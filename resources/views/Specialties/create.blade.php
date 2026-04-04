@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('dashboard.layouts.sidebar')

        <!-- Main Content -->
        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page mb-4">Add New Specialty</h1>
            <div class="row">
                <div class="col px-3">
                    <div class="card p-4">
                        <div class="card-body">
                            <form action="{{ route('specialties.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Tabs for languages -->
                                <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
                                    <li class="nav-item"><button class="nav-link active" id="ar-tab"
                                            data-bs-toggle="tab" data-bs-target="#lang-ar"
                                            type="button">العربية</button></li>
                                    <li class="nav-item"><button class="nav-link" id="en-tab" data-bs-toggle="tab"
                                            data-bs-target="#lang-en" type="button">English</button></li>
                                    <li class="nav-item"><button class="nav-link" id="fr-tab" data-bs-toggle="tab"
                                            data-bs-target="#lang-fr" type="button">Français</button></li>
                                    <li class="nav-item"><button class="nav-link" id="gr-tab" data-bs-toggle="tab"
                                            data-bs-target="#lang-gr" type="button">Deutsch</button></li>
                                </ul>

                                <div class="tab-content" id="langTabsContent">
                                    <!-- Arabic -->
                                    <div class="tab-pane fade show active" id="lang-ar" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title (Arabic)</label>
                                            <input type="text" name="title[ar]" class="form-control"
                                                value="{{ old('title.ar') }}" placeholder="أدخل اسم التخصص" required>
                                            @error('title.ar')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- English -->
                                    <div class="tab-pane fade" id="lang-en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title (English)</label>
                                            <input type="text" name="title[en]" class="form-control"
                                                value="{{ old('title.en') }}" placeholder="Enter specialty name" required>
                                            @error('title.en')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- French -->
                                    <div class="tab-pane fade" id="lang-fr" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title (French)</label>
                                            <input type="text" name="title[fr]" class="form-control"
                                                value="{{ old('title.fr') }}" placeholder="Entrez le nom de la spécialité">
                                            @error('title.fr')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- German -->
                                    <div class="tab-pane fade" id="lang-gr" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title (German)</label>
                                            <input type="text" name="title[gr]" class="form-control"
                                                value="{{ old('title.gr') }}" placeholder="Geben Sie den Fachgebietsnamen ein">
                                            @error('title.gr')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-purple text-white">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>