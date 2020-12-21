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
   <h3 align="center">Registrar Atención</h3>
    <br />
    @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
   <form method="post" enctype="multipart/form-data" action="{{route('registerAttention')}}">
    {{ csrf_field() }}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('registerAttention') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Ingrese nombre o rut del estudiante" required/>
                            <div id="countryList">
                            </div>

                                @error('search')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <form class="form-group row" id= "rol">
                                <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                <textarea id="situacion" name="situacion" class="col-md-6 col-form-label text-md-left" rows="3" required></textarea>
                            </form>
                            @error('situacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="carrera" class="col-md-4 col-form-label text-md-right" id="carrera1" name="carrera1">{{ __('Tipo de Situación') }}</label>
                            <div class="col-md-6">
                                <select id= "tipo" name="tipo" class="form-control">
                                <option value="Personal">Personal</option> 
                                <option value="Correo">Correo electrónico</option>
                                <option value="Otros">Otros</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="asignatura" class="col-md-4 col-form-label text-md-right" id="asignatura0" name="asignatura0">{{ __('¿Desea indicar una Asignatura?') }}</label>
                            <div class="col-md-6">
                                <input type="checkbox" name="check" id="check" value="1" onchange="javascript:showContent()" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="asignatura" class="col-md-4 col-form-label text-md-right" id="asignatura1" name="asignatura1" style="display:none">{{ __('Asignatura') }}</label>
                            <div class="col-md-6">
                                <select id= "select_asignatura" name="select_asignatura" class="form-control" style="display:none">
                                    <option value=""></option>
                                    @foreach($asignaturas as $asignatura)
                                        <option value="{{$asignatura->nrcAsignaturas}}">{{$asignatura->nrcAsignaturas}} - {{$asignatura->nomAsignaturas}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="asignatura" class="col-md-4 col-form-label text-md-right" id="asignatura0" name="asignatura0">{{ __('¿Desea indicar un Profesor?') }}</label>
                            <div class="col-md-6">
                                <input type="checkbox" name="check" id="check2" value="1" onchange="javascript:showContent()" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profesor1" class="col-md-4 col-form-label text-md-right" id="profesor1" name="profesor1" style="display:none">{{ __('Profesor') }}</label>
                            <div class="col-md-6">
                                <select id= "profesor2" name="profesor2" class="form-control" style="display:none">
                                    <option value=""></option>
                                    @foreach($profesores as $profesor)
                                        <option value="{{$profesor->email}}">{{$profesor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                            <input type="submit" name="upload" class="btn btn-primary" value="Reportar">   
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </form>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function showContent() {
                check = document.getElementById("check");
                check2 = document.getElementById("check2");
                element = document.getElementById("asignatura1");
                element1 = document.getElementById("select_asignatura");
                element2 = document.getElementById("profesor1");
                element3 = document.getElementById("profesor2");
                if(check.checked)
                {
                    element.style.display='block';
                    element1.style.display='block';
                    
                }else
                {
                    element.style.display='none';
                    element1.style.display='none';
                }
                if(check2.checked)
                {
                    element2.style.display='block';
                    element3.style.display='block';
                    
                }else
                {
                    element2.style.display='none';
                    element3.style.display='none';
                }
            }
    </script>

   <script>

        $(document).ready(function() {
            $( "#search" ).autocomplete({
        
                source: function(request, response) {
                    $.ajax({
                    url: "{{url('autocomplete')}}",
                    data: {
                            term : request.term
                    },
                    dataType: "json",
                        success: function(data){
                            $('#countryList').fadeIn();  
                            $('#countryList').html(data);
                            var resp = $.map(data,function(obj){
                                    return obj.nombre + ' ' +obj.apellidoPaterno + ' ' + obj.apellidoMaterno;
                            }); 
                            response(resp);
                        }
                    });
                },
                minLength: 1
            });
        });
</script>   
@endsection