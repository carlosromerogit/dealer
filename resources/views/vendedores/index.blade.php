@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4 flex justify-between items-center">

        <div>
            <h1 class="text-xl font-semibold">Vendedores</h1>
            <p class="text-sm text-gray-300">Listado de vendedores registrados</p>
        </div>

        <a href="{{ route('vendedores.create') }}"
           class="bg-white text-gray-800 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100">
            + Nuevo Vendedor
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
                        Comisión %
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

                @foreach($vendedores as $vendedor)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $vendedor->nombre }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $vendedor->email }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $vendedor->comision_pct }}%
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full font-medium
                            {{ $vendedor->activo
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700' }}">
                            {{ $vendedor->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right space-x-2">

                        <a href="{{ route('vendedores.show', $vendedor) }}"
                           class="bg-blue-100 text-blue-700 px-3 py-1 rounded-md text-sm hover:bg-blue-200">
                            Ver
                        </a>

                        <a href="{{ route('vendedores.edit', $vendedor) }}"
                           class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-md text-sm hover:bg-yellow-200">
                            Editar
                        </a>

                        <form action="{{ route('vendedores.destroy', $vendedor) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-100 text-red-700 px-3 py-1 rounded-md text-sm hover:bg-red-200">
                                Eliminar
                            </button>
                        </form>

                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

    {{-- PAGINACIÓN (si aplica) --}}
    <div class="mt-4">
        {{ $vendedores->links() }}
    </div>

</div>
@endsection