@extends('backend.layout.layout')

@section('title')
In mã vạch
@endsection

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product') }}">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">In hóa đơn</li>
        </ol>
    </nav>
    <form action="{{ route('suppliers.store') }}" method="post">
        @csrf
        <div class="row">

            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="heading">
                            <h6 class="card-title">
                                <i class="icon-lg pb-3px my-auto mx-2" data-feather="codepen"></i>
                                Sản phẩm từ các phiếu XNK: <span>229946517</span> 
                            </h6>
                        </div>
                        <hr>
                        
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <select class="form-select" id="status">
                                        <option selected="">- Chọn doanh nghiệp -</option>
                                        <option value="1">shangyang132</option>
                                        <option value="2">shangyang123</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">Tìm sản phẩm</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Nhập theo ri</a></li>
                                    </ul>
                                    <input type="text" placeholder="Vui lòng nhập tên sản phẩm" class="form-control"
                                        aria-label="Text input with dropdown button">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 d-flex align-items-center gap-2">
                            <div>
                              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                Thao tác
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down icon-lg pb-3px"><polyline points="6 9 12 15 18 9"></polyline></svg>
                              </button>
                              <ul class="dropdown-menu" style="">
                                <li>
                                  <a class="dropdown-item fs-5" href="#">
                                    <i class="icon-lg pb-3px my-auto mx-2" data-feather="file-text"></i>
                                    Xuất excel in mã vạch
                                  </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger fs-5" href="#">
                                      <i class="icon-lg pb-3px my-auto mx-2 text-danger" data-feather="trash-2"></i>
                                      Xóa danh sách
                                    </a>
                                </li>
                              </ul>
                            </div>
                        </div>

                        <div class="body-table">

                            <div class="table-responsive overflow-hidden">
                                <div id="dataTableExample_wrapper"
                                    class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="dataTableExample"
                                                class="table dataTable no-footer table-bordered"
                                                aria-describedby="dataTableExample_info">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Mã
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Mã sản phẩm
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Tên sản phẩm
                                                        </th>
                                                        <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableExampleHero"
                                                            rowspan="1" colspan="1">
                                                            <div>
                                                                <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Giá bán lẻ
                                                            </span>
                                                            <ul class="dropdown-menu p-3">
                                                                <li>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" id="var_require" name="var_require" value="Y">
                                                                        <label class="form-check-label" for="var_require">Lấy giá bán lẻ nếu sản phẩm chưa điền giá sỉ</label>
                                                                    </div>
                                                                </li>
                                                                <hr>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" id="var_require" name="var_require" value="Y">
                                                                                <label class="form-check-label" for="var_require">Giá bán lẻ</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" id="var_require" name="var_require" value="Y">
                                                                                <label class="form-check-label" for="var_require">Giá bán sỉ</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            </div>
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Số tồn
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Số lượng
                                                        </th>
                                                        <th class="sorting text-center text-black" tabindex="0"
                                                            aria-controls="dataTableExample" rowspan="1"
                                                            colspan="1">
                                                            Xóa
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">
                                                            2000214247541
                                                        </td>
                                                        <td class="text-center">
                                                            A05.A17.TOTE
                                                        </td>
                                                        <td class="text-center">
                                                            <p>
                                                                [Freeship Max] Combo ưu đãi Bàn chải đánh răng điện cảm ứng Anriea
                                                            </p>
                                                        </td>
                                                        <td class="text-center">
                                                            1.850.000
                                                        </td>
                                                        <td class="text-center">
                                                            5
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="number" max="99999" min="0" value="1" class="form-control" data-id="6">
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="fs-5 text-danger"
                                                                href="#">
                                                            <i class="icon-lg text-danger pb-3px"
                                                                data-feather="trash-2"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><br>

                        <div class="btn-submit">
                            <a href="/">
                                <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="heading">
                            <h6 class="card-title">Cấu hình tem in</h6>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div>
                                <div class="barcode-container text-center border-1 p-3 mb-3">
                                    <div class="product-details">
                                        <div class="product-name">Product Name</div>
                                    </div>

                                    <div>
                                        <div class="mx-auto" style="font-size:0;position:relative;width:268px;height:30px;">
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:12px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:6px;height:30px;position:absolute;left:22px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:6px;height:30px;position:absolute;left:30px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:38px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:44px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:54px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:6px;height:30px;position:absolute;left:58px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:66px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:70px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:80px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:88px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:94px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:6px;height:30px;position:absolute;left:100px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:110px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:6px;height:30px;position:absolute;left:114px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:8px;height:30px;position:absolute;left:122px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:132px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:144px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:148px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:154px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:8px;height:30px;position:absolute;left:162px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:172px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:176px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:184px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:194px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:198px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:206px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:8px;height:30px;position:absolute;left:210px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:8px;height:30px;position:absolute;left:220px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:230px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:236px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:242px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:6px;height:30px;position:absolute;left:252px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:2px;height:30px;position:absolute;left:260px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:4px;height:30px;position:absolute;left:264px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:0px;height:30px;position:absolute;left:268px;top:0px;">&nbsp;</div>
                                            <div style="background-color:black;width:0px;height:30px;position:absolute;left:268px;top:0px;">&nbsp;</div>
                                            </div>
                                        
                                            <div class="product-details">
                                            <div class="product-name">PD-123</div>
                                            <div class="product-name">Product Name</div>
                                            <div class="product-price">$99.99</div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div>
                                        <p>
                                            - Chỉ chọn được tối đa 3 loại. Nếu để tên sản phẩm 3 dòng thì chỉ chọn được tối đa 2 loại.
                                        </p>
                                        <br>
                                        <p>
                                            - Nếu chọn Mẫu giấy cuộn 1 nhãn (50x30mm), mẫu tem trang sức (80x10mm) thì được chọn tất cả.
                                        </p>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col">

                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="var_require" name="var_require" value="Y">
                                                <label class="form-check-label" for="var_require">Hiện tên shop</label>
                                            </div>
                                            <input type="text" class="form-control" id="var_description" name="var_description" value="shangyang132" autocomplete="off" placeholder="Nhập điều chỉnh">
                                        </div>

                                        <br>
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="var_require" name="var_require" value="Y">
                                                <label class="form-check-label" for="var_require">Hiện mã sản phẩm</label>
                                            </div>
                                        </div>
                                        
                                        <br>
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="var_require" name="var_require" value="Y">
                                                <label class="form-check-label" for="var_require">Hiện tên sản phẩm</label>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="var_require" name="var_require" value="Y">
                                                <label class="form-check-label" for="var_require">Hiện giá sản phẩm</label>
                                            </div>
                                        </div>
                                        
                                        <br>
                                        <div class="mb-3">
                                            <p class="form-check-label" for="var_require">Mã vạch</p>
                                        </div>

                                        <br>
                                        <div class="mb-3">
                                            <p class="form-check-label" for="var_require">Đơn vị tiền sau giá bán</p>
                                        </div>

                                        {{-- <br>
                                        <div class="mb-3">
                                            <p class="form-check-label" for="var_require">Hiện số thứ tự tem</p>
                                        </div> --}}

                                        <br>
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="var_require" name="var_require" value="Y">
                                                <label class="form-check-label" for="var_require">Hiện giá cũ</label>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="var_require" name="var_require" value="Y">
                                                <label class="form-check-label" for="var_require">Hiện 3 dòng tên sản phẩm</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col">

                                        <div class="mb-3">
                                            <select class="form-select mt-4" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <select class="form-select mt-4" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <select class="form-select mt-4" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <select class="form-select mt-4" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 hidden">
                                            <select class="form-select mt-4" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 hidden">
                                            <input type="text" class="form-control" id="var_description" name="var_description" value="đ" autocomplete="off" placeholder="Nhập điều chỉnh">
                                        </div>
                                        
                                        {{-- <div class="mb-3">
                                            <select class="form-select mt-4" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">Hiện trước tên sản phẩm</option>
                                                <option>Hiện sau tên sản phẩm</option>
                                                <option>Không hiện</option>
                                            </select>
                                        </div> --}}

                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <br>
                                        <div class="mb-3">
                                            <p>Loại mã</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <select class="form-select mt-4" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">Mã</option>
                                                <option>C39</option>
                                                <option>C128</option>
                                                <option>C128A</option>
                                                <option>EAN13</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                {{-- <div class="card p-0">
                    <div class="card-body">
                        <h6 class="card-title">Cài đặt font chữ</h6>
                        <hr>

                        <div class="row">

                            <div class="col">

                                <div class="mb-4">
                                    <p>Hiện số thứ tự tem</p>
                                </div>

                                <div class="mb-4">
                                    <p>Tên shop</p>
                                </div>

                                <div class="mb-4">
                                    <p>Mã sản phẩm</p>
                                </div>

                                <div class="mb-4">
                                    <p>Mã sản phẩm</p>
                                </div>

                                <div class="mb-4">
                                    <p>Mã sản phẩm</p>
                                </div>

                            </div>

                            <div class="col">

                                <div class="mb-3">
                                    <select class="form-select" name="age_select" id="ageSelect">
                                        <option selected="" disabled="">Roboto (Hỗ trợ tiếng việt, tiếng anh)</option>
                                        <option>English - Hỗ trợ tiếng anh</option>
                                        <option>Taiwand - Hỗ trợ tiếng đài loan</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <div class="row g-1">
                                        <div class="col">
                                            <select class="form-select" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">Trung bình</option>
                                                <option>- Cỡ -</option>
                                                <option>To</option>
                                                <option>Trung bình</option>
                                                <option>Nhỏ</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">Trung bình</option>
                                                <option>- Kiểu -</option>
                                                <option>Đậm</option>
                                                <option>Trung bình</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="row g-1">
                                        <div class="col">
                                            <select class="form-select" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">Trung bình</option>
                                                <option>- Cỡ -</option>
                                                <option>To</option>
                                                <option>Trung bình</option>
                                                <option>Nhỏ</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">Trung bình</option>
                                                <option>- Kiểu -</option>
                                                <option>Đậm</option>
                                                <option>Trung bình</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row g-1">
                                        <div class="col">
                                            <select class="form-select" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">Trung bình</option>
                                                <option>- Cỡ -</option>
                                                <option>To</option>
                                                <option>Trung bình</option>
                                                <option>Nhỏ</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">Trung bình</option>
                                                <option>- Kiểu -</option>
                                                <option>Đậm</option>
                                                <option>Trung bình</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row g-1">
                                        <div class="col">
                                            <select class="form-select" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">Trung bình</option>
                                                <option>- Cỡ -</option>
                                                <option>Rất To</option>
                                                <option>To</option>
                                                <option>Trung bình</option>
                                                <option>Nhỏ</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" name="age_select" id="ageSelect">
                                                <option selected="" disabled="">Trung bình</option>
                                                <option>- Kiểu -</option>
                                                <option>Đậm</option>
                                                <option>Trung bình</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div> --}}

                {{-- <br> --}}
{{-- 
                <div class="print-size">
                    <div class="card p-0">
                        <div class="card-body">
                            <h6 class="card-title">Chọn khổ giấy và in</h6>
                            <hr>
    
                            <div class="row">
                                <b>Căn lề giấy in (Đơn vị mm)</b>
                                <div class="col">
                                    <span>Căn trái</span>
                                    <input type="number" value="0" name="cat_code" maxlength="255" class="required form-control" id="cat_code" autocomplete="off" value="" placeholder="Căn trái">
                                </div>
                                <div class="col">
                                    <span>Căn trên</span>
                                    <input type="number" value="0" name="cat_code" maxlength="255" class="required form-control" id="cat_code" autocomplete="off" value="" placeholder="Căn trên">
                                </div>
                            </div>
    
                            <div class="card mt-3">
                                <div class="card-header header-elements-inline bg-light d-flex align-items-center justify-content-between">
                                    <h5 class="card-title font-weight-semibold mb-0">
                                        Chọn khổ giấy và in
                                    </h5>
                                    <div class="header-elements">
                                        <div class="list-icons">
                                            <a class="list-icons-item" data-bs-toggle="collapse" href="#list-images-item" aria-expanded="true" aria-controls="list-images-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down icon-xl pb-3px"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="card-body collapse" id="list-images-item" style="">
                                    <div class="form-group mb-2">
                                        <div class="row mt-4">
                                            <div class="col">
                                                <p>Mẫu giấy <b>180</b> nhãn </p>
                                                <span>- Khổ A4 - 20x15mm.</span>
                                                <div class="mt-3">
                                                    <button id="btnSaveForm" type="submit" class="btn btn-success">
                                                        Xem và in
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <img src="https://sonca.vn/wp-content/uploads/2020/09/Bia-mau-A4-160-gsm-mau-trang_3.jpg" alt="">
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col">
                                                <p>Mẫu giấy <b>180</b> nhãn </p>
                                                <span>- Khổ A4 - 20x15mm.</span>
                                                <div class="mt-3">
                                                    <button id="btnSaveForm" type="submit" class="btn btn-success">
                                                        Xem và in
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <img src="https://sonca.vn/wp-content/uploads/2020/09/Bia-mau-A4-160-gsm-mau-trang_3.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <p>Mẫu giấy <b>180</b> nhãn </p>
                                    <span>- Khổ A4 - 20x15mm.</span>
                                    <div class="mt-3">
                                        <button id="btnSaveForm" type="submit" class="btn btn-success">
                                            Xem và in
                                        </button>
                                    </div>
                                </div>
                                <div class="col">
                                    <img src="https://sonca.vn/wp-content/uploads/2020/09/Bia-mau-A4-160-gsm-mau-trang_3.jpg" alt="">
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div> --}}

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

<script>
    var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
</script>

@endsection