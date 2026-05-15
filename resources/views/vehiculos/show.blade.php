@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER (solo esta parte gris como dijiste) --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4">
        <h1 class="text-xl font-semibold">Detalle del Vehículo</h1>
        <p class="text-sm text-gray-300">Información completa del vehículo</p>
    </div>

    {{-- CONTENIDO --}}
    <div class="bg-white border border-gray-200 rounded-b-lg p-6 shadow-sm">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <p class="text-sm text-gray-500">Placa</p>
                <p class="text-lg font-semibold text-gray-800">{{ $vehiculo->placa }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Marca</p>
                <p class="text-lg font-semibold text-gray-800">{{ $vehiculo->modelo->marca->nombre }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Modelo</p>
                <p class="text-lg font-semibold text-gray-800">{{ $vehiculo->modelo->nombre }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Color</p>
                <p class="text-lg font-semibold text-gray-800">{{ $vehiculo->color->nombre }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Año</p>
                <p class="text-lg font-semibold text-gray-800">{{ $vehiculo->anio }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Estado</p>
                <span class="px-3 py-1 text-sm rounded-full
                    {{ $vehiculo->estado == 'vendido'
                        ? 'bg-red-100 text-red-700'
                        : ($vehiculo->estado == 'reservado'
                            ? 'bg-yellow-100 text-yellow-700'
                            : 'bg-green-100 text-green-700') }}">
                    {{ ucfirst($vehiculo->estado) }}
                </span>
            </div>

        </div>

        {{-- PRECIO --}}
        <div class="mt-6 border-t pt-4">
            <p class="text-sm text-gray-500">Precio lista</p>
            <p class="text-2xl font-bold text-gray-900">
                RD${{ number_format($vehiculo->precio_lista, 2) }}
            </p>
        </div>

    </div>

</div>
@endsection