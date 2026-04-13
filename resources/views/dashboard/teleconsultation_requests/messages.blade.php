@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

@section('content')
<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')

    <main class="col dashboard-content p-4">
<style>
    .chat-container {
        height: min(700px, 80vh);
        display: flex;
        flex-direction: column;
        background: #fdfdfd;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .chat-header {
        padding: 15px 25px;
        background: #fff;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .messages-area {
        flex: 1;
        overflow-y: auto;
        padding: 25px;
        background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
        display: flex;
        flex-direction: column;
    }
    .msg-wrapper {
        width: 100%;
        display: flex;
        margin-bottom: 15px;
    }
    .sent-box { justify-content: flex-end; }
    .received-box { justify-content: flex-start; }
    
    .msg {
        max-width: 75%;
        padding: 12px 18px;
        border-radius: 20px;
        position: relative;
        font-size: 14.5px;
        line-height: 1.5;
        box-shadow: 0 2px 5px rgba(0,0,0,0.03);
    }
    .sent {
        background: linear-gradient(135deg, #347fc2, #2a69a3);
        color: #fff;
        border-bottom-right-radius: 5px;
    }
    .received {
        background: #fff;
        color: #333;
        border: 1px solid #eee;
        border-bottom-left-radius: 5px;
    }
    .sender-name {
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 4px;
        text-transform: uppercase;
        color: #888;
    }
    .time {
        font-size: 10px;
        margin-top: 6px;
        opacity: 0.7;
        text-align: right;
    }
    .sent .time { color: #f0f0f0; }

    .chat-input-area {
        padding: 15px 25px;
        background: #fff;
        border-top: 1px solid #eee;
        display: flex;
        gap: 12px;
        align-items: center;
    }
    .chat-input-area input[type=text] {
        flex: 1;
        border-radius: 25px;
        padding: 12px 20px;
        border: 1px solid #ddd;
        outline: none;
        transition: border 0.3s;
    }
    .chat-input-area input[type=text]:focus { border-color: #347fc2; }
    
    .btn-send {
        background: #347fc2;
        color: #fff;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: transform 0.2s;
    }
    .btn-send:hover { transform: scale(1.05); }
    
    #loading-chat {
        text-align: center;
        font-size: 12px;
        color: #888;
        padding: 10px;
        display: none;
    }
</style>

<div class="row justify-content-center w-100">
    <div class="col-lg-10">
            <div class="chat-container">
                <div class="chat-header">
                    <div>
                        <h5 class="mb-0">Chat — Request #{{ $id }}</h5>
                        <small class="text-secondary">
                             Patient: {{ $req->client->full_name ?? ($req->client->f_name ?? 'N/A') }} | 
                             Specialty: {{ $req->specialty ? ($req->specialty->title['en'] ?? ($req->specialty->title['ar'] ?? 'N/A')) : 'N/A' }}
                         </small>
                    </div>
                    <a href="{{ Auth::guard('web')->check() ? route('teleconsultation_requests.index') : route('teleconsultation_requests.patient_index') }}" class="btn btn-sm btn-outline-secondary mb-0">
                        Back to List
                    </a>
                </div>

                <div class="messages-area" id="messages-box">
                    <div id="loading-chat"><i class="bi bi-arrow-repeat spin"></i> Loading older messages...</div>
                    <div id="messages-list">
                        @include('dashboard.teleconsultation_requests._message_items', ['messages' => $messages])
                    </div>
                    <input type="hidden" id="next_page_chat" value="{{ $messages->nextPageUrl() }}">
                </div>

                <form class="chat-input-area" action="{{ route('teleconsultation_requests.send_message', $id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="position-relative" style="width: 40px;">
                        <label for="chat-file" class="btn btn-link text-secondary mb-0 p-2" title="Attach File">
                            <i class="bi bi-paperclip fs-5"></i>
                        </label>
                        <input type="file" id="chat-file" name="file" class="d-none">
                    </div>
                    <input type="text" name="message" id="chat-message-input" placeholder="Type your message here..." autocomplete="off">
                    <button type="submit" class="btn-send">
                        <i class="bi bi-send-fill" style="margin-left: 3px;"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const box = document.getElementById('messages-box');
        const list = document.getElementById('messages-list');
        const loading = document.getElementById('loading-chat');
        let nextPage = document.getElementById('next_page_chat').value;

        // Scroll to bottom
        box.scrollTop = box.scrollHeight;

        // Infinite Scroll (Load More)
        box.addEventListener('scroll', function() {
            if (box.scrollTop === 0 && nextPage) {
                loadOlderMessages();
            }
        });

        function loadOlderMessages() {
            loading.style.display = "block";
            let oldHeight = box.scrollHeight;

            fetch(nextPage)
                .then(res => res.text())
                .then(data => {
                    loading.style.display = "none";
                    
                    const temp = document.createElement('div');
                    temp.innerHTML = data;
                    
                    const newItems = temp.querySelectorAll('.msg-wrapper');
                    newItems.forEach(item => list.prepend(item));

                    const newNext = temp.querySelector('input#next_page_chat')?.value;
                    nextPage = newNext || "";

                    box.scrollTop = box.scrollHeight - oldHeight;
                });
        }

        // File name preview or indicator (optional)
        document.getElementById('chat-file').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                document.getElementById('chat-message-input').placeholder = "File attached: " + this.files[0].name;
            }
        });
    });
</script>
@endsection
