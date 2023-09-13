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
      <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
            aria-controls="home" aria-selected="true">Danh mục sản phẩm</a>
        </li>
      </ul>
      <div class="tab-content mt-3" id="lineTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
          <div class="card-body p-0 pt-2">
            <!-- Start Filter content -->
            <div class="row mb-3">
              <div class="col-6 col-md-3 col-lg-2 pr-1">
                <div class="form-group input-group mb-0 pt-3">
                  <div class="col p-0">
                    <input type="text" name="id" maxlength="255" placeholder="Tên danh mục" id="id" class="form-control"
                      value="">
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-3 col-lg-2 pr-1">
                <div class="form-group input-group mb-0 pt-3">
                  <div class="col p-0">
                    <input type="text" name="name" maxlength="255" placeholder="Mã danh mục" autofocus="autofocus"
                      autocomplete="off" id="name" class="form-control" value="">
                  </div>
                </div>
              </div>
              <div class="col-1 pt-3">
                <div class="btn-group dropdown">
                  <button type="submit" class="btn submitFilterBtn btn-success">
                    Lọc
                  </button>
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
                    <a class="dropdown-item fs-5" href="{{ route('add_category') }}">
                      <i class="icon-lg pb-3px" data-feather="plus"></i>
                      Thêm mới
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
                      <i class="fa-solid fa-arrow-right-arrow-left p-1"></i>
                      Đổi trạng thái
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item fs-5" href="#">
                      <i class="icon-lg pb-3px" data-feather="trash"></i>
                      Xóa Cache
                    </a>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li>
                    <a class="dropdown-item text-danger fs-5" href="#">
                      <i class="icon-lg text-danger pb-3px" data-feather="trash"></i>
                      Xóa các dòng đã chọn
                    </a>
                  </li>
                </ul>
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
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                          rowspan="1" colspan="1">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                          </div>
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                          rowspan="1" colspan="1">
                          STT
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                          rowspan="1" colspan="1">
                          Tên
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                          rowspan="1" colspan="1">
                          Mã
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                          rowspan="1" colspan="1">
                          Ảnh
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                          rowspan="1" colspan="1">
                          Icon
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                          rowspan="1" colspan="1">
                          Thứ tự
                        </th>
                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                          rowspan="1" colspan="1">
                          Số SP
                        </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                          </td>
                          <td class="text-center">
                            1
                          </td>
                          <td class="text-start">
                            shangyang132
                          </td>
                          <td class="text-start">A100</td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-end">100,000</td>
                          <td class="text-center">2</td>
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