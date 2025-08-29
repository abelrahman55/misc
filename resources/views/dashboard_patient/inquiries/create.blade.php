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
                <h1 class="header-page">Create New Inquiry</h1>
            </div>

            <form action="{{ route('patient.inquiries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row d-flex justify-content-between mb-5">
                    <!-- General Info -->
                    <div class="col d-flex flex-column w-100">
                        <div class="rounded bg-white p-3 mb-5">
                            <p>General Info</p>
                        </div>
                        <div class="rounded bg-white p-3 h-100">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Treatment Type</label>
                                <input type="text" name="treatment_type" class="form-control" value="{{ old('treatment_type') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Assigned Coordinator</label>
                                <input type="text" name="assigned_coordintor" class="form-control" value="{{ old('assigned_coordintor') }}">
                            </div>
                            {{-- <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="awaiting_reply">Awaiting Reply</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div class="col d-flex flex-column w-100">
                        <div class="rounded bg-white p-3 mb-5">
                            <p>Attach Documents</p>
                        </div>
                        <div class="rounded bg-white p-3 h-100">
                            <input type="file" name="files[]" class="form-control mb-3" multiple>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Save Inquiry</button>
            </form>
        </div>
    </div>
</main>

    </div>
</div>
