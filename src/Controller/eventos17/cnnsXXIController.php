<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class cnnsXXIController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\cnnsXXIController::index')
		->bind('cnnsXXI.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\cnnsXXIController::setReservacion')->bind('cnnsXXI.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\cnnsXXIController::confirmacion')->bind('cnnsXXI.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\cnnsXXIController::politicas')->bind('cnnsXXI.politicas')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'cnnsXXI/cnnsXXI.index.twig.html',
				'es' 	=> 'cnnsXXI/cnnsXXI.index.twig.html',
				'en' 	=> 'cnnsXXI/cnnsXXI.index.en.twig.html'
		);
	$fn 				= new Functions;
	$paises   = $fn->getCountryList();	
	$hoteles[1] =
			array(
				'index' 				=> '1',
				'nombre' 				=> 'HOTEL REAL DE MINAS',
				'img' 					=> 'rminas.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACION  ESTANDAR SENCILLA O DOBLE (2 CAMAS MATRIMONIALES)',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'1,476.00',
								'usd'	=>	''
						),
						'costor' 	=> array(
								'mxn'	=>	'1,476.00',
								'usd'	=>	''
						),
						'propinas'	=>	array(
							'mxn'	=>	'40',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'HABITACION  SUPERIOR DOBLE (2 CAMAS MATRIMONIALES)',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,218.00',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'2,218.00',
							'usd'	=>	''
							),
						'propinas'	=>	array(
							'mxn'	=>	'80',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'HABITACION  SUPERIOR KING (1 CAMA)',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,218.00',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'2,218.00',
							'usd'	=>	''
							),
						'propinas'	=>	array(
							'mxn'	=>	'40',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						)					
				),
				'all' => true,
				'mensajes'			=> array(
						'es' => '<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
										'<ul>\n'.
										'<li>Renta de habitación en ocupación sencilla y/o doble por noche, 16% IVA, 2% ISH y propinas a camaristas</li>\n'.
										'<li>Se realizará un cargo único de $40.00 MN en habitación sencilla y $80.00 en habitación doble (entrada y salida) por concepto de propina a botones.</li>\n'.
										'<li>Tarifas cotizadas en MN.</li>'.
										'</ul>\n'.
										'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
										'<ul>\n'.
										'<li>Ckeck inn: 03:00 pm. / Ckeck out: 12:00 hrs.</li>\n'.
										'</ul>\n'.
										'',
						'en' => ''
					)
			);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 			=> 'CONGRESO NACIONAL DE NEUROCIRUGIA SIGLO XXI',
			'hoteles' 		=> $hoteles,
			'hotelesJson' => json_encode($hoteles),

			'currency' 		=> $currency,
			'idHotel' 		=> $idHotel,
			'lang' 				=> $lang,
			'paises' 			=> $paises,
			'operador'  	=> array(
										'name'	=> 'Mariela Arellano',
										'mail' 	=> 'marellano@tcevents.com',
										'phone'	=> '+52 55 5148 75 00 ext: 11' 
										),
			'url' 				=> (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST') . $request->server->get('REDIRECT_URL')
 			));		
	}

	public function setReservacion(Request $request, Application $app){
		$model = $app["rsvModel"];
		$fn 				= new Functions;
		$dh    			= explode('|', $request->request->get('habitacionc'));
		$now   			= new \DateTime('now');
		$fllegada 	= $fn->d2b($request->request->get('fechaLlegada'));
		$fsalida 		= $fn->d2b($request->request->get('fechaSalida'));
		$habitacion = $dh[0];
		$costoNoche = str_replace(',','',$dh[1]);
		$bellBoy 		= str_replace(',','',$dh[2]);
		$pack  			= (empty(str_replace(',','',$dh[3]))) ? 0*1 : str_replace(',','',$dh[3])*1;
		$pp 				= $dh[4];
		$costoNochr = str_replace(',','',$dh[5]);
		$cveRsv 		= time();
		$diasPago   = 0;
		$fpago 			= $request->request->get('pago');
		$data = array();
		$pages = array(
				'' 		=> 'mail-cnnsXXI-deposito-es.twig.html',
				'es' 	=> 'mail-cnnsXXI-deposito-es.twig.html',
				'en' 	=> 'mail-cnnsXXI-deposito-en.twig.html'
		);		
		if($pack != 0){
			$costoNochr = $costoNochr / $pack;
			$diasPago   = $pack;			
		}
		elseif($request->request->get('pagoPor') == 'N'){
			$diasPago = 2;
		}
		else{
			$dl 			= $fllegada;
			$ds 			= $fsalida;
			$di 			= $fllegada->diff($fsalida);
			$diasPago = $di->format('%a');
		}
		$cargo 			= ($costoNochr * $diasPago) + $bellBoy;
		$request->request->set('claveReservacion',$cveRsv);
		$request->request->set('tipoHabitacion',$habitacion);
		$request->request->set('costoNoche',$costoNochr);
		$request->request->set('cargoBellBoys',$bellBoy);
		$request->request->set('diasPago',$diasPago);
		$request->request->set('cargoTotal',$cargo);
		$request->request->set('status','iniciada');
		$fechas['fsalida'] 	= $fsalida;
		$fechas['fllegada'] = $fllegada;
		$fechas['now'] 		= $now;
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		$rsv = $model->crearReservacion($request->request,$fechas,$app);
		if($rsv){
			$data = $app["serializer"]->toArray($rsv);
			$mail 	= \Swift_Message::newInstance();
			$nombre = $request->request->get('nombre') . " " . $request->request->get('apaterno') ." " . $request->request->get('amaterno');
			if($fpago == 'DB'){
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							//"marellano@tcevents.com" => "Mariela Arellano"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion CONGRESO NACIONAL DE NEUROCIRUGIA SIGLO XXI');
			}
			else{
				$mail
					->setTo("erubi@tcevents.com","Mariela Arellano")
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							//"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso CONGRESO NACIONAL DE NEUROCIRUGIA SIGLO XXI');				
			}
			$body = $app['twig']->render('pages/eventos17/cnnsXXI/'.$pages[$request->request->get('lang') ], array(
				"data"		=> $rsv,
				"idHotel" => $request->request->get('idHotel'),
				"pais" 		=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 	=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name')				
				)
			);
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);
			$json   	= array(
					'status'	=> true,
					'msg' 		=> '',
					'data' 		=> $data
			);										
		}
		return $app->json($json);
	}

	public function confirmacion(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'cnnsXXI.confirmacion.twig.html',
				'es' 	=> 'cnnsXXI.confirmacion.twig.html',
				'en' 	=> 'cnnsXXI.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/cnnsXXI/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'cnnsXXI.politicas.twig.html',
				'es' 	=> 'cnnsXXI.politicas.twig.html',
				'en' 	=> 'cnnsXXI.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/cnnsXXI/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	

}
?>