<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-extrabold text-blue-900">TIANKII</h2>
        <p class="text-gray-500">Registro Oficial</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4 bg-blue-50 p-4 rounded border border-blue-200">
            <label class="block font-bold text-gray-800 mb-2">Selecciona tu Perfil:</label>
            <select name="rol" id="rol" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500" onchange="toggleCampos()">
                <option value="paciente">Soy Paciente (Necesito Seguro)</option>
                <option value="medico">Soy Médico (Profesional)</option>
            </select>
        </div>

        <div class="mb-4">
            <x-input-label for="name" :value="__('Nombre Completo')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
        </div>

        <div class="mb-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
        </div>

        <div id="extra-paciente" class="border-t pt-4 mt-4">
            <h3 class="font-bold text-gray-700 mb-3">Datos para tu Póliza</h3>
            
            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">DUI</label>
                <input type="text" name="dui" class="w-full border-gray-300 rounded shadow-sm" placeholder="00000000-0">
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Teléfono</label>
                    <input type="text" name="telefono" class="w-full border-gray-300 rounded shadow-sm">
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Fecha Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="w-full border-gray-300 rounded shadow-sm">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Zona de Residencia</label>
                <select name="ubicacion_zona" class="w-full border-gray-300 rounded shadow-sm">
                    <option value="Bajo Riesgo">Urbana (Bajo Riesgo)</option>
                    <option value="Alto Riesgo">Rural (Alto Riesgo)</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-blue-900" href="{{ route('login') }}">
                ¿Ya tienes cuenta?
            </a>
            <button type="submit" class="bg-blue-900 text-white px-6 py-2 rounded font-bold hover:bg-blue-800 transition">
                COMPLETAR REGISTRO
            </button>
        </div>
    </form>

    <script>
        function toggleCampos() {
            let rol = document.getElementById('rol').value;
            let div = document.getElementById('extra-paciente');
            if(rol === 'medico') {
                div.style.display = 'none';
            } else {
                div.style.display = 'block';
            }
        }
    </script>
</x-guest-layout>