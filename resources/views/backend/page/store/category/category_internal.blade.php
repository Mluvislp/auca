@extends('backend.layout.layout')

@section('title')
    Danh mục nội bộ
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
                <li class="breadcrumb-item active" aria-current="page">Danh mục nội bộ </li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                @include('backend.components.modalconfirm')
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="{{'category'}}">Danh mục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="">Danh mục nội bộ</a>
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
                                            <input type="text" name="filter_cat_inter_name" maxlength="255"
                                                   placeholder="Tên danh mục"
                                                   id="filter_cat_inter_name" class="form-control" value="">
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
                                            <a class="dropdown-item fs-5"
                                               href="<?= Route('create-category-internal') ?>">
                                                <i class="icon-lg pb-3px" data-feather="plus"></i>
                                                Thêm mới danh mục nội bộ
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item fs-5" href="{{route('import-category-internal')}}">
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
                                <div id="dataTableCategoryInternal_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="dataTableCategoryInternal"
                                                   class="table dataTable no-footer table-bordered"
                                                   aria-describedby="dataTableVariant_info" style="width: 100%">
                                                <thead class="table-light">
                                                <tr>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategoryInternal" rowspan="1" colspan="1">
                                                        Id
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategoryInternal" rowspan="1" colspan="1">
                                                        Tên
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategoryInternal" rowspan="1" colspan="1">
                                                        Mã danh mục
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategoryInternal" rowspan="1" colspan="1">
                                                        Id danh mục cha
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategoryInternal" rowspan="1" colspan="1">
                                                        Tổng số sản phẩm
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategoryInternal" rowspan="1"
                                                        colspan="1">
                                                       Người tạo
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategoryInternal" rowspan="1"
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
                        var dataTable = $('#dataTableCategoryInternal').DataTable();
                        dataTable.ajax.reload();
                    });
                    $('#dataTableCategoryInternal').DataTable({
                        serverSide: true,
                        scrollX: true,
                        scrollY: "800px",
                        autoHeight: false,
                        ajax: {
                            url: '{{ route('categoryinternal.all') }}',
                            type: 'GET',
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader("Authorization", "Bearer " + token);
                            },
                            data: function (data) {
                                data.page = (data.start / data.length) + 1;
                                data.per_page = data.length;
                                data.search = data.search.value;
                                data.filter_cat_inter_name = $('input[name="filter_cat_inter_name"]').val();
                            },
                            dataSrc: function (response) {
                                response.recordsTotal = response.data.total;
                                response.recordsFiltered = response.data.total;
                                return response.data.data;
                            },
                            error: function (xhr) {
                                if (xhr.status === 404) {
                                    $('#dataTableCategoryInternal').html(
                                        '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
                                    );
                                }
                            }
                        },
                        columns: [{
                            data: 'cat_inter_id',
                            name: 'cat_inter_id',
                        },
                            {
                                data: 'cat_inter_name',
                                name: 'cat_inter_name'
                            },
                            {
                                data: 'cat_inter_code',
                                name: 'cat_inter_code'
                            },
                            {
                                data: 'cat_inter_parent_id',
                                name: 'cat_inter_parent_id'
                            },
                            {
                                data: 'category_internal_product_count',
                                name: 'category_internal_product_count'
                            },
                            {
                                data: 'user_name',
                                name: 'user_name'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                render: function (data, type, row,) {
                                    var id = row.cat_inter_id;
                                    return `<td class="text-center">
                                        <span class="dropdown-toggle cursor-pointer"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </span>
                                        <ul class="dropdown-menu">
                                             <li>
                                                <a class="dropdown-item fs-5" href="{{route('edit-category-internal')}}?id=${id}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                    Sửa
                                                </a>
                                            </li>
                                             <li>
                                                <a class="dropdown-item fs-5 text-danger delete-item" onclick="deleteCategoryInternal(${id})">
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
                            filter_cat_inter_name: $('input[name="filter_cat_inter_name"]').val(),
                        };
                        $.ajax({
                            url: '{{ route('categoryinternal.export') }}',
                            type: 'POST',
                            data: filterData,
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader("Authorization", "Bearer " + token);
                            },
                            success: function (response) {
                                var workbook = XLSX.utils.book_new();
                                var heading = ['Tên'	,'Mã',	'ID'	,'parentId'	,'Tổng số sản phẩm',	'Người tạo'];
                                var sheetData = XLSX.utils.aoa_to_sheet([heading, ...response.data]);
                                XLSX.utils.book_append_sheet(workbook, sheetData, 'Sheet1');
                                var wbout = XLSX.write(workbook, {
                                    bookType: 'xlsx',
                                    type: 'array'
                                });
                                var currentDate = new Date().getTime(); // Lấy giá trị timestamp hiện tại
                                saveAs(new Blob([wbout], {
                                    type: 'application/octet-stream'
                                }), 'category_internal_' + currentDate + '.xlsx');
                            },
                            error: function (xhr) {
                                console.error(xhr);
                            }
                        });
                    });
                });
                function deleteCategoryInternal(id) {
                    $('#confirmModal').modal('show');
                    $('#modal-confirm-confirmed').off('click').on('click', function () {
                        $.ajax({
                            url: '{{route('categoryinternal.delete')}}',
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
                                var dataTable = $('#dataTableCategoryInternal').DataTable();
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
