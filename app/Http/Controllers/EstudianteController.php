<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Imports\EstudianteImport;
use Excel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;
use Validator;

class EstudianteController extends Controller
{
    public function index()
    {   
        return view('estudiante');
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
        $this->validate($request, [
            'select_file' => 'required|file|max:1024|mimes:xls,xlsx'
        ]);

        $file = $request->file('select_file');

        $import = new EstudianteImport;

        $import->import($file);

        if($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures());
        }
        else
        {
            return back()-> with('success', 'Se importó el archivo exitosamente');
        }
    }
}
