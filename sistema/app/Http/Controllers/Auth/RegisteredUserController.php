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
        // 1. DEBUG: Ver qué datos llegan (Si ves esto en pantalla, el formulario sí envía)
        // dd($request->all()); // Descomenta esto si quieres ver los datos crudos

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Estos son los nuevos, si faltan en el HTML, aquí fallará
            'dui' => ['required', 'string'], 
            'telefono' => ['required', 'string'],
            'fecha_nacimiento' => ['required', 'date'],
            'ubicacion_zona' => ['required'],
        ]);

        if ($validator->fails()) {
            // ¡AQUÍ ESTÁ EL CHIVATO!
            // Si falla, te mostrará una pantalla negra con los errores.
            dd('FALLÓ LA VALIDACIÓN:', $validator->errors()->all());
        }

        // 2. Si pasa la validación, intenta guardar
        try {
            DB::transaction(function () use ($request) {
                
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'rol' => 'paciente',
                ]);

                Paciente::create([
                    'user_id' => $user->id,
                    'dui' => $request->dui,
                    'telefono' => $request->telefono,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'ubicacion_zona' => $request->ubicacion_zona,
                ]);

                // Lógica del PDF (Precios)
                $prima = 50.00;
                $edad = Carbon::parse($request->fecha_nacimiento)->age;
                if ($edad > 40) $prima += ($edad - 40);
                if ($request->ubicacion_zona === 'Alto Riesgo') $prima *= 1.2;

                Poliza::create([
                    'user_id' => $user->id,
                    'nombre_plan' => 'Microseguro ' . $request->ubicacion_zona,
                    'costo' => $prima,
                    'cobertura' => 1000.00,
                    'estado' => 'activa'
                ]);

                event(new Registered($user));
                Auth::login($user);
            });

            return redirect(route('dashboard', absolute: false));

        } catch (\Exception $e) {
            // Si falla la Base de Datos, te mostrará esto:
            dd('ERROR DE BASE DE DATOS:', $e->getMessage());
        }
    }
}