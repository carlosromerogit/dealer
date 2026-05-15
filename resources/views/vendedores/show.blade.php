@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4">

        <h1 class="text-xl font-semibold">
            Detalle del Vendedor
        </h1>

        <p class="text-sm text-gray-300">
            Resumen de rendimiento y ventas
        </p>

        <h3 class="mt-2 text-lg font-semibold">
            {{ $vendedor->nombre }}
        </h3>

    </div>

    {{-- STATS --}}
    <div class="bg-white border border-gray-200 rounded-b-lg shadow-sm p-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="p-4 border border-gray-200 rounded-lg">
                <p class="text-sm text-gray-500">Total Ventas</p>
                <p class="text-2xl font-bold text-gray-900">
                    {{ $totalVentas }}
                </p>
            </div>

            <div class="p-4 border border-gray-200 rounded-lg">
                <p class="text-sm text-gray-500">Ingresos Generados</p>
                <p class="text-2xl font-bold text-gray-900">
                    RD${{ number_format($totalIngresos, 2) }}
                </p>
            </div>

            <div class="p-4 border border-gray-200 rounded-lg">
                <p class="text-sm text-gray-500">Comisión Total</p>
                <p class="text-2xl font-bold text-gray-900">
                    RD${{ number_format($comisionTotal, 2) }}
                </p>
            </div>

        </div>

        {{-- TABLE TITLE --}}
        <div class="mt-6 mb-3">
            <h4 class="text-lg font-semibold text-gray-800">
                Ventas del vendedor
            </h4>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto border border-gray-200 rounded-lg">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>

                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                            Vehículo
                        </th>

                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                            Precio
                        </th>

                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                            Comisión
                        </th>

                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                            Fecha
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @foreach($vendedor->ventas as $venta)

                        @php
                            $comision = $venta->precio_final * ($vendedor->comision_pct / 100);
                        @endphp

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 text-gray-900 font-medium">
                                {{ $venta->vehiculo->modelo->marca->nombre }}
                                {{ $venta->vehiculo->modelo->nombre }}
                                - {{ $venta->vehiculo->placa }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                RD${{ number_format($venta->precio_final, 2) }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                RD${{ number_format($comision, 2) }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection