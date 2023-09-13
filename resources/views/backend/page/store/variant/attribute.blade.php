@extends('backend.layout.layout')

@section('title')
Nhóm thuộc tính
@endsection

@section('style')

@endsection

@section('content')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Bảng điều khiển</a></li>
      <li class="breadcrumb-item"><a href="<?= Route('variant') ?>">Thuộc tính</a></li>
      <li class="breadcrumb-item active" aria-current="page">Giá trị thuộc tính</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
        @include('backend.components.modalconfirm')
        <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
            aria-controls="home" aria-selected="true">Giá trị thuộc tính</a>
        </li>
      </ul>
      <div class="tab-content mt-3" id="lineTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
          <div class="card-body p-0 pt-2">
            <!-- Start Filter content -->
            <div class="row mb-3">
              <div class="col-6 col-md-3 col-lg-2 pr-1">
                <div class="form-group input-group mb-0 pt-3">
                  <div class="col p-0">
                    <input type="text" name="vv_id" maxlength="255" placeholder="ID" id="vv_id" class="form-control" value="">
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-3 col-lg-2 pr-1">
                <div class="form-group input-group mb-0 pt-3">
                  <div class="col p-0">
                    <input type="text" name="vv_name" maxlength="255" placeholder="Tên giá trị thuộc tính" autofocus="autofocus"
                      autocomplete="off" id="vv_name" class="form-control" value="">
                  </div>
                </div>
              </div>
              <div class="col-1 pt-3">
                <div class="btn-group dropdown">
                  <button type="submit" name="submit-filter" class="btn submitFilterBtn btn-success">
                    Lọc
                  </button>
                </div>
              </div>
            </div>
            <div class="mb-3 d-flex align-items-center gap-2">
              <div>
                <button type="button" class="btn btn-success btn-sm" onclick="redirectToNewPage()">
                  <i class="icon-lg pb-3px" data-feather="plus"></i>
                  Thêm mới
                </button>
              </div>
            </div>
            <!-- End filter content -->
              <div class="table-responsive overflow-hidden">
                  <div id="dataTableVariantValue_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                      <div class="row">
                          <div class="col-sm-12 table-responsive">
                              <table id="dataTableVariantValue"
                                     class="table dataTable no-footer table-bordered"
                                     aria-describedby="dataTableVariant_info" style="width: 100%">
                                  <thead class="table-light">
                        <tr>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableVariantValue"
                            rowspan="1" colspan="1">
                            ID
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableVariantValue"
                            rowspan="1" colspan="1">
                            Tên
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableVariantValue"
                            rowspan="1" colspan="1">
                            Tên khác
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableVariantValue"
                            rowspan="1" colspan="1">
                            Mã
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableVariantValue"
                            rowspan="1" colspan="1">
                            Mã khác
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableVariantValue"
                            rowspan="1" colspan="1">
                            Giá trị
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableVariantValue"
                            rowspan="1" colspan="1">
                            Đơn vị
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableVariantValue"
                            rowspan="1" colspan="1">
                            Thứ tự
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableVariantValue"
                            rowspan="1" colspan="1">
                            Người tạo
                          </th>
                          <th class="sorting text-black text-center" tabindex="0" aria-controls="dataTableVariantValue"
                            rowspan="1" colspan="1">
                            <i class="icon-lg text-black pb-3px" data-feather="settings"></i>
                          </th>
                        </tr>
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
  </form>
</div>

