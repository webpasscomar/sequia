<?php

namespace App\Models;

use App\Models\Indicador;
use Illuminate\Database\Eloquent\Model;

class Capa extends Model
{
    protected $table = 'capas';
    protected $fillable = [
        'titulo',
        'resumen',
        'indicador_id',
        'presentacion',
        'fechaDesde',
        'fechaHasta',
        'georeferencial',
        'status',
        'orden'
    ];

    // Relación con el modelo Indicador
    public function indicador()
    {
        return $this->belongsTo(Indicador::class);
    }
}
