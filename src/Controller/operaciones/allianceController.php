<?php
namespace Controller\operaciones;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class allianceController implements ControllerProviderInterface {
	private $model 	=	null;

	public function connect(Application $app) {
		$index = $app['controllers_factory'];

		$index->get('/inicio/{tipo}','Controller\operaciones\allianceController::index')
			->bind('alliance.index')
 		  ->assert('tipo', '\w+')
 		  ->value('tipo', 'distribuidores');

		$index->get('/sede/{tipo}','Controller\operaciones\allianceController::sede')
			->bind('alliance.sede')
 		  ->assert('tipo', '\w+')
 		  ->value('tipo', 'distribuidores');

		$index->get('/agenda/{tipo}','Controller\operaciones\allianceController::agenda')
			->bind('alliance.agenda')
 		  ->assert('tipo', '\w+')
 		  ->value('tipo', 'distribuidores');

		$index->get('/registro/{tipo}','Controller\operaciones\allianceController::registro')
			->bind('alliance.registro')
			->assert('tipo', '\w+')
			->value('tipo', 'distribuidores');

		$index->post('/valida','Controller\operaciones\allianceController::valida')->bind('alliance.valida');
		$index->post('/setregistro','Controller\operaciones\allianceController::setRegistro')->bind('alliance.setRegistro');
		$index->get('/contacto','Controller\operaciones\allianceController::contacto')->bind('alliance.contacto');
		$index->post('/sendContacto','Controller\operaciones\allianceController::sendContacto')->bind('alliance.sendContacto');
		$index->get('/reporte','Controller\operaciones\allianceController::reporte')->bind('reporte');
		$index->get('/reporte2','Controller\operaciones\allianceController::reporte2')->bind('reporte2');
		return $index;
	}

	public function index(Request $request, Application $app,$tipo) {
		return $app['twig']->render('pages/alliance/index.twig.html', array(
			'title' => '',
			'tipo' 	=> $tipo,
			'tmpl' 	=> ($tipo == 'distribuidores') ? 'dis' : (($tipo == 'asociados') ? 'asoc' : '404')
		));
		//return $app->redirect('registro');
	}

	public function sede(Request $request, Application $app,$tipo) {
		var_dump($tipo);
		return $app['twig']->render('pages/alliance/sede.twig.html', array(
			'title' => '',
			'tipo' 	=> $tipo,
			'tmpl' 	=> ($tipo == 'distribuidores') ? 'dis' : 'asoc'
		));
	}

	public function registro(Request $request, Application $app,$tipo) {
		return $app['twig']->render('pages/alliance/registro.twig.html', array(
			'title' => '',
			'tipo' 	=> $tipo,
			'tmpl' 	=> ($tipo == 'distribuidores') ? 'dis' : 'asoc'
		));
	}

