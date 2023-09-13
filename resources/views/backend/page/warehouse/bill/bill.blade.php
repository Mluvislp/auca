@extends('backend.layout.layout')

@section('title')
Xuất nhập kho
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
      <li class="breadcrumb-item active" aria-current="page">Kho hàng</li>
      <li class="breadcrumb-item active" aria-current="page">Xuất nhập kho</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
            aria-controls="home" aria-selected="true">Phiếu xuất nhập kho</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="sell-price-line-tab" data-bs-toggle="tab" href="#fixSellPrice" role="tab"
            aria-controls="fixSellPrice" aria-selected="false">Sản phẩm xuất nhập kho</a>
        </li>
      </ul>
      <div class="tab-content mt-3" id="lineTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
          <div class="card-body p-0 pt-2">

            <!-- Start Filter content -->
            <div class="filter" data-select2-id="select2-data-6-5li8">
              <div class="row mb-3">

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="hihi">- Doanh nghiệp -</option>
                        <option value="asd">Tên doanh nghiệp</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_var_cat_id[]" id="filter_var_cat_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="hihi">hihi</option>
                        <option value="asd">ads</option>
                      </select><div class="multiselect-dropdown" style="width: 233px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>hihi</label></div><div><input type="checkbox"><label>ads</label></div></div></div><span class="placeholder">select</span></div>
                    </div>
                  </div>
                </div>
                

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="var_id" maxlength="255" placeholder="ID" id="var_id" class="form-control" value="">
                    </div>
                  </div>
                </div>
                
                <div class="col-6 col-md-3 col-lg-1 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="hihi">- Loại -</option>
                        <option value="otp1">Nhập</option>
                        <option value="otp2">Xuất</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_var_cat_id[]" id="filter_var_cat_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="otp">[N] Nhà cung cấp</option>
                        <option value="otp1">[C] Chuyền kho</option>
                        <option value="otp2">[G] Giao hàng</option>
                        <option value="otp3">[L] Bán lẻ</option>
                        <option value="otp4">[B] Bán sỉ</option>
                        <option value="otp5">[TL] Tặng kèm (Bán lẻ)</option>
                        <option value="otp6">[TG] Tặng kèm (Giao hàng)</option>
                        <option value="otp7">[TB] Tặng kèm (Bán sỉ)</option>
                        <option value="otp8">[K] Bù trừ kiểm kho</option>
                        <option value="otp9">[#] Khác</option>
                        <option value="otp10">[BH] Bảo hành</option>
                        <option value="otp11">[SC] Sửa chữa</option>
                        <option value="otp12">[LKBH] Linh kiện bảo hành</option>
                        <option value="otp13">[CB] Combo</option>
                      </select><div class="multiselect-dropdown" style="width: 233px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>hihi</label></div><div><input type="checkbox"><label>ads</label></div></div></div><span class="placeholder">select</span></div>
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
                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="collapse" data-bs-target="#filter-advanced-elements" aria-expanded="true" aria-controls="filter-advanced-elements">
                    </button>
                  </div>
                </div>
              </div>

              <div class="row m-0 col-12 pl-0 pr-0 mt-3 mb-3 collapse" id="filter-advanced-elements" style="" data-select2-id="select2-data-filter-advanced-elements">
                <div class="col-12 col-md-4 col-lg-3 pr-0">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Kho liên quan</label>
                    <div class="col-12 pr-0">
                      <select name="gpid" id="gpid" class="form-select">
                        <option value="">- Kho liên quan -</option>
                        <option value="">Tên kho</option>
                      </select>
                    </div>
                  </div>

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

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Đặc điểm</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_var_vg_id[]" id="filter_var_vg_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="otp">Có chiết khấu</option>
                        <option value="otp">Có khách hàng</option>
                        <option value="otp">Đơn từ đơn hàng</option>
                        <option value="otp">Không có nhân viên bán hàng</option>
                        <option value="otp">Có công nợ</option>
                        <option value="otp">Còn công nợ</option>
                        <option value="otp">Hết công nợ</option>
                        <option value="otp">Có nhập máy cũ</option>
                        <option value="otp">asdasadsa</option>
                        <option value="otp">asdasadsa</option>
                        <option value="otp">asdasadsa</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>- Danh mục nội bộ -</label></div><div><input type="checkbox"><label>Chưa gắn danh mục</label></div><div><input type="checkbox"><label>aaa</label></div></div></div><span class="placeholder">select</span></div>
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0" data-select2-id="select2-data-5-bu0j">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">ID Đơn hàng</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="id" maxlength="100" id="imei" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">ID Phiếu kiểm kho</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="id" maxlength="100" id="imei" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">ID Phiếu bảo hành</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="id" maxlength="100" id="imei" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">ID Phiếu nháp</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="id" maxlength="100" id="imei" class="form-control" value="">
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Khách hàng</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>
                  
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Người tạo</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhân viên bán hàng</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nguồn khách hàng</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>

                </div>
                <div class="col-12 col-md-4 col-lg-3 pr-0">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhà cung cấp</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Ghi chú</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>
                  
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhãn</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_var_vg_id[]" id="filter_var_vg_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="">Gucci</option>
                        <option value="">Prada</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>- Danh mục nội bộ -</label></div><div><input type="checkbox"><label>Chưa gắn danh mục</label></div><div><input type="checkbox"><label>aaa</label></div></div></div><span class="placeholder">select</span></div>
                    </div>
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
                    <a class="dropdown-item fs-5" href="{{ route('import') }}">
                      <i class="fa-solid fa-arrow-left p-1"></i>
                      Nhập kho
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item fs-5" href="{{ route('export') }}">
                      <i class="fa-solid fa-arrow-right p-1"></i>
                      Xuất kho
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item fs-5" href="#">
                      <i class="fa-regular fa-file-excel p-1"></i>
                      Nhập từ Excel
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
                      <i class="fa-regular fa-file-excel p-1"></i>
                      Xuất Excel
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
                      <i class="fa-solid fa-tags p-1"></i>
                      Gắn nhãn phiếu XNK đã chọn
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item fs-5" href="#">
                      <i class="fa-solid fa-link-slash p-1"></i>
                      Gỡ nhãn phiếu XNK đã chọn
                    </a>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li>
                    <a class="dropdown-item text-danger fs-5" href="#">
                      <i class="icon-lg text-danger pb-3px" data-feather="trash"></i>
                      Xóa các phiếu XNK đã chọn
                    </a>
                  </li>
                </ul>
              </div>

              <div class="btn-group dgColumnSelectors ml-1">
                <button type="button" class="dropdown-toggle btn btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-columns icon-lg pb-3px"><path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"></path></svg>
                </button>
                <div role="menu" class="dropdown-menu dropdown-menu-right dropdown-content wmin-lg-600 wmin-350 userDgConfig" data-columndisplaysetting="101" x-placement="bottom-end" style="will-change: transform;">
                  <div class="dropdown-content-body pb-2">
                    <div class="row">
                      <div class="col-6">
                        <h6 class="mb-0 font-weight-semibold fs-5">Cài đặt ẩn hiện cột:</h6>
                      </div>
                      <div class="text-end col-6">
                        <span class="cursor-pointer resetColumnDisplaySetting" data-columndisplaysetting="101">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw icon-lg pb-3px"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                          Quay về mặc định
                        </span>
                      </div>
                      <div class="dropdown-divider col-xl-12"></div>
                      <div class="col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="id" value="id" class="dgColumn mr-1" data-colspan="colSumary" data-class="dgColId"> Khách hàng
                        </label>
                      </div>
                      <div class="col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="imagemanager" value="imagemanager" class="dgColumn mr-1" checked="" data-colspan="colSumary" data-class="dgColImagemanager"> File đính kèm
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <!-- End filter content -->

            <div class="table-responsive overflow-hidden">
              <div id="dataTableExampleHero_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row">
                  <div class="col-sm-12 table-responsive">
                    <table id="dataTableExampleHero" class="table dataTable no-footer table-bordered"
                      aria-describedby="dataTableExampleHero_info">
                      <thead class="table-light">
                        <tr>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            ID | Ngày
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Kho hàng
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            SP
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            SL
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Tổng tiền
                          </th>
                          <th class="sorting text-black text-center sorting_asc" tabindex="0"
                            aria-controls="dataTableExampleHero" rowspan="1" colspan="1" aria-sort="ascending"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Giảm">
                            <i class="icon-lg text-warning pb-3px" data-feather="trending-down"></i>
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Người tạo
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Khách hàng
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Đính kèm">
                            <i class="icon-lg pb-3px" data-feather="paperclip"></i>
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Chỉnh sửa mô tả cho phiếu nhập kho">
                            <i class="icon-lg pb-3px" data-feather="edit"></i>
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            <i class="icon-lg text-black pb-3px" data-feather="settings"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center">
                            <a class="fs-5" href="#">
                              229946490
                            </a><br>
                            <a class="fs-6" href="#">
                              229946491
                            </a><br>
                            22/06
                          </td>
                          <td class="text-start">
                            <p>shangyang132</p>
                            <span class="text-success">Nhập nhà cung cấp</span>
                          </td>
                          <td class="text-end">2</td>
                          <td class="text-end">2</td>
                          <td class="text-end">232,323</td>
                          <td class="text-end">Null</td>
                          <td class="text-center">shangyang132@gmail.com</td>
                          <td class="text-center">bachthedev</td>
                          <td class="text-start">
                            file.csadcas
                          </td>
                          <td class="text-start">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</td>
                          <td class="text-center">
                            <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                              aria-expanded="false">
                              <i class="icon-lg pb-3px" data-feather="menu"></i>
                            </span>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item fs-6 text-start" href="#">
                                  <i class="icon-lg pb-3px" data-feather="printer"></i>
                                  In phiếu
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-6 text-start" href="#">
                                  <i class="icon-lg pb-3px" data-feather="edit-3"></i>
                                  Sửa phiếu
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-6 text-start" href="#">
                                  <i class="fa-solid fa-barcode p-1"></i>
                                  In mã vạch sản phẩm trong phiếu
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-6 text-start" href="#">
                                  <i class="fa-solid fa-barcode p-1"></i>
                                  In IMEI sản phẩm phiếu XNK
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-6 text-start" href="#">
                                  <i class="fa-regular fa-file-excel p-1"></i>
                                  Xuất Excel in mã vạch bằng Bartender
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-6 text-start text-danger" href="#">
                                  <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                                  Xóa phiếu
                                </a>
                              </li>
                            </ul>
                          </td>
                        </tr>

                        <tr class="total">
                          <td class="text-end font-weight-normal" colspan="2">Tổng cộng: </td>
                          <td class="text-end font-weight-normal">2</td>
                          <td class="text-end font-weight-normal">2</td>
                          <td class="text-end font-weight-normal">232,323</td>
                          <td class="text-end font-weight-normal"></td>
                          <td colspan="5"></td>
                        </tr>

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
            <div class="filter" data-select2-id="select2-data-6-5li8">
              <div class="row mb-3">

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="hihi">- Doanh nghiệp -</option>
                        <option value="asd">Tên doanh nghiệp</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_var_cat_id[]" id="filter_var_cat_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="">something in here</option>
                        <option value="">something in here</option>
                      </select><div class="multiselect-dropdown" style="width: 233px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>hihi</label></div><div><input type="checkbox"><label>ads</label></div></div></div><span class="placeholder">select</span></div>
                    </div>
                  </div>
                </div>
                

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="var_id" maxlength="255" placeholder="ID" id="var_id" class="form-control" value="">
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
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="hihi">- Loại -</option>
                        <option value="otp1">Nhập</option>
                        <option value="otp2">Xuất</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_var_cat_id[]" id="filter_var_cat_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="otp">[N] Nhà cung cấp</option>
                        <option value="otp1">[C] Chuyền kho</option>
                        <option value="otp2">[G] Giao hàng</option>
                        <option value="otp3">[L] Bán lẻ</option>
                        <option value="otp4">[B] Bán sỉ</option>
                        <option value="otp5">[TL] Tặng kèm (Bán lẻ)</option>
                        <option value="otp6">[TG] Tặng kèm (Giao hàng)</option>
                        <option value="otp7">[TB] Tặng kèm (Bán sỉ)</option>
                        <option value="otp8">[K] Bù trừ kiểm kho</option>
                        <option value="otp9">[#] Khác</option>
                        <option value="otp10">[BH] Bảo hành</option>
                        <option value="otp11">[SC] Sửa chữa</option>
                        <option value="otp12">[LKBH] Linh kiện bảo hành</option>
                        <option value="otp13">[CB] Combo</option>
                      </select><div class="multiselect-dropdown" style="width: 233px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>hihi</label></div><div><input type="checkbox"><label>ads</label></div></div></div><span class="placeholder">select</span></div>
                    </div>
                  </div>
                </div>

                <div class="col-1 pt-3">
                  <!-- Example split danger button -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success">Lọc</button>
                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="collapse" data-bs-target="#filter-advanced-elements" aria-expanded="true" aria-controls="filter-advanced-elements">
                    </button>
                  </div>
                </div>
              </div>

              <div class="row m-0 col-12 pl-0 pr-0 mt-3 mb-3 collapse" id="filter-advanced-elements" style="" data-select2-id="select2-data-filter-advanced-elements">
                <div class="col-12 col-md-4 col-lg-3 pr-0">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Sản phẩm</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Kho liên quan</label>
                    <div class="col-12 pr-0">
                      <select name="gpid" id="gpid" class="form-select">
                        <option value="">- Kho liên quan -</option>
                        <option value="">Tên kho</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">IMEI</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="privateId" maxlength="30" id="privateId" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Loại sản phẩm</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_var_vg_id[]" id="filter_var_vg_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="otp">Sản phẩm</option>
                        <option value="otp">Voucher</option>
                        <option value="otp">Sản phẩm cân đo</option>
                        <option value="otp">Sản phẩm theo IMEI</option>
                        <option value="otp">Gói sản phẩm</option>
                        <option value="otp">Dịch vụ</option>
                        <option value="otp">Dụng cụ</option>
                        <option value="otp">Sản phẩm bán theo lô</option>
                        <option value="otp">Combo</option>
                        <option value="otp">Sản phẩm nhiều đơn vị tính</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>- Danh mục nội bộ -</label></div><div><input type="checkbox"><label>Chưa gắn danh mục</label></div><div><input type="checkbox"><label>aaa</label></div></div></div><span class="placeholder">select</span></div>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Thương hiệu</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_var_vg_id[]" id="filter_var_vg_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="otp">Tên thương hiệu 1</option>
                        <option value="otp">Tên thương hiệu 2</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>- Danh mục nội bộ -</label></div><div><input type="checkbox"><label>Chưa gắn danh mục</label></div><div><input type="checkbox"><label>aaa</label></div></div></div><span class="placeholder">select</span></div>
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0" data-select2-id="select2-data-5-bu0j">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Đặc điểm</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_var_vg_id[]" id="filter_var_vg_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="otp">Có chiết khấu</option>
                        <option value="otp">Không chiết khấu</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>- Danh mục nội bộ -</label></div><div><input type="checkbox"><label>Chưa gắn danh mục</label></div><div><input type="checkbox"><label>aaa</label></div></div></div><span class="placeholder">select</span></div>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Danh mục</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_var_vg_id[]" id="filter_var_vg_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="otp">Danh mục 1</option>
                        <option value="otp">Danh mục 2</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>- Danh mục nội bộ -</label></div><div><input type="checkbox"><label>Chưa gắn danh mục</label></div><div><input type="checkbox"><label>aaa</label></div></div></div><span class="placeholder">select</span></div>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">ID Phiếu XNK</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="id" maxlength="100" id="imei" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Danh mục nội bộ</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_var_vg_id[]" id="filter_var_vg_id" multiple="" multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1" style="display: none;">
                        <option value="otp">Danh mục 1</option>
                        <option value="otp">Danh mục 2</option>
                      </select><div class="multiselect-dropdown" style="width: 0px;"><div class="multiselect-dropdown-list-wrapper" style="display: none;"><input class="multiselect-dropdown-search form-control" placeholder="search" style="width: 100%; display: block;"><div class="multiselect-dropdown-list" style="height: 15rem;"><div class="multiselect-dropdown-all-selector"><input type="checkbox"><label>All</label></div><div><input type="checkbox"><label>- Danh mục nội bộ -</label></div><div><input type="checkbox"><label>Chưa gắn danh mục</label></div><div><input type="checkbox"><label>aaa</label></div></div></div><span class="placeholder">select</span></div>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhà cung cấp</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="id" maxlength="100" id="brand" class="form-control" value="">
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">ID Phiếu bảo hành</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>
                  
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Người tạo</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhân viên bán hàng</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhân viên kỹ thuật</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Lợi nhuận</label>
                    <div class="col-12 pr-0">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">- Mức -</button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"> > </a>
                            <a class="dropdown-item" href="#"> < </a>
                            <a class="dropdown-item" href="#"> = </a>
                          </div>
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with dropdown button">
                      </div>
                    </div>
                  </div>

                </div>
                <div class="col-12 col-md-4 col-lg-3 pr-0">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Giá</label>
                    <div class="col-12 pr-0">
                      <input type="number" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Khoảng giá</label>
                    <div class="col-12 pr-0">
                      <div class="row m-0 input-group">
                        <input type="number" name="remainFrom" maxlength="50" placeholder="Từ" class="form-control form-control col-6" inputmode="decimal" id="remainFrom" value="">
                        <input type="number" name="remainTo" maxlength="50" placeholder="Đến" id="remainTo" class=" form-control form-control col-6" inputmode="decimal" value="">
                      </div>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Ghi chú</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
                  </div>
                  
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Khách hàng</label>
                    <div class="col-12 pr-0">
                      <input type="text" maxlength="100" id="tagName" class="form-control" value="">
                    </div>
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
                    <a class="dropdown-item fs-5" href="{{ route('import') }}">
                      <i class="fa-solid fa-arrow-left p-1"></i>
                      Nhập kho
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item fs-5" href="{{ route('export') }}">
                      <i class="fa-solid fa-arrow-right p-1"></i>
                      Xuất kho
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
                      <i class="fa-regular fa-file-excel p-1"></i>
                      Xuất Excel
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item fs-5" href="#">
                      <i class="icon-lg pb-3px" data-feather="printer"></i>
                      In mã vạch sản phẩm đã chọn
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item text-danger fs-5" href="#">
                      <i class="icon-lg text-danger pb-3px" data-feather="trash"></i>
                      Xóa sản phẩm xuất nhập kho
                    </a>
                  </li>
                </ul>
              </div>
              
              <div class="btn-group dgColumnSelectors ml-1">
                <button type="button" class="dropdown-toggle btn btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-columns icon-lg pb-3px"><path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"></path></svg>
                </button>
                <div role="menu" class="dropdown-menu dropdown-menu-right dropdown-content wmin-lg-600 wmin-350 userDgConfig" data-columndisplaysetting="101" x-placement="bottom-end" style="will-change: transform;">
                  <div class="dropdown-content-body pb-2">
                    <div class="row">
                      <div class="col-6">
                        <h6 class="mb-0 font-weight-semibold fs-5">Cài đặt ẩn hiện cột:</h6>
                      </div>
                      <div class="text-end col-6">
                        <span class="cursor-pointer resetColumnDisplaySetting" data-columndisplaysetting="101">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw icon-lg pb-3px"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                          Quay về mặc định
                        </span>
                      </div>
                      <div class="dropdown-divider col-xl-12"></div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="id" value="id" class="dgColumn mr-1" data-colspan="colSumary" data-class="dgColId"> Mã sản phẩm cha
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="imagemanager" value="imagemanager" class="dgColumn mr-1" checked="" data-colspan="colSumary" data-class="dgColImagemanager"> Tên sản phẩm cha
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="barcode" value="barcode" class="dgColumn mr-1" checked="" data-colspan="colSumary" data-class="dgColBarcode"> Mã sản phẩm
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="code" value="code" class="dgColumn mr-1" checked="" data-colspan="colSumary" data-class="dgColCode"> Lô hàng
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="importPrice" value="importPrice" class="dgColumn mr-1" data-colspan="colSumary" data-class="dgColImportPrice"> SL
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="avgCost" value="avgCost" class="dgColumn mr-1" checked="" data-colspan="colSumary" data-class="dgColAvgCost"> Giá
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="price" value="price" class="dgColumn mr-1" checked="" data-colspan="colSumary" data-class="dgColPrice"> Giá vốn
                          bán
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="priceVat" value="priceVat" class="dgColumn mr-1" data-colspan="colSumary" data-class="dgColPriceVat"> Tiền
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="wholesalePrice" value="wholesalePrice" class="dgColumn mr-1" data-colspan="colSumary" data-class="dgColWholesalePrice"> Chiết khấu
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="wholesalePriceVat" value="wholesalePriceVat" class="dgColumn mr-1" data-colspan="colSumary" data-class="dgColWholesalePriceVat"> Ghi  chú
                          VAT
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="quantityRemain" value="quantityRemain" class="dgColumn mr-1" checked="" data-class="dgColQuantityRemain"> ĐVT
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="totalQuantityRemain" value="totalQuantityRemain" class="dgColumn mr-1" data-class="dgColTotalQuantityRemain"> Người tạo
                        </label>
                      </div>

                    </div>
                  </div>
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
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            ID | Ngày
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Kho hàng
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Mã SP cha
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tên SP cha
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Mã SP
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            SL
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tồn
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Giá vốn
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tiền
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tổng tiền
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Người tạo
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            <i class="icon-lg text-black pb-3px" data-feather="settings"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center">
                            <a href="#">
                              592472295
                            </a>
                            <p>
                              15/07
                            </p>
                          </td>
                          <td class="text-start">
                            <p>
                              shangyang132
                            </p>
                            <p class="text-success">
                              Nhập [N]
                            </p>
                          </td>
                          <td class="text-start">
                            <a class="text-success" href="#">
                              XĐ
                            </a>
                          </td>
                          <td class="text-start">
                            <a class="text-success" href="#">
                              ădădawdawdawdawd - ădawdaw - 35mm - NO.23
                            </a>
                          </td>
                          <td class="text-start">
                            <!-- Extra large modal -->
                            <a class="text-danger" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl">Mã sản phẩm</a>

                            <div class="modal fade bd-example-modal-xl" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">
                                      <a href="#">
                                        <i class="icon-lg pb-3px" data-feather="external-link"></i>
                                        Mã sản phẩm
                                      </a>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                  </div>
                                  <div class="modal-body">

                                    <div class="float-end">
                                      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                        Thao tác
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down icon-lg pb-3px"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li>
                                          <a class="dropdown-item fs-5" href="#">
                                            <i class="icon-lg pb-3px" data-feather="printer"></i>
                                            In mã vạch sản phẩm
                                          </a>
                                        </li>
                                        <li>
                                          <a class="dropdown-item fs-5" href="#">
                                            <i class="icon-lg pb-3px" data-feather="edit"></i>
                                            Sửa sản phẩm
                                          </a>
                                        </li>
                                        <li>
                                          <a class="dropdown-item fs-5" href="#">
                                            <i class="icon-lg pb-3px" data-feather="edit"></i>
                                            Sửa thông tin hiển thị website
                                          </a>
                                        </li>
                                        <li>
                                          <a class="dropdown-item fs-5" href="#">
                                            <i class="icon-lg pb-3px" data-feather="tablet"></i>
                                            Tính lại số tồn
                                          </a>
                                        </li>
                                        <li>
                                          <a class="dropdown-item fs-5" href="#">
                                            <i class="icon-lg pb-3px" data-feather="refresh-cw"></i>
                                            Tính lại giá vốn
                                          </a>
                                        </li>
                                        <li>
                                          <a class="dropdown-item fs-5" href="#">
                                            <i class="icon-lg pb-3px" data-feather="refresh-cw"></i>
                                            Tính lại số đang chuyển kho
                                          </a>
                                        </li>
                                        <li>
                                          <a class="dropdown-item fs-5" href="#">
                                            <i class="icon-lg pb-3px" data-feather="refresh-cw"></i>
                                            In mã vạch sản phẩm
                                          </a>
                                        </li>
                                      </ul>
                                    </div>

                                    <div class="tab-ui">
                                      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                                        <li class="nav-item">
                                          <a class="nav-link active" id="tab1-line-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">
                                            <i class="icon-lg pb-3px" data-feather="info"></i>
                                            Thông tin
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="tab2-line-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">
                                            <i class="icon-lg pb-3px" data-feather="refresh-cw"></i>
                                            Tồn kho
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="tab3-line-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">
                                            <i class="icon-lg pb-3px" data-feather="image"></i>
                                            Ảnh
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="tab4-line-tab" data-bs-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">
                                            <i class="icon-lg pb-3px" data-feather="gift"></i>
                                            Khuyến mãi
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="tab5-line-tab" data-bs-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">
                                            <i class="icon-lg pb-3px" data-feather="layout"></i>
                                            Website
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="tab6-line-tab" data-bs-toggle="tab" href="#tab6" role="tab" aria-controls="tab6" aria-selected="false">
                                            <i class="icon-lg pb-3px" data-feather="refresh-cw"></i>
                                            Lịch sử đã xóa
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="tab7-line-tab" data-bs-toggle="tab" href="#tab7" role="tab" aria-controls="tab7" aria-selected="false">
                                            <i class="icon-lg pb-3px" data-feather="link-2"></i>
                                            XNK
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="tab8-line-tab" data-bs-toggle="tab" href="#tab8" role="tab" aria-controls="tab8" aria-selected="false">
                                            <i class="icon-lg pb-3px" data-feather="code"></i>
                                            API
                                          </a>
                                        </li>
                                      </ul>

                                      <div class="tab-content mt-3" id="lineTabContent">
                                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-line-tab">
                                          <div class="row">
                                            <div class="col-md-7 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                      <div class="heading">
                                                        <p class="float-end">Trạng thái: <span class="bg-blue text-white p-1">Mới</span></p>
                                                        <h6 class="card-title"><i class="icon-lg pb-3px" data-feather="info"></i> Thông tin</h6>
                                                      </div>
                                                        <hr>
                                                            <div class="mb-3">
                                                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                          <p>
                                                                            Mã: <span>XĐ-dă-1-3y</span>
                                                                          </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                          <p>
                                                                            Mã vạch: <span>2000214247640</span>
                                                                          </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                          <p>
                                                                            Mã sản phẩm cha: <span>XĐ</span>
                                                                          </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                          <p>
                                                                            Danh mục: <span>Xe máy</span>
                                                                          </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                          <p>
                                                                            Thương hiệu: <span>86Shop</span>
                                                                          </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                          <p>
                                                                            Người tạo: <span>123</span>
                                                                          </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                          <p>
                                                                            Ngày tạo: <span>23:27 14/07</span>
                                                                          </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                          <p>
                                                                            Nhà cung cấp: <a href="#">DREAM TREND - 0000000002</a>
                                                                          </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Giá nhập: <span>18.000.000</span>
                                                                        </p>
                                                                      </div>
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Giá vốn: <span>18.000.000</span>
                                                                        </p>
                                                                      </div>
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Giá bán: <span>19.000.000 <b>(Lãi 5%)</b></span>
                                                                        </p>
                                                                      </div>
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Giá sỉ: <span>Null</span>
                                                                        </p>
                                                                      </div>
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Giá cũ: <span>18.500.000</span>
                                                                        </p>
                                                                      </div>
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Đơn vị tính: <span>Chiếc</span>
                                                                        </p>
                                                                      </div>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                            
                                            <div class="col-md-5 grid-margin stretch-card">
                                                <div class="card w-100 p-0">
                                                  <div class="card-body">
                                                    <div class="heading">
                                                      <h6 class="card-title"><i class="icon-lg pb-3px" data-feather="info"></i> Thông tin khác</h6>
                                                    </div>
                                                      <hr>
                                                          <div class="mb-3">
                                                              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                                  <div class="col">
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Loại sản phẩm:
                                                                        </p>
                                                                      </div>
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Khối lượng:
                                                                        </p>
                                                                      </div>
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Kích thước:
                                                                        </p>
                                                                      </div>
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Màu sắc con:
                                                                        </p>
                                                                      </div>
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Size: 
                                                                        </p>
                                                                      </div>
                                                                      <div class="mb-3">
                                                                        <p>
                                                                          Màu sắc:
                                                                        </p>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col text-end">
                                                                    <div class="mb-3">
                                                                      <p>
                                                                        Sản phẩm
                                                                      </p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                      <p>
                                                                        90.000 gr
                                                                      </p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                      <p>
                                                                        2.000 x 550 x 1.500 cm
                                                                      </p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                      <p>
                                                                        Màu vàng
                                                                      </p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                      <p>
                                                                        1-3y
                                                                      </p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                      <p>
                                                                        Bright Grey
                                                                      </p>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                              </div>
                                                          </div>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="card mb-3">
                                              <div class="card-header header-elements-inline bg-light d-flex align-items-center justify-content-between">
                                                <h5 class="card-title font-weight-semibold mb-0">
                                                  <i class="icon-lg pb-3px" data-feather="tag"></i>
                                                  Nhãn
                                                </h5>
                                                <div class="header-elements">
                                                  <div class="list-icons">
                                                    <a class="list-icons-item" data-bs-toggle="collapse" href="#list-images-item" aria-expanded="true" aria-controls="list-images-item">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down icon-xl pb-3px"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                    </a>
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="card-body collapse show" id="list-images-item" style="">
                                                <div class="row">

                                                <div class="form-group mb-2">
                                                  <div class="row">
                                                    <div class="d-flex align-items-center">
                                                      <div class="input-group">
                                                        <input type="text" name="supplierName" maxlength="255" placeholder="Tìm kiếm nhãn" id="supplierName" autocomplete="off" class="form-control" value=""> <input type="hidden" name="supplierId" id="supplierId" value="">
                                                      </div>
                                                      <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                          <a href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus icon-lg pb-3px text-success"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                          </a>
                                                        </span>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                            
                                        </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-line-tab">2</div>
                                        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-line-tab">3</div>
                                        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-line-tab">4</div>
                                        <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-line-tab">5</div>
                                        <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-line-tab">6</div>
                                        <div class="tab-pane fade" id="tab7" role="tabpanel" aria-labelledby="tab7-line-tab">7</div>
                                        <div class="tab-pane fade" id="tab8" role="tabpanel" aria-labelledby="tab8-line-tab">8</div>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>
                            </div>                           
                          </td>
                          <td class="text-start">
                            <p class="text-success">
                              10
                            </p>
                          </td>
                          <td class="text-end">
                            <p>
                              10
                            </p>
                          </td>
                          <td class="text-end">18.000.000</td>
                          <td class="text-end">18.000.000</td>
                          <td class="text-end">18.000.000</td>
                          <td class="text-center">shangyang132@gmail.com</td>
                          <td class="text-center">
                            <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                              aria-expanded="false">
                              <i class="icon-lg pb-3px" data-feather="menu"></i>
                            </span>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item fs-6 text-start" href="#">
                                  <i class="icon-lg pb-3px" data-feather="edit-2"></i>
                                  Sửa
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-6 text-start text-danger" href="#">
                                  <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                                  Xóa
                                </a>
                              </li>
                            </ul>
                          </td>
                        </tr>

                        <tr class="total">
                          <td class="text-end" colspan="5">
                            <b>Tổng cộng: </b>
                          </td>
                          <td>
                            <p class="text-success">
                              30
                            </p>
                          </td>
                          <td class="text-end">
                            10
                          </td>
                          <td class="text-end">
                            <b>
                              180.000.000
                            </b>
                          </td>
                          <td class="text-end">
                            <b>
                              180.000.000
                            </b>
                          </td>
                          <td class="text-end">
                            <b>
                              180.000.000
                            </b>
                          </td>
                          <td class="text-center">
                            shangyang132@gmail.com
                          </td>
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