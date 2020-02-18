<?php
namespace Controller\operaciones;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;
use Lib\Functions\ppPlus;

class kickoff19Controller implements ControllerProviderInterface {
	private $model 	=	null;

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		//$this->model =	$app["kickoff19Model"];
		$index->get('/','Controller\operaciones\kickoff19Controller::index')->bind('kickoff19.index');
		$index->get('/registro','Controller\operaciones\kickoff19Controller::registro')->bind('kickoff19.registro');
		$index->post('/setregistro','Controller\operaciones\kickoff19Controller::setRegistro')->bind('kickoff19.setRegistro');
		$index->get('/sede','Controller\operaciones\kickoff19Controller::sede')->bind('kickoff19.sede');
		$index->get('/contacto','Controller\operaciones\kickoff19Controller::contacto')->bind('kickoff19.contacto');
		$index->post('/sendContacto','Controller\operaciones\kickoff19Controller::sendContacto')->bind('kickoff19.sendContacto');
		$index->get('/reporte','Controller\operaciones\kickoff19Controller::reporte')->bind('kickoff19.reporte');
    $index->get('/checkout','Controller\operaciones\kickoff19Controller::checkout')->bind('kickoff19.checkout');
    $index->get('/execute','Controller\operaciones\kickoff19Controller::execute')->bind('kickoff19.execute');
    $index->post('/pagoCompleto','Controller\operaciones\kickoff19Controller::payComplete')->bind('kickoff19.payComplete');
    $index->get('/payCancel','Controller\operaciones\kickoff19Controller::payCancel')->bind('kickoff19.payCancel');
		return $index;
	}

	public function index(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff19/index.twig', array(
			'title' =>'inicio'
		));
	}

	public function registro(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff19/registro.twig', array(
			'title' => 'registro'
		));
	}

	public function setRegistro(Request $request, Application $app) {
		$model 				=	$app["kickoff19Model"];
		$data 				= array();
		$fn 					= new Functions;
		$now   				= new \DateTime('now');
		$llegadaFecha_ = $request->request->get('llegada_fecha') ." ". $request->request->get('llegada_hora').":00";
		$salidaFecha_  = $request->request->get('salida_fecha') ." ". $request->request->get('salida_hora').":00";
		$llegadaFechaAco_ = $request->request->get('llegada_fecha_aco') ." ". $request->request->get('llegada_hora_aco').":00";
		$salidaFechaAco_  = $request->request->get('salida_fecha_aco') ." ". $request->request->get('salida_hora_aco').":00";		
		$request->request->set('llegada_fecha',$fn->d2b($llegadaFecha_,true));
		$request->request->set('salida_fecha',$fn->d2b($salidaFecha_,true));
		$request->request->set('llegada_fecha_aco',$fn->d2b($llegadaFechaAco_,true));
		$request->request->set('salida_fecha_aco',$fn->d2b($salidaFechaAco_,true));		
		$request->request->set('fecha_registro',$now);
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null,
			'rq' 		=> null
		);
		$reg 	= $model->setRegistro($request->request);
		$data = $app["serializer"]->toArray($reg);
		if(!empty($data)){
			$mail 	= \Swift_Message::newInstance();
			$mail
				->setTo($request->request->get('correo'),$request->request->get('nombre'))
				->setBcc(array(
						"erubi@tycgroup.com" => "Edgar Rubi",
						"mflores@tycgroup.com" => "Mónica Flores",
						"marellano@tycgroup.com" => "Mariela Arellano"
				))
				->setFrom('no--reply@sin-tcevents.mx','Registro')
				->setSubject('Registro Kick Off Navistar 2019');
				$body = $app['twig']->render('pages/kickoff19/rmail.twig', array(
					"data"	=> $data
				)
			);
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);
			$json   	= array(
				'status' => true,
				'msg' 	=> '',
				'data' 	=> $data,
				'rq' 		=> $request->request->all()
			);
		}
		return $app->json($json);
	}

	public function valida(Request $request, Application $app){
		$model 	=	$app["kickoff19Model"];
		$clave  = $model->getClave($request->request);
		return $app->json($clave);
	}

	public function sede(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff19/sede.twig', array(
			'title' => 'sede'
		));
	}

	public function contacto(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff19/contacto.twig', array(
			'title' => 'contacto'
		));
	}

	public function sendContacto(Request $request, Application $app) {
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		$mail = \Swift_Message::newInstance();
		$mail
			->setTo('mflores@tycgroup.com','Mónica Flores')
      ->setReplyTo('mflores@tycgroup.com','Mónica Flores')
			->setBcc(array(
        "marellano@tycgroup.com" => "Mariela Arellano",
				"erubi@tycgroup.com" => "Edgar Rubi"
			))
			->setFrom($request->request->get('correo'),$request->request->get('nombre'))
			->setSubject('Contacto Kick Off Navistar 2019');
		$body = $app['twig']->render('pages/kickoff19/mailContact.twig', array(
							"data"	=> $request->request
						)
		);

		$mail->setBody($body, "text/html");
		$env = $app['mailer']->send($mail);
		$json   	= array(
				'status'	=> true,
				'msg' 		=> ''
		);
		return $app->json($json);
	}

	public function agenda(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff19/agenda.twig.html', array(
			'title' => ''
		));
	}

	public function politicas(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff19/politicas.twig.html', array(
			'title' => ''
		));
	}

	public function tarifa(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff19/tarifa.twig.html', array(
			'title' => ''
		));
	}


	public function reporte(Request $request, Application $app) {
    $model    = $app["kickoff19Model"];
    $reg      = $model->getAll();
    $records  = $app["serializer"]->toArray($reg);
    $vfields  = array(
          'id_registro'      	      => 'ID',
          'nombre'  					      => 'Nombre',
          'apellidos'  				      => 'Apellidos',
          'correo'  					      => 'Correo',
          'telefono' 					      => 'Teléfono',
          'distribuidor'			      => 'Distribuidor',
          'puesto' 						      => 'Puesto',
          'factura_rs' 				      => 'Factura Razón Social',
          'factura_rfc' 			      => 'Factura RFC',
          'factura_correo'		      => 'Factura correo',
          'factura_direccion'	      => 'Factura dirección',
          'factura_pago' 			      => 'Factura pago',
          'llegada_nvuelo' 		      => 'Llegada No. de vuelo',
          'llegada_aerolinea'       => 'Llegada aerolínea',
          'llegada_fecha' 		      => 'Llegada fecha',
          'salida_nvuelo' 		      => 'Salida No. de vuelo',
          'salida_aerolinea' 	      => 'Salida aerolínea',
          'salida_fecha' 			      => 'Salida fecha',
          'habitacion' 				      => 'Habitación',
          'fecha_registro'		      => 'Fecha de registro',
          'nombre_aco'              => 'Nombre acompañante',
          'apellidos_aco'           => 'Apellidos acompañante',
          'correo_aco'              => 'Correo acompañante',
          'puesto_aco'              => 'Puesto acompañante',
          'llegada_nvuelo_aco'      => 'No. vuelo lledaga acompañante',
          'llegada_aerolinea_aco'   => 'Aerolínea llegada acompañante',
          'llegada_fecha_aco'       => 'Llegada fecha acompañante',
          'salida_nvuelo_aco'       => 'No. vuelo salida acompañante',
          'salida_aerolinea_aco'    => 'Aerolínea salida acompañante',
          'salida_fecha_aco'        => 'Salida fecha acompañante'

     );
    $fp     = fopen( 'php://temp/maxmemory:'. (12*1024*1024) , 'r+' );
    $fn     = new Functions;
    $isDate = array('llegada_fecha','salida_fecha','fecha_registro','llegada_fecha_aco','salida_fecha_aco');
    $isTime = array();
    $fields = array();
    $ignore = array('tx','tot');
    $keys   = array();
    $r_ = array();
    foreach ($vfields as $kf => $vf) {
    		//$vf = mb_convert_encoding($vf, 'UTF-16LE', 'UTF-8');
        //$vf = utf8_encode($vf);
        array_push($fields,$vf);
        array_push($keys,$kf);
    }
    echo implode(' | ', $fields);
    echo "<br><br>";
    fputcsv( $fp, $fields );
    foreach ($records as $kr => $vr) {
      foreach ($vr as $kv => $vv) {
        if(in_array($kv,$keys)){
          //$vv = utf8_encode($vv);
          $vv = (is_null($vv) || empty($vv)) ? '_' : $vv;
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
      echo implode(' | ', $r_);
      $r_ = array();
      echo "<br><br>";
    }
    rewind( $fp );
    $output = stream_get_contents( $fp );
    fclose( $fp );
    /*header('Content-Type: text/csv; charset=utf-8');
    //header("Content-Type: application/octet-stream");
    header('Content-Disposition: attachment; filename=KICK19regs.csv' );

    header('Content-Length: '. strlen($output) );
    echo $output;
    exit;*/
    return true;
	}

  public function reporte2(Request $request, Application $app) {
    $model    = $app["kickoff19Model"];
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
    header('Content-Disposition: attachment;filename="KickOff19.xlsx"');
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


  public function checkout(Request $request, Application $app,$lang){
    $qry = $request->query;
    $payData      = array();
    $lang         = 'es_MX';
    $urls         = array();
    $model    = $app["kickoff19Model"];
    $fn       = new Functions;
    $settings = array(
        'mode'      => 'live',
        'clientID'  => array(
                          'sandbox' => 'ATRlwj29eLlkCfnbXcVnuBxmKyISuUzZCTIhCFc-tyo_8ucLxAtdABEyMseGGelDD1mrXNJca938JePw',
                          'live'    => 'AX4F5-EOloUwKXnhgNGcMigiFrwVUUbF3kaVHJgk5dDY-5JRf7glVyq2f8psi0QXCLSSYp-aKxM7PS2A'
                        ),
        'secret'    => array(
                          'sandbox' => 'EAhILjAqrzGkp63Woew2l9H73mphTLpPyChr_opX_ADnWX6uaJbYj-QfRazOmozNQrk0_ubKr8LaTo7U',
                          'live'    => 'EE8KjGC0PCt-Nz7hpGE_sYKVDIogwqILyvzaOJLMCYyALKvMSDBmwJUqv_SOnYPjwwrilxfxhgOftLq6'
                        ),
        'params'    => array(
                          'nameProfile' => 'ReservasTyC_' . uniqid(),
                          'logoImage'   => 'https://webapps.tycgroup.com/assets/img/logoTyC50.png',
                          'shipping'    => 1,
                          'address'     => 1,
                          'landingPage' => 'billing',
                          'bank'        => 'https://www.paypal.com'
                        )
    );
    $ppPlus   = new ppPlus($settings);
    $reg      = $model->getById($qry->get('id'));
    $reg      = $app["serializer"]->toArray($reg);
    $urls     = array(
                  'return' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate('kickoff19.payComplete')),
                  'cancel' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate('kickoff19.payCancel'))
                );
    $aHab = json_decode($qry->get(hab),true);
    $payData = array(
                  'currency'          => 'MXN',
                  'total'             => $qry->get('tot'),
                  'subTotal'          => $qry->get('tot'),
                  'description'       => 'KICKOFF 2019, Iberostar Cancún -'. $aHab['name'],
                  'name'              => $reg['nombre'] ." " . $reg['apellidos']  ,
                  'address1'          => empty($reg['factura_direccion']) ? 'Ángel Urraza 625, Del Valle' : $reg['factura_direccion'],
                  'address2'          => '',
                  'city'              => empty($reg['factura_cd']) ? 'CDMX' : $reg['factura_cd'],
                  'country_code'      => 'MX',
                  'cp'                => empty($reg['factura_cp']) ? '03100' : $reg['factura_cp'],
                  'state'             => empty($reg['factura_edo']) ? 'CDMX' : $reg['factura_edo'],
                  'phone'             => empty($reg['telefono']) ? 'CDMX' : $reg['telefono'],
                  'item_name'         => 'KICKOFF 2019',
                  'item_description'  => 'KICKOFF 2019, Iberostar Cancún -'. $aHab['name'],
                  'item_price'        => $qry->get('tot'),
                  'item_sku'          => $fn->token(6,'KICKOFF19_'),
                  'item_currency'     => 'MXN'
                );
    return $app->json($ppPlus->getApproval($payData,$urls,$lang));
  }

  public function execute(Request $request, Application $app,$lang){
    $ppPlus   = new ppPlus(array());
    $exeUrl   = $request->query->get('exeUrl');
    $payerId  = $request->query->get('payer_id');
    $token    = $request->query->get('token');
    return $app->json($ppPlus->execute($exeUrl,$token,$payerId));
  }

  public function payComplete(Request $request, Application $app,$lang){
    $rqts       = $app["serializer"]->toArray($request->request)['parameters'];
    $host       = $request->server->get('HTTP_HOST');
    $model      = $app["kickoff19Model"];
    $model->setTX($rqts['idr'],$rqts['tx'],$rqts['amount']);
    return $app['twig']->render('pages/kickoff19/complete.twig', array(
      'title' => 'pago',
      'rq'    => $rqts
    ));
  }

  public function payCancel(Request $request, Application $app,$lang){
    return true;
  }

}

?>
