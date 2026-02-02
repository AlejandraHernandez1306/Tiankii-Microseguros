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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Para calcular la edad

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validación
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telefono' => ['required', 'string', 'max:20'],
            'fecha_nacimiento' => ['required', 'date'],
            'ubicacion_zona' => ['required', 'in:Bajo Riesgo,Alto Riesgo'], // Ajustado a tu lógica
        ]);

        // Transacción para integridad de datos (OES.1)
        DB::transaction(function () use ($request) {
            
            // 1. Crear Usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => 'paciente',
            ]);

            // 2. Crear Perfil Paciente
            Paciente::create([
                'user_id' => $user->id,
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'ubicacion_zona' => $request->ubicacion_zona,
            ]);

            // 3. CÁLCULO DE PRIMA (LÓGICA CORE RF.2.0)
            // A. Base
            $prima = 50.00; 
            
            // B. Ajuste por Edad
            $edad = Carbon::parse($request->fecha_nacimiento)->age;
            if ($edad > 40) {
                $prima += ($edad - 40) * 1.00; // +$1 por cada año extra
            }

            // C. Ajuste por Ubicación
            if ($request->ubicacion_zona === 'Alto Riesgo') {
                $prima *= 1.20; // Multiplicador 1.2x
            }

            // 4. Generar Póliza
            Poliza::create([
                'user_id' => $user->id,
                'nombre_plan' => 'Microseguro ' . $request->ubicacion_zona,
                'costo' => $prima, // Costo calculado
                'cobertura' => 1000.00, // Cobertura inicial fija para simulación
                'estado' => 'activa'
            ]);

            event(new Registered($user));
            Auth::login($user);
        });

        return redirect(route('dashboard', absolute: false));
    }
}