@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 px-4">

    {{-- CARD --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 bg-gray-800 border-b border-gray-200">
            <h1 class="text-xl font-semibold text-gray-100">
                Editar Vehículo
            </h1>
            <p class="text-sm text-gray-300">
                Modifica la información del vehículo
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- PLACA --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Placa</label>

                <input type="text"
                       name="placa"
                       value="{{ $vehiculo->placa }}"
                       class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                              bg-white text-gray-900
                              focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                              outline-none transition">
            </div>

            {{-- MODELO --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Modelo</label>

                <select name="modelo_id"
                        class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                               bg-white text-gray-900
                               focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                               outline-none transition">

                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo->id }}"
                            @selected($vehiculo->modelo_id == $modelo->id)>
                            {{ $modelo->marca->nombre }} - {{ $modelo->nombre }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- COLOR --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Color</label>

                <select name="color_id"
                        class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                               bg-white text-gray-900
                               focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                               outline-none transition">

                    @foreach($colores as $color)
                        <option value="{{ $color->id }}"
                            @selected($vehiculo->color_id == $color->id)>
                            {{ $color->nombre }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- AÑO --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Año</label>

                    <input type="number"
                           name="anio"
                           value="{{ $vehiculo->anio }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">
                </div>

                {{-- PRECIO --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Precio Lista</label>

                    <input type="number"
                           step="0.01"
                           name="precio_lista"
                           value="{{ $vehiculo->precio_lista }}"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">
                </div>

            </div>

            {{-- ESTADO --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Estado</label>

                <select name="estado"
                        class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                               bg-white text-gray-900
                               focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                               outline-none transition">

                    <option value="disponible" @selected($vehiculo->estado == 'disponible')>
                        Disponible
                    </option>

                    <option value="reservado" @selected($vehiculo->estado == 'reservado')>
                        Reservado
                    </option>

                    <option value="vendido" @selected($vehiculo->estado == 'vendido')>
                        Vendido
                    </option>

                </select>
            </div>

            {{-- BOTONES --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

                <a href="{{ route('vehiculos.index') }}"
                   class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-gray-800 text-white font-medium
                               hover:bg-gray-900 active:scale-95 transition">
                    Actualizar vehículo
                </button>

            </div>

        </form>

    </div>

</div>
@endsection