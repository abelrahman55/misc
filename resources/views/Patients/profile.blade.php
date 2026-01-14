@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')
        <main class="col-md-10 px-4 py-0">
            <div class="row h-100">

                <div class="col-4 px-0 bg-white shadow-sm">
                    <div class="p-4">
                        <h2 class="header-page-1 mb-5">
                            <i class="bi bi-arrow-left-short"></i>
                            Patient Profile
                        </h2>

                        <div class="d-flex flex-column gap-1 align-items-center mb-3">
                            <img src="{{ asset('storage/' . $patient->prof_img) }}" alt="patient" width="65"
                                height="65" class="rounded-circle img-thumbnail">
                            <span class="heading-3 fw-bold text-dark">{{ $patient->f_name ?? '' }} Hi</span>
                            <div class="d-flex gap-1 text-3 text-head">
                                <span>{{ $patient->age }} years old</span>
                                <span>|</span>
                                <span><i class="bi bi-geo-alt"></i>
                                    {{ isset($patient->country) ? $patient->country->getTranslation('name', app()->getLocale()) : '' }}</span>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills nav-profile w-100 px-1" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link active text-start" id="v-pills-info-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-info" type="button" role="tab"
                                aria-controls="v-pills-info" aria-selected="true">General Information</button>

                            {{--  <button class="nav-link text-start" id="v-pills-history-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-history" type="button" role="tab"
                                aria-controls="v-pills-history" aria-selected="false">Medical History</button>  --}}

                            <button class="nav-link text-start" id="v-pills-notes-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-notes" type="button" role="tab"
                                aria-controls="v-pills-notes" aria-selected="false">Consultation Notes</button>

                            <button class="nav-link text-start" id="v-pills-files-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-files" type="button" role="tab"
                                aria-controls="v-pills-files" aria-selected="false">Files</button>
                        </div>
                    </div>
                </div>


                <div class="col p-4 h-100">
                    <div class="tab-content" id="v-pills-tabContent">


                        <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel"
                            aria-labelledby="v-pills-info-tab">

                            <div class="d-flex flex-column gap-3 overflow-auto" style="max-height: 85vh;">

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('update_profile') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $patient->id }}"
                                        {{ auth()->guard('web')->user()?->role == $patient?->role ? '' : 'disabled' }}>


                                    <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                        <h3 class="header-page mb-4">Demographics</h3>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="row">
                                                <label class="col text-2 fw-bold" for="f_name">First Name</label>
                                                <input type="text" name="f_name" id="f_name"
                                                    class="form-control col"
                                                    value="{{ old('f_name', $patient->f_name) }}" required
                                                    {{ auth()->guard('web')->user()?->role == $patient?->role ? '' : 'disabled' }}>
                                            </div>
                                            <div class="row">
                                                <label class="col text-2 fw-bold" for="l_name">Last Name</label>
                                                <input type="text" name="l_name" id="l_name"
                                                    class="form-control col"
                                                    value="{{ old('l_name', $patient->l_name) }}"
                                                    {{ auth()->guard('web')->user()?->role == $patient?->role ? '' : 'disabled' }}>
                                            </div>
                                            <div class="row">
                                                <label class="col text-2 fw-bold" for="gender">Gender</label>
                                                <select
                                                    {{ auth()->guard('web')->user()?->role == $patient?->role ? '' : 'disabled' }}
                                                    name="gender" id="gender" class="form-select col">
                                                    <option value="male"
                                                        {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="female"
                                                        {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>
                                                        Female</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <label class="col text-2 fw-bold" for="dob">Date Of Birth</label>
                                                <input type="date" name="dob" id="dob"
                                                    class="form-control col" value="{{ old('dob', $patient->dob) }}"
                                                    {{ auth()->guard('web')->user()?->role == $patient?->role ? '' : 'disabled' }}>
                                            </div>
                                            <div class="row">
                                                <label class="col text-2 fw-bold">Age</label>
                                                <span class="col text-2 text-dark">{{ $patient->age ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                        <h3 class="header-page mb-4">Contact Information</h3>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="row">
                                                <label class="col text-2 fw-bold" for="email">Email</label>
                                                <input type="email" name="email" id="email"
                                                    class="form-control col"
                                                    value="{{ old('email', $patient->email) }}" required
                                                    {{ auth()->guard('web')->user()?->role == $patient?->role ? '' : 'disabled' }}>

                                            </div>
                                            <div class="row">
                                                <label class="col text-2 fw-bold" for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone"
                                                    class="form-control col"
                                                    value="{{ old('phone', $patient->phone) }}"
                                                    {{ auth()->guard('web')->user()?->role == $patient?->role ? '' : 'disabled' }}>
                                            </div>
                                            <div class="row">
                                                <label class="col text-2 fw-bold" for="address">Address</label>
                                                <input type="text" name="address" id="address"
                                                    class="form-control col"
                                                    value="{{ old('address', $patient->address) }}"
                                                    {{ auth()->guard('web')->user()?->role == $patient?->role ? '' : 'disabled' }}>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                        <h3 class="header-page mb-4">Insurance</h3>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="row">
                                                <label class="col text-2 fw-bold">Member Id</label>
                                                <span class="col text-2 text-dark">{{ $patient->id }}</span>
                                            </div>
                                            <div class="row">
                                                <label class="col text-2 fw-bold">Policy Holder</label>
                                                <span class="col text-2 text-dark">{{ $patient->f_name }}
                                                    {{ $patient->l_name }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    @if (auth()?->guard('web')?->user()?->role == 'patinet')
                                        <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                            <h3 class="header-page mb-4">Update Profile Image</h3>
                                            <input type="file" name="prof_img" accept="image/*"
                                                class="form-control">
                                        </div>


                                        <div class="shadow-sm bg-white px-5 py-4 rounded mb-4">
                                            <h3 class="header-page mb-4">Upload Additional File</h3>
                                            <input type="file" name="file"
                                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" class="form-control">
                                        </div>
                                    @endif

                                    @if($patient->id == auth()->guard('web')->user()->id)
                                    <button type="submit" class="btn btn-primary">Save Updates</button>
                                    @endif
                                </form>

                            </div>
                        </div>


                        <div class="tab-pane fade" id="v-pills-history" role="tabpanel"
                            aria-labelledby="v-pills-history-tab">
                            <div class="shadow-sm bg-white p-4 rounded">
                                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-summary-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-summary" type="button" role="tab"
                                        aria-controls="nav-summary" aria-selected="true">Summary</button>
                                    <button class="nav-link" id="nav-conditions-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-conditions" type="button" role="tab"
                                        aria-controls="nav-conditions" aria-selected="false">Conditions</button>
                                    <button class="nav-link" id="nav-notes-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-notes" type="button" role="tab"
                                        aria-controls="nav-notes" aria-selected="false">Notes</button>
                                </div>

                                <div class="tab-content p-2" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-summary" role="tabpanel"
                                        aria-labelledby="nav-summary-tab">
                                        James is a 32-year-old male with no known allergies or drug
                                        sensitivities. He has a history of seasonal allergies and occasional
                                        migraines. He takes no medications regularly.
                                    </div>
                                    <div class="tab-pane fade" id="nav-conditions" role="tabpanel"
                                        aria-labelledby="nav-conditions-tab">
                                        James is a 32-year-old male with no known allergies or drug
                                        sensitivities. He has a history of seasonal allergies and occasional
                                        migraines. He takes no medications regularly.
                                    </div>
                                    <div class="tab-pane fade" id="nav-notes" role="tabpanel"
                                        aria-labelledby="nav-notes-tab">
                                        James is a 32-year-old male with no known allergies or drug
                                        sensitivities. He has a history of seasonal allergies and occasional
                                        migraines. He takes no medications regularly.
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="v-pills-notes" role="tabpanel"
                            aria-labelledby="v-pills-notes-tab">
                            <div class="shadow-sm bg-white p-4 rounded">
                                <div class="d-flex flex-column gap-5 p-4">
                                    @foreach ($patient->usernotes ?? [] as $note)
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="box-icon-purple">📝</div>
                                            </div>
                                            <div class="col d-flex flex-column gap-1">
                                                <span class="text-4">{{ $note->created_at }}</span>
                                                <span class="text-2">{{ $note->note ?? '' }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="v-pills-files" role="tabpanel"
                            aria-labelledby="v-pills-files-tab">
                            <div class="shadow-sm bg-white p-4 rounded">
                                <div class="d-flex flex-wrap gap-3 mb-3">
                                    @forelse($patient->files ?? [] as $file)
                                        <a href="{{ asset('storage/' . $file->file) }}" target="_blank"
                                            class="d-block">
                                            @if (\Illuminate\Support\Str::endsWith($file->file, ['.jpg', '.jpeg', '.png']))
                                                <img src="{{ asset('storage/' . $file->file) }}" width="60"
                                                    height="60" class="img-thumbnail" />
                                            @else
                                                <img src="{{ asset('assets/file.png') }}" width="60"
                                                    height="60" alt="file icon" />
                                            @endif
                                        </a>
                                    @empty
                                        <p>No files uploaded yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
