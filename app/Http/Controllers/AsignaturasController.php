<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\Attention;
use App\Situation;
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

        $headings = (new HeadingRowImport)->toArray($file);
        $headings = $headings[0];

        if($headings[0][0] == 'codigo')
        {
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
        else
        {
            return back()-> with('error', 'El archivo es incorrecto');
        }
    }

    public function autocomplete2(Request $request)
    {
        $search = $request->get('term');
      
        $result = Asignatura::where('nomAsignaturas','LIKE','%'. $search. '%')->orwhere('codAsignaturas', 'LIKE', '%'. $search. '%')->get();

        return response()->json($result);
    }

    public function consultarAsignatura()
    {
        return view('consulta-asignatura');
    }

    public function consultaAsignatura(Request $request)
    {
        $search1 = $request->search;

        //dd($palabras[0]);

        if(Asignatura::where('nrcAsignaturas', '=', $search1)->exists())
        {
            $asignaturas = Asignatura::where('nrcAsignaturas', '=', $search1)->get();
            foreach($asignaturas as $asignatura)
            {
                $ramo = $asignatura;
            }
            $atenciones = Attention::all()->where('asignatura','=',$ramo->nrcAsignaturas);
            $situaciones = Situation::all()->where('asignatura','=',$ramo->nrcAsignaturas);
            
            return view("consultaAsignatura")->with('asignatura',$ramo)->with('atenciones',$atenciones)->with('situaciones',$situaciones);
        }
        else
        {
            return back()->with('error','El profesor no existe en la base de datos');
        }
    }
}
