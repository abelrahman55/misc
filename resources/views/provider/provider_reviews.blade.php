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
                        <div class="d-flex flex-column gap-4">
                            @foreach ($reviews as $review)
                            <div class="rounded shadow-sm p-4 bg-white">
                                <div class="d-flex justify-content-between mb-3 ">
                                    <div class="d-flex gap-1">
                                        <img src="{{ isset($review->user)?asset('storage/'.$review->user->prof_img):"" }}" alt="Avatar" class="rounded" width="50px"
                                            height="50px" />
                                        <div class="d-flex flex-column gap-1">
                                            <span class="text-2 text-dark">{{ isset($review->user)?$review->user->f_name . $review->user->l_name :"" }}</span>
                                            <span class="timing">{{ $review->created_at }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star text-warning"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-2">
                                        {{ $review->comment }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-4 px-4">
                        <div class="rounded shadow-sm bg-white p-4">
                            <h3 class="mb-4">Rating</h3>
                            <div class="d-flex gap-3 border-bottom pb-2 mb-4">
                                <span class="fs-3 text-dark">4.7</span>
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex gap-1">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star text-warning"></i>
                                    </div>
                                    <span class="timing">based on {{ $user->rate_count }} reviews</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-4">
                                <div class="d-flex flex-column">
                                    <div class="d-flex justify-content-between">
                                        <span>Reliability</span>
                                        <span>{{ $user->rate_avg }}</span>
                                    </div>
                                    <div class="progress" style="height: 7px;">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex justify-content-between">
                                        <span>Payout rating</span>
                                        <span>4.1</span>
                                    </div>
                                     <div class="progress" style="height: 7px;">
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex justify-content-between">
                                        <span>Positive solutions</span>
                                        <span>4.1</span>
                                    </div>
                                     <div class="progress" style="height: 7px;">
                                        <div class="progress-bar bg-purple" role="progressbar"
                                            style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
    </div>
</div>
