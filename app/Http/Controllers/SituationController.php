<?php

namespace App\Http\Controllers;

use App\Situation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class SituationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show(Situation $situation)
    {
        //
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
        /* 
        $rules = array(
            'estudiante_atendido'        =>  'required',
            'descripcion'         =>  'required',
            'medio_atencion'        =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        */
        $form_data = array(
            'estudiante_reportado'        =>  $request->search,
            'descripcion'         =>  $request->situacion,
            'medio_atencion'        =>  $request->tipo,
            'asignatura'    => $request->select_asignatura,
        );

        Situation::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);

    }
}
