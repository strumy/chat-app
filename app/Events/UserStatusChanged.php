<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public User $user, public bool $online)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        //\Log::info('Broadcasting user status.' . $this->user->last_seen_at);

         \Log::info(
            'UserStatusChanged::broadcastOn',
            [
                'user_id' => $this->user->id,
                'online' => $this->online,
            ]
            );

        return [
            new Channel('user-status')
        ];
    }

    public function broadcastAs(): string
    {
        return 'user.status.changed';
    }

    public function broadcastWith(): array
    {
        \Log::info('UserStatusChanged event', [
            'user_id' => $this->user->id,
            'online' => $this->online,
            'last_seen_at' => $this->user->last_seen_at,
        ]);

        return [
            'id' => $this->user->id,
            'online' => $this->online,
            'last_seen_at' => $this->user->last_seen_at?->toISOString(),
        ];
    }
}