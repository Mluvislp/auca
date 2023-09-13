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
      <li class="breadcrumb-item active" aria-current="page">Cập nhật</li>
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
          <form id="productUpdateForm" class="form-update-custom" method="post" enctype="multipart/form-data">
          <input value="" type="hidden" name="prd_id" id="prd_id">
            <div class="row mb-3">
              <div class="col-12 col-md-6">
                <div class="card p-3">
                  <div class="form-group mb-2">
                    <div class="row">
                      <label class="col-5 col-lg-2 col-form-label">Tên <span class="text-danger">*</span></label>
                      <div class="col-7 col-lg-10">
                        <input type="text" value="" name="prd_name" maxlength="255" class="required form-control"
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
                              <option value=""></option>
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
                              data-placeholder="Chọn sp cha">

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
                            <input type="text" value="" name="prd_code" maxlength="255" id="prd_code" autocomplete="off"
                              class="form-control">
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
                            <input type="text" value="" name="prd_barcode" maxlength="255" id="prd_barcode" autocomplete="off"
                              class="form-control">
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
                            <input type="number" value=""  name="pd_import_price" maxlength="255"
                              class="autoNumeric text-right form-control" id="pd_import_price"
                              autocomplete="off">
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
                              <input type="number" value="" name="pd_vat" maxlength="255"
                                class="autoNumeric text-right form-control" placeholder=""
                                id="pd_vat" autocomplete="off">
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
                            <input type="number" value="" name="pd_price" maxlength="255"
                              class="autoNumeric text-right form-control" id="pd_price"
                              autocomplete="off">
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
                            <input type="number" value="" name="pd_wholesale_price" maxlength="255"
                              class="autoNumeric text-right form-control" id="pd_wholesale_price"
                              autocomplete="off">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label class="col-5 col-lg-4 col-form-label">Giá cũ</label>
                          <div class="col-7 col-lg-8 pr-lg-0">
                            <input type="number" value="" name="pd_old_price" maxlength="255"
                              class="autoNumeric text-right form-control" id="pd_old_price"
                              autocomplete="off">
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
                                    printProductStatus($product_status_model , 1 , true);
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
                            <a id="btn-create-category" style="cursor: pointer">
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
                              <input type="number" value="" name="pd_shipping_weight" maxlength="255" placeholder=""
                                class="text-right form-control" id="pd_shipping_weight"
                                autocomplete="off">
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
                            <input type="text" value="" name="pd_unit" maxlength="255"
                              placeholder="VD: cái, chiếc, hộp, lon, gói..." id="pd_unit" autocomplete="off"
                              class="form-control">
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
                          <input type="number" value="" name="pd_lenght" maxlength="255" placeholder="Dài"
                            class="text-right form-control" id="pd_lenght" autocomplete="off"
                            >
                          <input type="number" value="" name="pd_width" maxlength="255" placeholder="Rộng"
                            class="text-right form-control" id="pd_width" autocomplete="off"
                            >
                          <input type="number" value="" name="pd_height" maxlength="255" placeholder="Cao"
                            class="text-right form-control" id="pd_height" autocomplete="off"
                            >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <div class="row">
                      <label class="col-5 col-lg-3 col-form-label">Ảnh đại diện</label>
                      <div class="col-7 col-lg-9">
                        <div class="media mt-0 row">
                          <input type="hidden" name="imageAvatar" class="imageUploadFile" id="imageAvatar" value="">
                          <div class="media-body col-9">
                            <div class="uniform-uploader" id="uniform-pd_image">
                              <input type="file" value="" name="pd_image" class="businessFileUpload form-control" accept="image/*" data-url=""
                                id="pd_image"><span class="filename" style="user-select: none;">Chọn file gif, png, jpg, bmp &lt;=
                                4MB</span>
                            </div>
                          </div>
                          <div class="imageArea col-3 align-self-center" id="imageArea"></div>
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
                        </select>
                      </div>
                    </div>
                    <div class="form-group mb-2 row">
                      <label class="col-5 col-lg-3">Địa chỉ bảo hành </label>
                      <div class="col-7 col-lg-9">
                        <input type="text" value="" name="wa_address" id="wa_address" autocomplete="off" class="form-control"
                          >
                      </div>
                    </div>
                    <div class="form-group mb-2 row">
                      <label class="col-5 col-lg-3">Số điện thoại </label>
                      <div class="col-7 col-lg-9">
                        <input type="text" value="" name="wa_tel" maxlength="10" id="wa_tel"
                          autocomplete="off" class="form-control">
                      </div>
                    </div>
                    <div class="form-group mb-2 row">
                      <label class="col-5 col-lg-3">Số tháng bảo hành </label>
                      <div class="col-7 col-lg-9">
                        <input type="number" value="" name="wa_num_month" maxlength="255" id="wa_num_month"
                          autocomplete="off" class="form-control">
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
                    <ul class="nav nav-tabs nav-tabs-line" id="variantTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="buy-price-line-tab" data-bs-toggle="tab" href="#tab-variant"
                          role="tab" aria-controls="tab-variant" aria-selected="false">
                          <i class="icon-lg pb-3px" data-feather="check-square"></i>
                          Thuộc tính
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
                          <div id="attributeCard" class="col-12">
                            <div class="alert alert-info">Vui lòng <b>chọn danh mục</b> trước.</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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

