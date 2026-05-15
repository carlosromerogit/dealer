@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4">

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 bg-gray-800">
            <h1 class="text-2xl font-semibold text-white">
                Nueva Marca
            </h1>

            <p class="text-sm text-gray-300 mt-1">
                Registra una marca y sus modelos
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('marcas.store') }}"
              method="POST"
              class="p-6 space-y-6">

            @csrf

            {{-- MARCA --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre de la marca
                </label>

                <input type="text"
                       name="nombre"
                       value="{{ old('nombre') }}"
                       class="w-full px-4 py-2.5 rounded-xl border
                       @error('nombre')
                            border-red-500 ring-2 ring-red-100
                       @else
                            border-gray-300
                       @enderror
                       focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                       outline-none transition">

                @error('nombre')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- MODELOS --}}
            <div>

                <div class="flex items-center justify-between mb-3">
                    <label class="text-sm font-medium text-gray-700">
                        Modelos
                    </label>

                    <button type="button"
                            onclick="agregarModelo()"
                            class="px-3 py-1.5 rounded-lg bg-gray-800 text-white text-sm hover:bg-gray-900 transition">
                        + Agregar modelo
                    </button>
                </div>

                <div id="modelos-container" class="space-y-3">

                    <div class="flex gap-3">

                        <input type="text"
                               name="modelos[]"
                               placeholder="Ej: Corolla"
                               class="flex-1 px-4 py-2.5 rounded-xl border border-gray-300
                                      focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                      outline-none transition">

                        <button type="button"
                                onclick="eliminarModelo(this)"
                                class="px-4 py-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition">
                            X
                        </button>

                    </div>

                </div>

            </div>

            {{-- BOTONES --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

                <a href="{{ route('marcas.index') }}"
                   class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-gray-800 text-white font-medium
                               hover:bg-gray-900 active:scale-95 transition">
                    Guardar marca
                </button>

            </div>

        </form>

    </div>

</div>

<script>
function agregarModelo() {

    let container = document.getElementById('modelos-container');

    container.insertAdjacentHTML('beforeend', `
        <div class="flex gap-3">
            <input type="text"
                   name="modelos[]"
                   placeholder="Ej: Corolla"
                   class="flex-1 px-4 py-2.5 rounded-xl border border-gray-300
                          focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                          outline-none transition">

            <button type="button"
                    onclick="eliminarModelo(this)"
                    class="px-4 py-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition">
                X
            </button>
        </div>
    `);
}

function eliminarModelo(button) {
    button.parentElement.remove();
}
</script>
@endsection