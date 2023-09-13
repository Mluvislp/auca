@extends('backend.layout.layout')
@section('style')
    @if(isset($hideViewPartial) && $hideViewPartial)
        <style>
            .navbar {
                display: none;
            }
            .sidebar {
                display: none;
            }
            .breadcrumb {
                display: none;
            }
            #affter-save {
                display: none;
            }

            .main-wrapper .page-wrapper .page-content {
                margin-top: 0px;
                padding: 0;
            }
            .page-breadcrumb {
                margin: 0px;
            }
        </style>
    @endif
@endsection
@section('title')
    Thêm nhà cung cấp
@endsection
@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Quản lý nhà cung cấp</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới nhà cung cấp</li>
            </ol>
        </nav>
        <form action="{{ route('suppliers.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Thông tin</h6>
                            <form class="forms-sample">
                                @if(isset($hideViewPartial) && $hideViewPartial)
                                    <input type="hidden" name="is_iframe" value="Y">
                                @endif
                                <div class="mb-3">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Tên nhà cung cấp<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="sup_name"
                                                value="{{ old('sup_name') }}" autocomplete="off"
                                                placeholder="Vui lòng nhập">
                                        </div>
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Số điện thoại<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="sup_tel"
                                                value="{{ old('sup_tel') }}" autocomplete="off"
                                                placeholder="Vui lòng nhập">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Số địa chỉ</label>
                                            <input type="text" class="form-control" name="sup_address"
                                                value="{{ old('sup_address') }}"
                                                autocomplete="off" placeholder="Vui lòng nhập">
                                        </div>
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Mã</label>
                                            <input type="text" class="form-control" name="sup_code"
                                                value="{{ old('sup_code') }}" autocomplete="off"
                                                placeholder="Vui lòng nhập">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Email</label>
                                            <input type="text" class="form-control" name="sup_email"
                                                value="{{ old('sup_email') }}"
                                                autocomplete="off" placeholder="Vui lòng nhập">
                                        </div>
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Mã số thuế</label>
                                            <input type="text" class="form-control" name="sup_tax_code"
                                                value="{{ old('sup_tax_code') }}"
                                                autocomplete="off" placeholder="Vui lòng nhập">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Số CMND</label>
                                            <input type="text" class="form-control" name="sup_personal_id"
                                                value="{{ old('sup_personal_id') }}"
                                                autocomplete="off" placeholder="Vui lòng nhạp">
                                        </div>
                                        <div class="col">
                                            <label for="cat_id" class="form-label">Loại</label>
                                            <select class="form-select"
                                                    name="sup_type_id" id="sup_type_id">
                                                @php
                                                    printTypeSuplier();
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" value="1"
                                                name="sup_status" checked id="gender1">
                                            <label class="form-check-label" for="gender1" >
                                                Đang giao dịch
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" value="2"
                                                name="sup_status" id="sup_status">
                                            <label class="form-check-label" for="sup_status">
                                                Ngừng giao dịch
                                            </label>
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
                </div>

                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card w-100 p-0">
                        <div class="card-body">
                            <h6 class="card-title">Thanh toán</h6>
                                <div class="mb-3">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Tên ngân hàng</label>
                                            <input type="text" class="form-control" name="sup_bank_name"
                                                value="{{ old('sup_bank_name') }}"
                                                autocomplete="off" placeholder="Vui lòng nhập">
                                        </div>
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Chi nhánh</label>
                                            <input type="text" class="form-control" name="sup_bank_branch"
                                                value="{{ old('sup_bank_branch') }}"
                                                autocomplete="off" placeholder="Vui lòng nhập">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Số tài khoản</label>
                                            <input type="text" class="form-control" name="sup_bank_account_number"
                                                value="{{ old('sup_bank_account_number') }}"
                                                autocomplete="off" placeholder="Vui lòng nhập">
                                        </div>
                                        <div class="col">
                                            <label for="exampleInputUsername1" class="form-label">Chủ tài khoản</label>
                                            <input type="text" class="form-control" name="sup_bank_account_holder"
                                                value="{{ old('sup_bank_account_holder') }}"
                                                autocomplete="off" placeholder="Vui lòng nhập">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" name="sup_note"
                                       cols="30" rows="10" placeholder="Vui lòng nhập">{{ old('sup_note') }}</textarea>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
            @endforeach
        </script>
    @endif
@endsection
