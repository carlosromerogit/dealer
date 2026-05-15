@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 px-4">

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 bg-gray-800 border-b border-gray-200">
            <h1 class="text-xl font-semibold text-gray-100">
                Registrar Pago
            </h1>
            <p class="text-sm text-gray-300">
                Agrega un pago al financiamiento
            </p>
        </div>

        <div class="p-6 space-y-6">

            {{-- ERRORES GENERALES --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    <ul class="text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- INFO FINANCIAMIENTO --}}
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 space-y-2 text-sm">

                <p class="text-gray-700">
                    <span class="font-semibold">Cliente:</span>
                    {{ $financiamiento->venta->cliente->nombre }}
                </p>

                <p class="text-gray-700">
                    <span class="font-semibold">Vehículo:</span>
                    {{ $financiamiento->venta->vehiculo->modelo->marca->nombre }}
                    {{ $financiamiento->venta->vehiculo->modelo->nombre }}
                    - {{ $financiamiento->venta->vehiculo->placa }}
                </p>

                <p class="text-gray-700">
                    <span class="font-semibold">Saldo actual:</span>
                    RD${{ number_format($financiamiento->saldo, 2) }}
                </p>

                <p class="text-gray-700">
                    <span class="font-semibold">Cuota estimada:</span>
                    RD${{ number_format($financiamiento->cuota_mensual, 2) }}
                </p>

            </div>

            {{-- FORM --}}
            <form method="POST" action="{{ route('pagos.store') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="financiamiento_id" value="{{ $financiamiento->id }}">

                {{-- MONTO --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Monto del pago</label>

                    <input type="number"
                           step="0.01"
                           name="monto"
                           value="{{ old('monto') }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border
                                  @error('monto') border-red-500 ring-2 ring-red-100 @else border-gray-300 @enderror
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition"
                           required>

                    @error('monto')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- FECHA --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Fecha de pago</label>

                    <input type="date"
                           name="fecha_pago"
                           value="{{ old('fecha_pago') }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border
                                  @error('fecha_pago') border-red-500 ring-2 ring-red-100 @else border-gray-300 @enderror
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition"
                           required>

                    @error('fecha_pago')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CUOTA --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">
                        Número de cuota (opcional)
                    </label>

                    <input type="number"
                           name="numero_cuota"
                           value="{{ old('numero_cuota') }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">

                    @error('numero_cuota')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BOTONES --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

                    <a href="{{ route('financiamientos.show', $financiamiento->id) }}"
                       class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="px-6 py-2.5 rounded-xl bg-gray-800 text-white font-medium
                                   hover:bg-gray-900 active:scale-95 transition">
                        Guardar pago
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection