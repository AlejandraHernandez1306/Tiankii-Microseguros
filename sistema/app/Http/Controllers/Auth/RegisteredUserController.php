<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Poliza;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB; // Necesario para transacciones

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
        // 1. Validamos los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telefono' => ['required', 'string', 'max:20'],
            'fecha_nacimiento' => ['required', 'date'],
            'ubicacion_zona' => ['required', 'in:Rural,Urbana'],
        ]);

        // 2. Usamos una transacción para asegurar que se cree todo o nada
        DB::transaction(function () use ($request) {
            
            // A. Crear el Usuario (Login)
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => 'paciente',
            ]);

            // B. Crear el Perfil del Paciente
            Paciente::create([
                'user_id' => $user->id,
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'ubicacion_zona' => $request->ubicacion_zona,
            ]);

            // C. Asignar la Póliza Automática (Lógica de Negocio del PDF)
            // Si es Rural, el costo es subsidiado ($5). Si es Urbana, costo pleno ($15).
            $plan = $request->ubicacion_zona === 'Rural' ? 'Plan Semilla Rural' : 'Plan Salud Urbana';
            $costo = $request->ubicacion_zona === 'Rural' ? 5.00 : 15.00;

            Poliza::create([
                'user_id' => $user->id,
                'nombre_plan' => $plan,
                'costo' => $costo,
                'cobertura' => 500.00, // Cobertura inicial estándar
                'estado' => 'activa'
            ]);

            event(new Registered($user));

            // D. Iniciar sesión automáticamente
            Auth::login($user);
        });

        // 3. Redirigir al Dashboard
        return redirect(route('dashboard', absolute: false));
    }
}