@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

@section('content')
<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')

    <main class="col dashboard-content p-4">
    <div class="row mb-3">
        <div class="col d-flex justify-content-between align-items-center">
            <h4 class="header-page-1">My Meetings for Teleconsultation #{{ $id }}</h4>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-white">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger text-white">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm box-1">
        <div class="card-body">
            <h5 class="mb-3">Meetings List</h5>
            <div class="table-responsive">
                <table class="table align-middle dashboard-table">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Doctor</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Time</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($meetings as $key => $meeting)
                            <tr>
                                <td><h6 class="mb-0 text-sm px-3">{{ $key + 1 }}</h6></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $meeting->doctor?->full_name ?? '—' }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $meeting->date ?? '—' }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $meeting->time ?? '—' }}</p></td>
                                <td>
                                    <span class="badge badge-sm bg-{{ $meeting->ended ? 'secondary' : 'success' }}">
                                        {{ $meeting->ended ? 'Ended' : 'Active' }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    @if ($meeting->ended == 0)
                                        <a href="{{ route('teleconsultation_meetings.join', $meeting->id) }}" target="_blank" class="btn btn-sm btn-info mb-0">
                                            Join Call
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-secondary mb-0" disabled>Ended</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No meetings found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $meetings->links() }}
            </div>
        </div>
    </div>
    </main>
</div>
@endsection
