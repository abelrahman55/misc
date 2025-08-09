@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('dashboard.layouts.sidebar')

        <!-- Main Content -->
        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page mb-4">Add New Question</h1>
            <div class="row">
                <div class="col px-3">
                    <div class="card p-4">
                        <div class="card-body">
                            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
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
                                                value="{{ old('title.ar') }}" placeholder="أدخل العنوان" required>
                                            @error('title.ar')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description (Arabic)</label>
                                            <textarea name="description[ar]" class="form-control" placeholder="أدخل الوصف" required>{{ old('description.ar', $about_us->description['ar'] ?? '') }}</textarea>
                                            @error('description.ar')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- English -->
                                    <div class="tab-pane fade" id="lang-en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title (English)</label>
                                            <input type="text" name="title[en]" class="form-control"
                                                value="{{ old('title.en') }}" placeholder="Enter the title" required>
                                            @error('title.en')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description (English)</label>
                                            <textarea name="description[en]" class="form-control" placeholder="Enter the description" required>{{ old('description.en', $about_us->description['en'] ?? '') }}</textarea>
                                            @error('description.en')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- French -->
                                    <div class="tab-pane fade" id="lang-fr" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title (French)</label>
                                            <input type="text" name="title[fr]" class="form-control"
                                                value="{{ old('title.fr') }}" placeholder="Entrez le titre">
                                            @error('title.fr')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description (French)</label>
                                            <textarea name="description[fr]" class="form-control" placeholder="Entrez la description">{{ old('description.fr', $about_us->description['fr'] ?? '') }}</textarea>
                                            @error('description.fr')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- German -->
                                    <div class="tab-pane fade" id="lang-gr" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title (German)</label>
                                            <input type="text" name="title[gr]" class="form-control"
                                                value="{{ old('title.gr') }}" placeholder="Geben Sie den Titel ein">
                                            @error('title.gr')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description (German)</label>
                                            <textarea name="description[gr]" class="form-control" placeholder="Geben Sie die Beschreibung ein">{{ old('description.gr', $about_us->description['gr'] ?? '') }}</textarea>
                                            @error('description.gr')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="mb-3 mt-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1"
                                            {{ old('status', $about_us->status ?? 1) == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0"
                                            {{ old('status', $about_us->status ?? 1) == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-purple text-white">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
