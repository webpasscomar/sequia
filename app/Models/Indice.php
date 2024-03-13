<?php

namespace App\Models;

use App\Models\Capa;
use Illuminate\Database\Eloquent\Model;

class Indice extends Model
{
    protected $table = 'indices';
    protected $fillable = [
        'organismo_id',
        'nombre',
        'descripcion',
        'color',
        'frecuencia',
        'escala',
        'fuente',
        'link',
        'orden',
        'status'
    ];


    // Relación con el modelo Organismo
    public function organismo()
    {
        return $this->belongsTo(Organismo::class);
    }

    // Relación con el modelo Capa
    public function capas()
    {
        return $this->hasMany(Capa::class);
    }

    // Relación 1:1 con Metadata
    public function metadata()
    {
        return $this->hasMany(Metadata::class);
    }
}
