<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model {
    use HasFactory;
    
    // PROTECCIÓN: Solo dejamos guardar estos campos
    protected $fillable = ['user_id', 'telefono', 'fecha_nacimiento', 'ubicacion_zona'];

    public function user() { return $this->belongsTo(User::class); }
}