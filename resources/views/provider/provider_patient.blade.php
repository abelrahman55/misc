@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')


<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')
                <main class="col-md-10 p-4" style="font-family: Noto Sans Lao, sans-serif">
                <div class="row h-100">
                    <div class="col px-4 py-2 pb-0">
                        <h2 class="text-1 text-dark mb-4">
                            Patients
                        </h2>
                        <div class="grid-4 mb-4">
                            @foreach ($patients as $patient )
                                <div class="card text-center shadow-sm rounded-4 py-4 px-5 border-0">
                                <div class="mx-auto mb-3">
                                    <img src="{{ asset('storage/'.$patient->prof_img) }}}}" alt="User Avatar"
                                        class="rounded-circle shadow-sm border border-3 border-light" width="100"
                                        height="100">
                                </div>
                                <h5 class="mb-1 fw-semibold">{{ $patient->f_name }} {{ $patient->l_name }}</h5>
                                <div class="text-muted small mb-1">{{ $patient->phone }}</div>
                                <div class="text-muted small mb-1">{{ $patient->address }}</div>
                                <a href="mailto:janick_parisian@yahoo.com"
                                    class="text-decoration-none small text-primary">
                                    {{ $patient->email }}
                                </a>
                                <hr class="my-3">
                                <a href="{{ route('patient_profile',['id'=>$patient->id]) }}" class="btn btn-purple text-white rounded-2 px-4 py-2"><i
                                        class="bi bi-list-check"></i> Details</a>
                            </div>
                            @endforeach
                        </div>
                        <nav aria-label="Page navigation ">
                            <ul class="pagination d-flex justify-content-center mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </main>
    </div>
</div>
