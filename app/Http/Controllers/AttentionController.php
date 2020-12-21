<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attention;
use Validator;
use App\Asignatura;
use App\User;
use App\Estudiante;
use Carbon\Carbon;

class AttentionController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignaturas = Asignatura::all();
        $profesores = User::all()->where('rol','=','Profesor');
        return view('attention-register')->with('asignaturas',$asignaturas)->with('profesores',$profesores);
    }

    public function registerAttention(Request $request)
    {
        /*
        $search1 = $request->search;

        $reemplazos = array(
            '-'             => '',
            '.'             => ''
        );

        $search1 = strtr( $search1 , $reemplazos);

        $palabras = explode (" ", $search1);

        if(Estudiante::where('nombre', '==', $search1))
        {
            return back()->with('error','Nombre de Alumno incorrecto');
        }
        else
        {
            if(Estudiante::where([['nombre', '=', '%'. $palabras[0]. '%'],['apellidoPaterno', '=', '%'. $palabras[1]. '%'],['apellidoMaterno', '=', '%'. $palabras[2]. '%']]))
            {
                $form_data = array(
                    'estudiante_atendido'        =>  $request->search,
                    'descripcion'         =>  $request->situacion,
                    'medio_atencion'        =>  $request->tipo,
                    'asignatura'         =>  $request->select_asignatura,
                    'profesor'        =>  $request->profesor2,
                    'fecha'         =>  Carbon::parse(Carbon::now('America/Santiago'))->locale('es_ES')->isoFormat('dddd D \d\e MMMM \d\e\l Y HH:mm:ss')
                );
        
                Attention::create($form_data);
                
                return back()->with('success','Se registro la atención');
            }
            else
            {
                return back()->with('error','El estudiante no existe en la base de datos');
            }
        }
        */
        
        $form_data = array(
            'estudiante_atendido'        =>  $request->search,
            'descripcion'         =>  $request->situacion,
            'medio_atencion'        =>  $request->tipo,
            'asignatura'         =>  $request->select_asignatura,
            'profesor'        =>  $request->profesor2,
            'fecha'         =>  Carbon::parse(Carbon::now('America/Santiago'))->locale('es_ES')->isoFormat('dddd D \d\e MMMM \d\e\l Y HH:mm:ss')
        );

        Attention::create($form_data);
        
        return back()->with('success','Se registro la atención');
    }
}
