<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-teal-700">Módulo Médico</h1>
                <p>Bienvenido Dr. {{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>
</x-app-layout>