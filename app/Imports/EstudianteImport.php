<?php

namespace App\Imports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EstudianteImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Estudiante([
            'rut' => $row['rut'],
            'paterno' => $row['paterno'],
            'materno' => $row['materno'],
            'nombre' => $row['nombre'],
            'carrera' => $row['carrera'],
            'correo' => $row['correo']
        ]);
    }
}
