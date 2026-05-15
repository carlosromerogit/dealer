<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Vehiculo;
use App\Models\Financiamiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class VentaController extends Controller implements HasMiddleware
{
    public static function middleware(){
    return [
        new Middleware('auth'),
        new Middleware('permission:ventas.index', only: ['index']),
        new Middleware('permission:ventas.create', only: ['create']),
        new Middleware('permission:ventas.store', only: ['store']),
        new Middleware('permission:ventas.show', only: ['show']),
        new Middleware('permission:ventas.edit', only: ['edit']),
        new Middleware('permission:ventas.update', only: ['update']),
        new Middleware('permission:ventas.destroy', only: ['destroy']),
    ];
 }
    public function index()
        {
        $ventas = Venta::with([
        'cliente',
        'vehiculo.modelo.marca',
        'vendedor'
    ])->latest()->paginate(10);

        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        return view('ventas.create', [
            'clientes' => Cliente::all(),
            'vehiculos' => Vehiculo::where('estado', 'disponible')->get(),
            'vendedores' => Vendedor::where('activo', true)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'vendedor_id' => 'required|exists:vendedores,id',
            'fecha' => 'required|date',
            'descuento' => 'nullable|numeric|min:0',
            'tipo_pago' => 'required|in:contado,financiado',
            'monto_enganche' => 'nullable|numeric|min:0',
            'num_cuotas' => 'nullable|integer|min:1',
            'tasa_interes' => 'nullable|numeric|min:0',
            'entidad_bancaria' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($data) {

            $vehiculo = Vehiculo::findOrFail($data['vehiculo_id']);

            if ($vehiculo->estado !== 'disponible') {
                return back()->withErrors([
                    'vehiculo' => 'Este vehículo no está disponible'
                ]);
            }

            $precioLista = $vehiculo->precio_lista;
            $descuento = $data['descuento'] ?? 0;
            $precioFinal = $precioLista - $descuento;

            $venta = Venta::create([
                'cliente_id' => $data['cliente_id'],
                'vehiculo_id' => $vehiculo->id,
                'vendedor_id' => $data['vendedor_id'],
                'fecha' => $data['fecha'],
                'precio_lista' => $precioLista,
                'descuento' => $descuento,
                'precio_final' => $precioFinal,
                'tipo_pago' => $data['tipo_pago'],
                'estado' => 'completada',
            ]);

            $vehiculo->update([
                'estado' => 'vendido'
            ]);

            if ($data['tipo_pago'] === 'financiado') {

                $enganche = $data['monto_enganche'] ?? 0;
                $montoFinanciado = $precioFinal - $enganche;

                Financiamiento::create([
                    'venta_id' => $venta->id,
                    'entidad_bancaria' => $data['entidad_bancaria'],
                    'enganche' => $enganche,
                    'monto_financiado' => $montoFinanciado,
                    'num_cuotas' => $data['num_cuotas'],
                    'tasa_interes' => $data['tasa_interes'],
                ]);
            }

            return redirect()
                ->route('ventas.index')
                ->with('success', 'Venta registrada correctamente');
        });
    }

    public function show(Venta $venta)
    {
        $venta->load(['cliente', 'vehiculo', 'vendedor', 'financiamiento']);

        return view('ventas.show', compact('venta'));
    }
}
