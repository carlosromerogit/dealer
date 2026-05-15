@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 px-4">

    {{-- CARD --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 bg-gray-800 border-b border-gray-200">
            <h1 class="text-xl font-semibold text-gray-100">
                Editar Financiamiento
            </h1>
            <p class="text-sm text-gray-300">
                Modifica los datos del financiamiento
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('financiamientos.update', $financiamiento) }}"
              method="POST"
              class="p-6 space-y-5">

            @csrf
            @method('PUT')

            {{-- BANCO --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Entidad bancaria</label>

                <input type="text"
                       name="entidad_bancaria"
                       value="{{ $financiamiento->entidad_bancaria }}"
                       class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                              bg-white text-gray-900
                              focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                              outline-none transition">
            </div>

            {{-- GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="text-sm font-medium text-gray-700">Enganche</label>
                    <input type="number"
                           name="enganche"
                           value="{{ $financiamiento->enganche }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Monto financiado</label>
                    <input type="number"
                           name="monto_financiado"
                           value="{{ $financiamiento->monto_financiado }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Cuotas</label>
                    <input type="number"
                           name="num_cuotas"
                           value="{{ $financiamiento->num_cuotas }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Tasa de interés (%)</label>
                    <input type="number"
                           step="0.01"
                           name="tasa_interes"
                           value="{{ $financiamiento->tasa_interes }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">
                </div>

            </div>

            {{-- BOTONES --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

                <a href="{{ route('financiamientos.index') }}"
                   class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-gray-800 text-white font-medium
                               hover:bg-gray-900 active:scale-95 transition">
                    Actualizar
                </button>

            </div>

        </form>

    </div>

</div>
@endsection