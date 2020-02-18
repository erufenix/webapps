<?php
namespace Controller\operaciones;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;
use Lib\Functions\ppPlus;

use Exporter\Handler;
use Exporter\Writer\CsvWriter;
use Exporter\Writer\XmlExcelWriter;
use Exporter\Writer\XlsWriter;

class michelin19Controller implements ControllerProviderInterface {
    private $model  =   null;

  public function connect(Application $app) {
    $index = $app['controllers_factory'];
    $index->get('/{tipo}','Controller\operaciones\michelin19Controller::index')
      ->bind('michelin19.index')
      ->assert('tipo', '\w+')
      ->value('tipo', 'staff');
    $index->get('/{tipo}/registro/','Controller\operaciones\michelin19Controller::registro')
      ->bind('michelin19.registro')
      ->assert('tipo', '\w+')
      ->value('tipo', 'staff');
    $index->post('/valida','Controller\operaciones\michelin19Controller::valida')->bind('michelin19.valida');
    $index->post('/setregistro','Controller\operaciones\michelin19Controller::setRegistro')->bind('michelin19.setRegistro');
    $index->get('/{tipo}/sede','Controller\operaciones\michelin19Controller::sede')
      ->assert('tipo', '\w+')
      ->value('tipo', 'staff')
      ->bind('michelin19.sede');
    $index->get('/{tipo}/agenda/','Controller\operaciones\michelin19Controller::agenda')
      ->assert('tipo', '\w+')
      ->value('tipo', 'staff')
      ->bind('michelin19.agenda');
    $index->get('/{tipo}/contacto/','Controller\operaciones\michelin19Controller::contacto')
      ->assert('tipo', '\w+')
      ->value('tipo', 'staff')
      ->bind('michelin19.contacto');
    $index->get('/{tipo}/vuelos/','Controller\operaciones\michelin19Controller::vuelos')
      ->assert('tipo', '\w+')
      ->value('tipo', 'staff')
      ->bind('michelin19.vuelos');
    $index->get('/{tipo}/pago/','Controller\operaciones\michelin19Controller::pago')
      ->assert('tipo', '\w+')
      ->value('tipo', 'staff')
      ->bind('michelin19.pago');

    $index->get('/{tipo}/reporte/','Controller\operaciones\michelin19Controller::reporteMi')
      ->assert('tipo', '\w+')
      ->value('tipo', 'staff')
      ->bind('michelin19.reporteMi');
      
    $index->get('/{tipo}/reporteT/','Controller\operaciones\michelin19Controller::reporteMiTaller')
      ->assert('tipo', '\w+')
      ->value('tipo', 'staff')
      ->bind('michelin19.reporteMiT');

    $index->get('/{tipo}/reporteTaco/','Controller\operaciones\michelin19Controller::reporteMiTallerAco')
      ->assert('tipo', '\w+')
      ->value('tipo', 'staff')
      ->bind('michelin19.reporteMiTaco');      

    $index->post('/tvalida','Controller\operaciones\michelin19Controller::tvalida')->bind('michelin19.tvalida');
    $index->post('/sendContacto','Controller\operaciones\michelin19Controller::sendContacto')->bind('michelin19.sendContacto');
    $index->get('/reporte','Controller\operaciones\michelin19Controller::reporte')->bind('michelin19.reporte');
    $index->get('/reporte2','Controller\operaciones\michelin19Controller::reporte2')->bind('michelin19.reporte2');
    $index->get('/checkout','Controller\operaciones\michelin19Controller::checkout')->bind('michelin19.checkout');
    $index->get('/execute','Controller\operaciones\michelin19Controller::execute')->bind('michelin19.execute');
    $index->post('/pagoCompleto','Controller\operaciones\michelin19Controller::payComplete')->bind('michelin19.payComplete');
    $index->get('/payCancel','Controller\operaciones\michelin19Controller::payCancel')->bind('michelin19.payCancel');
    return $index;
  }

