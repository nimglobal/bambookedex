<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ config('app.name', 'Bambookedex') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  </head>
  <body>
    <div id="app">
        @if(Auth::user() && Auth::user()->first_login != 0)
            <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/home"><img class="navbar-brand ball-size" width="30" src="{{asset('img/pokeball.svg')}}" alt="Pokéball Logo" aria-label="Pokéball Logo"><img class="navbar-brand ball-size" width="140" src="{{asset('img/bambookedex.png')}}" alt="Logo" aria-label="Logo"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @if(Auth::user()->type == 1)
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/entrenadores/lista">Trainers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('registrar') }}">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/notificacion/enviar">Notifications</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/pokemon/lista">Pokemon</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"href="/entrenadores/ranking">Ranking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/entrenadores/perfil">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/notificacion/lista">Notifications</a>
                            </li>
                            @endif
                        </ul>
                        <div class="nav-item dropdown d-flex">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        @endif
        <main class="col-12">
            @yield('content')
        </main>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>