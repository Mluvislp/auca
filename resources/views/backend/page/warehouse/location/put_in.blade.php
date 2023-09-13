@extends('backend.layout.layout')

@section('title')
    Xếp sản phẩm vào vị trí
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
                <li class="breadcrumb-item"><a href="{{ route('location') }}">Vị trí sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Xếp sản phẩm vào vị trí</li>
            </ol>
        </nav>

        <form id="batchForm" method="post">
            @csrf
            <div class="row">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Thông tin</h6>
                            <form class="forms-sample" id="batchForm" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">Cửa hàng <span class="text-danger">*</span> </label>
                                    <select class="form-select mb-3" id="prd_id">
                                        <option selected="">- Cửa hàng -</option>

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="colFormLabel" class="form-label">Note <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="position_value" id="colFormLabel"
                                        placeholder="Vui lòng nhập">
                                </div>
                                <div class="mb-3">
                                    <label for="colFormLabel" class="form-label">Sản phẩm</label>
                                    <input type="search" class="form-control" placeholder="Vui lòng nhập" id="searchItem">
                                </div>

                                <div class="mb-3 hidden" id="parent">
                                    <label class="form-label">Vị trí <span class="text-danger">*</span></label>
                                    <select class="form-select mb-3" id="parent_select">
                                        <option selected="">- Danh mục -</option>

                                    </select>
                                </div>
                                <div class="mb-3 hidden" id="child1">
                                    <label class="form-label">Vị trí <span class="text-danger">*</span></label>
                                    <select class="form-select mb-3" id="child1_select">
                                        <option selected="">- Danh mục -</option>

                                    </select>
                                </div>
                                <div class="mb-3 hidden" id="child2">
                                    <label class="form-label">Vị trí <span class="text-danger">*</span></label>
                                    <select class="form-select mb-3" id="child2_select">
                                        <option selected="">- Danh mục -</option>

                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Sau khi lưu dữ liệu: </label>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="gender_radio" id="gender1">
                        <label class="form-check-label" for="gender1">
                            Tiếp tục thêm
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="gender_radio" id="gender2">
                        <label class="form-check-label" for="gender2">
                            Hiện danh sách
                        </label>
                    </div>
                </div>
            </div>

            <div class="btn-submit">

                <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>

            </div>
        </form>

        <div class="card">
            <div class="card-body">
                <div class="body-table">
                    <table id="dataTableExample" class="table dataTable no-footer table-bordered"
                        aria-describedby="dataTableExample_info">
                        <thead class="table-light">
                            <tr>
                                <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                                    rowspan="1" colspan="1">
                                    Vị trí
                                </th>
                                <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                                    rowspan="1" colspan="1">
                                    Mã sản phẩm
                                </th>
                                <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                                    rowspan="1" colspan="1">
                                    Mã vạch
                                </th>
                                <th class="sorting text-center text-black" tabindex="0"
                                    aria-controls="dataTableExample" rowspan="1" colspan="1">
                                    Tên sản phẩm
                                </th>
                                <th class="sorting text-center text-black" tabindex="0"
                                    aria-controls="dataTableExample" rowspan="1" colspan="1">
                                    Số lượng
                                </th>
                                <th class="sorting text-center text-black" tabindex="0"
                                    aria-controls="dataTableExample" rowspan="1" colspan="1">
                                    Xóa
                                </th>
                            </tr>
                        </thead>
                        <tbody id="TableCon">
                            <tr>
                                <td class="text-center">3</td>
                                <td class="text-start">
                                    <p>A02.A20.2A03</p>
                                </td>
                                <td class="text-center">
                                    <p>2000214247534</p>
                                </td>
                                <td class="text-center">
                                    <p>Combo 7 Ngày Miếng Dán Răng + 1 Kem Đánh Răng Muối Hồng - TẶNG 2 MIẾNG DÁN LẺ THAN
                                        TRE A20.A02.2A03</p>
                                </td>
                                <td class="text-center">
                                    <input type="number" max="99999" min="0" value="1"
                                        class="form-control" data-id="6">
                                </td>
                                <td class="text-center">
                                    <a class="dropdown-item fs-5 text-danger" href="#">
                                        <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><br>


            </div>
        </div>

    </div>