  public function index(Request $request, Application $app,$tipo) {
    $page = "index.twig";
    return $app['twig']->render("pages/michelin19/$page", array(
          'title' => 'inicio',
          'tipo'  => $tipo
    ));
  }

  public function registro(Request $request, Application $app,$tipo) {
    $page = $tipo. "_registro.twig";
    return $app['twig']->render("pages/michelin19/$page", array(
          'title'     => ($tipo == 'staff') ? 'registro staff' : 'registro distribuidores',
          'tipo'      => $tipo,
          'talleresM' => $this->getTalleres($app,'m'),
          'talleresT' => $this->getTalleres($app,'t')
    ));
  }

  public function valida(Request $request, Application $app){
    $model  = $app["michelin19Model"];
    $clave  = $model->getClave($request->request);
    return $app->json($clave);
  }

  public function tvalida(Request $request, Application $app){
    return true;
  }

  public function setRegistro(Request $request, Application $app) {
    $model          =   $app["michelin19Model"];
    $data           = array();
    $fn             = new Functions;
    $now            = new \DateTime('now');
    $llegadaFecha_  = $request->request->get('llegada_fecha') ." ". $request->request->get('llegada_hora').":00";
    $salidaFecha_   = $request->request->get('salida_fecha') ." ". $request->request->get('salida_hora').":00";
    $request->request->set('fecha_hora_vuelol',$fn->d2b($llegadaFecha_,true));
    $request->request->set('fecha_hora_vuelos',$fn->d2b($salidaFecha_,true));
    $request->request->set('fecha_registro',$now);
    $json       = array(
      'status' => false,
      'msg'   => '',
      'data'  => null,
      'rq'        => null
    );
    $tsm    = array();
    $stm    = $request->request->get('stm');
    $tst    = array();
    $stt    = $request->request->get('stt');
    $atsm    = array();
    $astm    = $request->request->get('astm');
    $atst    = array();
    $astt    = $request->request->get('astt');    
    $tpo    = $request->request->get('tipo');
    $staff  = ($tpo == 'staff') ? true : false;
    if(!empty($request->request->get('tm'))){
      foreach ($request->request->get('tm') as $km => $vm) {
        //$tsm[] = $vm ." - " .$stm[$km];
        $ar     = explode("|", $stm[$km]);
        $tsm[]  = $vm ." - " . $ar[1];
        $id     = $ar[0];
        $up     = $model->upTaller($id,$staff);
      }
    }

    if(!empty($request->request->get('tt'))){
      foreach ($request->request->get('tt') as $km => $vm) {
        //$tst[] = $vm ." - " .$stt[$km];
        $ar     = explode("|", $stt[$km]);
        $tst[]  = $vm ." - " . $ar[1];
        $id     = $ar[0];
        $up     = $model->upTaller($id,$staff);
      }
    }

    if(!empty($request->request->get('atm'))){
      foreach ($request->request->get('atm') as $km => $vm) {
        //$tsm[] = $vm ." - " .$stm[$km];
        $ar     = explode("|", $astm[$km]);
        $atsm[]  = $vm ." - " . $ar[1];
        $id     = $ar[0];
        $up     = $model->upTaller($id,$staff);
      }
    }

    if(!empty($request->request->get('att'))){
      foreach ($request->request->get('att') as $km => $vm) {
        //$tst[] = $vm ." - " .$stt[$km];
        $ar     = explode("|", $astt[$km]);
        $atst[]  = $vm ." - " . $ar[1];
        $id     = $ar[0];
        $up     = $model->upTaller($id,$staff);
      }
    }    

    $talleresM = implode("\n",$tsm);
    $talleresT = implode("\n",$tst);
    $request->request->set('talleres',$talleresM . "\n\n" . $talleresT);
    $atalleresM = implode("\n",$atsm);
    $atalleresT = implode("\n",$atst);
    $request->request->set('talleres_aco',$atalleresM . "\n\n" . $atalleresT);


    $reg    = $model->setRegistro($request->request);
    $data = $app["serializer"]->toArray($reg);
    if(!empty($data)){
      $mail   = \Swift_Message::newInstance();
      $mail
        ->setTo($request->request->get('correo'),$request->request->get('nombre'))
        ->setBcc(array(
                "erubi@tycgroup.com" => "Edgar Rubi",
                "gterreros@tycgroup.com" => "Gerardo Terreros"
        ))
        ->setFrom('no--reply@sin-tcevents.mx','Registro')
        ->setSubject('Michelin Simposio Alliance 2019');
        $body = $app['twig']->render('pages/michelin19/rmail.twig', array(
            "data"      => $data,
            "talleres"  => $request->request->get('talleres')
        )
      );
      $mail->setBody($body, "text/html");
      $env = $app['mailer']->send($mail);
      if($request->request->get('regDoble') == true){
        $regCve = $model->getRegCve($request->request->get('idClave'));
        if(count($regCve) > 1){
          $blk = $model->blkCve($data['id_clave']);
        }
      }
      else{
        $blk = $model->blkCve($data['id_clave']);
      }
      $json       = array(
        'status' => true,
        'msg'   => '',
        'data'  => $data,
        'rq'        => $request->request->all()
      );
    }
    return $app->json($json);
  }

