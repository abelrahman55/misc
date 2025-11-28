@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<style>
    .price-offer {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 25px;
        transition: 0.3s;
    }

    .price-offer:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .provider-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #28a745;
    }

    .provider-info h5 {
        margin: 0;
        color: #333;
        font-weight: bold;
    }

    .package-title {
        font-size: 18px;
        color: #007bff;
        font-weight: 600;
    }

    .options-list {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 10px 15px;
    }

    .options-list li {
        margin-bottom: 5px;
    }

    .btn-offer {
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 600;
    }
</style>

<div class="container-fluid d-flex main-content">
    @include('dashboard.layouts.sidebar')

    <main class="col dashboard-content p-4">

        <h3 class="mb-4">تقديم عرض سعر للبروفايدر</h3>

        @foreach($conversations as $booking)
            <div class="price-offer">

                {{-- Provider Section --}}
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ $booking->user?->prof_img_url ?? asset('images/default.png') }}"
                         alt="Provider"
                         class="provider-img me-3">

                    <div class="provider-info">
                        <h5>{{ $booking->provider?->f_name . ' ' . $booking->provider?->l_name }}</h5>
                        <p class="text-muted mb-1">{{ $booking->provider?->email }}</p>
                        <p class="text-muted mb-0">المهنة: {{ $booking->provider?->role ?? 'غير محدد' }}</p>
                    </div>
                </div>

                {{-- Package Section --}}
                {{--  <div class="mb-3">
                    <div class="package-title">📦 {{ $booking->package?->title['ar'] ?? 'بدون اسم' }}</div>
                    <p class="mb-0 text-muted">السعر الأساسي: {{ $booking->package?->price ?? 0 }} جنيه</p>
                </div>  --}}

                {{-- Options Section --}}
                @if($booking->options && count($booking->options))
                    <div class="options-list mb-3">
                        <strong>الخيارات المختارة:</strong>
                        <ul class="mb-0">
                            @foreach($booking->options as $option)
                                <li>🔹 خيار رقم {{ $option->package_option_id }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form to set offer price --}}
            <form action="{{ route('nursing_make_offer') }}" method="POST" class="mt-3">
    @csrf
    <input type="hidden" name="booking_id" value="{{ $booking->id }}">

    <div class="row g-3 align-items-center">

        {{--  <div class="col-md-4">
            <label class="form-label">اختيار المزوّد (Provider)</label>
            <select name="provider_id" class="form-select">
                <option value="{{ $booking->provider?->id }}"
                        {{ ($offer?->provider_id == $booking->provider?->id) ? 'selected' : '' }}>
                    {{ $booking->provider?->f_name . ' ' . $booking->provider?->l_name }} (المطلوب)
                </option>

                @foreach($providers as $provider)
                    @if($provider->id != $booking->provider?->id)
                        <option value="{{ $provider->id }}"
                                {{ ($offer?->provider_id == $provider->id) ? 'selected' : '' }}>
                            {{ $provider->f_name . ' ' . $provider->l_name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>  --}}

        {{-- السعر المقترح --}}
        <div class="col-md-4">
            <label class="form-label">السعر المقترح</label>
            <input type="number"
                   step="0.01"
                   name="provider_price"
                   class="form-control"
                   placeholder="اكتب السعر..."
                   value="{{ $offer?->provider_price ?? '' }}">
        </div>

        {{-- زر الإرسال --}}
        <div class="col-md-3">
            <button class="btn btn-success btn-offer mt-4">
                {{ $offer ? 'تعديل العرض' : 'إرسال العرض' }}
            </button>
        </div>
    </div>
</form>



            </div>
        @endforeach

        <div class="mt-3">
            {{ $conversations->links() }}
        </div>

    </main>
</div>
