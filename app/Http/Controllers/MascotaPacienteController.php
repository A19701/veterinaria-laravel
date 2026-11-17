<?php

namespace App\Http\Controllers;

use App\Models\MascotaPaciente;
use Illuminate\Http\Request;

class MascotaPacienteController extends Controller
{
    public function index()
    {
        return MascotaPaciente::with('duenos')->get();
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre'           => 'required|string|max:100',
            'especie'          => 'required|string|max:100',
            'raza'             => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'peso'             => 'nullable|numeric',
        ]);

        $mascota = MascotaPaciente::create($datos);

        return response()->json($mascota, 201);
    }

    public function show($id)
    {
        return MascotaPaciente::with('duenos')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $mascota = MascotaPaciente::findOrFail($id);
        $mascota->update($request->all());

        return response()->json($mascota, 200);
    }

    public function destroy($id)
    {
        MascotaPaciente::findOrFail($id)->delete();
        return response()->json(['mensaje' => 'Mascota eliminada'], 200);
    }
}
