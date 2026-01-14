@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<style>
    .message-header {
        display: flex;
        gap: 16px;
        align-content: center;
        align-items: center;
    }

    .message-header .avatar {
        width: 35px;
        height: 35px;
        border-radius: 8px;
    }

    .message-body {
        padding-left: 50px;
    }

    .message-body p {
        color: rgba(99, 99, 99, 1);
    }

    .time {
        color: rgba(159, 167, 190, 1);
    }
</style>

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

                @foreach ($conversations as $conversation)
                    @php
                        // نجيب أول رسالة بأمان
                        $firstMessage = $conversation->messages->first();
                    @endphp
                    {{--  <p>{{ $conversation->id }}</p>  --}}
                    <a href="{{ route('nursing_conv_messages',['id'=>$conversation->id]) }}" class="message-container {{ $firstMessage?->user_id == auth()->id() ? 'sent' : 'received' }}">
                        <div class="message-header">
                            <img src="{{ $conversation->sender->profile_photo_url ?? asset('works/1752560823.jpg') }}"
                                alt="Sender" class="avatar" width="40" height="40">
                            <span>{{ $conversation->user->f_name ?? 'Unknown' }}</span>
                        </div>

                        <div class="message-body">
                            <p>{{ $firstMessage?->message ?? 'No messages yet.' }}</p>

                            {{-- صورة --}}
                            @if (!empty($firstMessage?->file) &&
                                (str_contains($firstMessage->file, '.jpg') ||
                                    str_contains($firstMessage->file, '.png') ||
                                    str_contains($firstMessage->file, '.jpeg')))
                                <img src="{{ asset('storage/' . $firstMessage->file) }}" alt="Attached Image"
                                    class="message-image" style="max-width: 200px; max-height: 200px;">
                            @endif

                            {{-- صوت --}}
                            @if (!empty($firstMessage?->voice))
                                <audio controls>
                                    <source src="{{ asset('storage/' . $firstMessage->voice) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @endif

                            {{-- ملف عادي --}}
                            @if (!empty($firstMessage?->file) &&
                                !str_contains($firstMessage->file, '.jpg') &&
                                !str_contains($firstMessage->file, '.png') &&
                                !str_contains($firstMessage->file, '.jpeg'))
                                <a href="{{ asset('storage/' . $firstMessage->file) }}" target="_blank">Download
                                    File</a>
                            @endif

                            {{-- وقت الإرسال --}}
                            {{--  <span class="time">
                                {{ $firstMessage?->created_at?->format('h:i A') ?? '' }}
                            </span>  --}}
                        </div>
                    </a>
<div style="display: flex;align-items: center;justify-content: end" class="make-price">
                        <a class="btn btn-primary my-2" href="{{ route('nursing_make_provider_price',['id'=>$conversation->id]) }}">
                        عمل عرض سعر له
                    </a>
                    </div>
                    <hr>
                @endforeach

            </div>
        </div>
    </main>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@push('style')
    <style>
        .message-container {
            margin-bottom: 15px;
            display: block;
            color: black;
            text-decoration: none;
        }

        .message-container.sent * {
            text-decoration: none;
            color: black;
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
