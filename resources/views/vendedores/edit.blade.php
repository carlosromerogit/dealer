@extends('layouts.app')

@section('content')
<div class="container py-4 max-w-2xl mx-auto">

    {{-- HEADER --}}
    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-4">
        <h1 class="text-xl font-semibold">
            Editar Vendedor
        </h1>
        <p class="text-sm text-gray-300">
            Modifica la información del vendedor
        </p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('vendedores.update', $vendedor) }}"
          method="POST"
          class="bg-white border border-gray-200 rounded-b-lg shadow-sm p-6 space-y-4">

        @csrf
        @method('PUT')

        {{-- NOMBRE --}}
        <div>
            <label class="text-sm text-gray-600">Nombre</label>
            <input type="text"
                   name="nombre"
                   value="{{ $vendedor->nombre }}"
                   class="mt-1 w-full px-4 py-2.5 rounded-lg border border-gray-300
                          focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                          outline-none transition">
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="text-sm text-gray-600">Email</label>
            <input type="email"
                   name="email"
                   value="{{ $vendedor->email }}"
                   class="mt-1 w-full px-4 py-2.5 rounded-lg border border-gray-300
                          focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                          outline-none transition">
        </div>
           @error('email')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror

        {{-- TELEFONO --}}
        <div>
            <label class="text-sm text-gray-600">Teléfono</label>
            <input type="text"
                   name="telefono"
                   value="{{ $vendedor->telefono }}"
                   class="mt-1 w-full px-4 py-2.5 rounded-lg border border-gray-300
                          focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                          outline-none transition">
        </div>

        {{-- COMISION --}}
        <div>
            <label class="text-sm text-gray-600">Comisión %</label>
            <input type="number"
                   step="0.01"
                   name="comision_pct"
                   value="{{ $vendedor->comision_pct }}"
                   class="mt-1 w-full px-4 py-2.5 rounded-lg border border-gray-300
                          focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                          outline-none transition">
        </div>

        {{-- ACTIVO --}}
        <div class="flex items-center gap-2">
            <input type="checkbox"
                   name="activo"
                   {{ $vendedor->activo ? 'checked' : '' }}
                   class="h-4 w-4 text-gray-800 border-gray-300 rounded">

            <label class="text-sm text-gray-700">
                Activo
            </label>
        </div>

        {{-- BOTONES --}}
        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

            <a href="{{ route('vendedores.index') }}"
               class="px-5 py-2.5 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                Cancelar
            </a>

            <button type="submit"
                    class="bg-gray-800 text-white px-5 py-2.5 rounded-lg hover:bg-gray-900 transition">
                Actualizar Vendedor
            </button>

        </div>

    </form>

</div>
@endsection