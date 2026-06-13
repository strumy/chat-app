<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:check-offline-users')]
#[Description('Command if users are offline')]
class CheckOfflineUsers extends Command
{
    protected $signature = 'chat:offline-check';

    protected $description = 'Mark users offline and broadcast status changes';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::query()
                ->whereNotNull('last_seen_at')
                ->where(
                    'last_seen_at',
                    '<',
                    now()->subSeconds(90)
                )->get();

        foreach ($users as $user) {
            if (!$user->offline_broadcasted) {
                broadcast(
                    new UserStatusChanged(
                        $user,
                        false
                    )
                );

                $user->update([
                    'offline_broadcasted' => true
                ]);

                $user->refresh();

                logger()->info(
                    'offline_broadcasted updated',
                    [
                        'user_id' => $user->id,
                        'value' => true,
                        'offline_broadcasted' => $user->offline_broadcasted,
                    ]
                );
            }
        }
    }
}
