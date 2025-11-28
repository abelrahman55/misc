@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('dashboard.layouts.sidebar')

        <!-- Main Content -->
        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="header-page">All Packages</h1>
                <a href="{{ route('packages.create') }}" class="btn btn-purple text-white">
                    + Add New Package
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
                                    <th>Title (EN)</th>
                                    <th>Title (AR)</th>
                                    <th>Price</th>
                                    <th>Options Count</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($packages as $package)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $package->title['en'] ?? '-' }}</td>
                                        <td>{{ $package->title['ar'] ?? '-' }}</td>
                                        <td>{{ number_format($package->price, 2) }} EGP</td>
                                        <td>
                                            <span class="badge bg-purple text-white">
                                                {{ $package->options->count() }}
                                            </span>
                                        </td>
                                        <td>{{ $package->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('packages.show', $package->id) }}">
                                                            👁️ View
                                                        </a>
                                                    </li>
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('packages_reservations', ['id'=>$package->id]) }}">
                                                            Reservations
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('packages.edit', $package->id) }}">
                                                            ✏️ Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('packages.destroy', $package->id) }}" method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this package?');">
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
                                        <td colspan="7" class="text-muted py-4">No packages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $packages->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
