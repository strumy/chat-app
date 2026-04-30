<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return response()->json([
            'status' => true,
            'message' => 'Messages retrieved successfully',
            'data' => $messages
        ], 200);
    }

    public function show($id)
    {
        $messages = Message::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Message found successfully',
            'data' => $messages
        ], 200);
    }

    public function store(MessageRequest $request)
    {
        $validated = $request->validated();

        $message = Message::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Message created successfully',
            'data' => $message
        ], 201);
    }

    public function update(MessageRequest $request, $id)
    {
        $validated = $request->validated();
        $message = Message::findOrFail($id);
        $message->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Message updated successfully',
            'data' => $message
        ], 200);
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Message deleted successfully'
        ], 204);
    }
}
