$(function () {
  AppAttributeProduct.init();
  AppProductDetail.init();
});

/**
* Function xử lý thuộc tính
* - Thêm thuộc tính sản phẩm "CHA | ĐỘC LẬP"
* - Tạo sản phẩm con từ thuộc tính
* */
var AppAttributeProduct = {
  // Type hiển thị thuộc tính
  TYPE_SELECT: 1, TYPE_CHECKBOX: 2, TYPE_NUMBER: 3, TYPE_TEXT: 5,
  attributesData: {},
  attrsValues: {}, // Biến chỉ lưu values attrs
  cacheChildsList: {}, // Mảng lưu thông tin sản phẩm thuộc tính đã tạo
  isSubmit: false,
  init() {
    this.displayColumnHandler();

    $('#attributeCardArea .nav-item').on('click', function () {
      $('#attributeCardArea .card-body').show();
    });
    $('.attributeCombinatedTable .copyQttAllBtn').on('click', e => {
      e.preventDefault();
      const valueAll = $('.attributeCombinatedTable .qttAll').val();
      $('.attributeCombinatedTable .extendQuantity').each(function () {
        AutoNumeric.set($(this).get(0), valueAll);
      });
      this.calculateQtt();
    });

    //Nhấn nút thêm thuộc tính sản phẩm
    $('#addNewAttributesBtn').on('click', function () {
      var categoryId = $('#categoryId').val();
      if (!categoryId) {
        AppCommon.overLoading({
          display: 'hide'
        });
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: 'Vui lòng chọn danh mục trước khi thêm thuộc tính sản phẩm',
          closeHandler: function () {
            $('#categoryId').focus();
          }
        });
        return false;
      }
      AppAttributeProduct.loadAttributes(categoryId);
    });

    //Bắt sự kiện thay đổi categoryId
    $('#categoryId').on('change', function () {
      $('.childProductsCardBody .table-attributes tbody').html('');
      $('.attributeCombinatedTable .table-attributes tbody').html('');

      AppAttributeProduct.loadChilAttributes($(this).val());
      AppAttributeProduct.loadAttributes($(this).val());
    });

    $('.childProductsCardBody')
      .on('select2:select', 'select.initSelect2', () => this.combineChildProduct())
      .on('select2:unselect', 'select.initSelect2', () => this.combineChildProduct());

    // Tìm kiếm thuộc tính trong dropdown
    $(document).on('keyup', '.rowItemAttr .has-search input', function () {
      let t = $(this), key = t.val() ? t.val().toLowerCase() : '',
        items = t.parents('.dropdown-menu').find('.find-item');

      if (!key) {
        items.show();
        return false;
      }
      items.each(function () {
        if ($(this).text().toLowerCase().includes(key)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });

    // Bấm chọn thuộc tính
    $(document).on('click', '.rowItemAttr .find-item', e => {
      let t = $(e.currentTarget), id = t.attr('data-id'), column = t.attr('data-column'),
        parent = t.parents('.rowItemAttr');

      /**
       * Kiểm tra thuộc tính đã được chọn chưa
       * - Nếu đã tồn tại thì reset trả về group rỗng mới
       * */
      if (id && $(`.childProductsCardBody .rowItemAttr[data-id="${id}"]`).length && $(`.childProductsCardBody .rowItemAttr`).length > 1) {
        PNotify.removeAll();
        new PNotify({
          text: `Thuộc tính <span class="font-weight-semibold">${t.text()}</span> đã được chọn, vui lòng chọn thuộc tính khác.`,
          addclass: 'alert alert-warning alert-styled-right',
        });

        // reset dữ liệu rowItemAttr
        parent.attr('data-id', '').attr('data-column', '');
        parent.find('.d-flex-child').removeAttr('data-select2-id');
        parent.find('.dropdown-toggle').text('Chọn thuộc tính');
        parent.find('.find-item').removeClass('active');

        parent.find('select').empty();
        if (parent.find('select').data('select2')) {
          parent.find('select').select2('destroy');
        }
        parent.find('select')
          .attr('id', '')
          .attr('name', '')
          .attr('data-id', '')
          .attr('data-column', '')
          .removeAttr("multiple")
          .removeAttr("tabindex")
          .removeAttr("aria-hidden")
          .removeAttr("data-select2-id")
          .removeClass("select-has-search-box initSelect2 select2-hidden-accessible");

        parent.find('.addQuickValueAttributesBtn')
          .attr('data-column', '')
          .attr('data-id', '')
          .attr('title', '');

        parent.find('.select2.select2-container').remove();
      } else {
        $('.rowItemAttr .find-item').not(t).removeClass('active');
        t.addClass('active');
        parent.attr('data-id', id);
        parent.attr('data-column', column);
        parent.find('.dropdown-toggle').html(t.text());
        parent.find('.addQuickValueAttributesBtn')
          .attr('title', t.text())
          .attr('data-id', id)
          .attr('data-column', column);

        if (typeof AppAttributeProduct.attributesData[column] != "undefined") {
          const attr = AppAttributeProduct.attributesData[column];
          const select = parent.find('select.attrSe');
          select.addClass('select-has-search-box initSelect2');
          select.attr('multiple', 'multiple');
          select.attr('data-column', column);
          select.attr('data-id', id);
          select.attr('name', `attrBreak-${column}`);
          select.attr('id', `attrBreak-${column}`);
          AppAttributeProduct.genSelectAttrValue(select, attr.values);
        }
      }
    });

    // Thay đổi sắp xếp thuộc tính
    $(document).on('change', '.rowItemAttr .order-attr', e => {
      e.preventDefault();
      let val = parseInt($(e.currentTarget).val());
      if (!val || val < 0 || typeof val == "undefined") {
        val = 0;
      }
      $(e.currentTarget).val(val);
      $(e.currentTarget).parents('.rowItemAttr').attr('data-order', val);
      this.changeSortedAtrr();
    });

    // Xóa thuộc tính
    $(document).on('click', '.rowItemAttr .remove-attr', e => {
      let iptVals = $(e.currentTarget).parents('.rowItemAttr').find('select.form-control').val();
      if (iptVals && $(`.attributeCombinatedTable .childProduct`).length) {
        $.each(iptVals, function (k, id) {
          let child = $(`.attributeCombinatedTable .childProduct[data-index*="${id}"]`);
          if (child.length) {
            if (typeof AppAttributeProduct.cacheChildsList[child.attr('data-index')]) {
              delete AppAttributeProduct.cacheChildsList[child.attr('data-index')];
            }
            child.remove();
          }
        });
      }
      $(e.currentTarget).parents('.rowItemAttr').remove();
      this.combineChildProduct();
    });

    // Thêm dòng thuộc tính
    $(document).on('click', '#plusRowAttr', e => {
      this.addRowItemAttr();
    });

    // Xóa 1 dòng sản phẩm con
    $(document).on('click', '.table-attributes .removeChildProduct', e => {
      this.removeChildItem($(e.currentTarget).closest('.childProduct').attr('data-index'));
      this.calculateQtt();
    });

    $(document).on('click', '.addQuickValueAttributesBtn', function () {
      let title = $(this).attr('title');
      let attributeId = $(this).attr('data-id');
      let column = $(this).attr('data-column');
      AppModal.show({
        modalId: 'addQuickAttrValueModal',
        size: 'modal-md',
        title: `Thêm giá trị cho thuộc tính <b class="text-success variantName">${title}</b>`,
        content: `<div class="form-group"><input type="text" id="attributeValueTxt" placeholder="Tên (bắt buộc)" class="form-control" /></div>
                        <div class="form-group"><input type="text" id="attributeCodeTxt" placeholder="Code" class="form-control" /></div>
                        <div class="form-group"><input type="text" id="attributeContentTxt" placeholder="Giá trị" class="form-control" /></div>`,
        buttons: [`<button class="btn btn-success" type="button" id="saveAddQuickAttrValueBtn"
                      data-id="${attributeId}" data-column="${column}"><i class="fal fa-save mr-1"></i> Lưu</button>`, "<button type='button' class='btn btn-light' data-dismiss='modal'>Đóng</button>"]
      });
    });
    $(document).on('click', '#addQuickAttrValueModal #saveAddQuickAttrValueBtn', function () {
      let data = {}, column = $(this).attr('data-column');
      data.tab = 'addquickvalue';
      data.storeId = $('#storeId').val();
      data.attributeId = $(this).attr('data-id');
      data.value = $('#attributeValueTxt').val();
      data.code = $('#attributeCodeTxt').val();
      data.content = $('#attributeContentTxt').val();

      AppAjax.post('/product/variant/value', data, function (rs) {
        if (rs.code == 0) {
          $('#addQuickAttrValueModal').modal('hide');
          AppModal.show({
            title: 'Lỗi', content: rs.messages.join('<br/>')
          });
        } else {
          $('#addQuickAttrValueModal').modal('hide');
          new PNotify({
            title: 'Thông báo', text: 'Thêm giá trị thành công', type: 'success'
          });
          const categoryId = $('#categoryId').val();
          const select = $('body #attrBreak-' + column);
          AppAttributeProduct.loadAttributes(categoryId);
          // AppAttributeProduct.loadChilAttributes(categoryId);
          let values = AppAttributeProduct.attributesData[column].values;
          if (!values.length) {
            values = [];
          }
          values.push(rs.data);
          AppAttributeProduct.attributesData[column].values = values;
          AppAttributeProduct.attrsValues[rs.data.id] = rs.data;

          AppAttributeProduct.genSelectAttrValue(select, values);
        }
      });
    });
    $(document).on('change', '.table-attributes .extendQuantity', function () {
      AppAttributeProduct.calculateQtt();
    });

    this.addQuickAttribute();
    this.handlerUploadImageTemp();
  },
  handlerUploadImageTemp() {
    // Xóa ảnh avatar
    $(document).on('click', '.extRenderImg .fa-minus-circle', function () {
      const parent = $(this).parents('.tdExtendImg'), nameImage = $(this).siblings('a').attr('data-filename'),
        formData = {
          storeId: $('#storeId').val(),
          name: nameImage,
          type: appConsts.media.businessFileTypes.TYPE_IMG_PRODUCT_AVATAR,
        };

      AppModal.show({
        modalId: 'confirmDelImg',
        title: 'Xóa ảnh',
        content: 'Bạn có muốn xóa ảnh này không?',
        buttons: [`<button type="button" class="btn btn-danger" id="minus-image" data-id="${nameImage}"><i class="fal fa-check mr-1"></i> Có</button>`, '<button type="button" class="btn btn-light" data-dismiss="modal"><i class="fal fa-times mr-1"></i> Không</button>']
      });

      // Xác nhận xóa ảnh
      $(document).on('click', '#minus-image', function () {
        AppModal.hide('#confirmDelImg');
        AppAjax.post('/media/upload/deleteimage', formData, rs => {
          if (!rs.code) {
            new PNotify({
              text: rs.messages, type: 'error'
            });
            return false;
          }
          parent.find('.extRenderImg').empty();
          parent.find('.extAddImage').show();
        });
      });
    });

    // Xóa ảnh modal view ảnh
    $(document).on('click', '.full-screen-img', function () {
      const t = $(this), parent = t.parents('.tdExtendImg'), imgSrc = t.attr('data-src'),
        imgName = t.attr('data-filename');
      AppModal.show({
        color: 'd-none',
        bodyClass: 'text-center p-2',
        modalId: 'fullScreenImage',
        title: 'Xóa ảnh',
        content: `<img src="${imgSrc}" alt="image">`,
        buttons: [`<button type="button" class="btn btn-warning" id="del-full-image" data-name="${imgName}"><i class="fal fa-times mr-1"></i>Xóa ảnh</button>`, '<button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>']
      });

      // Hỏi xác nhận xóa ảnh
      $(document).on('click', '#del-full-image', function () {
        const t = $(this), formData = {
          storeId: $('#storeId').val(),
          name: t.attr('data-name'),
          type: appConsts.media.businessFileTypes.TYPE_IMG_PRODUCT_AVATAR,
        };
        AppModal.show({
          modalId: 'confirmDelImg',
          title: 'Xóa ảnh',
          content: 'Bạn có muốn xóa ảnh này không?',
          buttons: [`<button type="button" class="btn btn-danger" id="del-full-image-accept"><i class="fal fa-check mr-1"></i> Có</button>`, '<button type="button" class="btn btn-light" data-dismiss="modal"><i class="fal fa-times mr-1"></i> Không</button>']
        });

        // // Xác nhận xóa ảnh
        $(document).on('click', '#del-full-image-accept', function () {
          AppModal.hide('#confirmDelImg');
          AppModal.hide('#fullScreenImage');
          AppAjax.post('/media/upload/deleteimage', formData, rs => {
            if (!rs.code) {
              new PNotify({
                text: rs.messages, type: 'error'
              });
              return false;
            }
            parent.find('.extRenderImg').empty();
            parent.find('.extAddImage').show();
          });
        });
      });
    });

    // Click để chọn ảnh
    $(document).on('click', '.extAddImage', e => {
      $(e.currentTarget).siblings('.extFileInput').click();
    });

    // Ảnh được chọn
    $(document).on('change', '.extFileInput', function (event) {
      var fileImage = event.target.files[0];
      PNotify.removeAll();

      let t = $(this), tdImg = t.parents('.tdExtendImg'), selector = tdImg.find('.extRenderImg'),
        extPlusImage = tdImg.find('.extAddImage'), indexType = (t.val().split('.').pop()).toLowerCase(),
        extensions = ['jpg', 'jpeg', 'gif', 'png', 'webp'], file = this.files[0], formData = new FormData();

      tdImg.find('.fa-spinner').remove();
      if (extensions.indexOf(indexType) === -1) {
        new PNotify({
          text: `Chỉ hỗ trợ các định dạng file: <span class="font-weight-semibold">${extensions.join(', ')}</span>`, // type: !rs.code ? 'error' : 'success'
        });
        return false;
      }
      if (!AppFuntions.validFileSize(t, this)) {
        return false;
      }

      extPlusImage.hide();
      tdImg.append('<i class="fa fa-spinner fa-spin"></i>');

      formData.append("upload", file);
      var options = {
        maxSizeMB: 1, //fix max size
        maxWidthOrHeight: 2048, //fix max width image
        useWebWorker: true,
        maxIteration: 3,
      };
      imageCompression(fileImage, options)
        .then(function (output) {
          var file_Type = output.type.split('/').pop().toLowerCase(); // compressedFile.type = image/png. With this code I only get the last "png".
          var fileData = new FormData();
          fileData.append('name', output.name);
          fileData.append('file_root', fileImage);
          fileData.append('input_val', "image");
          fileData.append('file', output);
          fileData.append('file_type', file_Type);
          AppAjax.ajax({
            url: `/media/upload/business?type=${appConsts.media.businessFileTypes.TYPE_IMG_PRODUCT_AVATAR}&storeId=${$('#storeId').val()}`,
            type: "POST",
            data: fileData,
            success: rs => {
              tdImg.find('.fa-spinner').remove();
              if (!rs.code) {
                extPlusImage.show();
                new PNotify({
                  text: rs.messages, type: 'error'
                });
                return false;
              }

              extPlusImage.hide();
              const reader = new FileReader();
              reader.onload = e => {
                selector.html(`<a href="javascript:void(0)" class="full-screen-img" data-src="${rs.data.url}"  
                                          data-fileName="${rs.data.name}"  data-title="Ảnh đại điện SP">
                                          <img src="${e.target.result}" alt="Ảnh đại điện SP">
                                      </a>
                                      <i class="fa fa-minus-circle text-danger position-absolute cursor-pointer"></i>`);
              };
              reader.readAsDataURL(file);
            },
            cache: false,
            contentType: false,
            processData: false,
          });
        })
        .catch(function (error) {
          alert(error.message);
        });
    });
  },
  calculateQtt: function () {
    let totalQtt = 0;
    $('.attributeCombinatedTable .extendQuantity').each(function () {
      if ($(this).val()) {
        totalQtt += parseInt($(this).val() ? AutoNumeric.getNumber($(this).get(0)) : 0);
      }
    });
    $('#totalQttAttribute').empty().html('(<b>' + totalQtt + '</b>)');
  },
  /**
   * Load danh sách giá trị của thuộc tính
   * */
  genSelectAttrValue(element = null, values = []) {
    if (!element) {
      return false;
    }

    // Có giá trị thuộc tính thì mới khởi tạo
    if (values) {
      values.sort((a, b) => a.order - b.order);
      const val = element.val();
      element.html('');
      $.each(values, function (k, val) {
        element.append(`<option value="${val.id}">${val.name}</option>`);
      });
      element.val(val);
      element.attr('multiple', 'multiple');
      element.select2();
    }
  },
  /**
   * Thêm nhanh thuộc tính sản phẩm
   * - Thêm thành công thì
   * */
  addQuickAttribute() {
    $(document).on('click', '.addQuickAttr', function () {
      let html = `<div class="form-group row">
                          <label class="col-3 control-label" for="modal_categories">Danh mục:</label>
                          <div class="col-9">
                              <select id="modal_categories" class="form-control select-multipleCheckbox select-has-search-box notCheckAll"
                               style="width: 100%;" multiple="multiple">
                                  <option value="">Chọn danh mục</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-3 control-label" for="modal_name">
                              Tên thuộc tính: <span class="text-danger">*</span>
                          </label>
                          <div class="col-9">
                              <input type="text" id="modal_name" class="form-control">
                              <div class="error"></div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-3 control-label" for="modal_variable">
                              Mã thuộc tính:
                              <span class="text-danger">*</span>
                          </label>
                          <div class="col-9">
                              <input type="text" id="modal_variable" class="form-control" placeholder="VD: color, size,...">
                              <div class="error"></div>
                              <small class="mt-2 d-block">Mã thuộc tính phải ở dạng viết liền không dấu</small>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-3 control-label" for="modal_type">Kiểu dữ liệu:</label>
                          <div class="col-9">
                              <select id="modal_type" class="form-control">
                                  <option value="1">Select</option>
                                  <option value="5">Text</option>
                                  <option value="2">Checkbox</option>
                                  <option value="3">Number</option>
                              </select >
                          </div>
                      </div>`;

      AppModal.show({
        modalId: 'addQuickAttrModal',
        title: 'Tạo thuộc tính mới',
        content: html,
        buttons: ['<button class="btn btn-success" type="button" id="saveAddQuickAttr" data-id=""><i class="fal fa-save mr-1"></i> Lưu</button>', '<button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>']
      });
      categorySuggestHandler.load({
        element: 'body #modal_categories',
        noDefaultOption: true,
        multiselect: true,
        addOptionsCategoryId: true,
        storeId: $('#storeId').val(),
      });
    });
    $(document).on('keyup', '#modal_variable', e => {
      const t = $(e.currentTarget), err = t.siblings('.error');

      if (!t.val()) {
        t.addClass('border-danger');
        err.html('<span class="validation-invalid-label">Mã thuộc tính không được để trống.</span>');
        return false;
      }
      if (t.val().length > 3 && !this.isValidVietnameseAndSpace(t.val())) {
        t.addClass('border-danger');
        err.html('<span class="validation-invalid-label">Mã thuộc tính phải ở dạng viết liền không dấu.</span>');
        return false;
      }
      t.removeClass('border-danger');
      err.html('');
    });

    // Thêm thuộc tính mới
    $(document).on('click', '#saveAddQuickAttr', () => {
      let data = {}, modal = $('body #addQuickAttrModal'), storeId = $('#storeId').val(),
        name = modal.find('#modal_name'), variable = modal.find('#modal_variable');

      modal.find('.border-danger').removeClass('border-danger');
      PNotify.removeAll();
      if (!storeId.length) {
        new PNotify({
          text: appTranslator.messages.common.noSelectStore, type: 'danger'
        });
        return false;
      }
      if (!name.val()) {
        name.addClass('border-danger');
        name.siblings('.error').html('<span class="validation-invalid-label">Tên thuộc tính không được để trống.</span>');
        return false;
      }
      if (!variable.val()) {
        variable.addClass('border-danger');
        variable.siblings('.error').html('<span class="validation-invalid-label">Mã thuộc tính không được để trống.</span>');
        return false;
      }
      if (variable.val().length > 3 && !this.isValidVietnameseAndSpace(variable.val())) {
        variable.addClass('border-danger');
        variable.siblings('.error').html('<span class="validation-invalid-label">Mã thuộc tính phải ở dạng viết liền không dấu.</span>');
        return false;
      }

      data.tab = 'add';
      data.addQuick = 1;
      data.storeId = storeId;
      data.name = name.val();
      data.variable = variable.val();
      data.type = modal.find('#modal_type').val();
      data.categoryId = modal.find('#modal_categories').val();
      AppAjax.post('/product/variant/index', data, function (rs) {
        if (rs.code) {
          if (typeof rs.data.id != "undefined") {
            $('.dropdown-menu .dropAttrVal').each(function () {
              if ($(this).find(`.find-item[data-id="${rs.data.id}"]`)) {
                $(this).append(`<a href="javascript:void(0);" class="dropdown-item find-item" data-id="${rs.data.id}" data-column="${rs.data.column}">${rs.data.name}</a>`);
              }
            });
            AppAttributeProduct.attributesData[rs.data.column] = {
              name: rs.data.name,
              options: {
                id: rs.data.id,
                column: rs.data.column,
                parentId: null
              },
              values: {}
            };
          }
          new PNotify({
            text: rs.messages, type: 'success'
          });
          AppModal.hide('#addQuickAttrModal');
          return false;
        } else {
          new PNotify({
            text: rs.messages, type: 'danger'
          });
          return false;
        }
      });
    });
  },
  /**
   * Kiểm tra string có phải tiếng việt và có dấu không
   * - false: tiếng việt và có dấu
   * - true: không phải tiếng việt
   * */
  isValidVietnameseAndSpace(string) {
    let re = /^[0-9a-zA-Z!@#\$%\^\&*\)\(+=._-]{2,}$/g;
    return re.test(string);
  },

  /**
   * Thêm dòng thuộc tính mới
   * */
  addRowItemAttr() {
    if (!AppAttributeProduct.attributesData || typeof AppAttributeProduct.attributesData == "undefined") {
      return false;
    }

    let a = '', b = '', c = $('body .rowItemAttr:last-child'), d = c.length ? c.attr('data-order') : 0,
      sorter = parseInt(d) + 1;
    $.each(AppAttributeProduct.attributesData, function (e, f) {
      a += `<a href="javascript:void(0);" class="dropdown-item find-item" data-id="${f.options.id}" data-column="${e}">${f.name}</a>`;
    });

    b = `<tr class="rowItemAttr" data-id="" data-order="${sorter}">
              <td>
                  <div class="btn-group bg-white">
                      <button class="dropdown-toggle btn btn-md btn-outline-secondary" data-toggle="dropdown" aria-expanded="true">Chọn thuộc tính</button>
                      <div class="dropdown-menu p-2">
                          <div class="has-search position-relative">
                              <input type="text" class="form-control">
                              <span class="fa fa-search form-control-feedback"></span>
                          </div>
                          <a href="javascript:void(0);" class="dropdown-item mt-1 addQuickAttr">
                              <i class="fal fa-plus mr-1"></i> Tạo thuộc tính mới
                          </a>
                          <div class="dropdown-divider mt-0"></div>
                          <div class="dropAttrVal">${a}</div>
                      </div>
                  </div>
              </td>
              <td>
                  <div class="d-flex d-flex-child pl-xl-3">
                      <select name="" data-id="" class="attrSe form-control" data-column="" id=""></select>
                      <div class="input-group-append">
                          <span data-id="" title="" class="input-group-text btn btn-default cursor-pointer text-success addQuickValueAttributesBtn">
                              <i class="far fa-plus"></i>
                          </span>
                      </div>
                  </div>
              </td>
              <td class="text-center">
                  <input type="number" class="order-attr form-control d-inline-block mr-2" min="0" value="${sorter}" style="min-width: 75px">
                  <a href="javascript:void(0)" class="remove-attr fal fa-trash-alt text-danger"></a>
              </td>
          </tr>`;

    $('.childProductsCardBody tbody').append(b);
  },
  /**
   * Mặc định luôn hiển thị danh sách thuộc tính
   * @param attr: {
   *     name: '',
   *     options: {
   *         id: '',
   *         column: '',
   *         parentId: '',
   *     },
   *     values: {
   *         0: {
   *              id: "822996"
   *              code: "VIT"
   *              column: "i1"
   *              name: "Violet"
   *              order: 9999
   *              value: "822996"
   *         }
   *     }
   * }
   * */
  addRowItemAlwayShow(attr) {
    let html = '', c = $('body .rowItemAttr:last-child'),
      d = c.length ? c.attr('data-order') : 0,
      sorter = parseInt(d) + 1,
      column = attr.options.column,
      eltSelectId = `attrBreak-${column}`;

    html = `<tr class="rowItemAttr" data-id="${attr.options.id}" data-order="${sorter}" data-column="${column}">
              <td>
                  <div class="btn-group bg-white">
                      <span class="btn btn-md btn-outline-secondary">${attr.name}</span>                       
                  </div>
              </td>
              <td>
                  <div class="d-flex d-flex-child pl-xl-3">
                      <select name="${eltSelectId}" data-id="${attr.options.id}" class="attrSe form-control" data-column="${column}" id="${eltSelectId}"></select>
                      <div class="input-group-append">
                          <span data-id="${attr.options.id}" data-column="${column}" title="Thêm giá trị thuộc tính mới"
                           class="input-group-text btn btn-default cursor-pointer text-success addQuickValueAttributesBtn">
                              <i class="far fa-plus"></i>
                          </span>
                      </div>
                  </div>
              </td>
              <td class="text-center">
                  <input type="number" class="order-attr form-control d-inline-block mr-2" min="0" value="${sorter}" style="min-width: 75px">
                  <a href="javascript:void(0)" class="remove-attr fal fa-trash-alt text-danger"></a>
              </td>
          </tr>`;

    $('.childProductsCardBody tbody').append(html);

    let eltSelect = $(`#${eltSelectId}`);
    eltSelect.addClass('select-has--box initSelect2');
    AppAttributeProduct.genSelectAttrValue(eltSelect, attr.values);
  },
  /**
   * Xóa dòng sản phẩm con
   * - Khi thêm bơt giá trị thuộc tính
   * - Bấm icon tại từng dòng
   * */
  removeChildItem(index, onlyDelCache = false) {
    if (!index) {
      return false;
    }

    if (onlyDelCache) {
      if (AppAttributeProduct.cacheChildsList[index]) {
        delete AppAttributeProduct.cacheChildsList[index];
      }
      return true;
    }

    $(`body .childProduct[data-index*="${index}"]`).each((k, elt) => {
      if (AppAttributeProduct.cacheChildsList[index]) {
        delete AppAttributeProduct.cacheChildsList[index];
      }
      if (!onlyDelCache) {
        $(elt).remove();
      }
    });
  },
  /**
   * Tạo cache thông tin sản phẩm con
   * */
  saveCacheChilds() {
    AppAttributeProduct.cacheChildsList = {};
    $('.attributeCombinatedTable .childProduct').each(function () {
      const t = $(this);
      AppAttributeProduct.cacheChildsList[t.attr('data-index')] = {
        name: t.find('.extendName').val(),
        code: t.find('.extendCode').val(),
        barcode: t.find('.extendBarcode').val(),
        priceImport: t.find('.extendPriceImport').val(),
        price: t.find('.extendPrice').val(),
        quantity: t.find('.extendQuantity').val(),
        shippingWeight: t.find('.extendShippingWeight').val(),
        length: t.find('.extendLength').val(),
        width: t.find('.extendWidth').val(),
        height: t.find('.extendHeight').val(),
        status: t.find('.extendStatus').val(),
      };
    });
  },

  /**
   * Thay đổi lại sắp xêp khi có thuộc tính bị thay đổi
   * - Thêm dòng thuộc tính mới
   * - Xóa dòng thuộc tính
   * - Thay đổi thứ tự của 1 dòng thuộc tính
   * */
  changeSortedAtrr() {
    let body = $('.childProductsCardBody .table-attributes tbody');
    let values = [];
    body.find('.initSelect2').each(function () {
      values[$(this).attr('data-column')] = $(this).val();
      if ($(this).data('select2')) {
        $(this).select2('destroy');
      }
    });

    body.html(this.getSorted('.childProductsCardBody .rowItemAttr', 'data-order').clone());
    body.find('.initSelect2').each(function () {
      if (typeof values[$(this).attr('data-column')] != "undefined") {
        $(this).val(values[$(this).attr('data-column')]);
      }
      $(this).select2();
    });

    this.saveCacheChilds();
    this.combineChildProduct();
  },
  getSorted(c, a) {
    return $($(c).toArray().sort((b, c) => {
      let d = parseInt(b.getAttribute(a)), e = parseInt(c.getAttribute(a));
      return d - e;
    }));
  },

  /**
   * Hiển thị html thuộc tính của sản phâm CHA
   * */
  loadAttributes(categoryId) {
    const f = {
      storeId: $('#storeId').val(),
      categoryId: categoryId
    };
    AppAjax.post('/product/item/load?tab=attribute&addNew=1', f, rs => {
      $('#attributeCard').html(rs);
      AppForm.initSelectSearchBox('#attributeCard .form-control');
    });
  },
  /**
   * Hiển thị html attributes để tạo SẢN PHẨM CON
   * */
  loadChilAttributes(categoryId) {
    let storeId = $('#storeId').val(), attributeChilds = $('.childProductsCardBody'), attrCheckedIds = [],
      dataPost = {};

    attributeChilds.find('.initSelect2').select2();
    if ($('body .childProductsCardBody select').length) {
      $('.childProductsCardBody select').each(function () {
        let name = $(this).attr('name'), value = $(this).val();
        name = name.replace("attrBreak-", "").replace("[]", "");
        attrCheckedIds.push({
          'name': name, 'value': value ? value : '',
        });
      });
    }

    dataPost.tab = 'attribute';
    dataPost.addNew = 1;
    dataPost.storeId = storeId;
    dataPost.categoryId = categoryId;
    // dataPost.fromView= 'add3-breakchild';
    dataPost.fromView = 'getJson';
    dataPost.attrCheckedIds = attrCheckedIds;
    AppAjax.post('/product/item/load', dataPost, res => {
      AppAttributeProduct.attributesData = res.code ? res.data : {};
      if (typeof res.data == "undefined" || !Object.keys(res.data).length) {
        $('#childAttrWarning').removeClass('d-none');
        $('#childAttrPartial').addClass('d-none');
      } else {
        $('#childAttrWarning').addClass('d-none');
        $('#childAttrPartial').removeClass('d-none');
        $.each(AppAttributeProduct.attributesData, (column, a) => {
          this.addRowItemAlwayShow(a);

          $.each(a.values, (k, v) => {
            AppAttributeProduct.attrsValues[v.id] = v;
          });
        });
      }
    });
  },
  /**
   * Thêm dòng sản phẩm con theo thuộc tính
   * */
  combineChildProduct() {
    this.saveCacheChilds();
    let attrMap = {};
    $('.childProductsCardBody select.form-control').each(function () {
      let values = $(this).val(), column = $(this).attr('data-column');
      if (values && Array.isArray(values) && values.length) {
        let arr = [], aSorts = {};
        $.each(values, (k, val) => {
          const item = AppAttributeProduct.attrsValues[val];
          if (typeof item != "undefined") {
            const ks = `${parseInt(item.order)}_${parseInt(item.id)}`;
            aSorts[ks] = item;
          }
        });
        $.each(aSorts, (k, val) => arr.push(val));
        arr.sort((a, b) => a.order - b.order);
        attrMap[column] = arr;
      }
    });

    let product = {
      name: '',
      code: '',
      barcode: '',
      priceImport: $('body #importPrice').val() ? AutoNumeric.getNumber($('#importPrice').get(0)) : 0,
      price: $('body #price').val() ? AutoNumeric.getNumber($('#price').get(0)) : 0,
      quantity: '',
      shippingWeight: $('#shippingWeight').val(),
      length: $('#length').val(),
      width: $('#width').val(),
      height: $('#height').val(),
      status: $('#status').val(),
    };
    product.barcode = ''; // Barcode luôn để trống tránh trường hợp bị trùng SP CHA
    if ($('body #detailExtName').val()) {
      product.name = $('#detailExtName').val;
    }
    if ($('body #detailExtCode').val()) {
      product.code = $('#detailExtCode').val;
    }
    if ($('body #detailExtPrice').val()) {
      product.price = parseInt($('#detailExtPrice').val());
    }
    if ($('body #detailExtPriceImport').val()) {
      product.priceImport = parseInt($('#detailExtPriceImport').val());
    }
    if ($('body #detailExtShippingWeight').val()) {
      product.shippingWeight = parseInt($('#detailExtShippingWeight').val());
    }
    if ($('body #detailExtLength').val()) {
      product.length = parseInt($('#detailExtLength').val());
    }
    if ($('body #detailExtWidth').val()) {
      product.width = parseInt($('#detailExtWidth').val());
    }
    if ($('body #detailExtHeight').val()) {
      product.height = parseInt($('#detailExtHeight').val());
    }
    if ($('body #detailExtStatus').val()) {
      product.status = parseInt($('#detailExtStatus').val());
    }

    let products = [], totalProducts = 1;
    $.each(attrMap, function (key, value) {
      if (parseInt(value) !== 0) {
        totalProducts *= value.length;
      }
    });
    for (let i = 0; i < totalProducts; i++) {
      products[i] = [];
    }

    let last_length = 1, step, attrIndex;
    $.each(attrMap, function (key, value) {
      step = totalProducts / (value.length * last_length);
      for (let i = 0; i < totalProducts; i++) {
        attrIndex = Math.floor(i / step) % value.length;
        products[i].push(value[attrIndex]);
      }
      last_length *= value.length;
    });

    $('.attributeCombinatedTable .table-attributes tbody').html('');

    $.each(products, (k, value) => {
      if (value.length) {
        let a = '#childProduct-template .childProduct', template = $(a).clone(),
          ex = { code: [], name: [], id: [] };

        $.each(value, (k, v) => {
          ex.code.push(v.code);
          ex.name.push(v.name);
          ex.id.push(v.id);
        });

        let keyIndex = this.getIndexKey(ex.id), psItem = { ...product };
        if (AppAttributeProduct.cacheChildsList[keyIndex]) {
          psItem = AppAttributeProduct.cacheChildsList[keyIndex];
        }
        psItem.name = ' - ' + ex.name.join(' - ');
        psItem.code = '-' + ex.code.join('-');

        const ps = $(`.attributeCombinatedTable .childProduct[data-index="${keyIndex}"]`);
        if (ps.length) {
          // Đã tồn tại
          template = ps.clone();
          ps.remove();
        }
        template.data('combination', value);
        template.attr('data-index', keyIndex);
        template.find('.extendName').val(psItem.name);
        template.find('.extendCode').val(psItem.code);
        template.find('.extendBarcode').val(psItem.barcode);
        template.find('.extendPriceImport').val(psItem.priceImport);
        template.find('.extendPrice').val(psItem.price);
        template.find('.extendQuantity').val(psItem.quantity);
        template.find('.extendShippingWeight').val(psItem.shippingWeight);
        template.find('.extendLength').val(psItem.length);
        template.find('.extendWidth').val(psItem.width);
        template.find('.extendHeight').val(psItem.height);
        template.find('.extendStatus').val(psItem.status);

        $('.attributeCombinatedTable .table-attributes tbody').append(template);

        AppFuntions.initAutoNumeric('.attributeCombinatedTable .autoNumeric');
      }
    });
  },

  getIndexKey(array) {
    if (!array || typeof array != "object" || !Object.keys(array).length) {
      return '';
    }
    return array.sort().join('-');
  },

  /**
   * Tùy chỉnh ẩn hiện cột sản phẩm mở rộng
   * */
  displayColumnHandler() {
    let html = '',
      displayColCss = $('#displayColumnStyle'),
      keyStorage = 'NhanhDisplayColumnAtrrExtenb',
      settings = localStorage.getItem(keyStorage) ? JSON.parse(localStorage.getItem(keyStorage)) : [];

    if (settings.length) {
      $('.dgExtColumn').prop('checked', true);
      $.each(settings, function (k, cls) {
        $(`.dgExtColumn[value="${cls}"]`).prop('checked', false);
        html += `.${cls} { display: none !important; }`;
      });
      displayColCss.html(html);
    }

    $(document).on('click', '.dgExtColumn', function () {
      html = '';
      settings = [];
      $('.dgExtColumn').each(function () {
        if (!$(this).is(':checked')) {
          settings.push($(this).val());
          html += `.${$(this).val()} { display: none !important; }`;
        }
      });
      localStorage.setItem(keyStorage, JSON.stringify(settings));
      displayColCss.html(html);
    });

    $(document).on('click', '.resetColumnDisplay', function () {
      $('.dgExtColumn').prop('checked', false);
      localStorage.setItem(keyStorage, JSON.stringify([]));
      displayColCss.html(`.colExtBarcode, .colExtPriceImport, .colExtPrice, .colExtOther {display: none !important;}`);
    });
  },
};

/**
* Tạo sản phẩm con từ thuộc tính trang chi tiết sản phẩm
* */
var AppProductDetail = {
  init() {
    $(document).on('click', '.createAttrschild', function () {
      const categoryId = $('#categoryId');
      if (!categoryId.val()) {
        PNotify.removeAll();
        new PNotify({
          text: 'Vui lòng chọn <span class="font-weight-semibold">Danh mục sản phẩm</span> trước.',
          addclass: 'alert alert-warning alert-styled-right',
        });
        return false;
      }
      categoryId.trigger('change');
      $('#createAttrChildModal').modal('show');
    });

    $('#createAttrChildModal .create').on('click', () => {
      $('#createAttrChildModal .loading').show();
      $('#createAttrChildModal .data').hide();
      this.saveProductChildAttr();
    });
  },
  _getDataAttrCombinated() {

    // chia sp thuộc tính
    // duyệt các row ở bảng tổ hợp sp thuộc tính
    // lưu dữ liệu vào 1 hidden dưới dnagj json
    let attrsBreak = [], hasInputQuantity = false, p = $('#createAttrChildModal'), depotId = p.find('#depotIdAttr');

    p.find('.table-attributes .childProduct').each(function () {
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
        'extendStatus': t.find('.extendStatus').val() ? t.find('.extendStatus').val() : null
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
        obj.extendImageId = renderImg.attr('data-id');
        obj.extendImage = renderImg.attr('data-fileName');
      }
      attrsBreak.push(obj);
    });

    return {
      'combinated': JSON.stringify(attrsBreak), 'isValidDepot': !(hasInputQuantity && !depotId.val()),
    };
  },
  saveProductChildAttr() {
    let p = $('body #createAttrChildModal'), depotId = p.find('#depotIdAttr'), data = {},
      getData = this._getDataAttrCombinated();

    p.find('.attributeCombinatedTable .alert').remove();
    p.find('.childProduct .border-danger').addClass('border-danger');
    depotId.removeClass('border-danger');
    if (!getData.isValidDepot) {
      PNotify.removeAll();
      new PNotify({
        text: 'Bạn chưa chọn cửa hàng',
      });
      depotId.focus();
      depotId.addClass('border-danger');
      return false;
    }

    AppCommon.overLoading({ zIndex: 9999, opacity: 0.3 });

    data.id = $('#detailExtId').val();
    data.storeId = $('#detailExtStoreId').val();
    data.copyParentImage = p.find('#copyParentImage:checked').val();
    data.depotId = p.find('#depotIdAttr').val();
    data.attributeCombinated = getData.combinated;
    AppAjax.post('/product/item/createattrchild', data, rs => {
      if (rs.code) {
        location.reload();
      } else {
        AppCommon.overLoading({ display: 'hide' });

        if (typeof rs.errorsAttributeDuplicate != "undefined") {
          let html = '', duplicate = rs.errorsAttributeDuplicate;

          if (typeof duplicate.name != "undefined" && (duplicate.name.length || Object.keys(duplicate.name).length)) {
            $.each(duplicate.name, (k, i) => {
              p.find(`.childProduct[data-index="${i}"] .extendName`).addClass('border-danger');
            });
            html += `<p class="mb-0">Tên mở rộng đã được sử dụng</p>`;
          }
          if (typeof duplicate.code != "undefined" && (duplicate.code.length || Object.keys(duplicate.code).length)) {
            $.each(duplicate.code, (k, i) => {
              p.find(`.childProduct[data-index="${i}"] .extendCode`).addClass('border-danger');
            });
            html += `<p class="mb-0">Mã mở rộng đã được sử dụng</p>`;
          }
          if (typeof duplicate.barcode != "undefined" && (duplicate.barcode.length || Object.keys(duplicate.barcode).length)) {
            $.each(duplicate.barcode, (k, i) => {
              p.find(`.childProduct[data-index="${i}"] .extendBarcode`).addClass('border-danger');
            });
            html += `<p class="mb-0">Mã vạch sản phẩm con đã được sử dụng</p>`;
          }
          p.find('.attributeCombinatedTable').append(`<div class="alert alert-warning mb-0 mt-3">${html}</div>`);
        } else {
          PNotify.removeAll();
          new PNotify({ text: rs.messages });
        }
        return false;
      }
    });
  },
};
