<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuenoMascota extends Model
{
    protected $table = 'dueno_mascota';
    protected $primaryKey = 'id_dueno';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'id_mascota',
    ];

    public function mascota()
    {
        return $this->belongsTo(MascotaPaciente::class, 'id_mascota', 'id_mascota');
    }
}

