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

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telefono' => ['required', 'string', 'max:20'],
            'fecha_nacimiento' => ['required', 'date'],
            'ubicacion_zona' => ['required', 'in:Rural,Urbana'],
        ]);

        DB::transaction(function () use ($request) {
            // 1. Usuario Base
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => 'paciente',
            ]);

            // 2. Perfil Médico (Fase 3: Datos de Salud)
            Paciente::create([
                'user_id' => $user->id,
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'ubicacion_zona' => $request->ubicacion_zona,
            ]);

            // 3. Generación de Póliza (Fase 2: Core Financiero)
            // Lógica: Rural paga menos ($5), Urbana paga estándar ($15)
            $esRural = $request->ubicacion_zona === 'Rural';
            
            Poliza::create([
                'user_id' => $user->id,
                'nombre_plan' => $esRural ? 'Plan Semilla (Subvencionado)' : 'Plan Urbano Total',
                'costo' => $esRural ? 5.00 : 15.00,
                'cobertura' => 500.00,
                'estado' => 'activa'
            ]);

            event(new Registered($user));
            Auth::login($user);
        });

        return redirect(route('dashboard', absolute: false));
    }
}