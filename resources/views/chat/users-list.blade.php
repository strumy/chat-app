<div class="list-group list-group-flush py-2">
    <a href="{{ route('chat.index') }}"
        class="list-group-item list-group-item-action h4 px-2">
        Members
    </a>
    @if(isset($users))
    @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $u)
        <a href="{{ route('chat.list', $u->id) }}"
           class="list-group-item list-group-item-action 
           @if(isset($user)) @if($u->id == $user->id) active @endif
           @endif
           ">
            <i class="fa-solid fa-user"></i>
            {{ $u->name }}
        </a>
    @endforeach
    @endif
</div>