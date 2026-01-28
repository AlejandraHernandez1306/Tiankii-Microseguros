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

    // RELACIÓN 1: Un usuario tiene UN perfil de paciente
    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

    // RELACIÓN 2: Un usuario tiene MUCHAS pólizas (Requisito Técnico)
    public function polizas()
    {
        return $this->hasMany(Poliza::class);
    }
}