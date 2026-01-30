<x-app-layout>
    <style>
        .btn-cobrar { background-color: #0D9488; color: white; font-weight: bold; padding: 0.75rem; border-radius: 0.5rem; width: 100%; }
        .btn-cobrar:hover { background-color: #0F766E; }
    </style>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-l-8 border-teal-600 p-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">👨‍⚕️ Panel Médico</h2>
                    <p class="text-teal-600 font-medium">Dr. {{ Auth::user()->name }}</p>
                </div>
                <div class="bg-teal-100 text-teal-800 px-4 py-2 rounded-full font-bold text-sm">
                    MODO CLÍNICO
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <h3 class="font-bold text-xl text-gray-700 mb-4 border-b pb-2">🩺 Registrar Consulta</h3>
                    <form action="{{ route('medico.registrar') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Paciente</label>
                            <input type="email" name="email_paciente" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="correo@paciente.com" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Diagnóstico</label>
                            <input type="text" name="diagnostico" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="Ej: Gripe Estacional" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Costo ($)</label>
                            <input type="number" name="costo" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="0.00" required>
                        </div>
                        
                        <button type="submit" class="btn-cobrar">
                            REALIZAR COBRO
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <h3 class="font-bold text-xl text-gray-700 mb-4 border-b pb-2">📅 Solicitudes Pendientes</h3>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded border mb-2">
                        <div>
                            <p class="font-bold text-sm">Paciente Rural #12</p>
                            <p class="text-xs text-gray-500">Motivo: Dolor General</p>
                        </div>
                        <div class="space-x-2">
                            <button onclick="this.parentElement.parentElement.remove(); alert('✅ Aceptado')" class="text-green-600 font-bold hover:underline text-sm">Aceptar</button>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-red-600 font-bold hover:underline text-sm">Rechazar</button>
                        </div>
                    </div>
                    
                    <p class="text-center text-xs text-gray-400 mt-4">No hay más citas por hoy.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>