@extends('backend.layout.layout')

@section('title')
    Thuộc tính
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
                <li class="breadcrumb-item active" aria-current="page">Thuộc tính</li>
            </ol>
        </nav>
        @php
            if (Session::has('is_group')) {
            $is_group = Session::get('is_group');
            }
            $active = 'active';
            $show_active = 'show active';
        @endphp
        <div class="card">
            <div class="card-body">
                @include('backend.components.modalconfirm')
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ isset($is_group) && $is_group ? '' : $active }}" id="home-line-tab"
                           data-bs-toggle="tab"
                           href="#variant" role="tab" aria-controls="variant" aria-selected="true">Thuộc tính</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ isset($is_group) && $is_group ? $active : '' }}" id="sell-price-line-tab"
                           data-bs-toggle="tab" href="#variantgroup" role="tab" aria-controls="variantgroup"
                           aria-selected="false">Nhóm
                            thuộc tính</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade {{ isset($is_group) && $is_group ? '' : $show_active }}" id="variant"
                         role="tabpanel"
                         aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">
                            <!-- Start Filter content -->
                            <div class="row mb-3">
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <select class="form-select" aria-label="multiple select example"
                                                    name="filter_var_vg_id[]"
                                                    id="filter_var_vg_id"  custom-multiple multiple multiselect-search="true"
                                                    multiselect-select-all="true"
                                                    multiselect-max-items="1">
                                                @php
                                                    printVariantGroupMultipleChoise($variant_group , []);
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <select class="form-select" aria-label="multiple select example"
                                                    name="filter_var_cat_id[]"
                                                    id="filter_var_cat_id" custom-multiple multiple multiselect-search="true"
                                                    multiselect-select-all="true"
                                                    multiselect-max-items="1">
                                                @php
                                                    printCategoriesMultipleChoise($categories , 0 , []);
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" name="var_id" maxlength="255" placeholder="ID"
                                                   id="var_id" class="form-control"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" name="var_name" maxlength="255"
                                                   placeholder="Tên thuộc tính"
                                                   autofocus="autofocus" autocomplete="off" id="var_name"
                                                   class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 pt-3">
                                    <div class="btn-group dropdown">
                                        <button type="button" name="submit-filter-variant"
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
                                            <a class="dropdown-item fs-5" href="<?= Route('create-variant') ?>">
                                                <i class="icon-lg pb-3px" data-feather="plus"></i>
                                                Thêm thuộc tính
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item fs-5" href="{{ Route('create-variant-group') }}">
                                                <i class="icon-lg pb-3px" data-feather="plus"></i>
                                                Thêm nhóm thuộc tính
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End filter content -->
                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableVariant_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="dataTableVariant"
                                                   class="table dataTable no-footer table-bordered"
                                                   aria-describedby="dataTableVariant_info" style="width: 100%">
                                                <thead class="table-light">
                                                <tr>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariant"
                                                        rowspan="1" colspan="1">
                                                        ID
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariant"
                                                        rowspan="1" colspan="1">
                                                        Tên
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariant"
                                                        rowspan="1" colspan="1">
                                                        Giá trị
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariant"
                                                        rowspan="1" colspan="1">
                                                        Mã thuộc tính
                                                    </th>
                                                    <th class="sorting text-black text-center sorting_asc" tabindex="0"
                                                        aria-controls="dataTableVariant" rowspan="1" colspan="1"
                                                        aria-sort="ascending">
                                                        Bắt buộc nhập
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariant"
                                                        rowspan="1" colspan="1">
                                                        Tìm kiếm
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariant"
                                                        rowspan="1" colspan="1">
                                                        Thứ tự
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariant"
                                                        rowspan="1" colspan="1">
                                                        Người tạo
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariant"
                                                        rowspan="1" colspan="1">
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
                    <div class="tab-pane fade {{ isset($is_group) && $is_group ? $show_active : '' }}" id="variantgroup"
                         role="tabpanel" aria-labelledby="sell-price-line-tab">
                        <div class="card-body p-0 pt-2">
                            <!-- Start Filter content -->
                            <div class="row mb-3">
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" maxlength="255" placeholder="ID" id="vg_id" name="vg_id"
                                                   autocomplete="off"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" maxlength="255" placeholder="Tên nhóm thuộc tính"
                                                   id="vg_name" name="vg_name"
                                                   autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 pt-3">
                                    <div class="btn-group dropdown">
                                        <button type="button" name="submit-filter-variant-group"
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
                                            <a class="dropdown-item fs-5" href="{{ Route('create-variant-group') }}">
                                                <i class="icon-lg pb-3px" data-feather="plus"></i>
                                                Thêm nhóm thuộc tính
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End filter content -->
                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableVariantGroup_wrapper"
                                     class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="dataTableVariantGroup"
                                                   class="table dataTable no-footer table-bordered"
                                                   aria-describedby="dataTableVariantGroup_info" style="width: 100%">
                                                <thead class="table-light">
                                                <tr>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariantGroup"
                                                        rowspan="1" colspan="1">
                                                        ID
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariantGroup"
                                                        rowspan="1" colspan="1">
                                                        Tên
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariantGroup"
                                                        rowspan="1" colspan="1">
                                                        Thứ tự
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariantGroup"
                                                        rowspan="1" colspan="1">
                                                        Người tạo
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariantGroup"
                                                        rowspan="1" colspan="1">
                                                        Ngày tạo
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableVariantGroup"
                                                        rowspan="1" colspan="1">
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
        </div>

    </div>
