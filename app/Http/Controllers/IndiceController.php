<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndiceController extends Controller
{
    //
    public function seleccionarIndice($indiceId)
    {
        return redirect()->route('indice.show', ['id' => $indiceId]);
    }
}
