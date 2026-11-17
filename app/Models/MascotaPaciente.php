<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MascotaPaciente extends Model
{
    protected $table = 'mascota_paciente';
    protected $primaryKey = 'id_mascota';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'fecha_nacimiento',
        'peso',
    ];

    public function duenos()
    {
        return $this->hasMany(DuenoMascota::class, 'id_mascota', 'id_mascota');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'paciente', 'id_mascota');
    }
}

