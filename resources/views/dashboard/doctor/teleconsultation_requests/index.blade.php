@extends('dashboard.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 box-1">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center bg-transparent border-0">
                    <h4 class="header-page-1">Assigned Teleconsultations</h4>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 dashboard-table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Patient</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Specialty</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Complaint</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($requests as $req)
                                @php $lang = app()->getLocale(); @endphp
                                <tr>
                                    <td><h6 class="mb-0 text-sm px-3">#{{ $req->id }}</h6></td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $req->client->full_name ?? 'N/A' }}</p>
                                        <p class="text-xs text-secondary mb-0">{{ $req->client->phone ?? '' }}</p>
                                    </td>
                                    <td><p class="text-xs font-weight-bold mb-0">{{ $req->specialty ? $req->specialty->title : 'N/A' }}</p></td>
                                    <td><p class="text-xs text-secondary mb-0">{{ Str::limit($req->complaint, 40) }}</p></td>
                                    <td><span class="text-secondary text-xs font-weight-bold">{{ $req->appointment_date ?? 'N/A' }}</span></td>
                                    <td><span class="badge badge-sm bg-success">{{ $req->status }}</span></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @if($req->medicalFiles->count())
                                            <button class="btn btn-sm btn-outline-secondary mb-0" data-bs-toggle="modal" data-bs-target="#filesModal{{ $req->id }}">Files</button>
                                            @endif
                                            <a href="{{ route('teleconsultation_meetings.doctor', $req->id) }}" class="btn btn-sm btn-primary mb-0">Meetings</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center py-4">No assigned consultations yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Files Modal --}}
@foreach($requests as $req)
    @if($req->medicalFiles->count())
    <div class="modal fade" id="filesModal{{ $req->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Files #{{ $req->id }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            @foreach($req->medicalFiles as $file)
                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="d-block mb-2">{{ basename($file->file_path) }}</a>
            @endforeach
        </div>
    </div></div></div>
    @endif
@endforeach
@endsection
