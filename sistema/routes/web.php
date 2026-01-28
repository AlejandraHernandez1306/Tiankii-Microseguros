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

Route::get('/prueba', function () {
    try {
        // Prueba de conexión y usuario
        $user = Auth::user();
        return "<h1>Sistema Tiankii Operativo</h1>" .
               "<p>Usuario: " . ($user ? $user->name : 'No logueado') . "</p>" .
               "<p>Base de Datos: Conectada</p>";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// RUTA DE EMERGENCIA - SOLO PARA PRUEBAS
Route::get('/debug', function () {
    $user = Illuminate\Support\Facades\Auth::user();
    if (!$user) {
        return "<h1>ESTADO: NO LOGUEADO</h1><p>El usuario no ha iniciado sesión.</p>";
    }
    
    // Intentar cargar la póliza
    $poliza = $user->polizas()->first();
    
    return "<h1>ESTADO: LOGUEADO CON ÉXITO</h1>" .
           "<h2>Usuario: " . $user->name . " (" . $user->rol . ")</h2>" .
           "<h3>Datos de Póliza en Base de Datos:</h3>" .
           "<pre>" . json_encode($poliza, JSON_PRETTY_PRINT) . "</pre>" .
           "<br><a href='/dashboard'>Intentar ir al Dashboard</a>";
});

require __DIR__.'/auth.php';