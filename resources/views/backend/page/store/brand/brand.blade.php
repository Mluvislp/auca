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
                <li class="breadcrumb-item active" aria-current="page">Thương hiệu</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Danh sách thương hiệu</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">
                            <!-- Start Filter content -->
                            <div class="row mb-3">
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" maxlength="255" placeholder="ID" id="brand_id"
                                                name="brand_id" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 pr-1">
                                    <div class="form-group input-group mb-0 pt-3">
                                        <div class="col p-0">
                                            <input type="text" maxlength="255" placeholder="Tên thương hiệu"
                                                id="brand_name" name="brand_name" autocomplete="off" class="form-control">
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
                                            <a class="dropdown-item fs-5" href="{{ route('add_brand') }}">
                                                <i class="icon-lg pb-3px" data-feather="plus"></i>
                                                Thêm thương hiệu
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item fs-5" href="{{ route('import_brand') }}">
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
                                            <table id="brandData" class="table dataTable no-footer table-bordered"
                                                aria-describedby="brandData_info">
                                                <thead class="table-light">
                                                    <tr>

                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="brandData" rowspan="1" colspan="1">
                                                            ID
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="brandData" rowspan="1" colspan="1">
                                                            Tên
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="brandData" rowspan="1" colspan="1">
                                                            Mã
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="brandData" rowspan="1" colspan="1">
                                                            Ảnh
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="brandData" rowspan="1" colspan="1">
                                                            Mô tả sản phẩm
                                                        </th>
                                                        <th class="sorting text-black text-center sorting_asc"
                                                            tabindex="0" aria-controls="brandData" rowspan="1"
                                                            colspan="1" aria-sort="ascending">
                                                            Thứ tự
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="brandData" rowspan="1" colspan="1">
                                                            Ghi chú
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="brandData" rowspan="1" colspan="1">
                                                            Người tạo
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="brandData" rowspan="1" colspan="1">
                                                            Ngày tạo
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="brandData" rowspan="1" colspan="1">
                                                            Trại thái
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0"
                                                            aria-controls="brandData" rowspan="1" colspan="1">
                                                            <i class="icon-lg text-black pb-3px"
                                                                data-feather="settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    {{-- begin product --}}

                                                    {{-- @foreach ($brand as $item)
     <tr>
      <td class="text-center">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        </div>
      </td>
      <td class="text-start">{{$item->brand_order}}</td>
      <td class="text-start">{{$item->brand_id}}</td>
      <td class="text-start">{{$item->brand_name}}</td>
      <td class="text-start">{{$item->brand_code}}</td>
      <td class="text-center">{{$item->brand_image}}</td>
      <td class="text-center">{{$item->brand_description}}</td>
      <td class="text-center">
        
        <div>
          
          <input type="number" value="{{$item->brand_order}}" onkeydown="handleKeyUp(event,{{$item->brand_id}})" class="form-control p-0" id="exampleFormControlInput1">
        </div>
      </td>
      <td class="text-start">{{$item->brand_content}}</td>
      <td class="text-start">{{$item->created_at}}</td>
      <td class="text-center">
        <div class="form-check form-switch d-flex justify-content-center align-items-center">
          @if ($item->brand_status == 1)
          <input class="form-check-input" type="checkbox" onchange="changeSelect({{$item->brand_id}})" id="flexSwitchCheckDefault" checked>
          @else
          <input class="form-check-input" type="checkbox" onchange="changeSelect({{$item->brand_id}})" id="flexSwitchCheckDefault">
          @endif
        </div>
      </td>
      <td class="text-center">
        <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="icon-lg pb-3px" data-feather="menu"></i>
        </span>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item fs-5" href="#">
              <i class="icon-lg pb-3px" data-feather="edit"></i>
              Sửa
            </a>
          </li>
          <li>
            <a class="dropdown-item text-success fs-5" href="#">
              <i class="icon-lg text-success pb-3px" data-feather="plus"></i>
              Thêm thương hiệu con
            </a>
          </li>
          <li>
            <a class="dropdown-item fs-5" href="#">
              <i class="icon-lg pb-3px" data-feather="x-circle"></i>
              Bỏ gắn thương hiệu cho sản phẩm
            </a>
          </li>
          <li>
            <a class="dropdown-item fs-5" href="#">
              <i class="icon-lg pb-3px" data-feather="arrow-right"></i>
              Chuyển sản phẩm sang thương hiệu khác
            </a>
          </li>
          <li>
            <a class="dropdown-item text-primary fs-5" href="#">
              <i class="icon-lg text-primary pb-3px" data-feather="link"></i>
              Link trên website
            </a>
          </li>
          <li>
            <a class="dropdown-item text-success fs-5" href="#">
              <i class="icon-lg text-success pb-3px" data-feather="plus-circle"></i>
              Upload ảnh
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
     @endforeach --}}
                                                    {{-- <tr>
      <td class="text-center">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        </div>
      </td>
      <td class="text-start">$item->brand_order</td>
      <td class="text-start">$item->brand_id</td>
      <td class="text-start">$item->brand_name</td>
      <td class="text-start">$item->brand_code</td>
      <td class="text-center">$item->brand_image</td>
      <td class="text-center">$item->brand_description</td>
      <td class="text-center">
        
        <div>
          
          <input type="number" value="$item->brand_order" onkeydown="handleKeyUp(event,'asdasd')" class="form-control p-0" id="exampleFormControlInput1">
        </div>
      </td>
      <td class="text-start">$item->brand_content</td>
      <td class="text-start">$item->created_at</td>
      <td class="text-center">
        <div class="form-check form-switch d-flex justify-content-center align-items-center">

          <input class="form-check-input" type="checkbox" onchange="changeSelect('$item->brand_id')" id="flexSwitchCheckDefault">

        </div>
      </td>
      <td class="text-center">
        <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="icon-lg pb-3px" data-feather="menu"></i>
        </span>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item fs-5" href="#">
              <i class="icon-lg pb-3px" data-feather="edit"></i>
              Sửa
            </a>
          </li>
          <li>
            <a class="dropdown-item text-success fs-5" href="#">
              <i class="icon-lg text-success pb-3px" data-feather="plus"></i>
              Thêm thương hiệu con
            </a>
          </li>
          <li>
            <a class="dropdown-item fs-5" href="#">
              <i class="icon-lg pb-3px" data-feather="x-circle"></i>
              Bỏ gắn thương hiệu cho sản phẩm
            </a>
          </li>
          <li>
            <a class="dropdown-item fs-5" href="#">
              <i class="icon-lg pb-3px" data-feather="arrow-right"></i>
              Chuyển sản phẩm sang thương hiệu khác
            </a>
          </li>
          <li>
            <a class="dropdown-item text-primary fs-5" href="#">
              <i class="icon-lg text-primary pb-3px" data-feather="link"></i>
              Link trên website
            </a>
          </li>
          <li>
            <a class="dropdown-item text-success fs-5" href="#">
              <i class="icon-lg text-success pb-3px" data-feather="plus-circle"></i>
              Upload ảnh
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

                                                    {{-- end product --}}


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
        var dataTableConfig = {
            serverSide: true,
            scrollX: true,
            scrollY: "800px",
            autoHeight: false,
            ajax: {
                url: '{{ route('brand.getAll') }}',
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                data: function(data) {
                    console.log(data)
                    data.page = (data.start / data.length) + 1;
                    data.per_page = data.length;
                    data.search = data.search.value;
                    data.columns[1].searchable = true;
                    data.columns[1].search.value = $('input[name="brand_id"]').val();
                    data.columns[2].searchable = true;
                    data.columns[2].search.value = $('input[name="brand_name"]').val();
                },
                dataSrc: function(response) {
                    response.recordsTotal = response.data.total;
                    response.recordsFiltered = response.data.total;
                    Exceldata = response.data.data
                    console.log(response.data.data)
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
                    data: 'brand_id',
                    name: 'brand_id',
                    searchable: true
                },
                {
                    data: 'brand_name',
                    name: 'brand_name',
                    searchable: true
                },
                {
                    data: 'brand_code',
                    name: 'brand_code'
                },
                {
                    data: 'brand_image',
                    name: 'brand_image',
                    render: function(data) {
                        return `<img src="${data}" alt="" class="img-brand" width="50px" height="40px">`;
                    }
                },
                {
                    data: 'brand_description',
                    name: 'brand_description'
                },
                {
                    data: 'number',
                    name: 'number',
                    render: function(data) {
                        return `<input type="number" value="${data['order']}" id = "order_${data['id']}" data-old="${data['order']}" data-id="${data['id']}" class="form-control p-0" id="exampleFormControlInput1" min="0" step="1">

                        `;
                    }
                },
                {
                    data: 'brand_content',
                    name: 'brand_content'
                },
                {
                    data: 'create_by',
                    name: 'create_by'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'status_data',
                    name: 'status_data',
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
                    data: 'number',
                    name: 'number',
                    render: function(data) {
                        return `
                      <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="icon-lg pb-3px" data-feather="menu"></i>
        </span>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item fs-5" href="./edit-brand/${data['id']}">
              <i class="icon-lg pb-3px" data-feather="edit"></i>
              Sửa
            </a>
          </li>
          <li>
            <a class="dropdown-item text-success fs-5" href="#">
              <i class="icon-lg text-success pb-3px" data-feather="plus"></i>
              Thêm thương hiệu con
            </a>
          </li>
          <li>
            <a class="dropdown-item fs-5" href="#">
              <i class="icon-lg pb-3px" data-feather="x-circle"></i>
              Bỏ gắn thương hiệu cho sản phẩm
            </a>
          </li>
          <li>
            <a class="dropdown-item fs-5" href="#">
              <i class="icon-lg pb-3px" data-feather="arrow-right"></i>
              Chuyển sản phẩm sang thương hiệu khác
            </a>
          </li>
          <li>
            <a class="dropdown-item text-primary fs-5" href="#">
              <i class="icon-lg text-primary pb-3px" data-feather="link"></i>
              Link trên website
            </a>
          </li>
          <li>
            <a class="dropdown-item text-success fs-5" href="#">
              <i class="icon-lg text-success pb-3px" data-feather="plus-circle"></i>
              Upload ảnh
            </a>
          </li>
          <li>
            <a class="dropdown-item fs-5 text-danger" onclick="deleteDATA(${data['id']})">
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
            pageLength: 10,
            drawCallback: function() {
                //SAVE ORDER
                if (!$('#brandData tbody tr.last-row').length) {
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
                    $('#brandData tbody').append(lastRow);
                    $('#saveOrderVarBtn').click(function() {
                        var orderData = {};
                        $('#brandData tbody input').each(function() {
                            var inputValue = $(this).val();
                            var id = $(this).data('id');
                            var old = $(this).data('old');
                            var valNumber 
                            if(inputValue == 'on' || !inputValue){
                                
                            }else{
                                valNumber =parseInt(inputValue)
                            }
                            if (valNumber) {
                                if(valNumber < 0) {
                                    toastr.error('data tại id '+id+' không được phép là âm', 'Thông báo');
                                    return
                                }
                                if(valNumber !== old){
                                    orderData[id] = valNumber
                                var Data = {
                                    count: inputValue
                                }
                                $.ajax({
                                    url: "{{ route('brand.updateOrderbrand', ['id' => ':id']) }}"
                                        .replace(':id', id),
                                    type: 'PUT',
                                    data: Data,
                                    dataType: 'json',
                                    beforeSend: function(xhr) {
                                        xhr.setRequestHeader("Authorization",
                                            "Bearer " + token);
                                    },
                                    success: function(response) {
                                        // Xử lý thành công
                                        toastr.success('Xử lý thành công data id '+id, 'Thông báo');
                                    },
                                    error: function(xhr, status, error) {
                                        toastr.error('lỗi xử lý tại data id '+id, 'Thông báo');
                                    }
                                });
                                }
                            }

                        });
                                        dataTable.destroy();
                                        dataTable = $('#brandData').DataTable(
                                            dataTableConfig);

                    });
                }
            },
        }
        $('button[name=submit-filter-variant-group]').click(function() {
            console.log($('input[name="brand_id"]').val())
            var dataTable = $('#brandData').DataTable();
            dataTable.column(1).search($('input[name="brand_id"]').val()).draw();
            dataTable.column(2).search($('input[name="brand_name"]').val()).draw();
        });
        var dataTable = $('#brandData').DataTable(dataTableConfig);


        function changeSelect(id) {
            $(document).ready(function() {
                $.ajax({
                    url: "{{ route('brand.updateStatusbrand', ['id' => ':id']) }}".replace(':id', id),
                    type: 'PUT',
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

        function handleKeyUp(id) {
            var inputValue = $(`#order_${id}`).val();
            console.log(inputValue)
            if (inputValue < 0) {
                toastr.error('Số thứ tự không được phép là âm', 'Lỗi');
                return
            }
            var Data = {
                count: inputValue
            }
            $(document).ready(function() {
                $.ajax({
                    url: "{{ route('brand.updateOrderbrand', ['id' => ':id']) }}".replace(':id', id),
                    type: 'PUT',
                    data: Data,
                    dataType: 'json',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        // Xử lý thành công
                        toastr.success('Xử lý thành công', 'Thông báo');
                        dataTable.destroy();
                        dataTable = $('#brandData').DataTable(dataTableConfig);
                    },
                    error: function(xhr, status, error) {
                        var statusCode = xhr.status;
                        console.log(xhr)
                        switch (statusCode) {
                            case 401:
                                toastr.error(
                                    'phiên đăng nhập đã hết hạn xin hãy đăng nhập và thử lại',
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
                    url: "{{ route('brand.deleteBrand', ['id' => ':id']) }}".replace(':id', id),
                    type: 'DELETE',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        $('#confirmModal').modal('hide');
                        toastr.success('Xử lý thành công', 'Thông báo');
                        dataTable.destroy();
                        dataTable = $('#brandData').DataTable(dataTableConfig);

                    },
                    error: function(xhr, status, error) {
                        $('#confirmModal').modal('hide');
                        var errorMessage = xhr.responseJSON.message ||
                            'lỗi xảy ra hãy thử relaod lại trang'
                        toastr.error(errorMessage, 'Lỗi');

                    }
                });
            });
            // if (confirm("Bạn có chắc chắn muốn xóa?")) {
            //     $.ajax({
            //         url: "{{ route('brand.deleteBrand', ['id' => ':id']) }}".replace(':id', id),
            //         type: 'DELETE',
            //         beforeSend: function(xhr) {
            //             xhr.setRequestHeader("Authorization", "Bearer " + token);
            //         },
            //         success: function(response) {
            //             toastr.success('Xử lý thành công', 'Thông báo');
            //             dataTable.destroy();
            //             dataTable = $('#brandData').DataTable(dataTableConfig);
            //         },
            //         error: function(xhr, status, error) {
            //             var statusCode = xhr.status;
            //             switch (statusCode) {
            //                 case 401:
            //                     toastr.error('phiên đăng nhập đã hết hạn xin hãy đăng nhập và thử lại', 'Lỗi');
            //                     break;
            //                 case 403:
            //                     toastr.error('Bạn không có quyền thực hiện việc này', 'Lỗi');
            //                     break;
            //                 default:
            //                     toastr.error('Đã có lỗi xảy ra hãy reload trang và thử lại', 'Lỗi');
            //             }
            //         }
            //     });
            // }
        }

        function Export() {
            // Tạo dữ liệu Excel
            console.log(Exceldata)
            var data = Exceldata.map(obj => Object.values(obj));

            // Tạo workbook mới
            var workbook = XLSX.utils.book_new();
            var sheetData = XLSX.utils.aoa_to_sheet([
                ['id', 'thứ tự', 'tên', 'mô tả', 'content', 'ko biết', 'hahah', 'hình ảnh'], ...data
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
@endsection

<script src="{{ asset('assets/backend/js/xlsx-custom.js') }}"></script>
<script src="{{ asset('assets/backend/js/FileSaver.min.js') }}"></script>
