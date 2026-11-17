<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';
    protected $primaryKey = 'id_cita';
    public $timestamps = false;

    protected $fillable = [
        'fecha_hora',
        'veterinario_asignado',
        'paciente',
        'servicio',
        'estado',
    ];

    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class, 'veterinario_asignado', 'id_veterinario');
    }

    public function mascota()
    {
        return $this->belongsTo(MascotaPaciente::class, 'paciente', 'id_mascota');
    }

    public function servicioInfo()
    {
        return $this->belongsTo(Servicio::class, 'servicio', 'id_servicio');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'id_cita', 'id_cita');
    }
}
