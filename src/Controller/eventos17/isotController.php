<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class isotController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\isotController::index')
		->bind('isot.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\isotController::setReservacion')->bind('isot.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\isotController::confirmacion')->bind('isot.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\isotController::politicas')->bind('isot.politicas')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'isot/isot.index.twig.html',
				'es' 	=> 'isot/isot.index.twig.html',
				'en' 	=> 'isot/isot.index.en.twig.html'
		);
	$fn 				= new Functions;
	$paises   = $fn->getCountryList($lang);
	$hoteles[1] =
			array(
				'index' 				=> '1',
				'nombre' 				=> 'KRYSTAL CANCÚN',
				'img' 					=> '1.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACIÓN DOBLE  DELUXE ROH',
							'en'	=> 'DOUBLE DELUXE ROH ROOM',
						),
						'costo' 	=> array(
								'mxn'	=>	'2,093.00',
								'usd'	=>	''
						),
						'costor' 	=> array(
								'mxn'	=>	'2,093.00',
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
							'es' => 'HABITACIÓN SENCILLA DELUXE ROH',
							'en' => 'SINGLE DELUXE ROH ROOM'
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,113.00',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'2,113.00',
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
				'all' => true,
				'mensajes'			=> array(
						'es' => '<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
										'<ul>\n'.
										'<li>Renta de habitación en ocupación sencilla y/o doble por noche, 16% IVA, 2% ISH y propinas a camaristas</li>\n'.
										'<li>El Check Inn 15:00 hrs. / Check Out 12:00 hrs.</li>\n'.
										'',
						'en' => '<h3 class=\"c-theme-font c-font-uppercase\">The rate includes:</h3>\n'.
										'<ul>\n'.
										'<li>Room for single and / or double occupancy per night, 16% IVA, 2% ISH and tips for maids</li>\n'.
										'<li>Check Inn 15:00 hrs. / Check Out 12:00 hrs.</li>\n'.
										''
					)
			);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 			=> 'CONGRESO ISOT 2018',
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
				'' 		=> 'mail-isot-deposito-es.twig.html',
				'es' 	=> 'mail-isot-deposito-es.twig.html',
				'en' 	=> 'mail-isot-deposito-en.twig.html'
		);
		$lang = $request->request->get('lang');		
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
							"marellano@tcevents.com" => "Mariela Arellano"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject($lang == 'es' ? 'Reservación CONGRESO ISOT 2018': 'Reservation CONGRESO ISOT 2018' );
			}
			else{
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"marellano@tcevents.com" => "Mariela Arellano",
							"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject($lang == 'es' ? 'Inicio de proceso de reservación CONGRESO ISOT 2018' : 'Start of reservation process CONGRESO ISOT 2018');				
			}
			$body = $app['twig']->render('pages/eventos17/isot/'.$pages[$lang], array(
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
				'' 		=> 'isot.confirmacion.twig.html',
				'es' 	=> 'isot.confirmacion.twig.html',
				'en' 	=> 'isot.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/isot/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'isot.politicas.twig.html',
				'es' 	=> 'isot.politicas.twig.html',
				'en' 	=> 'isot.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/isot/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	

}
?>