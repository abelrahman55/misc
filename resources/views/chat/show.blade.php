@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')
    <main class="col dashboard-content p-4">

        <h1 class="mb-4">Chat</h1>

        <div class="card shadow-sm">
            <div class="card-body" style="max-height:400px; overflow-y:auto;">
                @foreach($conversation->messages as $message)
                    <div class="mb-3 {{ $message->user_id == auth()->id() ? 'text-end' : 'text-start' }}">
                        <div class="p-2 rounded {{ $message->user_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
                            {{ $message->message }}
                            <br>
                            <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                        </div>
                        @if($message->file)
                            <a href="{{ asset('storage/'.$message->file) }}" target="_blank">📎 File</a>
                        @endif
                        @if($message->voice)
                            <audio controls>
                                <source src="{{ asset('storage/'.$message->voice) }}" type="audio/mpeg">
                            </audio>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="card-footer">
                <form method="post" action="{{ route('chat.send', $conversation->id) }}" enctype="multipart/form-data" class="d-flex gap-2">
                    @csrf
                    <input type="text" name="message" class="form-control" placeholder="Type a message">
                    <input type="file" name="file" class="form-control" style="max-width:200px;">
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>

    </main>
</div>
