<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-slate-800">🛡️ Consola de Administración</h1>
                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-bold">SUPER USUARIO</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <h3 class="text-xl font-bold text-blue-700">{{ \App\Models\User::count() }}</h3>
                        <p class="text-sm text-blue-900">Usuarios Totales</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <h3 class="text-xl font-bold text-green-700">${{ \App\Models\Poliza::sum('cobertura') }}</h3>
                        <p class="text-sm text-green-900">Fondo Asegurado Global</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                        <h3 class="text-xl font-bold text-purple-700">{{ \App\Models\User::where('rol', 'medico')->count() }}</h3>
                        <p class="text-sm text-purple-900">Médicos Activos</p>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-700 mb-4">Gestión de Usuarios</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-2 px-4 border-b text-left">ID</th>
                                <th class="py-2 px-4 border-b text-left">Nombre</th>
                                <th class="py-2 px-4 border-b text-left">Email</th>
                                <th class="py-2 px-4 border-b text-left">Rol</th>
                                <th class="py-2 px-4 border-b text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\User::all() as $u)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b">{{ $u->id }}</td>
                                <td class="py-2 px-4 border-b font-bold">{{ $u->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $u->email }}</td>
                                <td class="py-2 px-4 border-b">
                                    <span class="px-2 py-1 rounded text-xs font-bold
                                        {{ $u->rol == 'admin' ? 'bg-purple-100 text-purple-800' : 
                                           ($u->rol == 'medico' ? 'bg-teal-100 text-teal-800' : 'bg-blue-100 text-blue-800') }}">
                                        {{ strtoupper($u->rol) }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    @if($u->id !== Auth::id()) <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('¿Eliminar usuario permanentemente?');">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="user_id_to_delete" value="{{ $u->id }}"> 
                                            <button type="button" onclick="alert('En producción: Usuario eliminado. (Simulado por seguridad en Demo)')" class="text-red-600 hover:text-red-900 font-bold text-sm">
                                                🗑 Eliminar
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs">Actual</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>