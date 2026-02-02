<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * 
     * Al agregar 'rol' aquí, Laravel dejará de borrarlo silenciosamente.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- RELACIONES (LO QUE PIDIÓ EL JURADO) ---
    // 1 a 1: Usuario -> Paciente
    public function paciente() {
        return $this->hasOne(Paciente::class);
    }

    // 1 a Muchos: Usuario -> Pólizas (Historial)
    public function polizas() {
        return $this->hasMany(Poliza::class);
    }

    // 1 a Muchos: Médico -> Atenciones
    public function atenciones_medicas() {
        return $this->hasMany(Atencion::class, 'medico_user_id');
    }
}