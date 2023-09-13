@extends('backend.layout.layout')

@section('title')
Thêm phiếu kiểm
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('check') }}">Kiểm kho</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới phiếu kiểm</li>
        </ol>
    </nav>
    <form action="{{ route('suppliers.store') }}" method="post">
        @csrf
        <div class="row">

            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group">
                            <i class="icon-lg pb-3px my-auto mx-2" data-feather="map-pin"></i>
                            <select class="form-select" id="status">
                                <option selected="">- Chọn kho hàng -</option>
                                <option value="1">shangyang132</option>
                                <option value="2">shangyang123</option>
                            </select>
                        </div>
                        <hr>
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Tìm sản phẩm</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Cân điện tử</a></li>
                                <li><a class="dropdown-item" href="#">Tìm IMEI</a></li>
                                <li><a class="dropdown-item" href="#">Bán theo ri</a></li>
                            </ul>
                            <input type="text" placeholder="Vui lòng nhập" class="form-control"
                                aria-label="Text input with dropdown button">
                        </div>
                        <div class="body-table">

                            <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1-line-tab" data-bs-toggle="tab" href="#tab1"
                                        role="tab" aria-controls="tab1" aria-selected="true">Tất cả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab2-line-tab" data-bs-toggle="tab" href="#tab2" role="tab"
                                        aria-controls="tab2" aria-selected="false">Khớp</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab3-line-tab" data-bs-toggle="tab" href="#tab3" role="tab"
                                        aria-controls="tab3" aria-selected="false">Thừa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab4-line-tab" data-bs-toggle="tab" href="#tab4" role="tab"
                                        aria-controls="tab4" aria-selected="false">Thiếu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab5-line-tab" data-bs-toggle="tab" href="#tab5" role="tab"
                                        aria-controls="tab5" aria-selected="false">Chưa kiểm</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3" id="lineTabContent">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                    aria-labelledby="tab1-line-tab">
                                    <div class="table-responsive overflow-hidden">
                                        <div id="dataTableExample_wrapper"
                                            class="dataTables_wrapper dt-bootstrap5 no-footer">
                                            <div class="row">
                                                <div class="col-sm-12 table-responsive">
                                                    <table id="dataTableExample"
                                                        class="table dataTable no-footer table-bordered"
                                                        aria-describedby="dataTableExample_info">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th class="sorting text-center text-black" tabindex="0"
                                                                    aria-controls="dataTableExample" rowspan="1"
                                                                    colspan="1">
                                                                    Sản phẩm
                                                                </th>
                                                                <th class="sorting text-center text-black" tabindex="0"
                                                                    aria-controls="dataTableExample" rowspan="1"
                                                                    colspan="1">
                                                                    Tồn kho
                                                                </th>
                                                                <th class="sorting text-center text-black" tabindex="0"
                                                                    aria-controls="dataTableExample" rowspan="1"
                                                                    colspan="1">
                                                                    <i class="icon-md text-black pb-3px"
                                                                    data-feather="truck"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Đang giao hàng"></i>
                                                                </th>
                                                                <th class="sorting text-center text-black sorting_asc"
                                                                    tabindex="0" aria-controls="dataTableExample"
                                                                    rowspan="1" colspan="1" aria-sort="ascending">
                                                                    <i class="icon-md text-black pb-3px"
                                                                    data-feather="home"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Tồn trong kho = Tồn kho - Đang chuyển"></i>
                                                                </th>
                                                                <th class="sorting text-center text-black" tabindex="0"
                                                                    aria-controls="dataTableExample" rowspan="1"
                                                                    colspan="1">
                                                                    <i class="icon-md text-black pb-3px"
                                                                    data-feather="archive"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Tạm giữ"></i>
                                                                </th>
                                                                <th class="sorting text-center text-black" tabindex="0"
                                                                    aria-controls="dataTableExample" rowspan="1"
                                                                    colspan="1">
                                                                    Thực tế
                                                                </th>
                                                                <th class="sorting text-center text-black" tabindex="0"
                                                                    aria-controls="dataTableExample" rowspan="1"
                                                                    colspan="1">
                                                                    SL lệch
                                                                </th>
                                                                <th class="sorting text-center text-black" tabindex="0"
                                                                    aria-controls="dataTableExample" rowspan="1"
                                                                    colspan="1">
                                                                    Giá trị lệch
                                                                </th>
                                                                <th class="sorting text-center text-black" tabindex="0"
                                                                    aria-controls="dataTableExample" rowspan="1"
                                                                    colspan="1">
                                                                    <i class="icon-lg text-black pb-3px"
                                                                        data-feather="settings"></i>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <p>Hộp đựng kính áp tròng/lens mắt kèm gương hình thú hoạt hình dễ thương - Ngẫu nhiên</p>
                                                                </td>
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">Null</td>
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">
                                                                    <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                                                                </td>
                                                                <td class="text-center">
                                                                    <p class="text-danger">-899</p>
                                                                </td>
                                                                <td class="text-center">
                                                                    <p>766.000</p>
                                                                </td>
                                                                <td class="text-center">
                                                                    <span class="dropdown-toggle cursor-pointer"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="icon-lg pb-3px"
                                                                            data-feather="menu"></i>
                                                                    </span>
                                                                    <ul class="dropdown-menu">
                                                                        <li>
                                                                            <a class="dropdown-item fs-5" href="#">
                                                                                <i class="icon-lg pb-3px"
                                                                                    data-feather="refresh-ccw"></i>
                                                                                Tính lại tồn sản phẩm
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item fs-5 text-danger"
                                                                                href="#">
                                                                                <i class="icon-lg text-danger pb-3px"
                                                                                    data-feather="trash-2"></i>
                                                                                Xóa
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-line-tab">2
                                </div>
                                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-line-tab">3
                                </div>
                                <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-line-tab">4
                                </div>
                                <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-line-tab">5
                                </div>
                            </div>

                        </div><br>

                        <div class="btn-submit">
                            <a href="/">
                                <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="heading">
                            <h6 class="card-title">Thông tin</h6>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <p>
                                            ID phiếu kiểm kho:
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p>
                                            Tổng số lượng thực tế
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p>
                                            Tổng số lượng thừa
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p>
                                            Tổng số lượng thiếu
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p>
                                            Tổng số lượng chênh lệch
                                        </p>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <div class="mb-3">
                                        <a href="#">
                                            985190
                                        </a>
                                    </div>
                                    <div class="mb-3">
                                        <b>
                                            1
                                        </b>
                                    </div>
                                    <div class="mb-3">
                                        <p class="text-success">
                                            0
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p class="text-danger">
                                            899
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p class="text-danger">
                                            899
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="card p-0">
                    <div class="card-body">
                        <h6 class="card-title">Ghi chú</h6>
                        <hr>
                        <div class="mb-3">
                            <textarea id="maxlength-textarea" class="form-control" maxlength="100" rows="8"
                                placeholder="Vui lòng nhập"></textarea>
                        </div>
                    </div>
                </div>

                <br>

                <div class="card p-0">
                    <div class="card-body">
                        <h6 class="card-title">Kiểm gần đây</h6>
                        <hr>
                        <div class="mb-3">
                            <div class="alert alert-primary" role="alert">
                                <p><i class="icon-lg pb-3px" data-feather="plus"></i><b>1</b> KEM ĐÁNH RĂNG MUỐI HỒNG
                                    HIMALAYA BẠC HÀ - A20 </p>
                            </div>
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