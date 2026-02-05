<?php

namespace App\Models;

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

    public function paciente() {
        return $this->hasOne(Paciente::class);
    }

    public function polizas() {
        return $this->hasMany(Poliza::class);
    }

    // ESTO FALTABA PARA EL HISTORIAL
    public function atenciones() {
        return $this->hasMany(Atencion::class, 'paciente_user_id');
    }
}