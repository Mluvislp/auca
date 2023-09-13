@extends('backend.layout.layout')

@section('title')
    Thêm danh mục
@endsection

@section('style')
    <style>
        .perfect-scrollbar-example {
            position: relative;
        }
    </style>
    <script src="https://cdn.tiny.cloud/1/pcjwwqc8cmyfakrsj31se2vexs47aily5b4colz60yxiydow/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
@endsection

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Bảng điều khiển</a>
                </li>
                <li class="breadcrumb-item"><a href="<?= Route('category') ?>">Danh mục</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">Thông tin cơ bản</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="lineTabContent">
                    <form class="forms-sample" id="category-form" enctype="multipart/form-data">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                             aria-labelledby="home-line-tab">
                            <div class="card-body p-0 pt-2">
                                <div class="card card-general-input col-12">
                                    <div class="card-header header-elements-inline bg-light d-block d-sm-flex">
                                        <h5 class="card-title font-weight-semibold mb-0">
                                            <i class="icon-lg pb-3px" data-feather="info"></i>
                                            Thông tin cơ bản
                                        </h5>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="card-body">
                                            <div class="form-group mb-2">
                                                <label>Danh mục</label>
                                                <select class="form-select" id="cat_parent_id" name="cat_parent_id"
                                                        data-placeholder="Chọn một danh mục">
                                                    <option></option>
                                                    @php printCategories($categories) @endphp
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Tên<span class="text-danger">*</span></label>
                                                <input type="text" name="cat_name" maxlength="255"
                                                       class="required form-control" id="cat_name"
                                                       autocomplete="off" value="" placeholder="Nhập tên danh mục">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Mã danh mục<span class="text-danger">*</span></label>
                                                <input type="text" name="cat_code" maxlength="255"
                                                       class="required form-control" id="cat_code"
                                                       autocomplete="off" value="" placeholder="Nhập mã danh mục">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Trạng thái:</label>
                                                <select name="cat_status" id="cat_status" class="form-select">
                                                    <option value="1">Hiển thị</option>
                                                    <option value="2">Ẩn</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Hiển thị trang chủ:</label>
                                                <select name="cat_show_home" id="cat_show_home" class="form-select">
                                                    <option value="">- Trạng thái -</option>
                                                    <option value="1">Hiển thị</option>
                                                    <option value="2">Không hiển thị</option>
                                                </select>
                                            </div>
                                            <div class="card mb-3">
                                                <div
                                                    class="card-header header-elements-inline bg-light d-flex align-items-center justify-content-between">
                                                    <h5 class="card-title font-weight-semibold mb-0">
                                                        <i class="icon-lg pb-3px" data-feather="image"></i>
                                                        Hình ảnh
                                                    </h5>
                                                    <div class="header-elements">
                                                        <div class="list-icons">
                                                            <a class="list-icons-item" data-bs-toggle="collapse"
                                                               href="#list-images-item"
                                                               aria-expanded="false" aria-controls="list-images-item">
                                                                <i class="icon-xl pb-3px"
                                                                   data-feather="chevron-down"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body collapse show" id="list-images-item">
                                                    <div class="form-group mb-2">
                                                        <div
                                                            class="media mt-0 d-flex align-items-start justify-content-between gap-2">
                                                            <div class="mr-3 imageArea" id="image-cat-image">
                                                                <i class="icon-xxl pb-3px"data-feather="camera"></i>
                                                            </div>
                                                            <div class="media-body" style="width: 90%">
                                                                <div class="uniform-uploader" id="uniform-imageUpload">
                                                                    <input class="form-control" name="cat_image"
                                                                           class="form-input-styled businessFileUpload"  accept="image/*"
                                                                           id="cat_image" type="file">
                                                                </div>
                                                                <span class="form-text text-muted">File: gif, png, jpg, bmp (Tối đa 4MB)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-2">
                                                <div
                                                    class="card-header header-elements-inline bg-light d-flex align-items-center justify-content-between">
                                                    <h5 class="card-title font-weight-semibold mb-0">
                                                        <i class="icon-lg pb-3px" data-feather="image"></i>
                                                        Icon
                                                    </h5>
                                                    <div class="header-elements">
                                                        <a class="list-icons-item" data-bs-toggle="collapse"
                                                           href="#list-icons-item"
                                                           aria-expanded="false" aria-controls="list-icons-item">
                                                            <i class="icon-xl pb-3px" data-feather="chevron-down"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="card-body collapse show" id="list-icons-item">
                                                    <div class="form-group mb-2">
                                                        <div
                                                            class="media mt-0 d-flex align-items-start justify-content-between gap-2">
                                                            <div class="mr-3 imageArea" id="image-cat-icon">
                                                                <i class="icon-xxl pb-3px" data-feather="camera"></i>
                                                            </div>
                                                            <div class="media-body" style="width: 90%">
                                                                <div class="uniform-uploader" id="uniform-iconUpload">
                                                                    <input class="form-control" name="cat_icon"
                                                                           class="form-input-styled businessFileUpload"  accept="image/*"
                                                                           id="cat_icon" type="file">
                                                                </div>
                                                                <span class="form-text text-muted">File: gif, png, jpg, bmp (Tối đa 4MB)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Thứ tự:</label>
                                                <input type="text" name="cat_order" maxlength="11" id="cat_order"
                                                       autocomplete="off"
                                                       class="form-control" value="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Sau khi lưu dữ liệu:</label>
                                                <div
                                                    class="px-2 d-flex align-items-center justify-content-start flex-wrap gap-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="holdform"
                                                               value="Y" checked>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Tiếp tục thêm
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="holdform"
                                                               value="N">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Hiện danh sách
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-2">
                                                <button id="btnSaveForm" type="submit" class="btn btn-success">
                                                    <i class="icon-lg pb-3px" data-feather="save"></i>
                                                    Lưu
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        var token = localStorage.getItem("Token");
        $(document).ready(function () {
            $('#cat_image').change(function() {
                var file = $(this).prop('files')[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgElement = $('<img>').attr('src', e.target.result).attr('alt', 'Category Image').attr('width', '50');
                    $('#image-cat-image').html(imgElement);
                }
                reader.readAsDataURL(file);
            });
            $('#cat_icon').change(function() {
                var file = $(this).prop('files')[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgElement = $('<img>').attr('src', e.target.result).attr('alt', 'Category Image').attr('width', '50');
                    $('#image-cat-icon').html(imgElement);
                }
                reader.readAsDataURL(file);
            });
            function isValidImageFile(file) {
                var allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                return allowedTypes.includes(file.type);
            }
            $('#category-form').submit(function (event) {
                event.preventDefault();
                var cat_name = $('input[name="cat_name"]').val();
                var cat_code = $('input[name="cat_code"]').val();
                var holdform = $('input[name="holdform"]').filter(':checked').val();
                if (!cat_name) {
                    $('input[name="cat_name"]').addClass('border-danger');
                    toastr.error('Bạn chưa nhập tên', 'Lỗi');
                    return;
                } else {
                    $('input[name="cat_name"]').removeClass('border-danger');
                }
                if (!cat_code) {
                    $('input[name="cat_code"]').addClass('border-danger');
                    toastr.error('Bạn chưa nhập mã', 'Lỗi');
                    return;
                } else {
                    $('input[name="cat_code"]').removeClass('border-danger');
                }
                var fields = [{
                    name: 'cat_name',
                    selector: 'input[name="cat_name"]'
                },
                    {
                        name: 'cat_code',
                        selector: 'input[name="cat_code"]'
                    },
                    {
                        name: 'cat_parent_id',
                        selector: 'select[name="cat_parent_id"]'
                    },
                    {
                        name: 'cat_status',
                        selector: 'select[name="cat_status"]'
                    },
                    {
                        name: 'cat_show_home',
                        selector: 'select[name="cat_show_home"]'
                    },
                    {
                        name: 'cat_order',
                        selector: 'input[name="cat_order"]'
                    },
                    {
                        name: 'cat_image',
                        selector: 'input[name="cat_image"]',
                        type: 'file'
                    },
                    {
                        name: 'cat_icon',
                        selector: 'input[name="cat_icon"]',
                        type: 'file'
                    },
                ];
                var formData = new FormData(this);
                var error = 0;
                fields.forEach(function (field) {
                    var value;
                    if (field.type === 'checkbox') {
                        value = $(field.selector).prop('checked');
                    } else if (field.type === 'file') {
                        var fileInput = $(field.selector)[0];
                        if (fileInput.files.length > 0) {
                            var file = fileInput.files[0];
                            if (file.size <= 2 * 1024 * 1024) {  // Kiểm tra kích thước tệp tin (nhỏ hơn hoặc bằng 2MB)
                                if (isValidImageFile(file)) {  // Kiểm tra chỉ định dạng là hình ảnh
                                    value = file;
                                } else {
                                   toastr.error('Tệp tải lên phải là hình ảnh');
                                    error++;
                                    return;
                                }
                            } else {
                                toastr.error('Tệp tải lên không được vượt quá 2Mb');
                                error++;
                                return;
                            }
                        } else {
                            return;
                        }
                    } else {
                        value = $(field.selector).val();
                    }
                    formData.append(field.name, value);
                });
                if(error == 0){
                    $.ajax({
                        url: "{{ route('category.create') }}",
                        type: 'POST',
                        data: formData,
                        enctype: 'multipart/form-data',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader("Authorization", "Bearer " + token);
                        },
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            toastr.success(response.message, 'Thành công');
                            if (holdform == 'N') {
                                setTimeout(function () {
                                    window.location.href = "{{ route('category') }}";
                                }, 900);
                            }else{
                                setTimeout(function() {
                                    $('#category-form')[0].reset();
                                }, 600);
                            }
                        },
                        error: function (error) {
                            if (error.responseJSON && error.responseJSON.errors) {
                                var errors = error.responseJSON.errors;
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        var errorMessages = errors[key];
                                        errorMessages.forEach(function (errorMessage) {
                                            toastr.error(errorMessage);
                                        });
                                    }
                                }
                            } else if (error.responseJSON && error.responseJSON.message) {
                                toastr.error(error.responseJSON.message);
                            }
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $('#cat_parent_id').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>

@endsection
