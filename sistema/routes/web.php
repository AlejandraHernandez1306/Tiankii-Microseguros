<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// 1. PÁGINA DE INICIO
Route::get('/', function () {
    return view('welcome');
});

// 2. DASHBOARD INTELIGENTE (Redirección por Rol)
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->rol === 'admin') {
        return view('admin.dashboard', compact('user')); 
    } 
    elseif ($user->rol === 'medico') {
        return view('medico.dashboard', compact('user'));
    } 
    else {
        return view('dashboard', compact('user'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. RUTAS DE AUTENTICACIÓN (Login, Register, Logout)
require __DIR__.'/auth.php';

// 4. RUTAS DE PERFIL (¡ESTAS FALTABAN Y CAUSABAN EL ERROR!)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 5. RUTAS DE ADMIN
Route::middleware(['auth'])->group(function () {
    // Editar Usuario
    Route::get('/admin/editar/{id}', function ($id) {
        if (Auth::user()->rol !== 'admin') return redirect('/dashboard');
        $usuario = User::with('paciente')->findOrFail($id);
        return view('admin.edit', compact('usuario'));
    })->name('admin.edit');

    Route::post('/admin/editar/{id}', function (\Illuminate\Http\Request $request, $id) {
        if (Auth::user()->rol !== 'admin') return redirect('/dashboard');
        $usuario = User::findOrFail($id);
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol
        ]);
        if ($usuario->paciente && $request->has('ubicacion_zona')) {
            $usuario->paciente->update(['ubicacion_zona' => $request->ubicacion_zona]);
        }
        return redirect('/dashboard');
    })->name('admin.update');

    // Eliminar Usuario
    Route::delete('/admin/eliminar/{id}', function ($id) {
        if (Auth::user()->rol !== 'admin') return redirect('/dashboard');
        User::destroy($id);
        return back();
    })->name('admin.destroy');
});

// 6. RUTAS DE MÉDICO
Route::middleware(['auth'])->group(function () {
    // Registrar Consulta (La que daba error antes)
    Route::post('/medico/registrar-consulta', function (\Illuminate\Http\Request $request) {
        if (Auth::user()->rol !== 'medico') return abort(403);
        
        $request->validate(['email_paciente' => 'required|exists:users,email']);
        $paciente = User::where('email', $request->email_paciente)->first();

        \App\Models\Atencion::create([
            'paciente_user_id' => $paciente->id,
            'medico_user_id' => Auth::id(),
            'diagnostico' => $request->diagnostico,
            'receta' => $request->receta,
            'costo_total' => $request->costo,
            'monto_cubierto' => $request->costo * 0.8,
            'copago_paciente' => $request->costo * 0.2
        ]);
        return back()->with('success', 'Consulta registrada');
    })->name('medico.registrar');

    // Ver Historial
    Route::get('/medico/paciente/{id}', function ($id) {
        if (Auth::user()->rol !== 'medico') return redirect('/dashboard');
        $paciente = User::with(['paciente', 'polizas', 'atenciones'])->findOrFail($id);
        return view('medico.historial', compact('paciente'));
    })->name('medico.ver_historial'); // Nombre corregido para coincidir con tu vista

    // Activar Póliza
    Route::post('/medico/toggle-poliza/{id}', function ($id) {
        if (Auth::user()->rol !== 'medico') return abort(403);
        $poliza = \App\Models\Poliza::where('user_id', $id)->first();
        if($poliza) {
            $poliza->estado = ($poliza->estado === 'activa') ? 'cancelada' : 'activa';
            $poliza->save();
        }
        return back();
    })->name('medico.toggle_poliza');
});

// 7. API
Route::get('/api/paciente/{id}', function ($id) {
    return User::with('paciente', 'polizas')->find($id);
});