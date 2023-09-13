@extends('backend.layout.layout')

@section('title')
    Danh mục vị trí
@endsection

@section('style')
    <style>
        .perfect-scrollbar-example {
            position: relative;
        }
        .hidden {
            display: none;
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
                <li class="breadcrumb-item active" aria-current="page">Danh mục vị trí</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <div class="card-body p-0 pt-2">

                    <!-- Start Filter content -->
                    <div class="filter">
                      <div class="row mb-3">
                          <div class="col-6 col-md-3 col-lg-1 pr-1">
                              <div class="form-group input-group mb-0 pt-3">
                                  <div class="col p-0">
                                      <input type="text" name="p_id" maxlength="255" placeholder="ID"
                                          id="p_id" class="form-control" value="">
                                  </div>
                              </div>
                          </div>
                          <div class="col-6 col-md-3 col-lg-2 pr-1">
                              <div class="form-group input-group mb-0 pt-3">
                                  <div class="col p-0">
                                      <select name="status" id="prd_id" class="form-control">
                                          <option value="">- Chọn kho hàng - </option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-6 col-md-3 col-lg-2 pr-1">
                              <div class="form-group input-group mb-0 pt-3">
                                  <div class="col p-0">
                                    <select name="level_filter"  class="form-control" id="level_filter">
                                      <option value="">- Chọn cấp danh mục - </option>
                                      <option value="1">- 1 - </option>
                                      <option value="2">- 2 - </option>
                                      <option value="3">- 3 - </option>
                                  </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-6 col-md-3 col-lg-2 pr-1 hidden" id="parent">
                            <div class="form-group input-group mb-0 pt-3">
                                <div class="col p-0">
                                  <select name="parent_filter"  class="form-control" id="parent_filter">
                                    <option value="">- Chọn cấp cha - </option>
                                </select>
                                </div>
                            </div>
                        </div>
                          <div class="col-6 col-md-3 col-lg-2 pr-1">
                              <div class="form-group input-group mb-0 pt-3">
                                  <div class="col p-0">
                                      <input type="text"  name="p_name" maxlength="255"
                                          placeholder="Tên" id="postionName" class="form-control"
                                          value="">
                                  </div>
                              </div>
                          </div>
                          <div class="col-1 pt-3">
                              <!-- Example split danger button -->
                              <div class="btn-group">
                                  <button type="button" name="submit-filter-variant-group"
                                      class="btn btn-success">Lọc</button>
         
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
                                        <a class="dropdown-item fs-5" href="{{ route('addCategoryLocation') }}">
                                            <i class="icon-lg pb-3px" data-feather="plus"></i>
                                            Thêm danh mục
                                        </a>
                                    </li>
                                    {{-- <li>
                      <a class="dropdown-item fs-5" href="{{ route('addLocation') }}">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                        Thêm nhanh vị trí
                      </a>
                    </li> --}}
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
                                    <li>
                                        <a class="dropdown-item fs-5" href="#">
                                            <i class="icon-lg pb-3px" data-feather="printer"></i>
                                            In mã vạch tất cả vị trí
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <!-- End filter content -->
                </div>
            </div>
        </div>

        <div class="mt-2 mx-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-body p-0 pt-2">
                        <h5 class="mb-3">Danh sách danh mục</h5>
                        <table id="dataPosition" class="table dataTable no-footer table-bordered"
                            aria-describedby="dataPosition_info">
                            <thead class="table-light">
                                <tr>
                                    <th class="sorting text-center text-black" tabindex="0"
                                        aria-controls="dataPosition" rowspan="1" colspan="1">
                                        Mã
                                    </th>
                                    <th class="sorting text-center text-black" tabindex="0"
                                        aria-controls="dataPosition" rowspan="1" colspan="1">
                                        Tên
                                    </th>
                                    <th class="sorting text-center text-black" tabindex="0"
                                    aria-controls="dataPosition" rowspan="1" colspan="1">
                                    Vị trí
                                    </th>
                                    <th class="sorting text-center text-black" tabindex="0"
                                        aria-controls="dataPosition" rowspan="1" colspan="1">
                                        Cấp Vị trí
                                    </th>
                                    <th class="sorting text-center text-black" tabindex="0"
                                        aria-controls="dataPosition" rowspan="1" colspan="1">
                                        Cấp cha
                                    </th>
                                    <th class="sorting text-center text-black" tabindex="0"
                                        aria-controls="dataPosition" rowspan="1" colspan="1">
                                        Kho hàng
                                    </th>
                                    <th class="sorting text-center text-black" tabindex="0"
                                        aria-controls="dataPosition" rowspan="1" colspan="1">
                                        <i class="icon-lg text-black pb-3px" data-feather="settings"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        123456678
                                    </td>
                                    <td class="text-center">
                                        tes1
                                    </td>
                                    <td class="text-center">
                                        1
                                    </td>
                                    <td class="text-center">
                                        kệ hàng
                                    </td>
                                    <td class="text-center">
                                        alibaba
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
                                                <a class="dropdown-item fs-5" href="#">
                                                    <i class="icon-lg pb-3px" data-feather="printer"></i>
                                                    In mã vạch vị trí
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
@endsection

@section('script')
    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>

    <script type="text/javascript">
        var token = localStorage.getItem("Token");
        var Exceldata = null
        var selectedValue = ''
        var wareHouse = ''
        var levelData= ''
        var parentId = ''
        function appendSelect() {
            $.ajax({
                url: "{{ route('warehouse.select') }}",
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                processData: false, // Không xử lý dữ liệu thành chuỗi query
                contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
                success: function(response) {
                    $("#prd_id").empty();
                    $("#prd_id").append(`<option value="">- Chọn kho hàng -</option>`);
                    response.data.forEach(item => {
                        $("#prd_id").append(
                            `<option value="${item.w_id}">- ${item.w_name}_${item.w_country_iso} </option>`
                        );
                    });
                }

            });
        }
        appendSelect()

        $("#prd_id").on('change', function() {
            var id = $(this).val();
            parent = 0
            wareHouse = id
            appendSelectParent()
        });
        $("#parent_filter").on('change', function() {
            var id = $(this).val();
            parent = 0
            parentId = id
        });
        function appendSelectParent() {
          if(levelData !== '' && wareHouse !== '') {
            $.ajax({
                    url: `../../api/v1/position-level?level=${levelData - 1}&warehouse=${wareHouse}`,
                    type: 'GET',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    processData: false, // Không xử lý dữ liệu thành chuỗi query
                    contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
                    success: function(response) {
                        console.log(response)
                        var returndata = response.data
                        if (returndata.length !== 0) {
                            $("#parent_filter").empty();
                            $("#parent_filter").append(`<option value="">- Chọn danh mục cấp cha -</option>`);
                            returndata.forEach(item => {
                                $("#parent_filter").append(
                                    `<option value="${item.id}">- ${item.name} -</option>`
                                );
                            });
                            $('#parent').removeClass('hidden');
                        } else {
                            $("#parent_filter").empty();
                            $("#parent_filter").append(
                                `<option value="">- Ko có danh mục cấp này tồn tại ở kho hàng này -</option>`
                            );
                            $('#parent').removeClass('hidden');
                        }
                    }
                })
          }
        }
        $("#level_filter").on('change', function() {
            var level = $(this).val();
            levelData = level
            if (level == 1) {
                parent = 0
                $("#parent_filter").empty();
                $('#parent').addClass('hidden');
            } else {
                  appendSelectParent()
            }
        });

        var dataTableConfig = {
            serverSide: true,
            scrollX: true,
            scrollY: "500px",
            autoHeight: false,
            ajax: {
                url: '{{ route('position-category.getAll') }}',
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
                    data.columns[0].searchable = true;
                    data.columns[0].search.value = $('input[name="p_id"]').val();
                    data.columns[1].searchable = true;
                    data.columns[1].search.value = $('input[name="p_name"]').val();
                    data.columns[3].search.value = levelData;
                    data.columns[4].search.value = parentId;
                    data.columns[5].search.value = wareHouse;
                },
                dataSrc: function(response) {
                    response.recordsTotal = response.data.total;
                    response.recordsFiltered = response.data.total;
                    Exceldata = response.data.data

                    return response.data.data;
                },
                error: function(xhr) {
                    if (xhr.status === 404) {
                        $('#dataPosition').html(
                            '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
                        );
                    }
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    searchable: true
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true
                },
                {
                    data: 'cate_positon',
                    name: 'cate_positon'
                },
                {
                    data: 'level',
                    name: 'level'
                },
                {
                    data: 'parent',
                    name: 'parent'
                },
                {
                    data: 'warehouse_name',
                    name: 'warehouse_id'
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
                            <i class="icon-lg pb-3px" data-feather="edit"></i>
                            Sửa
                          </a>
                        </li>
                          <li>
                            <a class="dropdown-item fs-5" href="#">
                              <i class="icon-lg pb-3px" data-feather="printer"></i>
                              In mã vạch vị trí
                            </a>
                          </li>
                        <li>
                          <a class="dropdown-item fs-5 text-danger" href="#">
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
            var dataTable = $('#dataPosition').DataTable();
            dataTable.column(0).search($('input[name="p_id"]').val()).draw();
            dataTable.column(1).search($('input[name="p_name"]').val()).draw();
            dataTable.column(4).search(parentId).draw();
            dataTable.column(3).search(levelData).draw();
            dataTable.column(5).search(wareHouse).draw();
        });

        var dataTable = $('#dataPosition').DataTable(dataTableConfig);
    </script>
@endsection
