var allCkEditors = [];
var AppCommon = {
  init: function () {
    this.settingLayoutUI();
    this.changeUserUI();
    this.initTooltip();
    this.initMenu();
    this.initDropdownContent();
    this.initCarousel();
    this.initChangeStatus();
    this.textareaAutoHeight();
    this.submitFilter();
    this.trTableActive();
    this.copyText();
    this.handlerGroupTags();
  },
  renderIframeHtml: function (src, id) {
    if (!src || !id) {
      return;
    }
    return '<div class="scroll-wrapper d-flex position-relative" style="height: 80vh"><iframe id="' + id + '" class="w-100 h-100 border-0" src="' + src + '"></iframe></div>';
  },
  changeUserUI: function () {
    $('.changeUserUI').on('click', function () {
      var t = $(this)
        , inputName = t.attr('name')
        , reload = false;
      if (t.parent().hasClass('checked')) {
        return;
      }
      if (inputName == 'settingColor') {
        var dataColor = AppCommon.selectUserUiColor(t.val());
        var color = dataColor.id;
        var colorCode = dataColor.colorCode;
        $('meta[name="apple-mobile-web-app-status-bar-style"]').attr('content', colorCode);
        var logo = 'nhanh_white.png';
        if (color == 2) {
          logo = 'nhanh_white_red_icon.png';
        }
        $('body').addClass('theme-' + color);
        $('#logoMain img').attr('src', '/img/logo/' + logo);
      } else if (inputName == 'settingMenu') {
        reload = true;
      } else if (inputName == 'settingOpenMenu') {
        if ($(this).val() == appConsts.userUi.UI_LAYOUT_MENU_HOVER) {
          $('[data-toggle="dropdown"]').attr('data-hover', 'dropdown');
          if ($('[data-hover="dropdown"]').length) {
            $('[data-hover="dropdown"]').dropdownHover();
          }
        } else {
          if ($('[data-hover="dropdown"]').length) {
            $('[data-hover="dropdown"]').parent().unbind('mouseenter');
            $('#menuHorizontal li, .dropdown-submenu').unbind('mouseenter');
            $('[data-hover="dropdown"]').removeAttr('data-hover');
          }
        }
      } else if (inputName == 'settingOpenPageDetail') {
        if ($(this).val() == appConsts.userUi.UI_LAYOUT_OPEN_PAGE_NEW) {
          $('.open-detail-in-iframe').removeClass('open-detail-in-iframe');
        } else {
          reload = true;
        }
      }
      UserUI.saveUserSetting(false);
      if (reload) {
        setTimeout(function () {
          location.reload();
        }, 500);
      }
    });
  },
  selectUserUiColor: function (colorId) {
    var obj = {};
    var layoutColors = AppCommon.layoutColors();
    $.each(layoutColors, function (i, colorItem) {
      if (colorItem.id == colorId) {
        obj.id = colorItem.id;
        obj.colorCode = colorItem.colorCode;
      } else {
        $('body').removeClass('theme-' + colorItem.id);
      }
    });
    if (Object.keys(obj).length == 0) {
      return layoutColors[0];
    }
    return obj;
  },
  layoutColors: function () {
    return [{
      'id': appConsts.userUi.UI_LAYOUT_COLOR_RED,
      'colorCode': '#ab1d1d'
    }, {
      'id': appConsts.userUi.UI_LAYOUT_COLOR_BLACK,
      'colorCode': '#324148'
    }, {
      'id': appConsts.userUi.UI_LAYOUT_COLOR_3,
      'colorCode': '#27ae61'
    }, {
      'id': appConsts.userUi.UI_LAYOUT_COLOR_4,
      'colorCode': '#0090da'
    }, {
      'id': appConsts.userUi.UI_LAYOUT_COLOR_5,
      'colorCode': '#4b6580'
    }, {
      'id': appConsts.userUi.UI_LAYOUT_COLOR_6,
      'colorCode': '#9b58b5'
    }, {
      'id': appConsts.userUi.UI_LAYOUT_COLOR_7,
      'colorCode': '#6e9992'
    }, {
      'id': appConsts.userUi.UI_LAYOUT_COLOR_8,
      'colorCode': '#16a086'
    }, {
      'id': appConsts.userUi.UI_LAYOUT_COLOR_9,
      'colorCode': '#e67e22'
    }, {
      'id': appConsts.userUi.UI_LAYOUT_COLOR_10,
      'colorCode': '#d73c8a'
    }];
  },
  settingLayoutUI: function () {
    var layoutUI = window.localStorage.getItem('user_UI_setting');
    if (!layoutUI || layoutUI == 'undefined') {
      AppAjax.post('/profile/ui', {
        tab: 'loadSettingUI'
      }, function (rs) {
        layoutUI = JSON.stringify(rs.extraContent);
        window.localStorage.setItem('user_UI_setting', layoutUI);
      });
    }
    if (!layoutUI) {
      return;
    }
    layoutUI = JSON.parse(layoutUI);
    if (layoutUI.openMenu) {
      if (layoutUI.openMenu == appConsts.userUi.UI_LAYOUT_MENU_HOVER) {
        $('[data-toggle="dropdown"]').attr('data-hover', 'dropdown');
        if ($('[data-hover="dropdown"]').length) {
          $('[data-hover="dropdown"]').dropdownHover();
        }
      } else {
        if ($('[data-hover="dropdown"]').length) {
          $('[data-hover="dropdown"]').parent().unbind('mouseenter');
          $('#menuHorizontal li, .dropdown-submenu').unbind('mouseenter');
          $('[data-hover="dropdown"]').removeAttr('data-hover');
        }
      }
    }
    if (layoutUI.openPageDetail && layoutUI.openPageDetail == appConsts.userUi.UI_LAYOUT_OPEN_PAGE_NEW) {
      $('.open-detail-in-iframe').removeClass('open-detail-in-iframe');
    }
    if (layoutUI.fixedMenu) {
      if (layoutUI.fixedMenu == appConsts.userUi.UI_LAYOUT_MENU_FIXED) {
        $(window).bind('scroll', function () {
          if (window.innerWidth > 1024) {
            if ($(window).scrollTop() > 50) {
              $('#menuHorizontal').parents('.navbar').css({
                'position': 'sticky',
                'top': '0',
                'z-index': '1050'
              });
              $('#menuHorizontal').parents('.layout-horizontal').find('#dgTableView .stickyHeader  > thead').css({
                'top': '50px'
              });
            } else {
              $('#menuHorizontal').parents('.navbar').css({
                'position': '',
                'top': '',
                'z-index': ''
              });
              $('#menuHorizontal').parents('.layout-horizontal').find('#dgTableView .stickyHeader  > thead').css({
                'top': '0'
              });
            }
            if (window.innerWidth < 1920) {
              $('#menuHorizontal > li.show > div').css({
                'max-height': '500px',
                'overflow': 'auto'
              });
            }
          } else {
            $('#menuHorizontal').parents('.layout-horizontal').find('#dgTableView .stickyHeader  > thead').css({
              'top': '0'
            });
          }
        });
      } else {
        $('#menuHorizontal').parents('.layout-horizontal').find('#dgTableView .stickyHeader  > thead').css({
          'top': '0'
        });
      }
    }
  },
  checkExpiredDate: function () {
    $('.btnSignout').on('click', function () {
      window.localStorage.removeItem('expired_date');
    });
    var expiredDate = window.localStorage.getItem('expired_date');
    if (expiredDate) {
      expiredDate = JSON.parse(expiredDate);
      if (Date.now() < expiredDate.next_check_expired) {
        if (expiredDate.message) {
          $('#expired-messages').html(expiredDate.message);
          $('#expiredWarning').show().attr('href', expiredDate.link);
        }
        return;
      }
    }
    AppAjax.post('/store/manage/load', {
      'tab': 'checkExpiredDate'
    }, function (rs) {
      let link = '';
      if (rs.message) {
        link = rs.link ? rs.link : 'javascript:;';
        $('#expired-messages').html(rs.message);
        $('#expiredWarning').show().attr('href', link);
      }
      let date = new Date();
      let next_check_expired = date.setHours(date.getHours() + 1);
      let expired_date = {
        next_check_expired: next_check_expired,
        message: rs.message ? rs.message : '',
        link: link
      };
      window.localStorage.setItem('expired_date', JSON.stringify(expired_date));
    });
  },
  trTableStriped: function (table) {
    var i = 0;
    var cols = $(table).find("tr:first").children().length;
    if ($("tr:first").find("[colspan]").attr("colspan") != null) {
      cols += (parseInt($("tr:first").find("[colspan]").attr("colspan")) - 1);
    }
    $("tr").each(function (index) {
      var child = $(this).children().length;
      if ($(this).find("[colspan]").attr("colspan") != null) {
        child += (parseInt($(this).find("[colspan]").attr("colspan")) - 1);
      }
      if (child > (cols - 1)) {
        if (i % 2 == 0)
          $(this).addClass("table-rowDark");
        i++;
      } else {
        $(this).addClass($(this).prev().attr("class"));
      }
    });
  },
  trTableActive: function () {
    $('tbody>tr td').on('mouseover mouseout', function (e) {
      if (e.type == 'mouseover') {
        $el = $(this);
        $.each($el.parent().data('blockrows'), function () {
          $(this).find('td').addClass('hover');
        });
      } else {
        $el = $(this);
        $.each($el.parent().data('blockrows'), function () {
          $(this).find('td').removeClass('hover');
        });
      }
    });
    $("tbody>tr>td.select-checkbox").on('click', function () {
      var rowspan = $(this).parent().find('td[rowspan]').attr('rowspan');
      if (rowspan) {
        for (i = 0; i <= (rowspan - 2); i++) {
          $(this).parent().nextAll().eq(i).toggleClass('sub-item-row-selected');
        }
      }
    });
    $(document).on('click', '#cbCheckAll', function () {
      $(this).parents('table').find('tbody tr').toggleClass('sub-item-row-selected');
    });
    AppCommon.findBlocks($('table'));
  },
  findBlocks: function (theTable) {
    if ($(theTable).attr('data-hasblockrows') == null) {
      var rows = $(theTable).find('tr');
      for (var i = 0; i < rows.length;) {
        var firstRow = rows[i];
        var maxRowspan = 1;
        $(firstRow).find('td').each(function () {
          var attr = parseInt($(this).attr('rowspan') || '1', 10);
          if (attr > maxRowspan)
            maxRowspan = attr;
        });
        maxRowspan += i;
        var blockRows = [];
        for (; i < maxRowspan; i++) {
          $(rows[i]).data('blockrows', blockRows);
          blockRows.push(rows[i]);
        }
      }
      $(theTable).attr('data-hasblockrows', 1);
    }
  },
  textareaAutoHeight: function () {
    $('textarea.ta-auto-height').on('keyup input', function () {
      $(this).css('height', $(this).prop("scrollHeight") + 2);
    });
  },
  initTooltip: function () {
    if ($('[data-toggle="tooltip"]')) {
      $('[data-toggle="tooltip"]').tooltip({
        trigger: "hover"
      });
    }
  },
  initMenu: function () {
    $('.menuSelect>a').on('click', function () {
      $(this).parent().find('.openDropdown').toggleClass('active');
    });
    $('.changeLayoutDropdown>li>a').on('click', function () {
      var t = $(this);
      if (!$.cookie('uiLayoutMenu') || $.cookie('uiLayoutMenu') != t.attr('data-value')) {
        $.cookie('uiLayoutMenu', t.attr('data-value'), {
          expires: 365,
          path: '/'
        });
        location.reload();
      }
    });
    $('.changeSkinDropdown>li>a>i').on('click', function () {
      var t = $(this);
      if (!$.cookie('uiSkin') || $.cookie('uiSkin') != t.attr('data-value')) {
        $.cookie('uiSkin', t.attr('data-value'), {
          expires: 365,
          path: '/'
        });
        location.reload();
      }
    });
    $('#showHideMainMenu').on('click', function () {
      var t = $(this);
      if (!$.cookie('showHideMainMenu')) {
        $.cookie('showHideMainMenu', 'mainMenu', {
          expires: 365,
          path: '/'
        });
      } else {
        $.removeCookie('showHideMainMenu', {
          path: '/'
        });
      }
    });
    $(window).on('scroll', function () {
      if ($(window).width() < 768 && $(window).scrollTop() > 0) {
        $('.fixTopDefault').addClass('fixed-top');
        $('body').addClass('navbar-top');
      } else {
        $('.fixTopDefault').removeClass('fixed-top');
        $('body').removeClass('navbar-top');
      }
    });
    $(window).add('.table-responsive').on('scroll', function () {
      if ($(this).scrollLeft() > 0) {
        $('.stickyFirstCol>tbody>tr>td:nth-child(1)').addClass('fixedLeft');
      } else {
        $('.stickyFirstCol>tbody>tr>td:nth-child(1)').removeClass('fixedLeft');
      }
    });
    if ($(window).width() < 768) {
      $(document).on('click', function (event) {
        var element = $(event.target);
        if (!element.hasClass('fa-bars') && element.parents('.sidebar-content').length == 0) {
          $('body').removeClass('sidebar-mobile-main');
        }
      });
    } else {
      $('.nav-sidebar>.nav-item>.nav-link').hover(function () {
        $('.nav-sidebar>.nav-item>.nav-group-sub').hide();
      }, function () {
        $('.nav-sidebar>.nav-item.nav-item-open>.nav-group-sub').show();
      });
    }
  },
  initDropdownContent: function () {
    $('.dropdown-menu.notClose').on('click', function (event) {
      event.stopPropagation();
    });
  },
  initCkeditor: function (selector) {
    selector = selector ? selector : '.editor';
    var allHtmlElements = document.querySelectorAll(selector);
    var editorConfig = {
      language: 'vi',
      fontSize: {
        options: [8, 9, 10, 11, 12, 13, 'default', 15, 16, 17, 18, 19, 20, 22, 24, 26, 28, 36],
      },
      image: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties', 'toggleTableCaption'],
        resizeUnit: 'px',
        resizeOptions: [{
          name: 'resizeImage:original',
          label: 'Original',
          value: null,
          icon: 'original'
        }, {
          name: 'resizeImage:100',
          label: '100px',
          value: '100',
          icon: 'medium'
        }, {
          name: 'resizeImage:200',
          label: '200px',
          value: '200',
          icon: 'large'
        }],
      },
      table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties', 'toggleTableCaption'],
        tableProperties: {
          defaultProperties: {
            borderStyle: 'dashed',
            borderColor: 'hsl(90, 75%, 60%)',
            borderWidth: '3px',
            alignment: 'left',
            width: '550px',
            height: '450px'
          },
          tableCellProperties: {
            defaultProperties: {
              horizontalAlignment: 'center',
              verticalAlignment: 'bottom',
              padding: '10px'
            }
          }
        }
      },
      toolbar: {
        items: ['Heading', 'fontFamily', 'fontSize', 'fontColor', 'fontBackgroundColor', 'Bold', 'Italic', 'Underline', 'Strikethrough', 'link', 'imageUpload', 'insertTable', '|', 'bulletedList', 'blockQuote', 'alignment:left', 'alignment:right', 'alignment:center', 'alignment:justify', '|', 'undo', 'redo', 'Indent', 'Outdent', 'CodeBlock', 'sourceEditing', 'RemoveFormat', 'MediaEmbed', 'Code', 'resizeImage'],
        shouldNotGroupWhenFull: false
      },
      mediaEmbed: {
        previewsInData: true,
        providers: [{
          name: 'dailymotion',
          url: /^dailymotion\.com\/video\/(\w+)/,
          html: match => {
            const id = match[1];
            return ('<div style="position: relative; padding-bottom: 100%; height: 0; ">' + `<iframe src="https://www.dailymotion.com/embed/video/${id}" ` + 'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' + 'frameborder="0" width="480" height="270" allowfullscreen allow="autoplay">' + '</iframe>' + '</div>');
          }
        }, {
          name: 'spotify',
          url: [/^open\.spotify\.com\/(artist\/\w+)/, /^open\.spotify\.com\/(album\/\w+)/, /^open\.spotify\.com\/(track\/\w+)/],
          html: match => {
            const id = match[1];
            return ('<div style="position: relative; padding-bottom: 100%; height: 0; padding-bottom: 126%;">' + `<iframe src="https://open.spotify.com/embed/${id}" ` + 'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' + 'frameborder="0" allowtransparency="true" allow="encrypted-media">' + '</iframe>' + '</div>');
          }
        }, {
          name: 'youtube',
          url: [/^(?:m\.)?youtube\.com\/watch\?v=([\w-]+)(?:&t=(\d+))?/, /^(?:m\.)?youtube\.com\/v\/([\w-]+)(?:\?t=(\d+))?/, /^youtube\.com\/embed\/([\w-]+)(?:\?start=(\d+))?/, /^youtube\.com\/shorts\/([\w-]+)?/, /^youtu\.be\/([\w-]+)(?:\?t=(\d+))?/],
          html: match => {
            const id = match[1];
            const time = match[2];
            return ('<p>' + `<iframe src="https://www.youtube.com/embed/${id}${time ? `?start=${time}` : ''}" ` + 'frameborder="0" width="560" height="315" allow="autoplay; encrypted-media" allowfullscreen>' + '</iframe>' + '</p>');
          }
        }, {
          name: 'vimeo',
          url: [/^vimeo\.com\/(\d+)/, /^vimeo\.com\/[^/]+\/[^/]+\/video\/(\d+)/, /^vimeo\.com\/album\/[^/]+\/video\/(\d+)/, /^vimeo\.com\/channels\/[^/]+\/(\d+)/, /^vimeo\.com\/groups\/[^/]+\/videos\/(\d+)/, /^vimeo\.com\/ondemand\/[^/]+\/(\d+)/, /^player\.vimeo\.com\/video\/(\d+)/],
          html: match => {
            const id = match[1];
            return ('<div style="position: relative; padding-bottom: 100%; height: 0; padding-bottom: 56.2493%;">' + `<iframe src="https://player.vimeo.com/video/${id}" ` + 'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' + 'frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>' + '</iframe>' + '</div>');
          }
        }, {
          name: 'instagram',
          url: /^instagram\.com\/p\/(\w+)/
        }, {
          name: 'twitter',
          url: /^twitter\.com/
        }, {
          name: 'googleMaps',
          url: [/^google\.com\/maps/, /^goo\.gl\/maps/, /^maps\.google\.com/, /^maps\.app\.goo\.gl/]
        }, {
          name: 'flickr',
          url: /^flickr\.com/
        }, {
          name: 'facebook',
          url: /^facebook\.com/
        }]
      },
      link: {
        decorators: {
          openInNewTab: {
            mode: 'manual',
            label: 'Open in a new tab',
            defaultValue: false,
            attributes: {
              target: '_blank',
              rel: 'noopener noreferrer'
            }
          }
        }
      },
      htmlSupport: {
        allow: [{
          name: 'pre',
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display'],
          attributes: true
        }, {
          name: 'div',
          classes: true,
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display'],
          attributes: true
        }, {
          name: 'span',
          classes: true,
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display'],
          attributes: true
        }, {
          name: 'p',
          classes: true,
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display'],
          attributes: true
        }, {
          name: 'strong',
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display'],
          attributes: true
        }, {
          name: 'ul',
          classes: true,
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type'],
          attributes: true
        }, {
          name: 'ol',
          classes: true,
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type'],
          attributes: true
        }, {
          name: 'li',
          classes: true,
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type'],
          attributes: true
        }, {
          name: 'iframe',
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type', 'width', 'height', 'position', 'top', 'left', 'right', 'bottom'],
          attributes: true
        }, {
          name: 'table',
          classes: true,
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type', 'table-layout', 'font-size', 'font-family', 'border-collapse', 'border'],
          attributes: true
        }, {
          name: 'td',
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type', 'border-width', 'border-style', 'border-color', 'border-image', 'vertical-align', 'font-size', 'font-weight', 'overflow', 'text-decoration-line'],
          attributes: true
        }, {
          name: 'tr',
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type', 'height'],
          attributes: true
        }, {
          name: 'colgroup',
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type'],
          attributes: true
        }, {
          name: 'col',
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type'],
          attributes: true
        }, {
          name: 'tbody',
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type'],
          attributes: true
        }, {
          name: 'img',
          classes: true,
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type', 'width'],
          attributes: true
        }, {
          name: 'a',
          classes: true,
          styles: ['background', 'padding', 'border', 'margin', 'color', 'text-align', 'display', 'list-style-type', 'width'],
          attributes: true
        },],
      },
      heading: {
        options: [{
          model: 'paragraph',
          title: 'Paragraph',
          class: 'ck-heading_paragraph'
        }, {
          model: 'heading1',
          view: 'h1',
          title: 'Heading 1',
          class: 'ck-heading_heading1'
        }, {
          model: 'heading2',
          view: 'h2',
          title: 'Heading 2',
          class: 'ck-heading_heading2'
        }, {
          model: 'heading3',
          view: 'h3',
          title: 'Heading 3',
          class: 'ck-heading_heading3'
        }, {
          model: 'heading4',
          view: 'h4',
          title: 'Heading 4',
          class: 'ck-heading_heading4'
        }, {
          model: 'heading5',
          view: 'h5',
          title: 'Heading 5',
          class: 'ck-heading_heading5'
        }, {
          model: 'heading6',
          view: 'h6',
          title: 'Heading 6',
          class: 'ck-heading_heading6'
        }]
      }
    };
    if (allHtmlElements.length) {
      if (!selector) {
        if (allCkEditors.length) {
          for (let i = 0; i < allCkEditors.length; ++i) {
            allCkEditors[i].destroy();
          }
        }
      }
      allCkEditors = [];
      for (let i = 0; i < allHtmlElements.length; ++i) {
        var linkUpload = allHtmlElements[i].dataset.upload ? allHtmlElements[i].dataset.upload : '';
        if (linkUpload) {
          editorConfig.simpleUpload = {
            uploadUrl: linkUpload
          };
        }
        ClassicEditor.create(allHtmlElements[i], editorConfig).then(editor => allCkEditors.push(editor)).catch(error => console.error(error));
      }
    }
    if (typeof CKEDITOR != 'undefined') {
      CKEDITOR.on('dialogDefinition', function (ev) {
        var dialogName = ev.data.name;
        var dialogDefinition = ev.data.definition;
        if (dialogName == 'link' || dialogName == 'image') {
          dialogDefinition.removeContents('Upload');
        }
      });
    }
  },
  reCreateCkEditor: function (selector, stId) {
    if (!stId || !selector) {
      return null;
    }
    var parents = $(selector).parent();
    if ($.isEmptyObject(parents)) {
      return null;
    }
    parents.empty();
    var originalURL = document.location.href, url;
    if (originalURL.indexOf('?') != -1) {
      var urlParams = new URLSearchParams(window.location.search);
      var storeId = urlParams.get('storeId');
      if (storeId) {
        var alteredURL = AppFuntions.removeParam("storeId", originalURL);
        if (alteredURL == window.location.href.split('?')[0]) {
          url = alteredURL + "?storeId=" + stId;
        } else {
          url = alteredURL + "&storeId=" + stId;
        }
        $.each(parents, function (e, p) {
          var eId = $(p).attr('id');
          if (eId) {
            $('#' + eId).load(url + ' #' + eId);
          }
        });
        setTimeout(function () {
          AppCommon.initCkeditor();
        }, 1500);
        return;
      } else {
        url = originalURL + "&storeId=" + stId;
      }
    } else {
      url = originalURL + "?storeId=" + stId;
    }
    if (url != null) {
      $.each(parents, function (e, p) {
        var eId = $(p).attr('id');
        if (eId) {
          $('#' + eId).load(url + ' #' + eId);
        }
      });
    }
    setTimeout(function () {
      AppCommon.initCkeditor();
    }, 1500);
  },
  getDataCkEditor: function (name) {
    if (name) {
      for (var i = 0; i < allCkEditors.length; i++) {
        if (allCkEditors[i].sourceElement.id === name)
          return allCkEditors[i];
      }
      return null;
    }
  },
  overLoading: function (option) {
    var block = option && option.block ? option.block : $('body');
    var bg = option && option.background ? option.background : '#000';
    var color = option && option.color ? 'style="color:' + option.color + '"' : '';
    var zIndex = option && option.zIndex ? option.zIndex : 50;
    var opacity = option && option.opacity ? option.opacity : 0.1;
    var sizeSpin = option && option.sizeSpin ? option.sizeSpin : '';
    if (option && option.display == 'hide') {
      block.find('.overLoading').remove();
      return;
    }
    var html = '<div class="overLoading" style="background: ' + bg + '; opacity: ' + opacity + '; position: absolute; z-index: ' + zIndex + '; top:0; width: 100%; height: 100%;' + ' justify-content: center; align-items: center; transition:all 300ms; visibility: hidden; font-size: 22px">';
    html += '<i class="fas fa-circle-notch fa-spin fa-lg' + sizeSpin + '" ' + color + '></i>';
    html += '</div>';
    if (block) {
      block.css({
        position: 'relative'
      });
      block.append(html);
      block.find('.overLoading').css({
        display: 'flex',
        visibility: 'visible',
        opacity: opacity
      });
    }
  },
  progressload: function (data) {
    var modalId = data.modalId ? data.modalId : '#defaultModal'
      , $modal = $('body ' + modalId)
      , current = data.current ? data.current : 0
      , rate = data.totalItem ? parseFloat(100 / data.totalItem) : 0;
    $modal.find('.modal-body').prepend('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" data-current="' + current + '" data-rate="' + rate + '" style="width:' + current + '%">' + current + '%</div></div>');
  },
  progressChange: function (data) {
    var modalId = data.modalId ? data.modalId : '#defaultModal'
      , pb = $('body ' + modalId).find('.progress-bar')
      , rate = parseFloat(pb.attr('data-rate'))
      , current = parseFloat(pb.attr('data-current'))
      , now = parseFloat(current + rate);
    pb.css({
      width: now + '%'
    });
    pb.text(now > 100 ? 100 : Math.ceil(now) + '%');
    pb.attr('data-current', now);
  },
  advanceCompactSearch: function () {
    $('.compactSearch').hide();
    $('.fFilter li').each(function () {
      if (!$(this).find('.default').length) {
        $(this).css({
          display: 'none'
        });
      }
      if ($(this).find('select').length && $(this).find('select').val()) {
        $(this).css({
          display: 'inline-block'
        });
      }
      if ($(this).find('input[type!=hidden]').length) {
        if ($(this).find('input[type!=hidden]').prop('type') == 'checkbox' && $(this).find('input[type!=hidden]').is(':checked')) {
          $(this).css({
            display: 'inline-block'
          });
        } else if ($(this).find('input[type!=hidden]').prop('type') != 'checkbox' && $(this).find('input[type!=hidden]').val()) {
          $(this).css({
            display: 'inline-block'
          });
        }
      }
    });
    $('.advanceSearch').click(function () {
      $('.fFilter li').each(function () {
        if (!$(this).find('.default').length) {
          $(this).css({
            display: 'inline-block'
          });
        }
      });
      $('.compactSearch').show();
      $('.advanceSearch').hide();
      return false;
    });
    $('.compactSearch').click(function () {
      $('.fFilter li').each(function () {
        if (!$(this).find('.default').length) {
          $(this).css({
            display: 'none'
          });
        }
        if ($(this).find('select').length && $(this).find('select').val()) {
          $(this).css({
            display: 'inline-block'
          });
        }
        if ($(this).find('input[type!=hidden]').length) {
          if ($(this).find('input[type!=hidden]').prop('type') == 'checkbox' && $(this).find('input[type!=hidden]').is(':checked')) {
            $(this).css({
              display: 'inline-block'
            });
          } else if ($(this).find('input[type!=hidden]').prop('type') != 'checkbox' && $(this).find('input[type!=hidden]').val()) {
            $(this).css({
              display: 'inline-block'
            });
          }
        }
      });
      $('.compactSearch').hide();
      $('.advanceSearch').show();
      return false;
    });
  },
  initCarousel: function () {
    var t = $('div[data-id="slideCarousel"]');
    t.carousel();
  },
  initChangeStatus: function () {
    $('.changestatus').click(function () {
      var id = $(this).attr('data-id');
      AppAjax.ajax({
        url: $(this).attr('data-link'),
        data: {
          'id': id,
          'storeId': $('#storeId').val()
        },
        type: "POST",
        success: function (rs) {
          if (rs.code) {
            window.location.reload();
          } else {
            AppModal.show({
              title: 'Lỗi',
              color: 'bg-danger pt-2 pb-2',
              content: rs.messages
            });
          }
        },
      });
    });
  },
  initExportExel: function (selector, options) {
    if (!$('#excelSettingModal').length) {
      let exportSelectorElement = selector ? selector : '#excelAll';
      $(exportSelectorElement).jsExcelExport(options);
    } else {
      let exportSelectorElement = selector ? selector : '#excelAll';
      $(exportSelectorElement).on('click', function () {
        $('#excelSettingModal').modal('show');
      });
      if ($('input[name="columnExcelOption"]:checked').val() == 'column') {
        if ($('#columnOptionArea').hasClass('d-none')) {
          $('#columnOptionArea').removeClass('d-none');
        }
      } else {
        if (!$('#columnOptionArea').hasClass('d-none')) {
          $('#columnOptionArea').addClass('d-none');
        }
      }
      $('#excelSettingModal .columnExcelOption').on('change', function () {
        let value = $(this).val();
        $('#excelSettingModal .columnExcelOption').each(function () {
          $(this).prop('checked', false);
          if ($(this).val() == value) {
            $(this).prop('checked', true);
            if (value == 'column') {
              if ($('#columnOptionArea').hasClass('d-none')) {
                $('#columnOptionArea').removeClass('d-none');
              }
            } else {
              if (!$('#columnOptionArea').hasClass('d-none')) {
                $('#columnOptionArea').addClass('d-none');
              }
            }
          }
        });
      });
      $('#excelSettingModal .excelListPage').on('change', function () {
        let value = $(this).val();
        $('#excelSettingModal .excelListPage').each(function () {
          $(this).prop('checked', false);
          if ($(this).val() == value) {
            $(this).prop('checked', true);
          }
        });
      });
      $('.columnOptionValueAll').on('change', function () {
        if ($(this).is(":checked")) {
          $('.columnOptionValue').each(function () {
            $(this).prop('checked', true);
          });
        } else {
          $('.columnOptionValue').each(function () {
            $(this).prop('checked', false);
          });
        }
      });
      $('#btnExcelExportSetting').on('click', function () {
        var optionSettings = {};
        optionSettings.forceDownload = false;
        optionSettings.exportGroupToPsParent = 0;
        var params = options.param ? options.param : {
          'format': 'jsExcel'
        };
        if ($('input[name="excelListPage"]:checked').val() == 'recordPage') {
          optionSettings.forceDownload = true;
        }
        if ($('#recordAllFullPage').is(":checked")) {
          params.typeExcel = 'full';
        } else {
          params.typeExcel = '';
        }
        if ($('input[name="excelListPage"]:checked').val() == 'recordGroupPsParent') {
          params.exportGroupToPsParent = 1;
        }
        if ($('input[name="excelListPage"]:checked').val() == 'recordSelected') {
          var ids = [];
          var elements = $('div.content .selected').find('.select-checkbox');
          if (elements) {
            elements.each(function () {
              ids.push($(this).attr('data-id'));
            });
          }
          if (!ids.length) {
            $('#excelSettingModal').modal('hide');
            AppModal.show({
              title: 'Lỗi',
              content: 'Bạn chưa chọn bản ghi để xuất excel'
            });
            return false;
          }
          params.ids = ids.join(',');
        } else {
          params.ids = '';
        }
        optionSettings.url = (typeof options.url != 'undefined' && options.url) ? options.url : '';
        optionSettings.fileName = (typeof options.fileName != 'undefined' && options.fileName) ? options.fileName : '';
        let isSaveSetting = true;
        if ($('input[name="columnExcelOption"]:checked').val() == 'fbPsid') {
          let fanpageId = $('#fanpageId').val();
          if (!fanpageId) {
            exportExcelSettingHandler.errorHandler(['Để lấy Facebook PSID bạn cần lọc 2 tiêu chí: kênh bán là "Facebook" và 1 fanpage muốn xuất dữ liệu.']);
            exportExcelSettingHandler.stop();
            return false;
          }
          optionSettings.bookType = 'csv';
          params.typeExcel = 'fbPsid';
          isSaveSetting = false;
        }
        optionSettings.param = params;
        if ($('input[name="excelListPage"]:checked').val() == 'recordAll') {
          if ($(exportSelectorElement).attr('data-sourcetotalrecords')) {
            optionSettings.totalItemCount = parseInt($(exportSelectorElement).attr('data-sourcetotalrecords'));
          }
          if ($(exportSelectorElement).attr('data-pageexcellimitnumber')) {
            optionSettings.countNumberLimit = parseInt($(exportSelectorElement).attr('data-pageexcellimitnumber'));
          }
        }
        let allowColumns = [];
        let contents = {};
        contents.excelListPage = $('input[name="excelListPage"]:checked').val();
        if ($('input[name="columnExcelOption"]:checked').val() == 'column') {
          $('.columnOptionValue').each(function () {
            if ($(this).is(":checked")) {
              allowColumns.push($(this).val());
            }
          });
          if (allowColumns) {
            optionSettings.allowColumns = allowColumns;
            if (allowColumns && $('input[name="columnExcelOption"]:checked').val() == 'column') {
              contents.column = allowColumns;
            } else {
              contents.column = 'all';
            }
          }
        }
        let typeExport = $('#exportSetting').attr('data-type');
        if (typeExport && $('input[name="rembExcelSetting"]:checked').val() && allowColumns && isSaveSetting) {
          AppAjax.post('/setting/store/exportexcel', {
            content: JSON.stringify(contents),
            type: $('#exportSetting').attr('data-type'),
            storeId: $('#storeId').val(),
          }, function (rs) { });
        }
        exportExcelSettingHandler.init(optionSettings);
      });
      $('#btnCloseExportExcel').on('click', function () {
        exportExcelSettingHandler.stop();
      });
    }
  },
  submitFilter: function () {
    $('.form-filter .submitFilterBtn, .form-app button[type="submit"]').on('click', function () {
      var form = $(this).parents('.form-filter,.form-app');
      $(form).submit();
    });
    $('.form-filter, .form-app').each(function () {
      $(this).submit(function () {
        var fArr = this.elements;
        for (var i = 0; i < fArr.length; i++) {
          if (fArr[i].value === '') {
            fArr[i].disabled = true;
          }
        }
      });
    });
  },
  copyText: function () {
    $('body').on('click', '.click-copy-data', function (e) {
      let copyText = $(this).attr('data-copy-value') ? $(this).attr('data-copy-value') : $(this).text();
      navigator.clipboard.writeText(copyText).then(function () {
        new PNotify({
          title: '<i class="far fa-check"></i>  Thông báo',
          text: 'Đã copy: ' + copyText,
          type: 'success'
        });
      });
    });
  },
  calNumericalOrder: function (selector, find = '.numerical') {
    if (!selector)
      return;
    let numerical = 0;
    $(selector).each(function () {
      numerical++;
      $(this).find(find).text(numerical);
    });
  },
  handlerGroupTags() {
    let boxLbl = $('#boxLabels')
      , tagCount = boxLbl.find('.tagCount')
      , typeLabel = parseInt(boxLbl.attr('data-type'))
      , isQuick = parseInt(boxLbl.attr('data-handler-quick'))
      , storeIdData = boxLbl.attr('data-storeId') ? parseInt(boxLbl.attr('data-storeId')) : null
      , eltTagIds = boxLbl.find('#tagIds')
      , tagIdActive = eltTagIds.val() ? JSON.parse(eltTagIds.val()) : []
      , box = $('.btnGroupTags')
      , result = $('body #resultGroupTags')
      , dropTags = box.find('.dropTags')
      , tagsJson = {}
      , isLoadJson = false
      , isSubmit = false
      , storeId = $('#storeId').val();
    const loadTags = (storeId) => {
      AppCommon.handlerLoadTagsName({
        storeId: storeId,
        type: typeLabel,
        fn: r => {
          dropTags.empty();
          isLoadJson = true;
          $.each(r, (k, tag) => {
            tagsJson[tag.id] = tag;
            if (dropTags.length) {
              const c = tagIdActive.includes(parseInt(tag.id)) ? 'active' : '';
              dropTags.append(`<a href="javascript:;" class="dropdown-item ${c}" data-id="${tag.id}"><i class="far fa-square mr-1"></i> <span>${tag.name}</span></a>`);
            }
          }
          );
          const s = $('select#tagIds');
          if (s.length) {
            s.empty();
            $.each(r, (k, tag) => s.append(`<option value="${tag.id}">${tag.name}</option>`));
            if (tagIdActive) {
              s.val(tagIdActive);
            }
            s.trigger('select2');
          }
        }
      });
    }
      ;
    if (storeId && typeLabel) {
      loadTags(storeId);
    }
    const getUrlHandler = (t) => {
      return t === appConsts.store.tagItems.TYPE_ORDER ? '/order/manage/detail' : t === appConsts.store.tagItems.TYPE_CUSTOMER ? '/customer/code/details' : t === appConsts.store.tagItems.TYPE_BILL_INVENTORY ? "/inventory/bill/detail" : t === appConsts.store.tagItems.TYPE_BILL_REQUIREMENT ? "/inventory/requirement/billdetail" : t === appConsts.store.tagItems.TYPE_BILL_RETAIL ? '/pos/bill/detail' : t === appConsts.store.tagItems.TYPE_BILL_RETAIL_REQUIREMENT ? "/inventory/requirement/billdetail" : t === appConsts.store.tagItems.TYPE_POS_PRODUCT ? "/product/item/detail" : '';
    }
      ;
    $(document).on('change', '#storeId', function () {
      storeId = $(this).val();
      if (typeLabel) {
        loadTags(storeId);
      }
    });
    box.on('click', '.dropdown-menu', function (e) {
      e.preventDefault();
      e.stopPropagation();
      return false;
    });
    box.on('click', '.dropdown-item', function (e) {
      $(this).toggleClass('active');
    });
    box.on('keyup', '.has-search input', function () {
      let t = $(this)
        , key = t.val() ? t.val().toLowerCase() : '';
      if (!key) {
        box.find('.dropdown-item').removeClass('d-none');
        return false;
      }
      box.find('.dropdown-item').each(function () {
        if ($(this).text().toLowerCase().includes(key)) {
          $(this).removeClass('d-none');
        } else {
          $(this).addClass('d-none');
        }
      });
    });
    box.on('click', '.btn-tag-check-all', function (e) {
      e.preventDefault();
      const t = $(this)
        , items = dropTags.find('.dropdown-item').not('.d-none');
      if (t.hasClass('active')) {
        t.removeClass('active');
        items.removeClass('active');
      } else {
        t.addClass('active');
        items.addClass('active');
      }
    });
    box.on('click', '.btn-tag-open', function (e) {
      e.preventDefault();
      const w = boxLbl.width();
      box.find('.dropdown-menu').css({
        width: `${w}px`,
        'min-width': 'auto'
      });
      if (!isLoadJson || !tagsJson) {
        loadTags(storeId ? storeId : storeIdData);
      }
    });
    box.on('click', '.btn-tag-close', function (e) {
      box.find('.dropdown-menu').removeClass('show');
      box.find('.btnGroupTags').removeClass('show');
    });
    box.on('click', '.btn-tag-save', function (e) {
      let t = $(e.currentTarget)
        , tIds = []
        , html = '';
      dropTags.find('.dropdown-item.active').each(function () {
        const tId = parseInt($(this).attr('data-id'))
          , tag = tagsJson[tId] ?? null;
        if (tId)
          tIds.push(tId);
        if (tag) {
          html += `<span data-id="${tag.id}" style="background-color: ${tag.bgColor}; color:${tag.textColor}" class="badge mr-1 mb-1">${tag.name}`;
          html += `<a href="javascript:void(0)" data-id="${tag.id}" class="text-danger ml-2 far fa-times removeTag"></a>`;
          html += `</span>`;
        }
      });
      if (tagCount.length) {
        tagCount.removeClass('d-none').text(tIds.length);
      }
      eltTagIds.val(JSON.stringify(tIds));
      if (!isQuick) {
        box.find('.dropdown-menu').removeClass('show');
        box.find('.btnGroupTags').removeClass('show');
        result.html(html).addClass('card-body');
        return true;
      }
      let isPost = false
        , f = {
          tab: 'addtag',
          type: typeLabel,
          tagIds: tIds,
          storeId: t.attr('data-storeId'),
          itemId: t.attr('data-itemId')
        };
      if (!isPost) {
        isPost = true;
        AppCommon.overLoading({
          zIndex: 99999
        });
        AppAjax.post(getUrlHandler(typeLabel), f, a => {
          isPost = false;
          box.find('.dropdown-menu').removeClass('show');
          box.find('.btnGroupTags').removeClass('show');
          if (a.data) {
            result.empty();
            $.each(a.data, (k, t) => {
              result.append(`<span data-id="${t.id}"  style="background-color: ${t.bgColor}; color:${t.textColor}" class="badge mr-1 mb-1">${t.name}
                                    <a href="javascript:void(0)" data-id="${t.id}" data-storeId="${f.storeId}" data-itemId="${f.itemId}" data-type="${t.typeTagItem}" class="text-danger ml-2 far fa-times removeTag"></a></span>`);
            }
            );
          }
          AppCommon.overLoading({
            display: 'hide'
          });
          PNotify.removeAll();
          new PNotify({
            title: a.code ? 'Thông báo' : 'Lỗi',
            text: a.messages,
            type: a.code ? 'success' : 'error'
          });
        }
        );
      }
    });
    $(document).on('click', 'body #resultGroupTags .removeTag', function () {
      const reLoadList = () => {
        let a = [];
        dropTags.find(`.dropdown-item`).removeClass("active");
        result.find(".badge .removeTag").each(function () {
          const b = parseInt($(this).attr("data-id"));
          dropTags.find(`.dropdown-item[data-id="${b}"]`).addClass("active");
          a.push(b);
        });
        a = JSON.stringify(a);
        eltTagIds.val(a);
        tagIdActive = a;
      }
        ;
      const t = $(this)
        , ti = parseInt(t.attr("data-type"))
        , f = {
          tab: "removetag",
          type: ti,
          tagId: t.attr("data-id"),
          storeId: t.attr("data-storeId"),
          itemId: t.attr("data-itemId")
        };
      if (!isQuick) {
        t.parent("span").remove();
        reLoadList();
        return !0;
      }
      t.addClass('disable');
      AppAjax.post(getUrlHandler(ti), f, b => {
        t.removeClass('disable');
        if (b.code) {
          t.parent("span").remove();
          reLoadList();
        } else {
          new PNotify({
            title: appTranslator.labels.error,
            text: b.messages
          });
        }
      }
      );
    });
    $(document).on("click", ".lRemoveTag", function () {
      let d = $(this)
        , e = parseInt(d.data("type"))
        , k = {
          tab: "removetag",
          type: e,
          tagId: d.data("id"),
          storeId: d.data("storeid"),
          itemId: d.data("itemid")
        };
      d.parent('span').addClass('disable');
      if (!isSubmit) {
        isSubmit = !0;
        d.parent('span').removeClass('disable');
        AppAjax.post(getUrlHandler(e), k, b => (isSubmit = !1,
          PNotify.removeAll(),
          new PNotify({
            text: b.messages,
            type: b.code ? 'success' : 'error'
          }),
          b.code ? d.closest("span").remove() : ''));
      }
    });
    let labelIsSubmit = !1;
    $(document).on("click", "#assignLabelMultiple", function () {
      let t = $(this)
        , storeId = $('#storeId').val()
        , type = parseInt(t.attr('data-type'))
        , excludeModes = t.attr('data-exclude-mode') ? t.attr('data-exclude-mode') : {}
        , excludeModeDesc = t.attr('data-exclude-mode-desc') ? t.attr('data-exclude-mode-desc') : ''
        , actName = 'gắn';
      if (!$('body .dataTable .row-item.selected').length) {
        let mssError = type === appConsts.store.tagItems.TYPE_ORDER ? 'Đơn hàng' : type === appConsts.store.tagItems.TYPE_CUSTOMER ? 'Khách hàng' : type === appConsts.store.tagItems.TYPE_BILL_RETAIL ? 'Phiếu bán hàng' : type === appConsts.store.tagItems.TYPE_BILL_RETAIL_REQUIREMENT ? 'Phiếu nháp bán hàng' : type === appConsts.store.tagItems.TYPE_BILL_INVENTORY ? 'Phiếu XNK' : type === appConsts.store.tagItems.TYPE_BILL_REQUIREMENT ? 'Phiếu nháp XNK' : type === appConsts.store.tagItems.TYPE_POS_PRODUCT ? 'Sản phẩm' : '';
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: `Chưa có ${mssError} nào được chọn.`
        });
        return !1;
      }
      if (!storeId) {
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: 'Bạn chưa chọn doanh nghiệp.'
        });
        return !1;
      }
      if (labelIsSubmit) {
        return !1;
      }
      AppModal.show({
        modalId: 'assignLabelModal',
        title: `Gắn nhãn danh sách đã chọn`,
        content: `<div id="msgErrorAssignLabel">Đang tải dữ liệu mhãn <i class="fa fa-spin fa-spinner"></i></div>
                          <div class="form-group row mb-0"></div>
                         <input type="hidden" id="typeAssignLabel" value="${type}"/>`,
        buttons: {
          0: `<button type="button" class="btn btn-success" id='btnAssignLabel'>Gắn nhãn</button>`,
          1: `<button type="button" class="btn btn-light" id="btnCloseAssignLabel" data-dismiss='modal'>Đóng</button>`,
        },
      });
      let itemIds = []
        , checkTypes = {}
        , newType = type
        , msg = $('#msgErrorAssignLabel')
        , btnAssign = $('body #assignLabelModal #btnAssignLabel')
        , isValidMode = true;
      btnAssign.removeClass('d-none');
      $.each($('.dataTable .row-item.selected'), function () {
        const t = $(this)
          , id = parseInt(t.attr('data-id'))
          , type = t.attr('data-type-label')
          , mode = t.attr('data-mode');
        if (excludeModes.length && excludeModes.includes(mode)) {
          isValidMode = false;
          return false;
        }
        if (type) {
          newType = parseInt(type);
          checkTypes[type] = type;
        }
        itemIds.push(id);
      });
      let ckTypeLength = Object.keys(checkTypes).length;
      if (!isValidMode) {
        return msg.html(excludeModeDesc ? excludeModeDesc : 'Loại phiếu không hỗ trợ thao tác nhẫn').addClass('alert alert-danger');
      }
      if (ckTypeLength > 1) {
        btnAssign.addClass('d-none');
        if ([appConsts.store.tagItems.TYPE_BILL_INVENTORY, appConsts.store.tagItems.TYPE_BILL_RETAIL].includes(newType)) {
          return msg.html(`Không được ${actName} nhãn giống nhau cho 2 loại hóa đơn bán hàng và XNK`).addClass('alert alert-danger');
        }
        return msg.html(`Hệ thống chỉ hỗ trợ ${actName} 1 loại nhãn cho các dòng dữ liệu đã chọn`).addClass('alert alert-danger');
      }
      if (!storeId) {
        return msg.html('Bạn chưa chọn doanh nghiệp').addClass('alert alert-danger');
      }
      if (!itemIds.length) {
        return msg.html('Chưa có đơn hàng nào được chọn').addClass('alert alert-danger');
      }
      msg.html('').removeClass('alert alert-danger');
      AppCommon.handlerLoadTagsName({
        storeId: storeId,
        type: newType,
        fn: rData => {
          let m = $('body #assignLabelModal')
            , opts = '';
          if (!rData) {
            m.find('#msgErrorAssignLabel').html('<div class="alert alert-warning">Không tìm thấy danh sách nhãn!</div>');
            m.find('#btnAssignLabel').hide();
          } else {
            m.find('#btnAssignLabel').show();
            $.each(rData, (k, tag) => {
              opts += `<option value="${tag.id}">${tag.name}</option>`;
            }
            );
            m.find('#msgErrorAssignLabel').html('');
            m.find('.form-group').html(`
                            <label class="col-3" for="assignTagIds">Chọn nhãn:</label>
                            <div class="col-9">
                                <select id="assignLabelIds" class="form-control selectMultipleCheckbox" data-title="Nhãn" style="width: 100% !important;" multiple>${opts}</select>
                            </div>
                        `);
            let select = m.find('#assignLabelIds');
            select.select2MultiCheckboxes({
              wrapClass: 'wrapSelect',
              minimumResultsForSearch: 1,
              searchMatchOptGroups: true,
              selectAll: !select.hasClass('notCheckAll'),
              templateSelection: function (selected) {
                if (selected.length > 0) {
                  return selected.length === 1 ? select.find('option:selected').text() : "Đã chọn " + selected.length;
                }
                return 'Nhãn';
              },
            });
          }
        }
      });
      $(document).on('click', '#btnAssignLabel', function () {
        let btn = $(this)
          , assignLabelIds = $('body #assignLabelIds').val();
        btn.attr('disabled', true);
        if (!assignLabelIds) {
          return msg.html(`Bạn chưa chọn nhãn cần ${actName} cho đơn hàng`).addClass('alert alert-danger');
        }
        btnAssign.removeClass('d-none');
        if (!labelIsSubmit) {
          labelIsSubmit = !0;
          let dataPost = {
            tab: 'assignTags',
            storeId: storeId,
            itemIds: itemIds,
            tagIds: assignLabelIds,
            type: newType,
          }
            , l = newType === appConsts.store.tagItems.TYPE_CUSTOMER ? "/customer/code/customerlist" : newType === appConsts.store.tagItems.TYPE_BILL_RETAIL ? "/pos/bill/index" : newType === appConsts.store.tagItems.TYPE_BILL_RETAIL_REQUIREMENT ? "/inventory/requirement/bill" : newType === appConsts.store.tagItems.TYPE_BILL_INVENTORY ? "/inventory/bill/index" : newType === appConsts.store.tagItems.TYPE_BILL_REQUIREMENT ? "/inventory/requirement/bill" : newType === appConsts.store.tagItems.TYPE_POS_PRODUCT ? "/product/item/index" : '';
          AppAjax.post(l, dataPost, rs => {
            labelIsSubmit = !1;
            btn.attr('disabled', !1);
            btn.hide();
            if (!rs.code) {
              btnAssign.addClass('d-none');
              msg.html('<p class="alert alert-danger">' + rs.messages + '</p>');
              return !1;
            }
            msg.html('<p class="alert alert-success">' + rs.messages + '</p>');
            setTimeout(() => window.location.reload(), 1500);
          }
          );
        }
      });
    });
    $(document).on("click", "#removeAssignLabelMultiple", function () {
      let t = $(this)
        , storeId = $('#storeId').val()
        , type = parseInt(t.attr('data-type'))
        , actName = 'gỡ';
      if (!$('body .dataTable .row-item.selected').length) {
        let mssError = type === appConsts.store.tagItems.TYPE_ORDER ? 'Đơn hàng' : type === appConsts.store.tagItems.TYPE_CUSTOMER ? 'Khách hàng' : type === appConsts.store.tagItems.TYPE_BILL_RETAIL ? 'Phiếu bán hàng' : type === appConsts.store.tagItems.TYPE_BILL_RETAIL_REQUIREMENT ? 'Phiếu nháp bán hàng' : type === appConsts.store.tagItems.TYPE_BILL_INVENTORY ? 'Phiếu XNK' : type === appConsts.store.tagItems.TYPE_BILL_REQUIREMENT ? 'Phiếu nháp XNK' : type === appConsts.store.tagItems.TYPE_POS_PRODUCT ? 'Sản phẩm' : '';
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: `Chưa có ${mssError} nào được chọn.`
        });
        return !1;
      }
      if (!storeId) {
        AppModal.show({
          title: 'Lỗi',
          classTitle: 'text-danger',
          content: 'Bạn chưa chọn doanh nghiệp.'
        });
        return !1;
      }
      if (labelIsSubmit) {
        return !1;
      }
      AppModal.show({
        modalId: 'removeAssLabelModal',
        title: `Gỡ nhãn danh sách đã chọn`,
        content: `<div id="msgErrorRemoveAssLabel">Đang tải dữ liệu mhãn <i class="fa fa-spin fa-spinner"></i></div>
                          <div class="form-group row mb-0"></div>
                         <input type="hidden" id="typeRemoveAssLabel" value="${type}"/>`,
        buttons: {
          0: `<button type="button" class="btn btn-success" id='btnRemoveAssLabel'>Gỡ nhãn</button>`,
          1: `<button type="button" class="btn btn-light" id="btnCloseRemoveAssLabel" data-dismiss='modal'>Đóng</button>`,
        },
      });
      let itemIds = []
        , checkTypes = {}
        , newType = type
        , msg = $('#msgErrorRemoveAssLabel')
        , btnAssign = $('body #removeAssLabelModal #btnRemoveAssLabel')
        , checkListItems = $('.dataTable .row-item.selected');
      btnAssign.removeClass('d-none');
      $.each(checkListItems, function () {
        const t = $(this);
        itemIds.push(parseInt(t.attr('data-id')));
        if (t.attr('data-type-label')) {
          newType = parseInt(t.attr('data-type-label'));
          checkTypes[t.attr('data-type-label')] = t.attr('data-type-label');
        }
      });
      let ckTypeLength = Object.keys(checkTypes).length;
      if (ckTypeLength > 1) {
        btnAssign.addClass('d-none');
        if ([appConsts.store.tagItems.TYPE_BILL_INVENTORY, appConsts.store.tagItems.TYPE_BILL_RETAIL].includes(newType)) {
          return msg.html(`Không được ${actName} nhãn giống nhau cho 2 loại hóa đơn bán hàng và XNK`).addClass('alert alert-danger');
        }
        return msg.html(`Hệ thống chỉ hỗ trợ ${actName} 1 loại nhãn cho các dòng dữ liệu đã chọn`).addClass('alert alert-danger');
      }
      if (!storeId) {
        return msg.html('Bạn chưa chọn doanh nghiệp').addClass('alert alert-danger');
      }
      if (!itemIds.length) {
        return msg.html('Chưa có đơn hàng nào được chọn').addClass('alert alert-danger');
      }
      msg.html('').removeClass('alert alert-danger');
      let opts = ''
        , tagNames = []
        , tagGroupByItem = [];
      $.each(checkListItems, function () {
        $.each($(this).find('.lRemoveTag'), function () {
          let t = $(this)
            , tId = t.attr('data-id');
          if (typeof tagNames[tId] == "undefined") {
            tagNames[tId] = tId;
            opts += `<option value="${tId}">${t.parents('.badge').text()}</option>`;
          }
          if (typeof tagGroupByItem[tId] == "undefined") {
            tagGroupByItem[tId] = [];
          }
          tagGroupByItem[tId].push(t.attr('data-itemid'));
        });
      });
      let m = $('body #removeAssLabelModal');
      if (!tagNames.length) {
        m.find('#msgErrorRemoveAssLabel').html('<div class="alert alert-warning">Không tìm thấy danh sách nhãn cần gỡ!</div>');
        m.find('#btnRemoveAssLabel').hide();
      } else {
        m.find('#btnRemoveAssLabel').show();
        m.find('#msgErrorRemoveAssLabel').html('');
        m.find('.form-group').html(`
                    <label class="col-3" for="assignTagIds">Chọn nhãn:</label>
                    <div class="col-9">
                        <select id="removeAssLabelIds" class="form-control selectMultipleCheckbox" data-title="Nhãn" style="width: 100% !important;" multiple>${opts}</select>
                    </div>
                `);
        let select = m.find('#removeAssLabelIds');
        select.select2MultiCheckboxes({
          wrapClass: 'wrapSelect',
          minimumResultsForSearch: 1,
          searchMatchOptGroups: true,
          selectAll: !select.hasClass('notCheckAll'),
          templateSelection: function (selected) {
            if (selected.length > 0) {
              return selected.length === 1 ? select.find('option:selected').text() : "Đã chọn " + selected.length;
            }
            return 'Nhãn';
          },
        });
      }
      $(document).on('click', '#btnRemoveAssLabel', function () {
        let btn = $(this)
          , tagIds = $('body #removeAssLabelIds').val();
        btn.attr('disabled', true);
        if (!tagIds) {
          return msg.html(`Bạn chưa chọn nhãn cần ${actName} cho đơn hàng`).addClass('alert alert-danger');
        }
        let removeItemIds = [];
        $.each(tagIds, (k, tId) => {
          if (tagGroupByItem[tId] !== undefined) {
            $.each(tagGroupByItem[tId], (iK, iId) => !removeItemIds.includes(iId) ? removeItemIds.push(iId) : '');
          }
        }
        );
        btnAssign.removeClass('d-none');
        if (!labelIsSubmit) {
          labelIsSubmit = !0;
          let dataPost = {
            tab: 'removeAssignTags',
            storeId: storeId,
            itemIds: removeItemIds,
            tagIds: tagIds,
            type: newType,
          }
            , l = newType === appConsts.store.tagItems.TYPE_CUSTOMER ? "/customer/code/customerlist" : newType === appConsts.store.tagItems.TYPE_BILL_RETAIL ? "/pos/bill/index" : newType === appConsts.store.tagItems.TYPE_BILL_RETAIL_REQUIREMENT ? "/inventory/requirement/bill" : newType === appConsts.store.tagItems.TYPE_BILL_INVENTORY ? "/inventory/bill/index" : newType === appConsts.store.tagItems.TYPE_BILL_REQUIREMENT ? "/inventory/requirement/bill" : newType === appConsts.store.tagItems.TYPE_POS_PRODUCT ? "/product/item/index" : '';
          AppAjax.post(l, dataPost, rs => {
            labelIsSubmit = !1;
            btn.attr('disabled', !1);
            btn.hide();
            if (!rs.code) {
              btnAssign.addClass('d-none');
              msg.html('<p class="alert alert-danger">' + rs.messages + '</p>');
              return !1;
            }
            msg.html('<p class="alert alert-success">' + rs.messages + '</p>');
            setTimeout(() => window.location.reload(), 1500);
          }
          );
        }
      });
    });
    (() => {
      return {
        LABEL_STATUS_ACTIVE: 1,
        LABEL_STATUS_IN_ACTIVE: 2,
        storeId: $('#storeId').val(),
        modal: null,
        tfoot: null,
        init() {
          $(document).on('change', '#storeId', e => this.storeId = $(e.currentTarget).val());
          const userSelection = Object.values(document.getElementsByClassName('cardAddLFastLabel'));
          userSelection.forEach(link => {
            link.addEventListener("click", e => this.showModal($(e.currentTarget)));
          }
          );
          $(document).on('click', '#boxSelectLabels .quickAddLabel, #boxLabels .quickAddLabel', e => this.showModal($(e.currentTarget)));
          $(document).on('click', '#modalFastAddLabel .fastPicker', (e) => $(e.currentTarget).siblings('.changeColor').focus());
          $(document).on('keypress, keyup', '#modalFastAddLabel .fastItemName', (e) => this.preview($(e.currentTarget).parents('.fastTr')));
          $(document).on('click', '#modalFastAddLabel .fastItemStatus .dropdown-item', (e) => this.dropRenderStatus($(e.currentTarget)));
          $(document).on('click', '#modalFastAddLabel .fastNewRow', () => this.appendRow());
          $(document).on('click', '#modalFastAddLabel .fastItemSave', (e) => {
            e.preventDefault();
            this.saveTagName($(e.currentTarget));
          }
          );
          $(document).on('click', '#modalFastAddLabel .fastItemUpdate', (e) => {
            e.preventDefault();
            this.updateTagName($(e.currentTarget));
          }
          );
          $(document).on('click', '#modalFastAddLabel .fastItemDelete', (e) => {
            e.preventDefault();
            this.deleteTagName($(e.currentTarget).parents('.fastTr'));
          }
          );
          $(document).on('click', '#modalFastAddLabel .fastItemEdit', (e) => this.renderEdit($(e.currentTarget).parents('.fastTr')));
          $(document).on('click', '#modalFastAddLabel .fastItemRemove', (e) => $(e.currentTarget).parents('.fastTr').remove());
          $(document).on('click', '#modalFastAddLabel .fastChangeStatus', e => this.changSttTagName($(e.currentTarget)));
        },
        saveTagName(t) {
          let p = t.parents('.fastTr')
            , fastName = p.find('.fastItemName')
            , type = parseInt(t.parents('.fastLabelsList').attr('data-type'))
            , dataPost = {
              storeId: $('#storeId').val(),
              name: fastName.val().trim(),
              status: parseInt(p.find('.fastItemStatus').attr('data-status')),
              type: this.getTypeTag(type),
              configs: JSON.stringify({
                bgColor: p.find('.fastItemBg').val(),
                textColor: p.find('.fastItemColor').val()
              }),
              tab: type === appConsts.store.tagItems.TYPE_ORDER ? 'orderAddTag' : 'add'
            };
          if (!dataPost.type) {
            return this.showError('Dữ liệu không hợp lệ!');
          }
          fastName.removeClass('border-danger');
          if (!fastName) {
            fastName.addClass('border-danger').focus();
            return false;
          }
          if (dataPost.name.length < 3) {
            this.showError('Tên nhãn quá ngắn');
            fastName.addClass('border-danger').focus();
            return false;
          }
          t.prop('disabled', true);
          AppAjax.post('/setting/store/labels', dataPost, rs => {
            t.prop('disabled', false);
            if (rs.code > 0) {
              this.render(rs.data);
              p.remove();
            } else {
              this.showError(rs.messages);
            }
          }
          );
        },
        updateTagName(t) {
          let fastTr = t.parents('.fastTr')
            , tdEdit = t.parents('.tdEdit')
            , fastName = tdEdit.find('.fastItemName')
            , type = parseInt(t.parents('.fastLabelsList').attr('data-type'))
            , dataPost = {
              storeId: $('#storeId').val(),
              id: fastTr.attr('data-id'),
              name: fastName.val().trim(),
              status: parseInt(tdEdit.find('.fastItemStatus').attr('data-status')),
              type: this.getTypeTag(type),
              configs: JSON.stringify({
                bgColor: tdEdit.find('.fastItemBg').val(),
                textColor: tdEdit.find('.fastItemColor').val()
              }),
              tab: type === appConsts.store.tagItems.TYPE_ORDER ? 'orderEditTag' : 'edit'
            };
          if (!dataPost.type) {
            return this.showError('Dữ liệu không hợp lệ!');
          }
          fastName.removeClass('border-danger');
          if (!fastName) {
            fastName.addClass('border-danger').focus();
            return false;
          }
          if (dataPost.name.length < 3) {
            this.showError('Tên nhãn quá ngắn');
            fastName.addClass('border-danger').focus();
            return false;
          }
          t.prop('disabled', true);
          AppAjax.post('/setting/store/labels', dataPost, rs => {
            t.prop('disabled', false);
            if (rs.code > 0) {
              const tempUpdate = this.render(rs.data, false, true);
              fastTr.attr('data-bgcolor', rs.data.bgColor);
              fastTr.attr('data-textcolor', rs.data.textColor);
              fastTr.attr('data-name', rs.data.name);
              fastTr.attr('data-status', rs.data.status);
              fastTr.html(tempUpdate);
            } else {
              this.showError(rs.messages);
            }
          }
          );
        },
        deleteTagName(fastTr) {
          if (!confirm('Bạn có chắc chắn muốn xóa nhãn này ?')) {
            return false;
          }
          let type = parseInt(fastTr.parents('.fastLabelsList').attr('data-type'))
            , dataPost = {
              storeId: this.storeId,
              id: fastTr.attr('data-id'),
              tab: type === appConsts.store.tagItems.TYPE_ORDER ? 'orderDeleteTag' : 'delete'
            };
          if (!type) {
            return this.showError('Dữ liệu không hợp lệ!');
          }
          AppAjax.post('/setting/store/labels', dataPost, rs => {
            if (rs.code) {
              this.showSuccess(`Xóa nhãn <b>${fastTr.attr('data-name')}</b> thành công`);
              fastTr.remove();
            } else {
              this.showError(rs.messages);
            }
          }
          );
        },
        changSttTagName(item) {
          PNotify.removeAll();
          let fastTr = item.parents('.fastTr')
            , type = parseInt(fastTr.parents('.fastLabelsList').attr('data-type'))
            , dataPost = {
              tab: 'changeStatusTag',
              storeId: this.storeId,
              type: this.getTypeTag(type),
              id: fastTr.attr('data-id'),
            };
          if (!dataPost.type) {
            return this.showError('Dữ liệu không hợp lệ!');
          }
          AppAjax.post('/setting/store/labels', dataPost, rs => {
            if (!rs.code) {
              this.showError(rs.messages);
            } else {
              fastTr.attr('data-status', parseInt(rs.data.status));
              if (parseInt(rs.data.status) === this.LABEL_STATUS_ACTIVE) {
                item.removeClass('fa-minus-circle text-danger').addClass('fa-check text-success');
                item.attr('title', 'Hoạt động').attr('data-original-title', 'Hoạt động');
              } else {
                item.removeClass('fa-check text-success').addClass('fa-minus-circle text-danger');
                item.attr('title', 'Ẩn').attr('data-original-title', 'Ẩn');
              }
            }
          }
          );
        },
        getTypeTag(typeTagItem = null) {
          const types = {
            [appConsts.store.tagItems.TYPE_PRODUCT]: appConsts.store.tags.TYPE_PRODUCT,
            [appConsts.store.tagItems.TYPE_ARTICLE]: appConsts.store.tags.TYPE_PRODUCT,
            [appConsts.store.tagItems.TYPE_ANNOUNCEMENT]: appConsts.store.tags.TYPE_PRODUCT,
            [appConsts.store.tagItems.TYPE_MANUAL]: appConsts.store.tags.TYPE_PRODUCT,
            [appConsts.store.tagItems.TYPE_STORE_PRODUCT_CATEGORY]: appConsts.store.tags.TYPE_PRODUCT,
            [appConsts.store.tagItems.TYPE_CUSTOMER]: appConsts.store.tags.TYPE_CUSTOMER,
            [appConsts.store.tagItems.TYPE_BILL_RETAIL]: appConsts.store.tags.TYPE_BILL_RETAIL,
            [appConsts.store.tagItems.TYPE_BILL_INVENTORY]: appConsts.store.tags.TYPE_BILL_INVENTORY,
            [appConsts.store.tagItems.TYPE_BILL_REQUIREMENT]: appConsts.store.tags.TYPE_BILL_INVENTORY,
            [appConsts.store.tagItems.TYPE_ORDER]: appConsts.store.tags.TYPE_ORDER,
            [appConsts.store.tagItems.TYPE_BILL_RETAIL_REQUIREMENT]: appConsts.store.tags.TYPE_BILL_RETAIL,
            [appConsts.store.tagItems.TYPE_POS_PRODUCT]: appConsts.store.tags.TYPE_POS_PRODUCT,
          };
          return typeof types[typeTagItem] != "undefined" ? types[typeTagItem] : null;
        },
        showModal(elt) {
          if (!this.storeId) {
            AppModal.show({
              title: 'Lỗi',
              content: 'Bạn chưa chọn Doanh Nghiệp!'
            });
            return false;
          }
          let typeItem = null
            , eltParent = null;
          if (elt.parents('#boxSelectLabels').length) {
            eltParent = elt.parents('#boxSelectLabels');
            typeItem = eltParent.attr('data-type');
          } else if (elt.parents('#boxLabels').length) {
            eltParent = elt.parents('#boxLabels');
            typeItem = eltParent.attr('data-type');
          }
          if (!typeItem) {
            AppModal.show({
              title: 'Lỗi',
              content: 'Dữ liệu không hợp lệ!',
            });
            return false;
          }
          let modalTile = 'Thêm nhanh nhãn ';
          switch (this.getTypeTag(typeItem)) {
            case appConsts.store.tags.TYPE_CUSTOMER:
              modalTile += 'khách hàng';
              break;
            case appConsts.store.tags.TYPE_BILL_RETAIL:
              modalTile += 'hóa đơn bán hàng';
              break;
            case appConsts.store.tags.TYPE_BILL_INVENTORY:
              modalTile += 'hóa đơn XNK';
              break;
            case appConsts.store.tags.TYPE_ORDER:
              modalTile += 'đơn hàng';
              break;
            case appConsts.store.tags.TYPE_POS_PRODUCT:
              modalTile += 'sản phẩm';
              break;
            default:
              break;
          }
          let html = ` 
                <div class="fastLabelsList" data-type="${typeItem}">
                    <div class="thead d-flex justify-content-between">
                        <div class="th w-50">Tên Nhãn</div>
                        <div class="th w-25 text-center">Trạng thái</div>
                        <div class="th w-25 text-center">Thao tác</div>
                    </div>
                    <div class="tbody scrollBody d-block" data-last-scroll="0" data-scroll-down="0" data-page="0" data-type="${typeItem}"></div>
                    <div class="tfoot"><div class="fastTr"><button class="btn fastNewRow"><i class="fa fa-plus mr-1"></i> Thêm mới</button></div></div>
                </div>`;
          AppModal.show({
            modalId: 'modalFastAddLabel',
            title: modalTile,
            size: 'modal-lg',
            content: html,
            closeHandler: () => {
              eltTagIds = eltParent.find('#tagIds');
              const eltIds = eltTagIds.val();
              if (typeof eltIds == "string" && eltIds) {
                tagIdActive = JSON.parse(eltIds);
              } else {
                tagIdActive = eltIds;
              }
              loadTags(this.storeId);
            }
          });
          this.modal = $('body #modalFastAddLabel');
          this.tfoot = this.modal.find('.tfoot');
          this.appendRow();
        },
        appendRow() {
          this.tfoot.prepend(this.temp());
          this.fastInitPicker();
        },
        fastInitPicker() {
          this.modal.find('.changeColor').colorpicker().on('change', (e) => this.preview($(e.currentTarget).parents('.fastTr')));
        },
        dropRenderStatus(t) {
          const p = t.parents('.fastItemStatus')
            , v = parseInt(t.attr('data-value'));
          p.attr('data-status', v);
          p.find('.input-group-text').html(`<i class="far ${v === 1 ? 'fa-check text-success' : 'fa-minus-circle text-danger'}"></i>`);
        },
        preview(rowPrv) {
          let css = {}
            , txt = rowPrv.find('.fastItemName').val()
            , bg = rowPrv.find('.fastItemBg').val()
            , color = rowPrv.find('.fastItemColor').val()
            , preview = rowPrv.find('.fastPreview');
          if (bg) {
            css.background = bg;
          }
          if (color) {
            css.color = color;
          }
          preview.text(txt ? txt : 'Tên nhãn').css(css);
        },
        showError(messages) {
          PNotify.removeAll();
          const notifyItem = new PNotify({
            title: '<b>Lỗi</b>',
            text: messages
          });
          setTimeout(() => notifyItem.remove(), 2000);
          return false;
        },
        showSuccess(messages) {
          PNotify.removeAll();
          const notifyItem = new PNotify({
            title: '<b>Thông báo</b>',
            text: messages,
            type: 'success'
          });
          setTimeout(() => notifyItem.remove(), 2000);
          return true;
        },
        render(label = {}, prepend = false, getOnlyContent = false) {
          let { id, name, status, textColor, bgColor } = label
            , css = '';
          if (bgColor) {
            css += `background: ${bgColor};`;
          }
          if (textColor) {
            css += `color: ${textColor};`;
          }
          const content = `
                         <div class="td w-100 tdEdit d-none"></div>
                        <div class="td w-50 tdNormal text-left"><span class="badge" ${css ? `style="${css}"` : ''}>${name}</span></div>
                        <div class="td w-25 tdNormal">
                            <i class="fastChangeStatus cursor-pointer far ${status === 1 ? 'fa-check text-success' : 'fa-minus-circle text-danger'}" 
                            title="${status === 1 ? 'Hoạt động' : 'Ẩn'}" data-toggle="tooltip"></i>
                        </div>
                        <div class="td w-25 tdNormal">
                            <a href="javascript:void(0);" class="text-dark fastItemEdit mr-2"><i class="fal fa-pencil text-primary"></i></a>
                            <a href="javascript:void(0);" class="text-dark fastItemDelete"><i class="fal fa-trash-alt text-danger"></i></a>
                        </div>
                    `;
          if (getOnlyContent) {
            return content;
          }
          const html = `
                        <div class="fastTr text-center d-flex justify-content-between align-items-center"
                         data-id="${id}" data-bgcolor="${bgColor}" data-textcolor="${textColor}" data-name="${name}" data-status="${status}">
                           ${content}
                        </div>
                    `;
          if (prepend) {
            this.modal.find(`.scrollBody`).prepend(html);
          } else {
            this.modal.find(`.scrollBody`).append(html);
          }
        },
        renderEdit(fastTr) {
          let html = this.temp({
            id: fastTr.attr('data-status'),
            name: fastTr.attr('data-name'),
            status: fastTr.attr('data-status'),
            textColor: fastTr.attr('data-textcolor'),
            bgColor: fastTr.attr('data-bgcolor'),
          });
          fastTr.find('.tdEdit').html(html).removeClass('d-none');
          fastTr.find('.tdNormal').addClass('d-none');
          this.fastInitPicker();
        },
        temp(label = {}) {
          let css = ''
            , { id = '', name = '', status = this.LABEL_STATUS_ACTIVE, textColor = null, bgColor = null } = label;
          if (bgColor) {
            css += `background: ${bgColor};`;
          }
          if (textColor) {
            css += `color: ${textColor};`;
          }
          if (status) {
            status = parseInt(status);
          }
          return `<div class="${id ? '' : 'fastTr'} d-flex justify-content-between align-items-center"
                             data-id="${id}" data-bgcolor="${bgColor}" data-textcolor="${textColor}" data-name="${name}" data-status="${status}">                         
                                <div class="input-group">
                                    <input type="text" class="form-control fastItemName" maxlength="30" placeholder="Tên nhãn" value="${name}">
                                    <div class="input-group-append">
                                        <span class="input-group-text fastPicker" title="Chọn màu nền"><i class="fal fa-palette mr-1"></i></span>
                                        <input type="text" class="fastItemBg changeColor" value="${bgColor ? bgColor : ''}">
                                    </div>
                                    <div class="input-group-append position-relative">
                                        <span class="input-group-text fastPicker" title="Chọn màu chữ"><i class="fal fa-eye-dropper mr-1"></i></span>
                                        <input type="text" class="fastItemColor changeColor" value="${textColor ? textColor : ''}">
                                    </div>
                                    <div class="fastItemStatus input-group-append" data-status="${status}">
                                        <span class="input-group-text" data-toggle="dropdown" title="Trạng thái">
                                            <i class="fa ${status && status === this.LABEL_STATUS_ACTIVE ? 'fa-check text-success' : 'fa-minus-circle text-danger'}"></i>
                                        </span>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0)" data-value="${this.LABEL_STATUS_ACTIVE}">Hoạt động</a>
                                            <a class="dropdown-item" href="javascript:void(0)" data-value="${this.LABEL_STATUS_IN_ACTIVE}">Ẩn</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview d-inline-flex justify-content-between align-items-center">
                                    <span class="fastPrevTitle font-weight-normal mr-2">Xem trước</span>
                                    <span class="fastPreview badge badge-default" title="Xem trước" ${css ? `style="${css}"` : ''}>${name ? name : 'Tên nhãn'}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center ml-4">
                                    ${id ? '' : `<a href="javascript:void(0);" class="text-dark fastItemRemove" title="Xóa dòng"><i class="fal fa-trash-alt"></i></a>`}                                   
                                    <button class="btn ${id ? 'fastItemUpdate' : 'fastItemSave'} btn-info text-white ml-3"><i class="fal fa-save"></i></button>
                                </div>       
                        </div>`;
        },
        generateString(length = 10) {
          const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
          let result = ' ';
          const charactersLength = characters.length;
          for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
          }
          return result.trim();
        },
      };
    }
    )().init();
  },
  handlerLoadTagsName(opts = {}) {
    const b = $('#boxSelectLabels')
      , f = {
        storeId: opts.storeId,
        loadType: opts.type ? opts.type : b.length ? b.attr('data-type') : '',
        loadTypes: opts.hasOwnProperty('types') ? opts.types : [],
        statusAll: opts.hasOwnProperty('statusAll') ? 1 : 0,
      };
    AppAjax.post('/setting/store/loadlabels', f, rs => opts.fn(rs.data ? rs.data : []));
  },
  UpdateStoreIdInputImage: function (storeId, options) {
    var name = options.name
      , type = options.type;
    if (storeId) {
      if ($('.businessFileUpload').length) {
        $('.businessFileUpload[name="' + name + '"]').attr('data-url', '/media/upload/business?type=' + type + '&storeId=' + storeId);
      }
    }
  },
  downloadFile: function (url, fileName) {
    if (!url || !fileName) {
      return null;
    }
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.responseType = "blob";
    xhr.onload = function () {
      if (typeof MobileAppNative != 'undefined' && !MobileAppClient.isSafariBroswer()) {
        if (this.status == 200) {
          var blobPdf = this.response;
          var reader = new FileReader();
          reader.readAsDataURL(blobPdf);
          reader.onloadend = function () {
            base64data = reader.result;
            var contentType = xhr.getResponseHeader('Content-Type');
            MobileAppNative.receiveBase64FromBlobData(base64data, contentType);
          }
        }
      } else {
        var urlCreator = window.URL || window.webkitURL;
        var imageUrl = urlCreator.createObjectURL(this.response);
        var tag = document.createElement('a');
        tag.href = imageUrl;
        tag.download = fileName;
        document.body.appendChild(tag);
        tag.click();
        document.body.removeChild(tag);
      }
    }
      ;
    xhr.send();
  }
};
var AppUser = {
  getCurrentUserId: function () {
    return $('body').attr('data-nvn-current-user-id');
  },
  getCurrentUserName: function () {
    return $('#header .userFullName').text();
  }
};
var AppModal = {
  show: function (data) {
    var colorHeader = data.hasOwnProperty('color') && data.color ? data.color : '';
    var titleHeader = data.hasOwnProperty('title') && data.title ? data.title : '';
    var classTitleHeader = data.hasOwnProperty('classTitle') && data.classTitle ? data.classTitle : '';
    var header = '<div class="modal-header bg-light py-2 ' + colorHeader + '">' + '   <h5 class="modal-title ' + classTitleHeader + '" id="exampleModalLongTitle">' + titleHeader + '</h5>' + '   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="far fa-times font-size-xl"></i></button>' + '</div>';
    var bodyClass = data.hasOwnProperty('bodyClass') && data.bodyClass ? data.bodyClass : '';
    var contentModal = data.hasOwnProperty('content') && data.content ? data.content : '';
    var body = '<div class="modal-body ' + bodyClass + '">' + contentModal + '</div>';
    var buttons = '';
    var footer = '';
    if (data.buttons) {
      $.each(data.buttons, function (key, rs) {
        var btnColor = rs.hasOwnProperty('color') && rs.color ? rs.color : 'btn-success';
        var btnTitle = rs.hasOwnProperty('title') && rs.title ? rs.title : '';
        var btnOnclick = rs.hasOwnProperty('onclick') && rs.onclick ? rs.onclick : '';
        var textAttributes = '';
        if (rs.hasOwnProperty('attributes') && rs.attributes) {
          $.each(rs.attributes, function (key, vl) {
            textAttributes += key + '="' + vl + '" ';
          });
        }
        if (btnOnclick) {
          textAttributes += ' onclick="' + btnOnclick + '"';
        }
        if (typeof rs === 'string') {
          buttons += rs;
        } else {
          buttons += '<button type="button" class="btn ' + btnColor + '" ' + textAttributes + '>' + btnTitle + '</button>';
        }
      });
      var footerContent = data.footerContent ? data.footerContent : '';
      footer = '<div class="modal-footer bg-light py-2">' + footerContent + buttons + '</div>';
    }
    if (data.showOnlycontent) {
      header = '';
      footer = '';
    }
    var modalAttributes = '';
    if (data.hasOwnProperty('attributes') && data.attributes) {
      $.each(data.attributes, function (key, vl) {
        modalAttributes += key + '="' + vl + '" ';
      });
    }
    var modalId = data.hasOwnProperty('modalId') && data.modalId ? data.modalId : 'defaultModal';
    var backgroundContent = data.hasOwnProperty('background') && data.background ? data.background : '';
    var sizeModal = data.hasOwnProperty('size') && data.size ? data.size : '';
    var modal = '<div class="modal fade" id="' + modalId + '" ' + modalAttributes + ' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">' + '  <div class="modal-dialog modal-dialog-centered ' + sizeModal + '" role="document">' + '    <div class="modal-content ' + backgroundContent + '">' + header + body + footer + '</div>' + '  </div>' + '</div>';
    $('body').append(modal);
    $('body #' + modalId).modal('show');
    AppModal.removeModal(data);
  },
  hide: function (id, options) {
    id = id ? id : '#defaultModal';
    $('body ' + id).modal('hide').remove();
    $('body .modal-backdrop').remove();
    $('body').removeClass('modal-open');
    AppModal.removeModal(options);
  },
  removeModal: function (options) {
    var modalId = options && options.hasOwnProperty('modalId') ? options.modalId : 'defaultModal';
    $('body #' + modalId).on('hidden.bs.modal', function (e) {
      $('body #' + modalId).remove();
      $('body .modal-backdrop').remove();
      if (options && options.hasOwnProperty('closeHandler')) {
        options.closeHandler();
      }
    });
  }
};
var AppDataGrid = {
  init: function () {
    this.initButtonEventCommon();
    this.initColumnDisplaySetting();
    this.initCheckboxCheckAll();
    this.initCheckboxRadio();
    this.initPreviewImage();
    this.initDisplayMessageValid();
    this.initDeleteItems();
    this.initDeleteCache();
    this.initEffect();
  },
  initButtonEventCommon: () => {
    const btnExcelAll = $('.excelModalAll');
    if (btnExcelAll.length) {
      const formatExcel = btnExcelAll.attr('data-format') ? btnExcelAll.attr('data-format') : 'jsExcel';
      const urlExcel = btnExcelAll.attr('data-url') ? btnExcelAll.attr('data-url') : window.location.pathname;
      if (urlExcel) {
        AppCommon.initExportExel('.excelModalAll', {
          'param': {
            'format': formatExcel
          },
          'url': urlExcel,
        });
      }
    }
  }
  ,
  initColumnDisplaySetting: function () {
    $('.userDgConfig .dgColumn').on('click', function () {
      var t = $(this)
        , extraContent = [];
      var type = t.parents('.userDgConfig').attr('data-columnDisplaySetting');
      var colspanColumn = t.attr('data-colspan');
      var colspanTotal = '';
      var colspan = '';
      var hasClass = false;
      if (colspanColumn != '') {
        colspanTotal = parseInt($('#' + colspanColumn).attr('colspan'));
        if (!colspanTotal) {
          hasClass = true;
        }
      }
      if (t.is(':checked')) {
        $('.' + t.attr('data-class')).css('display', 'table-cell').parents('.table-responsive').trigger('change');
        $("input[name=" + t.val() + "]").attr('checked', 'checked');
        if (hasClass) {
          $('.' + colspanColumn).each(function () {
            colspanTotal = parseInt($(this).attr('colspan'));
            $(this).attr('colspan', colspanTotal + 1);
          });
        } else {
          $('#' + colspanColumn).attr('colspan', colspanTotal + 1);
        }
      } else {
        $('.' + t.attr('data-class')).css('display', 'none').parents('.table-responsive').trigger('change');
        $("input[name=" + t.val() + "]").removeAttr('checked');
        if (hasClass) {
          $('.' + colspanColumn).each(function () {
            colspanTotal = parseInt($(this).attr('colspan'));
            $(this).attr('colspan', colspanTotal - 1);
          });
        } else {
          $('#' + colspanColumn).attr('colspan', colspanTotal - 1);
        }
      }
      $(".userDgConfig input.dgColumn").not(':checked').map(function () {
        extraContent.push($(this).val());
      });
      AppAjax.post('/user/setting/save', {
        extraContent: extraContent.join(),
        type: type
      }, function (rs) { });
    });
    $('.userDgConfig .resetColumnDisplaySetting').on('click', function () {
      var type = $(this).attr('data-columnDisplaySetting');
      if (type) {
        AppAjax.post('/user/setting/delete', {
          type: type
        }, function (rs) {
          location.reload();
        });
      }
    });
  },
  initCheckboxCheckAll: function () {
    $(document).on('click', '.select-checkbox', function () {
      var t = $(this);
      if (!t.parent().hasClass('selected')) {
        t.parent().addClass('selected');
        t.prop('checked', true);
      } else {
        t.parent().removeClass('selected');
        t.prop('checked', false);
      }
    });
    $(document).on('click', '.dgCheckboxCheckAll', function () {
      if ($(this).hasClass('checked')) {
        $(this).removeClass('checked');
        $('.select-checkbox').parent().removeClass('selected');
        $('.select-checkbox').prop('checked', false);
      } else {
        $(this).addClass('checked');
        $('.select-checkbox').parent().addClass('selected');
        $('.select-checkbox').prop('checked', true);
      }
    });
  },
  initPreviewImage: function () {
    $('body').on('click', 'a[rel="prp"]', function (e) {
      e.preventDefault();
      var src = $(this).attr('data-src');
      if (src) {
        AppModal.show({
          size: 'modal-md mh-80',
          bodyClass: 'mb-0 p-0 text-center',
          content: '<img class="mw-100" src="' + src + '" alt="' + $(this).attr('data-title') + '" style="object-fit: contain"/>',
          showOnlycontent: true,
        });
      }
    });
  },
  initCheckboxRadio: function () {
    $(document).on('click', '.form-group .uniform-choice', function () {
      var t = $(this)
        , group = t.parents('.form-group')
        , input = group.find('.uniform-choice').find('input[type="radio"]')
        , span = input.parent('span');
      span.removeAttr('checked');
      input.prop('selected', false);
      input.parent('span').removeClass('checked');
      t.find('input').attr('selected', 'selected');
      t.find('input').prop('selected', true);
      t.find('input').parent('span').addClass('checked');
    });
  },
  initDisplayMessageValid: function () {
    $(document).on('change', 'input.border-danger, select.border-danger, textarea.border-danger', function () {
      var t = $(this);
      if (t.val()) {
        t.removeClass('border-danger');
        t.siblings('.form-text').remove();
        t.siblings('.error').empty();
      }
    });
    $(document).on('keyup', 'body .ck-editor .ck-content', function () {
      var t = $(this)
        , p = t.parents('.ck-editor')
        , ele = p.siblings('textarea');
      if (ele.hasClass('required')) {
        if (t.text()) {
          ele.removeClass('border-danger');
          p.siblings('.form-text').remove();
          p.siblings('.error').empty();
        } else {
          ele.addClass('border-danger');
          p.siblings('.error').html('<span class="validation-invalid-label">Bạn chưa nhập dữ liệu</span>');
        }
      }
    });
  },
  initDeleteItems: function () {
    $(document).on('click', '.js-del-item', function () {
      $(this).parents('tr').addClass('js-deleting-row-' + $(this).attr('data-id'));
      AppModal.show({
        size: 'modal-md',
        color: '',
        title: 'Xác nhận xóa?',
        content: '<div class="alert alert-warning"><p class="mb-0">Bạn có chắc chắn muốn xóa: <span class="font-weight-semibold">' + $(this).attr('data-label') + '</span></p></div>',
        buttons: [{
          title: '<i class="fal fa-check mr-1"></i> ' + appTranslator.translate(appTranslator.labels.Yes),
          color: 'btn-danger',
          attributes: {
            'id': 'modal-btn-delete-yes',
            'data-id': $(this).attr('data-id'),
            'data-link': $(this).attr('data-link'),
            'data-redirect': $(this).attr('data-redirect') ? $(this).attr('data-redirect') : '',
            'data-no-redirect': $(this).attr('data-no-redirect') ? $(this).attr('data-no-redirect') : 0,
            'data-label': $(this).attr('data-label'),
            'data-storeId': $(this).attr('data-storeId') ? $(this).attr('data-storeId') : ''
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
    $(document).on('click', '#modal-btn-delete-yes', function () {
      var item = $(this);
      item.prop('disabled', true);
      item.find('i').removeClass('fa-check').addClass('fa-spinner fa-spin');
      $('body').removeClass('modal-open').removeAttr('style');
      var dataPost = {};
      dataPost.id = $(this).attr('data-id');
      if ($(this).attr('data-storeId')) {
        dataPost.storeId = $(this).attr('data-storeId');
      }
      AppAjax.ajax({
        url: $(this).attr('data-link'),
        data: dataPost,
        type: "POST",
        success: function (rs) {
          if (rs.code) {
            $('tr.js-deleting-row-' + $('#modal-btn-delete-yes').attr('data-id')).remove();
            new PNotify({
              title: '<i class="far fa-check mr-1"></i> Đã xóa: ',
              text: $('#modal-btn-delete-yes').attr('data-label'),
              type: 'success'
            });
            item.prop('disabled', false);
            if (parseInt(item.attr('data-no-redirect'))) { } else if (item.attr('data-redirect')) {
              window.location.href = item.attr('data-redirect');
            } else {
              setTimeout(function () {
                window.location.reload();
              }, 1500);
            }
          } else {
            new PNotify({
              title: '<i class="far fa-check"></i> Lỗi xóa: ' + $('#modal-btn-delete-yes').attr('data-label'),
              text: typeof rs.messages == "object" ? rs.messages.join('\n') : rs.messages,
              type: 'danger'
            });
            item.prop('disabled', false);
          }
          item.find('i').removeClass('fa-spinner fa-spin').addClass('fa-check');
          AppModal.hide();
        }
      });
    });
    $(document).on('click', '#js-del-multiple', function () {
      var URL = $(this).attr('data-url')
        , option = {
          size: 'modal-md',
          color: 'bg-warning pt-2 pb-2',
          title: 'Xóa những dòng đã chọn!',
          modalId: 'modalProgress',
        }
        , content = ''
        , itemIds = [];
      if ($('body table .row-item.selected').length) {
        $('table .row-item.selected').each(function () {
          var t = $(this)
            , id = t.attr('data-id');
          if (id) {
            itemIds.push(id);
          }
        });
        content += '<input type="hidden" id="itemIds" value="' + itemIds + '"/>';
        content += '<div class="alert alert-warning mt-3">Bạn có chắc muốn xoá tất cả đòng đã chọn này?</div>';
        option.content = content;
        option.buttons = {
          0: '<button type="button" id="js-delete-multiple-item" data-url="' + URL + '" class="btn btn-primary">Ok</button>',
        };
      } else {
        option.content = '<div class="alert alert-warning alert-styled-left alert-dismissible">Bạn chưa chọn dòng nào!</div>';
      }
      AppModal.hide('#modalProgress');
      AppModal.show(option);
      if (itemIds.length) {
        AppCommon.progressload({
          modalId: '#modalProgress',
          totalItem: itemIds.length,
        });
        $('body #modalProgress').find('.progress').hide();
      }
    });
    $(document).on('click', 'body #js-delete-multiple-item', function () {
      var $modal = $('body #modalProgress')
        , itemIds = $('#itemIds').val().split(',')
        , storeId = $('#storeId').val()
        , URL = $(this).attr('data-url');
      $modal.find('.modal-body').find('.alert').remove();
      if (itemIds.length) {
        $modal.find('.progress').show();
        $modal.find('.modal-body').append('<div class="alert alert-info mt-3 bg-transparent"></div>');
        var isError = false
          , mss = $modal.find('.modal-body').find('.alert-info');
        itemIds.forEach(function (itemId) {
          var rowItem = $('.row-item[data-id="' + itemId + '"]');
          AppAjax.ajax({
            url: URL,
            data: {
              id: itemId,
              storeId: storeId,
            },
            type: "POST",
            success: function (rs) {
              if (rs.code) {
                if (rowItem) {
                  rowItem.fadeOut(100).remove();
                }
                mss.append('<p class="text-success-600 mb-0">' + rs.messages + '</div>');
              } else {
                mss.append('<p class="font-weight-bold text-danger mb-0">' + rs.messages + '</div>');
                isError = true;
              }
              AppCommon.progressChange({
                modalId: '#modalProgress',
              });
              setTimeout(function () {
                $modal.fadeOut(100).modal('hide');
              }, 5000);
            },
          });
          if (!isError) {
            $modal.find('#js-delete-multiple-item').remove();
          }
        });
      }
    });
  },
  initDeleteCache: function () {
    $('.storeClearCache').click(function () {
      var storeId = $('#storeId').val();
      var type = $(this).attr('data-type');
      if (!type || !storeId) {
        AppModal.show({
          color: 'bg-warning pt-2 pb-2',
          title: 'Thông báo',
          size: 'modal-sm',
          content: '<h6>Bạn chưa chọn doanh nghiệp!</h6>',
        });
      } else {
        AppAjax.post('/website/content/clearcache', {
          type: type,
          storeId: storeId
        }, function (rs) {
          new PNotify({
            title: '<i class="far fa-check"></i>  Thông báo',
            text: rs.messages,
            type: 'success'
          });
        });
      }
    });
  },
  initEffect: function () {
    $('.dg').each(function () {
      $(this).find('tr').each(function (i, tr) {
        $(tr).find('td').each(function (j, td) {
          var rowspan = $(td).attr('rowspan');
          if (rowspan) {
            var next = $(tr);
            for (var k = 1; k <= rowspan; k++) {
              next.attr('trid', i);
              next.addClass('trid-' + i);
              next = next.next();
            }
          }
        });
      });
      $(this).find('tr:odd').removeClass('even');
      $(this).find('tr:even').addClass('even');
      $(this).find('tr').hover(function () {
        var trid = $(this).attr('trid');
        if (trid) {
          $('tr.trid-' + trid).addClass('h');
        } else {
          $(this).addClass('h');
        }
      }, function () {
        var trid = $(this).attr('trid');
        if (trid) {
          $('tr.trid-' + trid).removeClass('h');
        } else {
          $(this).removeClass('h');
        }
      });
      if ($(this).find('tr:first th:first').find('input.cb').length > 0) {
        if ($(this).attr('id')) {
          AppDataGrid.checkAll($(this).attr('id'), 0);
        }
      }
    });
  },
  checkAll: function (tableId, colIndex) {
    var cbId = $('#' + tableId + ' tr:first th:eq(' + colIndex + ')').find('input.cb').attr('id');
    var tableRows = $('#' + tableId + ' tr:gt(0)');
    tableRows.each(function (rowIndex) {
      AppDataGrid.selectRow(tableId, rowIndex + 1, colIndex);
    });
    $('#' + cbId).click(function () {
      var isCheck = $(this).is(':checked');
      if (isCheck) {
        tableRows.each(function (rowIndex) {
          if ($(this).find('td:eq(' + colIndex + ')').find('input.cb').length) {
            document.getElementById($(this).find('td:eq(' + colIndex + ')').find('input.cb').attr('id')).checked = true;
            if ($(this).find('td:eq(' + colIndex + ')').find('input.cb').length > 0) {
              $(this).addClass('s');
            }
          }
        });
      } else {
        tableRows.each(function () {
          $(this).find('td:eq(' + colIndex + ')').find('input.cb').removeAttr('checked');
          $(this).removeClass('s');
        });
      }
    });
  },
  selectRow: function (tableId, rowIndex, colIndex) {
    $('#' + tableId + ' tr:eq(' + rowIndex + ') td:eq(' + colIndex + ')').find('input.cb').click(function () {
      if ($(this).is(':checked')) {
        $('#' + tableId + ' tr:eq(' + rowIndex + ')').addClass('s');
      } else {
        $('#' + tableId + ' tr:eq(' + rowIndex + ')').removeClass('s');
      }
    });
  }
};
var AppDateTime = {
  init: function () {
    var drops = 'down';
    if ($(window).width() < 768) {
      drops = 'up';
    }
    this.initDatePicker(drops);
    this.initDateTimePicker(drops);
  },
  initDatePicker: function (drops) {
    if ($('.tbDatePicker').length) {
      let drop = drops;
      if ($('.tbDatePicker').parents('#fReportFilter').length) {
        drop = "down";
      }
      $('.tbDatePicker').daterangepicker({
        drops: drop,
        singleDatePicker: true,
        autoUpdateInput: false,
        autoApply: true,
        showDropdowns: true,
        locale: {
          format: "DD/MM/YYYY",
          daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
          monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
          firstDay: 1
        }
      }).on('apply.daterangepicker', function (ev, picker) {
        picker.element.val(picker.startDate.format('DD/MM/YYYY'));
        picker.element.parents('.form-group').addClass('active');
        picker.element.change();
      });
    }
    if ($('.tb-show-daterangepicker').length) {
      let opens = 'center';
      if ($(window).width() < 768) {
        opens = 'left';
      }
      $('.tb-show-daterangepicker').daterangepicker({
        linkedCalendars: false,
        autoUpdateInput: false,
        autoApply: true,
        showDropdowns: true,
        alwaysShowCalendars: false,
        showCustomRangeLabel: false,
        opens: opens,
        locale: {
          format: "DD/MM/YYYY",
          daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
          monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
          firstDay: 1,
          applyLabel: 'Áp dụng',
          cancelLabel: 'Hủy',
          customRangeLabel: 'Chọn ngày'
        },
        ranges: {
          'Hôm nay': [moment().utcOffset('+07:00').startOf('day'), moment().utcOffset('+07:00').endOf('day')],
          'Hôm qua': [moment().utcOffset('+07:00').subtract(1, 'days').startOf('day'), moment().utcOffset('+07:00').subtract(1, 'days').endOf('day')],
          'Tuần này': [moment().utcOffset('+07:00').startOf('week'), moment().utcOffset('+07:00').endOf('day')],
          'Tuần trước': [moment().utcOffset('+07:00').startOf('week').subtract(7, 'days'), moment().utcOffset('+07:00').endOf('week').subtract(7, 'days')],
          'Tháng này': [moment().utcOffset('+07:00').startOf('month'), moment().utcOffset('+07:00').endOf('day')],
          'Tháng trước': [moment().utcOffset('+07:00').subtract(1, 'month').startOf('month'), moment().utcOffset('+07:00').subtract(1, 'month').endOf('month')],
        }
      }).on('apply.daterangepicker', function (ev, picker) {
        if ($(this).parent().find('#fromDate')) {
          $(this).parent().find('#fromDate').val(picker.startDate.format('DD/MM/YYYY'));
        }
        if ($(this).parent().find('#toDate')) {
          $(this).parent().find('#toDate').val(picker.endDate.format('DD/MM/YYYY'));
        }
      });
    }
  },
  initDateTimePicker: function (drops) {
    if ($('.tbDateTimePicker').length) {
      $('.tbDateTimePicker').daterangepicker({
        drops: drops,
        showDropdowns: true,
        timePicker: true,
        timePickerIncrement: 15,
        autoUpdateInput: false,
        opens: 'left',
        singleDatePicker: true,
        autoApply: true,
        locale: {
          format: "DD/MM/YYYY HH:mm:ss",
          daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
          monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
          firstDay: 1,
          applyLabel: 'Áp dụng',
          cancelLabel: 'Hủy',
        }
      }).on('apply.daterangepicker', function (ev, picker) {
        picker.element.val(picker.startDate.format('DD/MM/YYYY HH:mm:ss'));
        picker.element.parents('.form-group').addClass('active');
      });
    }
  }
};
var AppTheme = {
  getThemeBtnClass: function (btnClass) {
    if (appTheme.button[btnClass]) {
      return appTheme.button[btnClass];
    }
  }
};
var AppForm = {
  init: function () {
    this.changeElement();
    this.initForm();
    this.initSelectSearchBox();
    this.initNewSelectMultiple();
  },
  initForm: function () {
    var id = $('.collapseAutoFocus').attr('data-target');
    $(id).on('shown.bs.collapse', function (e) {
      $('input[autofocus]').focus();
    });
  },
  changeElement: function () {
    $('.form-filter .tbDatePicker').each(function () {
      if ($(this).val()) {
        $(this).parent('.form-group').addClass('active');
      }
    });
    $('.form-filter').on('change', 'input, textarea, select', function () {
      if ($(this).val()) {
        $(this).parent('.form-group').addClass('active');
      } else {
        $(this).parent('.form-group').removeClass('active');
      }
    });
    var fElements = ['input', 'select', 'textarea'];
    $.each(fElements, function (index, value) {
      $('.form-filter ' + value).each(function () {
        if ($(this).val()) {
          $(this).parent('.form-group').addClass('active');
        }
      });
    });
  },
  initSelectSearchBox: function (selector = '.select-has-search-box', length = 11) {
    if ($(selector).data('select2')) {
      $('#' + this.id).select2('destroy');
    }
    $(selector).select2({
      'minimumResultsForSearch': length,
    });
  },
  initNewSelectMultiple: function (selector = '.select-multipleCheckbox') {
    $(selector).each(function (index) {
      $(this).addClass('classMutiple' + index);
      $(this).select2MultiCheckboxes({
        templateSelection: function (selected) {
          if (selected.length > 0) {
            if (selected.length == 1) {
              return $('.classMutiple' + index).find('option:selected').text();
            } else {
              return "Đã chọn " + selected.length;
            }
          } else {
            return $('.classMutiple' + index).attr('data-title');
          }
        },
        wrapClass: 'wrapSelect',
        minimumResultsForSearch: 1,
        searchMatchOptGroups: true,
        selectAll: $(this).hasClass('notCheckAll') ? false : true
      });
    });
  },
};
var appCkeditorToolbarsCommon = {
  toolbar: ["heading", "undo", "redo", "bold", "italic", "blockQuote", "indent", "outdent", "link", "numberedList", "bulletedList", "mediaEmbed", "insertTable", "tableColumn", "tableRow", "mergeTableCells", "ckfinder", "imageTextAlternative", "imageUpload", "imageStyle:full", "imageStyle:side",],
  heading: {
    options: [{
      model: 'paragraph',
      title: 'Paragraph',
      class: 'ck-heading_paragraph'
    }, {
      model: 'heading1',
      view: 'h1',
      title: 'Heading 1',
      class: 'ck-heading_heading1'
    }, {
      model: 'heading2',
      view: 'h2',
      title: 'Heading 2',
      class: 'ck-heading_heading2'
    }, {
      model: 'heading3',
      view: 'h3',
      title: 'Heading 3',
      class: 'ck-heading_heading3'
    }, {
      model: 'heading4',
      view: 'h4',
      title: 'Heading 4',
      class: 'ck-heading_heading4'
    }, {
      model: 'heading5',
      view: 'h5',
      title: 'Heading 5',
      class: 'ck-heading_heading5'
    }, {
      model: 'heading6',
      view: 'h6',
      title: 'Heading 6',
      class: 'ck-heading_heading6'
    },]
  },
  image: {
    toolbar: ['imageStyle:full', 'imageStyle:side', '|', 'imageTextAlternative']
  },
  language: 'vi'
};
var AppDataIframe = {
  init: function () {
    $(document).on('click', '.open-detail-in-iframe', function (e) {
      if (e.ctrlKey) {
        return;
      }
      e.preventDefault();
      let openDetailLink = $(this).attr('href');
      let openDetailText = $(this).data('open-detail-text') ? $(this).data('open-detail-text') : $(this).text();
      AppModal.show({
        size: 'modal-xl',
        color: 'bg-white px-3 py-2',
        title: '<a title="Mở sang tab mới" href="' + openDetailLink + '"><i class="fal fa-external-link mr-1"></i> ' + openDetailText + '</a>',
        bodyClass: 'mb-0 p-0 text-center',
        footer: '',
        content: AppCommon.renderIframeHtml(openDetailLink + '&showDataIframe=1', 'openDetailInIframe')
      });
      return false;
    });
  },
  addProduct: function (selector) {
    $(document).on('click', selector, function () {
      $(this).tooltip('hide');
      AppModal.show({
        size: 'modal-xl',
        color: 'bg-success border-success px-3 py-2',
        title: '<i class="fal fa-cube mr-2"></i> Thêm sản phẩm',
        bodyClass: 'mb-0 p-0 text-center',
        footer: '',
        content: AppCommon.renderIframeHtml('/product/item/add?showDataIframe=1', 'addProductFrame')
      });
    });
  },
  addSupplier: function (selector, options = {}) {
    $(document).on('click', selector, function () {
      $(this).tooltip('hide');
      AppModal.show({
        size: 'modal-lg',
        color: 'bg-success border-success px-3 py-2',
        title: '<i class="fal fa-plus mr-2"></i> Thêm nhà cung cấp',
        bodyClass: 'mb-0 p-0 text-center',
        footer: '',
        content: AppCommon.renderIframeHtml('/supplier/manage/index?tab=add&showDataIframe=1', 'addSupplierFrame'),
        closeHandler: function () {
          if (options && options.hasOwnProperty('closeHandler')) {
            options.closeHandler();
          }
        }
      });
    });
  },
  addStoreProductCategory: function (selector, options = {}) {
    $(document).on('click', selector, function () {
      $(this).tooltip('hide');
      AppModal.show({
        modalId: 'addFastCategory',
        size: 'modal-lg',
        color: 'bg-success border-success px-3 py-2',
        title: '<i class="fal fa-th-list mr-2"></i> Thêm danh mục sản phẩm',
        bodyClass: 'mb-0 p-0 text-center',
        footer: '',
        content: AppCommon.renderIframeHtml('/store/category/index?tab=add&showDataIframe=1', 'addStoreProductCategoryFrame'),
        closeHandler: function () {
          var element = options.elements ? options.elements : '#categoryId';
          categorySuggestHandler.load({
            element: element,
            reload: true,
            storeId: $('#storeId').val()
          });
        }
      });
    });
  },
  addStoreProductBrand: function (selector, options = {}) {
    $(document).on('click', selector, function () {
      $(this).tooltip('hide');
      AppModal.show({
        modalId: 'addFastBrand',
        size: 'modal-lg',
        color: 'bg-success border-success px-3 py-2',
        title: '<i class="fal fa-th-list mr-2"></i> Thêm thương hiệu',
        bodyClass: 'mb-0 p-0 text-center',
        footer: '',
        content: AppCommon.renderIframeHtml('/product/brand/index?tab=add&showDataIframe=1', 'addStoreProductBrandFrame'),
        closeHandler: function () {
          var element = options.elements ? options.elements : '#brandId';
          storeSuggestHandler.loadBrands({
            element: element,
            reload: true,
            storeId: $('#storeId').val()
          });
        }
      });
    });
  },
  addSource: function (selector) {
    $(document).on('click', selector, function () {
      $(this).tooltip('hide');
      AppModal.show({
        size: 'modal-lg',
        color: 'bg-success border-success px-3 py-2',
        title: '<i class="fal fa-plus mr-2"></i> Thêm nguồn đơn hàng',
        bodyClass: 'mb-0 p-0 text-center',
        footer: '',
        content: AppCommon.renderIframeHtml('/store/traffic/source?tab=add&showDataIframe=1', 'addTrafficSourceFrame')
      });
    });
  },
  addCustomerCode: function (id, storeId) {
    AppModal.show({
      size: 'modal-lg',
      color: 'bg-success border-success px-3 py-2',
      title: '<i class="fal fa-plus mr-2"></i> Thêm thẻ khách hàng',
      bodyClass: 'mb-0 p-0 text-center',
      footer: '',
      content: AppCommon.renderIframeHtml('/customer/code/addcustomer?showDataIframe=1&id=' + id + '&storeId=' + storeId, 'addCustomerCodeFrame')
    });
  },
  addReasonWarranty: function (storeId) {
    AppModal.show({
      size: 'modal-lg',
      color: 'bg-success border-success px-3 py-2',
      title: '<i class="fal fa-plus mr-2"></i> Thêm lý do bảo hành',
      bodyClass: 'mb-0 p-0 text-center',
      footer: '',
      content: AppCommon.renderIframeHtml('/warranty/setting/reason?tab=add&storeId=' + storeId + '&showDataIframe=1', 'addTrafficSourceFrame')
    });
  }
};
AppDataIframe.init();
var appCkEditor = {
  initBasicEditor: function (selector, height) {
    let cssHeight = '150px';
    if (typeof height !== 'undefined' && height) {
      cssHeight = height;
    }
    $(selector).ckeditor({
      language: usrCnf.lang,
      uiColor: '#EEEEEE',
      height: cssHeight,
      toolbar: [['Styles', 'Format', 'FontSize', 'Bold', 'Italic', 'Underline', 'TextColor', 'Link', 'Unlink']],
      removePlugins: 'elementspath'
    });
  },
  initAdvancedEditor: function (selector, options, height) {
    let cssHeight = '350px';
    if (typeof height !== 'undefined' && height) {
      cssHeight = height;
    }
    let defaultOptions = {
      language: usrCnf.lang,
      height: cssHeight,
      toolbar: [{
        name: 'line1',
        items: ['Source']
      }, {
        name: 'line2',
        items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', 'Undo', 'Redo', 'Find']
      }, {
        name: 'line3',
        items: ['Link', 'Unlink', 'Anchor', 'Image', 'Table', 'HorizontalRule', 'PageBreak', 'Iframe', 'Youtube']
      }, {
        name: 'line4',
        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'CopyFormatting']
      }, {
        name: 'line5',
        items: ['TextColor', 'BGColor']
      }, {
        name: 'line6',
        items: ['NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'BidiLtr', 'BidiRtl']
      }, {
        name: 'line7',
        items: ['Styles', 'Format', 'Font', 'FontSize', 'RemoveFormat', 'Maximize']
      }],
      removePlugins: 'elementspath'
    };
    if (typeof options === 'object' && options !== null) {
      defaultOptions = Object.assign(defaultOptions, options);
    }
    $(selector).ckeditor(defaultOptions);
  }
};
var appCacheRencent = {
  keyStorage: $('#wrapperRecentData').attr('data-type'),
  saveCacheRecent: function (newItem = null) {
    const k = appCacheRencent.keyStorage;
    if (!k || !newItem)
      return false;
    let storageItems = localStorage.getItem(k) ? JSON.parse(localStorage.getItem(k)) : [];
    let isExisted = false
      , localStore = []
      , storeId = $('#storeId').val();
    if (storageItems.length) {
      $.each(storageItems, function (index, item) {
        if (typeof item.storeId != "undefined" && item.storeId === storeId) {
          let storeData = storageItems[index].data;
          if (storeData.length >= 5) {
            let dataIds = [];
            $.each(storeData, function (index, value) {
              dataIds.push(value.id);
            });
            const minOrderId = dataIds.length ? String(Math.min.apply(Math, dataIds)) : '';
            const index = dataIds.indexOf(minOrderId);
            if (index !== -1) {
              storeData.splice(index, 1);
            }
          }
          storageItems[index].data.push(newItem);
          isExisted = true;
          return true;
        }
      });
    }
    if (!isExisted) {
      localStore.push(newItem);
      storageItems.push({
        "storeId": storeId,
        "data": localStore
      });
    }
    localStorage.setItem(k, JSON.stringify(storageItems));
  },
  renderCacheRecent: function (arrKey = [], titleTotal = 'Tổng') {
    const k = appCacheRencent.keyStorage;
    if (!k || !arrKey)
      return false;
    let storeId = $('#storeId').val()
      , storageItems = localStorage.getItem(k) ? JSON.parse(localStorage.getItem(k)) : []
      , title = $('#wrapperRecentData').attr('data-title')
      , localStore = []
      , colSpan = Object.keys(arrKey).length;
    if (storageItems.length) {
      $.each(storageItems, function (index, item) {
        if (typeof item.storeId != "undefined" && item.storeId == storeId) {
          localStore = item.data;
          return true;
        }
      });
    }
    let htmlRecents = '';
    if (localStore.length) {
      localStore.sort(function (a, b) {
        return parseInt(b.id) - parseInt(a.id);
      });
      $.each(localStore, function (index, values) {
        htmlRecents += '<tr>';
        $.each(values, function (k, val) {
          if (arrKey.hasOwnProperty(k)) {
            const kVal = arrKey[k];
            if (k === 'checkId') {
              htmlRecents += '<td><a target="_blank" href="' + kVal + '?storeId=' + storeId + '&checkId=' + val + '"> ' + val + '</a></td>';
            } else if (k === 'id') {
              htmlRecents += '<td><a target="_blank" href="' + kVal + '?storeId=' + storeId + '&id=' + val + '"> ' + val + '</a></td>';
            } else if (kVal === 'number') {
              htmlRecents += '<td class="text-right font-weight-semibold">' + AppFuntions.formatDecimal(val) + '</td>';
            } else {
              htmlRecents += '<td>' + (typeof val != "undefined" && val != null ? val : '') + '</td>';
            }
          }
        });
        htmlRecents += '</tr>';
      });
    } else {
      htmlRecents += '<tr><td colspan="' + colSpan + '">Chưa có dữ liệu.</td></tr>';
    }
    $('#listRecentData').html(`
            <table class="table table-tiny table-hover">
                <thead>
                    <th colspan="${colSpan - 1}" class="text-left">${title}</th>
                    <th class="text-right">${titleTotal}</th>
                </thead>
                <tbody>${htmlRecents}</tbody>
              </table>
        `);
  },
};
var AppAjax = {
  post: function (url, data, success, fail = false) {
    AppAjax.ajax({
      url: url,
      data: data,
      success: success,
      fail: fail,
      type: 'POST'
    });
  },
  ajax: function (options) {
    let url = options.url
      , nuctk = $('body').attr('data-nuctk');
    if (!url || !nuctk) {
      return false;
    }
    let dataPost = options.data ? options.data : '';
    if (!dataPost) {
      dataPost = {
        'nuctk': nuctk
      };
    } else {
      if ($.isPlainObject(dataPost)) {
        dataPost.nuctk = nuctk;
      } else if ($.type(dataPost) === 'string') {
        dataPost += '&nuctk=' + nuctk;
      } else {
        dataPost.set('nuctk', nuctk);
      }
    }
    options.data = dataPost;
    $.ajax(options);
  }
};
var AppToats = {
  showToastsSuccess: function (options) {
    let title = options.title ?? '';
    let iconTitle = options.iconTitle ?? '<i class="fal fa-check"></i>';
    let iconContent = options.iconContent ?? '';
    let content = options.content ? '<div class="toast-body pt-1"><span class="mr-2 ui-pnotify-title">' + iconContent + '</span>' + options.content + '</div>' : '';
    let delay = options.delay ?? 2000;
    var html = '<div aria-live="polite" aria-atomic="true" class="toast-container position-fixed top-0" style="z-index: 10;left: 50%;transform: translateX(-50%)">\n' + '<div class="brighttheme-success text-dark toast ui-pnotify-shadow" role="alert" aria-live="assertive" aria-atomic="true" data-delay="' + delay + '">\n' + '<div class="toast-header text-dark bg-transparent rounded">\n' + '<span class="mb-0 mr-2 ui-pnotify-title">' + iconTitle + '</span>\n' + '<span class="mb-0 ui-pnotify-title">' + title + '</span>\n' + '<button type="button" class="ml-4 close" data-dismiss="toast" aria-label="Close"><i class="fal fa-times"></i></button>\n' + '</div>\n' + content + '</div>\n' + '</div>';
    $('body').append(html);
    $('.toast').toast('show');
    setTimeout(function () {
      $('.toast-container').remove();
    }, delay);
  },
  showToastsWarning: function (options) {
    let title = options.title ?? '';
    let iconTitle = options.iconTitle ?? '<i class="fal fa-triangle-exclamation"></i>';
    let iconContent = options.iconContent ?? '';
    let content = options.content ? '<div class="toast-body pt-1"><span class="mr-2">' + iconContent + '</span>' + options.content + '</div>' : '';
    let delay = options.delay ?? 2000;
    var html = '<div aria-live="polite" aria-atomic="true" class="toast-container position-fixed top-0" style="z-index: 10;left: 50%;transform: translateX(-50%)">\n' + '<div class="brighttheme-error shadow text-dark toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="' + delay + '">\n' + '<div class="text-dark bg-transparent toast-header rounded">\n' + '<span class="mb-0 mr-2 ui-pnotify-title">' + iconTitle + '</span>\n' + '<span class="mb-0 ui-pnotify-title">' + title + '</span>\n' + '<button type="button" class="ml-4 close" data-dismiss="toast" aria-label="Close"><i class="fal fa-times"></i></button>\n' + '</div>\n' + content + '</div>\n' + '</div>';
    $('body').append(html);
    $('.toast').toast('show');
    setTimeout(function () {
      $('.toast-container').remove();
    }, delay);
  },
};
var AppBusinessUpload = {
  init: function () {
    if ($('.businessFileUpload').length) {
      $(document).on('change', '.businessFileUpload', function (event) {
        if (AppFuntions.validFileSize($(this), this)) {
          var file_data = $(this).prop("files")[0]
            , file = event.target.files[0]
            , classImage = $(this).parents('.media')
            , form_data = new FormData();
          form_data.append("file", file_data);
          classImage.find('.imageArea img').remove();
          classImage.find('.imageArea i').remove();
          classImage.find('.imageArea').append('<i class="fa fa-spinner fa-spin ml-2"></i>');
          let url = $(this).attr('data-url');
          let dataType = $(this).attr('data-type');
          if (file.type == 'image/gif') {
            var fileData = new FormData();
            fileData.append('name', file.name);
            fileData.append('file_root', file);
            fileData.append('input_val', "image");
            fileData.append('file', file);
            fileData.append('file_type', "gif");
            var options = {
              url: url,
              fileData: fileData,
              classImage: classImage
            }
            AppBusinessUpload.upload(options);
          } else {
            let maxSizeMB = 1;
            if (dataType && dataType == 20) {
              maxSizeMB = 1.4;
            }
            var options = {
              maxSizeMB: maxSizeMB,
              maxWidthOrHeight: 2048,
              fileType: file.type,
              useWebWorker: true,
            };
            imageCompression(file, options).then(function (output) {
              var file_Type = output.type.split('/').pop().toLowerCase();
              var fileData = new FormData();
              fileData.append('name', output.name);
              fileData.append('file_root', file);
              fileData.append('file', output);
              fileData.append('file_type', file_Type);
              var options = {
                url: url,
                fileData: fileData,
                classImage: classImage
              }
              AppBusinessUpload.upload(options);
            }).catch(function (error) {
              alert(error.message);
            });
          }
        }
      });
    }
  },
  upload: function (options) {
    var url = options.url
      , fileData = options.fileData
      , classImage = options.classImage;
    AppAjax.ajax({
      url: url,
      dataType: 'JSON',
      cache: false,
      contentType: false,
      processData: false,
      data: fileData,
      type: 'post',
      success: function (rs) {
        if (rs.code) {
          classImage.find('.fa-spinner').remove();
          classImage.find('.imageArea').empty().append('<img src="' + rs.data.url + '" width="60">');
          $('.filename').attr('data-src', rs.imageName).attr('data-filepath', rs.filePath);
          if (classImage.find('.imageUploadFile').length) {
            classImage.find('.imageUploadFile').val(rs.imageName);
          }
        } else {
          $('.filename').html(rs.messages);
        }
      }
    });
  }
}
var UploadImageModalIndex = {
  init: function () {
    if (!typeof UploadImageModalIndex.file_data || +!UploadImageModalIndex.file_data === 0) {
      UploadImageModalIndex.imageCompressionImage(UploadImageModalIndex.file_data);
    }
  },
  imageCompressionImage: function (file) {
    let url = UploadImageModalIndex.url;
    var options = {
      maxSizeMB: 1,
      maxWidthOrHeight: 2048,
      useWebWorker: true,
      maxIteration: 3,
      fileType: file.type,
    };
    imageCompression(file, options).then(function (output) {
      var file_Type = output.type.split('/').pop().toLowerCase();
      var fileData = new FormData();
      fileData.append('name', output.name);
      fileData.append('file_root', file);
      fileData.append('input_val', "image");
      fileData.append('file', output);
      fileData.append('file_type', file_Type);
      var options = {
        url: url,
        fileData: fileData,
      }
      UploadImageModalIndex.uploadFilesImage(options);
    }).catch(function (error) {
      $('#preview-template').find('.dz-error-message').find('span').html(error.message.join('<br/>'));
    });
  },
  uploadFilesImage: function (options) {
    var url = options.url
      , fileData = options.fileData;
    AppAjax.ajax({
      url: url,
      dataType: 'JSON',
      cache: false,
      contentType: false,
      processData: false,
      data: fileData,
      type: 'post',
      success: function (response) {
        $('#icon--load--image,.icon--load--image').empty();
        var item = $('#preview-template');
        if (typeof response.code != 'undefined') {
          if (response.code) {
            item.find('.thumb-tack-success').show();
            $('#previewContainer, .previewContainer').empty().append('<div style="margin-left: 15px;" class="alert alert-success">Thêm ảnh thành công!</div>');
          } else {
            item.find('.dz-error-message').find('span').html(response.messages.join('<br/>'));
            item.find('.thumb-tack-error').show();
          }
        } else {
          item.find('.dz-error-message').find('span').html('Lỗi khi xử lí ảnh');
          item.find('.thumb-tack-error').show();
        }
      }
    });
  },
}
