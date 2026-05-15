<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-xl shadow w-96">

    <h1 class="text-xl font-bold mb-4">Registro</h1>

    <form method="POST" action="/register">
        @csrf

        <input type="text"
               name="name"
               placeholder="Nombre"
               class="w-full border p-2 mb-3 rounded">

        <input type="email"
               name="email"
               placeholder="Email"
               class="w-full border p-2 mb-3 rounded">

        <input type="password"
               name="password"
               placeholder="Password"
               class="w-full border p-2 mb-3 rounded">

        <button class="w-full bg-gray-800 text-white py-2 rounded">
            Crear cuenta
        </button>
    </form>

</div>

</body>
</html>