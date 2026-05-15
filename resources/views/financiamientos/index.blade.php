@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4 flex justify-between items-center">

        <div>
            <h1 class="text-xl font-semibold">Financiamientos</h1>
            <p class="text-sm text-gray-300">Listado de financiamientos registrados</p>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-gray-200 rounded-b-lg shadow-sm overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Cliente
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Vehículo
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Banco
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Monto
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Total
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Cuota
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Pagado
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Saldo
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

                @forelse($financiamientos as $financiamiento)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $financiamiento->venta->cliente->nombre ?? 'N/A' }}
                    </td>

                    <td class="px-6 py-4 text-gray-700">
                        {{ $financiamiento->venta->vehiculo->modelo->marca->nombre ?? 'N/A' }}
                        {{ $financiamiento->venta->vehiculo->modelo->nombre ?? '' }}
                    </td>

                    <td class="px-6 py-4 text-gray-700">
                        {{ $financiamiento->entidad_bancaria }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-900">
                        RD${{ number_format($financiamiento->monto_financiado, 2) }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-900">
                        RD${{ number_format($financiamiento->total, 2) }}
                    </td>

                    <td class="px-6 py-4 text-gray-700">
                        RD${{ number_format($financiamiento->cuota_mensual, 2) }}
                    </td>

                    <td class="px-6 py-4 text-gray-700">
                        RD${{ number_format($financiamiento->total_pagado, 2) }}
                    </td>

                    <td class="px-6 py-4 text-gray-700">
                        RD${{ number_format($financiamiento->saldo, 2) }}
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full font-medium
                            {{ $financiamiento->estado === 'pagado'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($financiamiento->estado) }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right space-x-2">

                        <a href="{{ route('pagos.create', $financiamiento->id) }}"
                           class="bg-green-100 text-green-700 px-3 py-1 rounded-md text-sm hover:bg-green-200">
                            Pagar
                        </a>

                        <a href="{{ route('financiamientos.show', $financiamiento->id) }}"
                           class="bg-blue-100 text-blue-700 px-3 py-1 rounded-md text-sm hover:bg-blue-200">
                            Ver
                        </a>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-6 text-gray-500">
                        No hay financiamientos registrados
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINACIÓN --}}
    <div class="mt-4">
        {{ $financiamientos->links() }}
    </div>

</div>
@endsection