<?php

use Illuminate\Support\Facades\Route;

// 1. Ruta de inicio / Login (El botón de la casita te mandará aquí)
Route::get('/', function () {
    return view('login'); // O la vista de login que prefieras
})->name('login');

// 2. Ruta para la vista principal de la aplicación (El botón de agendar cita del menú)
Route::get('/index', function () {
    return view('index');
})->name('home');

// 3. Ruta para "Mis citas"
Route::get('/citas', function () {
    return view('citas');
})->name('citas');

// 4. Ruta para la "Agenda"
Route::get('/agenda', function () {
    return view('agenda');
})->name('agenda');

// 5. Ruta para la vista de éxito de la cita (Cuando presionas agendar en el formulario)
Route::get('/cita-exitosa', function () {
    return view('citaex');
})->name('citaex');

// 6. Ruta para agregar un nuevo usuario
Route::get('/nuevo-usuario', function () {
    return view('nuevoUS');
})->name('nuevo.usuario');