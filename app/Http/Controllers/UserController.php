<?php

namespace App\Http\Controllers;

use App\User;
use App\Asignatura;
use App\Attention;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class UserController extends Controller
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
            
            $data = User::latest()->where([['rol', '<>', 'administrador'],['eliminado', false]])->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('users');
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
            'name'        =>  'required|alpha',
            'email'         =>  'required|email',
            'rol'        =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'email'         =>  $request->email,
            'rol'        =>  $request->rol,
        );

        User::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function show(User $sample_data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = User::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $sample_data)
    {
        $rules = array(
            'name'        =>  'required|regex:/^[\p{L}\s-]+$/',
            'email'         =>  'required|email',
            'rol'        =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'email'         =>  $request->email,
            'rol'        =>  $request->rol,
        );

        User::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->eliminado = true;
        $data->save();
    }

    public function situationReport()
    {
        return view('situation-report');
    }

    public function autocomplete1(Request $request)
    {
        $search = $request->get('term');

        $reemplazos = array(
            '-'             => '',
            '.'             => ''
        );

        $search = strtr( $search , $reemplazos);
      
        $result = User::where('rol','=','Profesor')->where('name', 'LIKE', '%'. $search. '%')->get();

        return response()->json($result);
    }

    public function consultarProfesor()
    {
        return view('consulta-profesor');
    }

    public function consulta(Request $request)
    {
        $search1 = $request->search;

        //dd($palabras[0]);

        if(User::where('name', '=', $search1)->exists())
        {
            $profesores = User::where('name', '=', $search1)->get();
            foreach($profesores as $profesor)
            {
                $profe = $profesor;
            }
            $atenciones = Attention::all()->where('profesor','=',$profe->email);
            
            return view("consulta")->with('profesor',$profe)->with('atenciones',$atenciones);
        }
        else
        {
            return back()->with('error','El profesor no existe en la base de datos');
        }
    }
}