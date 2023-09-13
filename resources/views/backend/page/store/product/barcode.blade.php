@extends('backend.layout.layout')

@section('title')
    Thêm danh sản phẩm
@endsection

@section('style')
    <style>
        .select2-container--bootstrap-5
        .select2-selection--multiple
        .select2-selection__rendered {
            flex-wrap: nowrap;
        }
    </style>

    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }

        .barcode-container {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            position: relative;
        }

        .barcode {
            /* CSS tùy chỉnh cho mã vạch */
        }

        .product-details {
            margin-top: 10px;
        }

        .product-name {
            font-weight: bold;
        }

        .product-price {
            color: #e74c3c; /* Màu sắc tùy chỉnh */
        }
    </style>

@endsection

@section('content')

    @include('backend.components.properties_modal')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Bảng điều khiển</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('product') }}">Sản phẩm</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">Thông tin cơ bản</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
                        <form id="productAddForm" class="form-add-custom" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="card p-3">
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <label class="col-5 col-lg-2 col-form-label">Số lượng</label>
                                                <div class="col-7 col-lg-10">
                                                    <input type="text" name="quantityInput" maxlength="255"
                                                           class="required form-control"
                                                           autofocus="autofocus" id="quantityInput" autocomplete="off"
                                                           value="">
                                                </div>
                                                @php
                                                    echo '<pre>';
                                                    print_r($product->toArray())
                                                @endphp
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card p-3">
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <label class="col-5 col-lg-3 col-form-label">Mã vạch<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-7 col-lg-9 d-flex flex-column align-items-center">
                                                    <div class="barcode-container">
                                                        <div class="product-details">
                                                            <div class="product-name">Product Name</div>
                                                        </div>
                                                        @php
                                                            echo $barcode_html;
                                                        @endphp
                                                        <div class="product-details">
                                                            <div class="product-name">PD-123</div>
                                                            <div class="product-name">Product Name</div>
                                                            <div class="product-price">$99.99</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-submit">
                                    <button type="button" onclick="openPrintTab()">In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function openPrintTab() {
            const quantity = parseInt(document.getElementById('quantityInput').value, 10);
            if (isNaN(quantity) || quantity <= 0) {
                alert('Vui lòng nhập một số lượng hợp lệ.');
                return;
            }
            let first = '<div class="barcode-container">' +
                            '<div class="product-details">' +
                                '<div class="product-warehouse-name"></div>' +
                            '</div>';

            let last =      '<div class="product-details">' +
                                '<div class="product-barcode">PD-123</div>' +
                                '<div class="product-name">Product Name</div>' +
                                '<div class="product-price">$99.99</div>' +
                            '</div>' +
                        '</div>';
            let barcodesHTML = '';
            for (let i = 0; i < quantity; i++) {

            }
            const barcodeHtml = document.querySelector('.barcode-container').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
            <html>
            <head>
                <title>In Barcode</title>
               <style>
                    .card {
                        border: 2px solid black;
                        padding: 10px;
                        margin: 10px;
                        max-height: 300px;
                        max-width : 300px;
                    }
                </style>
            </head>
            <body>
                <div class="card">
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col-7 col-lg-9 d-flex align-items-center">
                                ${barcodeHtml}
                            </div>
                        </div>
                    </div>
                </div>
                </body>
                </html>
                `);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }
    </script>
    <script>

        $(document).ready(function () {
            var token = localStorage.getItem("Token");
        });
    </script>
@endsection
