@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

@php
$lang     = app()->getLocale();
$isOwner  = auth()->guard('web')->user()?->id == $patient?->id;
$canEdit  = $isOwner || auth()->guard('web')->user()?->role == 'admin';
@endphp

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')
        <main class="col-md-10 px-4 py-0">
            <div class="row h-100">

                {{-- ===== Sidebar Nav ===== --}}
                <div class="col-4 px-0 bg-white shadow-sm">
                    <div class="p-4">
                        <h2 class="header-page-1 mb-5">
                            <a href="{{ url()->previous() }}" class="text-dark text-decoration-none">
                                <i class="bi bi-arrow-left-short"></i>
                            </a>
                            Patient Profile
                        </h2>

                        <div class="d-flex flex-column gap-1 align-items-center mb-3">
                            <img src="{{ $patient->prof_img ? asset('storage/' . $patient->prof_img) : asset('assets/images/user.png') }}"
                                alt="patient" width="75" height="75"
                                class="rounded-circle img-thumbnail object-fit-cover">
                            <span class="heading-3 fw-bold text-dark">
                                {{ trim(($patient->f_name ?? '') . ' ' . ($patient->l_name ?? '')) }}
                            </span>
                            <span class="badge bg-info text-dark">Patient</span>
                            <div class="d-flex gap-1 text-3 text-muted">
                                <span>{{ $patient->age ?? '—' }} years old</span>
                                <span>|</span>
                                <span><i class="bi bi-geo-alt"></i>
                                    {{ isset($patient->country) ? $patient->country->getTranslation('name', $lang) : '' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills nav-profile w-100 px-1" id="v-pills-tab"
                            role="tablist" aria-orientation="vertical">
                            <button class="nav-link active text-start" data-bs-toggle="pill"
                                data-bs-target="#tab-personal" type="button">General Information</button>
                            <button class="nav-link text-start" data-bs-toggle="pill"
                                data-bs-target="#tab-vitals" type="button">Vitals & Health</button>
                            <button class="nav-link text-start" data-bs-toggle="pill"
                                data-bs-target="#tab-emergency" type="button">Emergency Contact</button>
                            <button class="nav-link text-start" data-bs-toggle="pill"
                                data-bs-target="#tab-lab" type="button">Lab Data</button>
                            <button class="nav-link text-start" data-bs-toggle="pill"
                                data-bs-target="#tab-meds" type="button">Medications</button>
                            <button class="nav-link text-start" data-bs-toggle="pill"
                                data-bs-target="#tab-surgery" type="button">Surgeries</button>
                            <button class="nav-link text-start" data-bs-toggle="pill"
                                data-bs-target="#tab-allergies" type="button">Allergies</button>
                            <button class="nav-link text-start" data-bs-toggle="pill"
                                data-bs-target="#tab-notes" type="button">Consultation Notes</button>
                            <button class="nav-link text-start" data-bs-toggle="pill"
                                data-bs-target="#tab-files" type="button">Files</button>
                        </div>
                    </div>
                </div>

                {{-- ===== Tab Content ===== --}}
                <div class="col p-4 overflow-auto" style="max-height: 100vh;">

                    {{-- Flash --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="tab-content" id="v-pills-tabContent">

                        {{-- ==================================================
                             TAB 1: Personal / General Info
                             ================================================== --}}
                        <div class="tab-pane fade show active" id="tab-personal">
                            <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $patient->id }}">

                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-4">Demographics</h3>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">First Name</label>
                                            <input type="text" name="f_name" class="form-control"
                                                value="{{ old('f_name', $patient->f_name) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Middle Name</label>
                                            <input type="text" name="m_name" class="form-control"
                                                value="{{ old('m_name', $patient->m_name) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Last Name</label>
                                            <input type="text" name="l_name" class="form-control"
                                                value="{{ old('l_name', $patient->l_name) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Gender</label>
                                            <select name="gender" class="form-select" {{ $canEdit ? '' : 'disabled' }}>
                                                <option value="">-- Select --</option>
                                                <option value="male"   {{ old('gender',$patient->gender) == 'male'   ? 'selected':'' }}>Male</option>
                                                <option value="female" {{ old('gender',$patient->gender) == 'female' ? 'selected':'' }}>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Date of Birth</label>
                                            <input type="date" name="dob" class="form-control"
                                                value="{{ old('dob', $patient->dob) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Age</label>
                                            <input type="text" name="age" class="form-control"
                                                value="{{ old('age', $patient->age) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Relationship</label>
                                            <input type="text" name="relationship" class="form-control"
                                                value="{{ old('relationship', $patient->relationship) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Language</label>
                                            <input type="text" name="language" class="form-control"
                                                value="{{ old('language', $patient->language) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Military Status</label>
                                            <select name="military_status" class="form-select" {{ $canEdit ? '' : 'disabled' }}>
                                                <option value="">-- Select --</option>
                                                <option value="active"   {{ old('military_status',$patient->military_status)=='active'  ?'selected':'' }}>Active</option>
                                                <option value="inactive" {{ old('military_status',$patient->military_status)=='inactive'?'selected':'' }}>Inactive</option>
                                                <option value="veteran"  {{ old('military_status',$patient->military_status)=='veteran' ?'selected':'' }}>Veteran</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Occupation</label>
                                            <input type="text" name="occupation" class="form-control"
                                                value="{{ old('occupation', $patient->occupation) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                    </div>
                                </div>

                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-4">Contact Information</h3>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', $patient->email) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone', $patient->phone) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Mobile Number</label>
                                            <input type="text" name="mobile_number" class="form-control"
                                                value="{{ old('mobile_number', $patient->mobile_number) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Home Number</label>
                                            <input type="text" name="home_number" class="form-control"
                                                value="{{ old('home_number', $patient->home_number) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Country</label>
                                            <select name="country_id" class="form-select" {{ $canEdit ? '' : 'disabled' }}>
                                                <option value="">-- Select Country --</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                        {{ old('country_id', $patient->country_id) == $country->id ? 'selected' : '' }}>
                                                        {{ $country->getTranslation('name', $lang) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Town / City</label>
                                            <select name="town_id" class="form-select" {{ $canEdit ? '' : 'disabled' }}>
                                                <option value="">-- Select Town --</option>
                                                @foreach($towns as $town)
                                                    <option value="{{ $town->id }}"
                                                        {{ old('town_id', $patient->town_id) == $town->id ? 'selected' : '' }}>
                                                        {{ $town->getTranslation('name', $lang) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Street Name</label>
                                            <input type="text" name="street_name" class="form-control"
                                                value="{{ old('street_name', $patient->street_name) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                    </div>
                                </div>

                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-4">Medical Summary</h3>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Known Allergies (summary)</label>
                                            <textarea name="allergies" class="form-control" rows="2" {{ $canEdit ? '' : 'disabled' }}>{{ old('allergies', $patient->allergies) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Current Medications (summary)</label>
                                            <textarea name="medications" class="form-control" rows="2" {{ $canEdit ? '' : 'disabled' }}>{{ old('medications', $patient->medications) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">DNR Status</label>
                                            <input type="text" name="dnr" class="form-control"
                                                value="{{ old('dnr', $patient->dnr) }}" {{ $canEdit ? '' : 'disabled' }} placeholder="Yes / No">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Organ Donation</label>
                                            <input type="text" name="organ_donation" class="form-control"
                                                value="{{ old('organ_donation', $patient->organ_donation) }}" {{ $canEdit ? '' : 'disabled' }} placeholder="Yes / No">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Chronic Illnesses</label>
                                            <textarea name="chro_ill_conditions" class="form-control" rows="2" {{ $canEdit ? '' : 'disabled' }}>{{ old('chro_ill_conditions', $patient->chro_ill_conditions) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Surgical History (summary)</label>
                                            <textarea name="surgical_history" class="form-control" rows="2" {{ $canEdit ? '' : 'disabled' }}>{{ old('surgical_history', $patient->surgical_history) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Family History</label>
                                            <textarea name="family_history" class="form-control" rows="2" {{ $canEdit ? '' : 'disabled' }}>{{ old('family_history', $patient->family_history) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Dietary Preferences</label>
                                            <input type="text" name="dietary_preferences" class="form-control"
                                                value="{{ old('dietary_preferences', $patient->dietary_preferences) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Smoking</label>
                                            <select name="smoking" class="form-select" {{ $canEdit ? '' : 'disabled' }}>
                                                <option value="0" {{ old('smoking',$patient->smoking) == 0 ? 'selected':'' }}>No</option>
                                                <option value="1" {{ old('smoking',$patient->smoking) == 1 ? 'selected':'' }}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Alcohol</label>
                                            <select name="alcohol" class="form-select" {{ $canEdit ? '' : 'disabled' }}>
                                                <option value="0" {{ old('alcohol',$patient->alcohol) == 0 ? 'selected':'' }}>No</option>
                                                <option value="1" {{ old('alcohol',$patient->alcohol) == 1 ? 'selected':'' }}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Physical Activity</label>
                                            <select name="physical_activity" class="form-select" {{ $canEdit ? '' : 'disabled' }}>
                                                <option value="0" {{ old('physical_activity',$patient->physical_activity) == 0 ? 'selected':'' }}>No</option>
                                                <option value="1" {{ old('physical_activity',$patient->physical_activity) == 1 ? 'selected':'' }}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Preferred Hospital</label>
                                            <input type="text" name="prefered_hospital" class="form-control"
                                                value="{{ old('prefered_hospital', $patient->prefered_hospital) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Preferred Clinic</label>
                                            <input type="text" name="prefered_clinic" class="form-control"
                                                value="{{ old('prefered_clinic', $patient->prefered_clinic) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Preferred Specialist</label>
                                            <input type="text" name="prefered_specialist" class="form-control"
                                                value="{{ old('prefered_specialist', $patient->prefered_specialist) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                    </div>
                                </div>

                                @if($canEdit)
                                    <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                        <h3 class="header-page mb-3">Profile Image</h3>
                                        <div class="d-flex align-items-center gap-4">
                                            <img src="{{ $patient->prof_img ? asset('storage/' . $patient->prof_img) : asset('assets/images/user.png') }}"
                                                width="70" height="70" class="rounded-circle img-thumbnail">
                                            <input type="file" name="prof_img" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-5">
                                        <i class="bi bi-save me-2"></i>Save General Info
                                    </button>
                                @endif
                            </form>
                        </div>

                        {{-- ==================================================
                             TAB 2: Vitals & Health
                             ================================================== --}}
                        <div class="tab-pane fade" id="tab-vitals">
                            <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $patient->id }}">

                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-4">Vital Signs</h3>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Heart Rate (bpm)</label>
                                            <input type="text" name="heart_rate" class="form-control"
                                                value="{{ old('heart_rate', $patient->heart_rate) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Blood Pressure</label>
                                            <input type="text" name="blood_pressure" class="form-control"
                                                value="{{ old('blood_pressure', $patient->blood_pressure) }}" placeholder="120/80" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Temperature (°C)</label>
                                            <input type="text" name="temperature" class="form-control"
                                                value="{{ old('temperature', $patient->temperature) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Respiratory Rate</label>
                                            <input type="text" name="respiratory_rate" class="form-control"
                                                value="{{ old('respiratory_rate', $patient->respiratory_rate) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Oxygen Saturation (%)</label>
                                            <input type="text" name="oxygen_saturation" class="form-control"
                                                value="{{ old('oxygen_saturation', $patient->oxygen_saturation) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Height (cm)</label>
                                            <input type="text" name="height" class="form-control"
                                                value="{{ old('height', $patient->height) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Weight (kg)</label>
                                            <input type="text" name="weight" class="form-control"
                                                value="{{ old('weight', $patient->weight) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Waist Circumference (cm)</label>
                                            <input type="text" name="waist_circumference" class="form-control"
                                                value="{{ old('waist_circumference', $patient->waist_circumference) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                    </div>
                                </div>

                                @if($canEdit)
                                    <button type="submit" class="btn btn-primary px-5">
                                        <i class="bi bi-save me-2"></i>Save Vitals
                                    </button>
                                @endif
                            </form>
                        </div>

                        {{-- ==================================================
                             TAB 3: Emergency Contact
                             ================================================== --}}
                        <div class="tab-pane fade" id="tab-emergency">
                            <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $patient->id }}">

                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-4">Primary Care Provider / Emergency Contact</h3>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">First Name</label>
                                            <input type="text" name="p_f_name" class="form-control"
                                                value="{{ old('p_f_name', $patient->p_f_name) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Middle Name</label>
                                            <input type="text" name="p_m_name" class="form-control"
                                                value="{{ old('p_m_name', $patient->p_m_name) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Last Name</label>
                                            <input type="text" name="p_l_name" class="form-control"
                                                value="{{ old('p_l_name', $patient->p_l_name) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Phone</label>
                                            <input type="text" name="p_phone" class="form-control"
                                                value="{{ old('p_phone', $patient->p_phone) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Email</label>
                                            <input type="email" name="p_email" class="form-control"
                                                value="{{ old('p_email', $patient->p_email) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Address</label>
                                            <input type="text" name="p_home" class="form-control"
                                                value="{{ old('p_home', $patient->p_home) }}" {{ $canEdit ? '' : 'disabled' }}>
                                        </div>
                                    </div>
                                </div>

                                @if($canEdit)
                                    <button type="submit" class="btn btn-primary px-5">
                                        <i class="bi bi-save me-2"></i>Save Emergency Contact
                                    </button>
                                @endif
                            </form>
                        </div>

                        {{-- ==================================================
                             TAB 4: Lab Data
                             ================================================== --}}
                        <div class="tab-pane fade" id="tab-lab">
                            {{-- Existing lab records --}}
                            @if($labData->count())
                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-3">Existing Lab Records</h3>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Test Type</th>
                                                    <th>Timeline</th>
                                                    <th>Date of Studies</th>
                                                    <th>Files</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($labData as $lab)
                                                    <tr>
                                                        <td>{{ $lab->test_type ?? '—' }}</td>
                                                        <td>{{ $lab->timeline ?? '—' }}</td>
                                                        <td>{{ $lab->date_of_studies ?? '—' }}</td>
                                                        <td class="d-flex gap-2 justify-content-center">
                                                            @if($lab->file_test)
                                                                <a href="{{ asset('files/' . $lab->file_test) }}" target="_blank" class="btn btn-sm btn-outline-primary">Test File</a>
                                                            @endif
                                                            @if($lab->file_imaging)
                                                                <a href="{{ asset('files/' . $lab->file_imaging) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Imaging</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            @if($canEdit)
                                <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $patient->id }}">
                                    <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                        <h3 class="header-page mb-4">Add New Lab Record</h3>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Test Type</label>
                                                <input type="text" name="test_type" class="form-control" placeholder="e.g. Blood Test">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Timeline</label>
                                                <input type="text" name="timeline" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Date of Studies</label>
                                                <input type="date" name="date_of_studies" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Test File</label>
                                                <input type="file" name="file_test" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Imaging File</label>
                                                <input type="file" name="file_imaging" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-5"><i class="bi bi-save me-2"></i>Add Lab Record</button>
                                </form>
                            @endif
                        </div>

                        {{-- ==================================================
                             TAB 5: Medications
                             ================================================== --}}
                        <div class="tab-pane fade" id="tab-meds">
                            @if($medications->count())
                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-3">Existing Medications</h3>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Medication</th><th>Dosage</th><th>Frequency</th>
                                                    <th>Prescriber</th><th>Adverse Reactions</th><th>File</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($medications as $med)
                                                    <tr>
                                                        <td>{{ $med->medication }}</td>
                                                        <td>{{ $med->dosage ?? '—' }}</td>
                                                        <td>{{ $med->frequency ?? '—' }}</td>
                                                        <td>{{ $med->pres_provider ?? '—' }}</td>
                                                        <td>{{ $med->adverse_reactions ?? '—' }}</td>
                                                        <td>{{ $med->file_meds ? 'Yes' : '—' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            @if($canEdit)
                                <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $patient->id }}">
                                    <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                        <h3 class="header-page mb-4">Add Medication</h3>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Medication Name <span class="text-danger">*</span></label>
                                                <input type="text" name="medication" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Dosage</label>
                                                <input type="text" name="dosage" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Frequency</label>
                                                <input type="text" name="frequency" class="form-control" placeholder="e.g. Once daily">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Prescriber</label>
                                                <input type="text" name="pres_provider" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Adverse Reactions</label>
                                                <input type="text" name="adverse_reactions" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Prescription File</label>
                                                <input type="file" name="file_meds" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-5"><i class="bi bi-save me-2"></i>Add Medication</button>
                                </form>
                            @endif
                        </div>

                        {{-- ==================================================
                             TAB 6: Surgeries
                             ================================================== --}}
                        <div class="tab-pane fade" id="tab-surgery">
                            @if($surgeries->count())
                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-3">Surgical History</h3>
                                    @foreach($surgeries as $surg)
                                        <div class="border rounded p-3 mb-3">
                                            <div class="row g-2 text-2">
                                                <div class="col-md-6"><strong>Treatment:</strong> {{ $surg->current_treatment }}</div>
                                                <div class="col-md-6"><strong>Start Date:</strong> {{ $surg->start_date ?? '—' }}</div>
                                                <div class="col-md-6"><strong>Surgeon:</strong> {{ $surg->surgeon ?? '—' }}</div>
                                                <div class="col-md-6"><strong>Surgery Date:</strong> {{ $surg->surg_date ?? '—' }}</div>
                                                <div class="col-md-6"><strong>Outcomes:</strong> {{ $surg->outcomes ?? '—' }}</div>
                                                <div class="col-md-6"><strong>Recommendation:</strong> {{ $surg->recommendation ?? '—' }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if($canEdit)
                                <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $patient->id }}">
                                    <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                        <h3 class="header-page mb-4">Add Surgery Record</h3>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Current Treatment <span class="text-danger">*</span></label>
                                                <input type="text" name="current_treatment" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Start Date</label>
                                                <input type="date" name="start_date" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Duration</label>
                                                <input type="text" name="duration" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Surgery Date</label>
                                                <input type="date" name="surg_date" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Surgeon</label>
                                                <input type="text" name="surgeon" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Past Procedures</label>
                                                <textarea name="past_procedures" class="form-control" rows="2"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Outcomes</label>
                                                <textarea name="outcomes" class="form-control" rows="2"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Reason for Referral</label>
                                                <textarea name="reason_for_referral" class="form-control" rows="2"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Recommendation</label>
                                                <textarea name="recommendation" class="form-control" rows="2"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Surgery File</label>
                                                <input type="file" name="file_surgery" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-5"><i class="bi bi-save me-2"></i>Add Surgery Record</button>
                                </form>
                            @endif
                        </div>

                        {{-- ==================================================
                             TAB 7: Allergies
                             ================================================== --}}
                        <div class="tab-pane fade" id="tab-allergies">
                            @if($allergies->count())
                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-3">Allergy Records</h3>
                                    @foreach($allergies as $allergy)
                                        <div class="border rounded p-3 mb-3">
                                            <div class="row g-2 text-2">
                                                <div class="col-md-6"><strong>Drug:</strong> {{ $allergy->specific_drug ?? '—' }}</div>
                                                <div class="col-md-6"><strong>Food:</strong> {{ $allergy->specific_food ?? '—' }}</div>
                                                <div class="col-md-6"><strong>Reaction:</strong> {{ $allergy->reaction_details ?? '—' }}</div>
                                                <div class="col-md-6"><strong>Environment:</strong> {{ $allergy->infor_environment ?? '—' }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if($canEdit)
                                <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $patient->id }}">
                                    <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                        <h3 class="header-page mb-4">Add Allergy Record</h3>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Specific Drug</label>
                                                <input type="text" name="specific_drug" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Specific Food</label>
                                                <input type="text" name="specific_food" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Reaction Details</label>
                                                <textarea name="reaction_details" class="form-control" rows="2"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Environmental Info</label>
                                                <textarea name="infor_environment" class="form-control" rows="2"></textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Insurance Address</label>
                                                <input type="text" name="insur_address" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Insurance Policy</label>
                                                <input type="text" name="insur_policy" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Insurance Coverage</label>
                                                <input type="text" name="insur_coverage" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Billing Street</label>
                                                <input type="text" name="bill_street_name" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Billing Town</label>
                                                <input type="text" name="bill_town" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Billing Number</label>
                                                <input type="text" name="bill_number" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Preferred Payment</label>
                                                <input type="text" name="preferred_payment" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-5"><i class="bi bi-save me-2"></i>Add Allergy Record</button>
                                </form>
                            @endif
                        </div>

                        {{-- ==================================================
                             TAB 8: Consultation Notes
                             ================================================== --}}
                        <div class="tab-pane fade" id="tab-notes">
                            <div class="shadow-sm bg-white p-4 rounded">
                                <h3 class="header-page mb-4">Consultation Notes</h3>
                                <div class="d-flex flex-column gap-4 mb-4">
                                    @forelse($patient->usernotes ?? [] as $note)
                                        <div class="row">
                                            <div class="col-1"><div class="box-icon-purple">📝</div></div>
                                            <div class="col d-flex flex-column gap-1">
                                                <span class="text-4 text-muted">{{ $note->created_at->format('Y-m-d H:i') }}</span>
                                                <span class="text-2">{{ $note->note ?? '' }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">No notes yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- ==================================================
                             TAB 9: Files
                             ================================================== --}}
                        <div class="tab-pane fade" id="tab-files">
                            <div class="shadow-sm bg-white p-4 rounded">
                                <h3 class="header-page mb-4">Patient Files</h3>
                                <div class="d-flex flex-wrap gap-3 mb-3">
                                    @forelse($patient->files ?? [] as $file)
                                        <a href="{{ asset('storage/' . $file->file) }}" target="_blank" class="d-block">
                                            @if(\Illuminate\Support\Str::endsWith($file->file, ['.jpg', '.jpeg', '.png']))
                                                <img src="{{ asset('storage/' . $file->file) }}" width="70" height="70" class="img-thumbnail"/>
                                            @else
                                                <img src="{{ asset('assets/file.png') }}" width="70" height="70"/>
                                            @endif
                                        </a>
                                    @empty
                                        <p class="text-muted">No files uploaded yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div>{{-- end tab-content --}}
                </div>

            </div>
        </main>
    </div>
</div>