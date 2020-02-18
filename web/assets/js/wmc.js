$(document).ready(function() {

  var toursc = false;
  var host = jQuery(location).attr('host');
  var lang = $("#lang").val();
  var locales = {
                  'es' : 'es_MX',
                  'en' : 'en_US',
                  'fr' : 'fr_FR',
                  'de' : 'de_DE' 
  }

  var messages = {
    'es' : 'Preparando pago',
    'en' : 'Processing payment',
    'fr' : 'Préparer le paiement',
    'de' : 'Zahlung wird vorbereitet'
  }
  $(".date").datetimepicker({
    minDate: moment('2020-06-10'),
    maxDate: moment('2020-06-13'),
    defaultDate: moment('2020-06-10'),     
    format: 'DD/MM/YYYY',
    ignoreReadonly: true,
    showTodayButton: false,
    inline: false,
    sideBySide: true,
    debug:false,
    widgetPositioning:{
              horizontal: 'left',
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
      $('#fvalida').formValidation('enableFieldValidators', 'tour_date', true);
      $('#fvalida').formValidation('revalidateField', 'tour_date');              
  });
  
  if ( $("#fvalida").length ){
    $("#fvalida").formValidation({
      framework: 'bootstrap',
      locale: locales[lang],
      fields: {
        'cfullname[]': {
          validators: {
              notEmpty: {
                enabled: true
              }
          }
        },
        'cemail[]': {
          validators: {
              notEmpty: {
                enabled: true
              }
          }
        },
        tour_date:{
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
          message: 'Captcha is invalid',
          language: 'en'
        }*/
      }
    })
    .on('success.field.fv', function(e, data) {
    })
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#fvalida").data('formValidation');
      $("#next").addClass('hidden');
      $("#back").removeClass('hidden');
      $("#continue").removeClass('hidden');
      $("#tourinfo").addClass('hidden');
      $("#comfirm").removeClass('hidden');
      $("#dname").html('<span class="text-base-color">' + $('#name').val() + ' ' + $('#surname').val() + '</span> (' + $('#email').val() +  ')');
      $("#ddate").html('<span class="fa fa-calendar-check-o text-base-color"></span> <span class="text-base-color">Tour date</span> ' + $('#tour_date').val());
      if($( ".companionAdd" ).length > 0){
        var cnames = $('input[name="cfullname[]"]');
        var cmails = $('input[name="cemail[]"]');
        $("#dcompanion ol").html('');
        $("#dcompanion p").html('');
        $( ".companionAdd" ).each(function( index,val ) {
          if(cnames[index].value !== '' && cmails[index].value !== ''){
            $("#dcompanion p").html('<span class="fa fa-user-plus text-base-color"></span> <span class="text-base-color">Companions</span>')
            $("#dcompanion ol").append('<li>'+ cnames[index].value + ' (' + cmails[index].value + ')</li>');
          }
        });
      }

    })
    .on('click', '.addButton', function() {
      var $template   = $('#cTemplate'),
          $clone      = $template
                          .clone()
                          .removeClass('hide companion')
                          .addClass('companionAdd companionPlus')
                          .removeAttr('id')
                          .insertBefore($template),
          $dcompanion = $('.companionAdd');

      $(".addButton").prop('disabled',false).removeClass('disabled');
      if($dcompanion.length >= 4){
        $(".addButton").prop('disabled',true).addClass('disabled');
      }
      $('#fvalida')
          .formValidation('addField', $clone.find('[name="cfullname[]"]'))
          .formValidation('addField', $clone.find('[name="cemail[]"]'))
    })
    .on('click', '.removeButton', function() {
      var $row = $(this).closest('.form-group'),
          $dcompanion = $('.companionAdd');

      if($dcompanion.length <= 4){
        $(".addButton").prop('disabled',false).removeClass('disabled');
      }
      else{
        $(".addButton").prop('disabled',true).addClass('disabled');
      }      

      // Remove fields
      $('#fvalida')
          .formValidation('removeField', $row.find('[name="cfullname[]"]'))
          .formValidation('removeField', $row.find('[name="cemail[]"]'));

      // Remove element containing the fields
      $row.remove();
    })
    .on('click', '#hcompanion', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      var rel = e.attr('data-rel');
      if(st){
        $(".cfullname1").prop('disabled',false).removeClass('disabled');
        $(".cemail1").prop('disabled',false).removeClass('disabled');
        $(".addButton").prop('disabled',false).removeClass('disabled');
        toursc = true;
      }
      else{
        $(".cfullname1").prop('disabled',true).addClass('disabled');
        $(".cemail1").prop('disabled',true).addClass('disabled');
        $(".addButton").prop('disabled',true).addClass('disabled');
        $('#fvalida')
          .formValidation('removeField', $('.companionAdd').find('[name="cfullname[]"]'))
          .formValidation('removeField', $('.companionAdd').find('[name="cemail[]"]'));
        $('.companionAdd').find('[name="cfullname[]"]').val('');
        $('.companionAdd').find('[name="cemail[]"]').val('');          
        $(".companionPlus").remove();
        toursc = false;      
      }
    })
    .on('click', '#continue', function(event) {
      $("#back").addClass('hidden');
      HoldOn.open({
        theme:    "sk-cube-grid",
        message:  "<h3>"  +  messages[lang] + "</h3>"
      });      
      axios.post($("#fvalida").attr('action'),$("#fvalida").serialize())
        .then(function (response) {
          if(response.statusText == 'OK'){
            $("#tpp").height(200);          
            payForm(response.data);
          }
        })
        .catch(function (error) {

        })
        .then(function () {
        });      
    })
    .on('click', '#back', function(event) {
      $("#next").removeClass('hidden');
      $("#next").removeClass('disabled');
      $("#next").prop('disabled',false);
      $("#back").addClass('hidden');
      $("#continue").addClass('hidden');
      $("#tourinfo").removeClass('hidden');
      $("#comfirm").addClass('hidden');      
    });
  };

  function payForm(data){
    appUrl = data.approval.content.links[1].href;
    exeUrl = data.approval.content.links[2].href;
    token  = data.approval.token;
    mode   = data.approval.mode;
    tcom   = (data.tourdata.companion === 0 ) ? 'No' : data.tourdata.companion;
    var pp = PAYPAL.apps.PPP({
      "approvalUrl": appUrl,
      "placeholder": "tpp",
      "mode": mode,
      "payerEmail" : data.tourdata.email,
      "payerFirstName" : data.tourdata.name,
      "payerLastName" : data.tourdata.surname,
      "payerPhone" : data.tourdata.phone,
      "payerTaxId" : "",
      "language" : locales[lang],
      "disableContinue" : "pay",
      "enableContinue": "pay",
      "onLoad" : function(){
        $("#price").html(numeral(data.tourdata.total).format('$0.00') + ' USD');
        $("#tourdes").html('<ul class="list-unstyled margin-11 no-margin-bottom no-margin-rl text-gray-dark2 text-large text-left"><li class="check-mark">' + data.tourdata.rname + '</li><li class="check-mark">' + data.tourdata.name + ' ' + data.tourdata.surname + '</li><li class="check-mark">Companions: ' + tcom + '</li><li class="check-mark">Tour date: ' + data.tourdata.tour_date + '</li></ul>');
        $("#fvalida").remove();
        $("#pay").removeClass("hidden");
        $("#tour-dv").removeClass('col-lg-7 col-md-7 col-sm-12').addClass('col-lg-9 col-md-9 col-sm-12');
        $("#tour-resume").removeClass('col-lg-5 col-md-5 col-sm-12').addClass('col-lg-3 col-md-3 col-sm-12');
        HoldOn.close();
      },
      "onContinue" : function(rememberedCards, payerId, token){
      },
      "onError" : function(err){
        HoldOn.close();
      }
    });

    $("body").on('click', '#pay', function(event) {
      event.preventDefault();
      pp.doContinue();
      HoldOn.open({
        theme:    "sk-cube-grid",
        message:  "<h3>Processing payment</h3>"
      });        
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
        var result    = (dataCheck.result) ? dataCheck.result : {};
        if(result == 'error'){
          HoldOn.close();
        }

        if(action == 'checkout'){
          var obj = {};
          obj['pay_id']   = "PAY-" + result.payer.funding_option.id
          obj['token']    = token;
          obj['payer_id'] = result.payer.payer_info.payer_id;
          obj['exeUrl']   = exeUrl;
          HoldOn.open({
            theme:    "sk-cube-grid",
            message:  "<h3>Processing payment</h3>"
          });
          payExecute(data,obj);                              
        }
      }
      catch (exc) {
      }
    }  
  }

  function payExecute(data,obj){
    var urlExecute  = data.tourdata.urlPayExecute;
    var urlComplete = data.tourdata.urlPayComplete;
    axios.get(urlExecute,{params:{
      pay_id    : obj.pay_id,
      token     : obj.token,
      payer_id  : obj.payer_id,
      exeUrl    : obj.exeUrl
    }
    })
    .then(function (eResponse) {
      if((eResponse.data.code == 200 || eResponse.data.code == 201) && eResponse.data.content.state == "approved" ) {
        obj['sku']  = eResponse.data.content.transactions[0].item_list.items[0].sku;
        obj['st']   = 'Completed';
        obj['tx']   = eResponse.data.content.transactions[0].related_resources[0].sale.id;
        obj['data'] = data;
        $.redirect(urlComplete,obj);   
      }
    })
    .catch(function (error) {
    })
    .then(function () {

    }); 
  }

});