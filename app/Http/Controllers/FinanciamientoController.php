<?php

namespace App\Http\Controllers;

use App\Models\Financiamiento;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FinanciamientoController extends Controller implements HasMiddleware
{
    public static function middleware(){
    return [
        new Middleware('auth'),
        new Middleware('permission:financiamientos.index', only: ['index']),
        new Middleware('permission:financiamientos.create', only: ['create']),
        new Middleware('permission:financiamientos.store', only: ['store']),
        new Middleware('permission:financiamientos.show', only: ['show']),
        new Middleware('permission:financiamientos.edit', only: ['edit']),
        new Middleware('permission:financiamientos.update', only: ['update']),
        new Middleware('permission:financiamientos.destroy', only: ['destroy']),
    ];
 }
    
    public function index()
    {
        $financiamientos = Financiamiento::with([
            'venta.cliente',
            'venta.vehiculo'
        ])
        ->latest()
        ->paginate(10);

        return view('financiamientos.index', compact('financiamientos'));
    }
public function show(Financiamiento $financiamiento)
{
    $financiamiento->load([
        'venta.cliente',
        'venta.vehiculo.modelo.marca',
        'pagos'
    ]);

    return view('financiamientos.show', compact('financiamiento'));
}

    public function edit(Financiamiento $financiamiento)
    {
        return view('financiamientos.edit', compact('financiamiento'));
    }

    public function update(Request $request, Financiamiento $financiamiento)
    {
        $data = $request->validate([
            'entidad_bancaria' => 'required',
            'enganche' => 'required|numeric|min:0',
            'monto_financiado' => 'required|numeric|min:0',
            'num_cuotas' => 'required|integer|min:1',
            'tasa_interes' => 'required|numeric|min:0',
        ]);

        $financiamiento->update($data);

        return redirect()
            ->route('financiamientos.index')
            ->with('success', 'Financiamiento actualizado');
    }
}