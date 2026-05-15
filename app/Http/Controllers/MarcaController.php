<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MarcaController extends Controller implements HasMiddleware
{
    public static function middleware(){
    return [
        new Middleware('auth'),
        new Middleware('permission:marcas.index', only: ['index']),
        new Middleware('permission:marcas.create', only: ['create']),
        new Middleware('permission:marcas.store', only: ['store']),
        new Middleware('permission:marcas.show', only: ['show']),
        new Middleware('permission:marcas.edit', only: ['edit']),
        new Middleware('permission:marcas.update', only: ['update']),
        new Middleware('permission:marcas.destroy', only: ['destroy']),
    ];
 }
    
    public function index()
    {
        $marcas = Marca::with('modelos')
            ->withCount('modelos')
            ->latest()
            ->paginate(10);

        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:marcas,nombre',

            'modelos' => 'nullable|array',

            'modelos.*' => 'nullable|string|max:255',
        ]);

        // CREAR MARCA
        $marca = Marca::create([
            'nombre' => $validated['nombre']
        ]);

        // CREAR MODELOS
        if ($request->filled('modelos')) {

            foreach ($request->modelos as $modelo) {

                if (!empty($modelo)) {

                    $marca->modelos()->create([
                        'nombre' => $modelo
                    ]);

                }

            }

        }

        return redirect()
            ->route('marcas.index')
            ->with('success', 'Marca creada correctamente');
    }

    public function edit(Marca $marca)
    {
        $marca->load('modelos');

        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:marcas,nombre,' . $marca->id,

            'modelos' => 'nullable|array',

            'modelos.*' => 'nullable|string|max:255',
        ]);

        // ACTUALIZAR MARCA
        $marca->update([
            'nombre' => $validated['nombre']
        ]);

        // ELIMINAR MODELOS VIEJOS
        $marca->modelos()->delete();

        // CREAR NUEVOS
        if ($request->filled('modelos')) {

            foreach ($request->modelos as $modelo) {

                if (!empty($modelo)) {

                    $marca->modelos()->create([
                        'nombre' => $modelo
                    ]);

                }

            }

        }

        return redirect()
            ->route('marcas.index')
            ->with('success', 'Marca actualizada correctamente');
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();

        return back()->with('success', 'Marca eliminada');
    }
}