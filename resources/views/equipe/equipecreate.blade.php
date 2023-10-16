@extends('layout.navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Ajouter une équipe</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('equipe.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="ville">Ville de l'équipe:</label>
                                <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville de l'équipe" required maxlength="75">
                            </div>
                            <div class="form-group">
                                <label for="categorie">Catégorie de l'équipe:</label>
                                <input type="text" class="form-control" name="categorie" id="categorie" placeholder="Catégorie de l'équipe" required maxlength="75">
                            </div>
                            <div class="form-group">
                                <label for="championnat">Championnat de l'équipe:</label>
                                <input type="text" class="form-control" name="championnat" id="championnat" placeholder="Championnat de l'équipe" required maxlength="75">
                            </div>
                            <button class="btn btn-success" type="submit">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
