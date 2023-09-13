var AppBillImport = {
  isSubmit: false,
  // biến đánh dấu phiếu được save hay chưa, tránh tình huống double click chuột
  // sẽ save thành nhiều phiếu trùng nhau
  isSubmitted: false,

  // accountingTypeDepot được truyền từ view sang, được dùng để lấy tài khoản tiền mặt
  accountingTypeDepot: (typeof accountingTypeDepot != 'undefined' ? accountingTypeDepot : 0),

  // accountingTypeBank được truyền từ view sang, được dùng để lấy tài khoản ngân hàng
  accountingTypeBank: (typeof accountingTypeBank != 'undefined' ? accountingTypeBank : 0),

  // canAddSupplier được truyền từ view sang, được dùng để kiểm tra tài khoản đang đang nhập có được thêm NCC hay ko
  canAddSupplier: (typeof canAddSupplier != 'undefined' ? canAddSupplier : 0),

  // Đánh dấu loại phiếu nhập nhà cung cấp
  typeImport: (typeof typeImport != 'undefined' ? typeImport : 0),

  // Đánh dấu loại phiếu trả nhà cung cấp
  typeExport: (typeof typeExport != 'undefined' ? typeExport : 0),

  // đánh dấu đối tượng là nhà cung cấp bên kế toán
  contactTypeSupplier: (typeof contactTypeSupplier != 'undefined' ? contactTypeSupplier : 0),

  // object thông tin hóa đơn
  // object thông tin hóa đơn
  bill: {},

  // các event có thể lặp lại khi khởi tạo view hoặc user thao tác trên view
  eventsHandler: {

  },

  // Biến đánh dấu DN sử dụng setting giá vốn là giá đích danh
  settingImeiImportPrice: 0,

  // Số sản phẩm mỗi lần Post
  itemPost: 1,

  // Số sản phẩm đã được Post
  itemPosted: 0,

  // Tổng số sản phẩm
  totalItem: 0,

  // Lỗi lưu sản phẩm
  warning: 0,
  init: function () {
    $('.addVatAreaBtn').on('click', function () {
      if ($(this).find('i').hasClass('fa-chevron-double-down')) {
        $(this).find('i').removeClass('fa-chevron-double-down').addClass('fa-chevron-double-up');
        $('#vatArea').removeClass('d-none');
      } else {
        $(this).find('i').removeClass('fa-chevron-double-up').addClass('fa-chevron-double-down');
        $('#vatArea').addClass('d-none');
      }

    });
    if ($('#storeId').val()) {
      AppBillImport.loadStoreData();
    }
    if ($('#depotId').val()) {
      AppBillImport.loadAccounts();
    }
    $('#depotId').on('change', function () {
      AppBillImport.loadAccounts();
    });
    // Thay đổi doanh  nghiệp
    $('select#storeId').change(function () {
      $('#tbLoadProduct').val('');
      if (!$('#storeId').val()) {
        $('#tbLoadProduct').attr('disabled', 'disabled');
        $('#supplierName').attr('disabled', 'disabled');
        $('#addSupplier').addClass('hide');
        $('#depotId').find('option:gt(0)').remove();
      } else {
        $('#tbLoadProduct').removeAttr('disabled');
        $('#supplierName').removeAttr('disabled');
        if (canAddSupplier) {
          $('#addSupplier').removeClass('hide');
        } else {
          $('#addSupplier').addClass('hide');
        }
        $('#tbLoadProduct').focus();
      }
      $('#productList tbody .productItem').remove();
      AppBillImport.loadStoreData();
    });

    // suggest doanh nghiệp
    storeSuggestHandler.load({
      tbSuggest: '#storeIdName',
      emptyDataHandler: function () {
        $('#storeId').val('');
      },
      selectHandler: function (s) {
        $('#storeIdName').val(s.label);
        // rise event thay đổi doanh nghiệp để xóa sp, tính toán lại hóa đơn
        $('#storeId').val(s.id).trigger('change');
        $('#productList tbody .productItem').remove();
        AppBillImport.loadStoreData();
      }
    });

    // suggest nhân viên kinh doanh
    userSuggestHandler.load({
      storeId: '#storeId',
      depotId: '#depotId',
      tbSuggest: '#salemanName',
      selectHandler: function (u) {
        $('#saleId').val(u.id);
        $('#salemanName').val(u.fullName ? u.fullName : u.username);
      }
    });

    // Click vào nút thêm nhà cung cấp
    $('#addSupplier').click(function (e) {
      window.open('/supplier/manage/add?storeId=' + ($('#storeId').val()), '_newtab');
    });

    // Xóa sản phẩm khỏi danh sách đã chọn
    $('#productList').on('click', '.delProduct', function (e) {
      e.preventDefault();
      $(this).parents('.productItem').remove();
      AppBillImport.calculateProducts();
      AppBillImport.calculatorStt();
    });

    //Hiện ô nhập ghi chú
    $('#productList').on('click', '.showItemDescription', function () {
      if (!$(this).closest('tr').find('.editDescription').length) {
        let valueDescription = $(this).closest('tr').find('#prdDescription').val();
        $(this).closest('tr').find('.dgColName').append('<input type="text" name="editDescription" maxlength="255" value="' + valueDescription + '" class="form-control editDescription" placeholder="Nhập ghi chú">');
      }
    });
    $('#productList').on('click', '#showAllDescription', function () {
      if ($('#productList').find('.productItem').length) {
        $('.productItem').each(function () {
          if (!$(this).find('.editDescription').length) {
            let valueDescription = $(this).closest('tr').find('#prdDescription').val();
            $(this).find('.dgColName').append('<input type="text" name="editDescription" maxlength="255" value="' + valueDescription + '" class="form-control editDescription" placeholder="Nhập ghi chú">');
          }
        });
      }
    });

    // Nhập imei
    $("#productList").on('keyup', '.imei', function () {
      var element = $(this);
      var parent = element.parents('.productItem');
      element.removeClass('error');
      var n_imei = element.val().trim().split("\n");
      if (n_imei.length) {
        parent.find('.quantity').val(n_imei.length);
      }
      var offset = this.offsetHeight - this.clientHeight;
      element.css('height', 'auto').css('height', this.scrollHeight + offset);
      AppBillImport.calculateProducts();
    });
    $("#productList").on('change', '.imei', function () {
      var element = $(this);
      if (AppBillImport.typeExport && AppBillImport.settingImeiImportPrice) {
        AppBillImport.loadPriceImei(element);
      }
    });

    // Thay đổi tiền mặt, tiền chuyển khoản, giá, số lượng, vat, Chiết khấu
    $('#pageSupplier').on('change', '#cash, #money, #moneyTransfer, .price, .quantity, .typePsDiscount, .psDiscount, #vatValue, #vatType, #manualDiscount, #manualDiscountType', function () {
      // Xác nhận phiếu yêu cầu
      if ($(this).hasClass('quantity') && $(this).parents('.productItem').find('.quantityRequired').length) {
        AppBillImport.cssQuantityConfirm($(this));
      }
      AppBillImport.calculateProducts();
    });
    $('#pageSupplier').on('keyup', '.price, .typePsDiscount, .psDiscount, #vatValue, #vatType, #manualDiscount, #manualDiscountType', function () {
      AppBillImport.calculateProducts();
    });

    // load công nợ hiện tại của NCC
    $("#pageSupplier").on('change', '#supplierId', function () {
      AppBillImport.loadSupplierDebt();
    });

    // Click nút lưu
    $('#saveBill').click(function () {
      $('#printMode').val('');
      AppBillImport.submit();
    });

    // Click nút lưu và in
    $('#btnSaveAndPrintBill').click(function () {
      $('#printMode').val(1);
      AppBillImport.submit();
    });

    // copy price
    $('.copySubTotal').click(function () {
      let elementId = $(this).next('input.form-control').attr('id'),
        moneyNeedPayment = ($('#moneyNeedPayment').length && $('#moneyNeedPayment').text()) ? parseFloat($('#moneyNeedPayment').text().replace(/\./g, '').replace(',', '.')) : 0;
      if (moneyNeedPayment) {
        AutoNumeric.set('#' + elementId, Math.round(moneyNeedPayment));
      }
    });

    /*
     * Kiểm tra sản phẩm IMEI
     *  + Kiểm tra các imei nhập vào cho 1 sản phẩm
     *  + Kiểm tra các imei nhập vào của 1 sản phẩm với imei của các sản phẩm khác
     * */
    $('#productList').on('blur', '.imei', function () {
      // Kiểm tra các imei nhập vào cho 1 sản phẩm
      var element = $(this);
      var productStoreId = parseInt(element.parents('.productItem').attr('data-productstoreid'));
      var imeis = element.val() ? element.val().trim() : null;
      if (!imeis) {
        return false;
      }

      var arrImeis = imeis.trim().split("\n");
      var cacheImeis = [];
      var isValid = true;
      $.each(arrImeis, function (index, value) {
        if (cacheImeis.length && cacheImeis.indexOf(value) != -1) {
          if (element.parent().find('.errImei').length) {
            element.parent().find('.errImei').html('Trùng IMEI "' + value + '". Bạn vui lòng kiểm tra lại!');
          } else {
            element.parent().append('<div style="float: left;color: #FF0000;margin-top: 5px;" class="errImei">Trùng IMEI "' + value + '". Bạn vui lòng kiểm tra lại!</div>');
          }
          isValid = false;
          return isValid;
        }

        element.parent().find('.errImei').html('');
        cacheImeis.push(value);
        isValid = true;
      });

      if (!isValid) {
        return false;
      }

      // Kiểm tra các imei nhập vào của 1 sản phẩm với imei của các sản phẩm khác
      $('.imei').each(function () {
        var elm = $(this);
        var psId = parseInt(elm.parents('.productItem').attr('data-productstoreid'));
        if (productStoreId != psId) {
          var ims = elm.val();
          var arrIms = ims.trim().split("\n");
          $.each(arrIms, function (id, vl) {
            if (cacheImeis.length) {
              if (cacheImeis.indexOf(vl) != -1) {
                var psName = elm.parents('.productItem').find('.psName').text();
                if (element.parent().find('.errImei').length) {
                  element.parent().find('.errImei').html('Trùng IMEI "' + vl + '" với sản phẩm "' + psName + '". Bạn vui lòng kiểm tra lại!');
                } else {
                  element.parent().append('<div style="float: left;color: #FF0000;margin-top: 5px;" class="errImei">Trùng IMEI "' + vl + '" với sản phẩm "' + psName + '". Bạn vui lòng kiểm tra lại!</div>');
                }
                return false;
              } else {
                elm.parent().find('.errImei').html('');
              }
            }
          });
        }
      });
    });

    // Thay đổi số lượng lỗi
    $('#pageSupplier').on('change', '.damaged', function () {
      var damaged = $(this).val() ? parseInt($(this).val()) : 0;
      var quantity = $(this).parents('.productItem').find('.quantity').length && $(this).parents('.productItem').find('.quantity').val() ? parseInt($(this).parents('.productItem').find('.quantity').val()) : 0;
      if (damaged > quantity) {
        $(this).addClass('error').focus();
        return false;
      }

      $(this).removeClass('error');
      AppBillImport.calculateProducts();
    });

    // Thay đổi khối lượng sản phẩm
    $(document).on('change', '#productList .weight', function () {
      AppBillImport.calculateProducts();
    });

    /*
     * Kiểm tra giá trị số lượng
     *   + Loại sản phẩm cân đo: chấp nhập số và dấu ',', '.'
     *   + Không phải loại sản phẩm cân đo thì chỉ chấp nhận số nguyên dương
     * */
    $('#productList').on('blur', '.quantity', function () {
      var typeId = parseInt($(this).parents('.productItem').attr('data-productTypeId'));
      var quantity = $(this).val() ? $(this).val() : 0;
      if (typeId == appConsts.product.types.TYPE_WEIGHT_MEASURE) {
        var match = /^-?\d*((\.|\,)\d+)?$/;
        if (!quantity.match(match)) {
          $(this).focus();
          return false;
        }
      } else {
        if (isNaN(quantity) || quantity < 0) {
          $(this).focus();
          return false;
        }
        $(this).val(parseInt(quantity));
      }
    });

    // Nhấn phím lên, xuống
    $('#productList').on('keyup', '.keyCodeChange', function (e) {
      var element = $(this);
      if (e.keyCode == 38) { // Phím lên
        if (element.hasClass('quantity')) {
          $(".quantity").eq($(".quantity").index($(element)) - 1).focus().select();
        } else if (element.hasClass('price')) {
          $(".price").eq($(".price").index($(element)) - 1).focus().select();
        } else if (element.hasClass('psDiscount')) {
          $(".psDiscount").eq($(".psDiscount").index($(element)) - 1).focus().select();
        } else if (element.hasClass('weight')) {
          $(".weight").eq($(".weight").index($(element)) - 1).focus().select();
        }
      } else if (e.keyCode == 40) { // Phím xuống
        if (element.hasClass('quantity')) {
          $(".quantity").eq($(".quantity").index($(element)) + 1).focus().select();
        } else if (element.hasClass('price')) {
          $(".price").eq($(".price").index($(element)) + 1).focus().select();
        } else if (element.hasClass('psDiscount')) {
          $(".psDiscount").eq($(".psDiscount").index($(element)) - 1).focus().select();
        } else if (element.hasClass('weight')) {
          $(".weight").eq($(".weight").index($(element)) - 1).focus().select();
        }
      }
    });

    //Load đơn vị tính
    $('#productList').on('change', '.psUnitId', function () {
      $('#productList .addingProperties').removeClass('addingProperties');
      $(this).closest('.productItem').addClass('addingProperties');
      var psId = $(this).closest('.productItem').attr('data-productstoreid');
      AppAjax.post(
        '/product/item/suggest?tab=moreinfor',
        {
          'storeId': $('#storeId').val(),
          'depotId': $('#depotId').val(),
          'productStoreId': psId,
          'unitId': $(this).val(),
          'isLoadUnit': 1,
        },
        function (rs) {
          if (rs.unit) {
            if (rs.unit.importPrice) {
              AutoNumeric.set($('#productList .addingProperties').find('.price').get(0), rs.unit.importPrice);
            } else {
              $('#productList .addingProperties').find('.price').val('');
            }
            $('#productList .addingProperties').find('.psAvailable').empty().append(rs.unit.available);
            AppBillImport.calculateProducts();
          }
        }
      );
    });

    // Hot keys
    AppBillImport.hotKeys();

    /* PHẦN XỬ LÝ LÔ SẢN PHẨM */
    //Gợi ý lô sản phẩm theo từng dòng
    $('#productList').on('keyup', '.productBatchTxt', function () {
      $('#productList .addingProperties').removeClass('addingProperties');
      $(this).closest('.productItem').addClass('addingProperties');
    });

    //Remove lô
    $('#productList').on('click', '.removeBatch', function () {
      $(this).closest('.batchInfor').remove();

    });

    //Bắt sự kiện nhấn nút thêm nhanh lô sản phẩm
    $('#productList').on('click', '.addQuickProductBatchBtn', function () {
      $('#productList .addingProperties').removeClass('addingProperties');
      $(this).closest('.productItem').addClass('addingProperties');
      var psId = $(this).attr('data-psid');
      var psName = $(this).closest('.productItem').find('.productName').text();
      $('#addNewProductBatchModal .ProductNameInfor').empty().text(psName);
      $('#addNewProductBatchModal .batchProductStoreId').val(psId);
      $('#addNewProductBatchModal').modal('show');
    });

    //bắt sự kiện click nút Save thêm nhanh lô
    $('#addNewProductBatchModal #saveProductBatch').on('click', function () {
      var item = $(this);
      var storeId = $('#storeId').val();
      var psId = $('#addNewProductBatchModal .batchProductStoreId').val();
      var name = $('#batchName').val();
      var manufactureDate = $('#batchManufactureDate').val();
      var importPrice = $('#batchImportPrice').val() ? AutoNumeric.getNumber('#batchImportPrice') : 0;
      var expiredDate = $('#batchExpiredDate').val();
      if (!psId || !name || !manufactureDate) {
        $('#addNewProductBatchModal .errorAddProductBatch').html('Bạn vui lòng điền đầy đủ các trường').addClass('alert alert-danger');
        return;
      }
      AppAjax.post(
        '/product/batch/add?tab=addquick',
        {
          'storeId': storeId,
          'productStoreId': psId,
          'name': name,
          'importPrice': importPrice,
          'manufactureDate': manufactureDate,
          'expiredDate': expiredDate,
        },
        function (rs) {
          if (rs.code) {
            AppBillImport.addProductBatchToRow(rs.data);
            $('#addNewProductBatchModal').modal('hide');
            $('#batchProductStoreId').val('');
            $('#batchName').val('');
            $('#batchManufactureDate').val('');
            $('#batchImportPrice').val('');
            $('#batchExpiredDate').val('');
          } else {
            $('#addNewProductBatchModal .errorAddProductBatch').html(rs.messages).addClass('alert alert-danger');

          }
        }
      );
    });

    // Ẩn hiện nhà cung cấp
    AppBillImport.changeMode($('#mode').val());
    $("#pageSupplier").on('change', '#mode', function () {
      AppBillImport.changeMode($(this).val());
    });

    customerSuggestHandler.load({
      tbSuggest: '#customerName',
      storeId: '#storeId',
      depotId: '#depotId',
      suggestField: 'name',
      emptyDataHandler: function () {
        $('#customerId').val('');
      },
      selectHandler: function (c) {
        $('#customerId').val(c.id);
        $('#customerName').val(c.name);
        $('#customerMobile').val(c.mobile);
      }
    });
    customerSuggestHandler.load({
      tbSuggest: '#customerMobile',
      storeId: '#storeId',
      depotId: '#depotId',
      suggestField: 'mobile',
      emptyDataHandler: function () {
        $('#customerId').val('');
      },
      selectHandler: function (c) {
        $('#customerId').val(c.id);
        $('#customerName').val(c.name);
        $('#customerMobile').val(c.mobile);
      }
    });

    // Thay đổi tiền mặt, tiền chuyển khoản, giá, số lượng, vat, Chiết khấu
    $('#pageSupplier').on('change', '#cash, #money, #moneyTransfer, .price, .quantity, .typePsDiscount, .psDiscount, #vatValue, #vatType, #manualDiscount, #manualDiscountType', function () {
      // Xác nhận phiếu yêu cầu
      if ($(this).hasClass('quantity') && $(this).parents('.productItem').find('.quantityRequired').length) {
        AppBillImport.cssQuantityConfirm($(this));
      }
      AppBillImport.calculateProducts();
    });

    supplierSuggestHandler.load({
      storeId: '#storeId',
      tbSuggest: '#supplierName',
      emptyDataHandler: function () {
        $('#supplierId').val('');
      },
      selectHandler: function (item) {
        $("#supplierId").val(item.id);
        $("#supplierName").val(item.name);
        AppBillImport.loadSupplierDebt();
      }
    });

    AppDataIframe.addSupplier('#addFastSupplierBtn', {
      closeHandler: function () {
        AppBillImport.loadSupplier();
      }
    });
    // load công nợ hiện tại của NCC
    $('#supplierId').on('change', function () {
      AppBillImport.loadSupplierDebt();
    });
    AppDataIframe.addProduct('.addQuickProductBtn');

    appCacheRencent.renderCacheRecent({
      id: '/inventory/bill/detail',
      customerName: '',
      totalMoney: 'number'
    });

    productSuggestHandler.loadSuggest({
      storeId: '#storeId',
      depotId: '#depotId',
      tbSuggest: '#tbLoadProduct',
      suggestType: '#suggestType',
      status: "1,2",
      cacheHandler: function (term) {
        $('#tbLoadProduct').val('');
        var item = productSuggestHandler.rsCache[term];
        if (productSuggestHandler.originalOptions.onlyParent && !item.parentId) {
          AppBillImport.loadAllChildsProduct(item, $('#depotId').val());
        } else {
          AppBillImport.addProduct(item);
        }
      },
      selectHandler: function (p) {
        $('#tbLoadProduct').val('');
        if (productSuggestHandler.onlyParent && !p.parentId) {
          AppBillImport.loadAllChildsProduct(p, $('#depotId').val());
        } else {
          AppBillImport.addProduct(p);
        }
        $('#tbLoadProduct').focus();
      },
    });

    // Copy số lượng yêu cầu => Số lượng
    $('#productList').on('click', '#copyQuantity', function () {
      if ($('.productItem').length) {
        $('.productItem').each(function () {
          var quantityRequired = $(this).find('.quantityRequired').attr('data-value');
          $(this).find('.quantity').val(quantityRequired);
          AppBillImport.cssQuantityConfirm($(this).find('.quantity'));
        });
        AppBillImport.calculateProducts();
      }
    });

    // Điền số lượng dồng loạt
    $('.pushQtyAll').on('click', 'i.cursor-pointer', function () {
      let element = $(this).siblings('input');
      let qty = element.val() ? element.val() : 0;

      if ($('body .productItem').length) {
        const match = /^-?\d*((\.|\,)\d+)?$/;
        $('.productItem').each(function () {
          const typeId = parseInt($(this).attr('data-productTypeId'));
          if (typeId != appConsts.product.types.TYPE_IMEI) {
            if (typeId == appConsts.product.types.TYPE_WEIGHT_MEASURE) {
              if (qty.match(match)) {
                $(this).find('.quantity').val(qty);
                AppBillImport.cssQuantityConfirm($(this).find('.quantity'));
              }
            } else {
              if (!isNaN(qty) && qty > 0) {
                $(this).find('.quantity').val(parseInt(qty));
                AppBillImport.cssQuantityConfirm($(this).find('.quantity'));
              }
            }
          }
        });
        AppBillImport.calculateProducts();
      }
      element.val('');
    });

    // Điền giá đồng dồng loạt
    $('.priceHeader').on('click', 'i.cursor-pointer', function () {
      let element = $(this).siblings('input');
      let val = element.val();

      if ($('body .productItem').length) {
        $('.productItem').each(function () {
          AutoNumeric.set($(this).find('.price').get(0), val);
        });
        AppBillImport.calculateProducts();
      }
      AutoNumeric.set(element.get(0), '');
    });

    // Điền chiết khấu dồng loạt
    $('.discountHeader').on('click', 'i.cursor-pointer', function () {
      let type = $(this).siblings('select').val();
      let element = $(this).siblings('input');
      let val = element.val();

      if (type && $('body .productItem').length) {
        $('.productItem').each(function () {
          $(this).find('.typePsDiscount').val(type).change();
          AutoNumeric.set($(this).find('.psDiscount').get(0), val);
          $(this).find('.psDiscount').change();
        });
        AppBillImport.calculateProducts();
      }
      element.val('');
    });

    /*
    * Sản phẩm chọn từ /supplier/product/index
    * - Load lô hàng
    * - Load đơn vị tính
    *
    * */
    if ($('body #productList .productItem.psSupplier').length) {
      AppBillImport.handlerProductSupplier();
      $(document).on('change', '#depotId', function () {
        AppBillImport.handlerProductSupplier();
      });
    }
  },
  handlerProductSupplier() {
    const storeId = $('#storeId').val();
    const depotId = $('#depotId').val();
    let psIds = [];
    $('#productList .productItem').each(function () {
      const psId = parseInt($(this).attr('data-productStoreId'));
      const typeId = parseInt($(this).attr('data-productTypeId'));
      const elementId = $(this).attr('id');

      if (typeId === appConsts.product.types.TYPE_BATCH || typeId === appConsts.product.types.TYPE_MULTI_UNITS) {
        AppBillImport.loadProductMoreInfor({
          id: psId,
          storeId: $('#storeId').val()
        }, '#' + elementId);

        if (typeId === appConsts.product.types.TYPE_BATCH) {
          // Khỏi tạo suggest lô cho sản phẩm lô
          productSuggestHandler.loadProductBatch({
            storeId: '#storeId',
            depotId: '#depotId',
            tbSuggest: $('#' + elementId).find('.productBatchTxt'),
            selectHandler: item => AppBillImport.addProductBatchToRow(item)
          });
        }
      } else if (storeId) {
        psIds.push(psId);
      }
    });
    if (psIds.length) {
      AppAjax.ajax({
        url: '/product/item/load',
        type: 'POST',
        dataType: 'JSON',
        data: {
          tab: 'loadInventory',
          storeId: storeId,
          depotId: depotId,
          ids: psIds
        },
        success: rs => {
          if (rs.code > 0 && rs.data) {
            $.each(rs.data, (k, v) => {
              $(`#row_${v.id} .psAvailable`).text(v.remain).attr('data-value', v.remain);
            });
          }
        }
      });
    }
  },

  // Load sản phẩm con khi chọn sản phẩm cha (Bán theo ri)
  loadAllChildsProduct: function (item, depotId) {
    AppAjax.ajax({
      url: '/product/item/loaddata?tab=loadallchilds',
      type: 'POST',
      dataType: 'JSON',
      data: {
        storeId: item.storeId,
        depotId: depotId,
        productStoreId: item.id
      },
      success: function (rs) {
        if (rs.data) {
          $.each(rs.data, function (index, value) {
            AppBillImport.addProduct(value);
          });
          return true;
        }

        AppBillImport.addProduct(item);
      }
    });
  },
  //Post dữ liệu lên server
  submit: function () {
    if (AppBillImport.isSubmitted) {
      return false;
    }
    /*
    * https://work.1app.vn/loi-nhap-kho-bi-nhay-phieu.t503264.p5002?businessId=124
    * - Khi bấm nút sẽ set lại biến "isSubmitted" dể chặn click luôn tránh tình huống máy user đang đơ,
    *   user tiếp tục bấm tiếp sẽ bị gửi nhiều phiếu lên hệ thống cùng lúc
    * - Trường hợp nếu validate không pass thì set lại == false để có thể bấm đc tiếp tục
    * */
    AppBillImport.isSubmitted = true;

    // Kiểm tra thông tin
    var bill = AppBillImport.getBill();
    if (!bill.info.storeId) {
      AppModal.show({
        title: 'Lỗi',
        content: 'Bạn chưa chọn doanh nghiệp'
      });
      $('#storeId').focus();
      AppBillImport.isSubmitted = false;
      return false;
    }
    if (!bill.info.depotId) {
      AppModal.show({
        title: 'Lỗi',
        content: 'Bạn chưa chọn cửa hàng'
      });
      $('#depotId').focus();
      AppBillImport.isSubmitted = false;
      return false;
    }
    if (!bill.info.mode) {
      AppModal.show({
        title: 'Lỗi',
        content: 'Bạn chưa chọn phương thức nhập hàng'
      });
      $('#mode').focus();
      AppBillImport.isSubmitted = false;
      return false;
    }
    if (bill.info.mode == appConsts.imex.modes.MODE_OTHER) {
      if (storeSuggestHandler.storeSettings.accounting.useAccounting && bill.payment.money && !bill.payment.moneyAccountId) {
        AppModal.show({
          title: 'Lỗi',
          content: 'Bạn chưa chọn tài khoản thanh toán tiền mặt'
        });
        AppBillImport.isSubmitted = false;
        return false;
      }
      bill.payment.cashAccountId = bill.payment.moneyAccountId;
      if (storeSuggestHandler.storeSettings.accounting.useAccounting && bill.payment.money && !bill.info.customerMobile) {
        AppModal.show({
          title: 'Lỗi',
          content: 'Bạn chưa điền thông tin khách hàng'
        });
        AppBillImport.isSubmitted = false;
        return false;
      }
    }

    if (storeSuggestHandler.storeSettings.accounting.useAccounting && bill.info.mode == appConsts.imex.modes.MODE_SUPPLIER && !bill.info.supplierId) {
      AppModal.show({
        title: 'Lỗi',
        content: 'Bạn chưa nhập nhà cung cấp'
      });
      $('#supplierName').focus();
      AppBillImport.isSubmitted = false;
      return false;
    }

    if (storeSuggestHandler.storeSettings.accounting.useAccounting && bill.payment.cash && !bill.payment.cashAccountId) {
      AppModal.show({
        title: 'Lỗi',
        content: 'Bạn chưa chọn tài khoản thanh toán tiền mặt'
      });
      $('#cashAccountId').focus();
      AppBillImport.isSubmitted = false;
      return false;
    }

    if (storeSuggestHandler.storeSettings.accounting.useAccounting && bill.payment.moneyTransfer && !bill.payment.transferAccountId) {
      AppModal.show({
        title: 'Lỗi',
        content: 'Bạn chưa chọn tài khoản thanh toán chuyển khoản'
      });
      $('#transferAccountId').focus();
      AppBillImport.isSubmitted = false;
      return false;
    }

    if (!bill.products.length) {
      AppModal.show({
        title: 'Lỗi',
        content: 'Bạn chưa nhập sản phẩm'
      });
      $('#tbLoadProduct').focus();
      AppBillImport.isSubmitted = false;
      return false;
    }

    if (bill.info.taxBillDate) {
      var matches = /^(\d{2})[\/](\d{2})[\/](\d{4})$/.exec(bill.info.taxBillDate);
      if (matches == null) {
        AppModal.show({
          title: 'Lỗi',
          content: 'Ngày xuất hóa đơn VAT không hợp lệ'
        });
        $('#taxBillDate').focus();
        AppBillImport.isSubmitted = false;
        return false;
      }
    }

    if (bill.info.debtDueDate) {
      var matches2 = /^(\d{2})[\/](\d{2})[\/](\d{4})$/.exec(bill.info.debtDueDate);
      if (matches2 == null) {
        AppModal.show({
          title: 'Lỗi',
          content: 'Ngày hẹn thanh toán không hợp lệ'
        });
        $('#debtDueDate').focus();
        AppBillImport.isSubmitted = false;
        return false;
      }
    }

    if (bill.data.totalProductDiscount && bill.payment.manualDiscount) {
      AppModal.show({
        title: 'Lỗi',
        content: 'Chỉ được phép điền 1 loại chiết khấu: theo hóa đơn hoặc theo sản phẩm'
      });
      $('#manualDiscount').focus();
      AppBillImport.isSubmitted = false;
      return false;
    }

    var isValid = true;
    $.each(bill.products, function (index, value) {
      if (!value.quantity) {
        AppModal.show({
          title: 'Lỗi',
          content: 'Bạn chưa điền số lượng sản phẩm: ' + value.name
        });
        $('#row_' + value.id).find('.quantity').focus();
        isValid = false;
        return false;
      }
      if (value.expiredDate) {
        var matches2 = /^(\d{2})[\/](\d{2})[\/](\d{4})$/.exec(value.expiredDate);
        if (matches2 == null) {
          AppModal.show({
            'title': 'Lỗi',
            'classTitle': 'text-danger',
            'content': 'Ngày hết hạn không hợp lệ sản phẩm:' + value.name,
          });
          isValid = false;
          return false;
        }
      }
      if (value.quantity <= 0) {
        $('#row_' + value.id).find('.quantity').focus();
        AppModal.show({
          'title': 'Lỗi',
          'classTitle': 'text-danger',
          'content': 'Bạn không được nhập số lượng là số âm sản phẩm: ' + value.name,
        });
        isValid = false;
        return false;
      }
      if (value.typeId == appConsts.product.types.TYPE_BATCH) {
        if (!value.batchId) {
          AppModal.show({
            title: 'Lỗi',
            content: 'Bạn chưa nhập lô sản phẩm: ' + value.name
          });
          $('#row_' + value.id).find('.quantity').focus();
          isValid = false;
          return isValid;
        }
        var valid = AppBillImport.checkBatchProducts(value, bill.products);
        if (valid == false) {
          AppModal.show({
            title: 'Lỗi',
            content: 'Lô sản phẩm bị trùng nhau: ' + value.name
          });
          isValid = false;
          return isValid;
        }
      }

      if (value.typeId == appConsts.product.types.TYPE_MULTI_UNITS) {
        if (!value.unitId) {
          AppModal.show({
            title: 'Lỗi',
            content: 'Bạn chưa nhập đơn vị tính cho sản phẩm: ' + value.name
          });
          $('#row_' + value.id).find('.psUnitId').focus();
          isValid = false;
          return isValid;
        }
      }

      if (value.typeId == appConsts.product.types.TYPE_IMEI) {
        if (!value.imei) {
          $('#row_' + value.id).find('.imei').focus();
          AppModal.show({
            title: 'Lỗi',
            content: 'Bạn chưa nhập IMEI cho sản phẩm: ' + value.name
          });
          isValid = false;
          return isValid;
        }
        if (value.quantity != value.imei.split('\n').length) {
          $('#row_' + value.id).find('.imei').focus();
          AppModal.show({
            title: 'Lỗi',
            content: 'Số lượng IMEI không khớp số lượng sản phẩm'
          });
          isValid = false;
          return isValid;
        }

        // Kiểm tra imei trong 1 sản phẩm
        var valid2 = AppBillImport.checkExistedProductImei(value, bill.products);
        if (valid2 == false) {
          isValid = false;
          return isValid;
        }
      }

      // số lượng lỗi <= số lượng
      if (value.damaged && value.quantity && value.damaged > value.quantity) {
        $('#row_' + value.id).find('.damaged').focus();
        AppModal.show({
          title: 'Lỗi',
          content: 'Số lượng không hợp lệ: ' + value.name
        });
        isValid = false;
        return false;
      }

      if (value.discount > AppFuntions.roundFloatNumber(value.quantity * value.price)) {
        $('#row_' + value.id).find('.psDiscount').focus();
        AppModal.show({
          title: 'Lỗi',
          content: 'Chiết khấu không hợp lệ: ' + value.name
        });
        isValid = false;
        return isValid;
      }

      // Kiểm tra Xuất âm khi xuất trả NCC
      if (bill.typeExport && !storeSuggestHandler.storeSettings.pos.negativeExportSupplier) {
        if (value.quantity > value.available) {
          $('#row_' + value.id).find('.quantity').focus();
          AppModal.show({
            title: 'Lỗi',
            content: 'Sản phẩm không thể xuất trả: ' + value.name
          });
          isValid = false;
          return false;
        }
      }
    });
    if (!isValid) {
      AppBillImport.isSubmitted = false;
      return false;
    }

    AppBillImport.warning = 0;
    var url = '';
    if (AppBillImport.typeImport) {
      url = '/inventory/bill/import';
    } else if (AppBillImport.typeExport) {
      url = '/inventory/bill/export';
    }

    $('#msgErrors').removeClass('alert alert-danger').html('');
    AppBillImport.totalItem = bill.products.length;
    saveSupplier(url, bill);
  },
  // Kiểm tra trùng imei sản phẩm
  checkExistedProductImei: function (objProduct, objProducts) {
    // Kiểm tra các imei nhập vào cho 1 sản phẩm
    var isValid = true;
    var productStoreId = parseInt(objProduct.id);
    var arrImeis = objProduct.imei.trim().split("\n");
    var cacheImeis = [];
    $.each(arrImeis, function (index, value) {
      if (cacheImeis.length && cacheImeis.indexOf(value) != -1) {
        if ($('#row_' + objProduct.id).find('.errImei').length) {
          $('#row_' + objProduct.id).find('.errImei').html('Trùng IMEI "' + value + '". Bạn vui lòng kiểm tra lại!');
        } else {
          $('#row_' + objProduct.id).find('.imei').parent().append('<div style="float: left;color: #FF0000;margin-top: 5px;" class="errImei">Trùng IMEI "' + value + '". Bạn vui lòng kiểm tra lại!</div>');
        }
        isValid = false;
        return isValid;
      }

      $('#row_' + objProduct.id).find('.errImei').html('');
      cacheImeis.push(value);
      isValid = true;
    });

    if (!isValid) {
      return isValid;
    }

    // Kiểm tra các imei nhập vào của 1 sản phẩm với imei của các sản phẩm khác
    $.each(objProducts, function (idx, vl) {
      if (parseInt(vl.id) != productStoreId) {
        var arrIms = vl.imei.trim().split("\n");
        $.each(arrIms, function (i, v) {
          if (cacheImeis.length) {
            if (cacheImeis.indexOf(v) != -1) {
              if ($('#row_' + objProduct.id).find('.errImei').length) {
                $('#row_' + objProduct.id).find('.errImei').html('Trùng IMEI "' + v + '" với sản phẩm "' + vl.name + '". Bạn vui lòng kiểm tra lại!');
              } else {
                $('#row_' + objProduct.id).find('.imei').parent().append('<div style="float: left;color: #FF0000;margin-top: 5px;" class="errImei">Trùng IMEI "' + v + '" với sản phẩm "' + vl.name + '". Bạn vui lòng kiểm tra lại!</div>');
              }
              isValid = false;
              return isValid;
            } else {
              $('#row_' + vl.id).find('.errImei').html('');
              isValid = true;
            }
          }
        });
      }
    });

    return isValid;
  },
  showErrors: function (errors) {
    $.each(errors, function (key, messages) {
      $('#' + key).closest('.form-group').find('.error').empty().append('<span class="validation-invalid-label">' + messages[0] + '</span>');
    });
  },

  // Thêm sản phẩm
  addProduct: function (item) {
    if (parseInt(item.typeId) == appConsts.product.types.TYPE_COMBO) {
      AppModal.show({
        title: 'Lỗi',
        content: 'Không hỗ trợ nhập tồn kho cho sản phẩm combo'
      });
      return false;
    }
    var storeId = $("#storeId").val();
    var mode = $("#mode").val();
    var classViewImportPrice = canViewImportPrice ? '' : 'd-none';
    if ($('#row_' + item.id).length && parseInt(item.typeId) != appConsts.product.types.TYPE_BATCH) {
      if (parseInt(item.typeId) != appConsts.product.types.TYPE_IMEI) {
        var textQuantity = $('#row_' + item.id).find('input.quantity');
        var quantity = textQuantity.val() ? parseInt(textQuantity.val()) : 0;
        quantity += 1;
        textQuantity.val(quantity);
      }
    } else {
      $('#productList .addingProperties').removeClass('addingProperties');
      var arrProducts = [];
      if (item.code) {
        arrProducts.push(item.code);
      }
      if (item.barcode) {
        arrProducts.push(item.barcode);
      }
      if (item.name) {
        $nameElement = '<span class="psName">' + item.name;
        $nameElement += '</span>';
        if (parseInt(item.typeId) == parseInt(appConsts.product.types.TYPE_BATCH)) {
          $nameElement += "<div class='batchItem'>";
          $nameElement += "</div>";
        }
        arrProducts.push($nameElement);
      }
      var txtError = '';
      var psAvailable = item.remain;
      // Thêm ô nhập lỗi khi trả NCC với loại sản phẩm không phải IMEI
      if (!AppBillImport.typeImport) {
        // psAvailable = item.remain;
        txtError = '<input type="text" class="damaged form-control text-right" style="width: 40px;">';
      }
      var textPsDiscount = '<div class="input-group" style="width: 100px;float: right;"><div class="input-group-prepend">';
      textPsDiscount += '<select style="max-width: 40px;" class="typePsDiscount form-control float-left px-0" title="Loại chiết khấu">';
      textPsDiscount += '<option value="cash">$</option>';
      textPsDiscount += '<option value="percent">%</option>';
      textPsDiscount += '</select></div>';
      textPsDiscount += '<input style="width: 60px;" type="text" class="psDiscount keyCodeChange autoNumericDecimal form-control text-right float-left p-1" >';
      textPsDiscount += '</div>';
      if (mode == appConsts.imex.modes.MODE_OTHER) {
        textPsDiscount = '';
      }
      let elementId = 'row_' + item.id;
      var row = '<tr class="productItem addingProperties ' + elementId + '" id="' + elementId + '" data-productStoreId="' + item.id + '" ' +
        'data-productTypeId="' + item.typeId + '" data-imexId="">';
      row += `<td class="stt text-center"></td>`;
      row += '<td class="dgColName">' + arrProducts.join('<br>') + '</td>';
      if (storeSuggestHandler.storeSettings.pos.hasProductBatchConfig) {
        row += '<td class="psBatchGroup position-relative">';
        if (parseInt(item.typeId) == appConsts.product.types.TYPE_BATCH) {
          if (canAddProductBatch) {
            row += '<div class="input-group justify-content-center">' +
              '<input data-psid="' + item.id + '" placeholder="Số lô/ NSX" type="text" class="form-control productBatchTxt px-1" autocomplete="off" />' +
              '<div class="input-group-prepend"><a href="javascript:" data-psid="' + item.id + '" title="Thêm nhanh lô" data-toggle="tooltip" ' +
              'class="addQuickProductBatchBtn input-group-addon btn-success d-inline-flex align-items-center justify-content-center cursor-pointer" ><i class="fal fa-plus"></i></a></div>' +
              '</div>';
          } else {
            row += '<input data-psid="' + item.id + '" placeholder="Số lô/ NSX" type="text" class="form-control productBatchTxt px-1" autocomplete="off" />';
          }
        }
        row += '</td>';
      }
      row += '<td class="colUnit"></td>';
      row += '<td class="psAvailable text-right" data-value="' + psAvailable + '">' + psAvailable + '</td>';
      // Từ phiếu nháp => Thêm cột số lượng nháp
      if (isRequiredBill) {
        row += '<td class="text-right quantityRequired" data-value="0">0</td>';
      }
      if (parseInt(item.typeId) == appConsts.product.types.TYPE_IMEI) {
        row += '<td class="text-right"><input type="text" value="1" readonly="readonly" style="width: 80px;float: right;" autocomplete="off" class="form-control text-right quantity px-1"></td>' +
          '<td class="text-right"></td>' +
          '<td><textarea class="form-control imei p-1" style="min-width: 150px;" cols="20" rows="1"></textarea></td>';
      } else {
        row += '<td class="text-right"><input type="text" value="1" style="width:80px;float: right;" autocomplete="off" class="form-control text-right quantity keyCodeChange px-1"></td>' +
          '<td class="text-right">' + txtError + '</td><td></td>';
      }
      row += '<td class="text-right ' + classViewImportPrice + '"><input type="text" class="form-control autoNumeric text-right price keyCodeChange px-1" autocomplete="off" value="' + item.importPrice + '" style="width:105px;float: right;" ></td>';
      row += '<td class="priceTotal text-right ' + classViewImportPrice + '">' + AppFuntions.formatDecimal(item.importPrice) + '</td>';
      row += '<td class="' + classViewImportPrice + '">' + textPsDiscount + '</td>';
      row += '<td class="text-right"><input type="text" class="form-control autoNumeric text-right weight keyCodeChange p-1" autocomplete="off" value="' + item.weight + '" style="width:40px;float: right;" ></td>';
      if (storeSuggestHandler.storeSettings.pos.cf_imex_supplier_has_expire) {
        if (parseInt(item.typeId) != appConsts.product.types.TYPE_IMEI && mode == appConsts.imex.modes.MODE_SUPPLIER) {
          row += ' <td><input type="text" class="form-control tbDatePicker expiredDate" autocomplete="off" ></td>';
        } else {
          row += ' <td></td>';
        }
      }
      row += '<td class="text-center"><div class="dropdown"> ' +
        '<button type="button" class="btn dropdown-toggle btn-icon p-1 border-0" data-toggle="dropdown" aria-expanded="true"><i class="fal fa-bars"></i></button> ' +
        '<div class="dropdown-menu dropdown-menu-right"> ' +
        '<a href="javascript:void(0);" class="dropdown-item showItemDescription"><i class="fal fa-comment-alt-edit mr-2"></i>Hiện ô nhập ghi chú</a> ' +
        '<a href="javascript:void(0);" class="delProduct dropdown-item text-danger"><i class="fal fa-trash mr-2"></i>Xóa sản phẩm</a>' +
        '</div></div></td>';
      row += '</tr>';
      $('#productList tbody').prepend(row);
      if ($('.' + elementId + ' .autoNumeric').length) {
        AppFuntions.initAutoNumeric('.' + elementId + ' .autoNumeric');
      }
      if ($('.' + elementId + ' .autoNumericDecimal').length) {
        AppFuntions.initAutoNumericDecimal('.' + elementId + ' .autoNumericDecimal');
      }
      if (parseInt(item.typeId) == appConsts.product.types.TYPE_BATCH) {
        productSuggestHandler.loadProductBatch({
          storeId: '#storeId',
          depotId: '#depotId',
          tbSuggest: $('#' + elementId).find('.productBatchTxt'),
          selectHandler: function (item) {
            AppBillImport.addProductBatchToRow(item);
          }
        });
      }
      $('.expiredDate').daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false,
        showDropdowns: true,
        locale: {
          format: "DD/MM/YYYY",
          daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
          monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
          firstDay: 1
        }
      }).on('apply.daterangepicker', function (ev, picker) {
        picker.element.val(picker.startDate.format('DD/MM/YYYY'));
      });
      AppBillImport.loadProductMoreInfor(item);
    }

    AppBillImport.calculateProducts();
    AppBillImport.calculatorStt();
  },
  // Cập nhật STT sản phẩm
  calculatorStt: function () {
    let productItems = $('body .productItem');
    if (productItems.length) {
      productItems.each(function (k) {
        $(this).find('.stt').html(parseInt(k + 1));
      });
    }
  },
  loadProductMoreInfor: function (item, el = null) {
    if (!item.id || !item.storeId) {
      return false;
    }
    AppAjax.ajax({
      url: '/product/item/suggest?tab=moreinfor',
      type: 'POST',
      dataType: 'JSON',
      data: {
        storeId: item.storeId,
        productStoreId: item.id,
        isLoadBatchOld: 1,
        isLoadUnit: 1,
      },
      success: function (rs) {
        if (rs.batch) {
          AppBillImport.addProductBatchToRow(rs.batch, el);
        }

        if (rs.units) {
          var html = '<select class="psUnitId form-control p-1"><option value="">--</option>';
          $.each(rs.units, function (unitId, unit) {
            html += '<option value="' + unitId + '">' + unit.name + '</option>';
          });
          html += '</select>';
          $('#productList .productItem[data-productstoreid="' + item.id + '"]').find('.colUnit').html(html);
        } else if (rs.unit) {
          $('#productList .productItem[data-productstoreid="' + item.id + '"]').find('.colUnit').text(rs.unit);
        }
      }
    });
  },

  addProductBatchToRow: function (pb, el = null) {
    var textDate = '';
    if (pb.expiredDate) {
      textDate = '<span title="Ngày hết hạn"><i class="fal fa-calendar-times mr-1"></i>' + pb.expiredDate + '</span>';
    } else if (pb.manufactureDate) {
      textDate = '<span title="Ngày sản xuất">' + pb.manufactureDate + '</span>';
    }
    var row = '<span data-id="' + pb.id + '" class="badge bg-blue ml-auto batchInfor batchInfor_' + pb.id + '">' + pb.name + ' - ' + textDate;
    row += '<i style="cursor:pointer;" class=" removeBatch fa fa-times text-danger"></i>';
    row += '</span> <br/>';
    if (el) {
      $(el).find('.batchItem').empty().append(row);
      if (pb.importPrice) {
        AutoNumeric.set(`${el} .price`, pb.importPrice);
      }
    } else {
      $('#productList .addingProperties').find('.batchItem').empty().append(row);
      if (pb.importPrice) {
        AutoNumeric.set('#productList .addingProperties .price', pb.importPrice);
      }
    }
    AppBillImport.loadProductBatchInventory(pb.id);
    AppBillImport.calculateProducts();
  },
  loadProductBatchInventory: function (batchId) {
    if (!batchId) {
      return false;
    }
    var storeId = $('#storeId').val();
    var depotId = $('#depotId').val();
    AppAjax.ajax({
      url: '/product/batch/load?tab=loadInventory',
      type: 'POST',
      dataType: 'JSON',
      data: {
        storeId: storeId,
        depotId: depotId,
        productBatchId: batchId
      },
      success: function (rs) {
        if (rs.code > 0) {
          available = rs.data.available;
          $('#productList .addingProperties').find('.psAvailable').empty().append(available);
          $('#productList .addingProperties').find('.psAvailable').attr('data-value', available);
        }
      }
    });
  },

  // css ô số lượng sản phẩm được duyệt
  cssQuantityConfirm: function (elmQuantity) {
    var quantity = elmQuantity.val();
    var quantityRequired = elmQuantity.parents('.productItem').find('.quantityRequired').attr('data-value');
    if (quantity > quantityRequired) {
      elmQuantity.css({ 'border': '1px solid #CA3C3C' });
    } else {
      elmQuantity.css({ 'border': '1px solid #149249' });
    }
  },

  // Tính toán sản phẩm
  calculateProducts: function () {
    AppBillImport.getBill();
  },

  // Lấy thông tin của phiếu
  getBill: function () {
    AppBillImport.bill = {};
    AppBillImport.bill.products = [];
    AppBillImport.bill.payment = {
      manualDiscountType: $('#manualDiscountType').val(),
      manualDiscount: $('#manualDiscount').val() ? AutoNumeric.getNumber('#manualDiscount') : 0,
      cash: $('#money').val() ? AutoNumeric.getNumber('#money') : 0,
      cashAccountId: $('#cashAccountId').val(),
      moneyTransfer: $('#moneyTransfer').val() ? AutoNumeric.getNumber('#moneyTransfer') : 0,
      transferAccountId: $('#transferAccountId').val(),
      money: $('#money').length ? AutoNumeric.getNumber('#money') : 0,
      moneyAccountId: $('#moneyAccountId').length ? $('#moneyAccountId').val() : '',
    };
    if (AppBillImport.bill.payment.manualDiscountType == 'percent') {
      if (AppBillImport.bill.payment.manualDiscount > 100) {
        AutoNumeric.set($('#manualDiscount').get(0), '');
        AppBillImport.bill.payment.manualDiscount = 0;

      }
    }
    AppBillImport.bill.data = {
      totalProductDiscount: 0,
      totalQuantity: 0,
      totalDamaged: 0,
      totalPrice: 0,
      totalWeight: 0
    };
    AppBillImport.bill.info = {
      storeId: $('#storeId').val(),
      depotId: $('#depotId').val(),
      mode: $('#mode').val(),
      supplierId: $('#supplierId').val(),
      saleId: $('#saleId').val(),
      vatType: $('#vatType').val(),
      vatValue: AutoNumeric.getNumber('#vatValue'),
      taxBillCode: $('#taxBillCode').val(),
      taxBillDate: $('#taxBillDate').val(),
      description: $('#description').val(),
      debtDueDate: $('#debtDueDate').val(),
      printMode: $('#printMode').val(),
      afterSubmit: $('input[name="afterSubmit"]:checked').val(),
      updateImportPrice: $('input[name="updateImportPrice"]').is(':checked') ? 1 : 0,
      relatedBillId: $('#relatedBillId').val(),
      requirementBillId: $('#requirementBillId').val(),
      billId: $('#billId').length ? $('#billId').val() : '',
      finished: 0,
      customerId: $('#customerId').length ? $('#customerId').val() : '',
      customerName: $('#customerName').length ? $('#customerName').val() : '',
      customerMobile: $('#customerMobile').length ? $('#customerMobile').val() : '',
      tagIds: $('#tagIds').length ? $('#tagIds').val() : ''
    };
    var hasProductWeight = false; //Biến đánh dấu có sản phẩm cân đo hay không, nếu có thì fix cố định giá trị float
    $('.productItem').each(function () {
      var p = {};
      p.name = $(this).find('.psName') ? $(this).find('.psName').html() : '';
      p.description = $(this).find('.editDescription') ? $(this).find('.editDescription').val() : '';
      p.available = $(this).find('.psAvailable').attr('data-value') ? parseInt($(this).find('.psAvailable').attr('data-value')) : 0;
      p.typeId = $(this).attr('data-productTypeId');
      p.imexId = $(this).attr('data-imexId');
      p.oldimeis = $(this).attr('data-oldimeis') ? $(this).attr('data-oldimeis') : '';
      p.id = $(this).attr('data-productStoreId');
      var quantity = $(this).find('input.quantity').val();
      quantity = quantity.replace(',', '.');
      if (p.typeId == appConsts.product.types.TYPE_WEIGHT_MEASURE) {
        p.quantity = quantity ? parseFloat(quantity) : 0;
        hasProductWeight = true;
      } else {
        p.quantity = quantity ? parseInt(quantity) : 0;
      }
      let elementId = $(this).attr('id');
      p.damaged = $(this).find('input.damaged') && $(this).find('input.damaged').val() ? parseInt($(this).find('input.damaged').val()) : 0;
      p.price = $(this).find('input.price') && $(this).find('input.price').val() ? AutoNumeric.getNumber($(this).find('input.price').get(0)) : 0;
      p.weight = $(this).find('input.weight') && $(this).find('input.weight').val() ? AutoNumeric.getNumber($(this).find('input.weight').get(0)) : 0;
      p.imei = $(this).find('.imei') && $(this).find('.imei').val() ? $(this).find('.imei').val().trim() : '';
      var psDiscount = $(this).find('.psDiscount').val() ? AutoNumeric.getNumber($(this).find('.psDiscount').get(0)) : '';
      var typePsDiscount = $(this).find('.typePsDiscount').val();
      if (typePsDiscount == 'percent') {
        if (psDiscount > 100) {
          AutoNumeric.set($(this).find('.psDiscount').get(0), '');
          psDiscount = 0;
        }
        psDiscount = p.quantity * (p.price * psDiscount / 100);
      }
      psDiscount = parseInt(psDiscount);
      p.discount = psDiscount ? psDiscount : 0;
      p.expiredDate = $(this).find('.expiredDate').val();
      var batchId = $(this).find('.batchInfor').attr('data-id');
      if (batchId) {
        p.batchId = batchId;
      }
      p.unitId = $(this).find('.psUnitId').val() ? parseInt($(this).find('.psUnitId').val()) : 0;

      AppBillImport.bill.products.push(p);
      $(this).find('.priceTotal').html(AppFuntions.formatDecimal(AppFuntions.roundFloatNumber(p.quantity * p.price)));

      AppBillImport.bill.data.totalQuantity += p.quantity;
      AppBillImport.bill.data.totalProductDiscount += p.discount;
      AppBillImport.bill.data.totalDamaged += p.damaged;
      AppBillImport.bill.data.totalPrice += AppFuntions.roundFloatNumber(p.quantity * p.price);
      AppBillImport.bill.data.totalWeight += p.quantity * p.weight;
    });

    // Tính toán dòng tổng trong danh sách sản phẩm
    if (hasProductWeight) {
      $('#totalQuantity').html(AppBillImport.bill.data.totalQuantity.toFixed(2));
    } else {
      $('#totalQuantity').html(AppFuntions.formatDecimal(AppBillImport.bill.data.totalQuantity));
    }

    var totalPsDiscount = AppFuntions.roundFloatNumber(AppBillImport.bill.data.totalProductDiscount, 100);
    $('#totalPsDiscount').html(AppFuntions.formatDecimal(totalPsDiscount));
    $('#totalDamaged').html(AppFuntions.formatDecimal(AppBillImport.bill.data.totalDamaged));
    $('#totalPrice').html(AppFuntions.formatDecimal(AppBillImport.bill.data.totalPrice));
    $('#totalWeight').html(AppFuntions.formatDecimal(AppBillImport.bill.data.totalWeight));

    // tính toán lại công nợ nhà cung cấp
    var manualDiscount = AppBillImport.bill.data.totalProductDiscount;
    if (AppBillImport.bill.payment.manualDiscount) {
      manualDiscount = AppBillImport.bill.payment.manualDiscount;
      if (AppBillImport.bill.payment.manualDiscountType == 'percent') {
        manualDiscount = AppBillImport.bill.data.totalPrice * AppBillImport.bill.payment.manualDiscount / 100;
      }
    }

    var vatMoney = 0;
    if (AppBillImport.bill.info.vatValue) {
      vatMoney = parseInt(AppBillImport.bill.info.vatValue);
      if (AppBillImport.bill.info.vatType == 'percent') {
        vatMoney = parseInt(Math.round((AppBillImport.bill.data.totalPrice - manualDiscount) * AppBillImport.bill.info.vatValue / 100));
      }
    }

    var moneyNeedPayment = AppBillImport.bill.data.totalPrice + vatMoney - manualDiscount;
    moneyNeedPayment = AppFuntions.roundFloatNumber(moneyNeedPayment, 100);
    $('#moneyNeedPayment').text(AppFuntions.formatDecimal(moneyNeedPayment));
    var moneyPayment = AppBillImport.bill.data.totalPrice + vatMoney - manualDiscount - AppBillImport.bill.payment.cash - AppBillImport.bill.payment.moneyTransfer;
    AppBillImport.calculateDebtSuppler(moneyPayment);

    return AppBillImport.bill;
  },

  // tính toán công nợ nhà cung cấp trong khi thêm hóa đơn
  calculateDebtSuppler: function (money) {
    if (!storeSuggestHandler.storeSettings.accounting.useAccounting) {
      return false;
    }

    money = money ? parseInt(money) : 0;
    if ($('#debtSupplier').attr('debt')) {
      var debtSupplier = $('#debtSupplier').attr('debt') ? parseInt($('#debtSupplier').attr('debt')) : 0;
      var debtSupplierNew = 0;
      if (debtSupplier < 0) { // Nợ NCC
        debtSupplierNew = - (Math.abs(debtSupplier) + money);
        if (AppBillImport.typeExport) {
          debtSupplierNew = money - Math.abs(debtSupplier);
        }
      } else { // NCC nợ
        debtSupplierNew = debtSupplier - money;
        if (AppBillImport.typeExport) {
          debtSupplierNew = debtSupplier + money;
        }
      }

      var textDebts = 'Công nợ sau khi lưu phiếu:';
      var html = '<span id="debtSupplierNew">' + textDebts + '<strong style="color: red;">' + AppFuntions.formatDecimal(Math.abs(debtSupplierNew)) + '</strong></span>';
      if (!$('#debtSupplierNew').length) {
        $('#debtSupplier').append(html);
      } else {
        $('#debtSupplierNew').html(textDebts + '<strong style="color: red;">' + AppFuntions.formatDecimal(Math.abs(debtSupplierNew)) + '</strong>');
      }
    }
  },
  // load tài khoản kế toán, công nợ NCC nếu doanh nghiệp sử dụng kế toán
  loadUseAccounting: function () {
    var classViewImportPrice = canViewImportPrice ? '' : 'hide';
    var storeId = $('#storeId').val();
    if (storeId) {
      if (storeSuggestHandler.storeSettings.accounting.useAccounting) {
        AppBillImport.loadAccounts();
        AppBillImport.loadSupplierDebt();
      } else {
        $('#cashAccountId').val('');
        $('#wrapCash').hide();
        $('#transferAccountId').val('');
        $('#wrapTransfer').hide();
        $('#moneyAccountId').val('');
        $('#wrapMoneyAccountId').hide();
        $('#wrapTransferAccountId').hide();
      }
    } else {
      $('#cashAccountId').val('');
      $('#wrapCash').hide();
      $('#transferAccountId').val('');
      $('#wrapTransfer').hide();
    }
    let colSpanTotal = 4;
    let colSpanNeedPayment = 8;
    let colSpanNeedPaymentLast = 5;
    if (typeof reqBillId != "undefined" && reqBillId) {
      colSpanNeedPayment += 1;
    }
    if (storeSuggestHandler.storeSettings.pos.hasProductBatchConfig) {
      $('.batchHeader').removeClass('d-none');
      colSpanTotal += 1;
      colSpanNeedPayment += 1;
    } else {
      $('.batchHeader').addClass('d-none');
    }
    if (storeSuggestHandler.storeSettings.pos.cf_imex_supplier_has_expire) {
      colSpanNeedPaymentLast += 1;
      $('.expiredDateHeader').removeClass('d-none');
    } else {
      $('.expiredDateHeader').addClass('d-none');
    }
    $('#rowTotal td:eq(0)').attr('colspan', colSpanTotal);
    $('#needPayment td:eq(0)').attr('colspan', colSpanNeedPayment);
    $('#needPayment #tdLast').attr('colspan', colSpanNeedPaymentLast);
  },
  loadStoreData: function () {
    storeSuggestHandler.loadSettings({
      storeId: $('#storeId').val(),
      responseHandler: function () {
        AppBillImport.loadUseAccounting();
      }
    });
    storeSuggestHandler.loadDepots({
      storeId: $('#storeId').val(),
      autoPopulateSelectBoxDepot: '#depotId',
      defaultDepotId: $('#defaultDepotId').val()
    });
    AppBillImport.loadSupplier();
    AppBillImport.calculateProducts();
    AppBillImport.loadSettingImportPrice();

  },
  loadSupplier: function () {
    var storeId = $('#storeId').val();
    var mode = $('#mode').val();
    var defaultSupplierId = $('#defaultSupplierId').val() ? $('#defaultSupplierId').val() : '';
    var defaultSupplierName = $('#defaultSupplierName').val() ? $('#defaultSupplierName').val() : '';
    const box = $('#divSupplier');
    if (storeId) {
      AppAjax.ajax({
        url: '/inventory/imex/countsupplier',
        type: 'POST',
        dataType: 'JSON',
        data: { storeId: storeId },
        success: function (rs) {
          let html = '';
          let isSelectSupplier = 0;
          if (rs.data) {
            isSelectSupplier = 1;
            html += '<select id="supplierId" name="supplierId" class="form-control">';
            html += '<option value="">- Nhà cung cấp -</option>';
            $.each(rs.data, function (index, value) {
              var selected = '';
              if (defaultSupplierId && parseInt(defaultSupplierId) == parseInt(index)) {
                selected = 'selected="selected"';
              }
              html += '<option value="' + index + '" ' + selected + '>' + value + '</option>';
            });
            html += '</select>';
          } else {
            html += '<input type="hidden" id="supplierId" name="supplierId" value="' + defaultSupplierId + '">';
            html += '<input type="text" class="form-control" id="supplierName" name="supplierName" value="' + defaultSupplierName + '"' +
              ' autocomplete="off" placeholder="Nhà cung cấp">';
          }
          if (isSelectSupplier) {
            $('#supplierId').select2({
              'minimumResultsForSearch': 11
            });
          }
          if ($('.imexAddSupplier').length) {
            html += '<a title="Thêm nhanh nhà cung cấp" data-toggle="tooltip" id="addFastSupplier" class="input-group-addon"><i class="fa fa-plus"></i></a>';
          }
          html += '<div class="error text-danger"></div>';
          box.html(html);
          supplierSuggestHandler.load({
            storeId: '#storeId',
            tbSuggest: '#supplierName',
            emptyDataHandler: function () {
              $('#supplierId').val('');
            },
            selectHandler: function (item) {
              $("#supplierId").val(item.id);
              $("#supplierName").val(item.name);
              AppBillImport.loadSupplierDebt();
            }
          });
          if (mode == appConsts.imex.modes.MODE_OTHER) {
            box.hide();
            $('#manualDiscount').closest('.form-group').hide();
          } else {
            box.show();
            $('#manualDiscount').closest('.form-group').show();
          }
          $('#addFastSupplier').tooltip();
        }
      });
    }
  },
  loadSettingImportPrice: function () {
    return false;
    var storeId = $('#storeId').val();
    if (storeId) {
      AppAjax.ajax({
        url: '/pos/tool/loadsettingimportpriceimei',
        type: 'POST',
        dataType: 'JSON',
        data: { storeId: storeId },
        success: function (rs) {
          if (!rs.code) {
            AppBillImport.settingImeiImportPrice = 0;
            return false;
          }

          AppBillImport.settingImeiImportPrice = 1;
        }
      });
    }
  },
  // Danh sách tài khoản kế toán
  loadAccounts: function () {
    if (!storeSuggestHandler.storeSettings.accounting.useAccounting) {
      return false;
    }

    var storeId = $('#storeId').val();
    var depotId = $('#depotId').val();
    var mode = $('#mode').val();
    if (!storeId || !depotId) {
      $('#cashAccountId').html('<option value="">- Tài khoản trả tiền -</option>');
      $('#wrapCash').hide();
      $('#transferAccountId').html('<option value="">- Tài khoản trả tiền -</option>');
      $('#wrapTransfer').hide();
      $('#moneyAccountId').html('<option value="">- Tài khoản trả tiền -</option>');
      $('#wrapMoneyAccountId').hide();
      return false;
    }

    var types = [accountingTypeDepot, accountingTypeBank];
    storeSuggestHandler.loadAccountingAccounts({
      storeId: storeId,
      itemId: depotId,
      types: types,
      responseHandler: function (data) {
        // gán vào biến lưu trữ tài khoản kế toán
        storeSuggestHandler.assignAccountingAccounts(data, {
          depotId: depotId,
          assignElements: [
            {
              elementId: '#cashAccountId',
              label: 'Tài khoản trả tiền',
              typeAccount: accountingTypeDepot
            },
            {
              elementId: '#moneyAccountId',
              label: 'Tài khoản trả tiền',
              typeAccount: accountingTypeDepot
            },
            {
              elementId: '#transferAccountId',
              label: 'Tài khoản ngân hàng',
              typeAccount: accountingTypeBank
            }
          ],
          responseHandler: function () {
            if (mode == appConsts.imex.modes.MODE_OTHER) {
              $('#wrapMoneyAccountId').show();
            } else {
              $('#wrapCash').removeClass('hide').show();
              $('#wrapTransfer').removeClass('hide').show();
            }
          },
          errorHandler: function () {
            $('#wrapCash').addClass('hide').hide();
            $('#wrapTransferAccountId').addClass('hide').hide();
            $('#wrapMoneyAccountId').hide();
          }
        });
      }
    });
  },
  // Check trùng lô giữa các sản phẩm
  checkBatchProducts: function (product, products) {
    var isValid = true;
    var totalBatch = 0;
    $.each(products, function (index, value) {
      if (value.batchId == product.batchId) {
        totalBatch += 1;
      }
    });
    if (totalBatch > 1) {
      isValid = false;
    }
    return isValid;
  },
  // Load công nợ hiện tại của nhà cung cấp
  loadSupplierDebt: function () {
    if ($('#supplierId').val() && storeSuggestHandler.storeSettings.accounting.useAccounting) {
      AppAjax.ajax({
        url: '/accounting/debts/loadamount',
        type: 'POST',
        dataType: 'JSON',
        data: {
          storeId: $('#storeId').val(),
          itemId: $('#supplierId').val(),
          itemType: AppBillImport.contactTypeSupplier
        },
        success: function (rs) {
          const selectorDebt = $('#debtSupplier');
          if (rs.code) {
            var totalDebit = parseInt(rs.data.totalDebit);
            var totalCredit = parseInt(rs.data.totalCredit);
            var debts = totalDebit - totalCredit;
            var textDebts = 'Công nợ hiện tại: ';
            var html = '<span>' + textDebts + '<strong style="color: red;">' + AppFuntions.formatDecimal(Math.abs(debts)) + '. </strong></span>';
            selectorDebt.addClass('alert alert-warning').html(html);
            selectorDebt.attr('debt', debts);
            selectorDebt.removeClass('d-none');
          } else {
            selectorDebt.html('');
            selectorDebt.attr('debt', 0);
            selectorDebt.addClass('d-none');
          }
          AppBillImport.calculateProducts();
        }
      });
    }
  },

  /*
  * Hot key
 - F1: Mở 1 tab mới
  - F3: Focus vào ô sản phẩm
  - F6: Focus vào ô Chiết khấu
  - F8: Focus vào ô tiền mặt
  - F9: Lưu
  - F10: Lưu và In
  * */
  hotKeys: function () {
    shortcut.add("F1", function () {
      window.open('/inventory/bill/import', '_blank');
    });
    shortcut.add("F3", function () {
      $('#tbLoadProduct').focus();
    });
    shortcut.add("F6", function () {
      $('#manualDiscount').focus();
    });
    shortcut.add("F8", function () {
      $('#money').focus();
    });
    shortcut.add("F9", function () {
      $('#printMode').val(0);
      AppBillImport.submit();
    });
    shortcut.add("F10", function () {
      $('#printMode').val(1);
      AppBillImport.submit();
    });
  },
  changeMode: function (mode) {
    AppBillImport.resetValue();
    if (mode == appConsts.imex.modes.MODE_OTHER) {
      $('#wrapUpdateImportPrice').hide();
      $('.inforCustomer').show();
      $('#supplierArea').hide();
      $('#transferArea').show();
      $('#wrapCash').hide();
      $('#manualDiscount').closest('.form-group').hide();
      if (storeSuggestHandler.storeSettings.accounting.useAccounting) {
        $('#wrapMoneyAccountId').show();
        $('#wrapTransfer').show();
      } else {
        $('#moneyAccountId').val('');
        $('#wrapMoneyAccountId').hide();
        $('#wrapTransfer').hide();
      }
      return false;
    } else {
      $('#wrapMoneyAccountId').hide();
      $('.inforCustomer').hide();
      $('#supplierArea').show();
      $('#wrapCash').removeClass('hide').show();
      $('#wrapUpdateImportPrice').show();
      $('#transferArea').show();
      $('#manualDiscount').closest('.form-group').show();
    }
  },

  resetValue: function () {
    if (!$('#defaultSupplierId').val()) {
      $('#supplierId').val('');
      $('#supplierName').val('');
    }
    AutoNumeric.set('#vatValue', '');
    $('#taxBillCode').val('');
    $('#taxBillDate').val('');
    AutoNumeric.set('#money', '');
    $('#cashAccountId').val('');
    AutoNumeric.set('#moneyTransfer', '');
    $('#transferAccountId').val('');
    $('#debtDueDate').val('');
  },
  /*
  * Khai báo hàm để app mobile overwrite
  * */
  showErrorSubmit: function (messages) {
    AppModal.show({
      'title': 'Lỗi',
      'content': messages,
    });
  }
};
function saveSupplier(url, dataPost) {
  var products = dataPost.products;
  // Post dữ liệu lần đầu, Không có sản phẩm nào được post lên thì báo lỗi
  if (!products.length) {
    $('#msgErrors').addClass('alert alert-danger').html('Chưa có sản phẩm nào được thêm vào');
    AppBillImport.isSubmitted = false;
    AppCommon.overLoading({ display: 'hide' });
    return false;
  }

  var productsPosted = products.splice(0, AppBillImport.itemPost);
  dataPost.products = productsPosted;

  // Show modal và Hiển thị thanh %
  AppBillImport.itemPosted += AppBillImport.itemPost;
  showProcessBar(AppBillImport.itemPosted, AppBillImport.totalItem, {
    showProgressbar: '#showProgressbar',
    progress: '#progress'
  });

  // Sau khi tách mảng Nếu không còn sản phẩm nào => Báo kết thúc
  if (!products.length) {
    dataPost.info.finished = 1;
  }

  AppAjax.ajax({
    url: url,
    type: 'POST',
    dataType: 'JSON',
    data: { bill: dataPost },
    success: function (rs) {
      if (!rs.code) {
        AppBillImport.isSubmitted = false;
        $('#saveSupplierModal').removeClass('showed').modal('hide');
        $('#saveSupplierModal').on('shown.bs.modal', function (event) {
          $('#saveSupplierModal').removeClass('showed').modal('hide');
        });
        AppBillImport.showErrorSubmit(rs.messages);
        return false;
      }

      if (rs.data.warnings && rs.data.warnings.length) {
        var html = [];
        $.each(rs.data.warnings, function (index, value) {
          html.push('<p>' + value + '</p>');
        });
        $('#saveSupplierModal').removeClass('showed').modal('hide');
        $('#saveSupplierModal').on('shown.bs.modal', function (event) {
          $('#saveSupplierModal').removeClass('showed').modal('hide');
        });
        AppModal.show({
          title: 'Lỗi',
          content: html.join('<br/>'),
        });
        AppBillImport.warning = 1;
      }

      // Gán imexId cho các sản phẩm đã được lưu
      if (rs.data.imexIds) {
        dataPost.info.imexIds = rs.data.imexIds;
      }
      // Gán dữ liệu cho lần Post tiếp theo
      if (rs.data.imexBillId) {
        dataPost.info.imexBillId = rs.data.imexBillId;
        $('#billId').val(rs.data.imexBillId);
      } else {
        dataPost.info.imexBillId = '';
        $('#billId').val('');
      }
      if (rs.data.jsDiscountProduct) {
        dataPost.info.jsDiscountProduct = rs.data.jsDiscountProduct;
      }
      if (rs.data.imexProducts) {
        dataPost.info.imexProducts = rs.data.imexProducts;

        $('.productItem').each(function () {
          var element = $(this);
          var productStoreId = element.attr('data-productStoreId');
          $.each(rs.data.imexProducts, function (index, value) {
            if (value.productStoreId == productStoreId) {
              element.attr('data-imexid', value.id);
              if (value.imeis && value.imeis.length) {
                element.attr('data-oldimeis', value.imeis.join());
              }
            }
          });
        });
      }

      // Không còn sản phẩm => Hoàn tất
      if (!products.length) {
        if (rs.data.imexBillId) {
          appCacheRencent.saveCacheRecent({
            id: rs.data.imexBillId,
            customerName: rs.data.customerName ? rs.data.customerName : rs.data.customerMobile,
            totalMoney: rs.data.totalMoney ? rs.data.totalMoney : 0
          });
        }

        AppBillImport.isSubmitted = false;
        AppBillImport.itemPosted = 0;

        if (!AppBillImport.warning) {
          if (dataPost.info.afterSubmit == '/inventory/bill/import') {
            // Tiếp tục lập phiếu XNK từ nhà cung cấp
            window.location.href = '/inventory/bill/import?storeId=' + dataPost.info.storeId;
          } else {
            // Xem chi tiết phiếu XNK
            window.location.href = '/inventory/bill/detail?storeId=' + dataPost.info.storeId + '&id=' + rs.data.imexBillId;
          }
        } else {
          if (rs.data && rs.data.imexBillId && !$('#billCreated').length) {
            $('#msgErrors').prepend('<p id="billCreated"> Đã tạo phiếu XNK ID: <a target="_blank" href="/inventory/bill/detail?storeId=' + dataPost.info.storeId + '&id=' + rs.data.imexBillId + '">' + rs.data.imexBillId + '</a></p>');
          }
          $('#saveSupplierModal').removeClass('showed').modal('hide');
          $('html, body').animate({ scrollTop: 0 }, 1200);
        }

        return false;
      }

      // Tiếp tục post sản phẩm
      dataPost.products = products;
      saveSupplier(url, dataPost);
    }
  });
}

function showProcessBar(item, totalItem, options) {
  var showProgressbar = options.showProgressbar ? options.showProgressbar : '#showProgressbar';
  var progress = options.progress ? options.progress : '#progress';
  var percent = Math.ceil((item / totalItem) * 100);
  if (percent > 100) {
    percent = 100;
  }
  $(showProgressbar).css('width', percent + '%').html(percent + '%');
  $(progress).show();

  // Bật modal
  if (!$('#saveSupplierModal').hasClass('showed')) {
    $('#saveSupplierModal').addClass('showed');
    $('#saveSupplierModal').modal('show');
  }
}

function formatBatchModal() {
  $('#batchProductStoreId').val('');
  $('#batchName').val('');
  $('#batchManufactureDate').val('');
  $('#batchImportPrice').val('');
  $('#batchExpiredDate').val('');
}

$(function () {
  FormLayouts.init();
  AppBillImport.init();
});
