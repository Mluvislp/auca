@extends('backend.layout.layout')

@section('title')
Vị trí sản phẩm trong kho
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
      <li class="breadcrumb-item active" aria-current="page">Vị trí sản phẩm trong kho</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
        <div class="card-body p-0 pt-2">

            <!-- Start Filter content -->
            <div class="filter">
              <div class="row mb-3">

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                    <div class="form-group input-group mb-0 pt-3">
                      <div class="col p-0">
                        <select class="form-select" aria-label="select example" name="filter_var_cat_id[]"
                          id="filter_var_cat_id">
                          <option value="hihi">- Doanh nghiệp -</option>
                          <option value="otp1">shangyang132</option>
                          <option value="otp2">shangyang132</option>
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

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="postion_value" maxlength="255" placeholder="Ghi chú" id="postion_value" class="form-control"
                        value="">
                    </div>
                  </div>
                </div>
                
                <div class="col-6 col-md-3 col-lg-2 pr-1">
                    <div class="form-group input-group mb-0 pt-3">
                      <div class="col p-0">
                        <input type="text" name="prd_id" maxlength="255" placeholder="Sản phẩm" id="prd_id" class="form-control"
                          value="">
                      </div>
                    </div>
                </div>

                <div class="col-1 pt-3">
                  <!-- Example split danger button -->
                  <div class="btn-group">
                    <button type="button" name="submit-filter-variant-group" class="btn btn-success">Lọc</button>
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
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhà cung cấp</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="parentId" maxlength="30" id="parentId" class="form-control" value="">
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                    <div class="row form-group input-group fInputHidden">
                      <label class="col-form-label text-right col-12 pl-0 pr-0">Trang thái sản phẩm</label>
                      <div class="col-12 pr-0">
                        <select class="form-select" aria-label="select example" name="filter_var_cat_id[]"
                            id="filter_var_cat_id">
                            <option value="hihi">- Trạng thái sản phẩm -</option>
                            <option value="otp1">Mới</option>
                            <option value="otp1">Đang bán</option>
                            <option value="otp1">Ngừng bán</option>
                            <option value="otp2">Hết hàng</option>
                        </select>
                      </div>
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
                      <a class="dropdown-item fs-5" href="{{ route('putInLocation') }}">
                        <i class="icon-lg pb-3px" data-feather="arrow-right"></i>
                        Xếp sản phẩm vào vị trí
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="{{ route('putOutLocation') }}">
                        <i class="icon-lg pb-3px" data-feather="arrow-left"></i>
                        Lấy sản phẩm khỏi vị trí
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
                      <a class="dropdown-item fs-5" onclick="Export()">
                        <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                        Xuất Excel
                      </a>
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

            </div>
            <!-- End filter content -->

            <div class="table-responsive overflow-hidden">
              <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row">
                  <div class="col-sm-12 table-responsive">
                    <table id="dataPosition" class="table dataTable no-footer table-bordered"
                      aria-describedby="dataPosition_info">
                      <thead class="table-light">
                        <tr>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataPosition"
                            rowspan="1" colspan="1">
                            STT
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataPosition"
                            rowspan="1" colspan="1">
                            Mã sản phẩm
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataPosition"
                            rowspan="1" colspan="1">
                            Mã vạch
                          </th>
                          <th class="sorting text-center text-black sorting_asc" tabindex="0"
                            aria-controls="dataPosition" rowspan="1" colspan="1" aria-sort="ascending">
                            Tên sản phẩm
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataPosition"
                            rowspan="1" colspan="1">
                            SL tồng tại vị trí
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataPosition"
                          rowspan="1" colspan="1">
                            SL tồn thực
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataPosition"
                            rowspan="1" colspan="1">
                            Mã vị trí
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataPosition"
                            rowspan="1" colspan="1">
                            Notes
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataPosition"
                          rowspan="1" colspan="1">
                          Vị trí
                        </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataPosition"
                            rowspan="1" colspan="1">
                            <i class="icon-lg text-black pb-3px" data-feather="settings"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center">1</td>
                          <td class="text-center">
                            <b>12345667823</b>
                          </td>
                          <td class="text-center">
                            <p>Null</p>
                          </td>
                          <td class="text-center">
                            <p>kem đánh răng giành cho con lợn</p>
                          </td>
                          <td class="text-center">
                            <a href="#">
                              0
                            </a>
                          </td>
                          <td class="text-center">
                            <a href="#">
                              0
                            </a>
                          </td>
                          <td class="text-center">123ah</td>
                          <td class="text-center">
                            <p class="text-center">Null</p>
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

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-content-block" style="display: block">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Xác nhận xoá</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  Bạn có chắc muốn xoá ?
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                  <button type="button" id="modal-confirm-confirmed" class="btn btn-danger">Xoá</button>
              </div>
          </div>
          <div class="modal-loading-block" style="display: none">
              <div class="modal-body">
                  <div class="d-flex justify-content-center">
                      <div class="spinner-border" role="status">
                          <span class="sr-only">Loading...</span>
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
  console.log('hahahaha')
      var token = localStorage.getItem("Token");
      var Exceldata = null
      var selectedValue = ''
      $('#status').on('change', function() {
          selectedValue = $(this).val();
      });
      var dataTableConfig = {
          serverSide: true,
          scrollX: true,
          scrollY: "500px",
          autoHeight: false,
          ajax: {
              url: '{{ route('product-position.getAll') }}',
              type: 'GET',
              beforeSend: function(xhr) {
                  xhr.setRequestHeader("Authorization", "Bearer " + token);
              },
              data: function(data) {
                  var statusSearch = ''
                  if (selectedValue !== '') {
                      statusSearch = selectedValue
                  }

                  data.page = (data.start / data.length) + 1;
                  data.per_page = data.length;
                  data.search = data.search.value;
                  // data.status = data.search.value
                  // data.columns[0].searchable = true;
                  // data.columns[0].search.value = $('input[name="bp_id"]').val();
                  // data.columns[1].searchable = true;
                  // data.columns[1].search.value = $('input[name="bp_name"]').val();
                  // data.columns[2].searchable = true;
                  // data.columns[2].search.value = selectedValue;
                  // data.columns[4].searchable = true;
                  data.columns[3].search.value = $('input[name="prd_id"]').val();
                  data.columns[3].searchable = true;
                  data.columns[6].search.value = $('input[name="postion_value"]').val();
                  data.columns[6].searchable = true;
              },
              dataSrc: function(response) {
                  response.recordsTotal = response.data.total;
                  response.recordsFiltered = response.data.total;
                  Exceldata = response.data.data

                  return response.data.data;
              },
              error: function(xhr) {
                  if (xhr.status === 404) {
                      $('#brandData').html(
                          '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
                      );
                  }
              }
          },
          columns: [

              {
                  data: 'id',
                  name: 'id',
                  searchable: true
              },
              {
                  data: 'prd_code',
                  name: 'prd_code',
                  searchable: true
              },
              {
                  data: 'prd_code',
                  name: 'prd_code',
              },
              {
                  data: 'prd_name',
                  name: 'prd_name',
                  searchable: true
              },
              {
                  data: 'quantity',
                  name: 'quantity',
                  searchable: true
              },
              {
                  data: 'quantity',
                  name: 'quantity',
                  searchable: true
              },
              {
                  data: 'id',
                  name: 'id',
                  searchable: true
              },
              {
                  data: 'position_value',
                  name: 'position_value',
                  searchable: true
              },
              {
                  data: 'cate_positon',
                  name: 'cate_positon',
                  searchable: true
              },
              {
                  data: 'id',
                  name: 'id',
                  render: function(data) {
                      return `
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
                              <a class="dropdown-item fs-5 text-danger" onclick="deleteDATA(${data})" >
                                <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                                Xóa
                              </a>
                            </li>
                          </ul>
        `
                  }
              },

          ],
          searching: false,
          lengthMenu: [
              [10, 25, 50, -1],
              [10, 25, 50, 'All']
          ],
          pageLength: 10
      }


      $('button[name=submit-filter-variant-group]').click(function() {
          console.log($('input[name="postion_value"]').val())
          var dataTable = $('#dataPosition').DataTable();
          dataTable.column(3).search('input[name="prd_id"]"]').draw();
          dataTable.column(6).search('input[name="postion_value"]"]').draw();

      });
      function deleteDATA(id) {
            console.log(id)
            $('#confirmModal').modal('show');
            $('#modal-confirm-confirmed').off('click').on('click', function() {
                $.ajax({
                    url: "{{ route('product-position.delete', ['id' => ':id']) }}".replace(':id', id),
                    type: 'DELETE',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        $('#confirmModal').modal('hide');
                        toastr.success('Xử lý thành công', 'Thông báo');
                        dataTable.destroy();
                        dataTable = $('#dataPosition').DataTable(dataTableConfig);

                    },
                    error: function(xhr, status, error) {
                        $('#confirmModal').modal('hide');
                        var errorMessage = xhr.responseJSON.message ||
                            'lỗi xảy ra hãy thử relaod lại trang'
                        toastr.error(errorMessage, 'Lỗi');

                    }
                });
            });
        }
      function Export() {
            // Tạo dữ liệu Excel

            var data = Exceldata.map(obj => Object.values(obj));
            console.log()
            // Tạo workbook mới
            var workbook = XLSX.utils.book_new();
            var sheetData = XLSX.utils.aoa_to_sheet([
                ['STT', 'MÃ SẢN PHẨM', 'MÃ VẠCH', 'TÊN SẢN PHẨM', 'SL TỒN TẠI', 'SL TỒN THỰC', 'MÃ VỊ TRÍ','VỊ TRÍ'], ...data
            ]);
            XLSX.utils.book_append_sheet(workbook, sheetData, 'Sheet1');

            // Xuất file Excel
            var wbout = XLSX.write(workbook, {
                bookType: 'xlsx',
                type: 'array'
            });
            const currentDate = new Date();
            saveAs(new Blob([wbout], {
                type: 'application/octet-stream'
            }), 'data_brand' + currentDate + '.xlsx');
        }
      var dataTable = $('#dataPosition').DataTable(dataTableConfig);
  </script>
<script>
  var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
</script>
<script src="{{ asset('assets/backend/js/xlsx-custom.js') }}"></script>
<script src="{{ asset('assets/backend/js/FileSaver.min.js') }}"></script>
@endsection