@extends('dashboard.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-3">
        <div class="col d-flex justify-content-between align-items-center">
            <h4 class="header-page-1">Teleconsultation Meetings #{{ $id }}</h4>

            <!-- زر فتح المودال -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMeetingModal">
                <i class="bi bi-plus-circle"></i> Add Meeting
            </button>
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
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Patient</th>
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
                                <td><p class="text-xs font-weight-bold mb-0">{{ $meeting->client?->full_name ?? '—' }}</p></td>
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
                                        <a href="{{ route('teleconsultation_meetings.join', $meeting->id) }}" target="_blank" class="btn btn-sm btn-success mb-0 me-1">
                                            Join
                                        </a>
                                        <a href="{{ route('teleconsultation_meetings.end', $meeting->id) }}" class="btn btn-sm btn-danger mb-0">
                                            End
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-secondary mb-0" disabled>Ended</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No meetings found</td>
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
</div>

<!-- Add Meeting Modal -->
<div class="modal fade" id="addMeetingModal" tabindex="-1" aria-labelledby="addMeetingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMeetingModalLabel">Add New Meeting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('teleconsultation_meetings.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="teleconsultation_request_id" value="{{ $id }}">
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control" required value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Time</label>
                                <input type="time" name="time" id="time" class="form-control" required value="{{ date('H:i') }}">
                            </div>
                            <div class="alert alert-info mt-3 text-white">
                                Will generate a unique Jitsi meeting automatically.
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
                    <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary mb-0">Save Meeting</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://meet.jit.si/external_api.js"></script>
<script>
    let jitsiApi = null;
    const addMeetingModal = document.getElementById('addMeetingModal');

    addMeetingModal.addEventListener('shown.bs.modal', function() {
        const container = document.getElementById("jitsi-container");
        container.innerHTML = ""; 

        const roomName = "teleconsultation_" + "{{ $id }}_" + Date.now();

        jitsiApi = new JitsiMeetExternalAPI("meet.jit.si", {
            roomName: roomName,
            parentNode: container,
            userInfo: {
                displayName: "{{ auth()->check() ? auth()->guard('web')->user()->f_name : 'Doctor' }}"
            },
        });
    });

    addMeetingModal.addEventListener('hidden.bs.modal', function() {
        if (jitsiApi) {
            jitsiApi.dispose();
            jitsiApi = null;
        }
    });
</script>
@endpush
@endsection
