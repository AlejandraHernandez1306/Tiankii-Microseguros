<x-app-layout>
    <style>
        .panel-header { background-color: #0d9488; color: white; padding: 20px; border-radius: 10px 10px 0 0; display: flex; justify-content: space-between; align-items: center; }
        .btn-cobrar { background-color: #0f766e; color: white; font-weight: bold; width: 100%; padding: 12px; border-radius: 8px; border: 2px solid #115e59; cursor: pointer; text-transform: uppercase; margin-top: 10px; }
        .btn-cobrar:hover { background-color: #134e4a; }
        .btn-aceptar { background-color: #22c55e; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; border: none; cursor: pointer; }
        .btn-rechazar { background-color: #ef4444; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; border: none; cursor: pointer; }
        .card-box { background: white; border: 1px solid #e5e7eb; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="panel-header">
                    <div>
                        <h2 class="text-2xl font-bold">🏥 Panel Proveedor de Salud</h2>
                        <p class="text-sm opacity-90">Clínica / Farmacia Adscrita</p>
                    </div>
                    <div class="bg-white text-teal-800 px-4 py-2 rounded-full font-bold text-sm">
                        {{ Auth::user()->name }}
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                    <strong>✅ Éxito:</strong> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                    <strong>❌ Error:</strong> {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="card-box">
                    <h3 class="font-bold text-xl text-gray-700 mb-4 border-b pb-2">💊 Registrar Atención / Venta</h3>
                    <p class="text-xs text-gray-500 mb-4">Ingrese los datos para descontar del saldo del paciente.</p>
                    
                    <form action="{{ route('medico.registrar') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Correo del Paciente</label>
                            <input type="email" name="email_paciente" class="w-full border-gray-300 rounded p-2" placeholder="paciente@tiankii.com" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Servicio o Medicamento</label>
                            <input type="text" name="diagnostico" class="w-full border-gray-300 rounded p-2" placeholder="Ej: Amoxicilina / Consulta" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Monto a Cobrar ($)</label>
                            <input type="number" name="costo" step="0.01" class="w-full border-gray-300 rounded p-2 font-bold text-lg" placeholder="0.00" required>
                        </div>
                        
                        <button type="submit" class="btn-cobrar">
                            PROCESAR COBRO
                        </button>
                    </form>
                </div>

                <div class="card-box">
                    <h3 class="font-bold text-xl text-gray-700 mb-4 border-b pb-2">📅 Solicitudes Entrantes</h3>
                    
                    @if(rand(0,1)) <div class="flex justify-between items-center p-3 bg-blue-50 rounded border border-blue-100 mb-2">
                        <div>
                            <p class="font-bold text-sm">Nuevo Paciente (Rural)</p>
                            <p class="text-xs text-gray-500">Solicitud: Medicamento Crónico</p>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="this.parentElement.parentElement.remove(); alert('✅ Solicitud Aprobada')" class="btn-aceptar">Aceptar</button>
                            <button onclick="this.parentElement.parentElement.remove()" class="btn-rechazar">Rechazar</button>
                        </div>
                    </div>
                    @else
                    <div class="p-4 text-center text-gray-400 italic border-dashed border-2 border-gray-200 rounded">
                        No hay solicitudes pendientes en este momento.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>