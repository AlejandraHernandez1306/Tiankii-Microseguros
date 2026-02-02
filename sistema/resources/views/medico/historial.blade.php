<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-xl sm:rounded-lg p-6 mb-6 flex justify-between items-center border-l-8 border-teal-600">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $paciente->name }}</h1>
                    <p class="text-gray-500">DUI: {{ $paciente->paciente->dui ?? 'N/A' }} | Zona: {{ $paciente->paciente->ubicacion_zona ?? 'N/A' }}</p>
                </div>
                
                <div class="text-center">
                    <p class="text-sm font-bold mb-2">Control de Póliza</p>
                    <form action="{{ route('medico.toggle_poliza', $paciente->id) }}" method="POST">
                        @csrf
                        @php $estado = $paciente->polizas->first()->estado ?? 'vencida'; @endphp
                        @if($estado == 'activa')
                            <button class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-bold border border-green-400 hover:bg-red-100 hover:text-red-800 transition">
                                ✅ ACTIVA (Click para Desactivar)
                            </button>
                        @else
                            <button class="bg-red-100 text-red-800 px-4 py-2 rounded-full font-bold border border-red-400 hover:bg-green-100 hover:text-green-800 transition">
                                ⛔ INACTIVA (Click para Activar)
                            </button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="font-bold text-xl text-gray-700 mb-4">📂 Expediente Clínico Completo</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6">Fecha</th>
                            <th class="py-3 px-6">Diagnóstico</th>
                            <th class="py-3 px-6">Receta / Tratamiento</th>
                            <th class="py-3 px-6 text-right">Costo</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @forelse($paciente->atenciones as $atencion)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 font-bold">{{ $atencion->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-3 px-6">{{ $atencion->diagnostico }}</td>
                            <td class="py-3 px-6 italic text-teal-700">{{ $atencion->receta }}</td>
                            <td class="py-3 px-6 text-right font-bold text-red-600">${{ number_format($atencion->costo_total, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-400">Sin historial registrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-6">
                    <a href="{{ route('medico.panel') }}" class="text-teal-600 underline font-bold">← Volver al Panel Médico</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>