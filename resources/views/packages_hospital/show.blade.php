@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('dashboard.layouts.sidebar')

        <!-- Main Content -->
        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="header-page">Package Details Hospital</h1>
                <a href="{{ route('packages_hospital.index') }}" class="btn btn-secondary btn-sm">
                    ← Back to Packages
                </a>
            </div>

            <div class="row">
                <div class="col px-3">
                    <div class="card p-4 shadow-sm border-0">
                        <div class="card-body">

                            <!-- Package Titles -->
                            <h4 class="mb-3 text-purple">Titles</h4>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Language</th>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>العربية</td>
                                            <td>{{ $package->title['ar'] ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>English</td>
                                            <td>{{ $package->title['en'] ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Français</td>
                                            <td>{{ $package->title['fr'] ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deutsch</td>
                                            <td>{{ $package->title['gr'] ?? '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Price -->
                            <h4 class="text-purple mb-2">Price</h4>
                            <p class="fs-5 fw-semibold">{{ $package->price }} <span class="text-muted">EGP</span></p>

                            <!-- Package Options -->
                            <h4 class="text-purple mt-4 mb-3">Package Options</h4>

                            @if ($package->optionsHospital->count() > 0)
                                <ul class="list-group">
                                    @foreach ($package->optionsHospital as $option)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $option->title['en'] ?? $option->title['ar'] ?? 'Untitled Option' }}
                                            <span class="badge bg-purple text-white rounded-pill">#{{ $option->id }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No options assigned to this package.</p>
                            @endif

                            <!-- Actions -->
                            <div class="mt-4 d-flex gap-2">
                                <a href="{{ route('packages_hospital.edit', $package->id) }}" class="btn btn-primary px-4">
                                    Edit
                                </a>
                                <form action="{{ route('packages_hospital.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this package?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-4">Delete</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