@endsection

@section('script')
    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>
    <script>
        var token = localStorage.getItem("Token");
        $(document).ready(function () {
            //VARIANT
            $('button[name=submit-filter-variant]').click(function () {
                var dataTable = $('#dataTableVariant').DataTable();
                dataTable.column(0).search($('input[name="var_id"]').val()).draw();
                dataTable.column(1).search($('input[name="var_name"]').val()).draw();
                var selected_var_gr_id = $('#filter_var_vg_id').val();
                var selected_var_cat_id = $('#filter_var_cat_id').val();
                dataTable.ajax.reload();
            });
            $('#dataTableVariant').DataTable({
                serverSide: true,
                scrollX: true,
                scrollY: "800px",
                autoHeight: false,
                ajax: {
                    url: '{{route('variant.all')}}',
                    type: 'GET',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    data: function (data) {
                        data.page = (data.start / data.length) + 1;
                        data.per_page = data.length;
                        data.search = data.search.value;
                        data.columns[0].searchable = true;
                        data.columns[0].search.value = $('input[name="var_id"]').val();
                        data.columns[1].searchable = true;
                        data.columns[1].search.value = $('input[name="var_name"]').val();

                        data.selected_var_gr_id = $('#filter_var_vg_id').val();
                        data.selected_var_cat_id = $('#filter_var_cat_id').val();
                    },
                    dataSrc: function (response) {
                        response.recordsTotal = response.data.total;
                        response.recordsFiltered = response.data.total;
                        return response.data.data;
                    },
                    error: function (xhr) {
                        if (xhr.status === 404) {
                            $('#dataTableVariant').html(
                                '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
                            );
                        }
                    }
                },
                columns: [{
                    data: 'var_id',
                    name: 'var_id',
                    searchable: true
                },
                    {
                        data: 'var_name',
                        name: 'var_name'
                    },
                    {
                        data: 'variant_values_count',
                        name: 'variant_values_count',
                        render: function (data, type, row,) {
                            var id = row.var_id;
                            return '<a href="variant/value?variant=' + id + '">' + data + '</a>';
                        }
                    },
                    {
                        data: 'var_code',
                        name: 'var_code'
                    },
                    {
                        data: 'var_require',
                        name: 'var_require'
                    },
                    {
                        data: 'var_searchable',
                        name: 'var_searchable'
                    },
                    {
                        data: 'var_order',
                        name: 'var_order',
                        render: function (data, type, row,) {
                            var id = row.var_id;
                            return '<input type="number" max="99999" min="0" value="' + data +
                                '" class="form-control" data-id="' + id + '">';
                        }
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        render: function (data, type, row,) {
                            var id = row.var_id;
                            return `<td class="text-center">
                                        <span class="dropdown-toggle cursor-pointer"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </span>
                                        <ul class="dropdown-menu">
                                             <li>
                                                <a class="dropdown-item fs-5" href="variant/edit?id=${id}" data-id="${id}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                    Sửa
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-success fs-5"
                                                    href="{{route('import-variant-value')}}?id=${id}">
                                                    <i class="fa-solid fa-plus text-success"></i>
                                                    Import excel
                                                </a>
                                            </li>
                                             <li>
                                                <a class="dropdown-item fs-5 text-danger delete-item" onclick="deleteVariant(${id})">
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
                drawCallback: function () {
                    //SAVE ORDER
                    if (!$('#dataTableVariant tbody tr.last-row').length) {
                        var columnCount = $('#dataTableVariant thead tr th').length;
                        var lastRow = '<tr class="last-row">' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td>' +
                            '<button class="btn btn-primary" id="saveOrderVarBtn"><i class="fa-solid fa-floppy-disk"></i> Lưu</button>' +
                            '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>';
                        $('#dataTableVariant tbody').append(lastRow);
                        $('#saveOrderVarBtn').click(function () {
                            var orderData = {};
                            $('#dataTableVariant tbody input').each(function () {
                                var inputValue = $(this).val();
                                var id = $(this).data('id');
                                orderData[id] = inputValue;
                            });
                            $.ajax({
                                url: '{{route('variant.edit.order')}}',
                                method: 'POST',
                                data: orderData,
                                beforeSend: function (xhr) {
                                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                                },
                                success: function (response) {
                                    for (var key in response.data) {
                                        if (response.data.hasOwnProperty(key)) {
                                            var status = response.data[key].status;
                                            if (status) {
                                                toastr.success("Thuộc tính id : " + key + " cập nhật thành công"
                                                );
                                            } else {
                                                toastr.error("Thuộc tính id : " + key + " cập nhật thất bại");
                                            }
                                        }
                                    }
                                },
                                error: function (error) {
                                    toastr.error(error.responseJSON.message);
                                }
                            });
                        });
                    }
                },
            });


            //VARIANT GROUP
            $('button[name=submit-filter-variant-group]').click(function () {
                var dataTable = $('#dataTableVariantGroup').DataTable();
                dataTable.column(0).search($('input[name="vg_id"]').val()).draw();
                dataTable.column(1).search($('input[name="vg_name"]').val()).draw();
            });
            $('#dataTableVariantGroup').DataTable({
                serverSide: true,
                scrollX: true,
                scrollY: "800px",
                autoHeight: false,
                ajax: {
                    url: '{{route('variantgroup.all')}}',
                    type: 'GET',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    data: function (data) {
                        data.page = (data.start / data.length) + 1;
                        data.per_page = data.length;
                        data.search = data.search.value;
                        data.columns[0].searchable = true;
                        data.columns[0].search.value = $('input[name="vg_id"]').val();
                        data.columns[1].searchable = true;
                        data.columns[1].search.value = $('input[name="vg_name"]').val();
                    },
                    dataSrc: function (response) {
                        response.recordsTotal = response.data.total;
                        response.recordsFiltered = response.data.total;
                        return response.data.data;
                    },
                    error: function (xhr) {
                        if (xhr.status === 404) {
                            $('#dataTableVariantGroup').html(
                                '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
                            );
                        }
                    }
                },
                columns: [
                    {data: 'vg_id', name: 'vg_id', searchable: true},
                    {data: 'vg_name', name: 'vg_name'},
                    {
                        data: 'vg_order', name: 'vg_order',
                        render: function (data, type, row,) {
                            var id = row.vg_id;
                            return '<input type="number" max="99999" min="0" value="' + data +
                                '" class="form-control" data-id="' + id + '">';
                        }
                    },
                    {data: 'user_name', name: 'user_name'},
                    {
                        data: 'created_at', name: 'created_at', searchable: true,
                        render: function (data) {
                            var date = new Date(data * 1000);
                            return date.toLocaleString();
                        }
                    },
                    {
                        data: 'action', name: 'action',
                        render: function (data, type, row,) {
                            var id = row.vg_id;
                            return `<td class="text-center">
                                                    <span class="dropdown-toggle cursor-pointer"
                                                          data-bs-toggle="dropdown"
                                                          aria-expanded="false">
                                                      <i class="fa-solid fa-bars"></i>
                                                    </span>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item fs-5" href="variant-group/edit?id=${id}" data-id="${id}">
                                                                <i class="fa-regular fa-pen-to-square"></i>
                                                                Sửa
                                                            </a>
                                                        </li> <li>
                                                            <a class="dropdown-item fs-5 text-danger delete-item" onclick="deleteVariantGroup(${id})">
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
                drawCallback: function () {
                    if (!$('#dataTableVariantGroup tbody tr.last-row').length) {
                        var lastRow = '<tr class="last-row">' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td>' +
                            '<button class="btn btn-primary" id="saveOrderVarGRBtn"><i class="fa-solid fa-floppy-disk"></i> Lưu</button>' +
                            '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>';
                        $('#dataTableVariantGroup tbody').append(lastRow);
                        $('#saveOrderVarGRBtn').click(function () {
                            var orderData = {};
                            $('#dataTableVariantGroup tbody input').each(function () {
                                var inputValue = $(this).val();
                                var id = $(this).data('id');
                                orderData[id] = inputValue;
                            });
                            $.ajax({
                                url: '{{route('variantgroup.edit.order')}}',
                                method: 'POST',
                                data: orderData,
                                beforeSend: function (xhr) {
                                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                                },
                                success: function (response) {
                                    for (var key in response.data) {
                                        if (response.data.hasOwnProperty(key)) {
                                            var status = response.data[key].status;
                                            if (status) {
                                                toastr.success("Thuộc tính id : " +
                                                    key + " cập nhật thành công"
                                                );
                                            } else {
                                                toastr.error("Thuộc tính id : " +
                                                    key + " cập nhật thất bại");
                                            }
                                        }
                                    }
                                },
                                error: function (error) {
                                    toastr.error(error.responseJSON.message);
                                }
                            });
                        });
                    }
                },
            });

        });

        function deleteVariantGroup(id) {
            $('#confirmModal').modal('show');

            $('#modal-confirm-confirmed').off('click').on('click', function () {
                $.ajax({
                    url: '{{route('variantgroup.delete')}}',
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
                        var dataTable = $('#dataTableVariantGroup').DataTable();
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

        function deleteVariant(id) {
            $('#confirmModal').modal('show');

            $('#modal-confirm-confirmed').off('click').on('click', function () {
                $.ajax({
                    url: '{{route('variant.delete')}}',
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
                        var dataTable = $('#dataTableVariant').DataTable();
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
