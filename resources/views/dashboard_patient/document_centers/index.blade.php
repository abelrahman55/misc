@extends('dashboard_patient.layouts.layout')
@include('dashboard_patient.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard_patient.layouts.sidebar')

        <main class="col dashboard-content p-4">
            <div class="d-flex gap-5">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="header-page">
                            <svg width="24" height="10" viewBox="0 0 24 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.61619 9.28003C7.40289 8.72536 7.1682 8.21336 6.9122 7.74403C6.65619 7.25336 6.36819 6.7947 6.04819 6.36803H23.2002V3.74403H6.04819C6.3469 3.31736 6.62419 2.86936 6.88019 2.40003C7.13619 1.90936 7.3709 1.3867 7.5842 0.832031H5.15219C3.82949 2.38936 2.37889 3.57336 0.800194 4.38403V5.76003C2.37889 6.52803 3.82949 7.70136 5.15219 9.28003H7.61619Z"
                                    fill="#141414" />
                            </svg>
                            Documents Center
                        </h1>
                    </div>

                    <div class="row d-flex justify-content-between mb-5">
                        <div class="col d-flex flex-column w-100 p-4 bg-white ">
                            <h3 class="header-page">Media Upload</h3>
                            <div class="row">
                                <div class="col-5 mb-4">
                                    <p class="text-2">Add your documents here, and you can upload up to 5 files max</p>

                                    <!-- Upload Form -->
                                    <form action="{{ route('patient.document_centers.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="box-upload mb-4">
                                            <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                            <div class="d-flex align-items-center">
                                                <hr class="flex-grow-1 border-top border-secondary" />
                                                <span class="mx-3 text-muted">OR</span>
                                                <hr class="flex-grow-1 border-top border-secondary" />
                                            </div>
                                            <label class="upload-btn">
                                                Browse File
                                                <input type="file" name="file" hidden required />
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </form>

                                    <p class="text-2 mt-3">Only support .jpg, .png, .svg, and zip files</p>
                                </div>
                            </div>

                            <h3 class="header-page mt-4">Uploaded Files</h3>
                            <p class="text-2">List of your documents, you can delete or replace them.</p>

                            <div class="row gap-2 mb-5 docs-container">
                                @forelse($data as $doc)
                                    <div class="col-5">
                                        <div class="d-flex justify-content-between align-items-start border px-2 py-3 rounded">
                                            <div class="d-flex gap-3 align-items-start">
                                                <div>
                                                    <i class="bi bi-file-earmark-text" style="font-size: 2rem;"></i>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="file-name">{{ basename($doc->file) }}</span>
                                                    <a href="{{ $doc->file }}" target="_blank" class="file-link">Click to view</a>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <form action="{{ route('patient.document_centers.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn text-danger"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">No documents uploaded yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
