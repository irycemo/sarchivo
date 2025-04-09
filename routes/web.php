<?php

use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Permisos;
use App\Livewire\Admin\Usuarios;
use App\Livewire\Captura\Predios;
use App\Livewire\Consulta\Archivos;
use App\Livewire\Consulta\Consulta;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SetPasswordController;
use App\Http\Controllers\Dashboard\DashboardController;

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => ['auth', 'activo']], function(){

    /* Administración */
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('roles', Roles::class)->middleware('permission:Lista de roles')->name('roles');

    Route::get('permisos', Permisos::class)->middleware('permission:Lista de permisos')->name('permisos');

    Route::get('usuarios', Usuarios::class)->middleware('permission:Lista de usuarios')->name('usuarios');

    /* Captura */
    Route::get('captura_predios', Predios::class)->name('captura_predios');

    /* Consulta */
    Route::get('consulta_predios', Consulta::class)->name('consulta_predios');
    Route::get('consulta_archivos', Archivos::class)->name('consulta_archivos');

});

Route::get('setpassword/{email}', [SetPasswordController::class, 'create'])->name('setpassword');
Route::post('setpassword', [SetPasswordController::class, 'store'])->name('setpassword.store');
