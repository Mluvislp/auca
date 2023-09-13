@extends('backend.layout.layout')

@section('title')
    Thành viên
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
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quản lý thành viên</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <div class="data-button float-end">
                    <a href="{{ route('trash_account') }}">
                        <button type="button" class="btn btn-inverse-danger">Thùng rác</button>
                    </a>
                    <a href="{{ route('add_account') }}">
                        <button type="button" class="btn btn-inverse-primary">Thêm mới</button>
                    </a>
                </div>
                <h6 class="card-title">Danh sách thành viên</h6>
                <p class="text-muted mb-3">Read the <a href="#" target="_blank"> Official DataTables
                        Documentation </a>for a full list of instructions and other options.</p>
                <div class="table-responsive overflow-hidden">
                    <div  class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="perfect-scrollbar-example pb-2">
                                    <table id="dataTableExample" class="table dataTable no-footer"
                                        aria-describedby="dataTableExample_info">
                                        <thead>
                                            <tr>
           
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 306.925px;">ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 306.925px;">Tên vai trò
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                    style="width: 146.275px;">Summery
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 61.35px;">Loại vai trò</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Start date: activate to sort column ascending"
                                                    style="width: 134.413px;">TRẠNG THÁI
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 97.875px;">Hành động</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 97.875px;"> </th>
                                            </tr>
                                        </thead>
                                        <tbody id="newTable">
                                          @foreach($data as $item)
                                            <tr class="odd">
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->summary}}</td>
                                                <td>{{$item->type}}</td>
                                                <td>
                                                    <span class="badge rounded-pill bg-primary">{{$item->public}}</span>
                                                </td>
                                                <td>

                                                    <div class="btn-edit" style="margin-right: 10px;">
                                                        <a href="{{ route('edit_permission', ['id' => $item->id]) }}">Sửa</a>
                                                    </div>
                                </div>
                                </td>
                                <td>
                                    <div class="btn-deleted" style="margin-right: 10px;">
                                      <button onclick="deleteFunc({{$item->id}})">Xóa</button>
                                    </div>
                                <td>
                                    </tr> 
                                    @endforeach
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
@endsection

@section('script')
    <script>
        var token = localStorage.getItem("Token");
        function deleteFunc(id) {
          if (confirm("Bạn có chắc chắn muốn xóa?")) {
                $.ajax({
                    url: "{{ route('permission.Roledelete', ['id' => ':id']) }}".replace(':id', id),
                    type: 'DELETE',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        toastr.success('Xử lý thành công', 'Thông báo');
                        location.reload(true);
                    },
                    error: function(xhr, status, error) {
                        var statusCode = xhr.status;
                        switch (statusCode) {
                            case 401:
                                toastr.error('phiên đăng nhập đã hết hạn xin hãy đăng nhập và thử lại', 'Lỗi');
                                break;
                            case 403:
                                toastr.error('Bạn không có quyền thực hiện việc này', 'Lỗi');
                                break;
                            default:
                                toastr.error('Đã có lỗi xảy ra hãy reload trang và thử lại', 'Lỗi');
                        }
                    }
                });
            }
        }
    </script>
    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>
@endsection
