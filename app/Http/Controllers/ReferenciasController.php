<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferenciasController extends Controller
{

    public function index()
    {
        $title = 'Referencias';
        return view('mesa', compact('title'));
    }
}
