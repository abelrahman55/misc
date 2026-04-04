@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page mb-4">Payment</h1>

            <div class="row">
                <div class="col-md-8 px-3">
                    <!-- Consultation Details -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>Consultation Details</h5>
                            <p><strong>Doctor:</strong> {{ $consultation->doctor->full_name ?? $consultation->doctor->f_name }}</p>
                            <p><strong>Type:</strong>
                                @if($consultation->type === 'video')
                                <i class="bi bi-camera-video"></i> Video Consultation
                                @else
                                <i class="bi bi-telephone"></i> Call Consultation
                                @endif
                            </p>
                            @if($consultation->appointment_date)
                            <p><strong>Appointment:</strong> {{ $consultation->appointment_date }} at {{ $consultation->appointment_time }}</p>
                            @endif
                            <hr>
                            <h4><strong>Amount to Pay:</strong> ${{ number_format($consultation->price, 2) }}</h4>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div class="card p-4">
                        <div class="card-body">
                            <h5 class="mb-3">Payment Method</h5>
                            <form action="{{ route('patient.consultations.payment.process', $consultation->id) }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Select Payment Method</label>
                                    <select name="payment_method" class="form-control" required>
                                        <option value="">Choose...</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="debit_card">Debit Card</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                    </select>
                                    @error('payment_method')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i>
                                    In a production environment, this would integrate with a payment gateway like Stripe, PayPal, or your preferred payment processor.
                                </div>

                                <button type="submit" class="btn btn-purple text-white">
                                    <i class="bi bi-credit-card"></i> Complete Payment
                                </button>
                                <a href="{{ route('patient.consultations.my-bookings') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>