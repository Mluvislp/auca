@extends('backend.layout.layout')

@section('title')
Thêm nhanh danh mục vị trí sản phẩm
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('location') }}">Vị trí sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới vị trí</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <div class="mb-3 col-6 col-md-3 col-lg-3 pr-1">
                <label class="form-label">Kho hàng <span class="text-danger">*</span> </label>
                <select class="form-select mb-3">
                    <option selected="">- Kho hàng -</option>
                    <option value="1">kho hàng 1</option>
                    <option value="2">kho hàng 2</option>
                    <option value="3">kho hàng 3</option>
                </select>
            </div>
            <div class="body-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Danh mục (Tầng)</th>
                            <th scope="col">Danh mục (Khu)</th>
                            <th scope="col">Danh mục (Kệ)</th>
                            <th scope="col">Các vị trí</th>
                            <th scope="col">
                                <i class="icon-lg pb-3px" data-feather="settings"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <input type="text" max="99999" min="0" placeholder="VD: Tầng 1" class="form-control" data-id="6">
                            </td>
                            <td class="text-center">
                                <input type="text" max="99999" min="0" placeholder="VD: Khu A" class="form-control" data-id="6">
                            </td>
                            <td class="text-center">
                                <input type="text" max="99999" min="0" placeholder="VD: Kệ 1" class="form-control" data-id="6">
                            </td>
                            <td class="text-center">
                                <input type="text" max="99999" min="0" placeholder="VD: Ô 1 - Ô tài liệu" class="form-control" data-id="6">
                            </td>
                            <td class="text-center">
                                <a href="#">
                                    <i class="icon-lg pb-3px my-2 text-danger" data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><br>
            
            <div class="btn-submit">
                <a href="/">
                    <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
                </a>
            </div>

        </div>
    </div>

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

<script>
    var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
</script>

@endsection