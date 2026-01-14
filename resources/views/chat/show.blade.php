@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')
<style>
    .chat-container {
        {{--  max-width: 600px;  --}}
        margin: 0 auto;
        background: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .chat-header {
        padding: 10px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .chat-header .user-info {
        display: flex;
        align-items: center;
    }
    .chat-header .user-info img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 10px;
    }
    .chat-header .timestamp {
        color: #666;
        font-size: 0.8em;
    }
    .chat-messages {
        max-height: 400px;
        overflow-y: auto;
        padding: 15px;
    }
    .message {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }
    .message.sent {
        align-items: flex-end;
    }
    .message.received {
        align-items: flex-start;
    }
    .message-bubble {
        padding: 10px 15px;
        border-radius: 15px;
        max-width: 70%;
        display: inline-block;
        word-wrap: break-word;
    }
    .message.sent .message-bubble {
        background-color: rgba(61, 100, 253, 1);
        color: #fff;
    }
    .message.received .message-bubble {
        background-color: rgba(175, 184, 207, 1);
        color: #000;
    }
    .message-time {
        font-size: 0.7em;
        color: #888;
        margin-top: 5px;
    }
    .chat-input {
        padding: 10px;
        background: #fff;
        border-top: 1px solid #eee;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        display: flex;
        gap: 10px;
    }
    .chat-input input[type="text"] {
        flex-grow: 1;
        border: 1px solid #ddd;
        border-radius: 20px;
        padding: 5px 15px;
    }
    .chat-input button {
        border-radius: 20px;
        padding: 5px 20px;
    }
</style>

<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')
    <main class="col dashboard-content p-4">
        <div class="chat-container">
            <div class="chat-header">
                <div class="user-info">
                    @if($conversation->receiver->id!=Auth()?->id()??0)
                        <img src="{{ asset('storage/'.$conversation?->receiver?->prof_img??"") }}" alt="User">
                    @endif

                    @if($conversation->sender->id!=Auth()?->id()??0)
                        <img src="{{ asset('storage/'.$conversation?->sender?->prof_img??"") }}" alt="User">
                    @endif

                    <span>{{ $conversation->receiver->id!=Auth()?->id()??0?$conversation?->receiver?->f_name:$conversation?->sender?->f_name }}</span>
                </div>
                <span class="timestamp">Today | 08:32</span>
            </div>
            <div class="chat-messages">
                @foreach($messages ?? [] as $message)
                    <div class="message {{ $message->user_id == auth()->id() ? 'sent' : 'received' }}">
                        <div class="message-bubble">
                            {{ $message->message }}
                            <div class="message-time">
                                {{ optional($message->created_at)->format('H:i') ?? '' }}
                            </div>
                        </div>
                        @if(!empty($message->file))
                            <a href="{{ asset('storage/' . $message->file) }}" target="_blank">📎 File</a>
                        @endif
                        @if(!empty($message->voice))
                            <audio controls>
                                <source src="{{ asset('storage/' . $message->voice) }}" type="audio/mpeg">
                            </audio>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="chat-input">
                <form method="post" action="{{ route('chat.send', $conversation->id) }}" enctype="multipart/form-data" class="d-flex gap-2 w-100">
                    @csrf
                    <input type="text" name="message" class="form-control" placeholder="Type a message">
                    <input type="file" name="file" class="form-control" style="max-width: 200px;">
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </main>
</div>