  public function sede(Request $request, Application $app,$tipo) {
    return $app['twig']->render('pages/michelin19/sede.twig', array(
          'title' => 'sede',
          'tipo'  => $tipo
    ));
  }

  public function agenda(Request $request, Application $app,$tipo) {
    //$page = $tipo. "_agenda.twig";
    $page = "agenda.twig";
    return $app['twig']->render("pages/michelin19/$page", array(
      'title' => 'Agenda',
      'tipo'  => $tipo
    ));
  }

  public function contacto(Request $request, Application $app,$tipo) {
    return $app['twig']->render('pages/michelin19/contacto.twig', array(
      'title' => 'contacto',
      'tipo'  => $tipo
    ));
  }

  public function vuelos(Request $request, Application $app,$tipo) {
    return $app['twig']->render('pages/michelin19/vuelos.twig', array(
      'title' => 'Clave Promocional Aeromexico',
      'tipo'  => $tipo
    ));
  }

  public function pago(Request $request, Application $app,$tipo) {
    return $app['twig']->render('pages/michelin19/pago.twig', array(
      'title' => 'Pago',
      'tipo'  => $tipo
    ));
  }

  public function reporteMiTaller(Request $request, Application $app,$tipo) {
    $model    = $app["michelin19Model"];
    $reg      = $model->getAll($tipo);
    $records  = $app["serializer"]->toArray($reg);
    $data     = array();
    $fn       = new Functions;
    $format   = !empty($request->query->get('format')) ? $request->query->get('format') : 'xls';
    $atll     = array();
    $vfileds = array(
      'id_registro'     => 'ID',
      'nombre'          => 'Nombre',
      'apellidos'       => 'Apellidos',
      'correo'          => 'Correo',
      'celular'         => 'Celular',
      'contacto'        => 'Contacto',
      'distribuidor'    => 'Distribuidor',
      'acoNombre'       => 'Acompañante',
      'habitacion'      => 'Habitación',
      'ncamas'          => 'No. de camas',
      'transporte'      => 'Transporte',
      'aerolineal'      => 'Aerolínea de llegada',
      'nveulol'         => 'No. vuelo llegada',
      'fechaHoraVuelol' => 'Fecha/Hora vuelo llegada',
      'aerolineas'      => 'Aerolínea de salida',
      'nveulos'         => 'No. vuelo salida',
      'fechaHoraVuelos' => 'Fecha/Hora vuelo salida',
      'fechaRegistro'   => 'Fecha de registro',
      'tipo'            => 'Tipo',
      'talleres'        => 'Talleres',
      'talleresAco'     => 'Talleres acompañante',
      'comentarios'     => 'Comentarios'
    );
    $isDate = array('reg_fechaHoraVuelol','reg_fechaHoraVuelos','reg_fechaRegistro');
    $isName = array('reg_nombre');
    foreach ($records as $kr => $vr) {
      foreach ( $vfileds as $kf => $vf) {
        $fkey = "reg_" . $kf;
        if(in_array($fkey,$isName)){
            $vns = explode(" ",$vr[$fkey]);         
            $vr['reg_nombre'] = $vns[0];
            $vr['reg_apellidos'] = implode(" ",array_slice($vns,1)); 
        }          
        if(array_key_exists($fkey, $vr)){
          if(in_array($fkey,$isDate)){
            $vn = $fn->d2h($vr[$fkey],true);
          }
          else{
            $vn = $vr[$fkey];
          }
          $data[$kr][$vfileds[$kf]] = $vn;
        }
      }
    }

    foreach ($data as $kd => $vd) {
      foreach ($vd as $kv => $vv) {
        if($kv == 'Talleres'){
          $nt   = explode("\n",$vv);
          $taller = '';
          $hora   = '';
          $bht    = array();
          foreach ($nt as $kn) {
            $sepH = explode(" - ",$kn);
            if(count($sepH) != 0 && !empty($sepH[0])){
              $taller = $sepH[0];
              $hora   = $sepH[1] ." - ". $sepH[2] ;
            }
            $atll[$hora][] = array(
              'Hora'    => $hora,
              'Taller'  => $taller,
              'Nombre'  => $vd['Nombre'],
              'Apellidos' => $vd['Apellidos'],
              'Correo'  => $vd['Correo'],
              'Celular' => $vd['Celular']
            );
          }
        }
      }
    }
    ksort($atll);
    $_atll = array();
    foreach ($atll as $kth => $vth) {
      $_atll = array_merge($_atll,$atll[$kth]);
    }
    switch ($format) {
      case 'csv':
        $exporter_writer  = new CsvWriter('php://output',',','"','\\',true,true,"\n");
        $content_type     = "text/csv;charset=utf-8";
      break;
      case 'xls':
        $exporter_writer = new XlsWriter('php://output');
        $content_type     = "application/vnd.ms-excel";
      break;
      case 'xlsx':

        $exporter_writer  = new XmlExcelWriter('php://output');
        $content_type     = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
      break;
      default:
        # code...
        break;
    }
    $filename = 'Simposio_Alliance_2019_talleres';
    $exporter_source = new \Exporter\Source\ArraySourceIterator($_atll);
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Description: File Transfer');
    header('Content-type: ' . $content_type);
    header('Content-Disposition: attachment; filename=' . $filename . '.'.$format.';');
    header('Expires: 0');
    header('Pragma: public');
    ob_end_clean();

    \Exporter\Handler::create($exporter_source, $exporter_writer)->export();
    exit;
  }

