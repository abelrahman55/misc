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
                <h1 class="header-page text-muted mb-4">Patient Management</h1>
                <div class="row">
                    <div class="col pe-4">
                        <!-- Tabs -->
                        <nav class="mb-4 mx-1">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-patients-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-patients" type="button" role="tab" aria-controls="nav-patients"
                                    aria-selected="true">Patients</button>
                                <button class="nav-link" id="nav-appoinments-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-appoinments" type="button" role="tab"
                                    aria-controls="nav-appoinments" aria-selected="false">Appointments</button>
                                <button class="nav-link" id="nav-payments-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-payments" type="button" role="tab"
                                    aria-controls="nav-payments" aria-selected="false">Payments</button>
                            </div>
                        </nav>
                        <!-- Tap Contents -->
                        <div class="card border-0 p-4 rounded-4">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-patients" role="tabpanel"
                                    aria-labelledby="nav-patients-tab">
                                    <table class="table table-borderless transaction-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">User</th>
                                                <th scope="col">Email Address</th>
                                                <th scope="col">Member Since</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--  -->

                                            @foreach ($patients as $patient)
                                                <tr>
                                                <td class="d-flex gap-2 align-items-center">
                                                    <img src="{{ asset($patient->prof_img)}}" alt="user pic" width="40px"
                                                        height="40px">
                                                    <span class="fw-semibold text-dark">{{ $patient->f_name}}</span>
                                                </td>
                                                <td>{{ $patient->email }}</td>
                                                <td class="text-muted">{{ $patient->created_at }}</td>
                                                <td class="text-muted">{{ $patient->active==1?'active':'disactive' }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('patient_profile',['id'=>$patient->id]) }}" class="btn btn-purple text-white rounded-3 btn-sm">See
                                                            Profile</a>
                                                        <a
                                                            href="{{ route('change_active',['id'=>$patient->id]) }}"
                                                            class="btn {{ $patient->active==1?"btn-danger":"btn-success" }} rounded-3 btn-sm">
                                                        {{ $patient->active==1?'Deactivate':'active' }}
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="nav-appoinments" role="tabpanel"
                                    aria-labelledby="nav-appoinments-tab">
                                    <table class="table table-borderless table-hover transaction-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Time</th>
                                                <th scope="col">Patient</th>
                                                <th scope="col">Specialty</th>
                                                <th scope="col">Technician</th>
                                                <th scope="col">Location</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>7:00 - 7:10</td>
                                                <td>Braha Marlam Roh</td>
                                                <td>Cardiology</td>
                                                <td>Valeria</td>
                                                <td>Hagana 16, Tel Aviv</td>
                                                <td>Visited</td>
                                                <td>
                                                    <button type="button" class="btn bi bi-three-dots text-dark"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Reschedule</a></li>
                                                        <li><a class="dropdown-item" href="#">Approve</a></li>
                                                        <li><a class="dropdown-item" href="#">Cancel</a>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-payments" role="tabpanel"
                                    aria-labelledby="nav-payments-tab">
                                    <table class="table table-borderless table-hover transaction-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Patient</th>
                                                <th scope="col">Provider</th>
                                                <th scope="col">Value</th>
                                                <th scope="col">Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Braha Marlam Roh</td>
                                                <td>Valeria</td>
                                                <td>1612$</td>
                                                <td>Visited</td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </main>
    </div>
</div>
