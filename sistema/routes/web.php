<?php

use App\Models\Poliza; 
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // 1. Obtener el paciente (si existe)
    $paciente = $user->paciente; 

    // 2. OBTENER LA PÓLIZA REAL DE LA BD
    // Esto busca la primera póliza del usuario. Si no tiene, crea una vacía para que no de error.
    $poliza = $user->polizas()->first() ?? new Poliza([
        'nombre_plan' => 'Sin Plan Activo',
        'costo' => 0,
        'cobertura' => 0,
        'estado' => 'pendiente'
    ]);

    return view('dashboard', compact('user', 'paciente', 'poliza'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
