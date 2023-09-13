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
            <li class="breadcrumb-item"><a href="{{ route('brand') }}">Quản lý nhãn hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thùng rác</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Nhãn hàng đã xóa</h6>
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
                                            style="width: 306.925px;">TÊN NHÃN HÀNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                                            colspan="1" aria-label="Office: activate to sort column ascending"
                                            style="width: 146.275px;">MÃ THƯƠNG HIỆU</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                                            colspan="1" aria-label="Age: activate to sort column ascending"
                                            style="width: 61.35px;">NGUỒN GỐC</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                                            colspan="1" aria-label="Start date: activate to sort column ascending"
                                            style="width: 134.413px;">Địa chỉ</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1"
                                            colspan="1" aria-label="Salary: activate to sort column ascending"
                                            style="width: 97.875px;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd">
                                        <td class="sorting_1">01</td>
                                        <td>Công ty thời trang nike</td>
                                        <td>Nike</td>
                                        <td>Nhãn hàng ngoài nước</td>
                                        <td>123, wallstreet New York city</td>
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
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 grid-margin stretch-card">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <h6 class="card-title">Thông tin
                                                                                    </h6>
                                                                                    <form class="forms-sample">
                                                                                        <div class="mb-3">
                                                                                            <label
                                                                                                for="exampleInputUsername1"
                                                                                                class="form-label">Tên nhãn hàng
                                                                                            </label>
                                                                                            <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="Công ty thời trang nike">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label
                                                                                                for="exampleInputEmail1"
                                                                                                class="form-label">Mã thương hiệu
                                                                                            </label>
                                                                                            <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="Nike">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label
                                                                                                for="exampleInputEmail1"
                                                                                                class="form-label">Địa chỉ
                                                                                            </label>
                                                                                            <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="123 wallstreet New York city">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label
                                                                                                for="exampleInputPassword1"
                                                                                                class="form-label">Nguồn gốc
                                                                                            </label>
                                                                                            <input type="text" class="form-control" id="exampleInputDisabled1" disabled="" value="Nhãn hàng ngoài nước">
                                                                                        </div>
                                                                                    </form>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 grid-margin stretch-card">
                                                                            <div class="card w-100 p-0">
                                                                                <div class="card-body">
                                                                                    <h6 class="card-title">Hình ảnh</h6>
                                                                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                                                                        <div class="carousel-inner">
                                                                                            <div class="carousel-item active">
                                                                                                <img style="height: 100%" src="https://substackcdn.com/image/fetch/f_auto,q_auto:good,fl_progressive:steep/https%3A%2F%2Fbucketeer-e05bbc84-baa3-437e-9518-adb32be77984.s3.amazonaws.com%2Fpublic%2Fimages%2F67979fc2-9bc6-4ef1-a91a-9f8129c57645_1500x1500.jpeg" class="d-block w-100" alt="...">
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <img style="height: 100%" src="https://substackcdn.com/image/fetch/f_auto,q_auto:good,fl_progressive:steep/https%3A%2F%2Fbucketeer-e05bbc84-baa3-437e-9518-adb32be77984.s3.amazonaws.com%2Fpublic%2Fimages%2F67979fc2-9bc6-4ef1-a91a-9f8129c57645_1500x1500.jpeg" class="d-block w-100" alt="...">
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <img style="height: 100%" src="https://substackcdn.com/image/fetch/f_auto,q_auto:good,fl_progressive:steep/https%3A%2F%2Fbucketeer-e05bbc84-baa3-437e-9518-adb32be77984.s3.amazonaws.com%2Fpublic%2Fimages%2F67979fc2-9bc6-4ef1-a91a-9f8129c57645_1500x1500.jpeg" class="d-block w-100" alt="...">
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
                                    <tr class="odd">
                                        <td class="sorting_1">02</td>
                                        <td>Công ty thời trang nike</td>
                                        <td>Nike2</td>
                                        <td>Nhãn hàng ngoài nước</td>
                                        <td>123, wallstreet New York city</td>
                                        <td>
                                            <div class="btn-acction" style="display: flex;">
                                                <div class="btn-view" style="margin-right: 10px;">
                                                    <a href="">Xem</a>
                                                </div>
                                                <div class="btn-edit" style="margin-right: 10px;">
                                                    <a href="{{ route('edit_brand') }}">Khôi phục</a>
                                                </div>
                                                <div class="btn-deleted" style="margin-right: 10px;">
                                                    <a href="">Xóa vĩnh viễn</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="even">
                                        <td class="sorting_1">Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009/01/12</td>
                                        <td>$86,000</td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="sorting_1">Bradley Greer</td>
                                        <td>Software Engineer</td>
                                        <td>London</td>
                                        <td>41</td>
                                        <td>2012/10/13</td>
                                        <td>$132,000</td>
                                    </tr>
                                    <tr class="even">
                                        <td class="sorting_1">Brielle Williamson</td>
                                        <td>Integration Specialist</td>
                                        <td>New York</td>
                                        <td>61</td>
                                        <td>2012/12/02</td>
                                        <td>$372,000</td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="sorting_1">Cedric Kelly</td>
                                        <td>Senior Javascript Developer</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2012/03/29</td>
                                        <td>$433,060</td>
                                    </tr>
                                    <tr class="even">
                                        <td class="sorting_1">Charde Marshall</td>
                                        <td>Regional Director</td>
                                        <td>San Francisco</td>
                                        <td>36</td>
                                        <td>2008/10/16</td>
                                        <td>$470,600</td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="sorting_1">Colleen Hurst</td>
                                        <td>Javascript Developer</td>
                                        <td>San Francisco</td>
                                        <td>39</td>
                                        <td>2009/09/15</td>
                                        <td>$205,500</td>
                                    </tr>
                                    <tr class="even">
                                        <td class="sorting_1">Dai Rios</td>
                                        <td>Personnel Lead</td>
                                        <td>Edinburgh</td>
                                        <td>35</td>
                                        <td>2012/09/26</td>
                                        <td>$217,500</td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="sorting_1">Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                    </tr>
                                    <tr class="even">
                                        <td class="sorting_1">Gloria Little</td>
                                        <td>Systems Administrator</td>
                                        <td>New York</td>
                                        <td>59</td>
                                        <td>2009/04/10</td>
                                        <td>$237,500</td>
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