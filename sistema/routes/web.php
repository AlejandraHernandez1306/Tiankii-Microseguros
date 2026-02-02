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

// RUTA DE EDICIÓN DE USUARIOS (SOLO ADMIN)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/editar/{id}', function ($id) {
        if (Auth::user()->rol !== 'admin') return redirect('/dashboard');
        $usuario = \App\Models\User::with('paciente')->findOrFail($id);
        return view('admin.edit', compact('usuario'));
    })->name('admin.edit');

    Route::post('/admin/editar/{id}', function (\Illuminate\Http\Request $request, $id) {
        if (Auth::user()->rol !== 'admin') return redirect('/dashboard');
        $usuario = \App\Models\User::findOrFail($id);
        
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol
        ]);

        // Si es paciente y cambiamos su zona, actualizamos también
        if ($usuario->paciente && $request->has('ubicacion_zona')) {
            $usuario->paciente->update(['ubicacion_zona' => $request->ubicacion_zona]);
        }

        return redirect('/dashboard')->with('success', 'Usuario actualizado con autoridad.');
    })->name('admin.update');
});

// RUTAS MÉDICO AVANZADO
Route::middleware(['auth'])->group(function () {
    // Ver Historial
    Route::get('/medico/paciente/{id}', function ($id) {
        if (Auth::user()->rol !== 'medico') return redirect('/dashboard');
        $paciente = \App\Models\User::with(['paciente', 'polizas', 'atenciones'])->findOrFail($id);
        return view('medico.historial', compact('paciente'));
    })->name('medico.ver_historial');

    // Cambiar Estado Póliza (Activo/Inactivo)
    Route::post('/medico/toggle-poliza/{id}', function ($id) {
        if (Auth::user()->rol !== 'medico') return abort(403);
        $poliza = \App\Models\Poliza::where('user_id', $id)->first();
        if ($poliza) {
            $poliza->estado = ($poliza->estado === 'activa') ? 'cancelada' : 'activa';
            $poliza->save();
        }
        return back()->with('success', 'Estado de la póliza actualizado.');
    })->name('medico.toggle_poliza');
});