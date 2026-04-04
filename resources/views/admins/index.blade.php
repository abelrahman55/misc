@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

  <div class="content_wrapper with-sidenav">
    <div class="admins">
      <div class="">
        <h4 class="action-btns">
          {{--  <button class="btn" data-toggle="modal" id="search-btn" data-target="#search">
            <span class="sq-btn" style="padding-top: 3px;">
              <i class="bi bi-search main-light"></i>
            </span>
          </button>  --}}

          <button class="btn" data-toggle="modal" data-target="#add">
            <span class="sq-btn" style="padding-top: 3px;">
              <i class="bi bi-plus main-light"></i>
            </span>
          </button>
        {{--  <button class="btn" id="bulk-delete-btn">
  <span class="sq-btn" style="padding-top: 3px;">
    <i class="bi bi-trash red-text"></i>
  </span>
</button>  --}}
          <span class="main-color text-md mx-2" style="font-weight: bold;">
            المستخدمين
          </span>
        </h4>

        <div class="div-bg">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>

                  <th>اسم المستخدم</th>
                  <th>البريد الإلكتروني</th>

                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admins as $user )
                    <tr>

                  <td><span class="text-sm mb-0 mx-2">{{ $user->name }}</span></td>
                  <td><span class="text-sm mb-0 mx-2">{{ $user->email }}</span></td>

                  <td>
                    <div class="btns-div">
                      {{--  <button class="btn delete" data-toggle="modal" data-id="{{ $user->id }}" data-target="#delete">
                        <span class="sq-btn" style="padding-top: 3px;">
                          <i class="bi bi-trash red-text"></i>
                        </span>
                      </button>  --}}
                    <button
                        class="btn edit_modal edit-btn"
                        data-toggle="modal"
                        data-id="{{ $user->id}}"
                        data-name="{{ $user->name}}"
                        data-email="{{ $user->email}}"
                        data-target="#edit_modal"
                    >
                        <span class="sq-btn" style="padding-top: 3px;">
                            <i class="bi bi-pencil-square main-light"></i>
                        </span>
                    </button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $admins->links('pagination::bootstrap-5') }}
        </div>
        </div>
      </div>
    </div>

  </div>



@include('admins.add')
@include('admins.edit')


@push('script')


  <script>

    document.querySelectorAll('.delete').forEach(function (btn) {
  btn.addEventListener('click', function () {
    let id = this.dataset.id;
    console.log(id);

    document.getElementById('delete-banner-id').value = id;
  });
});


    // Wait for 3 seconds (3000 ms) then remove the alert messages
    setTimeout(function() {
      // Remove success message if exists
      const successAlert = document.getElementById('successMessage');
      if(successAlert) {
        successAlert.style.display = 'none';
      }
      const errors = document.getElementById('errors');
      if(errors) {
        errors.style.display = 'none';
      }
      // Remove error message if exists
      const errorAlert = document.getElementById('errorMessage');
      if(errorAlert) {
        errorAlert.style.display = 'none';
      }
    }, 3000);
  </script>
  <script>
document.addEventListener('DOMContentLoaded', function () {

  // عند الضغط على زر التعديل
  document.querySelectorAll('.edit-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      let id = this.dataset.id;
      let name = this.dataset.name;


      let email=this.dataset.email;



      document.getElementById('edit-banner-id').value = id;
      document.getElementById('current-email').value = email;
      document.getElementById('current-name').value = name;

      // إعادة تعيين input file حتى يشتغل الحدث بعد الضغط على زر تعديل
      {{--  console.log(fileInput2)  --}}

    });
  });
});
  document.querySelectorAll('.deletebanner').forEach(function (btn) {
    btn.addEventListener('click', function () {
      let id = this.dataset.id;
      console.log(id)
      document.getElementById('delete-banner-id').value = id;


  });
});
</script>




@endpush
