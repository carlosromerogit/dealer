@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto mt-10 px-4">

    {{-- HEADER --}}
    <div class="bg-gray-800 rounded-t-2xl px-6 py-5 flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-semibold text-white">
                Detalle de Venta
            </h1>

            <p class="text-sm text-gray-300">
                Información completa de la venta realizada
            </p>
        </div>

        <a href="{{ route('ventas.index') }}"
           class="bg-white text-gray-800 px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-100 transition">
            ← Volver
        </a>

    </div>

    <div class="bg-white border border-gray-200 rounded-b-2xl shadow-sm overflow-hidden">

        {{-- GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">

            {{-- CLIENTE --}}
            <div class="border border-gray-200 rounded-2xl p-5">

                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    Cliente
                </h2>

                <div class="space-y-3">

                    <div>
                        <p class="text-xs text-gray-500 uppercase">
                            Nombre
                        </p>

                        <p class="text-gray-900 font-medium">
                            {{ $venta->cliente->nombre }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase">
                            Teléfono
                        </p>

                        <p class="text-gray-700">
                            {{ $venta->cliente->telefono }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase">
                            Email
                        </p>

                        <p class="text-gray-700">
                            {{ $venta->cliente->email ?? 'N/A' }}
                        </p>
                    </div>

                </div>

            </div>

            {{-- VEHÍCULO --}}
            <div class="border border-gray-200 rounded-2xl p-5">

                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    Vehículo
                </h2>

                <div class="space-y-3">

                    <div>
                        <p class="text-xs text-gray-500 uppercase">
                            Vehículo
                        </p>

                        <p class="text-gray-900 font-medium">
                            {{ $venta->vehiculo->modelo->marca->nombre }}
                            {{ $venta->vehiculo->modelo->nombre }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase">
                            Placa
                        </p>

                        <p class="text-gray-700">
                            {{ $venta->vehiculo->placa }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase">
                            Año
                        </p>

                        <p class="text-gray-700">
                            {{ $venta->vehiculo->anio }}
                        </p>
                    </div>

                </div>

            </div>

            {{-- VENDEDOR --}}
            <div class="border border-gray-200 rounded-2xl p-5">

                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    Vendedor
                </h2>

                <div class="space-y-3">

                    <div>
                        <p class="text-xs text-gray-500 uppercase">
                            Nombre
                        </p>

                        <p class="text-gray-900 font-medium">
                            {{ $venta->vendedor->nombre }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase">
                            Comisión
                        </p>

                        <p class="text-gray-700">
                            {{ $venta->vendedor->comision_pct }}%
                        </p>
                    </div>

                </div>

            </div>

        </div>

        {{-- RESUMEN FINANCIERO --}}
        <div class="border-t border-gray-200 p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-5">
                Resumen de la Venta
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                {{-- PRECIO --}}
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">

                    <p class="text-sm text-gray-500">
                        Precio Final
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900 mt-2">
                        RD${{ number_format($venta->precio_final, 2) }}
                    </h3>

                </div>

                {{-- DESCUENTO --}}
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">

                    <p class="text-sm text-gray-500">
                        Descuento
                    </p>

                    <h3 class="text-2xl font-bold text-red-600 mt-2">
                        RD${{ number_format($venta->descuento, 2) }}
                    </h3>

                </div>

                {{-- TIPO PAGO --}}
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">

                    <p class="text-sm text-gray-500">
                        Tipo de Pago
                    </p>

                    <h3 class="text-xl font-semibold text-gray-900 mt-2">
                        {{ ucfirst($venta->tipo_pago) }}
                    </h3>

                </div>

                {{-- FECHA --}}
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">

                    <p class="text-sm text-gray-500">
                        Fecha
                    </p>

                    <h3 class="text-xl font-semibold text-gray-900 mt-2">
                        {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}
                    </h3>

                </div>

            </div>

        </div>

        {{-- FINANCIAMIENTO --}}
        @if($venta->tipo_pago === 'financiado' && $venta->financiamiento)

        <div class="border-t border-gray-200 p-6">

            <div class="flex items-center justify-between mb-5">

                <h2 class="text-lg font-semibold text-gray-800">
                    Financiamiento
                </h2>

                <a href="{{ route('financiamientos.show', $venta->financiamiento->id) }}"
                   class="bg-blue-100 text-blue-700 px-4 py-2 rounded-xl text-sm hover:bg-blue-200 transition">
                    Ver financiamiento
                </a>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">
                    <p class="text-sm text-gray-500">Banco</p>

                    <h3 class="text-lg font-semibold text-gray-900 mt-2">
                        {{ $venta->financiamiento->entidad_bancaria }}
                    </h3>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">
                    <p class="text-sm text-gray-500">Enganche</p>

                    <h3 class="text-lg font-semibold text-gray-900 mt-2">
                        RD${{ number_format($venta->financiamiento->enganche, 2) }}
                    </h3>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">
                    <p class="text-sm text-gray-500">Cuotas</p>

                    <h3 class="text-lg font-semibold text-gray-900 mt-2">
                        {{ $venta->financiamiento->num_cuotas }}
                    </h3>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">
                    <p class="text-sm text-gray-500">Interés</p>

                    <h3 class="text-lg font-semibold text-gray-900 mt-2">
                        {{ $venta->financiamiento->tasa_interes }}%
                    </h3>
                </div>

            </div>

        </div>

        @endif

    </div>

</div>

@endsection