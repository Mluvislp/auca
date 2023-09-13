@extends('backend.layout.layout')
@section('title')
    Danh mục nội bộ
@endsection
@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?= Route('category-internal') ?>">Danh mục nội bộ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
            </ol>
        </nav>
        <form class="forms-sample" id="category-internarl-form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card card-general-input col-12">
                        <div class="col-12 col-lg-6">
                            <div class="card-body">
                                <input type="hidden" name="attributeId" id="attributeId">
                                <div class="form-group mb-2 row">
                                    <label class="col-lg-4">Doanh nghiệp :</label>
                                    <div class="col-lg-8">
                                        <select id="groupid" style="width: 100%" class="form-select" name="groupid">
                                            <option value="">Chọn</option>
                                            {{printGroup($model_group)}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-2 row">
                                    <label class="col-lg-4">Cấp cha :</label>
                                    <div class="col-lg-8">
                                        <select id="cat_inter_parent_id" style="width: 100%" class="form-select" name="cat_inter_parent_id">
                                            <option value="">Chọn</option>
                                            {{printCategoryInternal($category_internal)}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-2 row">
                                    <label class="col-lg-4">Mã danh mục :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="cat_inter_code" id="cat_inter_code" autocomplete="off" class="form-control" value="">
                                        <div class="error"></div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 row">
                                    <label class="col-lg-4">Tên danh mục :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="cat_inter_name" id="cat_inter_name" autocomplete="off" class="form-control" value="">
                                        <div class="error"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin">
                    <input class="form-check-input" type="radio" name="holdform" value="Y" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Tiếp tục thêm
                    </label>
                    <input class="form-check-input" type="radio" name="holdform" value="N">
                    <label class="form-check-label" for="flexRadioDefault1">
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
        $(document).ready(function () {
            $('#category-internarl-form').submit(function (event) {
                event.preventDefault();
                var groupid = $('select[name="groupid"]').val();
                var cat_inter_parent_id = $('select[name="cat_inter_parent_id"]').val();
                var cat_inter_code = $('input[name="cat_inter_code"]').val();
                var cat_inter_name = $('input[name="cat_inter_name"]').val();
                var holdform = $('input[name="holdform"]').filter(':checked').val();

                if (!cat_inter_code) {
                    toastr.error('Nhập mã danh mục', 'Lỗi');
                    return;
                }else if (!cat_inter_name) {
                    toastr.error('Nhập tên danh mục', 'Lỗi');
                    return;
                }
                var formData = new FormData();
                formData.append('groupid', groupid);
                formData.append('cat_inter_parent_id',cat_inter_parent_id);
                formData.append('cat_inter_code',cat_inter_code);
                formData.append('cat_inter_name',cat_inter_name);
                $.ajax({
                    url: "{{ route('categoryinternal.create') }}",
                    type: 'POST',
                    data: formData,
                    enctype: 'multipart/form-data',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#category-internarl-form')[0].reset();
                        toastr.success(response.message, 'Thành công');
                        if (holdform == 'N') {
                            setTimeout(function() {
                                window.location.href = "{{route('category-internal')}}";
                            }, 900);
                        }else{
                            setTimeout(function() {
                                window.location.reload();
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
                        }
                        else if (error.responseJSON && error.responseJSON.message) {
                            toastr.error(error.responseJSON.message);
                        }
                    }
                });
            });
        });
    </script>

@endsection
