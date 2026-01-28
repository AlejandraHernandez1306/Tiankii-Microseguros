<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicoController; // Importar el nuevo controlador
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Poliza;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD INTELIGENTE (Redirecciona según rol)
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Si es médico, lo mandamos a su panel especial
    if ($user->rol === 'medico') {
        return redirect()->route('medico.panel');
    }

    // Si es paciente, mostramos su dashboard normal con historial
    $paciente = $user->paciente;
    $poliza = $user->polizas()->where('estado', 'activa')->first();
    
    // Obtener historial de atenciones (FASE 3 - HISTORIAL REAL)
    $historial = DB::table('atenciones')
                    ->where('paciente_user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

    return view('dashboard', compact('user', 'paciente', 'poliza', 'historial'));
})->middleware(['auth', 'verified'])->name('dashboard');

// RUTAS DEL MÉDICO
Route::middleware('auth')->group(function () {
    Route::get('/medico', [MedicoController::class, 'index'])->name('medico.panel');
    Route::post('/medico/registrar', [MedicoController::class, 'registrarAtencion'])->name('medico.registrar');
});

// RUTAS DE PERFIL
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';