<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-extrabold text-blue-900 tracking-tight">Tiankii</h2>
        <p class="text-sm text-gray-500 mt-2">Sistema de Microseguros de Salud</p>
        <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide mt-1">Registro de Nuevo Paciente</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">Nombre Completo</label>
            <input id="name" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2.5" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Correo Electrónico</label>
            <input id="email" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2.5" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <h3 class="text-xs font-bold text-blue-800 uppercase mb-3 border-b border-blue-200 pb-1">Información del Asegurado</h3>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="telefono" class="block font-medium text-sm text-gray-700">Teléfono</label>
                    <input id="telefono" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white p-2" type="text" name="telefono" :value="old('telefono')" required placeholder="####-####" />
                </div>

                <div>
                    <label for="ubicacion_zona" class="block font-medium text-sm text-gray-700">Zona</label>
                    <select id="ubicacion_zona" name="ubicacion_zona" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white p-2">
                        <option value="Rural">Rural (Subvencionado)</option>
                        <option value="Urbana">Urbana</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
            <x-input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')" />
            <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" required />
            <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="ubicacion_zona" :value="__('Zona de Residencia')" />
            <select id="ubicacion_zona" name="ubicacion_zona" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="Bajo Riesgo">Urbana / Bajo Riesgo (Plan Base)</option>
                <option value="Alto Riesgo">Rural / Alto Riesgo (+20% Prima)</option>
            </select>
            <x-input-error :messages="$errors->get('ubicacion_zona')" class="mt-2" />
        </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="password" class="block font-medium text-sm text-gray-700">Contraseña</label>
                <input id="password" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2" type="password" name="password" required />
            </div>
            <div>
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmar</label>
                <input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2" type="password" name="password_confirmation" required />
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-blue-800" href="{{ route('login') }}">
                ¿Ya registrado?
            </a>

            <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                Registrar Paciente
            </button>
        </div>
    </form>
</x-guest-layout>