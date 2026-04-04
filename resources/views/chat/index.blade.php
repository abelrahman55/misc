@extends('dashboard.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="chat-app-container">
        <!-- Sidebar: Conversations List -->
        <aside class="chat-sidebar">
            <div class="sidebar-header">
                <h2>Messages</h2>
                <div class="chat-search-wrapper">
                    <i class="bi bi-search text-muted"></i>
                    <input type="text" placeholder="Search conversations...">
                </div>
            </div>

            <div class="conv-list">
                @forelse($conversations as $conv)
                @php
                $otherUser = ($conv->sender && $conv->sender->id == Auth::guard('web')->id()) ? $conv->receiver : $conv->sender;
                @endphp
                @if($otherUser)
                <a href="{{ route('chat.index', ['id' => $conv->id]) }}"
                    class="conv-item {{ $currentConversation && $conv->id == $currentConversation->id ? 'active' : '' }}">
                    <img src="{{ asset('storage/'.($otherUser->prof_img ?? 'default.png')) }}" alt="Avatar" class="conv-avatar shadow-sm">
                    <div class="conv-info">
                        <div class="conv-name">{{ $otherUser->f_name ?? 'User' }} {{ $otherUser->l_name ?? '' }}</div>
                        <div class="conv-last-msg">
                            @if($conv->messages->isNotEmpty())
                            {{ $conv->messages->first()->message ?? 'Sent a file' }}
                            @else
                            No messages yet
                            @endif
                        </div>
                    </div>
                    <div class="conv-meta">
                        <div class="conv-time">{{ $conv->updated_at ? $conv->updated_at->format('h:i A') : '' }}</div>
                    </div>
                </a>
                @else
                <div class="conv-item text-muted small p-4 text-center">
                    <div class="text-xs">Invalid User</div>
                </div>
                @endif
                @empty
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-chat-dots fs-2 d-block mb-2"></i>
                    No conversations found
                </div>
                @endforelse
            </div>
        </aside>

        <!-- Main Chat Window -->
        <main class="chat-window">
            @if($currentConversation)
            @php
            $activeUser = ($currentConversation->sender && $currentConversation->sender->id == Auth::guard('web')->id()) ? $currentConversation->receiver : $currentConversation->sender;
            @endphp
            @if($activeUser)
            <!-- Header -->
            <div class="chat-window-header">
                <div class="current-user-info">
                    <img src="{{ asset('storage/'.($activeUser->prof_img ?? 'default.png')) }}" alt="Avatar" class="conv-avatar" style="width: 40px; height: 40px;">
                    <div>
                        <div class="conv-name mb-0">{{ $activeUser->f_name ?? 'User' }} {{ $activeUser->l_name ?? '' }}</div>
                        <div class="text-xs text-success">Online</div>
                    </div>
                </div>
                <div class="chat-actions">
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
                                    <button class="btn btn-sm btn-outline-danger flex-grow-1 mb-0" data-bs-toggle="modal" data-bs-target="#chatRejectModal">Reject</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Reject Modal -->
                <div class="modal fade" id="chatRejectModal" tabindex="-1" role="dialog">
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

                @foreach($currentConversation->messages as $msg)
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
                                <audio controls style="height: 30px; max-width: 200px;">
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
                <form action="{{ route('chat.send', $currentConversation->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-wrapper">
                        <label class="btn-icon mb-0" style="cursor: pointer;">
                            <i class="bi bi-plus-circle"></i>
                            <input type="file" name="file" class="d-none">
                        </label>

                        <!-- Hidden Voice Input -->
                        <input type="file" name="voice" id="voice_input" class="d-none" accept="audio/*">

                        <input type="text" name="message" id="chat_message_input" autocomplete="off" placeholder="Type your message here...">

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
            <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                <div class="bg-light rounded-circle p-4 mb-3">
                    <i class="bi bi-person-x fs-1"></i>
                </div>
                <h5>User not found</h5>
                <p class="text-sm">This conversation's recipient could not be located in the system.</p>
            </div>
            @endif
            @else
            <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                <div class="bg-light rounded-circle p-4 mb-3">
                    <i class="bi bi-chat-quote fs-1"></i>
                </div>
                <h5>Select a conversation</h5>
                <p class="text-sm">Choose a contact to start messaging</p>
            </div>
            @endif
        </main>
    </div>
</div>
@endsection