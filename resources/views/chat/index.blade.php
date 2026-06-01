@extends('layouts.chat')

@section('page_title')
    {{ "Chat App | Chat" }}
@endsection

@section('sidebar')
    @include('chat.users-list');
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <h4 class="text-muted">Select a user to start chatting</h4>
    </div>
@endsection
