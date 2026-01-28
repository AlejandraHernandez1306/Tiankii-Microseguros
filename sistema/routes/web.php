<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Poliza;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Si el registro falló antes, esto evita que la pantalla se ponga blanca.
    // Usamos '??' para crear datos falsos en memoria si la base de datos está vacía.
    
    $paciente = $user->paciente ?? new Paciente([
        'ubicacion_zona' => 'Sin Zona',
        'id' => '---'
    ]);

    // Lógica para la Póliza (Requisito RF.2.0 del PDF)
    $poliza = $user->polizas()->where('estado', 'activa')->first() ?? new Poliza([
        'nombre_plan' => 'Plan Básico (No Activo)',
        'costo' => 0.00,
        'cobertura' => 0.00,
        'estado' => 'inactiva',
        'created_at' => now()
    ]);

    return view('dashboard', compact('user', 'paciente', 'poliza'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';