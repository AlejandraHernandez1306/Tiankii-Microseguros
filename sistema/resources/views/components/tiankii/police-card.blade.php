@props(['poliza', 'paciente'])

<div class="bg-white p-6 rounded-xl shadow-md border border-slate-200 relative overflow-hidden transition hover:shadow-lg">
    <div class="absolute top-0 right-0 {{ $poliza->estado === 'activa' ? 'bg-green-500' : 'bg-red-500' }} text-white text-xs font-bold px-2 py-1 rounded-bl-lg uppercase">
        {{ $poliza->estado }}
    </div>
    <h4 class="text-lg font-bold text-slate-700 mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        Mi Póliza Actual
    </h4>
    
    <div class="space-y-4">
        <div class="flex justify-between border-b border-gray-100 pb-2">
            <span class="text-gray-500 text-sm">Plan:</span>
            <span class="font-bold text-blue-900 text-right">{{ $poliza->nombre_plan }}</span>
        </div>
        <div class="flex justify-between border-b border-gray-100 pb-2">
            <span class="text-gray-500 text-sm">Cobertura:</span>
            <span class="font-bold text-green-600 text-xl">${{ number_format($poliza->cobertura, 2) }}</span>
        </div>
        <div class="flex justify-between items-center pt-2">
            <span class="text-xs text-gray-400">Renovación: {{ $poliza->created_at->addMonth()->format('d/m/Y') }}</span>
            <button onclick="alert('SIMULACIÓN: Generando PDF...')" class="text-blue-600 text-sm font-semibold hover:underline">
                Ver Contrato
            </button>
        </div>
    </div>
</div>