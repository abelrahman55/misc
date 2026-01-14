@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')

    <main class="col dashboard-content p-4">

        <h2 class="mb-4">Welcome, {{ auth()->guard('web')->user()->f_name ?? 'Patient' }}</h2>

        {{-- ===================================== --}}
        {{-- 🔵 Meetings --}}
        {{-- ===================================== --}}
        {{--  <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                Latest Sicking Meetings
            </div>
            <div class="card-body">

                @if ($meetings->count())
                    <table class="table table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($meetings as $key => $appointment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $appointment->user?->f_name ?? '—' }}</td>
                                    <td>{{ $appointment->doctor?->f_name ?? '—' }}</td>
                                    <td>{{ $appointment->date ?? '—' }}</td>
                                    <td>{{ $appointment->time ?? '—' }}</td>
                                    <td>
                                        @if ($appointment->meeting && $appointment->ended == 0)
                                            @if ($appointment->meeting && $appointment->ended == 0)
                                                <a href="{{ route('client_meeting_join', $appointment->id) }}"
                                                    target="_blank" class="btn btn-sm btn-success">
                                                    <i class="bi bi-camera-video"></i> Join
                                                </a>
                                            @else
                                                <span class="text-muted">No link</span>
                                            @endif
                                        @else
                                            <span class="text-muted">No link</span>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No meetings found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

        {{ $meetings->links() }}
    @else
        <p class="text-muted">No meetings found.</p>
        @endif

</div>
</div> --}}

        {{-- ===================================== --}}
        {{-- 🟢 Hospital Bookings --}}
        {{-- ===================================== --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                Hospital Bookings
            </div>
            <div class="card-body">

                @if ($hospitalBookings->count())
                    <table class="table table-borderless table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Offer Price</th>
                                <th>Date</th>
                                <th>Created</th>
                                <th>Meetings</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hospitalBookings as $booking)
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
                                        @if ($booking?->offer && $booking?->offer?->paid == 'success')
                                            <a class="btn btn-purple text-white btn-sm"
                                                href="{{ route('offer_meetings', ['id' => $booking->offer->id]) }}">
                                                Meetings
                                            </a>
                                        @else
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                No Offer
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($booking->offer && $booking->offer->paid != 'success')
                                            <button class="btn btn-purple text-white btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#paymentModal" data-booking="{{ $booking->id }}"
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

                    {{ $hospitalBookings->links() }}
                @else
                    <p class="text-muted">No hospital bookings.</p>
                @endif

            </div>
        </div>


    </main>
</div>


<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title">Complete Payment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="paymentForm" action="{{ route('nursing_pay') }}" method="POST">
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


<div class="modal fade" id="paymentModal2" tabindex="-1" aria-hidden="true">
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

@push('script')
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
    <script>
        const modal = document.getElementById('paymentModal2');
        modal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const bookingId = button.getAttribute('data-booking');
            const price = button.getAttribute('data-price');
            document.getElementById('bookingId').value = bookingId;
            document.getElementById('bookingPrice').value = price;
            document.getElementById('totalAmount').innerText = price;
        });
    </script>
@endpush
