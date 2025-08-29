@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')
        <main class="col-md-10 px-4 py-0">
            <div class="row h-100">
                <!-- Sidebar Patient Info -->
                <div class="col-4 px-0 bg-white shadow-sm">
                    <div class="p-4">
                        <h2 class="header-page-1 mb-5">
                            <i class="bi bi-arrow-left-short"></i>
                            Patient Profile
                        </h2>

                        <div class="d-flex flex-column gap-1 align-items-center mb-3">
                            <img src="{{ asset('storage/'.$patient->prof_img) }}" alt="doctor" width="65" height="65"
                                class="rounded-circle img-thumbnail">
                            <span class="heading-3 fw-bold text-dark">{{$patient->f_name ?? ""}} Hi</span>
                            <div class="d-flex gap-1 text-3 text-head">
                                <span>{{$patient->age}} years old</span>
                                <span>|</span>
                                <span><i class="bi bi-geo-alt"></i> {{isset($patient->country)?$patient->country->name['ar']:""}}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills nav-profile w-100 px-1" id="v-pills-tab"
                            role="tablist" aria-orientation="vertical">
                            <button class="nav-link active text-start" id="v-pills-info-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-info" type="button" role="tab" aria-controls="v-pills-info"
                                aria-selected="true">General Information</button>

                            <button class="nav-link text-start" id="v-pills-history-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-history" type="button" role="tab"
                                aria-controls="v-pills-history" aria-selected="false">Medical History</button>

                            <button class="nav-link text-start" id="v-pills-notes-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-notes" type="button" role="tab"
                                aria-controls="v-pills-notes" aria-selected="false">Consultation Notes</button>

                            <button class="nav-link text-start" id="v-pills-files-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-files" type="button" role="tab"
                                aria-controls="v-pills-files" aria-selected="false">Files</button>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col p-4 h-100">
                    <div class="tab-content " id="v-pills-tabContent">

                        <!-- Tab Info -->
                        <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel"
                            aria-labelledby="v-pills-info-tab">

                            <div class="d-flex flex-column gap-3 overflow-auto" style="max-height: 85vh;">
                                <!-- Demographics -->
                                <div class="shadow-sm bg-white px-5 py-4 rounded">
                                    <h3 class="header-page mb-4">Demographics</h3>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="row">
                                            <span class="col text-2">Name</span>
                                            <span class="col text-2 text-dark">{{$patient->f_name ?? ""}}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col text-2">Gender</span>
                                            <span class="col text-2 text-dark">{{$patient->gender}}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col text-2">Date Of Birth</span>
                                            <span class="col text-2 text-dark">{{$patient->dob ?? 'N/A'}}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col text-2">Age</span>
                                            <span class="col text-2 text-dark">{{$patient->age ?? ''}}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Info -->
                                <div class="shadow-sm bg-white px-5 py-4 rounded">
                                    <h3 class="header-page mb-4">Contact Information</h3>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="row">
                                            <span class="col text-2">Email</span>
                                            <span class="col text-2 text-dark">{{$patient->email}}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col text-2">Phone</span>
                                            <span class="col text-2 text-dark">{{$patient->phone}}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col text-2">Address</span>
                                            <span class="col text-2 text-dark">{{$patient->address}}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Insurance -->
                                <div class="shadow-sm bg-white px-5 py-4 rounded">
                                    <h3 class="header-page mb-4">Insurance</h3>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="row">
                                            <span class="col text-2">Member Id</span>
                                            <span class="col text-2 text-dark">{{$patient->id}}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col text-2">Policy Holder</span>
                                            <span class="col text-2 text-dark">{{$patient->f_name}} {{$patient->l_name}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab Medical History -->
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

                        <!-- Tab Consultation Notes -->
                        <div class="tab-pane fade" id="v-pills-notes" role="tabpanel"
                            aria-labelledby="v-pills-notes-tab">
                            <div class="shadow-sm bg-white p-4 rounded">
                                <div class="d-flex flex-column gap-5 p-4">
                                    @foreach($patient->usernotes ?? [] as $note)
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="box-icon-purple">📝</div>
                                            </div>
                                            <div class="col d-flex flex-column gap-1">
                                                <span class="text-4">{{$note->created_at}}</span>
                                                <span class="text-2">{{$note->note ?? ""}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Add Note -->
                                    {{--  <form method="post" action="{{route('add_note')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex justify-content-between align-items-center bg-light py-2 px-3 rounded-2">
                                            <div class="w-50">
                                                <input type="text" name="note" class="form-control border-0 bg-transparent"
                                                    placeholder="Add a note">
                                            </div>
                                            <div>
                                                <button class="btn btn-purple text-white">Post</button>
                                            </div>
                                        </div>
                                    </form>  --}}
                                </div>
                            </div>
                        </div>

                        <!-- Tab Files -->
                        <div class="tab-pane fade" id="v-pills-files" role="tabpanel"
                            aria-labelledby="v-pills-files-tab">
                            <div class="shadow-sm bg-white p-4 rounded">
                                <div class="d-flex flex-wrap gap-3 mb-3">
                                    @forelse($patient->files ?? [] as $value)
                                        <a href="{{asset('storage/'.$value->file)}}" target="_blank">
                                            @if(Str::endsWith($value->file, ['.jpg','.jpeg','.png']))
                                                <img src="{{asset('storage/'.$value->file)}}" width="60" height="60" class="img-thumbnail"/>
                                            @else
                                                <img src="{{asset('assets/file.png')}}" width="60" height="60"/>
                                            @endif
                                        </a>
                                    @empty
                                        <p>No files uploaded yet.</p>
                                    @endforelse
                                </div>
                                <!-- Upload File -->
                                {{--  <form method="post" action="{{route('upload_file')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex justify-content-between align-items-center bg-light py-2 px-3 rounded-2">
                                        <div class="w-50">
                                            <input type="file" name="file" class="form-control border-0 bg-transparent">
                                        </div>
                                        <div>
                                            <button class="btn btn-purple text-white">Upload</button>
                                        </div>
                                    </div>
                                </form>  --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
