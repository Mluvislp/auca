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
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blogCategory') }}">Quản lý danh mục bài viết</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thùng rác</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Thùng rác</h6>
            <p class="text-muted mb-3">Read the <a href="#" target="_blank"> Official DataTables
                    Documentation </a>for a full list of instructions and other options.</p>
            <div class="table-responsive overflow-hidden">
                <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="perfect-scrollbar-example pb-2">
                            <table id="dataTableExample" class="table dataTable no-footer"
                                aria-describedby="dataTableExample_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTableExample"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending"
                                            style="width: 195.163px;">ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                                            colspan="1" aria-label="Position: activate to sort column ascending"
                                            style="width: 306.925px;">TÊN DANH MỤC</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                                            colspan="1" aria-label="Position: activate to sort column ascending"
                                            style="width: 306.925px;">DANH MỤC CẤP</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                                            colspan="1" aria-label="Start date: activate to sort column ascending"
                                            style="width: 134.413px;">TRẠNG THÁI</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                                            colspan="1" aria-label="Position: activate to sort column ascending"
                                            style="width: 306.925px;">CẤU HÌNH SLUG</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                                            colspan="1" aria-label="Salary: activate to sort column ascending"
                                            style="width: 97.875px;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd">
                                        <td class="sorting_1">01</td>
                                        <td>Báo tài chính</td>
                                        <td>Cấp 0</td>
                                        <td>
                                            <span class="badge rounded-pill bg-primary">Kích hoạt</span>
                                        </td>
                                        <td>bao-tai-chinh</td>
                                        <td>
                                            <div class="btn-acction" style="display: flex;">
                                                <div class="btn-view" style="margin-right: 10px;">
                                                    <a data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl" href="">Xem</a>
                                                    <div class="modal fade bd-example-modal-xl" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Xem nhanh</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 grid-margin stretch-card">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <h6 class="card-title">
                                                                                        Thông tin </h6>
                                                                                    <form class="forms-sample">
                                                                                        <div class="mb-3">
                                                                                            <label for="exampleInputUsername1" class="form-label">Tên
                                                                                                danh mục
                                                                                            </label>
                                                                                            <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="Báo tài chính">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="exampleInputEmail1" class="form-label">Danh
                                                                                                mục cấp </label>
                                                                                            <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="Cấp 0">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="exampleInputPassword1" class="form-label">Cấu
                                                                                                hình slug
                                                                                            </label>
                                                                                            <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="bao-tai-chinh">
                                                                                        </div>
                                                                                        <div class="form-check form-check-inline">
                                                                                            <input type="radio" class="form-check-input" name="radioInlineSelectedDisabled" id="radioInlineSelectedDisabled" disabled="" checked="">
                                                                                            <label class="form-check-label" for="radioInlineSelectedDisabled">
                                                                                                Hiển thị
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="form-check form-check-inline">
                                                                                            <input type="radio" class="form-check-input" name="radioInlineDisabled" id="radioInlineDisabled" disabled="">
                                                                                            <label class="form-check-label" for="radioInlineDisabled">
                                                                                                Không hiển thị
                                                                                            </label>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 grid-margin stretch-card">
                                                                            <div class="card w-100 p-0">
                                                                                <div class="card-body">
                                                                                    <h6 class="card-title">Hình
                                                                                        ảnh</h6>
                                                                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                                                                        <div class="carousel-inner">
                                                                                            <div class="carousel-item active">
                                                                                                <img style="height: 100%" src="https://img.freepik.com/free-psd/food-menu-restaurant-facebook-cover-template_120329-1690.jpg" class="d-block w-100 rounded-0" alt="...">
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <img style="height: 100%" src="https://img.freepik.com/free-psd/food-menu-restaurant-facebook-cover-template_120329-1690.jpg" class="d-block w-100 rounded-0" alt="...">
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <img style="height: 100%" src="https://img.freepik.com/free-psd/food-menu-restaurant-facebook-cover-template_120329-1690.jpg" class="d-block w-100 rounded-0" alt="...">
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
                                                    <a href="#">Xóa vĩnh viễn</a>
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