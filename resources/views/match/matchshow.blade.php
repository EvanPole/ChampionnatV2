@extends('layout.navbar')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4"></h1>
        <div class="alert alert-secondary" role="alert">
            Domicile:
            @foreach ($equipe as $equipes)
                @if ($match->domicile == $equipes->id)
                    <td>{{ $equipes->ville }}</td>
                @endif
            @endforeach
            Visiteur:
            @foreach ($equipe as $equipes)
                @if ($match->visiteur == $equipes->id)
                    <td>{{ $equipes->ville }}</td>
                @endif
            @endforeach
            date: {{$match->date}}
        </div>
    </div>
@endsection
