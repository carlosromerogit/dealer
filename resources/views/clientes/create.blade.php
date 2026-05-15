@extends('layouts.app')

@section('content')
<div class="container py-4 max-w-2xl">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4">
        <h1 class="text-xl font-semibold">Crear Cliente</h1>
        <p class="text-sm text-gray-300">
            Registra un nuevo cliente en el sistema
        </p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('clientes.store') }}"
          method="POST"
          class="bg-white border border-gray-200 rounded-b-lg p-6 space-y-4 shadow-sm">

        @csrf

        {{-- ERRORES GENERALES --}}
        @if ($errors->any())

        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">

            <h3 class="font-semibold mb-2">
                Hay errores en el formulario:
            </h3>

            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

        @endif

        {{-- NOMBRE --}}
        <div>

            <label class="block text-sm text-gray-600 mb-1">
                Nombre
            </label>

            <input type="text"
                   name="nombre"
                   value="{{ old('nombre') }}"
                   placeholder="Nombre completo"
                   class="w-full rounded-lg px-3 py-2 border
                          @error('nombre')
                              border-red-500 ring-2 ring-red-100
                          @else
                              border-gray-300
                          @enderror
                          focus:ring-2 focus:ring-gray-400 focus:outline-none">

            @error('nombre')
                <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- CÉDULA --}}
        <div>

            <label class="block text-sm text-gray-600 mb-1">
                Cédula
            </label>

            <input type="text"
                   name="cedula"
                   value="{{ old('cedula') }}"
                   placeholder="000-0000000-0"
                   class="w-full rounded-lg px-3 py-2 border
                          @error('cedula')
                              border-red-500 ring-2 ring-red-100
                          @else
                              border-gray-300
                          @enderror
                          focus:ring-2 focus:ring-gray-400 focus:outline-none">

            @error('cedula')
                <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- TELÉFONO --}}
        <div>

            <label class="block text-sm text-gray-600 mb-1">
                Teléfono
            </label>

            <input type="text"
                   name="telefono"
                   value="{{ old('telefono') }}"
                   placeholder="809-000-0000"
                   class="w-full rounded-lg px-3 py-2 border
                          @error('telefono')
                              border-red-500 ring-2 ring-red-100
                          @else
                              border-gray-300
                          @enderror
                          focus:ring-2 focus:ring-gray-400 focus:outline-none">

            @error('telefono')
                <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- EMAIL --}}
        <div>

            <label class="block text-sm text-gray-600 mb-1">
                Email
            </label>

            <input type="text"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="correo@email.com"
                   class="w-full rounded-lg px-3 py-2 border
                          @error('email')
                              border-red-500 ring-2 ring-red-100
                          @else
                              border-gray-300
                          @enderror
                          focus:ring-2 focus:ring-gray-400 focus:outline-none">

            @error('email')
                <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- DIRECCIÓN --}}
        <div>

            <label class="block text-sm text-gray-600 mb-1">
                Dirección
            </label>

            <input type="text"
                   name="direccion"
                   value="{{ old('direccion') }}"
                   placeholder="Dirección completa"
                   class="w-full rounded-lg px-3 py-2 border
                          @error('direccion')
                              border-red-500 ring-2 ring-red-100
                          @else
                              border-gray-300
                          @enderror
                          focus:ring-2 focus:ring-gray-400 focus:outline-none">

            @error('direccion')
                <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- BOTÓN --}}
        <div class="pt-2">

            <button class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-gray-700 transition">
                Guardar Cliente
            </button>

        </div>

    </form>

</div>
@endsection