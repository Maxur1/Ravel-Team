<!DOCTYPE html>
<html>
 <head>
  <title>Importar Asignaturas</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  
  <div class="container">
   <h3 align="center">Importar Asignaturas</h3>
    <br />
    @if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        Error al subir archivo<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif

   @if(session()->has('failures'))
    <div class="alert alert-danger">
        El archivo se subió con {{count(session()->get('failures'))}} problemas:<br>
      <ul id= "problemas" style="display:none" >
      
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
   <form method="post" enctype="multipart/form-data" action="{{route('importAsignaturas')}}">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Ingrese el archivo Excel</label></td>
       <td width="30">
        <input type="file" name="select_file" class="form-control" />
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
 
 </body>
</html>