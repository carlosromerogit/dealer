@extends('layouts.app')

@section('content')
<div class="container py-4 max-w-4xl mx-auto">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4">
        <h1 class="text-xl font-semibold">
            Nueva Venta
        </h1>
        <p class="text-sm text-gray-300">
            Registro de venta y financiamiento (si aplica)
        </p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('ventas.store') }}"
          method="POST"
          class="bg-white border border-gray-200 rounded-b-lg shadow-sm p-6 space-y-5">

        @csrf

        {{-- ERRORES GENERALES --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <ul class="text-sm list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- CLIENTE --}}
        <div>
            <label class="text-sm text-gray-600">Cliente</label>
            <select name="cliente_id"
                    class="mt-1 w-full px-4 py-2.5 rounded-lg border
                           @error('cliente_id') border-red-500 @else border-gray-300 @enderror
                           focus:border-gray-500 focus:ring-2 focus:ring-gray-200">

                @foreach($clientes as $c)
                    <option value="{{ $c->id }}" @selected(old('cliente_id') == $c->id)>
                        {{ $c->nombre }}
                    </option>
                @endforeach

            </select>

            @error('cliente_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- VEHICULO --}}
        <div>
            <label class="text-sm text-gray-600">Vehículo</label>
            <select name="vehiculo_id"
                    class="mt-1 w-full px-4 py-2.5 rounded-lg border
                           @error('vehiculo_id') border-red-500 @else border-gray-300 @enderror
                           focus:border-gray-500 focus:ring-2 focus:ring-gray-200">

                @foreach($vehiculos as $v)
                    <option value="{{ $v->id }}" @selected(old('vehiculo_id') == $v->id)>
                        {{ $v->modelo->marca->nombre }}
                        {{ $v->modelo->nombre }}
                        - {{ $v->placa }}
                        - RD${{ number_format($v->precio_lista, 2) }}
                    </option>
                @endforeach

            </select>

            @error('vehiculo_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- VENDEDOR --}}
        <div>
            <label class="text-sm text-gray-600">Vendedor</label>
            <select name="vendedor_id"
                    class="mt-1 w-full px-4 py-2.5 rounded-lg border
                           @error('vendedor_id') border-red-500 @else border-gray-300 @enderror
                           focus:border-gray-500 focus:ring-2 focus:ring-gray-200">

                @foreach($vendedores as $v)
                    <option value="{{ $v->id }}" @selected(old('vendedor_id') == $v->id)>
                        {{ $v->nombre }}
                    </option>
                @endforeach

            </select>

            @error('vendedor_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- FECHA --}}
            <div>
                <label class="text-sm text-gray-600">Fecha</label>
                <input type="date"
                       name="fecha"
                       value="{{ old('fecha') }}"
                       class="mt-1 w-full px-4 py-2.5 rounded-lg border
                              @error('fecha') border-red-500 @else border-gray-300 @enderror">

                @error('fecha')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DESCUENTO --}}
            <div>
                <label class="text-sm text-gray-600">Descuento</label>
                <input type="number"
                       name="descuento"
                       value="{{ old('descuento') }}"
                       class="mt-1 w-full px-4 py-2.5 rounded-lg border
                              @error('descuento') border-red-500 @else border-gray-300 @enderror">

                @error('descuento')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- TIPO PAGO --}}
        <div>
            <label class="text-sm text-gray-600">Tipo de pago</label>
            <select name="tipo_pago"
                    class="mt-1 w-full px-4 py-2.5 rounded-lg border
                           @error('tipo_pago') border-red-500 @else border-gray-300 @enderror">

                <option value="contado" @selected(old('tipo_pago') == 'contado')>Contado</option>
                <option value="financiado" @selected(old('tipo_pago') == 'financiado')>Financiado</option>

            </select>

            @error('tipo_pago')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- FINANCIAMIENTO --}}
        <div class="border-t border-gray-200 pt-5">

            <h2 class="text-sm font-semibold text-gray-700 mb-3">
                Financiamiento (si aplica)
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <input type="text"
                           name="entidad_bancaria"
                           value="{{ old('entidad_bancaria') }}"
                           placeholder="Banco"
                           class="w-full px-4 py-2.5 rounded-lg border">

                    @error('entidad_bancaria')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="number"
                           name="monto_enganche"
                           value="{{ old('monto_enganche') }}"
                           placeholder="Enganche"
                           class="w-full px-4 py-2.5 rounded-lg border">

                    @error('monto_enganche')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="number"
                           name="num_cuotas"
                           value="{{ old('num_cuotas') }}"
                           placeholder="Cuotas"
                           class="w-full px-4 py-2.5 rounded-lg border">

                    @error('num_cuotas')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="number"
                           name="tasa_interes"
                           value="{{ old('tasa_interes') }}"
                           placeholder="Interés %"
                           class="w-full px-4 py-2.5 rounded-lg border">

                    @error('tasa_interes')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

        </div>

        {{-- BOTÓN --}}
        <div class="flex justify-end pt-4 border-t border-gray-200">

            <button type="submit"
                    class="bg-gray-800 text-white px-6 py-2.5 rounded-lg hover:bg-gray-900 transition">
                Guardar Venta
            </button>

        </div>

    </form>

</div>
@endsection