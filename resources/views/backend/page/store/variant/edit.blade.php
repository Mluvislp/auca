@extends('backend.layout.layout')

@section('title')
    Thuộc tính
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
                <li class="breadcrumb-item active" aria-current="page">Thêm mới thuộc tính</li>
            </ol>
        </nav>
        @error('var_id')
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ $message }}
        </div>
        @enderror
        <form class="forms-sample" id="variant-form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" value="{{$variant_model['var_id']}}" name="var_id">
                            <div class="mb-3">
                                <label for="cat_id" class="form-label">Danh mục</label>
                                <select class="form-select" multiple aria-label="multiple select example"
                                        name="cat_id[]" id="cat_id">
                                    <option value="">Chọn</option>
                                    @php
                                        printCategoriesMultipleChoise($categories , 0 , $selected_category);
                                    @endphp
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="vg_id" class="form-label">Nhóm thuộc tính</label>
                                <select class="form-select" name="vg_id" id="vg_id">
                                    <option value="">Chọn</option>
                                    @foreach($variant_group as $val)
                                        <option
                                            value="<?= $val['vg_id'] ?>"
                                            {{($variant_model['vg_id'] == $val['vg_id'] ? 'selected' : '') }}
                                        ><?= $val['vg_name'] ?>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="var_parent_id" class="form-label">Thuộc tính cha</label>
                                <select class="form-select" name="var_parent_id" id="var_parent_id">
                                    <option value="">Chọn</option>
                                    @php
                                        printVariant($variant , 0 , $variant_model['var_parent_id']);
                                    @endphp
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="var_name" class="form-label">Tên thuộc tính<span class="text-danger"> *</span></label>
                                <input type="text"
                                       class="form-control"
                                       id="var_name"
                                       name="var_name"
                                       autocomplete="off"
                                       value="{{$variant_model['var_name']}}"
                                       placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="var_code" class="form-label">Mã thuộc tính<span class="text-danger"> *</span></label>
                                <input type="text"
                                       class="form-control @error('var_code') border-danger @enderror"
                                       id="var_code"
                                       name="var_code"
                                       autocomplete="off"
                                       value="{{$variant_model['var_code']}}"
                                       placeholder="VD : color, size, ...">
                                <p style="color: gray">Mã thuộc tính phải ở dạng viết liền không dấu.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="cat_id" class="form-label">Kiểu dữ liệu<span class="text-danger"> *</span></label>
                                <select class="form-select @error('var_type') border-danger @enderror" name="var_type" id="var_type">
                                   @php
                                       renderTypeValue($variant_model['var_type']);
                                   @endphp
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="var_unit" class="form-label ">Đơn vị</label>
                                <input type="text"
                                       class="form-control @error('var_unit') border-danger @enderror"
                                       id="var_unit"
                                       name="var_unit"
                                       value="{{$variant_model['var_unit']}}"
                                       autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="var_order" class="form-label">Thứ tự</label>
                                <input type="text"
                                       class="form-control @error('var_order') border-danger @enderror"
                                       id="var_order"
                                       name="var_order"
                                       value="{{$variant_model['var_order']}}"
                                       autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="var_description" class="form-label">Mô tả</label>
                                <input type="text"
                                       class="form-control @error('var_description') border-danger @enderror"
                                       id="var_description"
                                       name="var_description"
                                       value="{{$variant_model['var_description']}}"
                                       autocomplete="off">

                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="var_require"
                                       name="var_require"
                                       value="Y"
                                    {{($variant_model['var_require'] == "Y" ? 'checked' : '')}}
                                >
                                <label class="form-check-label" for="var_require">Phải nhập</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="var_searchable"
                                       name="var_searchable"
                                       value="Y"
                                    {{($variant_model['var_searchable'] == "Y" ? 'checked' : '')}}
                                >
                                <label class="form-check-label" for="var_searchable">Có thể tìm</label>
                            </div>
                        </div>
                    </div>
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
            $('#variant-form').submit(function (event) {
                event.preventDefault();
                var var_name = $('input[name="var_name"]').val();
                var var_code = $('input[name="var_code"]').val();
                var var_type = $('select[name="var_type"]').val();
                if (!var_name || !var_code || !var_type) {
                    toastr.error('Nhập các dữ liệu bắt buộc', 'Lỗi');
                    return;
                }
                var fields = [
                    {name: 'var_id',  selector: 'input[name="var_id"]'},
                    {name: 'cat_id', selector: '#cat_id'},
                    {name: 'vg_id', selector: 'select[name="vg_id"]'},
                    {name: 'var_parent_id', selector: 'select[name="var_parent_id"]'},
                    {name: 'var_name', selector: 'input[name="var_name"]'},
                    {name: 'var_code', selector: 'input[name="var_code"]'},
                    {name: 'var_type', selector: 'select[name="var_type"]'},
                    {name: 'var_unit', selector: 'input[name="var_unit"]'},
                    {name: 'var_order', selector: 'input[name="var_order"]'},
                    {name: 'var_description', selector: 'input[name="var_description"]'},
                    {name: 'var_require', selector: '#var_require', type: 'checkbox'},
                    {name: 'var_searchable', selector: '#var_searchable', type: 'checkbox'},
                ];
                var formData = new FormData(this);
                fields.forEach(function (field) {
                    var value;
                    if (field.type === 'checkbox') {
                        value = $(field.selector).prop('checked');
                    } else {
                        value = $(field.selector).val();
                    }
                    formData.append(field.name, value);
                });
                $.ajax({
                    url: "{{ route('variant.edit') }}",
                    type: 'POST',
                    data: formData,
                    enctype: 'multipart/form-data',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    processData: false, // Không xử lý dữ liệu thành chuỗi query
                    contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
                    success: function (response) {
                        toastr.success(response.message, 'Thành công');
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

