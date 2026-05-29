<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edición de Usuario (Modo Dios)</h2>
                
                <form method="POST" action="{{ route('admin.update', $usuario->id) }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold text-gray-700">Nombre</label>
                        <input type="text" name="name" value="{{ $usuario->name }}" class="w-full border p-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold text-gray-700">Correo</label>
                        <input type="email" name="email" value="{{ $usuario->email }}" class="w-full border p-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold text-gray-700">Rol de Sistema</label>
                        <select name="rol" class="w-full border p-2 rounded bg-gray-50">
                            <option value="paciente" {{ $usuario->rol == 'paciente' ? 'selected' : '' }}>Paciente</option>
                            <option value="medico" {{ $usuario->rol == 'medico' ? 'selected' : '' }}>Médico</option>
                            <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>

                    @if($usuario->paciente)
                    <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded">
                        <label class="block font-bold text-blue-800">Zona de Riesgo (Paciente)</label>
                        <select name="ubicacion_zona" class="w-full border p-2 rounded mt-1">
                            <option value="Bajo Riesgo" {{ $usuario->paciente->ubicacion_zona == 'Bajo Riesgo' ? 'selected' : '' }}>Bajo Riesgo (Urbano)</option>
                            <option value="Alto Riesgo" {{ $usuario->paciente->ubicacion_zona == 'Alto Riesgo' ? 'selected' : '' }}>Alto Riesgo (Rural)</option>
                        </select>
                    </div>
                    @endif

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ url('/dashboard') }}" class="text-gray-500 underline py-2">Cancelar</a>
                        <button type="submit" class="bg-blue-800 text-white font-bold py-2 px-6 rounded hover:bg-blue-900">
                            GUARDAR CAMBIOS
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>