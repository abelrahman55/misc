@extends('dashboard.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 box-1">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center bg-transparent border-0">
                    <h4 class="header-page-1">My Assigned Appointments</h4>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 dashboard-table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Patient</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Specialty</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Service</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date/Time</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Notes</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Payment Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">#{{ $appointment->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $appointment->client->full_name ?? ($appointment->client->f_name ?? 'N/A') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            @php
                                            $lang = app()->getLocale();
                                            @endphp
                                            {{ $appointment->specialty->title[$lang] ?? ($appointment->specialty->title['ar'] ?? 'N/A') }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $appointment->treatmentservice->title[$lang] ?? ($appointment->treatmentservice->title['ar'] ?? 'N/A') }}</p>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">{{ $appointment->appoint_date }} {{ $appointment->appoint_time }}</span>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0" title="{{ $appointment->notes }}">
                                            {{ Str::limit($appointment->notes, 50) }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm @if($appointment->status == 'pending') bg-warning @elseif($appointment->status == 'completed') bg-success @else bg-danger @endif">
                                            {{ $appointment->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($appointment->paid)
                                        <span class="badge badge-sm bg-success">
                                            Paid
                                        </span>
                                        @else
                                        <span class="badge badge-sm bg-danger">
                                            Not Paid
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('appointment_packages.start_chat', $appointment->id) }}" class="btn btn-sm btn-info mb-0">
                                                Chat
                                            </a>

                                            @if(!$appointment->package)
                                            <a href="{{ route('appointment_packages.create', $appointment->id) }}" class="btn btn-sm btn-primary mb-0">
                                                Create Package
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pagination-box">
                    {{ $appointments->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection