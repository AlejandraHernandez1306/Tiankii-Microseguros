<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

// LÓGICA DE DIRECCIONAMIENTO DEL DASHBOARD
Route::get('/dashboard', function () {
    $user = Auth::user();

    // 1. Si es MÉDICO -> Mándalo a su carpeta especial
    if ($user->rol === 'medico') {
        return redirect()->route('medico.panel');
    }

    // 2. Si es ADMIN -> Mándalo a su carpeta (o vista simple)
    if ($user->rol === 'admin') {
        return view('admin.dashboard');
    }

    // 3. Si es PACIENTE -> Carga sus datos y muestra su dashboard
    $paciente = $user->paciente;
    // Prevenir error si no tiene póliza (para usuarios nuevos)
    $poliza = $user->polizas()->where('estado', 'activa')->first();
    
    // Historial
    $historial = DB::table('atenciones')
                    ->where('paciente_user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

    return view('dashboard', compact('user', 'paciente', 'poliza', 'historial'));
})->middleware(['auth', 'verified'])->name('dashboard');

// RUTA DEL CONTRATO (Solo pacientes)
Route::get('/contrato', function () {
    $user = Auth::user();
    if($user->rol !== 'paciente') return redirect('/dashboard');
    
    return view('contract', [
        'user' => $user, 
        'paciente' => $user->paciente, 
        'poliza' => $user->polizas->first()
    ]);
})->middleware(['auth'])->name('contrato');

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