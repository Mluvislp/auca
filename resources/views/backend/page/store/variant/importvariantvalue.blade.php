@extends('backend.layout.layout')

@section('title')
    Sản phẩm
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
                <li class="breadcrumb-item"><a href="{{Route('variant')}}">Thuộc tính</a></li>
                <li class="breadcrumb-item active" aria-current="page">Import</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">Import thuộc tính</a>
                    </li>
                </ul>
                <form action="{{route('handle-import-variant-value')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content mt-3" id="lineTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                             aria-labelledby="home-line-tab">
                            <div class="card-body p-0 pt-2">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="alert alert-info">
                                            Import giá trị cho thuộc tính: <b>{{$variant->var_name}}</b>
                                            <input type="hidden" name="var_id" id="var_id" value="{{$variant->var_id}}">
                                        </div>
                                        <div class="error"></div>
                                        <div class="alert alert-info">
                                            Tải file mẫu
                                            <a href="{{ asset('excel_templates/AUCA_Import_Product_Attribute_Value.xlsx') }}"
                                               download="">AUCA_Import_Product_Attribute_Value.xlsx</a>
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
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group mb-2 row">
                                            <label class="col-lg-4">Kiểu import:</label>
                                            <div class="col-lg-8">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                        <span class="uniform-choice"><span class="checked"><input checked="checked" type="radio"
                                                                                  class="form-input-styled" name="mode"
                                                                                  value="add"></span></span>
                                                        Thêm mới thuộc tính
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                        <span class="uniform-choice"><span><input type="radio" class="form-input-styled" name="mode"
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
                @if(\Illuminate\Support\Facades\Session::has('import_response_data'))
                    @php
                    $data = \Illuminate\Support\Facades\Session::get('import_response_data');
                    @endphp
                <div class="tab-content mt-3" id="lineTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                         aria-labelledby="home-line-tab">
                        <div class="card-body p-0 pt-2">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="alert alert-primary" role="alert">
                                    Tổng số xử lý: <b>{{$data['total_record']}}</b>
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        Tổng số thành công : <b>{{$data['success_count']}}</b>
                                    </div>
                                    @if(!empty($data['fail_data']))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($data['fail_data'] as $val1)
                                            @foreach($val1['errors'] as $val2)
                                                <p>{{$val2}}</p>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection @section('script')
    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>
@endsection
