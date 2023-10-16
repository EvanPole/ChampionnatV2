@extends('layout.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Information sur : {{ $joueur->nom }}</h1>
        <div class="alert alert-secondary" role="alert">
            <p>Nom : {{ $joueur->nom }}</p>
            <p>Prénom :{{ $joueur->prenom }}</p>
            <p>Tel : {{ $joueur->tel }}</p>
            <p>Email : {{ $joueur->email }}</p>
            <p>Sexe :
                @if ($joueur->sexe == 0)
                    Homme
                @elseif ($joueur->sexe == 1)
                    Femme
                @endif
            </p>
        </div>
    </div>
@endsection
