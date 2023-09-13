@extends('backend.layout.layout')

@section('title')
Sắp chuyển đến
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
      <li class="breadcrumb-item active" aria-current="page">Sắp chuyển đến</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transfer') }}">Chuyển kho</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transfer_note') }}">Phiếu nháp</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transfer_move') }}">Đang chuyển đi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('transfer_to_move') }}">Sắp chuyển đến</a>
        </li>
      </ul>
      <div class="tab-content mt-3" id="lineTabContent">

        {{-- table 4 --}}
        <div class="tab-pane active" id="history" role="tabpanel" aria-labelledby="history-line-tab">
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
                        <option value="">- Từ kho -</option>
                        <option value="">shangyang132</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="multiple select example" name="filter_var_vg_id[]"
                        id="filter_var_vg_id" custom-multiple multiselect-search="true" multiselect-select-all="true"
                        multiselect-max-items="1">
                        <option value="">- Đến kho -</option>
                        <option value="">shangyang132</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
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
                      <input type="text" name="var_id" maxlength="255" placeholder="ID Phiếu XNK" id="var_id"
                        class="form-control" value="">
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
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Người tạo</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Người xác nhận</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="privateId" maxlength="30" id="privateId" class="form-control" value="">
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Sản phẩm</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Trạng thái</label>
                    <div class="col-12 pr-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                        <option value="0">- Trạng thái -</option>
                        <option value="1">Mới</option>
                        <option value="2">Hủy</option>
                        <option value="3">Đã duyệt</option>
                        <option value="4">Đã xác nhận</option>
                      </select>
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Ngày tạo</label>
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

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhãn</label>
                    <div class="col-12 pr-0">
                      <select class="form-control" aria-label="multiple select example" name="filter_var_vg_id[]"
                        id="filter_var_vg_id" multiple="" multiselect-search="true" multiselect-select-all="true"
                        multiselect-max-items="1" style="display: none;">
                        <option value="otp">Đã gắn nhãn</option>
                        <option value="otp">Chưa gắn nhãn</option>
                      </select>
                      <div class="multiselect-dropdown" style="width: 0px;">
                        <div class="multiselect-dropdown-list-wrapper" style="display: none;"><input
                            class="multiselect-dropdown-search form-control" placeholder="Tìm kiếm"
                            style="width: 100%; display: block;">
                          <div class="multiselect-dropdown-list" style="height: 15rem;">
                            <div class="multiselect-dropdown-all-selector">
                              <input type="checkbox"><label>Tất cả</label>
                            </div>
                            <div><input type="checkbox"><label>Đã gắn nhãn</label></div>
                            <div><input type="checkbox"><label>Chưa gắn nhãn</label></div>
                          </div>
                        </div><span class="placeholder">Gắn nhãn</span>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Ghi chú</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>

                </div>

              </div>

              <div class="mb-3 d-flex align-items-center gap-2">
                <div>
                  <a href="{{ route('add_transfer') }}">
                    <button type="button" class="btn btn-success btn-sm">
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
                        <i class="icon-lg pb-3px" data-feather="printer"></i>
                        In các phiếu đã chọn
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="printer"></i>
                        In mã vạch sản phẩm các phiếu đã chọn
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item text-danger fs-5" href="#">
                        <i class="icon-lg text-danger pb-3px" data-feather="trash"></i>
                        Hủy các phiếu đã chọn
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item text-danger fs-5" href="#">
                        <i class="icon-lg text-danger pb-3px" data-feather="trash"></i>
                        Xóa các phiếu đã chọn
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
                    <table id="dataBatch12" class="table dataTable no-footer table-bordered"
                      aria-describedby="dataBatch12_info">
                      <thead class="table-light">
                        <tr>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataBatch12"
                            rowspan="1" colspan="1">
                            ID | Ngày
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataBatch12"
                            rowspan="1" colspan="1">
                            Kho hàng
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataBatch12"
                            rowspan="1" colspan="1">
                            SP
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataBatch12" rowspan="1" colspan="1" aria-sort="ascending">
                            SL
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataBatch12"
                            rowspan="1" colspan="1">
                            Tổng tiền
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataBatch12"
                            rowspan="1" colspan="1">
                            Người tạo
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataBatch12"
                            rowspan="1" colspan="1">
                            Duyệt
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataBatch12"
                            rowspan="1" colspan="1">
                            Xác nhận
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            <i class="icon-md text-black pb-3px" data-feather="message-square" data-bs-toggle="tooltip"
                              data-bs-placement="top" title="Ghi chú"></i>
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
                            <p>
                              08/10/2019
                            </p>
                          </td>
                          <td class="text-start">
                            <p> <span>shangyang132</span> <i class="icon-lg pb-3px" data-feather="arrow-right"></i> <span>shangyang132 1</span> </p>
                            <p class="text-danger">Xuất chuyển kho</p>
                          </td>
                          <td class="text-center">4</td>
                          <td class="text-center">70</td>
                          <td class="text-center">1.700.000</td>
                          <td class="text-center">
                            <p>123</p>
                            <p><span>2:03</span><span>19/07/2023</span></p>
                          </td>
                          <td class="text-center">
                            <a class="text-success" href="#">123</a>
                            <p><span>2:03</span><span>19/07/2023</span></p>
                          </td>
                          <td class="text-center">
                            <a class="text-success" href="#">123</a>
                            <p><span>2:03</span><span>19/07/2023</span></p>
                          </td>
                          <td class="text-start">
                            <p>
                              xuất ký gửi hồng viễn tháng 9 
                            </p>
                          </td>
                          <td class="text-center">
                            <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                              aria-expanded="false">
                              <i class="icon-lg pb-3px" data-feather="menu"></i>
                            </span>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item fs-5" href="#">
                                  <i class="icon-lg pb-3px" data-feather="map-pin"></i>
                                  Đổi kho nhận hàng
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-5" href="#">
                                  <i class="icon-lg pb-3px" data-feather="printer"></i>
                                  In phiếu
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-5" href="#">
                                  <i class="icon-lg pb-3px" data-feather="printer"></i>
                                  In mã vạch
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-5" href="#">
                                  <i class="icon-lg pb-3px" data-feather="file-text"></i>
                                  Export in mã vạch
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item text-danger fs-5" href="#">
                                  <i class="icon-lg text-danger pb-3px" data-feather="x-circle"></i>
                                  Hủy phiếu
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item text-danger fs-5" href="#">
                                  <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                                  Xóa phiếu
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

