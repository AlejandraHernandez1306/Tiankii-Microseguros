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
        // 1. ADMIN (Gestión Total)
        User::firstOrCreate(
            ['email' => 'admin@tiankii.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'rol' => 'admin',
            ]
        );

        // 2. MÉDICO (Funciones: Consultas, Historial)
        User::firstOrCreate(
            ['email' => 'medico@tiankii.com'],
            [
                'name' => 'Dr. Especialista',
                'password' => Hash::make('password'),
                'rol' => 'medico',
            ]
        );

        // 3. PACIENTE (Funciones: Ver Póliza)
        $paciente = User::firstOrCreate(
            ['email' => 'paciente@tiankii.com'],
            [
                'name' => 'Paciente Demo',
                'password' => Hash::make('password'),
                'rol' => 'paciente',
            ]
        );

        // Datos vitales del paciente 
        $pacienteData = Paciente::firstOrCreate(
            ['user_id' => $paciente->id],
            [
                'dui' => '00000000-0',
                'telefono' => '7000-0000',
                'fecha_nacimiento' => '1990-01-01',
                'ubicacion_zona' => 'Alto Riesgo'
            ]
        );

        Poliza::firstOrCreate(
            ['user_id' => $paciente->id],
            [
                'nombre_plan' => 'Plan Rural',
                'costo' => 60.00,
                'cobertura' => 1000.00,
                'estado' => 'activa'
            ]
        );
    }
}