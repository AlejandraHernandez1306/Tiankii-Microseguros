<?php

use App\Models\User;
use App\Models\Paciente;
use App\Models\Poliza; // Asegúrate de importar esto
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Intenta buscar el paciente, si no existe, crea un objeto vacío para no romper la vista
    $paciente = $user->paciente ?? new Paciente([
        'ubicacion_zona' => 'No Definida',
        'id' => 'Pendiente'
    ]);

    // LÓGICA DE SEGURIDAD PARA LA DEMO:
    // Intenta buscar una póliza real en la BD.
    // Si NO existe, crea una "en el aire" (new Poliza) para que la tarjeta se vea bonita y no dé error.
    $poliza = $user->polizas()->first() ?? new Poliza([
        'nombre_plan' => 'Plan Básico (Demo)',
        'costo' => 15.00,
        'cobertura' => 500.00,
        'estado' => 'activa',
        'created_at' => now()
    ]);

    return view('dashboard', compact('user', 'paciente', 'poliza'));
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';