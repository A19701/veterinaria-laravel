<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'id_servicio';
    public $timestamps = false;

    protected $fillable = [
        'nombre_servicio',
        'duracion_estimada',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'servicio', 'id_servicio');
    }
}
