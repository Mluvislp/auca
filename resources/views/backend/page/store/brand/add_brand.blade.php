@extends('backend.layout.layout')

@section('title')
Thêm nhãn hàng
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropzone/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropify/dist/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/pickr/themes/classic.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/font-awesome/css/font-awesome.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/backend/css/upload-image.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/css/fileinput.min.css'>
@endsection

@section('content')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
      <li class="breadcrumb-item"><a href="{{ route('brand') }}">Quản lý nhãn hàng</a></li>
      <li class="breadcrumb-item active" aria-current="page">Thêm mới nhãn hàng</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Thông tin</h6>
          <form class="forms-sample" enctype="multipart/form-data" id="BrandForm">
            <div class="mb-3">
              <label for="exampleInputUsername1" class="form-label">Tên nhãn hàng <span class="text-danger"> *</span></label>
              <input type="text" class="form-control" name="brand_name" id="exampleInputUsername1" autocomplete="off"
                placeholder="Nhập tên nhãn hàng">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Mã thương hiệu <span class="text-danger"> *</span></label>
              <input class="form-control" maxlength="20" name="brand_code" id="defaultconfig-2" type="text"
                placeholder="Nhập mã thương hiệu">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Mô tả</label>
              <input class="form-control" maxlength="20" name="description" id="desBrand" type="text"
                placeholder="Nhập tên thương hiệu">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Content</label>
              <textarea class="form-control" name="description" id="contBrand" placeholder="Nhập mô tả"></textarea>
            </div>
            {{-- <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Content</label>
              <textarea class="form-control" name="content" id="defaultconfig-2"
                placeholder="Nhập mô tả"></textarea>
            </div> --}}
            <div class="mb-3">
              <label for="exampleInputPassword1" id="StatusSelect" class="form-label">Trạng thái</label>
              <select class="form-select" name="age_select" id="ageSelect">
                <option value="1" selected>kích hoạt</option>
                <option value="2">chưa kích hoạt</option>
              </select>
            </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
      <div class="card w-100 p-0">
        <div class="card-body">
          <h6 class="card-title">Hình ảnh</h6>
          <p class="text-muted mb-3">Vui lòng đặt tên file không quá dài, và kích thước file không quá 25mb</p>
          <section class="bg-diffrent">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-xl-8 w-100 p-0">
                  <div class="file-upload-contain">
                    <input id="multiplefileupload" type="file" accept=".jpg,.gif,.png" multiple />
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>

    <div class="btn-submit">
      <a href="/">
        <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
      </a>

    </div>
    </form>
  </div>
</div>
@endsection
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script type="text/javascript">
var token = localStorage.getItem("Token");
$(document).ready(function() {
  $('#BrandForm').submit(function(event) {
    event.preventDefault();
    var name = $('input[name="brand_name"]').val();
    var code = $('input[name="brand_code"]').val();
    var description = $('#desBrand').val();
    // var content = $('#contBrand').val();
    var selectedOptionValue = $('#ageSelect option:selected').val();
    var files = $('#multiplefileupload').get(0).files;
    if (!name || !code) {
      toastr.error('Bạn cần nhập nhập đầy đủ code và tên thương hiệu', 'Thao tác');
    } else {
      var formData = new FormData(this);
      if (files.length > 0) {
        for (var i = 0; i < files.length; i++) {
          formData.append('file[]', files[i]);
        }
      }
      formData.append('brand_name', name);
      formData.append('brand_description', description);
      // formData.append('content', content);
      formData.append('brand_code', code);
      formData.append('brand_status', selectedOptionValue);
      $.ajax({
        url: "{{ route('brand.createBrand') }}",
        type: 'POST',
        data: formData,
        enctype: 'multipart/form-data',
        beforeSend: function(xhr) {
          xhr.setRequestHeader("Authorization", "Bearer " + token);
        },
        processData: false, // Không xử lý dữ liệu thành chuỗi query
        contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
        success: function(response) {
          toastr.success('Tạo thành công', 'thao tác');
        },
        error: function(xhr, status, error) {
          var statusCode = xhr.status;
          switch (statusCode) {
            case 401:
              toastr.error('phiên đăng nhập đã hết hạn xin hãy đăng nhập và thử lại', 'Lỗi');
              break;
            case 403:
              toastr.error('Bạn không có quyền thực hiện việc này', 'Lỗi');
              break;
            default:
              toastr.error('Đã có lỗi xảy ra hãy reload trang và thử lại', 'Lỗi');
          }
        }
      });
    }
  });
});
</script>

@section('script')
<script src="{{ asset('assets/backend/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendors/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendors/dropify/dist/dropify.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendors/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendors/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ asset('assets/backend/js/form-validation.js') }}"></script>
<script src="{{ asset('assets/backend/js/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('assets/backend/js/inputmask.js') }}"></script>
<script src="{{ asset('assets/backend/js/select2.js') }}"></script>
<script src="{{ asset('assets/backend/js/typeahead.js') }}"></script>
<script src="{{ asset('assets/backend/js/tags-input.js') }}"></script>
<script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
<script src="{{ asset('assets/backend/js/dropify.js') }}"></script>
<script src="{{ asset('assets/backend/js/pickr.js') }}"></script>
<script src="{{ asset('assets/backend/js/flatpickr.js') }}"></script>

<script src="{{ asset('assets/backend/js/upload-image.js') }}"></script>

<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/js/plugins/sortable.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/themes/fas/theme.min.js'></script>
@endsection