var AppLocation = {
  init: function (options) {
    let elementCountry = options && options.countryId ? options.countryId : '#countryId';
    let elementCity = options && options.cityLocationId ? options.cityLocationId : '#cityLocationId';
    let elementDistrict = options && options.districtLocationId ? options.districtLocationId : '#districtLocationId';
    let elementWard = options && options.wardId ? options.wardId : '#wardLocationId';
    let districtLocationDefault = options && options.districtLocationDefault ? options.districtLocationDefault : '#districtLocationDefault';
    let wardLocationDefault = options && options.wardLocationDefault ? options.wardLocationDefault : '#wardLocationDefault';
    $('body').on('change', elementCountry, function () {
      if ($(this).val() && $(elementCity).length) {
        AppAjax.post('/system/location/load', {
          countryId: $(this).val(),
          type: 'city'
        }, function (data) {
          AppLocation.updateLocationCity(elementCity, data, elementDistrict);
        });
      } else {
        AppLocation.updateLocationCity(elementCity, null, elementDistrict);
      }
    });
    $('body').on('change', elementCity, function () {
      let isValid = true
        , cityId = $(this).val();
      if ($(this).attr('multiple') === 'multiple') {
        if (cityId.length > 1) {
          isValid = false;
        }
      } else if (!cityId) {
        isValid = false;
      }
      if (isValid && $(elementDistrict).length) {
        AppLocation.getLocationDistricts($(this).val(), elementDistrict, $(districtLocationDefault).val(), options);
        $(elementWard).val('');
      } else {
        if ($(elementDistrict).length) {
          $(elementDistrict).html('<option value="" selected> - Quận huyện - </options>');
        }
        if ($(elementWard).length) {
          $(elementWard).html('<option value="" selected> - Phường xã - </options>');
        }
      }
    });
    if ($(elementCity).val() && $(elementDistrict).length) {
      let isValid = true
        , cityId = $(elementCity).val();
      if ($(elementCity).attr('multiple') === 'multiple') {
        if (cityId.length > 1) {
          isValid = false;
        }
      } else if (!cityId) {
        isValid = false;
      }
      if (isValid) {
        AppLocation.getLocationDistricts(cityId, elementDistrict, $(districtLocationDefault).val(), options);
      }
    }
    $('body').on('change', elementDistrict, function () {
      if ($(this).val() && $(elementWard).length) {
        AppLocation.getLocationWards($(this).val(), elementWard);
      } else {
        if ($(elementWard).length) {
          $(elementWard).html('<option value="" selected> - Phường xã - </options>');
        }
      }
    });
    if ($(elementDistrict).val() && $(elementWard).length) {
      AppLocation.getLocationWards($(elementDistrict).val(), elementWard, $(wardLocationDefault).val());
    }
  },
  updateLocationCity: function (id, data, districtLocationId) {
    if ($(id).length) {
      var options = "";
      for (var i in data) {
        options += "<option value='" + i + "'>" + data[i] + "</option>";
      }
      if (!$(id).find('option:first').val()) {
        options = "<option value=''>" + $(id).find('option:first').text() + "</option>" + options;
      }
      $(id).html(options);
      AppLocation.getLocationDistricts($(id).val(), districtLocationId);
    }
  },
  getLocationDistricts: function (cityLocationId, districtLocationId, districtLocationDefault, options) {
    if (!cityLocationId) {
      AppLocation.updateLocationDistrict(districtLocationId, '', districtLocationDefault);
      if (options && options.responseHandler) {
        options.responseHandler();
      }
    } else {
      if (typeof cacheDistricts != 'undefined') {
        $.each(cacheDistricts, function (cId, values) {
          if (cityLocationId == cId) {
            AppLocation.updateLocationDistrict(districtLocationId, values, districtLocationDefault);
            if (options && options.responseHandler) {
              options.responseHandler(values);
            }
          }
        });
      } else {
        AppAjax.post('/system/location/load', {
          cityId: cityLocationId,
          type: 'district'
        }, function (data) {
          AppLocation.updateLocationDistrict(districtLocationId, data, districtLocationDefault);
          if (options && options.responseHandler) {
            options.responseHandler(data);
          }
        });
      }
    }
  },
  updateLocationDistrict: function (id, data, districtLocationDefault) {
    var districtLocationId = districtLocationDefault ? districtLocationDefault : $(id).val();
    if ($(id).length) {
      var options = "";
      if (data) {
        for (var i in data) {
          var selected = districtLocationId == i ? "selected='selected'" : "";
          options += "<option value='" + i + "' " + selected + ">" + data[i] + "</option>";
        }
      }
      if (!$(id).find('option:first').val()) {
        options = "<option value=''>" + $(id).find('option:first').text() + "</option>" + options;
      }
      $(id).html(options);
    }
  },
  getLocationWards: function (districtLocationId, wardId, wardIdDefault) {
    if (!districtLocationId) {
      AppLocation.updateLocationWard(wardId, '', wardIdDefault);
    } else {
      if (typeof cacheWards != 'undefined') {
        $.each(cacheWards, function (dId, values) {
          if (districtLocationId == dId) {
            AppLocation.updateLocationWard(wardId, values, wardIdDefault);
          }
        });
      } else {
        AppAjax.post('/system/location/load', {
          districtId: districtLocationId,
          type: 'ward'
        }, function (data) {
          AppLocation.updateLocationWard(wardId, data, wardIdDefault);
        });
      }
    }
  },
  updateLocationWard: function (id, data, wardIdDefault) {
    var wardId = wardIdDefault ? wardIdDefault : $(id).val();
    if ($(id).length) {
      var options = "";
      if (data) {
        for (var i in data) {
          var selected = wardId == i ? "selected='selected'" : "";
          options += "<option value='" + i + "' " + selected + ">" + data[i] + "</option>";
        }
      }
      if (!$(id).find('option:first').val()) {
        options = "<option value=''>" + $(id).find('option:first').text() + "</option>" + options;
      }
      $(id).html(options);
    }
  }
};
