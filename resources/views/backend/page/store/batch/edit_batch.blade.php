@extends('backend.layout.layout')

@section('title')
    Sửa lô sản phẩm
@endsection

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('batch') }}">Lô sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sửa lô sản phẩm</li>
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

                                <div class="mb-3">
                                    <label for="colFormLabel" class="form-label">Gía của lô</label>
                                    <input type="text" class="form-control" name="batch_price" id="colFormLabel"
                                        placeholder="Nhập giá của lô">
                                </div>
                                <div class="mb-3">
                                    <label for="colFormLabel" class="form-label">Sản phẩm</label>
                                    <input type="text" class="form-control" name="product" id="colFormLabel"
                                        placeholder="Nhập sản phẩm" disabled >
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Ngày sản xuất</label>
                                    <input type="date" name="toDate" placeholder="Đến"
                                        class=" form-control tbDatePicker col-6 form-control" maxlength="10"
                                        autocomplete="off" id="toDate" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ngày hết hạn</label>
                                    <input type="date" name="toExpired" placeholder="Đến"
                                        class=" form-control tbDatePicker col-6 form-control" maxlength="10"
                                        autocomplete="off" id="toExpried" value="">
                                </div>
                            </div>
                        </div>
                    
                </div>

                {{-- <div class="body-table">
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
                        <tbody>
                            <tr>
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
                            </tr>
                        </tbody>
                    </table>
                </div><br> --}}

                <div class="btn-submit">
                        <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
                </div>

            </div>
        </div>
    </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var token = localStorage.getItem("Token");
        // Lấy URL từ thanh địa chỉ
        var url = window.location.href;
        // Tìm vị trí của ký tự '/' cuối cùng trong URL
        var lastSlashIndex = url.lastIndexOf('/');
        // Lấy phần tử sau ký tự '/' cuối cùng để lấy ra ID
        var id = url.substring(lastSlashIndex + 1);

        function getData() {
            $.ajax({
                url: "{{ route('batch_product.show', ['id' => ':id']) }}".replace(':id', id),
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                success: function(response) {
                    // Tạo đối tượng Date từ chuỗi ngày
                    var dateObject = new Date(response.data.bp_manufacture_date);
                    // Lấy thông tin năm, tháng và ngày
                    var year = dateObject.getFullYear();
                    var month = String(dateObject.getMonth() + 1).padStart(2,
                    '0'); // Cộng thêm 1 vì tháng trong JavaScript bắt đầu từ 0
                    var day = String(dateObject.getDate()).padStart(2, '0');
                    // Tạo chuỗi theo định dạng yyyy-MM-dd
                    var formattedDate = year + '-' + month + '-' + day;
                    
                    var dateObject2 = new Date(response.data.bp_expired_date);
                    // Lấy thông tin năm, tháng và ngày
                    var year2 = dateObject2.getFullYear();
                    var month2 = String(dateObject2.getMonth() + 1).padStart(2,
                    '0'); // Cộng thêm 1 vì tháng trong JavaScript bắt đầu từ 0
                    var day2 = String(dateObject2.getDate()).padStart(2, '0');
                    // Tạo chuỗi theo định dạng yyyy-MM-dd
                    var formattedDate2 = year2 + '-' + month2 + '-' + day2;
                    $('input[name="batch_name"]').val(response.data.bp_name);
                    $('input[name="toDate"]').val(formattedDate);
                    $('input[name="batch_price"]').val(response.data.bp_price);
                    $('input[name="toExpired"]').val(formattedDate2);
                    $('input[name="product"]').val(response.data.prd_name);
                    
                    // $("#contBrand").val(response.data.brand_content);
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

        $('#batchForm').submit(function(event) {
            event.preventDefault();
            var name = $('input[name="batch_name"]').val();
            var date = $('input[name="toDate"]').val();
            var price = $('input[name="batch_price"]').val();
            var expired = $('input[name="toExpired"]').val();
            // var content = $('#contBrand').val();
            if (!name || !date || !price) {
                toastr.error('Bạn cần nhập nhập đầy đủ mã lô,giá lô và ngầy sản xuất', 'Thao tác');
            } else {
                var dateStamp = 0
                var expiredStamp = 0
                if (date) {
                    dateStamp = Date.parse(date);
                }
                if (expired) {
                    expiredStamp = Date.parse(expired);
                }
                var formData = new FormData(this);
                formData.append('bp_name', name);
                formData.append('bp_price', price);
                formData.append('bp_manufacture_date', date);
                formData.append('bp_expired_date', expired);
                $.ajax({
                    url: "{{ route('batch_product.update', ['id' => ':id']) }}".replace(':id',
                        id),
                    type: 'POST',
                    data: formData,
                    enctype: 'multipart/form-data',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    processData: false, // Không xử lý dữ liệu thành chuỗi query
                    contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
                    success: function(response) {
                        toastr.success('Cập nhập thành công', 'thao tác');
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
        getData()
    </script>
    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>
@endsection
