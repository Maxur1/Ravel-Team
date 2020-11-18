<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Estudiante extends Model
{

    protected $table = "estudiantes";

    protected $fillable = ['rut','apellidoPaterno','apellidoMaterno','nombre','codigoCarrera','correo'];

    public static function getEstudiante()
    {
        $records = DB::table('estudiantes')->select("id","rut","apellidoPaterno","apellidoMaterno","nombre","codigoCarrera","correo")->orderBy('id','asc')->get()->toArray();
        return $records;
    }
   
}