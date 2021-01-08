$(document).ready(function() {

	var hJson 				= ($("#hotelesJson").val() === '') ? {} : $("#hotelesJson").val();
	var paises  			= $("#paises").val();
	var obj 					= $.parseJSON(hJson);
	//var objp   				=	$.parseJSON(paises);
	var objp 					= {};
	var cur   				= $("#currency").val();
	var idHotel				= $("#idHotel").val();
	var lang 					= $("#lang").val();
	var j 						= idHotel;
	var payButton 		= null;
	var $dialog 			= null;
	var $listener 		= null;
	var $pCheckOut 		= {};
	var rutaImg    		= $("#rutaImg").val();
	var host 					= $("#host").val();
	var hostFull 			= $("#hostFull").val();
	var assets  			= $("#assets").val();
	var protocol  		= $("#protocol").val();
	var currency   		= $("#divisa").val();
	var urlConfirma 	= $("#urlConfirma").val();
	var urlApplyPay 	= $("#urlApplyPay").val();
	var urlChekout 		= $("#urlChekout").val();
	var urlExecute 		= $("#urlExecute").val();
	var urlPayReturn 	= $("#urlPayReturn").val();
	var mode 					= $("#pmode").val();
	var objl 					= {
											'es': 'es_ES',
											'en': 'en_US'
										};						
	var allg = false;
	var disabledDates = $("#disabledDates").val();
	
  (idHotel !== 0) ? $("#idHotel").val(idHotel) : $("#idHotel").val('');
	if(idHotel === '' || idHotel === 0 || idHotel === undefined || idHotel === null){
		allg = false;
	}
	else{
		allg = obj[idHotel]['all'];
	}
	var blkAco 			= !!$("#blkAco").val();
	if(idHotel !== 0 && (obj !== null && obj[j] !== undefined)){
		//var j 				= idHotel - 1;
		var img 					= obj[j]['img'];
		var nombre 		   	= obj[j]['nombre'];
		var habitaciones 	= obj[j]['habitaciones'];
		var habs 					= '';
		var mensajes 			= obj[j]['mensajes'][lang];
		$("#htimg").attr('href', protocol + host + assets + '/img/hotel/' + rutaImg + '/'+ img);
		$("#httumb").attr('src', protocol + host + assets + '/img/hotel/' + rutaImg + '/'+ img);
		$("#htnombre").html(nombre);
		$("#hotel").val(nombre);
		$("#imgHotel").val(protocol + host + assets + '/img/hotel/' + rutaImg + '/'+ img);
	}

	if(blkAco === true){
		$('.htc').on('click', function(e) {
			if(e.target.value !== undefined){
				var s = e.target.value;
				var s = $(this).val();
				if(s.indexOf("Doble") >= 0 || s.indexOf("Triple") >= 0 || s.indexOf("Cuádruple") >= 0 || s.indexOf("DBL") >= 0 || s.indexOf("DOBLE") >= 0){
					$("#acom").removeClass('disabled');
					$("#acom").prop('disabled',false);
				}
				else{
					$("#acom").addClass('disabled');
					$("#acom").prop('disabled',true);
				}
			}
		});
	}



  $(".ppor").on('click', function(e) {
    var id = e.currentTarget.id;
    $(".allfechasmsg").html("");
    $(".allfechas .control-label").removeClass("c-font-yellow animated shake");
    $(".allfechasmsg").removeClass("c-font-yellow animated shake");    
    ScrollTo('.allfechas', 0, 100);
    var lmoment = moment($("#fechaLlegada").val(),"DD-MM-YYYY");
    var smoment = moment($("#fechaSalida").val(),"DD-MM-YYYY");
    $("#fechaLlegada").focus();
		//$('.tpago').prop('checked', false);
		$('#frmRsv').formValidation('enableFieldValidators', 'pago', true);
		$('#frmRsv').formValidation('revalidateField', 'pago');		
    if(id == 'ppC'){
    	$("#fechaSalida").val(lmoment.add((allg==true) ? 3 : 1, 'days').format('DD/MM/YYYY'));
      $(".allfechasmsg").html("<label>" + (lang == 'es' ? '<i class="fa fa fa-exclamation" aria-hidden="true"></i> Selecciona las fechas para toda la estancia' : 'Select valid dates for the Whole stay' ) + "</label>");
      $(".allfechas .control-label").delay( 300 ).addClass("c-font-blue animated shake");
      $(".allfechasmsg").delay( 300 ).addClass("c-font-yellow animated shake");
    }
    else{
    	$("#fechaSalida").val(lmoment.add(2, 'days').format('DD/MM/YYYY'));
      $(".allfechasmsg").html("<label>" + (lang == 'es' ? '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Selecciona las fechas validas para las 2 noches (para 1 noche o más de 2, por favor selecciona la opción de <em>Toda la estancia</em> )': '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Select the 2 valid dates for the 2 nights (for 1 night or more than 2, please select the option Whole stay' ) + "</label>");
      $(".allfechas .control-label").delay( 300 ).addClass("c-font-yellow animated shake");
      $(".allfechasmsg").delay( 300 ).addClass("c-font-yellow animated shake");
    }
  });

  $(".tpago").on('click', function(e) {
  	valDates(allg);
  });


	if (objp && objp.geonames){
    $('.paises').empty();
		$('.paises').append($('<option>', {
		  	value: '',
		  	text : (lang == 'es' ? 'Seleccionar': 'Select' )
			})
		);
  	var sortedNames = obj.geonames;
  	if (objp.geonames.sort) {
  		sortedNames = objp.geonames.sort(function (a, b) {
      	return a.countryName.localeCompare(b.countryName);
      });
  		$.each(objp.geonames, function(i,item) {
    		var o = new Option(item.countryName,item.geonameId );
    		$('.paises').append(o);
 			});
  	}
  }


	$(".mphone").intlTelInput({
		utilsScript: assets + '/intl-tel-input/js/utils.js',
		autoPlaceholder: true,
		initialCountry: "mx",
		preferredCountries: ['mx', 'us', 'br']
	});
	
	$(".ffhone").intlTelInput({
		utilsScript: assets + '/intl-tel-input/js/utils.js',
		autoPlaceholder: true,
		initialCountry: "mx",
		preferredCountries: ['mx', 'us', 'br']
	});



	$("#fechaLlegada").datetimepicker({
		minDate: moment($("#fechaLleMin").val()),
		maxDate: moment($("#fechaLleMax").val()),
		format: 'DD/MM/YYYY',
		locale: lang,
		ignoreReadonly: true,
		showTodayButton: false,
		toolbarPlacement:'bottom',
		widgetPositioning:{
         			horizontal: 'auto',
          			vertical: 'bottom'
      		},
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
	})
	.on('dp.change', function(ec) {
		$("#fechaSalida").data("DateTimePicker").minDate(ec.date.add(1,'day'));
		$('#frmRsv').formValidation('enableFieldValidators', 'date', true);
		$('#frmRsv').formValidation('revalidateField', 'date');
		valDates(allg);
	});

	$("#fechaSalida").datetimepicker({
		minDate: moment($("#fechaSalMin").val()),
		maxDate: moment($("#fechaSalMax").val()),
		format: 'DD/MM/YYYY',
		locale: lang,
		ignoreReadonly: true,
		showTodayButton: false,
		toolbarPlacement:'bottom',
		widgetPositioning:{
         			horizontal: 'auto',
          			vertical: 'bottom'
      		},
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
	})
	.on('dp.change', function(ec) {
		$('#frmRsv').formValidation('enableFieldValidators', 'date', true);
		$('#frmRsv').formValidation('revalidateField', 'date');
		valDates(allg);
	});

	$("body").on('click', '.rfactura', function(event) {
		var e = $(this);
		var v = e.val();
		if(v == '1'){
			$(".factura").removeClass('disabled');
			$(".factura").removeAttr('disabled');
			$('#frmRsv').formValidation('enableFieldValidators', 'factura', true);
			$('#frmRsv').formValidation('revalidateField', 'factura');
			$('#telefonoFactura').val($('#telefono').val());
			$('#frmRsv').formValidation('enableFieldValidators', 'telefonoFactura', true);
			$('#frmRsv').formValidation('revalidateField', 'telefonoFactura');
			$('#frmRsv').formValidation('enableFieldValidators', 'cpFactura', true);
			$('#frmRsv').formValidation('revalidateField', 'cpFactura');
			$("#telefonoFactura").removeClass('disabled');
			$("#telefonoFactura").prop('disabled', false);
			$("#cpFactura").removeClass('disabled');
			$("#cpFactura").prop('disabled', false);										
		}
		else{
			$('#frmRsv').formValidation('enableFieldValidators', 'factura', false);
			$('#frmRsv').formValidation('revalidateField', 'factura');
			$('#frmRsv').formValidation('enableFieldValidators', 'telefonoFactura', false);
			$('#frmRsv').formValidation('revalidateField', 'telefonoFactura');
			$('#frmRsv').formValidation('enableFieldValidators', 'cpFactura', false);
			$('#frmRsv').formValidation('revalidateField', 'cpFactura');			
			$('#telefonoFactura').val();
			$(".factura").nextAll('.help-block[data-fv-result="INVALID"]').css('display', 'none');
			$(".factura").addClass('disabled');
			$(".factura").prop('disabled', true);
			$("#telefonoFactura").addClass('disabled');
			$("#telefonoFactura").prop('disabled', true);
			$("#cpFactura").addClass('disabled');
			$("#cpFactura").prop('disabled', true);						
			$(".factura").val('');
			$("#telefonoFactura").val('');
			$("#cpFactura").val('');

		}
		/* Act on the event */
	});

  function ScrollTo(target, speed, timeout) {

    if (!timeout) timeout = 0;
    if (!speed) speed = 1000;

    if (typeof target !== "undefined") {
      setTimeout(function() {
        $('html,body').animate({
          scrollTop: $(target).offset().top - 140
        }, speed);
      }, timeout);
    }
  }

  function valDates(allv = false){
  	var pr 	= $('.ppor:checked').val();
    var lmoment = moment($("#fechaLlegada").val(),"DD-MM-YYYY");
    var smoment = moment($("#fechaSalida").val(),"DD-MM-YYYY");
    var dif 		= smoment.diff(lmoment, 'days');
    $(".allfechasmsg").html("");
    $(".allfechas .control-label").removeClass("c-font-yellow animated shake");
    $(".allfechasmsg").removeClass("c-font-yellow animated shake");
  	if(pr == 'N'){
  		if(dif != 2){
	      $(".allfechasmsg").html("<label><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Selecciona las fechas validas para las 2 noches (para 1 noche o más de 2, por favor selecciona la opción de <em>Toda la estancia</em> )</label>");
	      $(".allfechas .control-label").delay( 300 ).addClass("c-font-yellow animated shake");
	      $(".allfechasmsg").delay( 300 ).addClass("c-font-yellow animated shake");
  		}
  		else{
		    $(".allfechasmsg").html("");
		    $(".allfechas .control-label").removeClass("c-font-yellow animated shake");
		    $(".allfechasmsg").removeClass("c-font-yellow animated shake");
  		}
  	}
  	else{
  			if(allv){
		  		if(dif >= 3){
				    $(".allfechasmsg").html("");
				    $(".allfechas .control-label").removeClass("c-font-yellow animated shake");
				    $(".allfechasmsg").removeClass("c-font-yellow animated shake");  			
		  		}
		  		else{
			      $(".allfechasmsg").html("<label><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Selecciona las fechas para toda la estancia</label>");
			      $(".allfechas .control-label").delay( 300 ).addClass("c-font-blue animated shake");
			      $(".allfechasmsg").delay( 300 ).addClass("c-font-yellow animated shake");		
		  		}
  			}
  			else{
		      $(".allfechasmsg").html("<label>Selecciona las fechas</label>");
		      $(".allfechas .control-label").delay( 300 ).addClass("c-font-blue animated shake");
		      $(".allfechasmsg").delay( 300 ).addClass("c-font-yellow animated shake");	
		  }
  	}
  }

	if ( $("#frmRsv").length ) {
		var host = jQuery(location).attr('host');
		$('#frmRsv')
			.formValidation({
				framework: 'bootstrap',
				locale: objl[lang],
				live: 'enabled',
				fields: {
					telefono: {
						validators: {
								callback: {
										message: 'Teléfono no valido',
										callback: function(value, validator, $field) {
											return value === '' || $field.intlTelInput('isValidNumber');
										}
								}
						}
					},
					telefonoFactura: {
						validators: {
								callback: {
										message: 'Teléfono no valido',
										callback: function(value, validator, $field) {
											return value === '' || $field.intlTelInput('isValidNumber');
										}
								}
						}
					},					
					cp: {
						validators: {
								regexp: {
									regexp: /^\d{5}$/,
									message: (lang === 'es') ? 'El código postal debe contener 5 digitos' : 'The postalcode must contain 5 digits'
								}
						}
					},
					cpFactura: {
						validators: {
								regexp: {
									regexp: /^\d{5}$/,
									message: (lang === 'es') ? 'El código postal debe contener 5 digitos' : 'The postalcode must contain 5 digits'
								}
						}
					},
					pago:{
						validators: {
							notEmpty: {
								enabled: true
							}
						}
					},
					pagoPor:{
						validators: {
							notEmpty: {
								enabled: true
							}
						}
					},						
					factura:{
						selector: '.factura',
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
					habitacionc:{
						validators: {
							notEmpty: {
								enabled: true
							},
							callback: {
									message: (lang === 'es') ? ' Seleccione la habitación' : ' Select the room',
									callback: function (value, validator, $field) {
										var htindex 	= $field.attr('data-hotel-index');
										var htnombre	= $field.attr('data-hotel-nombre');
										var htimage		= $field.attr('data-hotel-image');
										$("#htimg").attr('href', protocol + host + assets + '/img/hotel/' + rutaImg + '/'+ htimage);
										$("#imgHotel").val(protocol + host + assets + '/img/hotel/' + rutaImg + '/'+ htimage);
										$("#idHotel").val(htindex);
										$("#hotel").val(htnombre);
										if (value !== '') {
											$('div[data-div-for="habitacionc"]').removeClass('hide');
											/*$('html,body').animate({
												scrollTop: $('div[data-div-for="habitacionc"]').offset().top - 100},
												'slow');*/
											return true;
										}
										$('div[data-div-for="habitacionc"]').addClass('hide');
										return false;
									}
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
						language: lang
					}
				}
			})
			.on('err.field.fv', function(e, data) {
				$.each(data.fv.getInvalidFields(), function(index, val) {
					val.focus();
					return false;
				});
				if(data.field == 'habitacionc'){
					$('div[data-div-for="habitacionc"]').removeClass('hide');
					$('html,body').animate({
						scrollTop: $('div[data-div-for="habitacionc"]').offset().top - 100},
						'slow');
				}
			})
			.on('success.field.fv', function(e, data) {				
				if(data.field == 'habitacionc'){
					$('div[data-div-for="habitacionc"]').addClass('hide');
				}
				/*if(data.fv.getInvalidFields().length >= 0){

				}*/
			})
			.on('init.form.fv', function(e, data) {
			})
			.on('success.form.fv', function(e){// Prevent form submission
				e.preventDefault();
				// Get the form instance
				var $form = $(e.target);
				// Get the FormValidation instance
				var bv = $form.data('formValidation');
				// Use Ajax to submit form data
				$('#send').find("div").html("<span class='fa fa-circle-o-notch fa-spin'></span> " + (lang == 'es') ? 'Reservando' : 'Booking');
				$('#send').attr('disabled', 'disabled');
    				/* empieza el dialog */
						var pageLoad 	= urlConfirma + "/" + lang;
    				var zIndexHeader = $(".c-layout-header-fixed .c-layout-header").css('zIndex');
    				var msgbox = new BootstrapDialog({
						title: (lang == 'es')  ? "Confirmación de Reservación" : "Reservation confirmation",
      					size: BootstrapDialog.SIZE_WIDE,
      					type: BootstrapDialog.TYPE_INFO,
      					cssClass: 'user-dialog',
      					closeByBackdrop: false,
	           			message: function(dialog) {
	           				var $message = $('<div align="center" id="msgmodal"><span class="fa fa-circle-o-notch fa-spin text-green"></span> Cargando</div>');
	              			var pageToLoad = dialog.getData('pageToLoad');
	              			$message.load(pageToLoad,$form.serialize(), function() {
	              			});
	              			return $message;
	           			},
	           			data: {
	              			'pageToLoad': pageLoad
	           			},
							draggable: true,
							z_index_backdrop: zIndexHeader + 10,
  						z_index_modal: zIndexHeader +20,
  						buttons: [
  							{
  								id: "btn-can-action",
          						label: (lang == 'es') ? "<span>Cancelar</span>" : "<span>Cancel</span>" ,
          						cssClass: "btn btn-xs btn-danger c-btn-square",
	                				action: function(dialogItself){
	                    				var $button   = this;
	                    				$('#send').find("div").html(lang == 'es' ? "Reservar" : "Book");
	                    				$('#send').removeAttr('disabled');
	                    				$('#send').removeClass('disabled');
	                    				dialogItself.close();
	                				}
  							},
  							{
  								id: "btn-send-action",
          				label: (lang == 'es') ? "<span>Aceptar</span>" : "<span>Acept</span>",
          				cssClass: "btn btn-xs btn-success c-btn-square",
          				autospin: true,
          				action: function(dialogItself){
        							var $buttonSend 	= dialogItself.getButton('btn-send-action');
        							var $buttonCancel = dialogItself.getButton('btn-can-action');
        							$buttonSend.disable();
        							$buttonCancel.disable();
        							var imghFinal = $("#httumb").attr('src');
											var mode 			= mode;
											axios.post($form.attr('action'),$form.serialize())
											  .then(function (response){
											  	var data 		= response.data.data;
											  	var request = response.data.request;
													var status  = response.data.status;
													
											  	if(status){
														dialogItself.close();
														$("#frmRsv").addClass('animated fadeOutUp');

														if(data.formapago == 'DB'){
															$("#mpp").addClass('hidden');
															$("#frmRsv").remove();
															$("#mdb").removeClass('hidden').addClass('animated fadeInUp');
														}
														else{
															
															$("#mdb").addClass('hidden');
															$("#mpp").removeClass('hidden').addClass('animated fadeInUp');
															$("#frmRsv").remove();
															$("#nmail").text(data.email);
															$("#ppplus").height(200);
															$("#ppplus").block({
											            message: '<h1>' + ((lang  == 'es') ? 'Procesando' : 'Processing')  + '</h1> <img src="' + protocol + host + assets + '/img/F-1s-200px.svg" height="48">',
											            css: {
												            border: 					'none',
												            padding: 					'15px',
												            backgroundColor: 	'#000',
												            'border-radius': 	'10px',
												            opacity: 					0.8,
												            color: 						'#fff',
												            top: 							'10px'
											            },
											            overlayCSS:  {
											        			backgroundColor: 	'#fff',
											        			opacity: 					0.8
											        		}
															});
															axios.get(urlChekout, {
																   params: {
															    	id: 	data.idreservacion,
															    	mode: request.pmode
															     }
															  })
															  .then(function (response) {
										                $appUrl = response.data.content.links[1].href;
										                $exeUrl = response.data.content.links[2].href;
										                $token 	= response.data.token;
										                $mode   = response.data.mode;
										                $("#ppplus").height(400);
										                var pp = PAYPAL.apps.PPP({
										                          "approvalUrl": 			$appUrl,
										                          "placeholder": 			"ppplus",
										                          "mode": 						$mode,
										                          "payerEmail" : 			data.email,
										                          "payerFirstName" : 	data.nombre,
										                          "payerLastName" : 	data.app + '' + data.apm,
										                          "payerPhone" : 			data.telefono,
										                          "payerTaxId" : 			"",
										                          "language" : 				objl[lang],
										                          "disableContinue" : "continueButton",
										                          "enableContinue": 	"continueButton",
										                          "onLoad" : function(){
										                            $("#ppplus").unblock();
										                            $("#continueButton").removeClass('hidden');
										                          },
										                          "onContinue" : function(rememberedCards, payerId, token){
										                          },
										                          "onError" : function(err){
										                          }
										                });
																		$("body").on('click', '#continueButton', function(event) {
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
																			try{
										                    var dataCheck = JSON.parse(event.data);
										                    var action = dataCheck.action;
										                    var result = (dataCheck.result) ? dataCheck.result : {};
										                    if(action == 'checkout'){
										                      var obj = {};
										                      obj['pay_id']   = "PAY-" + result.payer.funding_option.id
										                      obj['token']    = $token;
										                      obj['payer_id'] = result.payer.payer_info.payer_id;
										                      obj['exeUrl']   = $exeUrl;

								                          $("#ppplus").block({
								                            message: '<h3>' + ((lang == 'es') ? 'Procesando pago' : 'Processing payment') + '</h3> <img src="'+ assets +'/img/F-1s-200px.svg" height="48">',
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
									                            objr['code']     = eResponse.data.content.transactions[0].item_list.items[0].sku;
									                            objr['st']  	   = 'Completed';
									                            objr['tx']       = eResponse.data.content.transactions[0].related_resources[0].sale.id;
                                              objr['des']      = eResponse.data.content.transactions[0].related_resources[0].sale.id;
									                            objr['data'] 	   = data;
																							objr['request']  = request;
									                            $.redirect(urlPayReturn+ "/" + lang,objr);
									                          }
									                        })
									                        .catch(function (error) {
									                        	//var_dump(error);
                        									})
                        									.then(function () {
										                          $("#ppplus").block({
										                            message: '<h3>' + ((lang == 'es') ? 'Procesando pago' : 'Processing payment') + '</h3> <img src="'+ assets +'/img/F-1s-200px.svg" height="48">',
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
															  });
														}
											  	}
											  })
											  .catch(function (error) {
											  });
          				}
  							}
  						]
    				});
			     	msgbox.realize();
    				var foo 	= msgbox.getModalFooter();
    				var $btnc  = msgbox.getButton('btn-can-action');
    				$btnc.before('<span class="quest finfo">'+ ((lang == 'es') ? '¿Los datos son correctos?' : 'The data is correct') + '</span>');
			     	msgbox.open();
			     	$dialog = msgbox;
			})
			.on('click', '.country-list', function() {
				$('#contactForm').formValidation('revalidateField', 'telefono');
			});
	}



});
