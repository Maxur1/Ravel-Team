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
            'paterno' => $row['Apellido Paterno'],
            'materno' => $row['Apellido Materno'],
            'nombre' => $row['Nombre'],
            'carrera' => $row['Carrera'],
            'correo' => $row['Correo']
        ]);
    }

    public function rules(): array
    {
        return [
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
