<?php

namespace App\Http\Controllers;

use App\Situation;
use App\Asignatura;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function show($id)
    {
        $situaciones = Situation::find($id);
        return view('situation.show', compact('situaciones'));
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
        
            $form_data = array(
                'estudiante_reportado'        =>  $request->search,
                'descripcion'         =>  $request->situacion,
                'medio_atencion'        =>  $request->tipo,
                'asignatura'    => $request->select_asignatura,
                'fecha'         =>  Carbon::parse(Carbon::now('America/Santiago'))->locale('es_ES')->isoFormat('dddd D \d\e MMMM \d\e\l Y HH:mm:ss')
            );
    
            Situation::create($form_data);

            /* Enviar notificación email a los profesores

            // Obtengo la id del trabajo al que está relacionado el avance
            $trabajo_id = $request->idTrabajo;
            // Buscar a los profesores relacionados al trabajo
            $trabajo = Trabajo::findOrFail($trabajo_id);
            $profesores = $trabajo->profesores;
            // Por cada profesor guía enviar un email
            foreach ($profesores as $profesor) {
                $destinatario_email = $profesor->email;
                // $destinario_nombre = $profesor->name;

                // Enviar email
                Mail::to($destinatario_email)->send(new AvanceRegistrado($trabajo, $profesor, $avance));

                // Enviar notificación por plataforma
                $profesor->notify(new AvanceRegistradoNotif($trabajo, $alumno, $avance));
            }
            */
    
            return back()->with('success','Se registro la situación');
       
    }
}
