@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')


<div class="container-fluid">
    <div class="row">
        @include('dashboard_patient.layouts.sidebar')

        <main class="col dashboard-content p-4">
            <div class="d-flex gap-5">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="header-page">
                            Feedback & Reviews
                        </h1>
                    </div>
                    <div class="d-flex flex-column">
                        <!-- Tabs -->
                        <div class="d-flex gap-3 p-3 mb-5" id="feedback" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active fw-semibold pb-2" id="feedback-rate-tab"
                                data-bs-toggle="pill" data-bs-target="#feedback-rate" type="button" role="tab"
                                aria-controls="feedback-rate" aria-selected="true">Rate</button>

                            <button class="nav-link fw-semibold pb-2" id="feedback-suggestions-tab"
                                data-bs-toggle="pill" data-bs-target="#feedback-suggestions" type="button" role="tab"
                                aria-controls="feedback-suggestions" aria-selected="false">Suggestions</button>

                            <button class="nav-link fw-semibold pb-2" id="feedback-history-tab" data-bs-toggle="pill"
                                data-bs-target="#feedback-history" type="button" role="tab"
                                aria-controls="feedback-history" aria-selected="false">History</button>
                        </div>

                        <!-- Tab content -->
                        <div class="tab-content" id="feedback-tabContent">
                            <div class="tab-pane fade show active" id="feedback-rate" role="tabpanel"
                                aria-labelledby="feedback-rate-tab" tabindex="0">
                                rew
                            </div>

                            <!-- Suggestions Form -->
                            <div class="tab-pane fade" id="feedback-suggestions" role="tabpanel"
                                aria-labelledby="feedback-suggestions-tab" tabindex="0">

                                <form action="{{ route('feedback_review.store') }}" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="description" placeholder="Leave a comment here" id="suggestions"
                                            style="height: 100px" required></textarea>
                                        <label for="suggestions">Write your suggestions for improvement</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>

                            <!-- History -->
                            <div class="tab-pane fade bg-white" id="feedback-history" role="tabpanel"
                                aria-labelledby="feedback-history-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col">
                                        <div class="d-flex flex-column gap-4 p-4">

                                            @forelse($data as $feedback)
                                                <div class="d-flex flex-column gap-1 pb-2 border-bottom">
                                                    <span class="timing">{{ $feedback->created_at->format('M d, Y') }}</span>

                                                    <div class="d-flex align-items-center gap-1">
                                                        <div class="text-center">
                                                            <img src="{{ asset('assets/images/user.png') }}" class="rounded"
                                                                alt="user avatar" width="45" height="45">
                                                        </div>
                                                        <span class="username">{{ $feedback->user->name ?? 'Unknown' }}</span>
                                                    </div>
                                                    <p class="feedback-txt">{{ $feedback->description }}</p>
                                                </div>
                                            @empty
                                                <p class="text-muted">No feedback yet.</p>
                                            @endforelse

                                        </div>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
