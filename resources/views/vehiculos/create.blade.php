@extends('layouts.app')

@section('content')
<div class="container py-4 max-w-2xl mx-auto">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4">
        <h1 class="text-xl font-semibold">Crear Vehículo</h1>
        <p class="text-sm text-gray-300">Registra un nuevo vehículo en el sistema</p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('vehiculos.store') }}" method="POST"
          class="bg-white border border-gray-200 rounded-b-lg p-6 space-y-4 shadow-sm">

        @csrf

        {{-- ERRORES GENERALES (NO ROMPE DISEÑO) --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- PLACA --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Placa</label>

            <input type="text" name="placa"
                   value="{{ old('placa') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2
                          focus:ring-2 focus:ring-gray-400 focus:outline-none
                          @error('placa') border-red-500 @enderror"
                   placeholder="Ej: A123456">

            @error('placa')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- MODELO --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Modelo</label>

            <select name="modelo_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                           focus:ring-2 focus:ring-gray-400 focus:outline-none
                           @error('modelo_id') border-red-500 @enderror">

                @foreach($modelos as $modelo)
                    <option value="{{ $modelo->id }}" @selected(old('modelo_id') == $modelo->id)>
                        {{ $modelo->marca->nombre }} - {{ $modelo->nombre }}
                    </option>
                @endforeach

            </select>

            @error('modelo_id')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- COLOR --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Color</label>

            <select name="color_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                           focus:ring-2 focus:ring-gray-400 focus:outline-none
                           @error('color_id') border-red-500 @enderror">

                @foreach($colores as $color)
                    <option value="{{ $color->id }}" @selected(old('color_id') == $color->id)>
                        {{ $color->nombre }}
                    </option>
                @endforeach

            </select>

            @error('color_id')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- AÑO --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Año</label>

            <input type="number" name="anio"
                   value="{{ old('anio') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2
                          focus:ring-2 focus:ring-gray-400 focus:outline-none
                          @error('anio') border-red-500 @enderror">

            @error('anio')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- PRECIO --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Precio</label>

            <input type="number" name="precio_lista"
                   value="{{ old('precio_lista') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2
                          focus:ring-2 focus:ring-gray-400 focus:outline-none
                          @error('precio_lista') border-red-500 @enderror">

            @error('precio_lista')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- ESTADO --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Estado</label>

            <select name="estado"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                           focus:ring-2 focus:ring-gray-400 focus:outline-none
                           @error('estado') border-red-500 @enderror">

                <option value="disponible" @selected(old('estado') == 'disponible')>Disponible</option>
                <option value="reservado" @selected(old('estado') == 'reservado')>Reservado</option>
                <option value="vendido" @selected(old('estado') == 'vendido')>Vendido</option>

            </select>

            @error('estado')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- BOTÓN --}}
        <div class="pt-2">
            <button class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-gray-700 transition">
                Guardar Vehículo
            </button>
        </div>

    </form>

</div>
@endsection