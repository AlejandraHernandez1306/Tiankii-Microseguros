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
            'costo' => 'required|numeric|min:1',
        ]);

        $paciente = User::where('email', $request->email_paciente)->first();
        
        // Buscar póliza activa del paciente
        $poliza = Poliza::where('user_id', $paciente->id)->where('estado', 'activa')->first();

        if (!$poliza) {
            return back()->with('error', 'El paciente no tiene una póliza activa.');
        }

        if ($poliza->cobertura < $request->costo) {
            return back()->with('error', 'SALDO INSUFICIENTE. Cobertura disponible: $' . $poliza->cobertura);
        }

        // TRANSACCIÓN: Descuento y Registro (Inspirado en PDF API-Laravel)
        DB::transaction(function () use ($paciente, $poliza, $request) {
            // 1. Descontar dinero de la póliza
            $poliza->cobertura -= $request->costo;
            $poliza->save();

            // 2. Guardar historial (Usamos DB directo para ahorrar tiempo de crear modelo Atencion)
            DB::table('atenciones')->insert([
                'paciente_user_id' => $paciente->id,
                'medico_user_id' => Auth::id(),
                'diagnostico' => $request->diagnostico,
                'costo' => $request->costo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return back()->with('success', 'Consulta registrada. Nuevo saldo póliza: $' . $poliza->cobertura);
    }
}