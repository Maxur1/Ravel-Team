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
   <h3 align="center">Consultar Asignatura</h3>
    <br />
    @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
   <form method="post" enctype="multipart/form-data" action="{{route('consultaAsignatura')}}">
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
                                <input type="text" name="search" id="search" class="form-control" placeholder="Ingrese codigo o nombre de la asignatura" required autocomplete="off"/>
                                <div id="countryList">
                                </div>

                                    @error('search')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                <input type="submit" name="upload" class="btn btn-primary" value="Buscar">   
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
   <script>

        $(document).ready(function() {
            $( "#search" ).autocomplete({
        
                source: function(request, response) {
                    $.ajax({
                    url: "{{url('autocomplete2')}}",
                    data: {
                            term : request.term
                    },
                    dataType: "json",
                        success: function(data){
                            $('#countryList').fadeIn();  
                            $('#countryList').html(data);
                            var resp = $.map(data,function(obj){
                                    return obj.nrcAsignaturas;
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