@extends('layouts.app')

@section('content')
<div class="container py-4 max-w-2xl mx-auto">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4">
        <h1 class="text-xl font-semibold">
            Crear Vendedor
        </h1>
        <p class="text-sm text-gray-300">
            Registra un nuevo vendedor en el sistema
        </p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('vendedores.store') }}"
          method="POST"
          class="bg-white border border-gray-200 rounded-b-lg shadow-sm p-6 space-y-4">

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

        {{-- NOMBRE --}}
        <div>
            <label class="text-sm text-gray-600">Nombre</label>

            <input type="text"
                   name="nombre"
                   value="{{ old('nombre') }}"
                   placeholder="Nombre completo"
                   class="mt-1 w-full px-4 py-2.5 rounded-lg border
                   @error('nombre')
                        border-red-500 ring-2 ring-red-100
                   @else
                        border-gray-300
                   @enderror
                   focus:border-gray-500 focus:ring-2 focus:ring-gray-200 outline-none transition">

            @error('nombre')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="text-sm text-gray-600">Email</label>

            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="correo@email.com"
                   class="mt-1 w-full px-4 py-2.5 rounded-lg border
                   @error('email')
                        border-red-500 ring-2 ring-red-100
                   @else
                        border-gray-300
                   @enderror
                   focus:border-gray-500 focus:ring-2 focus:ring-gray-200 outline-none transition">

            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- TELÉFONO --}}
        <div>
            <label class="text-sm text-gray-600">Teléfono</label>

            <input type="text"
                   name="telefono"
                   value="{{ old('telefono') }}"
                   placeholder="Ej: 809-000-0000"
                   class="mt-1 w-full px-4 py-2.5 rounded-lg border
                   @error('telefono')
                        border-red-500 ring-2 ring-red-100
                   @else
                        border-gray-300
                   @enderror
                   focus:border-gray-500 focus:ring-2 focus:ring-gray-200 outline-none transition">

            @error('telefono')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- COMISIÓN --}}
        <div>
            <label class="text-sm text-gray-600">Comisión %</label>

            <input type="number"
                   step="0.01"
                   name="comision_pct"
                   value="{{ old('comision_pct') }}"
                   placeholder="Ej: 5.00"
                   class="mt-1 w-full px-4 py-2.5 rounded-lg border
                   @error('comision_pct')
                        border-red-500 ring-2 ring-red-100
                   @else
                        border-gray-300
                   @enderror
                   focus:border-gray-500 focus:ring-2 focus:ring-gray-200 outline-none transition">

            @error('comision_pct')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- ACTIVO --}}
        <div class="flex items-center gap-2">
            <input type="checkbox"
                   name="activo"
                   checked
                   class="h-4 w-4 text-gray-800 border-gray-300 rounded">

            <label class="text-sm text-gray-700">
                Activo
            </label>
        </div>

        {{-- BOTÓN --}}
        <div class="flex justify-end pt-4 border-t border-gray-200">
            <button type="submit"
                    class="bg-gray-800 text-white px-5 py-2.5 rounded-lg hover:bg-gray-900 transition">
                Guardar Vendedor
            </button>
        </div>

    </form>

</div>
@endsection