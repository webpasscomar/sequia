<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcesoController extends Controller
{

    public function index()
    {
        $title = 'Proceso de trabajo';
        return view('mesa', compact('title'));
    }
}
