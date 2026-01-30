<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white p-6 rounded-lg shadow border-l-8 border-teal-500 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">👨‍⚕️ Panel Dr. {{ Auth::user()->name }}</h2>
                    <p class="text-sm text-gray-500">Gestión de Citas y Cobros</p>
                </div>
                <div class="bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-xs font-bold">ROL: MÉDICO</div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="font-bold text-lg mb-4 text-gray-700 border-b pb-2">Registrar Consulta (Cobro)</h3>
                    <form action="{{ route('medico.registrar') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="email" name="email_paciente" class="w-full rounded border-gray-300" placeholder="Email del Paciente" required>
                        <input type="text" name="diagnostico" class="w-full rounded border-gray-300" placeholder="Diagnóstico" required>
                        <input type="number" name="costo" class="w-full rounded border-gray-300" placeholder="Costo $" step="0.01" required>
                        <button class="w-full bg-teal-600 text-white font-bold py-2 rounded hover:bg-teal-700">COBRAR</button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="font-bold text-lg mb-4 text-gray-700 border-b pb-2">Solicitudes de Citas</h3>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded mb-3 border border-gray-200">
                        <div>
                            <p class="font-bold text-sm">Juan Pérez (Rural)</p>
                            <p class="text-xs text-gray-500">Consulta General - Hoy 2:00 PM</p>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="this.parentElement.parentElement.remove(); alert('Cita ACEPTADA. Se notificó al paciente.')" class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">✓ Aceptar</button>
                            <button onclick="this.parentElement.parentElement.remove(); alert('Cita RECHAZADA.')" class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">✕ Rechazar</button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded mb-3 border border-gray-200">
                        <div>
                            <p class="font-bold text-sm">Maria Lopez (Urbana)</p>
                            <p class="text-xs text-gray-500">Pediatría - Mañana 9:00 AM</p>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="this.parentElement.parentElement.remove(); alert('Cita ACEPTADA.')" class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">✓ Aceptar</button>
                            <button onclick="this.parentElement.parentElement.remove(); alert('Cita RECHAZADA.')" class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">✕ Rechazar</button>
                        </div>
                    </div>

                    <p class="text-center text-xs text-gray-400 mt-4">No hay más solicitudes pendientes.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>