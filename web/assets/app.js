//$("li a[rel='registro']").addClass("active");
//
var host 	= jQuery(location).attr('host');
var pn 		= jQuery(location).attr('pathname');
var wd   	= pn.split("/").pop();
var host  = jQuery(location).attr('host');
$("li a[rel='" + wd + "']").addClass("active");

if ( $("#frmRegistro").length ) {

  var dates = ["'2017-06-20'","'2017-06-21'","'2017-06-22'","'2017-06-23'"];
  var ul = $("<ul>",{
  			class: 'list-unstyled'
  });
  /*$.get( "lvalidaf", { dates: dates }, function( data ) {
  	$.each(data, function(index, val) {
  		ul.append('<li>' +  val.disponibles+ ' lugares disponibles para el ' + val.fecha + '</li>');
  	});
  	$("#msgfecha").removeClass('animated fadeIn');
  	$("#msgfecha").html(ul);
  	$("#msgfecha").addClass('animated fadeIn');
  	$('#fechaLlegada').val('');
  });*/

	$('#frmRegistro')
		.formValidation({
			framework: 'bootstrap',
			locale: 'es_ES',
			live: 'enabled',
			fields: {
				licencia:{
					selector: '.licencia',
					validators: {
						notEmpty: {
							enabled: true
						}
					}
				},
				dates:{
					selector: '.dates',
					validators: {
						notEmpty: {
							enabled: true
						}
					}
				},
				lvalida:{
					validators: {
						notEmpty: {
							enabled: true
						}
					}
				},
				lugarLicencia:{
					validators: {
						notEmpty: {
							enabled: true
						}
					}
				},
				digitos:{
					validators: {
						notEmpty: {
							enabled: true
						}
					}
				},
				fechaLlegada:{
					validators: {
						notEmpty: {
							enabled: true
						}
					}
				},
				fechaSalida:{
					validators: {
						notEmpty: {
							enabled: true
						}
					}
				},
        'correo':{
          validators: {
            notEmpty: {
            	message: 'Por favor introduce un valor'
            },
            remote: {
              message:  'Este correo ya esta registrado',
              url:      'vmail',
              type:     'POST',
              validKey: 'ifExist'
            }
          }
        }																							
			},
			addOns: {
				reCaptcha2: {
					element: 'captchaContainer',
					theme: 'clean',
					siteKey: (host == 'localhost') ? '6LeTACUTAAAAABdKkPPyxt71S91_xFTCz92MGw-n' : '6Le3Uh0TAAAAAIL5BEa-c1ZMCDzGuZSeL-cHx0DF',
					timeout: 120,
					message: 'El captcha no es valido',
					language: 'es'
				}
			}              
		})
		.on('success.field.fv', function(e, data) {
			if(data.fv.getInvalidFields().length >= 0){
				///data.fv.disableSubmitButtons(true);
				$("#send").removeAttr('disabled');
				$("#send").removeClass('disabled');
			}
		})
		.on('init.form.fv', function(e, data) {
		})
		.on('err.form.fv', function(e){
		})
		.on('success.form.fv', function(e){// Prevent form submission
			e.preventDefault();
			// Get the form instance
			var $form = $(e.target);
			// Get the FormValidation instance
			var bv = $form.data('formValidation');
			// Use Ajax to submit form data
			$('#send').find("div").html("<span class='fa fa-circle-o-notch fa-spin'></span> Enviando");
			$('#send').attr('disabled', 'disabled');
			$.post($form.attr('action'), $form.serialize(), function(result) {
				if(result.status == true){
					$("#formu").addClass('animated fadeOutUp');
					$("#result").removeClass('hidden').addClass('animated fadeInUp');
					$("#formu").remove();
					$("#nmail").text(result.data.correo);
				}
				else{
				}
			}, 'json')
		});
	
	$('#frmRegistro').formValidation('enableFieldValidators', 'fechaLlegada', false);
	$('#frmRegistro').formValidation('revalidateField', 'fechaLlegada');	
	$('#frmRegistro').formValidation('enableFieldValidators', 'fechaSalida', false);
	$('#frmRegistro').formValidation('revalidateField', 'fechaSalida');		
	
	$('body').on('click', '#licencia', function(event) {
		//event.preventDefault();
		var e   = $(this);
		var st  = e.is(":checked");
		if(st){
			$(".dlicencia").removeClass('hidden');
			$('#frmRegistro').formValidation('enableFieldValidators', 'licencia', true);
			$('#frmRegistro').formValidation('revalidateField', 'licencia');
			$('#frmRegistro').formValidation('enableFieldValidators', 'lvalida', true);
			$('#frmRegistro').formValidation('revalidateField', 'lvalida');
			$('#frmRegistro').formValidation('enableFieldValidators', 'lugarLicencia', true);
			$('#frmRegistro').formValidation('revalidateField', 'lugarLicencia');
			$('#frmRegistro').formValidation('enableFieldValidators', 'digitos', true);
			$('#frmRegistro').formValidation('revalidateField', 'digitos');											
		}
		else{
			$('#frmRegistro').formValidation('enableFieldValidators', 'licencia', false);
			$('#frmRegistro').formValidation('revalidateField', 'licencia');
			$('#frmRegistro').formValidation('enableFieldValidators', 'lvalida', false);
			$('#frmRegistro').formValidation('revalidateField', 'lvalida');
			$('#frmRegistro').formValidation('enableFieldValidators', 'lugarLicencia', false);
			$('#frmRegistro').formValidation('revalidateField', 'lugarLicencia');
			$('#frmRegistro').formValidation('enableFieldValidators', 'digitos', false);
			$('#frmRegistro').formValidation('revalidateField', 'digitos');							
			$(".licencia").val('');      
			$(".dlicencia").addClass('hidden');
		}
	});


	$('#fechaLlegada').datetimepicker({
		format: 'DD/MM/YYYY',
		locale: 'es',
		ignoreReadonly: true,
		showTodayButton: false,
		minDate: moment('2017-06-20'),
		maxDate: moment('2017-06-23'),
		icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		} 
	}).
	on('dp.change', function(ec) {
		$('#frmRegistro').formValidation('enableFieldValidators', 'dates', true);
		$('#frmRegistro').formValidation('revalidateField', 'dates');
		$("#msgfecha").html("");
		//$("#msgfecha").removeClass('animated fadeIn');
		//$("#msgfecha").html('<span class="fa fa-spinner fa-pulse fa-fw"></span> Obteniendo lugares disponibles');
		  /*$.ajax({
		    url: 'lvalida',
		    type: 'POST',
		    dataType: 'json',
		    data: {date: ec.date.format('YYYY-MM-DD')},
		  })
		  .done(function(result) {
		  	var dv = result.disponibles + " lugares para disponibles para el " + result.fecha;
		  	if(result.disponibles == 0){
		  		$('#fechaLlegada').val('');
		  		dv+= ", seleccione otra fecha";
					$('#frmRegistro').formValidation('enableFieldValidators', 'dates', true);
					$('#frmRegistro').formValidation('revalidateField', 'dates');	  		
		  	}
		  	$("#msgfecha").html(dv);
		  	$("#msgfecha").addClass('animated fadeIn');
		  })*/
	})
	.on('dp.show', function(es) {
	});

	$('#lvalida').datetimepicker({
		format: 'DD/MM/YYYY',
		locale: 'es',
		ignoreReadonly: true,
		showTodayButton: false,
		icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		} 
	}).
	on('dp.change', function(ec) {
		$('#frmRegistro').formValidation('enableFieldValidators', 'lvalida', true);
		$('#frmRegistro').formValidation('revalidateField', 'lvalida');
	});
}

