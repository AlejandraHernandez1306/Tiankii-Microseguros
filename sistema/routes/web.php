<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

// Página de inicio (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// LOGIN REDIRECTOR (El cerebro)
Route::get('/dashboard', function () {
    $user = Auth::user();

    // ESCENARIO 1: ES MÉDICO
    if ($user->rol === 'medico') {
        return redirect()->route('medico.panel');
    }

    // ESCENARIO 2: ES ADMIN
    if ($user->rol === 'admin') {
        return view('admin.dashboard'); // Crearemos esta vista simple abajo
    }

    // ESCENARIO 3: ES PACIENTE (Por defecto)
    // Carga datos vitales para que no dé error
    $paciente = $user->paciente;
    $poliza = $user->polizas()->where('estado', 'activa')->first();
    
    // Historial clínico (Fase 3)
    $historial = DB::table('atenciones')
                    ->where('paciente_user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

    return view('dashboard', compact('user', 'paciente', 'poliza', 'historial'));
})->middleware(['auth', 'verified'])->name('dashboard');

// RUTAS EXCLUSIVAS DE MÉDICO
Route::middleware('auth')->group(function () {
    Route::get('/medico', [MedicoController::class, 'index'])->name('medico.panel');
    Route::post('/medico/registrar', [MedicoController::class, 'registrarAtencion'])->name('medico.registrar');
});

// RUTAS DE PERFIL (Laravel Breeze Default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// RUTA CONTRATO (Extra)
Route::get('/contrato', function () {
    $user = Auth::user();
    if($user->rol !== 'paciente') return redirect('/dashboard');
    return view('contract', ['user' => $user, 'paciente' => $user->paciente, 'poliza' => $user->polizas->first()]);
})->middleware(['auth']);

require __DIR__.'/auth.php';