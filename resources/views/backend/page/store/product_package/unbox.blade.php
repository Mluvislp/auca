@extends('backend.layout.layout')

@section('title')
Bung gói sản phẩm
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bung gói sản phẩm</li>
        </ol>
    </nav>
    <form action="{{ route('suppliers.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Thông tin</h6>
                        <form class="forms-sample">
                            <div class="mb-3">
                                <label class="form-label">Kho hàng</label>
                                <select class="form-select mb-3">
                                    <option selected="">- Kho hàng -</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Ghi chú</label>
                                <textarea class="form-control" name="sup_note" cols="30" rows="10"
                                    placeholder="Vui lòng nhập">{{ old('sup_note') }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="body-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Mã SP</th>
                            <th scope="col">Tên SP</th>
                            <th scope="col">
                                <i class="icon-lg pb-3px" data-feather="image"></i>
                            </th>
                            <th scope="col">SL</th>
                            <th scope="col">Tồn</th>
                            <th scope="col">Giá vốn</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">
                                <i class="icon-lg pb-3px" data-feather="settings"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center">A02.A05.5A10</th>
                            <td class="text-left">Liệu trình hộp 7 ngày than tre + kem đánh răng than tre tặng 5 gói súc
                                miệng</td>
                            <td class="text-center">Null</td>
                            <td class="text-center">
                                <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                            </td>
                            <td class="text-center">498</td>
                            <td class="text-center">
                                <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                            </td>
                            <td class="text-center">199.000</td>
                            <td class="text-center">
                                <a href="#">
                                    <i class="icon-lg pb-3px text-danger" data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><br>

            <div class="mb-3">
                <label class="form-label">Sau khi lưu dữ liệu: </label>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="gender_radio" id="gender1">
                        <label class="form-check-label" for="gender1">
                            Xem danh sách gói
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="gender_radio" id="gender2">
                        <label class="form-check-label" for="gender2">
                            Tiếp tục bung gói
                        </label>
                    </div>
                </div>
            </div>

            <div class="btn-submit">
                <a href="/">
                    <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
                </a>
            </div>

        </div>
    </div>

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