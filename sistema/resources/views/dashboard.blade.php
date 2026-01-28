<x-app-layout>
    <div class="py-12 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-l-8 border-blue-700">
                <div class="p-6 text-gray-900 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800">Hola, {{ Auth::user()->name }}</h3>
                        <p class="text-slate-500">Panel del Paciente - Tiankii</p>
                    </div>
                    <div class="text-center sm:text-right">
                        <span class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full border border-blue-300">
                            ZONA {{ strtoupper($paciente->ubicacion_zona ?? 'RURAL') }}
                        </span>
                        <p class="text-xs text-gray-400 mt-2">ID: {{ $paciente->id ?? '---' }}</p>
                    </div>
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
                            <span class="font-bold text-blue-900 text-right">{{ $poliza->nombre_plan }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Cobertura Disp.:</span>
                            <span class="font-bold text-green-600 text-xl">${{ number_format($poliza->cobertura, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-xs text-gray-400">Renovación: 15/12/2025</span>
                            <button onclick="alert('SIMULACIÓN: Generando PDF del Contrato...')" class="text-blue-600 text-sm font-semibold hover:underline">
                                Ver Contrato
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                    <h4 class="text-lg font-bold text-slate-700 mb-4">Gestiones Rápidas</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="alert('Módulo de Citas: Conectando con agenda...')" class="flex flex-col items-center justify-center p-4 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition border border-blue-200">
                            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-xs font-bold">Agendar Cita</span>
                        </button>
                        <button onclick="alert('Stripe Sandbox: Sin pagos pendientes.')" class="flex flex-col items-center justify-center p-4 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition border border-indigo-200">
                            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            <span class="text-xs font-bold">Mis Pagos</span>
                        </button>
                    </div>
                    <button onclick="alert('SOS ACTIVADO: Enviando ubicación...')" class="w-full mt-3 bg-red-50 text-red-600 font-bold py-2 rounded-lg border border-red-200 hover:bg-red-100 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        BOTÓN DE PÁNICO
                    </button>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                    <h4 class="text-lg font-bold text-slate-700 mb-4">Cobertura Incluida</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center text-sm text-gray-700">
                            ✅ Consulta General (Ilimitada)
                        </li>
                        <li class="flex items-center text-sm text-gray-700">
                            ✅ Exámenes Laboratorio (80%)
                        </li>
                        <li class="flex items-center text-sm text-gray-400 border-t pt-2">
                            ❌ Cirugía Estética (No cubierto)
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="bg-slate-800 rounded-xl p-8 shadow-xl text-white text-center sm:text-left sm:flex sm:justify-between sm:items-center">
                <div>
                    <h4 class="font-bold text-xl text-white">¿Necesitas ayuda médica ahora?</h4>
                    <p class="text-slate-300 text-sm mt-1">Call center rural disponible 24/7.</p>
                </div>
                <button onclick="alert('Llamando...')" class="mt-4 sm:mt-0 bg-white text-slate-900 font-bold py-3 px-8 rounded-full shadow hover:bg-gray-200 transition">
                    Llamar al *TIANKII
                </button>
            </div>

        </div>
    </div>
</x-app-layout>