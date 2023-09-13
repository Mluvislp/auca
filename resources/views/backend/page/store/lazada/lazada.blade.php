@extends('backend.layout.layout')

@section('title')
    Sản phẩm lazada
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
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Bảng điều khiển</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Quản lý sản phẩm</li>
                <li class="breadcrumb-item active" aria-current="page">Sàn TMDT</li>
                <li class="breadcrumb-item active" aria-current="page">Lazada</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Bộ lọc</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sell-price-line-tab" data-bs-toggle="tab" href="#fixSellPrice"
                            role="tab" aria-controls="fixSellPrice" aria-selected="false">Sản phẩm đã ghép</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="buy-price-line-tab" data-bs-toggle="tab" href="#fixBuyPrice" role="tab"
                            aria-controls="fixBuyPrice" aria-selected="false">Sản phẩm chưa ghép</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="history-line-tab" data-bs-toggle="tab" href="#history" role="tab"
                            aria-controls="history" aria-selected="false">Sản phẩm chưa tạo sang Lazada</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">

                            <!-- Start Filter content -->
                            <div class="filter">
                                <div class="row mb-3">

                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <select class="form-select" aria-label="multiple select example"
                                                    name="filter_var_vg_id[]" id="filter_var_vg_id" multiple
                                                    multiselect-search="true" multiselect-select-all="true"
                                                    multiselect-max-items="1">
                                                    <option value="hihi">Chọn Seller</option>
                                                    <option value="asd">LAZADA AINI STORE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-3 col-lg-1 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255" placeholder="SKU"
                                                    id="var_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255"
                                                    placeholder="Sản phẩm (Lazada)" id="var_id" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-1 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255" placeholder="ID"
                                                    id="var_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255"
                                                    placeholder="Sản phẩm (Hệ thống)" id="var_id" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 pt-3">
                                        <!-- Example split danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Lọc</button>
                                            <button type="button"
                                                class="btn btn-success dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="collapse" data-bs-target="#filter-advanced-elements"
                                                aria-expanded="false" aria-controls="filter-advanced-elements">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse row m-0 col-12 pl-0 pr-0 mt-3 mb-3" id="filter-advanced-elements">

                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-4 pl-0 pr-0">Danh mục</label>
                                            <div class="col col-sm-8 pr-0">
                                                <select name="inventory" id="inventory" class="form-control"
                                                    aria-label="multiple select example" name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="1">
                                                    <option value="otp1">Danh mục</option>
                                                    <option value="otp2">Chưa gắn danh mục</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-4 pl-0 pr-0">Trạng thái đồng bộ
                                                tồn</label>
                                            <div class="col col-sm-8 pr-0">
                                                <select name="inventory" id="inventory" class="form-control"
                                                    aria-label="multiple select example" name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="1">
                                                    <option value="otp1">Lỗi</option>
                                                    <option value="otp2">Thành công</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-4 pl-0 pr-0">Trạng thái sản
                                                phẩm</label>
                                            <div class="col col-sm-8 pr-0">
                                                <select name="inventory" id="inventory" class="form-control"
                                                    aria-label="multiple select example" name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="1">
                                                    <option value="otp1">Hoạt động</option>
                                                    <option value="otp2">Không hoạt động</option>
                                                    <option value="otp3">Đã xóa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3 d-flex align-items-center gap-2">
                                    <div>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Đồng bộ
                                            <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="download"></i>
                                                    Tải sản phẩm từ Lazada
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="upload"></i>
                                                    Đồng bộ tổn kho sang Lazada
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="icon-lg pb-3px" data-feather="settings"></i>
                                            Thao tác
                                            <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                                                    Xuất Excel
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger fs-5" href="#">
                                                    <i class="icon-lg text-danger pb-3px" data-feather="trash"></i>
                                                    Xóa các sản phẩm lấy về đã chọn
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="repeat"></i>
                                                    Đổi trạng thái các sản phẩm đã chọn
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger fs-5" href="#">
                                                    <i class="icon-lg text-danger pb-3px" data-feather="zap-off"></i>
                                                    Hủy liên kết các sản phẩm
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <!-- End filter content -->

                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table class="table dataTable no-footer table-bordered"
                                                aria-describedby="dataTableExample_info">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            STT
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            SKU (Lazada)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Sản phẩm (Lazada)
                                                        </th>
                                                        <th class="sorting text-center text-black sorting_asc"
                                                            tabindex="0" aria-controls="dataTableExample"
                                                            rowspan="1" colspan="1" aria-sort="ascending">
                                                            Giá bán (Lazada)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            SL
                                                            <i class="icon-md text-primary pb-3px"
                                                                data-feather="help-circle" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Số lượng ghép nối giữa Nhanh.vn và sàn, VD sản phẩm A trên sàn ghép với 1 sản phẩm A trên Nhanh, Combo sản phẩm A ghép với 2 sản phẩm A trên Nhanh"></i>
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Sản phẩm (AUCA)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Giá bán (AUCA)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Tồn
                                                            <i class="icon-md text-primary pb-3px"
                                                                data-feather="help-circle" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Số tồn có thể bán đồng bộ sang sàn"></i>
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Trạng thái
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            <i class="icon-lg text-black pb-3px"
                                                                data-feather="settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="dataRow">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="fixSellPrice" role="tabpanel" aria-labelledby="sell-price-line-tab">
                        <div class="card-body p-0 pt-2">

                            <!-- Start Filter content -->
                            <div class="filter">
                                <div class="row mb-3">

                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <select class="form-select" aria-label="multiple select example"
                                                    name="filter_var_vg_id[]" id="filter_var_vg_id" multiple
                                                    multiselect-search="true" multiselect-select-all="true"
                                                    multiselect-max-items="1">
                                                    <option value="hihi">Chọn Seller</option>
                                                    <option value="asd">LAZADA AINI STORE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-3 col-lg-1 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255" placeholder="SKU"
                                                    id="var_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255"
                                                    placeholder="Sản phẩm (Lazada)" id="var_id" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-1 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255" placeholder="ID"
                                                    id="var_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255"
                                                    placeholder="Sản phẩm (Nhanh)" id="var_id" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 pt-3">
                                        <!-- Example split danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Lọc</button>
                                            <button type="button"
                                                class="btn btn-success dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="collapse" data-bs-target="#filter-advanced-elements"
                                                aria-expanded="false" aria-controls="filter-advanced-elements">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse row m-0 col-12 pl-0 pr-0 mt-3 mb-3" id="filter-advanced-elements">

                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-4 pl-0 pr-0">Danh mục</label>
                                            <div class="col col-sm-8 pr-0">
                                                <select name="inventory" id="inventory" class="form-control"
                                                    aria-label="multiple select example" name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="1">
                                                    <option value="otp1">Danh mục</option>
                                                    <option value="otp2">Chưa gắn danh mục</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-4 pl-0 pr-0">Trạng thái đồng bộ
                                                tồn</label>
                                            <div class="col col-sm-8 pr-0">
                                                <select name="inventory" id="inventory" class="form-control"
                                                    aria-label="multiple select example" name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="1">
                                                    <option value="otp1">Lỗi</option>
                                                    <option value="otp2">Thành công</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-4 pl-0 pr-0">Trạng thái sản
                                                phẩm</label>
                                            <div class="col col-sm-8 pr-0">
                                                <select name="inventory" id="inventory" class="form-control"
                                                    aria-label="multiple select example" name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="1">
                                                    <option value="otp1">Hoạt động</option>
                                                    <option value="otp2">Không hoạt động</option>
                                                    <option value="otp3">Đã xóa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3 d-flex align-items-center gap-2">
                                    <div>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Đồng bộ
                                            <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="download"></i>
                                                    Tải sản phẩm từ Lazada
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="upload"></i>
                                                    Đồng bộ tổn kho sang Lazada
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="icon-lg pb-3px" data-feather="settings"></i>
                                            Thao tác
                                            <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                                                    Xuất Excel
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger fs-5" href="#">
                                                    <i class="icon-lg text-danger pb-3px" data-feather="trash"></i>
                                                    Xóa các sản phẩm lấy về đã chọn
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="repeat"></i>
                                                    Đổi trạng thái các sản phẩm đã chọn
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger fs-5" href="#">
                                                    <i class="icon-lg text-danger pb-3px" data-feather="zap-off"></i>
                                                    Hủy liên kết các sản phẩm
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <!-- End filter content -->

                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableExampleHero_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="dataTableExampleHero"
                                                class="table dataTable no-footer table-bordered"
                                                aria-describedby="dataTableExampleHero_info">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            ID
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            SKU (Lazada)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            Sản phẩm (Lazada)
                                                        </th>
                                                        <th class="sorting text-center text-black sorting_asc"
                                                            tabindex="0" aria-controls="dataTableExampleHero"
                                                            rowspan="1" colspan="1" aria-sort="ascending">
                                                            Giá bán (Lazada)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            SL
                                                            <i class="icon-md text-primary pb-3px"
                                                                data-feather="help-circle" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Số lượng ghép nối giữa Nhanh.vn và sàn, VD sản phẩm A trên sàn ghép với 1 sản phẩm A trên Nhanh, Combo sản phẩm A ghép với 2 sản phẩm A trên Nhanh"></i>
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            Sản phẩm (AUCA)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            Giá bán (AUCA)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            Tồn
                                                            <i class="icon-md text-primary pb-3px"
                                                                data-feather="help-circle" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Số tồn có thể bán đồng bộ sang sàn"></i>
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            Trạng thái
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            <i class="icon-lg text-black pb-3px"
                                                                data-feather="settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td class="text-start"> 3A02 <br> <b>(Lazada AINI STORE)</b></td>
                                                        <td class="text-start">Liệu trình miếng dán trắng răng Anriea 21
                                                            ngày trắng sáng - Chính hãng 3A02</td>
                                                        <td class="text-center">1.050.000</td>
                                                        <td class="text-center">1</td>
                                                        <td class="text-left">(3A02) <br> <a href="#">Liệu trình 21
                                                                ngày miếng dán trắng răng than tre 3A02</a> </td>
                                                        <td class="text-center">Null</td>
                                                        <td class="text-center"><a href="#">1.381.226</a></td>
                                                        <td class="text-center">
                                                            <div
                                                                class="form-check form-switch d-flex justify-content-center align-items-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="flexSwitchCheckDefault">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="dropdown-toggle cursor-pointer"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="icon-lg pb-3px" data-feather="menu"></i>
                                                            </span>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item fs-5" href="#">
                                                                        <i class="icon-lg pb-3px" data-feather="edit"></i>
                                                                        Sửa SKU
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item fs-5" href="#">
                                                                        <i class="icon-lg pb-3px"
                                                                            data-feather="upload"></i>
                                                                        Đồng bộ tồn kho sang Lazada
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item fs-5 text-danger"
                                                                        href="#">
                                                                        <i class="icon-lg text-danger pb-3px"
                                                                            data-feather="trash-2"></i>
                                                                        Xóa sản phẩm lấy về
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item fs-5" href="#">
                                                                        <i class="icon-lg pb-3px"
                                                                            data-feather="x-circle"></i>
                                                                        Hủy liên kết
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
                    </div>
                    <div class="tab-pane fade" id="fixBuyPrice" role="tabpanel" aria-labelledby="buy-price-line-tab">
                        <div class="card-body p-0 pt-2">

                            <!-- Start Filter content -->
                            <div class="filter">
                                <div class="row mb-3">
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <select class="form-select" aria-label="multiple select example"
                                                    name="filter_var_vg_id[]" id="filter_var_vg_id" multiple
                                                    multiselect-search="true" multiselect-select-all="true"
                                                    multiselect-max-items="1">
                                                    <option value="hihi">Chọn Seller</option>
                                                    <option value="asd">LAZADA AINI STORE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-1 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255" placeholder="SKU"
                                                    id="var_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255"
                                                    placeholder="Sản phẩm (Lazada)" id="var_id" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-1 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255" placeholder="ID"
                                                    id="var_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255"
                                                    placeholder="Sản phẩm (Nhanh)" id="var_id" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 pt-3">
                                        <!-- Example split danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Lọc</button>
                                            <button type="button"
                                                class="btn btn-success dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="collapse" data-bs-target="#filter-advanced-elements"
                                                aria-expanded="false" aria-controls="filter-advanced-elements">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse row m-0 col-12 pl-0 pr-0 mt-3 mb-3" id="filter-advanced-elements">

                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-4 pl-0 pr-0">Trạng thái đồng bộ
                                                tồn</label>
                                            <div class="col col-sm-8 pr-0">
                                                <select name="inventory" id="inventory" class="form-control"
                                                    aria-label="multiple select example" name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="1">
                                                    <option value="otp1">Lỗi</option>
                                                    <option value="otp2">Thành công</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-4 pl-0 pr-0">Trạng thái sản
                                                phẩm</label>
                                            <div class="col col-sm-8 pr-0">
                                                <select name="inventory" id="inventory" class="form-control"
                                                    aria-label="multiple select example" name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="1">
                                                    <option value="otp1">Hoạt động</option>
                                                    <option value="otp2">Không hoạt động</option>
                                                    <option value="otp3">Đã xóa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3 d-flex align-items-center gap-2">
                                    <div>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Đồng bộ
                                            <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="download"></i>
                                                    Tải sản phẩm từ Lazada
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="upload"></i>
                                                    Đồng bộ tổn kho sang Lazada
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="icon-lg pb-3px" data-feather="settings"></i>
                                            Thao tác
                                            <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                                                    Xuất Excel
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger fs-5" href="#">
                                                    <i class="icon-lg text-danger pb-3px" data-feather="trash"></i>
                                                    Xóa các sản phẩm lấy về đã chọn
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="repeat"></i>
                                                    Đổi trạng thái các sản phẩm đã chọn
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger fs-5" href="#">
                                                    <i class="icon-lg text-danger pb-3px" data-feather="zap-off"></i>
                                                    Hủy liên kết các sản phẩm
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <!-- End filter content -->

                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableExampleV2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="dataTableExampleV2"
                                                class="table dataTable no-footer table-bordered"
                                                aria-describedby="dataTableExampleV2_info">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sorting text-center" tabindex="0"
                                                            aria-controls="dataTableExampleV2" rowspan="1"
                                                            colspan="1">
                                                            STT
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV2" rowspan="1"
                                                            colspan="1">
                                                            SKU (Lazada)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV2" rowspan="1"
                                                            colspan="1">
                                                            Sản phẩm (Lazada)
                                                        </th>
                                                        <th class="sorting text-center text-black sorting_asc"
                                                            tabindex="0" aria-controls="dataTableExampleV2"
                                                            rowspan="1" colspan="1" aria-sort="ascending">
                                                            Giá bán (Lazada)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV2" rowspan="1"
                                                            colspan="1">
                                                            SL
                                                            <i class="icon-md text-primary pb-3px"
                                                                data-feather="help-circle" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Số lượng ghép nối giữa Nhanh.vn và sàn, VD sản phẩm A trên sàn ghép với 1 sản phẩm A trên Nhanh, Combo sản phẩm A ghép với 2 sản phẩm A trên Nhanh"></i>
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV2" rowspan="1"
                                                            colspan="1">
                                                            Sản phẩm (AUCA)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV2" rowspan="1"
                                                            colspan="1">
                                                            Giá bán (AUCA)
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV2" rowspan="1"
                                                            colspan="1">
                                                            Tồn
                                                            <i class="icon-md text-primary pb-3px"
                                                                data-feather="help-circle" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Số tồn có thể bán đồng bộ sang sàn"></i>
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV2" rowspan="1"
                                                            colspan="1">
                                                            Trạng thái
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV2" rowspan="1"
                                                            colspan="1">
                                                            <i class="icon-lg text-black pb-3px"
                                                                data-feather="settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="dataRow">
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td class="text-start"> A20 17090855576 <br><b>(YOU&ME)</b></td>
                                                        <td class="text-start">Kem Đánh Răng Muối Hồng Himalaya Bạc Hà
                                                            (100ml) - Chính Hãng A20</td>
                                                        <td class="text-center">169.000</td>
                                                        <td class="text-center">
                                                            <input type="number" max="99999" min="0"
                                                                value="1" class="form-control" data-id="6">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text" max="99999" min="0"
                                                                class="form-control" data-id="6">
                                                        </td>
                                                        <td class="text-center">Null</td>
                                                        <td class="text-center">
                                                            <a href="#">1</a>
                                                        </td>
                                                        <td class="text-center">
                                                            <div
                                                                class="form-check form-switch d-flex justify-content-center align-items-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="flexSwitchCheckDefault">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="dropdown-toggle cursor-pointer"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="icon-lg pb-3px" data-feather="menu"></i>
                                                            </span>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item fs-5" href="#">
                                                                        <i class="icon-lg pb-3px" data-feather="edit"></i>
                                                                        Sửa sku
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item fs-5 text-danger"
                                                                        href="#">
                                                                        <i class="icon-lg text-danger pb-3px"
                                                                            data-feather="trash-2"></i>
                                                                        Xóa sản phẩm lấy về
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
                    </div>
                    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-line-tab">
                        <div class="card-body p-0 pt-2">
                            <!-- Start Filter content -->
                            <div class="filter">
                                <div class="row mb-3">
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <select class="form-select" aria-label="multiple select example"
                                                    name="filter_var_vg_id[]" id="filter_var_vg_id" multiple
                                                    multiselect-search="true" multiselect-select-all="true"
                                                    multiselect-max-items="1">
                                                    <option value="hihi">Chọn Seller</option>
                                                    <option value="asd">LAZADA AINI STORE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-1 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255" placeholder="SKU"
                                                    id="var_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255"
                                                    placeholder="Sản phẩm (Lazada)" id="var_id" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-1 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255" placeholder="ID"
                                                    id="var_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="var_id" maxlength="255"
                                                    placeholder="Sản phẩm (Nhanh)" id="var_id" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 pt-3">
                                        <!-- Example split danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Lọc</button>
                                            <button type="button"
                                                class="btn btn-success dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="collapse" data-bs-target="#filter-advanced-elements"
                                                aria-expanded="false" aria-controls="filter-advanced-elements">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse row m-0 col-12 pl-0 pr-0 mt-3 mb-3" id="filter-advanced-elements">

                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-4 pl-0 pr-0">Danh mục</label>
                                            <div class="col col-sm-8 pr-0">
                                                <select name="inventory" id="inventory" class="form-control"
                                                    aria-label="multiple select example" name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="1">
                                                    <option value="otp1">Danh mục</option>
                                                    <option value="otp2">Chưa gắn danh mục</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-4 pl-0 pr-0">Trạng thái sản
                                                phẩm</label>
                                            <div class="col col-sm-8 pr-0">
                                                <select name="inventory" id="inventory" class="form-control"
                                                    aria-label="multiple select example" name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="1">
                                                    <option value="otp1">Hoạt động</option>
                                                    <option value="otp2">Không hoạt động</option>
                                                    <option value="otp3">Đã xóa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 d-flex align-items-center gap-2">
                                    <div>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="icon-lg pb-3px" data-feather="settings"></i>
                                            Thao tác
                                            <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                                                    Xuất Excel
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <!-- End filter content -->

                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableExampleV3_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="dataTableExampleV3"
                                                class="table dataTable no-footer table-bordered"
                                                aria-describedby="dataTableExampleV3_info">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV3" rowspan="1"
                                                            colspan="1">
                                                            ID
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV3" rowspan="1"
                                                            colspan="1">
                                                            <i class="icon-md pb-3px" data-feather="image"></i>
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV3" rowspan="1"
                                                            colspan="1">
                                                            Mã sp
                                                        </th>
                                                        <th class="sorting text-center text-black sorting_asc"
                                                            tabindex="0" aria-controls="dataTableExampleV3"
                                                            rowspan="1" colspan="1" aria-sort="ascending">
                                                            Tên sp
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV3" rowspan="1"
                                                            colspan="1">
                                                            Giá bán
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExampleV3" rowspan="1"
                                                            colspan="1">
                                                            Tồn
                                                            <i class="icon-md text-primary pb-3px"
                                                                data-feather="help-circle" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Số tồn có thể bán đồng bộ sang sàn"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><a href="">39044887</a></td>
                                                        <td class="text-center">Null</td>
                                                        <td class="text-start">KSM80.0077.KSM80.0411</td>
                                                        <td class="text-start">1 kẻ mắt trắng + 1 kẻ mắt hồng</td>
                                                        <td class="text-end">1.400</td>
                                                        <td class="text-end"><a href="">700</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <script type="text/javascript">
        const appSecret = "8yKAGKZRvrDvJ1DkGI1cMnEtmEjKvJfL"; // Thay YOUR_APP_SECRET bằng mật khẩu ứng dụng của bạn
        var token = localStorage.getItem("Token_lazada");
        const signRequest = (appSecret, apiPath, params) => {
            // 1. Sort all request parameters (except the “sign” and parameters with byte array type)
            const keysortParams = keysort(params);

            // 2. Concatenate the sorted parameters into a string i.e. "key" + "value" + "key2" + "value2"...
            const concatString = concatDictionaryKeyValue(keysortParams);

            // 3. Add API name in front of the string in (2)
            const preSignString = apiPath + concatString;

            // 4. Encode the concatenated string in UTF-8 format & and make a digest (HMAC_SHA256)
            const hash = CryptoJS.HmacSHA256(preSignString, appSecret);

            // 5. Convert the digest to hexadecimal format
            const signature = CryptoJS.enc.Hex.stringify(hash);

            return signature.toUpperCase(); // must use upper case
        };
        const keysort = (unordered) => {
            return Object.keys(unordered)
                .sort()
                .reduce((ordered, key) => {
                    ordered[key] = unordered[key];
                    return ordered;
                }, {});
        };


        const concatDictionaryKeyValue = (object) => {
            return Object.keys(object).reduce(
                (concatString, key) => concatString.concat(key + object[key]),
                ''
            );
        };


        function GetProduct() {
            var paramenter = {
                access_token: token,
            };

            $.ajax({
                url: "https://node.hannguhiendai.com/lazada/product",
                type: 'GET',
                data: paramenter,
                success: function(response) {
                    console.log(response)
                    var productData = response.data
                    productData.forEach(item => {
                        const dataDATA = item
                        console.log(item)
                        const newRow = `<tr>
                                                        <td class="text-center">1</td>
                                                        <td class="text-start"> lazada:
                                                            ${dataDATA.skus[0].ShopSku}</b></td>
                                                        <td class="text-start">${dataDATA.attributes.name}</td>
                                                        <td class="text-center">${dataDATA.skus[0].price}</td>
                                                        <td class="text-center">
                                                            <input type="number" max="99999" min="0"
                                                                value="${dataDATA.skus[0].quantity}" class="form-control" data-id="6">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text" max="99999" min="0"
                                                                class="form-control" data-id="6">
                                                        </td>
                                                        <td class="text-center">Null</td>
                                                        <td class="text-center">
                                                            <a href="#">1</a>
                                                        </td>
                                                        <td class="text-center">
                                                            <div
                                                                class="form-check form-switch d-flex justify-content-center align-items-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="flexSwitchCheckDefault">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="dropdown-toggle cursor-pointer"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="icon-lg pb-3px" data-feather="menu"></i>
                                                            </span>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item fs-5" href="#">
                                                                        <i class="icon-lg pb-3px" data-feather="edit"></i>
                                                                        Sửa sku
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item fs-5 text-danger"
                                                                        href="#">
                                                                        <i class="icon-lg text-danger pb-3px"
                                                                            data-feather="trash-2"></i>
                                                                        Xóa sản phẩm lấy về
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                        `;
                        $("#dataRow").append(newRow);
                    });
                }

            });
        }
        GetProduct()
    </script>
@endsection
