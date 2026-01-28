<?php

use App\Models\Poliza;
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    $user = Auth::user();
    $paciente = $user->paciente;
    
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
