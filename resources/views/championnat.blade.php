@extends('layout.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Matches à venir</h1>
        <div class="table-responsive m-5">
            <h2>Match à venir</h2>
            <ul class="list-group">
                @foreach ($match as $matchs)
                    <li class="list-group-item">
                        @foreach ($equipe as $equipes)
                            @if ($equipes->id == $matchs->visiteur)
                                <span class="badge bg-primary">{{$equipes->ville}}</span>
                            @endif
                        @endforeach
                        <span >-</span>
                        @foreach ($equipe as $equipes)
                            @if ($equipes->id == $matchs->domicile)
                                <span class="badge bg-primary">{{$equipes->ville}}</span>
                            @endif
                        @endforeach
                        <span class="badge bg-info">Date : {{ $matchs->date }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
