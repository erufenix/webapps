$(document).ready(function() {
  var hoteles       = $("#hoteles").val();
  var transfer      = $("#transferJson").val();
  var hotelesJson   = $.parseJSON(hoteles);
  var transferJson  = $.parseJSON(transfer);
  var asset         = $("#asset").val();
  var host = jQuery(location).attr('host');
  $("#hotel").val('');
  $("#transfer").val('');
  $("#imgHotel").attr('src',asset + '/img/hotel/radla18/source.png');
  $("#imgHotel").attr('alt','source.png');
  $("#imgHotel").attr('title','source.png');
  $("#image-caption").html('Seleccionar hotel');
  $(".departure").val(''); 

  $("#hotel").change(function(event) {
    var e = $(this);
    var id = $(this).val();
    if(id != 0){
      var img = hotelesJson[id]['img'];
      var nombre = hotelesJson[id]['nombre'];      
      $("#imgHotel").attr('src',asset + '/img/hotel/aippi/' + img);
      $("#imgHotel").attr('alt',img);
      $("#imgHotel").attr('title',img);
      $("#image-caption").html(nombre);
      $("#hotelName").val(nombre);
      $("#hotelImg").val(img);
    }
    else{
      $("#imgHotel").attr('src',asset + '/img/hotel/radla18/source.png');
      $("#imgHotel").attr('alt','source.png');
      $("#imgHotel").attr('title','source.png');
      $("#image-caption").html('Seleccionar hotel');
      $("#hotelName").val('');
      $("#hotelImg").val('');    
    } 
  });

  $("#arrive_date").datetimepicker({
    minDate: moment('2018-09-18'),
    maxDate: moment('2018-09-30'),       
    format: 'DD/MM/YYYY',
    ignoreReadonly: true,
    showTodayButton: false,
    widgetPositioning:{
              horizontal: 'right',
              vertical: 'bottom'
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
  .on('dp.change', function() { 
      $('#trp').formValidation('enableFieldValidators', 'arrive_date', true);
      $('#trp').formValidation('revalidateField', 'arrive_date');
      $('#trp').formValidation('enableFieldValidators', 'arrive_time', true);
      $('#trp').formValidation('revalidateField', 'arrive_time');      
      //$('#trp').formValidation('enableFieldValidators', 'departure_date', true);
      //$('#trp').formValidation('revalidateField', 'departure_date');              
  });  

  $("#arrive_time").datetimepicker({
    format: 'HH:mm',
    ignoreReadonly: true,
    widgetPositioning:{
              horizontal: 'right',
              vertical: 'bottom'
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
  .on('dp.change', function() {
      $('#trp').formValidation('enableFieldValidators', 'arrive_time', true);
      $('#trp').formValidation('revalidateField', 'arrive_time');
      $('#trp').formValidation('enableFieldValidators', 'arrive_date', true);
      $('#trp').formValidation('revalidateField', 'arrive_date');      
      //$('#trp').formValidation('enableFieldValidators', 'departure_time', true);
      //$('#trp').formValidation('revalidateField', 'departure_time'); 
  });

  $("#departure_date").datetimepicker({
    //defaultDate: moment('0000-00-00'),
    minDate: moment('2018-09-18'),
    maxDate: moment('2018-09-30'),       
    format: 'DD/MM/YYYY',
    ignoreReadonly: true,
    showTodayButton: false,
    widgetPositioning:{
              horizontal: 'right',
              vertical: 'bottom'
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
  .on('dp.change', function() { 
      $('#trp').formValidation('enableFieldValidators', 'departure_date', true);
      $('#trp').formValidation('revalidateField', 'departure_date');
      $('#trp').formValidation('enableFieldValidators', 'departure_time', true);
      $('#trp').formValidation('revalidateField', 'departure_time');      
      //$('#trp').formValidation('enableFieldValidators', 'departure_date', true);
      //$('#trp').formValidation('revalidateField', 'departure_date');              
  });  

  $("#departure_time").datetimepicker({
    format: 'HH:mm',
    ignoreReadonly: true,
    widgetPositioning:{
              horizontal: 'right',
              vertical: 'bottom'
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
  .on('dp.change', function() {
      $('#trp').formValidation('enableFieldValidators', 'departure_time', true);
      $('#trp').formValidation('revalidateField', 'departure_time');
      $('#trp').formValidation('enableFieldValidators', 'departure_date', true);
      $('#trp').formValidation('revalidateField', 'departure_date');     
      //$('#trp').formValidation('enableFieldValidators', 'departure_time', true);
      //$('#trp').formValidation('revalidateField', 'departure_time'); 
  });


  $("#transfer").change(function(event) {
    var e = $(this);
    var i = $(this).val();
    rated(i);      
  });

  $("#arrive_persons").change(function(event) {
    var i = $("#transfer").val();
    rated(i);
  });

  $("#departure_persons").change(function(event) {
    var i = $("#transfer").val();
    var v = $(this).val();
    if(v != 0){
      $(".departure").prop('disabled', false);
      $('#trp').formValidation('enableFieldValidators', 'departure', true);
      $('#trp').formValidation('revalidateField', 'departure');    
      rated(i);
    }
    else{
      $('#trp').formValidation('enableFieldValidators', 'departure', false);
      $('#trp').formValidation('revalidateField', 'departure');
      $(".departure").val('');
      $(".departure").prop('disabled', true);
      rated(i);        
    }
  });

  $("body").on('click', '#bcheckbox', function(event) {
    if($('#bcheckbox').is(':checked')){
      $("#billing").removeClass('hidden');
      $("#bemail").val($("#email").val());
      $('#trp').formValidation('enableFieldValidators', 'billing', true);
      $('#trp').formValidation('revalidateField', 'billing');
      $('#trp').formValidation('enableFieldValidators', 'bemail', true);
      $('#trp').formValidation('revalidateField', 'bemail');                  
    }
    else{
      $("#billing").addClass('hidden');
      $('#trp').formValidation('enableFieldValidators', 'billing', false);
      $('#trp').formValidation('revalidateField', 'billing');
      $('#trp').formValidation('enableFieldValidators', 'bemail', false);
      $('#trp').formValidation('revalidateField', 'bemail');                 
      $(".billing").val('');      
    }
  });  


  function rated(type){
    var rated_arrive    = 0;
    var rated_departure = 0;
    var p_arrive        = $("#arrive_persons").val();
    var p_departure     = $("#departure_persons").val();
    var c               = 0;
    var v_arrive        = 0;
    var v_departure     = 0;
    var total           = 0;
    switch (type) {
      case 'shared':
        c = transferJson['shared'].value;
        v_arrive    = (c*1)*p_arrive/2;
        //v_departure = (c*1)*p_departure/2;
        v_departure = v_arrive;
        $("#departure_persons").val($("#arrive_persons").val());
        $('#trp').formValidation('enableFieldValidators', 'departure', false);
        $('#trp').formValidation('revalidateField', 'departure');
        $(".departure").prop('disabled', false);
      break;
      case 'private':
        c = transferJson['private'].value;
        v_arrive = c;
        if(p_departure == 0){
          v_departure = 0;
          v_arrive = c;
        }
        else{
          v_arrive = c/2;
          v_departure = v_arrive;
        }
      break;      
      default:
        v_arrive = 0
        v_departure = 0;
      break;
    }
    total = v_arrive + v_departure;
    $("#ttotal").html(numeral(total).format('$0.00') + ' USD')
    $("#total").val(numeral(total).format('0.00'));
    $("#arrive_rate").val(numeral(v_arrive).format('0.00'));
    $("#departure_rate").val(numeral(v_departure).format('0.00'));
  }

  if ( $("#trp").length ){

    $("#trp").formValidation({
      framework: 'bootstrap',
      locale: 'es_ES',
      fields: {
        departure:{
          selector: '.departure',
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        departure_date:{
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        departure_time:{
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        billing:{
          selector: '.billing',
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        bemail:{
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        }
      },
      addOns: {
        /*reCaptcha2: {
          element: 'captchaContainer',
          theme: 'clean',
          siteKey: (host == 'localhost') ? '6LeTACUTAAAAABdKkPPyxt71S91_xFTCz92MGw-n' : '6LeYoEMUAAAAAOJoJPemnWI8JHE4yfNMtpgR_vgU',
          timeout: 120,
          message: 'No valid captcha',
          language: 'en'
        }*/
      }              
    })
    .on('success.field.fv', function(e, data) {
    })            
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#trp").data('formValidation');

      $("#v_hotel div").html(hotelesJson[$("#hotel").val()].nombre);
      $("#v_hotel img").attr('src', $("#imgHotel").attr('src'));

      $("#v_transfer small").html(transferJson[$("#transfer").val()].text);

      $("#v_arrive_persons").html($("#arrive_persons").val());
      $("#v_arrive_airline").html($("#arrive_airline").val());
      $("#v_arrive_fly").html($("#arrive_fly").val());
      $("#v_arrive_date_time").html($("#arrive_date").val() + " - " + $("#arrive_time").val());
      //$("#v_arrive_time").html($("#arrive_time").val());
      $("#v_arrive_rate").html($("#arrive_rate").val());


      $("#v_departure_persons").html($("#departure_persons").val());
      $("#v_departure_airline").html($("#departure_airline").val());
      $("#v_departure_fly").html($("#departure_fly").val());
      $("#v_departure_date_time").html($("#departure_date").val() + " - " + $("#departure_time").val() );
      //$("#v_departure_time").html($("#departure_time").val());
      $("#v_departure_rate").html($("#departure_rate").val());

      $("#v_name").html($("#name").val());
      $("#v_phone").html($("#phone").val());
      $("#v_email").html($("#email").val());
      $("#v_total").html(numeral($("#total").val()).format('$0.00') + " USD");
      $(".tbilling").addClass('hidden');
      if($("#rfc").val() != ''){
        $(".tbilling").removeClass('hidden');
        $("#v_rfc").html($("#rfc").val());
        $("#v_company").html($("#company").val());
        $("#v_country").html($("#country").val());
        $("#v_bemail").html($("#bemail").val());
        $("#v_city").html($("#city").val());
        $("#v_state").html($("#state").val());
        $("#v_address").html($("#address").val());
        $("#v_bphone").html($("#bphone").val());
        $("#v_cp").html($("#cp").val());
      }

      $("#tab_comfirm a").removeClass('disabledTab');
      $('#tab_comfirm a').tab('show');
      $('#tab_comfirm').addClass('active');
      $("#tab_transport a").removeClass('active')
      $("#tab_transport a").addClass('disabledTab');
      $("#tab_transport").removeClass('active');
      $("#next").addClass('hidden');
      $("#back").removeClass('hidden');
      $("#pay").removeClass('hidden');       
    });

    $("body").on('click', '#back', function(event) {
        event.preventDefault();
        $("#tab_comfirm a").addClass('disabledTab');
        $('#tab_comfirm').removeClass('active');
        $("#tab_transport a").addClass('active')
        $("#tab_transport a").removeClass('disabledTab');
        $("#tab_transport a").tab('show');
        $("#tab_transport").addClass('active');
        $("#next").removeClass('hidden');
        $("#next").removeClass('disabled');
        $("#next").removeAttr('disabled');
        $("#back").addClass('hidden');
        $("#pay").addClass('hidden');
    });

    $("body").on('click', '#pay', function(event) {
      event.preventDefault();
      $('#pay').find("div").html("<span class='fa fa-circle-o-notch fa-spin'></span> Saving data");
      $('#pay').attr('disabled', 'disabled');
      $("#checkout-message").block({
            message: '<h2>Saving data</h2> <img src="'+ asset +'/img/F-1s-200px.svg" height="48">',
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
      axios.post($("#trp").attr('action'),$("#trp").serialize())
        .then(function (response) {
          if(response.data.status){
            $("#checkout-message").remove();
            $("#back").addClass('hidden');
            $('#pay').addClass('hidden');
            $('#payF').removeClass('hidden');
            var data = response.data.data;
            var urlExecute  = response.data.urlExecute;
            var urlComplete = response.data.urlComplete;
            var idTransport = data.tranport_id;
            $("#ppp").removeClass("hidden");
            $("#ppp").height(200);
            $("#ppp").block({
              message: '<h3>Checkout</h3> <img src="'+ asset +'/img/F-1s-200px.svg" height="48">',
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
            axios.get(response.data.urlChekout,{params:{id:response.data.data.tranport_id}})
              .then(function (response) {               
                $appUrl = response.data.content.links[1].href;
                $exeUrl = response.data.content.links[2].href;
                $token 	= response.data.token;
                $mode   = response.data.mode;        
                var pp = PAYPAL.apps.PPP({
                          "approvalUrl": $appUrl,
                          "placeholder": "ppp",
                          "mode": $mode,
                          "payerEmail" : data.email,
                          "payerFirstName" : data.name,
                          "payerLastName" : data.name,
                          "payerPhone" : data.phone,
                          "payerTaxId" : "",
                          "language" : 'en_US',
                          "disableContinue" : "payF",
                          "enableContinue": "payF",
                          "onLoad" : function(){
                            $("#ppp").unblock();
                          },
                          "onContinue" : function(rememberedCards, payerId, token){
                          },
                          "onError" : function(err){
                          }
                });
                $("body").on('click', '#payF', function(event) {
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
                    var action = dataCheck.action;
                    var result = (dataCheck.result) ? dataCheck.result : {};
                    if(action == 'checkout'){
                      var obj = {};
                      obj['pay_id']   = "PAY-" + result.payer.funding_option.id
                      obj['token']    = $token;
                      obj['payer_id'] = result.payer.payer_info.payer_id;
                      obj['exeUrl']   = $exeUrl;
                          $("#ppp").block({
                            message: '<h3>Processing payment</h3> <img src="'+ asset +'/img/F-1s-200px.svg" height="48">',
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
                      axios.get(urlExecute,{params:{
                          pay_id    : "PAY-" + result.payer.funding_option.id,
                          token     : $token,
                          payer_id  : result.payer.payer_info.payer_id,
                          exeUrl    : $exeUrl
                        }
                        })
                        .then(function (eResponse) {
                          if((eResponse.data.code == 200 || eResponse.data.code == 201) && eResponse.data.content.state == "approved" ) {
                            var objr = {}
                            objr['code']  = eResponse.data.content.transactions[0].item_list.items[0].sku;
                            objr['st']  = 'Completed';
                            objr['tx']    = eResponse.data.content.transactions[0].related_resources[0].sale.id;
                            $.redirect(urlComplete,objr);  
                          }
                        })
                        .catch(function (error) {
                        })
                        .then(function () {
                          $("#ppp").block({
                            message: '<h3>Processing payment</h3> <img src="'+ asset +'/img/F-1s-200px.svg" height="48">',
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
                $("#ppp").height(500); 
                $("#ppp").block({
                  message: '<h3>Checkout</h3> <img src="'+ asset +'/img/F-1s-200px.svg" height="48">',
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
              });
          }
        })
        .catch(function (error) {
        });     
    });
  }
});