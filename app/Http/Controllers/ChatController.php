<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Log;
use App\Events\UserStatusChanged;

class ChatController extends Controller
{
    public function index() {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('chat.index', compact('users'));
    }

    public function getConversation(User $user)
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('chat.conversation', compact('user', 'users'));
    }

    public function getUserMessages(User $user)
    {
        return Message::where(function ($q) use ($user) {
                $q->where('sender_id', auth()->id())
                ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                ->where('receiver_id', auth()->id());
            })
            ->orderBy('created_at')
            ->get();
    }

    public function send(Request $request, User $user) {
        $request->validate(['content' => 'required|string|max:5000']);
        
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'status' => true,
            'content' => $request->content
        ]);

        try{
            event(new MessageSent($message));
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return response()->json(['message' => $message, 'success' => true]);
    }

    public function updateHeartbeat() {
        $user = User::find(auth()->id());

        $wasOffline = $user->offline_broadcasted;

        Log::info('Heartbeat received', [
            'user_id' => $user->id,
            'was_offline' => $wasOffline,
            'last_seen_at' => $user->last_seen_at,
        ]);

        $user->update([
            'last_seen_at' => now(),
            'offline_broadcasted' => false,
        ]);

        $user->refresh();

        if ($wasOffline) {

            Log::info('ONLINE transition', [
                'user_id' => $user->id,
            ]);

            broadcast(
                new UserStatusChanged(
                    $user,
                    true
                )
            )->toOthers();
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
