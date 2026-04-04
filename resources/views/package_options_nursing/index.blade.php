@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="header-page">Package Options Nursing</h1>
                <a href="{{ route('package-options-nursing.create') }}" class="btn btn-purple text-white">+ Add New Option Nursing</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Title (Arabic)</th>
                                <th>Title (English)</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($options as $option)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $option->title['ar'] ?? '-' }}</td>
                                    <td>{{ $option->title['en'] ?? '-' }}</td>
                                    <td>{{ $option->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        {{--  <a href="{{ route('package-options-nursing.edit', $option) }}" class="btn btn-sm btn-primary">Edit</a>  --}}
                                        <a href="{{ route('edit_package-options-nursing', ['id' => $option->id]) }}" class="btn btn-sm btn-primary">Edit</a>

                                        {{--  <a href="{{ route('package-options-nursing.edit', ['id'=>$option->id??0]) }}" class="btn btn-sm btn-primary">Edit</a>  --}}
                                        <form action="{{ route('destroy_package-options-nursing', ['id'=>$option->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this option?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted">No package options found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
