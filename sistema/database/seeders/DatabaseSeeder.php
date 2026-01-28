<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

$user = \App\Models\User::factory()->create([
    'name' => 'Alejandra Demo',
    'email' => 'admin@tiankii.com',
    'password' => bcrypt('password'),
    'rol' => 'paciente'
]);

// Crea el perfil médico
\App\Models\Paciente::create([
    'user_id' => $user->id,
    'telefono' => '7000-0000',
    'fecha_nacimiento' => '2000-01-01',
    'ubicacion_zona' => 'Rural'
]);

// Crea una póliza real en BD
\App\Models\Poliza::create([
    'user_id' => $user->id,
    'nombre_plan' => 'Plan Semilla Rural',
    'costo' => 15.00,
    'cobertura' => 500.00,
    'estado' => 'activa'
]);
    }
}
