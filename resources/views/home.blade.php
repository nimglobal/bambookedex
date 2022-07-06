@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-4 mt-5">
        <form class="d-flex" method="GET">
            <input class="form-control me-2" name="pokemon" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success me-2" type="submit">Search</button>
            <a href="/home" class="btn btn-outline-info">List</a>
        </form>
    </div>
    <h2 class="mt-5">Pokemon list</h2>
    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pokemones as $pokemon => $value)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td><a href="/pokemon/ver/{{$value['name']}}">{{$value['name']}}</a></td>
                    @if($id)
                        <td><a href="/pokemon/ver/{{$value['name']}}"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{$id}}.png"></a></td>
                    @else
                        <td><a href="/pokemon/ver/{{$value['name']}}"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{$loop->index+1}}.png"></a></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            @if($prev)
                <li class="page-item">
                    <a class="page-link" href="{{ route('pagination') }}" onclick="event.preventDefault();
                document.getElementById('prev-form').submit();">Previous</a>
                    <form id="prev-form" action="{{ route('pagination') }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="url" value="{{$prev}}">
                    </form>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
            @endif
            @if($next)
                <li class="page-item">
                    <a class="page-link" href="{{ route('pagination') }}" onclick="event.preventDefault();
                document.getElementById('next-form').submit();">Next</a>
                <form id="next-form" action="{{ route('pagination') }}" method="POST" class="d-none">
                    @csrf
                    <input type="hidden" name="url" value="{{$next}}">
                </form>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
@endsection
