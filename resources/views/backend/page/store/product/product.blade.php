@extends('backend.layout.layout')

@section('title')
    Sản phẩm
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
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
        @include('backend.components.modalconfirm')
        <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-selected="true">Danh sách sản
            phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{'product-sell-price'}}">Có sửa giá bán</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{'product-import-price'}}">Có sửa giá nhập</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{'product-edit-history'}}">Lịch sử nhập xóa</a>
        </li>
      </ul>
      <div class="tab-content mt-4" id="lineTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
          <div class="card-body p-0 pt-2">
            <!-- Start Filter content -->
            <div class="filter">
              <div class="row mb-3">

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_depot_id[]"
                        custom-multiple id="filter_depot_id" multiple multiselect-search="true"
                        multiselect-select-all="true" multiselect-max-items="1">
                        {{printWarehosue($warehouse_model)}}
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="filter_prd_id" maxlength="255" placeholder="ID" id="filter_prd_id"
                        class="form-control" value="">
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="filter_prd_name_or_code" maxlength="255" placeholder="Tên, mã sản phẩm"
                        id="filter_prd_name_or_code" class="form-control" value="">
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_cat_id[]"
                        custom-multiple id="filter_cat_id" multiple multiselect-search="true"
                        multiselect-select-all="true" multiselect-max-items="1">
                        {{printCategories($category_model)}}
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_remain[]"
                        id="filter_remain">
                        <option value="1">Còn tồn</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-1 pt-3">
                  <!-- Example split danger button -->
                  <div class="btn-group">
                    <button type="button" name="submit-filter" class="btn btn-success">Lọc
                    </button>
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
                    <label class="col-form-label text-right col-12 pl-0 pr-0">ID cha</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="filter_prd_parent_id" maxlength="30" id="filter_prd_parent_id"
                        class="form-control" value="">
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">ID từ API</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="privateId" maxlength="30" id="privateId" class="form-control" value="">
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Cha con</label>
                    <div class="col-12 pr-0">
                      <select name="filter_child_parent" id="filter_child_parent" class="form-select">
                        <option value=""></option>
                        <option value="1">Sản phẩm cha</option>
                        <option value="2">Sản phẩm độc lập</option>
                        <option value="3">Sản phẩm con</option>
                        <option value="4">Sản phẩm cha + độc lập</option>
                        <option value="5">Sản phẩm con + độc lập</option>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Danh mục nội
                      bộ</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_cat_inter_id[]"
                        custom-multiple id="filter_cat_inter_id" multiple multiselect-search="true"
                        multiselect-select-all="true" multiselect-max-items="1">
                        {{printCategoryInternal($category_internal_model)}}
                      </select>
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Ngày tạo</label>
                    <div class="col-12 pr-0">
                      <div class="row m-0 input-group">
                        <input type="date" name="filter_created_from" placeholder="Từ"
                          class="form-control tbDatePicker col-6" maxlength="10" autocomplete="off"
                          id="filter_created_from" value="">
                        <input type="date" name="filter_created_to" placeholder="Đến"
                          class=" form-control tbDatePicker col-6 form-control" maxlength="10" autocomplete="off"
                          id="filter_created_to" value="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">IMEI</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="filter_prd_imei" maxlength="100" id="filter_prd_imei"
                        class="form-control" value="">
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Thương
                      hiệu</label>
                    <div class="col-12 pr-0">
                      <select id="filter_brand_id" name="filter_brand_id" style="width: 100%;" class="form-select"
                        data-placeholder="-Thương hiệu-">
                        <option></option>
                        {{printBrand($brand_model)}}
                      </select>
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Loại</label>
                    <div class="col-12 pr-0">
                      <select name="filter_prd_type_id" id="filter_prd_type_id" class="form-select">
                        @php
                        printProductType($product_type_model);
                        @endphp
                      </select>
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhà cung
                      cấp</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="filter_sup_name" maxlength="100" id="filter_sup_name"
                        class="form-control" value="">
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Giá</label>
                    <div class="col-12 pr-0">
                      <select name="filter_price_type" id="filter_price_type" class="form-select">
                        <option value="1">Giá nhập</option>
                        <option value="2">Giá bán</option>
                        <option value="3">Giá cũ</option>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Giá</label>
                    <div class="col-12 pr-0">
                      <div class="row m-0 input-group">
                        <input type="number" name="filter_price_form" placeholder="Từ" maxlength="50"
                          class="form-control form-control col-6" inputmode="decimal" id="filter_price_form" value="">
                        <input type="number" name="filter_price_to" placeholder="Đến" maxlength="50"
                          id="filter_price_to" class=" form-control form-control col-6" inputmode="decimal" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Đặc điểm</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_features[]"
                        custom-multiple id="filter_features" multiple multiselect-search="true"
                        multiselect-select-all="true" multiselect-max-items="1">
                        <option value="1">Có ảnh</option>
                        <option value="2">Không có ảnh</option>
                        <option value="3">Sản phẩm Mới</option>
                        <option value="4">Có VAT</option>
                        <option value="5">Không có VAT</option>
                        <option value="6">Có khối lượng</option>
                        <option value="7">Không có khối lượng</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-check input-group fInputHidden active">
                    <input type="hidden" name="remainByPr" value="0">
                    <input name="remainByPr" id="remainByPr" class="form-check-input col-2" type="checkbox" value="1">
                    <label class="form-check-label col-10" for="remainByPr">
                      Tồn theo SP cha
                    </label>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Tồn</label>
                    <div class="col-12 pr-0">
                      <div class="row m-0 input-group">
                        <input type="number" name="remainFrom" maxlength="50" placeholder="Từ"
                          class="form-control form-control col-6" inputmode="decimal" id="remainFrom" value="">
                        <input type="number" name="remainTo" maxlength="50" placeholder="Đến" id="remainTo"
                          class=" form-control form-control col-6" inputmode="decimal" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Trạng thái tồn</label>
                    <div class="col-12 pr-0">
                      <select name="filter_wa_status" id="filter_wa_status" class="form-select">
                        <option value=""></option>
                        <option value="shipping">Đang giao hàng</option>
                        <option value="transfering">Đang chuyển kho</option>
                        <option value="holding">Tạm giữ</option>
                        <option value="damaged">Lỗi</option>
                        <option value="availableLess">Có thể bán &lt;= 0</option>
                        <option value="availableGreat">Có thể bán &gt; 0</option>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Trạng thái bán</label>
                    <div class="col-12 pr-0">
                      <select name="filter_prd_status_id" id="filter_prd_status_id" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="0">Chưa có trạng thái</option>
                        @php
                        printProductStatusForFilter($product_status_model);
                        @endphp
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End filter content -->
            <div class="mb-3 d-flex align-items-center gap-2">
              <div>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                  Thêm mới
                  <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item fs-5" href="{{ route('add_product') }}">
                      <i class="icon-lg pb-3px" data-feather="plus"></i>
                      Thêm sản phẩm
                    </a>
                  </li>
                </ul>
              </div>
              <div class="btn-group dgColumnSelectors ml-1">
                <button type="button" class="dropdown-toggle btn btn-sm" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">
                  <i class="icon-lg pb-3px" data-feather="columns"></i>
                </button>
                <div role="menu" class="dropdown-menu dropdown-menu-right dropdown-content wmin-lg-600 wmin-350 userDgConfig"
                  x-placement="bottom-end"
                  style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(55px, 32px, 0px);">
                  <div class="dropdown-content-body pb-2">
                    <div class="row list_view">
                      <div class="col-6">
                        <h6 class="mb-0 font-weight-semibold fs-5">Cài đặt ẩn hiện cột:</h6>
                      </div>
                      <div class="text-end col-6">
                        <span class="cursor-pointer resetColumnDisplaySetting">
                          <i class="icon-lg pb-3px" data-feather="refresh-ccw"></i>
                          Quay về mặc định
                        </span>
                      </div>
                      <div class="dropdown-divider col-xl-12"></div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="id" value="id" class="dgColumn mr-1" data-colspan="colSumary"
                            data-class="dgColId" data-target="0">
                          ID
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="imagemanager" value="imagemanager" class="dgColumn mr-1" checked=""
                            data-colspan="colSumary" data-class="dgColImagemanager" data-target="1"> Ảnh
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="barcode" value="barcode" class="dgColumn mr-1" checked=""
                            data-colspan="colSumary" data-class="dgColBarcode" data-target="2"> Mã
                          vạch
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="code" value="code" class="dgColumn mr-1" checked="" data-colspan="colSumary"
                            data-class="dgColCode" data-target="3"> Mã
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="importPrice" value="importPrice" class="dgColumn mr-1" data-colspan="colSumary"
                            data-class="dgColImportPrice" data-target="4">
                          Giá nhập
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="avgCost" value="avgCost" class="dgColumn mr-1" checked=""
                            data-colspan="colSumary" data-class="dgColAvgCost" data-target="5"> Giá
                          vốn
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="price" value="price" class="dgColumn mr-1" checked="" data-colspan="colSumary"
                            data-class="dgColPrice" data-target="6"> Giá
                          bán
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="priceVat" value="priceVat" class="dgColumn mr-1" data-colspan="colSumary"
                            data-class="dgColPriceVat" data-target="7"> Giá
                          bán + VAT
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="wholesalePrice" value="wholesalePrice" class="dgColumn mr-1"
                            data-colspan="colSumary" data-class="dgColWholesalePrice" data-target="8"> Giá sỉ
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="wholesalePriceVat" value="wholesalePriceVat" class="dgColumn mr-1"
                            data-colspan="colSumary" data-class="dgColWholesalePriceVat" data-target="9"> Giá sỉ +
                          VAT
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="quantityRemain" value="quantityRemain" class="dgColumn mr-1" checked=""
                            data-class="dgColQuantityRemain" data-target="10"> Tồn
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="totalQuantityRemain" value="totalQuantityRemain" class="dgColumn mr-1"
                            data-class="dgColTotalQuantityRemain" data-target="11"> Tổng tồn
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="quantityDamaged" value="quantityDamaged" class="dgColumn mr-1"
                            data-class="dgColQuantityDamaged" data-target="12"> Hàng lỗi
                          <i class="icon-lg pb-3px" data-feather="alert-triangle"></i>
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="quantityShipping" value="quantityShipping" class="dgColumn mr-1" checked=""
                            data-class="dgQuantityColShipping" data-target="13"> Đang giao
                          hàng
                          <i class="icon-lg pb-3px" data-feather="truck"></i>
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="remainByDepot" value="remainByDepot" class="dgColumn mr-1" checked=""
                            data-class="dgColRemainByDepot" data-target="14"> Tồn
                          trong kho <i class="icon-lg pb-3px" data-feather="layers"></i>
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="transfering" value="transfering" class="dgColumn mr-1"
                            data-class="dgColTransfering" data-target="15"> Đang chuyển kho
                          <i class="icon-lg pb-3px" data-feather="repeat"></i>
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="quantityHold" value="quantityHold" class="dgColumn mr-1" checked=""
                            data-class="dgColQuantityHold" data-target="16"> Tạm giữ
                          <i class="icon-lg pb-3px" data-feather="archive"></i>
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="quantityAvailable" value="quantityAvailable" class="dgColumn mr-1" checked=""
                            data-class="dgColQuantityAvailable" data-target="17"> Có thể bán <i class="icon-lg pb-3px" data-feather="check-square"></i>
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="status" value="status" class="dgColumn mr-1" checked="" data-class="dgColStatus" data-target="18">
                          Bán
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="waittings" value="waittings" class="dgColumn mr-1" data-class="dgColWaittings" data-target="19">
                          Chờ nhập hàng
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="preOrder" value="preOrder" class="dgColumn mr-1" data-class="dgColPreOrder" data-target="20"> Đặt
                          trước
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="action" value="action" class="dgColumn mr-1" checked="" data-class="dgColAction" data-target="21">
                          Thao tác <i class="icon-lg pb-3px" data-feather="settings"></i>
                        </label>
                      </div>
                      <div class="col-lg-4 col-6 dropdown-item">
                        <label class="d-flex align-items-center gap-2 mb-0">
                          <input type="checkbox" name="unit" value="unit" class="dgColumn mr-1" data-colspan="colSumary"
                            data-class="dgColUnit" data-target="22"> Đơn vị tính
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive overflow-hidden">
            <div id="dataTableProduct_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
              <div class="row">
                <div class="col-sm-12 table-responsive">
                  <table id="dataTableProduct" class="table dataTable no-footer table-bordered display"
                    aria-describedby="dataTableProduct_info">
                    <thead class="table-light">
                      <tr>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          ID
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Ảnh
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Mã vạch
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Mã
                        </th>
                        <th class="sorting text-black text-center sorting_asc" tabindex="0"
                          aria-controls="dataTableProduct" rowspan="1" colspan="1" aria-sort="ascending">
                          Tên
                        </th>
                        <th class="sorting text-black text-center sorting_asc" tabindex="0"
                          aria-controls="dataTableProduct" rowspan="1" colspan="1" aria-sort="ascending">
                          ĐVT
                        </th>
                        <th class="sorting text-black text-center sorting_asc" tabindex="0"
                          aria-controls="dataTableProduct" rowspan="1" colspan="1" aria-sort="ascending">
                          Giá nhập
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Giá vốn
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Giá bán
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Giá bán + VAT
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Giá sỉ
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Giá sỉ + VAT
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Tồn
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top" title="Lỗi">
                          <i class="icon-lg text-warning pb-3px" data-feather="alert-triangle"></i>
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                          title="Đang giao hàng">
                          <i class="icon-lg text-primary pb-3px" data-feather="truck"></i>
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                          title="Tồn trong kho">
                          <i class="icon-lg text-black pb-3px" data-feather="layers"></i>
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                          title="Đang chuyển kho">
                          <i class="icon-lg text-black pb-3px" data-feather="repeat"></i>
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top" title="Tạm giữ">
                          <i class="icon-lg text-orange pb-3px" data-feather="archive" style="color: #fd7e14"></i>
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top" title="Có thể bán">
                          <i class="icon-lg text-success pb-3px" data-feather="check-square"></i>
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                          title="Chờ nhập hàng">
                          <i class="icon-lg text-black pb-3px" data-feather="plus"></i>
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Đặt trước
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          Bán
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct"
                          rowspan="1" colspan="1">
                          <i class="icon-lg text-black pb-3px" data-feather="settings"></i>
                        </th>
                      </tr>
                    </thead>
                    <tbody>

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
{{--model1--}}
<div class="modal fade modal-lg" id="uploadImgModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Ảnh sản phẩm
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex align-items-center justify-content-between gap-3">
        <div>
          <input class="form-control btn btn-success" name="prd_image" type="file" id="fastuploadProductImage">
        </div>
        <div>
          <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top"
            title="Để thay đổi thứ tự hiển thị ảnh trên website: Kéo thả ảnh và bấm nút Cập nhật vị trí">
            <i class="icon-lg text-black pb-3px" data-feather="help-circle"></i>
          </span>
          <button type="button" class="btn btn-primary" style="margin-left: 8px">
            <i class="icon-lg text-white pb-3px" data-feather="save"></i>
            Cập nhật vị trí
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
{{--model2--}}
<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Sửa trạng thái
        </h5>
      </div>
      <div class="modal-body d-flex align-items-center justify-content-between gap-3">
        <span>
          Trạng thái bán:
        </span>
        <select class="form-select">
          <option selected>Mới</option>
          <option value="1">Đang bán</option>
          <option value="2">Ngừng bán</option>
          <option value="3">Hết hàng</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Cập nhật</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

