<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('auth'),

            new Middleware(
                'role:admin'
            ),

        ];
    }

    public function index()
    {
        $usuarios = User::with('roles')->latest()->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('usuarios.create', compact('roles'));
    }

   public function store(Request $request)
{
    $data = $request->validate([

        'nombre' => ['required', 'string', 'max:255'],

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

        'password' => ['required', 'min:6'],

        'rol' => ['required', 'exists:roles,name'],

    ]);

    $usuario = User::create([

        'nombre' => $data['nombre'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'activo' => $request->boolean('activo'),

    ]);

    $usuario->assignRole($data['rol']);

    return redirect()
        ->route('usuarios.index')
        ->with('success', 'Usuario creado correctamente');
}

    public function edit(User $usuario)
    {
        $roles = Role::all();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $data = $request->validate([

            'nombre' => 'required|string|max:255',

                  'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($usuario) {

                    if ($value === $usuario->email) {
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

            'password' => 'nullable|min:6',

            'rol' => 'required|exists:roles,name',

            'activo' => 'nullable',
        ]);

        $usuario->update([

            'nombre' => $data['nombre'],

            'email' => $data['email'],

            'activo' => $request->boolean('activo'),
        ]);

        if ($request->filled('password')) {

            $usuario->update([
                'password' => Hash::make($data['password'])
            ]);
        }

        $usuario->syncRoles([$data['rol']]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario eliminado');
    }
}