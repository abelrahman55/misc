<?php

namespace App\Http\Controllers\Web;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class ChatController extends Controller
{
    public function index()
    {

        $conversations = Conversation::with(['messages.user', 'sender', 'receiver'])
            ->where('user_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->get();

        return view('chat.index', compact('conversations'));
    }

    public function show($id)
    {
        $conversation = Conversation::with('messages.user')->findOrFail($id);

       
        if ($conversation->user_id != Auth::id() && $conversation->receiver_id != Auth::id()) {
            abort(403);
        }

        return view('chat.show', compact('conversation'));
    }

    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'nullable|string',
            'file'    => 'nullable|file',
            'voice'   => 'nullable|file',
        ]);

        $conversation = Conversation::findOrFail($id);

        if ($conversation->user_id != Auth::id() && $conversation->receiver_id != Auth::id()) {
            abort(403);
        }

        $data = [
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ];

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('messages', 'public');
        }

        if ($request->hasFile('voice')) {
            $data['voice'] = $request->file('voice')->store('messages', 'public');
        }

        Message::create($data);

        return redirect()->back();
    }
}
