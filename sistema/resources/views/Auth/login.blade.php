<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-900 via-teal-900 to-black">
        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border border-gray-100">
            
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-black tracking-tighter" style="color: #0d9488;">TIANKII</h1>
                <p class="text-gray-400 font-medium">Ingresa a tu portal de salud</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Correo Electrónico</label>
                    <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 focus:ring-2 transition text-gray-800" style="outline-color: #0d9488;" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Contraseña</label>
                    <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 focus:ring-2 transition text-gray-800" style="outline-color: #0d9488;" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 shadow-sm" style="color: #0d9488;">
                        <span class="ms-2 text-sm text-gray-500 font-semibold">Recordarme</span>
                    </label>
                </div>

                <div class="block w-full">
                    <button type="submit" 
                            class="w-full py-4 rounded-xl font-black text-center text-white shadow-lg transition-all transform active:scale-95 border-none"
                            style="background-color: #0d9488 !important; opacity: 1 !important; visibility: visible !important; display: block !important; color: white !important;">
                        INICIAR SESIÓN AHORA
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center text-sm">
                <span class="text-gray-400">¿No tienes cuenta?</span>
                <a href="{{ route('register') }}" class="font-bold ml-1 underline decoration-2 underline-offset-4" style="color: #0d9488;">Regístrate aquí</a>
            </div>
        </div>
    </div>
</x-guest-layout>