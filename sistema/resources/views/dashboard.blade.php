<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-lg shadow-xl p-6 mb-8 text-white flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">Hola, {{ Auth::user()->name }}</h1>
                    <p class="opacity-90">Tu salud está en buenas manos.</p>
                </div>
                <div class="text-right hidden sm:block">
                    <p class="text-sm opacity-75">Estado de Póliza</p>
                    <p class="text-xl font-bold text-green-400">● ACTIVA</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                
                <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-blue-600">
                    <h3 class="font-bold text-gray-800 text-lg mb-4">💳 Credencial Digital</h3>
                    
                    <div class="bg-gray-800 rounded-xl p-6 text-white shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                        
                        <div class="flex justify-between items-start mb-6">
                            <span class="font-bold tracking-widest text-lg">TIANKII</span>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TIANKII-{{ Auth::user()->id }}" alt="QR" class="w-16 h-16 bg-white p-1 rounded">
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-xs opacity-75 uppercase">Asegurado</p>
                            <p class="font-bold text-xl tracking-wide">{{ strtoupper(Auth::user()->name) }}</p>
                        </div>
                        
                        <div class="flex justify-between text-sm">
                            <div>
                                <p class="opacity-75 text-xs">Plan</p>
                                <p class="font-bold">{{ Auth::user()->polizas->first()->nombre_plan ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="opacity-75 text-xs">Cobertura</p>
                                <p class="font-bold">${{ number_format(Auth::user()->polizas->first()->cobertura ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="font-bold text-gray-800 text-lg mb-4">Gestiones</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center justify-between p-4 bg-gray-50 rounded hover:bg-gray-100 transition border hover:border-blue-300 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">📄</span>
                                <div>
                                    <p class="font-bold text-gray-800">Contrato de Adhesión</p>
                                    <p class="text-xs text-gray-500">Descargar PDF firmado</p>
                                </div>
                            </div>
                            <a href="{{ route('contrato.ver') }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-700 text-sm">
                                DESCARGAR
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>