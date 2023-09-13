$(function () {
  'use strict';
  // TagInputs.init();
  Pnotify.init();
  AppData.init();
  AppProductAdd.init();
  AppProductAdd.optimizationSEO();
  loadStoreBranch();
  $('#storeId').change(function () {
    loadStoreBranch();
  });
  AppCommon.initCkeditor();

  /*upload image avatar*/
  AppBusinessUpload.init();
});
var AppProductAdd = {
  isSubmit: false,
  attributesData: {},
  init: function () {
    $('#imageUpload').uniform({
      fileButtonClass: 'action btn bg-info',
      fileDefaultHtml: 'Chọn file gif, png, jpg, bmp <= 4MB',
    });
    $('body').on('click', '.tagArea .removeTag', function (e) {
      $(this).parent().remove();
      return false;
    });

    // Gợi ý sản phẩm cha
    $('#parentIdName').autoComplete({
      resolver: 'custom',
      formatResult: function (item) {
        let textDisplay = '';
        textDisplay += '<div class="text-wrap w-100">' + item.label + '</div>';
        return {
          value: item.id,
          text: item.label,
          html: textDisplay
        };
      },
      minLength: 3,
      noResultsText: 'Không tìm thấy sản phẩm',
      events: {
        search: function (query, callback) {
          AppAjax.ajax({
            url: '/product/item/suggest',
            type: 'POST',
            dataType: 'JSON',
            data: {
              q: query,
              storeId: $('#storeId').val(),
              loadParent: 1,
              onlyParent: 1
            },
            success: function (rs) {
              callback(rs);
            }
          });
        }
      }
    }).keyup(function () {
      if (!$(this).val()) {
        $('#parentId').val('');
      }
    });
    $('#parentIdName').on('autocomplete.select', function (evt, item) {
      $('#parentId').val(item.id);
      $('#parentIdName').val(item.label);
    });
    //Gợi ý sản phẩm phẩm combo
    $('#comboProductArea').on('keyup', '.psComboName', function () {
      var item = $(this);
      $(this).autoComplete({
        resolver: 'custom',
        formatResult: function (item) {
          let textDisplay = '';
          textDisplay += '<div class="text-wrap w-100">' + item.label + '</div>';
          return {
            value: item.id,
            text: item.label,
            html: textDisplay
          };
        },
        minLength: 3,
        noResultsText: 'Không tìm thấy sản phẩm',
        events: {
          search: function (query, callback) {
            AppAjax.ajax({
              url: '/product/item/suggest',
              type: 'POST',
              dataType: 'JSON',
              data: {
                q: query,
                storeId: $('#storeId').val(),
              },
              success: function (rs) {
                callback(rs);
              }
            });
          }
        }
      });
      $(this).on('autocomplete.select', function (evt, item) {
        $(this).val(item.label);
        if (item.typeId == appConsts.product.types.TYPE_COMBO) {
          AppCommon.overLoading({
            display: 'hide'
          });
          AppModal.show({
            title: 'Lỗi',
            content: 'Bạn không được phép thêm sản phẩm combo khác',
          });
          return false;
        }
        $(this).closest('.comboItem').find('.psComboId').val(item.id).attr('data-typeid', item.typeId);
        return false;
      });
    });
    function imageIsLoaded(e) {
      var picture = '<img src="' + e.target.result + '"  width="60" height="60">';
      $(".imageArea").empty().append(picture);
    }

    //Bắt sự kiện thay đổi categoryId
    $('#categoryId').on('change', function () {
      AppProductAdd.loadAttributes($(this).val());
    });
    if ($('#categoryId').val()) {
      AppProductAdd.loadAttributes($('#categoryId').val());
    }
    $('.childProductsCardBody').on('select2:select', 'select.initSelect2', function () {
      AppProductAdd.combineChildProduct();
    }).on('select2:unselect', 'select.initSelect2', function () {
      AppProductAdd.combineChildProduct();
    });
    AppProductAdd.combineChildProduct();
    $('.table-attributes').on('click', '.removeChildProduct', function () {
      $(this).closest('tr').remove();
    });
    $('#btnSaveForm').on('click', function () {
      if (AppProductAdd.isValidForm($('form#productAddForm'))) {
        AppProductAdd.isSubmit = true;
        AppProductAdd.submit();
      }
    });

    //Thêm nhanh danh mục sản phẩm
    // @Todo: NVN chờ có form add thì thêm sự kiện refresh select category
    AppDataIframe.addStoreProductCategory('#fastAddCategoryId');

    //Thêm nhanh danh mục sản phẩm
    AppDataIframe.addSupplier('#fastAddSupplier');

    supplierSuggestHandler.load({
      storeId: '#storeId',
      tbSuggest: '#supplierName',
      emptyDataHandler: function () {
        $('#supplierId').val('');
      },
      selectHandler: function (item) {
        $("#supplierId").val(item.id);
        $("#supplierName").val(item.name);
      }
    });

    var typeId = $('#typeId').val();
    if (typeId) {
      if (typeId == appConsts.product.types.TYPE_MULTI_UNITS) {
        $('#multiUnitProductArea').removeClass('d-none');
      } else {
        $('#multiUnitProductArea').addClass('d-none');
      }
      if (typeId == appConsts.product.types.TYPE_COMBO) {
        $('#comboProductArea').removeClass('d-none');
      } else {
        $('#comboProductArea').addClass('d-none');
      }
    }

    $('#typeId').on('change', function () {
      if ($(this).val() == appConsts.product.types.TYPE_COMBO) {
        $('#comboProductArea').show();
      } else {
        $('#comboProductArea').hide();
      }
      if ($(this).val() == appConsts.product.types.TYPE_MULTI_UNITS) {
        $('#multiUnitProductArea').show();
        $('#unitProductArea').hide();
      } else {
        $('#multiUnitProductArea').hide();
        $('#unitProductArea').show();
      }
    });
    $('#comboProductArea .addComboProductBtn').on('click', function () {
      var row = $('#comboItemTemplate .comboItem').clone();
      $('#comboProductArea .showComboProductItem').append(row);
    });
    $('#comboProductArea').on('click', '.removeComboItem', function () {
      $(this).closest('.comboItem').remove();
    });
    $('#multiUnitProductArea .addUnitProductBtn').on('click', function () {
      var row = $('#multiUnitItemTemplate .unitItem').clone();
      $('#multiUnitProductArea .showUnitProductItem').append(row);
    });
    $('#multiUnitProductArea').on('click', '.removeUnitItem', function () {
      $(this).closest('.unitItem').remove();
    });

    // Suggest tag
    $('#tag-suggest').autoComplete({
      resolver: 'custom',
      formatResult: function (item) {
        let textDisplay = '';
        textDisplay += '<div class="text-wrap w-100">' + item.label + '</div>';
        return {
          value: item.id,
          text: item.label,
          html: textDisplay
        };
      },
      minLength: 3,
      noResultsText: 'Không tìm thấy tag',
      events: {
        search: function (query, callback) {
          AppAjax.ajax({
            url: '/product/item/loaddata',
            type: 'POST',
            dataType: 'JSON',
            data: {
              tab: 'tagsuggest',
              name: query,
              storeId: $('#storeId').val(),
            },
            success: function (rs) {
              callback(rs);
            }
          });
        }
      }
    }).keyup(function (e) {
      if (e.keyCode == 13 && $(this).val() != '') {
        $('.ui-helper-hidden-accessible').remove();
        var tagName = $(this).val();
        var tag = $('#tag-template').html();
        tag = tag.replace("{TAGNAME}", tagName);

        $('.tagArea').append(tag);
        $(this).val('');
      }
    });
    $('#tag-suggest').on('autocomplete.select', function (evt, item) {
      var tag = $('#tag-template').html();
      tag = tag.replace('{TAGNAME}', item.name);
      $('.tagArea').append(tag);
      $("#tag-suggest").val('');
    });

    var storeId = $('#storeId').val();
    $('#uploadContentImage').on('click', function () {
      window.open(
        '/media/manage/contentimage?type=Image&page=product&selectMultiple=1&contentId=content&storeId=' + storeId + '&id=' + productStoreId,
        '', "width=1000, height=500, top=50, left=50");
    });

    //Sản phẩm liên quan
    $('#related-product-name').autoComplete({
      resolver: 'custom',
      noResultsText: 'Không có sản phẩm',
      events: {
        search: function (query, callback) {
          AppAjax.post(
            '/product/item/suggest',
            {
              q: query,
              storeId: $('#storeId').val(),
              loadParent: 1,
              onlyParent: 1
            },
            function (rs) {
              callback(rs);
            }
          );
        }
      }
    });
    $('#related-product-name').on('keyup', function () {
      if (!$(this).val()) {
        $('#related-product-id').val('');
      }
    });
    $('#related-product-name').on('autocomplete.select', function (evt, item) {
      $('#related-product-id').val(item.id);
      $('#related-product-name').val(item.label);
    });

    // Thêm sản phẩm liên quan
    $('.addRelatedProduct').click(function (e) {
      e.preventDefault();
      var form = $(this).parent();
      var productStoreId = $('#id').val();
      var relatedProductStoreId = $('#related-product-id').val();
      if (!relatedProductStoreId) {
        alert('Sản phẩm không hợp lệ');
        return;
      }

      AppAjax.ajax({
        url: '/product/item/add?tab=addrelatedproduct',
        type: 'POST',
        dataType: 'JSON',
        data: { 'productStoreId': productStoreId, 'relatedProductStoreId': relatedProductStoreId, 'storeId': $('#storeId').val(), },
        success: function (rs) {
          if (rs.code == 1) {
            AppProductAdd.addRelatedProductTable(rs.data);
            $('#related-product-name').val('');
          } else {
            alert(rs.messages);
          }
        }
      });
    });

    // Thêm Video
    $('.addVideo').click(function (e) {
      e.preventDefault();
      var form = $(this).parent();
      var productStoreId = $('#id').val();
      var storeId = $('#storeId').val();
      var title = form.find('#titleVideo').val();
      var src = form.find('#linkVideo').val();
      if (!AppProductAdd.isValidUrl(src)) {
        alert('Link Youtube không hợp lệ');
        return;
      }

      AppAjax.ajax({
        url: '/product/item/add?tab=addvideo',
        type: 'POST',
        dataType: 'JSON',
        data: { 'productStoreId': productStoreId, 'storeId': storeId, 'title': title, 'src': src },
        success: function (rs) {

          if (rs.code == 1) {
            AppProductAdd.addVideoTable(rs.data);
            form.find('#titleVideo').val('');
            form.find('#linkVideo').val('');
            window.location.reload();
          } else {
            alert(rs.messages);
          }
        }
      });
    });
    $('#productAddForm').on('click', '.addQuickValueAttributesBtn', function () {
      var title = $(this).attr('data-title');
      var attributeId = $(this).attr('data-id');
      $('#addQuickAttrValueModal .variantName').text(title);
      $('#addQuickAttrValueModal #saveAddQuickAttrValueBtn').attr('data-id', attributeId);
      $('#addQuickAttrValueModal').modal('show');
    });
    $('#addQuickAttrValueModal #saveAddQuickAttrValueBtn').on('click', function () {
      var attributeId = $(this).attr('data-id');
      var value = $('#attributeValueTxt').val();
      var code = $('#attributeCodeTxt').val();
      var content = $('#attributeContentTxt').val();
      AppAjax.post('/product/variant/value?tab=addquickvalue', {
        'storeId': $('#storeId').val(),
        'attributeId': attributeId,
        'value': value,
        'code': code,
        'content': content
      }, function (rs) {
        if (rs.code == 0) {
          $('#addQuickAttrValueModal').modal('hide');
          AppModal.show({
            title: 'Lỗi',
            content: rs.messages.join('<br/>')
          });
        } else {
          $('#addQuickAttrValueModal').modal('hide');
          new PNotify({
            title: 'Thông báo',
            text: 'Thêm giá trị thành công',
            type: 'success'
          });
          var categoryId = $('#categoryId').val();
          AppProductAdd.loadAttributes(categoryId);
        }
      });
    });
  },
  isValidUrl: function (src) {
    var regexp = /((ftp|http|https):\/\/)?(www\.)?(youtube\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?/;
    return regexp.test(src);
  },
  addVideoTable: function (data) {
    var tbl = $('#tblVideos');
    if (tbl.length) {
      var tr = '<tr><td>' + data.id + '</td><td>' + data.title + '</td><td><a target="_blank" href="' + data.src + '">' + data.src + '</a></td><td class="text-center"><a title="Xóa" href="javascript:;" class="fa fa-times-circle deleteLinks" data-id="' + data.id + '"></a></td></tr>';
      tbl.find('tbody').append(tr);
    } else {
      var table = '<table class="table table-bordered" id="tblVideos">' +
        '<thead><tr><th>ID</th><th>Title</th><th>Src</th><th><i class="fal fa-cog"></i></th></tr></thead>' +
        '<tbody><tr><td>' + data.id + '</td><td>' + data.title + '</td><td><a href="' + data.src + '">' + data.src + '</a></td><td class="text-center"><a title="Xóa" href="javascript:;" class="fa fa-times-circle deleteLinks" data-id="' + data.id + '"></a></td></tr></tbody>' +
        '</table>';
      $('#tableVideos').html(table);
    }
  },
  addRelatedProductTable: function (data) {
    var tbl = $('#tblRelatedProducts');
    tbl.slideDown(300);
    if (tbl.length) {
      $.each(data, function (index, item) {
        var tr = '<tr>' +
          '<td class="d-none">' + item.suggestedProductStoreId + '</td>' +
          '<td><a href="' + item.viewLink + '" target="_blank">' + item.title + '</a></td>' +
          '<td class="text-center"><a title="Xóa" href="javascript:void(0);" class="fa fa-times-circle deleteLinks text-danger" data-id="' + item.id + '"></a></td>' +
          '</tr>';
        tbl.find('tbody').append(tr);
      });


    }
  },
  optimizationSEO: function () {
    $(document).on('click', '*[data-action="collapse-seo"]', function () {
      $('.group-seo').slideToggle('medium');
    });

    const titleSEO = $('.preview-seo-title');
    const keywordSEO = $('.preview-seo-keyword');
    const descSEO = $('.preview-seo-description');

    $('#metaTitle').on('keyup', function () {
      if ($(this).val()) {
        titleSEO.html($(this).val());
      } else {
        titleSEO.html('');
      }
    });
    $('#metaKeywords').on('keyup', function () {
      if ($(this).val()) {
        keywordSEO.html($(this).val());
      } else {
        keywordSEO.html('');
      }
    });
    $('#metaDescription').on('keyup', function () {
      if ($(this).val()) {
        descSEO.html($(this).val());
      } else {
        descSEO.html('');
      }
    });
  },
  loadAttributes: function (categoryId) {
    var storeId = $('#storeId').val();
    var attributes = $('#attributeCard');
    var attributeChilds = $('.childProductsCardBody');
    attributeChilds.find('.initSelect2').select2({
      placeholder: 'Chọn các giá trị',
    });
    AppAjax.post('/product/item/load?tab=attribute&addNew=1', { storeId: storeId, categoryId: categoryId, productId: productStoreId },
      function (response) {
        $('#attributeCardArea .card-body').show();
        attributes.html(response);
        AppForm.initSelectSearchBox('#attributeCard .form-control');
      }
    );
  },

  combineChildProduct: function () {
    var attrMap = {};
    $('.childProductsCardBody select.form-control').each(function () {
      var values = $(this).val(), column = $(this).attr('data-column');
      if (values && Array.isArray(values) && values.length) {
        var arr = [];
        values.forEach(function (value) {
          arr.push(AppProductAdd.attributesData[column]['values'][value]);
        });
        attrMap[column] = arr;
      }
    });

    $('.childProductsCardBody input').each(function () {
      if ($(this).val()) {
        var column = $(this).attr('data-column');
        attrMap[column] = [{
          'name': $(this).val(),
          'code': $(this).val(),
          'column': column,
          'value': $(this).val()
        }]
      }
    });
    var products = [];
    var totalProducts = 1;
    $.each(attrMap, function (key, value) {
      if (value != 0) {
        totalProducts *= value.length;
      }
    });

    for (var i = 0; i < totalProducts; i++) {
      products[i] = [];
    }

    var last_length = 1, step, attrIndex;
    $.each(attrMap, function (key, value) {
      step = totalProducts / (value.length * last_length);
      for (var i = 0; i < totalProducts; i++) {
        attrIndex = Math.floor(i / step) % value.length;
        products[i].push(value[attrIndex])
      }
      last_length *= value.length;
    });

    //        $('.attributeCombinatedTable .table-attributes tbody').html('');
    products.forEach(function (value) {
      if (value.length) {
        var template = $('#childProduct-template .childProduct').clone();
        template.data('combination', value);
        var label = [];
        var extend_code = [];
        var extend_name = [];

        value.forEach(function (v) {
          label.push(v['name']);
          extend_code.push(v['code']);
          extend_name.push(v['name']);
        });
        template.find('.childProduct-label').text(label.join(' - '));
        template.find('.extend_code').val('-' + extend_code.join('-'));
        template.find('.extend_name').val(' - ' + label.join(' - '));
        $('.attributeCombinatedTable .table-attributes tbody').append(template);
      }
    });
  },
  //Check form
  isValidForm: function (form) {
    var isValid = AppFuntions.isValidForm(form);
    return isValid;
  },
  //Post dữ liệu lên server
  submit: function () {
    var tags = [];
    $('.tagArea .tag').each(function () {
      var tag = $(this).find('span').text();
      if (tag) {
        tags.push(tag);
      }
    });
    if (tags.length) {
      $('#tags').val(tags.join(','));
    } else {
      $('#tags').val('');
    }

    // chia sp thuộc tính
    // duyệt các row ở bảng tổ hợp sp thuộc tính
    // lưu dữ liệu vào 1 hidden dưới dnagj json
    var attrsBreak = [];
    var hasInputQuantity = false;
    $('.table-attributes .childProduct').each(function () {
      if ($(this).find('.extend_quantity').val()) {
        hasInputQuantity = true;
      }
      var obj = {
        'attr': $(this).data('combination'),
        'extendCode': $(this).find('.extend_code').val(),
        'extendName': $(this).find('.extend_name').val(),
        'extendQuantity': $(this).find('.extend_quantity').val() ? parseInt($(this).find('.extend_quantity').val()) : 0
      };
      attrsBreak.push(obj);
    });
    if (attrsBreak.length) {
      $('#attributeCombinated').val(JSON.stringify(attrsBreak));
    } else {
      $('#attributeCombinated').val('');
    }
    if (hasInputQuantity && !$('#depotId').val()) {
      AppCommon.overLoading({
        display: 'hide'
      });
      AppModal.show({
        title: 'Lỗi',
        content: '<div class="alert alert-danger">Bạn chưa chọn cửa hàng</div>',
      });
      return false;
    }
    var typeId = $('#typeId').val() ? parseInt($('#typeId').val()) : 0;

    //Thêm sản phẩm combo
    var comboItems = [];
    var isValid = true;
    if (typeId == appConsts.product.types.TYPE_COMBO) {
      $('#comboProductArea .comboItem').each(function () {
        $(this).removeClass('error');
        var psComboId = $(this).find('.psComboId').val() ? parseInt($(this).find('.psComboId').val()) : '';
        var psComboTypeId = $(this).find('.psComboId').attr('data-typeid') ? parseInt($(this).find('.psComboId').attr('data-typeid')) : '';
        var qttCombo = $(this).find('.qttCombo').val() ? parseInt($(this).find('.qttCombo').val()) : '';
        if (!psComboId) {
          $(this).find('.psComboName').addClass('border border-danger');
          isValid = false;
        }
        if (!qttCombo) {
          $(this).find('.qttCombo').addClass('border border-danger');
          isValid = false;
        }
        if (psComboId && qttCombo) {
          var obj = {};
          obj.psComboId = psComboId;
          obj.psComboTypeId = psComboTypeId;
          obj.qttCombo = qttCombo;
          comboItems.push(obj);
        }
      });
      if (comboItems.length && typeId == appConsts.product.types.TYPE_COMBO) {
        $('#comboItems').val(JSON.stringify(comboItems));
      } else {
        $('#comboItems').val('');
      }
    }

    //Thêm sản phẩm nhiều đơn vị tính
    var multiUnitItems = [];
    $('#multiUnitProductArea .unitItem').each(function () {
      var unitName = $(this).find('.unitName').val();
      var unitQtt = $(this).find('.unitQtt').val() ? parseInt($(this).find('.unitQtt').val()) : '';
      var unitPrice = $(this).find('.unitPrice').val() ? parseInt($(this).find('.unitPrice').val()) : '';
      var unitWholesalePrice = $(this).find('.unitWholesalePrice').val() ? parseInt($(this).find('.unitWholesalePrice').val()) : '';
      var unitImportPrice = $(this).find('.unitImportPrice').val() ? parseInt($(this).find('.unitImportPrice').val()) : '';
      if (unitName && unitQtt) {
        var obj = {};
        obj.unitName = unitName;
        obj.unitQtt = unitQtt;
        obj.unitPrice = unitPrice;
        obj.unitWholesalePrice = unitWholesalePrice;
        obj.unitImportPrice = unitImportPrice;
        multiUnitItems.push(obj);
      }
    });
    if (multiUnitItems.length && typeId == appConsts.product.types.TYPE_MULTI_UNITS) {
      $('#multiUnitItems').val(JSON.stringify(multiUnitItems));
    } else {
      $('#multiUnitItems').val('');
    }

    // Sử dụng FormData để lưu dữ liệu form
    // cách này có thể lưu dc cả file
    var formData = new FormData($('form#productAddForm')[0]);
    if (typeof AppCommon.getDataCkEditor('description') === "object" && AppCommon.getDataCkEditor('description') !== null) {
      if (!AppCommon.getDataCkEditor('description').getData()) {
        $('#description').val('');
      }
    }
    if (typeof AppCommon.getDataCkEditor('content') === "object" && AppCommon.getDataCkEditor('content') !== null) {
      if (!AppCommon.getDataCkEditor('content').getData()) {
        $('#content').val('');
      }
    }
    if (typeof AppCommon.getDataCkEditor('promotionContent') === "object" && AppCommon.getDataCkEditor('promotionContent') !== null) {
      if (!AppCommon.getDataCkEditor('promotionContent').getData()) {
        $('#promotionContent').val('');
      }
    }
    if (!AppCommon.getDataCkEditor('warrantyContent').getData()) {
      $('#warrantyContent').val('');
    }

    let fields = $('#productAddForm').serializeArray(), isUseTagIds = false;
    $.each(fields, function (i, field) {
      if (field.name === 'tagIds[]') {
        isUseTagIds = true;
        // Bỏ qua tagIds[] vì trong new FormData đã lấy sẵn rồi nếu .set() sẽ bị sai chỉ lấy đc phần tử cuối
      } else {
        formData.set(field.name, field.value);
      }
    });
    if (!isUseTagIds) {
      // Không chọn nhãn nào thì cần set lại = array empty để loại bỏ được giá trị set trong populateValues form PHP
      formData.set('tagIds', []);
    }
    formData.set('showHome', $('#showHome').is(":checked") ? 1 : null);
    formData.set('showHot', $('#showHot').is(":checked") ? 1 : null);
    formData.set('showNew', $('#showNew').is(":checked") ? 1 : null);
    formData.set('replaceParentName', $('#replaceParentName').is(":checked") ? 1 : 0);
    formData.set('replaceParentCode', $('#replaceParentCode').is(":checked") ? 1 : 0);
    if ($('#imageUpload')[0].files.length) {
      formData.set('imageUpload', $('#imageUpload')[0].files[0]);
    }
    formData.set('storeId', $('#storeId').val());
    AppCommon.overLoading();
    AppAjax.ajax({
      url: '/product/item/edit',
      type: 'POST',
      data: formData,
      async: true,
      success: function (rs) {
        //trường hợp báo lỗi
        if (!rs.code) {
          AppCommon.overLoading({ display: 'hide' });
          AppProductAdd.showErrors(rs.errors);
        } else {
          //Tạm thời comment vì chưa check được tình huống tạo sản phẩm cha con
          /*window.parent.$("#productName").val(rs.productName);
          window.parent.$("#productId").val(rs.productId);*/
          window.location.href = rs.redirectUrl;
        }
      },
      cache: false,
      contentType: false,
      processData: false,
    });
  },
  showErrors: function (errors) {
    let errorMsgs = [];
    $.each(errors, function (elementName, message) {
      $('#' + elementName).closest('.form-group').find('.error').empty().append('<span class="validation-invalid-label">' + message + '</span>');
      $('#' + elementName).focus();
      errorMsgs.push(message);
    });
    AppModal.show({
      title: 'Lỗi',
      content: '<div class="alert alert-warning">' + errorMsgs.join('<br/>') + '</div>',
    });
  }
};

function loadStoreBranch() {
  var storeId = $('#storeId').val();
  if (storeId) {
    AppAjax.post('/store/branch/load',
      {
        storeId: storeId,
        productStoreId: productStoreId ? productStoreId : null
      },
      function (rs) {
        var html = '';
        html += '<div id="dgTableView" class="table-responsive">';
        html += '<table class="table table-md table-striped dataTable stickyHeader"><tbody>';
        html += '<thead class="dgTh"><tr class="text-center font-weight-semibold"><td>Chi nhánh</td><td>Giá bán</td><td>Giá buôn</td></tr></thead>';
        $.each(rs, function (k, v) {
          html += '<tr>';
          html += '<td>' + v.name + '</td>';
          html += '<td><input type="text" name="branchPrice' + v.id + '" id="branchPrice'
            + v.id + '" value="' + v.price + '" class="tb form-control text-right autoNumeric mr-2" placeholder="Giá lẻ" title="Giá bán lẻ"></td>';
          html += '<td><input type="text" name="branchWholesalePrice'
            + v.id + '" id="branchWholesalePrice' + v.id
            + '" value="' + v.wholesalePrice + '" class="tb form-control text-right autoNumeric" placeholder="Giá buôn" title="Giá bán buôn"></td>';
          html += '</tr>';
        });
        html += '</tbody></table></div>';
        $('#tab-branchs .contentBrachs').html(html);
        AppFuntions.initAutoNumeric('.contentBrachs .autoNumeric');
      }
    );
  }
}
