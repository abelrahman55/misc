@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('dashboard.layouts.sidebar')

        <!-- Main Content -->
        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="header-page">All Coupons</h1>
                <a href="{{ route('create_coupon') }}" class="btn btn-purple text-white">
                    + Add New Coupon
                </a>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Discount (%)</th>
                                    <th>Min Order</th>
                                    <th>Usage Limit</th>
                                    <th>Used Count</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>Expiry Date</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $coupon->code }}</strong></td>
                                        <td>{{ $coupon->discount_percent }}%</td>
                                        <td>{{ number_format($coupon->min_order, 2) }}</td>
                                        <td>{{ $coupon->usage_limit }}</td>
                                        <td>{{ $coupon->used_count ?? 0 }}</td>
                                        <td>
                                            @if ($coupon->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $coupon->starts_at?->format('Y-m-d H:i') ?? '-' }}</td>
                                        <td>{{ $coupon->expires_at?->format('Y-m-d H:i') ?? '-' }}</td>
                                        <td>{{ $coupon->created_at->format('Y-m-d') }}</td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('edit_coupon', ['id'=>$coupon->id]) }}">
                                                            ✏️ Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('delete_coupon', ['id'=>$coupon->id]) }}" method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this coupon?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                🗑️ Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-muted py-4">No coupons found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $coupons->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
