<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    use HasFactory;

    // Especificamos la tabla para evitar confusiones
    protected $table = 'atenciones_medicas';

    protected $fillable = [
        'paciente_user_id',
        'medico_user_id',
        'diagnostico',
        'receta',
        'costo_total',
        'monto_cubierto',
        'copago_paciente',
    ];

    // Relación: Una atención pertenece a un Paciente
    public function paciente() {
        return $this->belongsTo(User::class, 'paciente_user_id');
    }

    // Relación: Una atención la hizo un Médico
    public function medico() {
        return $this->belongsTo(User::class, 'medico_user_id');
    }
}