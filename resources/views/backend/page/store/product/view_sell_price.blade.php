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
      <li class="breadcrumb-item active" aria-current="page">Quản lý sản phẩm</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
      <li class="nav-item">
            <a class="nav-link" href="{{'product'}}">Danh sách sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="">Có sửa giá bán</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{'product-import-price'}}">Có sửa giá nhập</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{'product-edit-history'}}">Lịch sử nhập xóa</a>
        </li>
      </ul>
      <div class="tab-content mt-4" id="lineTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
          <div class="card-body p-0 pt-2">
            <!-- Start Filter content -->
            <div class="filter">
              <div class="row mb-3">
                <div class="col-6 col-md-5 col-lg-4 col-xl-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="p-0">
                      <div class="row g-0 m-0 input-group">
                        <div class="col">
                          <div class="input-group flatpickr" id="flatpickr-date">
                            <input type="text" name="filter_created_from" id="filter_created_from" class="form-control flatpickr-input" placeholder="Từ ngày"
                              data-input="" readonly="readonly">
                          </div>
                        </div>
                        <div class="col">
                          <div class="input-group flatpickr" id="flatpickr-date">
                            <input type="text" name="filter_created_to" id="filter_created_to" class="form-control flatpickr-input" placeholder="Đến ngày"
                              data-input="" readonly="readonly">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="name" maxlength="100" placeholder="Sản phẩm" id="name"
                        class="form-control" value="">
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select name="gpid" class="form-select px-1" id="gpid">
                        <option value="">- Cha con -</option>
                        <option value="-2">Sản phẩm cha</option>
                        <option value="-1">Sản phẩm độc lập</option>
                        <option value="1">Sản phẩm con</option>
                        <option value="2">Sản phẩm cha + độc lập</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="createdName" maxlength="100" placeholder="Người sửa" id="createdName"
                        class="form-control" value="">
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
            </div>
            <!-- End filter content -->
            <div class="table-responsive overflow-hidden">
              <div id="dataTableProduct2Hero_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row">
                  <div class="col-sm-12 table-responsive">
                    <table id="dataTableProduct2Hero" class="table dataTable no-footer table-bordered"
                      aria-describedby="dataTableProduct2Hero_info">
                      <thead class="table-light">
                        <tr>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct2Hero"
                            rowspan="1" colspan="1">
                            Mã sản phẩm
                          </th>
                          <th class="sorting text-black text-center sorting_asc" tabindex="0"
                            aria-controls="dataTableProduct2Hero" rowspan="1" colspan="1" aria-sort="ascending">
                            Tên sản phẩm
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct2Hero"
                            rowspan="1" colspan="1">
                            Giá bán cũ
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct2Hero"
                            rowspan="1" colspan="1">
                            Giá bán mới
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct2Hero"
                            rowspan="1" colspan="1">
                            Người sửa
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableProduct2Hero"
                            rowspan="1" colspan="1">
                            Thời gian
                          </th>
                        </tr>
                      </thead>
                      <tbody>
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
{{--model1--}}
<div class="modal fade modal-lg" id="uploadImgModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Ảnh sản phẩm
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex align-items-center justify-content-between gap-3">
        <div>
          <input class="form-control btn btn-success" type="file" id="formFile">
        </div>
        <div>
          <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top"
            title="Để thay đổi thứ tự hiển thị ảnh trên website: Kéo thả ảnh và bấm nút Cập nhật vị trí">
            <i class="icon-lg text-black pb-3px" data-feather="help-circle"></i>
          </span>
          <button type="button" class="btn btn-primary" style="margin-left: 8px">
            <i class="icon-lg text-white pb-3px" data-feather="save"></i>
            Cập nhật vị trí
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
{{--model2--}}
<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Sửa trạng thái
        </h5>
      </div>
      <div class="modal-body d-flex align-items-center justify-content-between gap-3">
        <span>
          Trạng thái bán:
        </span>
        <select class="form-select">
          <option selected>Mới</option>
          <option value="1">Đang bán</option>
          <option value="2">Ngừng bán</option>
          <option value="3">Hết hàng</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Cập nhật</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
