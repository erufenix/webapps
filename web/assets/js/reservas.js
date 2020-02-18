
  $('.profile').initial(
    {
      charCount:2,
      height:36,
      width:36,
      fontSize:14
    }
  );
   

  $(".nevent").initial(
    {
      charCount:15,
      fontSize:10,
      seed:9,
      color: 'random'
    }
  );

  $('#m-a-a').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    modal.find('.modal-title').text(button.attr('data-title'));
    modal.find('.modal-body').html('<div class="pull-center"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></div>');
    modal.find('.modal-footer').removeClass('invisible');
    modal.find('.modal-footer button.cancel > div').html(button.attr('data-cancel'));
    modal.find('.modal-footer button.accept > div').html(button.attr('data-accept'));
    modal.find('.modal-footer button.accept').removeAttr('id');
    modal.find('.modal-footer button.accept').attr('id', button.attr('data-id'));
    modal.find('.modal-body').load(button.attr('data-src'),{},
    		function(){
    		}
    );
  })

  $('#m-a-a').on('shown.bs.modal', function (e) {
    var rt      = $(e.relatedTarget);
    var form    = $("#" + rt.attr('data-form'));
    var btnSend = $("#" + rt.attr('data-id'));
    var modal   = $(this);
    $(form)
      .formValidation({
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
          }
        },          
      })
      .on('success.field.fv', function(e, data) {
        //console.log(data.fv.getInvalidFields());
        if (data.fv.getInvalidFields().length >= 0) {    // There is invalid field
          btnSend.removeClass('disabled');
          btnSend.removeAttr('disabled');      
        }
      })    
      .on('init.form.fv', function(e, data) {
      })
      .on('err.form.fv', function(e,data){
        btnSend.addClass('disabled');
        btnSend.prop('disabled', true);
      })
      .on('success.form.fv', function(e,data){
        e.preventDefault();
        var $form = $(e.target),
        fv    = $form.data('formValidation');
        $.ajax({
          url: $form.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: $form.serialize(),
            success: function(result) {
              if(result.status){
                modal.find('.modal-footer').addClass('invisible');
                modal.find('.modal-body').html('<div><span class="label success pos-rlt m-r-xs"><b class="arrow right b-success pull-in"></b>' + result.data.eventoIdioma.nombre_evento + '</span> <span class="h6">agregado corectamente</span></div><div>Actualizando lista de eventos <i class="fa fa-lg fa-refresh fa-spin"></i></div>');
                setTimeout(function(){ 
                  $(window).attr("location",result.url)  
                }, 4000);              
              }
            }
        });      
      });

   
    btnSend.on('click', function(event) { 
      event.preventDefault();
      form.submit();
    });

    $('.dates').datetimepicker({
      locale: 'es',
      format: 'DD-MM-YYYY',
      ignoreReadonly:true
    }).
    on('dp.change', function(ev){
        $('#addEvent').formValidation('revalidateField', 'dates');
    });

    $('body').on('keypress blur', '.nsp', function(event) {
      ele     = $(this);
      var nv  = ''
      nv = v.upperCase(ele.val());
      nv = v.replace(nv, ' ', '');
      nv = v.trim(nv);
      ele.val(nv);
    }); 

  });

  $('#m-h').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    modal.find('.modal-title').text(button.attr('data-title'));
    modal.find('.modal-body').html('<div class="pull-center"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></div>');
    modal.find('.modal-footer').removeClass('invisible');
    modal.find('.modal-footer button.cancel > div').html(button.attr('data-cancel'));
    modal.find('.modal-footer button.accept > div').html(button.attr('data-accept'));
    modal.find('.modal-footer button.accept').removeAttr('id');
    modal.find('.modal-footer button.accept').attr('id', button.attr('data-id'));
    modal.find('.modal-body').load(button.attr('data-src'),{},
        function(){
        }
    );
  });

  $('#tblhotel').bootstrapTable({
      onLoadSuccess: function (data) {
          //$(".asg").attr('data-toggle', 'confirmation');
      },
      onAll: function() {
        $('[data-toggle="tooltip"]').tooltip();
      }
  });

  

  function formatImg(value,row,index){
    var img = row.fotoHotel;
    var cve = $("#tblhotel").attr('data-cve');
    var src = $("#tblhotel").attr('data-src-image');
    var assets = $("#tblhotel").attr('data-assets');
    return '<a class="o-container" data-fancybox="images" href="' + assets + '/files/reservas/hoteles/' + cve + '/' + img + '"><img src="' + src + '/150x0/' + cve + '/' + img + '" class="o-image"><div class="o-middle"><div class="o-text"><i class="material-icons md-24">zoom_in</i></div></div></a>'
  } 

  function formatTools(value,row,index){
    return  '<button class="btn btn-xs btn-outline light-blue-900 text-white" data-id="' + row.idHotel + '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="material-icons">edit</i></button>\n'+
            '<button class="btn btn-xs btn-outline red-800 text-white" data-toggle="tooltip" data-placement="top" title="Habitaciones"><i class="material-icons">local_convenience_store</i></button>';
  }  