  public function reporteMiTallerAco(Request $request, Application $app,$tipo) {
    $model    = $app["michelin19Model"];
    $reg      = $model->getAll($tipo);
    $records  = $app["serializer"]->toArray($reg);
    $data     = array();
    $fn       = new Functions;
    $format   = !empty($request->query->get('format')) ? $request->query->get('format') : 'xls';
    $atll     = array();
    $vfileds = array(
      'id_registro'     => 'ID',
      'nombre'          => 'Nombre',
      'correo'          => 'Correo',
      'celular'         => 'Celular',
      'contacto'        => 'Contacto',
      'distribuidor'    => 'Distribuidor',
      'acoNombre'       => 'Acompañante',
      'habitacion'      => 'Habitación',
      'ncamas'          => 'No. de camas',
      'transporte'      => 'Transporte',
      'aerolineal'      => 'Aerolínea de llegada',
      'nveulol'         => 'No. vuelo llegada',
      'fechaHoraVuelol' => 'Fecha/Hora vuelo llegada',
      'aerolineas'      => 'Aerolínea de salida',
      'nveulos'         => 'No. vuelo salida',
      'fechaHoraVuelos' => 'Fecha/Hora vuelo salida',
      'fechaRegistro'   => 'Fecha de registro',
      'tipo'            => 'Tipo',
      'talleres'        => 'Talleres',
      'talleresAco'     => 'Talleres acompañante',
      'comentarios'     => 'Comentarios'
    );
    $isDate = array('reg_fechaHoraVuelol','reg_fechaHoraVuelos','reg_fechaRegistro');
    foreach ($records as $kr => $vr) {
      foreach ( $vfileds as $kf => $vf) {
        $fkey = "reg_" . $kf;
        if(array_key_exists($fkey, $vr)){
          if(in_array($fkey,$isDate)){
            $vn = $fn->d2h($vr[$fkey],true);
          }
          else{
            $vn = $vr[$fkey];
          }
          $data[$kr][$vfileds[$kf]] = $vn;
        }
      }
    }

    foreach ($data as $kd => $vd) {
      foreach ($vd as $kv => $vv) {
        if($kv == 'Talleres acompañante'){

          if(ord($vv) != 45 && ord($vv) != 10){
            $nt   = explode("\n",$vv);
            $taller = '';
            $hora   = '';
            $bht    = array();
            foreach ($nt as $kn) {
              $sepH = explode(" - ",$kn);
              if(count($sepH) != 0 && !empty($sepH[0])){
                $taller = $sepH[0];
                $hora   = $sepH[1] ." - ". $sepH[2] ;
              }
              $atll[$hora][] = array(
                'Hora'                => $hora,
                'Taller'              => $taller,
                'Nombre Acompañante'  => $vd['Acompañante'],
                'Nombre (titular)'    => $vd['Nombre'],
                'Correo (titular)'    => $vd['Correo'],
                'Celular(titular)'    => $vd['Celular']
              );
            }
          }
        }
      }
    }
    ksort($atll);
    $_atll = array();
    foreach ($atll as $kth => $vth) {
      $_atll = array_merge($_atll,$atll[$kth]);
    }
    switch ($format) {
      case 'csv':
        $exporter_writer  = new CsvWriter('php://output',',','"','\\',true,true,"\n");
        $content_type     = "text/csv;charset=utf-8";
      break;
      case 'xls':
        $exporter_writer = new XlsWriter('php://output');
        $content_type     = "application/vnd.ms-excel";
      break;
      case 'xlsx':

        $exporter_writer  = new XmlExcelWriter('php://output');
        $content_type     = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
      break;
      default:
        # code...
        break;
    }
    $filename = 'Simposio_Alliance_2019_talleres_acom';
    $exporter_source = new \Exporter\Source\ArraySourceIterator($_atll);
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Description: File Transfer');
    header('Content-type: ' . $content_type);
    header('Content-Disposition: attachment; filename=' . $filename . '.'.$format.';');
    header('Expires: 0');
    header('Pragma: public');
    ob_end_clean();

    \Exporter\Handler::create($exporter_source, $exporter_writer)->export();
    exit;
  }

