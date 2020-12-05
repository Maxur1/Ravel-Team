<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\Imports\AsignaturasImport;
use Excel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;
use Validator;
use Maatwesite\Excel\Validators\ValidationException;

class AsignaturasController extends Controller
{
    public function index()
    {   
        return view('asignatura');
    }

    public function getAllAsignaturas()
    {
        $asignaturas = Asignatura::all();
        return view('estudiantes', compact('estudiantes'));
    }

    public function importFormAsignaturas()
    {
        return view('import-form-asignaturas');
    }

    public function importAsignaturas(Request $request)
    {
        $this->validate($request, [
            'select_file' => 'required|file|max:1024|mimes:xls,xlsx'
        ]);

        $file = $request->file('select_file');

        $import = new AsignaturasImport;

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
