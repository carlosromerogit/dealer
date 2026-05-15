@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="bg-gray-800 text-white rounded-lg px-6 py-4 mb-6">
        <h1 class="text-xl font-semibold">Dashboard Ejecutivo</h1>
        <p class="text-sm text-gray-300">Centro de control del sistema</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

        <a href="{{ route('ventas.index') }}"
           class="bg-white border rounded-lg p-5 hover:shadow transition">

            <p class="text-gray-500 text-sm">Ventas del Mes</p>
            <p class="text-2xl font-bold">{{ $ventasMes }}</p>

        </a>

        <a href="{{ route('ventas.index') }}"
           class="bg-white border rounded-lg p-5 hover:shadow transition">

            <p class="text-gray-500 text-sm">Ingresos del Mes</p>
            <p class="text-2xl font-bold">RD${{ number_format($ingresosMes, 2) }}</p>

        </a>

        <a href="{{ route('vehiculos.index', ['estado' => 'disponible']) }}"
           class="bg-white border rounded-lg p-5 hover:shadow transition">

            <p class="text-gray-500 text-sm">Vehículos Disponibles</p>
            <p class="text-2xl font-bold">{{ $vehiculosDisponibles }}</p>

        </a>

        <a href="{{ route('financiamientos.index') }}"
           class="bg-white border rounded-lg p-5 hover:shadow transition">

            <p class="text-gray-500 text-sm">Saldo Pendiente</p>
            <p class="text-2xl font-bold text-red-600">
                RD${{ number_format($saldoPendiente, 2) }}
            </p>

        </a>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

        <div class="bg-white border rounded-lg p-5">

            <h2 class="font-semibold mb-3">Top Vendedores</h2>

            @foreach($topVendedores as $v)
                <a href="{{ route('vendedores.show', $v->id) }}"
                   class="flex justify-between py-2 border-b hover:bg-gray-50 px-2 rounded">

                    <span class="text-gray-800 font-medium">
                        {{ $v->nombre }}
                    </span>

                    <span class="text-gray-500 text-sm">
                        {{ $v->ventas_count }} ventas
                    </span>

                </a>
            @endforeach

        </div>

        <div class="bg-white border rounded-lg p-5">

            <h2 class="font-semibold mb-3">Últimas Ventas</h2>

            @foreach($ultimasVentas as $venta)
                <a href="{{ route('ventas.show', $venta->id) }}"
                   class="block py-2 border-b hover:bg-gray-50 px-2 rounded">

                    <div class="font-medium text-gray-800">
                        {{ $venta->cliente->nombre }}
                    </div>

                    <div class="text-sm text-gray-500">
                        RD${{ number_format($venta->precio_final,2) }}
                    </div>

                </a>
            @endforeach

        </div>

    </div>

    <div class="bg-white border rounded-lg p-5 mt-6">

        <h2 class="font-semibold mb-3">Últimos Vehículos</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

            @foreach($ultimosVehiculos as $vehiculo)
                <a href="{{ route('vehiculos.show', $vehiculo->id) }}"
                   class="border rounded-lg p-4 hover:bg-gray-50 transition">

                    <div class="font-medium text-gray-800">
                        {{ $vehiculo->modelo->marca->nombre }}
                        {{ $vehiculo->modelo->nombre }}
                    </div>

                    <div class="text-sm text-gray-500">
                        {{ $vehiculo->placa }}
                    </div>

                    <div class="text-sm font-semibold mt-1">
                        RD${{ number_format($vehiculo->precio_lista,2) }}
                    </div>

                </a>
            @endforeach

        </div>

    </div>

</div>
@endsection