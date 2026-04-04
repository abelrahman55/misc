@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

@php
use Illuminate\Support\Str;
$lang = app()->getLocale();
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
                            <i class="bi bi-arrow-left-short"></i>
                            Doctor / Facility Profile
                        </h2>

                        <div class="d-flex flex-column gap-1 align-items-center mb-3">
                            <span class="heading-3 fw-bold text-dark">{{ $user->legal_business_name ?? $user->email }}</span>
                            <div class="d-flex gap-1 text-3 text-head">
                                <span>{{ $user->healthcare_facility_type ?? 'Healthcare Provider' }}</span>
                                <span>|</span>
                                <span><i class="bi bi-geo-alt"></i>
                                    {{ isset($user->town) ? $user->town->getTranslation('name', $lang) : '' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills nav-profile w-100 px-1" id="v-pills-tab"
                            role="tablist" aria-orientation="vertical">
                            <button class="nav-link active text-start" id="v-pills-facility-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-facility" type="button" role="tab">Healthcare Facility</button>

                            <button class="nav-link text-start" id="v-pills-staffs-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-staffs" type="button" role="tab">Medical Staffs</button>

                            <button class="nav-link text-start" id="v-pills-licenses-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-licenses" type="button" role="tab">Licenses</button>

                            <button class="nav-link text-start" id="v-pills-social-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-social" type="button" role="tab">Social & Links</button>
                        </div>
                    </div>
                </div>

                {{-- ===== Tab Content ===== --}}
                <div class="col p-4 h-100 overflow-auto" style="max-height: 100vh;">
                    <div class="tab-content" id="v-pills-tabContent">

                        {{-- Flash Messages --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Facility Tab --}}
                        <div class="tab-pane fade show active" id="v-pills-facility" role="tabpanel">
                            <form action="{{ route('update_profile_provider') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-4">Healthcare Facility Information</h3>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Legal Business Name</label>
                                            <input type="text" name="legal_business_name" class="form-control"
                                                value="{{ old('legal_business_name', $user->legal_business_name) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Facility Type</label>
                                            <input type="text" name="healthcare_facility_type" class="form-control"
                                                value="{{ old('healthcare_facility_type', $user->healthcare_facility_type) }}"
                                                placeholder="e.g. Clinic, Hospital, Lab">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Town / City</label>
                                            <select name="town_id" class="form-select">
                                                <option value="">-- Select Town --</option>
                                                @foreach($towns as $town)
                                                    <option value="{{ $town->id }}"
                                                        {{ old('town_id', $user->town_id) == $town->id ? 'selected' : '' }}>
                                                        {{ $town->getTranslation('name', $lang) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Main Point of Contact</label>
                                            <input type="text" name="main_point_contact" class="form-control"
                                                value="{{ old('main_point_contact', $user->main_point_contact) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Website</label>
                                            <input type="text" name="website" class="form-control"
                                                value="{{ old('website', $user->website) }}" placeholder="https://...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">User Role</label>
                                            <input type="text" name="role" class="form-control"
                                                value="{{ old('role', $user->role) }}" placeholder="doctor/hospital etc..">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Type</label>
                                            <input type="text" name="type" class="form-control"
                                                value="{{ old('type', $user->type) }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Services Offered</label>
                                            <textarea name="service_offered" class="form-control" rows="3">{{ old('service_offered', $user->service_offered) }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Specialization</label>
                                            <textarea name="specialization" class="form-control" rows="2">{{ old('specialization', $user->specialization) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Pricing Information</label>
                                            <textarea name="pricing_information" class="form-control" rows="2">{{ old('pricing_information', $user->pricing_information) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Technology Used</label>
                                            <textarea name="technology" class="form-control" rows="2">{{ old('technology', $user->technology) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Quality Standards</label>
                                            <textarea name="quality" class="form-control" rows="2">{{ old('quality', $user->quality) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Preferred Partnership</label>
                                            <textarea name="preferred_partnership" class="form-control" rows="2">{{ old('preferred_partnership', $user->preferred_partnership) }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Blog / Content</label>
                                            <textarea name="content_blog" class="form-control" rows="3">{{ old('content_blog', $user->content_blog) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-purple text-white px-5">
                                    <i class="bi bi-save me-2"></i>Save Facility Info
                                </button>
                            </form>
                        </div>

                        {{-- Medical Staffs Tab --}}
                        <div class="tab-pane fade" id="v-pills-staffs" role="tabpanel">
                            <form action="{{ route('update_profile_provider') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h3 class="header-page mb-0">Medical Staff Members</h3>
                                        <button type="button" class="btn btn-sm btn-outline-purple" id="addStaffBtn">
                                            <i class="bi bi-plus-lg me-1"></i>Add Staff
                                        </button>
                                    </div>
                                    <p class="text-muted small mb-3">Note: Saving will replace all existing staff entries.</p>

                                    <div id="staffContainer">
                                        @forelse($user->medicalStaffs ?? [] as $index => $staff)
                                            <div class="staff-row border rounded p-3 mb-3 position-relative">
                                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-staff">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="medical_staffs[{{ $index }}][name]" class="form-control"
                                                            value="{{ $staff->name }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Qualification</label>
                                                        <input type="text" name="medical_staffs[{{ $index }}][qualification]" class="form-control"
                                                            value="{{ $staff->qualification }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Experience Years</label>
                                                        <input type="text" name="medical_staffs[{{ $index }}][experience_years]" class="form-control"
                                                            value="{{ $staff->experience_years }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Specialization</label>
                                                        <input type="text" name="medical_staffs[{{ $index }}][specialization]" class="form-control"
                                                            value="{{ $staff->specialization }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted" id="noStaffMsg">No staff members added yet. Click "Add Staff" to begin.</p>
                                        @endforelse
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-purple text-white px-5">
                                    <i class="bi bi-save me-2"></i>Save Staff Members
                                </button>
                            </form>
                        </div>

                        {{-- Licenses Tab --}}
                        <div class="tab-pane fade" id="v-pills-licenses" role="tabpanel">
                            <form action="{{ route('update_profile_provider') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-4">Licenses & Certifications</h3>

                                    @php
                                        $licenseGroups = $user->licenses ? $user->licenses->groupBy('type') : collect();
                                    @endphp

                                    @if($licenseGroups->count())
                                        <h5 class="mb-3">Existing Licenses</h5>
                                        @foreach($licenseGroups as $type => $licenses)
                                            <div class="mb-3">
                                                <span class="badge bg-secondary mb-2">{{ ucfirst($type) }}</span>
                                                <div class="d-flex flex-wrap gap-3">
                                                    @foreach($licenses as $license)
                                                        <a href="{{ asset('storage/' . $license->file) }}" target="_blank">
                                                            @if(Str::endsWith($license->file, ['.jpg','.jpeg','.png']))
                                                                <img src="{{ asset('storage/' . $license->file) }}" width="70" height="70" class="img-thumbnail"/>
                                                            @else
                                                                <div class="d-flex align-items-center gap-1 border rounded p-2">
                                                                    <i class="bi bi-file-earmark-text fs-3"></i>
                                                                    <small>{{ basename($license->file) }}</small>
                                                                </div>
                                                            @endif
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                        <hr>
                                    @endif

                                    <h5 class="mb-3">Upload New Licenses</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Operating License</label>
                                            <input type="file" name="licenses[operating][]" class="form-control"
                                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" multiple>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Accreditation</label>
                                            <input type="file" name="licenses[accreditation][]" class="form-control"
                                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" multiple>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Professional License</label>
                                            <input type="file" name="licenses[professional][]" class="form-control"
                                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" multiple>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Testimonials</label>
                                            <input type="file" name="licenses[testimonials][]" class="form-control"
                                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" multiple>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Profile Photo</label>
                                            <input type="file" name="licenses[prof_photo][]" class="form-control"
                                                accept=".jpg,.jpeg,.png" multiple>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Other Certificates</label>
                                            <input type="file" name="licenses[other_certs][]" class="form-control"
                                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" multiple>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Facility Images</label>
                                            <input type="file" name="licenses[facility][]" class="form-control"
                                                accept=".jpg,.jpeg,.png,.pdf" multiple>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Promotional Content</label>
                                            <input type="file" name="licenses[prom_content][]" class="form-control"
                                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" multiple>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Virtual Tour Video</label>
                                            <input type="file" name="licenses[virtual_tour_video][]" class="form-control"
                                                accept=".mp4,.mov,.avi" multiple>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Patient Success Stories</label>
                                            <input type="file" name="licenses[patient_success][]" class="form-control"
                                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" multiple>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-purple text-white px-5">
                                    <i class="bi bi-save me-2"></i>Upload Licenses
                                </button>
                            </form>
                        </div>

                        {{-- Social Tab --}}
                        <div class="tab-pane fade" id="v-pills-social" role="tabpanel">
                            <form action="{{ route('update_profile_provider') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                    <h3 class="header-page mb-4">Social Media & Links</h3>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold"><i class="bi bi-facebook me-2 text-primary"></i>Facebook</label>
                                            <input type="text" name="facebook_link" class="form-control"
                                                value="{{ old('facebook_link', $user->facebook_link) }}" placeholder="https://facebook.com/...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold"><i class="bi bi-twitter-x me-2"></i>Twitter / X</label>
                                            <input type="text" name="twitter_link" class="form-control"
                                                value="{{ old('twitter_link', $user->twitter_link) }}" placeholder="https://twitter.com/...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold"><i class="bi bi-linkedin me-2 text-primary"></i>LinkedIn</label>
                                            <input type="text" name="linkedin_link" class="form-control"
                                                value="{{ old('linkedin_link', $user->linkedin_link) }}" placeholder="https://linkedin.com/...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold"><i class="bi bi-tiktok me-2"></i>TikTok</label>
                                            <input type="text" name="tiktok_link" class="form-control"
                                                value="{{ old('tiktok_link', $user->tiktok_link) }}" placeholder="https://tiktok.com/...">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-purple text-white px-5">
                                    <i class="bi bi-save me-2"></i>Save Social Links
                                </button>
                            </form>
                        </div>

                    </div>{{-- end tab-content --}}
                </div>
            </div>
        </main>
    </div>
</div>

@push('scripts')
<script>
    // ===== Dynamic Medical Staff Rows =====
    let staffIndex = {{ ($user->medicalStaffs ? $user->medicalStaffs->count() : 0) }};

    document.getElementById('addStaffBtn')?.addEventListener('click', function () {
        const noMsg = document.getElementById('noStaffMsg');
        if (noMsg) noMsg.remove();

        const container = document.getElementById('staffContainer');
        const idx = staffIndex++;

        const html = `
            <div class="staff-row border rounded p-3 mb-3 position-relative">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-staff">
                    <i class="bi bi-trash"></i>
                </button>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="medical_staffs[${idx}][name]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Qualification</label>
                        <input type="text" name="medical_staffs[${idx}][qualification]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Experience Years</label>
                        <input type="text" name="medical_staffs[${idx}][experience_years]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Specialization</label>
                        <input type="text" name="medical_staffs[${idx}][specialization]" class="form-control">
                    </div>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-staff')) {
            e.target.closest('.staff-row').remove();
        }
    });
</script>
@endpush