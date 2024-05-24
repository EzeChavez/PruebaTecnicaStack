<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;
    protected $fillable = [
        'consulta_id', 'id_pregunta', 'titulo', 'cuerpo', 'enlace'
    ];
    public function preguntas()
{
    
    return $this->hasMany(Pregunta::class);
    
}
}
