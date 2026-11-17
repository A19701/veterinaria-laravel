<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        // Devuelve todas las citas con los datos del veterinario, mascota y servicio
        return Cita::with(['veterinario', 'mascota', 'servicioInfo'])->get();
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'fecha_hora'           => 'required|date',
            'veterinario_asignado' => 'required|exists:veterinario,id_veterinario',
            'paciente'             => 'required|exists:mascota_paciente,id_mascota',
            'servicio'             => 'required|exists:servicio,id_servicio',
            'estado'               => 'required|string|max:50',
        ]);

        $cita = Cita::create($datos);

        return response()->json($cita, 201);
    }

    public function show($id)
    {
        return Cita::with(['veterinario', 'mascota', 'servicioInfo'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        $datos = $request->validate([
            'fecha_hora'           => 'sometimes|date',
            'veterinario_asignado' => 'sometimes|exists:veterinario,id_veterinario',
            'paciente'             => 'sometimes|exists:mascota_paciente,id_mascota',
            'servicio'             => 'sometimes|exists:servicio,id_servicio',
            'estado'               => 'sometimes|string|max:50',
        ]);

        $cita->update($datos);

        return response()->json($cita, 200);
    }

    public function destroy($id)
    {
        Cita::findOrFail($id)->delete();
        return response()->json(['mensaje' => 'Cita eliminada'], 200);
    }
}
