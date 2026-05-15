<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Financiamiento;
use App\Models\Pago;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PagoController extends Controller implements HasMiddleware
{

    public static function middleware(){
    return [
        new Middleware('auth'),
        new Middleware('permission:pagos.index', only: ['index']),
        new Middleware('permission:pagos.create', only: ['create']),
        new Middleware('permission:pagos.store', only: ['store']),
    ];
 }

public function index()
{
    $financiamientos = Financiamiento::with('venta.cliente', 'venta.vehiculo')
        ->get();

    return view('pagos.index', compact('financiamientos'));
}
    public function create($financiamiento_id)
    {
        $financiamiento = Financiamiento::with('venta.cliente', 'venta.vehiculo')
            ->findOrFail($financiamiento_id);

        return view('pagos.create', compact('financiamiento'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'financiamiento_id' => 'required|exists:financiamientos,id',
        'monto' => 'required|numeric|min:1',
        'fecha_pago' => 'required|date',
        'numero_cuota' => 'nullable|integer'
    ]);

    $financiamiento = Financiamiento::with('pagos')
        ->findOrFail($data['financiamiento_id']);

    $totalPagado = $financiamiento->pagos->sum('monto');
    $saldoPendiente = $financiamiento->monto_financiado - $totalPagado;

    if ($data['monto'] > $saldoPendiente) {
        return back()->withErrors([
            'monto' => "El pago no puede ser mayor al saldo pendiente: " . "RD$" .number_format($saldoPendiente, 2)
        ])->withInput();
    }

    $financiamiento->pagos()->create([
        'monto' => $data['monto'],
        'fecha_pago' => $data['fecha_pago'],
        'numero_cuota' => $data['numero_cuota'] ?? null,
    ]);

    return redirect()
        ->route('financiamientos.show', $financiamiento->id)
        ->with('success', 'Pago registrado correctamente');
}
}