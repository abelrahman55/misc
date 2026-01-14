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
                            <form action="{{ route('faqs.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <label class="form-label">question (Arabic)</label>
                                            <input type="text" name="question[ar]" class="form-control"
                                                value="{{ old('question.ar') }}" placeholder="أدخل العنوان" required>
                                            @error('question.ar')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">answer (Arabic)</label>
                                            <textarea name="answer[ar]" class="form-control" placeholder="أدخل الوصف" required>{{ old('answer.ar', $about_us->answer['ar'] ?? '') }}</textarea>
                                            @error('answer.ar')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- English -->
                                    <div class="tab-pane fade" id="lang-en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">question (English)</label>
                                            <input type="text" name="question[en]" class="form-control"
                                                value="{{ old('question.en') }}" placeholder="Enter the question" required>
                                            @error('question.en')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">answer (English)</label>
                                            <textarea name="answer[en]" class="form-control" placeholder="Enter the answer" required>{{ old('answer.en', $about_us->answer['en'] ?? '') }}</textarea>
                                            @error('answer.en')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- French -->
                                    <div class="tab-pane fade" id="lang-fr" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">question (French)</label>
                                            <input type="text" name="question[fr]" class="form-control"
                                                value="{{ old('question.fr') }}" placeholder="Entrez le titre">
                                            @error('question.fr')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">answer (French)</label>
                                            <textarea name="answer[fr]" class="form-control" placeholder="Entrez la answer">{{ old('answer.fr', $about_us->answer['fr'] ?? '') }}</textarea>
                                            @error('answer.fr')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- German -->
                                    <div class="tab-pane fade" id="lang-gr" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">question (German)</label>
                                            <input type="text" name="question[gr]" class="form-control"
                                                value="{{ old('question.gr') }}" placeholder="Geben Sie den Titel ein">
                                            @error('question.gr')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">answer (German)</label>
                                            <textarea name="answer[gr]" class="form-control" placeholder="Geben Sie die Beschreibung ein">{{ old('answer.gr', $about_us->answer['gr'] ?? '') }}</textarea>
                                            @error('answer.gr')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
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
