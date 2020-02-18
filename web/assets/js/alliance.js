  var host = jQuery(location).attr('host');
  var values    = [];
  $(".our-clients").sliphover({
    backgroundColor: 'rgba(0,79,159,0.75)',
    withLink:true
  });

  $("body").on('click','.sliphover-overlay', function(event) {
  	event.preventDefault();
  	var hash 	= $(this).attr('href');
  	//var gpo 	= v.replace(hash, '#grupo', '');
  	$("#gpo").val(gpo);
  	$(".sliphover-overlay").addClass('hidden')
  	$("#gpos").addClass('hidden');
  	$("#cveReg").removeClass('hidden');
  });

  $("body").on('click', '#return1', function(event) {
  	event.preventDefault();
  	$("#cveReg").removeClass('hidden');
    $("#valida").prop('disabled',false);
    $("#valida").removeClass('disabled');
    $("#valida").find('span').html('Validar');
    $("#divErr").addClass('hidden'); 	
  });

  if ( $("#frmClave").length ) {
    $("#frmClave").formValidation({
      framework: 'bootstrap4',
      locale: 'es_ES',
      fields: {       
      },          
    })
    .on('success.field.fv', function(e, data) {
    }) 
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#frmClave").data('formValidation');
      $("#valida").prop('disabled',true);
      $("#valida").addClass('disabled');
      $("#valida").find('span').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Validando'); 
      $.ajax({
        url: $("#frmClave").attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $("#frmClave").serialize(),
          success: function(result) {
          	$("#cveReg").addClass('hidden');
          	if(result.length != 0 && result.clave != '' ){
              if(result.bloqueada){
                $("#divGpo").addClass('hidden');
                $("#divErr").removeClass('hidden');
                $("#frmg1 #idClave").val('');
                $("#frmg1 #distribuidor").val('');
                $("#frmg1 #regDoble").val(''); 
              }
              else{
                $("#divGpo").removeClass('hidden');
                $("#divErr").addClass('hidden');
                $("#frmg1 #idClave").val(result.idClave);
                $("#frmg1 #distribuidor").val(result.nombre);
                $("#frmg1 #regDoble").val(result.regDoble);                
              }
              
          	}
            else{
              $("#divGpo").addClass('hidden');
              $("#divErr").removeClass('hidden');
              $("#frmg1 #idClave").val('');
              $("#frmg1 #distribuidor").val('');
              $("#frmg1 #regDoble").val('');                
            }
          }
      });         
    });
  }
  
  if ( $("#frmg1").length ){ 
		$('body').on('click', '#aco', function(event) {
			var e   = $(this);
			var st  = e.is(":checked");
			if(st){
				$("#frmg1 #divaco").removeClass("hidden");
				$('#frmg1').formValidation('enableFieldValidators', 'aco_nombre', true);
				$('#frmg1').formValidation('revalidateField', 'aco_nombre');
			}		
			else{
				$("#frmg1 #divaco").addClass("hidden");
				$('#frmg1').formValidation('enableFieldValidators', 'aco_nombre', false);
				$('#frmg1').formValidation('revalidateField', 'aco_nombre');
				$("#aco_nombre").val('');				
			}
		});

		$("#frmg1 #transporte").change(function(event){
			var e = $(this);
			var v = e.val();
			if(v == "aereo"){
				$("#frmg1 #vuelo").removeClass('hidden');
				$('#frmg1').formValidation('enableFieldValidators', 'aerolineal', true);
				$('#frmg1').formValidation('revalidateField', 'aerolineal');
				$('#frmg1').formValidation('enableFieldValidators', 'aerolineas', true);
				$('#frmg1').formValidation('revalidateField', 'aerolineas');
        $('#frmg1').formValidation('enableFieldValidators', 'nvuelol', true);
        $('#frmg1').formValidation('revalidateField', 'nvuelol');
        $('#frmg1').formValidation('enableFieldValidators', 'nvuelos', true);
        $('#frmg1').formValidation('revalidateField', 'nvuelos');        
				$('#frmg1').formValidation('enableFieldValidators', 'datesv', true);
				$('#frmg1').formValidation('revalidateField', 'datesv');														
			}
			else{
				$("#frmg1 #vuelo").addClass('hidden');
				$('#frmg1').formValidation('enableFieldValidators', 'aerolineal', false);
				$('#frmg1').formValidation('revalidateField', 'aerolineal');
				$('#frmg1').formValidation('enableFieldValidators', 'aerolineas', false);
				$('#frmg1').formValidation('revalidateField', 'aerolineas');
        $('#frmg1').formValidation('enableFieldValidators', 'nvuelol', false);
        $('#frmg1').formValidation('revalidateField', 'nvuelol');
        $('#frmg1').formValidation('enableFieldValidators', 'nvuelos', false);
        $('#frmg1').formValidation('revalidateField', 'nvuelos');         
				$('#frmg1').formValidation('enableFieldValidators', 'datesv', false);
				$('#frmg1').formValidation('revalidateField', 'datesv');
				$("#frm1 #aerolineal").val('');
				$("#frm1 #aerolineas").val('');
				$("#frm1 #nvuelol").val('');
				$("#frm1 #nvuelol").val('');
				$("#frm1 fecha_hora_vuelos").val('');
				$("#frm1 fecha_hora_vuelol").val('');									
			}
		});

    $("#frmg1 #habitacion").change(function(event) {
      var e = $(this);
      var v = e.val();
      if(v == "doble"){
        $("#frmg1 #camas").removeClass('hidden');
        $('#frmg1').formValidation('enableFieldValidators', 'ncamas', true);
        $('#frmg1').formValidation('revalidateField', 'ncamas');     
      } 
      else{
        $("#frmg1 #camas").addClass('hidden');
        $('#frmg1').formValidation('enableFieldValidators', 'ncamas', false);
        $('#frmg1').formValidation('revalidateField', 'ncamas');
        $('#frmg1 #ncamas').val(''); 
      } 
    });    

    //$('.acts').mask('0', {'translation': {0: {pattern: /[1-4]{1,4}/}}});

    $("#frmg1").formValidation({
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
  			dates:{
  				selector: '.dates',
  				validators: {
  					notEmpty: {
  						enabled: true
  					}
  				}
  			},
  			datesv:{
  				selector: '.datesv',
  				validators: {
  					notEmpty: {
  						enabled: true
  					}
  				}
  			},
        horasv:{
          selector: '.horasv',
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },      
  			aerolineal:{
  				validators: {
  					notEmpty: {
  						message: 'Seleccione una aerolínea'
  					}
  				}
  			},
  			aerolineas:{
  				validators: {
  					notEmpty: {
  						message: 'Seleccione una aerolínea'
  					}
  				}
  			},
        nvuelol:{
          validators: {
            notEmpty: {
              enabled: true
            }
          }
        },
        nvuelos:{
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
        'acts[]':{
          validators: {
            choice: {
              min: 4,
              max: 4,
              message: 'Seleccionar 4 opciones'
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
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#frmg1").data('formValidation');
      $("#send").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Enviando');
      $("#send").addClass('disabled');
      $("#send").attr('disabled', 'disabled');
      $.ajax({
        url: $("#frmg1").attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $("#frmg1").serialize(),
        success: function(result) {
        	if(result.status){
  			    $("#send").find('div').html('Enviar');
  			    $("#send").addClass('disabled');
  			    $("#send").attr('disabled', 'disabled');
  			    $("#divGpo").remove();
  			    $("#nmail").html(result.data.correo);
  			    $("#result").removeClass('hidden');
        	}
        }
      });         
    });

  	$(".dates").datetimepicker({
      //minDate: moment('2018-02-12'),
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
        time: 'far fa-clock',
        date: 'far fa-calendar',
        up: 'fas fa-chevron-up',
        down: 'fas fa-chevron-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        clear: 'fas fa-trash',
        close: 'fas fa-times'
      }
    })
    .on('dp.change', function(ec) {
      $('#frmg1').formValidation('enableFieldValidators', 'dates', true);
      $('#frmg1').formValidation('revalidateField', 'dates');      
    });

  	$(".datesv").datetimepicker({
      //minDate: moment('2018-02-12'),
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
        time: 'far fa-clock',
        date: 'far fa-calendar',
        up: 'fas fa-chevron-up',
        down: 'fas fa-chevron-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        clear: 'fas fa-trash',
        close: 'fas fa-times'
      }
    })
    .on('dp.change', function(ec) {
      $('#frmg1').formValidation('enableFieldValidators', 'datesv', true);
      $('#frmg1').formValidation('revalidateField', 'datesv');      
    });

    $(".horasv").datetimepicker({
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
        clear: 'fas fa-trash',
        close: 'fas fa-times'
      }
    })
    .on('dp.change', function(ec) {
      $('#frmg1').formValidation('enableFieldValidators', 'horasv', true);
      $('#frmg1').formValidation('revalidateField', 'horasv');      
    });
  } 

  if ( $("#frmContacto").length ){

    $("#frmContacto").formValidation({
      framework: 'bootstrap4',
      locale: 'es_ES',
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
    .on('success.field.fv', function(e, data) {
    })            
    .on('success.form.fv', function(e) {
      e.preventDefault();
      fv    = $("#frmContacto").data('formValidation');
      $("#sendc").find('div').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Enviando');
      $("#sendc").addClass('disabled');
      $("#sendc").attr('disabled', 'disabled');
      $.ajax({
        url: $("#frmContacto").attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $("#frmContacto").serialize(),
        success: function(result) {
          if(result.status){
            $("#sendc").find('div').html('Enviar');
            $("#sendc").addClass('disabled');
            $("#sendc").attr('disabled', 'disabled');
            $("#contacto").remove();
            $("#resultc").removeClass('hidden');
          }
        }
      });         
    });
  };   


  //A4B1E9-CP1426BZ2MH0@prodigyweb.com.mx
  //48956904 