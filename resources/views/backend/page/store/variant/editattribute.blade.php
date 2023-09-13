@extends('backend.layout.layout')

@section('title')
Giá trị thuộc tính
@endsection

@section('style')

@endsection

@section('content')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Bảng điều khiển</a></li>
      <li class="breadcrumb-item"><a href="<?= Route('variant') ?>">Thuộc tính</a></li>
      <li class="breadcrumb-item active" aria-current="page"><a href="<?= Route('variant-value').'?variant='.$variant_id ?>">Giá trị thuộc tính</a></li>
      <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
    </ol>
  </nav>
  <form class="forms-sample" id="variant_value_form" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card card-general-input col-12">
          <div class="col-12 col-lg-6">
            <div class="card-body">
              <input type="hidden" name="attributeId" id="attributeId">
              <div class="form-group mb-2 row">
                <label class="col-lg-4">Giá trị cha:</label>
                <div class="col-lg-8">
                  <select id="vv_parent_id" style="width: 100%" class="form-control" name="vv_parent_id">
                      <option value="">Chọn</option>
                    {{printVariantValue($variant_value , 0 ,$variant_value_model['vv_parent_id'])}}
                  </select>
                </div>
              </div>
              <div class="form-group mb-2 row">
                <label class="col-lg-4">Tên thuộc tính:<span class="text-danger">*</span></label>
                <div class="col-lg-8">
                  <input type="text" name="vv_name" maxlength="255" id="vv_name" autocomplete="off" class="form-control"
                    value="{{$variant_value_model['vv_name']}}">
                  <div class="error"></div>
                </div>
              </div>
              <div class="form-group mb-2 row">
                <label class="col-lg-4">Giá trị:</label>
                <div class="col-lg-8">
                  <input type="text" name="vv_value" id="vv_value" autocomplete="off" class="form-control" value="{{$variant_value_model['vv_value']}}">
                  <div class="error"></div>
                </div>
              </div>
              <div class="form-group mb-2 row">
                <label class="col-lg-4">Tên khác:</label>
                <div class="col-lg-8">
                  <input type="text" name="vv_other_name" id="vv_other_name" autocomplete="off" class="form-control" value="{{$variant_value_model['vv_other_name']}}">
                  <div class="error"></div>
                </div>
              </div>
              <div class="form-group mb-2 row">
                <label class="col-lg-4">Mã:</label>
                <div class="col-lg-8">
                  <input type="text" name="vv_code" id="vv_code" autocomplete="off" class="form-control" value="{{$variant_value_model['vv_code']}}">
                  <div class="error"></div>
                </div>
              </div>
              <div class="form-group mb-2 row">
                <label class="col-lg-4">Mã khác:</label>
                <div class="col-lg-8">
                  <input type="text" name="vv_other_code" id="vv_other_code" autocomplete="off" class="form-control" value="{{$variant_value_model['vv_other_code']}}">
                  <div class="error"></div>
                </div>
              </div>
              <div class="form-group mb-2 row">
                <label class="col-lg-4">Đơn vị:</label>
                <div class="col-lg-8">
                  <input type="text" name="vv_unit" id="vv_unit" autocomplete="off" class="form-control" value="{{$variant_value_model['vv_unit']}}">
                  <div class="error"></div>
                </div>
              </div>
              <div class="form-group mb-2 row">
                <label class="col-lg-4">Thứ tự:</label>
                <div class="col-lg-8">
                  <input type="text" name="vv_order" id="vv_order" autocomplete="off" class="form-control" value="{{$variant_value_model['vv_order']}}">
                  <div class="error"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-submit">
        <a>
          <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
        </a>
      </div>
    </div>
  </form>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $("#vv_parent_id").select2({
        allowClear: true,
    });
    var token = localStorage.getItem("Token");
    $(document).ready(function () {
        var var_id = {{$variant_id}};
        var vv_id = {{$variant_value_id}};
        $('#variant_value_form').submit(function (event) {
            event.preventDefault();
            var vv_name = $('input[name="vv_name"]').val();
            var holdform = $('input[name="holdform"]').filter(':checked').val();
            if (!vv_name || !vv_id) {
                toastr.error('Nhập các dữ liệu bắt buộc', 'Lỗi');
                return;
            }
            var fields = [
                {name: 'vv_name', selector: 'input[name="vv_name"]'},
                {name: 'vv_parent_id', selector: 'select[name="vv_parent_id"]'},
                {name: 'vv_value', selector: 'input[name="vv_value"]'},
                {name: 'vv_other_name', selector: 'input[name="vv_other_name"]'},
                {name: 'vv_code', selector: 'input[name="vv_code"]'},
                {name: 'vv_other_code', selector: 'input[name="vv_other_code"]'},
                {name: 'vv_unit', selector: 'input[name="vv_unit"]'},
                {name: 'vv_order', selector: 'input[name="vv_order"]'},
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
            formData.append('var_id' ,var_id );
            formData.append('vv_id' ,vv_id );
            $.ajax({
                url: "{{ route('variantvalue.edit') }}",
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
                    setTimeout(function() {
                        window.location.href = "{{ route('variant-value').'?variant='.$variant_id}}";
                    }, 900);
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
