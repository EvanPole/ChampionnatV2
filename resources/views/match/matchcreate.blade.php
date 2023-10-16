@extends('layout.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Ajouter un Match</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('match.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="ville">Equipe 1 :</label>
                                <select class="form-select" name="equipe1" id="">
                                    @foreach ($equipes as $equipe)
                                        <option value="{{$equipe->id}}">{{ $equipe->ville}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categorie">Equipe 2 :</label>
                                <select class="form-select" name="equipe2" id="">
                                    @foreach ($equipes as $equipe)
                                        <option value="{{$equipe->id}}">{{ $equipe->ville}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="championnat">Date du match:</label>
                                <input type="date" class="form-control" name="date" id="date" placeholder="Date">
                            </div>
                            <button class="btn btn-success" type="submit">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
