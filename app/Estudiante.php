<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Estudiante extends Model
{

    protected $table = "estudiantes";

    protected $fillable = ['rut','paterno','materno','nombre','carrera','correo'];

    public static function getEstudiante()
    {
        $records = DB::table('estudiantes')->select("id","rut","paterno","materno","nombre","carrera","correo")->orderBy('id','asc')->get()->toArray();
        return $records;
    }
   
}