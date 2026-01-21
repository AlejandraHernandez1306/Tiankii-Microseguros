<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    $paciente = $user->paciente; 

    $poliza = [
        'plan' => 'Plan Salud Rural (Básico)',
        'estado' => 'Activa',
        'cobertura' => '$500.00',
        'prima' => '$15.00/mes',
        'proximo_pago' => '15 Dic 2025'
    ];

    return view('dashboard', compact('user', 'paciente', 'poliza'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
