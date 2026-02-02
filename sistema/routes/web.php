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

// DASHBOARD
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->rol === 'medico') {
        return redirect()->route('medico.panel');
    }
    if ($user->rol === 'admin') {
        return view('admin.dashboard');
    }

    $paciente = $user->paciente;
    $poliza = $user->polizas()->where('estado', 'activa')->first();
    $historial = DB::table('atenciones')->where('paciente_user_id', $user->id)->orderByDesc('created_at')->get();

    return view('dashboard', compact('user', 'paciente', 'poliza', 'historial'));
})->middleware(['auth', 'verified'])->name('dashboard');

// CONTRATO
Route::get('/contrato', function () {
    $user = Auth::user();
    if($user->rol !== 'paciente') return redirect('/dashboard');
    return view('contract', ['user' => $user, 'paciente' => $user->paciente, 'poliza' => $user->polizas->first()]);
})->middleware(['auth'])->name('contrato');

// MÉDICO
Route::middleware('auth')->group(function () {
    Route::get('/medico', [MedicoController::class, 'index'])->name('medico.panel');
    Route::post('/medico/registrar', [MedicoController::class, 'registrarAtencion'])->name('medico.registrar');
});

// PERFIL
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/api/usuario/{id}', function($id) {
    return \App\Models\User::with('polizas')->find($id);
});