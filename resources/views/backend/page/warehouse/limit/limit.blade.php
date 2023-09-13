@extends('backend.layout.layout')

@section('title')
Hạn mức tồn kho
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
      <li class="breadcrumb-item active" aria-current="page">Hạn mức tồn kho</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('check') }}">Hạn mức tồn kho</a>
        </li>
      </ul>
      <div class="tab-content mt-3" id="lineTabContent">

        {{-- table --}}
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
                      <select class="form-select" aria-label="multiple select example" name="filter_var_vg_id[]"
                        id="filter_var_vg_id" custom-multiple multiselect-search="true" multiselect-select-all="true"
                        multiselect-max-items="1">
                        <option value="hihi">- Danh mục -</option>
                        <option value="asd">Tên danh mục</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]"
                        id="filter_var_cat_id">
                        <option value="hihi">- Lọc tồn tối thiểu -</option>
                        <option value="">Tồn hiện tại < tồn tối thiểu</option>
                        <option value="">Tồn hiện tại <= tồn tối thiểu</option>
                        <option value="">Tồn hiện tại > tồn tối thiểu</option>
                        <option value="">Tồn hiện tại >= tòn tối thiểu</option>
                        <option value="">Có thể bán < tồn tối thiểu</option>
                        <option value="">Có thể bán <= tồn tối thiểu</option>
                        <option value="">Có thể bán > tồn tối thiểu</option>
                        <option value="">Có thể bán >= tồn tối thiểu</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                    <div class="form-group input-group mb-0 pt-3">
                      <div class="col p-0">
                        <select class="form-select" aria-label="select example" name="filter_var_cat_id[]"
                          id="filter_var_cat_id">
                          <option value="hihi">- Lọc tồn tối đa -</option>
                          <option value="">Tồn hiện tại < tồn tối đa</option>
                          <option value="">Tồn hiện tại <= tồn tối đa</option>
                          <option value="">Tồn hiện tại > tồn tối đa</option>
                          <option value="">Tồn hiện tại >= tòn tối đa</option>
                          <option value="">Có thể bán < tồn tối đa</option>
                          <option value="">Có thể bán <= tồn tối đa</option>
                          <option value="">Có thể bán > tồn tối đa</option>
                          <option value="">Có thể bán >= tồn tối đa</option>
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
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Người tạo</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
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
                            <select class="form-select" aria-label="multiple select example" name="filter_var_vg_id[]"
                                id="filter_var_vg_id" custom-multiple multiselect-search="true" multiselect-select-all="true"
                                multiselect-max-items="1">
                                <option value="hihi">- Thương hiệu -</option>
                                <option value="asd">Tên thương hiệu</option>
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
                        <a class="dropdown-item fs-5" href="{{ route('add_limit') }}">
                          <i class="icon-lg pb-3px" data-feather="plus"></i>
                          Thêm mới
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item fs-5" href="#">
                          <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                          Nhập từ excel
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
                      <a class="dropdown-item text-danger fs-5" href="#">
                        <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                        Xóa các dòng đã chọn
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
                            Cửa hàng
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Mã sản phẩm
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tên sản phẩm
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending">
                            Tồn hiện tại
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tồn tối thiểu
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                          rowspan="1" colspan="1">
                            Tồn tối đa
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                          rowspan="1" colspan="1">
                            Người tạo
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
                            <p>shangyang132</p>
                          </td>
                          <td class="text-center">
                            <p>XĐ-dă-1-3y</p>
                          </td>
                          <td class="text-start">
                            <p>Xe độ - ădawdaw - 1-3y</p>
                          </td>
                          <td class="text-center">
                            <a href="#">10</a>
                          </td>
                          <td class="text-center">
                           <p class="text-success">10</p>
                          </td>
                          <td class="text-center">
                            <p class="text-success">15</p>
                          </td>
                          <td class="text-center">
                            <p>123</p>
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