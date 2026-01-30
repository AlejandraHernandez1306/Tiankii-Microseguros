<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-teal-600 p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">👨‍⚕️ Panel Clínico - Tiankii</h2>
                    <span class="bg-teal-100 text-teal-800 text-sm font-bold px-3 py-1 rounded-full">Dr. {{ Auth::user()->name }}</span>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4 font-bold border border-green-400">✅ {{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4 font-bold border border-red-400">❌ {{ session('error') }}</div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <h3 class="font-bold text-xl mb-4 text-gray-700">🩺 Registrar Consulta (Cobro)</h3>
                        <form action="{{ route('medico.registrar') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="email" name="email_paciente" class="w-full rounded-lg border-gray-300" placeholder="Correo del Paciente (Ej: paciente@tiankii.com)" required>
                            <input type="text" name="diagnostico" class="w-full rounded-lg border-gray-300" placeholder="Diagnóstico Médico" required>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">$</span>
                                <input type="number" name="costo" class="w-full rounded-lg border-gray-300 pl-8" placeholder="Costo Consulta" step="0.01" required>
                            </div>
                            <button class="w-full bg-teal-600 text-white font-bold py-3 rounded-lg hover:bg-teal-700">REALIZAR COBRO A PÓLIZA</button>
                        </form>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                        <h3 class="font-bold text-xl mb-4 text-gray-700">📅 Solicitudes de Citas</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded border border-blue-100">
                                <div>
                                    <p class="font-bold text-sm">Alejandra Paciente</p>
                                    <p class="text-xs text-gray-500">Motivo: Chequeo General</p>
                                </div>
                                <div class="flex gap-2">
                                    <button onclick="this.closest('.flex').parentElement.remove(); alert('Cita Confirmada')" class="text-green-600 font-bold text-xs hover:bg-green-100 px-2 py-1 rounded">ACEPTAR</button>
                                    <button onclick="this.closest('.flex').parentElement.remove()" class="text-red-600 font-bold text-xs hover:bg-red-100 px-2 py-1 rounded">RECHAZAR</button>
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-xs text-gray-400 mt-4">No hay más solicitudes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>