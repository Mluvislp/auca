/*jshint scripturl:true*/
$(function () {
  'use strict';
  FormLayouts.init();
  $('#imageUpload').uniform({
    fileButtonClass: 'action btn bg-info',
    fileDefaultHtml: 'Chọn file gif, png, jpg, bmp <= 4MB',
  });
  Pnotify.init();
  AppProductAdd.init();
  AppCommon.initCkeditor();
  AppProductAdd.optimizationSEO();

  /*upload image avatar*/
  AppBusinessUpload.init();
});
var AppProductAdd = {
  isSubmit: false,
  init: function () {
    // Lấy danh sách kho và dữ liệu liên quan
    storeSuggestHandler.storeLoadRelatedData({});
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
              var item = rs[0];
              if (rs.length == 1) {
                $('#parentId').val(item.id);
                $('#parentIdName').val(item.label);
              } else {
                callback(rs);
              }
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


    $('#btnSaveForm').on('click', function () {
      if (AppProductAdd.isValidForm($('form#productAddForm'))) {
        AppProductAdd.isSubmit = true;
        AppProductAdd.submit();
      }
    });

    $('.tagArea').on('click', '.removeTag', function () {
      $(this).closest('.tag').remove();
    });

    //Thêm nhanh danh mục sản phẩm
    AppDataIframe.addStoreProductCategory('#fastAddCategoryId', { elements: '#categoryId' });

    //Thêm nhanh thương hiệu
    AppDataIframe.addStoreProductBrand('#fastAddBrandId', { elements: '#brandId' });

    // Thêm nhanh danh mục sản phẩm
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
    // upload ảnh bài viết
    // đơn giản là mở ra 1 cửa sổ mới
    $('#uploadContentImage').click(function () {
      window.open(
        '/media/manage/contentimage?type=Image&page=product&selectMultiple=1&contentId=content&id=',
        '', "width=1000, height=500, top=50, left=50");
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
      AppFuntions.initAutoNumeric('.autoNumeric');
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

    $('#addNewUnitsBtn').on('click', function () {
      var typeId = $('#typeId').val();
      if (!typeId || typeId != appConsts.product.types.TYPE_MULTI_UNITS) {
        AppCommon.overLoading({
          display: 'hide'
        });
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: 'Chức năng này dùng cho loại sản phẩm nhiều đơn vị tính, vui lòng chọn lại <b>Loại sản phẩm</b>',
          closeHandler: function () {
            $('#typeId').focus();
          }
        });
        return false;
      }
      $('#multiUnitProductArea').removeClass('d-none');
      $(this).addClass('d-none');
    });
    $('#addNewComboBtn').on('click', function () {
      var typeId = $('#typeId').val();
      if (!typeId || typeId != appConsts.product.types.TYPE_COMBO) {
        AppCommon.overLoading({
          display: 'hide'
        });
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: 'Chức năng này dùng cho loại sản phẩm combo, vui lòng chọn lại <b>Loại sản phẩm</b>',
          closeHandler: function () {
            $('#typeId').focus();
          }
        });
        return false;
      }
      $('#comboProductArea').removeClass('d-none');
      $(this).addClass('d-none');
    });
    $('#showUnitIntroBtn').on('click', function () {
      $('#introUnitModel').modal('show');
    });
    $('#showComboIntroBtn').on('click', function () {
      $('#introComboModel').modal('show');
    });
    $('#typeId').on('change', function () {
      var typeId = $(this).val();
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
    });

    //Sản phẩm liên quan
    $('#related-product-name').autoComplete({
      resolver: 'custom',
      noResultsText: 'Không có sản phẩm',
      events: {
        search: function (query, callback) {
          AppAjax.post('/product/item/suggest',
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
    $('#boxInfoRelatedProduct .addRelatedProduct').on('click', function () {
      AppProductAdd.addProductRelatedItems();
    });
    $('#boxInfoRelatedProduct').on('click', '.removeProductRelatedItem', function () {
      $(this).closest('tr').remove();
    });

    //Video giới thiệu sản phẩm
    $('#frmAddVideo .addVideo').on('click', function () {
      AppProductAdd.addVideos();
    });
    $('#tblVideos').on('click', '.deleteLinks', function () {
      $(this).closest('tr').remove();
    });
  },

  addProductRelatedItems: function () {
    var productId = $('#related-product-id').val();
    var productName = $('#related-product-name').val();
    const storeId = $('#storeId').val();
    if (!productId) {
      return false;
    }
    if ($('#boxInfoRelatedProduct tbody tr[data-id="' + productId + '"]').length) {
      return false;
    }
    const viewLink = productId && storeId ? `/product/item/detail?id=${productId}&storeId=${storeId}` : 'javascript:void(0)';

    $('#tblRelatedProducts').show();
    var row = `<tr class="relatedProductItem relatedProductItem_${productId}" data-id="${productId}">`;
    row += `<td class="d-none">${productId}</td>`;
    row += `<td><a href="${viewLink}">${productName}</a></td>`;
    row += '<td class="text-center"><a title="Xóa" href="javascript:void(0);" class="fa fa-times-circle removeProductRelatedItem text-danger"></a></td>';
    row += '</tr>';
    $('#tblRelatedProducts').append(row);
    $('#related-product-name').val('');
    $('#related-product-id').val('');
  },
  addVideos: function () {
    var titleVideo = $('#titleVideo').val();
    var linkVideo = $('#linkVideo').val();
    if (!titleVideo || !linkVideo) {
      AppCommon.overLoading({
        display: 'hide'
      });
      AppModal.show({
        title: 'Lỗi',
        content: 'Cần nhập tiêu đề và link video',
      });
      return false;
    }
    if (!AppProductAdd.isValidUrlVideos(linkVideo)) {
      AppCommon.overLoading({
        display: 'hide'
      });
      AppModal.show({
        title: 'Lỗi',
        content: 'Link Youtube không hợp lệ',
      });
      return false;
    }
    $('#tblVideos').show();
    var row = '<tr class="videoItem" data-id="">';
    row += '<td></td>';
    row += '<td class="titleVideoItem">' + titleVideo + '</td>';
    row += '<td><a class="linkVideoItem" target="_blank" href="' + linkVideo + '">' + linkVideo + '</a></td>';
    row += '<td class="text-center"><a title="Xóa" href="javascript:;" class="fal fa-trash deleteLinks text-danger"></a></td>';
    row += '</tr>';
    $('#tblVideos').append(row);
  },
  isValidUrlVideos: function (s) {
    var regexp = /((ftp|http|https):\/\/)?(www\.)?(youtube\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?/;
    return regexp.test(s);
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
  //Check form
  isValidForm: function (form) {
    var isValid = AppFuntions.isValidForm(form);
    return isValid;
  },
  //Post dữ liệu lên server
  submit: function () {
    AppCommon.overLoading();
    $('.attributeCombinatedTable .alert').remove();
    $('body .childProduct .border-danger').removeClass('border-danger');
    $('#depotId').siblings('.error').html('');

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
      const t = $(this), renderImg = t.find('.extRenderImg a');
      if (t.find('.extendQuantity').val()) {
        hasInputQuantity = true;
      }
      const obj = {
        'attr': t.data('combination'),
        'extendIndex': t.attr('data-index'),
        'extendName': t.find('.extendName').val(),
        'extendCode': t.find('.extendCode').val(),
        'extendBarcode': t.find('.extendBarcode').val() ? t.find('.extendBarcode').val() : '',
        'extendPriceImport': t.find('.extendPriceImport').val(),
        'extendPrice': t.find('.extendPrice').val(),
        'extendQuantity': t.find('.extendQuantity').val(),
        'extendShippingWeight': t.find('.extendShippingWeight').val() ? parseFloat(t.find('.extendShippingWeight').val()) : '',
        'extendLength': t.find('.extendLength').val() ? parseFloat(t.find('.extendLength').val()) : '',
        'extendWidth': t.find('.extendWidth').val() ? parseFloat(t.find('.extendWidth').val()) : '',
        'extendHeight': t.find('.extendHeight').val() ? parseFloat(t.find('.extendHeight').val()) : '',
        'extendStatus': t.find('.extendStatus').val() ? t.find('.extendStatus').val() : null,
        'extendImage': '',
      };
      if (AutoNumeric.isManagedByAutoNumeric(t.find('.extendPriceImport').get(0))) {
        obj.extendPriceImport = AutoNumeric.getNumber(t.find('.extendPriceImport').get(0));
      }
      if (AutoNumeric.isManagedByAutoNumeric(t.find('.extendPrice').get(0))) {
        obj.extendPrice = AutoNumeric.getNumber(t.find('.extendPrice').get(0));
      }
      if (AutoNumeric.isManagedByAutoNumeric(t.find('.extendQuantity').get(0))) {
        obj.extendQuantity = AutoNumeric.getNumber(t.find('.extendQuantity').get(0));
      }
      if (renderImg.length && renderImg.attr('data-fileName')) {
        obj.extendImage = renderImg.attr('data-fileName');
      }
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
      $('#depotId').focus().select().siblings('.error').html('<span class="validation-invalid-label">Bạn chưa chọn cửa hàng</span>');
      const cardFirst = $('#cardFirstRemain');
      cardFirst.removeClass('.card-collapsed');
      cardFirst.find('.list-icons-item').removeClass('rotate-180');
      cardFirst.find('.card-body').show();
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
        var qttCombo = $(this).find('.qttCombo').val() ? parseFloat($(this).find('.qttCombo').val()) : '';
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
      var productId = $(this).attr('data-id');
      var unitName = $(this).find('.unitName').val();
      var unitQtt = $(this).find('.unitQtt').val() ? parseInt($(this).find('.unitQtt').val()) : '';
      var unitPrice = $(this).find('.unitPrice').val() ? AutoNumeric.getNumber($(this).find('.unitPrice').get(0)) : '';
      var unitWholesalePrice = $(this).find('.unitWholesalePrice').val() ? AutoNumeric.getNumber($(this).find('.unitWholesalePrice').get(0)) : '';
      var unitImportPrice = $(this).find('.unitImportPrice').val() ? AutoNumeric.getNumber($(this).find('.unitImportPrice').get(0)) : '';
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

    //check Sản phẩm liên quan
    var productRelatedIds = [];
    $('#tblRelatedProducts .relatedProductItem').each(function () {
      var productRelatedId = $(this).attr('data-id');
      if (productRelatedId) {
        productRelatedIds.push(productRelatedId);
      }
    });
    $('#productRelatedIds').val(JSON.stringify(productRelatedIds));

    //Link videos
    var linkVideos = [];
    $('#tableVideos .videoItem').each(function () {
      var titleVideo = $(this).find('.titleVideoItem').text();
      var linkVideo = $(this).find('.linkVideoItem').text();
      var obj = {};
      obj.title = titleVideo;
      obj.link = linkVideo;
      linkVideos.push(obj);
    });
    $('#linkVideos').val(JSON.stringify(linkVideos));
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
    var fields = $('#productAddForm').serializeArray();
    $.each(fields, function (i, field) {
      if (field.name === 'tagIds[]') {
        // Bỏ qua tagIds[] vì trong new FormData đã lấy sẵn rồi nếu .set() sẽ bị sai chỉ lấy đc phần tử cuối
      } else {
        formData.set(field.name, field.value);
      }
    });
    if ($('#imageUpload')[0].files.length) {
      formData.set('imageUpload', $('#imageUpload')[0].files[0]);
    }

    AppAjax.ajax({
      url: '/product/item/add',
      type: 'POST',
      data: formData,
      async: true,
      success: function (rs) {
        //trường hợp báo lỗi
        if (!rs.code) {
          AppCommon.overLoading({ display: 'hide' });
          if (typeof rs.errorsAttributeDuplicate != "undefined") {
            let html = '', parent = $('body .attributeCombinatedTable'), duplicate = rs.errorsAttributeDuplicate;
            if (typeof duplicate.name != "undefined" && (duplicate.name.length || Object.keys(duplicate.name).length)) {
              $.each(duplicate.name, (k, i) => {
                parent.find(`.childProduct[data-index="${i}"] .extendName`).addClass('border-danger');
              });
              html += `<p class="mb-0">Tên mở rộng đã được sử dụng</p>`;
            }
            if (typeof duplicate.code != "undefined" && (duplicate.code.length || Object.keys(duplicate.code).length)) {
              $.each(duplicate.code, (k, i) => {
                parent.find(`.childProduct[data-index="${i}"] .extendCode`).addClass('border-danger');
              });
              html += `<p class="mb-0">Mã mở rộng đã được sử dụng</p>`;
            }
            if (typeof duplicate.barcode != "undefined" && (duplicate.barcode.length || Object.keys(duplicate.barcode).length)) {
              $.each(duplicate.barcode, (k, i) => {
                parent.find(`.childProduct[data-index="${i}"] .extendBarcode`).addClass('border-danger');
              });
              html += `<p class="mb-0">Mã vạch sản phẩm con đã được sử dụng</p>`;
            }
            parent.append(`<div class="alert alert-warning mb-0 mt-3">${html}</div>`);
          } else {
            AppProductAdd.showErrors(rs.errors);
          }
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
