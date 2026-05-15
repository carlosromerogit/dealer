@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 px-4">

    {{-- CARD --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 bg-gray-800 border-b border-gray-200">
            <h1 class="text-xl font-semibold text-gray-100">
                Editar Cliente
            </h1>
            <p class="text-sm text-gray-300">
                Modifica la información del cliente
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('clientes.update', $cliente) }}"
              method="POST"
              class="p-6 space-y-6">

            @csrf
            @method('PUT')

            {{-- NOMBRE --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Nombre</label>

                <input type="text"
                       name="nombre"
                       value="{{ $cliente->nombre }}"
                       class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                              bg-white text-gray-900
                              focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                              outline-none transition">
            </div>

            {{-- CÉDULA --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Cédula</label>

                <input type="text"
                       name="cedula"
                       value="{{ $cliente->cedula }}"
                       class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                              bg-white text-gray-900
                              focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                              outline-none transition">
            </div>

            {{-- GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- TELÉFONO --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Teléfono</label>

                    <input type="text"
                           name="telefono"
                           value="{{ $cliente->telefono }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>

                    <input type="text"
                           name="email"
                           value="{{ $cliente->email }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">
                </div>
                        @error('email')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror

            </div>

            {{-- DIRECCIÓN --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Dirección</label>

                <input type="text"
                       name="direccion"
                       value="{{ $cliente->direccion }}"
                       class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                              bg-white text-gray-900
                              focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                              outline-none transition">
            </div>

            {{-- BOTONES --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

                <a href="{{ route('clientes.index') }}"
                   class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-gray-800 text-white font-medium
                               hover:bg-gray-900 active:scale-95 transition">
                    Actualizar cliente
                </button>

            </div>

        </form>

    </div>

</div>
@endsection