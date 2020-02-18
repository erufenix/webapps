<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;


use Lib\Functions\ppplusLive as ppplus;

define("CVEisot","isotn");

class isotnController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get("/{idHotel}/{currency}/{lang}",sprintf('Controller\eventos17\%sController::index',CVEisot))
		->bind(CVEisot.".index")
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);		
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',CVEisot))->bind(CVEisot.".setReservacion");
		$index->get('/confirmacion/{lang}',sprintf('Controller\eventos17\%sController::confirmacion',CVEisot))->bind(CVEisot.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}',sprintf('Controller\eventos17\%sController::politicas',CVEisot))->bind(CVEisot.".politicas")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',CVEisot))->bind(CVEisot.".setReservacion");
		$index->post('/applyPay/{lang}',sprintf('Controller\eventos17\%sController::applyPay',CVEisot))->bind(CVEisot.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/checkOut/{lang}',sprintf('Controller\eventos17\%sController::checkOut',CVEisot))->bind(CVEisot.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payReturn/{lang}',sprintf('Controller\eventos17\%sController::payRetrun',CVEisot))->bind(CVEisot.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payCancel/{lang}',sprintf('Controller\eventos17\%sController::payCancel',CVEisot))->bind(CVEisot.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/execute/{lang}',sprintf('Controller\eventos17\%sController::execute',CVEisot))->bind(CVEisot.'.execute')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'universal/es.index.twig.html',
				'es' 	=> 'universal/es.index.twig.html',
				'en' 	=> 'universal/en.index.twig.html'
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
								'mxn'	=>	'1.0',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'1.0',
								'usd'	=>	'0'
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
							'mxn'	=>	'0.5',
							'usd'	=>	'0'
							),
						'costor' 	=>  array(
							'mxn'	=>	'0.5',
							'usd'	=>	'0'
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
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
										'<li>Renta de habitación en ocupación sencilla y/o doble por noche, 16% IVA, 2% ISH y propinas a camaristas.</li>'.
										'<li>El Check Inn 15:00 hrs. / Check Out 12:00 hrs.</li>'.
										'</ul>',
						'en' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
										'<li>Room for single and / or double occupancy per night, 16% IVA, 2% ISH and tips for maids</li>'.
										'<li>Check Inn 15:00 hrs. / Check Out 12:00 hrs.</li>'.
										'</ul>'
					)
			);

  		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 				=> '',
			'evento' 				=> 'CONGRESO ISOT 2018',
			'hoteles' 			=> $hoteles,
			'hotelesJson' 	=> json_encode($hoteles),
			'currency' 			=> $currency,
			'idHotel' 			=> $idHotel,
			'lang' 					=> $lang,
			'paises' 				=> $paises,
			'logo' 					=> array(
											),
			'css_logo'    	=> 'logo01',
			'fechas'  			=> array(
													'es' => '4 AL 8 DE NOVIEMBRRE 2018',
													'en' => '4 TO 8 NOVENBER 2018' 
													),
			'sede'        	=> array(
													'es' => 'KRYSTAL CANCÚN',
													'en' => 'KRYSTAL CANCUN' 
													),
			'claveEvento' 	=> 'ISOT',
			'fechaLleMin'		=> '2018-11-04',
			'fechaLleMax'		=> '2018-11-07',
			'fechaSalMin'		=> '2018-11-05',
			'fechaSalMax'		=> '2018-11-08',
			'noches' 				=> 2,
			'urlIndex'			=> $app['url_generator']->generate(CVEisot.".index"),
			'urlReserva'		=> $app['url_generator']->generate(CVEisot.".setReservacion"),
			'urlConfirma'		=> $app['url_generator']->generate(CVEisot.".confirmacion"),
			'urlApplyPay' 	=> $app['url_generator']->generate(CVEisot.".applyPay"),
			'urlChekout'    => $app['url_generator']->generate(CVEisot.".checkOut"),
			'urlExecute'    => $app['url_generator']->generate(CVEisot.".execute"),
			'rutaImg' 			=> 'isot',
			'links'					=> array(
														'es' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(CVEisot.".politicas"),
																								'name' 	=> 'Políticas de reservación'
																							),
																'formato'   => array()
																),
														'en' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(CVEisot.".politicas"),
																								'name' 	=> 'Reservation Policies'
																							),
																'formato'   => array()
																) 			
													),
			'linksJson' 		=> json_encode(
														array(
														'politicas' => array(
																						'url' 	=> $app['url_generator']->generate(CVEisot.".politicas"),
																						'name' 	=> 'Politicas de reservación'
																					),
														'formato'   => array()
														)
													),
			'operador'  		=> array(
													'name'			=> 'Mariela Arellano',
													'sortName' 	=> 'MA',
													'mail' 			=> 'erubi@tycgroup.com',
													'phone'			=> '+52 55 5148 75 00 ext: 11'
											),
			'operadorJson' 	=> json_encode(
														array(
															'name'			=> 'Mariela Arellano',
															'sortName' 	=> 'MA',
															'mail' 			=> 'erubi@tycgroup.com',
															'phone'			=> '+52 55 5148 75 00 ext: 11'
														)														
													),
			'host' 					=> $request->server->get('HTTP_HOST'),
			'protocol' 			=> sprintf("%s://",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http'),
			'hostFullUri' 	=> sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME')),
			'hostFull' 			=> sprintf("%s://%s%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME') ,$request->server->get('REQUEST_URI')),
			'mode' 					=> 'live',
			'dateMsg' 			=> array(
													'es' => 'Reservaciones para antes o después de las fechas oficiales del evento estarán sujetas a disponibilidad.',
													'en' => 'To book before or after the official dates of the event will be subject to availability.'
												),
			'_msg_'					=> array()
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
		$CVEisotRsv 		= time();
		$diasPago   = 0;
		$fpago 			= $request->request->get('pago');
		$data = array();
		$pages = array(
				'' 		=> 'mail-deposito-es.twig.html',
				'es' 	=> 'mail-deposito-es.twig.html',
				'en' 	=> 'mail-deposito-en.twig.html'
		);
		if($pack != 0){
			$costoNochr = $costoNochr / $pack;
			$diasPago   = $pack;
		}
		elseif($request->request->get('pagoPor') == 'N'){
			$diasPago = $request->request->get('noches');
		}
		else{
			$dl 			= $fllegada;
			$ds 			= $fsalida;
			$di 			= $fllegada->diff($fsalida);
			$diasPago = $di->format('%a');
		}
		$cargo 			= ($costoNochr * $diasPago) + $bellBoy;
		$request->request->set('claveReservacion',$CVEisotRsv);
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
			$data['mode'] = $request->request->get('pmode');
			$data['lang'] = $request->request->get('lang');
			$mail 	= \Swift_Message::newInstance();
			$nombre = $request->request->get('nombre') . " " . $request->request->get('apaterno') ." " . $request->request->get('amaterno');
			if($fpago == 'DB'){
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setBcc(array(
							"erubi@tycgroup.com" => "Edgar Rubi",
							//"marellano@tycgroup.com" => "Mariela Arellano"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion Evento 2018');
			}
			else{
				$mail
					->setTo("erubi@tycgroup.com","Edgar Rubi")
					->setBcc(array(
							//"lcazares@tcevents.com" => "Luis Cazares"
							//"marellano@tycgroup.com" => "Mariela Arellano"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion Evento 2018');
			}
			$imgHotel = explode("/",$request->request->get('imgHotel'));
			$imgHotel = end($imgHotel);
			$imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/".CVEisot."/" . $imgHotel;
			$body = $app['twig']->render('pages/eventos17/universal/'.$pages[$request->request->get('lang') ], array(
				"data"			=> $rsv,
				"idHotel" 	=> $request->request->get('idHotel'),
				"pais" 			=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 		=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name'),
				"bannerImg" => 'http://webapps.tycgroup.com/assets/img/bannerReMail.png',
				"imgHotel"  =>  $imgHotel,
				"operador"	=> array(
												'name'			=> 'Mariela Arellano',
												'sortName' 	=> 'MA',
												'mail' 			=> 'marellano@tycgroup.com',
												'phone'			=> '+52 55 5148 75 00 ext: 11'
											)
				)
			);
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);
			$json   	= array(
					'status'	=> true,
					'msg' 		=> '',
					'data' 		=> $data,
					'aData' 	=> $app["serializer"]->toArray($data),
					'request' => $request->request->all()
			);
		}
		return $app->json($json);
	}

	public function confirmacion(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'es.confirmacion.twig.html',
				'es' 	=> 'es.confirmacion.twig.html',
				'en' 	=> 'en.confirmacion.twig.html',
		);
		return $app['twig']->render("pages/eventos17/universal/" . $pages[$lang], array(
			'data' 			=> $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		/*$pages = array(
				'' 		=> "es.". CVEisot .".politicas.twig.html",
				'es' 	=> "es.". CVEisot .".politicas.twig.html",
				'en' 	=> "en.". CVEisot ."politicas-en.twig.html",
		);
		return $app['twig']->render("pages/eventos17/universal/" . $pages[$lang], array(
			'data' => $request->query,
			'operador'	=> array(
												'name'			=> 'Edgar R. U.',
												'sortName' 	=> 'ER',
												'mail' 			=> 'erubi@tycgroup.com',
												'phone'			=> '+52 55 5148 75 00 ext: 39'
										),
		));*/
		$pages = array(
				'' 		=> 'isot.politicas.twig.html',
				'es' 	=> 'isot.politicas.twig.html',
				'en' 	=> 'isot.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/isot/" . $pages[$lang], array(
			'data' => $request->query
		));		
	}

	public function checkOut(Request $request, Application $app,$lang){
		$response = array();
		$pay 			= new ppplus;
		$urls 		= array(
									'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(CVEisot.".payReturn"),
									'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(CVEisot.".payCancel")
								);
		$params 	= array(
									'nameProfile' => 'ReservasTyC_' . uniqid(),
									'logoImage' 	=> 'https://webapps.tycgroup.com/assets/img/logoTyC50.png',
									'shipping' 		=> 1,
									'address' 		=> 1,
									'landingPage' => 'billing',
									'bank' 				=> 'https://www.paypal.com'
								);
		return $app->json($pay->checkOut($request->query,$lang,$urls,$params));
	}

	public function execute(Request $request, Application $app,$lang){
		$pay 			= new ppplus;
		$exeUrl 	= $request->query->get('exeUrl');
		$payerId 	= $request->query->get('payer_id');
		$token 		= $request->query->get('token');
		return $app->json($pay->execute($exeUrl,$token,$payerId));
	}	

}
?>
