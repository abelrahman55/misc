@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

@section('content')
<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')

    <main class="col dashboard-content p-4">
        <style>
        .chat-app-container {
            display: flex;
            height: 80vh;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            border: 1px solid #eef2f5;
        }

        .chat-sidebar {
            width: 320px;
            border-right: 1px solid #eef2f5;
            display: flex;
            flex-direction: column;
            background: #fcfcfc;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #eef2f5;
            background: #fff;
        }

        .sidebar-header h2 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .chat-search-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .chat-search-wrapper i {
            position: absolute;
            left: 12px;
            color: #a0aec0;
        }

        .chat-search-wrapper input {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            font-size: 13px;
            background: #f8fafc;
            transition: all 0.2s;
        }

        .chat-search-wrapper input:focus {
            outline: none;
            border-color: #347fc2;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(52, 127, 194, 0.1);
        }

        .conv-list {
            flex: 1;
            overflow-y: auto;
        }

        .conv-item {
            display: flex;
            padding: 15px 20px;
            border-bottom: 1px solid #f1f5f9;
            text-decoration: none;
            color: inherit;
            transition: background 0.2s;
            align-items: center;
        }

        .conv-item:hover {
            background: #f8fafc;
        }

        .conv-item.active {
            background: #eff6ff;
            border-left: 4px solid #347fc2;
        }

        .conv-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .conv-info {
            flex: 1;
            min-width: 0;
        }

        .conv-name {
            font-weight: 600;
            font-size: 14px;
            color: #1e293b;
            margin-bottom: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .conv-last-msg {
            font-size: 12px;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .conv-meta {
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .conv-time {
            font-size: 11px;
            color: #94a3b8;
        }

        .chat-window {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #ffffff;
        }

        .chat-window-header {
            padding: 20px 25px;
            border-bottom: 1px solid #eef2f5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
        }

        .current-user-info {
            display: flex;
            align-items: center;
        }

        .current-user-info .conv-avatar {
            margin-right: 15px;
        }

        .chat-actions .btn-icon {
            background: none;
            border: none;
            color: #64748b;
            font-size: 20px;
            cursor: pointer;
            transition: color 0.2s;
        }

        .chat-actions .btn-icon:hover {
            color: #347fc2;
        }

        .chat-messages-body {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
            background-color: #f8fafc;
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
        }

        .message-row {
            display: flex;
            margin-bottom: 20px;
        }

        .message-row.sent {
            justify-content: flex-end;
        }

        .message-row.received {
            justify-content: flex-start;
        }

        .message-content {
            max-width: 70%;
        }

        .message-bubble {
            padding: 12px 16px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.5;
            position: relative;
        }

        .sent .message-bubble {
            background: #347fc2;
            color: #fff;
            border-bottom-right-radius: 4px;
            box-shadow: 0 2px 5px rgba(52, 127, 194, 0.2);
        }

        .sent .message-bubble a {
            color: #f8fafc;
            border-color: rgba(255,255,255,0.3) !important;
        }

        .received .message-bubble {
            background: #fff;
            color: #334155;
            border-bottom-left-radius: 4px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }

        .message-time {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 5px;
        }

        .sent .message-time {
            text-align: right;
        }

        .received .message-time {
            text-align: left;
        }

        .chat-input-area {
            padding: 15px 25px;
            background: #fff;
            border-top: 1px solid #eef2f5;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 30px;
            padding: 5px 15px;
        }

        .input-wrapper input[type="text"] {
            flex: 1;
            border: none;
            background: transparent;
            padding: 12px 15px;
            font-size: 14px;
            color: #334155;
        }

        .input-wrapper input[type="text"]:focus {
            outline: none;
        }

        .input-wrapper input[type="text"]::placeholder {
            color: #94a3b8;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: none;
            background: transparent;
            color: #64748b;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-icon:hover {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-send {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: none;
            background: #347fc2;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-left: 5px;
            transition: all 0.2s;
            box-shadow: 0 4px 10px rgba(52, 127, 194, 0.3);
        }

        .btn-send:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            animation: pulse 1.5s infinite ease-in-out;
        }

        @keyframes pulse {
            0% { transform: scale(0.8); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(0.8); opacity: 0.5; }
        }

        @media (max-width: 768px) {
            .chat-app-container {
                flex-direction: column;
                height: 85vh;
            }
            
            .chat-sidebar {
                width: 100%;
                height: 40%;
                border-right: none;
                border-bottom: 1px solid #eef2f5;
            }
            
            .chat-window {
                height: 60%;
            }
        }
        </style>
        <div class="chat-app-container mx-auto" style="max-width: 900px;">
            <!-- Single Conversation View -->
            <main class="chat-window">
                @php
                $activeUser = ($conversation->sender && $conversation->sender->id == Auth::guard('web')->id()) ? $conversation->receiver : $conversation->sender;
                @endphp
                @if($activeUser)
                <!-- Header -->
                <div class="chat-window-header">
                    <div class="current-user-info">
                        <a href="{{ route('appointment_chat.index') }}" class="btn-icon me-2 mt-1 d-lg-none">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <img src="{{ asset('storage/'.($activeUser->prof_img ?? 'default.png')) }}" alt="Avatar" class="conv-avatar shadow-sm" style="width: 45px; height: 45px;">
                        <div>
                            <div class="conv-name mb-0">
                                {{ $activeUser->f_name ?? 'User' }} {{ $activeUser->l_name ?? '' }}
                                @if($conversation->appointment)
                                <span class="badge bg-light text-dark ms-2" style="font-size: 10px;">{{ $conversation->appointment->description ?? 'No Summary' }}</span>
                                @endif
                            </div>
                            <div class="text-xs text-success">
                                <i class="bi bi-circle-fill" style="font-size: 8px;"></i> Online
                            </div>
                        </div>
                    </div>
                    <div class="chat-actions">
                        <a href="{{ route('appointment_chat.index') }}" class="btn btn-sm btn-outline-primary mb-0 d-none d-lg-inline-block">
                            <i class="bi bi-grid"></i> All Appointment Messages
                        </a>
                        <button class="btn btn-icon"><i class="bi bi-three-dots-vertical"></i></button>
                    </div>
                </div>

                <!-- Messages Body -->
                <div class="chat-messages-body">
                    @php
                    $pendingPackage = \App\Models\AppointmentPackage::where('client_id', Auth::guard('web')->id())
                    ->where('status', 'pending')
                    ->where(function($q) use ($activeUser) {
                    $q->where('admin_id', $activeUser->id)
                    ->orWhere('provider_id', $activeUser->id);
                    })
                    ->first();
                    @endphp

                    @if($pendingPackage)
                    <div class="message-row received mb-4">
                        <div class="message-content w-100" style="max-width: 400px;">
                            <div class="card shadow-sm border-info">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="text-primary mb-0">New Package Offer</h6>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    </div>
                                    <p class="text-sm font-weight-bold mb-1">{{ $pendingPackage->title[app()->getLocale()] ?? $pendingPackage->title['ar'] }}</p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-xs text-secondary">Price:</span>
                                        <span class="text-sm font-weight-bolder text-dark">{{ number_format($pendingPackage->price, 2) }}</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('appointment_packages.respond', $pendingPackage->id) }}" method="POST" class="flex-grow-1">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-sm btn-success w-100 mb-0">Approve</button>
                                        </form>
                                        <button class="btn btn-sm btn-outline-danger flex-grow-1 mb-0" data-bs-toggle="modal" data-bs-target="#chatShowAppointRejectModal">Reject</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chat Reject Modal -->
                    <div class="modal fade" id="chatShowAppointRejectModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="{{ route('appointment_packages.respond', $pendingPackage->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Reject Package Offer</h5>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="rejection_reason" class="form-control" placeholder="Reason for rejection..." required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Reject Offer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @foreach($messages ?? [] as $msg)
                    <div class="message-row {{ $msg->user_id == Auth::guard('web')->id() ? 'sent' : 'received' }}">
                        <div class="message-content">
                            <div class="message-bubble">
                                {{ $msg->message }}

                                @if($msg->file)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/'.$msg->file) }}" target="_blank" class="btn btn-sm btn-light border py-1 px-2 text-xs">
                                        <i class="bi bi-paperclip"></i> View Attachment
                                    </a>
                                </div>
                                @endif

                                @if($msg->voice)
                                <div class="mt-2">
                                    <audio controls style="height: 30px; max-width: 220px;">
                                        <source src="{{ asset('storage/'.$msg->voice) }}" type="audio/mpeg">
                                    </audio>
                                </div>
                                @endif
                            </div>
                            <div class="message-time">
                                {{ $msg->created_at ? $msg->created_at->format('h:i A') : '' }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Input Area -->
                <div class="chat-input-area">
                    <form action="{{ route('appointment_chat.send', $conversation->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-wrapper">
                            <label class="btn-icon mb-0" style="cursor: pointer;" title="Attach File">
                                <i class="bi bi-plus-circle"></i>
                                <input type="file" name="file" class="d-none">
                            </label>

                            <!-- Hidden Voice Input -->
                            <input type="file" name="voice" id="voice_input" class="d-none" accept="audio/*">

                            <input type="text" name="message" id="chat_message_input" autocomplete="off" placeholder="Write your message...">

                            <!-- Recording Overlay (Hidden by default) -->
                            <div id="recording_status" class="d-none align-items-center gap-2 flex-grow-1 px-2">
                                <span class="badge bg-danger pulse-dot"></span>
                                <span class="text-danger fw-bold small">Recording...</span>
                                <span id="recording_timer" class="ms-auto small font-monospace">00:00</span>
                            </div>

                            <div class="input-actions">
                                <button type="button" class="btn-icon" id="voice_record_btn" title="Voice Message">
                                    <i class="bi bi-mic" id="mic_icon"></i>
                                </button>
                                <button type="submit" class="btn btn-send">
                                    <i class="bi bi-send-fill"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @else
                <div class="p-5 text-center text-muted">
                    <i class="bi bi-person-x fs-1 d-block mb-3"></i>
                    <h5>Chat partner not found</h5>
                    <p>This conversation's recipient could not be located in the system.</p>
                    <a href="{{ route('appointment_chat.index') }}" class="btn btn-primary">Back to Messages</a>
                </div>
                @endif
            </main>
        </div>
    </main>
</div>
@endsection