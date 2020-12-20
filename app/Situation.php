<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    protected $table = "reporte_situacion";

    protected $fillable = [
        'estudiante_reportado', 'descripcion','medio_atencion','asignatura',
    ];
}
