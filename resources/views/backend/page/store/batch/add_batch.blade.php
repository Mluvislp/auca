@extends('backend.layout.layout')

@section('title')
    Thêm mới lô sản phẩm
@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Thêm thẻ script để load JavaScript của Select2 -->

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('batch') }}">Lô sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới lô sản phẩm</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <div class="box-heading">
                    <h6 class="card-title">Thông tin</h6>
                    <form class="forms-sample" id="batchForm" enctype="multipart/form-data">
                        <div class="row row-cols-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="colFormLabel" class="form-label">Số lô</label>
                                    <input type="text" class="form-control" name="batch_name" id="colFormLabel"
                                        placeholder="VD: L0001">
                                </div>

                                {{-- <div class="mb-3">
                                    <label for="colFormLabel" class="form-label">Sản phẩm</label>
                                    <select name="cat_id" id="prd_id" class="form-select"
                                        data-placeholder="Chọn một danh mục">
                                        <option value="">- Sản phẩm -</option>
                                    </select>
                                </div> --}}
                                <div class="mb-3">
                                    <label for="colFormLabel" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="searchItem" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select class="form-select mb-3" id="status">
                                        <option selected="">- Trạng thái -</option>
                                        <option value="1">Hiện</option>
                                        <option value="2">Ẩn</option>
                                    </select>
                                </div>
                            </div>


                        </div>

                </div>

                <div class="body-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-start" scope="col">Mã SP</th>
                                <th class="text-start" scope="col">Tên SP</th>
                                <th class="text-start" scope="col">Giá nhập</th>
                                <th class="text-start" scope="col">Ngày sản xuất</th>
                                <th class="text-start" scope="col">Ngày hết hạn</th>
                                <th scope="col">
                                    <i class="icon-lg pb-3px" data-feather="settings"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="TableCon">
                            {{-- <tr>
                                <th class="text-left">A02.A05.5A10</th>
                                <td class="text-left">
                                    Liệu trình hộp 7 ngày than tre + kem đánh răng than tre tặng 5 gói súc miệng
                                </td>
                                <td class="text-center">
                                    <input type="number" placeholder="Giá nhập" max="99999" min="0"
                                        class="form-control" data-id="6">
                                </td>
                                <td class="text-center">
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="text" class="form-control flatpickr-input"
                                            placeholder="Ngày sản xuất" data-input="" readonly="readonly">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="text" class="form-control flatpickr-input"
                                            placeholder="Ngày hết hạn" data-input="" readonly="readonly">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="#">
                                        <i class="icon-lg pb-3px text-danger" data-feather="trash"></i>
                                    </a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div><br>

                <div class="btn-submit">
                    <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
                </div>

            </div>
        </div>
        </form>
    </div>
@endsection



@section('script')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/toastr.min.css') }}">
    <script type="text/javascript">
        var token = localStorage.getItem("Token");
        var selectedValue = 1
        var ArrayData = []
        $('#status').on('change', function() {
            selectedValue = $(this).val();
        });
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
                    var map =  data.map(item => {
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
                        appendSelect()
                        if (response.data) {
                            if (response.data.prd_type_id == 8 && response.data.prd_type_id == '8') {
                                ArrayData.push(response.data);
                            } else {
                                toastr.error(
                                    `Sản phẩm này ko phải là loại nhập lô`,
                                    'Thao tác');
                            }
                        }
                        appendData()
                    }

                });
            }
        });
        // $("#prd_id").on('change', function() {
        //     var id = $(this).val();
        //     const foundObject = ArrayData.find(item => item.prd_id == id);
        //     if (foundObject) {
        //         toastr.error('product id ' + id + ' đã tồn tại trong table', 'Lỗi');
        //     } else {
        //         $.ajax({
        //             url: "{{ route('product.selectShow', ['id' => ':id']) }}".replace(':id', id),
        //             type: 'GET',
        //             beforeSend: function(xhr) {
        //                 xhr.setRequestHeader("Authorization", "Bearer " + token);
        //             },
        //             processData: false, // Không xử lý dữ liệu thành chuỗi query
        //             contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
        //             success: function(response) {
        //                 appendSelect()
        //                 if (response.data) {
        //                     if (response.data.prd_type_id == 8 && response.data.prd_type_id == '8') {
        //                         ArrayData.push(response.data);
        //                     } else {
        //                         toastr.error(
        //                             `Sản phẩm này ko phải là loại nhập lô`,
        //                             'Thao tác');
        //                     }
        //                 }
        //                 appendData()
        //             }

        //         });
        //     }


        // });


        function appendSelect() {
            $.ajax({
                url: "{{ route('product.selectAll') }}",
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
                            `<option value="${item.prd_id}">- ${item.prd_name}_${item.prd_code} -</option>`
                        );
                    });
                }

            });
        }
        appendSelect()

        function appendData() {
            var html = ''
            $("#TableCon").empty();
            if (ArrayData !== []) {

                ArrayData.forEach((item, index) => {
                    html += `<tr>`
                    html +=
                        `
                <th class="text-left">${item.prd_name}</th>
                                <td class="text-center">
                                    <input type="number" placeholder="Giá nhập" name="batch_price_${item.prd_id}" max="99999" min="0"
                                        class="form-control" data-id="6">
                                </td>
                                <td class="text-center">
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                            <input type="date" name="toDate_${item.prd_id}" placeholder="Đến"
                                        class=" form-control tbDatePicker col-6 form-control" maxlength="10"
                                        autocomplete="off" id="toDate" value="">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                            <input type="date" name="toExpired_${item.prd_id}" placeholder="Đến"
                                        class=" form-control tbDatePicker col-6 form-control" maxlength="10"
                                        autocomplete="off" id="toDate" value="">
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

        function deleteValue(index) {
            console.log(index)
            if (index >= 0 && index < ArrayData.length) {
                ArrayData.splice(index, 1);
                appendData()
            }
        }
        $('#batchForm').submit(function(event) {
            event.preventDefault();
            var name = $('input[name="batch_name"]').val();
            var hasInvalidData = false;
            // var content = $('#contBrand').val();
            if (ArrayData.length == 0) {
                toastr.error('Bạn cần nhập nhập sản phẩm', 'Thao tác');
                return
            }
            ArrayData.forEach((item, index) => {
                var date = $(`input[name="toDate_${item.prd_id}"]`).val();
                var price = $(`input[name="batch_price_${item.prd_id}"]`).val();
                var expired = $(`input[name="toExpired_${item.prd_id}"]`).val();
                if (!date || !price || !expired) {
                    toastr.error(
                        `Bạn chưa nhập đầy đủ ở dòng ${index + 1},hãy chắc chắn ràng bạn nhập đầy đủ giá,ngày sản xuất và ngày hết hạn`,
                        'Thao tác');
                    hasInvalidData = true;
                }
            })

            if (!name) {
                toastr.error('Bạn cần nhập nhập đầy đủ mã lô,giá lô và ngầy sản xuất', 'Thao tác');
            } else {
                if (hasInvalidData) {
                    return;
                }
                var formData = new FormData(this);
                formData.append('bp_name', name);
                formData.append('bp_status', selectedValue);
                $.ajax({
                    url: "{{ route('batch.add') }}",
                    type: 'POST',
                    data: formData,
                    enctype: 'multipart/form-data',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    processData: false, // Không xử lý dữ liệu thành chuỗi query
                    contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
                    success: function(response) {
                        var idBatch = response.data.id
                        $('input[name="batch_name"]').val('');
                        ArrayData.forEach((item, index) => {
                            var date = $(`input[name="toDate_${item.prd_id}"]`).val();
                            var price = $(`input[name="batch_price_${item.prd_id}"]`).val();
                            var expired = $(`input[name="toExpired_${item.prd_id}"]`).val();
                            console.log(expired)
                            $.ajax({
                                url: "{{ route('batch_product.add') }}",
                                type: 'POST',
                                data: {
                                    bp_name: name,
                                    bp_price: price,
                                    bp_status: selectedValue,
                                    batch_id: idBatch,
                                    prd_id: item.prd_id,
                                    bp_manufacture_date: date,
                                    bp_expired_date: expired,
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
                        ArrayData = []
                        toastr.success('Tạo thành công', 'thao tác');
                        appendData()
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
            }
        });
    </script>

    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>
@endsection
<!-- Đầu tiên, đảm bảo thư viện jQuery đã được tải -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Tiếp theo, tải thư viện Select2 sau khi đã tải jQuery -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script
