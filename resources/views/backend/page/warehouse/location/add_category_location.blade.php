@extends('backend.layout.layout')

@section('title')
    Thêm danh mục vị trí trong kho
@endsection

@section('content')
    <style>
        .hidden {
            display: none;
        }
    </style>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categoryLocation') }}">Danh mục trí trong kho</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm danh mục vị trí trong kho</li>
            </ol>
        </nav>
        <form method="post" id="batchForm">
            @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Thông tin</h6>
                            <form class="forms-sample">
                                <div class="mb-3">
                                    <label class="form-label">Kho hàng <span class="text-danger">*</span> </label>
                                    <select class="form-select mb-3" id="prd_id">
                                        <option selected="">- Chọn kho hàng -</option>

                                    </select>
                                </div>

                                <div class="mb-3 hidden" id="level">
                                    <label class="form-label">Cấp của danh mục</label>
                                    <select class="form-select mb-3" id="level_select">
                                        <option selected="">- Danh mục -</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="mb-3 hidden" id="parent">
                                    <label class="form-label">Danh mục cấp cha</label>
                                    <select class="form-select mb-3" id="parent_select">
                                        <option selected="">- Danh mục -</option>

                                    </select>
                                </div>

                                <div class="btn-submit">

                                    <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>

                                </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card w-100 p-0">
                        <div class="card-body">
                            <h6 class="card-title">Danh mục</h6>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Tên danh mục <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="name" id="colFormLabel"
                                    placeholder="Vui lòng nhập">
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Mã danh mục <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="colFormLabel" placeholder="Vui lòng nhập">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var token = localStorage.getItem("Token");
        var selectedValue = 1
        var wareHouse = 0
        var parent = 0
        var ArrayData = []
        var levelData = 0

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
            $('#level').removeClass('hidden');
            parent = 0
            $("#parent_select").empty();
            $('#parent').addClass('hidden');
            wareHouse = id
        });

        $("#level_select").on('change', function() {
            var level = $(this).val();
            levelData = level
            if (level == 1) {
                parent = 0
                $("#parent_select").empty();
                $('#parent').addClass('hidden');
            } else {
                $.ajax({
                    url: `../../api/v1/position-level?level=${level - 1}&warehouse=${wareHouse}`,
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
                            $("#parent_select").empty();
                            $("#parent_select").append(`<option value="">- Chọn danh mục -</option>`);
                            returndata.forEach(item => {
                                $("#parent_select").append(
                                    `<option value="${item.id}">- ${item.name} -</option>`
                                );
                            });
                            $('#parent').removeClass('hidden');
                        } else {
                            $("#parent_select").empty();
                            $("#parent_select").append(
                                `<option value="">- Ko có danh mục cấp này tồn tại ở kho hàng này -</option>`
                            );
                            $('#parent').removeClass('hidden');
                        }
                    }
                });
            }
        });
        $("#parent_select").on('change', function() {
            var id = $(this).val();
            parent = id
            console.log(parent)
        });

        $('#batchForm').submit(function(event) {
            event.preventDefault();
            var name = $('input[name="name"]').val();
            if (!name) {
                toastr.error('Bạn chưa nhập tên danh mục', 'Thao tác');
                return
            }
            console.log(levelData)

            if (levelData != 1 && parent == 0) {
                toastr.error('Bạn chưa nhập danh mục cấp cha', 'Thao tác');
                return
            }
            $.ajax({
                url: "{{ route('position-category.create') }}",
                type: 'POST',
                data: {
                    name: name,
                    level: levelData,
                    warehouse_id: wareHouse,
                    parent: parent,
                },
                dataType: 'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                success: function(response) {
                    toastr.success('Thao tác thành công', 'thao tác');
                },
                error: function(xhr, status, error) {
                    var statusCode = xhr.status;
                    toastr.error(
                        `đã có lỗi xảy ra ở dòng ,hãy chắc chắn ràng bạn nhập đầy đủ các trường yêu cầu`,
                        'Thao tác');

                }
            });


        });
    </script>
    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>
@endsection
