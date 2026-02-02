<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiankii - Microseguros</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        
        <div class="fixed top-0 right-0 px-6 py-4 sm:block z-50">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline font-bold">Ir al Panel Principal</a>
                <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 underline cursor-pointer">Cerrar Sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline font-bold">Iniciar Sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline font-bold">Registrarse</a>
                @endif
            @endauth
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <h1 class="text-6xl font-black text-blue-900 tracking-tighter">TIANKII</h1>
            </div>
            <p class="mt-4 text-xl text-gray-600">Microseguros de Salud y Pagos Digitales para Zonas Rurales</p>
            
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-white rounded-lg shadow-lg border-l-4 border-blue-600">
                    <h3 class="font-bold text-lg">Soy Paciente</h3>
                    <p class="text-sm text-gray-500 mb-4">Consulta tu saldo, historial y cobertura.</p>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block w-full bg-blue-600 text-white py-2 rounded font-bold">Ir a mi Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-blue-600 text-white py-2 rounded font-bold hover:bg-blue-700">Entrar</a>
                        <a href="{{ route('register') }}" class="block w-full mt-2 text-blue-600 text-sm underline">Crear cuenta nueva</a>
                    @endauth
                </div>

                <div class="p-6 bg-white rounded-lg shadow-lg border-l-4 border-teal-600">
                    <h3 class="font-bold text-lg">Soy Médico / Admin</h3>
                    <p class="text-sm text-gray-500 mb-4">Gestión de consultas y administración.</p>
                    <a href="{{ route('login') }}" class="block w-full bg-teal-600 text-white py-2 rounded font-bold hover:bg-teal-700">Acceso Profesional</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>