	public function setRegistro(Request $request, Application $app) {
		$model 		=	$app["allianceModel"];
		$data 		= array();
		$fn 			= new Functions;
		$now   		= new \DateTime('now');
		$regCve   = null;
		$acts     = '';
		$regDbl   = $request->request->get('regDoble');
		$fhoral_  = $request->request->get('fecha_vuelol') ." ". $request->request->get('hora_vuelol').":00";
		$fhoras_  = $request->request->get('fecha_vuelos') ." ". $request->request->get('hora_vuelos').":00";
		$fllegada = $fn->d2b($request->request->get('fecha_l'));
		$fsalida 	= $fn->d2b($request->request->get('fecha_s'));
		$fhoral 	= $fn->d2b($fhoral_,true);
		$fhoras 	= $fn->d2b($fhoras_,true);
		$request->request->set('fecha_l',$fllegada);
		$request->request->set('fecha_s',$fsalida);
		$request->request->set('fecha_hora_vuelol',$fhoral);
		$request->request->set('fecha_hora_vuelos',$fhoras);
		$request->request->set('fecha_registro',$now);
		if(!empty($request->request->get('acts'))){
			$acts = implode("\n",$request->request->get('acts'));
		}
		$request->request->set('actividad',$acts);
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		$reg 	= $model->setregistro($request->request);
		$data = $app["serializer"]->toArray($reg);
		if(!empty($data)){
			$mail 	= \Swift_Message::newInstance();
			$mail
				->setTo($request->request->get('correo'),$request->request->get('nombre'))
				->setBcc(array(
						"erubi@tcevents.com" => "Edgar Rubi",
						"gterreros@tcevents.com" => "Gerardo Terreros"
				))
				->setFrom('no--reply@sin-tcevents.mx','Reservacion')
				->setSubject('Reservacion Convención Distribuidores 2018');
			$body = $app['twig']->render('pages/alliance/remail.twig.html', array(
				"data"		=> $data			
				)
			);
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);
			if($regDbl == true){
				$regCve = $model->getRegCve($request->request->get('idClave'));
				if(count($regCve) > 1){
					$blk = $model->blkCve($data['id_clave']);
				}
			}
			else{
				$blk = $model->blkCve($data['id_clave']);
			}								
			$json   	= array(
				'status' => true,
				'msg' 	=> '',
				'data' 	=> $data
			);
		}
		return $app->json($json);				
	}	

	public function valida(Request $request, Application $app){
		$model 	=	$app["allianceModel"];
		$clave  = $model->getClave($request->request);
		return $app->json($clave);
	}

	public function contacto(Request $request, Application $app) {
		return $app['twig']->render('pages/alliance/contacto.twig.html', array(
			'title' => ''
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
			->setTo('gterreros@tcevents.com','Gerardo Terreros')
			->setBcc(array(
				"erubi@tcevents.com" => "Edgar Rubi"
			))
			->setFrom($request->request->get('correo'),$request->request->get('nombre'))
			->setSubject('Contacto Convención Distribuidores 2018');	
		$body = $app['twig']->render('pages/alliance/mailContact.twig.html', array(
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
		return $app['twig']->render('pages/alliance/agenda.twig.html', array(
			'title' => ''
		));
	}

	public function reporte(Application $app) {
		$model 		=	$app["allianceModel"];
		$reg 			= $model->getAll();
		$records  = $app["serializer"]->toArray($reg);
		$vfields 	= array(
					'reg_idRegistro'			=> 'ID Registro',
					'reg_nombre' 					=> 'Nombre',
					'reg_correo' 					=> 'Correo',
					'reg_celular' 				=> 'Celular',
					'reg_contacto' 				=> 'Contacto',
					'reg_distribuidor'		=> 'Distribuidor',
					'reg_acoNombre' 			=> 'Acompañante',
					'reg_habitacion' 			=> 'Habitación',
					'reg_ncamas'					=> 'No. camas',
					'reg_transporte' 			=> 'Transporte',
					'reg_aerolineas' 			=> 'Aerolínea (llegada)',
					'reg_nvuelos'  				=> 'No. vuelo (llegada)',
					'reg_fechaHoraVuelos' => 'Fecha/hora (llegada)',
					'reg_aerolineal' 			=> 'Aerolínea (salida)',
					'reg_nveulol'  				=> 'No. vuelo (salida)',
					'reg_fechaHoraVuelol' => 'Fecha/hora (salida)',
					'reg_cmVuelo'				 	=> 'Comentario',
					'reg_actividad'				=> 'Workshops',
					'reg_fechaRegistro' 	=> 'Fecha de registro',
					'reg_fechaL' 					=> 'Fecha de llegada',
					'reg_fechaS'          => 'Fecha de salida',
					'cve_clave' 					=> 'Clave usada',
		 );
		$fp 		= fopen( 'php://temp/maxmemory:'. (12*1024*1024) , 'r+' );
		$fn 		= new Functions;
		$isDate	= array('reg_fechaRegistro','reg_fechaL','reg_fechaS');
		$isTime = array('reg_fechaHoraVuelos','reg_fechaHoraVuelol');
		$fields  = array();
		$keys   = array();
		$r_ = array();
		foreach ($vfields as $kf => $vf) {
				array_push($fields,$vf);
				array_push($keys,$kf);
		}
		fputcsv( $fp, $fields );
		foreach ($records as $kr => $vr) {
			foreach ($vr as $kv => $vv) {
				if(in_array($kv,$keys)){
					$vv = utf8_decode($vv);
					$vv = is_null($vv) ? '' : $vv;
					if(in_array($kv,$isDate) && !empty($vv)){
						$vv = $fn->d2h($vv);
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

		header('Content-Disposition: attachment; filename=mAlliance.csv' );

		header('Content-Length: '. strlen($output) );

		echo $output;
		exit;
	}


	public function reporte2(Application $app) {
		$model 		=	$app["allianceModel"];
		$reg 			= $model->getAll();		
		$records  = $app["serializer"]->toArray($reg);
		//$fields 	= array('ID registro','Nombre','Apellidos','Correo','Distribuidor','Nombre acompañante','Habitación','No. de camas','Aerolínea (llegada a los Cabos)','No. de vuelo (llegada a los Cabos)','Fecha hora (llegada a los Cabos)','No. de vuelo (salida los Cabos)','Aerolínea (salida de los Cabos)','Fecha hora (salida los Cabos)','Actividad','Renta palos','Día actividad','Fecha de registro','Token');
		$fields 	= array('ID registro');
		$fn  	= new Functions;
		$excel	= $fn->genExcel('International17','International17','Registros');
		$ltrnum   = 65;
		$ltrchr   = "";
		$lastchr  = "";
		$lastcell = 0;		
		$over = '';
		$cc   = 0;
		$isDate = array('fecha_registro','fecha_hora_vuelol','fecha_hora_vuelos');
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
		foreach ($fields as $kr => $vr) {
			$ltrchr = chr($ltrnum+$cc);
			//var_dump($vr);
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
		foreach ($records as $kr => $vr) {
			foreach ($vr as $k_     => $v_) {
				$ltrchr = chr($ltrnum+$index);
				$index++;
				$cc++;
				if(in_array($k_,$isDate) && !empty($v_)){
					$v_ = $fn->d2h($v_);
				}
				$excel->getActiveSheet()->setCellValue($over.$ltrchr.$cr, $v_);
				$excel->getActiveSheet()->getStyle($over.$ltrchr.$cr)->applyFromArray($values);
				//$excel->getActiveSheet()->getStyle($over2.$ltrchr.$cr)->getAlignment()->setIndent(1);
				if ($index > 25) {
					$index = 0;
				}
				if ($cc > 25) {
					$over = "A";
				}
			}
			$index = 0;
			$cc   = 0;
			$cr++;
			$over = '';
		}
		$excel->getActiveSheet()->setCellValue('A1', 'XVIII Convención Distribuidores International');
		$excel->getActiveSheet()->mergeCells('A1:'.$over.$lastchr.'1');
		$excel->getActiveSheet()->getStyle('A1:'.$over.$lastchr.'1')->applyFromArray($titles);
		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="International17.xlsx"');
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
}
?>