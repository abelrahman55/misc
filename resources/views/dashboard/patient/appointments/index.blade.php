@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

@section('content')
<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')

    <main class="col dashboard-content p-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 box-1">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center bg-transparent border-0">
                        <h4 class="header-page-1">My Appointments</h4>
                    </div>
                    <div class="card-extra-content px-4 mt-2">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="color: white;">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 dashboard-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Doctor</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Specialty</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Service</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date/Time</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td>
                                            <div class="px-3 py-1">
                                                <h6 class="mb-0 text-sm">#{{ $appointment->id }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 mt-2">{{ $appointment->doctor->full_name ?? ($appointment->doctor->f_name ?? 'N/A') }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 mt-2">
                                                @php $lang = app()->getLocale(); @endphp
                                                {{ $appointment->specialty->title[$lang] ?? ($appointment->specialty->title['ar'] ?? 'N/A') }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 mt-2">{{ $appointment->treatmentservice->title[$lang] ?? ($appointment->treatmentservice->title['ar'] ?? 'N/A') }}</p>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">{{ $appointment->appoint_date }} {{ $appointment->appoint_time }}</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            @php
                                            $package = \App\Models\AppointmentPackage::where('appointment_id', $appointment->id)->first();
                                            @endphp
                                            <span class="badge badge-sm mt-2 @if($appointment->status == 'pending') bg-warning @elseif($appointment->status == 'completed') bg-success @else bg-danger @endif">
                                                {{ $appointment->status }}
                                            </span>
                                            @if($package)
                                            <div class="mt-1">
                                                @if($package->status == 'pending')
                                                <span class="badge badge-sm bg-info">Offer Available</span>
                                                @elseif($package->status == 'approved')
                                                <span class="badge badge-sm bg-primary">Offer Accepted</span>
                                                @elseif($package->status == 'rejected')
                                                <span class="badge badge-sm bg-danger">Offer Rejected</span>
                                                @elseif($package->status == 'paid')
                                                <span class="badge badge-sm bg-success">Offer Paid</span>
                                                @endif
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="d-flex flex-column gap-1 mt-2">
                                                    <a href="{{ route('appointment_packages.start_chat', ['appointment_id' => $appointment->id, 'type' => 'doctor']) }}" class="btn btn-sm btn-info mb-0">
                                                        Chat with Doctor
                                                    </a>
                                                    @if($package)
                                                    <a href="{{ route('appointment_packages.start_chat', ['appointment_id' => $appointment->id, 'type' => 'admin']) }}" class="btn btn-sm btn-outline-info mb-0">
                                                        Chat with Admin
                                                    </a>
                                                    @endif
                                                </div>
                                                @if($package)
                                                <a href="{{ route('appointment_packages.patient_index') }}" class="btn btn-sm btn-primary mb-0">
                                                    View Offer
                                                </a>

                                                @if($package->status == 'pending')
                                                <form action="{{ route('appointment_packages.respond', $package->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="btn btn-sm btn-success mb-0">Approve</button>
                                                </form>
                                                <button type="button" class="btn btn-sm btn-danger mb-0" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $package->id }}">
                                                    Reject
                                                </button>

                                                <!-- Reject Modal -->
                                                <div class="modal fade" id="rejectModal{{ $package->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('appointment_packages.respond', $package->id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="rejected">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Reject Package</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-start">
                                                                    <p class="text-sm">Please tell us why you are rejecting this offer:</p>
                                                                    <textarea name="rejection_reason" class="form-control" rows="3" required></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger">Reject Offer</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @elseif($package->status == 'approved')
                                                <form action="{{ route('appointment_packages.pay') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                    <button type="submit" class="btn btn-sm btn-warning mb-0" title="Pay with Paymob or Points">
                                                        Pay Now
                                                    </button>
                                                </form>
                                                @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="d-flex justify-content-center mt-3">
                        {{ $appointments->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection