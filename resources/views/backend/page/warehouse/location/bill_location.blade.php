@extends('backend.layout.layout')

@section('title')
Hóa đơn xuất nhập vị trí
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
      <li class="breadcrumb-item active" aria-current="page">Hóa đơn xuất nhập vị trí</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
        <div class="card-body p-0 pt-2">

            <!-- Start Filter content -->
            <div class="filter">
              <div class="row mb-3">

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_var_vg_id[]"
                        id="filter_var_vg_id" multiple multiselect-search="true" multiselect-select-all="true"
                        multiselect-max-items="1">
                        <option value="hihi">- Đến kho -</option>
                        <option value="asd">Tên kho</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-5 col-lg-4 col-xl-2 pr-1">
                    <div class="form-group input-group mb-0 pt-3">
                        <div class="p-0">
                            <div class="row g-0 m-0 input-group">
                              <div class="col">
                                <div class="input-group flatpickr" id="flatpickr-date">
                                  <input type="text" class="form-control flatpickr-input" placeholder="Từ ngày" data-input="" readonly="readonly">
                                </div>
                              </div>
                              <div class="col">
                                <div class="input-group flatpickr" id="flatpickr-date">
                                  <input type="text" class="form-control flatpickr-input" placeholder="Đến ngày" data-input="" readonly="readonly">
                                </div>
                                </div>
                            </div>
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
                
                <div class="col-6 col-md-3 col-lg-2 pr-1">
                    <div class="form-group input-group mb-0 pt-3">
                      <div class="col p-0">
                        <input type="text" name="var_id" maxlength="255" placeholder="Vị trí" id="var_id" class="form-control"
                          value="">
                      </div>
                    </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                    <div class="form-group input-group mb-0 pt-3">
                      <div class="col p-0">
                        <input type="text" name="var_id" maxlength="255" placeholder="Người tạo" id="var_id" class="form-control"
                          value="">
                      </div>
                    </div>
                </div>

                <div class="col-1 pt-3">
                  <!-- Example split danger button -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success">Lọc</button>
                  </div>
                </div>

              </div>

              <div class="collapse row m-0 col-12 pl-0 pr-0 mt-3 mb-3" id="filter-advanced-elements">

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhà cung cấp</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                    <div class="row form-group input-group fInputHidden">
                      <label class="col-form-label text-right col-12 pl-0 pr-0">Trang thái sản phẩm</label>
                      <div class="col-12 pr-0">
                        <select class="form-select" aria-label="select example" name="filter_var_cat_id[]"
                            id="filter_var_cat_id">
                            <option value="hihi">- Trạng thái sản phẩm -</option>
                            <option value="otp1">Mới</option>
                            <option value="otp1">Đang bán</option>
                            <option value="otp1">Ngừng bán</option>
                            <option value="otp2">Hết hàng</option>
                        </select>
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
                      <a class="dropdown-item fs-5" href="{{ route('putInLocation') }}">
                        <i class="icon-lg pb-3px" data-feather="arrow-right"></i>
                        Xếp sản phẩm vào vị trí
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="{{ route('putOutLocation') }}">
                        <i class="icon-lg pb-3px" data-feather="arrow-left"></i>
                        Lấy sản phẩm khỏi vị trí
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
                            ID | Ngày
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Kho hàng
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Số SP
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending">
                            Tổng SL
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Ngày lập phiếu
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            <i class="icon-lg text-black pb-3px" data-feather="settings"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center">
                            <a href="#">
                                9
                            </a>
                            <p>
                                25/07/2023
                            </p>
                          </td>
                          <td class="text-center">
                            <p>
                                shangyang132
                                <i class="icon-lg text-blue pb-3px" data-feather="arrow-left"></i>
                            </p>
                          </td>
                          <td class="text-center">
                            <p>Null</p>
                          </td>
                          <td class="text-center">
                            <p>Null</p>
                          </td>
                          <td class="text-center">
                            <p>Null</p>
                          </td>
                          <td class="text-center">
                            <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                              aria-expanded="false">
                              <i class="icon-lg pb-3px" data-feather="menu"></i>
                            </span>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item fs-5" href="#">
                                  <i class="icon-lg pb-3px" data-feather="printer"></i>
                                  In phiếu
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
                        <tr>
                            <td class="text-center">
                              <a href="#">
                                  9
                              </a>
                              <p>
                                  25/07/2023
                              </p>
                            </td>
                            <td class="text-center">
                              <p>
                                  shangyang132
                                  <i class="icon-lg text-danger pb-3px" data-feather="arrow-right"></i>
                              </p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="icon-lg pb-3px" data-feather="menu"></i>
                              </span>
                              <ul class="dropdown-menu">
                                <li>
                                  <a class="dropdown-item fs-5" href="#">
                                    <i class="icon-lg pb-3px" data-feather="printer"></i>
                                    In phiếu
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

@endsection

@section('script')

<script>
  var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
</script>

@endsection