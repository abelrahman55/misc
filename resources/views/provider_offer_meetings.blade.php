@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')

    <main class="col dashboard-content p-4">

        <div class="row mb-3">
            <div class="col d-flex justify-content-between align-items-center">
                <h1 class="header-page">Meetings</h1>

            </div>
        </div>

        {{-- ✅ رسالة نجاح --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- ✅ رسائل الأخطاء --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 🗓️ جدول الميتنجات --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Meetings List</h4>
                <table class="table table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($meetings as $key => $appointment)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $appointment->user?->f_name ?? '—' }}</td>
                                <td>{{ $appointment->doctor?->f_name ?? '—' }}</td>
                                <td>{{ $appointment->date ?? '—' }}</td>
                                <td>{{ $appointment->time ?? '—' }}</td>
                                <td>
                                    @if ($appointment->meeting && $appointment->ended == 0)
                                        @if ($appointment->meeting && $appointment->ended == 0)
                                            <a href="{{ route('provider_meeting_join', $appointment->id) }}"
                                                target="_blank" class="btn btn-sm btn-success">
                                                <i class="bi bi-camera-video"></i> Join
                                            </a>
                                        @else
                                            <span class="text-muted">No link</span>
                                        @endif
                                    @else
                                        <span class="text-muted">No link</span>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No meetings found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>
