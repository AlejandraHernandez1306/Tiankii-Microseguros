<x-app-layout>
    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-teal-600">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">👨‍⚕️ Panel Médico - Tiankii</h2>
                        <span class="bg-teal-100 text-teal-800 text-xs font-semibold px-2.5 py-0.5 rounded">MODO DOCTOR</span>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p class="font-bold">¡Operación Exitosa!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Error en Transacción</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Registrar Nueva Consulta</h3>
                            <form action="{{ route('medico.registrar') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Correo del Paciente</label>
                                    <input type="email" name="email_paciente" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" placeholder="paciente@tiankii.com" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Diagnóstico / Motivo</label>
                                    <input type="text" name="diagnostico" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" placeholder="Ej: Consulta General, Gripe..." required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Costo de la Consulta ($)</label>
                                    <input type="number" name="costo" step="0.01" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" placeholder="0.00" required>
                                </div>
                                <button type="submit" class="w-full bg-teal-600 text-white font-bold py-3 rounded-lg hover:bg-teal-700 transition">
                                    COBRAR A PÓLIZA
                                </button>
                            </form>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Instrucciones</h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-2">
                                <li>Ingrese el correo exacto del paciente registrado.</li>
                                <li>El sistema verificará automáticamente si la póliza está activa.</li>
                                <li>Si el paciente tiene saldo suficiente, se descontará automáticamente (RF.4.2).</li>
                                <li>Se generará un registro en el historial clínico.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>