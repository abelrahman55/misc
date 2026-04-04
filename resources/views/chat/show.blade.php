@extends('dashboard.layouts.layout')

@section('content')
<div class="container-fluid py-4">
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
                    <a href="{{ route('chat.index') }}" class="btn-icon me-2 mt-1 d-lg-none">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <img src="{{ asset('storage/'.($activeUser->prof_img ?? 'default.png')) }}" alt="Avatar" class="conv-avatar shadow-sm" style="width: 45px; height: 45px;">
                    <div>
                        <div class="conv-name mb-0">{{ $activeUser->f_name ?? 'User' }} {{ $activeUser->l_name ?? '' }}</div>
                        <div class="text-xs text-success">
                            <i class="bi bi-circle-fill" style="font-size: 8px;"></i> Online
                        </div>
                    </div>
                </div>
                <div class="chat-actions">
                    <a href="{{ route('chat.index') }}" class="btn btn-sm btn-outline-primary mb-0 d-none d-lg-inline-block">
                        <i class="bi bi-grid"></i> All Messages
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
                                    <button class="btn btn-sm btn-outline-danger flex-grow-1 mb-0" data-bs-toggle="modal" data-bs-target="#chatShowRejectModal">Reject</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Reject Modal -->
                <div class="modal fade" id="chatShowRejectModal" tabindex="-1" role="dialog">
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
                <form action="{{ route('chat.send', $conversation->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-wrapper">
                        <label class="btn-icon mb-0" style="cursor: pointer;" title="Attach File">
                            <i class="bi bi-plus-circle"></i>
                            <input type="file" name="file" class="d-none">
                        </label>
                        <input type="text" name="message" autocomplete="off" placeholder="Write your message...">
                        <div class="input-actions">
                            <button type="button" class="btn-icon" title="Voice Message"><i class="bi bi-mic"></i></button>
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
                <a href="{{ route('chat.index') }}" class="btn btn-primary">Back to Messages</a>
            </div>
            @endif
        </main>
    </div>
</div>
@endsection