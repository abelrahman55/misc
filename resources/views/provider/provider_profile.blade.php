@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

@php
use Illuminate\Support\Str;
@endphp

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')
        <main class="col-md-10 px-4 py-0">
            <div class="row h-100">


                <div class="col-4 px-0 bg-white shadow-sm">
                    <div class="p-4">
                        <h2 class="header-page-1 mb-5">
                            <i class="bi bi-arrow-left-short"></i>
                             Profile
                        </h2>

                        <div class="d-flex flex-column gap-1 align-items-center mb-3">
                            <img src="{{ asset($user->prof_img) }}" alt="doctor" width="65" height="65"
                                class="rounded-circle img-thumbnail">
                            <span class="heading-3 fw-bold text-dark">{{$user->f_name ?? ""}}</span>
                            <div class="d-flex gap-1 text-3 text-head">
                                <span>{{$user->age}} years old</span>
                                <span>|</span>
                                <span><i class="bi bi-geo-alt"></i> {{isset($user->country)?$user->country->getTranslation('name', app()->getLocale()):""}}</span>
                            </div>
                        </div>
                    </div>


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


                <div class="col p-4 h-100">
                    <div class="tab-content" id="v-pills-tabContent">


                        <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel"
                            aria-labelledby="v-pills-info-tab">

                            <div class="d-flex flex-column gap-3 overflow-auto" style="max-height: 85vh;">

                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
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

                                <form action="{{ route('update_profile_provider') }}" method="post" enctype="multipart/form-data">
                                    @csrf


                                    <div class="mb-3">
                                        <label for="f_name" class="form-label">First Name</label>
                                        <input type="text" id="f_name" name="f_name" class="form-control" value="{{ old('f_name', $user->f_name) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="l_name" class="form-label">Last Name</label>
                                        <input type="text" id="l_name" name="l_name" class="form-control" value="{{ old('l_name', $user->l_name) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select id="gender" name="gender" class="form-select">
                                            <option value="male" {{ (old('gender', $user->gender) == 'male') ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ (old('gender', $user->gender) == 'female') ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" id="dob" name="dob" class="form-control" value="{{ old('dob', $user->dob) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="prof_img" class="form-label">Profile Image</label>
                                        <input type="file" id="prof_img" name="prof_img" class="form-control" accept="image/*">
                                    </div>


                                    <div class="mb-3">
                                        <label for="file" class="form-label">Upload New File</label>
                                        <input type="file" id="file" name="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                    </div>

                                    <button type="submit" class="btn btn-purple text-white">Save Updates</button>
                                </form>

                            </div>
                        </div>

                        <!-- Tab Medical History -->
                        <div class="tab-pane fade" id="v-pills-history" role="tabpanel" aria-labelledby="v-pills-history-tab">
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


                        <div class="tab-pane fade" id="v-pills-notes" role="tabpanel" aria-labelledby="v-pills-notes-tab">
                            <div class="shadow-sm bg-white p-4 rounded">
                                <div class="d-flex flex-column gap-5 p-4">
                                    @foreach($user->usernotes ?? [] as $note)
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

                                    <form method="post" action="{{route('add_note')}}" enctype="multipart/form-data">
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
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="v-pills-files" role="tabpanel" aria-labelledby="v-pills-files-tab">
                            <div class="shadow-sm bg-white p-4 rounded">

                                <div class="d-flex flex-wrap gap-3 mb-3">
                                    @forelse($user->files ?? [] as $file)
                                        <div class="position-relative">
                                            <a href="{{ asset('storage/' . $file->file) }}" target="_blank">
                                                @if (Str::endsWith($file->file, ['.jpg','.jpeg','.png']))
                                                    <img src="{{ asset('storage/' . $file->file) }}" width="60" height="60" class="img-thumbnail" />
                                                @else
                                                    <img src="{{ asset('assets/file.png') }}" width="60" height="60" />
                                                @endif
                                            </a>


                                            {{--  <form action="{{ route('delete_file', $file->id) }}" method="POST"
                                                style="position:absolute; top:0; right:0;"
                                                onsubmit="return confirm('هل أنت متأكد من حذف الملف؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">×</button>
                                            </form>  --}}
                                        </div>
                                    @empty
                                        <p>No files uploaded yet.</p>
                                    @endforelse
                                </div>


                                <form method="post" action="{{ route('update_profile_provider') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex justify-content-between align-items-center bg-light py-2 px-3 rounded-2">
                                        <div class="w-50">
                                            <input type="file" name="file" class="form-control border-0 bg-transparent" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                        </div>
                                        <div>
                                            <button class="btn btn-purple text-white">Upload New File</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
