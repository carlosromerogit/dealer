<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelo;
use App\Models\Marca;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ModeloController extends Controller implements HasMiddleware
{
    public static function middleware(){
    return [
        new Middleware('auth'),
        new Middleware('permission:modelos.index', only: ['index']),
        new Middleware('permission:modelos.create', only: ['create']),
        new Middleware('permission:modelos.store', only: ['store']),
        new Middleware('permission:modelos.show', only: ['show']),
        new Middleware('permission:modelos.edit', only: ['edit']),
        new Middleware('permission:modelos.update', only: ['update']),
        new Middleware('permission:modelos.destroy', only: ['destroy']),
    ];
 }
    public function index()
    {
        $modelos = Modelo::with('marca')
            ->latest()
            ->paginate(10);

        return view('modelos.index', compact('modelos'));
    }

    public function create()
    {
        return view('modelos.create', [
            'marcas' => Marca::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'marca_id' => 'required|exists:marcas,id',
        ]);

        Modelo::create($data);

        return redirect()->route('modelos.index')
            ->with('success', 'Modelo creado');
    }

    public function edit(Modelo $modelo)
    {
        return view('modelos.edit', [
            'modelo' => $modelo,
            'marcas' => Marca::all()
        ]);
    }

    public function update(Request $request, Modelo $modelo)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'marca_id' => 'required|exists:marcas,id',
        ]);

        $modelo->update($data);

        return redirect()->route('modelos.index')
            ->with('success', 'Modelo actualizado');
    }

    public function destroy(Modelo $modelo)
    {
        if ($modelo->vehiculos()->count() > 0) {
            return back()->withErrors([
                'error' => 'No puedes eliminar un modelo con vehículos asociados'
            ]);
        }

        $modelo->delete();

        return back()->with('success', 'Modelo eliminado');
    }
}