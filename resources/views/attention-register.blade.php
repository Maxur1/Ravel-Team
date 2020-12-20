<!DOCTYPE html>
<html>
 <head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Registrar Atención</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  @include('/layouts/live');
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <style>
    .form-control
    {
        
    }
 
 </style>
 <body> 
  <div class="container">
   <h3 align="center">Registrar Atención</h3>
    <br />
   <form method="post" enctype="multipart/form-data" action="{{route('registerAttention')}}">
    {{ csrf_field() }}
    <div class="form-group">
        <div id="custom-search-input">
            <div width="40%" align="left" class="input-group">
                <label>Estudiante</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Ingrese nombre o rut del estudiante" />
                <div id="countryList">
                </div>
            </div>
            
        </div>
        <br>
        <div align="left">
            <label>Descripción de la atención</label>
            <input type="textarea" name="situacion" class="form-control"/>
        </div>
        <br>
        <div width="40%" align="left" class="input-group">
            <label>Tipo de atención</label>
            <br>
            <select id= "tipo" name="tipo" onchange="showresult(this.value)" class="form-control">
                <option value="Personal">Personal</option> 
                <option value="Correo">Correo electrónico</option>
                <option value="Otros">Otros</option>
            </select>
        </div>
        <br>
        <br>
        <div align="center">
            <input type="submit" name="upload" class="btn btn-primary" value="Reportar">   
        </div>
    </div>
   </form>

   <script>
        function showresult(str) {
            if (str == "Academica") {
                $("#asignatura").css('display', 'block');
                return;
            }else{
                $("#asignatura").css('display', 'none'); 

            }
        }

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
</body>
</html>