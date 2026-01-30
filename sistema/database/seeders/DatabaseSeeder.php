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
        // 1. DEMO PACIENTE: "Alejandra"
        // Este usuario tendrá saldo, póliza y datos listos.
        $paciente = User::create([
            'name' => 'Alejandra Paciente',
            'email' => 'paciente@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'paciente',
        ]);
        
        // Crear su ficha médica
        Paciente::create([
            'user_id' => $paciente->id,
            'telefono' => '7000-0001',
            'fecha_nacimiento' => '1995-05-20',
            'ubicacion_zona' => 'Rural',
        ]);

        // Crear su póliza con $500 de saldo
        Poliza::create([
            'user_id' => $paciente->id,
            'nombre_plan' => 'Plan Semilla Rural',
            'costo' => 5.00,
            'cobertura' => 500.00,
            'estado' => 'activa'
        ]);

        // 2. DEMO MÉDICO: "Dr. Tiankii"
        // Este usuario verá el panel verde de doctores.
        User::create([
            'name' => 'Dr. Especialista',
            'email' => 'medico@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'medico',
        ]);

        // 3. DEMO ADMIN: "Super Usuario"
        // Este usuario verá el control total (o mensaje de construcción).
        User::create([
            'name' => 'Admin Tiankii',
            'email' => 'admin@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'admin',
        ]);
    }
}