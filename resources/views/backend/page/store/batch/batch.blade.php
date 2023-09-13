@extends('backend.layout.layout')

@section('title')
    Lô sản phẩm
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
                <li class="breadcrumb-item active" aria-current="page">Lô sản phẩm</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Lô sản phẩm</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">
                            <!-- Start Filter content -->
                            <div class="filter">
                                <div class="row mb-3">
                                    <div class="col-6 col-md-3 col-lg-1 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="bp_id" maxlength="255" placeholder="ID"
                                                    id="bp_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">- Chọn trạng thái - </option>
                                                    <option value="1">Hiện</option>
                                                    <option value="2">Ẩn</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="bp_name" maxlength="255"
                                                    placeholder="Tên lô hàng" id="bp_name" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                                        <div class="form-group input-group mb-0 pt-3">
                                            <div class="col p-0">
                                                <input type="text" name="productStoreName" maxlength="255"
                                                    placeholder="Sản phẩm" id="productStoreName" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 pt-3">
                                        <!-- Example split danger button -->
                                        <div class="btn-group">
                                            <button type="button" name="submit-filter-variant-group"
                                                class="btn btn-success">Lọc</button>
                                            <button type="button"
                                                class="btn btn-success dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="collapse" data-bs-target="#filter-advanced-elements"
                                                aria-expanded="false" aria-controls="filter-advanced-elements">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse row m-0 col-12 pl-0 pr-0 pb-3 mt-3 mb-3" id="filter-advanced-elements">
                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-12 pl-0 pr-0">Ngày sản xuất</label>
                                            <div class="col-12 pr-0">
                                                <div class="row m-0 input-group">
                                                    <input type="date" name="fromDate" id="fromDate" placeholder="Từ"
                                                        class="form-control tbDatePicker col-6" maxlength="10"
                                                        autocomplete="off" id="fromDate" value="">
                                                    <input type="date" name="toDate" id="toDate" to
                                                        placeholder="Đến"
                                                        class=" form-control tbDatePicker col-6 form-control"
                                                        maxlength="10" autocomplete="off" id="toDate" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-12 pl-0 pr-0">Ngày hết hạn</label>
                                            <div class="col-12 pr-0">
                                                <div class="row m-0 input-group">
                                                    <input type="date" name="fromExpired" placeholder="Từ"
                                                        class="form-control tbDatePicker col-6" maxlength="10"
                                                        autocomplete="off" id="fromDate" value="">
                                                    <input type="date" name="toExpired" placeholder="Đến"
                                                        class=" form-control tbDatePicker col-6 form-control"
                                                        maxlength="10" autocomplete="off" id="toDate" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3 pr-0">
                                        <div class="row form-group input-group fInputHidden">
                                            <label class="col-form-label text-right col-12 pl-0 pr-0">Số ngày còn
                                                hạn</label>
                                            <div class="col-12 pr-0">
                                                <div class="row m-0 input-group">
                                                    <input type="number" name="fromDueDate" placeholder="Từ"
                                                        maxlength="50" class="form-control form-control col-6"
                                                        inputmode="decimal" id="fromDueDate" value="">
                                                    <input type="number" name="toDueDate" placeholder="Đến"
                                                        maxlength="50" id="toDueDate"
                                                        class=" form-control form-control col-6" inputmode="decimal"
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 d-flex align-items-center gap-2">
                                <div>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Thêm mới
                                        <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item fs-5" href="{{ route('add_batch') }}">
                                                <i class="icon-lg pb-3px" data-feather="plus"></i>
                                                Thêm lô sản phẩm
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item fs-5" href="{{ route('import_batch') }}">
                                                <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                                                Nhập từ Excel
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown"
                                        aria-expanded="false">
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
                                            <a class="dropdown-item fs-5" href="#">
                                                <i class="icon-lg pb-3px" data-feather="repeat"></i>
                                                Đổi trạng thái
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
                            <!-- End filter content -->
                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="dataBatch" class="table dataTable no-footer table-bordered"
                                                aria-describedby="dataBatch_info">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataBatch" rowspan="1" colspan="1">
                                                            ID
                                                        </th>
                                                        {{-- <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Số lô
                          </th> --}}
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataBatch" rowspan="1" colspan="1">
                                                            Tên lô
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataBatch" rowspan="1" colspan="1">
                                                            Trạng thái
                                                        </th>
                                                        <th class="sorting text-black text-center sorting_asc"
                                                            tabindex="0" aria-controls="dataBatch" rowspan="1"
                                                            colspan="1" aria-sort="ascending">
                                                            Giá nhập
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataBatch" rowspan="1" colspan="1">
                                                            Ngày sản xuất
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataBatch" rowspan="1" colspan="1">
                                                            Ngày hết hạn
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataBatch" rowspan="1" colspan="1">
                                                            Số ngày còn hạn
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataBatch" rowspan="1" colspan="1">
                                                            Sản phẩm
                                                        </th>
                                                        <th class="text-center" scope="col">
                                                            <i class="icon-lg pb-3px" data-feather="settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- <tr>
                          <td class="text-center">1</td>
                          <td class="text-center">162,700</td>
                          <td class="text-center">2,700</td>
                          <td class="text-center">700</td>
                          <td class="text-center">700</td>
                          <td class="text-center">700</td>
                          <td class="text-center">700</td>
                          <td class="text-center">
                            <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                              aria-expanded="false">
                              <i class="icon-lg pb-3px" data-feather="menu"></i>
                            </span>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item fs-5" href="{{ route('edit_batch') }}">
                                  <i class="icon-lg pb-3px" data-feather="edit"></i>
                                  Sửa
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
                        </tr> --}}
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
    @endsection @section('script')
    <script type="text/javascript">
        var token = localStorage.getItem("Token");
        var Exceldata = null
        var selectedValue = ''
        var toDate = $('input[name="fromDate"]').val();
        $('#status').on('change', function() {
            selectedValue = $(this).val();
        });
        var dataTableConfig = {
            serverSide: true,
            scrollX: true,
            scrollY: "800px",
            autoHeight: false,
            ajax: {
                url: '{{ route('batch_product.all') }}',
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                data: function(data) {
                    var statusSearch = ''
                    if (selectedValue !== '') {
                        statusSearch = selectedValue
                    }
                    console.log($('input[name="fromDate"]').val())
                    data.page = (data.start / data.length) + 1;
                    data.per_page = data.length;
                    data.search = data.search.value;
                    data.status = data.search.value
                    data.columns[0].searchable = true;
                    data.columns[0].search.value = $('input[name="bp_id"]').val();
                    data.columns[1].searchable = true;
                    data.columns[1].search.value = $('input[name="bp_name"]').val();
                    data.columns[2].searchable = true;
                    data.columns[2].search.value = selectedValue;
                    data.columns[4].searchable = true;
                    data.columns[4].search.value = $('input[name="fromDate"]').val();
                    data.columns[4].search.value2 = $('input[name="toDate"]').val();
                    data.columns[5].search.value = $('input[name="fromExpired"]').val();
                    data.columns[5].search.value2 = $('input[name="toExpired"]').val();
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
                    data: 'bp_id',
                    name: 'bp_id',
                    searchable: true
                },
                {
                    data: 'bp_name',
                    name: 'bp_name',
                    searchable: true
                },
                {
                    data: 'status_data',
                    name: 'bp_status',
                    render: function(data) {
                        if (data['status'] == 1) {
                            return '<input class="form-check-input" type="checkbox" onchange="changeSelect(' +
                                data['id'] + ')" id="flexSwitchCheckDefault" checked>'
                        } else if (data['status'] == 2) {
                            return '<input class="form-check-input" type="checkbox" onchange="changeSelect(' +
                                data['id'] + ')" id="flexSwitchCheckDefault">'
                        }
                    }
                },
                {
                    data: 'bp_price',
                    name: 'bp_price',
                },
                {
                    data: 'bp_manufacture_date',
                    name: 'bp_manufacture_date',
                    searchable: true
                },
                {
                    data: 'bp_expired_date',
                    name: 'bp_expired_date',
                    searchable: true
                },
                {
                    data: 'date_left',
                    name: 'date_left',
                    searchable: true
                },
                {
                    data: 'prd_name',
                    name: 'prd_name',
                    searchable: true
                },
                {
                    data: 'bp_id',
                    name: 'bp_id',
                    render: function(data) {
                        return `
                        <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                              aria-expanded="false">
                              <i class="icon-lg pb-3px" data-feather="menu"></i>
                            </span>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item fs-5" href="./batch-edit/${data}">
                                  <i class="icon-lg pb-3px" data-feather="edit"></i>
                                  Sửa
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item fs-5 text-danger" onclick="deleteDATA(${data})">
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

        function changeSelect(id) {
            $(document).ready(function() {
                $.ajax({
                    url: "{{ route('batch_product.status_update', ['id' => ':id']) }}".replace(':id', id),
                    type: 'POST',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        // Xử lý thành công
                        // console.log(response)
                        // dataTable.destroy();
                        // dataTable = $('#brandData').DataTable(dataTableConfig);
                        toastr.success('Xử lý thành công', 'Thông báo');
                    },
                    error: function(xhr, status, error) {
                        var statusCode = xhr.status;
                        switch (statusCode) {
                            case 401:
                                toastr.error('phiên đăng nhập đã hết hạn xin hãy đăng nhập và thử lại',
                                    'Lỗi');
                                break;
                            case 403:
                                toastr.error('Bạn không có quyền thực hiện việc này', 'Lỗi');
                                break;
                            default:
                                toastr.error('Đã có lỗi xảy ra hãy reload trang và thử lại', 'Lỗi');
                        }
                    }
                });
            })
        }

        function deleteDATA(id) {
            console.log(id)
            $('#confirmModal').modal('show');
            $('#modal-confirm-confirmed').off('click').on('click', function() {
                $.ajax({
                    url: "{{ route('batch_product.del', ['id' => ':id']) }}".replace(':id', id),
                    type: 'DELETE',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        $('#confirmModal').modal('hide');
                        toastr.success('Xử lý thành công', 'Thông báo');
                        dataTable.destroy();
                        dataTable = $('#dataBatch').DataTable(dataTableConfig);

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

        $('button[name=submit-filter-variant-group]').click(function() {
            console.log(toDate)
            console.log($('input[name="bp_id"]').val())
            var dataTable = $('#dataBatch').DataTable();
            dataTable.column(0).search($('input[name="bp_id"]').val()).draw();
            dataTable.column(1).search($('input[name="bp_name"]').val()).draw();
            dataTable.column(2).search(selectedValue).draw();
            dataTable.column(4).search('input[name="toDate"]').draw();
            dataTable.column(5).search('input[name="fromExpired"]').draw();
        });
        var dataTable = $('#dataBatch').DataTable(dataTableConfig);


        function Export() {
            // Tạo dữ liệu Excel

            var data = Exceldata.map(obj => Object.values(obj));
            console.log()
            // Tạo workbook mới
            var workbook = XLSX.utils.book_new();
            var sheetData = XLSX.utils.aoa_to_sheet([
                ['id', 'mã lô', 'giá', 'trạng thái', 'ngày sản xuất', 'ngày hết hạn', 'số ngày còn hạn'], ...data
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
    </script>
    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>

    <script src="{{ asset('assets/backend/js/xlsx-custom.js') }}"></script>
    <script src="{{ asset('assets/backend/js/FileSaver.min.js') }}"></script>
@endsection
