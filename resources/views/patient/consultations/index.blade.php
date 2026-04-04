@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page mb-4">My Consultations</h1>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-12 px-3">
                    <div class="card p-4">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Specialty</th>
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
                                        <td>{{ $consultation->doctor->full_name ?? $consultation->doctor->f_name }}</td>
                                        <td>{{ $consultation->doctor->specialist->title['en'] ?? '-' }}</td>
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
                                            {{ $consultation->appointment_date }}<br>{{ $consultation->appointment_time }}
                                            @else
                                            <span class="text-muted">Not set yet</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$consultation->is_free && $consultation->payment_status === 'pending' && $consultation->status === 'scheduled')
                                            <a href="{{ route('patient.consultations.payment', $consultation->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-credit-card"></i> Pay Now
                                            </a>
                                            @elseif($consultation->payment_status === 'paid' && $consultation->meeting_link)
                                            <a href="{{ $consultation->meeting_link }}"
                                                target="_blank"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-box-arrow-up-right"></i> Join Meeting
                                            </a>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No consultations found</td>
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