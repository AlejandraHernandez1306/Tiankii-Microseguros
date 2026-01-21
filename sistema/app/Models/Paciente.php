<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $guarded = []; // Permite asignación masiva de todo

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}