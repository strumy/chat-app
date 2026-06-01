@extends('layouts.app')

@section('page_title')
    {{ "Chat App | Register" }}
@endsection

@section('header')
    <header class="masthead bg-primary text-white">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-body p-4">

                        <h3 class="text-center mb-4">Create an Account</h3>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    required
                                    autofocus
                                    autocomplete="name">

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    required
                                    autocomplete="username">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password"
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    required
                                    autocomplete="new-password">

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    required
                                    autocomplete="new-password">

                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Actions --}}
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('login') }}" class="text-decoration-none">
                                    {{ __('Already registered?') }}
                                </a>

                                <button type="submit" class="btn btn-primary px-4">
                                    {{ __('Register') }}
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection


