@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

@section('content')
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12 col-xl-10 mx-auto">
                <form method="post" action="{{ route('roles.update', $role) }}">
                    @csrf
                    @method('PUT')

                    <!-- Card for Role Name -->
                    <div style="background-color: transparent !important" class="card shadow-sm rounded-3 border-0">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="fas fa-user-tag me-2"></i> {{ __('Role Name') }}
                            </h5>
                            <input type="text" name="name" class="form-control rounded-pill shadow-sm" value="{{ $role->name }}">
                        </div>
                    </div>

                    <!-- Permissions Section -->
                    <div  style="background-color: transparent !important" class="card shadow-sm rounded-3 border-0 mt-4">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="fas fa-shield-alt me-2"></i> تحديد الصلاحيات
                            </h5>

                            <!-- Select All Checkbox -->
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <input type="checkbox" id="check" class="form-check-input" style="transform: scale(1.3); cursor: pointer;"
                                    @if ($permissionNum == count($permissions)) checked @endif>
                                    <label for="check" class="form-check-label fw-bold text-danger">{{ __('Select All') }}</label>
                                </div>

                            <!-- Permissions Grid in Accordion -->
                            <div class="accordion" id="permissionsAccordion">
                                @php
                                    $groupedPermissions = $permissions->groupBy(function ($perm) {
                                        return explode('-', $perm->name)[0]; // Group by first part before "-"
                                    });
                                @endphp

                                @foreach ($groupedPermissions as $group => $perms)
                                    <div class="accordion-item border-0 mb-2 shadow-sm">
                                        <h2 class="accordion-header" id="heading-{{ $group }}">
                                            <button class="accordion-button bg-light text-dark fw-bold shadow-none"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $group }}"
                                            aria-expanded="true" aria-controls="collapse-{{ $group }}">
                                            <i class="fas fa-folder me-2 text-primary"></i>
                                            {{ __('Manage') }} {{ __(ucfirst($group)) }}
                                        </button>
                                        </h2>
                                        <div id="collapse-{{ $group }}" class="accordion-collapse collapse show"
                                            aria-labelledby="heading-{{ $group }}"
                                            data-bs-parent="#permissionsAccordion">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    @foreach ($perms as $permission)
                                                        <div class="col-md-4 col-sm-6 mb-2">
                                                            <div style="display: flex;align-items: center;justify-content: space-between" class="form-check bg-white p-2 rounded shadow-sm border">
                                                                <input style="display: block" type="checkbox" class="form-check-input checkbox" name="permission_name[]"
                                                                    value="{{ $permission->name }}"
                                                                    @if (in_array($permission->id, $ids) || $permissionNum == count($permissions)) checked @endif>
                                                                <label style="text-align: left;width:100%;display:block" class="form-check-label text-dark ms-2">
                                                                    {{ ucfirst(str_replace('-', ' ', __($permission->name))) }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <button type="submit" class="btn btn-primary mt-4 w-100 shadow-sm rounded-pill">
                        <i class="fas fa-save me-2"></i> {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

  @push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.delete-country-btn').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');
                console.log("Trying to delete role with ID:", id); // Debug

                Swal.fire({
                    title: '{{ __("هل انت متأكد") }}',
                    text: "{{ __('هل تريد مسح هذا') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DC143C',
                    cancelButtonColor: '#696969',
                    cancelButtonText: "{{ __('Cancel') }}",
                    confirmButtonText: '{{ __("نعم!") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.createElement('form');
                        form.action = '{{ url("/admin/roles") }}/' + id;
                        form.method = 'POST';
                        form.style.display = 'none';

                        let csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = '{{ csrf_token() }}';

                        let methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';

                        form.appendChild(csrfInput);
                        form.appendChild(methodInput);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush

  </div>



  @push('script')
<script>
document.getElementById('check').addEventListener('change', function() {
    document.querySelectorAll('.checkbox').forEach(checkbox => checkbox.checked = this.checked);
});

document.querySelectorAll('.checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        document.getElementById('check').checked = [...document.querySelectorAll('.checkbox')].every(cb => cb.checked);
    });
});
</script>
@endpush
