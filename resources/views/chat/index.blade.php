@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')
    <main class="col dashboard-content p-4">

        <h1 class="mb-4">My Conversations</h1>

        <div class="list-group">
            @forelse($conversations as $conversation)
                <a href="{{ route('chat.show', $conversation->id) }}" class="list-group-item list-group-item-action">
                    Chat with:
                    @if($conversation->user_id == auth()->id())
                        {{ $conversation->receiver->name ?? 'Unknown' }}
                    @else
                        {{ $conversation->sender->name ?? 'Unknown' }}
                    @endif
                </a>
            @empty
                <p>No conversations found</p>
            @endforelse
        </div>
    </main>
</div>
