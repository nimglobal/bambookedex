@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5">Notifications</h2>
    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Text</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notificaciones as $notificacion)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>{{ json_decode( $notificacion->data, true)['titulo'] }}</td>
                    <td>{{ json_decode( $notificacion->data, true)['contenido'] }}</td>
                    <td>{{ $notificacion->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
