@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    @if (session('success'))
        <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div id="errorMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page text-muted mb-4">🩺 My Sicking Bookings</h1>

            <div class="row">
                <div class="col pe-4">
                    <!-- Tabs -->
                    <nav class="mb-4 mx-1">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-bookings-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-bookings" type="button" role="tab"
                                aria-controls="nav-bookings" aria-selected="true">Bookings</button>
                            {{--  <button class="nav-link" id="nav-payments-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-payments" type="button" role="tab" aria-controls="nav-payments"
                                aria-selected="false">Payments</button>  --}}
                        </div>
                    </nav>

                    <div class="card border-0 p-4 rounded-4">
                        <div class="tab-content" id="nav-tabContent">
                            <!-- 🩺 Bookings -->
                            <div class="tab-pane fade show active" id="nav-bookings" role="tabpanel"
                                aria-labelledby="nav-bookings-tab">
                                <table class="table table-borderless table-hover text-center align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Package</th>
                                            <th>Offer Price</th>
                                            <th>Date</th>
                                            <th>Created</th>
                                            <th>Meetings</th>
                                            <th>messging</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bookings as $booking)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $booking->package->title['en'] ?? '-' }}
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ number_format($booking->package->price, 2) }} EGP
                                                    </small>
                                                </td>
                                                <td>
                                                    @if ($booking->offer)
                                                        {{ number_format($booking->offer->provider_price, 2) }} EGP
                                                    @else
                                                        <span class="text-muted">No offer yet</span>
                                                    @endif
                                                </td>
                                                <td>{{ $booking->date }}</td>
                                                <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a class="btn btn-success"
                                                        href="{{ route('my_seekin_messages', ['id' => $booking->id]) }}">
                                                        Messiging
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($booking?->offer && $booking?->offer?->paid == 'success')
                                                        <a class="btn btn-purple text-white btn-sm"
                                                            href="{{ route('client_package_offer_meetings', ['id' => $booking->offer->id]) }}">
                                                            Meetings
                                                        </a>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm" disabled>
                                                            No Offer
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($booking?->offer && $booking?->offer?->paid != 'success')
                                                        <button class="btn btn-purple text-white btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#paymentModal"
                                                            data-booking="{{ $booking->id }}"
                                                            data-price="{{ $booking->offer->provider_price }}">
                                                            💳 Pay
                                                        </button>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm" disabled>
                                                            No Offer
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-muted py-4">No bookings found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $bookings->links('pagination::bootstrap-5') }}
                                </div>
                            </div>

                            <!-- 💳 Payments Tab -->
                            <div class="tab-pane fade" id="nav-payments" role="tabpanel"
                                aria-labelledby="nav-payments-tab">
                                <div class="text-center py-5 text-muted">
                                    <i class="bi bi-credit-card fs-1 mb-3"></i>
                                    <p>No payments made yet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- 💳 Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title">Complete Payment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="paymentForm" action="{{ route('package_pay') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="booking_id" id="bookingId">
                    <input type="hidden" name="price" id="bookingPrice">

                    <div class="mb-3">
                        <label class="form-label">Have a Coupon?</label>
                        <input type="text" name="coupon_code" class="form-control"
                            placeholder="Enter coupon code (optional)">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="use_points" id="usePoints">
                        <label class="form-check-label" for="usePoints">
                            Use my available points
                        </label>
                    </div>

                    <div class="alert alert-light border">
                        <strong>Total to pay:</strong> <span id="totalAmount" class="fw-bold">0</span> EGP
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-purple text-white">Confirm Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('paymentModal');
    modal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const bookingId = button.getAttribute('data-booking');
        const price = button.getAttribute('data-price');
        document.getElementById('bookingId').value = bookingId;
        document.getElementById('bookingPrice').value = price;
        document.getElementById('totalAmount').innerText = price;
    });
</script>
