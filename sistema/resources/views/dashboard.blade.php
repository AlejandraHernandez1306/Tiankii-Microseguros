<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-xl p-6 mb-8 text-white flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">Bienvenido, {{ Auth::user()->name }}</h1>
                    <p class="opacity-90">Tu salud está protegida con Tiankii.</p>
                </div>
                <div class="text-right hidden sm:block">
                    <p class="text-sm opacity-75">Estado de Cuenta</p>
                    <p class="text-xl font-bold text-green-300">ACTIVO</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                
                <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-blue-500">
                    <h3 class="font-bold text-gray-800 text-lg mb-4">💳 Tu Credencial Digital</h3>
                    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl p-6 text-white shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                        <div class="flex justify-between items-start mb-8">
                            <span class="font-bold tracking-widest text-lg">TIANKII</span>
                            <span class="text-xs bg-green-500 px-2 py-1 rounded font-bold">ASEGURADO</span>
                        </div>
                        <div class="mb-6">
                            <p class="text-xs opacity-75 uppercase">Titular</p>
                            <p class="font-bold text-xl tracking-wide">{{ strtoupper(Auth::user()->name) }}</p>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <p class="text-xs opacity-75">Póliza</p>
                                <p class="font-bold">{{ Auth::user()->polizas->first()->nombre_plan ?? 'Básico' }}</p>
                            </div>
                            <div>
                                <p class="text-xs opacity-75">Cobertura</p>
                                <p class="font-bold">${{ number_format(Auth::user()->polizas->first()->cobertura ?? 1000, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="font-bold text-gray-800 text-lg mb-4">Documentación</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center justify-between p-4 bg-gray-50 rounded hover:bg-gray-100 transition">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">📄</span>
                                <div>
                                    <p class="font-bold text-gray-800">Contrato de Adhesión</p>
                                    <p class="text-xs text-gray-500">Formato PDF Digital</p>
                                </div>
                            </div>
                            <a href="{{ route('contrato.ver') }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-700 shadow">
                                Descargar
                            </a>
                        </li>
                        <li class="flex items-center justify-between p-4 bg-gray-50 rounded">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🚑</span>
                                <div>
                                    <p class="font-bold text-gray-800">Red de Hospitales</p>
                                    <p class="text-xs text-gray-500">Clínicas Cercanas</p>
                                </div>
                            </div>
                            <button class="text-gray-400 font-bold cursor-not-allowed">Próximamente</button>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>