<script>
var token = localStorage.getItem("Token");
// var storedColumnPrefs = localStorage.setItem('columnVisibility');
// var = [false,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true]
$(document).ready(function () {
  var dataTable = $('#dataTableProduct').DataTable({
    serverSide: true,
    scrollX: true,
    scrollY: "600px",
    autoHeight: false,
    fixedHeader: true,
    ajax: {
      url: '{{route('product.all')}}',
      type: 'GET',
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (data) {
        data.page = (data.start / data.length) + 1;
        data.per_page = data.length;
        data.search = data.search.value;

        data.filter_depot_id = $('#filter_depot_id').val();
        data.filter_prd_id = $('input[name="filter_prd_id"]').val();
        data.filter_prd_name_or_code = $('input[name="filter_prd_name_or_code"]').val();
        data.filter_cat_id = $('#filter_cat_id').val();
        data.filter_cat_inter_id = $('#filter_cat_inter_id').val();
        data.filter_prd_parent_id = $('input[name="filter_prd_parent_id"]').val();
        data.filter_child_parent = $('select[name="filter_child_parent"]').val();
        data.filter_created_from = $('input[name="filter_created_from"]').val();
        data.filter_created_to = $('input[name="filter_created_to"]').val();
        data.filter_prd_imei = $('input[name="filter_prd_imei"]').val();
        data.filter_brand_id = $('input[name="filter_brand_id"]').val();
        data.filter_prd_type_id = $('select[name="filter_prd_type_id"]').val();
        data.filter_sup_name = $('input[name="filter_sup_name"]').val();
        data.filter_price_type = $('select[name="filter_price_type"]').val();
        data.filter_price_form = $('input[name="filter_price_form"]').val();
        data.filter_price_to = $('input[name="filter_price_to"]').val();
        data.filter_features = $('#filter_features').val();
        data.filter_prd_status_id = $('select[name="filter_prd_status_id"]').val();
      },
      dataSrc: function (response) {
        response.recordsTotal = response.data.total;
        response.recordsFiltered = response.data.total;
        return response.data.data;
      },
      error: function (xhr) {
        if (xhr.status === 404) {
          $('#dataTableProduct').html(
            '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
          );
        }
      }
    },
    columns: [
      {
        data: 'prd_id',
        name: 'prd_id',
      },
      {
        data: 'product_detail.pd_image',
        name: 'product_detail.pd_image',
        render: function (data, type, row) {
          var id = row.prd_id;
          if (data && data.length > 0 && data !== "") {
            var imageUrl = '/storage/' + data;
            return '<img src="' + imageUrl + '" alt="Product Image" width="50">';
          } else {
            // var col = `<a class="cursor-pointer text-center fs-5" href="{{route('edit_product')}}?id=${id}"'>
            //     <i class="fa-solid fa-circle-plus text-success"></i>
            //   </a>`;
            // return col;
            var col = '<span class="cursor-pointer text-center" data-bs-toggle="modal" onclick="uploadImage(' + id + ')">';
            col += '<i class="fa-solid fa-circle-plus text-success"></i>';
            col += '</span>';
            return col;
          }
        }
      },
      {
        data: 'prd_barcode',
        name: 'prd_barcode',
      },
      {
        data: null,
        name: 'prd_code',
        render: function (data, type, row) {
          if (data.prd_code) {
            return data.prd_code;
          } else {
            return '';
          }
        }
      },
      {
        data: null,
        name: 'prd_name',
        render: function (data, type, row) {
          if (data.prd_name) {
            return data.prd_name;
          } else {
            return '';
          }
          // var id = row.prd_id;
          // if (data.prd_name) {
          //   var col = `<a href="{{route('detail_product')}}?id=${id}">${data.prd_name}<a>`;
          //   return col;
          // } else {
          //   return '';
          // }
        }
      },
      {
        data: 'product_detail.pd_unit',
        name: 'product_detail.pd_unit',
        render: function (data, type, row) {
          return data ? data : '';
        }
      },
      {
        data: 'product_detail.pd_import_price',
        name: 'product_detail.pd_import_price',
        render: function (data, type, row) {
          return data ? data : 0;
        }
      },
      {
        data: 'product_detail.pd_import_price',
        name: 'product_detail.pd_avg_cost',
        render: function (data, type, row) {
          var avgCost = data ? parseFloat(data) : 0;
          return avgCost.toFixed(2);
        }
      },
      {
        data: 'product_detail.pd_price',
        name: 'product_detail.pd_price',
        render: function (data, type, row) {
          return data ? data : 0;
        }
      },
        {
            data: 'product_detail',
            name: 'product_detail.pd_price_vat',
            render: function (data, type, row) {
                var price = data.pd_price ? parseFloat(data.pd_price) : 0;
                var vat = data.pd_vat ? parseFloat(data.pd_vat) : 0;
                var priceWithVat = price + (price * (vat / 100));
                var col = '<p>' + priceWithVat.toFixed(2) + '<p>';
                if (vat > 0) {
                    col += '<p> VAT : ' + vat + '%<p>';
                }
                return col;
            }
        },
      {
        data: 'product_detail.pd_wholesale_price',
        name: 'product_detail.pd_wholesale_price',
        render: function (data, type, row) {
          return data ? data : 0;
        }
      },
      {
        data: 'product_detail',
        name: 'product_detail.pd_wholesale_price_vat',
        render: function (data, type, row) {

            var price = data.pd_wholesale_price ? parseFloat(data.pd_wholesale_price) : 0;
            var vat = data.pd_vat ? parseFloat(data.pd_vat) : 0;
            var priceWithVat = price + (price * (vat / 100));
            var col = '<p>' + priceWithVat.toFixed(2) + '<p>';
            if (vat > 0) {
                col += '<p> VAT : ' + vat + '%<p>';
            }
            return col;
        }
      },
      {
        data: 'total_quantity',
        name: 'total_quantity',
        render: function (data, type, row) {
          return data ? data : 0;
        }
      },
      {
        data: 0,
        name: 'total_quantity_defective',
        render: function (data, type, row) {
          return data ? data : 0;
        }
      },
      {
        data: '',
        name: 'Đang giao hàng',
        render: function (data, type, row) {
          return data ? data : '';
        }
      },
      {
        data: '',
        name: 'Tồn trong kho',
        render: function (data, type, row) {
          return data ? data : '';
        }
      },
      {
        data: '',
        name: 'Đang chuyển kho',
        render: function (data, type, row) {
          return data ? data : '';
        }
      },
      {
        data: '',
        name: 'Tạm giữ',
        render: function (data, type, row) {
          return data ? data : '';
        }
      },
      {
        data: '',
        name: 'Có thể bán',
        render: function (data, type, row) {
          return data ? data : '';
        }
      },
      {
        data: '',
        name: 'Chờ nhập hàng',
        render: function (data, type, row) {
          return data ? data : '';
        }
      },
      {
        data: '',
        name: 'Nhập trước',
        render: function (data, type, row) {
          return data ? data : '';
        }
      },
      {
        data: '',
        name: "Đặt trước",
        render: function (data, type, row) {
          var col = '<span class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#changeStatusModal"><i class="icon-lg pb-3px" data-feather="repeat"></i></span>';
          return col;
        }
      },
      {
        data: 'action',
        name: 'action',
        render: function (data, type, row) {
          var id = row.prd_id;
          return `<td class="text-center">
                  <span class="dropdown-toggle cursor-pointer"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-solid fa-bars"></i>
                  </span>
                  <ul class="dropdown-menu">
                        <li>
                          <a class="dropdown-item fs-5" href="{{route('edit_product')}}?id=${id}">
                              <i class="fa-regular fa-pen-to-square"></i>
                              Sửa
                          </a>
                      </li>
                       <li>
                          <a class="dropdown-item fs-5" href="{{route('barcode_product')}}?id=${id}">
                              <i class="fa-regular fa-pen-to-square"></i>
                              In mã vạch sản phẩm trong phiếu
                          </a>
                      </li>
                        <li>
                          <a class="dropdown-item fs-5 text-danger delete-item" onclick="deleteProduct(${id})">
                              <i class="fa-solid fa-trash text-danger"></i>
                              Xóa
                          </a>
                      </li>
                  </ul>
              </td>`;
        }
      },
    ],
    searching: false,
    language: {
      search: "",
      sProcessing: "Đang xử lý...",
      sLengthMenu: "_MENU_",
      sZeroRecords: "Không tìm thấy kết quả",
      sEmptyTable: "Không tìm thấy kết quả",
      sInfo: "Hiển thị _START_ cho đến _END_ trong tổng số _TOTAL_",
      sInfoEmpty: "Hiển thị 0 cho đến 0 trong tổng số 0",
      sInfoFiltered: "(Được lọc từ _MAX_)",
      sInfoPostFix: "",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Đang tải...",
      oPaginate: {
        "sFirst": "<<",
        "sLast": ">>",
        "sNext": ">",
        "sPrevious": "<"
      },
      "oAria": {
        "sSortAscending": ": Sắp xếp cột theo thứ tự tăng dần",
        "sSortDescending": ": Sắp xếp cột theo thứ tự giảm dần"
      }
    },
    lengthMenu: [
      [10, 25, 50],
      [10, 25, 50]
    ],
    pageLength: 10,
  });  

  // Load column visibility preferences from local storage
  var storedColumnPrefs = localStorage.getItem('columnVisibility');
  if (storedColumnPrefs) {
    var columnPrefs = JSON.parse(storedColumnPrefs);
    dataTable.columns().visible(false); // Hide all columns initially
    $.each(columnPrefs, function (index, isVisible) {
      dataTable.column(index).visible(isVisible);
      $('.dgColumn[data-target="' + index + '"]').prop('checked', isVisible);
    });
  }

  // Update column visibility and store in local storage
  $('.dgColumn').on('change', function () {
    var column = dataTable.column($(this).attr('data-target'));
    column.visible(!column.visible());

    var columnPrefs = [];
    dataTable.columns().every(function () {
        columnPrefs.push(this.visible());
    });
    localStorage.setItem('columnVisibility', JSON.stringify(columnPrefs));
  });

  $('.resetColumnDisplaySetting').on('click', function () {
    localStorage.removeItem('columnVisibility');
    dataTable.columns().visible(true); // Show all columns
    $('.toggle-column').prop('checked', true);
  });

  $('button[name=submit-filter]').click(function () {
    dataTable.ajax.reload();
  });
});
function uploadImage(id) {
  $('#uploadImgModal').modal('show');
  var fileInput = $('#fastuploadProductImage');
  fileInput.val(null); // Reset the value of the file input

  // Add 'change' event handler only once
  fileInput.off('change').on('change', function (event) {
    var fileInput = event.target;
    var file = fileInput.files[0];
    if (file) {
      var formData = new FormData();
      formData.append('pd_image', file);
      formData.append('pd_id', id);
      $.ajax({
        url: '{{route('product.fastupload')}}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function (xhr) {
          xhr.setRequestHeader("Authorization", "Bearer " + token);
        },
        success: function (response) {
          var dataTable = $('#dataTableProduct').DataTable();
          dataTable.ajax.reload();
          toastr.success(response.message, 'Thành công');
          $('#uploadImgModal').modal('hide');
        },
        error: function (error) {
          $('#uploadImgModal').modal('hide');
          if (error.responseJSON && error.responseJSON.message) {
            toastr.error(error.responseJSON.message, 'Lỗi');
          }
        }
      });
    }
  });
}
  function deleteProduct(id) {
      $('#confirmModal').modal('show');

      $('#modal-confirm-confirmed').off('click').on('click', function () {
          $.ajax({
              url: '{{route('product.delete')}}',
              method: 'DELETE',
              data: {
                  id: id
              },
              beforeSend: function (xhr) {
                  xhr.setRequestHeader("Authorization", "Bearer " + token);
                  $('#modal-content-block').hide();
                  $('#modal-loading-block').show();
              },
              success: function (response) {
                  toastr.success(response.message, 'Thành công');
                  var dataTable = $('#dataTableProduct').DataTable();
                  var row = dataTable.row('#row-' + id);
                  row.remove().draw(false);
                  $('#confirmModal').modal('hide');
              },
              error: function (error) {
                  if (error.responseJSON && error.responseJSON.message) {
                      toastr.error(error.responseJSON.message, 'Lỗi');
                  }
                  $('#confirmModal').modal('hide');
              }
          });
      });
  }

</script>

<script>
  $( '#filter_remain' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  } );
  $( '#filter_child_parent' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  } );
  $( '#filter_brand_id' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  } );
  $( '#filter_prd_type_id' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  } );
  $( '#filter_price_type' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  } );
  $( '#filter_wa_status' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  } );
  $( '#filter_prd_status_id' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  } );
</script>

@endsection