  public function reporteMi(Request $request, Application $app,$tipo) {
    $model    = $app["michelin19Model"];
    $reg      = $model->getAll($tipo);
    $records  = $app["serializer"]->toArray($reg);
    $data     = array();
    $fn       = new Functions;
    $format   = !empty($request->query->get('format')) ? $request->query->get('format') : 'xls';
    $vfileds = array(
      'id_registro'       => 'ID',
      'nombre'            => 'Nombre',
      'apellidos'         => 'Apellidos',
      'correo'            => 'Correo',
      'celular'           => 'Celular',
      'contacto'          => 'Contacto',
      'distribuidor'      => 'Distribuidor',
      'acoNombre'         => 'Acompañante',
      'habitacion'        => 'Habitación',
      'ncamas'            => 'No. de camas',
      'transporte'        => 'Transporte',
      'aerolineal'        => 'Aerolínea de llegada',
      'nveulol'           => 'No. vuelo llegada',
      'fechaHoraVuelol'   => 'Fecha/Hora vuelo llegada',
      'aerolineas'        => 'Aerolínea de salida',
      'nveulos'           => 'No. vuelo salida',
      'fechaHoraVuelos'   => 'Fecha/Hora vuelo salida',
      'fechaRegistro'     => 'Fecha de registro',
      'tipo'              => 'Tipo',
      'talleres'          => 'Talleres',
      'talleresAco'       => 'Talleres acompañante',
      'comentarios'       => 'Comentarios'
    );

    $isDate = array('reg_fechaHoraVuelol','reg_fechaHoraVuelos','reg_fechaRegistro');
    $isSep = array('reg_talleres','reg_talleresAco');
    $sep = '|';
    $isName = array('reg_nombre');
    foreach ($records as $kr => $vr) {
      foreach ( $vfileds as $kf => $vf) {
        $fkey = "reg_" . $kf;
        if(array_key_exists($fkey, $vr)){
            
          if(in_array($fkey,$isName)){
            $vns = explode(" ",$vr[$fkey]);         
            $vr['reg_nombre'] = $vns[0];
            $vr['reg_apellidos'] = implode(" ",array_slice($vns,1)); 
          }            
            
          if(in_array($fkey,$isDate)){
            $vn = $fn->d2h($vr[$fkey],true);
          }
          else{
            $vn = $vr[$fkey];
          }
          
          if(in_array($fkey,$isSep)){
            $vn = str_replace("\n", " |\n",$vr[$fkey]);
            //$vn = str_replace("||", "|",$vr[$fkey]);
          }
          else{
            $vn = $vr[$fkey];
          }           
          
          $vn = is_null($vn) ? '_' : $vn;
          $data[$kr][$vfileds[$kf]] = $vn;
        }
      }
    }

    switch ($format) {
      case 'csv':
        $exporter_writer  = new CsvWriter('php://output',',','"','\\',true,true,"\n");
        $content_type     = "text/csv;charset=utf-8";
      break;
      case 'xls':
        $exporter_writer = new XlsWriter('php://output');
        $content_type     = "application/vnd.ms-excel";
      break;
      case 'xlsx':

        $exporter_writer  = new XmlExcelWriter('php://output');
        $content_type     = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
      break;
      default:
        # code...
        break;
    }
    $filename = 'Simposio_Alliance_2019';
    $exporter_source = new \Exporter\Source\ArraySourceIterator($data);
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Description: File Transfer');
    header('Content-type: ' . $content_type);
    header('Content-Disposition: attachment; filename=' . $filename . '.'.$format.';');
    header('Expires: 0');
    header('Pragma: public');
    ob_end_clean();

    \Exporter\Handler::create($exporter_source, $exporter_writer)->export();
    exit;
  }

