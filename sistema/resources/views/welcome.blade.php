<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tiankii - Microseguros</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased bg-slate-50 font-[Figtree]">
        
        <nav class="bg-white shadow-sm fixed w-full z-10 top-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-2xl font-black text-blue-900 tracking-tighter">TIANKII</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-900">Ir al Panel</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-700">Iniciar Sesión</a>
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-700 text-white rounded-full text-sm font-bold hover:bg-blue-800 transition">Afiliarse</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <div class="relative pt-24 pb-16 sm:pt-32 sm:pb-24 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl sm:text-6xl font-extrabold text-slate-900 tracking-tight">
                    Salud accesible para <br>
                    <span class="text-blue-700">nuestras comunidades.</span>
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto">
                    El primer ecosistema de microseguros médicos diseñado para zonas rurales. Sin trámites complejos, sin barreras bancarias.
                </p>
                <div class="mt-8 flex justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-blue-700 text-white rounded-xl text-lg font-bold shadow-lg hover:bg-blue-600 transition transform hover:-translate-y-1">
                        Comenzar Ahora
                    </a>
                    <a href="#funciona" class="px-8 py-3 bg-white text-blue-700 border border-blue-200 rounded-xl text-lg font-bold shadow-sm hover:bg-gray-50 transition">
                        Saber más
                    </a>
                </div>
            </div>
        </div>

        <div id="funciona" class="bg-white py-16 border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-700 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Cobertura Rural</h3>
                        <p class="mt-2 text-gray-600">Planes diseñados específicamente para zonas de bajo acceso (Rural/Urbana) con tarifas ajustadas.</p>
                    </div>
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-700 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Pagos Digitales</h3>
                        <p class="mt-2 text-gray-600">Gestiona tus cuotas de forma transparente y segura sin necesidad de efectivo.</p>
                    </div>
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-700 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Red Médica</h3>
                        <p class="mt-2 text-gray-600">Acceso a consultas, exámenes y medicamentos con validación en tiempo real.</p>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-white border-t border-slate-200 py-8 text-center">
            <p class="text-gray-400 text-sm">&copy; 2025 Tiankii Project. Todos los derechos reservados.</p>
            <p class="text-gray-300 text-xs mt-1">Bootcamp Código Semilla - Equipo 5</p>
        </footer>
    </body>
</html>