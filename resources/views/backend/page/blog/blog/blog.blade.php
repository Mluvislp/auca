@extends('backend.layout.layout')

@section('title')
Bài viết
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
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
      <li class="breadcrumb-item active" aria-current="page">Quản lý bài viết</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <div class="data-button float-end">
        <a href="{{ route('trash_blog') }}">
          <button type="button" class="btn btn-inverse-danger">Thùng rác</button>
        </a>
        <a href="{{ route('add_blog') }}">
          <button type="button" class="btn btn-inverse-primary">Thêm mới</button>
        </a>
      </div>
      <h6 class="card-title">Danh sách bài viết</h6>
      <p class="text-muted mb-3">Read the <a href="#" target="_blank"> Official DataTables
          Documentation </a>for a full list of instructions and other options.</p>
      <div class="table-responsive overflow-hidden">
        <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="row">
            <div class="col-sm-12">
              <div class="perfect-scrollbar-example pb-2">
                <table id="dataTableExample" class="table dataTable no-footer" aria-describedby="dataTableExample_info">
                  <thead>
                    <tr>
                      <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                        colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending"
                        style="width: 195.163px;">ID</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Position: activate to sort column ascending" style="width: 306.925px;">TIÊU ĐỀ BÀI
                        VIẾT</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Position: activate to sort column ascending" style="width: 306.925px;">THUỘC DANH
                        MỤC</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Position: activate to sort column ascending" style="width: 306.925px;">CẤU HÌNH SLUG
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Office: activate to sort column ascending" style="width: 146.275px;">NGÀY ĐĂNG TẢI
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Age: activate to sort column ascending" style="width: 61.35px;">ĐƯỜNG DẪN BÀI VIẾT
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Start date: activate to sort column ascending" style="width: 134.413px;">TRẠNG THÁI
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1"
                        aria-label="Salary: activate to sort column ascending" style="width: 97.875px;">Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="odd">
                      <td class="sorting_1">01</td>
                      <td>Ăn gì để không bị mập</td>
                      <td>Ăn uống</td>
                      <td>an-gi-de-khong-bi-map</td>
                      <td>15/03/2023</td>
                      <td>
                        <a style="color: blue;" href="">http://127.0.0.1:8000/admin/blog</a>
                      </td>
                      <td>
                        <span class="badge rounded-pill bg-primary">Hiển thị</span>
                      </td>
                      <td>
                        <div class="btn-acction" style="display: flex;">
                          <div class="btn-view" style="margin-right: 10px;">
                            <a data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl" href="">Xem</a>
                            <div class="modal fade bd-example-modal-xl" tabindex="-1"
                              aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xem nhanh</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="btn-close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-md-6 grid-margin stretch-card">
                                        <div class="card">
                                          <div class="card-body">
                                            <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                                              <li class="nav-item">
                                                <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab"
                                                  href="#home" role="tab" aria-controls="home"
                                                  aria-selected="true">Thông tin bài viết</a>
                                              </li>
                                              <li class="nav-item">
                                                <a class="nav-link" id="profile-line-tab" data-bs-toggle="tab"
                                                  href="#profile" role="tab" aria-controls="profile"
                                                  aria-selected="false">Nội dung</a>
                                              </li>
                                            </ul>
                                            <div class="tab-content mt-3" id="lineTabContent">
                                              <div class="tab-pane fade show active" id="home" role="tabpanel"
                                                aria-labelledby="home-line-tab">
                                                <form class="forms-sample">
                                                  <div class="mb-3">
                                                    <label for="exampleInputUsername1" class="form-label">Tiêu đề bài
                                                      viết
                                                    </label>
                                                    <input type="text" class="form-control" id="exampleInputDisabled1"
                                                      disabled="" value="Ăn gì để không mập">
                                                  </div>
                                                  <div class="mb-3">
                                                    <label for="exampleInputUsername1" class="form-label">Thuộc danh mục
                                                    </label>
                                                    <input type="text" class="form-control" id="exampleInputDisabled1"
                                                      disabled="" value="Ăn uống">
                                                  </div>
                                                  <div class="mb-3">
                                                    <label for="exampleInputUsername1" class="form-label">Cấu hình slug
                                                    </label>
                                                    <input type="text" class="form-control" id="exampleInputDisabled1"
                                                      disabled="" value="an-gi-de-khong-map">
                                                  </div>
                                                  <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Ngày đăng tải
                                                    </label>
                                                    <input type="text" class="form-control" id="exampleInputDisabled1"
                                                      disabled="" value="15/03/2023">
                                                  </div>

                                                  <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input"
                                                      name="radioInlineSelectedDisabled"
                                                      id="radioInlineSelectedDisabled" disabled="" checked="">
                                                    <label class="form-check-label" for="radioInlineSelectedDisabled">
                                                      Hiển thị
                                                    </label>
                                                  </div>
                                                  <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input"
                                                      name="radioInlineDisabled" id="radioInlineDisabled" disabled="">
                                                    <label class="form-check-label" for="radioInlineDisabled">
                                                      Ngưng hiển thị
                                                    </label>
                                                  </div>
                                                </form>
                                              </div>
                                              <div class="tab-pane fade" id="profile" role="tabpanel"
                                                aria-labelledby="profile-line-tab">
                                                <div class="mb-3">
                                                  <label for="exampleFormControlTextarea" class="form-label">Nội dung
                                                    bài viết</label>
                                                  <div class="perfect-scrollbar-example">
                                                    <textarea style="height: 310px;" class="form-control"
                                                      id="exampleFormControlTextarea1" disabled=""
                                                      rows="5">Trong nhiều năm, thực phẩm ít chất béo được xem là lựa chọn phù hợp cho những người cần kiểm soát cân nặng, kiểm soát hàm lượng cholesterol máu để có một trái tim khỏe mạnh. Vậy những thực phẩm nào ít chất béo và tốt cho sức khỏe? Trong bài viết này sẽ cung cấp những thông tin hữu ích về 13 loại thực phẩm ít chất béo, tốt cho sức khỏe. Trong nhiều năm, thực phẩm ít chất béo được xem là lựa chọn phù hợp cho những người cần kiểm soát cân nặng, kiểm soát hàm lượng cholesterol máu để có một trái tim khỏe mạnh. Vậy những thực phẩm nào ít chất béo và tốt cho sức khỏe? Trong bài viết này sẽ cung cấp những thông tin hữu ích về 13 loại thực phẩm ít chất béo, tốt cho sức khỏe.</textarea>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-md-6 grid-margin stretch-card">
                                        <div class="card w-100 p-0">
                                          <div class="card-body">
                                            <h6 class="card-title">Hình ảnh</h6>
                                            <div id="carouselExampleControls" class="carousel slide"
                                              data-bs-ride="carousel">
                                              <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                  <img
                                                    src="https://cdn-www.vinid.net/fe9611d1-top-cac-mon-an-khuya-khong-map.jpg"
                                                    class="d-block w-100 h-100 rounded-0" alt="...">
                                                </div>
                                                <div class="carousel-item">
                                                  <img
                                                    src="https://cdn-www.vinid.net/fe9611d1-top-cac-mon-an-khuya-khong-map.jpg"
                                                    class="d-block w-100 h-100 rounded-0" alt="...">
                                                </div>
                                                <div class="carousel-item">
                                                  <img
                                                    src="https://cdn-www.vinid.net/fe9611d1-top-cac-mon-an-khuya-khong-map.jpg"
                                                    class="d-block w-100 h-100 rounded-0" alt="...">
                                                </div>
                                              </div>
                                              <a class="carousel-control-prev" data-bs-target="#carouselExampleControls"
                                                role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                              </a>
                                              <a class="carousel-control-next" data-bs-target="#carouselExampleControls"
                                                role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                              </a>
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
                          <div class="btn-edit" style="margin-right: 10px;">
                            <a href="{{ route('edit_blog') }}">Sửa</a>
                          </div>
                          <div class="btn-deleted" style="margin-right: 10px;">
                            <a href="">Xóa</a>
                          </div>
                        </div>
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
  </div>
</div>
@endsection

@section('script')
<script>
var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
</script>
@endsection