  public function sendContacto(Request $request, Application $app) {
    $json       = array(
      'status' => false,
      'msg'   => '',
      'data'  => null
    );
    $mail = \Swift_Message::newInstance();
    $mail
      ->setTo('gterreros@tycgroup.com','Gerardo Terreros')
      ->setReplyTo($request->request->get('correo'),$request->request->get('nombre'))
      ->setBcc(array(
          "erubi@tycgroup.com" => "Edgar Rubi*"
      ))
      ->setFrom('no--reply@sin-tcevents.mx','Contacto')
      ->setSubject('Contacto Michelin Simposio Alliance 2019');
    $body = $app['twig']->render('pages/michelin19/mailContact.twig', array(
        "data"  => $request->request
      )
    );

    $mail->setBody($body, "text/html");
    $env = $app['mailer']->send($mail);
    $json       = array(
      'status'    => true,
      'msg'       => ''
    );
    return $app->json($json);
  }

  public function reporte(Request $request, Application $app) {
  $model    = $app["michelin19Model"];
  $reg      = $model->getAll();
  $records  = $app["serializer"]->toArray($reg);
  $vfields  = array(
    'id_registro'         => 'ID',
    'nombre'              => 'Nombre',
    'apellidos'           => 'Apellidos',
    'correo'              => 'Correo',
    'telefono'            => 'Teléfono',
    'distribuidor'        => 'Distribuidor',
    'puesto'              => 'Puesto',
    'factura_rs'          => 'Factura Razón Social',
    'factura_rfc'         => 'Factura RFC',
    'factura_correo'      => 'Factura correo',
    'factura_direccion'   => 'Factura dirección',
    'factura_pago'        => 'Factura pago',
    'llegada_nvuelo'      => 'Llegada No. de vuelo',
    'llegada_aerolinea'   => 'Llegada aerolínea',
    'llegada_fecha'       => 'Llegada fecha',
    'salida_nvuelo'       => 'Salida No. de vuelo',
    'salida_aerolinea'    => 'Salida aerolínea',
    'salida_fecha'        => 'Salida fecha',
    'habitacion'          => 'Habitación',
    'fecha_registro'      => 'Fecha de registro',
    'tx'                  => 'TX',
    'tot'                 => 'Total'
  );
  $fp     = fopen( 'php://temp/maxmemory:'. (12*1024*1024) , 'r+' );
  $fn     = new Functions;
  $isDate = array('llegada_fecha','salida_fecha','fecha_registro');
  $isTime = array();
  $fields = array();
  $ignore = array('tx','tot');
  $keys   = array();
  $r_ = array();
  foreach ($vfields as $kf => $vf) {
    //$vf = mb_convert_encoding($vf, 'UTF-16LE', 'UTF-8');
    array_push($fields,$vf);
    array_push($keys,$kf);
  }
  fputcsv( $fp, $fields );
  foreach ($records as $kr => $vr) {
    foreach ($vr as $kv => $vv) {
      if(in_array($kv,$keys)){
        //$vv = utf8_encode($vv);
        $vv = is_null($vv) ? '' : $vv;
        if(in_array($kv,$isDate) && !empty($vv)){

          $vv = $fn->d2h($vv,true);
        }
        if(in_array($kv,$isTime) && !empty($vv)){
          $vv = $fn->d2h($vv,true);
        }
        array_push($r_,$vv);
      }
    }
    fputcsv( $fp, $r_);
    $r_ = array();
  }
  rewind( $fp );
  $output = stream_get_contents( $fp );
  fclose( $fp );
  header('Content-Type: text/csv; charset=utf-8');
  //header("Content-Type: application/octet-stream");
  header('Content-Disposition: attachment; filename=KICK19regs.csv' );

  header('Content-Length: '. strlen($output) );
  echo $output;
  exit;
  }

