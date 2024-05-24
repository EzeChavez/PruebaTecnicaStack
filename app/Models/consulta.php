<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consulta extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'etiqueta', 'fecha_hasta', 'fecha_desde'
    ];

public function consulta()
{
    return $this->belongsTo(Consulta::class);
}
}
