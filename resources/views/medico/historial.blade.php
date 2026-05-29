<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6 mb-6 border-t-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $paciente->name }}</h1>
                        <p class="text-gray-500">{{ $paciente->email }}</p>
                        <div class="mt-2 text-sm">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">DUI: {{ $paciente->paciente->dui ?? 'N/A' }}</span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Zona: {{ $paciente->paciente->ubicacion_zona ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 font-bold">← Volver</a>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-4">Historial de Atenciones</h3>
            
            @forelse($paciente->atenciones as $atencion)
            <div class="bg-white shadow rounded-lg p-6 mb-4 border-l-4 border-teal-400">
                <div class="flex justify-between mb-2">
                    <span class="font-bold text-teal-700">Dr. {{ $atencion->medico->name ?? 'Desconocido' }}</span>
                    <span class="text-gray-500 text-sm">{{ $atencion->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="mb-3">
                    <p class="font-bold text-xs text-gray-500 uppercase">Diagnóstico</p>
                    <p class="text-gray-800">{{ $atencion->diagnostico }}</p>
                </div>
                <div class="mb-3">
                    <p class="font-bold text-xs text-gray-500 uppercase">Receta</p>
                    <p class="text-gray-800">{{ $atencion->receta }}</p>
                </div>
                <div class="grid grid-cols-3 gap-4 text-sm bg-gray-50 p-3 rounded">
                    <div>
                        <p class="text-xs text-gray-500">Total</p>
                        <p class="font-bold">${{ number_format($atencion->costo_total, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-green-600">Cubierto (Seguro)</p>
                        <p class="font-bold text-green-700">${{ number_format($atencion->monto_cubierto, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-red-600">Copago Paciente</p>
                        <p class="font-bold text-red-700">${{ number_format($atencion->copago_paciente, 2) }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-gray-500 bg-white rounded shadow">
                No hay historial médico registrado para este paciente.
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>