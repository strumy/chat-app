<div class="list-group list-group-flush py-2">
    <a href="{{ route('chat.index') }}"
        class="list-group-item list-group-item-action h4 px-2">
        Members
    </a>
    @if(isset($users))
    @foreach($users as $u)
        <a href="{{ route('chat.list', $u->id) }}"
           class="list-group-item list-group-item-action 
           @if(isset($user)) @if($u->id == $user->id) active @endif
           @endif
           ">
           @if($u->isOnline()) 🟢 <i class="fa-solid fa-user"></i>
                @else⚫ <i class="fa-solid fa-user"></i> @endif
            
            {{ $u->name }} &nbsp;
            <span id="status-user-{{ $u->id }}" class="small text-secondary">
                @if($u->isOnline()) (Online)
                @else 
                (Offline)
                @endif
            </span>
        </a>
    @endforeach
    @endif
</div>

<script>
function showOnlineIndicator(userId)
{
    const el =
        document.getElementById(
            `status-user-${userId}`
        );

    if (!el) return;

    el.classList.remove(
        'text-secondary'
    );

    el.classList.add(
        'text-success'
    );

    el.innerHTML =
        '🟢 Online';
}

function showOfflineIndicator(userId, lastSeen)
{
    const el =
        document.getElementById(
            `status-user-${userId}`
        );

    if (!el) return;

    el.classList.remove(
        'text-success'
    );

    el.classList.add(
        'text-secondary'
    );

    const date =
        new Date(lastSeen);

    el.innerHTML =
        `⚫ Last seen ${date.toLocaleTimeString()}`;
}


setInterval(() => {

    console.log(
        '[Heartbeat] Sending at:',
        new Date().toLocaleTimeString()
    );

    axios.post('/chat/heartbeat')
        .then(response => {

            console.log(
                '[Heartbeat] Success:',
                response.data
            );

        })
        .catch(error => {

            console.error(
                '[Heartbeat] Failed:',
                error
            );

        });

}, 30000);
</script>
