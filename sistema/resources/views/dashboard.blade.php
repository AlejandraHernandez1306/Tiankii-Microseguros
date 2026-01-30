<x-app-layout>
    <div class="py-12 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-l-8 border-blue-700 p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">Hola, {{ Auth::user()->name }}</h3>
                    <p class="text-slate-500">Panel del Paciente - Tiankii</p>
                </div>
                <div class="text-center sm:text-right">
                    <span class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full border border-blue-300">
                        ZONA {{ strtoupper($paciente->ubicacion_zona ?? 'RURAL') }}
                    </span>
                    <p class="text-xs text-gray-400 mt-2">ID Paciente: {{ $paciente->id ?? '---' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200 relative overflow-hidden">
                    <div class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-bl-lg">
                        {{ strtoupper($poliza->estado ?? 'ACTIVA') }}
                    </div>
                    <h4 class="text-lg font-bold text-slate-700 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Mi Póliza Actual
                    </h4>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Plan Contratado:</span>
                            <span class="font-bold text-blue-900 text-right">{{ $poliza->nombre_plan ?? 'Plan Básico' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Costo Mensual:</span>
                            <span class="font-bold text-slate-700 text-right">${{ number_format($poliza->costo ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Cobertura Disp.:</span>
                            <span class="font-bold text-green-600 text-xl">${{ number_format($poliza->cobertura ?? 0, 2) }}</span>
                        </div>
                        <div class="pt-2 text-center">
                            <button onclick="alert('SIMULACIÓN: Generando PDF del Contrato... \n\n(Esta función estará disponible en producción)')" class="text-blue-600 text-sm font-bold hover:underline cursor-pointer">
                                📄 Descargar Contrato
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                    <h4 class="text-lg font-bold text-slate-700 mb-4">Gestiones Rápidas</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="alert('MÓDULO DE CITAS (SANDBOX)\n\nConectando con agenda de médicos rurales...')" class="flex flex-col items-center justify-center p-4 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition border border-blue-200">
                            <span class="text-2xl mb-1">📅</span>
                            <span class="text-xs font-bold">Agendar</span>
                        </button>
                        <button onclick="alert('PASARELA DE PAGOS (SANDBOX)\n\nIniciando transacción segura simulada con Stripe...')" class="flex flex-col items-center justify-center p-4 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition border border-indigo-200">
                            <span class="text-2xl mb-1">💳</span>
                            <span class="text-xs font-bold">Pagos</span>
                        </button>
                    </div>
                    <button onclick="if(confirm('¿Está seguro de enviar una alerta de emergencia?')) alert('SOS ENVIADO: Ubicación compartida con la central Tiankii.');" class="w-full mt-3 bg-red-600 text-white font-bold py-3 rounded-lg shadow hover:bg-red-700 transition flex justify-center items-center gap-2">
                        🚨 BOTÓN DE PÁNICO
                    </button>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                    <h4 class="text-lg font-bold text-slate-700 mb-4">Tu Cobertura</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center text-sm text-gray-700 bg-gray-50 p-2 rounded">
                            ✅ Consulta General (Ilimitada)
                        </li>
                        <li class="flex items-center text-sm text-gray-700 bg-gray-50 p-2 rounded">
                            ✅ Exámenes Laboratorio (80%)
                        </li>
                        <li class="flex items-center text-sm text-gray-400 p-2 border border-gray-100 rounded">
                            ❌ Cirugía Estética
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="bg-slate-800 rounded-xl p-6 shadow-xl text-white text-center sm:text-left sm:flex sm:justify-between sm:items-center">
                <div>
                    <h4 class="font-bold text-xl">¿Necesitas ayuda médica?</h4>
                    <p class="text-slate-300 text-sm mt-1">Línea gratuita Tiankii disponible 24/7.</p>
                </div>
                <button onclick="alert('Llamando al *8426...')" class="mt-4 sm:mt-0 bg-white text-slate-900 font-bold py-3 px-8 rounded-full shadow hover:bg-gray-200 transition">
                    Llamar al *TIANKII
                </button>
            </div>

        </div>
    </div>
</x-app-layout>