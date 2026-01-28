<x-app-layout>
    <style>
        .loader { border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 30px; height: 30px; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        [x-cloak] { display: none !important; }
    </style>

    <div class="py-12 bg-slate-100 min-h-screen" x-data="dashboardLogic()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-l-8 border-blue-700 p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <h3 class="text-3xl font-extrabold text-slate-800">Hola, <span class="text-blue-700">{{ Auth::user()->name }}</span></h3>
                    <p class="text-slate-500">Panel del Asegurado | <span id="current-date"></span></p>
                </div>
                <div class="text-center sm:text-right">
                    <span class="bg-blue-100 text-blue-800 text-sm font-bold px-4 py-1 rounded-full border border-blue-300">
                        ZONA {{ strtoupper($paciente->ubicacion_zona ?? 'RURAL') }}
                    </span>
                    <p class="text-xs text-gray-400 mt-2">ID: {{ $paciente->id ?? '---' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200 relative overflow-hidden">
                    <div class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">
                        {{ strtoupper($poliza->estado ?? 'ACTIVA') }}
                    </div>
                    <h4 class="text-lg font-bold text-slate-700 mb-4">Mi Póliza Digital</h4>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Plan:</span>
                            <span class="font-bold text-blue-900 text-right">{{ $poliza->nombre_plan ?? 'Plan Básico' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Cobertura:</span>
                            <span class="font-bold text-green-600 text-xl">${{ number_format($poliza->cobertura ?? 0, 2) }}</span>
                        </div>
                        <button onclick="window.print()" class="w-full mt-2 bg-blue-50 text-blue-700 border border-blue-200 py-2 rounded-lg font-bold hover:bg-blue-100 transition flex justify-center items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Imprimir Contrato
                        </button>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                    <h4 class="text-lg font-bold text-slate-700 mb-4">Gestiones</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <button @click="openModal('cita')" class="flex flex-col items-center justify-center p-4 bg-gray-50 border-2 border-gray-100 rounded-xl hover:border-blue-500 hover:bg-white transition">
                            <span class="text-2xl mb-1">📅</span>
                            <span class="text-xs font-bold text-gray-600">Agendar</span>
                        </button>
                        <button @click="openModal('pago')" class="flex flex-col items-center justify-center p-4 bg-gray-50 border-2 border-gray-100 rounded-xl hover:border-indigo-500 hover:bg-white transition">
                            <span class="text-2xl mb-1">💳</span>
                            <span class="text-xs font-bold text-gray-600">Pagos</span>
                        </button>
                    </div>
                    <button @click="activarPanico()" class="w-full mt-4 bg-red-600 text-white font-bold py-3 rounded-lg shadow hover:bg-red-700 flex justify-center items-center gap-2">
                        <span x-show="!panicoActivo">🚨 BOTÓN DE PÁNICO</span>
                        <span x-show="panicoActivo" class="flex items-center gap-2"><span class="loader w-4 h-4 border-white"></span> Enviando...</span>
                    </button>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                    <h4 class="text-lg font-bold text-slate-700 mb-4">Cobertura</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center text-gray-700">✅ Consulta General</li>
                        <li class="flex items-center text-gray-700">✅ Laboratorio (80%)</li>
                        <li class="flex items-center text-gray-400">❌ Cirugía Estética</li>
                    </ul>
                </div>
            </div>
        </div>

        <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeModal()"></div>
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg w-full p-6 relative z-10">
                    
                    <div x-show="activeModal === 'cita'">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Agendar Cita Médica</h3>
                        <input type="date" class="w-full border-gray-300 rounded mb-4">
                        <select class="w-full border-gray-300 rounded mb-4"><option>General</option><option>Pediatría</option></select>
                        <button @click="procesar('Cita Agendada')" class="w-full bg-blue-600 text-white py-2 rounded">Confirmar</button>
                    </div>

                    <div x-show="activeModal === 'pago'">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Realizar Pago (Sandbox)</h3>
                        <p class="mb-4">Monto: <strong>${{ $poliza->costo ?? '0.00' }}</strong></p>
                        <input type="text" placeholder="Tarjeta (Simulada)" class="w-full border-gray-300 rounded mb-4">
                        <button @click="procesar('Pago Exitoso')" class="w-full bg-indigo-600 text-white py-2 rounded">Pagar Ahora</button>
                    </div>

                    <div x-show="activeModal === 'success'" class="text-center">
                        <div class="text-5xl mb-2">✅</div>
                        <h3 class="text-lg font-medium text-gray-900" x-text="successMessage"></h3>
                        <button @click="closeModal()" class="mt-4 bg-gray-200 text-gray-800 px-4 py-2 rounded">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const now = new Date();
            document.getElementById('current-date').textContent = now.toLocaleDateString();
        });

        function dashboardLogic() {
            return {
                modalOpen: false,
                activeModal: '',
                panicoActivo: false,
                successMessage: '',
                openModal(type) { this.activeModal = type; this.modalOpen = true; },
                closeModal() { this.modalOpen = false; this.activeModal = ''; },
                procesar(msg) {
                    this.activeModal = '';
                    setTimeout(() => {
                        this.successMessage = msg;
                        this.activeModal = 'success';
                    }, 500);
                },
                activarPanico() {
                    if(confirm('¿Enviar alerta de emergencia?')) {
                        this.panicoActivo = true;
                        setTimeout(() => {
                            alert('UBICACIÓN ENVIADA A CENTRAL DE EMERGENCIAS');
                            this.panicoActivo = false;
                        }, 2000);
                    }
                }
            }
        }
    </script>
</x-app-layout>