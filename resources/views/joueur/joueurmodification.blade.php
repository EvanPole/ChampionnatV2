@extends('layout.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Modification des informations d'un joueur</h1>

        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title text-primary">Joueur : {{ $joueur->nom }} {{ $joueur->prenom }}</h5>

                <form action="{{ route('joueur.update', ['joueur' => $joueur->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nom">Nom du joueur:</label>
                        <input type="text" class="form-control" name="nom" id="nom" value="{{ $joueur->nom }}"
                            placeholder="Nom du joueur">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom du joueur:</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" value="{{ $joueur->prenom }}"
                            placeholder="Prénom du joueur">
                    </div>
                    <div class="form-group">
                        <label for="email">Email du joueur:</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $joueur->email }}"
                            placeholder="Email du joueur">
                    </div>
                    <div class="form-group">
                        <label for="tel">Téléphone du joueur:</label>
                        <input type="tel" class="form-control" name="tel" id="tel" value="{{ $joueur->tel }}"
                            placeholder="Téléphone du joueur">
                    </div>
                    <div class="form-group">
                        <label for="equipe_id">Équipe du joueur:</label>
                        <select class="form-control" name="equipe_id" id="equipe_id">
                            @foreach ($equipes as $equipe)
                                @if ($equipe->id === $joueur->equipe_id)
                                    <option value="{{ $equipe->id }}" selected>{{ $equipe->ville }}</option>
                                @else
                                    <option value="{{ $equipe->id }}">{{ $equipe->ville }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sexe">Sexe du joueur:</label>
                        <select class="form-control" name="sexe" id="sexe">
                            <option value="0" @if ($joueur->sexe == 0) selected @endif>Homme</option>
                            <option value="1" @if ($joueur->sexe == 1) selected @endif>Femme</option>
                        </select>
                    </div>

                    <button class="btn btn-success btn-block" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
