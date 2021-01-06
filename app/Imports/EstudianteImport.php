<?php

namespace App\Imports;

use App\Estudiante;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;

use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class EstudianteImport implements ToModel,WithHeadingRow, WithValidation,SkipsOnError,SkipsOnFailure
{
    use Importable,SkipsErrors,SkipsFailures;

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
            'Rut' => ['required','unique:estudiantes,rut'],
            'Apellido Paterno' => 'required',
            'Apellido Materno' => 'required',
            'Nombre' => 'required',
            'Carrera' => 'required|integer',
            'Correo' => 'required|nullable|email',
        ];
    }
}
