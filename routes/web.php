<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndiceController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\ReferenciasController;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Protege el acceso al registro desde la barra de navegación del navegador
Auth::routes(
    ['register' => false]
);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
Route::get('/mesa', [MesaController::class, 'index'])->name('mesa');
Route::get('/proceso', [ProcesoController::class, 'index'])->name('proceso');
Route::get('/referencias', [ReferenciasController::class, 'index'])->name('referencias');
Route::get('/indices', [IndiceController::class, 'seleccionarIndice'])->name('indice.show');
