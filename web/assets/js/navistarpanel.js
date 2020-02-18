$(document).ready(function() {
  $('#tableReg').bootstrapTable({
    //url:        '/registros',
    classes: 		"table table-hover table-striped table-sm table-bordered",
    locale: 		"es-MX",
    pagination: true,
    search:     true,
    showExport: true,
    filterControl: true,
    exportTypes: ['csv','excel'],
    exportDataType: 'all',
    detailFormatter: detailFormatter,
    columns: [
        {
          field: 'id_registro',
          title: 'ID',
          sortable: true,
          align: 'center',
          valign: 'middle',
          width: 60
        }, 
        {
          field: 'nombre',
          title: 'Nombre',
          sortable: true,
          align: 'center',
          valign: 'middle'      
        },
        {
          field: 'correo',
          title: 'Correo',
          sortable: true,
          align: 'center',
          valign: 'middle'      
        },    
        {
          field: 'celular',
          title: 'Teléfono',
          sortable: true,
          align: 'center',
          valign: 'middle'      
        },
        {
          field: 'empresa',
          title: 'Empresa',
          sortable: true,
          align: 'center',
          valign: 'middle'      
        },
        {
          field: 'distribuidor',
          title: 'Distribuidor',
          sortable: true,
          align: 'center',
          valign: 'middle'      
        },
        {
          field: 'transporte',
          title: 'Transporte',
          sortable: true,
          align: 'center',
          valign: 'middle'      
        }               
      ]
    })

    function detailFormatter(index, row) {
      console.log(row);
      var html    = []
      var trans   = {};
      var tkey    = '';
      var tvalue  = '';
      trans['id_registro']          = 'ID';
      trans['nombre']               = 'Nombre';
      trans['correo']               = 'Correo';
      trans['celular']              = 'Teléfono';
      trans['empresa']              = 'Empresa';
      trans['distribuidor']         = 'Distribuidor';
      trans['transporte']           = 'Transporte';
      trans['aerolineal']           = 'Aerolínea de llegada';
      trans['nveulol']              = 'No. vuelo de llegada';
      trans['fecha_hora_vuelol']    = 'Fecha/ hora vuelo de llegada';
      trans['aerolineas']           = 'Aerolínea de salida';
      trans['nvuelos']              = 'No. vuelo de salida';
      trans['fecha_hora_vuelos']    = 'Fecha/ hora vuelo de salida';
      trans['habitacion']           = 'Habitación';
      trans['camas']                = 'Camas';
      trans['noches']               = 'Noches';
      trans['nochesa']              = 'Noches adicionales';
      trans['tipo']                 = 'Tipo';
      trans['njcamisa']             = 'Camisa No jugador';
      trans['handicap']             = 'Handicap';
      trans['equipo']               = 'Renta de equipo';
      trans['guante']               = 'Guante';
      trans['gtalla']               = 'Talla de guante';
      trans['jcamisa']              = 'Camisa jugador';
      trans['alergia']              = 'Alergias';
      trans['respaciales']          = 'Requerimientos especiales';
      trans['comentarios']          = 'Comentarios';
      trans['rsocial']              = 'Razón social';
      trans['rfc']                  = 'RFC';
      trans['fcorreo']              = 'Correo de facturación';
      trans['ftelefono']            = 'Teléfono de facturación';
      trans['fdireccion']           = 'Dirección de facturación';
      
      akey = $.map(trans, function(element,index) {return index})      
      console.log(akey);
      $.each(row, function (key, value) {
        if($.inArray( key, akey ) !== -1 ){
          tkey    = (trans[key] == undefined) ? key : trans[key];
          tvalue  = (value == null) ? '' : value;
          tvalue  = (value == 'NULL') ? '' : value;
          html.push('<p><b>' + tkey + ':</b> ' + tvalue + '</p>')
        }
      })
      return html.join('')
    }     
});  