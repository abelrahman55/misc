@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')


<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('dashboard.layouts.sidebar')

        <!-- Main Content -->
       <main class="col dashboard-content p-4">
    <div class="d-flex gap-5">
        <div class="col">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="header-page">
                    <svg width="24" height="10" viewBox="0 0 24 10" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.61619 9.28003C7.40289 8.72536 7.1682 8.21336 6.9122 7.74403C6.65619 7.25336 6.36819 6.7947 6.04819 6.36803H23.2002V3.74403H6.04819C6.3469 3.31736 6.62419 2.86936 6.88019 2.40003C7.13619 1.90936 7.3709 1.3867 7.5842 0.832031H5.15219C3.82949 2.38936 2.37889 3.57336 0.800194 4.38403V5.76003C2.37889 6.52803 3.82949 7.70136 5.15219 9.28003H7.61619Z"
                            fill="#141414" />
                    </svg>
                    My Inquiries
                </h1>
                <a href="{{ route('inquiries.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> New Inquiry
                </a>
            </div>

            <!-- Filters -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <input type="text" placeholder="Search..." class="form-control" />
                </div>
                <div class="btn-group filter-box" role="group">
                    <button type="button" class="btn border-0 border-end"><i class="bi bi-funnel"></i></button>
                    <button type="button" class="btn border-0 border-end">Filter By</button>
                    <select class="btn border-0 border-end">
                        <option value="">Select Date</option>
                        <option value="">Today</option>
                        <option value="">Last 7 Days</option>
                    </select>
                    <select class="btn border-0 border-end">
                        <option value="">Inquiry Status</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    <button type="button" class="btn reset-filter-btn">
                        <i class="bi bi-arrow-clockwise"></i> Reset Filter
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table dashboard-table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Treatment Type</th>
                            <th scope="col">Coordinator</th>
                            <th scope="col">Date</th>
                            <th scope="col">Hospitals</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- مثال ثابت -->


                        <!-- تكرار بالـ foreach -->
                        @foreach($data as $inquiry)
                        <tr>
                            <td>{{ $inquiry->id }}</td>
                            <td>{{ $inquiry->treatment_type }}</td>
                            <td>{{ $inquiry->assigned_coordintor }}</td>
                            <td>{{ $inquiry->date }}</td>
                            <td>{{ $inquiry->hospital->name ?? '-' }}</td>
                            <td>
                                <span class="badge
                                    @if($inquiry->status == 'pending') bg-warning
                                    @elseif($inquiry->status == 'completed') bg-success
                                    @else bg-info @endif">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            </td>
                            <td>
                                <i class="bi bi-three-dots" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"></i>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('inquiries.edit', $inquiry->id) }}">Edit</a></li>
                                    <li><a class="dropdown-item" href="{{ route('inquiries.show', $inquiry->id) }}">View</a></li>
                                    <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-between pagination-box">
                    <p class="pagination-text">Showing {{ $data->firstItem() }}-{{ $data->lastItem() }} of {{ $data->total() }}</p>
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</main>

    </div>
</div>
