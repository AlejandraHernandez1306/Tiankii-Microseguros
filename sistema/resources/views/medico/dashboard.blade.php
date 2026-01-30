<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-teal-600 p-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">👨‍⚕️ Panel Clínico</h2>
                    <p class="text-teal-600 font-medium">Dr. {{ Auth::user()->name }} | Licencia #MED-2026</p>
                </div>
                <div class="bg-teal-100 text-teal-800 px-4 py-2 rounded-full font-bold text-sm">
                    MODO ACTIVO
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded font-bold">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded font-bold">❌ {{ session('error') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <h3 class="font-bold text-xl text-gray-700 mb-4 border-b pb-2">💊 Consulta y Receta Digital</h3>
                    <form action="{{ route('medico.registrar') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Paciente (Email)</label>
                            <input type="email" name="email_paciente" class="w-full rounded border-gray-300" placeholder="paciente@tiankii.com" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Diagnóstico Médico</label>
                            <input type="text" name="diagnostico" class="w-full rounded border-gray-300" placeholder="Ej: Infección Respiratoria" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Receta / Tratamiento</label>
                            <textarea name="receta" rows="3" class="w-full rounded border-gray-300" placeholder="Ej: Amoxicilina 500mg c/8h por 7 días..." required></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Costo ($)</label>
                                <input type="number" name="costo" step="0.01" class="w-full rounded border-gray-300 font-bold" placeholder="0.00" required>
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="w-full bg-teal-600 text-white font-bold py-2 rounded hover:bg-teal-700 shadow-lg">
                                    CONFIRMAR Y COBRAR
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border border-gray-200 opacity-90">
                    <h3 class="font-bold text-xl text-gray-700 mb-4 border-b pb-2">📂 Expediente Reciente</h3>
                    <p class="text-sm text-gray-500 mb-4">Último paciente atendido:</p>
                    <div class="bg-gray-50 p-4 rounded border">
                        <p><strong>Estado:</strong> Esperando nueva consulta...</p>
                        <p class="text-xs text-gray-400 mt-2">El historial completo se actualiza al procesar el cobro.</p>
                    </div>
                    <div class="mt-6">
                        <h4 class="font-bold text-sm text-gray-700">Inventario Rápido (Farmacia)</h4>
                        <ul class="text-xs text-gray-600 list-disc list-inside mt-2">
                            <li>Paracetamol 500mg (Disponible)</li>
                            <li>Ibuprofeno 400mg (Bajo Stock)</li>
                            <li>Antibióticos (Requiere Receta)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>