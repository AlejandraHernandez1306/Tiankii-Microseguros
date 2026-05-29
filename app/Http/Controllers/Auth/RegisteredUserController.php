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
            'rol' => ['required', 'in:paciente,medico'], // Obliga a que venga el rol
        ]);

        if ($validator->fails()) {
            
            dd('ERROR DE VALIDACIÓN (Faltan datos):', $validator->errors()->all(), 'DATOS RECIBIDOS:', $request->all());
        }

        try {
            DB::transaction(function () use ($request) {
                
                // 2. CREAR USUARIO 
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'rol' => $request->rol,
                ]);

                // 3. LÓGICA DE PACIENTE (Solo si es paciente)
                if ($request->rol === 'paciente') {
                    
                    // Valores por defecto para evitar errores si el formulario HTML falla
                    $fecha = $request->fecha_nacimiento ?? '2000-01-01';
                    $zona = $request->ubicacion_zona ?? 'Bajo Riesgo';
                    
                    Paciente::create([
                        'user_id' => $user->id,
                        'dui' => $request->dui ?? 'PENDIENTE-' . time(),
                        'telefono' => $request->telefono ?? '0000-0000',
                        'fecha_nacimiento' => $fecha,
                        'ubicacion_zona' => $zona,
                    ]);

                    // --- LÓGICA DE NEGOCIO (CÁLCULO DE PRIMA) ---
                    $prima = 50.00;
                    $edad = Carbon::parse($fecha)->age;
                    
                    // Lógica: +$1 por año arriba de 40
                    if ($edad > 40) $prima += ($edad - 40);
                    // Lógica: +20% si es Rural
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
            
            dd("ERROR CRÍTICO:", $e->getMessage());
        }
    }
}