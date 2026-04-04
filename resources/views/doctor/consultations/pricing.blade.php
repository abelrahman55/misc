@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page mb-4">Consultation Pricing Settings</h1>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col-md-8 px-3">
                    <div class="card p-4">
                        <div class="card-body">
                            <form action="{{ route('doctor.consultations.pricing.update') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Video Consultation Price (per session)</label>
                                    <input type="number" step="0.01" name="video_consultation_price"
                                        class="form-control"
                                        value="{{ old('video_consultation_price', $doctor->video_consultation_price ?? 0) }}"
                                        required>
                                    @error('video_consultation_price')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Call Consultation Price (per session)</label>
                                    <input type="number" step="0.01" name="call_consultation_price"
                                        class="form-control"
                                        value="{{ old('call_consultation_price', $doctor->call_consultation_price ?? 0) }}"
                                        required>
                                    @error('call_consultation_price')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="first_consultation_free"
                                        class="form-check-input"
                                        id="firstFree"
                                        {{ ($doctor->first_consultation_free ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="firstFree">
                                        Offer first consultation for free
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-purple text-white">Save Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>