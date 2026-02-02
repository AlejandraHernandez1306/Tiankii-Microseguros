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

    public function store(Request $request): RedirectResponse
    {
        // 1. VALIDACIÓN GENERAL (Nombre, Email, Pass)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'rol' => ['required', 'in:paciente,medico'], // Validamos que el rol sea válido
        ]);

        // 2. VALIDACIÓN ESPECÍFICA (Dependiendo del Rol)
        if ($request->rol === 'paciente') {
            $request->validate([
                'dui' => ['required', 'string'],
                'telefono' => ['required'],
                'fecha_nacimiento' => ['required', 'date'],
            ]);
        } elseif ($request->rol === 'medico') {
            $request->validate([
                'jvpm' => ['required', 'string'], // Validación especial para médico
            ]);
        }

        DB::transaction(function () use ($request) {
            
            // A. CREAR USUARIO MAESTRO
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => $request->rol, // Guardamos si es médico o paciente
            ]);

            // B. SI ES PACIENTE -> CREAR PERFIL Y SEGURO
            if ($request->rol === 'paciente') {
                Paciente::create([
                    'user_id' => $user->id,
                    'dui' => $request->dui,
                    'telefono' => $request->telefono,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'ubicacion_zona' => $request->ubicacion_zona,
                ]);

                // Lógica de Precios
                $prima = 50.00;
                $edad = Carbon::parse($request->fecha_nacimiento)->age;
                if ($edad > 40) $prima += ($edad - 40);
                if ($request->ubicacion_zona === 'Alto Riesgo') $prima *= 1.20;

                Poliza::create([
                    'user_id' => $user->id,
                    'nombre_plan' => 'Plan ' . $request->ubicacion_zona,
                    'costo' => $prima,
                    'cobertura' => 1000.00,
                    'estado' => 'activa'
                ]);
            }
            
            // C. SI ES MÉDICO -> (Opcional: Podrías crear una tabla 'medicos' con el JVPM, 
            // pero para no complicarte, solo guardamos el usuario con rol 'medico')

            event(new Registered($user));
            Auth::login($user);
        });

        // Redirección inteligente al Dashboard
        return redirect(route('dashboard', absolute: false));
    }
}