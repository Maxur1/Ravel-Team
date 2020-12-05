<?php

namespace App\Imports;

use App\Asignatura;
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

class AsignaturasImport implements ToModel,WithHeadingRow, WithValidation,SkipsOnError,SkipsOnFailure
{
    use Importable,SkipsErrors,SkipsFailures;

    public function model(array $row)
    {
        return new Asignatura([
            'codAsignaturas' => $row['Codigo'],
            'nrcAsignaturas' => $row['NRC'],
            'nomAsignaturas' => $row['Asignatura'],
        ]);
    }

    public function rules(): array
    {
        return [
            'Codigo' => 'required',
            'NRC' => ['required','integer','unique:asignaturas,nrcAsignaturas'],
            'Asignatura' => 'required',
        ];
    }   
}
