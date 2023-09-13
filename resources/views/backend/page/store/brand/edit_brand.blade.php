@extends('backend.layout.layout')

@section('title')
    Sửa nhãn hàng
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropzone/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropify/dist/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/pickr/themes/classic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/backend/css/upload-image.css') }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/css/fileinput.min.css'>
@endsection

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('brand') }}">Quản lý nhãn hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sửa nhãn hàng</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Thông tin</h6>
                        <form class="forms-sample" enctype="multipart/form-data" id="BrandForm">
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Tên nhãn hàng <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="brand_name" id="exampleInputUsername1"
                                    autocomplete="off" placeholder="Nhập tên nhãn hàng">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Mã thương hiệu <span class="text-danger"> *</span></label>
                                <input class="form-control" maxlength="20" name="brand_code" id="brandCode" type="text"
                                    placeholder="Nhập mã thương hiệu">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">mô tả <span class="text-danger"> *</span></label>
                                <textarea class="form-control" name="description" id="desBrand" placeholder="Nhập mô tả"></textarea>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Content</label>
                                  <textarea class="form-control" name="description" id="contBrand" placeholder="Nhập mô tả"></textarea>
                            </div> --}}


                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card w-100 p-0">
                    <div class="card-body">
                        <h6 class="card-title">Hình ảnh</h6>
                        <p class="text-muted mb-3">Vui lòng đặt tên file không quá dài, và kích thước file không quá 25mb
                        </p>
                        <section class="bg-diffrent">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 w-100 p-0">
                                        <div class="file-upload-contain">
                                            <input id="multiplefileupload" type="file" accept=".jpg,.gif,.png" />
                                            <div class="previewFile">

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="btn-submit">
                <a href="/">
                    <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
                </a>
            </div>
            </form>

        </div>
    </div>
@endsection
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script type="text/javascript">
    var token = localStorage.getItem("Token");
    // Lấy URL từ thanh địa chỉ
    var url = window.location.href;
    // Tìm vị trí của ký tự '/' cuối cùng trong URL
    var lastSlashIndex = url.lastIndexOf('/');
    // Lấy phần tử sau ký tự '/' cuối cùng để lấy ra ID
    var id = url.substring(lastSlashIndex + 1);
    $(document).ready(function() {
        function getData() {
            $.ajax({
                url: "{{ route('brand.showBrand', ['id' => ':id']) }}".replace(':id', id),
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                success: function(response) {
                    $("#exampleInputUsername1").val(response.data.brand_name);
                    $("#brandCode").val(response.data.brand_code);
                    $("#desBrand").val(response.data.brand_description);
                    if(response.data.brand_image_name){
                        $(".previewFile").append(
                        `
                    <div class="file-preview-frame file-sortable  kv-preview-thumb" id="thumb-multiplefileupload-${response.data.brand_image_name}" data-fileindex="-1" data-fileid="10316117_JAY06446-2.jpg" data-template="image" data-zoom=""><div class="kv-file-content">
                        <img src="${response.data.brand_image}" alt="" width="50px" height="50px">
                    </div><div class="file-thumbnail-footer">
                    <div class="file-detail"><div class="file-caption-name">${response.data.brand_image_name}</div>
                           <div class="file-size"> <samp>(9.84 MB)</samp></div>
                </div>   <div class="file-actions">
                  <div class="file-footer-buttons">
                  <button type="button" class="kv-file-remove file-remove" onclick = "removeFile(${response.data.brand_id})" title="Remove file" fdprocessedid="4rg22"><i class="fa fa-times"></i></button>
                   </div>
                     </div>
            <button class="file-drag-handle drag-handle-init file-drag" title="Move / Rearrange" fdprocessedid="9pwk7o"><i class="fa fa-arrows-alt"></i></button>
                    <div class="clearfix"></div>
           </div>

            <div class="kv-zoom-cache"></div></div>
                    `)
                    }
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

        $("#multiplefileupload").on("change", function() {
            $(".previewFile").empty()
        });

        $('#BrandForm').submit(function(event) {
            event.preventDefault();
            var name = $('input[name="brand_name"]').val();
            var code = $('input[name="brand_code"]').val();
            var description = $('#desBrand').val();
            var content = $('#contBrand').val();
            var files = $('#multiplefileupload').get(0).files;
            if (!name || !code || !description) {
                toastr.error('Bạn cần cập nhập đầy đủ', 'Thao tác');
            } else {
                var formData = new FormData(this);
                if (files.length > 0) {
                    for (var i = 0; i < files.length; i++) {
                        formData.append('file[]', files[i]);
                    }
                }
                formData.append('brand_name', name);
                formData.append('brand_description', description);
                // formData.append('brand_content', content);
                formData.append('brand_code', code);
                $.ajax({
                    url: "{{ route('brand.updateBrand', ['id' => ':id']) }}".replace(':id',
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
                        location.reload();
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
        });
        getData()
    });

    function removeFile(id) {
        console.log(id)
        $.ajax({
                    url: "{{ route('brand.deleteimage', ['id' => ':id']) }}".replace(':id',
                        id),
                    type: 'POST',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    processData: false, // Không xử lý dữ liệu thành chuỗi query
                    contentType: false, // Không đặt kiểu dữ liệu của yêu cầu
                    success: function(response) {
                        toastr.success('Cập nhập thành công', 'thao tác');
                        $(".previewFile").empty()
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
</script>
@section('script')
    <script src="{{ asset('assets/backend/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/backend/js/inputmask.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.js') }}"></script>
    <script src="{{ asset('assets/backend/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/backend/js/tags-input.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pickr.js') }}"></script>
    <script src="{{ asset('assets/backend/js/flatpickr.js') }}"></script>

    <script src="{{ asset('assets/backend/js/upload-image.js') }}"></script>

    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/js/plugins/sortable.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/themes/fas/theme.min.js'></script>
@endsection
