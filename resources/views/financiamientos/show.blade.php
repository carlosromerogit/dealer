@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4">
        <h1 class="text-xl font-semibold">Detalle del Financiamiento</h1>
        <p class="text-sm text-gray-300">Información completa del crédito y pagos</p>
    </div>

    {{-- INFO PRINCIPAL --}}
    <div class="bg-white border border-gray-200 rounded-b-lg shadow-sm p-6 space-y-4">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <p class="text-sm text-gray-500">Cliente</p>
                <p class="font-semibold text-gray-900">
                    {{ $financiamiento->venta->cliente->nombre }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Vehículo</p>
                <p class="font-semibold text-gray-900">
                    {{ $financiamiento->venta->vehiculo->modelo->marca->nombre }}
                    {{ $financiamiento->venta->vehiculo->modelo->nombre }}
                    - {{ $financiamiento->venta->vehiculo->placa }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Banco</p>
                <p class="font-semibold text-gray-900">
                    {{ $financiamiento->entidad_bancaria }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Enganche</p>
                <p class="font-semibold text-gray-900">
                    RD${{ number_format($financiamiento->enganche, 2) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Monto financiado</p>
                <p class="font-semibold text-gray-900">
                    RD${{ number_format($financiamiento->monto_financiado, 2) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Cuotas</p>
                <p class="font-semibold text-gray-900">
                    {{ $financiamiento->num_cuotas }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tasa de interés</p>
                <p class="font-semibold text-gray-900">
                    {{ $financiamiento->tasa_interes }}%
                </p>
            </div>

        </div>

        {{-- BOTÓN --}}
        <div class="pt-4 border-t border-gray-200 flex justify-end">
            <a href="{{ route('pagos.create', $financiamiento->id) }}"
               class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-gray-900 transition">
                Registrar pago
            </a>
        </div>

    </div>

    {{-- RESUMEN FINANCIERO --}}
    <div class="mt-4 bg-white border border-gray-200 rounded-lg shadow-sm p-6">

        <h3 class="text-lg font-semibold text-gray-900 mb-4">
            Resumen financiero
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-sm text-gray-500">Total financiado</p>
                <p class="text-xl font-bold text-gray-900">
                    RD${{ number_format($financiamiento->monto_financiado, 2) }}
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-sm text-gray-500">Total pagado</p>
                <p class="text-xl font-bold text-gray-900">
                    RD${{ number_format($financiamiento->total_pagado, 2) }}
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-sm text-gray-500">Saldo</p>
                <p class="text-xl font-bold text-gray-900">
                    RD${{ number_format($financiamiento->saldo, 2) }}
                </p>
            </div>

        </div>

        <div class="mt-4">
            <p class="text-sm text-gray-500 mb-1">Progreso</p>

            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-gray-800 h-3 rounded-full"
                     style="width: {{ $financiamiento->progreso }}%">
                </div>
            </div>

            <p class="text-sm text-gray-600 mt-1">
                {{ $financiamiento->progreso }}% completado
            </p>
        </div>

    </div>

    {{-- HISTORIAL --}}
    <div class="mt-4 bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-200">
            <h4 class="font-semibold text-gray-900">Historial de pagos</h4>
        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                            Cuota
                        </th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                            Monto
                        </th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                            Fecha
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($financiamiento->pagos as $pago)
                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4 text-gray-900">
                            {{ $pago->numero_cuota ?? '-' }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-900">
                            RD${{ number_format($pago->monto, 2) }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $pago->fecha_pago }}
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-6 text-gray-500">
                            No hay pagos registrados aún
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection