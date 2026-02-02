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
        // 1. VALIDAMOS DATOS COMUNES + ROL
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'rol' => ['required', 'in:paciente,medico'],
        ]);

        DB::transaction(function () use ($request) {
            
            // 2. CREAMOS EL USUARIO MAESTRO
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => $request->rol,
            ]);

            // 3. SI ES PACIENTE -> CREAMOS SU SEGURO
            if ($request->rol === 'paciente') {
                
                // Si el usuario no llenó algo, ponemos valores por defecto para que NO TRUENE
                $fecha = $request->fecha_nacimiento ?? '2000-01-01';
                $zona = $request->ubicacion_zona ?? 'Bajo Riesgo';
                $dui = $request->dui ?? 'PENDIENTE-'.rand(1000,9999);

                Paciente::create([
                    'user_id' => $user->id,
                    'dui' => $dui,
                    'telefono' => $request->telefono ?? '0000-0000',
                    'fecha_nacimiento' => $fecha,
                    'ubicacion_zona' => $zona,
                ]);

                // Lógica de Cobro
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
            
            // 4. LOGIN AUTOMÁTICO
            event(new Registered($user));
            Auth::login($user);
        });

        // 5. ENVIAR AL DASHBOARD
        return redirect(route('dashboard', absolute: false));
    }
}