@extends('layout.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">{{ __('T3') }}</h1>
        @if (!empty($eqjoueurs))
            @foreach ($eqjoueurs as $eqjoueur)
                <div class="card mb-3">
                    <div class="card-header">
                        <h2>{{ $eqjoueur['equipe']->ville }}</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="table-primary">
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Sexe</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eqjoueur['joueurs'] as $joueur)
                                    <tr>
                                        <td>{{ $joueur->nom }}</td>
                                        <td>{{ $joueur->prenom }}</td>
                                        <td>{{ $joueur->tel }}</td>
                                        <td>{{ $joueur->email }}</td>
                                        <td>
                                            @if ($joueur->sexe == 0)
                                                Homme
                                            @elseif ($joueur->sexe == 1)
                                                Femme
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST"
                                                action="{{ route('joueur.destroy', ['joueur' => $joueur->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="btn-group">
                                                    <input type="submit" class="btn btn-danger delete-user"
                                                        value="{{ __('sup') }}">
                                                        <a class="btn btn-primary"
                                                        href="{{ route('joueur.show', ['joueur' => $joueur->id]) }}">{{ __('info') }}</a>
                                                    <a class="btn btn-secondary"
                                                        href="{{ route('joueur.edit', ['joueur' => $joueur->id]) }}">{{ __('edit') }}</a>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a class="btn btn-success" href="{{ route('joueur.create') }}">Ajouter un joueur</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-secondary" role="alert">
                Aucune équipe disponible avec des joueurs.
            </div>
        @endif
    </div>
@endsection
