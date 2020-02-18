$(document).ready(function() {

	var hJson 			= $("#hotelesJson").val();
	var paises  		= $("#paises").val();
	var obj 				= $.parseJSON(hJson);
	var objp   			=	$.parseJSON($.parseJSON(paises));
	var cur   			= $("#currency").val();
	var idHotel			= $("#idHotel").val();
	var lang 				= $("#lang").val();
	var j 					= idHotel;
	var payButton 	= null;
	var $dialog 		= null;
	var $listener 	= null;
	var $pCheckOut 	= {};
	var rutaImg    	= $("#rutaImg").val();
	var host 				= $("#host").val();
	var hostFull 		= $("#hostFull").val();
	var assets  		= $("#assets").val();
	var protocol  	= $("#protocol").val();
	var currency   	= $("#divisa").val();
	var urlConfirma = $("#urlConfirma").val();
	var urlApplyPay = $("#urlApplyPay").val();
	var urlChekout 	= $("#urlChekout").val();
	var urlExecute 	= $("#urlExecute").val();
	var mode 				= $("#pmode").val();
	var objl 				= {
											'es': 'es_ES',
											'en': 'en_US'
										};
  (idHotel !== 0) ? $("#idHotel").val(idHotel) : $("#idHotel").val('');
	$("#htimg").attr('href', protocol + host + assets + '/img/hotel/source.png');
	$("#httumb").attr('src', protocol + host + assets + '/img/hotel/source.png');
	$("#htnombre").html('<span class="has-error">Seleccionar el hotel</span>');
	$("#habitaciones").html('<div class="text-center"><span class="has-error">Seleccionar el hotel</span></div>');
	$("#msgs").html('');
	var blkAco 			= !!$("#blkAco").val();	
	
	if(idHotel !== 0 && obj[j] !== undefined){
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
		$.each(habitaciones, function(index, val) {
				if (typeof(val.sep) !== 'undefined') {
					habs += '<div class="row"><div class="col-sm-12 col-md-12"><hr></div></div>';
				}
				else{
					habs += '<div class="row from-group">\n'+
									'	<div class="col-sm-7 col-md-7 hbtipo">' + ((val.tipo[lang] == '') ? '&nbsp' : val.tipo[lang])  + (val.hagotada == true ? ' <span class="label label-warning c-font-slim">Agotada</span>' : '') + '</div>\n'+
									'	<div class="col-sm-3 col-md-3 hbcosto">' + currency + ' $' + ((val.costo[cur] == '') ? '&nbsp;' : val.costo[cur]  ) + '</div>\n'+
									'	<div class="col-sm-2 col-md-2 hbradio">\n'+
									'			<div class="c-radio">\n'+
									'				<input class="c-radio" name="habitacionc" id="htc' + (index + 1 ) + '" value="' + val.tipo[lang]+ "|" + val.costo[cur] + "|" + val.propinas[cur] + "|" + val.pack + '|' + val.pp +'|' + val.costor[cur] + '" type="radio" required' + (val.hagotada == true ? ' disabled' : '') + ' >&nbsp;\n'+
									'				<label for="htc' + (index + 1 ) + '">\n'+
									'					<span></span><span class="check"></span><span class="box"></span>&nbsp\n'+
									'				</label>\n'+									
									'			</div>\n'+
									'	</div>\n'+
									'</div>';
				}			
		});
		$("#habitaciones").html(habs);
		$("#msgs").html(mensajes);
	}

	if(blkAco == true){
		$('.c-radio').on('click', function(e) {
			if(e.target.value !== undefined){
				var s = e.target.value;
				if(s.indexOf("Doble") >= 0 || s.indexOf("Triple") >= 0 || s.indexOf("Cuádruple") >= 0){
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

	$("#idHotel").change(function(event) {
		var e = $(this);
		var value = e.val();
	    $("#htimg").attr('href', protocol + host + assets + '/img/hotel/source.png');
		//$("#httumb").attr('src', protocol + host + assets + '/img/hotel/source.png');
		$("#httumb").attr('src', protocol + host + assets + '/img/F-1s-200px.svg');
		if(value != 0){
			var j 						= value;
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
			$.each(habitaciones, function(index, val) {
					if (typeof(val.sep) !== 'undefined') {
						habs += '<div class="row"><div class="col-sm-12 col-md-12"><hr></div></div>';
					}
					else{
						habs += '<div class="row from-group">\n'+
										'	<div class="col-sm-7 col-md-7 hbtipo">' + ((val.tipo[lang] == '') ? '&nbsp' : val.tipo[lang])  + (val.hagotada == true ? ' <span class="label label-warning c-font-slim">Agotada</span>' : '') + '</div>\n'+
										'	<div class="col-sm-3 col-md-3 hbcosto">' + currency + ' $' + ((val.costo[cur] == '') ? '&nbsp;' : val.costo[cur]  ) + '</div>\n'+
										'	<div class="col-sm-2 col-md-2 hbradio">\n'+
										'			<div class="c-radio">\n'+
										'				<input class="c-radio" name="habitacionc" id="htc' + (index + 1 ) + '" value="' + val.tipo[lang]+ "|" + val.costo[cur] + "|" + val.propinas[cur] + "|" + val.pack + '|' + val.pp +'|' + val.costor[cur] + '" type="radio" required' + (val.hagotada == true ? ' disabled' : '') + ' >&nbsp;\n'+
										'				<label for="htc' + (index + 1 ) + '">\n'+
										'					<span></span><span class="check"></span><span class="box"></span>&nbsp\n'+
										'				</label>\n'+									
										'			</div>\n'+
										'	</div>\n'+
										'</div>';
					}			
			});			
			$("#habitaciones").html(habs);
			$("#msgs").html(mensajes);
		  $('#frmRsv').formValidation('enableFieldValidators', 'habitacionc', true);
		  $('#frmRsv').formValidation('revalidateField', 'habitacionc');
		  
		  /*if(all){
		  	$("#rnight").addClass('hidden');
		  	$("#ppC").prop('checked', true);
		  }
		  else{
		  	$("#rnight").removeClass('hidden');
		  	$("#ppC").removeAttr('checked');
		  }*/

			if(blkAco == true){
				$('.c-radio').on('click', function(e) {
					if(e.target.value !== undefined){
						var s = e.target.value;
						if(s.indexOf("Doble") >= 0 || s.indexOf("Triple") >= 0 || s.indexOf("Cuádruple") >= 0){
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

		}
		else{
			$("#htimg").attr('href', protocol + host + assets + '/img/hotel/source.png');
			$("#httumb").attr('src', protocol + host + assets + '/img/hotel/source.png');
			$("#htnombre").html('<span class="has-error">Seleccionar el hotel</span>');
			$("#habitaciones").html('<div class="text-center"><span class="has-error">Seleccionar el hotel</span></div>');
			$("#msgs").html('');
		}		
	});

	if (objp && objp.geonames){
    $('.paises').empty();
		$('.paises').append($('<option>', {
		  	value: '',
		  	text : 'Seleccionar'
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
	});  

	$("body").on('click', '.rfactura', function(event) {
		var e = $(this);
		var v = e.val();
		if(v == '1'){
			$(".factura").removeClass('disabled');
			$(".factura").removeAttr('disabled');
			$('#frmRsv').formValidation('enableFieldValidators', 'factura', true);
			$('#frmRsv').formValidation('revalidateField', 'factura');
		}
		else{
			$('#frmRsv').formValidation('enableFieldValidators', 'factura', false);
			$('#frmRsv').formValidation('revalidateField', 'factura');
			$(".factura").nextAll('.help-block[data-fv-result="INVALID"]').css('display', 'none');
			$(".factura").addClass('disabled');
			$(".factura").prop('disabled', true);
			$(".factura").val('');
		}
		/* Act on the event */
	});

	if ( $("#frmRsv").length ) {
		var host = jQuery(location).attr('host');
		$('#frmRsv')
			.formValidation({
				framework: 'bootstrap',
				locale: objl[lang],
				live: 'enabled',
				fields: {
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
			.on('err.field.fv', function(e, data) {
				if(data.field == 'habitacionc'){
					$('div[data-div-for="habitacionc"]>small').css('display', 'inline');
				}
			})
			.on('success.field.fv', function(e, data) {
				if(data.field == 'habitacionc'){
					$('div[data-div-for="habitacionc"]>small').css('display', 'none');
				}
				if(data.fv.getInvalidFields().length >= 0){

				}
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
						title: (lang == 'es')  ? "Solicitud de Reservación" : "Reservation request",
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
        							var mode 			= mode
          						$.post($form.attr('action'), $form.serialize(), function(result) {
												if(result.status){
													dialogItself.close();
													$("#frmRsv").addClass('animated fadeOutUp');
													if(result.data.formapago == 'DB'){
														$("#mpp").addClass('hidden');
														$("#frmRsv").remove();
														$("#mdb").removeClass('hidden').addClass('animated fadeInUp');
													}
													else{
														$("#mdb").addClass('hidden');
														$("#mpp").removeClass('hidden').addClass('animated fadeInUp');
														$("#frmRsv").remove();
														$("#ppplus").height(200);
														$("#ppplus").block({
										            message: '<h1>Procesando</h1> <img src="' + protocol + host + assets + '/img/F-1s-200px.svg" height="48">',
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
														var checkOut 	= $.get(urlChekout,result.data);
														var dataFinal = result.data;
														var objl = {
																				'es': 'es_MX',
																				'en': 'en_US'
																			}
														$.when(checkOut).done(function (response) {
															$pCheckOut = response;
															if(jQuery.isEmptyObject($pCheckOut) == false){
																$appUrl = $pCheckOut.content.links[1].href;
																$exeUrl = $pCheckOut.content.links[2].href;
																$token 	= $pCheckOut.token;
																var ppp = PAYPAL.apps.PPP({
																	"approvalUrl": $appUrl,
															  	"placeholder": "ppplus",
															  	"mode": result.data.mode,
															  	"payerEmail" : result.data.email,
															  	"payerFirstName" : result.data.nombre,
															  	"payerLastName" : result.data.app + " " + result.data.apm,
															  	"payerPhone" : result.data.telefono,
															  	"payerTaxId" : "",
															  	"language" : objl[result.data.lang],
															  	"disableContinue" : "continueButton",
															  	"enableContinue": "continueButton",
															  	"onLoad" : function(){
															  		$("#ppplus").unblock();
															  	},
															  	"onContinue" : function(rememberedCards, payerId, token){
															  	},
															  	"onError" : function(err){
															  	}
																});

																$("#continueButton").removeClass('hidden');
																$("body").on('click', '#continueButton', function(event) {
																	event.preventDefault();
																	ppp.doContinue();
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
																		//this is how we extract the message from the incoming events, data format should look like {"action":"inlineCheckout","checkoutSession":"error","result":"missing data in the credit card form"}
																   	var data = JSON.parse(event.data);
																   	var action = data.action;
																   	var result = (data.result) ? data.result : {};
																   	if(action == 'checkout'){
																   		var obj = {};
																   		obj['pay_id'] 	= "PAY-" + result.payer.funding_option.id
																   		obj['token'] 		= $token;
																   		obj['payer_id']	= result.payer.payer_info.payer_id;
																   		obj['exeUrl'] 	= $exeUrl;
																   		var execute = $.get(urlExecute,obj);
																   		$("#mpp").remove();
																   		//$("#ppplus").remove();
																   		$("#continueButton").remove();
																			$("#ppplus").block({
															            message: '<h1>Procesando pago </h1> <img src="' + protocol + host + assets + '/img/F-1s-200px.svg" height="48">',
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
																   		$.when (execute).done(function (eResponse) {															   			
																   			if((eResponse.code == 200 || eResponse == 201) && eResponse.content.state == "approved" ) {
																   				var content = eResponse.content;
																   				$("#c_order").html(content.transactions[0].item_list.items[0].sku);
																   				$("#c_description").html(content.transactions[0].item_list.items[0].description);
																   				$("#c_id").html(content.transactions[0].related_resources[0].sale.id);
																   				$("#c_total").html("$" + content.transactions[0].related_resources[0].sale.amount.total + " " + content.transactions[0].related_resources[0].sale.amount.currency);
																   				$("#ppplus").remove();
																   				$("#aproved").removeClass('hidden');
																   				$("#imgfinal").attr('src', imghFinal);
																   				$("#finalName").html(dataFinal.nombre + " " + dataFinal.app + " " + dataFinal.apm + "(" + dataFinal.email + ")");
																   				$("#finalHotel span").html(dataFinal.nombrehotel);
																   				$("#finalHabitacion span").html(dataFinal.tipohabitacion);
																   			}
																   		});
																   	}

																   	if(action == 'closeMiniBrowser'){
																   		$("#ppplus").remove();
																   		$("#continueButton").remove();
																   	}
																		//do some logic here to handle success events or errors if any
																  }
																  catch (exc) {
																  }
																}																																																	

															}
														});
												}
											}
										}, 'json');
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
			});
	}



});