<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('page_title', config('app.name', 'Chat App'))</title>

        <!-- Fonts -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />

        <!-- Styles / Scripts-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body id="page-top">
        <!-- Navigation-->
        @if (Route::has('login'))
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/chat_logo.png') }}" width="40" height="40" class="d-inline-block align-top" alt="">
                    ChatApp
                </a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        @auth
                        <li class="nav-item mx-0 mx-lg-1">
                            <span class="nav-link py-3 px-0 px-lg-3 rounded text-white text-capitalize">
                                <b class="text-info">Welcome &nbsp;</b>
                                <i class="fa-notdog fa-solid fa-user"></i>
                                {{ Auth::user()->name }}
                            </span>
                        </li>

                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/dashboard') }}">Dashboard</a></li>
                        @else
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('login') }}">Login</a></li>
                        @if (Route::has('register'))
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('register') }}">Register</a></li>
                        @endif
                        @endauth
                        
                        @auth
                        <li class="nav-item mx-0 mx-lg-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-link py-3 px-0 px-lg-3 rounded text-white text-uppercase">Logout</button>
                        </form>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        @endif
        
        @yield('header')

        @yield('body')
        
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; <a href="https://chatapp.articulatedlogic.com/">ChatApp</a> 2026 by <a href="https://strumy.github.io">@strumy</a>.</small></div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>