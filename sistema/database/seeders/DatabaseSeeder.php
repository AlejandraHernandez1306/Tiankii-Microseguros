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
        // 1. USUARIO PACIENTE (Para demostrar el Dashboard)
        $paciente = User::create([
            'name' => 'Alejandra Paciente',
            'email' => 'paciente@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'paciente',
        ]);
        
        Paciente::create([
            'user_id' => $paciente->id,
            'telefono' => '7777-7777',
            'fecha_nacimiento' => '2000-01-01',
            'ubicacion_zona' => 'Rural',
        ]);

        Poliza::create([
            'user_id' => $paciente->id,
            'nombre_plan' => 'Plan Semilla Rural',
            'costo' => 5.00,
            'cobertura' => 500.00,
            'estado' => 'activa'
        ]);

        // 2. USUARIO MÉDICO (Para demostrar Aceptar/Rechazar y Cobros)
        User::create([
            'name' => 'Dr. Especialista',
            'email' => 'medico@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'medico',
        ]);

        // 3. USUARIO ADMIN (Tercer Rol)
        User::create([
            'name' => 'Administrador Tiankii',
            'email' => 'admin@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'admin',
        ]);
    }
}