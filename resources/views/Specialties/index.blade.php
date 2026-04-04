@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')
<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')
        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="header-page">Specialties Management</h1>
                <a href="{{ route('specialties.create') }}" class="btn btn-purple">Add Specialty</a>
            </div>

            <div class="row">
                <div class="col-12 px-3">
                    <div class="card p-4">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title (En)</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($specialties as $specialty)
                                    <tr>
                                        <td>{{ $specialty->id }}</td>
                                        <td>{{ $specialty->title['en'] ?? '-' }}</td>
                                        <td>
                                            @if($specialty->status == 1)
                                            <span class="badge bg-success">Active</span>
                                            @else
                                            <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('specialties.edit', $specialty->id) }}" class="btn btn-sm btn-dark"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('specialties.destroy', $specialty->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $specialties->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>