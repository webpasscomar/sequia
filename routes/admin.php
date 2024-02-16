<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Roles;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\Admin\Organismos;


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

Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/roles', Roles::class)->name('admin.roles');
Route::get('/users', Users::class)->name('admin.users');

/*Protejo las rutas con el middleware AdminRole, para que los usuarios que no tengan el permiso de administrador
no puedan acceder*/
Route::middleware(['adminRole'])->group(function () {
    // Ruta Organismos - Protegida
    Route::get('/organismos', Organismos::class)->name('admin.organismos');
});
