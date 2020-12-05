<?php

namespace App\Imports;

use App\Estudiante;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class EstudianteImport implements ToModel,WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        $reemplazos = array(
            '-'             => '',
            '.'             => ''
        );
        return new Estudiante([
            'rut' => $row['Rut'],
            'rut' => strtr( $row['Rut'] , $reemplazos ),
            'apellidoPaterno' => $row['Apellido Paterno'],
            'apellidoMaterno' => $row['Apellido Materno'],
            'nombre' => $row['Nombre'],
            'codigoCarrera' => $row['Carrera'],
            'correo' => $row['Correo']
        ]);
    }

    public function rules(): array
    {
        return [
            'Rut' => 'required',
            'Apellido Paterno' => 'required',
            'Apellido Materno' => 'required',
            'Nombre' => 'required',
            'Carrera' => 'required',
            'Correo' => 'required',

            'Rut' => Rule::unique('estudiantes','rut'),
            
            'Carrera' => Rule::in(['Carrera']),
             
             // Can also use callback validation rules
             'Carrera' => function($attribute, $value, $onFailure) {
                  if (!is_integer($value)) {
                    $onFailure(': codigo Carrera no es un entero.');
                  }
              }
        ];
    }
}
