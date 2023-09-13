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
                <li class="breadcrumb-item active" aria-current="page">Sửa thuộc tính</li>
            </ol>
        </nav>
        <form id = "variant-group-form" class="forms-sample" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="vg_name" class="form-label">Tên nhóm thuộc tính<span class="text-danger"> *</span></label>
                                <input type="hidden" name="vg_id" value="{{$variant_group ? $variant_group['vg_id'] : ''}}">
                                <input type="text"
                                       class="form-control"
                                       id="vg_name"
                                       name="vg_name"
                                       value="{{$variant_group ? $variant_group['vg_name'] : ''}}"
                                       autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="vg_order" class="form-label">Thứ tự</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{$variant_group ? $variant_group['vg_order'] : ''}}"
                                       id="vg_order"
                                       name="vg_order"
                                       autocomplete="off">
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
            $('#variant-group-form').submit(function (event) {
                event.preventDefault();
                var vg_id = $('input[name="vg_id"]').val();
                var vg_name = $('input[name="vg_name"]').val();
                var vg_order = $('input[name="vg_order"]').val();
                if (!vg_name) {
                    toastr.error('Kiểm tra lại dữ liệu của bạn', 'Lỗi');
                } else {
                    var formData = new FormData(this);
                    formData.append('vg_id', vg_id);
                    formData.append('vg_name', vg_name);
                    formData.append('vg_order', vg_order);
                    $.ajax({
                        url: "{{ route('variantgroup.edit') }}",
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
                }
            });
        });
    </script>
@endsection

