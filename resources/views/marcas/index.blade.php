@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Marcas
            </h1>

            <p class="text-sm text-gray-500">
                Gestión de marcas de vehículos
            </p>
        </div>

        <a href="{{ route('marcas.create') }}"
           class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2.5 rounded-xl transition">
            Nueva Marca
        </a>

    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERRORS --}}
    @if($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- CARD --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- TABLE HEADER --}}
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-800">
            <h2 class="text-lg font-semibold text-white">
                Listado de marcas
            </h2>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600">
                            Nombre
                        </th>

                        <th class="px-6 py-3 text-left font-semibold text-gray-600">
                            Modelos
                        </th>

                        <th class="px-6 py-3 text-right font-semibold text-gray-600">
                            Acciones
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($marcas as $marca)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- NOMBRE --}}
                            <td class="px-6 py-4 text-gray-800 font-medium">
                                {{ $marca->nombre }}
                            </td>

                            {{-- MODELOS --}}
                            <td class="px-6 py-4 text-gray-600">
                                {{ $marca->modelos_count }}
                            </td>

                            {{-- ACTIONS --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    {{-- EDITAR --}}
                                    <a href="{{ route('marcas.edit', $marca) }}"
                                       class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700
                                              hover:bg-blue-100 transition text-sm">
                                        Editar
                                    </a>

                                    {{-- ELIMINAR --}}
                                    <form action="{{ route('marcas.destroy', $marca) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Eliminar esta marca?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-1.5 rounded-lg bg-red-50 text-red-700
                                                       hover:bg-red-100 transition text-sm">
                                            Eliminar
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="3"
                                class="px-6 py-10 text-center text-gray-500">

                                No hay marcas registradas

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if($marcas->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $marcas->links() }}
            </div>
        @endif

    </div>

</div>
@endsection