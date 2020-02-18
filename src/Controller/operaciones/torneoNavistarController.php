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

class torneoNavistarController implements ControllerProviderInterface {
  private $model  =   null;

  public function connect(Application $app) {
    $index = $app['controllers_factory'];
    $index->get('/','Controller\operaciones\torneoNavistarController::index')
      ->bind('torneoNavistar.index');
    $index->get('/sede','Controller\operaciones\torneoNavistarController::sede')
      ->bind('torneoNavistar.sede');  
    $index->get('/registro/','Controller\operaciones\torneoNavistarController::registro')
      ->bind('torneoNavistar.registro');
    $index->post('/setregistro','Controller\operaciones\torneoNavistarController::setRegistro')->bind('torneoNavistar.setRegistro');
    $index->get('/reporte','Controller\operaciones\torneoNavistarController::reporte')
      ->bind('torneoNavistar.reporte');
    $index->get('/panel/','Controller\operaciones\torneoNavistarController::panel')
      ->bind('torneoNavistar.panel');
    $index->get('/panel/registros/','Controller\operaciones\torneoNavistarController::getRegistros')
      ->bind('torneoNavistar.panelRegistros');
    $index->get('/panel/login','Controller\operaciones\torneoNavistarController::login')
      ->bind('torneoNavistar.login');                 
    return $index;
  }

  public function index(Request $request, Application $app,$tipo) {
    return $app['twig']->render("pages/torneoNavistar/index.twig", array(
          'title' => 'Inicio'
    ));
  }

  public function sede(Request $request, Application $app,$tipo) {
    return $app['twig']->render("pages/torneoNavistar/sede.twig", array(
          'title' => 'Sede'
    ));
  }  

  public function registro(Request $request, Application $app,$tipo) {
    return $app['twig']->render("pages/torneoNavistar/registro.twig", array(
          'title' => 'Registro'
    ));
  }

  public function setRegistro(Request $request, Application $app,$tipo) {
    $model          =   $app["torneoNavistarModel"];
    $data           = array();
    $fn             = new Functions;
    $now            = new \DateTime('now');
    $llegadaFecha_  = $request->request->get('fechal') ." ". $request->request->get('horal').":00";
    $salidaFecha_   = $request->request->get('fechas') ." ". $request->request->get('horas').":00";
    $request->request->set('fecha_hora_vuelol',$fn->d2b($llegadaFecha_,true));
    $request->request->set('fecha_hora_vuelos',$fn->d2b($salidaFecha_,true));
    $request->request->set('fecha_registro',$now);
    $json       = array(
      'status' => false,
      'msg'   => '',
      'data'  => null,
      'rq'        => null
    );
    $reg    = $model->setRegistro($request->request);
    $data = $app["serializer"]->toArray($reg);
    if(!empty($data)){
      $mail   = \Swift_Message::newInstance();
      $mail
        ->setTo($request->request->get('correo'),$request->request->get('nombre'))
        ->setBcc(array(
                "erubi@tycgroup.com" => "Edgar Rubi",
                //"gterreros@tycgroup.com" => "Gerardo Terreros"
        ))
        ->setFrom('no--reply@sin-tcevents.mx','Registro')
        ->setSubject('5º Torneo de Golf NAVISTAR');
        $body = $app['twig']->render('pages/torneoNavistar/rmail.twig', array(
            "data"      => $data
        )
      );
      $mail->setBody($body, "text/html");
      $env = $app['mailer']->send($mail);      
      $json       = array(
        'status'  => true,
        'msg'     => '',
        'data'    => $data,
        'rq'      => $request->request->all()
      );      
    }      
    return $app->json($json);
  }
  
  public function reporte(Request $request, Application $app,$tipo) {
    $model    = $app["torneoNavistarModel"];
    $reg      = $model->getAll();
    $records  = $app["serializer"]->toArray($reg);
    $data     = array();
    $fn       = new Functions;
    $format   = !empty($request->query->get('format')) ? $request->query->get('format') : 'xls';    
    $vfileds = array(
      'id_registro'       => 'ID',
      'nombre'            => 'Nombre',
      'correo'            => 'Correo',
      'celular'           => 'Teléfono',
      'empresa'           => 'Empresa',
      'distribuidor'      => 'Distribuidor',
      'transporte'        => 'Transporte',
      'aerolineal'        => 'Aerolínea de llegada',
      'nveulol'           => 'No. vuelo llegada',
      'fecha_hora_vuelol' => 'Fecha/Hora vuelo llegada',
      'aerolineas'        => 'Aerolínea de salida',
      'nveulos'           => 'No. vuelo salida',
      'fecha_hora_vuelos' => 'Fecha/Hora vuelo salida',      
      'habitacion'        => 'Habitación',
      'noches'            => 'Noches',
      'nochesa'           => 'Noches adicionales',
      'ncamas'            => 'No. de camas',
      'tipo'              => 'Tipo',      
      'fecha_registro'    => 'Fecha de registro',
      'rsocial'           => 'Razón social',
      'rfc'               => 'RFC',
      'fcorreo'           => 'Correo de facturación',
      'ftelefono'         => 'Teléfono de facturación',
      'fdireccion'        => 'Direccion de facturación',
      'tipo'              => 'Tipo',
      'njcamisa'          => 'Camisa (no jugador)',
      'handicap'          => 'Handicap',
      'equipo'            => 'Renta de equipo',
      'guante'            => 'Guante',
      'gtalla'            => 'Talla de guante',
      'jcamisa'           => 'Camisa (jugador)',
      'alergias'          => 'Alergias',
      'respeciales'       => 'Requerimientos especiales',
      'comentarios'       => 'Comentarios',

    );
    $isDate = array('fecha_hora_vuelol','fecha_hora_vuelos','fecha_registro');
    $isVuelo = array('fecha_hora_vuelol','fecha_hora_vuelos','fecha_registro');
    foreach ($records as $kr => $vr) {
      foreach ( $vfileds as $kf => $vf) {
        $fkey = "" . $kf;
        if(array_key_exists($fkey, $vr)){
                    
          if(in_array($fkey,$isDate)){
            $vn = $fn->d2h($vr[$fkey],true);
            
          }
          else{
            $vn = $vr[$fkey];
          }

          /*if(in_array($fkey,$isVuelo)){
            $vn = ($vn == '31-12-1969 18:00') ? '' : $vn;
          }
          else{
            $vn = $vr[$fkey];
          }          */


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
    $filename = 'TorneoNavistar';
    $exporter_source = new \Exporter\Source\ArraySourceIterator($data);
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Description: File Transfer');
    header('Content-type: ' . $content_type);
    header('Content-Disposition: attachment; filename=' . $filename . '.'.$format.';');
    header('Expires: 0');
    header('Pragma: public');
    //ob_end_clean();

    \Exporter\Handler::create($exporter_source, $exporter_writer)->export();
    exit;    
    
  }

  public function panel(Request $request, Application $app) {
    $user = $app["NaviUser"];
    return $app['twig']->render("pages/torneoNavistar/panel/panel.twig", array(
          'title' => 'Panel',
          'user' 	=> $user
    ));
  }

  public function getRegistros(Request $request, Application $app){
    $model    = $app["torneoNavistarModel"];
    $reg      = $model->getAll();
    $records  = $app["serializer"]->toArray($reg);
    return $app->json($records);    
  }

	public function login(Request $request, Application $app) {
		return $app['twig']->render('pages/torneoNavistar/panel/login.twig', array(
			"error" => $app["security.last_error"]($request),
			"last_username" => $app["session"]->get("_security.last_username")
		));
  }  

} 
  ?>