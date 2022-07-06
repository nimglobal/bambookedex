@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-3">
            @if($capturado == 1)
                <div>
                    <a class="btn btn-outline-danger" href="{{ route('liberarPokemon') }}"
                onclick="event.preventDefault();
                document.getElementById('liberar-form').submit();">
                        <img class="navbar-brand ball-size" width="30" src="{{asset('img/pokeball.svg')}}" alt="Pokéball Logo" aria-label="Pokéball Logo"> {{ __('Liberar') }}
                    </a>
                    <form id="liberar-form" action="{{ route('liberarPokemon') }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">
                    </form>
                </div>
            @else
                <div>
                    <a class="btn btn-outline-success" href="{{ route('capturarPokemon') }}"
                onclick="event.preventDefault();
                document.getElementById('capturar-form').submit();">
                       <img class="navbar-brand ball-size" width="30" src="{{asset('img/pokeball.svg')}}" alt="Pokéball Logo" aria-label="Pokéball Logo"> {{ __('Capturar') }}
                    </a>
                    <form id="capturar-form" action="{{ route('capturarPokemon') }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">
                        <input type="hidden" name="name" value="{{$nombre}}">
                    </form>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col offset-md-2">
            <div class="accordion-body" style="width: 60%;">
                <div class="card">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/{{$id}}.gif" class="" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$nombre}}</h5><hr />
                        <p class="card-text">Peso: {{$peso}}</p>
                        <p class="card-text">Altura: {{$altura}}</p>
                        <p class="card-text">Experiencia base: {{$experiencia}}</p>
                        <p class="card-text">Tipo: </p>
                        <ul>
                            @foreach ($tipo as $type => $value)
                                <li>{{$value['type']['name']}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="accordion mt-3" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <strong>Abilities</strong>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <ul>
                            @foreach ($habilidades as $habilidad => $value)
                                <li>{{$value['ability']['name']}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <strong>Stats</strong>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                @foreach ($estadisticas as $stats => $value)
                                    <li>Name: {{$value['stat']['name']}}</li>
                                    <li>Base Stat: {{$value['base_stat']}}</li>
                                    <li>effort: {{$value['effort']}}</li>
                                    <hr>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <strong>Moves</strong>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                @foreach ($movimientos as $move => $value)
                                    <li>{{$value['move']['name']}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--@if($capturado == 1)
        <div>
            <a class="dropdown-item" href="{{ route('liberarPokemon') }}"
                onclick="event.preventDefault();
                document.getElementById('liberar-form').submit();">
                {{ __('Liberar') }}
            </a>
            <form id="liberar-form" action="{{ route('liberarPokemon') }}" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="id" value="{{$id}}">
            </form>
        </div>
    @else
        <div>
            <a class="dropdown-item" href="{{ route('capturarPokemon') }}"
                onclick="event.preventDefault();
                document.getElementById('capturar-form').submit();">
                {{ __('Capturar') }}
            </a>
            <form id="capturar-form" action="{{ route('capturarPokemon') }}" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="id" value="{{$id}}">
                <input type="hidden" name="name" value="{{$nombre}}">
            </form>
        </div>
    @endif

    <div>
        <img src="{{$imagen}}">
        <p>Nombre: {{$nombre}}</p>
        <p>Experiencia base: {{$experiencia}}</p>
        <p>Habilidades</p>
        <ul>
        @foreach ($habilidades as $habilidad => $value)
            <li>{{$value['ability']['name']}}</li>
        @endforeach
        </ul>
        <p>Peso: {{$peso}}</p>
        <p>Altura: {{$altura}}</p>
        <p>Tipo</p>
        <ul>
        @foreach ($tipo as $type => $value)
            <li>{{$value['type']['name']}}</li>
        @endforeach
        </ul>
        <p>Estadísticas</p>
        <ul>
        @foreach ($estadisticas as $stats => $value)
            <li>Nombre: {{$value['stat']['name']}}</li>
            <li>Estadística base: {{$value['base_stat']}}</li>
            <li>Esfuerzo: {{$value['effort']}}</li>
            <li><hr></li>
        @endforeach
        </ul>
        <p>Movimientos</p>
        <ul>
        @foreach ($movimientos as $move => $value)
            <li>{{$value['move']['name']}}</li>
        @endforeach
        </ul>
    </div>-->
</div>
@endsection
