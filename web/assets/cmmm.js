$.when(jeoquery.getGeoNames('countryInfo'))
    .then(function (obj) {
    	$('.paises').empty();
      	if (obj && obj.geonames){
        	var sortedNames = obj.geonames;
        	if (obj.geonames.sort) {
                sortedNames = obj.geonames.sort(function (a, b) {
                    return a.countryName.localeCompare(b.countryName);
                });
        	}
        	$('.paises').append($('<option>', { 
            		value: '',
            		text : 'Seleccionar'
         		})
        	);
          $.each(obj.geonames, function(i,item) {
            var o = new Option(item.countryName,item.countryName );
            $('.paises').append(o);
          });
    	}
});

$("body").on('click', '#aco', function(event) {
	var e 	= $(this);
	var v 	= e.val();
	var sw 	= e.find(".ios-switch");
	if(sw.hasClass('on')){
		$('[data-aco]').removeClass('hidden').addClass('animated fadeIn');
    $('#frmmm').formValidation('enableFieldValidators', 'aco', true);
    $('#frmm').formValidation('revalidateField', 'aco');    
	}
	else{
    $('#frmmm').formValidation('enableFieldValidators', 'aco', false);
    $('#frmm').formValidation('revalidateField', 'aco');
    $('.aco').val('');     
		$('[data-aco]').addClass('hidden').removeClass('animated fadeIn');
	}	
});

if ( $("#frmmm").length ) {
  $('#frmmm')
    .formValidation({
      framework: 'bootstrap',
      locale: 'es_ES',
      live: 'enabled',
      //excluded: ':disabled',
      fields: {
        aco:{
          selector: '.aco',
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
        }                                           
      },
      /*addOns: {
        reCaptcha2: {
          element: 'captchaContainerC',
          theme: 'clean',
          siteKey: (host == 'localhost') ? '6LeTACUTAAAAABdKkPPyxt71S91_xFTCz92MGw-n' : '6Le3Uh0TAAAAAIL5BEa-c1ZMCDzGuZSeL-cHx0DF',
          timeout: 120,
          message: 'El captcha no es valido',
          language: 'es'
        }
      }*/              
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
    })
    .bootstrapWizard({
      tabClass: 'wizard-steps',
      //nextSelector: 'ul.pager li.next',
      //previousSelector: 'ul.pager li.previous',      
      onTabClick: function(tab, navigation, index) {        
        return validateTab(index);
      },
      onNext: function( tab, navigation, index, newindex ) {
        var numTabs    = $('#frmmm').find('.tab-pane').length,
            isValidTab = validateTab(index - 1);
        if (!isValidTab) {
            return false;
        }
        //fsend(index,numTabs,$('#frmmm'));
        return true;
      },
      onPrevious: function(tab, navigation, index) {
        $(".wizard li.send").addClass('hidden');
        $(".wizard li.next").removeClass('hidden');        
        return validateTab(index + 1);
      },
      onTabShow: function(tab, navigation, index) {
        // Update the label of Next button when we are at the last tab
        var numTabs = $('#frmmm').find('.tab-pane').length;
        $('#frmmm').formValidation('enableFieldValidators', 'aco', false);
        $('#frmm').formValidation('revalidateField', 'aco');
        $('#frmmm').find('.next').removeClass('disabled');
        fsend(index,numTabs,$('#frmmm'));
      }                        
    });    
}

function validateTab(index) {
  var fv   = $('#frmmm').data('formValidation'), // FormValidation instance
  // The current tab
  $tab = $('#frmmm').find('.tab-pane').eq(index);
  // Validate the container
  fv.validateContainer($tab);
  var isValidStep = fv.isValidContainer($tab);
  if (isValidStep === false || isValidStep === null) {
      // Do not jump to the target tab
      return false;
  }
  return true;
}

function fsend(index,numTabs,form){
  if (index === numTabs-1) {
    var arrData = $(form).serializeArray();
    $.each(arrData, function(index, val) {
      var vname = val.name;
      var value = val.value;
      $("[data-form='" + vname + "']").html(value);
    });
    $(".wizard li.next").addClass('hidden');
    $(".wizard li.send").removeClass('hidden');
    $("body").on('click', '.wizard li.send', function(event) {
      event.preventDefault();
      $.post($(form).attr('action'), $(form).serialize(), function(result) {
        $(".wizard li.send button").attr('disabled', 'disabled').addClass('disabled');
        $(".wizard li.send button div").html("<span class='fa fa-circle-o-notch fa-spin'></span> Enviando");
        if(result.status){
          $("#frmmm").remove();
          $("#result").removeClass('hidden').addClass('animated fadeInUp');
          $("#nmail").html(result.data.correo);
        }
      }, 'json');            
    });         
  }
  else{
    $(".wizard li.next").removeClass('hidden');
    $(".wizard li.send").addClass('hidden');    
  }  
}

$('.date').datetimepicker({
      minDate: moment('2017-09-12'),
      maxDate: moment('2017-09-15'),
      //format: 'DD/MM/YYYY',
      locale: 'es',
      ignoreReadonly: true,
      showTodayButton: false,
      //toolbarPlacement:'top',
      widgetPositioning:{
                horizontal: 'right',
                vertical: 'top'
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
      $('#frmmm').formValidation('enableFieldValidators', 'date', true);
      $('#frmmm').formValidation('revalidateField', 'date');      
    });