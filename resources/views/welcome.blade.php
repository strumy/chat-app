@extends('layouts.app')

@section('page_title')
    {{ "Chat App | Welcome" }}
@endsection

@section('header')
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <img class="masthead-avatar mb-5" src="{{ asset('images/chat_logo.png') }}" alt="Chatlogo" width="30"/>
            <h1 class="masthead-heading text-uppercase mb-0">Welcome to ChatApp</h1>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <p class="masthead-subheading font-weight-light mb-0">Chat one to one with your friends. Register to get started.</p>
        </div>
    </header>
@endsection

