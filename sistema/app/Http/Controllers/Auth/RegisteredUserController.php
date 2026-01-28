<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Paciente; // <--- VITAL
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB; // TRANSACCIONES

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validamos TODO lo que viene del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Datos del Paciente 
            'telefono' => ['required', 'string', 'max:20'],
            'fecha_nacimiento' => ['required', 'date'],
            'ubicacion_zona' => ['required', 'in:Rural,Urbana'], // Asegura que coincida con el ENUM
        ]);

        // 2. Usamos Transacción: O se guarda todo, o no se guarda nada.
        DB::transaction(function () use ($request) {
            
            // A. Crear Usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => 'paciente', // Forzamos el rol
            ]);

            // B. Crear Perfil de Paciente 
            Paciente::create([
                'user_id' => $user->id,
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'ubicacion_zona' => $request->ubicacion_zona,
            ]);

            event(new Registered($user));

            // C. Login Automático
            Auth::login($user);
        });

        // 3. Redirigir al Dashboard
        return redirect(route('dashboard', absolute: false));
    }
}