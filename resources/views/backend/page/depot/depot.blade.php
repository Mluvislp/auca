@extends('backend.layout.layout')

@section('title')
Kho hàng
@endsection

@section('content')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Bảng điều khiển</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Quản lý kho hàng</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Quản lý kho hàng</a>
                </li>
            </ul>
            <div class="tab-content mt-3" id="lineTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
                    <div class="card-body p-0 pt-2">
                        <!-- Start Filter content -->
                        <div class="filter">

                            <div class="mb-3 d-flex align-items-center gap-2">
                                <div>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="dropdown"
                                        aria-expanded="false"> Thao tác <i class="icon-lg pb-3px"
                                            data-feather="chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item fs-5" href="{{ route('add_depot') }}">
                                                <i class="icon-lg pb-3px" data-feather="plus"></i> Thêm mới kho hàng </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- End filter content -->
                        <div class="table-responsive overflow-hidden">
                            <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="dataTableExample" class="table dataTable no-footer table-bordered"
                                            aria-describedby="dataTableExample_info">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="sorting text-center text-black" tabindex="0"
                                                        aria-controls="dataTableExample" rowspan="1" colspan="1"> STT
                                                    </th>
                                                    <th class="sorting text-center text-black" tabindex="0"
                                                        aria-controls="dataTableExample" rowspan="1" colspan="1">
                                                        Tên kho hàng
                                                    </th>
                                                    <th class="sorting text-center text-black" tabindex="0"
                                                        aria-controls="dataTableExample" rowspan="1" colspan="1">
                                                        Địa chỉ
                                                    </th>
                                                    <th class="sorting text-center text-black" tabindex="0"
                                                        aria-controls="dataTableExample" rowspan="1" colspan="1">
                                                        Số điện thoại
                                                    </th>
                                                    <th class="sorting text-center text-black" tabindex="0"
                                                        aria-controls="dataTableExample" rowspan="1" colspan="1">
                                                        <i class="icon-lg text-black pb-3px"
                                                            data-feather="settings"></i>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center">
                                                        <p>AU CA TRADING COMPANY LIMITED</p>
                                                    </td>
                                                    <td class="text-center">0315020377</td>
                                                    <td class="text-center">0902 933 280</td>
                                                    <td class="text-center">
                                                        <span class="dropdown-toggle cursor-pointer"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="icon-lg pb-3px" data-feather="menu"></i>
                                                        </span>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item fs-5" href="{{ route('edit_depot') }}">
                                                                    <i class="icon-lg pb-3px" data-feather="edit"></i> 
                                                                    Sửa thông tin
                                                                </a>        
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item fs-5 text-danger" href="#">
                                                                    <i class="icon-lg text-danger pb-3px" data-feather="trash-2"></i> 
                                                                    Xóa thông tin 
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
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<script type="text/javascript">
    const appSecret = "8yKAGKZRvrDvJ1DkGI1cMnEtmEjKvJfL"; // Thay YOUR_APP_SECRET bằng mật khẩu ứng dụng của bạn
    var token = localStorage.getItem("Token_lazada");
    const signRequest = (appSecret, apiPath, params) => {
      // 1. Sort all request parameters (except the “sign” and parameters with byte array type)
      const keysortParams = keysort(params);
      // 2. Concatenate the sorted parameters into a string i.e. "key" + "value" + "key2" + "value2"...
      const concatString = concatDictionaryKeyValue(keysortParams);
      // 3. Add API name in front of the string in (2)
      const preSignString = apiPath + concatString;
      // 4. Encode the concatenated string in UTF-8 format & and make a digest (HMAC_SHA256)
      const hash = CryptoJS.HmacSHA256(preSignString, appSecret);
      // 5. Convert the digest to hexadecimal format
      const signature = CryptoJS.enc.Hex.stringify(hash);
      return signature.toUpperCase(); // must use upper case
    };
    const keysort = (unordered) => {
      return Object.keys(unordered).sort().reduce((ordered, key) => {
        ordered[key] = unordered[key];
        return ordered;
      }, {});
    };
    const concatDictionaryKeyValue = (object) => {
      return Object.keys(object).reduce(
        (concatString, key) => concatString.concat(key + object[key]), '');
    };
  
    function GetProduct() {
      var paramenter = {
        access_token: token,
      };
      $.ajax({
        url: "https://node.hannguhiendai.com/lazada/product",
        type: 'GET',
        data: paramenter,
        success: function(response) {
          console.log(response)
          var productData = response.data
          productData.forEach(item => {
            const dataDATA = item
            console.log(item)
            const newRow = `
                  <tr>
                      <td class="text-center">1</td>
                      <td class="text-start"> lazada:
                        ${dataDATA.skus[0].ShopSku}
                      </b>
                  </td>
                  <td class="text-start">${dataDATA.attributes.name}</td>
                  <td class="text-center">${dataDATA.skus[0].price}</td>
                  <td class="text-center">
                      <input type="number" max="99999" min="0"
                        value="${dataDATA.skus[0].quantity}" class="form-control" data-id="6">
                      </td>
                      <td class="text-center">
                          <input type="text" max="99999" min="0"
                            class="form-control" data-id="6">
                          </td>
                          <td class="text-center">Null</td>
                          <td class="text-center">
                              <a href="#">1</a>
                          </td>
                          <td class="text-center">
                              <div class="form-check form-switch d-flex justify-content-center align-items-center">
                                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                              </div>
                              </td>
                              <td class="text-center">
                                  <span class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                                      <i class="icon-lg pb-3px" data-feather="menu"></i>
                                  </span>
                                  <ul class="dropdown-menu">
                                      <li>
                                          <a class="dropdown-item fs-5" href="#">
                                              <i class="icon-lg pb-3px" data-feather="edit"></i>
                                                                          Sửa sku
                                          </a>
                                      </li>
                                      <li>
                                          <a class="dropdown-item fs-5 text-danger"
                                                                          href="#">
                                              <i class="icon-lg text-danger pb-3px"
                                                                              data-feather="trash-2"></i>
                                                                          Xóa sản phẩm lấy về
                                                                      
                                          </a>
                                      </li>
                                  </ul>
                              </td>
                          </tr>
                                          `;
            $("#dataRow").append(newRow);
          });
        }
      });
    }
    GetProduct()
</script>

@endsection