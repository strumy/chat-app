<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('page_title', config('app.name', 'Chat App'))</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                overflow: hidden;
            }
            .sidebar {
                width: 260px;
                height: 100vh;
                overflow-y: auto;
                border-right: 1px solid #ddd;
            }
            .chat-container {
                height: calc(100vh - 56px);
                overflow: hidden;
            }
        </style>
    </head>

    <body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                {{ config('app.name', 'Chat App') }}
            </a>

            <div class="d-flex">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="d-flex chat-container">

        <!-- SIDEBAR -->
        <div class="sidebar bg-white">
            @yield('sidebar')
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-grow-1 overflow-hidden">
            @yield('content')
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>