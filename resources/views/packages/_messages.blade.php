@php
    $items = $messages->reverse(); // عشان تظهر الأقدم فوق
@endphp

@foreach($items as $msg)
    @php
        $isMine = $msg->user_id == auth()->id();
        $extension = strtolower(pathinfo($msg->file, PATHINFO_EXTENSION));
        $imageExtensions = ['jpg','jpeg','png','gif','webp','bmp','svg'];
    @endphp

    <div class="msg-wrapper {{ $isMine ? 'sent-box' : 'received-box' }}">
        <div class="msg {{ $isMine ? 'sent' : 'received' }}">
            <div class="sender-name">{{ $msg->user?->f_name ?? 'User' }}</div>
            <div>{{ $msg->message }}</div>

            @if(!empty($msg->file))
                @if(in_array($extension, $imageExtensions))
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$msg->file) }}" style="max-width: 150px; border-radius:8px;">
                    </div>
                @else
                    <a href="{{ asset('storage/'.$msg->file) }}" target="_blank" class="mt-2 inline-block text-blue-600 underline">📎 تحميل الملف</a>
                @endif
            @endif

            <div class="time">{{ $msg->created_at?->format('H:i') }}</div>
        </div>
    </div>
@endforeach

<input type="hidden" id="next_page" value="{{ $messages->nextPageUrl() }}">
