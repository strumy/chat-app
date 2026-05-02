@extends('layouts.app')

@section('body')
    <section class="page-section bg-primary text-white mb-0" id="chat">
        <div class="d-flex chat-container">

            <!-- SIDEBAR -->
            <div class="sidebar bg-white">
                @yield('sidebar')
            </div>

            <!-- MAIN CONTENT -->
            <div class="flex-grow-1 overflow-scroll">
                @yield('content')
            </div>

        </div>
    </section>
@endsection