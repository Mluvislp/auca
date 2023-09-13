@extends('backend.layout.layout')

@section('title')
    Sản phẩm
@endsection

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Bảng điều khiển</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Quản lý người dùng</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Phân quyền</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">
                            <!-- Start Filter content -->
                            <form id="Submit" class="mb-3 p-3 border border-primary rounded-3">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Tên vai trò</label>
                                    <input type="text" class="form-control" name="title" id="title">
                                </div>
                                <div class="mb-3">
                                    <label for="decs" class="form-label">Mô tả</label>a
                                    <textarea class="form-control" placeholder="Leave a comment here" name="decs12" id="decs12"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </form>
                            <!-- End filter content -->
                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableExampleHero_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="dataTableExampleHero"
                                                class="table dataTable no-footer table-bordered"
                                                aria-describedby="dataTableExampleHero_info">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            Tiêu đề
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            Xem
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            Thêm
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            Cập nhật
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="dataTableExampleHero" rowspan="1"
                                                            colspan="1">
                                                            Xóa
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-start">
                                                            Quản lý tổng quát
                                                        </td>
                                                        <td class="text-center">
                                                            <div
                                                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="flexSwitchCheckChecked" checked>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div
                                                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="flexSwitchCheckChecked" checked>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div
                                                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="flexSwitchCheckChecked" checked>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div
                                                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="flexSwitchCheckChecked" checked>
                                                            </div>
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
    <script>
        var token = localStorage.getItem("Token");
        // Lấy URL từ thanh địa chỉ
        var url = window.location.href;
        // Tìm vị trí của ký tự '/' cuối cùng trong URL
        var lastSlashIndex = url.lastIndexOf('/');
        // Lấy phần tử sau ký tự '/' cuối cùng để lấy ra ID
        var id = url.substring(lastSlashIndex + 1);

        function getData() {
            $(document).ready(function() {
                $.ajax({
                    url: "{{ route('permission.viewALL') }}",
                    type: 'GET',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        $('tbody').empty();
                        const viewPage = ['view', 'add', 'edit', 'delete']
                        console.log(response.data)
                        const permission = response.data.permission
                        const detail = response.data.detail
                        $("#title").val(response.data.type.name);
                        $("#decs12").val(response.data.type.summary);
                        var html = ``
                        $.each(permission, function(key, value) {

                            if (detail.hasOwnProperty(value)) {

                                html += `<tr>
                                    <td class="text-start">
                                        ${value}
                                    </td>`
                                viewPage.forEach((element) => {
                                    if (detail[value].hasOwnProperty(element)) {
                                        html +=
                                            ` 
                                      <td class="text-center">
                                        <div
                                            class="form-check form-switch d-flex align-items-center justify-content-center">
                                            <input class="form-check-input" type="checkbox"  onchange="deletePermission(${detail[value][element].id})"
                                            role="switch" id="flexSwitchCheckChecked" checked>
                                        </div>
                                       </td>
                                             `
                                    } else {
                                        html +=
                                            ` 
                                      <td class="text-center">
                                        <div
                                            class="form-check form-switch d-flex align-items-center justify-content-center">
                                            <input class="form-check-input" type="checkbox" onchange="addPermission(${id},'${element}','${value}')"
                                            role="switch" id="flexSwitchCheckChecked">
                                        </div>
                                       </td>
                                             `
                                    }
                                });
                                html += `</tr>`
                            } else {
                                html += `<tr>
                                    <td class="text-start">
                                        ${value}
                                    </td>`
                                viewPage.forEach((element) => {
                                    html +=
                                        ` 
                                      <td class="text-center">
                                        <div
                                            class="form-check form-switch d-flex align-items-center justify-content-center">
                                            <input class="form-check-input" type="checkbox" onchange="addPermission(${id},'${element}','${value}')"
                                            role="switch" id="flexSwitchCheckChecked">
                                        </div>
                                       </td>
                                             `
                                })
                                html += `</tr>`
                            }
                        });
                        $('tbody').append(html);
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
            });
        }
        getData()

        function addPermission(id, page, value) {
            $(document).ready(function() {
                $('.form-check-input').prop('disabled', true);
                $.ajax({
                    url: "{{ route('permission.add') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        type: page,
                        page: value
                    },
                    dataType: 'json',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        $('.form-check-input').prop('disabled', false);
                        toastr.success('thêm quyền thành công', 'Thao tác');
                        getData()
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

        function deletePermission(id) {
            $(document).ready(function() {
                $('.form-check-input').prop('disabled', true);
                $.ajax({
                    url: "{{ route('permission.del') }}",
                    type: 'DELETE',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        $('.form-check-input').prop('disabled', false);
                        toastr.success('Xóa quyền thành công', 'Thao tác');
                        getData()
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
            console.log('delete permission with id ' + id)
        }

        $("#Submit").submit(function(event) {
            event.preventDefault();
            var title = $("#title").val();
            var desc = $("#decs12").val();
            $.ajax({
                url: "{{ route('permission.UpdateRole', ['id' => ':id']) }}".replace(':id',id),
                type: 'PUT',
                data: {
                    name:title,
                    summery:desc
                },
                dataType: 'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                success: function(response) {
                    toastr.success('Cập nhập thành công', 'thao tác');
                    getData()
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
        });
    </script>
@endsection
