@extends('backend.layout.layout')

@section('title')
Danh mục
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
                <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                @include('backend.components.modalconfirm')
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab"  role="tab" aria-selected="true">Danh mục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('category-internal')}}">Danh mục nội bộ</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade show active" id="tab-category"
                         role="tabpanel"
                         aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">
                            <!-- Start Filter content -->
                            <div class="row mb-3">
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" name="filter_cat_name" maxlength="255" placeholder="Tên danh mục"
                                                   id="filter_cat_name" class="form-control"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" name="filter_cat_code" maxlength="255"
                                                   placeholder="Mã danh mục"
                                                   autofocus="autofocus" autocomplete="off" id="filter_cat_code"
                                                   class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 pt-3">
                                    <div class="btn-group dropdown">
                                        <button type="button" name="submit-filter"
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
                                            <a class="dropdown-item fs-5" href="<?= Route('create-category') ?>">
                                                <i class="icon-lg pb-3px" data-feather="plus"></i>
                                                Thêm danh mục
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item fs-5" href="{{ Route('import-category') }}">
                                                <i class="icon-lg pb-3px" data-feather="plus"></i>
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
                                            <a class="dropdown-item fs-5" href="#">
                                                <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                                                Xuất Excel
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End filter content -->
                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableCategory_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="dataTableCategory"
                                                   class="table dataTable no-footer table-bordered"
                                                   aria-describedby="dataTableCategory_info" style="width: 100%">
                                                <thead class="table-light">
                                                <tr>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategory"
                                                        rowspan="1" colspan="1">
                                                        ID
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategory"
                                                        rowspan="1" colspan="1">
                                                        Tên
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategory"
                                                        rowspan="1" colspan="1">
                                                        Mã
                                                    </th>
                                                    <th class="sorting text-black text-center sorting_asc" tabindex="0"
                                                        aria-controls="dataTableCategory" rowspan="1" colspan="1"
                                                        aria-sort="ascending">
                                                        Ảnh
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategory"
                                                        rowspan="1" colspan="1">
                                                        Icon
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategory"
                                                        rowspan="1" colspan="1">
                                                        Thứ tự
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategory"
                                                        rowspan="1" colspan="1">
                                                        Số sản phẩm
                                                    </th>
                                                    <th class="sorting text-black text-center" tabindex="0"
                                                        aria-controls="dataTableCategory"
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
        var token = localStorage.getItem("Token");
        $(document).ready(function () {
            $('button[name=submit-filter]').click(function () {
                var dataTable = $('#dataTableCategory').DataTable();
                dataTable.ajax.reload();
            });
            $('#dataTableCategory').DataTable({
                serverSide: true,
                scrollX: true,
                scrollY: "800px",
                autoHeight: false,
                ajax: {
                    url: '{{route('category.all')}}',
                    type: 'GET',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    data: function (data) {
                        data.page = (data.start / data.length) + 1;
                        data.per_page = data.length;
                        data.search = data.search.value;
                        data.filter_cat_name = $('input[name="filter_cat_name"]').val();
                        data.filter_cat_code = $('input[name="filter_cat_code"]').val();
                    },
                    dataSrc: function (response) {
                        response.recordsTotal = response.data.total;
                        response.recordsFiltered = response.data.total;
                        return response.data.data;
                    },
                    error: function (xhr) {
                        if (xhr.status === 404) {
                            $('#dataTableCategory').html(
                                '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
                            );
                        }
                    }
                },
                columns: [{
                    data: 'cat_id',
                    name: 'cat_id',
                },
                    {
                        data: 'cat_name',
                        name: 'cat_name',
                    },
                    {
                        data: 'cat_code',
                        name: 'cat_code',
                    },
                    {
                        data: 'cat_image',
                        name: 'cat_image',
                        render: function (data, type, row) {
                            if (data && data.length > 0) {
                                var imageUrl = '/storage/' + data;
                                return '<img src="' + imageUrl + '" alt="Category Image" width="50">';
                            } else {
                                return 'No Image';
                            }
                        }
                    },
                    {
                        data: 'cat_icon',
                        name: 'cat_icon',
                        render: function (data, type, row) {
                            if (data && data.length > 0) {
                                var imageUrl = '/storage/' + data;
                                return '<img src="' + imageUrl + '" alt="Category Image" width="50">';
                            } else {
                                return 'No Image';
                            }
                        }
                    },
                    {
                        data: 'cat_order',
                        name: 'cat_order',
                        render: function (data, type, row,) {
                            var id = row.cat_id;
                            return '<input type="number" max="99999" min="0" value="' + data +
                                '" class="form-control" data-id="' + id + '">';
                        }
                    },
                    {
                        data: 'category_product_count',
                        name: 'category_product_count',
                        render: function (data, type, row,) {
                            var id = row.cat_id;
                            return '<a href="/value?category=' + id + '">' + data + '</a>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function (data, type, row,) {
                            var id = row.cat_id;
                            return `<td class="text-center">
                                        <span class="dropdown-toggle cursor-pointer"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </span>
                                        <ul class="dropdown-menu">
                                             <li>
                                                <a class="dropdown-item fs-5" href="{{route('edit-category')}}?id=${id}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                    Sửa
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-success fs-5"
                                                    href="">
                                                    <i class="fa-solid fa-plus text-success"></i>
                                                    Import excel
                                                </a>
                                            </li>
                                             <li>
                                                <a class="dropdown-item fs-5 text-danger delete-item" onclick="deleteCategory(${id})">
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
                paging: false,
                lengthMenu: [
                    [-1],
                    ['All']
                ],
                drawCallback: function () {
                    //SAVE ORDER
                    if (!$('#dataTableCategory tbody tr.last-row').length) {
                        var lastRow = '<tr class="last-row">' +
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
                        $('#dataTableCategory tbody').append(lastRow);
                        $('#saveOrderVarBtn').click(function () {
                            var orderData = {};
                            $('#dataTableCategory tbody input').each(function () {
                                var inputValue = $(this).val();
                                var id = $(this).data('id');
                                orderData[id] = inputValue;
                                console.log(inputValue)
                            });
                            $.ajax({
                                url: '{{route('category.edit.order')}}',
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
                                                toastr.success("Danh mục id : " + key + " cập nhật thành công"
                                                );
                                            } else {
                                                toastr.error("Danh mục id : " + key + " cập nhật thất bại");
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
        function deleteCategory(id) {
            $('#confirmModal').modal('show');

            $('#modal-confirm-confirmed').off('click').on('click', function () {
                $.ajax({
                    url: '{{route('category.delete')}}',
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
                        var dataTable = $('#dataTableCategory').DataTable();
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
