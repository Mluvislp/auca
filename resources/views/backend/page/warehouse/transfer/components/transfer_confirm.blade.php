@extends('backend.layout.layout')

@section('title')
Duyệt phiếu chuyển kho nháp
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('transfer') }}">Chuyển kho</a></li>
            <li class="breadcrumb-item active" aria-current="page">Duyệt phiếu chuyển kho nháp</li>
        </ol>
    </nav>
    <form action="{{ route('suppliers.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Thông tin</h6>
                        <form class="forms-sample">
                            
                            <div class="form-group mb-2">
                                <div class="row">
                                  <label class="col-5 col-lg-3 col-form-label">Từ kho<span class="text-danger">*</span>
                                  </label>
                                  <div class="col-7 col-lg-9 d-flex align-items-center">
                                    <p class="text-danger">shangyang132</p>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <div class="row">
                                  <label class="col-5 col-lg-3 col-form-label">Đến kho<span class="text-danger">*</span>
                                  </label>
                                  <div class="col-7 col-lg-9 d-flex align-items-center">
                                    <p class="text-danger">shangyang321</p>
                                  </div>
                                </div>
                            </div> 

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card w-100 p-0">
                    <div class="card-body">
                        <h6 class="card-title">Giao nhận</h6>

                        <div class="form-group mb-2">
                            <div class="row">
                              <label class="col-5 col-lg-3 col-form-label">Ghi chú</label>
                              <div class="col-7 col-lg-9 d-flex align-items-center">
                                <textarea class="form-control" name="sup_note" cols="30" rows="10"
                                placeholder="Vui lòng nhập">{{ old('sup_note') }}</textarea>
                              </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>

    <div>
        <div class="card p-3">
            <div class="card-body p-0 pt-2">

              <div class="row">
                <div class="col-6">
                <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Sản phẩm</button>
                    <ul class="dropdown-menu" style="">
                        <li><a class="dropdown-item" href="#">Nhập theo ri</a></li>
                    </ul>
                    <input type="text" class="form-control" aria-label="Text input with dropdown button">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-lg pb-3px h-100" data-feather="loader"></i>
                        </span>
                    </div>
                </div>
                </div>
                <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="IMEI" aria-label="Text input with dropdown button">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-lg pb-3px h-100" data-feather="loader"></i>
                        </span>
                    </div>
                </div>
                </div>
              </div>

                <div class="table-responsive overflow-hidden">
                  <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer ">
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="dataTableExampleHero" class="table dataTable no-footer table-bordered"
                          aria-describedby="dataTableExample_info">
                          <thead>
                            <tr>
                              <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                                colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending">Mã SP</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Office: activate to sort column ascending">Tên SP</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Office: activate to sort column ascending">IMEI</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">ĐVT</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Có thể chuyển</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Yêu cầu</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Lỗi</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending">SL duyệt</th>
                              <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                                rowspan="1" colspan="1">
                                <div>
                                    <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="icon-lg pb-3px" data-feather="settings"></i>
                                  </span>
                                  <ul class="dropdown-menu">
                                    <li>
                                      <a class="dropdown-item fs-6 text-start" href="#">
                                        <i class="icon-lg pb-3px" data-feather="message-square"></i>
                                        Hiện ô nhập ghi chú cho tất cả sản phẩm
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td class="text-center">
                                    <p>
                                        1
                                    </p>
                                </td>
                                <td class="text-start">
                                    <p>
                                        A02.A05.5A10
                                    </p>    
                                </td>
                                <td class="text-start">
                                    Liệu trình hộp 7 ngày than tre + kem đánh răng than tre tặng 5 gói súc miệng
                                </td>
                                <td class="text-center">Null</td>
                                <td class="text-center">Null</td>
                                <td class="text-center">500</td>
                                <td class="text-center">25</td>
                                <td class="text-center">0</td>
                                <td class="text-center">
                                  <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                                </td>
                                <td class="text-center">
                                  <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="icon-lg pb-3px" data-feather="menu"></i>
                                  </span>
                                  <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item fs-6 text-start" href="#">
                                          <i class="icon-lg pb-3px" data-feather="message-square"></i>
                                          Hiện ô nhập ghi chú
                                        </a>
                                      </li>
                                    <li>
                                      <a class="dropdown-item fs-6 text-start text-danger" href="#">
                                        <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                                        Xóa sản phẩm
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

    <div>
        <div class="card p-3 mt-3">
        

            <div class="mb-3 d-flex align-items-center gap-2">
                <div>
                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                    Lưu thay đổi
                  </button>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@section('script')

@if ($errors->any())
<script>
    @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
            @endforeach
</script>
@endif

<script>
    var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
</script>

@endsection