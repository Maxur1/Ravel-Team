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
                    Situaciones
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tab_trabajo">
                            <tbody>
                                <tr id='avances'>
                                    <td style="vertical-align: middle">
                                        Fecha de la Situación
                                    </td>
                                    <td>
                                        <input name="fecha" class="form-control" type="text" value="{{ $sit->fecha }}" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: middle">
                                        Alumno
                                    </td>
                                    <td>
                                        <input name="alumno" class="form-control" type="text" value="{{ $sit->estudiante_reportado }}" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: middle">
                                        Descripción
                                    </td>
                                    <td>
                                        <input name="texto" class="form-control" type="text" value="{{ $sit->descripcion }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle">
                                        Tipo de Situación
                                    </td>
                                    <td>
                                        <input name="tipo" class="form-control" type="text" value="{{$sit->medio_atencion}}" readonly>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection