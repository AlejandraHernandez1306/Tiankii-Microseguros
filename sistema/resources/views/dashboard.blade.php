<x-app-layout>
    <div class="py-12 bg-slate-100 min-h-screen" x-data="{ openReceta: false, recetaTexto: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white p-6 rounded-xl shadow border-l-8 border-blue-600 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Hola, {{ Auth::user()->name }}</h1>
                    <p class="text-slate-500">Panel del Asegurado</p>
                </div>
                <div class="text-right">
                    <span class="bg-blue-100 text-blue-800 font-bold px-3 py-1 rounded-full text-xs">ZONA {{ strtoupper($paciente->ubicacion_zona) }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="font-bold text-lg text-slate-700 mb-4">Estado de Cuenta</h3>
                    <div class="flex justify-between border-b pb-2 mb-2">
                        <span>Saldo Disponible</span>
                        <span class="font-bold text-2xl text-green-600">${{ number_format($poliza->cobertura, 2) }}</span>
                    </div>
                    <div class="text-sm text-gray-500 mb-4">Plan: {{ $poliza->nombre_plan }}</div>
                    <a href="{{ route('contrato') }}" target="_blank" class="block w-full bg-blue-50 text-blue-600 text-center py-2 rounded font-bold hover:bg-blue-100">
                        📄 Ver Contrato Legal
                    </a>
                </div>

                <div class="md:col-span-2 bg-white p-6 rounded-xl shadow">
                    <h3 class="font-bold text-lg text-slate-700 mb-4">📂 Historial de Consultas y Recetas</h3>
                    @if(isset($historial) && count($historial) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2">Fecha</th>
                                        <th class="px-4 py-2">Diagnóstico</th>
                                        <th class="px-4 py-2">Costo</th>
                                        <th class="px-4 py-2">Receta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($historial as $h)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($h->created_at)->format('d/m/Y') }}</td>
                                        <td class="px-4 py-2 font-medium text-gray-900">{{ $h->diagnostico }}</td>
                                        <td class="px-4 py-2 text-red-600">-${{ $h->costo }}</td>
                                        <td class="px-4 py-2">
                                            @if($h->receta)
                                                <button @click="openReceta = true; recetaTexto = '{{ $h->receta }}'" class="text-blue-600 underline font-bold hover:text-blue-800">
                                                    Ver Receta
                                                </button>
                                            @else
                                                <span class="text-gray-400">---</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-400 italic">No hay historial médico registrado.</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <button onclick="alert('Funcionalidad Sandbox: Abriendo pasarela de pagos...')" class="bg-indigo-600 text-white py-3 rounded-lg font-bold shadow hover:bg-indigo-700">
                    💳 Recargar Saldo
                </button>
                
                <a href="tel:911" class="bg-red-600 text-white py-3 rounded-lg font-bold shadow hover:bg-red-700 text-center flex justify-center items-center gap-2">
                    🚨 SOS (LLAMADA REAL)
                </a>
            </div>
        </div>

        <div x-show="openReceta" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
            <div class="bg-white p-6 rounded-lg max-w-lg w-full shadow-2xl" @click.away="openReceta = false">
                <h3 class="text-xl font-bold text-teal-700 mb-4">💊 Receta Médica Digital</h3>
                <div class="bg-yellow-50 p-4 rounded border border-yellow-200 text-gray-800 font-mono text-sm leading-relaxed" x-text="recetaTexto"></div>
                <button @click="openReceta = false" class="mt-4 w-full bg-gray-200 text-gray-800 py-2 rounded font-bold">Cerrar</button>
            </div>
        </div>
    </div>
</x-app-layout>