@endsection @section('script')
<script>
$(document).ready(function () {
  var token = localStorage.getItem("Token");
  $('button[name=submit-filter]').click(function () {
    var dataTable = $('#dataTableProduct2Hero').DataTable();
    dataTable.ajax.reload();
  });
  $('#dataTableProduct2Hero').DataTable({
    serverSide: true,
    scrollX: true,
    scrollY: "600px",
    autoHeight: false,
    fixedHeader: true,
    ajax: {
      url: '{{ route('logproduct.all') }}',
      type: 'GET', 
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      data: function (data) {
        data.log_type = 1
        data.page = (data.start / data.length) + 1
        data.per_page = data.length;
        data.search = data.search.value;
        data.filter_created_from = $('input[name="filter_created_from"]').val();
        data.filter_created_to = $('input[name="filter_created_to"]').val();
        data.log_prd_name = $('input[name="log_prd_name"]').val();
        data.filter_user_id = $('select[name="filter_user_id"]').val();

      },
      dataSrc: function (response) {
        response.recordsTotal = response.data.total;
        response.recordsFiltered = response.data.total;
        return response.data.data;
      },
      error: function (xhr) {
        if (xhr.status === 404) {
          $('#dataTableProduct2Hero').html(
            '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
          );
        }
      }
    },
    columns: [
      {
        data: 'log_prd_code',
        name: 'log_prd_code',
        searchable: true
      },
      {
        data: 'log_prd_name',
        name: 'log_prd_name',
        searchable: true
      },
      {
        data: 'log_prd_old_value',
        name: 'log_prd_old_value',
        render: function(data, type, row) {
          if (type === 'display' || type === 'filter') {
            const parsedObjectValue = JSON.parse(data).pd_import_price
            return parsedObjectValue
          }
          return data; // Return raw data for sorting and other purposes
        },
        searchable: true
      },
      {
        data: 'log_prd_new_value',
        name: 'log_prd_new_value',
        render: function(data, type, row) {
          if (type === 'display' || type === 'filter') {
            const parsedObjectValue = JSON.parse(data).pd_import_price
            return parsedObjectValue
          }
          return data; // Return raw data for sorting and other purposes
        },
        searchable: true
      },
      {
        data: 'user_id',
        name: 'user_id',
      },
      {
        data: 'created_at',
        name: 'created_at',
        render: function(data, type, row) {
          if (type === 'display' || type === 'filter') {
            var unixTimestamp = data; // Assuming data is the Unix timestamp
            var date = new Date(unixTimestamp * 1000); // Convert to milliseconds
            var formattedDate = date.toLocaleString(); // Adjust to your preferred format
            return formattedDate;
          }
          return data; // Return raw data for sorting and other purposes
        }
      },
    ],
    searching: false,
    language: {
      search: "",
      sProcessing: "Đang xử lý...",
      sLengthMenu: "_MENU_",
      sZeroRecords: "Không tìm thấy kết quả",
      sEmptyTable: "Không tìm thấy kết quả",
      sInfo: "Hiển thị _START_ cho đến _END_ trong tổng số _TOTAL_",
      sInfoEmpty: "Hiển thị 0 cho đến 0 trong tổng số 0",
      sInfoFiltered: "(Được lọc từ _MAX_)",
      sInfoPostFix: "",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Đang tải...",
      oPaginate: {
        "sFirst": "<<",
        "sLast": ">>",
        "sNext": ">",
        "sPrevious": "<"
      },
      "oAria": {
        "sSortAscending": ": Sắp xếp cột theo thứ tự tăng dần",
        "sSortDescending": ": Sắp xếp cột theo thứ tự giảm dần"
      }
    },
    lengthMenu: [
      [10, 25, 50],
      [10, 25, 50]
    ],
    pageLength: 10,
  });
});
</script>

<script>
    $( '#gpid' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
  } );
</script>

@endsection
