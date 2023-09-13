@extends('backend.layout.layout')

@section('title')
Lấy sản phẩm vào vị trí
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('location') }}">Vị trí sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lấy sản phẩm vào vị trí</li>
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
                            <div class="mb-3">
                                <label class="form-label">Cửa hàng <span class="text-danger">*</span> </label>
                                <select class="form-select mb-3">
                                    <option selected="">- Cửa hàng -</option>
                                    <option value="1">shangyang123</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Vị trí <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" id="colFormLabel" placeholder="Vui lòng nhập">
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="form-label">Sản phẩmx</label>
                                <input type="text" class="form-control" id="colFormLabel" placeholder="Vui lòng nhập">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card w-100 p-0">
                    <div class="card-body">
                        <h6 class="card-title">Import Excel</h6>
                        <div class="mb-3">
                            <label for="colFormLabel" class="form-label">Import file</label>
                            <input class="form-control businessFileUpload" name="imageUpload" type="file" accept="image/*" id="imageUpload" data-url="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="body-table">
                <table id="dataTableExample" class="table dataTable no-footer table-bordered" aria-describedby="dataTableExample_info">
                <thead class="table-light">
                  <tr>
                    <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                      rowspan="1" colspan="1">
                      Vị trí
                    </th>
                    <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                    rowspan="1" colspan="1">
                      Mã sản phẩm
                    </th>
                    <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                      rowspan="1" colspan="1">
                      Mã vạch
                    </th>
                    <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                      rowspan="1" colspan="1">
                      Tên sản phẩm
                    </th>
                    <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                      rowspan="1" colspan="1">
                      Số lượng
                    </th>
                    <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                      rowspan="1" colspan="1">
                      Xóa
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center">3</td>
                    <td class="text-start">
                        <p>A02.A20.2A03</p>
                    </td>
                    <td class="text-center">
                        <p>2000214247534</p>
                    </td>
                    <td class="text-center">
                        <p>Combo 7 Ngày Miếng Dán Răng + 1 Kem Đánh Răng Muối Hồng - TẶNG 2 MIẾNG DÁN LẺ THAN TRE A20.A02.2A03</p>
                    </td>
                    <td class="text-center">
                        <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                    </td>
                    <td class="text-center">
                        <a class="dropdown-item fs-5 text-danger" href="#">
                            <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                        </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div><br>

            <div class="mb-3">
                <label class="form-label">Sau khi lưu dữ liệu: </label>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="gender_radio" id="gender1">
                        <label class="form-check-label" for="gender1">
                            Tiếp tục thêm
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="gender_radio" id="gender2">
                        <label class="form-check-label" for="gender2">
                            Hiện danh sách
                        </label>
                    </div>
                </div>
            </div>

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