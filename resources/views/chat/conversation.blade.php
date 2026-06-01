@extends('layouts.chat')

@section('sidebar')
    @include('chat.users-list');
@endsection

@section('content')
<div class="d-flex flex-column h-100 p-3 bg-dark"
     x-data="chatComponent({{ $user->id }}, '{{ route('chat.list', $user->id) }}', '{{ route('chat.send', $user->id) }}')"
     x-init="init()">

    <!-- Chat Header -->
    <div class="border-bottom pb-2 mb-3">
        <h5 class="mb-0"><i class="fa-solid fa-user"></i> {{ $user->name }}</h5>
    </div>

    <div x-show="error" class="alert alert-danger" x-text="error"></div>
    <!-- Messages -->
    <div x-show="loading" class="text-center my-3">
        <div class="spinner-border text-primary"></div>
    </div>
    <div class="flex-grow-1 overflow-auto" x-ref="messagesBox">
        <template x-for="m in messages" :key="m.id">
            <div class="mb-3 d-flex"
                 :class="m.sender_id == authId ? 'justify-content-end' : 'justify-content-start'">

                <div class="p-2 rounded-3 m-2"
                     :class="m.sender_id == authId
                        ? 'bg-light text-dark border'
                        : 'bg-secondary text-light border'">
                    <span x-text="m.content"></span>
                    <div class="small text-muted mt-1" x-text="formatTime(m.created_at)"></div>
                </div>

            </div>
        </template>
    </div>

    <!-- Input -->
    <form @submit.prevent="sendMessage" class="mt-3 d-flex gap-2">
        <input type="text" name="content" class="form-control" placeholder="Type a message..." x-model="content">
        <button class="btn btn-primary">Send</button>
    </form>

</div>

<script>
function chatComponent(userId, fetchUrl, sendUrl) {
    return {
        authId: {{ auth()->id() }},
        messages: [],
        content: '',
        fetchUrl,
        sendUrl,
        error: null,
        loading: false, 

        init() {
            //console.log("fetchUrl:", this.fetchUrl);
            this.loadMessages();
            //setInterval(() => this.loadMessages(), 3000);

            if (window.Echo) {
                window.Echo.private('chat.' + this.authId)
                    .subscribed(() => {
                        console.log('Subscribed to chat.' + this.authId);
                    })
                    .error((error) => {
                        console.error('Subscription error:', error);
                    })
                    .listen('MessageSent', (e) => {
                        console.log('Message received:', e);
                        this.messages.push(e.message);
                        this.$nextTick(() => {
                            this.$refs.messagesBox.scrollTop = this.$refs.messagesBox.scrollHeight;
                        });
                    });
            } else {
                console.error("Echo not loaded yet");
            }
        },

        async loadMessages() {
            try {
                const res = await fetch(this.fetchUrl, { 
                    headers: { 'Accept': 'application/json' }});

                if (!res.ok) throw new Error('Failed to load messages');
                
                this.messages = await res.json();
            } catch (err) {
                this.error = err.message;
            } finally {
                this.loading = false;
            }
            this.$nextTick(() => {
                this.$refs.messagesBox.scrollTop = this.$refs.messagesBox.scrollHeight;
            });
        },

        async sendMessage() {
            if (!this.content.trim()) return;

            const res = await fetch(this.sendUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(
                    {
                        receiver_id: userId,
                        content: this.content
                    })
            });
            console.log(res);

            this.content = '';
            this.loadMessages();
        },

        formatTime(ts) {
            const time = new Date(ts).toLocaleTimeString();
            return time;
        }
    }
}
</script>
@endsection

