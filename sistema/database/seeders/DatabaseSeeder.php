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
            'name' => 'Admin Tiankii',
            'email' => 'admin@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'admin',
        ]);

        // MEDICO
        User::create([
            'name' => 'Medico General',
            'email' => 'medico@tiankii.com',
            'password' => Hash::make('password'),
            'rol' => 'medico',
        ]);
    }
}