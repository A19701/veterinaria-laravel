<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario';
    protected $primaryKey = 'id_horario';
    public $timestamps = false;

    protected $fillable = [
        'id_veterinario',
        'id_cita',
    ];

    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class, 'id_veterinario', 'id_veterinario');
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita', 'id_cita');
    }
}
