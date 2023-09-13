@extends('backend.layout.layout')

@section('title')
    Nhập từ excel
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
                <li class="breadcrumb-item"><a href="/">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?= Route('category-internal') ?>">Danh mục nội bộ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nhập từ excel</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">Import danh mục nội bộ</a>
                    </li>
                </ul>
                <form id="upload-form" enctype="multipart/form-data">
                    <div class="tab-content mt-3" id="lineTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                             aria-labelledby="home-line-tab">
                            <div class="card-body p-0 pt-2">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="alert alert-info">
                                            Tải file mẫu
                                            <a href="{{ asset('excel_templates/AUCA_Import_Category_Internal.xlsx') }}"
                                               download="">AUCA_Import_Category_Internal.xlsx</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <input type="hidden" name="storeId" id="storeId" disabled="disabled"
                                               value="45355">
                                        <div class="form-group mb-2 row">
                                            <label class="col-lg-4">File Excel:</label>
                                            <div class="col-lg-8">
                                                <input type="file" name="fileUpload" class="form-input-styled"
                                                       id="fileUpload">
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-12 mb-3">
                                <button type="submit" id="uploadForm" class="btn btnSave btn-success">
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
                </form>
                <div class="tab-content mt-3" id="result-content" style="display: none">
                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                         aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="alert alert-primary" role="alert">
                                        Tổng số xử lý: <b id="total_record"></b>
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        Tổng số thành công : <b id="success_count"></b>
                                    </div>
                                    <div class="alert alert-danger" role="alert" id="res-error" style="display: none">

                                    </div>
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
        $(document).ready(function () {
            $('#upload-form').submit(function (event) {
                event.preventDefault();
                $(this).attr('disabled', 'disabled');
                var formData = new FormData();
                var fileInput = $('#fileUpload')[0];
                var file = fileInput.files[0];
                formData.append('fileUpload', file);
                $.ajax({
                    url: '{{ route('categoryinternal.import') }}',
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        $('#uploadForm').removeAttr('disabled');
                        if(response.status){
                            toastr.success(response.message, 'Thành công');
                            $('#result-content').show();
                            $('#total_record').text(response.data.total_record);
                            $('#success_count').text(response.data.success_count);
                            if (response.data.fail_data.length === 0) {
                                $('#res-error').hide();
                            } else {
                                $('#res-error').show();
                                var resErrorDiv = $('#res-error');
                                resErrorDiv.empty();
                                response.data.fail_data.forEach(function(item) {
                                    var errorParagraph = $('<p></p>');
                                    errorParagraph.append('Dòng ' + item.row_index + ': ');
                                    item.errors.forEach(function(error) {
                                        errorParagraph.append(error + '<br>');
                                    });
                                    resErrorDiv.append(errorParagraph);
                                });
                            }
                        }
                    },
                    error: function (error) {
                        $('#uploadForm').removeAttr('disabled');
                        if (error.responseJSON && error.responseJSON.errors) {
                            var errors = error.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    var errorMessages = errors[key];
                                    errorMessages.forEach(function (errorMessage) {
                                        toastr.error(errorMessage);
                                    });
                                }
                            }
                        }
                        else if (error.responseJSON && error.responseJSON.message) {
                            toastr.error(error.responseJSON.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
