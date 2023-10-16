@extends('layout.navbar')
@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Liste des équipes</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">Équipe</th>
                    <th scope="col">Nb. Membres</th>
                    <th scope="col">Victoires</th>
                    <th scope="col">Nuls</th>
                    <th scope="col">Défaites</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($equipe as $equipes)
                    <tr>
                        <th scope="row">{{ $equipes->ville }}</th>
                        <td>{{ $playerCounts[$equipes->id] }}</td>
                        <td>{{ $victoires[$equipes->id] }}</td>
                        <td>{{ $nul[$equipes->id] }}</td>
                        <td>{{ $defaites[$equipes->id] }}</td>
                        <td>
                            <form method="POST" action="{{ route('equipe.destroy', ['equipe' => $equipes->id]) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <div class="btn-group">
                                    <input type="submit" class="btn btn-danger delete-user" value="Supprimer">
                                    <a class="btn btn-primary" href="{{ route('equipe.show', ['equipe' => $equipes->id]) }}">Info</a>
                                    <a class="btn btn-secondary" href="{{ route('equipe.edit', ['equipe' => $equipes->id]) }}">Éditer</a>
                                </div>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-secondary" role="alert">
                                Ha, Flûte, il n'y a pas d'équipe !
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a class="btn btn-success mb-3" href="{{ route('equipe.create') }}">Ajouter une nouvelle équipe</a>
    </div>
@endsection
