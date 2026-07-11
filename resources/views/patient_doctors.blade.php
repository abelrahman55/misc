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

        /* ⭐ تصميم النجوم */
        .star-rating {
            direction: rtl;
            display: inline-flex;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 1.8rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating input[type="radio"]:checked~label {
            color: #ffc107;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffc107;
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
                                <i class="bi bi-person-badge me-2 text-purple"></i> Doctors
                            </h2>

                            {{-- شريط البحث --}}
                            <form method="GET" action="{{ route('patient_doctors') }}" class="search-bar">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control rounded-start-3"
                                        placeholder="Search by name or phone..." value="{{ request('search') }}">
                                    <button class="btn btn-purple text-white rounded-end-3">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- كروت الأطباء --}}
                        <div class="grid-4 mb-4">
                            @forelse ($doctors as $doctor)
                                <div class="card patient-card text-center rounded-4 py-4 px-4">
                                    <div class="mx-auto mb-3">
                                        <img src="{{ $doctor?->provider?->prof_img ? asset('storage/' . $doctor->provider->prof_img) : asset('default-avatar.png') }}"
                                            alt="User Avatar" class="rounded-circle patient-avatar" width="100"
                                            height="100">
                                    </div>

                                    <div class="patient-name mb-1">
                                        {{ $doctor?->provider?->f_name }} {{ $doctor?->provider?->l_name }}
                                    </div>

                                    <div class="patient-info">{{ $doctor?->provider?->phone }}</div>
                                    <div class="patient-info">{{ $doctor?->provider?->address }}</div>

                                    @if ($doctor?->provider?->email)
                                        <a href="mailto:{{ $doctor->provider->email }}"
                                            class="text-decoration-none small text-primary d-block mt-1">
                                            {{ $doctor->provider->email }}
                                        </a>
                                    @endif

                                    <hr class="my-3 d-flex justify-content-center">

                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('patient_profile', ['id' => $doctor?->provider?->id]) }}"
                                            class="btn btn-purple text-white rounded-2 px-3 py-2">
                                            <i class="bi bi-list-check"></i> Details
                                        </a>

                                        {{-- 🔹 زر التقييم --}}
                                        <button type="button" class="btn btn-outline-warning rounded-2 px-3 py-2"
                                            data-bs-toggle="modal" data-bs-target="#rateDoctorModal"
                                            data-provider-id="{{ $doctor?->provider?->id }}"
                                            data-provider-name="{{ $doctor?->provider?->f_name }} {{ $doctor?->provider?->l_name }}">
                                            <i class="bi bi-star"></i> Rate
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-muted mt-4">No doctors found.</p>
                            @endforelse
                        </div>

                        {{-- الباجينيشن --}}
                        <div class="d-flex justify-content-center mt-4">
                            {{ $doctors->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    {{-- 🌟 مودال التقييم --}}
    <div class="modal fade" id="rateDoctorModal" tabindex="-1" aria-labelledby="rateDoctorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('make_rate') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="rateDoctorLabel">Rate Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">
                    <input type="hidden" name="provider_id" id="provider_id" value="">
                    <p id="provider_name" class="fw-semibold text-purple"></p>

                    {{-- ⭐ النجوم --}}
                    <div class="star-rating mb-3">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rate" id="star{{ $i }}" value="{{ $i }}">
                            <label for="star{{ $i }}">★</label>
                        @endfor
                    </div>

                    <div class="mb-3">
                        <textarea name="comment" class="form-control" placeholder="Write your comment..." rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-purple text-white">Submit Rating</button>
                </div>
            </form>
        </div>
    </div>

    {{-- 🧠 سكربت يمرر بيانات الطبيب إلى المودال --}}
    <script>
        const rateModal = document.getElementById('rateDoctorModal');
        rateModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const providerId = button.getAttribute('data-provider-id');
            const providerName = button.getAttribute('data-provider-name');

            document.getElementById('provider_id').value = providerId;
            document.getElementById('provider_name').textContent = providerName;
        });
    </script>
@endsection
