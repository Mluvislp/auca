@extends('backend.layout.layout')

@section('title')
Lịch sử sửa xóa phiếu XNK
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
      <li class="breadcrumb-item active" aria-current="page">Lịch sử sửa xóa phiếu XNK</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('history') }}">Lịch sử sửa xóa phiếu XNK</a>
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
                        <option value="hihi">- Kho hàng -</option>
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
                        <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                            <option value="0">- Kiểu log -</option>
                            <option value="">Sửa hóa đơn</option>
                            <option value="">Xóa hóa đơn</option>
                            <option value="">Tạo phiếu</option>
                            <option value="">Khôi phục phiếu</option>
                            <option value="">Gộp phiếu</option>
                            <option value="">Sửa phiếu chuyển kho</option>
                        </select>
                      </div>
                    </div>
                </div>

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                    <div class="form-group input-group mb-0 pt-3">
                      <div class="col p-0">
                        <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                            <option value="0">- Kiểu -</option>
                            <option value="">[N] Nhà cung cấp</option>
                            <option value="">[C] Chuyển kho</option>
                            <option value="">[G] Giao hàng</option>
                            <option value="">[L] Bán lẻ</option>
                            <option value="">[B] Bán sỉ</option>
                            <option value="">[TL] Tặng kèm (Bán lẻ)</option>
                            <option value="">[TG] Tặng kèm (Giao hàng)</option>
                            <option value="">[TB] Tặng kèm (Bán sỉ)</option>
                            <option value="">[K] Bù trừ kiểm kho</option>
                            <option value="">[#] Khác</option>
                            <option value="">[BH] Bảo hành</option>
                            <option value="">[SC] Sửa chữa</option>
                            <option value="">[LKBH] Linh kiện bảo hành</option>
                            <option value="">[CB] Combo</option>
                        </select>
                      </div>
                    </div>
                </div>

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                    <div class="form-group input-group mb-0 pt-3">
                      <div class="col p-0">
                        <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                            <option value="0">- Loại -</option>
                            <option value="">Nhập</option>
                            <option value="">Xuất</option>
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
                    <label class="col-form-label text-right col-12 pl-0 pr-0">XNK từ ngày</label>
                    <div class="col-12 pr-0">
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

                <div class="col-12 col-md-4 col-lg-3 pr-0">

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Người sửa, xóa</label>
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
              <div id="dataTableExampleHero_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="dataTableExampleHero" class="table dataTable no-footer table-bordered"
                      aria-describedby="dataTableExampleHero_info">
                      <thead class="table-light">
                        <tr>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            ID hóa đơn
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Kiểu log
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Loại XNK
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataTableExampleHero" rowspan="1" colspan="1" aria-sort="ascending">
                            Kiểu XNK
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Ngày XNK
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Người thao tác
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Thời gian tạo
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
                          </td>
                          <td class="text-start">Sửa hóa đơn</td>
                          <td class="text-center">Nhập</td>
                          <td class="text-center">[N] Nhà cung cấp</td>
                          <td class="text-center">02/08/2023</td>
                          <td class="text-center">123</td>
                          <td class="text-center">
                            <b>00:30</b>
                            <p>04/08/2023</p>
                          </td>
                          <td class="text-center">
                            <a href="#">
                              <i class="icon-lg pb-3px" data-feather="eye"></i>
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
    </div>
  </div>
</div>

@endsection

@section('script')

<script>
  var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
</script>

@endsection