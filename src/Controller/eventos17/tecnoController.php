<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;

//use Lib\Functions\ppplusSandbox as ppplus;

define("tecno","tecno");

class tecnoController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get("/{idHotel}/{currency}/{lang}",sprintf('Controller\eventos17\%sController::index',tecno))
		->bind(tecno.".index")
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',tecno))->bind(tecno.".setReservacion");
		$index->get('/confirmacion/{lang}',sprintf('Controller\eventos17\%sController::confirmacion',tecno))->bind(tecno.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}',sprintf('Controller\eventos17\%sController::politicas',tecno))->bind(tecno.".politicas")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',tecno))->bind(tecno.".setReservacion");
		$index->post('/applyPay/{lang}',sprintf('Controller\eventos17\%sController::applyPay',tecno))->bind(tecno.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/checkOut/{lang}',sprintf('Controller\eventos17\%sController::checkOut',tecno))->bind(tecno.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payReturn/{lang}',sprintf('Controller\eventos17\%sController::payReturn',tecno))->bind(tecno.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payCancel/{lang}',sprintf('Controller\eventos17\%sController::payCancel',tecno))->bind(tecno.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/execute/{lang}',sprintf('Controller\eventos17\%sController::execute',tecno))->bind(tecno.'.execute')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'universal/es.index.twig.html',
				'es' 	=> 'universal/es.index.twig.html',
				'en' 	=> 'universal/en.index.en.twig.html'
		);
		$fn 				= new Functions;
		$paises   = $fn->getCountryList($lang);
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
			'claveEvento' 	=> tecno,
			'fechaLleMin'		=> '2018-11-01',
			'fechaLleMax'		=> '2018-11-03',
			'fechaSalMin'		=> '2018-11-02',
			'fechaSalMax'		=> '2018-11-04',
			'noches' 				=> 2,
			'urlIndex'			=> $app['url_generator']->generate(tecno.".index"),
			'urlReserva'		=> $app['url_generator']->generate(tecno.".setReservacion"),
			'urlConfirma'		=> $app['url_generator']->generate(tecno.".confirmacion"),
			'urlApplyPay' 	=> $app['url_generator']->generate(tecno.".applyPay"),
			'urlChekout'    => $app['url_generator']->generate(tecno.".checkOut"),
			'urlExecute'    => $app['url_generator']->generate(tecno.".execute"),
			'urlPayReturn'  => $app['url_generator']->generate(tecno.".payReturn"),
			'rutaImg' 			=> 'ffm',
			'links'					=> array(
														'politicas' => array(
																						'url' 	=> $app['url_generator']->generate(tecno.".politicas"),
																						'name' 	=> 'Politicas de reservación'
																					),
														'formato'   => array()
													),
			'linksJson' 		=> json_encode(
														array(
														'politicas' => array(
																						'url' 	=> $app['url_generator']->generate(tecno.".politicas"),
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
		$tecnoRsv 		= time();
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
		$request->request->set('claveReservacion',$tecnoRsv);
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
			$imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/".tecno."/" . $imgHotel;
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
									'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(tecno.".payReturn"),
									'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(tecno.".payCancel")
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
													'sandbox' => 'AVwd0_m4Asr31lglE-h-AaiqcUDglqAeoNyRY8mwptCK_dL5czcoEJ6DwG6qLuLPc8HQf-zQG09nJyMR',
													'live' 		=> 'ASUZIljxmNLRNMwMsXDNFCUfTJX0Iv7XyKbMPFkaw01gR73q9zNGS2OsNPt4HwgVXrjiZiOfQhB-dWKe'
												),
				'secret' 		=> array(
													'sandbox' => 'EL9p95sk26Rv9YX0vDDtJIVPmKUhk4ZoGOsHU_7gT4f0r6Zci3e-CAhUiMPXlWDLkFJkcKIaWzmXCkXp',
													'live' 		=> 'EIOzXak6xorVyCLagxqqxq6d0eskFYTNjFUm8qgn7OxscqUfa6wo1lNBAVwU4O_On81BvpsJh3TWduzk'
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
										'return' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate(tecno.'.payReturn')),
										'cancel' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate(tecno.'.payCancel'))
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
		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'evento' 				=> 'Evento 2018',
			'logo' 					=> array(
													'desktop_logo'	=> 'icon_geek.png',
													'mobile_logo' 	=> 'icon_geek_90.png'
											),
			'css_logo'    	=> 'logo01',
			'fechas'  			=> '02 al 04 de Noviembre 2018',
			'sede'        	=> 'Graymalkin Lane, Salem Center',
			'claveEvento' 	=> tecno,
			'lang' 					=> $lang,
			'operador'  		=> array(
													'name'			=> 'Edgar R. U.',
													'sortName' 	=> 'ER',
													'mail' 			=> 'erubi@tycgroup.com',
													'phone'			=> '+52 55 5148 75 00 ext: 39'
											),
			'request' 			=> $request->request,
      'urlIndex'      => $app['url_generator']->generate(tecno.".index")
		));
	}

}
?>
