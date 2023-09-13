@extends('backend.layout.layout') 

@section('title') 
Thùng rác 
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
        <li class="breadcrumb-item active" aria-current="page">Quản lý sản phẩm</li>
      </ol>
    </nav>
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Sản phẩm đã xóa</h6>
        <p class="text-muted mb-3">Read the <a href="#" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options. </p>
        <div class="table-responsive">
          <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="row">
              <div class="col-sm-12">
                <div class="perfect-scrollbar-example pb-2">
                  <table id="dataTableExample" class="table dataTable no-footer" aria-describedby="dataTableExample_info">
                    <thead>
                      <tr>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 195.163px;">ID</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 306.925px;">TÊN SẢN PHẨM</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 306.925px;">MÃ SẢN PHẨM</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 146.275px;">DANH MỤC</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 146.275px;">KHỐI LƯỢNG</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 306.925px;">NGÀY TẠO</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 134.413px;">ĐƯỜNG DẪN SẢN PHẨM</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 134.413px;">CẤU HÌNH SLUG</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 134.413px;">TRẠNG THÁI</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 97.875px;">Hành động</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="odd">
                        <td class="sorting_1">01</td>
                        <td>Khô gà lá chanh hộp - 200g</td>
                        <td>422208973</td>
                        <td>Đồ ăn vặt</td>
                        <td>Hộp 200g</td>
                        <td>13/03/2023</td>
                        <td>
                          <a style="color: blue;" href="#">http://127.0.0.1:8000/detail</a>
                        </td>
                        <td>kho-ga-la-chanh</td>
                        <td>
                            <span class="badge rounded-pill bg-primary">Kích hoạt</span>
                        </td>
                        <td>
                          <div class="btn-acction" style="display: flex;">
                            <div class="btn-view" style="margin-right: 10px;">
                              <a data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl" href="">Xem</a>
                              <div class="modal fade bd-example-modal-xl" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"> Xem nhanh</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-6 grid-margin stretch-card">
                                          <div class="card">
                                            <div class="card-body">
                                              <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                                                <li class="nav-item">
                                                  <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin</a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" id="profile-line-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Thông tin bổ xung</a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" id="contact-line-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Thông tin khuyến mãi</a>
                                                </li>
                                              </ul>
                                              <div class="tab-content mt-3" id="lineTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
                                                  <form class="forms-sample">
                                                    <div class="mb-3">
                                                      <label for="exampleInputUsername1" class="form-label">Tên sản phẩm </label>
                                                      <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="Khô gà lá chanh giòn rụm (Hộp 500g)">
                                                    </div>
                                                    <div class="mb-3">
                                                      <label for="exampleInputEmail1" class="form-label">Mã sản phẩm </label>
                                                      <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="422208973">
                                                    </div>
                                                    <div class="mb-3">
                                                      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                        <div class="col">
                                                          <label for="exampleInputEmail1" class="form-label">Giá bán </label>
                                                          <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="240.000đ">
                                                        </div>
                                                        <div class="col">
                                                          <label for="exampleInputEmail1" class="form-label">Giá giảm </label>
                                                          <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="180.000đ">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="mb-3">
                                                      <label for="exampleInputPassword1" class="form-label">Cấu hình slug </label>
                                                      <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="kho-ga-la-chanh">
                                                    </div>
                                                    <div class="mb-3">
                                                      <label for="exampleInputPassword1" class="form-label">Ghi chú </label>
                                                      <textarea id="maxlength-textarea" class="form-control" style="height: 100px;" disabled="" maxlength="100" rows="8" placeholder="Sản phẩm được làm 100% từ gà thật"></textarea>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input type="radio" class="form-check-input" name="radioInlineSelectedDisabled" id="radioInlineSelectedDisabled" disabled="" checked="">
                                                      <label class="form-check-label" for="radioInlineSelectedDisabled"> Hiển thị </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input type="radio" class="form-check-input" name="radioInlineDisabled" id="radioInlineDisabled" disabled="">
                                                      <label class="form-check-label" for="radioInlineDisabled"> Không hiển thị </label>
                                                    </div>
                                                  </form>
                                                </div>
                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-line-tab">
                                                  <form class="forms-sample">
                                                    <div class="mb-3">
                                                      <label for="exampleInputUsername1" class="form-label">Đơn vị cung cấp </label>
                                                      <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="Công ty cổ phần thực phẩm xanh sạch đẹp 123">
                                                    </div>
                                                    <div class="mb-3">
                                                      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                        <div class="col">
                                                          <label for="exampleInputEmail1" class="form-label">Thuộc danh mục </label>
                                                          <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="KHÔ GÀ TỔNG HỢP">
                                                        </div>
                                                        <div class="col">
                                                          <label for="exampleInputEmail1" class="form-label">Thuộc nhãn hàng </label>
                                                          <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="DUMBUM HCM">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="mb-3">
                                                      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                        <div class="col">
                                                          <label for="exampleInputEmail1" class="form-label">Quy trình đóng gói </label>
                                                          <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="Lon nhựa">
                                                        </div>
                                                        <div class="col">
                                                          <label for="exampleInputEmail1" class="form-label">Trọng lượng </label>
                                                          <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="500g">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="mb-3">
                                                      <label for="exampleInputPassword1" class="form-label">Hạn sử dụng </label>
                                                      <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="6 tháng kể từ lúc mua hàng">
                                                    </div>
                                                    <div class="mb-3">
                                                      <label for="exampleInputPassword1" class="form-label">Vệ sinh thực phẩm </label>
                                                      <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="Giấy phép từ bộ y tế">
                                                    </div>
                                                    <div class="mb-3">
                                                      <label for="exampleInputPassword1" class="form-label">Kho hàng </label>
                                                      <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="Kho hàng tại HCM">
                                                    </div>
                                                  </form>
                                                </div>
                                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-line-tab">
                                                  <div class="card">
                                                    <div class="card-body">
                                                      <h6 class="card-title">QUÀ TẶNG ĐI KÈM</h6>
                                                      <p class="text-muted mb-3"> Được tạo từ <code>thêm sản phẩm</code>
                                                      </p>
                                                      <div class="table-responsive">
                                                        <table class="table table-hover">
                                                          <thead>
                                                            <tr>
                                                              <th># </th>
                                                              <th>Tên quà tặng</th>
                                                              <th>Giá bán</th>
                                                              <th>Giá giảm</th>
                                                              <th>Ngày phát hành</th>
                                                              <th>Ngày kết thúc</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <tr>
                                                              <th>1 </th>
                                                              <td>Snack hoa cải</td>
                                                              <th>25.000đ</th>
                                                              <td>22.000đ</td>
                                                              <td>23/03/2023</td>
                                                              <td>24/03/2023</td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <br>
                                                  <div class="card">
                                                    <div class="card-body">
                                                      <h6 class="card-title">KHUYẾN MÃI KHI MUA KÈM</h6>
                                                      <p class="text-muted mb-3"> Được tạo từ <code> thêm sản phẩm </code>
                                                      </p>
                                                      <div class="table-responsive">
                                                        <table class="table table-hover">
                                                          <thead>
                                                            <tr>
                                                              <th># </th>
                                                              <th>Tên combo</th>
                                                              <th>Giá bán</th>
                                                              <th>Giá giảm</th>
                                                              <th>Ngày phát hành</th>
                                                              <th>Ngày kết thúc</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <tr>
                                                              <th>1</th>
                                                              <th>Combo 3 con gà cười</th>
                                                              <td>399.000đ</td>
                                                              <td>299.000đ</td>
                                                              <td>23/03/2023</td>   
                                                              <td>24/03/2023</td>
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
                                        <div class="col-md-6 grid-margin stretch-card">
                                          <div class="card w-100 p-0">
                                            <div class="card-body">
                                              <h6 class="card-title">Hình ảnh </h6>
                                              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                  <div class="carousel-item active">
                                                    <img style="height: 100%" src="https://vn-live-01.slatic.net/p/4d302e982de069877bb3bbf2321012d5.jpg" class="d-block w-100 rounded-0" alt="...">
                                                  </div>
                                                  <div class="carousel-item">
                                                    <img style="height: 100%" src="https://vn-live-01.slatic.net/p/4d302e982de069877bb3bbf2321012d5.jpg" class="d-block w-100 rounded-0" alt="...">
                                                  </div>
                                                  <div class="carousel-item">
                                                    <img style="height: 100%" src="https://vn-live-01.slatic.net/p/4d302e982de069877bb3bbf2321012d5.jpg" class="d-block w-100 rounded-0" alt="...">
                                                  </div>
                                                </div>
                                                <a class="carousel-control-prev" data-bs-target="#carouselExampleControls" role="button" data-bs-slide="prev">
                                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                  <span class="visually-hidden">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" data-bs-target="#carouselExampleControls" role="button" data-bs-slide="next">
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
                              <a href="#">Khôi phục</a>
                            </div>
                            <div class="btn-deleted" style="margin-right: 10px;">
                              <a href="">Xóa vĩnh viễn</a>
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
  
  @endsection @section('script')
  <script>
    var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
  </script> 
  @endsection