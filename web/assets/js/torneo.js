$(document).ready(function() {

  var host  = jQuery(location).attr('host');

  if ( $("#ftorneo").length ){
    $(".tipo").prop('checked',false);
    $("#transporte").val('');
    $("#habitacion").val('');
    $("#ncamas").val('');
    $("#equipo").val('');
    $("#guante").val('');
    $("#alergiasi").val('');
    $("#noches").val('');
    $("#nochesa").val('');
    $("#gtalla").val('');
    $("#jcamisa").val('');
    $("#njcamisa").val('');
    $("#respaciales").val('');
    $("#comentarios").val('');

    $('body').on('click', '.tipo', function(event) {
      var e = $(this);
      var v = e.val();
      $('.djugador').addClass('hidden');
      $("#handicap").rules("remove");
      $("#equipo").rules("remove");
      $("#njcamisa").rules("remove");
      $("#guante").rules("remove");
      $("#gtalla").rules("remove");
      $("#jcamisa").rules("remove");         
      if(v == 'Jugador'){
        $('.djugador').removeClass('hidden');
        $('.dnjugador').addClass('hidden');
        $("#handicap").rules( "add", {
          required: true,
          range: [1, 150]
        });
        $("#equipo").rules( "add", {
          required: true
        });
        $("#guante").rules( "add", {
          required: true
        });
        $("#gtalla").rules( "add", {
          required: true
        });
        $("#jcamisa").rules( "add", {
          required: true
        });        
      }
      if(v == 'No jugador'){
        $('.dnjugador').removeClass('hidden');
        $('.djugador').addClass('hidden');
        $("#njcamisa").rules( "add", {
          required: true
        });        
      }
    });

    $("#habitacion").change(function(event){
      var e = $(this);
      var v = e.val();
      $("#ncamas").rules("remove");
      $("#noches").rules("remove");
      $("#fncamas").addClass('invisible');
      $("#fnoches").addClass('invisible');
      $("#fnochesa").addClass('invisible');
      $("#fncamas").addClass('invisible');
      if(v !== ''){
        $("#fnoches").removeClass('invisible');
        $("#fnochesa").removeClass('invisible');
        $("#noches").rules( "add", {
          required: true
        });        
      }
      if(v == 'Doble'){
        $("#fncamas").removeClass('invisible');
        $("#ncamas").rules( "add", {
          required: true
        });
      }
    });

    $('body').on('click', '#factura', function(event) {
      var e   = $(this);
      var st  = e.is(":checked");
      $("#rsocial").rules("remove");
      $("#rfc").rules("remove");
      $("#fcorreo").rules("remove");
      $("#ftelefono").rules("remove");
      $("#fdireccion").rules("remove");
      $(".fact").addClass('hidden');
      if(st){
        $(".fact").removeClass('hidden');
        $("#rsocial").rules( "add", {
          required: true
        });
        $("#rfc").rules( "add", {
          required: true
        });
        $("#fcorreo").rules( "add", {
          required: true
        });
        $("#ftelefono").rules( "add", {
          required: true
        });
        $("#fdireccion").rules( "add", {
          required: true
        });                                        
      }
      else{
        $("#rsocial").val('');
        $("#rfc").val('');
        $("#fcorreo").val('');
        $("#ftelefono").val('');
        $("#fdireccion").val('');        
      }
    });

    $("#equipo").change(function(event){
      var e = $(this);
      var v = e.val();
      //$("#guante").rules("remove");
      //$("#flado").addClass('invisible');
      //$("#fgtalla").addClass('invisible');
      //$("#fcamisa").addClass('invisible');
      //$("#gtalla").rules("remove");
      //$("#jcamisa").rules("remove");      
      if(v == 'Si'){
        //$("#flado").removeClass('invisible');
        //$("#fgtalla").removeClass('invisible');
        //$("#fcamisa").removeClass('invisible');
        /*$("#guante").rules( "add", {
          required: true
        });
        $("#gtalla").rules( "add", {
          required: true
        });
        $("#jcamisa").rules( "add", {
          required: true
        });*/                
      }
    });


    $("#alergiasi").change(function(event){
      var e = $(this);
      var v = e.val();
      $("#alergia").rules("remove");
      $("#falergias").addClass('invisible');
      if(v == 'Si'){
        $("#falergias").removeClass('invisible');
        $("#alergia").rules( "add", {
          required: true
        });
      }
    });    

    $('#fechal').datetimepicker({
      minDate: moment('2020-01-22'),
      maxDate: moment('2020-01-24'),
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
    });

    $("#horal").datetimepicker({
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
    });

    $('#fechas').datetimepicker({
      minDate: moment('2020-01-22'),
      maxDate: moment('2020-01-24'),
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
    });

    $("#horas").datetimepicker({
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
    });


    $("#transporte").change(function(event){
      var e = $(this);
      var v = e.val();
      if(v == "Aereo"){
        $("#dvuelos").removeClass('hidden');
        /*$("#nvuelol").rules( "add", {
          required: true
        });
        $("#aerolineal").rules( "add", {
          required: true
        });
        $("#fechal").rules( "add", {
          required: true
        });
        $("#horal").rules( "add", {
          required: true
        });
        $("#nvuelos").rules( "add", {
          required: true
        });
        $("#aerolineas").rules( "add", {
          required: true
        });
        $("#fechas").rules( "add", {
          required: true
        });
        $("#horas").rules( "add", {
          required: true
        });*/                
      }
      else{
        $("#dvuelos").addClass('hidden');
        /*$("#nvuelol").rules( "remove");
        $("#aerolineal").rules( "remove");
        $("#fechal").rules( "remove");
        $("#horal").rules( "remove");
        $("#dvuelos").addClass('hidden');
        $("#nvuelos").rules("remove");
        $("#aerolineas").rules("remove");
        $("#fechas").rules("remove");
        $("#horas").rules("remove");
        $(".fvuelol").val('');*/       
      }
    });    

    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una dirección de correo válida",
        url: "Por favor, escribe una URL válida.",
        date: "Por favor, escribe una fecha válida.",
        dateISO: "Por favor, escribe una fecha (ISO) válida.",
        number: "Por favor, escribe un número entero válido.",
        digits: "Por favor, escribe sólo dígitos.",
        creditcard: "Por favor, escribe un número de tarjeta válido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        accept: "Por favor, escribe un valor con una extensión aceptada.",
        maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
        max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
        min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
      });

    $("#ftorneo").validate({					
		    rules:{
          correo:
          {
            email: true
          },
        },
        messages:{
        },
        submitHandler: function(form) {
          $('#send').attr('disabled',true).addClass('disabled');
          HoldOn.open({
            theme:    "sk-cube-grid",
            message:  "<h3>Enviando</h3>"
          });           
          axios.post($("#ftorneo").attr('action'),$("#ftorneo").serialize())
          .then(function (response) {
            var data = response.data;
            if(data.status){
              HoldOn.close();
              var options = {
                theme:"custom",
                // If theme == "custom" , the content option will be available to customize the logo
                content:'',
                message:'Se registraron correctamente los datos. Se envio un correo a <strong><span>' + data.data.correo + '</span></strong> con los detalles <input type="button" class="button btn btn-primary" value="Cerrar" onclick="HoldOn.close(); window.location.reload();">',
                backgroundColor:"#333",
                textColor:"white"
              };
              HoldOn.open(options);            
            }
          })
          .catch(function (error) {
            
          })
          .then(function (){             
          });
        },                   
        errorPlacement: function(error, element)
        {
          error.insertAfter(element.parent());
        }        
      }
    );      
  }

  if ( $("#map_hotel").length ){

    $("#map_hotel").gMap({
      controls: false,
      scrollwheel: true,
      maptype: 'ROADMAP',
      markers: [
          {
            latitude: 20.662156,
            longitude: -105.256700 
          },
          {
            icon: {
                  image: "http://www.google.com/mapfiles/marker.png",
                  iconsize: [26, 46],
                  iconanchor: [12,46]
            }
          }
      ],
      zoom: 17
    });
  }

});  