  public function reporte2(Request $request, Application $app) {
    $model    = $app["michelin19Model"];
    $reg      = $model->getAll();
    $records  = $app["serializer"]->toArray($reg);
    $vfields  = array(
          'id_registro'       => 'ID',
          'nombre'            => 'Nombre',
          'apellidos'         => 'Apellidos',
          'correo'            => 'Correo',
          'telefono'          => 'Teléfono',
          'distribuidor'      => 'Distribuidor',
          'puesto'            => 'Puesto',
          'factura_rs'        => 'Factura Razón Social',
          'factura_rfc'       => 'Factura RFC',
          'factura_correo'    => 'Factura correo',
          'factura_direccion' => 'Factura dirección',
          'factura_pago'      => 'Factura pago',
          'factura_cp'        => 'Factura CP',
          'factura_edo'       => 'Factura estado',
          'factura_ciudad'    => 'Factura ciudad',
          'llegada_nvuelo'    => 'Llegada No. de vuelo',
          'llegada_aerolinea' => 'Llegada aerolínea',
          'llegada_fecha'     => 'Llegada fecha',
          'salida_nvuelo'     => 'Salida No. de vuelo',
          'salida_aerolinea'  => 'Salida aerolínea',
          'salida_fecha'      => 'Salida fecha',
          'habitacion'        => 'Habitación',
          'fecha_registro'    => 'Fecha de registro',
          'tx'                => 'TX',
          'tot'               => 'Total'

     );
    $fn   = new Functions;
    $excel  = $fn->genExcel('KickOf2019','KickOff2019','Registros');
    $ltrnum   = 65;
    $ltrchr   = "";
    $lastchr  = "";
    $lastcell = 0;
    $over = '';
    $cc   = 0;
    $isDate = array('fecha_registro','llegada_fecha','salida_fecha');

    $titles = array(
      'font'    => array(
        'name'   => 'Verdana',
        'bold'   => true,
        'italic' => false,
        'strike' => false,
        'size'   => 16,
        'color'  => array(
          'rgb'   => 'FFFFFF',
          )
        ),
      'fill'   => array(
        'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
          'argb' => 'FF8503')
        ),
      'borders'     => array(
        'allborders' => array(
          'style'     => \PHPExcel_Style_Border::BORDER_NONE
          )
        ),
      'alignment'   => array(
        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => TRUE
        )
      );

