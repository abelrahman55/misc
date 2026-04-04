@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    @if(session('success'))
    <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session('error'))
    <div id="errorMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        @include('dashboard.layouts.sidebar')
        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page text-muted mb-4">Doctor Management</h1>
            <div class="row">
                <div class="col pe-4">
                    <!-- Tabs -->
                    <nav class="mb-4 mx-1">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-doctors-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-doctors" type="button" role="tab" aria-controls="nav-doctors"
                                aria-selected="true">Doctors</button>
                        </div>
                    </nav>
                    <!-- Tab Contents -->
                    <div class="card border-0 p-4 rounded-4 shadow-sm">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-doctors" role="tabpanel"
                                aria-labelledby="nav-doctors-tab">
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">Doctor</th>
                                                <th scope="col">Email Address</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Member Since</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($doctors as $doctor)
                                            <tr>
                                                <td class="d-flex gap-2 align-items-center">
                                                    <img src="{{ $doctor->prof_img ? asset('storage/' . $doctor->prof_img) : asset('assets/images/user.png') }}" 
                                                         alt="doctor pic" width="40px" height="40px" class="rounded-circle border">
                                                    <div>
                                                        <span class="fw-semibold text-dark d-block text-capitalize">{{ $doctor->f_name }} {{ $doctor->l_name }}</span>
                                                        <small class="text-muted">{{ $doctor->specialty ?? 'No Specialty' }}</small>
                                                    </div>
                                                </td>
                                                <td>{{ $doctor->email }}</td>
                                                <td>{{ $doctor->phone ?? 'N/A' }}</td>
                                                <td class="text-muted">{{ $doctor->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <span class="badge {{ $doctor->active == 1 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-3 py-2 rounded-pill">
                                                        {{ $doctor->active == 1 ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('patient_profile', ['id' => $doctor->id]) }}" class="btn btn-purple text-white rounded-3 btn-sm shadow-sm">
                                                            View Info
                                                        </a>
                                                        <a href="{{ route('change_active', ['id' => $doctor->id]) }}"
                                                            class="btn {{ $doctor->active == 1 ? 'btn-outline-danger' : 'btn-outline-success' }} rounded-3 btn-sm shadow-sm">
                                                            {{ $doctor->active == 1 ? 'Deactivate' : 'Activate' }}
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4">
                                    {{ $doctors->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
