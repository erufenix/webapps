$(document).ready(function () {

  var host = jQuery(location).attr('host');
  $("#otema").val('');

  if ($("#fscitas").length) {

    $("#fscitas").formValidation({
      framework: 'bootstrap4',
      locale: 'es_ES',
      fields: {
        'correo': {
          validators: {
            emailAddress: {
              message: 'El correo no es valido'
            }
          }
        }
      }
    });

    $('body').on('blur', '#correo', function () {
      var e = $(this);
      var v = e.val();
      var data = null;
      axios.get($('#valcita').val(), {
        params: {
          mail: v
        }
      })
        .then(function (response) {
          data = response.data;
          if (data.mail !== '') {
            $("#fscitas").formValidation('updateMessage', 'correo', 'emailAddress', 'Este correo ya agendo una cita ');
            $("#fscitas").formValidation('updateStatus', 'correo', 'INVALID', 'emailAddress');
            $("#correo").focus();
          }
          else {
            $("#fscitas").formValidation('updateMessage', 'correo', 'emailAddress', '');
            $("#fscitas").formValidation('updateStatus', 'correo', 'VALID', 'emailAddress');
          }
        })
        .catch(function (error) {
        })
    });

  }

  //$('.mdb-select').materialSelect();



  $("#ostema").change(function () {
    var e = $(this);
    //var tem = $('#tema option:selected').attr('data-tem');
    var tema = $('#ostema option:selected').attr('data-tema');
    var subtema = e.val();
    var btn = '';
    $("#hcitas").html('<i class="fa-3x fas fa-spinner fa-spin"></i>');
    axios.get('temasCitas', {
      params: {
        tema: tema,
        subtema: subtema
      }
    })
      .then(function (response) {
        var data = response.data;
        $.each(data.citas, function (key, value) {
          var hora = moment(value.hora.date).format('HH:mm');
          var nowf = moment().format('HH:mm');
          var _h = moment('2020-02-' + value.dia + ' ' + hora).format('YYYY-MM-DD HH:mm');
          var _n = moment().format('YYYY-MM-DD HH:mm');
          var id = value.idTemario;
          var blk = value.bloqueada;
          var df = moment(_h).isSameOrAfter(_n);
          if (df === false) {
            blk = 1;
          }
          btn = btn + '<button type="button" data-cita="' + id + '|' + hora + '" class="btn btn-sm ' + ((blk === 0) ? "btn-outline-info" : "btn-outline-warning disabled") + ' waves-effect hcita" ' + ((blk === 0) ? "" : "disabled") + ' id="scita' + key + '">' + hora + '</button>'
        });
        $("#mesa").html("Mesa: " + data.mesa);
        $("#dia").html("Día: " + data.dia);
        $("#vmesa").val(data.mesa);
        $("#vdia").val(data.dia);
        $(".iday").removeClass('invisible');
        $("#hcitas").html(btn);
      })
      .catch(function (error) {

      })
      .then(function () {
      });

  });

  

  $("#otema").change(function () {
    var e = $(this);
    var tema = e.val();
    $("#ostema").prop('disabled',true);
    $("#ostema").empty();
		$("#ostema").append($('<option>', {
		  	value: '',
		  	text : ('Cargando Subtemas...')
			})
		);    
    axios.get('subTemas', {
      params: {
        tema: tema
      }
    })
      .then(function (response) {
        var data = response.data;
        $.each(data, function(i,item) {
          var o = document.createElement('option');
          o.value = item.noSubtema;
          o.text  = item.subtema;
          o.setAttribute('data-tema', tema);
          $('#ostema').append(o);
        });
        $("#ostema option:first").html('Seleccionar Subtema');
        $("#ostema").removeAttr('disabled');
      })
      .catch(function (error) {

      })
      .then(function () {
      });    
  });

  $('body').on('click', '.hcita', function (event) {
    var e = $(this);
    $(".hcita").removeClass('hcitaChk hactive');
    e.addClass('hcitaChk hactive');
    var hvalid = false;
    $(".hcita").each(function () {
      var eh = $(this);
      var cita = eh.attr('data-cita');
      if (eh.hasClass('hactive')) {
        hvalid = true;
        $("#cita").val(cita);
        $('#setcitas').formValidation('enableFieldValidators', 'cita', true);
        $('#setcitas').formValidation('revalidateField', 'cita');
      }
    });
  });


  $('body').on('click', '#return', function (event) {
    $("#sendc").find('div').html('Continuar');
    $("#sendc").removeClass('disabled');
    $("#sendc").removeAttr('disabled');
    $("#cempresa").html('');
    $("#cnombre").html('');
    $("#cdia").html('');
    $("#chora").html('');
    $("#cmesa").html('');
    $("#ctema").html('');
    $("#scita").removeClass('invisible');
    $("#ccita").addClass('invisible');
  });


  $('body').on('click', '#confirm', function (event) {
    $("#confirm").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Confirmando');
    $("#confirm").addClass('disabled');
    $("#confirm").attr('disabled', 'disabled');
    axios.post($("#setcitas").attr('action'), $("#setcitas").serialize())
      .then(function (response) {
        var data = response.data;
        if (response.status) {
          $("#scita").remove();
          $("#ccita").remove();
          $("#fempresa").html(data.cita.empresa);
          $("#fnombre").html(data.cita.nombre + '(' + data.cita.correo + ')');
          $("#fdia").html(data.cita.dia);
          $("#fhora").html(data.cita.hora);
          $("#fmesa").html(data.cita.mesa);
          $("#ftema").html(data.tema.tema + ' - ' + data.tema.subtema);
          $("#fcita").removeClass('invisible');
        }
      })
      .catch(function (error) {

      })
      .then(function () {
      });
  });



  if ($("#setcitas").length) {

    $("#setcitas").formValidation({
      framework: 'bootstrap4',
      locale: 'es_ES',
      fields: {
        'cita': {
          excluded: false,
          validators: {
            notEmpty: {
              enabled: true,
              message: 'Selecciona una hora'
            },
            callback: {
              message: '',
              callback: function (value, validator, $field) {
                return true;
              }
            }
          }
        }
      },
      addOns: {
      }
    })
      .on('success.field.fv', function (e, data) {
      })
      .on('success.form.fv', function (e) {
        e.preventDefault();
        fv = $("#setcitas").data('formValidation');
        $("#sendc").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Solicitando');
        $("#sendc").addClass('disabled');
        $("#sendc").attr('disabled', 'disabled');
        $("#cempresa").html($("#empresa").val());
        $("#cnombre").html($("#nombre").val() + '(' + $("#correo").val() + ')');
        $("#cdia").html($("#vdia").val());
        $("#chora").html($('.hactive').text());
        $("#cmesa").html($("#vmesa").val());
        $("#ctema").html($("#otema option:selected").text() + ' - ' + $("#ostema option:selected").text());
        $("#scita").addClass('invisible');
        $("#ccita").removeClass('invisible');
      });
  }
});