@extends('backend.layout.layout')

@section('title')
Sửa kho hàng
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('depot') }}">Quản lý kho hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sửa kho hàng</li>
        </ol>
    </nav>
    <form method="post">
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
                        <div class="btn-submit">
                            <a href="/">
                                <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </form>

</div>
@endsection

@section('script')

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