@extends('backend.layout.layout')

@section('title')
Sửa tài khoản
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropzone/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropify/dist/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/pickr/themes/classic.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/font-awesome/css/font-awesome.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/backend/css/upload-image.css') }}">
@endsection

@section('content')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
      <li class="breadcrumb-item"><a href="{{ route('account') }}">Quản lý tài khoản</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sửa tài khoản</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Thông tin</h6>
          <form class="forms-sample">
            <div class="mb-3">
              <label for="exampleInputUsername1" class="form-label">Tên người dùng</label>
              <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off"
                placeholder="Nhập tên người dùng">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Địa chỉ email</label>
              <input class="form-control" maxlength="20" name="defaultconfig-2" id="defaultconfig-2" type="text"
                placeholder="Nhập địa chỉ email">
            </div>
            <div class="mb-3">
              <label class="form-label">Trạng thái</label>
              <div>
                <div class="form-check form-check-inline">
                  <input type="radio" class="form-check-input" name="gender_radio" id="gender1">
                  <label class="form-check-label" for="gender1">
                    Hiển thị
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" class="form-check-input" name="gender_radio" id="gender2">
                  <label class="form-check-label" for="gender2">
                    Không hiển thị
                  </label>
                </div>
              </div>
            </div>
            <div class="btn-submit">
              <a href="/">
                <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
              </a>
              <a href="/">
                <button class="btn btn-secondary">Hủy thay đổi</button>
              </a>
            </div>
          </form>

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

  </div>
</div>
@endsection

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
@endsection