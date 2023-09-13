@extends('backend.layout.layout')

@section('title')
Thêm danh sản phẩm
@endsection

@section('style')
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

<style>
  .select2-container--bootstrap-5
  .select2-selection--multiple
  .select2-selection__rendered {
    flex-wrap: nowrap;
  }
</style>

<style>
  .ck-editor__editable[role="textbox"] {
      /* editing area */
      min-height: 200px;
  }
  .ck-content .image {
      /* block images */
      max-width: 80%;
      margin: 20px auto;
  }
</style>

@endsection

@section('content')

@include('backend.components.properties_modal')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Bảng điều khiển</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('product') }}">Sản phẩm</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
            aria-controls="home" aria-selected="true">Thông tin cơ bản</a>
        </li>
      </ul>
      <div class="tab-content mt-3" id="lineTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
          <form id="productAddForm" class="form-add-custom" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
              <div class="col-12 col-md-6">
                <div class="card p-3">
                  <div class="form-group mb-2">
                    <div class="row">
                      <label class="col-5 col-lg-2 col-form-label">Tên <span class="text-danger">*</span></label>
                      <div class="col-7 col-lg-10">
                        <input type="text" name="prd_name" maxlength="255" class="required form-control"
                          autofocus="autofocus" id="prd_name" autocomplete="off" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label">Loại <span class="text-danger">*</span></label>
                          <div class="col-7 col-lg-8 pr-lg-0">
                            <select name="prd_type_id" id="prd_type_id" class="required form-select"
                              data-placeholder="Chọn loại">
                              @php
                              printProductType($product_type_model);
                              @endphp
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label">Sản phẩm cha</label>
                          <div class="col-7 col-lg-8 pr-lg-0">
                            <select name="prd_parent_id" id="prd_parent_id" class="required form-select"
                              data-placeholder="Chọn loại">
                              @php
                              printProductType($product_type_model);
                              @endphp
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label">Mã</label>
                          <div class="col-7 col-lg-8 pr-lg-0">
                            <input type="text" name="prd_code" maxlength="255" id="prd_code" autocomplete="off"
                              class="form-control" value="">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label text-lg-right">Mã
                            vạch</label>
                          <div class="col-7 col-lg-8 pl-lg-0">
                            <input type="text" name="prd_barcode" maxlength="255" id="prd_barcode" autocomplete="off"
                              class="form-control" value="">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label">Giá nhập</label>
                          <div class="col-7 col-lg-8 pr-lg-0">
                            <input type="number" name="pd_import_price" maxlength="255"
                              class="autoNumeric text-right form-control" id="pd_import_price"
                              autocomplete="off" value="">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label text-lg-right">VAT</label>
                          <div class="col-7 col-lg-8 pl-lg-0">
                            <div class="input-group">
                              <input type="number" name="pd_vat" maxlength="255"
                                class="autoNumeric text-right form-control" placeholder=""
                                id="pd_vat" autocomplete="off" value="">
                              <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label">Giá bán</label>
                          <div class="col-7 col-lg-8 pr-lg-0">
                            <input type="number" name="pd_price" maxlength="255"
                              class="autoNumeric text-right form-control" id="pd_price"
                              autocomplete="off" value="">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label text-lg-right">Giá
                            sỉ</label>
                          <div class="col-7 col-lg-8 pl-lg-0">
                            <input type="number" name="pd_wholesale_price" maxlength="255"
                              class="autoNumeric text-right form-control" id="pd_wholesale_price"
                              autocomplete="off" value="">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label">Giá cũ</label>
                          <div class="col-7 col-lg-8 pr-lg-0">
                            <input type="number" name="pd_old_price" maxlength="255"
                              class="autoNumeric text-right form-control" id="pd_old_price"
                              autocomplete="off" value="">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label text-lg-right">Trạng thái</label>
                          <div class="col-7 col-lg-8 pl-lg-0">
                            <select name="prd_status_id" id="prd_status_id" class="form-select form-control">
                              @php
                              printProductStatus($product_status_model);
                              @endphp
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="card p-3">
                  <div class="form-group mb-2">
                    <div class="row">
                      <label class="col-5 col-lg-3 col-form-label">Danh mục<span class="text-danger">*</span></label>
                      <div class="col-7 col-lg-9 d-flex align-items-center">
                        <div class="input-group">
                          <select name="cat_id" id="cat_id" class="form-select" data-placeholder="Chọn một danh mục">
                            <option value="">- Danh mục -</option>
                          </select>
                        </div>
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <a href="<?= Route('create-category') ?>" id="btn-create-category" style="cursor: pointer">
                              <i class="icon-lg pb-3px text-success" data-feather="plus"></i>
                            </a>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <div class="row">
                      <label class="col-5 col-lg-3 col-form-label">Danh mục nội bộ</label>
                      <div class="col-7 col-lg-9 d-flex align-items-center">
                        <div class="input-group">
                          <select name="cat_inter_id" id="cat_inter_id" class="form-select"
                            data-placeholder="Chọn một danh mục nội bộ">
                            <option value="">- Danh mục nội bộ -</option>
                          </select>
                        </div>
                        <div class="input-group-prepend">
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Dùng khi bạn muốn có thêm 1 hệ danh mục sản phẩm khác với danh mục hiển thị trên website để phân tích số liệu">
                            <i class="icon-lg pb-3px text-primary" data-feather="help-circle"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-3 col-form-label">Thương hiệu</label>
                          <div class="col-7 col-lg-9">
                            <select name="brand_id" id="brand_id" class="form-select"
                              data-placeholder="Chọn một thương hiệu">
                              <option value="">- Thương hiệu -</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-6 col-form-label">Khối lượng</label>
                          <div class="col-6 pr-lg-0">
                            <div class="input-group">
                              <input type="number" name="pd_shipping_weight" maxlength="255" placeholder=""
                                class="text-right form-control" id="pd_shipping_weight"
                                autocomplete="off" value="">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Gr</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-form-label text-lg-right">Đơn vị
                            tính</label>
                          <div class="col-7 pl-lg-0">
                            <input type="text" name="pd_unit" maxlength="255"
                              placeholder="VD: cái, chiếc, hộp, lon, gói..." id="pd_unit" autocomplete="off"
                              class="form-control" value="">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <div class="row">
                      <label class="col-5 col-lg-3 col-form-label">Kích thước (cm)</label>
                      <div class="col-7 col-lg-9">
                        <div class="input-group">
                          <input type="number" name="pd_lenght" maxlength="255" placeholder="Dài"
                            class="text-right form-control" id="pd_lenght" autocomplete="off"
                            value="">
                          <input type="number" name="pd_width" maxlength="255" placeholder="Rộng"
                            class="text-right form-control" id="pd_width" autocomplete="off"
                            value="">
                          <input type="number" name="pd_height" maxlength="255" placeholder="Cao"
                            class="text-right form-control" id="pd_height" autocomplete="off"
                            value="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <div class="row">
                      <label class="col-5 col-lg-3 col-form-label">Ảnh đại diện</label>
                      <div class="col-7 col-lg-9">
                      <div class="media mt-0">
                        <input type="hidden" name="imageAvatar" class="imageUploadFile" id="imageAvatar" value="">
                        <div class="media-body">
                          <div class="uniform-uploader" id="uniform-pd_image">
                            <input type="file" name="pd_image" class="businessFileUpload form-control" accept="image/*" data-url=""
                              id="pd_image"><span class="filename" style="user-select: none;">Chọn file gif, png, jpg, bmp &lt;=
                              4MB</span>
                          </div>
                        </div>
                        <div class="imageArea col-3 align-self-center">
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12 col-md-6">
                <div class="card mb-3">
                  <div
                    class="card-header header-elements-inline bg-light d-flex align-items-center justify-content-between">
                    <h5 class="card-title font-weight-semibold mb-0">
                      <i class="icon-lg pb-3px" data-feather="tool"></i>
                      Bảo hành
                    </h5>
                    <div class="header-elements">
                      <div class="list-icons">
                        <a class="list-icons-item" data-bs-toggle="collapse" href="#list-tools-item"
                          aria-expanded="false" aria-controls="list-tools-item">
                          <i class="icon-xl pb-3px" data-feather="chevron-down"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body collapse show" id="list-tools-item">
                    <div class="form-group mb-2 row">
                      <label class="col-5 col-lg-3">Xuất xứ</label>
                      <div class="col-7 col-lg-9">
                        <select name="country_id" id="country_id" class="form-select" data-placeholder="Chọn xuất xứ">
                          <option value="">- Quốc gia -</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group mb-2 row">
                      <label class="col-5 col-lg-3">Địa chỉ bảo hành </label>
                      <div class="col-7 col-lg-9">
                        <input type="text" name="wa_address" id="wa_address" autocomplete="off" class="form-control"
                          value="">
                      </div>
                    </div>
                    <div class="form-group mb-2 row">
                      <label class="col-5 col-lg-3">Số điện thoại </label>
                      <div class="col-7 col-lg-9">
                        <input type="text" name="wa_tel" maxlength="10" id="wa_tel"
                          autocomplete="off" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group mb-2 row">
                      <label class="col-5 col-lg-3">Số tháng bảo hành </label>
                      <div class="col-7 col-lg-9">
                        <input type="number" name="wa_num_month" maxlength="255" id="wa_num_month"
                          autocomplete="off" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group mb-2 row">
                      <label>Nội dung bảo hành </label>
                      <div class="form-group mb-2" id="productContent">
                      <textarea name="wa_content" maxlength="255" id="wa_content" class="editor form-control" autocomplete="off" style="display: none;"></textarea>
                        <div style="height: 400px;" class="h-100" id="editor"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="card mb-3">
                  <div
                    class="card-header header-elements-inline bg-light d-flex align-items-center justify-content-between">
                    <h5 class="card-title font-weight-semibold mb-0">
                      <i class="icon-lg pb-3px" data-feather="box"></i>
                      Tồn đầu
                    </h5>
                    <div class="header-elements">
                      <div class="list-icons">
                        <a class="list-icons-item" data-bs-toggle="collapse" href="#list-images-item"
                          aria-expanded="false" aria-controls="list-images-item">
                          <i class="icon-xl pb-3px" data-feather="chevron-down"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body collapse show" id="list-images-item">
                    <div class="row">
                      <div class="col-12 col-lg-6">
                        <div class="form-group mb-2">
                          <div class="row">
                            <label class="col-5 col-lg-6 col-form-label">Số lượng</label>
                            <div class="col-7 col-lg-6 pr-lg-0">
                              <input type="number" name="pd_first_remain" class="form-control text-right form-control"
                                maxlength="255" placeholder="" id="pd_first_remain"
                                autocomplete="off" value="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-2">
                      <div class="row">
                        <label class="col-5 col-lg-3 col-form-label">Cửa hàng</label>
                        <div class="col-7 col-lg-9">
                          <select name="w_id" id="w_id" class="form-select"
                            data-placeholder="Chọn một cửa hàng">
                            <option value="">- Cửa hàng -</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-2">
                      <div class="row">
                        <label class="col-5 col-lg-3 col-form-label">Nhà cung cấp</label>
                        <div class="col-7 col-lg-9 d-flex align-items-center">
                          <select name="sup_id" id="sup_id" class="form-select" data-placeholder="Chọn nhà cung cấp">
                            <option value="">- Nhà cung cấp -</option>
                          </select>
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <a href="<?= Route('suppliers.create') ?>" id="btn-create-supplier">
                                <i class="icon-lg pb-3px text-success" data-feather="plus"></i>
                              </a>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card mb-3">
                  <div
                    class="card-header header-elements-inline bg-light d-flex align-items-center justify-content-between">
                    <ul class="nav nav-tabs nav-tabs-line" id="variantTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="buy-price-line-tab" data-bs-toggle="tab" href="#tab-variant"
                          role="tab" aria-controls="tab-variant" aria-selected="false">
                          <i class="icon-lg pb-3px" data-feather="check-square"></i>
                          Thuộc tính
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="history-line-tab" data-bs-toggle="tab" href="#tab-create-child"
                          role="tab" aria-controls="tab-create-child" aria-selected="false">
                          <i class="icon-lg pb-3px" data-feather="share-2"></i>
                          Tạo sản phẩm con
                        </a>
                      </li>
                    </ul>
                    <div class="header-elements">
                      <div class="list-icons">
                        <a class="list-icons-item" data-bs-toggle="collapse" href="#list-prod-item"
                          aria-expanded="false" aria-controls="list-prod-item">
                          <i class="icon-xl pb-3px" data-feather="chevron-down"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body collapse show" id="list-prod-item">
                    <div class="tab-content" id="variantTabContent">
                      <div class="tab-pane fade show active" id="tab-variant" role="tabpanel"
                        aria-labelledby="buy-price-line-tab">
                        <div class="row">
                          <div id="attributeCard" class="col-12 col-md-6">
                            <div class="alert alert-info">Vui lòng <b>chọn danh mục</b> trước.</div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="tab-create-child" role="tabpanel"
                        aria-labelledby="history-line-tab">
                        <style>
                          .attrSe.form-control:not(.select2-hidden-accessible),
                          .attrSe.form-control:not(.select2-hidden-accessible)+.input-group-append {
                            pointer-events: none;
                          }

                          .attrSe.form-control {
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            text-indent: 1px;
                            text-overflow: '';
                          }

                          .content-wrapper {
                            /* Fix lỗi khi chọn select2 bị tràn màn hình */
                            max-width: 100%;
                          }

                          .extRenderImg .fa-minus-circle {
                            right: 0;
                            top: -6px;
                            display: none;
                          }

                          .extRenderImg:hover .fa-minus-circle {
                            display: inline-block;
                          }

                          .extRenderImg img {
                            width: 40px;
                          }

                          .has-search .form-control {
                            padding-right: 2.375rem;
                          }

                          .has-search .form-control-feedback {
                            position: absolute;
                            z-index: 2;
                            display: block;
                            width: 2.375rem;
                            height: 2.375rem;
                            line-height: 2.375rem;
                            text-align: center;
                            pointer-events: none;
                            color: #aaa;
                            right: 0;
                          }

                          .rowItemAttr .dropdown-menu {
                            overflow-y: scroll;
                            max-height: 300px;
                          }

                          .table-attributes .order-attr {
                            width: 61px;
                            height: 35px;
                            left: 701px;
                            top: 125px;
                            border: 1px solid #EEEEEE;
                            border-radius: 2px;
                          }

                          .table-attributes .select2-container--default.select2-container--focus .select2-selection--multiple {
                            border: 1px solid #ddd;
                          }

                          .table-attributes .btn-outline-secondary {
                            min-width: 135px;
                            text-align: left;
                          }

                          .table-attributes .btn-outline-secondary.dropdown-toggle,
                          .table-attributes .btn-outline-secondary:target,
                          .table-attributes .btn-outline-secondary:active,
                          .table-attributes .btn-outline-secondary:hover {
                            background-color: transparent !important;
                            color: #777 !important;
                          }

                          .childProductsCardBody thead th,
                          .childProductsCardBody tbody td {
                            padding: .5rem;
                            border: none;
                          }

                          .table-attributes thead th {
                            white-space: nowrap;
                          }

                          .attributeCombinatedTable .table-responsive {
                            overflow-x: auto !important;
                          }

                          .childProduct .extendName,
                          .childProduct .extendCode,
                          .childProduct .extendBarcode {
                            min-width: 160px !important;
                          }

                          .childProduct .extendPriceImport,
                          .childProduct .extendPrice {
                            min-width: 120px !important;
                          }

                          .childProduct .extendQuantity {
                            min-width: 90px !important;
                          }

                          .childProduct .extendLength,
                          .childProduct .extendWidth,
                          .childProduct .extendHeight {
                            min-width: 90px !important;
                          }

                          #defaultModal,
                          #createAttrChildModal,
                          #fullScreenImage,
                          #confirmDelImg {
                            background: rgb(0 0 0 / 50%);
                          }

                          @media (min-width: 992px) {
                            .table-attributes select.attrSe {
                              min-width: 300px;
                            }
                          }

                          @media (min-width: 1200px) {

                            .table-attributes select.attrSe,
                            .table-attributes .select2.select2-container {
                              max-width: 450px;
                            }
                          }

                          .rowItemAttr .dropdown-toggle:after {
                            right: 15px;
                            position: absolute;
                          }
                        </style>
                        <style id="displayColumnStyle">
                          .colExtBarcode,
                          .colExtPriceImport,
                          .colExtPrice,
                          .colExtOther {
                            display: none !important;
                          }
                        </style>
                        <div id="childAttrWarning">
                          <div class="alert alert-info">Vui lòng <b>chọn danh mục</b> trước.</div>
                        </div>
                        <div id="childAttrPartial" class="d-none">
                          <div class="row">
                            <div class="col-12 col-xl-6">
                              <div class="form-check d-flex align-items-center">
                                <div class="form-check form-switch">
                                  <input id="copyParentImage" name="copyParentImage" type="checkbox"
                                    class="form-check-input" role="switch" value="1">
                                </div>
                                <label class="label-checkbox cursor-pointer" for="copyParentImage">
                                  Copy ảnh sản phẩm cha cho sản phẩm con
                                </label>
                              </div>
                              <div class="childProductsCardBody mt-2">
                                <table class="table table-attributes no-footer" data-hasblockrows="1">
                                  <thead class="table-light">
                                    <tr>
                                      <th class="text-left text-black">Tên thuộc tính</th>
                                      <th class="text-black">Giá trị</th>
                                      <th class="text-black">
                                        Thứ tự
                                        <i class="icon-lg pb-3px text-primary" data-feather="help-circle" data-toggle="tooltip" title="" data-original-title="Thứ tự hiển thị thuộc tính trong tên và mã sản phẩm con"></i>
                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody></tbody>
                                </table>
                              </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between align-items-end">
                              <a href="<?= Route('create-variant') ?>" id="btn-create-new-attribute"
                                class="btn btn-outline-primary cursor-pointer mt-3 mb-2">
                                <i class="icon-lg pb-3px" data-feather="plus"></i>
                                Thêm thuộc tính
                              </a>
                              <div class="btn-group dgColumnSelectors ml-1">
                                <button type="button" class="dropdown-toggle btn btn-sm" data-bs-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">
                                  <i class="icon-lg pb-3px" data-feather="columns"></i>
                                </button>
                                <div role="menu" class="dropdown-menu dropdown-menu-right dropdown-content wmin-350"
                                  x-placement="top-end">
                                  <div class="dropdown-content-body pb-2">
                                    <div class="row">
                                      <div class="col-6">
                                        <h6 class="mb-0 font-weight-semibold">Cài đặt ẩn hiện cột:</h6>
                                      </div>
                                      <div class="text-right col-6">
                                        <span class="cursor-pointer resetColumnDisplay">
                                          <i class="fa-solid fa-arrow-rotate-left mr-1"></i> Quay về mặc định
                                        </span>
                                      </div>
                                      <div class="dropdown-divider col-xl-12"></div>

                                      <div class="col-6 dropdown-item">
                                        <label class="d-flex align-items-center mb-0 gap-1">
                                          <input type="checkbox" name="checkCol" value="colExtBarcode"
                                            class="dgExtColumn mr-1"> Mã
                                          vạch
                                        </label>
                                      </div>
                                      <div class="col-6 dropdown-item">
                                        <label class="d-flex align-items-center mb-0 gap-1">
                                          <input type="checkbox" name="checkCol" value="colExtPriceImport"
                                            class="dgExtColumn mr-1">
                                          Giá nhập
                                        </label>
                                      </div>
                                      <div class="col-6 dropdown-item">
                                        <label class="d-flex align-items-center mb-0 gap-1">
                                          <input type="checkbox" name="checkCol" value="colExtPrice"
                                            class="dgExtColumn mr-1"> Giá
                                          bán
                                        </label>
                                      </div>
                                      <div class="col-6 dropdown-item">
                                        <label class="d-flex align-items-center mb-0 gap-1">
                                          <input type="checkbox" name="checkCol" value="colExtOther"
                                            class="dgExtColumn mr-1"> Kích
                                          thước
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 attributeCombinatedTable mt-2">
                              <div class="table-responsive">
                                <table class="table table-hover table-bordered table-attributes table-bordered"
                                  data-hasblockrows="1">
                                  <thead class="table-light">
                                    <tr>
                                      <th><i class="icon-lg pb-3px" data-feather="image"></i></th>
                                      <th>Tên mở rộng</th>
                                      <th>Mã mở rộng</th>
                                      <th class="colExtBarcode">
                                        Mã vạch
                                        <i class="icon-lg pb-3px text-primary" data-feather="help-circle"></i>
                                      </th>
                                      <th class="colExtPriceImport">Giá nhập</th>
                                      <th class="colExtPrice">Giá bán</th>
                                      <th title="Số lượng" class="p-1">
                                        <div class="d-flex justify-content-center">
                                          <input style="width: 50px" class="form-control p-1 qttAll text-right"
                                            placeholder="SL">
                                          <div class="input-group-prepend">
                                            <a href="javascript:"
                                              title="Điền số lượng và click mũi tên để thay đổi số lượng cho tất cả các dòng bên dưới"
                                              class="fas fa-arrow-down mt-2 ml-1 fa-lg copyQttAllBtn"></a>
                                          </div>
                                          <div id="totalQttAttribute" class="input-group-prepend"></div>
                                        </div>
                                      </th>
                                      <th>Khối lượng (g)</th>
                                      <th class="colExtOther">Kích thước (cm)</th>
                                      <th><i class="icon-lg pb-3px" data-feather="settings"></i></th>
                                    </tr>
                                  </thead>
                                  <tbody></tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-none">
                          <table id="childProduct-template" data-hasblockrows="1">
                            <tbody>
                              <tr class="childProduct" data-index="">
                                <td class="tdExtendImg text-center p-2">
                                  <div class="extRenderImg position-relative"></div>
                                  <input type="file" name="extFileInput" class="extFileInput form-control form-control-sm" id="extFileInput" accept="image/*">
                                  <input type="hidden" class="extendStatus" value="">
                                </td>
                                <td><input class="extendName form-control" value="" placeholder="Tên mở rộng"></td>
                                <td><input class="extendCode form-control" value="" placeholder="Mã mở rộng"></td>
                                <td class="colExtBarcode">
                                  <input class="extendBarcode form-control text-right" value="" placeholder="Mã vạch">
                                </td>
                                <td class="colExtPriceImport">
                                  <input class="extendPriceImport autoNumeric form-control text-right" value=""
                                    placeholder="Giá nhập">
                                </td>
                                <td class="colExtPrice">
                                  <input class="extendPrice autoNumeric form-control text-right" value=""
                                    placeholder="Giá bán">
                                </td>
                                <td>
                                  <input class="extendQuantity autoNumeric form-control text-right" value=""
                                    placeholder="Tồn đầu">
                                </td>
                                <td>
                                  <input class="extendShippingWeight form-control text-right" value="" placeholder="KL">
                                </td>
                                <td class="colExtOther">
                                  <div class="d-flex">
                                    <input class="extendLength form-control text-right" value="" placeholder="Dài">
                                    <input class="extendWidth form-control text-right" value="" placeholder="Rộng">
                                    <input class="extendHeight form-control text-right" value="" placeholder="Cao">
                                  </div>
                                </td>
                                <td class="text-center">
                                  <a href="javascript:void(0)" class="removeChildProduct">
                                    <i class="fa-solid text-danger fa-trash"></i>
                                  </a>
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
            <div class="form-group mb-2">
              <div class="col-lg-8">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <span class="uniform-choice">
                      <span class="checked">
                        <input value="afterSubmit-2" type="radio" class="form-check-input-styled" name="afterSubmit"
                          checked="checked" data-fouc="" selected="selected">
                      </span>
                    </span>
                    Tiếp tục thêm
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <span class="uniform-choice">
                      <span class="">
                        <input value="afterSubmit-1" type="radio" class="form-check-input-styled" name="afterSubmit"
                          data-fouc="" selected="selected">
                      </span>
                    </span>
                    Hiện danh sách sản phẩm
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <span class="uniform-choice">
                      <span class="">
                        <input value="afterSubmit-3" type="radio" class="form-check-input-styled" name="afterSubmit"
                          data-fouc="" selected="selected">
                      </span>
                    </span>
                    In mã vạch sản phẩm
                  </label>
                </div>
              </div>
            </div>
            <div class="btn-submit">
              <a href="/">
                <button type="submit" class="btn btn-success me-2">Lưu thay đổi</button>
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<!-- @include('backend.page.store.product.modalcreatecategory')
@include('backend.page.store.product.modalcreatesupplier')
@include('backend.page.store.product.modalcreatenewattribute') -->
@include('backend.page.store.product.modalcreateattribute')

