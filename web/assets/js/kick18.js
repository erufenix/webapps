var host = jQuery(location).attr('host');
if ( $("#frmk").length ){

  $("#frmk").formValidation({
    framework: 'bootstrap4',
    locale: 'es_ES',
    fields: {
      dates:{
        selector: '.dates',
        validators: {
          notEmpty: {
            enabled: true
          }
        }
      },
      horas:{
        selector: '.horas',
        validators: {
          notEmpty: {
            enabled: true
          }
        }
      },
      datesa:{
        selector: '.datesa',
        validators: {
          notEmpty: {
            enabled: true
          }
        }
      },
      horasa:{
        selector: '.horasa',
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
      },
      acoCorreo:{
        validators: {
          notEmpty: {
            enabled: true
          }
        }        
      }                                                                      
    },
    addOns: {
      reCaptcha2: {
        element: 'captchaContainer1',
        theme: 'clean',
        siteKey: (host == 'localhost') ? '6LeTACUTAAAAABdKkPPyxt71S91_xFTCz92MGw-n' : '6Le3Uh0TAAAAAIL5BEa-c1ZMCDzGuZSeL-cHx0DF',
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
      url: $("#frmk").attr('action'),
      type: 'POST',
      dataType: 'json',
      data: $("#frmk").serialize(),
      success: function(result) {
        if(result.status){
          $("#sendk").find('div').html('Enviar');
          $("#sendk").addClass('disabled');
          $("#sendk").attr('disabled', 'disabled');
          $("#frmk").remove();
          $("#nmail").html(result.data.correo);
          $("#resultk").removeClass('hidden');
        }
      }
    });         
  });

  $(".dates").datetimepicker({
    //minDate: moment('2018-02-01'),
    //maxDate: moment('2018-02-14'),
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
    $('#frmk').formValidation('enableFieldValidators', 'dates', true);
    $('#frmk').formValidation('revalidateField', 'dates');
  });

  $(".horas").datetimepicker({
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
    $('#frmk').formValidation('enableFieldValidators', 'horas', true);
    $('#frmk').formValidation('revalidateField', 'horas');     
  });

  $(".datesa").datetimepicker({
    //minDate: moment('2018-02-01'),
    //maxDate: moment('2018-02-14'),
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
    $('#frmk').formValidation('enableFieldValidators', 'datesa', true);
    $('#frmk').formValidation('revalidateField', 'datesa');
  });

  $(".horasa").datetimepicker({
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
    $('#frmk').formValidation('enableFieldValidators', 'horasa', true);
    $('#frmk').formValidation('revalidateField', 'horasa');     
  });



  $("#habitacion").change(function(event) {
    var e = $(this);
    console.log(e.val());
    if(e.val() == 'Doble'){
      $("#acodiv").removeClass('hidden');
      $("#vtot").html('$24,000.00');
      $("#tot").val('24,000.00');      
      $('#frmk').formValidation('enableFieldValidators', 'aco', true);
      $('#frmk').formValidation('revalidateField', 'aco');
      $('#frmk').formValidation('enableFieldValidators', 'acoCorreo', true);
      $('#frmk').formValidation('revalidateField', 'acoCorreo');          
    }
    if(e.val() == 'Sencilla'){
      $("#acodiv").addClass('hidden');
      $("#vtot").html('$10,000.00');
      $("#tot").val('10,000.00');      
      $('#frmk').formValidation('enableFieldValidators', 'aco', false);
      $('#frmk').formValidation('revalidateField', 'aco');
      $('#frmk').formValidation('enableFieldValidators', 'acoCorreo', false);
      $('#frmk').formValidation('revalidateField', 'acoCorreo');
      $('.aco').val('');                   
    }
    if(e.val() == ''){
      $("#acodiv").addClass('hidden');
      $('#frmk').formValidation('enableFieldValidators', 'aco', false);
      $('#frmk').formValidation('revalidateField', 'aco');
      $('#frmk').formValidation('enableFieldValidators', 'acoCorreo', false);
      $('#frmk').formValidation('revalidateField', 'acoCorreo');       
      $("#vtot").html('');
      $("#tot").val('');
      $('.aco').val('');             
    }    
  });

};   