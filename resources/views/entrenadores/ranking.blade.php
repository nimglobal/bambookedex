@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5">Pokemon Trainer - Ranking</h2>
    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Picture</th>
                <th scope="col">Name</th>
                <th scope="col">Number of pokemon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entrenadores as $entrenador)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>
                        @if($entrenador->picture)
                            <img width="60" src="/img/perfil/{{ $entrenador->picture }}" />
                        @else
                            <img width="60" src="/img/perfil/default.jpg" />
                        @endif
                    </td>
                    <td>{{ $entrenador->name }}</td>
                    <td>{{ $entrenador->pokemones }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
