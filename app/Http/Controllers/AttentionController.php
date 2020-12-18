<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attention;
use Validator;

class AttentionController extends Controller
{
    public function register(Request $request)
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
        );

        Attention::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);

    }
}
