<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attention extends Model
{
    protected $table = "registro_atencion";

    protected $fillable = [
        'estudiante_atendido', 'descripcion','medio_atencion','asignatura', 'profesor', 'fecha'
    ];
}
