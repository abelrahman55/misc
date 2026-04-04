@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')

    <main class="col dashboard-content p-4">

        <div class="row mb-3">
            <div class="col d-flex justify-content-between align-items-center">
                <h1 class="header-page">Meetings</h1>

                <!-- زر فتح المودال -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMeetingModal">
                    <i class="bi bi-plus-circle"></i> Add Meeting
                </button>
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
                                            <a href="{{ route('client_meeting_join', $appointment->id) }}"
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

{{-- 🟢 مودال الإضافة + Jitsi --}}
<div class="modal fade" id="addMeetingModal" tabindex="-1" aria-labelledby="addMeetingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addMeetingModalLabel">Add New Meeting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('create_package_meeting') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        {{-- بيانات الموعد --}}
                        <div class="col-md-4">
                            <input type="hidden" name="offer_id" value="{{ $id }}">
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="time" class="form-label">Time</label>
                                <input type="time" name="time" id="time" class="form-control" required>
                            </div>

                            {{-- هنخزن هنا لينك الميتنج --}}
                            <input type="hidden" name="meeting" id="meeting">

                            <div class="alert alert-info mt-3">
                                عند فتح المودال بيتولد لينك ميتنج تلقائيًّا ويتخزّن في قاعدة البيانات.
                            </div>
                        </div>

                        {{-- Jitsi Meeting --}}
                        <div class="col-md-8">
                            <div class="border rounded" style="height: 400px; overflow: hidden;">
                                <div id="jitsi-container" style="width: 100%; height: 100%;"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Meeting</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        let jitsiApi = null;

        const addMeetingModal = document.getElementById('addMeetingModal');

        // لما المودال يتفتح
        addMeetingModal.addEventListener('shown.bs.modal', function() {
            const container = document.getElementById("jitsi-container");
            container.innerHTML = ""; // نتأكد إن مفيش instance قديمة

            // اسم روم فريد
            const roomName = "appointment_{{ auth()->id() ?? 'guest' }}_" + Date.now();

            // نخزن اللينك في الانبوت عشان يروح للكنترولر ويتخزن في DB
            const meetingInput = document.getElementById('meeting');
            meetingInput.value = "https://meet.jit.si/" + roomName;

            jitsiApi = new JitsiMeetExternalAPI("meet.jit.si", {
                roomName: roomName,
                parentNode: container,
                userInfo: {
                    displayName: "{{ auth()->check() ? auth()->guard('web')->user()->name : 'Guest' }}"
                },
            });

            // لو حابب ترجع المستخدم للداشبورد بعد ما الميتنج يقفل:
            // jitsiApi.addListener('readyToClose', function () {
            //     window.location.href = "{{ url()->current() }}";
            // });
        });

        // لما المودال يتقفل نمسح الـ instance
        addMeetingModal.addEventListener('hidden.bs.modal', function() {
            if (jitsiApi) {
                jitsiApi.dispose();
                jitsiApi = null;
            }
        });
    </script>
@endpush
