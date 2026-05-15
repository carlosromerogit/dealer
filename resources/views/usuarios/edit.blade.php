@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-10 px-4">

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 bg-gray-800">

            <h1 class="text-xl font-semibold text-white">
                Editar Usuario
            </h1>

            <p class="text-sm text-gray-300">
                Modificar información del usuario
            </p>

        </div>

        {{-- FORM --}}
        <form action="{{ route('usuarios.update', $usuario) }}"
              method="POST"
              class="p-6 space-y-6">

            @csrf
            @method('PUT')

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
                <label class="text-sm font-medium text-gray-700">Nombre</label>

                <input type="text"
                       name="nombre"
                       value="{{ old('nombre', $usuario->nombre) }}"
                       class="mt-1 w-full rounded-xl border px-4 py-2.5
                              @error('nombre') border-red-500 ring-2 ring-red-100 @else border-gray-300 @enderror">

                @error('nombre')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Email</label>

                <input type="email"
                       name="email"
                       value="{{ old('email', $usuario->email) }}"
                       class="mt-1 w-full rounded-xl border px-4 py-2.5
                              @error('email') border-red-500 ring-2 ring-red-100 @else border-gray-300 @enderror">

                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="text-sm font-medium text-gray-700">
                    Nueva contraseña (opcional)
                </label>

                <input type="password"
                       name="password"
                       class="mt-1 w-full rounded-xl border px-4 py-2.5
                              @error('password') border-red-500 ring-2 ring-red-100 @else border-gray-300 @enderror">

                <p class="text-xs text-gray-500 mt-1">
                    Déjalo vacío si no quieres cambiarla
                </p>

                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ROL --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Rol</label>

                <select name="rol"
                        class="mt-1 w-full rounded-xl border px-4 py-2.5
                               @error('rol') border-red-500 ring-2 ring-red-100 @else border-gray-300 @enderror">

                    @foreach($roles as $role)
                        <option value="{{ $role->name }}"
                            @selected(old('rol', $usuario->roles->first()?->name) == $role->name)>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach

                </select>

                @error('rol')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ACTIVO --}}
            <div class="flex items-center gap-2">

                <input type="checkbox"
                       name="activo"
                       {{ old('activo', $usuario->activo) ? 'checked' : '' }}>

                <label class="text-sm text-gray-700">
                    Usuario activo
                </label>

            </div>

            {{-- BOTONES --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

                <a href="{{ route('usuarios.index') }}"
                   class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-gray-800 text-white hover:bg-gray-900 transition">
                    Actualizar usuario
                </button>

            </div>

        </form>

    </div>

</div>

@endsection