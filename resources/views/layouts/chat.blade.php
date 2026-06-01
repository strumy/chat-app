@extends('layouts.app')

@section('body')
    <section class="page-section bg-light text-white mb-0" id="chat">
        <div class="container pt-2 mt-2">
            <div class="d-flex chat-container">

                <!-- SIDEBAR -->
                <div class="sidebar bg-white">
                    @yield('sidebar')
                </div>

                <!-- MAIN CONTENT -->
                <div class="flex-grow-1 overflow-auto">
                    @yield('content')
                </div>

            </div>
        </div>
    </section>
@endsection