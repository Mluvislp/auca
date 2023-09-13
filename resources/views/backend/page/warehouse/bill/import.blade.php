@extends('backend.layout.layout')

@section('title')
Nhập kho
@endsection

@section('content')
<div class="page-content">

  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
      <li class="breadcrumb-item"><a href="{{ route('bill') }}">Xuất nhập kho</a></li>
      <li class="breadcrumb-item active" aria-current="page">Phiếu nhập kho</li>
    </ol>
  </nav>

  <div>
    <form>
      @csrf
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">Thông tin</h6>
              <form class="forms-sample">

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Kho hàng<span class="text-danger">*</span></label>
                    <div class="col-7 col-lg-10">
                      <select name="w_id" id="w_id" class="form-select mb-3" data-placeholder="Chọn một cửa hàng">
                        <option selected="">- Cửa hàng -</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Loại nhập hàng<span class="text-danger">*</span></label>
                    <div class="col-7 col-lg-10">
                      <select name="wb_mode" id="wb_mode" class="form-select mb-3">
                        <option selected="1">- Nhà cung cấp -</option>
                        <option value="2">Khác</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Khách hàng</label>
                    <div class="col-7 col-lg-10">
                      <input type="text" name="wb_customer_name" id="wb_customer_name" maxlength="255" class="required form-control"
                        autofocus="autofocus"  autocomplete="off" value="">
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Số điện thoại</label>
                    <div class="col-7 col-lg-10">
                      <input type="text" name="wb_customer_tel" id="wb_customer_tel" maxlength="255" class="required form-control"
                        autofocus="autofocus"  autocomplete="off" value="">
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Nhà cung cấp</label>
                    <div class="col-7 col-lg-10 d-flex align-items-center">
                      <div class="input-group">
                        <select name="sup_id" id="sup_id" class="form-select" data-placeholder="Chọn nhà cung cấp">
                          <option value="">- Nhà cung cấp -</option>
                        </select>
                      </div>
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <a href="<?= Route('suppliers.create') ?>">
                            <i class="icon-lg pb-3px text-success" data-feather="plus"></i>
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Ghi chú</label>
                    <div class="col-7 col-lg-10">
                      <textarea class="form-control" name="sup_note" cols="30" rows="5"
                        placeholder="Vui lòng nhập"></textarea>
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
                  <label class="col-5 col-lg-2 col-form-label">VAT</label>
                  <div class="col-7 col-lg-10">
                    <div class="input-group">
                      <button class="btn btn-outline-secondary" type="button">
                        <select name="wb_vat_type" style="width: 60px;" class="form-control p-1 text-center form-control"
                          id="wb_vat_type">
                          <option value="Money">$</option>
                          <option value="Percent">%</option>
                        </select>
                      </button>
                      <input type="number" name="wb_vat_value" id="wb_vat_value" class="form-control" aria-label="Text input with dropdown button">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group mb-2">
                <div class="row">
                  <label class="col-5 col-lg-2 col-form-label">Số hóa đơn VAT</label>
                  <div class="col-7 col-lg-10">
                    <input type="text" name="wb_tax_bill_code" id="wb_tax_bill_code" maxlength="255" class="required form-control"
                      autofocus="autofocus" autocomplete="off" value="">
                  </div>
                </div>
              </div>

              <div class="form-group mb-2">
                <div class="row">
                  <label class="col-5 col-lg-2 col-form-label">Ngày xuất VAT</label>
                  <div class="col-7 col-lg-10">
                    <div class="input-group flatpickr" id="flatpickr-date">
                      <input type="text" name="wb_tax_bill_date" id="wb_tax_bill_date" class="form-control flatpickr-input" data-input="" readonly="readonly">
                      <span class="input-group-text input-group-addon" data-toggle="">
                        <i class="icon-lg pb-3px" data-feather="calendar"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2 mt-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Chiết khấu (F6)</label>
                    <div class="col-7 col-lg-10">
                      <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button">
                          <select name="wb_manual_discount_type" style="width: 60px;" class="form-control p-1 text-center form-control"
                            id="wb_manual_discount_type">
                            <option value="Money">$</option>
                            <option value="Percent">%</option>
                          </select>
                        </button>
                        <input type="number" name="wb_manual_discount" id="wb_manual_discount" class="form-control" aria-label="Text input with dropdown button">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Tiền mặt (F8)</label>
                    <div class="col-7 col-lg-10">
                      <input type="number" name="wb_money" id="wb_money" maxlength="255" class="required form-control"
                        autofocus="autofocus"  autocomplete="off" value="">
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Tài khoản</label>
                    <div class="col-7 col-lg-10">
                      <select class="form-select mb-3">
                        <option selected="">- Tài khoản trả tiền -</option>
                        <option value="1">1111.1 (tiền mua ccdc)</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Chuyển khoản</label>
                    <div class="col-7 col-lg-10">
                      <input type="number" name="prd_name" maxlength="255" class="required form-control"
                        autofocus="autofocus" id="prd_name" autocomplete="off" value="">
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Tài khoản</label>
                    <div class="col-7 col-lg-10">
                      <select class="form-select mb-3">
                        <option selected="">- Tài khoản ngân hàng -</option>
                        <option value="1">1111.1 (Vietcombank)</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-2">
                  <div class="row">
                    <label class="col-5 col-lg-2 col-form-label">Ngày hẹn thanh toán</label>
                    <div class="col-7 col-lg-10">
                      <div class="input-group flatpickr" id="flatpickr-date">
                        <input type="text" class="form-control flatpickr-input" data-input="" readonly="readonly">
                        <span class="input-group-text input-group-addon" data-toggle="">
                          <i class="icon-lg pb-3px" data-feather="calendar"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="mt-3">
                    <div class="form-check form-switch mb-2">
                      <input type="checkbox" class="form-check-input" id="formSwitch1">
                      <label class="form-check-label" for="formSwitch1">Cập nhật giá nhập của sản phẩm theo giá trong
                        lần nhập này.</label>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>
    </form>
  </div>

  <div>
    <div class="card p-3">
      <div class="card-body p-0 pt-2">
        <div class="input-group mb-3">
          <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">Sản phẩm</button>
          <ul class="dropdown-menu" style="">
            <li><a class="dropdown-item" href="#">Nhập theo ri</a></li>
          </ul>
          <input type="text" class="form-control" aria-label="Text input with dropdown button">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <a href="#">
                <i class="icon-lg pb-3px text-success" data-feather="plus"></i>
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
                      <th class="sorting sorting_asc pb-4" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                        colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                      <th class="sorting pb-4" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Position: activate to sort column ascending">Sản phẩm</th>
                      <th class="sorting pb-4" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Office: activate to sort column ascending">ĐVT</th>
                      <th class="sorting pb-4" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Position: activate to sort column ascending">Tồn</th>
                      <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                        rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="Điền số lượng và click mũi tên để thay đổi số lượng cho tất cả các dòng bên dưới">
                        <div class="d-flex">
                          <input type="text" class="form-control w-auto" id="exampleInputUsername1" autocomplete="off"
                            placeholder="SL">
                          <a href="#">
                            <i class="icon-lg pb-3px text-blue my-2" data-feather="arrow-down"></i>
                          </a>
                        </div>
                      </th>
                      <th class="sorting pb-4" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Age: activate to sort column ascending">SL Lỗi</th>
                      <th class="sorting pb-4" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Start date: activate to sort column ascending">IMEI</th>
                      <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                        rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="Điền số lượng và click mũi tên để thay đổi số lượng cho tất cả các dòng bên dưới">
                        <div class="d-flex">
                          <input type="text" class="form-control w-auto" id="exampleInputUsername1" autocomplete="off"
                            placeholder="Giá">
                          <a href="#">
                            <i class="icon-lg pb-3px text-blue my-2" data-feather="arrow-down"></i>
                          </a>
                        </div>
                      </th>
                      <th class="sorting pb-4" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Salary: activate to sort column ascending">Thành tiền</th>
                      <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                        rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="Điền số lượng và click mũi tên để thay đổi số lượng cho tất cả các dòng bên dưới">
                        <div class="input-group d-flex">
                          <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">$</button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">%</a></li>
                          </ul>
                          <input type="number" class="form-control" aria-label="Text input with dropdown button">
                          <a href="#">
                            <i class="icon-lg pb-3px text-danger my-2" data-feather="arrow-down"></i>
                          </a>
                        </div>
                      </th>
                      <th class="sorting text-black text-center pb-4" tabindex="0" aria-controls="dataTableExampleHero"
                        rowspan="1" colspan="1" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="Khối lượng">
                        <i class="icon-lg pb-3px" data-feather="compass"></i>
                      </th>
                      <th class="sorting text-black text-center pb-4" tabindex="0" aria-controls="dataTableExampleHero"
                        rowspan="1" colspan="1">
                        <div>
                          <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <span>A05.A17.TOTE</span><br>
                        <span>2000214247541</span>
                        <p>[Freeship Max] Combo ưu đãi Bàn chải đánh răng điện</p>
                        <div class="mb-2">
                          <input type="text" class="form-control" id="wb_description" autocomplete="off"
                            placeholder="Nhập ghi chú">
                        </div>
                      </td>
                      <td class="text-end">Null</td>
                      <td class="text-end">0</td>
                      <td class="text-end">
                        <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                      </td>
                      <td class="text-end">Null</td>
                      <td class="text-end">Null</td>
                      <td class="text-end">
                        <input type="number" max="99999" min="0" value="0" class="form-control" data-id="6">
                      </td>
                      <td class="text-end">
                        0
                      </td>
                      <td class="text-end">
                        <div class="input-group d-flex">
                          <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">$</button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">%</a></li>
                          </ul>
                          <input type="number" class="form-control" aria-label="Text input with dropdown button">
                        </div>
                      </td>
                      <td class="text-end">
                        <input type="number" max="99999" min="0" value="500" class="form-control" data-id="6">
                      </td>
                      <td class="text-center">
                        <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="icon-lg pb-3px" data-feather="menu"></i>
                        </span>
                        <ul class="dropdown-menu">
                          <li>
                            <a class="dropdown-item fs-6 text-start text-danger" href="#">
                              <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                              Xóa sản phẩm
                            </a>
                          </li>
                        </ul>
                      </td>
                    </tr>

                    <tr class="total">
                      <td class="text-end font-weight-normal" colspan="4">Tổng cộng: </td>
                      <td class="text-end font-weight-normal">1</td>
                      <td class="text-end font-weight-normal">0</td>
                      <td class="text-end font-weight-normal">Null</td>
                      <td class="text-end font-weight-normal">Null</td>
                      <td class="text-end font-weight-normal">0</td>
                      <td class="text-end font-weight-normal">0</td>
                      <td class="text-end font-weight-normal">500</td>
                      <td class="text-end font-weight-normal"></td>
                    </tr>

                    <tr class="sub-total">
                      <td class="text-end font-weight-normal" colspan="8">Cần thanh toán: </td>
                      <td class="text-end font-weight-normal">0</td>
                      <td class="text-end font-weight-normal" colspan="3"></td>
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
                    <input value="afterSubmit-2" type="radio" class="form-check-input-styled" name="afterSubmit"
                      checked="checked" data-fouc="" selected="selected">
                  </span>
                </span>
                Xem chi tiêu phiếu
              </label>
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <span class="uniform-choice">
                  <span class="">
                    <input value="afterSubmit-1" type="radio" class="form-check-input-styled" name="afterSubmit"
                      data-fouc="" selected="selected">
                  </span>
                </span>
                Tiếp tục thêm
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
            <i class="icon-lg pb-3px" data-feather="database"></i>
            <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
          </button>
          <ul class="dropdown-menu p-2">
            <li class="d-flex">
              <b>(Tổng)</b>
              <p> Phiếu nhập kho gần đây</p>
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

  <div class="row pageHelpInfo pt-3 mt-2" style="border-top: 1px solid #ccc;">
    <div class="col-2 text-right pr-3"><i class="fa-regular fs-3 fa-lightbulb"></i><br></div>
    <div class="col-10">
      <p>Chú ý: </p>
      <p>- Nếu có chiết khấu theo sản phẩm và cả hóa đơn, thì áp dụng chiết khấu theo sản phẩm thay vì cả hóa đơn.</p>
      <p>- Nên nhập tối đa khoảng 200 sản phẩm / phiếu.</p>
      <p>- Nếu sản phẩm là loại Sản phẩm theo IMEI, nhập mỗi IMEI trên 1 dòng. Số dòng IMEI phải bằng với cột Số lượng.
      </p>
      <p>- Nếu doanh nghiệp có sử dụng module Kế toán, hệ thống sẽ tự động tạo 1 phiếu chi nếu có chọn "Tài khoản
        trả tiền" và điền "Tiền đã thanh toán nhập hàng cho hóa đơn này".
      </p>
    </div>
  </div>

