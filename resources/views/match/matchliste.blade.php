@extends('layout.navbar')
@section('content')

    <h1 class="text-center">{{ __('T1') }}</h1>
    <div class="table-responsive m-5">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">Domicile</th>
                    <th scope="col">Visiteur</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($match as $matchs)
                    @php
                        $equipeDomicile = null;
                        $equipeVisiteur = null;
                    @endphp
                    @foreach ($equipe as $equipes)
                        @if ($matchs->domicile == $equipes->id)
                            @php
                                $equipeDomicile = $equipes;
                            @endphp
                        @endif
                        @if ($matchs->visiteur == $equipes->id)
                            @php
                                $equipeVisiteur = $equipes;
                            @endphp
                        @endif
                    @endforeach

                    @if ($equipeDomicile && $equipeVisiteur)
                        <tr>
                            <td>{{ $equipeDomicile->ville }}</td>
                            <td>{{ $equipeVisiteur->ville }}</td>
                            <td>{{ $matchs->date }}</td>
                            <td>
                                <form method="POST" action="{{ route('match.destroy', ['match' => $matchs->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn-group">
                                        @if (Bouncer::can('acces'))
                                            <input type="submit" class="btn btn-danger delete-user"
                                                value="{{ __('sup') }}">
                                            <a class="btn btn-primary"
                                                href="{{ route('match.show', ['match' => $matchs->id]) }}">{{ __('info') }}</a>
                                        @endif
                                        @if (Bouncer::can('match-edit'))
                                            <a class="btn btn-secondary"
                                                href="{{ route('match.edit', ['match' => $matchs->id]) }}">{{ __('resm') }}</a>
                                        @endif
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="alert alert-secondary" role="alert">
                                Ha, Flut il n'y a pas de matchs !
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if (Bouncer::can('acces'))
            <a class="btn btn-success" href="{{ route('match.create') }}">Ajouter un match</a>
        @endif
    </div>

@endsection
