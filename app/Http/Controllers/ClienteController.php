<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ClienteController extends Controller implements HasMiddleware
{
    //
    public static function middleware(){
    return [
        new Middleware('auth'),
        new Middleware('permission:clientes.index', only: ['index']),
        new Middleware('permission:clientes.create', only: ['create']),
        new Middleware('permission:clientes.store', only: ['store']),
        new Middleware('permission:clientes.show', only: ['show']),
        new Middleware('permission:clientes.edit', only: ['edit']),
        new Middleware('permission:clientes.update', only: ['update']),
        new Middleware('permission:clientes.destroy', only: ['destroy']),
    ];
 }


      public function index()
    {
        $clientes = Cliente::latest()->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'cedula' => 'required|unique:clientes,cedula',
            'telefono' => 'required',
            'email' => [
                    'required',
                    'email',
                    function ($attribute, $value, $fail) {

                        $existsInClientes = \App\Models\Cliente::where('email', $value)->exists();

                        $existsInUsers = \App\Models\User::where('email', $value)->exists();

                        $existsInVendedores = \App\Models\Vendedor::where('email', $value)->exists();

                        if ($existsInClientes || $existsInUsers || $existsInVendedores) {
                            $fail('El correo ya está registrado.');
                        }
                    }
                ],            'direccion' => 'nullable',
                    ]);

        Cliente::create($data);

        return redirect()->route('clientes.index');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'cedula' => 'required|unique:clientes,cedula,' . $cliente->id,
            'telefono' => 'required',
             'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($cliente) {

                    if ($value === $cliente->email) {
                        return;
                    }

                    $exists =
                        \App\Models\Cliente::where('email', $value)->exists() ||
                        \App\Models\User::where('email', $value)->exists() ||
                        \App\Models\Vendedor::where('email', $value)->exists();

                    if ($exists) {
                        $fail('El correo ya está registrado.');
                    }
                }
            ],
            'direccion' => 'nullable',
        ]);

        $cliente->update($data);

        return redirect()->route('clientes.index');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return back();
    }
}
