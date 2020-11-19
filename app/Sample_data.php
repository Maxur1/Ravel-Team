<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample_data extends Model
{
    protected $fillable = [
     'rut', 'apellidoPaterno', 'apellidoMaterno', 'nombre', 'codigoCarrera', 'correo'
    ];
}
