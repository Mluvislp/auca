@extends('backend.layout.layout')

@section('title')
Nhóm thuộc tính
@endsection

@section('style')
<style>
.perfect-scrollbar-example {
  position: relative;
}
</style>
@endsection

@section('content')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Bảng điều khiển</a></li>
      <li class="breadcrumb-item"><a href="<?= Route('variant') ?>">Thuộc tính</a></li>
      <li class="breadcrumb-item active" aria-current="page">Thêm mới nhóm thuộc tính</li>
    </ol>
  </nav>
  <form class="forms-sample" id="variant-group-form" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label for="vg_name" class="form-label">Tên nhóm thuộc tính<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" id="vg_name" name="vg_name" value="" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="vg_order" class="form-label">Thứ tự</label>
              <input type="text" class="form-control" value="" id="vg_order" name="vg_order" autocomplete="off">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin">
        <input class="form-check-input" id="selectCheckbox1" type="radio" name="holdform" value="Y" checked>
        <label class="form-check-label" for="selectCheckbox1">
          Tiếp tục thêm
        </label>
        <input class="form-check-input" id="selectCheckbox2" type="radio" name="holdform" value="N">
        <label class="form-check-label" for="selectCheckbox2">
          Hiện danh sách thuộc tính
        </label>
      </div>
      <div class="btn-submit">
        <a href="/">
          <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
        </a>
      </div>
    </div>
  </form>
</div>

@endsection
@section('script')
<script type="text/javascript">
var token = localStorage.getItem("Token");
$(document).ready(function() {
  $('#variant-group-form').submit(function(event) {
    event.preventDefault();
    var vg_name = $('input[name="vg_name"]').val();
    var vg_order = $('input[name="vg_order"]').val();
    var holdform = $('input[name="holdform"]').filter(':checked').val();
    if (!vg_name) {
      toastr.error('Kiểm tra lại dữ liệu', 'Lỗi');
    } else {
      var formData = new FormData(this);
      formData.append('vg_name', vg_name);
      formData.append('vg_order', vg_order);
      console.log(formData);
      $.ajax({
        url: "{{ route('variantgroup.create') }}",
        type: 'POST',
        data: formData,
        enctype: 'multipart/form-data',
        beforeSend: function(xhr) {
          xhr.setRequestHeader("Authorization", "Bearer " + token);
        },
        processData: false, // Không xử lý dữ liệu thành chuỗi query
        contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
        success: function(response) {
          $('input[name="vg_name"]').val('');
          $('input[name="vg_order"]').val('');
          toastr.success(response.message, 'Thành công');
          if (holdform == 'N') {
              setTimeout(function() {
                  window.location.href = "{{ route('variant') }}";
              }, 900);
          }
        },
        error: function(error) {
          if (error.responseJSON && error.responseJSON.errors) {
            var errors = error.responseJSON.errors;
            for (var key in errors) {
              if (errors.hasOwnProperty(key)) {
                var errorMessages = errors[key];
                errorMessages.forEach(function(errorMessage) {
                  toastr.error(errorMessage);
                });
              }
            }
          }
          else if (error.responseJSON && error.responseJSON.message) {
            toastr.error(error.responseJSON.message);
          }
        }
      });
    }
  });
});
</script>

@endsection
