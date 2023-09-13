@extends('backend.layout.layout')

@section('title')
    Thêm phiếu chuyển kho
@endsection

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('transfer') }}">Chuyển kho</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm phiếu chuyển kho</li>
            </ol>
        </nav>
        <form action="{{ route('suppliers.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Thông tin</h6>
                            <form class="forms-sample" id="submit">

                                <div class="form-group mb-2">
                                    <div class="row">
                                        <label class="col-5 col-lg-3 col-form-label">Từ kho<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-7 col-lg-9 d-flex align-items-center">
                                            <select class="form-select mb-3" id="prd_id">
                                                <option selected="">- Kho hàng -</option>
                                                <option value="1">shangyang123</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <div class="row">
                                        <label class="col-5 col-lg-3 col-form-label">Đến kho<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-7 col-lg-9 d-flex align-items-center">
                                            <select class="form-select mb-3" id="prd_id2">
                                                <option selected="">- Kho hàng -</option>
                                                <option value="1">shangyang123</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <div class="row">
                                        <label class="col-5 col-lg-3 col-form-label">Nhãn</label>
                                        <div class="col-7 col-lg-9 d-flex align-items-center">
                                            <div class="input-group">
                                                <select name="cat_id" id="cat_id" class="form-select"
                                                    data-placeholder="Chọn một danh mục">
                                                    <option value="">- Chọn nhãn -</option>
                                                </select>
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <a id="btn-create-category" style="cursor: pointer">
                                                        <i class="icon-lg pb-3px text-success" data-feather="plus"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card w-100 p-0">
                        <div class="card-body">
                            <h6 class="card-title">Thanh toán</h6>

                            <div class="form-group mb-2">
                                <div class="row">
                                    <label class="col-5 col-lg-3 col-form-label">Ghi chú</label>
                                    <div class="col-7 col-lg-9 d-flex align-items-center">
                                        <textarea class="form-control" id="Notes" name="sup_note" cols="30" rows="10" placeholder="Vui lòng nhập">{{ old('sup_note') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <div class="row">
                                    <label class="col-5 col-lg-3 col-form-label">File đính kèm</label>
                                    <div class="col-7 col-lg-9">
                                        <div class="media mt-0">
                                            <input type="hidden" name="pd_image" class="imageUploadFile" id="pd_image"
                                                value="">
                                            <div class="media-body">
                                                <div class="uniform-uploader" id="uniform-imageUpload">
                                                    <input class="form-control businessFileUpload" name="imageUpload"
                                                        type="file" accept="image/*" id="imageUpload" data-url="">
                                                    <span class="form-text text-muted">File: gif, png, jpg, bmp (Tối đa
                                                        4MB)</span>
                                                </div>
                                            </div>
                                            <div class="imageArea col-3 align-self-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>

        <div>
            <div class="card p-3">
                <div class="card-body p-0 pt-2">
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Sản phẩm</button>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="#">Nhập theo ri</a></li>
                        </ul>
                        {{-- <input type="text" class="form-control" aria-label="Text input with dropdown button">
                    // --}}
                        <select class="form-control" id="product_list">
                            <option selected="">- Mời bạn chọn từ kho hàng -</option>
                            <option value="1">shangyang123</option>
                        </select>
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <a href="#">
                                    <i class="icon-lg pb-3px text-success" data-feather="plus"></i>
                                </a>
                            </span>
                        </div>
                        <div class="btn-group dgColumnSelectors ml-1">
                            <button type="button" class="dropdown-toggle btn btn-sm show" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-columns icon-lg pb-3px">
                                    <path
                                        d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18">
                                    </path>
                                </svg>
                            </button>
                            <div role="menu"
                                class="dropdown-menu dropdown-menu-right dropdown-content wmin-lg-600 wmin-350 userDgConfig"
                                data-columndisplaysetting="101" x-placement="bottom-end"
                                style="will-change: transform; position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                <div class="dropdown-content-body pb-2">
                                    <div class="row">
                                        <div class="dropdown-item">
                                            <label class="d-flex align-items-center gap-2 mb-0">
                                                <input type="checkbox" name="id" value="id"
                                                    class="dgColumn mr-1" data-colspan="colSumary" data-class="dgColId">
                                                Lô hàng
                                            </label>
                                        </div>
                                        <div class="dropdown-item">
                                            <label class="d-flex align-items-center gap-2 mb-0">
                                                <input type="checkbox" name="id" value="id"
                                                    class="dgColumn mr-1" data-colspan="colSumary" data-class="dgColId">
                                                IMEI
                                            </label>
                                        </div>
                                        <div class="dropdown-item">
                                            <label class="d-flex align-items-center gap-2 mb-0">
                                                <input type="checkbox" name="id" value="id"
                                                    class="dgColumn mr-1" data-colspan="colSumary" data-class="dgColId">
                                                Đơn vị tính
                                            </label>
                                        </div>
                                        <div class="dropdown-item">
                                            <label class="d-flex align-items-center gap-2 mb-0">
                                                <input type="checkbox" name="id" value="id"
                                                    class="dgColumn mr-1" data-colspan="colSumary" data-class="dgColId">
                                                Mã sản phẩm
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive overflow-hidden">
                        <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer ">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="dataTableExampleHero" class="table dataTable no-footer table-bordered"
                                        aria-describedby="dataTableExample_info">
                                        <thead>
                                            <tr>
                                                <th class="sorting sorting_asc" tabindex="0"
                                                    aria-controls="dataTableExample" rowspan="1" colspan="1"
                                                    aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Mã vạch SP</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending">Mã SP</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending">Tên SP</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending">ĐVT</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending">IMEI</th>
                                                <th class="sorting pb-0 pt-0 text-center" tabindex="0"
                                                    aria-controls="dataTableExampleHero" rowspan="1" colspan="1"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Copy số lượng duyệt sang ô số lượng">
                                                    Có thể chuyển
                                                    <a href="#">
                                                        <i class="icon-lg pb-3px text-danger my-2"
                                                            data-feather="skip-forward"></i>
                                                    </a>
                                                </th>
                                                <th class="sorting pt-2 pb-1 text-center" tabindex="0"
                                                    aria-controls="dataTableExampleHero" rowspan="1" colspan="1"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Điền số lượng và click mũi tên để thay đổi số lượng cho tất cả các dòng bên dưới">
                                                    <div class="d-flex">
                                                        <input type="text" class="form-control w-auto"
                                                            id="exampleInputUsername1" autocomplete="off"
                                                            placeholder="SL">
                                                        <a href="#">
                                                            <i class="icon-lg pb-3px text-blue my-2"
                                                                data-feather="arrow-down"></i>
                                                        </a>
                                                    </div>
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTableExample"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending">Lỗi
                                                    <span>(0)</span>
                                                </th>
                                                <th class="sorting text-black text-center" tabindex="0"
                                                    aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                                    <div>
                                                        <span class="dropdown-toggle cursor-pointer"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="icon-lg pb-3px" data-feather="settings"></i>
                                                        </span>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item fs-6 text-start" href="#">
                                                                    <i class="icon-lg pb-3px"
                                                                        data-feather="message-square"></i>
                                                                    Hiện ô nhập ghi chú cho tất cả sản phẩm
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="TableCon">
                                            {{-- <tr>
                                                <td class="text-center">
                                                    <p>
                                                        2000208406152
                                                    </p>
                                                </td>
                                                <td class="text-start">
                                                    <p>
                                                        A02.A05.5A10
                                                    </p>
                                                </td>
                                                <td class="text-start">
                                                    Liệu trình hộp 7 ngày than tre + kem đánh răng than tre tặng 5 gói súc
                                                    miệng
                                                </td>
                                                <td class="text-end">Null</td>
                                                <td class="text-end">Null</td>
                                                <td class="text-end">
                                                    <p>
                                                        CTB: <span class="text-success">498</span>
                                                    </p>
                                                </td>
                                                <td class="text-end">
                                                    <input type="number" max="99999" min="0" value="1"
                                                        class="form-control" data-id="6">
                                                </td>
                                                <td class="text-end">
                                                    <input type="number" max="99999" min="0" value="0"
                                                        class="form-control" data-id="6">
                                                </td>
                                                <td class="text-center">
                                                    <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="icon-lg pb-3px" data-feather="menu"></i>
                                                    </span>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item fs-6 text-start" href="#">
                                                                <i class="icon-lg pb-3px"
                                                                    data-feather="message-square"></i>
                                                                Hiện ô nhập ghi chú
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item fs-6 text-start text-danger"
                                                                href="#">
                                                                <i class="icon-lg text-danger pb-3px"
                                                                    data-feather="trash-2"></i>
                                                                Xóa sản phẩm
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr> --}}

                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card p-3 mt-3">

                <div class="mb-3 d-flex">
                    <b>Sau khi lưu dữ liệu: </b>
                    <div class="form-group mb-2">
                        <div class="col-lg-8">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <span class="uniform-choice">
                                        <span class="checked">
                                            <input value="afterSubmit-2" type="radio" class="form-check-input-styled"
                                                name="afterSubmit" checked="checked" data-fouc="" selected="selected">
                                        </span>
                                    </span>
                                    Xem chi tiết phiếu chuyển kho
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <span class="uniform-choice">
                                        <span class="">
                                            <input value="afterSubmit-1" type="radio" class="form-check-input-styled"
                                                name="afterSubmit" data-fouc="" selected="selected">
                                        </span>
                                    </span>
                                    Tiếp tục lập phiếu chuyển kho
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 d-flex align-items-center gap-2">
                    <div>
                        <button type="button" id="SaveData" class="btn btn-success btn-sm" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Lưu thay đổi
                        </button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Lưu và in
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var token = localStorage.getItem("Token");
        var ware_to = 0
        var ware_from = 0
        var ArrayData = []

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
                    if (ware_to == 0 || ware_to == ware_from) {
                        $("#prd_id").empty();
                        $("#prd_id").append(`<option value="">- Chọn kho hàng -</option>`);
                        response.data.forEach(item => {
                            $("#prd_id").append(
                                `<option value="${item.w_id}">- ${item.w_name}_${item.w_country_iso} </option>`
                            );
                        });
                    }
                    if (ware_from == 0 || ware_to == ware_from) {
                        $("#prd_id2").empty();
                        $("#prd_id2").append(`<option value="">- Chọn kho hàng -</option>`);
                        response.data.forEach(item => {
                            $("#prd_id2").append(
                                `<option value="${item.w_id}">- ${item.w_name}_${item.w_country_iso} </option>`
                            );
                        });
                    }
                }

            });
        }
        appendSelect()
        $("#prd_id").on('change', function() {
            var id = $(this).val();
            if (ware_to !== 0) {
                if (ware_to == id) {
                    toastr.error('Kho đến và kho đi không được bằng nhau', 'Thao tác');
                    appendSelect()
                    return
                }
            }
            appendSelectProduct(id)
            ware_from = id
            
        });
        $("#prd_id2").on('change', function() {
            var id = $(this).val();
            if (ware_from !== 0) {
                if (ware_from == id) {
                    toastr.error('Kho đến và kho đi không được bằng nhau', 'Thao tác');
                    appendSelect()
                    return
                }
            }
            ware_to = id
        });

        function appendSelectProduct(id) {
            $.ajax({
                url: "{{ route('transfer-ware.warehouse', ['id' => ':id']) }}".replace(':id', id),
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                processData: false, // Không xử lý dữ liệu thành chuỗi query
                contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
                success: function(response) {

                    data = response.data
                    if (data.length !== 0) {
                        $("#product_list").empty();
                        $("#product_list").append(`<option value="">- Mời bạn chọn sản phẩm -</option>`);
                        data.forEach(item => {
                            $("#product_list").append(
                                `<option value="${item.wp_id}">- ${item.get_ware_product.prd_code}------>${item.get_ware_product.prd_name} </option>`
                            );
                        });
                    }

                }

            });
        }

        $("#product_list").on('change', function() {
            var id = $(this).val();
            const foundObject = ArrayData.find(item => item.wp_id == id);
            if (foundObject) {
                toastr.error('product id ' + id + ' đã tồn tại trong table', 'Lỗi');
            } else {
                $.ajax({
                    url: "{{ route('transfer-ware.showware', ['id' => ':id']) }}".replace(':id', id),
                    type: 'GET',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    processData: false, // Không xử lý dữ liệu thành chuỗi query
                    contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
                    success: function(response) {
                        appendSelectProduct(ware_to)
                        if (response.data) {
                            ArrayData.push(response.data);
                        }
                        console.log(ArrayData)
                        appendDataProduct()
                    }

                });
            }
        });

        function appendDataProduct() {
            var html = ''
            $("#TableCon").empty();
            if (ArrayData !== []) {
                ArrayData.forEach((item, index) => {
                    html += `<tr>`
                    html +=
                        `
                        <td class="text-center">
                                                    <p>
                                                        ${item.get_ware_product.prd_barcode}
                                                    </p>
                                                </td>
                                                <td class="text-start">
                                                    <p>
                                                        ${item.get_ware_product.prd_code}
                                                    </p>
                                                </td>
                                                <td class="text-start">
                                                    ${item.get_ware_product.prd_name}
                                                </td>
                                                <td class="text-end">Null</td>
                                                <td class="text-end">Null</td>
                                                <td class="text-end">
                                                    <p>
                                                        CTB: <span class="text-success">${item.wp_quantity}</span>
                                                    </p>
                                                </td>
                                                <td class="text-end">
                                                    <input type="number" name="quantity_${item.wp_id}" max="99999" min="1" value="1"
                                                        class="form-control" data-id="6">
                                                </td>
                                                <td class="text-end">
                                                    <input type="number" name="error_${item.wp_id}" max="99999" min="0" value="0"
                                                        class="form-control" data-id="6">
                                                </td>
                                                <td class="text-center">
                                                    <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="icon-lg pb-3px" data-feather="menu"></i>
                                                    </span>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item fs-6 text-start" href="#">
                                                                <i class="icon-lg pb-3px"
                                                                    data-feather="message-square"></i>
                                                                Hiện ô nhập ghi chú
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item fs-6 text-start text-danger"
                                                            onclick = "deleteValue (${index})" >
                                                                <i class="icon-lg text-danger pb-3px"
                                                                    data-feather="trash-2"></i>
                                                                Xóa sản phẩm
                                                            </a>
                                                        </li>
                                                    </ul>
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
                appendDataProduct()
            }
        }

        $('#SaveData').click(function() {
            if (ArrayData.length == 0) {
                toastr.error('Bạn cần nhập nhập sản phẩm', 'Thao tác');
                return
            }
            var hasInvalidData = false;
            ArrayData.forEach((item, index) => {
                var quantity = $(`input[name="quantity_${item.wp_id}"]`).val();
                var error = $(`input[name="error_${item.wp_id}"]`).val();
                if (!quantity) {
                    toastr.error(
                        `Bạn chưa nhập đầy đủ ở dòng ${index + 1},hãy chắc chắn ràng bạn nhập đầy đủ số lượng`,
                        'Thao tác');
                    hasInvalidData = true;
                }

                if (quantity <= 0) {
                    toastr.error(
                        `Số lượng ở dòng  ${index + 1} không được là 0`,
                        'Thao tác');
                    hasInvalidData = true;
                }

                if (ware_from == 0 || ware_to == 0) {
                    toastr.error('Bạn cần nhập kho đến và kho đi', 'Thao tác');
                } else {
                    if (hasInvalidData) {
                        return;
                    }
                    var notes = $(`#Notes`).val();
                    $.ajax({
                        url: "{{ route('transfer-ware.add') }}",
                        type: 'POST',
                        data: {
                            from: ware_from,
                            to: ware_to,
                            tag: "",
                            status: "draft",
                            desc: notes,
                        },
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader("Authorization", "Bearer " + token);
                        },
                        dataType: 'json',
                        success: function(response) {
                            var idTicket = response.data.id
                            ArrayData.forEach((item, index) => {
                                var quantity = $(`input[name="quantity_${item.wp_id}"]`).val();
                                var error = $(`input[name="error_${item.wp_id}"]`).val();

                                $.ajax({
                                    url: "{{ route('transfer-ware.addProduct') }}",
                                    type: 'POST',
                                    data: {
                                        prd_id: item.prd_id,
                                        wareId : idTicket,
                                        quantity: quantity,
                                        error: error,
                                    },
                                    dataType: 'json',
                                    beforeSend: function(xhr) {
                                        xhr.setRequestHeader(
                                            "Authorization",
                                            "Bearer " + token);
                                    },
                                    success: function(response) {
                                        toastr.success('Xử lý data dòng ' +
                                            index +
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
                                    toastr.error(
                                        'phiên đăng nhập đã hết hạn xin hãy đăng nhập và thử lại',
                                        'Lỗi');
                                    break;
                                case 403:
                                    toastr.error('Bạn không có quyền thực hiện việc này',
                                        'Lỗi');
                                    break;
                                default:
                                    toastr.error('Đã có lỗi xảy ra hãy reload trang và thử lại',
                                        'Lỗi');
                            }
                        }
                    });
                }
            })
        })
    </script>

    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>
@endsection
