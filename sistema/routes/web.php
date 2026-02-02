<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () { return view('welcome'); });

// --- DASHBOARD CENTRAL 
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->rol === 'admin') return view('admin.dashboard', compact('user'));
    if ($user->rol === 'medico') return view('medico.dashboard', compact('user'));
    return view('dashboard', compact('user'));
})->middleware(['auth'])->name('dashboard'); // <--- SIN 'VERIFIED'

require __DIR__.'/auth.php';

// RUTAS MEDICO (Restauradas)
Route::middleware(['auth'])->group(function () {
    Route::post('/medico/registrar-consulta', function (\Illuminate\Http\Request $request) {
        if (Auth::user()->rol !== 'medico') return abort(403);
        
        return back()->with('success', 'Consulta Guardada'); 
    })->name('medico.registrar');
    
    Route::get('/medico/historial/{id}', function($id) {
         return "Historial del paciente " . $id; 
    })->name('medico.ver_historial');
});

// RUTAS ADMIN (Restauradas)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/editar/{id}', function($id) { return "Editar " . $id; })->name('admin.edit');
    Route::delete('/admin/borrar/{id}', function($id) { return back(); })->name('admin.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});