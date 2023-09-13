@extends('backend.layout.layout')

@section('title')
    Quản lý công ty
@endsection

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quản lý công ty</li>
            </ol>
        </nav>
        <div id="errorList" style="display: none;" class="alert alert-danger">
            <ul id="errorMessages"></ul>
        </div>
        <form id="company-form">
            @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Thông tin</h6>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Tên công ty <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="group_name" name='group_name' value="{{$group->group_name}}"
                                    placeholder="Vui lòng nhập tên công ty">
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Mã số thuế <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" id="tax_code" name="tax_code" value="{{$group->tax_code}}"
                                    placeholder="Vui lòng nhập mã số thuế">
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$group->address}}"
                                    placeholder="Vui lòng nhập địa chỉ">
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{$group->email}}"
                                    placeholder="Vui lòng nhập email">
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Số điện thoại</label>
                                <input type="number" class="form-control" id="phone" name="phone" value="{{$group->phone}}"
                                    placeholder="Vui lòng nhập số điện thoại">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Bổ xung</h6>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Ghi chú</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Vui lòng nhập">{{$group->description}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <button id="btnSaveForm" class="btn btn-success">
                                    Lưu thay đổi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var token = localStorage.getItem("Token");

        $(document).ready(function() {
            $('#btnSaveForm').on('click', function(e) {
                e.preventDefault();

                if (!validateForm()) {
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('store_company') }}",
                    data: $("#company-form").serialize(),
                    success: function(data) {
                        if (data.status === 1) {
                            alert('Cập nhật dữ liệu thành công')
                            location.reload()
                        }
                        
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        var errorList = $("#errorList");
                        var errorMessages = $("#errorMessages");
                        
                        errorMessages.empty(); // Clear any previous errors
                        
                        var errors = xhr.responseJSON.errors;
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var errorMessagesList = errors[key];
                                for (var i = 0; i < errorMessagesList.length; i++) {
                                    var errorMessage = errorMessagesList[i];
                                    var listItem = "<li>" + errorMessage + "</li>";
                                    errorMessages.append(listItem);
                                }
                            }
                        }
                        errorList.show();
                        $("html, body").animate({ scrollTop: 0 }, 500);
                    }
                });
            })

            function validateForm() {
                var isValid = true;
                var group_name = $('#group_name').val();
                var tax_code = $('#tax_code').val();
                if (group_name === '' || tax_code === '') {
                    alert('không được bỏ trống');
                    isValid = false;
                }

                return isValid;
            }

        });
    </script>

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        </script>
    @endif

    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>

@endsection
