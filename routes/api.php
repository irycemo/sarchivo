<?php

use App\Http\Controllers\Api\V1\Solicitudes\CrearSolicitudController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::post('crear_solicitud', [CrearSolicitudController::class, 'crearSolicitud']);

});
