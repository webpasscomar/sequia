<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    use HasFactory;
    protected $fillable = [
        'indice_id',
        'status'
    ];

    public function indice()
    {
        return $this->belongsTo(Indice::class);
    }
}
