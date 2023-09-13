@extends('backend.layout.layout')

@section('title')
    Thêm tài khoản
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
                <li class="breadcrumb-item active" aria-current="page">Thêm mới tài khoản</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Thông tin</h6>
                        <form id="Submit" class="forms-sample">
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Tên vai trò</label>
                                <input type="text" class="form-control" id="title" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="Nhập tên người dùng">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Mô tả</label>
                                <textarea class="form-control" placeholder="Leave a comment here" name="decs12" id="decs12"></textarea>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" id="StatusSelect" class="form-label">Trạng thái</label>
                              <select class="form-select" name="age_select" id="ageSelect">
                                <option value="1" selected>kích hoạt</option>
                                <option value="2">chưa kích hoạt</option>
                              </select>
                            </div>
                            </div>
                        </form>

                        <div class="btn-submit">
               
                          <button onclick="AddData()" type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>


                          <button class="btn btn-secondary">Hủy thay đổi</button>

                  </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script>
  var token = localStorage.getItem("Token");
   function AddData () {
        var title = $("#title").val();
        var desc = $("#decs12").val();
        var public = ''
        var selectedOptionValue = $('#ageSelect option:selected').val();
        if(selectedOptionValue == 1 || selectedOptionValue == "1") {
          public = 'active'
        }else{
          public = 'deactive'
        }
        if (title == "") {
          toastr.error('Bạn cần nhập tên', 'Lỗi');
        }else{
          $.ajax({
            url: "{{ route('permission.AddRole')}}",
            type: 'POST',
            data: {
                name: title,
                summary: desc,
                public:public
            },
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + token);
            },
            success: function(response) {
                toastr.success('Cập nhập thành công', 'thao tác');
                getData()
            },
            error: function(xhr, status, error) {
                var statusCode = xhr.status;
                switch (statusCode) {
                    case 401:
                        toastr.error('phiên đăng nhập đã hết hạn xin hãy đăng nhập và thử lại',
                            'Lỗi');
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
   }
 
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
@endsection

