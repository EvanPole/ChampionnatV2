@extends('layout.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Modifier un Match</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('match.update',  ['match' => $match->id]) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="ville">Equipe 1 :</label>
                                <select class="form-select" name="equipe1" id="">
                                    @foreach ($equipes as $equipe)
                                        @if ($equipe->id == $match->domicile)
                                        <option value="{{$equipe->id}}" selected>{{ $equipe->ville}}</option>
                                        @else
                                            <option value="{{$equipe->id}}">{{ $equipe->ville}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categorie">Equipe 2 :</label>
                                <select class="form-select" name="equipe2" id="">
                                    @foreach ($equipes as $equipe)
                                        @if ($equipe->id == $match->visiteur)
                                        <option value="{{$equipe->id}}" selected>{{ $equipe->ville}}</option>
                                        @else
                                            <option value="{{$equipe->id}}">{{ $equipe->ville}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="championnat">Date du match:</label>
                                <input type="date" class="form-control" value="{{ $match->date }}" name="date" id="date" placeholder="Date">
                            </div>
                            <div class="form-group">
                                <label for="but1">But Visiteur:</label>
                                <input type="number" name="but1" id="but1" value="{{ $match->but_visiteur }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="but2">But Domicile:</label>
                                <input type="number" name="but2" id="but2" value="{{ $match->but_domicile }}" class="form-control">
                            </div>
                            <button class="btn btn-success" type="submit">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
