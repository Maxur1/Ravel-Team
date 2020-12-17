<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Asignatura;
use App\Imports\EstudianteImport;
use Excel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;
use Validator;

class EstudianteController extends Controller
{
    public function index()
    {
        $asignaturas = Asignatura::all();
        return view('situation-report')->with('asignaturas',$asignaturas);
    }

    public function attention()
    {
        return view('attention-register');
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Estudiante::findOrFail($id);
            return response()->json(['result' => $data]);
        }
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

    public function autocomplete(Request $request)
    {
        $search = $request->get('term');

        $reemplazos = array(
            '-'             => '',
            '.'             => ''
        );

        $search = strtr( $search , $reemplazos);
      
        $result = Estudiante::where('nombre', 'LIKE', '%'. $search. '%')->orWhere('rut', 'LIKE', '%'. $search. '%')->get();

        return response()->json($result);
    }
}
