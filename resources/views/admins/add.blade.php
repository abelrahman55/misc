 <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addNewCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between border-0">
          <h5 class="modal-title text-md gray-color">إضافة مستخدم</h5>
          <button type="button" class="close m-0 p-0 border-0 bg-transparent" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="gray-color" style="font-size: 16px;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('store_new_admin') }}" class="form-style" method="post" enctype="multipart/form-data">
            @csrf

            <div class="my-2">
                <label class="text-sm">اسم المستخدم</label>
                <input type="text" placeholder="اسم المعلم" name="name" />
            </div>

            <div class="my-2">
                <label class="text-sm">البريد الالكترونى</label>
                <input type="text" placeholder="البريد الالكترونى" name="email" />
            </div>
            <div class="my-2">
                <label class="text-sm">كلمه السر</label>
                <input type="text" placeholder="كلمه السر" name="password" />
            </div>

            <div class="modal-footer border-0">
              <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal">إلغاء</button>
              <button type="submit" class="btn add-btn">إضافة <i class="bi bi-check-circle-fill"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
