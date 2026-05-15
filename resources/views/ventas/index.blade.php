@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4 flex justify-between items-center">

        <div>
            <h1 class="text-xl font-semibold">Ventas</h1>
            <p class="text-sm text-gray-300">Listado de ventas registradas</p>
        </div>

        <a href="{{ route('ventas.create') }}"
           class="bg-white text-gray-800 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100">
            + Nueva Venta
        </a>

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
                        Vendedor
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Precio Final
                    </th>

                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                        Tipo Pago
                    </th>

                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                @foreach($ventas as $venta)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $venta->cliente->nombre }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $venta->vehiculo->modelo->marca->nombre }}
                        {{ $venta->vehiculo->modelo->nombre }}
                    </td>

                    <td class="px-6 py-4">
                        <a href="{{ route('vendedores.show', $venta->vendedor_id) }}"
                           class="text-blue-600 hover:underline font-medium">
                            {{ $venta->vendedor->nombre }}
                        </a>
                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-900">
                        RD${{ number_format($venta->precio_final, 2) }}
                    </td>

                    <td class="px-6 py-4 text-gray-600 capitalize">
                        {{ $venta->tipo_pago }}
                    </td>
                  
                    <td class="px-6 py-4 text-gray-600 capitalize">
                           <a href="{{ route('ventas.show', $venta) }}"
                           class="bg-blue-100 text-blue-700 px-3 py-1 rounded-md text-sm hover:bg-blue-200">
                            Ver
                        </a>
                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</div>
@endsection