@extends('backend.layout.layout')

@section('title')
Thêm phiếu nháp bán lẻ
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('draft') }}">Phiếu nháp</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm phiếu nháp bán lẻ</li>
        </ol>
    </nav>
    <form action="#" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Khách hàng</h6>
                        <hr>
                        <form class="forms-sample">

                            <div class="row">

                                <div class="col">
                                  
                                    <div class="form-group mb-3">
                                        <select class="form-select">
                                            <option selected="">- Xuất -</option>
                                            <option value="">Nhập</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                      <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="text" class="form-control flatpickr-input" placeholder="Chọn ngày" data-input="" readonly="readonly">
                                      </div>
                                    </div>

                                    <div class="form-group mb-3">
                                      <input type="text" name="id" maxlength="100" id="imei" placeholder="Tên khách hàng" class="form-control" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                      <input type="text" name="id" maxlength="100" id="imei" placeholder="Số điện thoại" class="form-control" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                      <input type="text" name="id" maxlength="100" id="imei" placeholder="Ghi chú hóa đơn" class="form-control" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                      <select class="form-select">
                                          <option selected="">- Giới tính -</option>
                                          <option value="">Nam</option>
                                          <option value="">Nữ</option>
                                      </select>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                      <input type="text" name="id" maxlength="100" id="imei" placeholder="Tên công ty" class="form-control" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                      <input type="text" name="id" maxlength="100" id="imei" placeholder="Mã số thuể" class="form-control" value="">
                                    </div>

                                </div>

                                <div class="col">

                                  <div class="form-group input-group mb-3">
                                    <div class="col p-0">
                                      <select class="form-select" id="city-select-field" data-placeholder="Choose one thing">
                                        <option>- Thành phố -</option>
                                        <option>Chọn thành phố</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group input-group mb-3">
                                    <div class="col p-0">
                                      <select class="form-select" id="district-select-field" data-placeholder="Choose one thing">
                                        <option>- Quận huyện -</option>
                                        <option>Chọn quận huyện</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group mb-3">
                                    <input type="text" name="id" maxlength="100" id="imei" placeholder="Email khách hàng" class="form-control" value="">
                                  </div>
                                  
                                  <div class="form-group mb-3">
                                    <input type="text" name="id" maxlength="100" id="imei" placeholder="Địa chỉ" class="form-control" value="">
                                  </div>

                                  <div class="form-group input-group mb-3">
                                    <div class="col p-0">
                                      <select class="form-select" id="tag-select-field" data-placeholder="Choose one thing">
                                        <option>- Nhãn khách hàng -</option>
                                        <option>Chọn nhãn khách hàng</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group mb-3">
                                    <input type="text" name="id" maxlength="100" id="imei" placeholder="Số PO - Hợp đồng" class="form-control" value="">
                                  </div>

                                  <div class="form-group mb-3">
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                      <input type="text" class="form-control flatpickr-input" placeholder="Ngày ký hợp đồng" data-input="" readonly="readonly">
                                    </div>
                                  </div>

                                  <div class="form-group mb-3">
                                    <input type="text" name="id" maxlength="100" id="imei" placeholder="Ghi chú" class="form-control" value="">
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
                        <hr>

                        <div class="form-group mb-3">
                            <div class="row">

                              <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Tiền mặt</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">%</a></li>
                                </ul>
                                <input type="number" class="form-control" placeholder="VAT" aria-label="Text input with dropdown button">
                              </div>

                              <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Tiền mặt</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">%</a></li>
                                </ul>
                                <input type="text" class="form-control" placeholder="Chiết khấu" aria-label="Text input with dropdown button">
                              </div>

                              <div class="form-group mb-3">
                                <input type="number" name="id" maxlength="100" id="imei" placeholder="Tiền mặt" class="form-control" value="">
                              </div>

                              <div class="w-100">
                                <div class="row mb-3">
                                  <div class="col">
                                    <div class="form-group">
                                      <select class="form-select">
                                          <option selected="">- Tài khoản quẹt thẻ -</option>
                                          <option value="">1121.1 (Vietcombank)</option>
                                          <option value="">1121.2 (Agribank)</option>
                                          <option value="">1121.3 (VIB)</option>
                                          <option value="">1121.4 (BIDV)</option>
                                      </select>
                                  </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <input type="number" name="id" maxlength="100" id="imei" placeholder="Tiền quyẹt thẻ" class="form-control" value="">
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group mb-3">
                                <input type="text" name="id" maxlength="100" id="imei" placeholder="Mã giao dịch" class="form-control" value="">
                              </div>

                              <div class="w-100">
                                <div class="row mb-3">
                                  <div class="col">
                                    <div class="form-group">
                                      <select class="form-select">
                                          <option selected="">- Tài khoản quẹt thẻ -</option>
                                          <option value="">1121.1 (Vietcombank)</option>
                                          <option value="">1121.2 (Agribank)</option>
                                          <option value="">1121.3 (VIB)</option>
                                          <option value="">1121.4 (BIDV)</option>
                                      </select>
                                  </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <input type="number" name="id" maxlength="100" id="imei" placeholder="Số tiền chuyển khoản" class="form-control" value="">
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group mb-3">
                                <div class="input-group flatpickr" id="flatpickr-date">
                                  <input type="text" class="form-control flatpickr-input" placeholder="Chọn ngày hẹn thanh toán" data-input="" readonly="readonly">
                                </div>
                              </div>
                              
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- <div class="col-md-6 grid-margin stretch-card">
                <div class="card w-100 p-0">
                    <div class="card-body">
                        <h6 class="card-title">Thông tin</h6>
                        <hr>

                        <div class="form-group mb-3">
                          <select class="form-select">
                              <option selected="">- Sau khi lưu dữ liệu -</option>
                              <option value="">Tiếp tục thêm phiếu yêu cầu</option>
                              <option value="">Về danh sách phiếu yêu cầu</option>
                          </select>
                        </div>

                    </div>
                </div>
            </div> --}}

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card w-100 p-0">
                  <div class="card-body">
                      <h6 class="card-title">Nhãn</h6>
                      <hr>

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

                <div class="row">
                  <div class="col">
                    <div class="form-group mb-3">
                      <select class="form-select">
                          <option selected="">- Xuất -</option>
                          <option value="">Nhập</option>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="input-group mb-3">
                      <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Sản phẩm</button>
                      <ul class="dropdown-menu" style="">
                          <li><a class="dropdown-item" href="#">Nhập theo ri</a></li>
                      </ul>
                      <input type="text" class="form-control" aria-label="Text input with dropdown button">
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
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending">#</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                aria-label="Office: activate to sort column ascending">Sản phẩm</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Đơn vị tính</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">SL</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Tồn</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Giá</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Giảm giá</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Thành tiền</th>
                              <th class="sorting text-center" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                                  aria-label="Position: activate to sort column ascending">Xóa</th>
                            </tr>
                          </thead>
                          <tbody>

                            <tr>
                                <td class="text-center">
                                  1
                                </td>
                                <td class="text-center">
                                    <p>
                                      [Freeship Max] Combo ưu đãi Bàn chải đánh răng điện cảm ứng Anriea và kem đánh răng hương cam Anriea
                                    </p>
                                </td>
                                <td class="text-center">
                                    Null
                                </td>
                                <td class="text-center">
                                    <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                                </td>
                                <td class="text-center">
                                  <p class="text-success">
                                    5
                                  </p>
                                </td>
                                <td class="text-center">
                                  <input type="number" max="99999" min="0" value="180.000" class="form-control" data-id="6">
                                </td>
                                <td class="text-center">
                                  <div class="input-group">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">$</button>
                                    <ul class="dropdown-menu" style="">
                                        <li><a class="dropdown-item" href="#">%</a></li>
                                    </ul>
                                    <input type="number" class="form-control" aria-label="Text input with dropdown button">
                                  </div>
                                </td>
                                <td class="text-center">
                                    <p>
                                        240.000
                                    </p>
                                </td>
                                <td class="text-center">
                                    <a class="text-center text-danger" href="#">
                                        <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                              <td class="text-end" colspan="3">
                                <b>Tổng cộng:</b>
                              </td>
                              <td class="text-end">
                                <b>1</b>
                              </td>
                              <td class="text-end">Null</td>
                              <td class="text-end">Null</td>
                              <td class="text-end">
                                <b>0</b>
                              </td>
                              <td class="text-center">
                                <b>240.000</b>
                              </td>
                              <td></td>
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
                          Tiếp thêm phiếu yêu cầu
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <span class="uniform-choice">
                            <span class="">
                              <input value="afterSubmit-1" type="radio" class="form-check-input-styled" name="afterSubmit" data-fouc="" selected="selected">
                            </span>
                          </span>
                          Về trang danh sách phiếu yêu cầu
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

<script>
  $( '#city-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  });

  $( '#district-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  });

  $( '#tag-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  });
</script>

@endsection