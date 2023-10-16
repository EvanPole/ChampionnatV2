@extends('layout.navbar')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Information sur l'équipe : {{ $equipe->ville }}</h1>
            <div class="alert alert-secondary" role="alert">
                <p>Equipe : {{ $equipe->ville }}</p>
                <p>Categorie : {{ $equipe->categorie }}</p>
                <p>Championnat : {{ $equipe->championnat }}</p>
            </div>
    </div>
@endsection
