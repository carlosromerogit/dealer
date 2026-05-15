<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendedor;
use App\Models\Cliente;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class VendedorController extends Controller implements HasMiddleware
{
     public static function middleware(){
    return [
        new Middleware('auth'),
        new Middleware('permission:vendedores.index', only: ['index']),
        new Middleware('permission:vendedores.create', only: ['create']),
        new Middleware('permission:vendedores.store', only: ['store']),
        new Middleware('permission:vendedores.show', only: ['show']),
        new Middleware('permission:vendedores.edit', only: ['edit']),
        new Middleware('permission:vendedores.update', only: ['update']),
        new Middleware('permission:vendedores.destroy', only: ['destroy']),
    ];
 }
    public function index()
    {
        $vendedores = Vendedor::latest()->paginate(10);
        return view('vendedores.index', compact('vendedores'));
    }

    public function create()
    {
        return view('vendedores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'email' => [
        'required',
        'email',
        function ($attribute, $value, $fail) {

            $exists =
                User::where('email', $value)->exists() ||
                Cliente::where('email', $value)->exists() ||
                Vendedor::where('email', $value)->exists();

            if ($exists) {
                $fail('El email ya está registrado en el sistema.');
            }
        }
    ],
            'telefono' => 'nullable',
            'comision_pct' => 'required|numeric|min:0|max:100',
        ]);

        $data['activo'] = $request->has('activo');

        Vendedor::create($data);

        return redirect()->route('vendedores.index');
    }
public function show(Vendedor $vendedor)
{
    $totalVentas = $vendedor->ventas()->count();

$totalIngresos = $vendedor->ventas()->sum('precio_final');
  $comisionTotal = $totalIngresos * ($vendedor->comision_pct / 100);
    return view('vendedores.show', compact(
        'vendedor',
        'totalVentas',
        'totalIngresos',
        'comisionTotal'
    ));
}

    public function edit(Vendedor $vendedor)
    {
        return view('vendedores.edit', compact('vendedor'));
    }

   public function update(Request $request, Vendedor $vendedor)
{
    $data = $request->validate([
        'nombre' => 'required',
            'email' => [
            'required',
            'email',
            function ($attribute, $value, $fail) use ($vendedor) {

                $exists =
                    User::where('email', $value)->exists() ||
                    Cliente::where('email', $value)->exists() ||
                    Vendedor::where('email', $value)
                        ->where('id', '!=', $vendedor->id)
                        ->exists();

                if ($exists) {
                    $fail('El email ya está registrado en el sistema.');
                }
            }
        ],
        'telefono' => 'nullable',
        'comision_pct' => 'required|numeric|min:0|max:100',
    ]);

    $data['activo'] = $request->has('activo');

    $vendedor->update($data);

    return redirect()->route('vendedores.index');
}

    public function destroy(Vendedor $vendedor)
    {
        $vendedor->delete();

        return back();
    }
}
