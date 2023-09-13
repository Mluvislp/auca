@extends('backend.layout.layout')

@section('title')
Thêm mới gói sản phẩm
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới gói sản phẩm</li>
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
                                <label for="colFormLabel" class="form-label">Tên gói</label>
                                <input type="text" class="form-control" id="colFormLabel" placeholder="Vui lòng nhập">
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Mã gói</label>
                                <input type="text" class="form-control" id="colFormLabel" placeholder="Vui lòng nhập">
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

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card w-100 p-0">
                    <div class="card-body">
                        <h6 class="card-title">Thanh toán</h6>
                        <div class="mb-3">
                            <label for="colFormLabel" class="form-label">Số lượng gói</label>
                            <input type="text" class="form-control" id="colFormLabel" placeholder="Vui lòng nhập">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select mb-3">
                                <option selected="">- Danh mục -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="colFormLabel" class="form-label">Giá nhập</label>
                            <input type="number" class="form-control" id="exampleInputMobile"
                                placeholder="Vui lòng nhập">
                        </div>
                        <div class="mb-3">
                            <label for="colFormLabel" class="form-label">Giá bán</label>
                            <input type="number" class="form-control" id="exampleInputMobile"
                                placeholder="Vui lòng nhập">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="input-group mb-3">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">Sản phẩm</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Nhập theo ri</a></li>
                </ul>
                <input type="text" class="form-control" aria-label="Text input with dropdown button">
            </div>
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
                        <tr>
                            <td class="text-center" colspan="3"><b>Tổng cộng</b></td>
                            <td class="text-center">1</td>
                            <td class="text-center"><b>498</b></td>
                            <td class="text-center"><b>199.000</b></td>
                            <td colspan="2"></td>
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
                            Tiếp tục thêm
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