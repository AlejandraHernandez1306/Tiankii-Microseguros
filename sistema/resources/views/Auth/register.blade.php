<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-extrabold text-blue-900">TIANKII</h2>
        <p class="text-gray-500">Registro de Usuarios</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-bold text-gray-700">Selecciona tu Perfil:</label>
            <select name="rol" id="rol" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500" onchange="toggleCampos()">
                <option value="paciente">Soy Paciente</option>
                <option value="medico">Soy Médico</option>
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

        <div id="extra-paciente">
    <div class="mb-4">
        <label class="block font-bold text-gray-700">DUI</label>
        <input type="text" name="dui" class="w-full border-gray-300 rounded" placeholder="00000000-0">
    </div>
    <div class="mb-4">
        <label class="block font-bold text-gray-700">Teléfono</label>
        <input type="text" name="telefono" class="w-full border-gray-300 rounded">
    </div>
    <div class="mb-4">
        <label class="block font-bold text-gray-700">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="w-full border-gray-300 rounded">
    </div>
    <div class="mb-4">
        <label class="block font-bold text-gray-700">Zona</label>
        <select name="ubicacion_zona" class="w-full border-gray-300 rounded">
            <option value="Bajo Riesgo">Urbana (Bajo Riesgo)</option>
            <option value="Alto Riesgo">Rural (Alto Riesgo)</option>
        </select>
    </div>
</div>
            <input type="hidden" name="telefono" value="0000-0000"> <input type="hidden" name="fecha_nacimiento" value="2000-01-01"> </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-blue-900" href="{{ route('login') }}">
                ¿Ya tienes cuenta? Iniciar Sesión
            </a>

            <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded font-bold hover:bg-blue-900">
                REGISTRARSE
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