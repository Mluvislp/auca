@extends('backend.layout.layout')

@section('title')
Mã sản phẩm
@endsection

@section('style')

<style>
/**
 * FilePond Custom Styles
 */
.filepond--drop-label {
  color: #4c4e53;
}

.filepond--label-action {
  -webkit-text-decoration-color: #babdc0;
  text-decoration-color: #babdc0;
}

.filepond--panel-root {
  border-radius: 2em;
  background-color: #edf0f4;
}

.filepond--item-panel {
  background-color: #595e68;
}

.filepond--drip-blob {
  background-color: #7f8a9a;
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
      <li class="breadcrumb-item">
        <a href="{{ route('product') }}">Sản phẩm</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Thông tin sản phẩm</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <div class="modal-body">
        <div class="float-end">
          <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Thao tác
          </button>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item fs-5" href="#">
                <i class="icon-lg pb-3px" data-feather="printer"></i>
                In mã vạch sản phẩm
              </a>
            </li>
            <li>
              <a class="dropdown-item fs-5" href="#">
                <i class="icon-lg pb-3px" data-feather="edit"></i>
                Sửa sản phẩm
              </a>
            </li>
            <li>
              <a class="dropdown-item fs-5" href="#">
                <i class="icon-lg pb-3px" data-feather="tablet"></i>
                Tính lại số tồn
              </a>
            </li>
            <li>
              <a class="dropdown-item fs-5" href="#">
                <i class="icon-lg pb-3px" data-feather="refresh-cw"></i>
                Tính lại giá vốn
              </a>
            </li>
            <li>
              <a class="dropdown-item fs-5" href="#">
                <i class="icon-lg pb-3px" data-feather="refresh-cw"></i>
                Tính lại số đang chuyển kho
              </a>
            </li>
            <li>
              <a class="dropdown-item fs-5" href="#">
                <i class="icon-lg pb-3px" data-feather="refresh-cw"></i>
                In mã vạch sản phẩm
              </a>
            </li>
          </ul>
        </div>
        <div class="tab-ui">
          <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="tab1-line-tab" data-bs-toggle="tab" href="#tab1" role="tab"
                aria-controls="tab1" aria-selected="true">
                <i class="icon-lg pb-3px" data-feather="info"></i>
                Thông tin
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tab2-line-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                aria-selected="false">
                <i class="icon-lg pb-3px" data-feather="refresh-cw"></i>
                Tồn kho
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tab3-line-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3"
                aria-selected="false">
                <i class="icon-lg pb-3px" data-feather="image"></i>
                Ảnh
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tab6-line-tab" data-bs-toggle="tab" href="#tab6" role="tab" aria-controls="tab6"
                aria-selected="false">
                <i class="icon-lg pb-3px" data-feather="refresh-cw"></i>
                Lịch sử đã xóa
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tab7-line-tab" data-bs-toggle="tab" href="#tab7" role="tab" aria-controls="tab7"
                aria-selected="false">
                <i class="icon-lg pb-3px" data-feather="link-2"></i>
                XNK
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tab8-line-tab" data-bs-toggle="tab" href="#tab8" role="tab" aria-controls="tab8"
                aria-selected="false">
                <i class="icon-lg pb-3px" data-feather="code"></i>
                API
              </a>
            </li>
          </ul>

          <div class="tab-content mt-3" id="lineTabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-line-tab">
              <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="heading">
                        <p class="float-end">Trạng thái: <span class="bg-blue text-white p-1 rounded-2">Mới</span></p>
                        <h6 class="card-title"><i class="icon-lg pb-3px" data-feather="info"></i> Thông tin</h6>
                      </div>
                      <hr>
                      <div class="mb-3">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                          <div class="col">
                            <div class="mb-3">
                              <p>
                                Mã: <span>XĐ-dă-1-3y</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Mã vạch: <span>2000214247640</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Mã sản phẩm cha: <span>XĐ</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Danh mục: <span>Xe máy</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Thương hiệu: <span>86Shop</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Người tạo: <span>123</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Ngày tạo: <span>23:27 14/07</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Nhà cung cấp: <a href="#">DREAM TREND - 0000000002</a>
                              </p>
                            </div>
                          </div>
                          <div class="col">
                            <div class="mb-3">
                              <p>
                                Giá nhập: <span>18.000.000</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Giá vốn: <span>18.000.000</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Giá bán: <span>19.000.000 <b>(Lãi 5%)</b></span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Giá sỉ: <span>Null</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Giá cũ: <span>18.500.000</span>
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Đơn vị tính: <span>Chiếc</span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-5 grid-margin stretch-card">
                  <div class="card w-100 p-0">
                    <div class="card-body">
                      <div class="heading">
                        <h6 class="card-title"><i class="icon-lg pb-3px" data-feather="info"></i> Thông tin khác</h6>
                      </div>
                      <hr>
                      <div class="mb-3">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                          <div class="col">
                            <div class="mb-3">
                              <p>
                                Loại sản phẩm:
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Khối lượng:
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Kích thước:
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Màu sắc con:
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Size:
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Màu sắc:
                              </p>
                            </div>
                          </div>
                          <div class="col text-end">
                            <div class="mb-3">
                              <p>
                                Sản phẩm
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                90.000 gr
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                2.000 x 550 x 1.500 cm
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Màu vàng
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                1-3y
                              </p>
                            </div>
                            <div class="mb-3">
                              <p>
                                Bright Grey
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-line-tab">
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
                              Kho
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Tồn
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Lỗi
                            </th>
                            <th class="sorting text-center text-black sorting_asc" tabindex="0"
                              aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending">
                              Đang giao hàng
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Tồn kho trong
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Đang xuất chuyển kho
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Chờ nhập chuyển kho
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Tạm giữ
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Tạm giữ linh kiện
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Bảo hành
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Có thể bán
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Chờ nhập hàng
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Đặt trước
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">
                              <a href="#">
                                <i class="icon-lg pb-3px" data-feather="home"></i>
                                shangyang132
                              </a>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                            <td class="text-center">
                              <p>Null</p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-line-tab">

              <div>
                <input type="file" class="filepond" name="filepond" id="file" multiple data-max-file-size="3MB"
                  data-max-files="10" />
                <div class="btn-submit">
                  <a href="#">
                    <button type="submit" class="btn btn-success me-2">Cập nhật vị trí</button>
                  </a>
                </div>
              </div>

            </div>

            <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-line-tab">
              <div class="table-responsive overflow-hidden">
                <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  <div class="row">
                    <div class="col-sm-12 table-responsive">
                      <table id="dataTableExampleHero" class="table dataTable no-footer table-bordered"
                        aria-describedby="dataTableExample_info">
                        <thead class="table-light">
                          <tr>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              LogID
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Ngày tạo
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Người tạo
                            </th>
                            <th class="sorting text-center text-black sorting_asc" tabindex="0"
                              aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending">
                              Thao tác
                            </th>
                            <th class="sorting text-center text-black" tabindex="0" aria-controls="dataTableExample"
                              rowspan="1" colspan="1">
                              Dữ liệu
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">
                              <p>151150846</p>
                            </td>
                            <td class="text-center">
                              <p>27/07/2023 <span>16:18:21</span> </p>
                            </td>
                            <td class="text-center">
                              <p>123</p>
                            </td>
                            <td class="text-center">
                              <p>Sửa sản phẩm</p>
                            </td>
                            <td class="text-center">
                              <a href="#">
                                <i class="icon-lg pb-3px" data-feather="eye"></i>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab7" role="tabpanel" aria-labelledby="tab7-line-tab">
              <div class="card-body p-0 pt-2">
                <!-- Start Filter content -->
                <div class="filter">
                  <div class="row mb-3">

                    <div class="col-6 col-md-5 col-lg-4 col-xl-2 pr-1">
                      <div class="form-group input-group mb-0 pt-3">
                        <div class="p-0">
                          <div class="row g-0 m-0 input-group">
                            <div class="col">
                              <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control flatpickr-input" placeholder="Từ ngày"
                                  data-input="" readonly="readonly">
                              </div>
                            </div>
                            <div class="col">
                              <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control flatpickr-input" placeholder="Đến ngày"
                                  data-input="" readonly="readonly">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                      <div class="form-group input-group mb-0 pt-3">
                        <div class="col p-0">
                          <input type="text" name="name" maxlength="100" placeholder="Mô tả sản phẩm" id="name"
                            class="form-control" value="">
                        </div>
                      </div>
                    </div>

                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                      <div class="form-group input-group mb-0 pt-3">
                        <div class="col p-0">
                          <select name="type" class="form-select px-1" id="type">
                            <option value="">- Loại XNK -</option>
                            <option value="">Nhập</option>
                            <option value="">Xuất</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                      <div class="form-group input-group mb-0 pt-3">
                        <div class="col p-0">
                          <select name="inventory" id="inventory" class="form-control"
                            aria-label="multiple select example" name="mode" id="mode" multiple custom-multiple
                            multiselect-search="true" multiselect-select-all="true" multiselect-max-items="1">
                            <option value="">- Kiểu XNK -</option>
                            <option value="5">[N] Nhà cung cấp</option>
                            <option value="3">[C] Chuyển kho</option>
                            <option value="1">[G] Giao hàng</option>
                            <option value="2">[L] Bán lẻ</option>
                            <option value="6">[B] Bán sỉ</option>
                            <option value="4">[TL] Tặng kèm (Bán lẻ)</option>
                            <option value="18">[TG] Tặng kèm (Giao hàng)</option>
                            <option value="17">[TB] Tặng kèm (Bán sỉ)</option>
                            <option value="8">[K] Bù trừ kiểm kho</option>
                            <option value="10">[#] Khác</option>
                            <option value="13">[BH] Bảo hành</option>
                            <option value="15">[SC] Sửa chữa</option>
                            <option value="16">[LKBH] Linh kiện bảo hành</option>
                            <option value="19">[CB] Combo</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-1 pt-3">
                      <div class="btn-group dropdown">
                        <button type="submit" class="btn submitFilterBtn btn-success">
                          Lọc
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End filter content -->
                <div class="table-responsive overflow-hidden">
                  <div id="dataTableExampleHero_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                      <div class="col-sm-12 table-responsive">
                        <table id="dataTableExampleV2" class="table dataTable no-footer table-bordered"
                          aria-describedby="dataTableExampleHero_info">
                          <thead class="table-light">
                            <tr>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                ID | Ngày
                              </th>
                              <th class="sorting text-black text-center sorting_asc" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1" aria-sort="ascending">
                                Kho hàng
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                Kiểu
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                Sản phẩm
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                SL
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                Tồn
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                Giá vốn
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                Tiền
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                Tổng tiền
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                <i class="icon-lg pb-3px" data-feather="settings"></i>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="text-center">
                                <p>32487237</p>
                                <span>17/07/2023</span>
                              </td>
                              <td class="text-center">
                                <p>shangyang</p>
                              </td>
                              <td class="text-center"></td>
                              <td class="text-center">Kem đánh răng</td>
                              <td class="text-center">0</td>
                              <td class="text-center">0</td>
                              <td class="text-center">0</td>
                              <td class="text-center">0</td>
                              <td class="text-center">0</td>
                              <td class="text-center">
                                <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                                  aria-expanded="false">
                                  <i class="icon-lg pb-3px" data-feather="menu"></i>
                                </span>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a class="dropdown-item fs-5 text-danger" href="#">
                                      <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i>
                                      Xóa
                                    </a>
                                  </li>
                                </ul>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab8" role="tabpanel" aria-labelledby="tab8-line-tab">
              <div class="card-body p-0 pt-2">
                <!-- Start Filter content -->
                <div class="filter">
                  <div class="row mb-3">

                    <div class="col-6 col-md-5 col-lg-4 col-xl-2 pr-1">
                      <div class="form-group input-group mb-0 pt-3">
                        <div class="p-0">
                          <div class="row g-0 m-0 input-group">
                            <div class="col">
                              <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control flatpickr-input" placeholder="Từ ngày"
                                  data-input="" readonly="readonly">
                              </div>
                            </div>
                            <div class="col">
                              <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control flatpickr-input" placeholder="Đến ngày"
                                  data-input="" readonly="readonly">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-6 col-md-3 col-lg-2 pr-1">
                      <div class="form-group input-group mb-0 pt-3">
                        <div class="col p-0">
                          <select name="merchantId" class="form-select px-1" id="merchantId">
                            <option value="">- Kênh bán -</option>
                            <option value="">Lazada</option>
                            <option value="">Shopee</option>
                            <option value="">Tiktok shop</option>
                            <option value="">Tiki</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-1 pt-3">
                      <div class="btn-group dropdown">
                        <button type="submit" class="btn submitFilterBtn btn-success">
                          Lọc
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End filter content -->
                <div class="table-responsive overflow-hidden">
                  <div id="dataTableExampleHero_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                      <div class="col-sm-12 table-responsive">
                        <table id="dataTableExampleV3" class="table dataTable no-footer table-bordered"
                          aria-describedby="dataTableExampleHero_info">
                          <thead class="table-light">
                            <tr>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                ID
                              </th>
                              <th class="sorting text-black text-center sorting_asc" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1" aria-sort="ascending">
                                Nội dung
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                Ngày
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                Appid
                              </th>
                              <th class="sorting text-black text-center" tabindex="0"
                                aria-controls="dataTableExampleHero" rowspan="1" colspan="1">
                                Type
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="text-center">
                                <p>32487237</p>
                              </td>
                              <td class="text-center">
                                <p>Null</p>
                              </td>
                              <td class="text-center">27/07/2023</td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
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

<!-- <script>
ClassicEditor
  .create(document.querySelector('#editor'))
</script>

<script>
/*
We want to preview images, so we need to register the Image Preview plugin
*/
FilePond.registerPlugin(
  // encodes the file as base64 data
  FilePondPluginFileEncode,
  // validates the size of the file
  FilePondPluginFileValidateSize,
  // corrects mobile image orientation
  FilePondPluginImageExifOrientation,
  // previews dropped images
  FilePondPluginImagePreview
);

const inputElement = document.querySelector('input[id="file"]');
const pond = FilePond.create(inputElement);
</script>

<script>
FilePond.parse(document.body);
</script> -->

<script>
$(document).ready(function() {
  var token = localStorage.getItem("Token");

  function getUrlParameter(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  function getData() {
    var id = getUrlParameter('id');

    $.ajax({
      url: "{{ route('product.find')}}",
      type: 'GET',
      data: {
        id: id,
      },
      delay: 250,
      beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
      },
      success: function(response) {
        console.log(response);
        // initProductDetails(response.data);
      },
      error: function(xhr) {
        var statusCode = xhr.status;
        displayError(statusCode);
      }
    });
  }

  getData();
});
</script>

<script>
$('#type').select2({
  theme: "bootstrap-5",
  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
  placeholder: $(this).data('placeholder'),
});
$('#merchantId').select2({
  theme: "bootstrap-5",
  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
  placeholder: $(this).data('placeholder'),
});
</script>
@endsection