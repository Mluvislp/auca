$(function () {
  'use strict';
  AppCommon.init();
  AppDataGrid.init();
  AppDateTime.init();
  AppFuntions.initAutoNumeric('.autoNumeric');
  AppFuntions.initAutoNumericDecimal('.autoNumericDecimal');
  AppForm.init();
  AppLocation.init();
  AppCommon.checkExpiredDate();
  var t = $('#filter-advanced-elements');
  if (t.find('.fInputHidden.d-none').length != t.find('.row.form-group.input-group').length) {
    t.addClass('show');
  }
  $(document).on('click', '#dropDownAvdancedFilter', function (e) {
    e.preventDefault();
    $(this).find('i').toggleClass('fa-rotate-180');
    if ($(this).find('i').hasClass('fa-rotate-180')) {
      $('#filter-advanced-elements').addClass('show');
    } else {
      $('#filter-advanced-elements').removeClass('show');
    }
    $('#filter-advanced-elements').find('.fInputHidden').toggleClass('d-none');
  });
  $(document).on('click', '#advancedFilterModal', function () {
    $('#modalAdvancedFilter').modal();
    $('#modalAdvancedFilter').on('shown.bs.modal', function () {
      $('#newFilterName').trigger('focus');
    });
    var params = window.location.pathname + window.location.search;
    $('#filterValues').val(params);
  });
  $('#saveAdvancedFilter').on('click', function () {
    let name = $('#newFilterName').val()
      , type = $('#typeFilter').val()
      , filterValues = $('#filterValues').val();
    if (!name || !type || !filterValues) {
      $('#msgAdvancedFilter').addClass('alert alert-danger').html('Dữ liệu không hợp lệ');
    }
    AppAjax.post('/user/setting/savefilter', {
      storeId: $('#storeId').val(),
      type: type,
      name: name,
      filterValues: filterValues
    }, function (rs) {
      if (rs.code) {
        if ($('#msgAdvancedFilter').hasClass('alert-danger')) {
          $('#msgAdvancedFilter').removeClass('alert-danger').addClass('alert-success').html('Lưu bộ lọc mới thành công');
        } else {
          $('#msgAdvancedFilter').addClass('alert alert-success').html('Lưu bộ lọc mới thành công');
        }
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      } else {
        $('#msgAdvancedFilter').addClass('alert alert-danger').html(rs.messages);
      }
    });
  });
  $(document).on('click', '#deleteSavedFilter', function (e) {
    e.preventDefault();
    AppModal.show({
      size: 'modal-md',
      color: '',
      title: 'Xác nhận xóa?',
      content: '<div class="alert alert-warning"><p class="mb-0">Bạn có chắc chắn muốn xóa bộ lọc: <span class="font-weight-semibold overflow-hidden d-block" title="' + $(this).attr('data-label') + '">' + $(this).attr('data-label') + '</span></p></div>',
      buttons: [{
        title: '<i class="fal fa-check mr-1"></i> ' + appTranslator.translate(appTranslator.labels.Yes),
        color: 'btn-danger',
        attributes: {
          'id': 'modal-btn-deleteFilter-yes',
          'data-id': $(this).attr('data-id'),
          'data-link': $(this).attr('data-link'),
        }
      }, {
        title: '<i class="fal fa-times mr-1"></i> ' + appTranslator.translate(appTranslator.labels.No),
        color: 'btn-light',
        attributes: {
          'data-dismiss': 'modal'
        }
      }]
    });
  });
  $(document).on('click', '#modal-btn-deleteFilter-yes', function (e) {
    e.preventDefault();
    $('body').removeClass('modal-open').removeAttr('style');
    AppModal.hide();
    AppAjax.post($(this).attr('data-link'), {
      id: $(this).attr('data-id'),
      storeId: $('#storeId').val()
    }, function (rs) {
      if (rs.code) {
        new PNotify({
          title: '<i class="far fa-check mr-1"></i> Xóa thành công: ',
          text: 'Đã xóa bộ lọc này',
          type: 'success'
        });
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      } else {
        new PNotify({
          title: '<i class="far fa-check"></i> Lỗi xóa: ' + $('#modal-btn-delete-yes').attr('data-label'),
          text: rs.messages,
          type: 'danger'
        });
      }
    });
  });
  let parentWidth = $('.table-responsive').parents('.page-content').width()
    , tableWidth = $('.table-responsive table').width();
  if (parentWidth > 768 && tableWidth > parentWidth) {
    $('.table-responsive').parents('.page-content').css({
      'width': parentWidth + 'px'
    });
    $('.table-responsive').parents('.content-wrapper').css({
      'width': '100%'
    });
    $('.table-responsive').parents('.content').css({
      'padding': '0'
    });
  }
  $(window).resize(function () {
    if ($(this).width() !== parentWidth) {
      parentWidth = $(this).width();
      if (parentWidth > 768 && tableWidth > parentWidth) {
        $('.table-responsive').parents('.page-content').css({
          'width': parentWidth + 'px'
        });
        $('.table-responsive').parents('.content-wrapper').css({
          'width': '100%'
        });
        $('.table-responsive').parents('.content').css({
          'padding': '0'
        });
      } else {
        $('.table-responsive').parents('.page-content').css({
          'width': ''
        });
        $('.table-responsive').parents('.content-wrapper').css({
          'width': ''
        });
        $('.table-responsive').parents('.content').css({
          'padding': ''
        });
      }
    }
  });
  $('.table-responsive').on('change', function () {
    var t = $(this);
    let parentWidth = t.parents('.page-content').width()
      , tableWidth = $('.table-responsive table').width();
    if (parentWidth > 768 && tableWidth > parentWidth) {
      $('.table-responsive').parents('.page-content').css({
        'width': parentWidth + 'px'
      });
      $('.table-responsive').parents('.content-wrapper').css({
        'width': '100%'
      });
      $('.table-responsive').parents('.content').css({
        'padding': '0'
      });
    } else {
      $('.table-responsive').parents('.page-content').css({
        'width': ''
      });
      $('.table-responsive').parents('.content-wrapper').css({
        'width': ''
      });
      $('.table-responsive').parents('.content').css({
        'padding': ''
      });
    }
  });
  if ($('#menuHorizontal').length) {
    if ($('#menuHorizontal li').length >= 10) {
      $('#menuHorizontal > li:nth-last-child(3) .dropdown-menu,#menuHorizontal > li:nth-last-child(2) .dropdown-menu,#menuHorizontal > li:last-child .dropdown-menu').css({
        'left': 'inherit',
        'right': 0
      });
      $('#menuHorizontal > li:nth-last-child(3) .dropdown-menu .dropdown-submenu .dropdown-menu,#menuHorizontal > li:nth-last-child(2) .dropdown-menu .dropdown-submenu .dropdown-menu,#menuHorizontal > li:last-child .dropdown-menu .dropdown-submenu .dropdown-menu').css({
        'right': 100 + '%',
        'left': 'inherit'
      });
    }
  }
  $(document).ready(function () {
    $('#notifyBox li').hover(function () {
      if ($(this).find('a').width() > 450) {
        $('#notifyBox li:hover a').css('margin-left', '-15em');
      } else if ($(this).find('a').width() > 400) {
        $('#notifyBox li:hover a').css('margin-left', '-5em');
      }
    }, function () {
      $('#notifyBox li a').css('margin-left', '0em');
    });
  });
  storeSuggestHandler.load({
    tbSuggest: '#storeIdName',
    emptyDataHandler: function () {
      $('#storeId').val('');
    },
    selectHandler: function (s) {
      $('#storeIdName').val(s.label);
      $('#storeId').val(s.id).trigger('change');
    }
  });
  storeSuggestHandler.load({
    tbSuggest: '#businessIdName',
    emptyDataHandler: function () {
      $('#businessId').val('');
    },
    selectHandler: function (s) {
      $('#businessIdName').val(s.label);
      $('#businessId').val(s.id).trigger('change');
    }
  });
  if (MobileAppClient.isMobileAppLayout()) {
    localStorage.removeItem('lastSigninDateTime');
    localStorage.removeItem('announcementData');
  } else {
    if (localStorage.lastSigninDateTime) {
      var lastTimeAnnouncement = AppAnnouncement.lastTimeAnnouncement()
        , announcementData = AppAnnouncement.announcementData()
        , currentDateTime = AppAnnouncement.currentDateTime;
      if (currentDateTime > Number(lastTimeAnnouncement)) {
        AppAnnouncement.loadLatestAnnouncement();
      } else {
        AppAnnouncement.loadAnnouncementDom({
          data: announcementData
        });
      }
    } else {
      localStorage.lastSigninDateTime = AppAnnouncement.currentDateTime;
      AppAnnouncement.loadLatestAnnouncement();
    }
  }
  $(document).on('click', '#supportBottom', function () {
    $('html , body').animate({
      scrollTop: $(document).height()
    }, 'slow');
    return false;
  });
});
var AppAnnouncement = {
  currentDateTime: new Date().getTime(),
  lastTimeAnnouncement: function () {
    var lastTime;
    if ($.cookie('lastTimeAnnouncement') == null) {
      lastTime = null;
    } else {
      lastTime = $.cookie('lastTimeAnnouncement');
    }
    return lastTime;
  },
  announcementData: function () {
    var data;
    if (localStorage.announcementData == null) {
      data = null;
    } else {
      data = localStorage.announcementData;
    }
    return data;
  },
  loadLatestAnnouncement: function () {
    AppAjax.post('/application/index/loadAnnouncement', {}, function (rs) {
      if (rs.code == 1) {
        var dataBeforeCheck = JSON.parse(rs.announcementData)
          , dataAfterCheck = [];
        $.each(dataBeforeCheck, function (index, value) {
          if (Number(value[2]) > Number(localStorage.lastSigninDateTime)) {
            dataAfterCheck.push(value);
          }
        })
        localStorage.announcementData = JSON.stringify(dataAfterCheck);
      }
      var data = AppAnnouncement.announcementData();
      AppAnnouncement.loadAnnouncementDom({
        data: data
      });
    });
  },
  loadAnnouncementDom: function (options) {
    if (JSON.parse(options.data).length > 0) {
      $('#js-notify-qty').append('<i class="fas fa-bell fa-lg"></i>');
    } else {
      $('#js-notify-qty').append('<i class="far fa-bell fa-lg"></i>');
    }
    if (options.data) {
      var currentData = JSON.parse(options.data);
      $.each(currentData, function (index, value) {
        $('#notifyBox').append('<li class="dropdown-item"><a href="' + value[0] + '" class="media-title noticeItem font-weight-semibold text-default"><i class="far fa-bell mr-1"></i>' + value[1] + '</a></li>\n');
      });
    }
  }
};
function formatDecimal(n) {
  n += '';
  if (!$.trim(n)) {
    return '';
  }
  var x = n.split('.');
  var x1 = x[0];
  var x2 = x.length > 1 ? ',' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + '.' + '$2');
  }
  return x1 + x2;
}
function renderStyleButtonMobile() {
  $('#buttonMenuMobileFilter').parent().css({
    'position': 'fixed',
    'top': '48px',
    'padding': '0',
    'left': '0',
    'width': '100%',
    'max-width': '100%',
    'z-index': '100'
  });
  if ($('#expired-messages').text().length > 0) {
    $('#buttonMenuMobileFilter').parent().css({
      'position': 'fixed',
      'top': '72px',
      'padding': '0',
      'left': '0',
      'width': '100%',
      'max-width': '100%',
      'z-index': '100'
    });
  }
}
function renderStyleButtonDefault() {
  $('#buttonMenuMobileFilter').parent().attr('style', '');
  $('#buttonMenuMobileFilter').attr('style', 'display:none');
}
