@extends('backend.layout.layout')

@section('title')
Phiếu chuyển kho
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
      <li class="breadcrumb-item active" aria-current="page">Chuyển kho</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
            aria-controls="home" aria-selected="true">Chuyển kho</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transfer_note') }}">Phiếu nháp</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transfer_move') }}">Đang chuyển đi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transfer_to_move') }}">Sắp chuyển đến</a>
        </li>
      </ul>
      <div class="tab-content mt-3" id="lineTabContent">

        {{-- table 1 --}}
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
          <div class="card-body p-0 pt-2">

            <!-- Start Filter content -->
            <div class="filter">
              <div class="row mb-3">

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_var_vg_id[]"
                        id="filter_var_vg_id" custom-multiple multiselect-search="true" multiselect-select-all="true"
                        multiselect-max-items="1">
                        <option value="hihi">Chọn Store</option>
                        <option value="asd">LAZADA AINI STORE</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_var_vg_id[]"
                        id="filter_var_vg_id" custom-multiple multiselect-search="true" multiselect-select-all="true"
                        multiselect-max-items="1">
                        <option value="hihi">- Đến kho -</option>
                        <option value="asd">Tên kho</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="var_id" maxlength="255" placeholder="ID" id="var_id" class="form-control"
                        value="">
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-5 col-lg-4 col-xl-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="p-0">
                      <div class="row g-0 m-0 input-group">
                        <div class="col">
                          <div class="input-group flatpickr" id="flatpickr-date">
                            <input type="text" class="form-control flatpickr-input" placeholder="Từ ngày" data-input=""
                              readonly="readonly">
                          </div>
                        </div>
                        <div class="col">
                          <div class="input-group flatpickr" id="flatpickr-date">
                            <input type="text" class="form-control flatpickr-input" placeholder="Đến ngày" data-input=""
                              readonly="readonly">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]"
                        id="filter_var_cat_id">
                        <option value="hihi">- Loại -</option>
                        <option value="otp1">Nhập</option>
                        <option value="otp2">Xuất</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-1 pt-3">
                  <!-- Example split danger button -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success">Lọc</button>
                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split"
                      data-bs-toggle="collapse" data-bs-target="#filter-advanced-elements" aria-expanded="false"
                      aria-controls="filter-advanced-elements">
                    </button>
                  </div>
                </div>
              </div>

              <div class="collapse row m-0 col-12 pl-0 pr-0 mt-3 mb-3" id="filter-advanced-elements">

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Sản phẩm</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">IMEI</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="privateId" maxlength="30" id="privateId" class="form-control" value="">
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">ID Phiếu nháp</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhãn</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_var_vg_id[]"
                        id="filter_var_vg_id" multiple="" multiselect-search="true" multiselect-select-all="true"
                        multiselect-max-items="1" style="display: none;">
                        <option value="otp">Đã gắn nhãn</option>
                        <option value="otp">Chưa gắn nhãn</option>
                      </select>
                      <div class="multiselect-dropdown" style="width: 0px;">
                        <div class="multiselect-dropdown-list-wrapper" style="display: none;"><input
                            class="multiselect-dropdown-search form-control" placeholder="Tìm kiếm"
                            style="width: 100%; display: block;">
                          <div class="multiselect-dropdown-list" style="height: 15rem;">
                            <div class="multiselect-dropdown-all-selector">
                              <input type="checkbox"><label>Tất cả</label>
                            </div>
                            <div><input type="checkbox"><label>Đã gắn nhãn</label></div>
                            <div><input type="checkbox"><label>Chưa gắn nhãn</label></div>
                          </div>
                        </div><span class="placeholder">Gắn nhãn</span>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Người tạo</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Ghi chú</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>
                </div>

              </div>

              <div class="mb-3 d-flex align-items-center gap-2">
                <div>
                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                    Thêm mới
                    <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item fs-5" href="{{ route('add_transfer') }}">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                        Thêm phiếu chuyển kho
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="{{ route('add_transfer_note') }}">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                        Thêm phiếu chuyển kho nháp
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="{{ route('call_transfer') }}">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                        Gọi hàng từ kho khác
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="file-text"></i>
                        Nhập từ excel
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="file-text"></i>
                        Import điều chuyển kho
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="refresh-ccw"></i>
                        Phân phối chuyển kho theo tỉ lệ
                      </a>
                    </li>
                  </ul>
                </div>
                <div>
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
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
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="printer"></i>
                        In mã vạch sản phẩm trong các phiếu XNK đã chọn
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="printer"></i>
                        In IMEI sản phẩm trong các phiếu XNK đã chọn
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="printer"></i>
                        In các phiếu XNK đã chọn
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="tag"></i>
                        Gắn nhãn phiếu chuyển kho đã chọn
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="printer"></i>
                        Gỡ nhãn phiếu chuyển kho đã chọn
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item text-danger fs-5" href="#">
                        <i class="icon-lg text-danger pb-3px" data-feather="trash"></i>
                        Xóa các phiếu đã chọn
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
                    <table id="dataTableExample" class="table dataTable no-footer table-bordered"
                      aria-describedby="dataTableExample_info">
                      <thead class="table-light">
                        <tr>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            STT
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            ID | Ngày
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Kho hàng
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending">
                            Kiểu
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            SP
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                          rowspan="1" colspan="1">
                            SL
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tổng tiền
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            <i class="icon-md text-danger pb-3px" data-feather="arrow-down" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Chiết khấu"></i>
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Người tạo
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            <i class="icon-md text-black pb-3px" data-feather="message-square" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Ghi chú"></i>
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            <i class="icon-lg text-black pb-3px" data-feather="settings"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center">1</td>
                          <td class="text-start">
                            <b>123456678</b>
                            <p>18/07/2023</p>
                          </td>
                          <td class="text-center">shangyang132</td>
                          <td class="text-center">Null</td>
                          <td class="text-center">
                            <a href="#">
                              100
                            </a>
                          </td>
                          <td class="text-center">
                            <a href="#">
                              100
                            </a>
                          </td>
                          <td class="text-center">
                            <p>120.000.000</p>
                          </td>
                          <td class="text-center">Null</td>
                          <td class="text-center">admin@gmail.com</td>
                          <td class="text-center">
                            <p class="text-start">Không có ghi chú</p>
                          </td>
                          <td class="text-center">
                            <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                              aria-expanded="false">
                              <i class="icon-lg pb-3px" data-feather="menu"></i>
                            </span>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item fs-5" href="#">
                                  <i class="icon-lg pb-3px" data-feather="edit"></i>
                                  Sửa
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-5 text-danger" href="#">
                                  <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
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

@endsection