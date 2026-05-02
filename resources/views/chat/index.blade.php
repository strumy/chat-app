@extends('layouts.chat')

@section('page_title')
    {{ "Chat App | Chat" }}
@endsection

@section('sidebar')
<div class="list-group list-group-flush">
    <a href="{{ route('chat.index') }}"
        class="list-group-item list-group-item-action h4 px-2">
        List of Users
    </a>
    @foreach($users as $u)
        <a href="{{ route('chat.list', $u->id) }}"
           class="list-group-item list-group-item-action">
            {{ $u->name }}
        </a>
    @endforeach
</div>
@endsection

@section('content')
<div class="d-flex justify-content-center align-items-center h-100">
    <h4 class="text-muted">Select a user to start chatting</h4>
</div>
@endsection
