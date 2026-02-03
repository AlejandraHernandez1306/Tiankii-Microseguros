<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded shadow border-l-4 border-teal-500">
                    <p class="text-gray-500 text-sm">Pacientes Totales</p>
                    <p class="text-2xl font-bold">{{ \App\Models\User::where('rol', 'paciente')->count() }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">Consultas Realizadas</p>
                    <p class="text-2xl font-bold">{{ \App\Models\Atencion::where('medico_user_id', Auth::id())->count() }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-purple-500">
                    <p class="text-gray-500 text-sm">Ingresos del Mes</p>
                    <p class="text-2xl font-bold">${{ \App\Models\Atencion::where('medico_user_id', Auth::id())->sum('costo_total') }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-green-500">
                    <p class="text-gray-500 text-sm">Estado del Sistema</p>
                    <p class="text-lg font-bold text-green-600">En Línea ●</p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md border border-gray-100">
                    <h3 class="font-bold text-lg mb-4 text-teal-800 border-b pb-2 flex items-center gap-2">
                        <span>📝</span> Registrar Nueva Consulta
                    </h3>
                    
                    <form action="{{ route('medico.registrar') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="col-span-2">
                                <label class="text-sm font-bold text-gray-700">Paciente (Email)</label>
                                <input type="email" name="email_paciente" class="w-full border-gray-300 rounded focus:ring-teal-500" required placeholder="ejemplo@tiankii.com">
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700">Costo Total ($)</label>
                                <input type="number" step="0.01" name="costo" class="w-full border-gray-300 rounded" required>
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700">Fecha</label>
                                <input type="text" value="{{ date('Y-m-d') }}" disabled class="w-full bg-gray-100 border-gray-300 rounded text-gray-500">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="text-sm font-bold text-gray-700">Diagnóstico Médico</label>
                            <textarea name="diagnostico" class="w-full border-gray-300 rounded h-24" required placeholder="Describe los síntomas y el diagnóstico..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="text-sm font-bold text-gray-700">Receta / Tratamiento</label>
                            <textarea name="receta" class="w-full border-gray-300 rounded h-20" placeholder="Medicamentos recetados..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded font-bold shadow-lg transition transform hover:scale-105">
                            GUARDAR Y GENERAR EXPEDIENTE
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100 h-fit">
                    <h3 class="font-bold text-lg mb-4 text-gray-700 border-b pb-2">📂 Directorio</h3>
                    
                    @if($pacientes->count() > 0)
                        <ul class="space-y-3">
                            @foreach($pacientes as $p)
                            <li class="flex justify-between items-center p-3 bg-gray-50 rounded hover:bg-teal-50 transition border border-gray-200">
                                <div class="truncate">
                                    <p class="font-bold text-gray-800 text-sm">{{ $p->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $p->email }}</p>
                                </div>
                                <a href="{{ route('medico.ver_historial', $p->id) }}" class="text-white bg-teal-500 hover:bg-teal-600 px-3 py-1 rounded text-xs font-bold shadow-sm">
                                    Ver
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="mt-4 text-xs">
                            {{ $pacientes->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-sm text-center py-4">No hay pacientes registrados.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>