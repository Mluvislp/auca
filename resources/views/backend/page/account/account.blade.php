@extends('backend.layout.layout')

@section('title')
Sản phẩm
@endsection

@section('content')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Bảng điều khiển</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Quản lý người dùng</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
            aria-controls="home" aria-selected="true">Phân quyền</a>
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
                    <input type="text" name="title" maxlength="255" placeholder="Tiêu đề" id="title"
                      class="form-control" value="">
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-3 col-lg-2 pr-1">
                <div class="form-group input-group mb-0 pt-3">
                  <div class="col p-0">
                    <input type="text" name="user" maxlength="255" placeholder="Người dùng" autofocus="autofocus"
                      autocomplete="off" id="user" class="form-control" value="">
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
                    <a class="dropdown-item fs-5" href="#">
                      <i class="fa-solid fa-arrow-left p-1"></i>
                      Nhập kho
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item fs-5" href="#">
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
                            <div class="mb-3 form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            </div>
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Tiêu đề
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Mô tả
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Nhân viên
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                            rowspan="1" colspan="1">
                            Ngày tạo
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
                            <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            </div>
                          </td>
                          <td class="text-start">
                            Lorem, ipsum dolor.
                          </td>
                          <td class="text-start">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</td>
                          <td class="text-start">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item p-1">An item</li>
                              <li class="list-group-item p-1">A second item</li>
                              <li class="list-group-item p-1">A third item</li>
                              <li class="list-group-item p-1">A fourth item</li>
                              <li class="list-group-item p-1">And a fifth one</li>
                            </ul>
                          </td>
                          <td class="text-center">
                            2022-10-10 15:57:08
                          </td>
                          <td class="text-center">
                            <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                              aria-expanded="false">
                              <i class="icon-lg pb-3px" data-feather="menu"></i>
                            </span>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item fs-6 text-start" href="{{ route('edit_permission') }}">
                                  <i class="icon-lg pb-3px" data-feather="edit-3"></i>
                                  Sửa quyền
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-6 text-start text-danger" href="#">
                                  <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                                  Xóa quyền
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