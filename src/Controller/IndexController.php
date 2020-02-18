<?php
namespace Controller;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Entity\Bfg17;

use Lib\Functions\Functions;

class IndexController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/','Controller\IndexController::index')->bind('index');
		$index->get('/actividades','Controller\IndexController::actividades')->bind('actividades');
		$index->match('/registro','Controller\IndexController::registro')->bind('registro');
		$index->post('/setregistro','Controller\IndexController::setRegistro')->bind('setRegistro');
		$index->get('/sede','Controller\IndexController::sede')->bind('sede');
		$index->get('/agenda','Controller\IndexController::programa')->bind('programa');
		$index->get('/contacto','Controller\IndexController::contacto')->bind('contacto');
		$index->post('/sendContacto','Controller\IndexController::sendContacto')->bind('sendContacto');
		$index->get('/cData','Controller\IndexController::cData')->bind('cData');
		$index->post('/valida','Controller\IndexController::valida')->bind('valida');
		$index->post('/vmail','Controller\IndexController::vmail')->bind('vmail');
		$index->get('/reporte','Controller\IndexController::reporte')->bind('reporte');
		$index->get('/reporte2','Controller\IndexController::reporte2')->bind('reporte2');
		return $index;
	}

	public function index(Request $request, Application $app) {
		return $app['twig']->render('index.twig', array(
			'title' =>''
		));
	}

	public function actividades(Request $request, Application $app) {
		return $app['twig']->render('pages/actividades.twig', array());
	}	

	public function registro(Request $request, Application $app) {
		return $app['twig']->render('pages/registro.twig', array(
			'data' 	=> $request->request,
			'title' => 'Registro'
		));
	}

	public function sede(Request $request, Application $app) {
		return $app['twig']->render('pages/sede.twig', array(
			'title'	=> 'Sede'
		));
	}

	public function programa(Request $request, Application $app) {
		return $app['twig']->render('pages/programa.twig', array());
	}

	public function contacto(Request $request, Application $app) {
		return $app['twig']->render('pages/contacto.twig', array());
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
				"apujula@asociacioninternational.com"   => "Ángel A. Pujula Tiburcio",
				"sflores@asociacioninternational.com"  	=> "Salvador Flores",
				"Susana.delafuente@navistar.com"    		=> "Susana de la fuente",
				"erubi@tcevents.com"    								=> "Edgar Rubi"
			))
			->setFrom($request->request->get('correo'),$request->request->get('nombre'))
			->setSubject($request->request->get('asunto'));	
		$body = $app['twig']->render('pages/mailContact.twig', array(
						"data"	=> $request->request
						//"cid"   => $cid
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

	public function setRegistro(Request $request, Application $app) {
		$em 	= $app['orm.em'];
		$data = array();
		$reg = new Bfg17;
		$fn = new Functions;
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		if($reg){
			$reg
				->setNombre($request->request->get('nombre'))
				->setApellidos($request->request->get('apellidos'))
				->setCorreo($request->request->get('correo'))
				->setRazonSocial($request->request->get('razonSocial'))
				->setHabitacion($request->request->get('habitacion'))
				->setTransporte($request->request->get('transporte'))
				->setFechaLlegada($fn->d2b($request->request->get('fechaLlegada'),false))
				->setFechaSalida($fn->d2b($request->request->get('fechaSalida'),false))
				->setAlergia($request->request->get('alergia'))
				->setlicenciaEmision($request->request->get('lugarLicencia'))
				->setlicenciaDigitos($request->request->get('digitos'))
				->setlicenciaValida($fn->d2b($request->request->get('lvalida'),false))
				->setFechaRegistro(new \DateTime('now'));
			try {
				$em->persist($reg);
				$em->flush();
				$data = $app["serializer"]->toArray($reg);
				/*$body = $app['twig']->render('pages/nmail.twig', array(
					"data"	=> $data
					//"cid"   => $cid
					)
				);
				$mail->setBody($body, "text/html");
				$env = $app['mailer']->send($mail);*/			
				$json   	= array(
					'status'	=> true,
					'msg' 		=> '',
					'data' 		=> $data
				);					
			} catch (Exception $e) {
				$json['mensaje'] = $e;
				$json['status']  = false;					
			}				
		}

		return $app->json($json);	
	}

	public function cData(Request $request, Application $app) {
		$em 	= $app['orm.em'];
		return $app['twig']->render('pages/cdata.twig', array());		
	}	

	public function vmail(Request $request, Application $app){
		$em 	= $app['orm.em'];
		$ifExist = false;
		$m 		= $reg = $em->getRepository('Entity\Convencion17')->findOneByCorreo($request->request->get('correo'));
		if(empty($m)){
			$ifExist = true;
		}
		return $app->json(array('ifExist' => $ifExist));
	}

	public function valida(Request $request, Application $app) {
		$em 		= $app['orm.em'];
		$json   	= array(
			'status' => false,
			'msg' 	=> 'Datos no validos, verificalos datos por favor!',
			'data' 	=> null
		);		
		$correo 	= $request->request->get('correo');
		$token        = $request->request->get('token');
		$validar      = $em->getRepository('Entity\Convencion17')->findOneBy(array('correo' => $correo, 'token' => $token));
		if($validar){
			$data = $app["serializer"]->toArray($validar);
			$json   	= array(
				'status' => true,
				'msg' 	=> '',
				'data' 	=> $data
			);			
		}
		return $app->json($json);
	}	

	public function reporte(Application $app) {
		$em 			= $app['orm.em'];
		$reg 			= $em->getRepository('Entity\Convencion17')->findAll();
		$records  = $app["serializer"]->toArray($reg);
		$fields 	= array('ID registro','Nombre','Apellidos','Correo','Distribuidor',utf8_decode('Nombre acompañante'),utf8_decode('Habitación'),'No. de camas',utf8_decode('Aerolínea (llegada a los Cabos)'),'No. de vuelo (llegada a los Cabos)','Fecha hora (llegada a los Cabos)','No. de vuelo (salida los Cabos)',utf8_decode('Aerolínea (salida de los Cabos'),'Fecha hora (salida los Cabos)','Actividad','Renta palos',utf8_decode('Día actividad'),'Fecha de registro','Token');
		$fp = fopen( 'php://temp/maxmemory:'. (12*1024*1024) , 'r+' );
		$fn = new Functions;
		fputcsv( $fp, $fields );
		$isDate = array('fecha_registro','fecha_hora_vuelol','fecha_hora_vuelos');
		$r_ = array();
		foreach ($records as $kr => $vr) {
			foreach ($vr as $kv => $vv) {
				$vv = utf8_decode($vv);
				$vv = is_null($vv) ? '' : $vv;
				if(in_array($kv,$isDate) && !empty($vv)){
					$vv = $fn->d2h($vv);
				}
				array_push($r_,$vv);
			}
			fputcsv( $fp, $r_);
			$r_ = array();
		}
		rewind( $fp );
		$output = stream_get_contents( $fp );
		fclose( $fp );

		header('Content-Type: text/csv; charset=utf-8');

		header('Content-Disposition: attachment; filename=international17.csv' );

		header('Content-Length: '. strlen($output) );

		echo $output;
		exit;
	}

	public function reporte2(Application $app) {
		$em 			= $app['orm.em'];
		$reg 			= $em->getRepository('Entity\Convencion17')->findAll();
		$records  = $app["serializer"]->toArray($reg);
		$fields 	= array('ID registro','Nombre','Apellidos','Correo','Distribuidor','Nombre acompañante','Habitación','No. de camas','Aerolínea (llegada a los Cabos)','No. de vuelo (llegada a los Cabos)','Fecha hora (llegada a los Cabos)','No. de vuelo (salida los Cabos)','Aerolínea (salida de los Cabos)','Fecha hora (salida los Cabos)','Actividad','Renta palos','Día actividad','Fecha de registro','Token');
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