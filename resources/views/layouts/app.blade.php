<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UCN - Fichas de atención personal de los estudiantes DISC') }}</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/css/custom-theme/jquery-ui-1.10.0.custom.css" rel="stylesheet"/>
   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->

    @yield('head')
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <!-- Styles -->

    <style>
        body {
            background-color: #EFF0F1;
            padding-bottom: 55px;
        }

        footer {
            position: fixed;
            height: 55px;
            bottom: 0;
            left: 0;
            width: 100%;            
            background-color: #23415B;
            text-align: center;
            color: rgba(245, 245, 245, .65);
        }

        .footer-text {
            font-size: 75%;
        }
    </style>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>

<body>
    <!-- Barra de navegación -->

    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #23415B">
            <!-- Logo UCN -->
            <a class="navbar-brand">
                <img src="\img\Isologo-UCN-2018.png" height="40px" alt="Logo-UCN" loading="lazy">
            </a>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Lado derecho de la barra de navegación -->
                <ul class="nav navbar-nav ml-auto">
                    <!-- Links de autenticación -->
                    @guest
                    
                    @else

                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <!-- Consultar Bitácoras -->
                                                            

                    <!-- Si el usuario es un administrador... -->
                    @if(Auth::user()->rol === 'Administrador' )
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">Administrar usuarios<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrar usuarios</a>
                    </li>
                    <!-- Si el usuario es un Jefe de Carrera... -->
                    @elseif(Auth::user()->rol === 'Jefe de Carrera')
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/import-form">Añadir Estudiantes<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/import-form-asignaturas">Añadir Asignaturas<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/sample">Editar Correo Estudiantes<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/attention-register">Registrar Atención<span class="sr-only">(current)</span></a>
                    </li>
                    <!-- Si el usuario es un Secretaria... -->
                    @elseif(Auth::user()->rol === 'Secretario')
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/import-form">Añadir Estudiantes<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/import-form-asignaturas">Añadir Asignaturas<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/sample">Editar Correo Estudiantes<span class="sr-only">(current)</span></a>
                    </li>
                    <!-- Si el usuario es un Profesor... -->
                    @elseif(Auth::user()->rol === 'Profesor')

                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/situation-report">Reportar Situación<span class="sr-only">(current)</span></a>
                    </li>

                    @endif

                    <!-- Notificaciones -->
                    @if(Auth::user()->rol === 'Jefe de Carrera')                    
                        <div class="dropdown">
                            <button style="color: rgba(255,255,255,.75)" class="btn dropdown-toggle" type="button" id="btn_notificacion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Notificaciones <span class="badge" id="cantNotify"> ({{count(Auth::user()->unreadNotifications)}}) </span>
                            </button>

                                <ul class="dropdown-menu" role="menu" id="ulNotify">                                
                                    @foreach (Auth::user()->unreadNotifications->take(4) as $notification)                                        
                                            <li class="list-group-item">                                        
                                                <a onclick="markRead('{{ $notification->id }}')" href="{{route('situation.show', $notification->data['fecha'])}}"><i>Nueva situación</b></a>
                                            </li>
                                    @endforeach
                                    <li class="list-group-item">
                                        <a href="{{route('notification.index')}}">Ver Todas Las Notificaciones</a>
                                    </li>
                                </ul>
                        </div>
                    @endif

                    <!-- CERRAR SESIÓN -->
                    <li class="nav-item">
                        <a class="nav-link">{{ Auth::user()->name }}</a>
                    </li>   

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>   
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                    @endguest

            </div>
        </nav>

        <!-- Para mostrar los mensajes de errores -->
        <div style="margin-top:20px">
            @if(session('info'))
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Mensajes de error -->
            @if(count($errors))
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        @yield('content')
    </div>

    <footer>
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3 footer-text">Ingeniería de Software II-2020:
            <a style="color: #EFF0F1" href="https://www.ucn.cl/"> Universidad Católica del Norte</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Scripts -->
    <script> src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>  
    
    @auth
    <script>

        function changeCount() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('notificacion.cantidad') }}",
                type: 'post',
                dataType: "json",
                data: {
                    _token: _token,
                    query: {{Auth::user()->id}}, 
                },
                success: function(data) {
                    cambiarNotificacionesVen(data);
                }
            });
        }

        function cambiarNotificacionesVen(notificacion)
        {                   
            cant = 0;
            for(var i=0; i<notificacion.length; i++)
            {   
                cant = cant + 1;
            }        

            document.getElementById("cantNotify").textContent = '('+cant+')';

        }

        function markRead(idNotificacion)
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('notificacion.marcarLeidos') }}",
                type: 'post',
                dataType: "json",
                data: {
                    _token: _token,
                    user_id: {{Auth::user()->id}},
                    id_notificacion: idNotificacion
                },
                success: function(data) {        
                }
            });
        }

        $(document).ready(function() {
            changeCount();
            setInterval(changeCount, 10000);
        });
    </script>
    @endauth
    
    @yield('scripts')
</body>

</html>