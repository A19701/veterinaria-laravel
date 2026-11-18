<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;

// 1. Ruta de verificación /ping (R1, R2, R9)
Route::get('/ping', function () {
    return response()->json([
        'status' => 'ok',
        'mensaje' => 'API de Veterinaria funcionando correctamente'
    ], 200);
});

// 2. Ruta que falla a propósito para probar el manejo de error 500 (R8)
Route::get('/error-prueba', function () {
    throw new \Exception('Fallo simulado a propósito');
});

// 3. Rutas de lectura (R3, R4, R5) -> IMPORTANTE: /resumen debe ir ANTES que /{id}
Route::get('/citas/resumen', [CitaController::class, 'resumen']);
Route::get('/citas', [CitaController::class, 'index']);
Route::get('/citas/{id}', [CitaController::class, 'show']);

// 4. Rutas de alta, actualización y baja (R6, R7)
Route::post('/citas', [CitaController::class, 'store']);
Route::put('/citas/{id}', [CitaController::class, 'update']);
Route::delete('/citas/{id}', [CitaController::class, 'destroy']);
