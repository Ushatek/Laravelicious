<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laravelicious
    </title>
    <link rel="stylesheet" href="/css/app.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<link rel="shortcut icon" type="image/jpg" href="/img/favicon.ico" />

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-navbar" id="headerNav">
        <div class="container-fluid">
            <a class="navbar-brand d-block d-lg-none" href="#">
                <img src="/img/logo.png" height="80" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="/">Strona główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="/menu">Menu</a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link mx-2" href="#">
                            <img src="/img/logo.png" height="80" />
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="/zamowienia">Zamówienia</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Konto
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @if(Session::has('nazwazalogowanego'))
                                <li><a class="dropdown-item" href="/logout">Wyloguj</a></li>
                            @else
                                <li><a class="dropdown-item" href="/logowanie">Zaloguj</a></li>
                                <li><a class="dropdown-item" href="/rejestracja">Zarejestruj</a></li>
                            @endif

                            
                            
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
            <div class="col-sm-12">
                @yield('menu')
            </div>
    </div>

    <!-- wywolanie widoku konkretnej strony -->
    @yield('content')

    <!-- Stopka -->
    <br>
    <br>
    <footer>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            Projekt stworzony przez Michała Wójcika na zajęcia realizowane w
            <a class="text-reset fw-bold" href="https://www.wsb-nlu.edu.pl/"> WSB-NLU</a>.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @yield('scripts')
</body>

</html>