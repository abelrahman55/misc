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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="header-page">
                            <svg width="24" height="10" viewBox="0 0 24 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.61619 9.28003C7.40289 8.72536 7.1682 8.21336 6.9122 7.74403C6.65619 7.25336 6.36819 6.7947 6.04819 6.36803H23.2002V3.74403H6.04819C6.3469 3.31736 6.62419 2.86936 6.88019 2.40003C7.13619 1.90936 7.3709 1.3867 7.5842 0.832031H5.15219C3.82949 2.38936 2.37889 3.57336 0.800194 4.38403V5.76003C2.37889 6.52803 3.82949 7.70136 5.15219 9.28003H7.61619Z"
                                    fill="#141414" />
                            </svg>
                            Inquiry Details
                        </h1>
                        <a href="{{ route('inquiries.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="card p-4 mb-4">
                        <div class="card-body">
                            <h5 class="mb-3">Inquiry Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>User</th>
                                    <td>{{ $inquiry->patient->f_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $inquiry->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Contact Details</th>
                                    <td>{{ $inquiry->contact_details ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $inquiry->country->name[app()->getLocale()] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Specialty</th>
                                    <td>{{ $inquiry->specialty->name[app()->getLocale()] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Proximity</th>
                                    <td>{{ $inquiry->proximity ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Reputation</th>
                                    <td>{{ $inquiry->reputation ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Budget</th>
                                    <td>{{ number_format($inquiry->budget, 2) ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Symptoms</th>
                                    <td>{{ $inquiry->symptoms ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td>{{ $inquiry->date ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Treatment Type</th>
                                    <td>{{ $inquiry->treatment_type ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Coordinator</th>
                                    <td>{{ $inquiry->assigned_coordintor ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span
                                            class="badge
                        @if ($inquiry->status == 'pending') bg-warning
                        @elseif($inquiry->status == 'confirmed') bg-info
                        @elseif($inquiry->status == 'in_progress') bg-primary
                        @elseif($inquiry->status == 'awaiting_reply') bg-secondary
                        @elseif($inquiry->status == 'completed') bg-success @endif">
                                            {{ ucfirst(str_replace('_', ' ', $inquiry->status)) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            <h5 class="mt-4 mb-3">Attached Files</h5>
                            @if ($inquiry->files->count())
                                <ul>
                                    @foreach ($inquiry->files as $file)
                                        <li>
                                            <a href="{{ $file->file }}" target="_blank">
                                                File {{ $loop->iteration }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No files attached.</p>
                            @endif
                        </div>
                    </div>


                    {{-- <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('inquiries.edit', $inquiry->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('inquiries.destroy', $inquiry->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div> --}}

                </div>
            </div>
        </main>
    </div>
</div>
