@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')
    <main class="col dashboard-content p-4">
        <div class="row">
            <div class="col d-flex justify-content-between align-items-center">
                <h1 class="header-page">Upcoming Appointments</h1>

                <!-- أزرار التبديل -->
                <div class="btn-group">
                    <button class="btn btn-outline-primary" id="showCalendar" title="Calendar">
                        <i class="bi bi-calendar4-week"></i>
                    </button>
                    <button class="btn btn-outline-primary" id="showTable" title="Table">
                        <i class="bi bi-table"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row gap-3 mt-3">
            <div class="col p-4">
                <!-- الكالندر -->
                <div id="calendarView">
                    <div id="calendar"></div>
                </div>

                <!-- الجدول -->
                <div id="tableView" style="display:none;">
                    <h4>Schedule</h4>
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $appointment)
                            <tr>
                                <td>{{ $appointment->doctor->name ?? 'Doctor #'.$appointment->doctor_id }}</td>
                                <td>{{ $appointment->appoint_date }}</td>
                                <td>{{ $appointment->appoint_time }}</td>
                                <td>
                                    <span class="badge
                                        @if($appointment->status == 'Completed') bg-success
                                        @elseif($appointment->status == 'Cancelled') bg-danger
                                        @else bg-warning @endif">
                                        {{ $appointment->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="">
                                        <img src="{{ asset('storage/Group 370.png') }}" alt="">
                                    </a>
                                    <a href="">
                                        <img src="{{ asset('storage/Group 371.png') }}" alt="">
                                    </a>
                                    <a href="">
                                        <img src="{{ asset('storage/Group 372.png') }}" alt="">
                                    </a>
                                    {{--  <button class="btn btn-sm btn-info"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>  --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>
</div>

@push('script')
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- FullCalendar -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js'></script>
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: false,
            events: [
                @foreach($data as $appointment)
                {
                    title: 'موعد مع الدكتور {{ $appointment->doctor->name ?? $appointment->doctor_id }} - {{ $appointment->status }}',
                    start: '{{ $appointment->appoint_date }}T{{ $appointment->appoint_time }}',
                    color: '{{ $appointment->urgence_level == "hard" ? "#ff0000" : "#007bff" }}'
                },
                @endforeach
            ]
        });
        calendar.render();

        // التبديل بين الكالندر والجدول
        document.getElementById('showCalendar').addEventListener('click', function () {
            document.getElementById('calendarView').style.display = 'block';
            document.getElementById('tableView').style.display = 'none';
        });

        document.getElementById('showTable').addEventListener('click', function () {
            document.getElementById('calendarView').style.display = 'none';
            document.getElementById('tableView').style.display = 'block';
        });
    });
</script>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.css' rel='stylesheet' />
@endpush
