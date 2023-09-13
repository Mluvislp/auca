@extends('backend.layout.layout')

@section('title')
Thêm phiếu nháp khác
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('draft') }}">Phiếu nháp</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm phiếu nháp khác</li>
        </ol>
    </nav>
    <form action="#" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Thông tin</h6>
                        <form class="forms-sample">

                            <div class="form-group mb-4">
                                <div class="row">
                                  <label class="col-5 col-lg-3 col-form-label">Ngày thực hiện<span class="text-danger">*</span>
                                  </label>
                                  <div class="col-7 col-lg-9 d-flex align-items-center">
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="text" class="form-control flatpickr-input" placeholder="Chọn ngày" data-input="" readonly="readonly">
                                    </div>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <div class="row">
                                  <label class="col-5 col-lg-3 col-form-label">Loại<span class="text-danger">*</span>
                                  </label>
                                  <div class="col-7 col-lg-9 d-flex align-items-center">
                                    <select class="form-select mb-3">
                                        <option selected="">- Loại -</option>
                                        <option value="">Nhập</option>
                                        <option value="">Xuất</option>
                                    </select>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <div class="row">
                                  <label class="col-5 col-lg-3 col-form-label">Cửa hàng<span class="text-danger">*</span>
                                  </label>
                                  <div class="col-7 col-lg-9 d-flex align-items-center">
                                    <select class="form-select mb-3">
                                        <option selected="">- Cửa hàng -</option>
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
                        <h6 class="card-title">Người gửi, người nhận</h6>

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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus icon-lg pb-3px h-100 text-success"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
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
                <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Sản phẩm</button>
                    <ul class="dropdown-menu" style="">
                        <li><a class="dropdown-item" href="#">Nhập theo ri</a></li>
                    </ul>
                    <input type="text" class="form-control" aria-label="Text input with dropdown button">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <a href="#">
                            <i class="icon-lg pb-3px text-dark" data-feather="loader"></i>
                          </a>
                        </span>
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
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending">Mã SP</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Office: activate to sort column ascending">Tên SP</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Đơn vị tính</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">SL</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Giá yêu cầu</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Xóa</th>
                            </tr>
                          </thead>
                          <tbody>

                            <tr>
                                <td class="text-center">
                                    <p>
                                        A02.A05.5A10
                                    </p>
                                </td>
                                <td class="text-start">
                                    Liệu trình hộp 7 ngày than tre + kem đánh răng than tre tặng 5 gói súc miệng
                                </td>
                                <td class="text-center">Null</td>
                                <td class="text-center">
                                    <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                                </td>
                                <td class="text-center">
                                    <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                                </td>
                                <td class="text-center">
                                    <a class="text-center text-danger" href="#">
                                        <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
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
                          Tiếp tục tạo phiếu
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