$(document).ready(function() {
  var host  = jQuery(location).attr('host');
  var hjson = ($("#hjson").val() !== undefined ) ? $.parseJSON($("#hjson").val()) : {} ;
  var asset = $("#asset").val();
  //$('.f-switch').bootstrapSwitch('state', false, false);
  $("#habitacion").val('');

  $(".f-switch").bootstrapSwitch({
    onSwitchChange: function(event, state) {
      if(state == true){
        $("#fact").removeClass('invisible');
        $('#frmreg').formValidation('enableFieldValidators', 'fact', true);
        $('#frmreg').formValidation('revalidateField', 'fact');
        $('#frmreg').formValidation('enableFieldValidators', 'factura_correo', true);
        $('#frmreg').formValidation('revalidateField', 'factura_correo');
      }
      else{
        $("#fact").addClass('invisible');
        $('#frmreg').formValidation('enableFieldValidators', 'fact', false);
        $('#frmreg').formValidation('revalidateField', 'fact');
        $('#frmreg').formValidation('enableFieldValidators', 'factura_correo', false);
        $('#frmreg').formValidation('revalidateField', 'factura_correo');
        $("#factura_correo").val('');
        $(".fact").val('');
      }
    },
    onInit: function(event, state) {
      //$(".f-switch").bootstrapSwitch('state', false, false);
    }
  });

  if ( $("#frmreg").length ){
    $("#frmreg").formValidation({
      framework: 'bootstrap4',
      locale: 'es_ES',
      fields: {
        date:{
          selector: '.date',
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        datec:{
          selector: '.date',
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },        
        hour:{
          selector: '.hour',
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        hourc:{
          selector: '.hourc',
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },        
        fact:{
          selector: '.fact',
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        factura_correo:{
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        correo_aco:{
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        aco:{
          selector: '.aco',
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        }
      },
      addOns: {
        reCaptcha2: {
          element: 'captchaContainer',
          theme: 'clean',
          siteKey: (host == 'localhost') ? '6LeTACUTAAAAABdKkPPyxt71S91_xFTCz92MGw-n' : '6LeYoEMUAAAAAOJoJPemnWI8JHE4yfNMtpgR_vgU',
          timeout: 120,
          message: 'El captcha no es valido',
          language: 'es'
        }
      }
    })
    .on('success.field.fv', function(e, data) {
    })
    .on('err.field.fv', function(e, data) {

    })
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#frmk").data('formValidation');
      $("#sendk").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Enviando');
      $("#sendk").addClass('disabled');
      $("#sendk").attr('disabled', 'disabled');
      $.ajax({
        url: $("#frmreg").attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $("#frmreg").serialize(),
        success: function(result) {
          if(result.status){
            $("#sendk").find('div').html('Enviar');
            $("#sendk").addClass('disabled');
            $("#sendk").attr('disabled', 'disabled');
            $("#frmdiv").remove();
            $("#mailf").html(result.data.correo);
            $("#result").removeClass('invisible');
            $("#divPay").removeClass('invisible');
            $("#hname").html(result.rq.habitaciont);
            $("#hsubtotal").html(result.rq.subt);
            $("#hiva").html(result.rq.iva);
            $("#htotal").html(result.rq.tot);
            if(result.rq.habitacion == 'Doble'){
              $("#stotal").html("TOTAL x 2");
            }
            var urlExecute  = result.rq.urlExecute;
            var urlComplete = result.rq.urlComplete;
            var idr         = result.data.id_registro
            if(result.data.factura_pago == 'Tarjeta de crédito'){
              $("#bpk").addClass('invisible');
              $("#pay").html($("#ttc").html());
              /*blk('divPay','Preparando');
              $("#bpk").removeClass('invisible');
              axios.get(result.rq.urlCheckout,{
                  params:{
                    tot: result.rq.tot,
                    hab: hjson[result.rq.habitacion],
                    id:  result.data.id_registro
                  }
                })
                  .then(function (response) {
                    $appUrl = response.data.content.links[1].href;
                    $exeUrl = response.data.content.links[2].href;
                    $token  = response.data.token;
                    $mode   = response.data.mode;
                    var pp = PAYPAL.apps.PPP({
                              "approvalUrl": $appUrl,
                              "placeholder": "pay",
                              "mode": $mode,
                              "payerEmail" : result.rq.correo,
                              "payerFirstName" : result.rq.nombre,
                              "payerLastName" : result.rq.apellidos,
                              "payerPhone" : result.rq.telefono,
                              "payerTaxId" : "",
                              "language" : 'es_MX',
                              "disableContinue" : "bpk",
                              "enableContinue": "bpk",
                              "onLoad" : function(){
                                $("#divPay").unblock();
                              },
                              "onContinue" : function(rememberedCards, payerId, token){
                              },
                              "onError" : function(err){
                                console.log(err);
                              }
                    });

                    $("body").on('click', '#bpk', function(event) {
                      event.preventDefault();
                      pp.doContinue();
                    });

                    if (window.addEventListener) {
                      window.addEventListener("message", messageListener, false);
                    }
                    else if (window.attachEvent) {
                      window.attachEvent("onmessage", messageListener);
                    }
                    else {
                    }

                    function messageListener(event) {
                      try {
                        var dataCheck = JSON.parse(event.data);
                        var action    = dataCheck.action;
                        var _result_  = (dataCheck.result) ? dataCheck.result : {};
                        if(action == 'checkout'){
                          var obj = {};
                          obj['pay_id']   = "PAY-" + _result_.payer.funding_option.id
                          obj['token']    = $token;
                          obj['payer_id'] = _result_.payer.payer_info.payer_id;
                          obj['exeUrl']   = $exeUrl;
                          blk('divPay','Procesando');
                          axios.get(result.rq.urlExecute,{params:{
                            pay_id    : obj['pay_id'],
                            token     : obj['token'],
                            payer_id  : obj['payer_id'],
                            exeUrl    : obj['exeUrl']
                          }
                          })
                          .then(function (eResponse) {
                            var objr = {}
                            objr['code']    = eResponse.data.content.transactions[0].item_list.items[0].sku;
                            objr['st']      = 'Completed';
                            objr['tx']      = eResponse.data.content.transactions[0].related_resources[0].sale.id;
                            objr['item']    = eResponse.data.content.transactions[0].item_list.items[0].description;
                            objr['amount']  = eResponse.data.content.transactions[0].amount.total;
                            objr['idr']     = idr;
                            $.redirect(urlComplete,objr);
                          })
                          .catch(function (error) {
                          })
                          .then(function(){
                          });
                        }
                      }
                      catch (exc) {
                      }
                    }

                  })
                  .catch(function (error) {
                  })
                  .then(function () {
                  });*/
            }
            else{//Depósito bancario
              $("#bpk").addClass('invisible');
              $("#pay").html($("#tdb").html());
            }
          }
        }
      });
    });
  }

  if ( $("#frmcontact").length ){

    $("#frmcontact").formValidation({
      framework: 'bootstrap4',
      locale: 'es_ES',
      fields: {
      },
      addOns: {
        reCaptcha2: {
          element: 'captchaContainerC',
          theme: 'clean',
          siteKey: (host == 'localhost') ? '6LeTACUTAAAAABdKkPPyxt71S91_xFTCz92MGw-n' : '6LeYoEMUAAAAAOJoJPemnWI8JHE4yfNMtpgR_vgU',
          timeout: 120,
          message: 'El captcha no es valido',
          language: 'es'
        }
      }
    })
    .on('success.field.fv', function(e, data) {
    })
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#frmcontact").data('formValidation');
      $("#sendc").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Enviando');
      $("#sendc").addClass('disabled');
      $("#sendc").attr('disabled', 'disabled');
      $.ajax({
        url: $("#frmcontact").attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $("#frmcontact").serialize(),
        success: function(result) {
          if(result.status){
            $("#sendc").find('div').html('Enviar');
            $("#sendc").addClass('disabled');
            $("#sendc").attr('disabled', 'disabled');
            $("#dvcontact").remove();
            $("#resultc").removeClass('invisible');
          }
        }
      });
    });
  };

  $(".date").datetimepicker({
      minDate: moment('2019-01-16'),
      maxDate: moment('2019-01-19'),
      format: 'DD/MM/YYYY',
      locale: 'es',
      ignoreReadonly: true,
      showTodayButton: false,
      //toolbarPlacement:'top',
      widgetPositioning:{
                horizontal: 'right',
                vertical: 'top'
            },
      icons: {
        time: 'fa fa-clock',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
      }
    })
    .on('dp.change', function(ec) {
      $('#frmreg').formValidation('enableFieldValidators', 'date', true);
      $('#frmreg').formValidation('revalidateField', 'date');
    });

  $(".datec").datetimepicker({
      minDate: moment('2019-01-16'),
      maxDate: moment('2019-01-19'),
      format: 'DD/MM/YYYY',
      locale: 'es',
      ignoreReadonly: true,
      showTodayButton: false,
      //toolbarPlacement:'top',
      widgetPositioning:{
                horizontal: 'right',
                vertical: 'top'
            },
      icons: {
        time: 'fa fa-clock',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
      }
    })
    .on('dp.change', function(ec) {
      $('#frmreg').formValidation('enableFieldValidators', 'datec', true);
      $('#frmreg').formValidation('revalidateField', 'datec');
    });



    $(".hour").datetimepicker({
      format: 'H:mm',
      useCurrent: true,
      locale: 'es',
      ignoreReadonly: true,
      //toolbarPlacement:'top',
      widgetPositioning:{
                horizontal: 'right',
                vertical: 'top'
            },
      icons: {
        time: 'fa fa-clock',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up black',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
      }
    })
    .on('dp.change', function(ec) {
      $('#frmreg').formValidation('enableFieldValidators', 'hour', true);
      $('#frmreg').formValidation('revalidateField', 'hour');
    });


    $(".hourc").datetimepicker({
      format: 'H:mm',
      useCurrent: true,
      locale: 'es',
      ignoreReadonly: true,
      //toolbarPlacement:'top',
      widgetPositioning:{
                horizontal: 'right',
                vertical: 'top'
            },
      icons: {
        time: 'fa fa-clock',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up black',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
      }
    })
    .on('dp.change', function(ec) {
      $('#frmreg').formValidation('enableFieldValidators', 'hourc', true);
      $('#frmreg').formValidation('revalidateField', 'hourc');
    });

  $("#habitacion").change(function(event) {
    var e = $(this);
    if(e.val() == 'Doble'){
      $("#divaco").removeClass("invisible");
      $('#frmreg').formValidation('enableFieldValidators', 'aco', true);
      $('#frmreg').formValidation('revalidateField', 'aco');
      $('#frmreg').formValidation('enableFieldValidators', 'correo_aco', true);
      $('#frmreg').formValidation('revalidateField', 'correo_aco');
      $("#subt").val(hjson[e.val()].subtotal);
      $("#iva").val(hjson[e.val()].IVA);
      $("#tot").val(numeral(hjson[e.val()].total).multiply(2).format('0,0.00'));
      $("#habitaciont").val(hjson[e.val()].name);
    }
    if(e.val() == 'Sencilla'){
      $("#divaco").addClass("invisible");
      $('#frmreg').formValidation('enableFieldValidators', 'aco', false);
      $('#frmreg').formValidation('revalidateField', 'aco');
      $('#frmreg').formValidation('enableFieldValidators', 'correo_aco', false);
      $('#frmreg').formValidation('revalidateField', 'correo_aco');
      $(".aco").val('');
      $("#correo_aco").val('');
      $("#subt").val(hjson[e.val()].subtotal);
      $("#iva").val(hjson[e.val()].IVA);
      $("#tot").val(numeral(hjson[e.val()].total).multiply(1).format('0,0.00'));
      $("#habitaciont").val(hjson[e.val()].name);
    }
    if(e.val() == ''){
      $("#divaco").addClass("invisible");
      $('#frmreg').formValidation('enableFieldValidators', 'aco', false);
      $('#frmreg').formValidation('revalidateField', 'aco');
      $('#frmreg').formValidation('enableFieldValidators', 'correo_aco', false);
      $('#frmreg').formValidation('revalidateField', 'correo_aco');
      $("#subt").val('');
      $("#iva").val('');
      $("#tot").val('');
      $("#habitaciont").val('');
      $(".aco").val('');
    }
  });

  function blk(dv,st){
    $("#" + dv).block({
      message: '<h5>' + st + ' pago</h5> <img src="../assets/img/F-1s-200px.svg" height="24">',
      css: {
        border:           'none',
        padding:          '15px',
        backgroundColor:  '#000',
        'border-radius':  '10px',
        opacity:          0.8,
        color:            '#fff',
        top:              '10px'
      },
      overlayCSS:  {
        backgroundColor:  '#fff',
        opacity:          0.8
      }
    });
  }

  if ( $(".flat-map").length ){
    var googleMap = function () {
        // gmap default
        if ($().gmap3) {
            var data = JSON.parse('[{"address":"Boulevard Kukulcan km. 17 CP: 77500, Cancún, México","content":""}]');
            $(".flat-map")
            .gmap3({
                map: {
                    options: {
                        zoom: 10,
                        center: [21.067075,-86.778717,14],
                        zoom:17,
                        mapTypeId: 'Iberostar',
                        mapTypeControlOptions: {
                            mapTypeIds: ['Iberostar', google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID]
                        },
                        scrollwheel: true
                    },
                },
            });

        }
        // json loop
        $.each(data, function (key, val) {
            $('.flat-map').gmap3({
                marker: {
                    values: [{
                        address: val.address,
                        options: {
                            icon: "../assets/img/icon-map.png"
                        }

                    }]
                },
                styledmaptype: {
                    id: "Iberostar",
                    options: {
                        name: "Iberostar"
                    },
                    /*styles: [
                    {
                        "featureType": "administrative",
                        "elementType": "all",
                        "stylers": [
                        {
                            "saturation": "-100"
                        }
                        ]
                    },
                    {
                        "featureType": "administrative.province",
                        "elementType": "all",
                        "stylers": [
                        {
                            "visibility": "off"
                        }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 65
                        },
                        {
                            "visibility": "on"
                        }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": "50"
                        },
                        {
                            "visibility": "simplified"
                        }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [
                        {
                            "saturation": "-100"
                        }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [
                        {
                            "visibility": "simplified"
                        }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "all",
                        "stylers": [
                        {
                            "lightness": "30"
                        }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "all",
                        "stylers": [
                        {
                            "lightness": "40"
                        }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "visibility": "simplified"
                        }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                        {
                            "hue": "#ffff00"
                        },
                        {
                            "lightness": -25
                        },
                        {
                            "saturation": -97
                        }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels",
                        "stylers": [
                        {
                            "lightness": -25
                        },
                        {
                            "saturation": -100
                        }
                        ]
                    }
                    ]*/
                }
            });
        });
    };

    googleMap();
  }

});
