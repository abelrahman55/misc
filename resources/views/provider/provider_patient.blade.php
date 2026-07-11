@extends('dashboard.layouts.layout')

@section('content')
    <style>
        /* 🌸 شبكة عرض الكروت */
        .grid-4 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
        }

        /* 🌿 تصميم الكارت */
        .patient-card {
            transition: all 0.3s ease;
            background-color: #fff;
            border: 1px solid #f1f1f1;
        }

        .patient-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            border-color: #e0d8ff;
        }

        /* 🌸 الزر البنفسجي */
        .btn-purple {
            background-color: #6f42c1;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-purple:hover {
            background-color: #5a32a3;
            box-shadow: 0 4px 10px rgba(111, 66, 193, 0.3);
        }

        /* 👤 صورة المستخدم */
        .patient-avatar {
            border: 3px solid #f8f9fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        /* ✨ النصوص */
        .patient-name {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .patient-info {
            font-size: 0.9rem;
            color: #6c757d;
        }

        /* 🔍 شريط البحث */
        .search-bar {
            max-width: 400px;
        }

        /* 📱 استجابة للشاشات الصغيرة */
        @media (max-width: 768px) {
            .grid-4 {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            {{-- الشريط الجانبي --}}
            @include('dashboard.layouts.sidebar')

            <main class="col-md-10 p-4" style="font-family: 'Noto Sans Lao', sans-serif;">
                <div class="row h-100">
                    <div class="col px-4 py-2 pb-0">
                        {{-- العنوان --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="text-1 text-dark mb-0">
                                <i class="bi bi-people-fill me-2 text-purple"></i> Patients
                            </h2>

                            {{-- شريط البحث --}}
                            <form method="GET" action="{{ route('provider_patient') }}" class="search-bar">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control rounded-start-3"
                                        placeholder="Search by name or phone..." value="{{ request('search') }}">
                                    <button class="btn btn-purple text-white rounded-end-3">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- كروت المرضى --}}
                        <div class="grid-4 mb-4">
                            @forelse ($patients as $patient)
                                <div class="card patient-card text-center rounded-4 py-4 px-4">
                                    <div class="mx-auto mb-3">
                                        <img src="{{ $patient?->user?->prof_img ? asset('storage/' . $patient->user->prof_img) : asset('default-avatar.png') }}"
                                            alt="User Avatar" class="rounded-circle patient-avatar" width="100"
                                            height="100">
                                    </div>

                                    <div class="patient-name mb-1">
                                        {{ $patient?->user?->f_name }} {{ $patient?->user?->l_name }}
                                    </div>

                                    <div class="patient-info">{{ $patient?->user?->phone }}</div>
                                    <div class="patient-info">{{ $patient?->user?->address }}</div>

                                    @if ($patient?->user?->email)
                                        <a href="mailto:{{ $patient->user->email }}"
                                            class="text-decoration-none small text-primary d-block mt-1">
                                            {{ $patient->user->email }}
                                        </a>
                                    @endif

                                    <hr class="my-3">

                                    <a href="{{ route('patient_profile', ['id' => $patient?->user?->id]) }}"
                                        class="btn btn-purple text-white rounded-2 px-4 py-2">
                                        <i class="bi bi-list-check"></i> Details
                                    </a>
                                </div>
                            @empty
                                <p class="text-center text-muted mt-4">No patients found.</p>
                            @endforelse
                        </div>

                        {{-- الباجينيشن --}}
                        <div class="d-flex justify-content-center mt-4">
                            {{ $patients->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
