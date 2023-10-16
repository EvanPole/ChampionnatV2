@extends('layout.navbar')
@section('content')
    <div class="container mt-5">
        {{-- <a class="btn btn-success" href="{{ route('championnat.index') }}">retour</a> --}}
        <h1 class="mb-4">Modification des informations de l'équipe : {{ $equipe->ville }}</h1>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('equipe.update', ['equipe' => $equipe->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="ville">Ville de l'équipe:</label>
                        <input type="text" class="form-control" name="ville" id="ville" value="{{ $equipe->ville }}"
                            placeholder="Ville de l'équipe" required maxlength="75">
                    </div>
                    <div class="form-group">
                        <label for="categorie">Catégorie de l'équipe:</label>
                        <input type="text" class="form-control" name="categorie" id="categorie"
                            value="{{ $equipe->categorie }}" placeholder="Catégorie de l'équipe" required maxlength="75">
                    </div>
                    <div class="form-group">
                        <label for="championnat">Championnat de l'équipe:</label>
                        <input type="text" class="form-control" name="championnat" id="championnat"
                            value="{{ $equipe->championnat }}" placeholder="Championnat de l'équipe" required maxlength="75">
                    </div>
                    <button class="btn btn-success" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>

        <h2 class="mt-5">Liste des joueurs de l'équipe</h2>
        @forelse ($player as $players)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Nom du joueur : {{ $players->nom }} {{ $players->prenom }}</h5>
                    <p class="card-text">Téléphone : {{ $players->tel }}</p>
                    <p class="card-text">Email : {{ $players->email }}</p>
                </div>
            </div>
        @empty
            <div class="alert alert-secondary" role="alert">
                Désolé, il n'y a pas de joueurs !
            </div>
        @endforelse
    </div>
@endsection
