@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('dashboard.layouts.sidebar')

        <!-- Main Content -->
        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page mb-4">Edit Package Hospital</h1>
            <div class="row">
                <div class="col px-3">
                    <div class="card p-4 shadow-sm border-0">
                        <div class="card-body">
                            <form action="{{ route('packages_hospital.update', $package->id) }}" method="POST">
                                @csrf
                                @method('PUT')

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
                                                value="{{ old('title.ar', $package->title['ar'] ?? '') }}"
                                                placeholder="أدخل الاسم بالعربية" required>
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
                                                value="{{ old('title.en', $package->title['en'] ?? '') }}"
                                                placeholder="Enter title in English" required>
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
                                                value="{{ old('title.fr', $package->title['fr'] ?? '') }}"
                                                placeholder="Entrez le titre en français">
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
                                                value="{{ old('title.gr', $package->title['gr'] ?? '') }}"
                                                placeholder="Geben Sie den Titel ein">
                                            @error('title.gr')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Price -->
                                {{--  <div class="mb-3 mt-4">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" step="0.01"
                                        placeholder="Enter price"
                                        value="{{ old('price', $package->price) }}" required>
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>  --}}

                                <!-- Package Options -->
                                <div class="mb-3">
                                    <label class="form-label">Package Options</label>
                                    <div class="row">
                                        @foreach ($package_options as $option)
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="options[]"
                                                        value="{{ $option->id }}"
                                                        id="option{{ $option->id }}"
                                                        {{ in_array($option->id, $selected_options ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="option{{ $option->id }}">
                                                        {{ $option->title['en'] ?? $option->title['ar'] ?? 'Untitled' }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-purple text-white px-4 mt-3">Update Package</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
