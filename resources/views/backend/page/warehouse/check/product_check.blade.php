@extends('backend.layout.layout')

@section('title')
Danh sách sản phẩm kiểm kho
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
      <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm kiểm kho</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('check') }}">Kiểm kho</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('product_check') }}">Sản phẩm kiểm kho</a>
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
                      <select class="form-select" aria-label="custom-multiple select example" name="filter_var_vg_id[]"
                        id="filter_var_vg_id" custom-multiple multiselect-search="true" multiselect-select-all="true"
                        multiselect-max-items="1">
                        <option value="">Chọn Store</option>
                        <option value="">LAZADA AINI STORE</option>
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
                        <option value="">- Đến kho -</option>
                        <option value="">Tên kho</option>
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

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="var_id" maxlength="255" placeholder="ID phiếu kiểm" id="var_id" class="form-control"
                        value="">
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="var_id" maxlength="255" placeholder="Sản phẩm" id="var_id" class="form-control"
                        value="">
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
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Danh mục</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_cat_inter_id[]" custom-multiple="" id="filter_cat_inter_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="2"> Danh mục 2</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="Tìm kiếm" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>Tất cả</label></div><div><input type="checkbox"><label>Danh mục 2</label></div><div><input type="checkbox"><label>- Danh mục con của danh mục 2</label></div></div></div><span class="placeholder">Chọn</span></div>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Tình trạng</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_cat_inter_id[]" custom-multiple="" id="filter_cat_inter_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="">Đủ</option>
                        <option value="">Thừa</option>
                        <option value="">Thiếu</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="Tìm kiếm" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>Tất cả</label></div><div><input type="checkbox"><label>Danh mục 2</label></div><div><input type="checkbox"><label>- Danh mục con của danh mục 2</label></div></div></div><span class="placeholder">Chọn</span></div>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhà cung cấp</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Thương hiệu</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_cat_inter_id[]" custom-multiple="" id="filter_cat_inter_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="">Gucci</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="Tìm kiếm" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>Tất cả</label></div><div><input type="checkbox"><label>Danh mục 2</label></div><div><input type="checkbox"><label>- Danh mục con của danh mục 2</label></div></div></div><span class="placeholder">Chọn</span></div>
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Loại sản phẩm</label>
                    <div class="col-12 pr-0">
                      <select name="gpid" id="gpid" class="form-select">
                        <option value="">- Loại sản phẩm -</option>
                        <option value="">Sản phẩm</option>
                        <option value="">Voucher</option>
                        <option value="">Sản phẩm cân đo</option>
                        <option value="">Sản phẩm theo imei</option>
                        <option value="">Gói sản phẩm</option>
                        <option value="">Dịch vụ</option>
                        <option value="">Dụng cụ</option>
                        <option value="">Sản phẩm bán theo lô</option>
                        <option value="">Combo</option>
                        <option value="">Sản phẩm nhiều đơn vị tính</option>
                      </select>
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
                            Ngày
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Kho
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tên sản phẩm
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending">
                            Giá vốn
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Giá bán
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                          rowspan="1" colspan="1">
                            Tồn
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Đang chuyển
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tồn thực tế
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Chênh lệch
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Mô tả
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
                              30/07/2023
                            </a>
                          </td>
                          <td class="text-start">
                            <p>shangyang132</p>
                          </td>
                          <td class="text-start">
                            <a href="">Tẩy Tế Bào Chết Chiết Xuất Gừng Cho Da Đầu In Nature (Dạng tạo bọt)</a>
                          </td>
                          <td class="text-center">
                            <p>10.000</p>
                          </td>
                          <td class="text-center">
                            <p>688.000</p>
                          </td>
                          <td class="text-center">
                            <p>12</p>
                          </td>
                          <td class="text-center">
                            <p>120</p>
                          </td>
                          <td class="text-center">
                            <p>1</p>
                          </td>
                          <td class="text-center">
                            <p class="text-success">220</p>
                          </td>
                          <td class="text-center">
                            <p>Null</p>
                          </td>
                          <td class="text-center">
                            <a href="">
                              <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                            </a>
                          </td>
                        </tr>

                        <tr>
                          <td class="text-center">
                            <a href="#">
                              30/07/2023
                            </a>
                          </td>
                          <td class="text-start">
                            <p>shangyang132</p>
                          </td>
                          <td class="text-start">
                            <a href="">Tẩy Tế Bào Chết Chiết Xuất Gừng Cho Da Đầu In Nature (Dạng tạo bọt)</a>
                          </td>
                          <td class="text-center">
                            <p>10.000</p>
                          </td>
                          <td class="text-center">
                            <p>688.000</p>
                          </td>
                          <td class="text-center">
                            <p>12</p>
                          </td>
                          <td class="text-center">
                            <p>120</p>
                          </td>
                          <td class="text-center">
                            <p>1</p>
                          </td>
                          <td class="text-center">
                            <p class="text-danger">-220</p>
                          </td>
                          <td class="text-center">
                            <p>Null</p>
                          </td>
                          <td class="text-center">
                            <a href="">
                              <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                            </a>
                          </td>
                        </tr>

                        <tr class="total">
                          <td class="text-end" colspan="5">
                            <b>Tổng cộng</b>
                          </td>
                          <td class="text-center">
                            <b>1.500</b>
                          </td>
                          <td class="text-center">
                            <b>74</b>
                          </td>
                          <td class="text-center">
                            <b>435</b>
                          </td>
                          <td class="text-center">
                            <b class="text-danger">-220</b>
                          </td>
                          <td></td>
                          <td></td>
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