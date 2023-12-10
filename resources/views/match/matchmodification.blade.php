@extends('layout.navbar')

@section('content')
    <div class="container mt-5">
        <x-titre name="Modifier un Match" />
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('match.update', ['match' => $match->id]) }}" method="post">
                            @csrf
                            @method('put')
                                <div class="form-group">
                                    <label for="ville">Equipe 1 :</label>
                                    <select class="form-select" name="equipe1" id="">
                                        @foreach ($equipes as $equipe)
                                            @if ($equipe->id == $match->domicile)
                                                <option value="{{ $equipe->id }}" selected>{{ $equipe->ville }}</option>
                                            @else
                                                <option value="{{ $equipe->id }}">{{ $equipe->ville }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            <div class="form-group">
                                <label for="categorie">Equipe 2 :</label>
                                <select class="form-select" name="equipe2" id="">
                                    @foreach ($equipes as $equipe)
                                        @if ($equipe->id == $match->visiteur)
                                            <option value="{{ $equipe->id }}" selected>{{ $equipe->ville }}</option>
                                        @else
                                            <option value="{{ $equipe->id }}">{{ $equipe->ville }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="championnat">Date du match:</label>
                                <input type="date" class="form-control"
                                    value="{{ date('Y-m-d', strtotime($match->date)) }}" name="date" id="date"
                                    placeholder="Date">

                            </div>
                            <button class="btn btn-success" type="submit">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
