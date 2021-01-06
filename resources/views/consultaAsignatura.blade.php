@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
@endsection
@section('head')
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Registrar Atención</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  @include('/layouts/live')
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
@section('content')
<div class="container">
    <h3 align="center">{{$asignatura->nomAsignaturas}}</h3>
    <br />
    <div class="row">
        <div class="col-md-12">
            @if(count($atenciones) != 0)
                <div class="card border-secondary">
                    <div class="card-header">
                        Atenciones Registradas
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="tab_trabajo">
                                    <tr align="center">
                                        <th>
                                        Fecha
                                        </th>

                                        <th >
                                        Descripción
                                        </th>

                                        <th>
                                        Acción
                                        </th>
                                    
                                    </tr>
                                    
                                    <tbody>
                                        @foreach($atenciones as $atencion)
                                            <tr id='atenciones'>
                                                <td align="center">
                                                {{$atencion->fecha}}
                                                </td>
                                                <td align="center">
                                                {{$atencion->descripcion}}
                                                </td>
                                                <td align="center">
                                                    <a href="{{route('atention.show', $atencion->fecha)}}">
                                                    <input type="submit" name="upload" class="btn btn-primary" value="ver detalles">
                                                    </a>       
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>  
                            </div>
                    </div>
                </div>
                <br>
            @else
            <div class="card border-secondary">
                    <div class="card-header">
                        Atenciones Registradas
                    </div>
                    <div class="card-body">
                    <h6 align="center">No hay atenciones vinculadas a esta asignatura</h6>
                    </div>
            </div> 
            @endif
            <br>
            @if(count($situaciones) != 0)
                <div class="card border-secondary">
                    <div class="card-header">
                        Situaciones Reportadas
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="tab_trabajo">
                                    <tr align="center">
                                        <th>
                                        Fecha
                                        </th>

                                        <th >
                                        Descripción
                                        </th>

                                        <th>
                                        Acción
                                        </th>
                                    
                                    </tr>
                                    
                                    <tbody>
                                        @foreach($situaciones as $situacion)
                                            <tr id='situaciones'>
                                                <td align="center">
                                                {{$situacion->fecha}}
                                                </td>
                                                <td align="center">
                                                {{$situacion->descripcion}}
                                                </td>
                                                <td align="center">
                                                    <a href="{{route('situation.show', $situacion->fecha)}}">
                                                    <input type="submit" name="upload" class="btn btn-primary" value="ver detalles">
                                                    </a>       
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>  
                            </div>
                    </div>
                </div>
                <br>
            @else
            <div class="card border-secondary">
                    <div class="card-header">
                        Atenciones Registradas
                    </div>
                    <div class="card-body">
                    <h6 align="center">No hay atenciones vinculadas a esta asignatura</h6>
                    </div>
            </div> 
            @endif
        </div>
    </div>
</div>
@endsection