@extends('dashboard.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card box-1">
                <div class="card-header pb-0 bg-transparent border-0">
                    <h4 class="header-page-1">Renew Special Package</h4>
                    <p class="text-sm">For Appointment #{{ $package->appointment_id }} - Client: {{ $package->client->full_name ?? $package->client->f_name }}</p>
                    @if($package->status == 'rejected')
                    <div class="alert alert-danger text-white mt-2" role="alert">
                        <strong>Rejection Reason:</strong> {{ $package->rejection_reason }}
                        <br><small>Update the package details below and resubmit to the client.</small>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('appointment_packages.update', $package->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="appointment_id" value="{{ $package->appointment_id }}">
                        <input type="hidden" name="client_id" value="{{ $package->client_id }}">

                        <div class="mb-3">
                            <label class="form-label">Package Title (Arabic)</label>
                            <input type="text" name="title_ar" class="form-control" value="{{ $package->title['ar'] ?? '' }}" placeholder="باقة طبية مخصصة" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Package Title (English)</label>
                            <input type="text" name="title_en" class="form-control" value="{{ $package->title['en'] ?? '' }}" placeholder="Custom Medical Package" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ $package->price }}" placeholder="0.00" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Provider (Doctor/Hospital)</label>
                            <select name="provider_id" class="form-select" required>
                                <option value="">-- Choose Provider --</option>
                                @foreach($providers as $provider)
                                <option value="{{ $provider->id }}" {{ $package->provider_id == $provider->id ? 'selected' : '' }}>
                                    {{ $provider->full_name ?? $provider->f_name }} ({{ $provider->role }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 text-uppercase text-xs font-weight-bolder">Package Items / Details</h6>
                            <button type="button" class="btn btn-sm btn-outline-primary mb-0 py-1" id="add-item-btn">
                                <i class="bi bi-plus-circle"></i> Add Item
                            </button>
                        </div>

                        <div id="items-container">
                            @foreach($package->manualItems as $item)
                            <div class="item-row mb-3 d-flex gap-2">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-radius-sm"><i class="bi bi-dot"></i></span>
                                    <input type="text" name="items[]" class="form-control" value="{{ $item->title }}" placeholder="e.g. Clinical Consultation" required>
                                </div>
                                <button type="button" class="btn btn-link text-danger mb-0 p-0 remove-item-btn">
                                    <i class="bi bi-trash fs-5"></i>
                                </button>
                            </div>
                            @endforeach
                            @if($package->manualItems->isEmpty())
                            <div class="item-row mb-3 d-flex gap-2">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-radius-sm"><i class="bi bi-dot"></i></span>
                                    <input type="text" name="items[]" class="form-control" placeholder="e.g. Clinical Consultation" required>
                                </div>
                                <button type="button" class="btn btn-link text-danger mb-0 p-0 remove-item-btn" style="display: none;">
                                    <i class="bi bi-trash fs-5"></i>
                                </button>
                            </div>
                            @endif
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('appointments.index') }}" class="btn btn-secondary mb-0">Cancel</a>
                            <button type="submit" class="btn btn-primary mb-0">Update & Resubmit Package</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('items-container');
        const addBtn = document.getElementById('add-item-btn');

        if (addBtn) {
            addBtn.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className = 'item-row mb-3 d-flex gap-2';
                row.innerHTML = `
                    <div class="input-group">
                        <span class="input-group-text bg-light border-radius-sm"><i class="bi bi-dot"></i></span>
                        <input type="text" name="items[]" class="form-control" placeholder="New item..." required>
                    </div>
                    <button type="button" class="btn btn-link text-danger mb-0 p-0 remove-item-btn">
                        <i class="bi bi-trash fs-5"></i>
                    </button>
                `;
                container.appendChild(row);
                updateRemoveButtons();
            });
        }

        if (container) {
            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-item-btn')) {
                    e.target.closest('.item-row').remove();
                    updateRemoveButtons();
                }
            });
        }

        function updateRemoveButtons() {
            const rows = container.querySelectorAll('.item-row');
            rows.forEach((row) => {
                const btn = row.querySelector('.remove-item-btn');
                btn.style.display = rows.length === 1 ? 'none' : 'block';
            });
        }

        // Initial setup for remove buttons
        updateRemoveButtons();
    });
</script>
@endpush
@endsection