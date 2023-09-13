@extends('backend.layout.layout')

@section('title')
Thêm mới hạn mức tồn kho
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới hạn mức tồn kho</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <div class="heading">
                <h6 class="card-title">Thông tin</h6>
            </div><hr>
            <div class="row">
                <div class="col-6">
                    <div class="input-group mb-3">
                        <label class="col-form-label text-right col-12 pl-0 pr-0">Cửa hàng</label>
                        <select class="form-select" aria-label="select example" name="filter_var_cat_id[]" id="filter_var_cat_id">
                            <option value="hihi">- Cửa hàng -</option>
                            <option value="">shangyang132</option>
                      </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <label class="col-form-label text-right col-12 pl-0 pr-0">Sản phẩm</label>
                        <input type="text" class="form-control" aria-label="Text input with dropdown button">
                    </div>
                </div>
            </div>

            <div class="table-responsive overflow-hidden">
              <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row">
                  <div class="col-sm-12 table-responsive">
                    <table id="dataTableExample" class="table dataTable no-footer table-bordered"
                      aria-describedby="dataTableExample_info">
                      <thead class="table-light">
                        <tr>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Mã SP
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tên SP
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Số tồn tối thiểu
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Tồn tối thiểu
                          </th>
                          <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                            rowspan="1" colspan="1">
                            Xóa
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center">
                            <p>A02.A20</p>
                          </td>
                          <td class="text-center">
                            <p>LIỆU TRÌNH 7 NGÀY + KEM ĐÁNH RĂNG MUỐI HỒNG</p>
                          </td>
                          <td class="text-start">
                            <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
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
                  </div>
                </div>
              </div>
            </div>

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