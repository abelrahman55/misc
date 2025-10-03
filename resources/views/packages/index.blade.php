@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')
    <main class="col dashboard-content p-4">
        <div class="row mb-4">
            <div class="col">
                <h1 class="header-page">All Packages</h1>
            </div>
        </div>

        <div class="row">
            @foreach($packages as $package)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm p-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $package->title['en'] ?? 'No Title' }} ({{ $package->price }}$)</h5>
                            <p class="card-text">
                                <strong>Options:</strong>
                                <ul>
                                    @forelse($package->options as $option)
                                        <li>{{ $option->title['en'] ?? 'No Option Title' }}</li>
                                    @empty
                                        <li>No Options</li>
                                    @endforelse
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>

@push('style')
<style>
    .card {
        border-radius: 15px;
    }
</style>
@endpush
