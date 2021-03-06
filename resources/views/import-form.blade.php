@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
@endsection
@section('head')
    <script> src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
@endsection
@section('content')
@guest
<meta http-equiv="refresh" content="1; URL={{ route('login') }}" />
@else
  <br />
  
  <div class="container">
   <h3 align="center">Importar Estudiantes</h3>
    <br />
    @if(session()->has('failures'))
    <div class="alert alert-danger">
        El archivo se subió con {{count(session()->get('failures'))}} problemas:<br>
      <ul id= "problemas" style="display:none" >
      <br>
        @foreach(session()->get('failures') as $validation)
            @foreach($validation->errors() as $error)
                <li>{{ $error }} en la fila {{ $validation->row() }} del archivo.</li>
            @endforeach
        @endforeach
      </ul>
      <br>
    <button class="delete btn btn-danger btn-sm" id="vermas" onClick="ver" style="display:block"> Ver más </button>   
    <button class="delete btn btn-danger btn-sm" id="vermenos" onClick="ver" style="display:none"> Ver menos </button>
    </div>
    @endif

    <script>
      document.getElementById("vermas").onclick = function ver () { 
        document.getElementById("problemas").style.display = "block"; 
        document.getElementById("vermenos").style.display = "block"; 
        document.getElementById("vermas").style.display = "none"; 
      }
      document.getElementById("vermenos").onclick = function ver () { 
        document.getElementById("problemas").style.display = "none"; 
        document.getElementById("vermenos").style.display = "none"; 
        document.getElementById("vermas").style.display = "block"; 
      } 

    </script>

   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
   <form method="post" enctype="multipart/form-data" action="{{route('import')}}">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Ingrese el archivo Excel</label></td>
       <td width="30">
        <input type="file" name="select_file" />
       </td>
       <td width="30%" align="left">
        <input type="submit" name="upload" class="btn btn-primary" value="Subir">
       </td>
      </tr>
      <tr>
       <td width="40%" align="right"></td>
       <td width="30"><span class="text-muted">.xls, .xlsx</span></td>
       <td width="30%" align="left"></td>
      </tr>
     </table>
    </div>
   </form>
@endguest
@endsection
@section('scripts')
@endsection