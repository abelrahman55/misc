@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page mb-4">Set Appointment Time</h1>

            <div class="row">
                <div class="col-md-8 px-3">
                    <!-- Patient Info -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>Patient Information</h5>
                            <p><strong>Name:</strong> {{ $consultation->patient->full_name ?? $consultation->patient->f_name }}</p>
                            <p><strong>Phone:</strong> {{ $consultation->patient->phone }}</p>
                            <p><strong>Type:</strong>
                                @if($consultation->type === 'video')
                                <i class="bi bi-camera-video"></i> Video Consultation
                                @else
                                <i class="bi bi-telephone"></i> Call Consultation
                                @endif
                            </p>
                            @if($consultation->notes)
                            <p><strong>Notes:</strong> {{ $consultation->notes }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Appointment Form -->
                    <div class="card p-4">
                        <div class="card-body">
                            <form action="{{ route('doctor.consultations.save-appointment', $consultation->id) }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Appointment Date</label>
                                    <input type="date" name="appointment_date"
                                        class="form-control"
                                        value="{{ old('appointment_date', $consultation->appointment_date) }}"
                                        min="{{ date('Y-m-d') }}"
                                        required>
                                    @error('appointment_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Appointment Time</label>
                                    <input type="time" name="appointment_time"
                                        class="form-control"
                                        value="{{ old('appointment_time', $consultation->appointment_time) }}"
                                        required>
                                    @error('appointment_time')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Meeting Link (Zoom, Google Meet, etc.)</label>
                                    <input type="url" name="meeting_link"
                                        class="form-control"
                                        value="{{ old('meeting_link', $consultation->meeting_link) }}"
                                        placeholder="https://zoom.us/j/123456789">
                                    @error('meeting_link')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-purple text-white">Set Appointment</button>
                                <a href="{{ route('doctor.consultations.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>