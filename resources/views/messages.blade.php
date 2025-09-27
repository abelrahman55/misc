@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')
    <main class="col dashboard-content p-4">
        <div class="row">
            <div class="col">
                <h1 class="header-page">All Messages</h1>
            </div>
        </div>
        <div class="row gap-3">
            <div class="col p-4">
                @foreach($conversations as $conversation)
                    @foreach($conversation->messages as $message)
                        <div class="message-container {{ $message->user_id == auth()->id() ? 'sent' : 'received' }}">
                            <div class="message-header">
                                <img src="{{ $conversation->sender->profile_photo_url ?? asset('default-avatar.png') }}" alt="Sender" class="avatar" width="40" height="40">
                                <span>{{ $conversation->sender->name ?? 'Unknown' }}</span>
                                <span class="time">{{ $message->created_at->format('h:i A') }}</span>
                            </div>
                            <div class="message-body">
                                <p>{{ $message->message }}</p>
                                @if($message->file && strpos($message->file, '.jpg') !== false || strpos($message->file, '.png') !== false || strpos($message->file, '.jpeg') !== false)
                                    <img src="{{ asset('storage/' . $message->file) }}" alt="Attached Image" class="message-image" style="max-width: 200px; max-height: 200px;">
                                @endif
                                @if($message->voice)
                                    <audio controls>
                                        <source src="{{ asset('storage/' . $message->voice) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                @endif
                                @if($message->file && !strpos($message->file, '.jpg') && !strpos($message->file, '.png') && !strpos($message->file, '.jpeg'))
                                    <a href="{{ asset('storage/' . $message->file) }}" target="_blank">Download File</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </main>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Optional: Add JavaScript for dynamic behavior if needed
    </script>
@endpush

@push('style')
    <style>
        .message-container {
            margin-bottom: 15px;
        }
        .sent .message-body {
            background-color: #007bff;
            color: white;
            border-radius: 10px;
            padding: 10px;
            display: inline-block;
            margin-left: 20%;
            text-align: right;
        }
        .received .message-body {
            background-color: #e9ecef;
            border-radius: 10px;
            padding: 10px;
            display: inline-block;
            margin-right: 20%;
        }
        .message-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
        }
        .avatar {
            border-radius: 50%;
        }
        .time {
            font-size: 0.8em;
            color: #6c757d;
        }
        .message-image {
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
@endpush
