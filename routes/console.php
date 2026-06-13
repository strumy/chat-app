<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Events\UserStatusChanged;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {

    logger()->info('Offline checker running', [
        'time' => now()->toDateTimeString()
    ]);

    User::query()
        ->whereNotNull('last_seen_at')
        ->where('offline_broadcasted', false)
        ->where(
            'last_seen_at',
            '<',
            now()->subMinutes(2)
        )
        ->get()
        ->each(function ($user) {

            logger()->info(
                'Broadcasting user status',
                [
                    'user_id' => $user->id
                ]
            );

            broadcast(
                new UserStatusChanged(
                    $user,
                    false
                )
            );

            $user->update([
                'offline_broadcasted' => true
            ]);
        });

})->everyMinute();