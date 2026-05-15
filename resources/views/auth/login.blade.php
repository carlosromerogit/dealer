<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

    {{-- CONTENEDOR PRINCIPAL --}}

        {{-- CARD --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            {{-- HEADER --}}
            <div class="bg-gray-800 px-6 py-5 text-white">
                <h1 class="text-xl font-semibold">Iniciar sesión</h1>
                <p class="text-sm text-gray-300">
                    Accede al sistema de concesionario
                </p>
            </div>

            {{-- FORM --}}
            <form method="POST" action="/login" class="p-6 space-y-5">
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="correo@ejemplo.com"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password"
                           name="password"
                           placeholder="••••••••"
                           class="mt-1 w-full px-4 py-2.5 rounded-xl border border-gray-300
                                  bg-white text-gray-900
                                  focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                                  outline-none transition">
                </div>

                {{-- ERROR --}}
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded-lg text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- BUTTON --}}
                <button type="submit"
                        class="w-full bg-gray-800 text-white py-2.5 rounded-xl font-medium
                               hover:bg-gray-900 active:scale-[0.99] transition">
                    Entrar
                </button>

                {{-- LINK --}}
                {{-- <p class="text-sm text-center text-gray-600">
                    ¿No tienes cuenta?
                    <a href="/register" class="text-gray-900 font-medium hover:underline">
                        Crear cuenta
                    </a>
                </p> --}}

            </form>

        </div>

    </div>

</body>
</html>