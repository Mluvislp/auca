@extends('backend.layout.layout')

@section('title')
Thêm mã ưu đãi
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropzone/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropify/dist/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/pickr/themes/classic.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/font-awesome/css/font-awesome.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/backend/css/upload-image.css') }}">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/css/fileinput.min.css'>
<script src="https://cdn.tiny.cloud/1/pcjwwqc8cmyfakrsj31se2vexs47aily5b4colz60yxiydow/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('voucher') }}">Quản lý ưu đãi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới ưu đãi</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Thông tin</h6>
                    <form class="forms-sample">
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Mã giảm giá</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" maxlength="10"
                                placeholder="Nhập mã giảm giá">
                        </div>
                        <div class="mb-3">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                <div class="col">
                                    <label for="exampleInputEmail1" class="form-label">Ngày phát hành</label>
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="text" class="form-control flatpickr-input" placeholder="Ngày phát hành" data-input="" readonly="readonly">
                                        <span class="input-group-text input-group-addon" data-toggle=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1" class="form-label">Ngày kết thúc</label>
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="text" class="form-control flatpickr-input active" placeholder="Ngày kết thúc" data-input="" readonly="readonly">
                                        <span class="input-group-text input-group-addon" data-toggle=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Mô tả ưu đãi</label>
                            <textarea id="default-editor"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="gender_radio" id="gender1">
                                    <label class="form-check-label" for="gender1">
                                        Kích hoạt
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="gender_radio" id="gender2">
                                    <label class="form-check-label" for="gender2">
                                        Ngưng kích hoạt
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

        <div class="col-md-5 grid-margin stretch-card">
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
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/js/plugins/sortable.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/themes/fas/theme.min.js'></script>

<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
@endsection