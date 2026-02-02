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
        // ADMIN
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'admin',
        ]);

        // MEDICO
        User::create([
            'name' => 'Medico',
            'email' => 'medico@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'medico',
        ]);

        // PACIENTE (Completo para que no falle el dashboard)
        $p = User::create([
            'name' => 'Alejandra',
            'email' => 'paciente@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'paciente',
        ]);
        
        Paciente::create([
            'user_id' => $p->id,
            'dui' => '12345678-9', 
            'telefono' => '7000-0000', 
            'fecha_nacimiento' => '2000-01-01', 
            'ubicacion_zona' => 'Urbana'
        ]);

        Poliza::create([
            'user_id' => $p->id, 
            'nombre_plan' => 'Plan Base', 
            'costo' => 50.00, 
            'cobertura' => 1000.00
        ]);
    }
}