function chdate(e){
	var date = e.date;
	$("#fechaSalida").val(date.add(1,'day').format('DD-MM-YYYY'));   
}

if ( $("#frmContacto").length ) {
	var host = jQuery(location).attr('host');
	$('#frmContacto')
		.formValidation({
			framework: 'bootstrap',
			locale: 'es_ES',
			live: 'enabled',
			fields: {                             
			},
			addOns: {
				reCaptcha2: {
					element: 'captchaContainerC',
					theme: 'clean',
					siteKey: (host == 'localhost') ? '6LeTACUTAAAAABdKkPPyxt71S91_xFTCz92MGw-n' : '6Le3Uh0TAAAAAIL5BEa-c1ZMCDzGuZSeL-cHx0DF',
					timeout: 120,
					message: 'El captcha no es valido',
					language: 'es'
				}
			}              
		})
		.on('init.form.fv', function(e, data) {
		})
		.on('err.form.fv', function(e){
		})
		.on('success.form.fv', function(e){// Prevent form submission
			e.preventDefault();
			// Get the form instance
			var $form = $(e.target);
			// Get the FormValidation instance
			var bv = $form.data('formValidation');
			// Use Ajax to submit form data
			$('#send').find("div").html("<span class='fa fa-circle-o-notch fa-spin'></span> Enviando");
			$('#send').attr('disabled', 'disabled');
			$.post($form.attr('action'), $form.serialize(), function(result) {
				if(result.status == true){
					$("#formuc").addClass('animated fadeOutUp');
					$("#resultc").removeClass('hidden').addClass('animated fadeInUp');
					$("#formuc").remove();
				}
				else{
				}
			}, 'json')
		});             
}

if ( $(".map").length ) {
	jQuery(".gmap").gmap3({
		marker: {
			address: 'Autódromo Hnos. Rodríguez',
			options: {
				icon: "../assets/afela/img/marker.png"
			}
		},
		map:{
			options:{
				zoom: 16,
				zoomControl: true,
				mapTypeControl: false,
				scaleControl: false,
				scrollwheel: false,
				navigationControl: true,
				streetViewControl: false,
				draggable: true,
				styles: [
					{
					"featureType":"all",
					"elementType":"all",
						"stylers":[
							{ "saturation":"-50" }
						]
					}]
			}
		}
	});


}