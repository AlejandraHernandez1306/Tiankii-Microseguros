<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-teal-500">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-teal-800">🩺 Panel Médico</h1>
                    <p>Bienvenido Dr. {{ Auth::user()->name }}</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="font-bold mb-4">Nueva Consulta</h3>
                    <form action="{{ route('medico.registrar') }}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Correo Paciente" class="w-full border rounded mb-2 p-2" required>
                        <textarea name="diagnostico" placeholder="Diagnóstico" class="w-full border rounded mb-2 p-2"></textarea>
                        <button class="bg-teal-600 text-white w-full py-2 rounded font-bold">Guardar Consulta</button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <h3 class="font-bold mb-4">Pacientes Recientes</h3>
                    <ul>
                        @foreach(\App\Models\User::where('rol', 'paciente')->limit(5)->get() as $p)
                        <li class="border-b py-2 flex justify-between">
                            <span>{{ $p->name }}</span>
                            <span class="text-sm text-gray-500">{{ $p->email }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>