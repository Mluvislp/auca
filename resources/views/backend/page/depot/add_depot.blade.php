@extends('backend.layout.layout')

@section('title')
Thêm mới kho hàng
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('depot') }}">Quản lý kho hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới kho hàng</li>
        </ol>
    </nav>
    <form method="post" id="depot-form">
        @csrf
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Thông tin</h6>
                        <form class="forms-sample">
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Tên kho hàng <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" id="colFormLabel" placeholder="Vui lòng nhập tên công ty">
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Địa chỉ <span class="text-danger">*</span> </label>
                                <input type="number" class="form-control" id="colFormLabel" placeholder="Vui lòng nhập mã số thuế">
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Số điện thoại <span class="text-danger">*</span> </label>
                                <input type="number" class="form-control" id="colFormLabel" placeholder="Vui lòng nhập số điện thoại">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <button id="btnSaveForm" type="submit" class="btn btn-success">
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
        $('#btnSaveForm').on('click', function(){
            var group_name = $('#group_name').val();
            var tax_code = $('#tax_code').val();
            var address = $('#address').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var description = $('#description').val();

            if(group_name ==  ''  || tax_code == '' || address == '' || group_name == '' || phone == '' || description == ''){
                alert('không được bỏ trống')
            } else {
                $.ajax({
                    url: "{{ route('group.check') }}",
                    type: 'POST',
                    data: {
                        group_name:group_name,
                        tax_code:tax_code,
                        address:address,
                        email:email,
                        phone:phone,
                        description:description
                    },
                    success:function(data){
                        alert('Insert dữ liệu thành công');
                    }
                    enctype: 'multipart/form-data',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    processData: false,
                    contentType: false,
    
                });
            }
        })
        
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