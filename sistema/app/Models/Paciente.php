<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    // Desactiva la protección contra escritura masiva
    // para que podamos guardar 'ubicacion_zona', 'telefono', etc.
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}