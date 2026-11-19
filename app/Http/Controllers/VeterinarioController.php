<?php

namespace App\Http\Controllers;

use App\Models\Veterinario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VeterinarioController extends Controller
{
    public function create()
{
    return view('nuevoUS');
}
    public function store(Request $request)
{
    $data = $request->validate([
        'nombre' => ['required', 'string', 'max:100'],
        'apellidos' => ['required', 'string', 'max:100'],
        'especialidad' => ['required', 'string', 'max:100'],
        'telefono' => ['required', 'string', 'max:30'],
        'email' => ['required', 'email', 'max:150'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
    ]);

    DB::table('veterinario')->insert([
        'nombre' => $data['nombre'],
        'apellidos' => $data['apellidos'],
        'especialidad' => $data['especialidad'],
        'telefono' => $data['telefono'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    return redirect()
        ->route('login')
        ->with('success', 'Veterinario registrado correctamente. Ya puedes iniciar sesión.');
}
   
}
