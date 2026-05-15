@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4">

    {{-- HEADER --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-6 py-5 bg-gray-800">
            <div class="flex items-center justify-between">

                <div>
                    <h1 class="text-2xl font-semibold text-white">
                        {{ $marca->nombre }}
                    </h1>

                    <p class="text-sm text-gray-300 mt-1">
                        Gestión de modelos de la marca
                    </p>
                </div>

                <a href="{{ route('marcas.index') }}"
                   class="px-4 py-2 rounded-xl bg-white/10 text-white hover:bg-white/20 transition">
                    Volver
                </a>

            </div>
        </div>

        {{-- INFO --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6 border-b border-gray-200 bg-gray-50">

            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <p class="text-sm text-gray-500">Marca</p>
                <h2 class="text-lg font-semibold text-gray-800 mt-1">
                    {{ $marca->nombre }}
                </h2>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <p class="text-sm text-gray-500">Total Modelos</p>
                <h2 class="text-lg font-semibold text-gray-800 mt-1">
                    {{ $marca->modelos->count() }}
                </h2>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <p class="text-sm text-gray-500">Creada</p>
                <h2 class="text-lg font-semibold text-gray-800 mt-1">
                    {{ $marca->created_at->format('d/m/Y') }}
                </h2>
            </div>

        </div>

        {{-- CONTENIDO --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">

            {{-- FORM NUEVO MODELO --}}
            <div class="lg:col-span-1">

                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">

                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        Nuevo Modelo
                    </h2>

                    <form action="{{ route('modelos.store', $marca) }}"
                          method="POST"
                          class="space-y-4">

                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nombre del modelo
                            </label>

                            <input type="text"
                                   name="nombre"
                                   value="{{ old('nombre') }}"
                                   placeholder="Ej: Corolla"
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

                        <button type="submit"
                                class="w-full px-4 py-2.5 rounded-xl bg-gray-800 text-white
                                       hover:bg-gray-900 transition">
                            Guardar Modelo
                        </button>

                    </form>

                </div>

            </div>

            {{-- TABLA MODELOS --}}
            <div class="lg:col-span-2">

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Modelos registrados
                        </h2>
                    </div>

                    @if(session('success'))
                        <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-100 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                                        Modelo
                                    </th>

                                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">
                                        Vehículos
                                    </th>

                                    <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @forelse($marca->modelos as $modelo)

                                    <tr class="hover:bg-gray-50 transition">

                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-800">
                                                {{ $modelo->nombre }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm">
                                                {{ $modelo->vehiculos()->count() }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-2">

                                                {{-- EDITAR --}}
                                                <button type="button"
                                                        onclick="toggleEdit({{ $modelo->id }})"
                                                        class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition text-sm">
                                                    Editar
                                                </button>

                                                {{-- ELIMINAR --}}
                                                <form action="{{ route('modelos.destroy', $modelo) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('¿Eliminar modelo?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="px-3 py-1.5 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 transition text-sm">
                                                        Eliminar
                                                    </button>

                                                </form>

                                            </div>
                                        </td>

                                    </tr>

                                    {{-- EDIT INLINE --}}
                                    <tr id="edit-{{ $modelo->id }}" class="hidden bg-gray-50">

                                        <td colspan="3" class="px-6 py-4">

                                            <form action="{{ route('modelos.update', $modelo) }}"
                                                  method="POST"
                                                  class="flex gap-3">

                                                @csrf
                                                @method('PUT')

                                                <input type="text"
                                                       name="nombre"
                                                       value="{{ $modelo->nombre }}"
                                                       class="flex-1 px-4 py-2 rounded-xl border border-gray-300
                                                              focus:ring-2 focus:ring-gray-200 outline-none">

                                                <button type="submit"
                                                        class="px-4 py-2 rounded-xl bg-gray-800 text-white hover:bg-gray-900">
                                                    Guardar
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                                            No hay modelos registrados
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<script>
function toggleEdit(id) {
    document.getElementById('edit-' + id).classList.toggle('hidden');
}
</script>
@endsection