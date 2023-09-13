var branchObjs = {};
$(function () {
  loadScrollTop();
  storeSuggestHandler.storeLoadRelatedData({
    addOptionsCategoryId: [{
      id: '-1',
      name: 'Chưa gắn danh mục'
    }],
    addOptionsBrandId: [{
      id: '-1',
      name: 'Chưa gắn thương hiệu'
    }],
    addOptionsInternalCategoryId: [{
      id: '-1',
      name: 'Chưa gắn danh mục'
    }]
  });
  AppCommon.initExportExel('#excelAll', {
    'param': {
      'format': 'jsExcel'
    },
    'url': '/product/item/index',
  });
  var urlParams = new URLSearchParams(window.location.search)
    , showModalImage = urlParams.get('showmodalimage')
    , productId = urlParams.get('productId');
  if (showModalImage && showModalImage == 1 && productId) {
    showModalImageProduct(productId, 'Upload ảnh');
  }
  $(document).on('click', '#dgProductIndex .imageManager', function () {
    var id = $(this).data('id');
    var title = $(this).data('name');
    showModalImageProduct(id, title);
  });
  $("#printBarcode").click(function (e) {
    e.preventDefault();
    var productStoreIds = [];
    $('#dgProductIndex tbody tr.selected').each(function () {
      productStoreIds.push($(this).data('id'));
      productStoreIds.join(',');
    });
    if (!productStoreIds.length) {
      location.href = '/product/barcode/export?type=product';
    } else {
      location.href = '/product/barcode/export?type=product&ids=' + productStoreIds + '&storeId=' + $('#storeId').val();
    }
  });
  var storeId = $('#storeId').val();
  $('#bntPrintProducts').on('click', function () {
    var productHtmls = '';
    $.each($('#dgProductIndex tbody tr.selected'), function () {
      productHtmls += '<tr class="rowItem" data-id=' + $(this).data('id') + '>';
      productHtmls += '<td>' + $(this).find('td.psName').text() + '</td>';
      productHtmls += '<td><input style="width: 50px" class="form-control qtt autoNumeric text-right px-1" data-id=' + $(this).data('id') + ' value="1"></td>';
      productHtmls += '<td class="text-center"><a href="javascript:" class="fal fa-trash text-danger fa-lg remove"></a>';
      productHtmls += '</tr>';
    });
    $('#printProductModal table tbody').append(productHtmls);
    $('#printProductModal .copyQtt').on('click', function () {
      var copyValue = AutoNumeric.getNumber('#tableItemList .qttAllValue');
      if (!copyValue) {
        $('#tableItemList .qttAllValue').focus();
        return false;
      }
      $('#tableItemList .qtt').each(function () {
        $(this).val(copyValue);
      })
    });
    $('#printProductModal .remove').on('click', function () {
      $(this).parents('tr.rowItem').remove();
    });
    $('#printProductModal').modal('show');
  });
  $('#printProductModal .btnPrint').on('click', function () {
    var productIds = '';
    $.each($('#printProductModal tr'), function () {
      if ($(this).data('id')) {
        productIds += '&ids[]=' + $(this).data('id') + '-' + $(this).find('input.qtt').val();
      }
    });
    if (!productIds.length) {
      $('#printProductModal').modal('hide');
      AppModal.show({
        title: 'Lỗi',
        classTitle: 'text-danger',
        content: 'Chưa có sản phẩm nào được chọn'
      });
      return false;
    }
    valuePrint = $('#printProductModal .printProductInfo').val();
    if (!valuePrint) {
      $('#printProductModal .errorPrint').html('Vui lòng chọn kiểu in');
      return false;
    }
    $('#printProductModal .errorPrint').html('');
    $('#printProductModal').modal('hide');
    if (valuePrint == 'printInfo') {
      window.open('/product/item/print?storeId=' + storeId + productIds, '_blank');
    }
    if (valuePrint == 'printInfo4') {
      window.open('/product/item/print?storeId=' + storeId + '&format=a4custom&' + productIds, '_blank');
    }
    if (valuePrint == 'printInfo8') {
      window.open('/product/item/print?type=1&storeId=' + storeId + productIds, '_blank');
    }
    if (valuePrint == 'printInfo21') {
      window.open('/product/item/print?type=2&storeId=' + storeId + productIds, '_blank');
    }
  });
  $('#printProductModal #itemSuggest').autoComplete({
    resolver: 'custom',
    formatResult: function (item) {
      let textDisplay = '';
      textDisplay += '<div class="d-inline-flex boxImage mr-2"><img src="' + item.imgPath + '" /></div>';
      textDisplay += '<div class="d-flex align-items-center flex-wrap w-100">';
      textDisplay += '<div class="text-nowrap w-100">' + item.text + '</div>';
      textDisplay += '<div><span>(' + (item.price ? AppFuntions.formatDecimal(item.price) : 0) + ')</span>';
      textDisplay += '</div></div>';
      return {
        value: item.id,
        text: "[" + item.code + "] " + item.text,
        html: textDisplay
      };
    },
    minLength: 3,
    noResultsText: 'Không có sản phẩm',
    events: {
      search: function (query, callback) {
        let depotId = $('#depotId').val();
        let onlyChild = 1;
        let onlyParent = '';
        $('#itemSuggest').parent('.input-group').find('.fa-spinner').addClass('fa-spin');
        AppAjax.ajax({
          url: '/product/item/suggest',
          type: 'POST',
          dataType: 'JSON',
          data: {
            q: query,
            storeId: $('#storeId').val(),
            depotId: depotId,
            onlyChild: onlyChild,
            onlyParent: onlyParent,
            status: '1,2',
          },
          success: function (res) {
            callback(res);
          }
        });
      }
    }
  }).addClass('suggestProductBox');
  $('#itemSuggest').on('autocomplete.select', function (evt, p) {
    $('#itemSuggest').val('');
    addProductPrint(p);
  });
  $('.addbarcode').on('click', function (e) {
    e.preventDefault();
    id = $(this).data('id');
    $(this).addClass('generating');
    var code = $(this).parents('tr').find('td.code').text();
    var name = $(this).parents('tr').find('.name').text();
    $('.generalBarcodeModal').modal(id);
    $('.generalBarcodeModal .productIdBarcode').val(id);
  });
  $('.generalBarcodeModal .btnGeneralBarcode').on('click', function () {
    productId = $('.generalBarcodeModal .productIdBarcode').val();
    AppAjax.post('/product/item/edit?tab=autobarcode', {
      storeId: $('#storeId').val(),
      id: productId,
    }, function (rp) {
      if (rp.code) {
        window.location.reload();
      } else if (rp.messages) {
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: rp.messages.join("\n")
        });
        $('#dgProductIndex .generating').removeClass('generating');
      }
    });
  });
  if ($("#remain").val()) {
    $("#remainFrom").attr("disabled", false);
    $("#remainTo").attr("disabled", false);
  } else {
    $("#remainFrom").attr("disabled", "disabled");
    $("#remainTo").attr("disabled", "disabled");
  }
  $('#remain').on('change', function () {
    if ($("#remain").val()) {
      $("#remainFrom").attr("disabled", false);
      $("#remainTo").attr("disabled", false);
    } else {
      $("#remainFrom").attr("disabled", "disabled");
      $("#remainTo").attr("disabled", "disabled");
    }
  });
  if ($("#priceRange").val()) {
    $("#fromPrice").attr("disabled", false);
    $("#toPrice").attr("disabled", false);
  } else {
    $("#fromPrice").attr("disabled", "disabled");
    $("#toPrice").attr("disabled", "disabled");
  }
  $('#priceRange').on('change', function () {
    if ($("#priceRange").val()) {
      $("#fromPrice").attr("disabled", false);
      $("#toPrice").attr("disabled", false);
    } else {
      $("#fromPrice").attr("disabled", "disabled");
      $("#toPrice").attr("disabled", "disabled");
    }
  });
  supplierSuggestHandler.load({
    storeId: '#storeId',
    tbSuggest: '#supplierName',
    noSupplier: true,
    emptyDataHandler: function () {
      $('#supplierId').val('');
    },
    selectHandler: function (item) {
      $("#supplierId").val(item.id);
      $("#supplierName").val(item.name);
    }
  });
  $('#tagName').autoComplete({
    resolver: 'custom',
    formatResult: function (item) {
      let textDisplay = '';
      textDisplay += '<div class="text-wrap w-100">' + item.name + '</div>';
      return {
        value: item.id,
        text: item.name,
        html: textDisplay
      };
    },
    minLength: 3,
    noResultsText: 'Không tìm thấy tag',
    events: {
      search: function (query, callback) {
        AppAjax.ajax({
          url: '/product/item/loaddata?tab=tagsuggest',
          type: 'POST',
          dataType: 'JSON',
          data: {
            name: query,
            storeId: $('#storeId').val(),
          },
          success: function (res) {
            callback(res);
          }
        });
      }
    }
  });
  $('#tagName').on('autocomplete.select', function (evt, item) {
    $("#tagId").val(item.id);
  });
  $('#tagName').on('change', function () {
    if (!$(this).val()) {
      $("#tagId").val('');
    }
  });
  $('#dgProductIndex .changePrice').hover(function () {
    $(this).children("a").css("visibility", "visible");
  }, function () {
    $(this).children("a").css("visibility", "hidden");
  });
  $('.cchangePrice').on('click', function () {
    $(".modal-title").html($(this).attr('name'));
    $(".modal-body #price").focus();
    $('.getItemId').attr('value', $(this).attr('id'));
    AutoNumeric.set('.modal-body #importPrice', $(this).attr('importPrice'));
    AutoNumeric.set('.modal-body #price', $(this).attr('price'));
    AutoNumeric.set('.modal-body #vatPrice', $(this).attr('vat'));
    AutoNumeric.set('.modal-body #wholesalePrice', $(this).attr('wholesalePrice'));
    AutoNumeric.set('.modal-body #oldPrice', $(this).attr('oldPrice'));
    $('#grUpdatePrice').css('display', 'flex');
    if (parseInt($(this).attr('data-parentId')) > 0) {
      $('#grUpdatePrice').css('display', 'none');
    }
  });
  $('#changePriceModal').on('shown.bs.modal', function () {
    $('#changePriceModal #price').focus();
  });
  $('#updatePrice').on('click', function () {
    if ($(this).is(':checked')) {
      $(this).val(1);
    }
  });
  $('#changePriceModal .changePrice').on('click', function () {
    let branchValues = [];
    if ($('#updateBranchPriceCheckbox').is(":checked")) {
      $('#branchPriceTable tbody tr').each(function () {
        let branchId = $(this).find('.branchId').val()
          , elementName = '#row_' + branchId
          , price = $(elementName + ' .branchPrice').val().length ? AutoNumeric.getNumber(elementName + ' .branchPrice') : ''
          , wholesalePrice = $(elementName + ' .branchWholesalePrice').val().length ? AutoNumeric.getNumber(elementName + ' .branchWholesalePrice') : '';
        branchValues.push({
          'branchId': branchId,
          'price': price,
          'wholesalePrice': wholesalePrice,
        });
      });
    }
    let importPrice = 0;
    if ($('.modal-body #importPrice').length) {
      importPrice = AutoNumeric.getNumber('.modal-body #importPrice');
    }
    const psId = $('#changePriceModal .getItemId').attr('value');
    const paramPrice = AutoNumeric.getNumber('.modal-body #price');
    const vatPrice = AutoNumeric.getNumber('.modal-body #vatPrice');
    if (psId) {
      AppAjax.post('/product/item/edit?tab=changeprice', {
        id: psId,
        storeId: $('#storeId').val(),
        'importPrice': importPrice,
        'price': paramPrice,
        'vat': vatPrice,
        'wholesalePrice': AutoNumeric.getNumber('#changePriceModal #wholesalePrice'),
        'oldPrice': AutoNumeric.getNumber('.modal-body #oldPrice'),
        'updatePrice': $('#updatePrice').val(),
        'branchs': JSON.stringify(branchValues),
      }, function (rs) {
        if (rs.code) {
          const current = $('.cchangePrice[id="' + psId + '"]').closest('td');
          let price = paramPrice + parseInt(paramPrice * vatPrice / 100) + '';
          price = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
          price = price + '<br>' + 'VAT: ' + vatPrice + "\%";
          current.find('.price').html(price);
          current.find('.wholesalePrice').text($('.modal-body #wholesalePrice').val());
          current.find('.oldPrice').text($('.modal-body #oldPrice').val());
          $('#changePriceModal').modal('hide');
          window.location.reload();
        } else {
          $('#changePriceModal').modal('hide');
          AppModal.show({
            title: 'Lỗi',
            classTitle: 'text-danger',
            content: rs.messages
          });
        }
      });
    }
  });
  $('#updateBranchPriceCheckbox').on('change', function () {
    if ($(this).is(":checked")) {
      $('#updateBranchPriceArea').slideDown(300);
    } else {
      $('#updateBranchPriceArea').slideUp(300);
    }
  });
  $('#updateBranchPriceSelect').on('change', function () {
    if ($(this).val()) {
      addBranchRow();
    }
  });
  $('#branchPriceTable').on('click', '.remove-item', function () {
    const branchId = $(this).closest('tr').find('input[class="branchId"]').val();
    if (branchObjs[branchId] !== undefined) {
      delete branchObjs[branchId];
    }
    if (parseInt($('#updateBranchPriceSelect').val()) === parseInt(branchId)) {
      $('body #updateBranchPriceSelect').val('');
    }
    $(this).closest('tr').remove();
  });
  $(document).on('click', '.changestatus', function () {
    $("#updateStatusModal #psStatusSelect").val($(this).attr('statusVal'));
    $('#updateStatusModal #psIdToSelected').empty().val($(this).attr('data-id'));
    $('#updateStatusModal').modal('show');
  });
  $('#updateStatusModal').on('click', '#btnUpdateStatusProduct', function () {
    var idsStr = $('#psIdToSelected').val();
    var ids = idsStr.split(',');
    $('#updateStatusModal .modal-footer').html('<span class="text-info"><i class="fa fa-rotate-right fa-spin"></i> Làm phiền bạn chờ một lát!</span>');
    var data = {
      ids: ids,
      storeId: $('#storeId').val(),
      status: $('#psStatusSelect').val()
    };
    AppAjax.ajax({
      url: '/product/item/changestatus',
      data: data,
      type: "POST",
      success: function (rs) {
        updateStatusCallBack(rs);
      }
    });
  });
  $("#bntChangeProductStatus").click(function (e) {
    e.preventDefault();
    var productStoreIds = [];
    $('#dgProductIndex tr.selected').each(function () {
      productStoreIds.push($(this).data('id'));
      productStoreIds.join(',');
    });
    if (!productStoreIds.length) {
      AppModal.show({
        title: 'Lỗi',
        classTitle: 'text-danger',
        content: 'Chưa có sản phẩm nào được chọn!'
      });
      return false;
    } else {
      $('#updateStatusModal #psIdToSelected').val(productStoreIds);
      $('#updateStatusModal').modal('show');
    }
  });
  $("#changeHotProduct").click(function (e) {
    var productStoreIds = [];
    $('#dgProductIndex tr.selected').each(function () {
      if ($(this).data('id')) {
        productStoreIds.push($(this).data('id'));
        productStoreIds.join(',');
      }
    });
    if (!productStoreIds.length) {
      AppModal.show({
        title: 'Lỗi',
        classTitle: 'text-danger',
        content: 'Chưa có sản phẩm nào được chọn!'
      });
      return false;
    }
    $('#setHotProductModal #psIdToSelected').val(productStoreIds);
    $('#setHotProductModal').modal('show');
  });
  $('#setHotProductModal .btnSetHotProduct').on('click', function () {
    var ids = $('#setHotProductModal #psIdToSelected').val();
    $('#setHotProductModal .loaddingSetProduct').addClass('d-block');
    $(this).attr('disabled', true);
    AppAjax.post('/product/item/editwebsite?tab=changehotproduct', {
      storeId: $("#storeId").val(),
      ids: ids
    }, function (rp) {
      if (rp.code) {
        $('#setHotProductModal').modal('hide');
        AppModal.show({
          title: 'Thông báo',
          classTitle: 'text-success',
          content: 'Cài đặt thành công'
        });
        setTimeout(function () {
          window.location.reload();
        }, 2000);
      } else if (rp.messages) {
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: rp.messages.join("\n")
        });
      }
    });
  });
  $("#bntChangeProductNew").click(function (e) {
    var productStoreIds = [];
    $('#dgProductIndex tr.selected').each(function () {
      if ($(this).data('id')) {
        productStoreIds.push($(this).data('id'));
        productStoreIds.join(',');
      }
    });
    if (!productStoreIds.length) {
      AppModal.show({
        title: 'Lỗi',
        classTitle: 'text-danger',
        content: 'Chưa có sản phẩm nào được chọn!'
      });
      return false;
    }
    $('#setNewProductModal #psIdToSelected').val(productStoreIds);
    $('#setNewProductModal').modal('show');
  });
  $('#setNewProductModal .btnSetNewProduct').on('click', function () {
    var ids = $('#setNewProductModal #psIdToSelected').val();
    $('#setNewProductModal .loaddingSetProduct').addClass('d-block');
    $(this).attr('disabled', true);
    AppAjax.post('/product/item/editwebsite?tab=changeproductnew', {
      storeId: $("#storeId").val(),
      ids: ids
    }, function (rp) {
      if (rp.code) {
        $('#setNewProductModal').modal('hide');
        AppModal.show({
          title: 'Thông báo',
          classTitle: 'text-success',
          content: 'Cài đặt thành công'
        });
        setTimeout(function () {
          window.location.reload();
        }, 2000);
      } else if (rp.messages) {
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: rp.messages.join("\n")
        });
      }
    });
  });
  $('#setparens').on('click', function () {
    var productIds = [];
    $('#dgProductIndex tr.selected').each(function () {
      if ($(this).data('id')) {
        productIds.push($(this).data('id'));
        productIds.join(',');
      }
    });
    if (!productIds.length) {
      AppModal.show({
        title: 'Lỗi',
        classTitle: 'text-danger',
        content: 'Chưa có sản phẩm nào được chọn'
      });
      return false;
    }
    window.open('/auto/product/updateparents?storeId=' + storeId + '&ids=' + productIds, '_blank');
  });
  $('#dgProductIndex .viewComboProduct').on('click', function () {
    var id = $(this).data('id');
    window.open('/product/item/detail?storeId=' + storeId + '&id=' + id + '&tab=combos', '_blank');
  });
  $('#dgProductIndex').on('click', '.share-image', function () {
    $('#shareImageModal .psIdToSelected').val($(this).attr('idref'));
    $('#shareImageModal').modal('show');
  });
  $('#shareImageModal').on('shown.bs.modal', function () {
    $('#shareImageModal .btnSetImageProduct').trigger('focus');
  });
  $('#shareImageModal .btnSetImageProduct').on('click', function () {
    var id = $('#shareImageModal .psIdToSelected').val();
    var classImg = $('.img' + id);
    AppAjax.post('/product/item/editwebsite?tab=shareavartartochild', {
      id: id,
      storeId: $('#storeId').val()
    }, function (rs) {
      if (rs.code) {
        $('#shareImageModal').modal('hide');
        classImg.removeClass('fa-plus-circle').addClass('fa-image');
        window.location.reload();
      } else {
        $('#shareImageModal').modal('hide');
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: rs.messages
        });
      }
    });
  });
  $('#openps').click(function (e) {
    AppCommon.overLoading();
    e.preventDefault();
    if (!$('#dgProductIndex tr.selected').length) {
      AppModal.show({
        title: 'Lỗi',
        classTitle: 'text-danger',
        content: 'Bạn chưa chọn sản phẩm!'
      });
      return false;
    }
    var psIds = [];
    $.each($('#dgProductIndex tr.row-item.selected'), function () {
      var id = parseInt($(this).data('id'));
      psIds.push(id);
    });
    if (psIds.length) {
      AppAjax.ajax({
        url: '/product/item/edit?tab=openps',
        data: {
          'ids': psIds,
          'storeId': $('#storeId').val()
        },
        dataType: 'JSON',
        type: 'POST',
        success: function (rs) {
          if (rs.code == 1) {
            window.location.reload();
          } else {
            AppCommon.overLoading({
              'display': 'hide'
            });
            AppModal.show({
              title: 'Lỗi',
              classTitle: 'text-danger',
              content: rs.messages
            });
          }
        }
      });
    }
  });
});
function addBranchRow() {
  const branchId = $('#updateBranchPriceSelect').val();
  if (branchObjs[branchId] != undefined) {
    return false;
  }
  const productStoreId = $('#changePriceModal .getItemId').attr('value');
  const branchName = $('#updateBranchPriceSelect option:selected').text();
  const price = $('#changePriceModal #price').val().length ? AutoNumeric.getNumber('#changePriceModal #price') : '';
  const wholesalePrice = $('#changePriceModal #wholesalePrice').val().length ? AutoNumeric.getNumber('#changePriceModal #wholesalePrice') : '';
  const elementName = '#row_' + branchId;
  const branchTemplate = $('#branchTemplate tr').clone();
  branchTemplate.attr('id', 'row_' + branchId);
  branchTemplate.find('.branchName').text(branchName);
  branchTemplate.find('.branchId').val(branchId);
  $('#branchPriceTable tbody').append(branchTemplate);
  AppFuntions.initAutoNumeric(elementName + ' .autoNumeric');
  AutoNumeric.set(elementName + ' .branchPrice', price);
  AutoNumeric.set(elementName + ' .branchWholesalePrice', wholesalePrice);
  AppAjax.post('/store/branch/load', {
    storeId: $("#storeId").val(),
    id: branchId,
    productStoreId: productStoreId,
    page: 'product.item.index',
  }, function (rs) {
    if (rs.price) {
      AutoNumeric.set(elementName + ' .branchPrice', rs.price);
    }
    if (rs.wholesalePrice) {
      AutoNumeric.set(elementName + ' .branchWholesalePrice', rs.wholesalePrice);
    }
  });
  branchObjs[branchId] = branchId;
}
function addProductPrint(item) {
  let rows = '';
  rows += '<tr class="rowItem" data-id=' + item.id + '>';
  rows += '<td>' + item.name + '</td>';
  rows += '<td><input style="width: 50px" class="form-control qtt autoNumeric text-right px-1" data-id=' + item.id + ' value="1"></td>';
  rows += '<td class="text-center"><a href="javascript:" class="fal fa-trash text-danger fa-lg remove"></a>';
  rows += '</tr>';
  $('#printProductModal #tableItemList').find('tbody').append(rows);
  $('#printProductModal #tableItemList .remove').on('click', function () {
    $(this).parents('tr.rowItem').remove();
  });
}
function loadScrollTop() {
  $(window).scroll(function () {
    sessionStorage.scrollTop = $(this).scrollTop();
  });
  if (sessionStorage.scrollTop != "undefined") {
    $(window).scrollTop(sessionStorage.scrollTop);
  }
}
function updateStatusCallBack(rp) {
  if (rp.code == 1) {
    window.location.reload();
  } else {
    $('#updateStatusModal').modal('hide');
    $('#updateStatusModal .modal-footer').html('<button type="button" class="btn btn-info" id="btnUpdateStatusProduct">Cập nhật</button><button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>');
    AppModal.show({
      title: 'Lỗi',
      classTitle: 'text-danger',
      content: rp.messages.join('<br/>')
    });
  }
}
function showModalImageProduct(productId, title) {
  if (productId) {
    $('#imageModalProduct .modal-title').html(title);
    $('#imageModalProduct .modal-body').load('/product/item/loaddata?tab=iframeimage&id=' + productId + '&storeId=' + $('#storeId').val());
    $('#imageModalProduct').modal('show');
  }
}
