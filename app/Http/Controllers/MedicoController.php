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
        $request->validate([
            'email_paciente' => 'required|email|exists:users,email',
            'diagnostico' => 'required|string',
            'receta' => 'required|string',
            'costo' => 'required|numeric|min:1',
        ]);

        $paciente = User::where('email', $request->email_paciente)->first();
        
        // Verificar Póliza Activa (RF.4.0)
        $poliza = Poliza::where('user_id', $paciente->id)->where('estado', 'activa')->first();

        if (!$poliza) {
            return back()->with('error', 'El paciente no tiene cobertura activa.');
        }

        // LÓGICA DE DESCUENTO (RF.4.2)
        $costoTotal = $request->costo;
        $montoCubierto = $costoTotal * 0.80; // El seguro cubre el 80%
        $copago = $costoTotal * 0.20;       // El paciente paga el 20%

        // Validar fondos suficientes
        if ($poliza->cobertura < $montoCubierto) {
            return back()->with('error', 'COBERTURA INSUFICIENTE. Saldo disponible: $' . $poliza->cobertura);
        }

        // Ejecutar Transacción
        DB::transaction(function () use ($paciente, $poliza, $request, $costoTotal, $montoCubierto, $copago) {
            // 1. Descontar solo lo cubierto
            $poliza->cobertura -= $montoCubierto;
            $poliza->save();

            // 2. Registrar Atención con detalle financiero
            DB::table('atenciones')->insert([
                'paciente_user_id' => $paciente->id,
                'medico_user_id' => Auth::id(),
                'diagnostico' => $request->diagnostico,
                'receta' => $request->receta,
                'costo_total' => $costoTotal,
                'monto_cubierto' => $montoCubierto,
                'copago_paciente' => $copago,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return back()->with('success', 
            "Atención registrada. Costo Total: $$costoTotal. " .
            "Seguro cubrió (80%): $$montoCubierto. " .
            "Paciente paga (20%): $$copago."
        );
    }
}