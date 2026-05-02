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

                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('chat.index') }}">Chat</a></li>
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