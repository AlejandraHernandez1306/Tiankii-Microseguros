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
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'rol' => ['required', 'in:paciente,medico'],
        ]);

        DB::transaction(function () use ($request) {
            
            // 1. Crear Usuario Maestro
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => $request->rol,
            ]);

            // 2. Lógica solo para Pacientes
            if ($request->rol === 'paciente') {
                
                // Valores por defecto "A prueba de fallos"
                // Si el usuario no selecciona fecha, asumimos una edad base para que no truene el sistema
                $fecha = $request->fecha_nacimiento ?? '2000-01-01'; 
                $zona = $request->ubicacion_zona ?? 'Bajo Riesgo'; 
                $dui = $request->dui ?? 'PENDIENTE-' . time();

                Paciente::create([
                    'user_id' => $user->id,
                    'dui' => $dui,
                    'telefono' => $request->telefono ?? '0000-0000',
                    'fecha_nacimiento' => $fecha,
                    'ubicacion_zona' => $zona,
                ]);

                // --- LÓGICA DE NEGOCIO (CALCULO DE PRECIO) ---
                // Requisito: Calcular precio por zona y edad
                $prima = 50.00; // Base
                $edad = Carbon::parse($fecha)->age;
                
                // Regla 1: +$1 por cada año arriba de 40
                if ($edad > 40) {
                    $prima += ($edad - 40);
                }
                // Regla 2: +20% si es Rural (Alto Riesgo)
                if ($zona === 'Alto Riesgo') {
                    $prima *= 1.20;
                }

                Poliza::create([
                    'user_id' => $user->id,
                    'nombre_plan' => 'Plan ' . $zona,
                    'costo' => $prima,
                    'cobertura' => 1000.00,
                    'estado' => 'activa'
                ]);
            }

            event(new Registered($user));
            Auth::login($user);
        });

        return redirect(route('dashboard', absolute: false));
    }
}