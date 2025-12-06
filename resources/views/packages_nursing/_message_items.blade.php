@foreach ($messages as $message)
    <div
        class="msg-wrapper {{ $message?->user_id == auth()->id() || auth()->guard('web')->user()->role == 'admin' ? 'sent-box' : 'received-box' }}">
        <div
            class="msg {{ $message?->user_id == auth()->id() || auth()->guard('web')->user()->role == 'admin' ? 'sent' : 'received' }}">
            <div class="sender-name">{{ $message?->user?->name }}</div>

            {{-- نص الرسالة --}}
            @if ($message->message)
                <div>{{ $message->message }}</div>
            @endif

            {{-- الملف المرفق --}}
            @if ($message->file)
                @php
                    $extension = strtolower(pathinfo($message->file, PATHINFO_EXTENSION));
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                @endphp

                @if (in_array($extension, $imageExtensions))
                    <div style="margin-top:5px;">
                        <img src="{{ asset('storage/' . $message->file) }}" alt="image"
                            style="max-width:200px; border-radius:10px;">
                    </div>
                @else
                    <div style="margin-top:5px;">
                        <a href="{{ asset('storage/' . $message->file) }}" target="_blank">
                            تحميل الملف
                        </a>
                    </div>
                @endif
            @endif

            <div class="time">{{ $message?->created_at?->format('H:i') }}</div>
        </div>
    </div>
@endforeach
