@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
@endsection
@section('head')
  <title>Editar Correo</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  @endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-secondary">
                <div class="card-header">
                    Atención Registrada
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tab_trabajo">
                            <tbody>
                                <tr id='avances'>
                                    <td style="vertical-align: middle">
                                        Fecha de la Atención
                                    </td>
                                    <td>
                                        <input name="fecha" class="form-control" type="text" value="{{ $atencion->fecha }}" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: middle">
                                        Alumno
                                    </td>
                                    <td>
                                        <input name="alumno" class="form-control" type="text" value="{{ $atencion->estudiante_atendido }}" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: middle">
                                        Descripción
                                    </td>
                                    <td>
                                        <input name="texto" class="form-control" type="text" value="{{ $atencion->descripcion }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle">
                                        Medio de Atención
                                    </td>
                                    <td>
                                        <input name="tipo" class="form-control" type="text" value="{{$atencion->medio_atencion}}" readonly>
                                    </td>
                                </tr>
                                @if($atencion->asignatura != null)
                                <tr>
                                    <td style="vertical-align: middle">
                                        Asignatura
                                    </td>
                                    @foreach($asignaturas as $asignatura)
                                        @if($asignatura->nrcAsignaturas === $atencion->asignatura)
                                            <td>
                                                <input name="tipo" class="form-control" type="text" value="{{$asignatura->nrcAsignaturas}} - {{$asignatura->nomAsignaturas}}" readonly>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                                @endif

                                @if($atencion->profesor != null)
                                <tr>
                                    <td style="vertical-align: middle">
                                        Profesor
                                    </td>
                                    @foreach($profesores as $profesor)
                                        @if($profesor->email === $atencion->profesor)
                                            <td>
                                                <input name="tipo" class="form-control" type="text" value="{{$profesor->name}}" readonly>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection