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

    public function show($fecha)
    {
        $atenciones = Attention::all()->where('fecha','=',$fecha);

        $asignaturas = Asignatura::all();
        $profesores = User::all()->where('rol','=','Profesor');
        
        foreach ($atenciones as $atencion)
        {
            $atencion = $atencion;
        }
        return view('atention.show', compact('atencion'))->with('asignaturas',$asignaturas)->with('profesores',$profesores);
    }

    public function registerAttention(Request $request)
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
        
        /*
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
        */
    }
}
