@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">

            {{-- 🔹 إحصائيات --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3">
                        <h6 class="text-secondary">Doctors</h6>
                        <h3 class="fw-bold text-primary">{{ $doctors }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3">
                        <h6 class="text-secondary">Hospitals</h6>
                        <h3 class="fw-bold text-primary">{{ $hospitals }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3">
                        <h6 class="text-secondary">Hotels</h6>
                        <h3 class="fw-bold text-primary">{{ $hotels }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3">
                        <h6 class="text-secondary">Patients</h6>
                        <h3 class="fw-bold text-primary">{{ $patients }}</h3>
                    </div>
                </div>
            </div>
    <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3">
                        <h6 class="text-secondary">Nursing Packages</h6>
                        <h3 class="fw-bold text-success">{{ $nursing_packages }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3">
                        <h6 class="text-secondary">Patients Packages</h6>
                        <h3 class="fw-bold text-success">{{ $packages }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3">
                        <h6 class="text-secondary">Providers Packages</h6>
                        <h3 class="fw-bold text-success">{{ $provider_bookings }}</h3>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3">
                        <h6 class="text-secondary">Packages Bookings</h6>
                        <h3 class="fw-bold text-success">{{ $packages_bookings }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3">
                        <h6 class="text-secondary">Nursing Bookings</h6>
                        <h3 class="fw-bold text-success">{{ $nursing_bookings }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3">
                        <h6 class="text-secondary">Provider Bookings</h6>
                        <h3 class="fw-bold text-success">{{ $provider_bookings }}</h3>
                    </div>
                </div>

            </div>


            {{-- 🔹 آخر الحجوزات --}}
            <div class="card border-0 shadow-sm rounded-3 mt-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="fw-semibold mb-0">🕓 Latest Nursing Bookings</h5>
                    {{--  <a href="#" class="btn btn-outline-primary btn-sm">View All</a>  --}}
                </div>

                <div class="card-body">
                    @if($reservations->count())
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>المريض</th>
                                        <th>التاريخ</th>
                                        <th>اخر رساله</th>
                                        <th>عدد الرسائل</th>
                                        <th>المراسله</th>
                                        <th>عرض السعر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $booking)
                                        <tr>
                                            <td>{{ $booking->id }}</td>
                                            <td>
                                                @if($booking->user)
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="{{ $booking->user->prof_img_url ?? asset('assets/images/user.png') }}"
                                                            alt="User" width="40" height="40" class="rounded-circle border">
                                                        <div>
                                                            <div class="fw-semibold">{{ $booking->user->f_name ?? '' }} {{ $booking->user->l_name ?? '' }}</div>
                                                            <small class="text-muted">{{ $booking->user->email }}</small>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">No user</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($booking->date)->format('Y-m-d') }}</td>
                                            <td>
                                                @if($booking->messages->count())
                                                    {{ Str::limit($booking->messages->last()->message ?? '📎 Attachment', 40) }}
                                                @else
                                                    <span class="text-muted">No messages</span>
                                                @endif
                                            </td>
                                            <td>{{ $booking->messages->count() }}</td>
                                            <td>
                                                <a class="btn btn-primary" href="{{ route('nursing_conv_messages',['id'=>$booking->id]) }}">
                                                    الرسائل
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="{{ route('nursing_make_provider_price',['id'=>$booking->id]) }}">
                                                    عرض سعر
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted">No bookings found.</p>
                    @endif
                </div>
            </div>

        </main>
    </div>
</div>
