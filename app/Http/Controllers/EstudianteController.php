<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Asignatura;
use App\Attention;
use App\Situation;
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

        $headings = (new HeadingRowImport)->toArray($file);
        $headings = $headings[0];
        if($headings[0][0] == 'rut')
        {
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
        }else
        {
            return back()-> with('error', 'El archivo es incorrecto');
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

    public function fichaEstudiantes()
    {
        return view('ficha-estudiantes');
    }

    public function generarFicha(Request $request)
    {
        $search1 = $request->search;

        $palabras = explode (" ", $search1);

        //dd($palabras[0]);

        if(count($palabras) != 3)
        {
            return back()->with('error','Nombre de Alumno incorrecto');
        }
        else
        {
            if(Estudiante::where('apellidoPaterno', '=', $palabras[1])->where('apellidoMaterno', '=', $palabras[2])->exists())
            {
                $estudiantes = Estudiante::where('apellidoPaterno', '=', $palabras[1])->where('apellidoMaterno', '=', $palabras[2])->get();
                foreach($estudiantes as $estudiante)
                {
                    $alumno = $estudiante;
                }
                $atenciones = Attention::all()->where('estudiante_atendido','=',$search1);
                $situaciones = Situation::all()->where('estudiante_reportado','=',$search1);
                
                return view("ficha")->with('estudiante',$alumno)->with('atenciones',$atenciones)->with('situaciones',$situaciones);
            }
            else
            {
                return back()->with('error','El estudiante no existe en la base de datos');
            }
        }
    }
}
