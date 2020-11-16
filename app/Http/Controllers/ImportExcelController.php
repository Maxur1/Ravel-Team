<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;

class ImportExcelController extends Controller
{
    function index()
    {
     $data = DB::table('estudiantes')->get();
     return view('import_excel', compact('data'));
    }

    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('select_file')->getRealPath();

     $data = Excel::load($path)->get();

     if($data->count() > 0)
     {
      foreach($data->toArray() as $key => $value)
      {
       foreach($value as $row)
       {
        $insert_data[] = array(
         'Rut'  => $row['rut'],
         'ApellidoPaterno'   => $row['apellidoPaterno'],
         'ApellidoMaterno'   => $row['apellidoMaterno'],
         'Nombre'    => $row['nombre'],
         'CodigoCarrera'  => $row['codigoCarrera'],
         'Correo'   => $row['correo']
        );
       }
      }

      if(!empty($insert_data))
      {
       DB::table('estudiantes')->insert($insert_data);
      }
     }
     return back()->with('Hecho', 'Se ha cargado la informacion exitosamente.');
    }
}