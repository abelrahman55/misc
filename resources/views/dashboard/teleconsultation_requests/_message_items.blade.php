@foreach($messages as $msg)
@php
    $isMe = false;
    if (Auth::guard('web')->check() && $msg->user_type == 'admin') {
        $isMe = true;
    } elseif (Auth::guard('web')->check() && Auth::guard('web')->id() == $msg->user_id && $msg->user_type == 'user') {
        $isMe = true;
    }
@endphp

<div class="msg-wrapper {{ $isMe ? 'sent-box' : 'received-box' }}">
    <div class="msg {{ $isMe ? 'sent' : 'received' }}">
        @if(!$isMe)
            <div class="sender-name">
                {{ $msg->user_type == 'admin' ? 'Admin' : ($msg->user->full_name ?? 'User') }}
            </div>
        @endif

        <div class="text">
            {{ $msg->message }}
        </div>

        @if($msg->file)
            <div class="attachment mt-2">
                <a href="{{ asset('storage/' . $msg->file) }}" target="_blank" class="btn btn-xs btn-outline-primary mb-0 p-1">
                   <i class="bi bi-file-earmark-arrow-down"></i> View Attachment
                </a>
            </div>
        @endif

        <div class="time">
            {{ $msg->created_at->format('H:i') }}
        </div>
    </div>
</div>
@endforeach
