@extends('layout.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Création d'un nouveau joueur</h1>

        <div class="card shadow-lg" style="border: 2px solid #673AB7;">
            <div class="card-body">
                <form action="{{ route('joueur.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom du joueur:</label>
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom du joueur" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom du joueur:</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom du joueur" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="email">Email du joueur:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email du joueur" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="tel">Téléphone du joueur:</label>
                        <input type="tel" class="form-control" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" name="tel" id="tel" placeholder="Téléphone du joueur" required>
                    </div>
                    <div class="form-group">
                        <label for="equipe_id">Équipe du joueur:</label>
                        <select class="form-control" name="equipe_id" id="equipe_id" required>
                            @foreach ($equipes as $equipe)
                                <option value="{{ $equipe->id }}">{{ $equipe->ville }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sexe">Sexe du joueur:</label>
                        <select class="form-control" name="sexe" id="sexe" required>
                            <option value="0">Homme</option>
                            <option value="1">Femme</option>
                        </select>
                    </div>

                    <button class="btn btn-success btn-block" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
