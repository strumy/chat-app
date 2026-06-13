<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{userId}', function ($user, $userId) {
    return [
        'id' => $user->id,
        'name' => $user->name,
    ];
});

Broadcast::channel('user-status', function ($user, $userId) {
    return [
        'id' => $user->id,
        'name' => $user->name,
    ];
});