// npm package: datatables.net-bs5
// github link: https://github.com/DataTables/Dist-DataTables-Bootstrap5


// Resize table headers when change tabs
//Prevent Tabbed table headers were not sized correctly
$(document).ready(function () {
  $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    // console.log("resize table header worked");
    $($.fn.dataTable.tables(true)).css('width', '100%');
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
  });
});

$(function () {
  'use strict';

  $(function () {
    $('#dataTableExample').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "All"]
      ],
      "columnDefs": [{
        "defaultContent": "-",
        "targets": "_all"
      }],
      "iDisplayLength": 10,
      "scrollY": 600,
      "scrollX": true,
      "language": {
        search: "",
        sProcessing: "Đang xử lý...",
        sLengthMenu: "_MENU_",
        sZeroRecords: "Không tìm thấy kết quả",
        sEmptyTable: "Không tìm thấy kết quả",
        sInfo: "Hiển thị _START_ cho đến _END_ trong tổng số _TOTAL_",
        sInfoEmpty: "Hiển thị 0 cho đến 0 trong tổng số 0",
        sInfoFiltered: "(Được lọc từ _MAX_)",
        sInfoPostFix: "",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Đang tải...",
        oPaginate: {
          "sFirst": "<<",
          "sLast": ">>",
          "sNext": ">",
          "sPrevious": "<"
        },
        "oAria": {
          "sSortAscending": ": Sắp xếp cột theo thứ tự tăng dần",
          "sSortDescending": ": Sắp xếp cột theo thứ tự giảm dần"
        }
      }
    });
    
    $('#dataTableExample').each(function () {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Tìm kiếm');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });

});

// MULTIPLE DATATABLE HERE
// PRODUCT

$(function () {
  'use strict';

  $(function () {
    $('#dataTableExampleHero').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "All"]
      ],
      "columnDefs": [{
        "defaultContent": "-",
        "targets": "_all"
      }],
      "iDisplayLength": 10,
      "scrollY": 600,
      "scrollX": true,
      "language": {
        search: "",
        sProcessing: "Đang xử lý...",
        sLengthMenu: "_MENU_",
        sZeroRecords: "Không tìm thấy kết quả",
        sEmptyTable: "Không tìm thấy kết quả",
        sInfo: "Hiển thị _START_ cho đến _END_ trong tổng số _TOTAL_",
        sInfoEmpty: "Hiển thị 0 cho đến 0 trong tổng số 0",
        sInfoFiltered: "(Được lọc từ _MAX_)",
        sInfoPostFix: "",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Đang tải...",
        oPaginate: {
          "sFirst": "<<",
          "sLast": ">>",
          "sNext": ">",
          "sPrevious": "<"
        },
        "oAria": {
          "sSortAscending": ": Sắp xếp cột theo thứ tự tăng dần",
          "sSortDescending": ": Sắp xếp cột theo thứ tự giảm dần"
        }
      }
    });
    $('#dataTableExampleHero').each(function () {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Tìm kiếm');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });

});

$(function () {
  'use strict';

  $(function () {
    $('#dataTableExampleV2').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "All"]
      ],
      "iDisplayLength": 10,
      "scrollY": 600,
      "scrollX": true,
      "language": {
        search: "",
        sProcessing: "Đang xử lý...",
        sLengthMenu: "_MENU_",
        sZeroRecords: "Không tìm thấy kết quả",
        sEmptyTable: "Không tìm thấy kết quả",
        sInfo: "Hiển thị _START_ cho đến _END_ trong tổng số _TOTAL_",
        sInfoEmpty: "Hiển thị 0 cho đến 0 trong tổng số 0",
        sInfoFiltered: "(Được lọc từ _MAX_)",
        sInfoPostFix: "",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Đang tải...",
        oPaginate: {
          "sFirst": "<<",
          "sLast": ">>",
          "sNext": ">",
          "sPrevious": "<"
        },
        "oAria": {
          "sSortAscending": ": Sắp xếp cột theo thứ tự tăng dần",
          "sSortDescending": ": Sắp xếp cột theo thứ tự giảm dần"
        }
      }
    });
    $('#dataTableExampleV2').each(function () {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Tìm kiếm');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });

});

$(function () {
  'use strict';

  $(function () {
    $('#dataTableExampleV3').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "All"]
      ],
      "iDisplayLength": 10,
      "scrollY": 600,
      "scrollX": true,
      "language": {
        search: "",
        sProcessing: "Đang xử lý...",
        sLengthMenu: "_MENU_",
        sZeroRecords: "Không tìm thấy kết quả",
        sEmptyTable: "Không tìm thấy kết quả",
        sInfo: "Hiển thị _START_ cho đến _END_ trong tổng số _TOTAL_",
        sInfoEmpty: "Hiển thị 0 cho đến 0 trong tổng số 0",
        sInfoFiltered: "(Được lọc từ _MAX_)",
        sInfoPostFix: "",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Đang tải...",
        oPaginate: {
          "sFirst": "<<",
          "sLast": ">>",
          "sNext": ">",
          "sPrevious": "<"
        },
        "oAria": {
          "sSortAscending": ": Sắp xếp cột theo thứ tự tăng dần",
          "sSortDescending": ": Sắp xếp cột theo thứ tự giảm dần"
        }
      }
    });
    $('#dataTableExampleV3').each(function () {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Tìm kiếm');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });

});