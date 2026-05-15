<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gray-900 text-white flex flex-col">

        <div class="p-5 text-xl font-bold border-b border-gray-700">
            Dealer
        </div>

        <nav class="flex-1 p-4 space-y-2 text-sm">

            <a href="{{ url('/dashboard') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700">
                Dashboard
            </a>

            <a href="{{ route('vehiculos.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700">
                Vehículos
            </a>
  
            <a href="{{ route('marcas.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700">
               Marcas y modelos
            </a>

            <a href="{{ route('clientes.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700">
                Clientes
            </a>

            <a href="{{ route('vendedores.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700">
                Vendedores
            </a>

            <a href="{{ route('ventas.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700">
               Ventas
            </a>
        
            <a href="{{ route('financiamientos.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700">
               Financiamientos
            </a>

            <a href="{{ route('usuarios.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700">
               Adm. Usuarios
            </a>

        </nav>

        <div class="p-4 border-t border-gray-700 text-xs text-gray-400">
            © {{ date('Y') }} Dealer 
        </div>

    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        <header class="bg-white shadow px-6 py-4 flex justify-between">

            <h1 class="text-lg font-semibold text-gray-700">
                @yield('title', 'Panel')
            </h1>

            <span class="text-sm text-gray-500">
                Sistema de concesionaria
            </span>
            <span class="text-sm text-gray-500">
      <form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit"
        class="w-full flex items-center gap-2 px-4 py-2 rounded-lg
               text-red-600 hover:bg-red-50 transition">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1
                     a2 2 0 01-2 2H5a2 2 0 01-2-2V7
                     a2 2 0 012-2h6a2 2 0 012 2v1" />
        </svg>

        Cerrar sesión
    </button>
</form>
            </span>

        </header>

        {{-- CONTENT --}}
        <main class="p-6 overflow-y-auto">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>