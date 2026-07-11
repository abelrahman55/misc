@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<style>
    .chat-box { height: 80vh; background: #e5ddd5; border-radius: 10px; display:flex; flex-direction:column; }
    .messages-area { flex:1; overflow-y:auto; padding:20px; }
    .msg-wrapper { width:100%; display:flex; margin-bottom:12px; }
    .sent-box { justify-content:flex-end; }
    .received-box { justify-content:flex-start; }
    .msg { max-width:65%; padding:10px 15px; border-radius:15px; font-size:14px; line-height:1.4; }
    .sent { background:#dcf8c6; border-bottom-right-radius:0; }
    .received { background:#fff; border-bottom-left-radius:0; }
    .sender-name { font-size:12px; color:#555; margin-bottom:3px; font-weight:bold; }
    .time { font-size:10px; color:#555; margin-top:5px; text-align:right; }
    .chat-input-area { background:#fff; padding:10px; display:flex; gap:10px; align-items:center; border-top:1px solid #ccc; }
    .chat-input-area input[type=text] { flex:1; border-radius:20px; padding:10px 15px; border:1px solid #ccc; }
    .chat-input-area button { border-radius:50%; width:45px; height:45px; font-size:18px; line-height:0; padding:0; }
    #loading { text-align:center; padding:5px; display:none; }
</style>

<div class="container-fluid d-flex main-content">

    {{--  @include('dashboard.layouts.sidebar')  --}}

    <main class="col dashboard-content p-4">

    <div class="chat-box">

    {{-- تحميل الرسائل --}}
    <div id="loading">تحميل...</div>
    <div class="messages-area" id="messages">
        <div id="messages-list">
            @include('packages_nursing._message_items', ['messages' => $messages])
        </div>
        <input type="hidden" id="next_page" value="{{ $messages->nextPageUrl() }}">
    </div>

    {{-- إرسال رسالة --}}
    <form class="chat-input-area"
          action="{{ route('provider_send_message', $id) }}"
          method="post"
          enctype="multipart/form-data">

        @csrf
        <input type="text" name="message" placeholder="اكتب رسالة...">
        <input type="file" name="file" style="max-width:150px">
        <button class="btn btn-success">➤</button>
    </form>

</div>


    </main>
</div>

<script>
let box = document.getElementById('messages');
let loading = document.getElementById('loading');
let nextPage = document.getElementById('next_page').value;

// Scroll to bottom initially
box.scrollTop = box.scrollHeight;

box.addEventListener('scroll', function() {
    if(box.scrollTop === 0 && nextPage) {
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

            // استخراج الرسائل فقط
            let temp = document.createElement('div');
            temp.innerHTML = data;
            let messagesHTML = temp.querySelectorAll('.msg-wrapper');
            messagesHTML.forEach(msg => box.querySelector('#messages-list').prepend(msg));

            // تحديث nextPage
            let newNext = temp.querySelector("#next_page")?.value;
            nextPage = newNext || "";

            // الحفاظ على Scroll position
            box.scrollTop = box.scrollHeight - oldHeight;
        });
}

</script>
