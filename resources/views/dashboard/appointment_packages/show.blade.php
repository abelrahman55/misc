@extends('dashboard.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card box-1">
                <div class="card-header pb-0 bg-transparent border-0 d-flex justify-content-between">
                    <div>
                        <h4 class="header-page-1">Package Details</h4>
                        <p class="text-sm">For Appointment #{{ $package->appointment_id }}</p>
                    </div>
                    <div>
                        <span class="badge @if($package->status == 'pending') bg-warning @elseif($package->status == 'approved') bg-info @elseif($package->status == 'paid') bg-success @else bg-danger @endif">
                            {{ strtoupper($package->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-xs text-secondary mb-0">Title (AR)</h6>
                            <p class="font-weight-bold">{{ $package->title['ar'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-xs text-secondary mb-0">Title (EN)</h6>
                            <p class="font-weight-bold">{{ $package->title['en'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-xs text-secondary mb-0">Price</h6>
                            <p class="font-weight-bold">{{ number_format($package->price, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-xs text-secondary mb-0">Provider</h6>
                            <p class="font-weight-bold">{{ $package->provider->full_name ?? $package->provider->f_name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h6 class="mb-3">Package Items</h6>
                    <ul class="list-group shadow-sm">
                        @forelse($package->manualItems as $item)
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            {{ $item->title }}
                        </li>
                        @empty
                        <p class="text-sm text-center py-3">No items specified for this package.</p>
                        @endforelse
                    </ul>

                    @if($package->status == 'rejected')
                    <div class="alert alert-danger mt-4 text-white">
                        <strong>Rejection Reason:</strong> {{ $package->rejection_reason ?? 'No reason provided.' }}
                    </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back to Appointments</a>
                        @if($package->status == 'rejected')
                        <a href="{{ route('appointment_packages.create', $package->appointment_id) }}" class="btn btn-primary">Create New Version</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection