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
        // 1. VALIDACIÓN MANUAL (Para que veas el error si falla)
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dui' => ['required', 'string'], // Si esto falta en el HTML, aquí tronará
            'telefono' => ['required', 'string'],
            'fecha_nacimiento' => ['required', 'date'],
            'ubicacion_zona' => ['required'],
        ]);

        if ($validator->fails()) {
            // ESTO TE MOSTRARÁ EL ERROR EN PANTALLA NEGRA
            dd('ERROR DE VALIDACIÓN (Faltan datos en el form):', $validator->errors()->all());
        }

        // 2. LÓGICA DE NEGOCIO Y BD
        try {
            DB::transaction(function () use ($request) {
                
                // A. Crear Usuario (Encriptación Hash::make)
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'rol' => 'paciente',
                ]);

                // B. Crear Paciente (Relación 1:1)
                Paciente::create([
                    'user_id' => $user->id,
                    'dui' => $request->dui,
                    'telefono' => $request->telefono,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'ubicacion_zona' => $request->ubicacion_zona,
                ]);

                // C. CÁLCULO DE PRIMA (Lógica Core)
                $prima = 50.00;
                $edad = Carbon::parse($request->fecha_nacimiento)->age;
                
                // Lógica: +$1 por cada año arriba de 40
                if ($edad > 40) {
                    $prima += ($edad - 40);
                }
                // Lógica: +20% si es Rural
                if ($request->ubicacion_zona === 'Alto Riesgo') {
                    $prima *= 1.20;
                }

                // D. Crear Póliza (Relación 1:N)
                Poliza::create([
                    'user_id' => $user->id,
                    'nombre_plan' => 'Plan ' . $request->ubicacion_zona,
                    'costo' => $prima,
                    'cobertura' => 1000.00,
                    'estado' => 'activa'
                ]);

                event(new Registered($user));
                Auth::login($user);
            });

            return redirect(route('dashboard', absolute: false));

        } catch (\Exception $e) {
            dd('ERROR CRÍTICO DE BD:', $e->getMessage());
        }
    }
}