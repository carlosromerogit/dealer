<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Vehiculo;
use App\Models\Modelo;
use App\Models\Color;

class VehiculoController extends Controller implements HasMiddleware
{

 public static function middleware(){
    return [
        new Middleware('auth'),
        new Middleware('permission:vehiculos.index', only: ['index']),
        new Middleware('permission:vehiculos.create', only: ['create']),
        new Middleware('permission:vehiculos.store', only: ['store']),
        new Middleware('permission:vehiculos.show', only: ['show']),
        new Middleware('permission:vehiculos.edit', only: ['edit']),
        new Middleware('permission:vehiculos.update', only: ['update']),
        new Middleware('permission:vehiculos.destroy', only: ['destroy']),
    ];
 }

    public function index()
    {
        $vehiculos = Vehiculo::with(['modelo.marca', 'color'])
            ->latest()
            ->paginate(10);

        return view('vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        return view('vehiculos.create', [
            'modelos' => Modelo::with('marca')->get(),
            'colores' => Color::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'placa' => 'required|unique:vehiculos,placa',
            'vin' => 'nullable|unique:vehiculos,vin',

            'modelo_id' => 'required|exists:modelos,id',
            'color_id' => 'required|exists:colores,id',

            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'precio_lista' => 'required|numeric|min:0',
            'estado' => 'required|in:disponible,reservado,vendido',
        ]);

        Vehiculo::create($validated);

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo creado correctamente');
    }

    public function show(Vehiculo $vehiculo)
    {
        $vehiculo->load(['modelo.marca', 'color']);

        return view('vehiculos.show', compact('vehiculo'));
    }

    public function edit(Vehiculo $vehiculo)
    {
        return view('vehiculos.edit', [
            'vehiculo' => $vehiculo,
            'modelos' => Modelo::with('marca')->get(),
            'colores' => Color::all(),
        ]);
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $validated = $request->validate([
            'placa' => 'required|unique:vehiculos,placa,' . $vehiculo->id,
            'vin' => 'nullable|unique:vehiculos,vin,' . $vehiculo->id,

            'modelo_id' => 'required|exists:modelos,id',
            'color_id' => 'required|exists:colores,id',

            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'precio_lista' => 'required|numeric|min:0',
            'estado' => 'required|in:disponible,reservado,vendido',
        ]);

        $vehiculo->update($validated);

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        if ($vehiculo->estado === 'vendido') {
            return back()->withErrors([
                'error' => 'No puedes eliminar un vehículo vendido'
            ]);
        }

        $vehiculo->delete();

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado');
    }
}