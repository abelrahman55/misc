@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    @if (session('success'))
        <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div id="errorMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        @include('dashboard.layouts.sidebar')
        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page text-muted mb-4">articles Management</h1>
            <div class="row">
                <div class="col pe-4">
                    <!-- Tabs -->
                    <nav class="mb-4 mx-1">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-articless-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-articless" type="button" role="tab"
                                aria-controls="nav-articless" aria-selected="true">articless</button>
                            <button class="nav-link" id="nav-appoinments-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-appoinments" type="button" role="tab"
                                aria-controls="nav-appoinments" aria-selected="false">Appointments</button>
                            <button class="nav-link" id="nav-payments-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-payments" type="button" role="tab"
                                aria-controls="nav-payments" aria-selected="false">Payments</button>
                        </div>
                    </nav>
                    <a href="{{ route('articles.create') }}" class="btn btn-primary rounded-3 btn-sm">
                        Create
                    </a>
                    <!-- Tap Contents -->
                    <div class="card border-0 p-4 rounded-4">

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-articless" role="tabpanel"
                                aria-labelledby="nav-articless-tab">
                                <table class="table table-borderless transaction-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--  -->

                                        @foreach ($articless as $articles)
                                            <tr>

                                                <td>{{ $loop->index + 1 }}</td>
                                                <td class="text-muted">{{ $articles->title[app()->getLocale()] }}</td>
                                                <td class="text-muted">{{ $articles->description[app()->getLocale()] }}
                                                </td>
                                                <td class="text-muted">
                                                    <img src="{{ $articles->image }}" alt="Blog Image" width="50"
                                                        height="50" class="img-thumbnail">
                                                </td>
                                                <td class="text-muted">
                                                    {{ $articles->status == '1' ? 'active' : 'inactive' }}
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('articles.edit', $articles->id) }}"
                                                            class="btn btn-primary rounded-3 btn-sm">
                                                            Update
                                                        </a>

                                                        <form
                                                            action="{{ route('articles.delete', ['id' => $articles->id]) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this article?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger rounded-3 btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-appoinments" role="tabpanel"
                                aria-labelledby="nav-appoinments-tab">
                                <table class="table table-borderless table-hover transaction-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Time</th>
                                            <th scope="col">articles</th>
                                            <th scope="col">Specialty</th>
                                            <th scope="col">Technician</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>7:00 - 7:10</td>
                                            <td>Braha Marlam Roh</td>
                                            <td>Cardiology</td>
                                            <td>Valeria</td>
                                            <td>Hagana 16, Tel Aviv</td>
                                            <td>Visited</td>
                                            <td>
                                                <button type="button" class="btn bi bi-three-dots text-dark"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Reschedule</a></li>
                                                    <li><a class="dropdown-item" href="#">Approve</a></li>
                                                    <li><a class="dropdown-item" href="#">Cancel</a>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="nav-payments" role="tabpanel"
                                aria-labelledby="nav-payments-tab">
                                <table class="table table-borderless table-hover transaction-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">articles</th>
                                            <th scope="col">Provider</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Braha Marlam Roh</td>
                                            <td>Valeria</td>
                                            <td>1612$</td>
                                            <td>Visited</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>
</div>
