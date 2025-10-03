  <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edituserLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between border-0">
          <h5 class="modal-title text-md gray-color">تعديل المستخدم</h5>
          <button type="button" class="close m-0 p-0 border-0 bg-transparent" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="gray-color" style="font-size: 16px;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('store_update_admin') }}" method="post" class="form-style" enctype="multipart/form-data">
            @csrf

            <input type="hidden" id="edit-banner-id" name="id"/>

  <div class="my-2">
            <label>الاسم</label>
            <input type="text" name="name" id="current-name" placeholder="الاسم" />
        </div>
  <div class="my-2">
            <label>البريد الالكترونى</label>
            <input type="text" name="email" id="current-email" placeholder="البريد الالكترونى" />
        </div>

        <div class="my-2">
            <label>كلمه السر</label>
            <input type="text" name="password" id="current-password"  placeholder="الباسورد" />
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal">إلغاء</button>
          <button type="submit" class="btn save-btn">حفظ <i class="bi bi-check-circle-fill"></i></button>
        </div>
          </form>
        </div>
      </div>
    </div>
  </div>
