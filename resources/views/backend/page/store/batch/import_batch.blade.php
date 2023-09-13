@extends('backend.layout.layout')

@section('title')
    Thương hiệu
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
                <li class="breadcrumb-item"><a href="{{ route('batch') }}">Lô sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Import</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Import lô sản phẩm</a>
                    </li>
                </ul>
                @csrf
                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">
                            <div class="row">
                                <div class="col-12 col-lg-6">

                                    <div class="alert alert-info">
                                        Tải file mẫu
                                        <a href="{{ asset('excel_templates/AUCA_Import_Batch.xlsx') }}"
                                            download="">AUCA_Import_ProductBatch.xlsx</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <input type="hidden" name="storeId" id="storeId" disabled="disabled" value="45355">
                                    <div class="form-group mb-2 row">
                                        <label class="col-lg-4">File Excel:</label>
                                        <div class="col-lg-8">
                                            <input type="file" name="fileUpload" class="form-input-styled"
                                                id="fileUpload" accept=".xlsx, .xls">
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-2 row">
                                        <label class="col-lg-4">Kiểu import:</label>
                                        <div class="col-lg-8">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <span class="uniform-choice"><span class="checked"><input
                                                                checked="checked" type="radio" class="form-input-styled"
                                                                name="mode" value="add"></span></span>
                                                    Thêm mới thuộc tính
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <span class="uniform-choice"><span><input type="radio"
                                                                class="form-input-styled" name="mode"
                                                                value="update"></span></span>
                                                    Cập nhật thuộc tính
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-12 mb-3">
                            <button onclick="importExcel()" id="uploadForm" class="btn btnSave btn-success">
                                <i class="icon-lg pb-3px" data-feather="upload"></i>
                                Import
                            </button>
                        </div>
                        <div class="col-12 pageHelpInfo">
                            <p>
                                <i class="icon-lg text-warning pb-3px" data-feather="alert-triangle"></i>
                                Không chèn các kí tự đặc biệt (@,# ,$,/,-, ...) vào tên của file import
                            </p>
                        </div>
                    </div>
                </div>


                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">
                            <div class="row" id="Message">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection @section('script')
    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>
@endsection
<script>
    var token = localStorage.getItem("Token");

    function importExcel() {
        const fileInput = document.getElementById('fileUpload');
        const file = fileInput.files[0];
        $('#Message').empty();

        if (file == null) {
            toastr.error('Bạn chưa cung cấp file', 'Lỗi');
        } else {
            const reader = new FileReader();

            reader.onload = function(e) {
                var html = ``
                var errorCode = ``
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, {
                    type: 'array'
                });
                const worksheet = workbook.Sheets[workbook.SheetNames[0]];
                const jsonData = XLSX.utils.sheet_to_json(worksheet, {
                    header: 1
                });

                // console.log(jsonData); // Dữ liệu từ file Excel
                var count = 0
                var legnhtData = 0
                var isErr = false
                for (var i = 1; i < jsonData.length; i++) {
                    var row = jsonData[i];
                    if (row.length > 0) {
                        if (!row[5]) {
                            toastr.error('Bạn chưa nhập id sản phẩm ở dòng ' + i, 'Lỗi');
                            isErr = true
                            return
                        }
                    }
                }
                if (isErr) {
                    return
                }
                for (var i = 1; i < jsonData.length; i++) {
                    var row = jsonData[i];
                    if (row.length > 0) {
                        legnhtData++
                    }
                    if (row.length > 0) {
                        if (!row[0] || !row[3]) {
                            errorCode += `<p>Bạn cần nhập data mã và code của ngày sản xuất ở hàng ${i}</p>`
                        } else if (row[2]) {
                            if (row[2] !== 2 || row[2] !== 1 || row[2] !== '2' || row[2] !== '1') {
                                errorCode += `<p>Trang thái ở hàng ${i} chỉ có thể là 1 và 2</p>`
                            }
                        } else {
                            $.ajax({
                                url: "{{ route('batch_product.import') }}",
                                type: 'POST',
                                data: {
                                    bp_name: row[0],
                                    bp_price: row[1],
                                    prd_id: row[5],
                                    bp_status: row[2],
                                    bp_manufacture_date: formatDateToYYYYMMDD(row[3]),
                                    bp_expired_date: formatDateToYYYYMMDD(row[4]),
                                },
                                dataType: 'json',
                                beforeSend: function(xhr) {
                                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                                },
                                success: function(response) {

                                    toastr.success(`Thao tác ở dòng ${i} thành công`, 'thao tác');
                                },
                                error: function(xhr, status, error) {
                                    var statusCode = xhr.status;
                                    var data = xhr.responseJSON

                                    console.log(xhr)
                                    switch (statusCode) {
                                        case 401:
                                            toastr.error(
                                                'phiên đăng nhập đã hết hạn xin hãy đăng nhập và thử lại',
                                                'Lỗi');
                                            break;
                                        case 403:
                                            toastr.error('Bạn không có quyền thực hiện việc này',
                                                'Lỗi');
                                            break;
                                        case 404:
                                            toastr.error(`Id sản phẩm ${data.data.id} ko hợp lệ`,
                                                'Lỗi');
                                            break;
                                        case 405:
                                            toastr.error(`Sản phẩm có id ${data.data.id} ko phải loại nhập lô`,
                                                'Lỗi');
                                            break;
                                        case 422:
                                            toastr.error(
                                                '<p>Bạn cần nhập data name và code của thương hiệu ở hàng ${i}</p>',
                                                'Lỗi');
                                            break;
                                        default:
                                            toastr.error(
                                                'Đã có lỗi xảy ra hãy hiem53 tra lại file excel',
                                                'Lỗi');
                                    }

                                }
                            });
                        }

                    }

                }
                console.log(errorCode)
                if (html !== ``) {
                    $('#Message').append(html)
                } else if (errorCode !== ``) {
                    $('#Message').append(
                        `
                    <div class="col-12 col-lg-6">
                                    <div class="alert alert-primary" role="alert">
                                        Tổng số xử lý: <b>${legnhtData}</b>
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        Tổng số thành công : <b>${count}</b>
                                    </div>
                                    <div class="alert alert-danger" role="alert">
                                       ${errorCode}
                                    </div>
                    `)
                } else {
                    $('#Message').append(`
                            <div class="col-12 col-lg-6">
                                    <div class="alert alert-primary" role="alert">
                                        Tổng số xử lý: <b>${legnhtData}</b>
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        Tổng số thành công : <b>${count}</b>
                                    </div>
                            `)
                }
            };

            reader.readAsArrayBuffer(file);
        }

    }

    function formatDateToYYYYMMDD(serial) {
        if (serial) {
            var utc_days = Math.floor(serial - 25569);
            var utc_value = utc_days * 86400;
            var date_info = new Date(utc_value * 1000);

            var year = date_info.getFullYear();
            var month = String(date_info.getMonth() + 1).padStart(2, '0');
            var day = String(date_info.getDate()).padStart(2, '0');

            return year + '-' + month + '-' + day;

        } else {
            return ''
        }

    }
</script>
<script src="{{ asset('assets/backend/js/xlsx-custom.js') }}"></script>
<script src="{{ asset('assets/backend/js/FileSaver.min.js') }}"></script>
