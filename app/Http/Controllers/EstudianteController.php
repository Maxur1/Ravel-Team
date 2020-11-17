<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Imports\EstudianteImport;
use Excel;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {   
        return view('estudiante');
    }

    public function addEstudiante()
    {
        $estudiantes = [
            ["rut" => "1234","paterno" => "perez","materno" => "lopez","nombre" => "juan","carrera" => "0001","correo" => "juan@ucn.cl"]

        ];
        Estudiante::insert($estudiantes);
        return "Se han agregado estudiantes exitosamente";
    }

    public function getAllEstudiante()
    {
        $estudiantes = Estudiante::all();
        return view('estudiantes', compact('estudiantes'));
    }

    public function importForm()
    {
        return view('import-form');
    }

    public function import(Request $request)
    {
        Excel::import(new EstudianteImport, $request->select_file);
        return redirect('/get-all-estudiante');
    }
}
