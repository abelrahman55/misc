@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page mb-4">Book Consultation</h1>

            <div class="row">
                <div class="col-12 px-3">
                    <div class="card p-4">
                        <div class="card-body">
                            <h5 class="mb-3">Select a Doctor</h5>

                            @if($doctors->isEmpty())
                            <div class="alert alert-info">No doctors available at the moment.</div>
                            @else
                            <div class="row">
                                @foreach($doctors as $doctor)
                                <div class="col-md-6 mb-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start mb-3">
                                                <img src="{{ $doctor->prof_img ? asset('storage/' . $doctor->prof_img) : asset('images/default-doctor.png') }}"
                                                    alt="{{ $doctor->full_name }}"
                                                    class="rounded-circle me-3"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                                <div>
                                                    <h5 class="mb-1">{{ $doctor->full_name ?? $doctor->f_name . ' ' . $doctor->l_name }}</h5>
                                                    @if($doctor->specialist)
                                                    <p class="text-muted mb-0">{{ $doctor->specialist->title['en'] ?? 'Doctor' }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <h6>Consultation Prices:</h6>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span><i class="bi bi-camera-video text-primary"></i> Video:</span>
                                                    <strong>${{ number_format($doctor->video_consultation_price ?? 0, 2) }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span><i class="bi bi-telephone text-success"></i> Call:</span>
                                                    <strong>${{ number_format($doctor->call_consultation_price ?? 0, 2) }}</strong>
                                                </div>
                                                @if($doctor->first_consultation_free)
                                                <div class="alert alert-success py-1 px-2 mb-0">
                                                    <small><i class="bi bi-gift"></i> First consultation is FREE!</small>
                                                </div>
                                                @endif
                                            </div>

                                            <button type="button"
                                                class="btn btn-purple text-white w-100"
                                                data-bs-toggle="modal"
                                                data-bs-target="#bookModal{{ $doctor->id }}">
                                                <i class="bi bi-calendar-plus"></i> Book Consultation
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Booking Modal -->
                                <div class="modal fade" id="bookModal{{ $doctor->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Book Consultation with {{ $doctor->full_name ?? $doctor->f_name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('patient.consultations.store-booking') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                                                    <div class="mb-3">
                                                        <label class="form-label">Consultation Type</label>
                                                        <select name="type" class="form-control" required>
                                                            <option value="">Select Type</option>
                                                            <option value="video">Video Call - ${{ number_format($doctor->video_consultation_price ?? 0, 2) }}</option>
                                                            <option value="call">Phone Call - ${{ number_format($doctor->call_consultation_price ?? 0, 2) }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Notes (Optional)</label>
                                                        <textarea name="notes" class="form-control" rows="3" placeholder="Any specific concerns or notes..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-purple text-white">Confirm Booking</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>