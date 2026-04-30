<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use \Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class ChatController extends Controller
{
    public function index() {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('chat.index', compact('users'));
    }

    public function dashboard() {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('dashboard', compact('users'));
    }

    public function conversation(User $user) {
        $auth = auth()->id();

        if (request()->expectsJson()) {
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

            //return response()->json([$messages]);
        }
        return view('chat.conversation', compact('user'));
    }

    public function send(Request $request, User $user) {
        $request->validate(['content' => 'required|string|max:2000']);

        //$validated = $request->validated();
        
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'status' => true,
            'content' => $request->content
        ]);

        return response()->json(['message' => $message, 'success' => true]);
    }
}
