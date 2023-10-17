<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des joueurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">⚽️ Championnat</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                @if (Bouncer::can('match-edit'))
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('match.index') }}">{{ __('nav_2') }}</a>
                        </li>
                    </ul>
                @elseif (Bouncer::can('acces'))
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('championnat.index') }}">{{ __('nav_1') }}</a>
                        </li>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('match.index') }}">{{ __('nav_2') }}</a>
                            </li>
                        </ul>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('equipe.index') }}">{{ __('nav_3') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('joueur.index') }}">{{ __('nav_4') }}</a>
                        </li>
                    </ul>
                @endif

            </div>
            @if (!Auth::check())
                <a style="margin-right: 6px" class="btn btn-outline-dark btn-sm" href="{{ route('login') }}">Login </a>
                <a style="margin-right: 6px" class="btn btn-outline-dark btn-sm"
                    href="{{ route('register') }}">inscription</a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button style="margin-right: 6px" type="submit"
                        class="btn btn-outline-dark btn-sm">Déconnexion</button>
                </form>
            @endif


            <form action="{{ route('change.language') }}" method="post" id="languageForm">
                @csrf
                <select name="language" id="language" class="form-select form-select-sm">
                    <option value="fr" @if (session('locale') == 'fr') selected @endif>🇫🇷 {{ __('FR') }}
                    </option>
                    <option value="en" @if (session('locale') == 'en') selected @endif>🇬🇧 {{ __('EN') }}
                    </option>
                </select>
            </form>


        </div>
    </nav>
    @yield('content')

    <script>
        document.getElementById('language').addEventListener('change', function() {
            document.getElementById('languageForm').submit();
        });
    </script>
</body>

</html>
