@extends('backend.layout.layout')

@section('title')
Kiểm kho
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
            <a class="nav-link active" href="{{ route('check') }}">Kiểm kho</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('product_check') }}">Sản phẩm kiểm kho</a>
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
                        id="filter_var_vg_id" multiple multiselect-search="true" multiselect-select-all="true"
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
                      <input type="text" name="var_id" maxlength="255" placeholder="ID" id="var_id" class="form-control"
                        value="">
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]"
                        id="filter_var_cat_id">
                        <option value="hihi">- Loại kiểm kho -</option>
                        <option value="">Theo sản phẩm</option>
                        <option value="">Toàn bộ</option>
                        <option value="">Theo danh mục</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]"
                        id="filter_var_cat_id">
                        <option value="hihi">- Phiếu bù trừ -</option>
                        <option value="">Đã làm bù trừ</option>
                        <option value="">Chưa làm bù trừ</option>
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
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Ghi chú</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row g-0 m-0 input-group">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Ngày bù trừ</label>
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

              <div class="mb-3 d-flex align-items-center gap-2">
                <div>
                  <a href="{{ route('add_check') }}">
                    <button type="button" class="btn btn-success btn-sm">
                      <i class="icon-lg pb-3px" data-feather="plus"></i>
                      Thêm mới
                    </button>
                  </a>
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
                        <i class="icon-lg pb-3px" data-feather="minimize"></i>
                        Gộp các phiếu đã chọn
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
                            Loại kiểm kho
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending">
                            Kho
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Người tạo
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
                            <i class="icon-md text-black pb-3px" data-feather="message-square" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Ghi chú"></i>
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            SP Thiếu
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Bù trừ kiểm kho
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
                          <td class="text-center">
                            <a href="#">123456678</a>
                            <p>18/07/2023</p>
                          </td>
                          <td class="text-center">Theo sản phẩm</td>
                          <td class="text-center">shangyang132</td>
                          <td class="text-center">
                           <p>123</p>
                          </td>
                          <td class="text-center">
                            <p>2</p>
                          </td>
                          <td class="text-center">
                            <p>2</p>
                          </td>
                          <td class="text-center">
                            <p>Không có ghi chú</p>
                          </td>
                          <td class="text-center">Null</td>
                          <td class="text-center">
                            <b>123</b>
                            <p> <span>12:25</span> 11/03/2021</p>
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
                                <a class="dropdown-item fs-5" href="#">
                                  <i class="icon-lg pb-3px" data-feather="bar-chart-2"></i>
                                  Báo cáo
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-5" href="#">
                                  <i class="icon-lg pb-3px" data-feather="file"></i>
                                  Xuất excel sản phẩm
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