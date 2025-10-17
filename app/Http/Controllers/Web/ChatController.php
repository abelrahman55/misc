<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
// public function index()
// {
//     $id = request('id'); // id المريض

//     $conversations = Conversation::with(['messages.user', 'sender', 'receiver'])
//         ->where(function ($q) use ($id) {
//             $q->where('user_id', Auth::id())
//               ->where('receiver_id', $id);
//         })
//         ->orWhere(function ($q) use ($id) {
//             $q->where('user_id', $id)
//               ->where('receiver_id', Auth::id());
//         })
//         ->get();
//         // return $conversations;
//     return view('chat.index', compact('conversations'));
// }
    public function index(Request $request)
    {
        $id = $request->id; // ممكن يكون conversation id اللي بتمرره من الواجهة
                            // return $id;
                            // return Auth::guard('web')->id();
                            // جلب كل المحادثات الخاصة بالمستخدم الحالي
        $user = Auth::guard('web')->user();
        // return $user;
        $conversations = Conversation::with(['sender', 'receiver', 'messages'])
            ->where('user_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->get();

        // المحادثة الحالية (لو في id اتبعت)
        $currentConversation = null;
        if ($id) {
            $currentConversation = Conversation::with(['messages.user', 'sender', 'receiver'])
                ->find($id);
        }
        // return $conversations;
        // مهم نمرر نفس اسم المتغير اللي الـ Blade بيستخدمه
        return view('chat.index', compact('conversations', 'currentConversation'));
    }

    public function show($id)
    {
        $conversation = Conversation::with('messages.user')->findOrFail($id);
        // $messages     = $conversation->messages ?? [];

        $messages = $conversation->messages?->sortBy('created_at')->values() ?? collect();
        // return $messages;
        if ($conversation->user_id != Auth::id() && $conversation->receiver_id != Auth::id()) {
            abort(403);
        }

        return view('chat.show', compact('conversation', 'messages'));
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
            'user_id'         => Auth::id(),
            'message'         => $request->message,
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
