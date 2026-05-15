@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4 flex justify-between items-center">

        <div>
            <h1 class="text-xl font-semibold">Vehículos</h1>
            <p class="text-sm text-gray-300">Listado de vehículos registrados</p>
        </div>

        <a href="{{ route('vehiculos.create') }}"
           class="bg-white text-gray-800 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100">
            + Nuevo Vehículo
        </a>

    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-gray-200 rounded-b-lg shadow-sm overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Placa
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Marca
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Modelo
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Color
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Año
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Precio
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

                @foreach($vehiculos as $vehiculo)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $vehiculo->placa }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $vehiculo->modelo->marca->nombre ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $vehiculo->modelo->nombre ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $vehiculo->color->nombre ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $vehiculo->anio }}
                    </td>

                    <td class="px-6 py-4 text-gray-900 font-semibold">
                        RD${{ number_format($vehiculo->precio_lista, 2) }}
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full font-medium
                            {{ $vehiculo->estado == 'vendido'
                                ? 'bg-red-100 text-red-700'
                                : ($vehiculo->estado == 'reservado'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : 'bg-green-100 text-green-700') }}">
                            {{ ucfirst($vehiculo->estado) }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right space-x-2">

                        <a href="{{ route('vehiculos.show', $vehiculo) }}"
                           class="bg-blue-100 text-blue-700 px-3 py-1 rounded-md text-sm hover:bg-blue-200">
                            Ver
                        </a>

                        <a href="{{ route('vehiculos.edit', $vehiculo) }}"
                           class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-md text-sm hover:bg-yellow-200">
                            Editar
                        </a>

                        <form action="{{ route('vehiculos.destroy', $vehiculo) }}"
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

    {{-- PAGINACIÓN --}}
    <div class="mt-4">
        {{ $vehiculos->links() }}
    </div>

</div>
@endsection