@extends('backend.layout.layout')

@section('title')
    Nhà cung cấp
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
                <li class="breadcrumb-item"><a href="/">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nhà cung cấp</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                @include('backend.components.modalconfirm')
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">Nhà cung cấp</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">

                            <!-- Start Filter content -->
                            <div class="row mb-3">
                                <div class="col-6 col-md-3 col-lg-1 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" name="filter_sup_id" maxlength="255" placeholder="ID"
                                                   id="filter_sup_id" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" name="filter_sup_name" maxlength="255"
                                                   placeholder="Tên nhà cung cấp" autofocus="autofocus"
                                                   autocomplete="off"
                                                   id="filter_sup_name" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-5 col-lg-4 col-xl-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="p-0">
                                            <div class="row m-0 input-group">
                                                <input type="date" name="filter_from_date" placeholder="Từ ngày"
                                                       class="form-control tbDatePicker" maxlength="10"
                                                       autocomplete="off" id="filter_from_date" value="">
                                                <input type="date" name="filter_to_date" placeholder="Đến ngày"
                                                       class="form-control tbDatePicker col-6" maxlength="10"
                                                       autocomplete="off" id="filter_to_date" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-1 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" name="filter_sup_tel" maxlength="255"
                                                   placeholder="Điện thoại" id="filter_sup_tel" class="form-control"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" name="filter_user_name" maxlength="255"
                                                   placeholder="Người tạo" autofocus="autofocus" autocomplete="off"
                                                   id="filter_user_name" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-1 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <select class="form-select" aria-label="select example"
                                                    name="filter_sup_type" id="filter_sup_type">
                                                <option value="">- Loại -</option>
                                                <option value="1">Cá nhân</option>
                                                <option value="2">Doanh nghiệp</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <select class="form-select" aria-label="select example"
                                                    name="filter_sup_status" id="filter_sup_status">
                                                <option value="">- Trạng thái -</option>
                                                <option value="1">Đang giao dịch</option>
                                                <option value="2">Ngừng giao dịch</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 pt-3">
                                    <div class="btn-group dropdown">
                                        <button type="submit" name="submit-filter"
                                                class="btn submitFilterBtn btn-success">
                                            Lọc
                                        </button>
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
                                            <a class="dropdown-item fs-5" href="<?= Route('suppliers.create') ?>">
                                                <i class="icon-lg pb-3px" data-feather="plus"></i>
                                                Thêm mới nhà cung cấp
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item fs-5" href="<?= Route('import-supplier') ?>">
                                                <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                                                Nhập từ excel
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
                                            <a class="dropdown-item fs-5" id="exportButton">
                                                <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                                                Xuất excel
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- End filter content -->

                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableSupplier_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="dataTableSupplier"
                                                   class="table dataTable no-footer table-bordered"
                                                   aria-describedby="dataTableVariant_info" style="width: 100%">
                                                <thead class="table-light">
                                                <tr>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableSupplier" rowspan="1" colspan="1">
                                                        Mã
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableSupplier" rowspan="1" colspan="1">
                                                        Tên
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableSupplier" rowspan="1" colspan="1">
                                                        Loại
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableSupplier" rowspan="1" colspan="1">
                                                        Điện thoại
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableSupplier" rowspan="1" colspan="1">
                                                        Người tạo
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableSupplier" rowspan="1"
                                                        colspan="1">
                                                        Trạng thái
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableSupplier" rowspan="1"
                                                        colspan="1">
                                                        <i class="icon-lg text-black pb-3px"
                                                           data-feather="settings"></i>
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
            </form>
        </div>
        @endsection
        @section('script')
            <script src="{{ asset('assets/backend/js/xlsx-custom.js') }}"></script>
            <script src="{{ asset('assets/backend/js/FileSaver.min.js') }}"></script>
            <script>
                var token = localStorage.getItem("Token");
                $(document).ready(function () {
                    $('button[name=submit-filter]').click(function () {
                        var dataTable = $('#dataTableSupplier').DataTable();
                        dataTable.ajax.reload();
                    });
                    $('#dataTableSupplier').DataTable({
                        serverSide: true,
                        scrollX: true,
                        scrollY: "800px",
                        autoHeight: false,
                        ajax: {
                            url: '{{ route('supplier.all') }}',
                            type: 'GET',
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader("Authorization", "Bearer " + token);
                            },
                            data: function (data) {
                                data.page = (data.start / data.length) + 1;
                                data.per_page = data.length;
                                data.search = data.search.value;
                                data.filter_sup_name = $('input[name="filter_sup_name"]').val(),
                                    data.filter_sup_tel = $('input[name="filter_sup_tel"]').val(),
                                    data.filter_sup_id = $('input[name="filter_sup_id"]').val();
                                data.filter_from_date = $('input[name="filter_from_date"]').val();
                                data.filter_to_date = $('input[name="filter_to_date"]').val();
                                data.filter_user_name = $('input[name="filter_user_name"]').val();
                                data.filter_sup_type = $('select[name="filter_sup_type"]').val();
                                data.filter_sup_status = $('select[name="filter_sup_status"]').val();

                            },
                            dataSrc: function (response) {
                                response.recordsTotal = response.data.total;
                                response.recordsFiltered = response.data.total;
                                return response.data.data;
                            },
                            error: function (xhr) {
                                if (xhr.status === 404) {
                                    $('#dataTableSupplier').html(
                                        '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
                                    );
                                }
                            }
                        },
                        columns: [{
                            data: 'sup_code',
                            name: 'sup_code',
                        },
                            {
                                data: 'sup_name',
                                name: 'sup_name',
                            },
                            {
                                data: 'sup_type_name',
                                name: 'sup_type_name',
                            },
                            {
                                data: 'sup_tel',
                                name: 'sup_tel',
                            },
                            {
                                data: 'user_name',
                                name: 'user_name'
                            },
                            {
                                data: 'sup_status_name',
                                name: 'sup_status_name',
                            },
                            {
                                data: 'action',
                                name: 'action',
                                render: function (data, type, row,) {
                                    var id = row.sup_id;
                                    var editUrl = "{{ route('suppliers.edit', ':id') }}".replace(':id', id);
                                    return `<td class="text-center">
                                        <span class="dropdown-toggle cursor-pointer"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </span>
                                        <ul class="dropdown-menu">
                                             <li>
                                                  <a class="dropdown-item fs-5" href="${editUrl}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                    Sửa
                                                </a>
                                               </li>
                                             <li>
                                                 <a class="dropdown-item fs-5 text-danger delete-item" onclick="deleteSupplier(${id})">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                    Xóa
                                                </a>
                                            </li>
                                        </ul>
                                    </td>`;
                                }
                            },
                        ],
                        searching: false,
                        lengthMenu: [
                            [10, 25, 50],
                            [10, 25, 50]
                        ],
                        pageLength: 10,
                    });
                    $('#exportButton').click(function () {
                        var filterData = {
                            filter_sup_name: $('input[name="filter_sup_name"]').val(),
                            filter_sup_tel: $('input[name="filter_sup_tel"]').val(),
                            filter_sup_id: $('input[name="filter_sup_id"]').val(),
                            filter_from_date: $('input[name="filter_from_date"]').val(),
                            filter_to_date: $('input[name="filter_to_date"]').val(),
                            filter_user_name: $('input[name="filter_user_name"]').val(),
                            filter_sup_type: $('select[name="filter_sup_type"]').val(),
                            filter_sup_status: $('select[name="filter_sup_status"]').val()
                        };
                        $.ajax({
                            url: '{{ route('supplier.export') }}',
                            type: 'POST',
                            data: filterData,
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader("Authorization", "Bearer " + token);
                            },
                            success: function (response) {
                                var workbook = XLSX.utils.book_new();
                                var heading = ['ID', 'Mã nhà cung cấp', 'Tên nhà cung cấp', 'Địa chỉ', 'Loại nhà cung cấp', 'Số điện thoại', 'Email', 'Ngân hàng', 'Chi nhánh', 'Số tài khoản', 'Chủ tài khoản', 'Người tạo', 'Trạng thái'];
                                var sheetData = XLSX.utils.aoa_to_sheet([heading, ...response.data]);
                                XLSX.utils.book_append_sheet(workbook, sheetData, 'Sheet1');
                                var wbout = XLSX.write(workbook, {
                                    bookType: 'xlsx',
                                    type: 'array'
                                });
                                var currentDate = new Date().getTime(); 
                                saveAs(new Blob([wbout], {
                                    type: 'application/octet-stream'
                                }), 'supplỉe_' + currentDate + '.xlsx');
                            },
                            error: function (xhr) {
                                console.error(xhr);
                            }
                        });
                    });
                });
                function deleteSupplier(id) {
                    $('#confirmModal').modal('show');
                    $('#modal-confirm-confirmed').off('click').on('click', function () {
                        $.ajax({
                            url: '{{route('supplier.delete')}}',
                            method: 'DELETE',
                            data: {
                                id: id
                            },
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader("Authorization", "Bearer " + token);
                                $('#modal-content-block').hide();
                                $('#modal-loading-block').show();
                            },
                            success: function (response) {
                                toastr.success(response.message, 'Thành công');
                                var dataTable = $('#dataTableSupplier').DataTable();
                                var row = dataTable.row('#row-' + id);
                                row.remove().draw(false);
                                $('#confirmModal').modal('hide');
                            },
                            error: function (error) {
                                if (error.responseJSON && error.responseJSON.message) {
                                    toastr.error(error.responseJSON.message, 'Lỗi');
                                }
                                $('#confirmModal').modal('hide');
                            }
                        });
                    });
                }
            </script>
@endsection
