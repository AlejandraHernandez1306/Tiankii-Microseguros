<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="text-xl font-bold text-center text-blue-900 mb-4">CREAR CUENTA TIANKII</h2>

        <div class="mb-4 p-4 bg-gray-100 rounded-lg border border-gray-300">
            <label class="block font-bold text-gray-700 mb-2">🔴 ¿Eres Médico o Paciente?</label>
            <select name="rol" id="rol" class="w-full border-gray-300 rounded-md shadow-sm" onchange="mostrarCampos()">
                <option value="paciente">Soy Paciente (Quiero Seguro)</option>
                <option value="medico">Soy Médico (Quiero trabajar)</option>
            </select>
        </div>

        <div>
            <x-input-label for="name" :value="__('Nombre Completo')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        </div>

        <div id="campos_paciente" class="mt-4 p-4 bg-blue-50 rounded border border-blue-200">
            <h3 class="font-bold text-blue-800">Datos del Paciente</h3>
            <div class="mt-2">
                <label>DUI</label>
                <input type="text" name="dui" class="w-full border-gray-300 rounded-md" placeholder="00000000-0">
            </div>
            <div class="mt-2">
                <label>Teléfono</label>
                <input type="text" name="telefono" class="w-full border-gray-300 rounded-md">
            </div>
            <div class="mt-2">
                <label>Fecha Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="w-full border-gray-300 rounded-md">
            </div>
            <div class="mt-2">
                <label>Zona</label>
                <select name="ubicacion_zona" class="w-full border-gray-300 rounded-md">
                    <option value="Bajo Riesgo">Urbana</option>
                    <option value="Alto Riesgo">Rural</option>
                </select>
            </div>
        </div>

        <div id="campos_medico" class="hidden mt-4 p-4 bg-teal-50 rounded border border-teal-200">
            <h3 class="font-bold text-teal-800">Datos Médicos</h3>
            <div class="mt-2">
                <label>Licencia JVPM</label>
                <input type="text" name="jvpm" class="w-full border-gray-300 rounded-md" placeholder="JVPM-XXXX">
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar Contraseña" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                ¿Ya tienes cuenta?
            </a>
            <x-primary-button class="ms-4 bg-blue-900">
                {{ __('REGISTRARSE AHORA') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function mostrarCampos() {
            var rol = document.getElementById('rol').value;
            if (rol === 'paciente') {
                document.getElementById('campos_paciente').classList.remove('hidden');
                document.getElementById('campos_medico').classList.add('hidden');
            } else {
                document.getElementById('campos_paciente').classList.add('hidden');
                document.getElementById('campos_medico').classList.remove('hidden');
            }
        }
    </script>
</x-guest-layout>