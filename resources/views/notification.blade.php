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

@guest
    <meta http-equiv="refresh" content="1; URL={{ route('home') }}" />
@else
<div class="container">
    <div class="row">
        <div class="col-md-12 mx">
            <div class="card border-secondary">
                <div class="card-header">
                    <b>Notificaciones</b>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered table-hover">
                        <tbody id="tablaTrabajos" class="table-hover">
                            <?php $cant=0; ?>
                            @foreach(Auth::user()->unreadNotifications  as $notification)
                               
                                    <tr>
                                        <a onclick="markRead('{{ $notification->id }}')" style="vertical-align: middle" href="{{route('situation.show', $notification->data['fecha'])}}"> 
                                        <p>{{$notification->data["profesor"]}} reporto una nueva situación</p></a>
                                    </tr>
                                <?php $cant++; ?>                                                             
                            @endforeach
                            @if($cant === 0)
                                <p style="text-align:center"><b>No tienes nuevas notificaciones</b></p>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection