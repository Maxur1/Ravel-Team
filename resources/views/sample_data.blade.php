@extends('layouts.app')
@section('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

@endsection
@section('content')
@guest
<meta http-equiv="refresh" content="1; URL={{ route('login') }}" />
@else
 <body>
  <div class="container">    
     <br />
     <h3 align="center">Registro de Estudiantes</h3>
     <br />
     <!--<div align="right">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Crear Registro</button>
     </div>-->
     <br />
   <div class="table-responsive">
    <table id="user_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th width="14%">Rut</th>
                <th width="14%">Apellido Paterno</th>
                <th width="14%">Apellido Materno</th>
                <th width="14%">Nombre</th>
                <th width="14%">Codigo de Carrera</th>
                <th width="16%">Correo</th>
                <th width="14%">Accion</th>
      </tr>
     </thead>
    </table>
   </div>
   <br />
   <br />
  </div>


<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir un nuevo registro</h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-4" >Correo : </label>
            <div class="col-md-8">
             <input type="text" name="correo" id="correo" class="form-control" />
            </div>
           </div>
           
                <br />
                <div class="form-group" align="center">
                 <input type="hidden" name="action" id="action" value="Add" />
                 <input type="hidden" name="hidden_id" id="hidden_id" />
                 <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                </div>
         </form>
        </div>
     </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmacion</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Estas seguro que quieres eliminar este dato?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection
@section('scripts')
<script>
$(document).ready(function(){

 $('#user_table').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
   url: "{{ route('sample.index') }}",
  },
  columns: [
   {
    data: 'rut',
    name: 'rut'
   },
   {
    data: 'apellidoPaterno',
    name: 'apellidoPaterno'
   },
   {
    data: 'apellidoMaterno',
    name: 'apellidoMaterno'
   },
   {
    data: 'nombre',
    name: 'nombre'
   },
   {
    data: 'codigoCarrera',
    name: 'codigoCarrera'
   },
   {
    data: 'correo',
    name: 'correo'
   },
   {
    data: 'action',
    name: 'action',
    orderable: false
   }
  ]
 });

 $('#create_record').click(function(){
  $('.modal-title').text('Add New Record');
  $('#action_button').val('Add');
  $('#action').val('Add');
  $('#form_result').html('');

  $('#formModal').modal('show');
 });

 $('#sample_form').on('submit', function(event){
  event.preventDefault();
  var action_url = '';

  if($('#action').val() == 'Add')
  {
   action_url = "{{ route('sample.store') }}";
  }

  if($('#action').val() == 'Edit')
  {
   action_url = "{{ route('sample.update') }}";
  }

  $.ajax({
   url: action_url,
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   success:function(data)
   {
    var html = '';
    if(data.errors)
    {
     html = '<div class="alert alert-danger">';
     for(var count = 0; count < data.errors.length; count++)
     {
      html += '<p>' + data.errors[count] + '</p>';
     }
     html += '</div>';
    }
    if(data.success)
    {
     html = '<div class="alert alert-success">' + data.success + '</div>';
     $('#sample_form')[0].reset();
     $('#user_table').DataTable().ajax.reload();
    }
    $('#form_result').html(html);
   }
  });
 });

 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url :"/sample/"+id+"/edit",
   dataType:"json",
   success:function(data)
   {
    //$('#rut').val(data.result.rut);
    //$('#apellidoPaterno').val(data.result.apellidoPaterno);
    //$('#apellidoMaterno').val(data.result.apellidoMaterno);
    //$('#nombre').val(data.result.nombre);
    //$('#codigoCarrera').val(data.result.codigoCarrera);
    $('#correo').val(data.result.correo);
    $('#hidden_id').val(id);
    $('.modal-title').text('Editar Registro');
    $('#action_button').val('Editar');
    $('#action').val('Edit');
    $('#formModal').modal('show');
   }
  })
 });

 var user_id;

 /*$(document).on('click', '.delete', function(){
  user_id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
   url:"sample/destroy/"+user_id,
   beforeSend:function(){
    $('#ok_button').text('Deleting...');
   },
   success:function(data)
   {
    setTimeout(function(){
     $('#confirmModal').modal('hide');
     $('#user_table').DataTable().ajax.reload();
     alert('Data Deleted');
    }, 2000);
   }
  })
 });*/

});
</script>

@endsection