@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

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

                    <form action="{{ route('inquiries.store') }}" method="POST" enctype="multipart/form-data">
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

                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Contact Details</label>
                                        <input type="text" name="contact_details" class="form-control" value="{{ old('contact_details') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <select name="country_id" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                  {{ $country->getTranslation('name', app()->getLocale()) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Specialty</label>
                                        <select name="specialty_id" class="form-control">
                                            <option value="">Select Specialty</option>
                                            @foreach($specialties as $specialty)
                                                <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>
                                                    {{ $specialty->title[app()->getLocale()] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Proximity</label>
                                        <input type="text" name="proximity" class="form-control" value="{{ old('proximity') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Reputation</label>
                                        <input type="text" name="reputation" class="form-control" value="{{ old('reputation') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Budget</label>
                                        <input type="number" step="0.01" name="budget" class="form-control" value="{{ old('budget') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Symptoms</label>
                                        <textarea name="symptoms" class="form-control">{{ old('symptoms') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="awaiting_reply" {{ old('status') == 'awaiting_reply' ? 'selected' : '' }}>Awaiting Reply</option>
                                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <!-- Attachments -->
                            <div class="col d-flex flex-column w-100">
                                <div class="rounded bg-white p-3 mb-5 d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Attach Documents</p>
                                    <button type="button" class="btn btn-sm btn-primary" id="addFileInput">
                                        <i class="bi bi-plus-circle"></i> Add File
                                    </button>
                                </div>
                                <div class="rounded bg-white p-3 h-100" id="fileInputsWrapper">
                                    <div class="mb-3 d-flex gap-2 align-items-center">
                                        <input type="file" name="files[]" class="form-control">
                                    </div>
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

@push('script')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let wrapper = document.getElementById("fileInputsWrapper");
        let addBtn = document.getElementById("addFileInput");

        addBtn.addEventListener("click", function() {
            let newInput = document.createElement("div");
            newInput.classList.add("mb-3", "d-flex", "gap-2", "align-items-center");

            newInput.innerHTML = `
                <input type="file" name="files[]" class="form-control">
                <button type="button" class="btn btn-danger btn-sm removeFile">
                    <i class="bi bi-trash"></i>
                </button>
            `;

            wrapper.appendChild(newInput);

            newInput.querySelector(".removeFile").addEventListener("click", function() {
                newInput.remove();
            });
        });
    });
</script>
@endpush
