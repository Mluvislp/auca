@extends('backend.layout.layout')

@section('title')
Sản phẩm XNK nháp
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
      <li class="breadcrumb-item active" aria-current="page">Phiếu nháp</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('draft') }}">Phiếu XNK nháp</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('draft_product') }}">Sản phẩm XNK nháp</a>
        </li>
      </ul>
      <div class="tab-content mt-3" id="lineTabContent">

        {{-- table --}}
        <div class="tab-pane active" id="fixSellPrice" role="tabpanel" aria-labelledby="sell-price-line-tab">
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
                        <option value="hihi">- Từ kho -</option>
                        <option value="asd">shangyang132</option>
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
                        <option value="asd">shangyang132</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="var_id" maxlength="255" placeholder="ID" id="var_id"
                        class="form-control" value="">
                    </div>
                  </div>
                </div>
                
                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="var_id" maxlength="255" placeholder="ID Phiếu XNK" id="var_id"
                        class="form-control" value="">
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
                        <option value="">Tên danh mục</option>
                        <option value="">Tên danh mục</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="Tìm kiếm" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>Tất cả</label></div><div><input type="checkbox"><label>Danh mục 2</label></div><div><input type="checkbox"><label>- Danh mục con của danh mục 2</label></div></div></div><span class="placeholder">Chọn</span></div>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Thương hiệu</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_cat_inter_id[]" custom-multiple="" id="filter_cat_inter_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="">Tên thương hiệu</option>
                        <option value="">Tên thương hiệu</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="Tìm kiếm" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>Tất cả</label></div><div><input type="checkbox"><label>Danh mục 2</label></div><div><input type="checkbox"><label>- Danh mục con của danh mục 2</label></div></div></div><span class="placeholder">Chọn</span></div>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Loại</label>
                    <div class="col-12 pr-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="0">- Loại -</option>
                        <option value="">Nhập</option>
                        <option value="">Xuất</option>
                      </select>
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Loại sản phẩm</label>
                    <div class="col-12 pr-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="">- Loại sản phẩm -</option>
                        <option value="">Sản phẩm</option>
                        <option value="">Voucher</option>
                        <option value="">Sản phẩm cân đo</option>
                        <option value="">Sản phẩm theo IMEI</option>
                        <option value="">Gói sản phẩm</option>
                        <option value="">Dịch vụ</option>
                        <option value="">Dụng cụ</option>
                        <option value="">Sản phẩm bán theo lô</option>
                        <option value="">Combo</option>
                        <option value="">Sản phẩm nhiều đơn vị tính</option>
                      </select>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Trạng thái</label>
                    <div class="col-12 pr-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="0">- Trạng thái -</option>
                        <option value="1">Mới</option>
                        <option value="2">Hủy</option>
                        <option value="3">Đã duyệt</option>
                        <option value="4">Đã xác nhận</option>
                      </select>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Kiểu</label>
                    <div class="col-12 pr-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="">- Trạng thái -</option>
                        <option value="">[N] Nhà cung cấp</option>
                        <option value="">[C] Chuyển kho</option>
                        <option value="">[L] Bán lẻ</option>
                        <option value="">[B] Bán sỉ</option>
                        <option value="">[#] Khác</option>
                      </select>
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
                    <label class="col-form-label text-right col-12 pl-0 pr-0">IMEI</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Ghi chú</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhà cung cấp</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Người tạo</label>
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
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down icon-lg pb-3px"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <ul class="dropdown-menu" style="">
                      <li>
                        <a class="dropdown-item fs-5" href="{{ route('ncc_draft') }}">
                        <i class="icon-lg pb-3px" data-feather="arrow-left"></i>
                          Phiếu nháp nhập NCC
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item fs-5" href="{{ route('moveTo_draft') }}">
                        <i class="icon-lg pb-3px" data-feather="arrow-right"></i>
                          Phiếu nháp chuyển vào kho
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item fs-5" href="{{ route('nnk_retail_draft') }}">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                          Phiếu nháp nhập NNK bán lẻ
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item fs-5" href="{{ route('nnk_resell_draft') }}">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                          Phiếu nháp nhập NNK bán sỉ
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item fs-5" href="{{ route('nnk_other_draft') }}">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                          Phiếu nháp nhập NNK khác
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
                          <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                          Xuất Excel mã vạch trang hiện tại
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
                    <table id="dataTableExampleHero" class="table dataTable no-footer table-bordered"
                      aria-describedby="dataTableExampleHero_info">
                      <thead class="table-light">
                        <tr>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            ID | Ngày
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Kho hàng
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Người lập
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Sản phẩm
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataTableExampleHero" rowspan="1" colspan="1" aria-sort="ascending">
                            SL tồn
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataTableExampleHero" rowspan="1" colspan="1" aria-sort="ascending">
                            SL YC
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataTableExampleHero" rowspan="1" colspan="1" aria-sort="ascending">
                            Giá YC
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataTableExampleHero" rowspan="1" colspan="1" aria-sort="ascending">
                            Tiền YC
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Mô tả
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            SL duyệt
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Giá duyệt
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            SL XNK
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Tổng tiền
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            <i class="icon-lg text-black pb-3px" data-feather="settings"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td class="text-center">
                            <a href="#">
                              3121419
                            </a>
                            <p>
                              08/10/2019
                            </p>
                            <p>
                              10:33:36
                            </p>
                          </td>
                          <td class="text-start">
                            <p> <span>Xuất [C]</span> <br> <span>shangyang132</span> <i class="icon-lg pb-3px" data-feather="arrow-right"></i> <span>shangyang132 1</span> </p>
                          </td>
                          <td class="text-center">123</td>
                          <td class="text-start">
                            <a href="#">
                                A04
                            </a>
                            <p>
                                牙贴ANRIEA - Miếng dán trắng răng Anriea
                            </p>
                          </td>
                          <td class="text-center">19.984</td>
                          <td class="text-center">10</td>
                          <td class="text-center">97.000</td>
                          <td class="text-center">970.000</td>
                          <td class="text-start">
                            <p>
                                xuất ký gửi anriea tại vũ an hn thắng 9
                            </p>
                          </td>
                          <td class="text-center">50</td>
                          <td class="text-center">75.000</td>
                          <td class="text-center">10</td>
                          <td class="text-center">970.000</td>
                          <td class="text-center">
                            <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                              aria-expanded="false">
                              <i class="icon-lg pb-3px" data-feather="menu"></i>
                            </span>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item fs-5" href="#">
                                  <i class="icon-lg pb-3px" data-feather="file-text"></i>
                                  Export in mã vạch
                                </a>
                              </li>
                            </ul>
                          </td>
                        </tr>

                        {{-- <tr class="total">
                          <td class="text-end" colspan="5">
                            <b>Tổng cộng: </b>
                          </td>
                          <td class="text-end">
                            <b>555</b>
                          </td>
                          <td class="text-end">
                            <b>4.200</b>
                          </td>
                          <td class="text-end">
                            <b>10.449.178</b>
                          </td>
                          <td class="text-end">
                            <b></b>
                          </td>
                          <td class="text-end">
                            <b>555</b>
                          </td>
                          <td class="text-end">
                            <b></b>
                          </td>
                          <td class="text-end">
                            <b>523</b>
                          </td>
                          <td class="text-end">
                            <b>8.901.792</b>
                          </td>
                          <td class="text-end">
                            <b></b>
                          </td>
                        </tr> --}}

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