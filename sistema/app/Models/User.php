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
        'rol', // <--- Permite guardar si es paciente o admin
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

    // RELACIÓN 1: Usuario -> Paciente
    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

    // RELACIÓN 2: Usuario -> Pólizas 
    public function polizas()
    {
        return $this->hasMany(Poliza::class);
    }
}