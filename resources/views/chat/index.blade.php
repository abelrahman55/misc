@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')
<style>
    *{
        color: black;
    }
    .form_chat_search{
        background-color: rgba(248, 249, 253, 1);
        min-width: 340px;
        max-width: fit-content;
        padding: 5px;
        display: flex;
    }
    .form_chat_search input{
        border: none;
        outline: none;
        background-color: transparent;
        flex:1;
    }
</style>
<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')

    <main class="col dashboard-content p-4">
        <div class="flex h-screen border rounded-lg shadow bg-white">
            <!-- العمود الشمال: قائمة المحادثات -->
            <div class="w-1/3 border-r overflow-y-auto">
                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="font-bold">All Messages</h2>
                    <div>
                        <form class="form_chat_search" action="">
                            <span class="text-blue-500 cursor-pointer">🔍</span>
                            <input class="" placeholder="Search or start a new chat" type="text">
                        </form>
                    </div>
                </div>
                @forelse($conversations as $conv)
                    @php
                        $otherUser = $conv->sender->id == Auth::guard('web')->id() ? $conv->receiver : $conv->sender;
                    @endphp
                    <a style="display: flex ;align-items: center;gap:10px" href="{{ route('chat.index', ['id' => $conv->id]) }}"
                       class="block p-3 border-b hover:bg-gray-100 flex items-center
                       {{ $currentConversation && $conv->id == $currentConversation->id ? 'bg-gray-200' : '' }}">
                        <img style="width: 50px;height: 50px;border-radius: 50%" src="{{ asset('storage/'.$otherUser->prof_img) }}" alt="Avatar" class="w-10 h-10 rounded-full mr-3">
                        {{--  <p>{{ json_encode($otherUser->prof_img) }}</p>  --}}
                        <div class="flex-1">
                            <div class="font-semibold">{{ $otherUser->f_name ?? 'User' }}</div>
                            {{--  <p>{{ json_encode($conv) }}</p>  --}}
                            <div class="text-sm text-gray-600">{{ $conv?->messages[0]?->message ?? 'No message' }}</div>
                        </div>
                        <span class="text-xs text-gray-400">{{ $conv?->updated_at?->format('h:i A') }}</span>
                    </a>
                @empty
                    <p class="p-4 text-gray-500">No conversations</p>
                @endforelse
            </div>

            <!-- العمود اليمين: تفاصيل المحادثة -->
            <div class="w-2/3 flex flex-col">
                @if($currentConversation)
                    <!-- اسم الطرف الآخر -->
                    <div class="p-4 border-b flex justify-between items-center bg-white">
                        <div class="font-bold">
                            {{ $currentConversation->sender->id == Auth::guard('web')->id()
                                ? $currentConversation->receiver->f_name
                                : $currentConversation->sender->f_name }}
                        </div>
                        <span class="text-blue-500 cursor-pointer">🔍</span>
                    </div>

                    <!-- الرسائل -->
                    <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
                        @forelse($currentConversation->messages as $msg)
                            @php
                                $user = $msg->user;
                            @endphp
                            <div class="flex {{ $msg->user_id == Auth::guard('web')->id() ? 'justify-end' : 'justify-start' }} items-start">
                                <img style="width: 50px;height: 50px;border-radius: 50%" src="{{ asset('storage/'.$user->prof_img) }}" alt="Avatar" class="w-8 h-8 rounded-full mr-2 mt-1">

                                <div class="px-3 py-2 rounded-lg max-w-xs
                                    {{ $msg->user_id == Auth::guard('web')->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                                    <div style="color: black">{{ $msg->message }}</div>
                                    <div class="text-xs mt-1 {{ $msg->user_id == Auth::guard('web')->id() ? 'text-blue-100' : 'text-gray-500' }}">
                                        {{ $msg?->created_at?->format('h:i A') }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No messages yet</p>
                        @endforelse
                    </div>

                    <!-- إدخال رسالة جديدة -->
                    <div class="p-4 border-t bg-white flex items-center">
                        <form action="{{ route('chat.send', $currentConversation->id) }}" method="POST" class="flex-1 flex items-center">
                            @csrf
                            <input type="text" name="message"
                                   class="flex-1 border rounded-l p-2 focus:outline-none"
                                   placeholder="Type your message...">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Send</button>
                        </form>
                        <div class="ml-2 text-blue-500 cursor-pointer">🎙️</div>
                    </div>
                @else
                    <div class="flex-1 flex items-center justify-center text-gray-500">
                        Select a conversation from the list
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
