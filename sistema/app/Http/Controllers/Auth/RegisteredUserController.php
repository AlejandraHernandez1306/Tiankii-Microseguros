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
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // 1. VALIDACIÓN
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'rol' => ['required', 'in:paciente,medico'],
        ]);

        if ($validator->fails()) {
            // ESTO DETIENE TODO Y TE MUESTRA EL ERROR EN PANTALLA NEGRA
            dd('FALLÓ LA VALIDACIÓN:', $validator->errors()->all()); 
        }

        // 2. INTENTO DE GUARDADO
        try {
            DB::transaction(function () use ($request) {
                
                // Crear Usuario
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'rol' => $request->rol,
                ]);

                // Crear Paciente (si aplica)
                if ($request->rol === 'paciente') {
                    $fecha = $request->fecha_nacimiento ?? '2000-01-01';
                    $zona = $request->ubicacion_zona ?? 'Bajo Riesgo';
                    
                    Paciente::create([
                        'user_id' => $user->id,
                        'dui' => $request->dui ?? 'PENDIENTE-' . time(),
                        'telefono' => $request->telefono ?? '0000-0000',
                        'fecha_nacimiento' => $fecha,
                        'ubicacion_zona' => $zona,
                    ]);

                    // Cálculo Lógica de Negocio
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

            return redirect(route('dashboard'));

        } catch (\Exception $e) {
            // ESTO TE MUESTRA EL ERROR DE BASE DE DATOS
            dd('ERROR CRÍTICO DEL SISTEMA:', $e->getMessage()); 
        }
    }
}