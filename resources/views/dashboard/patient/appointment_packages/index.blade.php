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
                        <h4 class="header-page-1">Special Packages Offers</h4>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 dashboard-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Provider</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($packages as $package)
                                    <tr>
                                        <div class="px-3 py-1">
                                            @php $lang = app()->getLocale(); @endphp
                                            <h6 class="mb-0 text-sm fw-bold">{{ $package->title[$lang] ?? $package->title['ar'] }}</h6>
                                            <p class="text-xs text-secondary mb-1">Appoint #{{ $package->appointment_id }}</p>
                                            <div class="mt-1">
                                                @foreach($package->manualItems as $item)
                                                <span class="badge bg-light text-dark border p-1 text-xxs font-weight-normal me-1 mb-1">
                                                    <i class="bi bi-dot"></i> {{ $item->title }}
                                                </span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 mt-2">{{ number_format($package->price, 2) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 mt-2">{{ $package->provider->full_name ?? ($package->provider->f_name ?? 'N/A') }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="badge mt-2 badge-sm @if($package->status == 'pending') bg-warning @elseif($package->status == 'approved') bg-info @elseif($package->status == 'paid') bg-success @else bg-danger @endif">
                                                {{ strtoupper($package->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($package->status == 'pending')
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('appointment_packages.respond', $package->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="btn btn-sm btn-success mb-0">Approve</button>
                                                </form>
                                                <button class="btn btn-sm btn-danger mb-0" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $package->id }}">Reject</button>
                                            </div>

                                            <!-- Reject Modal -->
                                            <div class="modal fade" id="rejectModal{{ $package->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('appointment_packages.respond', $package->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="rejected">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Reject Package</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea name="rejection_reason" class="form-control" placeholder="Please state why you are rejecting this package..." required></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Submit Rejection</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @elseif($package->status == 'approved')
                                            <form action="{{ route('appointment_packages.pay', $package->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary mb-0">Pay Now</button>
                                            </form>
                                            @else
                                            <span class="text-xs text-muted">No actions available</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pagination-box">
                        {{ $packages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection