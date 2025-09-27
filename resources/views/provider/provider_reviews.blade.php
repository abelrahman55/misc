@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')
        <main class="col-md-10 p-4" style="font-family: Noto Sans Lao, sans-serif">
            <div class="row h-100">
                <div class="col px-4 py-2 pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <h2 class="text-1 text-dark">
                            Reviews and Ratings
                        </h2>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary">Response <i class="bi bi-reply"></i></button>
                            <button class="btn btn-primary">Share Review <i class="bi bi-share"></i></button>
                        </div>
                    </div>

                    {{-- قائمة الريفيوهات --}}
                    <div class="d-flex flex-column gap-4">
                        @foreach ($reviews as $review)
                            <div class="rounded shadow-sm p-4 bg-white">
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="d-flex gap-2">
                                        <img src="{{ isset($review->user) ? asset('storage/'.$review->user->prof_img) : asset('default-avatar.png') }}"
                                            alt="Avatar" class="rounded" width="50" height="50" />

                                        <div class="d-flex flex-column gap-1">
                                            <span class="text-2 text-dark">
                                                {{ isset($review->user) ? $review->user->f_name . ' ' . $review->user->l_name : 'Unknown User' }}
                                            </span>
                                            <span class="timing">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-1">
                                        @php
                                            $fullStars = floor($review->rate ?? 0);
                                            $halfStar = ($review->rate - $fullStars) >= 0.5 ? 1 : 0;
                                            $emptyStars = 5 - ($fullStars + $halfStar);
                                        @endphp

                                        {{-- النجوم الكاملة --}}
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @endfor

                                        {{-- نص نجمة --}}
                                        @if ($halfStar)
                                            <i class="bi bi-star-half text-warning"></i>
                                        @endif

                                        {{-- النجوم الفاضية --}}
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="bi bi-star text-warning"></i>
                                        @endfor
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <span class="text-2">
                                        {{ $review->comment }}
                                    </span>
                                </div>

                                {{-- Form الرد على التقييم --}}
                                <div class="mt-3">
                                    {{-- Form الرد على التقييم --}}
<div class="mt-3">
    <form action="{{ route('reply_review', $review->id) }}" method="POST" class="d-flex gap-2">
        @csrf
        <input
            type="text"
            name="reply"
            class="form-control"
            placeholder="Write a reply..."
            value="{{ old('reply', $review->reply) }}" {{-- لو فيه رد قديم يظهر --}}
            required
        >
        <button type="submit" class="btn btn-sm btn-primary">
            {{ $review->reply ? 'Update Reply' : 'Reply' }}
        </button>
    </form>
</div>

                                </div>

                                {{-- لو فيه رد محفوظ مسبقاً --}}
                                @if($review->reply)
                                    <div class="mt-2 ps-4 border-start border-2">
                                        <strong class="d-block mb-1 text-primary">Your Response:</strong>
                                        <span class="text-muted">{{ $review->reply }}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- العمود الجانبي للتقييم العام --}}
                <div class="col-4 px-4">
                    <div class="rounded shadow-sm bg-white p-4">
                        <h3 class="mb-4">Rating</h3>
                        <div class="d-flex gap-3 border-bottom pb-2 mb-4">
                            <span class="fs-3 text-dark">{{ number_format($user->rate_avg, 1) }}</span>
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex gap-1">
                                    @php
                                        $fullStars = floor($user->rate_avg); // النجوم الكاملة
                                        $halfStar = ($user->rate_avg - $fullStars) >= 0.5 ? 1 : 0; // نص نجمة
                                        $emptyStars = 5 - ($fullStars + $halfStar); // الباقي فاضي
                                    @endphp

                                    {{-- النجوم الكاملة --}}
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @endfor

                                    {{-- نص نجمة --}}
                                    @if ($halfStar)
                                        <i class="bi bi-star-half text-warning"></i>
                                    @endif

                                    {{-- النجوم الفاضية --}}
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="bi bi-star text-warning"></i>
                                    @endfor
                                </div>
                                <span class="timing">based on {{ $user->rate_count }} reviews</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
