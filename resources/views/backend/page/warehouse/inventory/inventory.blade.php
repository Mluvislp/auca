@extends('backend.layout.layout')

@section('title')
Sản phẩm tồn kho
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
      <li class="breadcrumb-item active" aria-current="page">Sản phẩm tồn kho</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('inventory') }}">Sản phẩm tồn kho</a>
        </li>
      </ul>
      <div class="tab-content mt-3" id="lineTabContent">

        {{-- table --}}
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
          <div class="card-body p-0 pt-2">

            <!-- Start Filter content -->
            <div class="filter">
              <div class="row mb-3">

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <input type="text" name="filter_prd_id" placeholder="ID" maxlength="30" id="filter_prd_id" class="form-control" value="">
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                        <input type="search" name="filter_prd_id_box" class="form-control" placeholder="Vui lòng nhập" id="filter_prd_id_box">
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                        <select class="form-select" aria-label="multiple select example"
                                name="filter_w_id[]"
                                id="filter_w_id"  custom-multiple multiple multiselect-search="true"
                                multiselect-select-all="true"
                                multiselect-max-items="1">
                        <option value="">Chọn Store</option>
                        @php
                            printWarehouse($warehouse)
                        @endphp
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                        <select class="form-select" aria-label="multiple select example"
                                name="filter_brand_id[]"
                                id="filter_brand_id"  custom-multiple multiple multiselect-search="true"
                                multiselect-select-all="true"
                                multiselect-max-items="1">
                          @php
                              printBrand($brand)
                          @endphp
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-1 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_var_cat_id[]"
                        id="filter_var_cat_id">
                        <option value="hihi">- Tồn -</option>
                        <option value="">Còn tồn</option>
                        <option value="">Có thể bán</option>
                        <option value="">Còn tồn trong kho</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2 pr-1">
                  <div class="form-group input-group mb-0 pt-3">
                    <div class="col p-0">
                      <select class="form-select" aria-label="select example" name="filter_prd_type_id[]"
                        id="filter_prd_type_id">
                          @php
                              printProductType($type_product)
                          @endphp
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-1 pt-3">
                  <!-- Example split danger button -->
                  <div class="btn-group">
                    <button type="button" name="submit-filter-inventory" class="btn btn-success">Lọc</button>
                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split"
                      data-bs-toggle="collapse" data-bs-target="#filter-advanced-elements" aria-expanded="false"
                      aria-controls="filter-advanced-elements">
                    </button>
                  </div>
                </div>
              </div>

              <div class="collapse row m-0 col-12 pl-0 pr-0 mt-3 mb-3" id="filter-advanced-elements">

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                      <label class="col-form-label text-right col-12 pl-0 pr-0">Danh mục</label>
                      <div class="col-12 pr-0">
                          <select class="form-select" aria-label="multiple select example"
                                  name="filter_prd_cat_id[]"
                                  id="filter_prd_cat_id"  custom-multiple multiple multiselect-search="true"
                                  multiselect-select-all="true"
                                  multiselect-max-items="1">
                              @php
                                  printCategories($categories)
                              @endphp
                          </select>
                      </div>
                  </div>
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Danh mục nội bộ</label>
                    <div class="col-12 pr-0">
                        <select class="form-select" aria-label="multiple select example"
                                name="filter_prd_cat_inter_id[]"
                                id="filter_prd_cat_inter_id"  custom-multiple multiple multiselect-search="true"
                                multiselect-select-all="true"
                                multiselect-max-items="1">
                            @php
                                printCategoryInternal($categories_internal)
                            @endphp
                        </select>
                    </div>
                </div>
              </div>

                <div class="col-12 col-md-4 col-lg-3 pr-0">
                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Trạng thái</label>
                    <div class="col-12 pr-0">
                      <select class="form-select" aria-label="select example" name="filter_prd_status_id[]" id="filter_prd_status_id">
                        <option value="">- Trạng thái -</option>
                        <option value="1">Mới</option>
                        <option value="2">Đang bán</option>
                        <option value="3">Ngừng bán</option>
                        <option value="4">Hết hàng</option>
                      </select>
                    </div>
                  </div>

                  <div class="row form-group input-group fInputHidden">
                    <label class="col-form-label text-right col-12 pl-0 pr-0">Nhà cung cấp</label>
                    <div class="col-12 pr-0">
                      <input type="text" name="filter_prd_sup_id" maxlength="30" id="filter_prd_sup_id" class="form-control" value="">
                    </div>
                  </div>
                </div>

              </div>

              <div class="mb-3 d-flex align-items-center gap-2">
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                    Thao tác
                    <i class="icon-lg pb-3px" data-feather="chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="file-plus"></i>
                        Xuất Excel
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                        Thêm phiếu chuyển kho nháp
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item fs-5" href="#">
                        <i class="icon-lg pb-3px" data-feather="plus"></i>
                        Thêm yêu cầu nhà cung cấp
                      </a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
            <!-- End filter content -->

            <div class="table-responsive overflow-hidden">
              <div id="datatableInventory_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row">
                  <div class="col-sm-12 table-responsive">
                    <table id="datatableInventory" class="table dataTable no-footer table-bordered"
                      aria-describedby="datatableInventory_info">
                      <thead class="table-light">

                      </thead>
                      <tbody>


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
        var token = localStorage.getItem("Token");
        $(document).ready(function () {
            $('#filter_prd_type').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: "Loại sản phẩm",
            });
            $('#filter_prd_id_box').select2({
                placeholder: 'Tìm kiếm Sản Phẩm',
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('product.select2') }}",
                    dataType: 'json',
                    delay: 250,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        var data = data.data
                        var map = data.map(item => {
                            return {
                                id: item.prd_id,
                                text: item.prd_name
                            };
                        })
                        return {
                            results: map
                        };
                    },
                    cache: true
                }
            });
            $('#filter_prd_id_box').on('select2:select', function(e) {
                var selectedOption = e.params.data;
                var id = selectedOption.id
                var name = selectedOption.text

                $(this).val(id).trigger('change');
                $(this).next('.select2-container').find('.select2-selection__rendered').text(name);
            });
            function initializeDataTable() {
                var filter_w_id = $('#filter_w_id').val();
                $.ajax({
                    url: '{{route('productinventory.head')}}',
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    data: {
                        filter_w_id: JSON.stringify(filter_w_id)
                    },
                    success: function (response) {
                        var headData = response.data.name;
                        var all = response.data.all;
                        var hide = response.data.diff;
                        var dynamicColumns = [];
                        var totalColumnIndex = -1;
                        dynamicColumns.push({
                            data: 'prd_name',
                            name: 'prd_name',
                            title: "Tên sản phẩm"
                        });
                        var count = 1;
                        var indexWaCol = {};
                        all.forEach(function(i) {
                            var columnId = 'warehouse_' + i;
                            dynamicColumns.push({
                                data: 'warehouse.' + i + '.wp_quantity',
                                name: columnId,
                                title: headData[i]
                            });
                            indexWaCol[i] = count;
                            count++;
                        });
                        totalColumnIndex = count+1;
                        var hideCol = {};
                        hide.forEach(function(column, index) {
                            var columnName = indexWaCol[column];
                            hideCol[index] = columnName;
                        });
                        dynamicColumns.push({
                            data: 'total',
                            name: 'total',
                            title: 'Tổng',
                        });
                        $('#datatableInventory').DataTable({
                            destroy: true,
                            serverSide: true,
                            scrollX: true,
                            scrollY: "800px",
                            autoHeight: false,
                            ajax: {
                                url: '{{route('productinventory.all')}}',
                                type: 'GET',
                                beforeSend: function (xhr) {
                                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                                },
                                data: function (data) {
                                    data.page = (data.start / data.length) + 1;
                                    data.per_page = data.length;
                                    data.search = data.search.value;

                                    data.filter_prd_id = $('#filter_prd_id').val();
                                    data.filter_prd_id_box = $('#filter_prd_id_box').val();
                                    data.filter_w_id = $('#filter_w_id').val();
                                    data.filter_brand_id = $('#filter_brand_id').val();
                                    data.filter_prd_type_id = $('#filter_prd_type_id').val();
                                    data.filter_prd_cat_id = $('#filter_prd_cat_id').val();
                                    data.filter_prd_cat_inter_id = $('#filter_prd_cat_inter_id').val();
                                    data.filter_prd_status_id = $('#filter_prd_status_id').val();
                                    data.filter_prd_sup_id = $('#filter_prd_sup_id').val();
                                },
                                dataSrc: function (response) {
                                    response.recordsTotal = response.data.total;
                                    response.recordsFiltered = response.data.total;
                                    return response.data.data;
                                },
                                error: function (xhr) {
                                    if (xhr.status === 404) {
                                        $('#datatableInventory').html(
                                            '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
                                        );
                                    }
                                }
                            },
                            columns: dynamicColumns,
                            columnDefs: [
                                {
                                    targets: Object.values(hideCol),
                                    visible: false
                                }
                            ],
                            searching: false,
                            lengthMenu: [
                                [10, 25, 50],
                                [10, 25, 50]
                            ],
                            pageLength: 10,
                        });
                    },
                });
            }
            initializeDataTable();
            $('button[name=submit-filter-inventory]').click(function () {
                initializeDataTable();
            });
        });
    </script>
@endsection