    $colums = array(
      'font'   => array(
        'name'  => 'Arial',
        'bold'  => true,
        'color' => array(
          'rgb'  => '000000',
          )
        ),
      'fill'        => array(
        'type'       => \PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation'   => 90,
        'startcolor' => array(
          'rgb'       => 'ffffff',
          ),
        'endcolor' => array(
          'argb'    => 'ffffff',
          )
        ),
      'borders' => array(
        'top'    => array(
          'style' => \PHPExcel_Style_Border::BORDER_MEDIUM,
          'color' => array(
            'rgb'  => '143860',
            )
          ),
        'bottom' => array(
          'style' => \PHPExcel_Style_Border::BORDER_MEDIUM,
          'color' => array(
            'rgb'  => '000000',
            )
          )
        ),
      'alignment'   => array(
        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'       => TRUE
        )
      );

    $values = array(
      'font'   => array(
        'name'  => 'Arial',
        'color' => array(
          'rgb'  => '000000',
          )
        ),
      'fill'   => array(
        'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
          'argb' => 'ffffff')
        ),
      'borders' => array(
        'left'   => array(
          'style' => \PHPExcel_Style_Border::BORDER_THIN,
          'color' => array(
            'rgb'  => '000000',
            )
          )
        )
      );

    foreach ($vfields as $kr => $vr) {
      $ltrchr = chr($ltrnum+$cc);
      $excel->getActiveSheet()->setCellValue($over.$ltrchr.'2', $vr);
      $excel->getActiveSheet()->getColumnDimension($over.$ltrchr)->setAutoSize(TRUE);
      $excel->getActiveSheet()->getStyle($over.$ltrchr.'2')->applyFromArray($colums);
      //echo "$over$ltrchr 2 -> $kr, $cc | <br>";
      $lastchr  = $ltrchr;
      $lastcell = $kr+1;
      $cc++;
      if ($cc > 25) {
        $cc = 0;
      }
      if ($kr >= 25) {
        $over = "A";
      }
    }

    $cr = 3;
    $over = '';
    $cc   = 0;
    $index = 0;

    $excel->getActiveSheet()->setCellValue('A1', 'Kick Off Navistar 2019');
    $excel->getActiveSheet()->mergeCells('A1:'.$over.$lastchr.'1');
    $excel->getActiveSheet()->getStyle('A1:'.$over.$lastchr.'1')->applyFromArray($titles);
    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="michelin19.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');// Date in the past
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');// always modified
    header('Cache-Control: cache, must-revalidate');// HTTP/1.1
    header('Pragma: public');// HTTP/1.0
    $excel = \PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $excel->save('php://output');
    exit;

  }

  private function getTalleres($app,$turno='m'){
    $model  = $app["michelin19Model"];
    $_ta    = array();
    $ta = $model->getTalleres($turno);
    $nk = 0;
    foreach ($ta as $tk => $tv) {
      /*if($nk != $tv['noTaller']){
        $_ta[] = $tv;
      }
      $nk = $tv['noTaller'];*/
      $_ta[$tv['noTaller']][] = $tv;
    }
    return $_ta;
  }

}

?>
