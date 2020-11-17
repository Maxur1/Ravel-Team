<?php

namespace App\Imports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class EstudianteImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $reemplazos = array(
            '-'             => '',
            '.'             => ''
        );
        return new Estudiante([
            'rut' => $row['Rut'],
            'rut' => strtr( $row['Rut'] , $reemplazos ),
            'paterno' => $row['Apellido Paterno'],
            'materno' => $row['Apellido Materno'],
            'nombre' => $row['Nombre'],
            'carrera' => $row['Carrera'],
            'correo' => $row['Correo']
        ]);
    }
}
