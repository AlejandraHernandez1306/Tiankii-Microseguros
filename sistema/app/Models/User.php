<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol', // <--- ESTO FALTABA. SIN ESTO, NO GUARDA SI ERES MÉDICO O PACIENTE.
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

    // Relaciones (Para modularidad y lógica de negocio)
    public function paciente() {
        return $this->hasOne(Paciente::class);
    }

    public function polizas() {
        return $this->hasMany(Poliza::class);
    }

    public function atenciones() {
        return $this->hasMany(Atencion::class, 'paciente_user_id');
    }
}