@section('script')

<script>

$(document).ready(function () {
  displayColumnHandler()
  var token = localStorage.getItem("Token");
  // $('#btn-create-category').click(function () {
  //   $('#modal-create-category').modal('show');
  // });
  // $('#btn-create-supplier').click(function () {
  //   $('#modal-create-supplier').modal('show');
  // });
  // $('#btn-create-new-attribute').click(function () {
  //   $('#modal-create-new-attribute').modal('show');
  // });

  //handle select2
  $('#prd_parent_id').select2({
    ajax: {
      url: '{{route('product.all')}}',
      dataType: 'json',
      delay: 250,
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (params) {
        return {
          filter_prd_name: params.term,
          page: params.page || 1,
          per_page: 10
        };
      },
      processResults: function (data) {
        var options = [];
        var val = data.data.data;
        if (val.length === 0) {
          var emptyOption = {
            value: '',
            text: 'Không có kết quả'
          };
          options.push(emptyOption);
        } else {
          val.forEach(function (item) {
            var option = {
              id: item.prd_id,
              value: item.prd_id,
              text: item.prd_name
            };
            options.push(option);
          });
        }
        return {
          results: options,
          pagination: {
            more: (data.data.current_page * 10) < data.data.total
          }
        };
      },
      cache: true
    },
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
  $('#prd_type_id').select2({
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
  $('#cat_id').select2({
    ajax: {
      url: '{{route('category.all')}}',
      dataType: 'json',
      delay: 250,
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (params) {
        return {
          filter_cat_name: params.term,
          page: params.page || 1,
          per_page: 10
        };
      },
      processResults: function (data) {
        var options = [];
        var val = data.data.data;
        option = {
          id: 0,
          value: '',
          text: 'Chọn danh mục'
        };
        options.push(option);
        val.forEach(function (item) {
          var option = {
            id: item.cat_id,
            value: item.cat_id,
            text: item.cat_name
          };
          options.push(option);
        });
        return {
          results: options,
          pagination: {
            more: (data.data.current_page * 10) < data.data.total
          }
        };
      },
      cache: true
    },
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
  });
  $('#cat_inter_id').select2({
    ajax: {
      url: '{{route('categoryinternal.all')}}',
      dataType: 'json',
      delay: 250,
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (params) {
        return {
          filter_cat_inter_name: params.term,
          page: params.page || 1,
          per_page: 10
        };
      },
      processResults: function (data) {
        var options = [];
        var val = data.data.data;
        val.forEach(function (item) {
          var option = {
            id: item.cat_inter_id,
            value: item.cat_inter_id,
            text: item.cat_inter_name
          };
          options.push(option);
        });
        return {
          results: options,
          pagination: {
            more: (data.data.current_page * 10) < data.data.total
          }
        };
      },
      cache: true
    },
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
  $('#brand_id').select2({
    ajax: {
      url: '{{route('brand.getAll')}}',
      dataType: 'json',
      delay: 250,
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (params) {
        return {
          search: params.term,
          page: params.page || 1,
          per_page: 10
        };
      },
      processResults: function (data) {
        var options = [];
        var val = data.data.data;
        val.forEach(function (item) {
          var option = {
            id: item.brand_id,
            value: item.brand_id,
            text: item.brand_name
          };
          options.push(option);
        });
        return {
          results: options,
          pagination: {
            more: (data.data.current_page * 10) < data.data.total
          }
        };
      },
      cache: true
    },
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
  $('#w_id').select2({
    ajax: {
      url: '{{route('warehouse.all')}}',
      dataType: 'json',
      delay: 250,
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (params) {
        return {
          filter_w_name: params.term,
          page: params.page || 1,
          per_page: 10
        };
      },
      processResults: function (data) {
        var options = [];
        var val = data.data;

        if (val.length === 0) {
          var emptyOption = {
            value: '',
            text: 'Không có kết quả'
          };
          options.push(emptyOption);
        } else {
          val.forEach(function (item) {
            var option = {
              id: item.w_id,
              value: item.w_id,
              text: item.w_name
            };
            options.push(option);
          });
        }

        return {
          results: options,
          pagination: {
            more: (data.data.current_page * 10) < data.data.total
          }
        };
      },
      cache: true
    },
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
  //sup
  $('#sup_id').select2({
    ajax: {
      url: '{{route('supplier.all')}}',
      dataType: 'json',
      delay: 250,
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (params) {
        return {
          filter_sup_name: params.term,
          page: params.page || 1,
          per_page: 10
        };
      },
      processResults: function (data) {
        var options = [];
        var val = data.data.data;
        if (val.length === 0) {
          var emptyOption = {
            value: '',
            text: 'Không có kết quả'
          };
          options.push(emptyOption);
        } else {
          val.forEach(function (item) {
            var option = {
              id: item.sup_id,
              value: item.sup_id,
              text: item.sup_name
            };
            options.push(option);
          });
        }
        return {
          results: options,
          pagination: {
            more: (data.data.current_page * 10) < data.data.total
          }
        };
      },
      cache: true
    },
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
  $('#country_id').select2({
    ajax: {
      url: '{{route('country.all')}}',
      dataType: 'json',
      delay: 250,
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (params) {
        return {
          filter_country_name: params.term,
          page: params.page || 1,
          per_page: 10
        };
      },
      processResults: function (data) {
        var options = [];
        var val = data.data;
        val.forEach(function (item) {
          var option = {
            id: item.country_id,
            value: item.country_id,
            text: item.country_nicename,
          };
          options.push(option);
        });
        return {
          results: options,
          pagination: {
            more: (data.data.current_page * 10) < data.data.total
          }
        };
      },
      cache: true
    },
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
  $('#prd_status_id').select2({
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });

  $('.attributeCombinatedTable .copyQttAllBtn').on('click', e => {
    e.preventDefault();
    const valueAll = $('.attributeCombinatedTable .qttAll').val();
    $('.attributeCombinatedTable .extendQuantity').each(function () {
      AutoNumeric.set($(this).get(0), valueAll);
    });
    calculateQtt();
  });

  var AppAttributeProduct = {
    // Type hiển thị thuộc tính
    TYPE_SELECT: 1, TYPE_CHECKBOX: 2, TYPE_NUMBER: 3, TYPE_TEXT: 5,
    attributesData: {},
    attrsValues: {}, // Biến chỉ lưu values attrs
    cacheChildsList: {}, // Mảng lưu thông tin sản phẩm thuộc tính đã tạo
    isSubmit: false
  }
  //show/hide create child product
  var cat_id_val = $('#cat_id').val();
  if (cat_id_val == '') {
    $('#childAttrWarning').removeClass('d-none');
    $('#childAttrPartial').addClass('d-none');
  }
  $('#cat_id').on('select2:select', function (e) {
    var selectedOption = e.params.data;
    if (selectedOption.value == '') {
      $('#childAttrWarning').removeClass('d-none');
      $('#childAttrPartial').addClass('d-none');
    } else {
      $('#childAttrWarning').addClass('d-none');
      $('#childAttrPartial').removeClass('d-none');

      var selected_cat_id = selectedOption.value;
      $('#attributeCard').empty();
      $('.childProductsCardBody .table-attributes tbody').html('');
      $('.attributeCombinatedTable .table-attributes tbody').html('');

      $.ajax({
        url: '{{route('variant.find')}}',
        method: 'POST',
        data: {
          id: selected_cat_id
        },
        beforeSend: function (xhr) {
          xhr.setRequestHeader("Authorization", "Bearer " + token);
        },
        success: function (response) {
          AppAttributeProduct.attributesData = response.data;
          AppAttributeProduct.attrsValues = response.data;

          //#region Aways show attribute tabs column
          $.each(response.data, function (index, item) {
            c = $('body .psAttr:last-child'),
              d = c.length ? c.attr('data-order') : 0,
              sorter = parseInt(d) + 1,
              eltAttrSelectId = `attrVar-${sorter}`;

            var html = '<div class="row form-group mb-3 psAttr" data-order="' + sorter + '">';
            html += '<div class="col-12 col-md-3 col-lg-3 d-flex align-items-center text-start">';
            html += '<strong>' + item.var_name + '</strong>';
            html += '</div>';
            html += '<div class="col-12 col-md-8 col-lg-9 mt-0">';
            html += '<div class="input-group">';
            html += '<div class="col-12 d-flex align-items-center" style="min-width: 230px">';
            html += '<select id="'+ eltAttrSelectId +'" name="var-' + index + '" class="form-select" data-placeholder="Chọn ' + item.var_name + '">';
            html += '<option value="">- ' + item.var_name + ' -</option>';
            $.each(item.variant_values, function (index, value) {
              if (!value.vv_id) {
                return false;
              } else {
                html += '<option value="' + value.vv_id + '">' + value.vv_name + '</option>';
              }
            });
            html += '</select>';
            html += '<div class="input-group-prepend">';
            html += '<span" data-column="var-' + index + '" data-title="' + item.var_name + '" data-id="' + item.var_id + '" class="input-group-text btn btn-default text-success cursor-pointer h-100 border addQuickValueAttributesBtn" title="Thêm giá trị thuộc tính mới">';
            html += '<i class="fa-solid fa-plus"></i>';
            html += '</span>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            $('#attributeCard').append(html);

            $(`#${eltAttrSelectId}`).select2({
              theme: "bootstrap-5",
              width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
              placeholder: $(this).data('placeholder'),
            });
          });
          //#endregion
          //#region Aways show the attribute children tabs table
          $.each(response.data, function (index, item) {
            let html = ''
            c = $('body .rowItemAttr:last-child'),
              d = c.length ? c.attr('data-order') : 0,
              sorter = parseInt(d) + 1,
              eltSelectId = `attrBreak-${sorter}`;

            if (!item.var_name) {
              return false;
            } else {
              html = '<tr class="rowItemAttr" data-order="' + sorter + '">';
              html += '<td>';
              html += '<div class="btn-group bg-white w-100">';
              html += '<span class="btn btn-md btn-outline-secondary text-start" disabled style="pointer-events: none">' + item.var_name + '</span>';
              html += '</div>';
              html += '</td>';
              html += '<td>';
              html += '<div class="d-flex align-items-center justify-content-start pl-xl-3 flex-nowrap gap-2">';
              html += '<select data-column="var-' + index + '" name="' + eltSelectId + '" id="' + eltSelectId + '" class="form-select form-control w-100" data-placeholder="' + item.var_name + '" multiple style="min-width: 350px;">';
              html += '</select>';
              html += '<div class="input-group-append">';
              html += '<span" data-column="var-' + index + '" data-title="' + item.var_name + '" data-id="' + item.var_id + '" class="input-group-text btn btn-default text-success cursor-pointer h-100 border addQuickValueAttributesBtn" title="Thêm giá trị thuộc tính mới">';
              html += '<i class="fa-solid fa-plus"></i>';
              html += '</span>';
              html += '</div>';
              html += '</div>';
              html += '</td>';
              html += '<td class="d-flex justify-content-end align-items-center gap-2">';
              html += '<input type="number" class="order-attr form-control d-inline-block mr-2" min="0" value="' + sorter + '" style="max-width: 100px">';
              html += '<a href="javascript:void(0)" class="remove-attr text-danger mr-2">';
              html += '<i class="fa-solid fa-trash"></i>';
              html += '</a>';
              html += '</td>';
              html += '</tr>';
              $('.childProductsCardBody tbody').append(html);
            }

            $(`#${eltSelectId}`).select2({
              theme: "bootstrap-5",
              width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
              placeholder: $(this).data('placeholder'),
            });

            let eltSelect = $(`#${eltSelectId}`);
            eltSelect.addClass('initSelectAttribute');
            genSelectAttrValue(eltSelect, item.variant_values);

            $.each(item.variant_values, (k, v) => {
              AppAttributeProduct.attrsValues[v.vv_id] = v;
            });
          });
        },
        //#endregion
        error: function (error) {
          console.log(error.responseJSON);
        }
      });
    }
  });

  $('.childProductsCardBody')
    .on('select2:select', 'select.initSelectAttribute',() => combineChildProduct())
    .on('select2:unselect', 'select.initSelectAttribute', () => combineChildProduct());

  //#region Modal AddQuickAttrValue
  $(document).on('click', '.addQuickValueAttributesBtn', function () {
    let title = $(this).attr('data-title');
    let attributeId = $(this).attr('data-id');
    let column = $(this).attr('data-column');
    // JavaScript to handle dynamic title
    document.getElementById("indexValueTxt").value = attributeId;
    document.getElementById("modalTitle").innerText = title;

    $('#addQuickAttrValueModal').modal('show');

  });

  // JavaScript to handle the "Lưu" button click event
  $(document).on('click', '#addQuickAttrValueModal #saveAddQuickAttrValueBtn', function () {
    var formData = new FormData();
    $("#addQuickAttrValueModal").each(function () {
      formData.append('var_id', $(this).find('#indexValueTxt').val());
      formData.append('vv_code', $(this).find('#attributeCodeTxt').val());
      formData.append('vv_name', $(this).find('#attributeValueTxt').val());
      formData.append('vv_value', $(this).find('#attributeContentTxt').val());

      formData.append('vv_order', '');
      formData.append('vv_other_code', '');
      formData.append('vv_other_name', '');
      formData.append('vv_parent_id', '');
      formData.append('vv_unit', '');
    });
    $.ajax({
      url: "{{ route('variantvalue.create') }}",
      type: 'POST',
      data: formData,
      enctype: 'multipart/form-data',
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      processData: false, // Không xử lý dữ liệu thành chuỗi query
      contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
      success: function (response) {
        $('#addQuickAttrValueModal').modal('hide');
        toastr.success(response.message, 'Thành công', {
          onHidden: function () {
            location.reload();
          }
        });
      },
      error: function (error) {
        if (error.responseJSON && error.responseJSON.errors) {
          var errors = error.responseJSON.errors;
          for (var key in errors) {
            if (errors.hasOwnProperty(key)) {
              var errorMessages = errors[key];
              errorMessages.forEach(function (errorMessage) {
                toastr.error(errorMessage);
              });
            }
          }
        }
        else if (error.responseJSON && error.responseJSON.message) {
          toastr.error(error.responseJSON.message);
        }
      }
    });
  });

  $(document).on('change', '.table-attributes .extendQuantity', function () {
    calculateQtt();
  });

  // JavaScript to clear the modal input fields when the modal is closed
  $('#addQuickAttrValueModal').on('hidden.bs.modal', function () {
    // Clear the input fields
    $('#attributeContentTxt').val('');
    $('#attributeValueTxt').val('');
    $('#attributeCodeTxt').val('');
    $('#indexValueTxt').val('');
  });
  //#endregion

  // Thay đổi sắp xếp thuộc tính
  $(document).on('change', '.rowItemAttr .order-attr', e => {
    e.preventDefault();
    let val = parseInt($(e.currentTarget).val());
    if (!val || val < 0 || typeof val == "undefined") {
      val = 0;
    }
    $(e.currentTarget).val(val);
    $(e.currentTarget).parents('.rowItemAttr').attr('data-order', val);
    changeSortedAtrr();
  });

  // Xóa thuộc tính
  $(document).on('click', '.rowItemAttr .remove-attr', e => {
    let iptVals = $(e.currentTarget).parents('.rowItemAttr').find('select.form-control').val();
    if (iptVals && $(`.attributeCombinatedTable .childProduct`).length) {
      $.each(iptVals, function (k, id) {
        let child = $(`.attributeCombinatedTable .childProduct[data-index*="${id}"]`);
        if (child.length) {
          if (typeof AppAttributeProduct.cacheChildsList[child.attr('data-index')]) {
            delete AppAttributeProduct.cacheChildsList[child.attr('data-index')];
          }
          child.remove();
        }
      });
    }
    $(e.currentTarget).parents('.rowItemAttr').remove();
    combineChildProduct();
  });

  // Xóa 1 dòng sản phẩm con
  $(document).on('click', '.table-attributes .removeChildProduct', e => {
    removeChildItem($(e.currentTarget).closest('.childProduct').attr('data-index'));
    calculateQtt();
  });

  /**
   * Load danh sách giá trị của thuộc tính
   * */
  function genSelectAttrValue(element = null, values = []) {
    if (!element) {
      return false;
    }
    // Có giá trị thuộc tính thì mới khởi tạo
    if (values) {
      values.sort((a, b) => a.order - b.order);
      const val = element.val();
      element.html('');
      $.each(values, function (k, val) {
        if (val.vv_value == null || val == ''){
          return false
        } else {
          element.append(`<option value="${val.vv_id}">${val.vv_name}</option>`);
        }
      });
      element.val(val);
    }
  }
  /**
   * Thêm dòng sản phẩm con theo thuộc tính
   * */
  function combineChildProduct() {
    saveCacheChilds();
    let attrMap = {};
    $('.childProductsCardBody select.form-select').each(function () {
      let values = $(this).val(), column = $(this).attr('data-column');
      if (values && Array.isArray(values) && values.length) {
        let arr = [], aSorts = {};
        $.each(values, (k, val) => {
          const attrList = AppAttributeProduct.attrsValues
          const item = attrList.find((attrList) => attrList.vv_id == val)
          if (typeof item != "undefined") {
            const ks = `${parseInt(item.vv_order)}_${parseInt(item.vv_id)}`;
            aSorts[ks] = item;
          }
        });
        $.each(aSorts, (k, val) => arr.push(val));
        arr.sort((a, b) => a.order - b.order);
        attrMap[column] = arr;
      }
    });

    let product = {
      name: '',
      code: '',
      barcode: '',
      priceImport: $('body #importPrice').val() ? AutoNumeric.getNumber($('#importPrice').get(0)) : 0,
      price: $('body #price').val() ? AutoNumeric.getNumber($('#price').get(0)) : 0,
      quantity: '',
      shippingWeight: $('#shippingWeight').val(),
      length: $('#length').val(),
      width: $('#width').val(),
      height: $('#height').val(),
      status: $('#status').val(),
    };

    product.barcode = ''; // Barcode luôn để trống tránh trường hợp bị trùng SP CHA
    if ($('body #detailExtName').val()) {
      product.name = $('#detailExtName').val;
    }
    if ($('body #detailExtCode').val()) {
      product.code = $('#detailExtCode').val;
    }
    if ($('body #detailExtPrice').val()) {
      product.price = parseInt($('#detailExtPrice').val());
    }
    if ($('body #detailExtPriceImport').val()) {
      product.priceImport = parseInt($('#detailExtPriceImport').val());
    }
    if ($('body #detailExtShippingWeight').val()) {
      product.shippingWeight = parseInt($('#detailExtShippingWeight').val());
    }
    if ($('body #detailExtLength').val()) {
      product.length = parseInt($('#detailExtLength').val());
    }
    if ($('body #detailExtWidth').val()) {
      product.width = parseInt($('#detailExtWidth').val());
    }
    if ($('body #detailExtHeight').val()) {
      product.height = parseInt($('#detailExtHeight').val());
    }
    if ($('body #detailExtStatus').val()) {
      product.status = parseInt($('#detailExtStatus').val());
    }
    let products = [], totalProducts = 1;
    $.each(attrMap, function (key, value) {
      if (parseInt(value) !== 0) {
        totalProducts *= value.length;
      }
    });
    for (let i = 0; i < totalProducts; i++) {
      products[i] = [];
    }

    let last_length = 1, step, attrIndex;
    $.each(attrMap, function (key, value) {
      step = totalProducts / (value.length * last_length);
      for (let i = 0; i < totalProducts; i++) {
        attrIndex = Math.floor(i / step) % value.length;
        products[i].push(value[attrIndex]);
      }
      last_length *= value.length;
    });

    $('.attributeCombinatedTable .table-attributes tbody').html('');

    $.each(products, (k, value) => {
      if (value.length) {
        let a = '#childProduct-template .childProduct', template = $(a).clone(),
        ex = { code: [], name: [], id: [] };

        $.each(value, (k, v) => {
          ex.code.push(v.vv_code);
          ex.name.push(v.vv_name);
          ex.id.push(v.vv_id);
        });

        parent_attr = []
        $.each(value, (k ,v) => {
          parent_attr.push({vv_id: v.vv_id});
        })

        let keyIndex = getIndexKey(ex.id), psItem = { ...product };
        if (AppAttributeProduct.cacheChildsList[keyIndex]) {
          psItem = AppAttributeProduct.cacheChildsList[keyIndex];
        }
        psItem.name = ' - ' + ex.name.join(' - ');
        psItem.code = '-' + ex.code.join('-');

        const ps = $(`.attributeCombinatedTable .childProduct[data-index="${keyIndex}"]`);
        if (ps.length) {
          // Đã tồn tại
          template = ps.clone();
          ps.remove();
        }
        template.data('combination', parent_attr);
        template.attr('data-index', keyIndex);
        template.find('.extendName').val(psItem.name);
        template.find('.extendCode').val(psItem.code);
        template.find('.extendBarcode').val(psItem.barcode);
        template.find('.extendPriceImport').val(psItem.priceImport);
        template.find('.extendPrice').val(psItem.price);
        template.find('.extendQuantity').val(psItem.quantity);
        template.find('.extendShippingWeight').val(psItem.shippingWeight);
        template.find('.extendLength').val(psItem.length);
        template.find('.extendWidth').val(psItem.width);
        template.find('.extendHeight').val(psItem.height);
        template.find('.extendStatus').val(psItem.status);

        $('.attributeCombinatedTable .table-attributes tbody').append(template);
        initAutoNumeric('.attributeCombinatedTable .autoNumeric');
      }
    });
  }

  function getIndexKey(array) {
    if (!array || typeof array != "object" || !Object.keys(array).length) {
      return '';
    }
    return array.sort().join('-');
  }
  /**
  * Xóa dòng sản phẩm con
  * - Khi thêm bơt giá trị thuộc tính
  * - Bấm icon tại từng dòng
  * */
  function removeChildItem(index, onlyDelCache = false) {
    if (!index) {
      return false;
    }

    if (onlyDelCache) {
      if (AppAttributeProduct.cacheChildsList[index]) {
        delete AppAttributeProduct.cacheChildsList[index];
      }
      return true;
    }

    $(`body .childProduct[data-index*="${index}"]`).each((k, elt) => {
      if (AppAttributeProduct.cacheChildsList[index]) {
        delete AppAttributeProduct.cacheChildsList[index];
      }
      if (!onlyDelCache) {
        $(elt).remove();
      }
    });
  }

  /**
   * Thay đổi lại sắp xêp khi có thuộc tính bị thay đổi
   * - Thêm dòng thuộc tính mới
   * - Xóa dòng thuộc tính
   * - Thay đổi thứ tự của 1 dòng thuộc tính
   * */
  function changeSortedAtrr() {
    let body = $('.childProductsCardBody .table-attributes tbody');
    let values = [];
    body.find('.initSelectAttribute').each(function () {
      values[$(this).attr('data-column')] = $(this).val();
      if ($(this).data('select2')) {
        $(this).select2('destroy');
      }
    });

    body.html(getSorted('.childProductsCardBody .rowItemAttr', 'data-order').clone());
    body.find('.initSelectAttribute').each(function () {
      if (typeof values[$(this).attr('data-column')] != "undefined") {
        $(this).val(values[$(this).attr('data-column')]);
      }
      $(this).select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        closeOnSelect: false,
      });
    });

    saveCacheChilds();
    combineChildProduct();
  }

  function getSorted(c, a) {
    return $($(c).toArray().sort((b, c) => {
      let d = parseInt(b.getAttribute(a)), e = parseInt(c.getAttribute(a));
      return d - e;
    }));
  }
  /**
   * Tạo cache thông tin sản phẩm con
   * */
  function saveCacheChilds() {
    AppAttributeProduct.cacheChildsList = {};
    $('.attributeCombinatedTable .childProduct').each(function () {
      const t = $(this);
      AppAttributeProduct.cacheChildsList[t.attr('data-index')] = {
        name: t.find('.extendName').val(),
        code: t.find('.extendCode').val(),
        barcode: t.find('.extendBarcode').val(),
        priceImport: t.find('.extendPriceImport').val(),
        price: t.find('.extendPrice').val(),
        quantity: t.find('.extendQuantity').val(),
        shippingWeight: t.find('.extendShippingWeight').val(),
        length: t.find('.extendLength').val(),
        width: t.find('.extendWidth').val(),
        height: t.find('.extendHeight').val(),
        status: t.find('.extendStatus').val(),
      };
    });
  }

  /**
  * Tùy chỉnh ẩn hiện cột sản phẩm mở rộng
  * */
  function displayColumnHandler() {
    let html = '',
      displayColCss = $('#displayColumnStyle'),
      keyStorage = 'AucaDisplayColumnAtrrExtenb',
      settings = localStorage.getItem(keyStorage) ? JSON.parse(localStorage.getItem(keyStorage)) : [];

    if (settings.length) {
      $('.dgExtColumn').prop('checked', true);
      $.each(settings, function (k, cls) {
        $(`.dgExtColumn[value="${cls}"]`).prop('checked', false);
        html += `.${cls} { display: none !important; }`;
      });
      displayColCss.html(html);
    }

    $(document).on('click', '.dgExtColumn', function () {
      html = '';
      settings = [];
      $('.dgExtColumn').each(function () {
        if (!$(this).is(':checked')) {
          settings.push($(this).val());
          html += `.${$(this).val()} { display: none !important; }`;
        }
      });
      localStorage.setItem(keyStorage, JSON.stringify(settings));
      displayColCss.html(html);
    });

    $(document).on('click', '.resetColumnDisplay', function () {
      $('.dgExtColumn').prop('checked', false);
      localStorage.setItem(keyStorage, JSON.stringify([]));
      displayColCss.html(`.colExtBarcode, .colExtPriceImport, .colExtPrice, .colExtOther {display: none !important;}`);
    });
  }

  function calculateQtt() {
    let totalQtt = 0;
    $('.attributeCombinatedTable .extendQuantity').each(function () {
      if ($(this).val()) {
        totalQtt += parseInt($(this).val() ? AutoNumeric.getNumber($(this).get(0)) : 0);
      }
    });
    $('#totalQttAttribute').empty().html('(<b>' + totalQtt + '</b>)');
  }

  /**
  * Kiểm tra string có phải tiếng việt và có dấu không
  * - false: tiếng việt và có dấu
  * - true: không phải tiếng việt
  * */
  function isValidVietnameseAndSpace(string) {
    let re = /^[0-9a-zA-Z!@#\$%\^\&*\)\(+=._-]{2,}$/g;
    return re.test(string);
  }

  function initAutoNumeric(selector, options = {}) {
    let index = 0;
    const elements = document.querySelectorAll(selector);

    elements.forEach((element) => {
      if (!AutoNumeric.isManagedByAutoNumeric(element)) {
        new AutoNumeric(element, {
          decimalPlaces: options.hasOwnProperty('mDec') ? options.mDec : 0,
          minimumValue: options.hasOwnProperty('minimumValue') ? options.minimumValue : '0',
          modifyValueOnWheel: false
        });
      }
      index += 1;
    });
  }

});
</script>

<script>
  ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
      // Store the editor instance in a variable
      window.ckeditorInstance = editor;
    } )
    .catch( error => {
      console.error( error );
    } );
</script>

<script>
$(document).ready(function () {
  var token = localStorage.getItem("Token");
  $('#productAddForm').submit(function (event) {
    event.preventDefault();
    var prd_name = $('input[name="prd_name"]').val();
    var prd_type_id = $('select[name="prd_type_id"]').val();
    var cat_id = $('select[name="cat_id"]').val();
    var w_id = $('select[name="w_id"]').val();
    var pd_first_remain = $('input[name="pd_first_remain"]').val();
    var holdform = $('input[name="afterSubmit"]').filter(':checked').val();
    if (!prd_name || !prd_type_id || !cat_id) {
      toastr.error('Nhập các dữ liệu bắt buộc', 'Lỗi');
      return;
    }

    var parent_attr = getSelectedParentAttrValues()
    // chia sp thuộc tính
    // duyệt các row ở bảng tổ hợp sp thuộc tính
    // lưu dữ liệu vào 1 hidden dưới dạng json
    var attrsBreak = [];
    var hasInputQuantity = false;
    $('.table-attributes .childProduct').each(function () {
      const t = $(this), renderImg = t.find('.extRenderImg a');
      if (t.find('.extendQuantity').val()) {
        hasInputQuantity = true;
      }
      const obj = {
        'attr': t.data('combination'),
        'extendIndex': t.attr('data-index'),
        'extendName': t.find('.extendName').val(),
        'extendCode': t.find('.extendCode').val(),
        'extendBarcode': t.find('.extendBarcode').val() ? t.find('.extendBarcode').val() : '',
        'extendPriceImport': t.find('.extendPriceImport').val(),
        'extendPrice': t.find('.extendPrice').val(),
        'extendQuantity': t.find('.extendQuantity').val(),
        'extendShippingWeight': t.find('.extendShippingWeight').val() ? parseFloat(t.find('.extendShippingWeight').val()) : '',
        'extendLength': t.find('.extendLength').val() ? parseFloat(t.find('.extendLength').val()) : '',
        'extendWidth': t.find('.extendWidth').val() ? parseFloat(t.find('.extendWidth').val()) : '',
        'extendHeight': t.find('.extendHeight').val() ? parseFloat(t.find('.extendHeight').val()) : '',
        'extendStatus': t.find('.extendStatus').val() ? t.find('.extendStatus').val() : null,
        'extendImage': '',
      };
      if (AutoNumeric.isManagedByAutoNumeric(t.find('.extendPriceImport').get(0))) {
        obj.extendPriceImport = AutoNumeric.getNumber(t.find('.extendPriceImport').get(0));
      }
      if (AutoNumeric.isManagedByAutoNumeric(t.find('.extendPrice').get(0))) {
        obj.extendPrice = AutoNumeric.getNumber(t.find('.extendPrice').get(0));
      }
      if (AutoNumeric.isManagedByAutoNumeric(t.find('.extendQuantity').get(0))) {
        obj.extendQuantity = AutoNumeric.getNumber(t.find('.extendQuantity').get(0));
      }
      if ($('#extFileInput')[0].files.length) {
        obj.extendImage = $('#extFileInput')[0].files[0]
      }
      attrsBreak.push(obj);
      if (pd_first_remain && t.find('.extendQuantity').val()) {
        toastr.error('Bạn không thể sử dụng cả 2 tính năng nhập tồn đầu và chia thuộc tính cùng lúc', 'Lỗi');
        return false;
      }

    });

    if (hasInputQuantity && !w_id) {
      toastr.error('Bạn chưa chọn cửa hàng', 'Lỗi');
      return false;
    }

    var formData = new FormData($('form#productAddForm')[0]);

    var wa_content = getCKEditorData()
    if(!wa_content){
      document.getElementById("wa_content").value = '';
    } else {
      document.getElementById("wa_content").value = wa_content;
    }

    var fields = [
      { name: 'prd_name', selector: 'input[name="prd_name"]' },
      { name: 'prd_type_id', selector: 'select[name="prd_type_id"]' },
      { name: 'prd_parent_id', selector: 'select[name="prd_parent_id"]' },
      { name: 'prd_code', selector: 'input[name="prd_code"]' },
      { name: 'prd_barcode', selector: 'input[name="prd_barcode"]' },
      { name: 'pd_import_price', selector: 'input[name="pd_import_price"]' },
      { name: 'pd_vat', selector: 'input[name="pd_vat"]' },
      { name: 'pd_price', selector: 'input[name="pd_price"]' },
      { name: 'pd_wholesale_price', selector: 'input[name="pd_wholesale_price"]' },
      { name: 'pd_old_price', selector: 'input[name="pd_old_price"]' },
      { name: 'prd_status_id', selector: 'select[name="prd_status_id"]' },
      { name: 'cat_id', selector: 'select[name="cat_id"]' },
      { name: 'cat_inter_id', selector: 'select[name="cat_inter_id"]' },
      { name: 'brand_id', selector: 'select[name="brand_id"]' },
      { name: 'pd_shipping_weight', selector: 'input[name="pd_shipping_weight"]' },
      { name: 'pd_unit', selector: 'input[name="pd_unit"]' },
      { name: 'pd_lenght', selector: 'input[name="pd_lenght"]' },
      { name: 'pd_width', selector: 'input[name="pd_width"]' },
      { name: 'pd_height', selector: 'input[name="pd_height"]' },
      { name: 'country_id', selector: 'select[name="country_id"]' },
      { name: 'wa_address', selector: 'input[name="wa_address"]' },
      { name: 'wa_tel', selector: 'input[name="wa_tel"]' },
      { name: 'wa_num_month', selector: 'input[name="wa_num_month"]' },
      { name: 'wa_content', selector: 'textarea[name="wa_content"]' },
      { name: 'pd_first_remain', selector: 'input[name="pd_first_remain"]' },
      { name: 'w_id', selector: 'select[name="w_id"]' },
      { name: 'sup_id', selector: 'select[name="sup_id"]' },
      { name: 'copy_parent_image', selector: 'input[name="copyParentImage"]' },
    ];
    // { name: 'country_iso', selector: 'select[name="country_id"]' },

    for (var i = 0; i < attrsBreak.length; i++) {
      var obj = attrsBreak[i];
      var attrArray = obj.attr;
      for (var j = 0; j < attrArray.length; j++) {
        var attrObj = attrArray[j];
        for (var key in attrObj) {
          if (attrObj.hasOwnProperty(key)) {
            formData.append(`attribute_combinated[${i}][attr][${j}][${key}]`, attrObj[key]);
          }
        }
      }
      formData.append(`attribute_combinated[${i}][extend_index]`, obj.extendIndex);
      formData.append(`attribute_combinated[${i}][extend_name]`, obj.extendName);
      formData.append(`attribute_combinated[${i}][extend_code]`, obj.extendCode);
      formData.append(`attribute_combinated[${i}][extend_barcode]`, obj.extendBarcode);
      formData.append(`attribute_combinated[${i}][extend_price_import]`, obj.extendPriceImport.toString());
      formData.append(`attribute_combinated[${i}][extend_price]`, obj.extendPrice.toString());
      formData.append(`attribute_combinated[${i}][extend_quantity]`, obj.extendQuantity.toString());
      formData.append(`attribute_combinated[${i}][extend_shipping_weight]`, obj.extendShippingWeight.toString());
      formData.append(`attribute_combinated[${i}][extend_length]`, obj.extendLength.toString());
      formData.append(`attribute_combinated[${i}][extend_width]`, obj.extendWidth.toString());
      formData.append(`attribute_combinated[${i}][extend_height]`, obj.extendHeight.toString());
      formData.append(`attribute_combinated[${i}][extend_status]`, obj.extendStatus);
      formData.append(`attribute_combinated[${i}][extend_image]`, obj.extendImage);
    }
    $.each(fields, function (i, field) {
      var value = $(field.selector).val(); // Lấy giá trị của trường
      if (value !== '' && !isNaN(value)) {
        value = parseInt(value);
        formData.set(field.name, value);
      } else if (value !== '' && isNaN(value)) {
        formData.set(field.name, value);
      }
    });

    // Get the file from the input element
    if ($('#pd_image')[0].files.length) {
      formData.set('pd_image', $('#pd_image')[0].files[0]);
    }
    if (parent_attr && parent_attr !== '') {
      for (let i = 0; i < parent_attr.length; i++) {
        const item = parent_attr[i];
        for (const key in item) {
          if (item.hasOwnProperty(key)) {
            formData.append(`parent_attr[${i}][${key}]`, item[key]);
          }
        }
      }
    } else {
      formData.set('parent_attr', null);
    }

    $.ajax({
      url: "{{ route('product.create') }}",
      type: 'POST',
      data: formData,
      enctype: 'multipart/form-data',
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      processData: false, // Không xử lý dữ liệu thành chuỗi query
      contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
      success: function (response) {
        $('#productAddForm')[0].reset();
        toastr.success(response.message, 'Thành công');
        if (holdform == 'afterSubmit-1') {
          setTimeout(function () {
            window.location.href = "{{ route('product') }}";
          }, 900);
        } else if (holdform == 'afterSubmit-3') {
          // printBarCode();
          toastr.success(response.message, 'In mã vạch sản phẩm');
        }
      },
      error: function (error) {
        if (error.responseJSON && error.responseJSON.errors) {
          var errors = error.responseJSON.errors;
          for (var key in errors) {
            if (errors.hasOwnProperty(key)) {
              var errorMessages = errors[key];
              errorMessages.forEach(function (errorMessage) {
                toastr.error(errorMessage);
              });
            }
          }
        } else if (error.responseJSON && error.responseJSON.message) {
          toastr.error(error.responseJSON.message);
        }
      }
    });
  });

  function getCKEditorData() {
    // Wait for the CKEditor instance to be ready
    if (window.ckeditorInstance) {
      // Get the CKEditor content
      var content = window.ckeditorInstance.getData();
      // You can now use the 'content' variable to work with the data.
      return content;
    }
  }

  function getSelectedParentAttrValues() {
    const parent_attr = [];
    // Find all the select elements inside the div with ID "attributeCard"
    $('#attributeCard select').each(function() {
      const selectedValue = $(this).val();
      // Check if selectedValue is not empty before pushing it into the array
      if (selectedValue !== "" && selectedValue !== null) {
        parent_attr.push({ vv_id: selectedValue });
      }
    });

    return parent_attr;
  }

});
</script>

@endsection