</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
  var token = localStorage.getItem("Token");

  $('#w_id').select2({
    ajax: {
      url: '{{route('warehouse.all')}}',
      dataType: 'json',
      delay: 250,
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (params) {
        return {
          filter_w_name: params.term,
          page: params.page || 1,
          per_page: 10
        };
      },
      processResults: function (data) {
        var options = [];
        var val = data.data;

        if (val.length === 0) {
          var emptyOption = {
            value: '',
            text: 'Không có kết quả'
          };
          options.push(emptyOption);
        } else {
          val.forEach(function (item) {
            var option = {
              id: item.w_id,
              value: item.w_id,
              text: item.w_name
            };
            options.push(option);
          });
        }

        return {
          results: options,
          pagination: {
            more: (data.data.current_page * 10) < data.data.total
          }
        };
      },
      cache: true
    },
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
  $('#sup_id').select2({
    ajax: {
      url: '{{route('supplier.all')}}',
      dataType: 'json',
      delay: 250,
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (params) {
        return {
          filter_sup_name: params.term,
          page: params.page || 1,
          per_page: 10
        };
      },
      processResults: function (data) {
        var options = [];
        var val = data.data.data;
        if (val.length === 0) {
          var emptyOption = {
            value: '',
            text: 'Không có kết quả'
          };
          options.push(emptyOption);
        } else {
          val.forEach(function (item) {
            var option = {
              id: item.sup_id,
              value: item.sup_id,
              text: item.sup_name
            };
            options.push(option);
          });
        }
        return {
          results: options,
          pagination: {
            more: (data.data.current_page * 10) < data.data.total
          }
        };
      },
      cache: true
    },
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
});
</script>

<script>
  $('#wb_mode').select2({
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
  var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
</script>
@endsection