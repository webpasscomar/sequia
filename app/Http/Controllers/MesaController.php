<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MesaController extends Controller
{

    public function index()
    {
        $title = 'Mesa nacional del monitor';
        return view('mesa', compact('title'));
    }
}
