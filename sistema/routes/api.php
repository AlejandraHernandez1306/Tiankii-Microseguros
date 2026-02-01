<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Poliza;

// Endpoint Público: Consultar estado de póliza por email del paciente
// Ejemplo de uso en Postman: GET http://tiankii.test/api/consulta-poliza?email=paciente@tiankii.com
Route::get('/consulta-poliza', function (Request $request) {
    $email = $request->query('email');
    
    if (!$email) {
        return response()->json(['error' => 'Email requerido'], 400);
    }

    $usuario = User::where('email', $email)->first();

    if (!$usuario) {
        return response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    // Usamos la relación que ya definiste en tus modelos
    $poliza = Poliza::where('user_id', $usuario->id)->where('estado', 'activa')->first();

    if (!$poliza) {
        return response()->json([
            'paciente' => $usuario->name,
            'estado' => 'Sin Póliza Activa'
        ]);
    }

    return response()->json([
        'paciente' => $usuario->name,
        'plan' => $poliza->nombre_plan,
        'cobertura_restante' => $poliza->cobertura,
        'status' => 'ACTIVO',
        'mensaje' => 'Listo para atención médica (Fase 3)'
        //todavia falta
    ]);
});