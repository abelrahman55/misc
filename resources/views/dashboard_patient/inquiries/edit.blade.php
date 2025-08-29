@extends('dashboard_patient.layouts.layout')
@include('dashboard_patient.layouts.header')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('dashboard_patient.layouts.sidebar')

<main class="col dashboard-content p-4">
    <div class="d-flex gap-5">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="header-page">Edit Inquiry #{{ $inquiry->id }}</h1>
                <a href="{{ route('patient.inquiries.index', $inquiry->id) }}" class="btn btn-secondary">← Back</a>
            </div>

            <form action="{{ route('patient.inquiries.update', $inquiry->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row d-flex justify-content-between mb-5">
                    <!-- General Info -->
                    <div class="col d-flex flex-column w-100">
                        <div class="rounded bg-white p-3 mb-5">
                            <p>General Info</p>
                        </div>
                        <div class="rounded bg-white p-3 h-100">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" value="{{ old('date', $inquiry->date) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Treatment Type</label>
                                <input type="text" name="treatment_type" class="form-control" value="{{ old('treatment_type', $inquiry->treatment_type) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Assigned Coordinator</label>
                                <input type="text" name="assigned_coordintor" class="form-control" value="{{ old('assigned_coordintor', $inquiry->assigned_coordintor) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $inquiry->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $inquiry->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="in_progress" {{ $inquiry->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="awaiting_reply" {{ $inquiry->status == 'awaiting_reply' ? 'selected' : '' }}>Awaiting Reply</option>
                                    <option value="completed" {{ $inquiry->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div class="col d-flex flex-column w-100">
                        <div class="rounded bg-white p-3 mb-5">
                            <p>Attached Documents</p>
                        </div>
                        <div class="d-flex flex-column gap-3 rounded bg-white p-3 h-100">
                            <input type="file" name="files[]" class="form-control mb-3" multiple>

                            @if($inquiry->files->count())
                                @foreach($inquiry->files as $file)
                                    <div class="d-flex justify-content-between align-items-start border p-2 rounded">
                                        <div class="d-flex gap-3 align-items-start">
                                            <div>
                                                <i class="bi bi-file-earmark-text"></i>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="file-name">{{ basename($file->file) }}</span>
                                                <a href="{{ $file->file }}" target="_blank" class="file-link">Click to view</a>

                                                {{-- <a href="{{ asset('storage/'.$file->file) }}" target="_blank" class="file-link">Click to view</a> --}}
                                            </div>
                                        </div>
                                        {{-- <form action="{{ route('inquiries.files.destroy', [$inquiry->id, $file->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-danger"><i class="bi bi-trash"></i></button>
                                        </form> --}}
                                    </div>
                                @endforeach
                            @else
                                <span class="text-muted">No files uploaded</span>
                            @endif
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Inquiry</button>
            </form>
        </div>
    </div>
</main>

    </div>
</div>
