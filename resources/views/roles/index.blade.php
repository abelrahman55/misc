@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

<div class="content_wrapper with-sidenav">
    <div class="">
        <div class="row mb-5">
            <div class="col-12 col-xl-12">
                <div style="background-color: transparent !important" class="card">
                    <div class="add d-flex justify-content-end p-2">
                        {{-- @can('roles-create') --}}
                        @can('roles-create')
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">
                            <i class="fas fa-add"></i> {{ __('إضافه') }}
                        </a>
                        @endcan
                        {{-- @endcan --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-center">
                            <table id="example2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('الاسم') }}</th>
                                        <th>{{ __('عدد الصلاحيات') }}</th>
                                        <th>{{ __('عدد المستخدمين') }}</th>
                                        <th>{{ __('العمليات') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ count($role->permissions) }}</td>
                                        <td>{{ count($role->users) }}</td>
                                        <td>
                                            {{-- @can('roles-delete') --}}
                                            @can('roles-delete')
                                            <button type="button" class="btn btn-danger w-25 delete-country-btn" data-id="{{ $role->id }}">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            @endcan
                                            {{-- @endcan --}}
                                            {{-- @can('roles-update') --}}
                                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-info w-25">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @can(abilities: 'roles-update')
                                            @endcan
                                            {{-- @endcan --}}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">{{ __('No data available!') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div style="padding:5px;direction: ltr;">
                                {!! $roles->withQueryString()->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>



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
