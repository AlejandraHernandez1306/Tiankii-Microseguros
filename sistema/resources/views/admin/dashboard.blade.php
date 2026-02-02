<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border-l-4 border-indigo-500">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-indigo-800 mb-4">Panel de Administración</h1>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="p-3 font-bold">Nombre</th>
                                    <th class="p-3 font-bold">Email</th>
                                    <th class="p-3 font-bold">Rol</th>
                                    <th class="p-3 font-bold">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\User::all() as $u)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3">{{ $u->name }}</td>
                                    <td class="p-3">{{ $u->email }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                                            {{ $u->rol == 'admin' ? 'bg-indigo-100 text-indigo-800' : 
                                               ($u->rol == 'medico' ? 'bg-teal-100 text-teal-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ $u->rol }}
                                        </span>
                                    </td>
                                    <td class="p-3 flex gap-2">
                                        <a href="{{ route('admin.edit', $u->id) }}" class="text-blue-600 font-bold text-sm">Editar</a>
                                        <form action="{{ route('admin.destroy', $u->id) }}" method="POST" onsubmit="return confirm('¿Eliminar?');">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600 font-bold text-sm">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>