<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

// --- DASHBOARD MODULAR CON PAGINACIÓN ---
Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) return redirect('/login');

    if ($user->rol === 'admin') {
        // CAMBIO: paginate(10) en vez de all()
        $users = User::paginate(10); 
        return view('admin.dashboard', compact('user', 'users')); 
    } 
    elseif ($user->rol === 'medico') {
        // CAMBIO: paginate(10) para pacientes
        $pacientes = User::where('rol', 'paciente')->paginate(10);
        return view('medico.dashboard', compact('user', 'pacientes'));
    } 
    else {
        return view('dashboard', compact('user'));
    }
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// RUTAS DE PERFIL
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/editar/{id}', function ($id) {
        if (Auth::user()->rol !== 'admin') return redirect('/dashboard');
        $usuario = User::with('paciente')->findOrFail($id);
        return view('admin.edit', compact('usuario'));
    })->name('admin.edit');

    Route::post('/admin/editar/{id}', function (\Illuminate\Http\Request $request, $id) {
        if (Auth::user()->rol !== 'admin') return redirect('/dashboard');
        $usuario = User::findOrFail($id);
        $usuario->update(['name' => $request->name, 'email' => $request->email, 'rol' => $request->rol]);
        
        // ALERTA DE ÉXITO (Requisito del jurado)
        return redirect('/dashboard')->with('success', 'Usuario actualizado correctamente.');
    })->name('admin.update');

    Route::delete('/admin/eliminar/{id}', function ($id) {
        if (Auth::user()->rol !== 'admin') return redirect('/dashboard');
        User::destroy($id);
        
        // ALERTA DE ÉXITO
        return back()->with('success', 'Usuario eliminado del sistema.');
    })->name('admin.destroy');
});

// MÉDICO
Route::middleware(['auth'])->group(function () {
    Route::post('/medico/registrar-consulta', function (\Illuminate\Http\Request $request) {
        if (Auth::user()->rol !== 'medico') return abort(403);
        
        // ... (Tu lógica de guardado sigue aquí) ...

        // ALERTA DE ÉXITO
        return back()->with('success', 'Consulta registrada y guardada en historial.');
    })->name('medico.registrar');

    Route::get('/medico/paciente/{id}', function ($id) {
        if (Auth::user()->rol !== 'medico') return redirect('/dashboard');
        $paciente = User::with(['paciente', 'polizas', 'atenciones'])->findOrFail($id);
        return view('medico.historial', compact('paciente'));
    })->name('medico.ver_historial');
});

Route::get('/api/paciente/{id}', function ($id) {
    return User::with('paciente', 'polizas')->find($id);
});