<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;

//use Lib\Functions\ppplusSandbox as ppplus;

define("CVE","EV18");

class EV18Controller implements ControllerProviderInterface {
	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get("/{idHotel}/{currency}/{lang}",sprintf('Controller\eventos17\%sController::index',CVE))
		->bind(CVE.".index")
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',CVE))->bind(CVE.".setReservacion");
		$index->get('/confirmacion/{lang}',sprintf('Controller\eventos17\%sController::confirmacion',CVE))->bind(CVE.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}',sprintf('Controller\eventos17\%sController::politicas',CVE))->bind(CVE.".politicas")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',CVE))->bind(CVE.".setReservacion");
		$index->post('/applyPay/{lang}',sprintf('Controller\eventos17\%sController::applyPay',CVE))->bind(CVE.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/checkOut/{lang}',sprintf('Controller\eventos17\%sController::checkOut',CVE))->bind(CVE.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payReturn/{lang}',sprintf('Controller\eventos17\%sController::payReturn',CVE))->bind(CVE.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payCancel/{lang}',sprintf('Controller\eventos17\%sController::payCancel',CVE))->bind(CVE.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/execute/{lang}',sprintf('Controller\eventos17\%sController::execute',CVE))->bind(CVE.'.execute')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'universal/es.index.twig.html',
				'es' 	=> 'universal/es.index.twig.html',
				'en' 	=> 'universal/en.index.en.twig.html'
		);
		$fn 				= new Functions;
		$paises   = array_column($fn->getCountryListArray($lang)['content']['geonames'], 'countryName', 'geonameId');
		$hoteles[1] =
			array(
				'index' 				=> '1',
				'nombre' 				=> 'GRAN HOTEL CONCORDIA',
				'img' 					=> 'concordia.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'Habitación sencilla',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'1,000.05',
								'usd'	=>	'1,000.05'
						),
						'costor' 	=> array(
								'mxn'	=>	'1,000.05',
								'usd'	=>	'1,000.05'
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
							'es' => 'Habitación Doble',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'1,200.00',
							'usd'	=>	'1,200.00'
							),
						'costor' 	=>  array(
							'mxn'	=>	'1,200.00',
							'usd'	=>	'1,200.00'
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
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
										'<li>Internet inalámbrico incluido</li>'.
										'<li>Acceso en cortesía al Gimnasio,</li>'.
										'<li>Check inn 15:00 hrs. Check out 12:00 hrs.</li>'.
										'</ul>',
						'en' => ''
					)
			);

		$hoteles[2] =
			array(
				'index' 				=> '2',
				'nombre' 				=> 'HOTEL PANORAMA',
				'img' 					=> 'panorama.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'Habitación sencilla',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'1,200.05',
								'usd'	=>	''
						),
						'costor' 	=> array(
								'mxn'	=>	'1,200.05',
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
							'es' => 'Habitación doble',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'1,000.00',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'1,000.00',
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
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
										'<li>Internet inalámbrico incluido</li>'.
										'<li>Acceso en cortesía al Gimnasio,</li>'.
										'</ul>',
						'en' => ''
					)
			);
		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 				=> '',
			'evento' 				=> 'Evento 2018',
			'hoteles' 			=> $hoteles,
			'hotelesJson' 	=> json_encode($hoteles),
			'currency' 			=> $currency,
			'idHotel' 			=> $idHotel,
			'lang' 					=> $lang,
			'paises' 				=> $paises,
			'logo' 					=> array(
													'desktop_logo'	=> 'icon_geek.png',
													'mobile_logo' 	=> 'icon_geek_90.png'
											),
			'css_logo'    	=> 'logo01',
			'fechas'  			=> '02 al 04 de Noviembre 2018',
			'sede'        	=> 'Graymalkin Lane, Salem Center',
			'claveEvento' 	=> CVE,
			'fechaLleMin'		=> '2018-11-01',
			'fechaLleMax'		=> '2018-11-03',
			'fechaSalMin'		=> '2018-11-02',
			'fechaSalMax'		=> '2018-11-04',
			'noches' 				=> 2,
			'urlIndex'			=> $app['url_generator']->generate(CVE.".index"),
			'urlReserva'		=> $app['url_generator']->generate(CVE.".setReservacion"),
			'urlConfirma'		=> $app['url_generator']->generate(CVE.".confirmacion"),
			'urlApplyPay' 	=> $app['url_generator']->generate(CVE.".applyPay"),
			'urlChekout'    => $app['url_generator']->generate(CVE.".checkOut"),
			'urlExecute'    => $app['url_generator']->generate(CVE.".execute"),
			'urlPayReturn'  => $app['url_generator']->generate(CVE.".payReturn"),
			'rutaImg' 			=> 'ffm',
			'links'					=> array(
														'politicas' => array(
																						'url' 	=> $app['url_generator']->generate(CVE.".politicas"),
																						'name' 	=> 'Politicas de reservación'
																					),
														'formato'   => array()
													),
			'linksJson' 		=> json_encode(
														array(
														'politicas' => array(
																						'url' 	=> $app['url_generator']->generate(CVE.".politicas"),
																						'name' 	=> 'Politicas de reservación'
																					),
														'formato'   => array()
														)
													),
			'operador'  		=> array(
													'name'			=> 'Edgar R. U.',
													'sortName' 	=> 'ER',
													'mail' 			=> 'erubi@tycgroup.com',
													'phone'			=> '+52 55 5148 75 00 ext: 39'
											),
			'operadorJson' 	=> json_encode(
														array(
															'name'			=> 'Edgar R. U.',
															'sortName' 	=> 'ER',
															'mail' 			=> 'erubi@tycgroup.com',
															'phone'			=> '+52 55 5148 75 00 ext: 39'
														)
													),
			'host' 					=> $request->server->get('HTTP_HOST'),
			'protocol' 			=> sprintf("%s://",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http'),
			'hostFullUri' 	=> sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME')),
			'hostFull' 			=> sprintf("%s://%s%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME') ,$request->server->get('REQUEST_URI')),
			'mode' 					=> 'sandbox'
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
			$data['mode'] = $request->request->get('pmode');
			$data['lang'] = $request->request->get('lang');
			$mail 	= \Swift_Message::newInstance();
			$nombre = $request->request->get('nombre') . " " . $request->request->get('apaterno') ." " . $request->request->get('amaterno');
			if($fpago == 'DB'){
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setBcc(array(
							"erubi@tycgroup.com" => "Edgar Rubi",
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion Evento 2018');
			}
			else{
				$mail
					->setTo("erubi@tycgroup.com","Edgar Rubi")
					->setBcc(array(
							//"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion Evento 2018');
			}
			$imgHotel = explode("/",$request->request->get('imgHotel'));
			$imgHotel = end($imgHotel);
			$imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/".CVE."/" . $imgHotel;
			$body = $app['twig']->render('pages/eventos17/universal/'.$pages[$request->request->get('lang') ], array(
				"data"			=> $rsv,
				"idHotel" 	=> $request->request->get('idHotel'),
				"pais" 			=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 		=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name'),
				"bannerImg" => 'http://webapps.tycgroup.com/assets/img/bannerReMail.png',
				"imgHotel"  =>  $imgHotel,
				"operador"	=> array(
												'name'			=> 'Edgar R. U.',
												'sortName' 	=> 'ER',
												'mail' 			=> 'erubi@tycgroup.com',
												'phone'			=> '+52 55 5148 75 00 ext: 39'
											)
				)
			);
			$mail->setBody($body, "text/html");
			//$env = $app['mailer']->send($mail);
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
		$pages = array(
				'' 		=> 'es.politicas.twig.html',
				'es' 	=> 'es.politicas.twig.html',
				'en' 	=> 'en.politicas-en.twig.html',
		);
		return $app['twig']->render("pages/eventos17/universal/" . $pages[$lang], array(
			'data' => $request->query,
			'operador'	=> array(
												'name'			=> 'Edgar R. U.',
												'sortName' 	=> 'ER',
												'mail' 			=> 'erubi@tycgroup.com',
												'phone'			=> '+52 55 5148 75 00 ext: 39'
										),
		));
	}

	public function _checkOut_(Request $request, Application $app,$lang){
		$response = array();
		$pay 			= new ppplus;
		$urls 		= array(
									'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(CVE.".payReturn"),
									'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(CVE.".payCancel")
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

	public function checkOut(Request $request, Application $app,$lang){
		$model 	= $app["rsvModel"];
		$id 		= $request->query->get('id');
		$mode 	= $request->query->get('mode');
		$rsv 		= $model->getReservacion(array('idreservacion' =>$id));
		$langs 	= array(
								'es' => 'es_MX',
								'en' => 'en_US',
								'pt' => 'pt_BR'
							);
		$lang 	= $langs[$lang];
		$settings = array(
				'mode' 			=> $mode,
				'clientID' 	=> array(
													'sandbox' => 'Aamm4JcEPPuRAqkRYTDC44v2xyXPI3XlUlIOyCzM-jPuYoxTm4xyeX6vy0tcSZTUxPKUTkQhOI1NrGa2',
													'live' 		=> 'AXIjt9ZwFU34lIzBOlOb2ozh5ZyQ3Tif7hehrFgyhcBFFTValGA4835roqraOvM_voonyy2ceGSfJ0r-'
												),
				'secret' 		=> array(
													'sandbox' => 'ELqXRheFUcx7w41XVpT1IglSXRzgbwEQ9XpBZ5toqUJnm4tjY9oku3ynWbN1EkAK3gdWCxq-Ac7Vss-g',
													'live' 		=> 'EL-XIzcVqUMWNaZBThBH7yTVf2kkaKBSvN7wEV2pbYWZ34BTS4vtxzAZYA2EKzQQzxun4KvB-1Teyx9A'
												),
				'params' 		=> array(
													'nameProfile' => 'ReservasTyC_' . uniqid(),
													'logoImage' 	=> 'https://webapps.tycgroup.com/assets/img/logoTyC50.png',
													'shipping' 		=> 1,
													'address' 		=> 1,
													'landingPage' => 'billing',
													'bank' 				=> 'https://www.paypal.com'
												)
		);

		$urls 			= array(
										'return' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate(CVE.'.payReturn')),
										'cancel' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate(CVE.'.payCancel'))
									);

		$payData = array(
									'currency'					=> strtoupper($rsv->getDivisa()),
									'total' 						=> $rsv->getCargototal(),
									'subTotal' 					=> $rsv->getCargototal(),
									'description' 			=> $rsv->getNombreevento() .", " . $rsv->getNombrehotel() ." - ". $rsv->getTipohabitacion(),
									'name' 							=> $rsv->getNombre() ." ". $rsv->getApp() ." ". $rsv->getApm(),
									'address1' 					=> $rsv->getDireccion() .", ". $rsv->getColonia(),
									'address2' 					=> '',
									'city' 							=> '_',
									'country_code' 			=> 'MX',
									'cp' 								=> $rsv->getCp(),
									'state' 						=> $rsv->getEstado(),
									'phone' 						=> $rsv->getTelefono(),
									'item_name' 				=> $rsv->getNombreevento(),
									'item_description' 	=> $rsv->getNombreevento() .", " . $rsv->getNombrehotel() ." - ". $rsv->getTipohabitacion(),
									'item_price' 				=> $rsv->getCargototal(),
									'item_sku' 					=> $rsv->getClaveevento() ."-". $rsv->getClavereservacion(),
									'item_currency' 		=> strtoupper($rsv->getDivisa()),
									'email' 						=> $rsv->getEmail()
								);
		$ppPlus 		= new ppPlus($settings);
		return $app->json($ppPlus->getApproval($payData,$urls,$lang));
	}



	public function _execute_(Request $request, Application $app,$lang){
		$pay 			= new ppplus;
		$exeUrl 	= $request->query->get('exeUrl');
		$payerId 	= $request->query->get('payer_id');
		$token 		= $request->query->get('token');
		return $app->json($pay->execute($exeUrl,$token,$payerId));
	}

	public function execute(Request $request, Application $app,$lang){
		$ppPlus 	= new ppPlus(array());
		$exeUrl 	= $request->query->get('exeUrl');
		$payerId 	= $request->query->get('payer_id');
		$token 		= $request->query->get('token');
		return $app->json($ppPlus->execute($exeUrl,$token,$payerId));
	}

	public function payReturn(Request $request, Application $app,$lang){
    $model  = $app["rsvModel"];
    $tx     = $request->request->get('tx');
    $id     = $request->request->get('data')['idreservacion'];
		$pages = array(
				'' 		=> 'universal/es.return.twig.html',
				'es' 	=> 'universal/es.return.twig.html',
				'en' 	=> 'universal/en.return.en.twig.html'
		);
		$model->setValue('tx',$tx,$id);
		$mailc 	= \Swift_Message::newInstance();
		$mailc
			->setTo('erubi@tycgroup.com','Edgar Rubi')
			->setBcc(array(
					//"erubi@tycgroup.com" => "Edgar Rubi",
			))
			->setFrom('no--reply@sin-tcevents.mx','Pago completado')
			->setSubject('Reservacion Evento 2018 -  Pago PayPlay completado');
		
		$bodyc = $app['twig']->render('pages/eventos17/universal/mail-complete.twig.html', array(
				'request' => $request->request->all()
			)
		);

		$mailc->setBody($bodyc, "text/html");
		$env = $app['mailer']->send($mailc);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'evento' 				=> 'Evento 2018',
			'logo' 					=> array(
													'desktop_logo'	=> 'icon_geek.png',
													'mobile_logo' 	=> 'icon_geek_90.png'
											),
			'css_logo'    	=> 'logo01',
			'fechas'  			=> '02 al 04 de Noviembre 2018',
			'sede'        	=> 'Graymalkin Lane, Salem Center',
			'claveEvento' 	=> CVE,
			'lang' 					=> $lang,
			'operador'  		=> array(
													'name'			=> 'Edgar R. U.',
													'sortName' 	=> 'ER',
													'mail' 			=> 'erubi@tycgroup.com',
													'phone'			=> '+52 55 5148 75 00 ext: 39'
											),
			'request' 			=> $request->request,
      'urlIndex'      => $app['url_generator']->generate(CVE.".index")
		));
	}

}
?>