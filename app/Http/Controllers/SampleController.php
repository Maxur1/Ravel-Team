<?php

namespace App\Http\Controllers;

use App\Estudiante;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Estudiante::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                        //$button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('sample_data');
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
        $rules = array(
            'rut'        =>  $request->rut,
            'apellidoPaterno'         =>  $request->apellidoPaterno,
            'apellidoMaterno'        =>  $request->apellidoMaterno,
            'nombre'        =>  $request->nombre,
            'codigoCarrera'        =>  $request->codigoCarrera,
            'correo'        =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            /*'rut'        =>  $request->rut,
            'apellidoPaterno'         =>  $request->apellidoPaterno,
            'apellidoMaterno'        =>  $request->apellidoMaterno,
            'nombre'        =>  $request->nombre,
            'codigoCarrera'        =>  $request->codigoCarrera,*/
            'correo'        =>  $request->correo
        );

        Estudiante::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estudiante  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $sample_data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estudiante  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Estudiante::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiante $sample_data)
    {
        $rules = array(
            'correo'        =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'correo'        =>  $request->correo
        );

        Estudiante::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudiante  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Estudiante::findOrFail($id);
        $data->delete();
    }
}


