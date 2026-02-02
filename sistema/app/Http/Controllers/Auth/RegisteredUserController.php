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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'rol' => ['required', 'in:paciente,medico'], // Validación estricta
        ]);

        DB::transaction(function () use ($request) {
            
            // 1. Crear Usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => $request->rol,
            ]);

            // 2. Si es Paciente, crear perfil médico y póliza
            if ($request->rol === 'paciente') {
                
                // Valores de seguridad por si el formulario falla en enviar algún dato
                $fecha = $request->fecha_nacimiento ?? '2000-01-01';
                $zona = $request->ubicacion_zona ?? 'Bajo Riesgo';
                $dui = $request->dui ?? 'PENDIENTE-' . time();

                Paciente::create([
                    'user_id' => $user->id,
                    'dui' => $dui,
                    'telefono' => $request->telefono ?? 'Sin numero',
                    'fecha_nacimiento' => $fecha,
                    'ubicacion_zona' => $zona,
                ]);

                // Crear Póliza
                $prima = 50.00;
                $edad = Carbon::parse($fecha)->age;
                if ($edad > 40) $prima += ($edad - 40);
                if ($zona === 'Alto Riesgo') $prima *= 1.20;

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