@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-10 px-4">

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 bg-gray-800">

            <h1 class="text-xl font-semibold text-white">
                Crear Usuario
            </h1>

            <p class="text-sm text-gray-300">
                Registrar nuevo usuario del sistema
            </p>

        </div>

        {{-- FORM --}}
        <form action="{{ route('usuarios.store') }}"
              method="POST"
              class="p-6 space-y-6">

            @csrf

            {{-- ERRORES GENERALES --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    <ul class="text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- NOMBRE --}}
            <div>
                <label class="text-sm font-medium text-gray-700">
                    Nombre
                </label>

                <input type="text"
                       name="nombre"
                       value="{{ old('nombre') }}"
                       class="mt-1 w-full rounded-xl border px-4 py-2.5
                              @error('nombre') border-red-500 ring-2 ring-red-200 @else border-gray-300 @enderror
                              focus:border-gray-500 focus:ring-2 focus:ring-gray-200">

                @error('nombre')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="text-sm font-medium text-gray-700">
                    Email
                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="mt-1 w-full rounded-xl border px-4 py-2.5
                              @error('email') border-red-500 ring-2 ring-red-200 @else border-gray-300 @enderror
                              focus:border-gray-500 focus:ring-2 focus:ring-gray-200">

                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="text-sm font-medium text-gray-700">
                    Contraseña
                </label>

                <input type="password"
                       name="password"
                       class="mt-1 w-full rounded-xl border px-4 py-2.5
                              @error('password') border-red-500 ring-2 ring-red-200 @else border-gray-300 @enderror
                              focus:border-gray-500 focus:ring-2 focus:ring-gray-200">

                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ROL --}}
            <div>
                <label class="text-sm font-medium text-gray-700">
                    Rol
                </label>

                <select name="rol"
                        class="mt-1 w-full rounded-xl border px-4 py-2.5
                               @error('rol') border-red-500 ring-2 ring-red-200 @else border-gray-300 @enderror">

                    @foreach($roles as $role)
                        <option value="{{ $role->name }}"
                            @selected(old('rol') == $role->name)>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach

                </select>

                @error('rol')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ACTIVO --}}
            <div class="flex items-center gap-2">
                <input type="checkbox"
                       name="activo"
                       {{ old('activo', true) ? 'checked' : '' }}
                       class="h-4 w-4 text-gray-800 border-gray-300 rounded">

                <label class="text-sm text-gray-700">
                    Usuario activo
                </label>
            </div>

            {{-- BOTÓN --}}
            <div class="flex justify-end pt-4 border-t border-gray-200">

                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-gray-800 text-white hover:bg-gray-900 transition">

                    Guardar usuario

                </button>

            </div>

        </form>

    </div>

</div>

@endsection