@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4 flex justify-between items-center">

        <div>
            <h1 class="text-xl font-semibold">Usuarios</h1>
            <p class="text-sm text-gray-300">Listado de usuarios del sistema</p>
        </div>

        <a href="{{ route('usuarios.create') }}"
           class="bg-white text-gray-800 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100">
            + Nuevo Usuario
        </a>

    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-gray-200 rounded-b-lg shadow-sm overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Nombre
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Email
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Rol
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Estado
                    </th>

                    <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Acciones
                    </th>

                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                @foreach($usuarios as $usuario)
                <tr class="hover:bg-gray-50 transition">

                    {{-- NOMBRE --}}
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $usuario->nombre }}
                    </td>

                    {{-- EMAIL --}}
                    <td class="px-6 py-4 text-gray-600">
                        {{ $usuario->email }}
                    </td>

                    {{-- ROL --}}
                    <td class="px-6 py-4 text-gray-600">
                        {{ $usuario->roles->first()->name ?? 'Sin rol' }}
                    </td>

                    {{-- ESTADO --}}
                    <td class="px-6 py-4">
                        @if($usuario->activo)
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">
                                Activo
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 font-medium">
                                Inactivo
                            </span>
                        @endif
                    </td>

                    {{-- ACCIONES --}}
                    <td class="px-6 py-4 text-right space-x-2">

                        <a href="{{ route('usuarios.edit', $usuario) }}"
                           class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-md text-sm hover:bg-yellow-200">
                            Editar
                        </a>

                        <form action="{{ route('usuarios.destroy', $usuario) }}"
                              method="POST"
                              class="inline">

                            @csrf
                            @method('DELETE')

                          <button type="submit"
        onclick="return confirm('¿Seguro que deseas eliminar este usuario?')"
        class="bg-red-100 text-red-700 px-3 py-1 rounded-md text-sm hover:bg-red-200">
    Eliminar
</button>

                        </form>

                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

    {{-- PAGINACIÓN --}}
    <div class="mt-4">
        {{ $usuarios->links() }}
    </div>

</div>
@endsection