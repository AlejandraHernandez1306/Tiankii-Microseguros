<x-app-layout>
    <style>
        .btn-primary { background-color: #2563EB; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: bold; width: 100%; display: block; text-align: center; }
        .btn-primary:hover { background-color: #1D4ED8; }
        .btn-secondary { background-color: #4F46E5; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: bold; width: 100%; display: block; text-align: center; }
        .btn-danger { background-color: #DC2626; color: white; padding: 0.75rem; border-radius: 0.5rem; font-weight: bold; width: 100%; margin-top: 1rem; }
    </style>

    <div class="py-12 bg-slate-100 min-h-screen" x-data="{ modalOpen: false, modalType: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-l-8 border-blue-700 p-6 flex flex-col sm:flex-row justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">Hola, {{ Auth::user()->name }}</h3>
                    <p class="text-slate-500">Panel del Paciente</p>
                </div>
                <div class="mt-2 sm:mt-0 text-center sm:text-right">
                    <span class="bg-blue-100 text-blue-800 font-bold px-3 py-1 rounded-full text-sm">
                        ZONA {{ strtoupper($paciente->ubicacion_zona ?? 'GENERAL') }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-xl shadow border border-slate-200">
                    <div class="flex justify-between mb-4">
                        <h4 class="font-bold text-lg text-slate-700">Mi Seguro</h4>
                        <span class="text-green-600 font-bold bg-green-50 px-2 py-1 rounded text-xs">ACTIVO</span>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Plan:</span>
                            <span class="font-bold text-blue-900">{{ $poliza->nombre_plan ?? 'Básico' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Cobertura:</span>
                            <span class="font-bold text-green-600 text-lg">${{ number_format($poliza->cobertura ?? 0, 2) }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('contrato') }}" target="_blank" class="text-blue-600 hover:underline text-sm font-bold flex items-center justify-center gap-2 border border-blue-100 p-2 rounded bg-blue-50">
                        📄 Ver Contrato Firmado
                    </a>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border border-slate-200">
                    <h4 class="font-bold text-lg text-slate-700 mb-4">Gestiones</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <button @click="modalOpen = true; modalType = 'cita'" class="btn-primary">
                            📅 Agendar
                        </button>
                        <button @click="modalOpen = true; modalType = 'pago'" class="btn-secondary">
                            💳 Pagos
                        </button>
                    </div>
                    <button onclick="if(confirm('¿SOS?')) alert('Ubicación Enviada')" class="btn-danger">
                        🚨 SOS
                    </button>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border border-slate-200">
                    <h4 class="font-bold text-lg text-slate-700 mb-4">Historial Reciente</h4>
                    @if(isset($historial) && count($historial) > 0)
                        <ul class="text-sm space-y-2">
                            @foreach($historial as $h)
                            <li class="flex justify-between border-b pb-1">
                                <span>{{ $h->diagnostico }}</span>
                                <span class="text-red-500 font-bold">-${{ $h->costo }}</span>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400 text-sm italic">Sin consultas previas.</p>
                    @endif
                </div>
            </div>
        </div>

        <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="bg-white rounded-lg shadow-xl w-96 p-6" @click.away="modalOpen = false">
                
                <div x-show="modalType === 'cita'">
                    <h3 class="font-bold text-xl mb-4">Agendar Cita</h3>
                    <input type="date" class="w-full border-gray-300 rounded mb-4">
                    <button @click="modalOpen = false; alert('✅ Cita solicitada al médico de zona.')" class="btn-primary">Confirmar</button>
                </div>

                <div x-show="modalType === 'pago'">
                    <h3 class="font-bold text-xl mb-4">Pago Mensual</h3>
                    <p class="mb-4">Monto: ${{ $poliza->costo ?? '0.00' }}</p>
                    <button @click="modalOpen = false; alert('✅ Pago simulado exitoso (Sandbox).')" class="btn-secondary">Pagar</button>
                </div>

                <button @click="modalOpen = false" class="mt-4 text-gray-500 text-sm underline w-full text-center">Cancelar</button>
            </div>
        </div>
    </div>
</x-app-layout>