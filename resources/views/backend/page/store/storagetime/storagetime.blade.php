@extends('backend.layout.layout')

@section('title')
Thời gian lưu kho
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
      <li class="breadcrumb-item active" aria-current="page">Thời gian lưu kho</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
            aria-controls="home" aria-selected="true">Danh sách sản phẩm thời gian lưu kho
          </a>
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
                      <select class="form-select" aria-label="multiple select example" name="filter_var_vg_id[]"
                        id="filter_var_vg_id" custom-multiple multiselect-search="true" multiselect-select-all="true"
                        multiselect-max-items="1">
                        <option value="asd">shangyang132</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="">- Xem dữ liệu -</option>
                        <option value="">Nhập lâu, chưa bán được</option>
                        <option value="">Bán chậm</option>
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

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_var_vg_id[]"
                        id="filter_var_vg_id" custom-multiple multiselect-search="true" multiselect-select-all="true"
                        multiselect-max-items="1">
                        <option value="">- Danh mục -</option>
                        <option value="">Tên danh mục</option>
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
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Loại</label>
                    <div class="col-12 pr-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="0">- Loại -</option>
                        <option value="">Chưa gắn loại sản phẩm</option>
                        <option value="">Sản phẩm</option>
                        <option value="">Voucher</option>
                        <option value="">Sản phẩm cân đo</option>
                        <option value="">Sản phẩm theo IMEI</option>
                        <option value="">Gói sản phẩm</option>
                        <option value="">Dịch vụ</option>
                        <option value="">Dụng cụ</option>
                        <option value="">Sản phẩm bán theo lô</option>
                        <option value="">Combo</option>
                        <option value="">Sản phâm nhiều đơn vị tính</option>
                      </select>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Trạng thái</label>
                    <div class="col-12 pr-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="0">- Trạng thái -</option>
                        <option value="">Mới</option>
                        <option value="">Đang bán</option>
                        <option value="">Nghừng bán</option>
                        <option value="">Hết hàng</option>
                      </select>
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
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Thương hiệu</label>
                    <div class="col-12 pr-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="0">- Thương hiệu -</option>
                        <option value="1">Tên thương hiệu</option>
                      </select>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Danh mục nội bộ</label>
                    <div class="col-12 pr-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="0">- Danh mục nội bộ -</option>
                        <option value="1">Tên danh mục</option>
                      </select>
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
                    <hr>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                        Lập phiếu nháp nhà cung cấp
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                        Lập phiếu nháp chuyển kho
                      </a>
                    </li>
                    <hr>
                    <li>
                        <a class="dropdown-item fs-5" href="#">
                          <i class="icon-lg pb-3px" data-feather="refresh-ccw"></i>
                          Đổi trạng thái sản phẩm
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
                            Sản phẩm
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Nhà cung cấp
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Giá nhập / Giá bán
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tồn
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tổng tồn
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Lỗi
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Ngày bắt đầu XNK
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Ngày cuối cùng XKN
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Ngày bán cuối cùng
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Lưu từ ngày bắt đầu
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Lưu từ ngày cuối cùng
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Lưu từ ngày bán cuối cùng
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-start">
                            <p>2A09.2A07</p>
                            <a href="#">
                              "Combo 2 hộp NSM tặng 5 gói mước súc miệng -2A09.5A10 SKU: 2A09.5A10"
                            </a>
                          </td>
                          <td class="text-start">
                            <a href="#">
                              Gucci
                            </a>
                          </td>
                          <td class="text-center">126.600</td>
                          <td class="text-center">1.999</td>
                          <td class="text-center">1999</td>
                          <td class="text-center">Null</td>
                          <td class="text-center">08/05</td>
                          <td class="text-center">08/05</td>
                          <td class="text-center">08/05</td>
                          <td class="text-center">90 ngày</td>
                          <td class="text-center">90 ngày</td>
                          <td class="text-center">90 ngày</td>
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

@endsection @section('script')
<script>
var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
</script>
@endsection