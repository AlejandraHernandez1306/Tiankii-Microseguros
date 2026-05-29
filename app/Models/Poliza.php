<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model {
    use HasFactory;
    
    // PARA QUE SE GUARDE EL SALDO
    protected $fillable = ['user_id', 'nombre_plan', 'costo', 'cobertura', 'estado'];

    public function user() { return $this->belongsTo(User::class); }
}