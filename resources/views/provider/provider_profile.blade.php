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
                <div class="col-lg-4 col-12 px-0 bg-white shadow-sm mb-lg-0 mb-4">
                    <div class="p-3 p-lg-4">
                        <h2 class="header-page-1 mb-3 mb-lg-5 fs-4 fs-lg-2">
                            <i class="bi bi-arrow-left-short"></i>
                            Doctor / Facility Profile
                        </h2>

                        <div class="d-flex flex-column gap-1 align-items-center mb-3 text-center text-lg-start px-2">
                            <span class="heading-3 fw-bold text-dark">{{ $user->legal_business_name ?? $user->email }}</span>
                            <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-1 text-3 text-head">
                                <span>{{ $user->healthcare_facility_type ?? 'Healthcare Provider' }}</span>
                                <span>|</span>
                                <span><i class="bi bi-geo-alt"></i>
                                    {{ isset($user->town) ? $user->town->getTranslation('name', $lang) : '' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-start overflow-auto">
                        <div class="nav flex-row flex-lg-column nav-pills nav-profile w-100 px-1 pb-2 pb-lg-0" id="v-pills-tab"
                            role="tablist" aria-orientation="horizontal">
                            <button class="nav-link active text-nowrap mb-lg-1 me-1 me-lg-0" id="v-pills-facility-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-facility" type="button" role="tab">Facility</button>

                            <button class="nav-link text-nowrap mb-lg-1 me-1 me-lg-0" id="v-pills-staffs-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-staffs" type="button" role="tab">Staffs</button>

                            <button class="nav-link text-nowrap mb-lg-1 me-1 me-lg-0" id="v-pills-licenses-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-licenses" type="button" role="tab">Licenses</button>

                            <button class="nav-link text-nowrap mb-lg-1 me-1 me-lg-0" id="v-pills-social-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-social" type="button" role="tab">Social</button>
                        </div>
                    </div>
                </div>

                {{-- ===== Tab Content ===== --}}
                <div class="col-lg-8 col-12 p-3 p-lg-4 h-100 overflow-auto" style="max-height: 100vh;">
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
                                            <input type="text" class="form-control bg-light" value="{{ $user->role }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Type</label>
                                            <input type="text" class="form-control bg-light" value="{{ $user->type }}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Services Offered</label>
                                            <textarea name="service_offered" class="form-control" rows="3">{{ old('service_offered', $user->service_offered) }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Specialization</label>
                                            <select name="specialization_id" class="form-select">
                                                <option value="">-- Select Specialization --</option>
                                                @foreach($specialties as $specialty)
                                                    <option value="{{ $specialty->id }}" 
                                                        {{ old('specialization_id', $user->specialization_id) == $specialty->id ? 'selected' : '' }}>
                                                        {{ $specialty->getTranslation('title', $lang) }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                            <label class="form-label fw-semibold">Profile Photo</label>
                                            <div class="d-flex align-items-center gap-3 border rounded p-2">
                                                @if($user->prof_img)
                                                    <img src="{{ asset('storage/' . $user->prof_img) }}" alt="Current Photo" width="40" height="40" class="rounded-circle border">
                                                @endif
                                                <input type="file" name="prof_img" class="form-control" accept=".jpg,.jpeg,.png">
                                            </div>
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
                                                    <div class="col-md-11 lg-6">
                                                        <label class="form-label fw-semibold">Specialization</label>
                                                        <select name="medical_staffs[{{ $index }}][specialization]" class="form-select">
                                                            <option value="">-- Select Specialization --</option>
                                                            @foreach($specialties as $specialty)
                                                                <option value="{{ $specialty->id }}" 
                                                                    {{ old("medical_staffs.{$index}.specialization", $staff->specialization) == $specialty->id ? 'selected' : '' }}>
                                                                    {{ $specialty->getTranslation('title', $lang) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
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
                                                        <div class="position-relative">
                                                            <a href="{{ asset('storage/' . $license->file) }}" target="_blank">
                                                                @if(Str::endsWith($license->file, ['.jpg','.jpeg','.png']))
                                                                    <img src="{{ asset('storage/' . $license->file) }}" width="70" height="70" class="img-thumbnail"/>
                                                                @else
                                                                    <div class="d-flex align-items-center gap-1 border rounded p-2 bg-light">
                                                                        <i class="bi bi-file-earmark-text fs-3"></i>
                                                                        <small class="text-truncate" style="max-width: 100px;">{{ basename($license->file) }}</small>
                                                                    </div>
                                                                @endif
                                                            </a>
                                                            <a href="{{ route('delete_license', $license->id) }}" 
                                                               class="btn btn-danger btn-sm p-0 position-absolute top-0 start-100 translate-middle rounded-circle"
                                                               style="width: 20px; height: 20px; line-height: 18px;"
                                                               onclick="return confirm('هل أنت متأكد من حذف هذا الملف؟')">
                                                                <i class="bi bi-x small"></i>
                                                            </a>
                                                        </div>
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

@push('script')
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
                        <select name="medical_staffs[${idx}][specialization]" class="form-select">
                            <option value="">-- Select Specialization --</option>
                            @foreach($specialties as $specialty)
                                <option value="{{ $specialty->id }}">
                                    {{ $specialty->getTranslation('title', $lang) }}
                                </option>
                            @endforeach
                        </select>
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