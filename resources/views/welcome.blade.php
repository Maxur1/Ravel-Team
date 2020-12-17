<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UCN - Fichas de atención personal de los estudiantes DISC</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #EFF0F1;
            color: #636b6f;
            font-family: sans-serif;
            font-weight: 20;
            height: 100vh;
            margin: 0px;
        }

        .element2 {
            padding-top: 10%;
        }

        footer {
            position: fixed;
            height: 60px;
            bottom: 0;
            left: 0;
            width: 100%;
            /* line-height: 60px; */
            background-color: #23415B;
            text-align: center;
            color: rgba(245, 245, 245, .65);
        }

        .footer-text {
            font-size: 75%;
        }
    </style>

</head>

<body>

    <!-- NavBar -->
    <div class="navBar2" id="app">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #23415B">
            <!-- Logo UCN -->
            <a class="navbar-brand" href="{{ url('/')}}">
                <img src="{{URL::asset('img/Isologo-UCN-2018.png')}}" height="45px" alt="Logo-UCN" loading="lazy">
            </a>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Lado derecho de la barra de navegación -->
                <ul class="nav navbar-nav ml-auto">
                    <!-- Links de autenticación -->
                    @guest

                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <!-- Si el usuario es un administrador... -->
                    @if(Auth::user()->rol === 'Administrador' )
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">Administrar usuarios<span class="sr-only">(current)</span></a>
                    </li>
                    @endif

                    <!-- CERRAR SESIÓN -->
                    <div class="dropdown">
                        <button style="color: rgba(255,255,255,.75)" class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>

                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- El botón activa el formulario que permite el logout -->
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                    @endguest

            </div>
        </nav>
    </div>
    @auth

    @endauth
    <!-- Si el usuario no está logueado -->

    @guest
    <div class="container element2">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-secondary">

                    <div class="card-header text-center">
                        <strong>Ingreso al sistema</strong>
                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <div class="col-md-9 mx-auto">
                                    <div class="input-group">

                                        <input id="email" type="email" placeholder="Correo Electrónico" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <br>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                    <div class="col-md-9 mx-auto">
                                        <input id="password" placeholder="Contraseña" type="password" class="form-control " name="password" required>

                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                <br>

                                <div class="form-group text-center">

                                    <button type="submit" class="btn btn-danger">
                                        Ingresar
                                    </button>

                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endguest

    <footer>
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3 footer-text">Ingeniería de Software II-2020:
            <a style="color: #EFF0F1" href="https://www.ucn.cl/"> Universidad Católica del Norte</a>
        </div>
        <!-- Copyright -->
    </footer>



</body>

</html>

<script src="{{ asset('js/app.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>