@endsection
    @section('script')
    <script>
        function redirectToNewPage() {
            window.location.href = '{{route('create-variant-value')}}?variant={{$variant_id}}';
        }
        var token = localStorage.getItem("Token");
        var var_id = {{$variant_id}};
        $(document).ready(function () {
            $('button[name=submit-filter]').click(function () {
                var dataTable = $('#dataTableVariantValue').DataTable();
                dataTable.column(0).search($('input[name="vv_id"]').val()).draw();
                dataTable.column(1).search($('input[name="vv_name"]').val()).draw();
                dataTable.ajax.reload();
            });
            $('#dataTableVariantValue').DataTable({
                serverSide: true,
                scrollX: true,
                scrollY: "800px",
                autoHeight: false,
                ajax: {
                    url: '{{route('variantvalue.all')}}',
                    type: 'GET',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    data: function (data) {
                        data.page = (data.start / data.length) + 1;
                        data.per_page = data.length;
                        data.search = data.search.value;
                        data.columns[0].searchable = true;
                        data.columns[0].search.value = $('input[name="vv_id"]').val();
                        data.columns[1].searchable = true;
                        data.columns[1].search.value = $('input[name="vv_name"]').val();
                        data.var_id = var_id;
                    },
                    dataSrc: function (response) {
                        response.recordsTotal = response.data.total;
                        response.recordsFiltered = response.data.total;
                        return response.data.data;
                    },
                    error: function (xhr) {
                        if (xhr.status === 404) {
                            $('#dataTableVariantValue').html(
                                '<p style="text-align: center;padding: 10px;">Có lỗi xảy ra khi lấy dữ liệu.</p>'
                            );
                        }
                    }
                },
                columns: [{
                    data: 'vv_id',
                    name: 'vv_id',
                    searchable: true
                },
                    {
                        data: 'vv_name',
                        name: 'vv_name'
                    },
                    {
                        data: 'vv_other_name',
                        name: 'vv_other_name'
                    },
                    {
                        data: 'vv_code',
                        name: 'vv_code'
                    },
                    {
                        data: 'vv_other_code',
                        name: 'vv_other_code'
                    },
                    {
                        data: 'vv_value',
                        name: 'vv_value'
                    },
                    {
                        data: 'vv_unit',
                        name: 'vv_unit'
                    },
                    {
                        data: 'vv_order',
                        name: 'vv_order',
                        render: function (data, type, row,) {
                            var id = row.vv_id;
                            return '<input type="number" max="99999" min="0" value="' + data +
                                '" class="form-control" data-id="' + id + '">';
                        }
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function (data, type, row,) {
                            var id = row.vv_id;
                            return `<td class="text-center">
                                        <span class="dropdown-toggle cursor-pointer"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </span>
                                        <ul class="dropdown-menu">
                                             <li>
                                                <a class="dropdown-item fs-5" href="{{route('edit-variant-value')}}?variant=${var_id}&variant_value=${id}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                    Sửa
                                                </a>
                                            </li>
                                             <li>
                                                <a class="dropdown-item fs-5 text-danger delete-item" onclick="deleteVariantValue(${id})">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                    Xóa
                                                </a>
                                            </li>
                                        </ul>
                                    </td>`;
                        }
                    },
                ],
                searching: false,
                lengthMenu: [
                    [10, 25, 50],
                    [10, 25, 50]
                ],
                pageLength: 10,
                drawCallback: function () {
                    //SAVE ORDER
                    if (!$('#dataTableVariantValue tbody tr.last-row').length) {
                        var lastRow = '<tr class="last-row">' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td>' +
                            '<button class="btn btn-primary" id="saveOrderBtn"><i class="fa-solid fa-floppy-disk"></i> Lưu</button>' +
                            '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>';
                        $('#dataTableVariantValue tbody').append(lastRow);
                        $('#saveOrderBtn').click(function () {
                            var orderData = {};
                            $('#dataTableVariantValue tbody input').each(function () {
                                var inputValue = $(this).val();
                                var id = $(this).data('id');
                                orderData[id] = inputValue;
                            });
                            $.ajax({
                                url: '{{route('variantvalue.edit.order')}}',
                                method: 'POST',
                                data: orderData,
                                beforeSend: function (xhr) {
                                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                                },
                                success: function (response) {
                                    for (var key in response.data) {
                                        if (response.data.hasOwnProperty(key)) {
                                            var status = response.data[key].status;
                                            if (status) {
                                                toastr.success("Thuộc tính id : " + key + " cập nhật thành công"
                                                );
                                            } else {
                                                toastr.error("Thuộc tính id : " + key + " cập nhật thất bại");
                                            }
                                        }
                                    }
                                },
                                error: function (error) {
                                    toastr.error(error.responseJSON.message);
                                }
                            });
                        });
                    }
                },
            });
        });
        function deleteVariantValue(id) {
            $('#confirmModal').modal('show');

            $('#modal-confirm-confirmed').off('click').on('click', function () {
                $.ajax({
                    url: '{{route('variantvalue.delete')}}',
                    method: 'DELETE',
                    data: {
                        id: id
                    },
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + token);
                        $('#modal-content-block').hide();
                        $('#modal-loading-block').show();
                    },
                    success: function (response) {
                        toastr.success(response.message, 'Thành công');
                        var dataTable = $('#dataTableVariantValue').DataTable();
                        var row = dataTable.row('#row-' + id);
                        row.remove().draw(false);
                        $('#confirmModal').modal('hide');
                    },
                    error: function (error) {
                        if (error.responseJSON && error.responseJSON.message) {
                            toastr.error(error.responseJSON.message, 'Lỗi');
                        }
                        $('#confirmModal').modal('hide');
                    }
                });
            });
        }
    </script>
@endsection
