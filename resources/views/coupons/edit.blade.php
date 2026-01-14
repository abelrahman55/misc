@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <h1 class="header-page mb-4">Edit Coupon</h1>

            <div class="row">
                <div class="col px-3">
                    <div class="card p-4 shadow-sm border-0">
                        <div class="card-body">
                            <form action="{{ route('update_coupon', $coupon->id) }}" method="POST">
                                @csrf

                                <!-- Coupon Code -->
                                <div class="mb-3">
                                    <label class="form-label">Coupon Code</label>
                                    <input type="text" name="code" class="form-control"
                                           value="{{ old('code', $coupon->code) }}" required>
                                    @error('code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Discount Percent -->
                                <div class="mb-3">
                                    <label class="form-label">Discount Percent (%)</label>
                                    <input type="number" name="discount_percent" class="form-control"
                                           step="0.01" min="0" max="100"
                                           value="{{ old('discount_percent', $coupon->discount_percent) }}" required>
                                    @error('discount_percent')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Minimum Order -->
                                <div class="mb-3">
                                    <label class="form-label">Minimum Order</label>
                                    <input type="number" name="min_order" class="form-control"
                                           step="0.01" min="0"
                                           value="{{ old('min_order', $coupon->min_order) }}" required>
                                    @error('min_order')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Usage Limit -->
                                <div class="mb-3">
                                    <label class="form-label">Usage Limit</label>
                                    <input type="number" name="usage_limit" class="form-control"
                                           min="1"
                                           value="{{ old('usage_limit', $coupon->usage_limit) }}" required>
                                    @error('usage_limit')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Start Date -->
                                <div class="mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="starts_at" class="form-control"
                                           value="{{ old('starts_at', $coupon->starts_at ? $coupon->starts_at->format('Y-m-d') : '') }}" required>
                                    @error('starts_at')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Expiry Date -->
                                <div class="mb-3">
                                    <label class="form-label">Expiry Date</label>
                                    <input type="date" name="expires_at" class="form-control"
                                           value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : '') }}" required>
                                    @error('expires_at')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="1" {{ old('status', $coupon->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $coupon->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-purple text-white px-4 mt-3">Update Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
