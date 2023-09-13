@extends('backend.layout.layout')

@section('title')
Gọi hàng từ kho khác
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('transfer') }}">Chuyển kho</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gọi hàng từ kho khác</li>
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
                                    <select class="form-select mb-3">
                                        <option selected="">- Kho hàng -</option>
                                        <option value="1">shangyang123</option>
                                    </select>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <div class="row">
                                  <label class="col-5 col-lg-3 col-form-label">Đến kho<span class="text-danger">*</span>
                                  </label>
                                  <div class="col-7 col-lg-9 d-flex align-items-center">
                                    <select class="form-select mb-3">
                                        <option selected="">- Kho hàng -</option>
                                        <option value="1">shangyang123</option>
                                    </select>
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
                        <h6 class="card-title">Thanh toán</h6>

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

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card w-100 p-0">
                    <div class="card-body">
                        <h6 class="card-title">Nhãn</h6>

                        <div class="form-group mb-2">
                          <div class="row">
                            <div class="col-1 my-auto">
                              <div class="form-check form-check-inline">
                                <input type="checkbox" name="skill_check" class="form-check-input" id="checkInline1">
                              </div>
                            </div>
                            <div class="col-11">
                              <div class="input-group">
                                <input type="text" placeholder="Tìm kiếm nhãn" class="form-control" aria-label="Text input with dropdown button">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <a href="#">
                                        <i class="icon-lg pb-3px h-100 text-success" data-feather="plus"></i>
                                      </a>
                                    </span>
                                </div>
                            </div>
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
                                colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Mã vạch SP</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending">Mã SP</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Office: activate to sort column ascending">Tên SP</th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">ĐVT</th>
                              <th class="sorting pb-0 pt-0 text-center" tabindex="0" aria-controls="dataTableExampleHero"
                                  rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                                  data-bs-title="Copy số lượng duyệt sang ô số lượng">
                                  Có thể chuyển
                                  <a href="#">
                                      <i class="icon-lg pb-3px text-danger my-2" data-feather="skip-forward"></i>
                                  </a>
                              </th>
                              <th class="sorting pt-2 pb-1 text-center" tabindex="0" aria-controls="dataTableExampleHero"
                                rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Điền số lượng và click mũi tên để thay đổi số lượng cho tất cả các dòng bên dưới">
                                <div class="d-flex">
                                    <input type="text" class="form-control w-auto" id="exampleInputUsername1" autocomplete="off" placeholder="SL">
                                    <a href="#">
                                        <i class="icon-lg pb-3px text-blue my-2" data-feather="arrow-down"></i>
                                    </a>
                                </div>
                              </th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Salary: activate to sort column ascending">Lỗi <span>(0)</span></th>
                              <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending">Giá</th>
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
                                        2000208406152
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
                                <td class="text-end">Null</td>
                                <td class="text-end">498</td>
                                <td class="text-end">
                                  <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                                </td>
                                <td class="text-end">
                                    <input type="number" max="99999" min="0" value="0" class="form-control" data-id="6">
                                </td>
                                <td class="text-end">
                                    199.000
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
            
            <div class="mb-3 d-flex">
                <b>Sau khi lưu dữ liệu: </b>
                <div class="form-group mb-2">
                    <div class="col-lg-8">
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <span class="uniform-choice">
                            <span class="checked">
                              <input value="afterSubmit-2" type="radio" class="form-check-input-styled" name="afterSubmit" checked="checked" data-fouc="" selected="selected">
                            </span>
                          </span>
                          Tiếp tục lập phiếu
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <span class="uniform-choice">
                            <span class="">
                              <input value="afterSubmit-1" type="radio" class="form-check-input-styled" name="afterSubmit" data-fouc="" selected="selected">
                            </span>
                          </span>
                          Về trang danh sách
                        </label>
                      </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 d-flex align-items-center gap-2">
                <div>
                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                    Lưu thay đổi
                  </button>
                </div>
                <div>
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database icon-lg pb-3px"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down icon-lg pb-3px"><polyline points="6 9 12 15 18 9"></polyline></svg>
                  </button>
                  <ul class="dropdown-menu p-2">
                    <li class="d-flex">
                        <b>(Tổng)</b><p> Phiếu nhập kho gần đây</p>
                    </li>
                    <hr>
                    <li>
                        Chưa có dữ liệu:
                    </li>
                  </ul>
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