@endsection

@section('script')

    <script type="text/javascript">
        var token = localStorage.getItem("Token");
        var selectedValue = 1
        var wareHouse = 0
        var ArrayData = []
        var category = 0
        $('#searchItem').select2({
            placeholder: 'Tìm kiếm Sản Phẩm',
            minimumInputLength: 1, // Số ký tự tối thiểu để gửi yêu cầu AJAX
            ajax: {
                url: "{{ route('product.select2') }}", // URL API để tìm kiếm dữ liệu từ server
                dataType: 'json',
                delay: 250, // Độ trễ trước khi gửi yêu cầu AJAX (ms)
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                data: function(params) {
                    return {
                        search: params.term // Tham số tìm kiếm từ input
                    };
                },
                processResults: function(data) {
                    // Định dạng dữ liệu trả về để hiển thị trong Select2
                    console.log(data.data)
                    var data = data.data
                    var map = data.map(item => {
                        return {
                            id: item.prd_id,
                            text: item.prd_name
                        };
                    })
                    return {
                        results: map // data là một mảng chứa các tùy chọn
                    };
                },
                cache: true // Có lưu cache kết quả yêu cầu AJAX hay không (tùy chọn)
            }
        });

        $('#searchItem').on('select2:select', function(e) {
            var selectedOption = e.params.data;
            var id = selectedOption.id

            const foundObject = ArrayData.find(item => item.prd_id == id);
            if (foundObject) {
                toastr.error('product id ' + id + ' đã tồn tại trong table', 'Lỗi');
            } else {
                $.ajax({
                    url: "{{ route('product.selectShow', ['id' => ':id']) }}".replace(':id', id),
                    type: 'GET',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    processData: false, // Không xử lý dữ liệu thành chuỗi query
                    contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
                    success: function(response) {
                        if (response.data) {
                            ArrayData.push(response.data);
                        }
                        appendData()
                    }

                });
            }
        });

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
                    $("#prd_id").append(`<option value="">- Sản phẩm -</option>`);
                    response.data.forEach(item => {
                        $("#prd_id").append(
                            `<option value="${item.w_id}">- ${item.w_name}_${item.w_country_iso} </option>`
                        );
                    });
                }

            });
        }
        $("#prd_id").on('change', function() {
            var id = $(this).val();
            wareHouse = id
            $.ajax({
                url: `../../api/v1/position-level?level=1&warehouse=${wareHouse}`,
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
                        $("#parent_select").append(`<option value="">- Chọn vị trí cấp 1 -</option>`);
                        returndata.forEach(item => {
                            $("#parent_select").append(
                                `<option value="${item.id}">- ${item.name} -</option>`
                            );
                        });
                        $('#parent').removeClass('hidden');
                    } else {
                        $("#parent_select").empty();
                        $("#parent_select").append(
                            `<option value="">- Ko có danh mục vị trí cấp này tồn tại ở kho hàng này -</option>`
                        );
                        $('#parent').removeClass('hidden');
                    }
                }
            });
        });

        $("#parent_select").on('change', function() {
            var id = $(this).val();
            category = id
            $.ajax({
                url: `../../api/v1/position-parent?parent=${category}`,
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
                        $("#child1_select").empty();
                        $("#child1_select").append(`<option value="">- Chọn vị trí cấp 2 -</option>`);
                        returndata.forEach(item => {
                            $("#child1_select").append(
                                `<option value="${item.id}">- ${item.name} -</option>`
                            );
                        });
                        $('#child1').removeClass('hidden');
                    } else {
                        $("#child1_select").empty();
                        $("#child1_select").append(
                            `<option value="">- Ko có danh mục vị trí cấp này tồn tại ở kho hàng này -</option>`
                        );
                        $('#child1').removeClass('hidden');
                    }
                }
            });
        });
        $("#child1_select").on('change', function() {
            var id = $(this).val();
            category = id
            $.ajax({
                url: `../../api/v1/position-parent?parent=${category}`,
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
                        $("#child2_select").empty();
                        $("#child2_select").append(`<option value="">- Chọn vị trí cấp 2 -</option>`);
                        returndata.forEach(item => {
                            $("#child2_select").append(
                                `<option value="${item.id}">- ${item.name} -</option>`
                            );
                        });
                        $('#child2').removeClass('hidden');
                    } else {
                        $("#child2_select").empty();
                        $("#child2_select").append(
                            `<option value="">- Ko có danh mục vị trí cấp này tồn tại ở kho hàng này -</option>`
                        );
                        $('#child2').removeClass('hidden');
                    }
                }
            });
        });
        $("#child2_select").on('change', function() {
            var id = $(this).val();
            category = id
        });
        appendSelect()

        function appendData() {
            var html = ''
            $("#TableCon").empty();
            if (ArrayData !== []) {

                ArrayData.forEach((item, index) => {
                    html += `<tr>`
                    html +=
                        `
                                <td class="text-center">
                                    ${item.prd_id}
                                </td>
                                <td class="text-center">
                                    ${item.prd_code}

                                </td>
                                <td class="text-center">
                                    ${item.prd_name}
                                </td>
                                <td class="text-center">
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="number"name="Quan_${item.prd_id}" max="99999" min="1" value="1" class="form-control"
                                        data-id="6">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button onclick = "deleteValue (${index})" >Xóa</button>
                                </td>
                `
                    html += `</tr>`
                });

                $("#TableCon").append(html)
            }
        }
        appendData()

        function deleteValue(index) {
            console.log(index)
            if (index >= 0 && index < ArrayData.length) {
                ArrayData.splice(index, 1);
                appendData()
            }
        }
        $('#batchForm').submit(function(event) {
            event.preventDefault();
            var value = $('input[name="position_value"]').val();
            var hasInvalidData = false;
            // var content = $('#contBrand').val();
            if (wareHouse == 0) {
                toastr.error('Bạn chưa chọn cửa hàng', 'Thao tác');
                return
            }
            if (ArrayData.length == 0) {
                toastr.error('Bạn cần nhập nhập sản phẩm', 'Thao tác');
                return
            }
            if(category == 0) {
                toastr.error('Bạn chưa chọn vị trí cho sản phẩm', 'Thao tác');
                return
            }
            ArrayData.forEach((item, index) => {
                var number = $(`input[name="Quan_${item.prd_id}"]`).val();
                if (!number || number <= 0) {
                    toastr.error(
                        `Data ở dòng  ${index + 1} kohng6 được là 0`,
                        'Thao tác');
                    hasInvalidData = true;
                }
            })

            if (hasInvalidData) {
                return
            }
            ArrayData.forEach((item, index) => {
                var prd_id = item.prd_id
                var warehouse_id = item.prd_id
                var type = 1
                var number = $(`input[name="Quan_${item.prd_id}"]`).val();
                $.ajax({
                    url: "{{ route('product-position.create') }}",
                    type: 'POST',
                    data: {
                        position_value: value,
                        prd_id: prd_id,
                        warehouse_id: wareHouse,
                        postion_type: type,
                        quantity: number,
                        category:category,
                    },
                    dataType: 'json',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization",
                            "Bearer " + token);
                    },
                    success: function(response) {
                        toastr.success('Xử lý data dòng ' + index +
                            ' thành công', 'thao tác');
                    },
                    error: function(xhr, status, error) {
                        var statusCode = xhr.status;
                        toastr.error(
                            `đã có lỗi xảy ra ở dòng ${index + 1 },hãy chắc chắn ràng bạn nhập đầy đủ giá,ngày sản xuất và ngày hết hạn`,
                            'Thao tác');

                    }
                });
            })

        });
    </script>

    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>
    
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
