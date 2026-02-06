<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden border-t-4 border-indigo-600">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold text-gray-800">Panel de Administración</h1>
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">Usuarios Totales: {{ $users->total() }}</span>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="p-3 font-bold text-gray-600">Nombre</th>
                                    <th class="p-3 font-bold text-gray-600">Email</th>
                                    <th class="p-3 font-bold text-gray-600">Rol</th>
                                    <th class="p-3 font-bold text-gray-600">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="p-3">{{ $u->name }}</td>
                                    <td class="p-3 text-sm text-gray-500">{{ $u->email }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-bold uppercase 
                                            {{ $u->rol == 'admin' ? 'bg-purple-100 text-purple-800' : 
                                               ($u->rol == 'medico' ? 'bg-teal-100 text-teal-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ $u->rol }}
                                        </span>
                                    </td>
                                    <td class="p-3 flex gap-2">
                                        <a href="{{ route('admin.edit', $u->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm font-bold shadow transition">
                                            Editar
                                        </a>
                                        <form action="{{ route('admin.destroy', $u->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                            @csrf @method('DELETE')
                                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-bold shadow transition">
                                                Borrar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>