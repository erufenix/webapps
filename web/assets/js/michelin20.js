$(document).ready(function() {
  var host  = jQuery(location).attr('host');

  if ( $("#fvalida").length ){
    $("#fvalida").formValidation({
      framework: 'bootstrap4',
      locale: 'es_ES',
      fields: {
      },
      addOns: {
      }
    })
    .on('err.field.fv', function(e, data) {
      $("#bvalida").removeClass('disabled');
      $("#bvalida").prop('disabled', 'false');
      $("#bvalida div").html('Validar');
      $("#clave").val('');
    })
    .on('success.field.fv', function(e, data) {
    })
    .on('success.form.fv', function(e) {
      e.preventDefault();
      $("#bvalida div").html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Validando');
      axios.post($("#fvalida").attr('action'),$("#fvalida").serialize())
        .then(function (response) {
          var data = response.data;
          if(data.length != 0 && data.clave != '' ){
            if(data.bloqueada){
              $("#registro").addClass('invisible');
              $("#err").removeClass('invisible');
              $("#fregistro #idClave").val('');
              $("#fregistro #distribuidor").val('');
              $("#fregistro #nombre").val('');
              $("#fregistro #correo").val('');
              $("#fregistro #regDoble").val('');
              $("#bvalida").removeClass('disabled');
              $("#bvalida div").html('Validar');
              $("#clave").val('');
            }
            else{
              $("#valida").remove();
              $("#registro").removeClass('invisible');
              $("#err").addClass('invisible');
              $("#fregistro #idClave").val(data.cv_idClave);
              $("#fregistro #distribuidor").val(data.cv_distribuidor);
              $("#fregistro #nombre").val(data.cv_nombre);
              $("#fregistro #correo").val(data.cv_correo);
              $("#fregistro #regDoble").val(data.cv_regDoble);
              if(data.cv_tipo == 'staff' && data.reg_idClave != null){
                $('#modalCard').modal({
                  keyboard: false,
                  backdrop: 'static',
                  show:true
                })

                $('#modalCard').on('hidden.bs.modal', function (e) {
                  HoldOn.open({
                    theme:    "sk-cube-grid",
                    message:  "<h3>Redireccionando</h3>"
                  });                   
                  window.location.reload();
                })                
              }
            }
          }
          else{
            $("#registro").addClass('invisible');
            $("#err").removeClass('invisible');
            $("#fregistro #idClave").val('');
            $("#fregistro #distribuidor").val('');
            $("#fregistro #nombre").val('');
            $("#fregistro #correo").val('');
            $("#fregistro #regDoble").val('');
            $("#bvalida").removeClass('disabled');
            $("#bvalida").prop('disabled', 'false');
            $("#bvalida div").html('Validar');
            $("#clave").val('');
          }
        })
        .catch(function (error) {

        })
        .then(function () {
          //$("#bvalida div").html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Validando');
        });
    })
  }

  if ( $("#fvalidad").length ){
    $("#fvalidad").formValidation({
      framework: 'bootstrap4',
      locale: 'es_ES',
      fields: {
      },
      addOns: {
      }
    })
    .on('err.field.fv', function(e, data) {
      $("#bvalida").removeClass('disabled');
      $("#bvalida").prop('disabled', 'false');
      $("#bvalida div").html('Validar');
      $("#clave").val('');
    })
    .on('success.field.fv', function(e, data) {
    })
    .on('success.form.fv', function(e) {
      e.preventDefault();
      $("#bvalida div").html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Validando');
      axios.post($("#fvalidad").attr('action'),$("#fvalidad").serialize())
        .then(function (response) {
          var data = response.data;
          if(data.length != 0 && data.clave != '' ){
            if(data.bloqueada){
              $("#registro").addClass('invisible');
              $("#err").removeClass('invisible');
              $("#fdatos #idClave").val('');
              $("#fdatos #distribuidor").val('');
              $("#fdatos #nombre").val('');
              $("#fdatos #correo").val('');
              $("#fdatos #regDoble").val('');
              $("#bvalida").removeClass('disabled');
              $("#bvalida div").html('Validar');
              $("#clave").val('');
            }
            else{
              $("#valida").remove();
              $("#registro").removeClass('invisible');
              $("#err").addClass('invisible');
              $("#fdatos #idClave").val(data.cv_idClave);
              $("#fdatos #distribuidor").val(data.reg_distribuidor);
              $("#fdatos #nombre").val(data.reg_nombre);
              $("#fdatos #correo").val(data.reg_correo);
              $("#fdatos #celular").val(data.reg_celular);
              $("#fdatos #contacto").val(data.reg_contacto);
              $("#fdatos #regDoble").val(data.cv_regDoble);
              if(data.reg_acoNombre != ''){
                $("#aco").prop('checked', true);
                $("#aco").css('pointer-events','none');
                $("#div_aco").removeClass('invisible');  
                $("#fdatos #aco_nombre").val(data.reg_acoNombre);
                $("#tab-aco").removeClass('invisible');
              }
              $('#fdatos #transporte').val(data.reg_transporte);
              $('#fdatos #transporte').css('pointer-events','none');
              if(data.reg_transporte == 'aereo'){
                $('.vuelo').removeClass('invisible');
                $('#fdatos #nvuelol').val(data.reg_nveulol);
                $('#fdatos #aerolineal').val(data.reg_aerolineal).css('pointer-events','none');
                $('#fdatos #llegada_fecha').val(moment(data.reg_fechaHoraVuelol.date).format('DD/MM/YYYY'));
                $('#fdatos #llegada_hora').val(moment(data.reg_fechaHoraVuelol.date).format('H:mm'));

                $('#fdatos #nvuelos').val(data.reg_nvuelos);
                $('#fdatos #aerolineas').val(data.reg_aerolineas).css('pointer-events','none');
                $('#fdatos #salida_fecha').val(moment(data.reg_fechaHoraVuelos.date).format('DD/MM/YYYY'));
                $('#fdatos #salida_hora').val(moment(data.reg_fechaHoraVuelos.date).format('H:mm'));                
              }
              else{
                $('.vuelo').addClass('invisible');
              }
              $('#fdatos #habitacion').val(data.reg_habitacion).css('pointer-events','none');
              if(data.reg_habitacion == 'doble'){
                $('#div_hab').removeClass('invisible');
                $('#fdatos #ncamas').val(data.reg_ncamas);
              }
              $('#mensaje').val(data.reg_comentarios);
              $('#idr').val(data.reg_idRegistro);
            }
          }
          else{
            $("#registro").addClass('invisible');
            $("#err").removeClass('invisible');
            $("#fdatos #idClave").val('');
            $("#fdatos #distribuidor").val('');
            $("#fdatos #nombre").val('');
            $("#fdatos #correo").val('');
            $("#fdatos #regDoble").val('');
            $("#bvalida").removeClass('disabled');
            $("#bvalida").prop('disabled', 'false');
            $("#bvalida div").html('Validar');
            $("#clave").val('');
          }
        })
        .catch(function (error) {

        })
        .then(function () {
          //$("#bvalida div").html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Validando');
        });
    })
  }  

  if($("#fregistro").length){

    $("#aco").prop('checked', false);
    $("#fregistro #div_aco").addClass("invisible");
    $("#aco_nombre").val('');
    $("#transporte").val('');
    $(".cvuelo").val('');
    $("#habitacion").val('');
    $("#ncamas").val('');
    $(".tm").prop('checked', false);
    $(".stm").val('');
    $(".tt").prop('checked', false);
    $(".stt").val('');
    $("#_talleres_").prop('checked', false);
    $(".atm").prop('checked', false);
    $(".astm").val('');
    $(".att").prop('checked', false);
    $(".astt").val('');
    $('body').on('click', '#aco', function(event) {
      var e   = $(this);
      //var chk = e.find('#aco');
      var st  = e.is(":checked");
      if(st){
        $("#fregistro #div_aco").removeClass("invisible");
        $("#fregistro #tab-aco").removeClass("invisible");
        $('#fregistro').formValidation('enableFieldValidators', 'aco_nombre', true);
        $('#fregistro').formValidation('revalidateField', 'aco_nombre');
      }
      else{
        $("#fregistro #div_aco").addClass("invisible");
        $("#fregistro #tab-aco").addClass("invisible");
        $('#fregistro').formValidation('enableFieldValidators', 'aco_nombre', false);
        $('#fregistro').formValidation('revalidateField', 'aco_nombre');
        $("#aco_nombre").val('');
      }
    });

    $('body').on('click', '#_talleres_', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      if(st){
        $("#fregistro .atalleres").removeClass("invisible");
      }
      else{
        $("#fregistro .atalleres").addClass("invisible");
        $(".atm").prop('checked', false);
        $(".astm").val('');
      }
    });

    $('body').on('click', '.tm', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      var rel = e.attr('data-rel');
      if(st){
        $("#stm"+ rel).prop('disabled', false);
        $("#stm"+ rel).focus();
        //$('#fregistro').formValidation('enableFieldValidators', 'stm' + rel , true);
        //$('#fregistro').formValidation('revalidateField', 'stm' + rel);
      }
      else{
        $("#stm"+rel).prop('disabled', true);
        $("#stm"+rel).val('');
        //$('#fregistro').formValidation('enableFieldValidators', 'stm' + rel , false);
        //$('#fregistro').formValidation('revalidateField', 'stm' + rel);
      }
    });

    $('body').on('click', '.atm', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      var rel = e.attr('data-rel');
      if(st){
        $("#astm"+ rel).prop('disabled', false);
        $("#astm"+ rel).focus();
      }
      else{
        $("#astm"+rel).prop('disabled', true);
        $("#astm"+rel).val('');
      }
    });

    $('body').on('click', '.tt', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      var rel = e.attr('data-rel');
      if(st){
        $("#stt"+ rel).prop('disabled', false);
        $("#stt"+ rel).focus();
        //$('#fregistro').formValidation('enableFieldValidators', 'stm' + rel , true);
        //$('#fregistro').formValidation('revalidateField', 'stm' + rel);
      }
      else{
        $("#stt"+rel).prop('disabled', true);
        $("#stt"+rel).val('');
        //$('#fregistro').formValidation('enableFieldValidators', 'stm' + rel , false);
        //$('#fregistro').formValidation('revalidateField', 'stm' + rel);
      }
    });

    $('body').on('click', '.att', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      var rel = e.attr('data-rel');
      if(st){
        $("#astt"+ rel).prop('disabled', false);
        $("#astt"+ rel).focus();
        //$('#fregistro').formValidation('enableFieldValidators', 'stm' + rel , true);
        //$('#fregistro').formValidation('revalidateField', 'stm' + rel);
      }
      else{
        $("#astt"+rel).prop('disabled', true);
        $("#astt"+rel).val('');
        //$('#fregistro').formValidation('enableFieldValidators', 'stm' + rel , false);
        //$('#fregistro').formValidation('revalidateField', 'stm' + rel);
      }
    });
  
    $(".date").datetimepicker({
        minDate: moment('2020-02-10'),
        maxDate: moment('2020-02-13'),
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
          time: 'far fa-clock',
          date: 'far fa-calendar',
          up: 'fas fa-chevron-up',
          down: 'fas fa-chevron-down',
          previous: 'fas fa-chevron-left',
          next: 'fas fa-chevron-right',
          clear: 'far fa-trash-alt',
          close: 'fas fa-times'
        }
      })
      .on('dp.change', function(ec) {
        $('#fregistro').formValidation('enableFieldValidators', 'date', true);
        $('#fregistro').formValidation('revalidateField', 'date');
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
          time: 'far fa-clock',
          date: 'far fa-calendar',
          up: 'fas fa-chevron-up',
          down: 'fas fa-chevron-down',
          previous: 'fas fa-chevron-left',
          next: 'fas fa-chevron-right',
          clear: 'far fa-trash-alt',
          close: 'fas fa-times'
        }
      })
      .on('dp.change', function(ec) {
        $('#fregistro').formValidation('enableFieldValidators', 'hour', true);
        $('#fregistro').formValidation('revalidateField', 'hour');
      });


    $("#transporte").change(function(event){
      var e = $(this);
      var v = e.val();
      if(v == "aereo"){
        $("#fregistro .vuelo").removeClass('invisible');
      }
      else{
      }
    });

    $("#fregistro #habitacion").change(function(event) {
      var e = $(this);
      var v = e.val();
      if(v == "doble"){
        $("#fregistro #div_hab").removeClass('invisible');
        $('#fregistro').formValidation('enableFieldValidators', 'ncamas', true);
        $('#fregistro').formValidation('revalidateField', 'ncamas');
      }
      else{
        $("#fregistro #div_hab").addClass('invisible');
        $('#fregistro').formValidation('enableFieldValidators', 'ncamas', false);
        $('#fregistro').formValidation('revalidateField', 'ncamas');
        $('#fregistro #ncamas').val('');
      }
    });

    $("#fregistro")
    .on('init.form.fv', function(e, data) {
      $(".tm,.tt,.atm,.att").each(function(index, el) {
        var e       = $(this);
        var so      = e.nextAll('select').children("option[value!='']");
        var length  = so.length;
        var c       = 0;
        $.each(so, function(index, val) {
          var th    = $(this);
          var cupo  = th.attr('data-cupo'); 
          if(th.prop('disabled') && cupo >= 20){
            c++;
          }
        });
        if(c == length){
          e.prop('disabled', true);
          e.next('label').addClass('agotado');
        }
        //cosole.log("___________");
      });
    })    
    .formValidation({
      framework: 'bootstrap4',
      locale: 'es_ES',
      fields: {
        aco_nombre:{
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        ncamas:{
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        cvuelo:{
          selector: '.cvuelo',
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        date:{
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
        'tm[]':{
          validators: {
            choice: {
              min: 3,
              max: 3,
              message: 'Seleccionar 3 opciones'
            },
            callback: {
                message: '',
                callback: function (value, validator, $field) {
                    var frel = $field.attr('data-rel');
                    var fchk = $field.is(":checked");
                    var fst  = $("#stm" + frel);
                    if(fchk){
                      fst.addClass('err');
                      $('#fregistro').formValidation('enableFieldValidators', 'stm[]', true);
                      $('#fregistro').formValidation('revalidateField', 'stm[]');
                    }
                    else{
                      fst.removeClass('err');
                      $('#fregistro').formValidation('enableFieldValidators', 'stm[]', false);
                      $('#fregistro').formValidation('revalidateField', 'stm[]');
                    }
                    return true;
                }
            }
          }
        },
        'stm[]':{
          validators: {
            notEmpty: {
              message: ' <br>Seleciona la hora',
              enabled: true
            },
            callback: {
              message: '',
              callback: function (value, validator, $field) {
                $field.addClass('err');
                var hv  = ''
                var idv = $field.attr('id');
                if(value != ''){
                  var hv = value.split('|')[1];
                }
                $.each($(".stm"), function(index, val) {
                  if(hv != 0){
                    var e   = $(this);
                    var id  = e.attr('id');
                    if(id !== idv){
                      $("#"  + id + " option:contains('" + hv + "')").attr("disabled","disabled");
                    }
                    else{
                      $("#"  + id + " option:contains('" + hv + "')").removeAttr('disabled');
                    }
                  }
                });
                if(value !== ''){
                  $field.removeClass('err');
                }

                return true;
              }
            }
          }
        },
        'tt[]':{
          validators: {
            choice: {
              min: 3,
              max: 3,
              message: 'Seleccionar solo 3 talleres'
            },
            callback: {
                message: '',
                callback: function (value, validator, $field) {
                    var frel = $field.attr('data-rel');
                    var fchk = $field.is(":checked");
                    var fst  = $("#stt" + frel);
                    if(fchk){
                      fst.addClass('err');
                      $('#fregistro').formValidation('enableFieldValidators', 'stt[]', true);
                      $('#fregistro').formValidation('revalidateField', 'stt[]');
                    }
                    else{
                      fst.removeClass('err');
                      $('#fregistro').formValidation('enableFieldValidators', 'stt[]', false);
                      $('#fregistro').formValidation('revalidateField', 'stt[]');
                    }
                    return true;
                }
            }
          }
        },
        'stt[]':{
          validators: {
            notEmpty: {
              message: ' <br>Seleciona la hora del taller',
              enabled: true
            },
            callback: {
              message: '',
              callback: function (value, validator, $field) {
                $field.addClass('err');
                var hv  = ''
                var idv = $field.attr('id');
                if(value != ''){
                  var hv = value.split('|')[1];
                }
                $.each($(".stt"), function(index, val) {
                  if(hv != 0){
                    var e   = $(this);
                    var id  = e.attr('id');
                    if(id !== idv){
                      $("#"  + id + " option:contains('" + hv + "')").attr("disabled","disabled");
                    }
                    else{
                      $("#"  + id + " option:contains('" + hv + "')").removeAttr('disabled');
                    }
                  }
                });
                if(value !== ''){
                  $field.removeClass('err');
                }
                return true;
              }
            }
          }
        },
        'atm[]':{
          validators: {
            choice: {
              min: 3,
              max: 3,
              message: 'Seleccionar 3 opciones'
            },
            callback: {
                message: '',
                callback: function (value, validator, $field) {
                    var frel = $field.attr('data-rel');
                    var fchk = $field.is(":checked");
                    var fst  = $("#astm" + frel);
                    if(fchk){
                      fst.addClass('err');
                      $('#fregistro').formValidation('enableFieldValidators', 'astm[]', true);
                      $('#fregistro').formValidation('revalidateField', 'astm[]');
                    }
                    else{
                      fst.removeClass('err');
                      $('#fregistro').formValidation('enableFieldValidators', 'astm[]', false);
                      $('#fregistro').formValidation('revalidateField', 'astm[]');
                    }
                    return true;
                }
            }
          }
        },
        'astm[]':{
          validators: {
            notEmpty: {
              message: ' <br>Seleciona la hora',
              enabled: true
            },
            callback: {
              message: '',
              callback: function (value, validator, $field) {
                $field.addClass('err');
                var hv  = ''
                var idv = $field.attr('id');
                if(value != ''){
                  var hv = value.split('|')[1];
                }
                $.each($(".astm"), function(index, val) {
                  if(hv != 0){
                    var e   = $(this);
                    var id  = e.attr('id');
                    if(id !== idv){
                      $("#"  + id + " option:contains('" + hv + "')").attr("disabled","disabled");
                    }
                    else{
                      $("#"  + id + " option:contains('" + hv + "')").removeAttr('disabled');
                    }
                  }
                });
                if(value !== ''){
                  $field.removeClass('err');
                }

                return true;
              }
            }
          }
        },
        'att[]':{
          validators: {
            choice: {
              min: 3,
              max: 3,
              message: 'Seleccionar 3 opciones'
            },
            callback: {
                message: '',
                callback: function (value, validator, $field) {
                    var frel = $field.attr('data-rel');
                    var fchk = $field.is(":checked");
                    var fst  = $("#astt" + frel);
                    if(fchk){
                      fst.addClass('err');
                      $('#fregistro').formValidation('enableFieldValidators', 'astt[]', true);
                      $('#fregistro').formValidation('revalidateField', 'astt[]');
                    }
                    else{
                      fst.removeClass('err');
                      $('#fregistro').formValidation('enableFieldValidators', 'astt[]', false);
                      $('#fregistro').formValidation('revalidateField', 'astt[]');
                    }
                    return true;
                }
            }
          }
        },
        'astt[]':{
          validators: {
            notEmpty: {
              message: ' <br>Seleciona la hora',
              enabled: true
            },
            callback: {
              message: '',
              callback: function (value, validator, $field) {
                $field.addClass('err');
                var hv  = ''
                var idv = $field.attr('id');
                if(value != ''){
                  var hv = value.split('|')[1];
                }
                $.each($(".astt"), function(index, val) {
                  if(hv != 0){
                    var e   = $(this);
                    var id  = e.attr('id');
                    if(id !== idv){
                      $("#"  + id + " option:contains('" + hv + "')").attr("disabled","disabled");
                    }
                    else{
                      $("#"  + id + " option:contains('" + hv + "')").removeAttr('disabled');
                    }
                  }
                });
                if(value !== ''){
                  $field.removeClass('err');
                }
                return true;
              }
            }
          }
        }
      },
      addOns: {
        reCaptcha2: {
          element: 'captchaContainer1',
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
      $.each(data.fv.getInvalidFields(), function(index, val) {
        val.focus();
        return false;
      });
    })
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#fregistro").data('formValidation');
      $("#send").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Enviando');
      $("#send").addClass('disabled');
      $("#send").attr('disabled', 'disabled');
      axios.post($("#fregistro").attr('action'),$("#fregistro").serialize())
        .then(function (response) {
          var data = response.data;
          if(data.status){
            $("#send").find('div').html('Enviar');
            $("#send").removeClass('disabled');
            $("#send").prop('disabled', false);
            $("#registro").remove();
            $("#result").removeClass('invisible');
            $("#mailr").html(data.data.correo);
          }
        })
        .catch(function (error) {

        })
        .then(function () {
        });
    });


  }

  if($("#fdatos").length){

    $(".tm").prop('checked', false);
    $(".stm").val('');
    $(".tt").prop('checked', false);
    $(".stt").val('');
    $("#_talleres_").prop('checked', false);
    $(".atm").prop('checked', false);
    $(".astm").val('');
    $(".att").prop('checked', false);
    $(".astt").val('');

    $('body').on('click', '#_talleres_', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      if(st){
        $("#fdatos .atalleres").removeClass("invisible");
      }
      else{
        $("#fdatos .atalleres").addClass("invisible");
        $(".atm").prop('checked', false);
        $(".astm").val('');
      }
    });

    $('body').on('click', '.tm', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      var rel = e.attr('data-rel');
      if(st){
        $("#stm"+ rel).prop('disabled', false);
        $("#stm"+ rel).focus();
        //$('#fregistro').formValidation('enableFieldValidators', 'stm' + rel , true);
        //$('#fregistro').formValidation('revalidateField', 'stm' + rel);
      }
      else{
        $("#stm"+rel).prop('disabled', true);
        $("#stm"+rel).val('');
        //$('#fregistro').formValidation('enableFieldValidators', 'stm' + rel , false);
        //$('#fregistro').formValidation('revalidateField', 'stm' + rel);
      }
    });

    $('body').on('click', '.atm', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      var rel = e.attr('data-rel');
      if(st){
        $("#astm"+ rel).prop('disabled', false);
        $("#astm"+ rel).focus();
      }
      else{
        $("#astm"+rel).prop('disabled', true);
        $("#astm"+rel).val('');
      }
    });

    $('body').on('click', '.tt', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      var rel = e.attr('data-rel');
      if(st){
        $("#stt"+ rel).prop('disabled', false);
        $("#stt"+ rel).focus();
      }
      else{
        $("#stt"+rel).prop('disabled', true);
        $("#stt"+rel).val('');
      }
    });

    $('body').on('click', '.att', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      var rel = e.attr('data-rel');
      if(st){
        $("#astt"+ rel).prop('disabled', false);
        $("#astt"+ rel).focus();
      }
      else{
        $("#astt"+rel).prop('disabled', true);
        $("#astt"+rel).val('');
      }
    });


    $("#fdatos")
    .on('init.form.fv', function(e, data) {
      $(".tm,.tt,.atm,.att").each(function(index, el) {
        var e       = $(this);
        var so      = e.nextAll('select').children("option[value!='']");
        var length  = so.length;
        var c       = 0;
        $.each(so, function(index, val) {
          var th    = $(this);
          var cupo  = th.attr('data-cupo'); 
          if(th.prop('disabled') && cupo >= 20){
            c++;
          }
        });
        if(c == length){
          e.prop('disabled', true);
          e.next('label').addClass('agotado');
        }
        //cosole.log("___________");
      });
    })    
    .formValidation({
      framework: 'bootstrap4',
      locale: 'es_ES',
      fields: {
        'tm[]':{
          validators: {
            choice: {
              min: 3,
              max: 3,
              message: 'Seleccionar 3 opciones'
            },
            callback: {
                message: '',
                callback: function (value, validator, $field) {
                    var frel = $field.attr('data-rel');
                    var fchk = $field.is(":checked");
                    var fst  = $("#stm" + frel);
                    if(fchk){
                      fst.addClass('err');
                      $('#fregistro').formValidation('enableFieldValidators', 'stm[]', true);
                      $('#fregistro').formValidation('revalidateField', 'stm[]');
                    }
                    else{
                      fst.removeClass('err');
                      $('#fregistro').formValidation('enableFieldValidators', 'stm[]', false);
                      $('#fregistro').formValidation('revalidateField', 'stm[]');
                    }
                    return true;
                }
            }
          }
        },
        'stm[]':{
          validators: {
            notEmpty: {
              message: ' <br>Seleciona la hora',
              enabled: true
            },
            callback: {
              message: '',
              callback: function (value, validator, $field) {
                $field.addClass('err');
                var hv  = ''
                var idv = $field.attr('id');
                if(value != ''){
                  var hv = value.split('|')[1];
                }
                $.each($(".stm"), function(index, val) {
                  if(hv != 0){
                    var e   = $(this);
                    var id  = e.attr('id');
                    if(id !== idv){
                      $("#"  + id + " option:contains('" + hv + "')").attr("disabled","disabled");
                    }
                    else{
                      $("#"  + id + " option:contains('" + hv + "')").removeAttr('disabled');
                    }
                  }
                });
                if(value !== ''){
                  $field.removeClass('err');
                }

                return true;
              }
            }
          }
        },
        'tt[]':{
          validators: {
            choice: {
              min: 3,
              max: 3,
              message: 'Seleccionar solo 3 talleres'
            },
            callback: {
                message: '',
                callback: function (value, validator, $field) {
                    var frel = $field.attr('data-rel');
                    var fchk = $field.is(":checked");
                    var fst  = $("#stt" + frel);
                    if(fchk){
                      fst.addClass('err');
                      $('#fdatos').formValidation('enableFieldValidators', 'stt[]', true);
                      $('#fdatos').formValidation('revalidateField', 'stt[]');
                    }
                    else{
                      fst.removeClass('err');
                      $('#fdatos').formValidation('enableFieldValidators', 'stt[]', false);
                      $('#fdatos').formValidation('revalidateField', 'stt[]');
                    }
                    return true;
                }
            }
          }
        },
        'stt[]':{
          validators: {
            notEmpty: {
              message: ' <br>Seleciona la hora del taller',
              enabled: true
            },
            callback: {
              message: '',
              callback: function (value, validator, $field) {
                $field.addClass('err');
                var hv  = ''
                var idv = $field.attr('id');
                if(value != ''){
                  var hv = value.split('|')[1];
                }
                $.each($(".stt"), function(index, val) {
                  if(hv != 0){
                    var e   = $(this);
                    var id  = e.attr('id');
                    if(id !== idv){
                      $("#"  + id + " option:contains('" + hv + "')").attr("disabled","disabled");
                    }
                    else{
                      $("#"  + id + " option:contains('" + hv + "')").removeAttr('disabled');
                    }
                  }
                });
                if(value !== ''){
                  $field.removeClass('err');
                }
                return true;
              }
            }
          }
        },
        'atm[]':{
          validators: {
            choice: {
              min: 3,
              max: 3,
              message: 'Seleccionar 3 opciones'
            },
            callback: {
                message: '',
                callback: function (value, validator, $field) {
                    var frel = $field.attr('data-rel');
                    var fchk = $field.is(":checked");
                    var fst  = $("#astm" + frel);
                    if(fchk){
                      fst.addClass('err');
                      $('#fdatos').formValidation('enableFieldValidators', 'astm[]', true);
                      $('#fdatos').formValidation('revalidateField', 'astm[]');
                    }
                    else{
                      fst.removeClass('err');
                      $('#fdatos').formValidation('enableFieldValidators', 'astm[]', false);
                      $('#fregistro').formValidation('revalidateField', 'astm[]');
                    }
                    return true;
                }
            }
          }
        },
        'astm[]':{
          validators: {
            notEmpty: {
              message: ' <br>Seleciona la hora',
              enabled: true
            },
            callback: {
              message: '',
              callback: function (value, validator, $field) {
                $field.addClass('err');
                var hv  = ''
                var idv = $field.attr('id');
                if(value != ''){
                  var hv = value.split('|')[1];
                }
                $.each($(".astm"), function(index, val) {
                  if(hv != 0){
                    var e   = $(this);
                    var id  = e.attr('id');
                    if(id !== idv){
                      $("#"  + id + " option:contains('" + hv + "')").attr("disabled","disabled");
                    }
                    else{
                      $("#"  + id + " option:contains('" + hv + "')").removeAttr('disabled');
                    }
                  }
                });
                if(value !== ''){
                  $field.removeClass('err');
                }

                return true;
              }
            }
          }
        },
        'att[]':{
          validators: {
            choice: {
              min: 3,
              max: 3,
              message: 'Seleccionar 3 opciones'
            },
            callback: {
                message: '',
                callback: function (value, validator, $field) {
                    var frel = $field.attr('data-rel');
                    var fchk = $field.is(":checked");
                    var fst  = $("#astt" + frel);
                    if(fchk){
                      fst.addClass('err');
                      $('#fdatos').formValidation('enableFieldValidators', 'astt[]', true);
                      $('#fdatos').formValidation('revalidateField', 'astt[]');
                    }
                    else{
                      fst.removeClass('err');
                      $('#fdatos').formValidation('enableFieldValidators', 'astt[]', false);
                      $('#fdatos').formValidation('revalidateField', 'astt[]');
                    }
                    return true;
                }
            }
          }
        },
        'astt[]':{
          validators: {
            notEmpty: {
              message: ' <br>Seleciona la hora',
              enabled: true
            },
            callback: {
              message: '',
              callback: function (value, validator, $field) {
                $field.addClass('err');
                var hv  = ''
                var idv = $field.attr('id');
                if(value != ''){
                  var hv = value.split('|')[1];
                }
                $.each($(".astt"), function(index, val) {
                  if(hv != 0){
                    var e   = $(this);
                    var id  = e.attr('id');
                    if(id !== idv){
                      $("#"  + id + " option:contains('" + hv + "')").attr("disabled","disabled");
                    }
                    else{
                      $("#"  + id + " option:contains('" + hv + "')").removeAttr('disabled');
                    }
                  }
                });
                if(value !== ''){
                  $field.removeClass('err');
                }
                return true;
              }
            }
          }
        }
      },
      addOns: {
        reCaptcha2: {
          element: 'captchaContainerd',
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
      $.each(data.fv.getInvalidFields(), function(index, val) {
        val.focus();
        return false;
      });
    })
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#fdatos").data('formValidation');
      $("#send").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Guardando');
      $("#send").addClass('disabled');
      $("#send").attr('disabled', 'disabled');
      axios.post($("#fdatos").attr('action'),$("#fdatos").serialize())
        .then(function (response) {
          var data = response.data;
          if(data.status){
            $("#send").find('div').html('Guardar');
            $("#send").removeClass('disabled');
            $("#send").prop('disabled', false);
            $("#registro").remove();
            $("#result").removeClass('invisible');
            $("#mailr").html(data.data.correo);
          }
        })
        .catch(function (error) {

        })
        .then(function () {
        });
    });


  }



  if ( $("#fcontacto").length ){

    $("#fcontacto").formValidation({
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
      fv    = $("#fcontacto").data('formValidation');
      $("#sendc").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Enviando');
      $("#sendc").addClass('disabled');
      $("#sendc").attr('disabled', 'disabled');
      $.ajax({
        url: $("#fcontacto").attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $("#fcontacto").serialize(),
        success: function(result) {
          if(result.status){
            $("#sendc").find('div').html('Enviar');
            $("#sendc").addClass('disabled');
            $("#sendc").attr('disabled', 'disabled');
            $("#contacto").remove();
            $("#resultc").removeClass('invisible');
          }
        }
      });
    });
  };


  var googleMap = function () {
      // gmap default
      if ($().gmap3) {
          var data = JSON.parse('[{"address":"Av. Cocoteros, 98 Sur, Nuevo Vallarta, Riviera Nayarit, Nayarit 63735 , Nayarit","content":""}]');
          $(".flat-map")
          .gmap3({
              map: {
                  options: {
                      zoom: 17,
                      center: [20.7058419,-105.3019024,17],
                      mapTypeId: 'Grand Velas Riviera Nayarit',
                      mapTypeControlOptions: {
                          mapTypeIds: ['Grand Velas Riviera Nayarit', google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID]
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
                          icon: "../../assets/img/maeker2.png"
                      }

                  }]
              },
              styledmaptype: {
                  id: "Grand Velas Riviera Nayarit",
                  options: {
                      name: ""
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

  if($("#mi-table")){
    var header_height = 0;
    var header_width = 0;
    $('.vertical-th span').each(function() {
        if ($(this).outerWidth() > header_height) header_height = $(this).outerWidth();
        header_width = $(this).outerWidth();
    });

    $('.vertical-th').height(header_height + 10);
    $('.vertical-th').width(header_width + 10);
  }

});
