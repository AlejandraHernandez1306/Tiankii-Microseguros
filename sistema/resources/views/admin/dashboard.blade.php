<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 rounded shadow border-l-4 border-indigo-600">
                    <p class="text-gray-500">Usuarios Totales</p>
                    <p class="text-2xl font-bold">{{ $users->total() }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-green-600">
                    <p class="text-gray-500">Dinero Recaudado</p>
                    <p class="text-2xl font-bold">${{ number_format($totalDinero ?? 0, 2) }}</p>
                </div>
            </div>

            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden border-t-4 border-indigo-600">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Gestión de Usuarios</h1>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="p-3">Nombre</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Rol</th>
                                <th class="p-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $u)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $u->name }}</td>
                                <td class="p-3">{{ $u->email }}</td>
                                <td class="p-3 uppercase font-bold text-xs">{{ $u->rol }}</td>
                                <td class="p-3 flex gap-2">
                                    <a href="{{ route('admin.edit', $u->id) }}" class="text-blue-600 font-bold">Editar</a>
                                    <form action="{{ route('admin.destroy', $u->id) }}" method="POST" onsubmit="return confirm('¿Borrar?');">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 font-bold">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>