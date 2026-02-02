<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Paciente;
use App\Models\Poliza;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ADMIN (Usa firstOrCreate para no duplicar)
        User::firstOrCreate(
            ['email' => 'admin@tiankii.com'], // Busca por este email
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'rol' => 'admin',
            ]
        );

        // 2. MÉDICO
        User::firstOrCreate(
            ['email' => 'medico@tiankii.com'],
            [
                'name' => 'Medico General',
                'password' => Hash::make('password'),
                'rol' => 'medico',
            ]
        );

        // 3. PACIENTE DEMO
        $pacienteUser = User::firstOrCreate(
            ['email' => 'paciente@tiankii.com'],
            [
                'name' => 'Paciente Demo',
                'password' => Hash::make('password'),
                'rol' => 'paciente',
            ]
        );

        // Crear datos del paciente SOLO si no existen
        if (!Paciente::where('user_id', $pacienteUser->id)->exists()) {
            Paciente::create([
                'user_id' => $pacienteUser->id,
                'dui' => '88888888-8',
                'telefono' => '7777-7777',
                'fecha_nacimiento' => '1990-01-01',
                'ubicacion_zona' => 'Alto Riesgo'
            ]);

            Poliza::create([
                'user_id' => $pacienteUser->id,
                'nombre_plan' => 'Plan Rural',
                'costo' => 60.00,
                'cobertura' => 1000.00,
                'estado' => 'activa'
            ]);
        }
    }
}