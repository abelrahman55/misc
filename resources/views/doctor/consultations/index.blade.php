@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="header-page">My Consultations</h1>
                <div>
                    <a href="{{ route('doctor.consultations.pricing') }}" class="btn btn-secondary">Pricing Settings</a>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Filter tabs -->
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link {{ !request('status') ? 'active' : '' }}"
                        href="{{ route('doctor.consultations.index') }}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}"
                        href="{{ route('doctor.consultations.index', ['status' => 'pending']) }}">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'scheduled' ? 'active' : '' }}"
                        href="{{ route('doctor.consultations.index', ['status' => 'scheduled']) }}">Scheduled</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'paid' ? 'active' : '' }}"
                        href="{{ route('doctor.consultations.index', ['status' => 'paid']) }}">Paid</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}"
                        href="{{ route('doctor.consultations.index', ['status' => 'completed']) }}">Completed</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-12 px-3">
                    <div class="card p-4">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                        <th>Appointment</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($consultations as $consultation)
                                    <tr>
                                        <td>{{ $consultation->patient->full_name ?? $consultation->patient->f_name }}</td>
                                        <td>
                                            @if($consultation->type === 'video')
                                            <i class="bi bi-camera-video"></i> Video
                                            @else
                                            <i class="bi bi-telephone"></i> Call
                                            @endif
                                        </td>
                                        <td>
                                            @if($consultation->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                            @elseif($consultation->status === 'scheduled')
                                            <span class="badge bg-info">Scheduled</span>
                                            @elseif($consultation->status === 'paid')
                                            <span class="badge bg-success">Paid</span>
                                            @elseif($consultation->status === 'completed')
                                            <span class="badge bg-secondary">Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($consultation->is_free)
                                            <span class="badge bg-success">Free</span>
                                            @else
                                            ${{ number_format($consultation->price, 2) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($consultation->appointment_date)
                                            {{ $consultation->appointment_date }} {{ $consultation->appointment_time }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if($consultation->status === 'pending' || $consultation->status === 'scheduled')
                                            <a href="{{ route('doctor.consultations.set-appointment', $consultation->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="bi bi-calendar"></i> Set Time
                                            </a>
                                            @endif
                                            @if($consultation->meeting_link)
                                            <a href="{{ $consultation->meeting_link }}" target="_blank" class="btn btn-sm btn-success">
                                                <i class="bi bi-box-arrow-up-right"></i> Join
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No consultations found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $consultations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>