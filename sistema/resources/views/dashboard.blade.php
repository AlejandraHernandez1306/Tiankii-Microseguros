<x-app-layout>
    <style>
        .spinner { border: 3px solid rgba(0,0,0,0.1); border-radius: 50%; border-top: 3px solid #3498db; width: 20px; height: 20px; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        [x-cloak] { display: none !important; }
    </style>

    <div class="py-12 bg-slate-100 min-h-screen" x-data="appData()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-l-8 border-blue-700 p-6 flex flex-col sm:flex-row justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">Hola, {{ Auth::user()->name }}</h3>
                    <p class="text-slate-500">Bienvenido a Tiankii</p>
                </div>
                <div class="mt-4 sm:mt-0 text-center sm:text-right">
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase">
                        Zona {{ $paciente->ubicacion_zona ?? 'General' }}
                    </span>
                    <p class="text-xs text-gray-400 mt-1">ID: {{ $paciente->id ?? '#' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="text-lg font-bold text-slate-700">Mi Póliza</h4>
                        <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">ACTIVA</span>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600 text-sm">Plan:</span>
                            <span class="font-bold text-blue-900 text-sm text-right">{{ $poliza->nombre_plan ?? 'Básico' }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600 text-sm">Costo:</span>
                            <span class="font-bold text-slate-700">${{ number_format($poliza->costo ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between pt-1">
                            <span class="text-gray-600 text-sm">Cobertura:</span>
                            <span class="font-bold text-green-600 text-lg">${{ number_format($poliza->cobertura ?? 0, 2) }}</span>
                        </div>
                        <button onclick="window.print()" class="w-full mt-3 text-blue-600 text-sm font-semibold hover:underline flex justify-center items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            Descargar Contrato
                        </button>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                    <h4 class="text-lg font-bold text-slate-700 mb-4">Servicios</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <button @click="abrirModal('cita')" class="flex flex-col items-center justify-center p-3 bg-gray-50 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                            <span class="text-2xl">📅</span>
                            <span class="text-xs font-bold text-gray-600 mt-1">Citas</span>
                        </button>
                        <button @click="abrirModal('pago')" class="flex flex-col items-center justify-center p-3 bg-gray-50 border border-gray-200 rounded-lg hover:bg-indigo-50 hover:border-indigo-300 transition">
                            <span class="text-2xl">💳</span>
                            <span class="text-xs font-bold text-gray-600 mt-1">Pagos</span>
                        </button>
                    </div>
                    <button @click="activarPanico()" class="w-full mt-4 bg-red-600 text-white py-2 rounded-lg font-bold shadow hover:bg-red-700 transition flex justify-center items-center gap-2">
                        <span x-show="!loadingPanico">🚨 SOS</span>
                        <span x-show="loadingPanico" class="spinner border-white border-t-red-600"></span>
                        <span x-show="loadingPanico" class="text-sm">Enviando...</span>
                    </button>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                    <h4 class="text-lg font-bold text-slate-700 mb-4">Detalle Cobertura</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span> Consultas Ilimitadas</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span> Exámenes (80%)</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span> Medicina General</li>
                        <li class="flex items-center text-gray-400"><span class="text-red-400 mr-2">✘</span> Cirugía Estética</li>
                    </ul>
                </div>
            </div>
        </div>

        <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="modalOpen = false">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    
                    <div x-show="tipoModal === 'cita'" class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Agendar Cita Médica</h3>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Especialidad</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><option>General</option><option>Pediatría</option></select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Fecha</label>
                            <input type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <button @click="procesar('Cita Agendada')" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Confirmar Cita</button>
                    </div>

                    <div x-show="tipoModal === 'pago'" class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Pasarela de Pago (Sandbox)</h3>
                        <p class="text-sm text-gray-500 mb-4">Simulación de pago seguro.</p>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Tarjeta</label>
                            <input type="text" placeholder="**** **** **** 4242" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <button @click="procesar('Pago Exitoso')" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">Pagar ${{ $poliza->costo ?? '0.00' }}</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function appData() {
            return {
                modalOpen: false,
                tipoModal: '',
                loadingPanico: false,
                abrirModal(tipo) {
                    this.tipoModal = tipo;
                    this.modalOpen = true;
                },
                procesar(msg) {
                    this.modalOpen = false;
                    alert('✅ ' + msg + '\n\n(Operación registrada en el sistema)');
                },
                activarPanico() {
                    if(confirm('¿Enviar ubicación de emergencia?')) {
                        this.loadingPanico = true;
                        // Simular retraso de red
                        setTimeout(() => {
                            this.loadingPanico = false;
                            alert('🚨 UBICACIÓN ENVIADA\nLat: 13.69, Lon: -89.22\nServicios de emergencia notificados.');
                        }, 1500);
                    }
                }
            }
        }
    </script>
</x-app-layout>