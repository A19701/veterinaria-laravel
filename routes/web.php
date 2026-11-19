<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\DuenoMascotaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\VeterinarioController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $veterinario = DB::table('veterinario')
        ->where('email', $credentials['email'])
        ->first();

    if ($veterinario && Hash::check($credentials['password'], $veterinario->password)) {
        $request->session()->regenerate();
        session([
            'veterinario_id' => $veterinario->id_veterinario,
            'veterinario_nombre' => $veterinario->nombre,
        ]);

        return redirect()->route('home');
    }

    return back()
        ->withErrors(['email' => 'Correo o contraseña incorrectos.'])
        ->withInput($request->only('email'));
})->name('login.submit');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// 2. REGISTRO DE NUEVO USUARIO (nuevoUS.blade.php)
Route::get('/nuevo-usuario', function () {
    return view('nuevoUS');
})->name('nuevo.usuario');
Route::post('/nuevo-usuario', [VeterinarioController::class, 'store'])->name('registro.store');

// 3. VISTA PRINCIPAL / AGENDAR CITA (index.blade.php)
Route::get('/index', [CitaController::class, 'create'])->name('home');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

// 4. CONFIRMACIÓN DE CITA EXITOSA (citaex.blade.php)
Route::get('/cita-exitosa', function () {
    $ultimaCita = DB::table('citas')
        ->join('mascota_paciente', 'citas.paciente', '=', 'mascota_paciente.id_mascota')
        ->leftJoin('dueno_mascota', 'mascota_paciente.id_mascota', '=', 'dueno_mascota.id_mascota')
        ->join('servicio', 'citas.servicio', '=', 'servicio.id_servicio')
        ->join('veterinario', 'citas.veterinario_asignado', '=', 'veterinario.id_veterinario')
        ->select(
            'citas.id_cita',
            'citas.fecha_hora',
            'citas.estado',
            'mascota_paciente.nombre as mascota_nombre',
            'mascota_paciente.especie',
            'dueno_mascota.nombre as dueno_nombre',
            'dueno_mascota.apellidos as dueno_apellidos',
            'servicio.nombre_servicio',
            'veterinario.nombre as vet_nombre',
            'veterinario.apellidos as vet_apellidos'
        )
        ->orderBy('citas.id_cita', 'desc')
        ->first();

    return view('citaex', compact('ultimaCita'));
})->name('citaex');

// 5. MIS CITAS (citas.blade.php)
Route::get('/mis-citas', [CitaController::class, 'mostrarCitas'])->name('citas');

// ruta para eliminar/cancelar
Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');

//ruta agenda
Route::get('/agenda', function () {
    $hoy = Carbon::today()->toDateString();

    $citas = DB::table('citas')
        ->join('mascota_paciente', 'citas.paciente', '=', 'mascota_paciente.id_mascota')
        ->join('servicio', 'citas.servicio', '=', 'servicio.id_servicio')
        ->join('veterinario', 'citas.veterinario_asignado', '=', 'veterinario.id_veterinario')
        ->select(
            'citas.id_cita',
            'citas.fecha_hora',
            'citas.estado',
            'mascota_paciente.nombre as mascota_nombre',
            'mascota_paciente.especie',
            'servicio.nombre_servicio',
            'veterinario.nombre as vet_nombre',
            'veterinario.apellidos as vet_apellidos'
        )
        ->orderBy('citas.fecha_hora', 'asc')
        ->get();

    $citasHoy = DB::table('citas')
        ->whereDate('fecha_hora', $hoy)
        ->count();

    $citasEnEspera = DB::table('citas')
        ->where('estado', 'programada')
        ->count();

    $horarios = DB::table('horario')->get();

    return view('agenda', compact('citas', 'citasHoy', 'citasEnEspera', 'horarios'));
})->name('agenda');