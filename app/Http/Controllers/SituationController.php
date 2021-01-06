<?php

namespace App\Http\Controllers;

use Auth;
use App\Situation;
use App\Asignatura;
use App\User;
use App\Estudiante;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Asignatura;
use Validator;
use App\Mail\SituationMail;
use App\Notifications\SituationNotification;

use Illuminate\Support\Facades\Mail;

class SituationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignaturas = Asignatura::all();
        return view('situation-report')->with('asignaturas',$asignaturas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Situation  $situation
     * @return \Illuminate\Http\Response
     */

    public function show($fecha)
    {
        $situaciones = Situation::all()->where('fecha','=',$fecha);

        $asignaturas = Asignatura::all();
        
        foreach ($situaciones as $situation)
        {
            $sit = $situation;
        }
        return view('situation.show', compact('sit'))->with('asignaturas',$asignaturas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Situation  $situation
     * @return \Illuminate\Http\Response
     */
    public function edit(Situation $situation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Situation  $situation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Situation $situation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Situation  $situation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Situation $situation)
    {
        //
    }

    public function report(Request $request)
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
                    'estudiante_reportado'        =>  $request->search,
                    'descripcion'         =>  $request->situacion,
                    'medio_atencion'        =>  $request->tipo,
                    'asignatura'    => $request->select_asignatura,
                    'fecha'         =>  Carbon::parse(Carbon::now('America/Santiago'))->locale('es_ES')->isoFormat('dddd D \d\e MMMM \d\e\l Y HH:mm:ss')
                );
        
                $situation = Situation::create($form_data);
    
                $profesor = Auth::user();
    
                // Enviar notificación email a los profesores
    
                $jefes = User::all()->where('rol','=','Jefe de Carrera');
                // Por cada profesor guía enviar un email
                foreach ($jefes as $jefe) {
                    $destinatario_email = $jefe->email;
                    // $destinario_nombre = $profesor->name;
                    
                    // Enviar email
                    Mail::to($destinatario_email)->send(new SituationMail($situation, $profesor->name));
    
                    // Enviar notificación por plataforma
                    $jefe->notify(new SituationNotification($situation, $profesor->email));
                }
                
        
                return back()->with('success','Se registro la situación');
            }
            else
            {
                return back()->with('error','El estudiante no existe en la base de datos');
            }
        }
    }
}
