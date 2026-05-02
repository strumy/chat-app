@extends('layouts.chat')

@section('page_title')
    {{ "Chat App | Dashboard" }}
@endsection

@section('sidebar')

<div class="list-group list-group-flush">
    <a href="{{ route('chat.index') }}"
        class="list-group-item list-group-item-action h4 px-2">
        List of Users
    </a>
</div>
@endsection

@section('content')

@endsection