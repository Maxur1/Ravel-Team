<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Asignatura extends Model
{

    protected $table = "asignaturas";

    protected $fillable = ['codAsignaturas','nrcAsignaturas','nomAsignaturas'];

    public static function getAs()
    {
        $records = DB::table('asignaturas')->select("id","codAsignaturas","nrcAsignaturas","nomAsignaturas")->orderBy('id','asc')->get()->toArray();
        return $records;
    }
   
}