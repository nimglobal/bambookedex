@extends('layouts.app')

@section('content')
<div class="container">
   <div class="col mt-4">
      <center>
         @if($entrenador->picture)
            <img width="100" src="/img/perfil/{{ $entrenador->picture }}" />
         @else
            <img width="100" src="/img/perfil/default.jpg" />
         @endif
         <div class="accordion-body mt-2 text-start" style="width: 40%;">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">{{ $entrenador->name}} {{ $entrenador->lastname}}</h5>
                  <h5 class="card-title">{{ $entrenador->email}}</h5>
                  <hr />
                  <p class="card-text">Pokemon</p>
                  <ul>
                     @foreach ($pokemones as $pokemon)
                        <li>{{ $pokemon->nombre}}</li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
      </center>
   </div>
</div>
@endsection
