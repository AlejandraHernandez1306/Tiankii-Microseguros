<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Atencion;

Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD CENTRAL (Con lógica de roles y paginación)
Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) return redirect('/login');

    if ($user->rol === 'admin') {
        $users = User::paginate(10); // Paginación Admin
        return view('admin.dashboard', compact('user', 'users')); 
    } 
    elseif ($user->rol === 'medico') {
        $pacientes = User::where('rol', 'paciente')->paginate(10); // Paginación Médico
        return view('medico.dashboard', compact('user', 'pacientes'));
    } 
    else {
        // PACIENTE: Traemos su historial ordenado
        $misAtenciones = Atencion::where('paciente_user_id', $user->id)
                                 ->with('medico')
                                 ->latest()
                                 ->get();
        return view('dashboard', compact('user', 'misAtenciones'));
    }
})->middleware(['auth'])->name('dashboard'); // <--- SIN BLOQUEO VERIFIED

require __DIR__.'/auth.php';

// RUTAS PERFIL
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// RUTAS ADMIN
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
        return redirect('/dashboard')->with('success', 'Usuario actualizado correctamente.');
    })->name('admin.update');

    Route::delete('/admin/eliminar/{id}', function ($id) {
        if (Auth::user()->rol !== 'admin') return redirect('/dashboard');
        User::destroy($id);
        return back()->with('success', 'Usuario eliminado.');
    })->name('admin.destroy');
});

// RUTAS MÉDICO
Route::middleware(['auth'])->group(function () {
    Route::post('/medico/registrar-consulta', function (\Illuminate\Http\Request $request) {
        if (Auth::user()->rol !== 'medico') return abort(403);
        
        $request->validate(['email_paciente' => 'required|exists:users,email']);
        $paciente = User::where('email', $request->email_paciente)->first();

        Atencion::create([
            'paciente_user_id' => $paciente->id,
            'medico_user_id' => Auth::id(),
            'diagnostico' => $request->diagnostico,
            'receta' => $request->receta,
            'costo_total' => $request->costo,
            'monto_cubierto' => $request->costo * 0.8,
            'copago_paciente' => $request->costo * 0.2
        ]);
        return back()->with('success', 'Consulta y Receta guardadas con éxito.');
    })->name('medico.registrar');

    Route::get('/medico/paciente/{id}', function ($id) {
        if (Auth::user()->rol !== 'medico') return redirect('/dashboard');
        $paciente = User::with(['paciente', 'polizas', 'atenciones'])->findOrFail($id);
        return view('medico.historial', compact('paciente'));
    })->name('medico.ver_historial');
});

// RUTAS DE DOCUMENTOS (PDFs y Contratos)
Route::get('/contrato', function () {
    return view('contract');
})->middleware(['auth'])->name('contrato.ver');

Route::get('/receta/{id}', function ($id) {
    $atencion = Atencion::with(['medico', 'paciente'])->findOrFail($id);
    if(Auth::id() !== $atencion->paciente_user_id && Auth::user()->rol !== 'medico') abort(403);
    return view('receta_pdf', compact('atencion'));
})->middleware(['auth'])->name('receta.imprimir');