@include('backend.page.store.product.modalcreatecategory')
@include('backend.page.store.product.modalcreatesupplier')
@include('backend.page.store.product.modalcreateattribute')
@include('backend.page.store.product.modalcreatenewattribute')

@section('script')

<script>

$(document).ready(function () {
  var token = localStorage.getItem("Token");
  $('#btn-create-category').click(function () {
    $('#modal-create-category').modal('show');
  });
  $('#btn-create-supplier').click(function () {
    $('#modal-create-supplier').modal('show');
  });
  $('#btn-create-new-attribute').click(function () {
    $('#modal-create-new-attribute').modal('show');
  });

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
    ajax: {
      url: '{{route('product.type')}}',
      dataType: 'json',
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (params) {
        return {
          filter_prd_type_name: params.term,
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
              id: item.prd_type_id,
              value: item.prd_type_id,
              text: item.prd_type_name
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
            value: item.country_iso,
            text: item.country_nicename
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

  function getUrlParameter(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  function displayError(statusCode) {
    var errorMessage = '';

    switch (statusCode) {
      case 401:
        errorMessage = 'Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập và thử lại.';
        break;
      case 403:
        errorMessage = 'Bạn không có quyền thực hiện việc này.';
        break;
      default:
        errorMessage = 'Đã có lỗi xảy ra. Vui lòng tải lại trang và thử lại.';
    }

    toastr.error(errorMessage, 'Lỗi');
  }

  function initProductDetails(data) {
    var prdValueTemp = {};
    if (data.prd_parent_id) {
      prdValueTemp.prd_parent_name = data.parent.prd_name || "--";
      prdValueTemp.prd_parent_id = data.parent.prd_id || null;
    }
    if (data.brand_id) {
      prdValueTemp.brand_name = data.brand.brand_name || "--";
      prdValueTemp.brand_id = data.brand.brand_id || null;
    }
    if (data.cat_inter_id) {
      prdValueTemp.cat_inter_name = data.category_internal.cat_inter_name || "--";
      prdValueTemp.cat_inter_id = data.category_internal.cat_inter_id || null;
    }
    if (data.country_id) {
      prdValueTemp.country_nicename = data.warranty.country.country_nicename || "--";
      prdValueTemp.country_id = data.warranty.country_id || null;
    }
    if (data.prd_type_id) {
      prdValueTemp.prd_type_name = data.type.prd_type_name || "--";
      prdValueTemp.prd_type_id = data.type.prd_type_id || null;
    }
    if (data.cat_id) {
      prdValueTemp.cat_name = data.categories.cat_name || "--";
      prdValueTemp.cat_id = data.categories.cat_id || null;
    }

    var newCountryOption = new Option(prdValueTemp.country_nicename, prdValueTemp.country_id, true, true);
    var newBrandOption = new Option(prdValueTemp.brand_name, prdValueTemp.brand_id, true, true);
    var newCatOption = new Option(prdValueTemp.cat_name, prdValueTemp.cat_id, true, true);
    var newCatInterOption = new Option(prdValueTemp.cat_inter_name, prdValueTemp.cat_inter_id, true, true);
    var newTypeOption = new Option(prdValueTemp.prd_type_name, prdValueTemp.prd_type_id, true, true);
    var newPrdParentOption = new Option(prdValueTemp.prd_parent_name, prdValueTemp.prd_parent_id, true, true);

    $('#country_id').empty().append(newCountryOption).trigger('change');
    $('#brand_id').empty().append(newBrandOption).trigger('change');
    $('#cat_id').empty().append(newCatOption).trigger('change');
    $('#cat_inter_id').empty().append(newCatInterOption).trigger('change');
    $('#prd_type_id').empty().append(newTypeOption).trigger('change');
    $('#prd_parent_id').empty().append(newPrdParentOption).trigger('change');

    $('#prd_status_id').val(data.prd_status_id).trigger('change');
    $('#prd_barcode').val(data.prd_barcode);
    $('#prd_code').val(data.prd_code);
    $('#prd_id').val(data.prd_id);
    $('#prd_name').val(data.prd_name);
    $('#pd_height').val(data.product_detail.pd_height);
    $('#pd_price').val(data.product_detail.pd_price);
    $('#pd_wholesale_price').val(data.product_detail.pd_wholesale_price);
    $('#pd_old_price').val(data.product_detail.pd_old_price);
    $('#pd_vat').val(data.product_detail.pd_vat);
    $('#pd_import_price').val(data.product_detail.pd_import_price);
    $('#pd_shipping_weight').val(data.product_detail.pd_shipping_weight);
    $('#pd_unit').val(data.product_detail.pd_unit);
    $('#pd_lenght').val(data.product_detail.pd_lenght);
    $('#pd_width').val(data.product_detail.pd_width);

    const fileInput = document.getElementById('pd_image');
    const image = data.product_detail.pd_image;
    fetch(image)
    .then(response => response.blob())
    .then(blob => {
      const file = new File([blob], data.product_detail.pd_image, { type: blob.type });

      // Create a FileList containing the File object
      const fileList = new DataTransfer();
      fileList.items.add(file);

      // Assign the FileList to the file input
      fileInput.files = fileList.files;
    });

    if (data.product_detail.pd_image && data.product_detail.pd_image !== ""){
      var imageUrl = '/storage/' + data.product_detail.pd_image;
      $("#imageArea").html('<img src="' + imageUrl + '" alt="'+ data.product_detail.pd_image +'">');
    }

    $('#wa_address').val(data.warranty.wa_address);
    $('#wa_tel').val(data.warranty.wa_tel);
    $('#wa_num_month').val(data.warranty.wa_num_month);

    ClassicEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
      var htmlContent = data.warranty.wa_content;
      if (htmlContent === null || htmlContent === undefined) {
        htmlContent = "";
      }
      editor.setData(htmlContent);

      var ckEditorContent = editor.getData();
      document.getElementById("wa_content").value = ckEditorContent;
    })
    .catch(error => {
      console.error(error);
    });


    if (data.cat_id && data.cat_id != null) {
      var variant_values = [];
      data.variant_values.forEach(element => {
        variant_values.push({var_id: element.var_id, vv_id: element.vv_id, vv_name: element.vv_name});
      });
      genAttributeCard(data.cat_id, variant_values)
    }
  }

  function getData() {
    var id = getUrlParameter('id');

    $.ajax({
      url: "{{ route('product.find')}}",
      type: 'GET',
      data: {
        id: id,
      },
      delay: 250,
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      success: function (response) {
        initProductDetails(response.data);
      },
      error: function (xhr) {
        var statusCode = xhr.status;
        displayError(statusCode);
      }
    });
  }

  getData();

  var AppAttributeProduct = {
    // Type hiển thị thuộc tính
    TYPE_SELECT: 1, TYPE_CHECKBOX: 2, TYPE_NUMBER: 3, TYPE_TEXT: 5,
    attributesData: {},
    attrsValues: {}, // Biến chỉ lưu values attrs
    cacheChildsList: {}, // Mảng lưu thông tin sản phẩm thuộc tính đã tạo
    isSubmit: false
  }
  //show/hide create child product
  function genAttributeCard(detailCatId, variantValuesData) {
    var cat_id_val = detailCatId;
    if (cat_id_val == '') {
      $('#childAttrWarning').removeClass('d-none');
      $('#childAttrPartial').addClass('d-none');
    } else {
      var selected_cat_id = cat_id_val;
      var variant_values = variantValuesData;
      $('#attributeCard').empty();
      handleGetAttributesList(selected_cat_id, variant_values);
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
        handleGetAttributesList(selected_cat_id, '');
      }
    });
  }

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

  function getIndexKey(array) {
    if (!array || typeof array != "object" || !Object.keys(array).length) {
      return '';
    }
    return array.sort().join('-');
  }

  function getSorted(c, a) {
    return $($(c).toArray().sort((b, c) => {
      let d = parseInt(b.getAttribute(a)), e = parseInt(c.getAttribute(a));
      return d - e;
    }));
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

  function getCKEditorData() {
    // Wait for the CKEditor instance to be ready
    if (window.ckeditorInstance) {
      // Get the CKEditor content
      var content = window.ckeditorInstance.getData();
      // You can now use the 'content' variable to work with the data.
      return content;
    }
  }

  function handleGetAttributesList(selected_cat_id, variant_values) {
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
        if (variant_values !== '') {
          var resp = response.data
          const filteredData = resp.filter(item => {
            return variant_values.some(filterItem => 
              item.var_id === filterItem.var_id
            );
          });
          //#region Aways show attribute tabs column
          $.each(filteredData, function (index, item) {
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
            html += '<select id="'+ eltAttrSelectId +'" name="var-' + index + '" class="form-select" data-attribute="'+ item.var_id +'" data-placeholder="Chọn ' + item.var_name + '">';
            $.each(item.variant_values, function(index, value) {
              let isSelected = '';
              if (value.vv_id) {
                const matchingVariant = variant_values.find(val => val.vv_id === value.vv_id);
                isSelected = matchingVariant ? ' selected' : '';
              }
              html += `<option value="${value.vv_id}" ${isSelected}>${value.vv_name}</option>`;
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
        } else {
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
            html += '<select id="'+ eltAttrSelectId +'" name="var-' + index + '" class="form-select" data-attribute="'+ item.var_id +'" data-placeholder="Chọn ' + item.var_name + '">';
            $.each(item.variant_values, function(index, value) {
              if (value.vv_id) {
                html += `<option value="${value.vv_id}">${value.vv_name}</option>`;
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
        }
      },
      //#endregion
      error: function (error) {
        console.log(error.responseJSON);
      }
    });
  }

  $('#productUpdateForm').submit(function (event) {
    event.preventDefault();
    var prd_name = $('input[name="prd_name"]').val();
    var prd_type_id = $('select[name="prd_type_id"]').val();
    var cat_id = $('select[name="cat_id"]').val();
    if (!prd_name || !prd_type_id || !cat_id) {
      toastr.error('Nhập các dữ liệu bắt buộc', 'Lỗi');
      return;
    }

    var attrsBreak = [];
    var hasInputQuantity = false;
    var parent_attr = getSelectedParentAttrValues()
    var formData = new FormData($('form#productUpdateForm')[0]);

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
      { name: 'country_iso', selector: 'select[name="country_id"]' },
      { name: 'wa_address', selector: 'input[name="wa_address"]' },
      { name: 'wa_tel', selector: 'input[name="wa_tel"]' },
      { name: 'wa_num_month', selector: 'input[name="wa_num_month"]' },
      { name: 'wa_content', selector: 'textarea[name="wa_content"]' },
    ];
    
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
      url: "{{ route('product.update') }}",
      type: 'POST',
      data: formData,
      enctype: 'multipart/form-data',
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      processData: false, // Không xử lý dữ liệu thành chuỗi query
      contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
      success: function (response) {
        $('#productUpdateForm')[0].reset();
        toastr.success(response.message, 'Thành công');
        setTimeout(function () {
          window.location.href = "{{ route('product') }}";
        }, 900);
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

  function getSelectedParentAttrValues() {
    const parent_attr = [];
    // Find all the select elements inside the div with ID "attributeCard"
    $('#attributeCard select').each(function() {
      const selectedValue = $(this).val();
      const dataAttribute = $(this).parents("select").prevObject[0].dataset.attribute; 

      // Check if selectedValue is not empty before pushing it into the array
      if (selectedValue !== "" && selectedValue !== null) {
        parent_attr.push({var_id: dataAttribute, vv_id: selectedValue });
      }
    });
    return parent_attr;
  }

});
</script>

@endsection
