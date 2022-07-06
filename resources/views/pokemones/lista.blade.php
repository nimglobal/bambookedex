@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5">My Pokemon</h2>
    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Date of capture</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pokemones as $pokemon => $value)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>{{ $value->nombre }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{$value->id_pokemon}}.png"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