<script type="text/javascript">
  var token = localStorage.getItem("Token");
  var Exceldata = null
  var dataTableConfig = {
      serverSide: true,
      scrollX: true,
      scrollY: "800px",
      autoHeight: false,
      ajax: {
          url: '../../api/v1/transfer-ware/list/confirm',
          type: 'GET',
          beforeSend: function(xhr) {
              xhr.setRequestHeader("Authorization", "Bearer " + token);
          },
          data: function(data) {
              var statusSearch = ''
              data.page = (data.start / data.length) + 1;
              data.per_page = data.length;
              data.search = data.search.value;
              data.status = data.search.value
              // data.columns[0].searchable = true;
              // data.columns[0].search.value = $('input[name="bp_id"]').val();
              // data.columns[1].searchable = true;
              // data.columns[1].search.value = $('input[name="bp_name"]').val();
              // data.columns[2].searchable = true;
              // data.columns[2].search.value = selectedValue;
          },
          dataSrc: function(response) {
              response.recordsTotal = response.data.total;
              response.recordsFiltered = response.data.total;
              Exceldata = response.data.data
              return response.data.data;
          },
          error: function(xhr) {
              if (xhr.status === 404) {
                  $('#dataBatch').html(
                      '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
                  );
              }
          }
      },
      columns: [
          {
              data: 'wtrans_id',
              name: 'wtrans_id',
              searchable: true
          },
          {
              data: 'wareHouse',
              name: 'wareHouse',
              render: function(data) {
                  if (data == null) {
                      return ' '
                  } else {
                      return `<p> <span>${data['from']}</span> <i class="icon-lg pb-3px"
                                  data-feather="arrow-right"></i> tới  <span>${data['to']}
                                                              1</span> </p>
                              <p class="text-danger">Xuất chuyển kho</p>`
                  }
              },
              searchable: true
          },
          {
              data: 'productCount',
              name: 'productCount',
              searchable: true
          },
          {
              data: 'productQuantity',
              name: 'productQuantity',
          },
          {
              data: 'productTotal',
              name: 'productTotal',
              searchable: true
          },
          {
              data: 'creator',
              name: 'creator',
              render: function(data) {
                  if (data == null) {
                      return ''
                  } else {
                      return `<p>${data['name']}</p>
                            <p><span>${data['date']}</span></p>`
                  }
              },
              searchable: true
          },
          {
              data: 'acceptor',
              name: 'acceptor',
              render: function(data) {
                  if (data == null) {
                      return ' '
                  } else {
                      return `<p>${data['name']}</p>
                            <p><span>${data['date']}</span></p>`
                  }
              },
              searchable: true
          },
          {
              data: 'confirmer',
              name: 'confirmer',
              render: function(data) {
                  if (data == null) {
                      return ' '
                  } else {
                      return `<p>${data['name']}</p>
                            <p><span>${data['date']}</span></p>`
                  }
              },
              searchable: true
          },
          {
              data: 'wtrans_description',
              name: 'wtrans_description',
              searchable: true,
          },
          {
              data: 'wtrans_id',
              name: 'wtrans_id',
              render: function(data) {
                  return `        <span class="dropdown-toggle cursor-pointer"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="icon-lg pb-3px" data-feather="menu"></i>
                                                        </span>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item fs-5" href="#">
                                                                    <i class="icon-lg pb-3px"
                                                                        data-feather="printer"></i>
                                                                    In phiếu
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item fs-5" href="#">
                                                                    <i class="icon-lg pb-3px"
                                                                        data-feather="printer"></i>
                                                                    In mã vạch
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item fs-5" href="#">
                                                                    <i class="icon-lg pb-3px"
                                                                        data-feather="file-text"></i>
                                                                    Export in mã vạch
                                                                </a>
                                                            </li>
                                                        </ul>`
              },
              searchable: true,
          },

      ],
      searching: false,
      lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, 'All']
      ],
      pageLength: 10
  }

  var dataTable = $('#dataBatch12').DataTable(dataTableConfig);
  </script>

@endsection