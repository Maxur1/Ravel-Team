<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attention;
use Validator;
use App\Asignatura;
use App\User;

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
            'estudiante_atendido'        =>  $request->search,
            'descripcion'         =>  $request->situacion,
            'medio_atencion'        =>  $request->tipo,
            'asignatura'         =>  $request->select_asignatura,
            'profesor'        =>  $request->profesor2,
        );

        Attention::create($form_data);

        //return response()->json(['success' => 'Data Added successfully.']);
        
        return back()->with('success','Se registro la atención');

    }
}
