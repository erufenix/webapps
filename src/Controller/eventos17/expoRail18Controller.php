<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class expoRail18Controller implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\expoRail18Controller::index')
		->bind('rail18.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\expoRail18Controller::setReservacion')->bind('rail18.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\expoRail18Controller::confirmacion')->bind('rail18.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\expoRail18Controller::politicas')->bind('rail18.politicas')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'exporail/rail18.index.twig.html',
				'es' 	=> 'exporail/rail18.index.twig.html',
				'en' 	=> 'exporail/rail18.index.en.twig.html'
		);
		$hoteles = array(
			array(
				'index' 				=> '1',
				'nombre' 				=> 'IBEROSTAR CANCÚN',
				'img' 					=> '1.jpeg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACIÓN ESTÁNDAR OCEAN VIEW SENCILLA',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'5,020.00',
								'usd'	=>	''
						),
						'costor' 	=> array(
								'mxn'	=>	'5,020.00',
								'usd'	=>	''
						),						
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'HABITACIÓN ESTÁNDAR OCEAN VIEW DOBLE',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'7,948.00',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'7,948.00',
							'usd'	=>	''
							),						
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						)
				),
				'mensajes'			=> array(
						'es' => '<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
										'<ul>\n'.
										'<li>Renta de Habitación Estándar Osean View sencilla o doble en Plan Todo Incluido,por noche, Impuestos, Propinas a Camaristas y a Bell boys.</li>'.
										'<li>Internet inalámbrico incluido durante las fechas del Congreso, solo para hospedados en el Hotel Iberostar. Se otorgarán 2 accesos a WiFi por habitación.</li>\n'.
										'<li>Acceso en cortesía al Gimnasio,</li>\n'.
										'<li>Check inn 15:00 hrs. Check out 12:00 hrs.</li>'.
										'</ul>\n'.
										'<h3 class=\"c-theme-font c-font-uppercase\">NOTAS IMPORTANTES:</h3>\n'.
										'<ul>\n'.
										'<li>La tarifa para niños de 3 a 12 años es de $1,800.00 por niño por noche en Plan Todo Incluido, Impuestos, Propinas a Camaristas y a Bell boys.</li>'.
										'<li>En el caso en que en la habitación solo haya un adulto y un niño, la habitación se pagará como doble.</li>'.
										'<li>Niños de 13 años en adelante pagan tarifa de adulto aún acompañados.</li>'.
										'</ul>\n',
						'en' => ''
					)		
			)
		);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 			=> 'XVII REUNIÓN DE NEGOCIOS DE LA INDUSTRIA FERROVIARIA, EXPORAIL 2018',
			'hoteles' 		=> $hoteles,
			'hotelesJson' => json_encode($hoteles),
			'currency' 		=> $currency,
			'idHotel' 		=> $idHotel,
			'lang' 				=> $lang, 
			'operador'  	=> array(
										'name'	=> 'Carlos Aguirre',
										'mail' 	=> 'cguirre@tcevents.com',
										'phone'	=> '+52 55 5148 75 00 ext: 69' 
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
				'' 		=> 'mail-rail18-deposito-es.twig.html',
				'es' 	=> 'mail-rail18-deposito-es.twig.html',
				'en' 	=> 'mail-rail18-deposito-en.twig.html'
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
							"caguirre@tcevents.com" => "Carlos Aguirre"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion XVII REUNIÓN DE NEGOCIOS DE LA INDUSTRIA FERROVIARIA, EXPORAIL 2018');
			}
			else{
				$mail
					->setTo("caguirre@tcevents.com","Carlos Aguirre")
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion XVII REUNIÓN DE NEGOCIOS DE LA INDUSTRIA FERROVIARIA, EXPORAIL 2018');				
			}
			$body = $app['twig']->render('pages/eventos17/exporail/'.$pages[$request->request->get('lang') ], array(
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
				'' 		=> 'rail18.confirmacion.twig.html',
				'es' 	=> 'rail18.confirmacion.twig.html',
				'en' 	=> 'rail18.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/exporail/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'rail18.politicas.twig.html',
				'es' 	=> 'rail18.politicas.twig.html',
				'en' 	=> 'rail18.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/exporail/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	

}
?>