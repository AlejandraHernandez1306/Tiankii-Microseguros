<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poliza;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    public function index()
    {
        return view('medico.dashboard');
    }

    public function registrarAtencion(Request $request)
    {
        // Validación estricta
        $request->validate([
            'email_paciente' => 'required|email|exists:users,email',
            'diagnostico' => 'required|string',
            'receta' => 'required|string', // Ahora es obligatorio recetar
            'costo' => 'required|numeric|min:0',
        ]);

        $paciente = User::where('email', $request->email_paciente)->first();
        
        // Verificar que sea Rol Paciente
        if($paciente->rol !== 'paciente') {
            return back()->with('error', 'El usuario indicado no es un paciente.');
        }

        $poliza = Poliza::where('user_id', $paciente->id)->where('estado', 'activa')->first();

        if (!$poliza) {
            return back()->with('error', 'El paciente no tiene seguro activo.');
        }

        if ($poliza->cobertura < $request->costo) {
            return back()->with('error', 'FONDOS INSUFICIENTES. Saldo actual: $' . $poliza->cobertura);
        }

        // TRANSACCIÓN ATÓMICA (Técnico: Atomicidad)
        DB::transaction(function () use ($paciente, $poliza, $request) {
            // 1. Cobrar (Descuento)
            $poliza->cobertura -= $request->costo;
            $poliza->save();

            // 2. Generar Historial Clínico + Receta
            DB::table('atenciones')->insert([
                'paciente_user_id' => $paciente->id,
                'medico_user_id' => Auth::id(),
                'diagnostico' => $request->diagnostico,
                'receta' => $request->receta, // Guardamos la receta
                'costo' => $request->costo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return back()->with('success', 'Consulta registrada y Receta generada. Nuevo saldo: $' . number_format($poliza->cobertura, 2));
    }
}