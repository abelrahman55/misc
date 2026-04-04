<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AppointmentConversation;
use App\Models\AppointmentMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentChatController extends Controller
{
    /**
     * Display a listing of appointment conversations.
     */
    public function index(Request $request)
    {
        $id = $request->id; // Conversation ID
        $currentUser = Auth::guard('web')->user();

        $conversations = AppointmentConversation::with(['sender', 'receiver', 'messages', 'appointment'])
            ->where('user_id', $currentUser->id)
            ->orWhere('receiver_id', $currentUser->id)
            ->latest('updated_at')
            ->get();

        $currentConversation = null;
        if ($id) {
            $currentConversation = AppointmentConversation::with(['messages.user', 'sender', 'receiver', 'appointment'])
                ->where(function ($q) use ($currentUser) {
                    $q->where('user_id', $currentUser->id)
                        ->orWhere('receiver_id', $currentUser->id);
                })
                ->find($id);

            if ($currentConversation) {
                // With column-reverse, we need newest items first in the collection
                $currentConversation->setRelation('messages', $currentConversation->messages->sortByDesc('created_at')->values());
            }
        }

        return view('appointment_chat.index', compact('conversations', 'currentConversation'));
    }

    /**
     * Display a specific appointment conversation.
     */
    public function show($id)
    {
        $currentUser = Auth::guard('web')->user();

        $conversation = AppointmentConversation::with(['messages.user', 'sender', 'receiver'])
            ->where(function ($q) use ($currentUser) {
                $q->where('user_id', $currentUser->id)
                    ->orWhere('receiver_id', $currentUser->id);
            })
            ->findOrFail($id);

        $messages = $conversation->messages->sortByDesc('created_at')->values();

        return view('appointment_chat.show', compact('conversation', 'messages'));
    }

    /**
     * Send a message within an appointment conversation.
     */
    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'nullable|string',
            'file'    => 'nullable|file|max:10240', // 10MB limit
            'voice'   => 'nullable|file|max:5120',  // 5MB limit
        ]);

        $currentUser = Auth::guard('web')->user();
        $conversation = AppointmentConversation::where(function ($q) use ($currentUser) {
            $q->where('user_id', $currentUser->id)
                ->orWhere('receiver_id', $currentUser->id);
        })
            ->findOrFail($id);

        $data = [
            'appointment_conversation_id' => $conversation->id,
            'user_id'         => $currentUser->id,
            'message'         => $request->message,
        ];

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('appointment_messages', 'public');
        }

        if ($request->hasFile('voice')) {
            $data['voice'] = $request->file('voice')->store('appointment_messages', 'public');
        }

        AppointmentMessage::create($data);

        return redirect()->back();
    }
}
