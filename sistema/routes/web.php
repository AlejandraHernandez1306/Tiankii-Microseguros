<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

Route::get('/', function () { return view('welcome'); });

// DASHBOARD
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Redirección por ROL
    if ($user->rol === 'medico') return redirect()->route('medico.panel');
    if ($user->rol === 'admin') return "<h1>Panel Admin (En construcción)</h1>";

    // Panel Paciente
    $paciente = $user->paciente;
    $poliza = $user->polizas()->where('estado', 'activa')->first();
    $historial = DB::table('atenciones')->where('paciente_user_id', $user->id)->get();

    return view('dashboard', compact('user', 'paciente', 'poliza', 'historial'));
})->middleware(['auth', 'verified'])->name('dashboard');

// CONTRATO REAL (Nueva Ruta)
Route::get('/contrato', function () {
    $user = Auth::user();
    $paciente = $user->paciente;
    $poliza = $user->polizas()->first();
    return view('contract', compact('user', 'paciente', 'poliza'));
})->middleware(['auth'])->name('contrato');

// RUTAS MÉDICO
Route::middleware('auth')->group(function () {
    Route::get('/medico', [MedicoController::class, 'index'])->name('medico.panel');
    Route::post('/medico/registrar', [MedicoController::class, 'registrarAtencion'])->name('medico.registrar');
});

require __DIR__.'/auth.php';