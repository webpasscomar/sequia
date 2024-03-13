<?php

namespace App\Models;

use App\Models\Indice;
use Illuminate\Database\Eloquent\Model;

class Capa extends Model
{
    protected $table = 'capas';
    protected $fillable = ['titulo', 'resumen', 'indice_id', 'presentacion', 'fechaDesde', 'fechaHasta', 'georeferencial', 'status'];

    // Relación con el modelo Indicador
    public function indice()
    {
        return $this->belongsTo(Indice::class);
    }
}
