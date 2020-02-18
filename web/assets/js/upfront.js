$(document).ready(function() {
  if ( $("#fupfront").length ){

    $("#fupfront").formValidation({
      framework: 'bootstrap',
      locale: 'es_ES',
      fields: {
      },
      /*addOns: {
        reCaptcha2: {
          element: 'captchaContainerC',
          theme: 'clean',
          siteKey: (host == 'localhost') ? '6LeTACUTAAAAABdKkPPyxt71S91_xFTCz92MGw-n' : '6LeYoEMUAAAAAOJoJPemnWI8JHE4yfNMtpgR_vgU',
          timeout: 120,
          message: 'El captcha no es valido',
          language: 'es'
        }
      }*/
    })
    .on('success.field.fv', function(e, data) {
    })
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#fupfront").data('formValidation');
      $("#send").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Enviando');
      $("#send").addClass('disabled');
      $("#send").attr('disabled', 'disabled');
      axios.post($("#fupfront").attr('action'),$("#fupfront").serialize())
        .then(function (response) {
          if(response.statusText == 'OK'){
            $.redirect(response.data.data.urlComplete,response.data.data);
          }
        })
        .catch(function (error) {

        })
        .then(function () {
        });      
    });
  }


  if ( $("#fvalida").length ){
    $("#fvalida").formValidation({
      framework: 'bootstrap',
      locale: 'es_ES',
      fields: {
      },
    })
    .on('success.field.fv', function(e, data) {
    })
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#fvalida").data('formValidation');
      $("#sendv").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Validando');
      $("#sendv").addClass('disabled');
      $("#sendv").attr('disabled', 'disabled');
      axios.post($("#fvalida").attr('action'),$("#fvalida").serialize())
        .then(function (response) {
          $("#merr").html('');
          if(response.statusText == 'OK'){
            var data = response.data;
            if(data.status == true){
              $("#mvalida").remove();
              $(".contact-content").removeClass('invisible');
              $("#merr").html('');
              $("#correo").val(data.data.correo);
              $("#id_clave").val(data.data.idClave);
            }
            else{
              $("#merr").html('El correo no es valido o ya fue registrado')
              $("#sendv").find('div').html('Validar');
            }
          }
        })
        .catch(function (error) {

        })
        .then(function () {
        });      
    });
  }

});