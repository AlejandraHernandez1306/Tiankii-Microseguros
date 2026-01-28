<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poliza extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relación Inversa
    public function user() {
        return $this->belongsTo(User::class);
    }
}