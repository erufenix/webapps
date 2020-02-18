<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;
//use Lib\Functions\ppplusLive as ppplus;

define("ANEIC","aneic");

class aneicController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get("/{idHotel}/{currency}/{lang}",sprintf('Controller\eventos17\%sController::index',ANEIC))
		->bind(ANEIC.".index")
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);		
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',ANEIC))->bind(ANEIC.".setReservacion");
		$index->get('/confirmacion/{lang}',sprintf('Controller\eventos17\%sController::confirmacion',ANEIC))->bind(ANEIC.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}',sprintf('Controller\eventos17\%sController::politicas',ANEIC))->bind(ANEIC.".politicas")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',ANEIC))->bind(ANEIC.".setReservacion");
		$index->post('/applyPay/{lang}',sprintf('Controller\eventos17\%sController::applyPay',ANEIC))->bind(ANEIC.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/checkOut/{lang}',sprintf('Controller\eventos17\%sController::checkOut',ANEIC))->bind(ANEIC.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payReturn/{lang}',sprintf('Controller\eventos17\%sController::payReturn',ANEIC))->bind(ANEIC.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payCancel/{lang}',sprintf('Controller\eventos17\%sController::payCancel',ANEIC))->bind(ANEIC.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/execute/{lang}',sprintf('Controller\eventos17\%sController::execute',ANEIC))->bind(ANEIC.'.execute')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'universal/es.index.twig.html',
				'es' 	=> 'universal/es.index.twig.html',
				'en' 	=> 'universal/en.index.twig.html'
		);
		$fn 				= new Functions;
		$paises   = array_column($fn->getCountryListArray($lang)['content']['geonames'], 'countryName', 'geonameId');

		$hoteles[1] =
			array(
				'index' 				=> '1',
				'nombre' 				=> 'FIESTA INN TORREON GALERIAS',
				'img' 					=> 'fiestaGalerias.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACION CPL',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'2,346.30',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'2,346.30',
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
                    '<li>Renta de Habitación por noche en la categoría elegida con Desayuno Buffet, Impuestos y Propinas.</li>'.
                    '<li>El Check Inn 15:00 hrs. / Check Out 12:00 hrs.</li>'.
                    '',
						'en' => ''
					)
			);



		$hoteles[2] =
			array(
				'index' 				=> '2',
				'nombre' 				=> 'HOLIDAY INN EXPRESS TORREON',
				'img' 					=> 'holidayInnTo.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACION CPL',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'1,911.00',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'1,911.00',
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
                    '<li>Renta de Habitación por noche en la categoría elegida con Barra de Desayuno Express e Impuestos</li>'.
                    '<li>El Check Inn 15:00 hrs. / Check Out 12:00 hrs.</li>'.
                    '',
						'en' => ''
					)
			);

		$hoteles[3] =
			array(
				'index' 				=> '3',
				'nombre' 				=> 'HAMPTON INN TORREO AEROPUERTO GALERIAS',
				'img' 					=> 'hamptonTo.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACION CPL',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'1,911.00',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'1,911.00',
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
                    '<li>Renta de Habitación por noche en la categoría elegida con Desayuno Buffet e Impuestos.</li>'.
                    '<li>El Check Inn 15:00 hrs. / Check Out 12:00 hrs.</li>'.
                    '',
						'en' => ''
					)
			);

  		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 				=> '',
			'evento' 				=> 'XXXV OLIMPIANEIC TORREON 2019',
			'hoteles' 			=> $hoteles,
			'hotelesJson' 	=> json_encode($hoteles),
			'currency' 			=> $currency,
			'idHotel' 			=> $idHotel,
			'lang' 					=> $lang,
			'paises' 				=> $paises,
			'logo' 					=> array(
											),
			'css_logo'    	=> '',
			'fechas'  			=> array(
													'es' => '01 AL 05 DE MAYO, 2019',
													'en' => '' 
													),
			'sede'        	=> array(
													'es' => 'TORREON, COAHUILA',
													'en' => '' 
													),
			'claveEvento' 	=> 'ANEIC',
			'fechaLleMin'		=> '2019-05-01',
			'fechaLleMax'		=> '2019-05-04',
			'fechaSalMin'		=> '2019-05-02',
			'fechaSalMax'		=> '2019-05-05',
			'noches' 				=> 2,
			'urlIndex'			=> $app['url_generator']->generate(ANEIC.".index"),
			'urlReserva'		=> $app['url_generator']->generate(ANEIC.".setReservacion"),
			'urlConfirma'		=> $app['url_generator']->generate(ANEIC.".confirmacion"),
			'urlApplyPay' 	=> $app['url_generator']->generate(ANEIC.".applyPay"),
			'urlChekout'    => $app['url_generator']->generate(ANEIC.".checkOut"),
			'urlExecute'    => $app['url_generator']->generate(ANEIC.".execute"),
			'urlPayReturn'  => $app['url_generator']->generate(ANEIC.".payReturn"),
			'rutaImg' 			=> 'aneic',
			'links'					=> array(
														'es' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(ANEIC.".politicas"),
																								'name' 	=> 'Políticas de reservación'
																							),
																'formato'   => array()
																),
														'en' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(ANEIC.".politicas"),
																								'name' 	=> 'Reservation Policies'
																							),
																'formato'   => array()
																) 			
													),
			'linksJson' 		=> json_encode(
														array(
														)
													),
			'operador'  		=> array(
													'name'			=> 'Carlos Aguirre',
													'sortName' 	=> 'CA',
													'mail' 			=> 'caguirre@tycgroup.com',
													'phone'			=> '+52 55 5148 75 00 ext: 69'
											),
            'extOperador'   => array(
                            array(
                              'name'      => 'Mariela Arellano',
                              'sortName'  => 'MA',
                              'mail'      => 'marellano@tycgroup.com',
                              'phone'     => '+52 55 5148 75 00 ext: 11'
                            )
                          ),											
			'operadorJson' 	=> json_encode(
														array(
															'name'			=> 'Carlos Aguirre',
															'sortName' 	=> 'CA',
															'mail' 			=> 'caguirre@tycgroup.com',
															'phone'			=> '+52 55 5148 75 00 ext: 69'
														)														
													),
			'host' 					=> $request->server->get('HTTP_HOST'),
			'protocol' 			=> sprintf("%s://",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http'),
			'hostFullUri' 	=> sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME')),
			'hostFull' 			=> sprintf("%s://%s%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME') ,$request->server->get('REQUEST_URI')),
			'mode' 					=> 'live',
			'dateMsg' 			=> array(
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
		$ANEICRsv 		= time();
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
		$request->request->set('claveReservacion',$ANEICRsv);
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
							"marellano@tycgroup.com" => "Mariela Arellano",
							"caguirre@tycgroup.com" => "Carlos Aguirre"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion XXXV OLIMPIANEIC TORREON 2019');
			}
			else{
				$mail
					->setTo("erubi@tycgroup.com","Edgar Rubi")
					->setBcc(array(
							"lcazares@tcevents.com" => "Luis Cazares",
							"marellano@tycgroup.com" => "Mariela Arellano",
							"caguirre@tycgroup.com" => "Carlos Aguirre"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion XXXV OLIMPIANEIC TORREON 2019');
			}
			$imgHotel = explode("/",$request->request->get('imgHotel'));
			$imgHotel = end($imgHotel);
			$imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/aneic/". $imgHotel;
			$body = $app['twig']->render('pages/eventos17/universal/'.$pages[$request->request->get('lang') ], array(
				"data"			=> $rsv,
				"idHotel" 	=> $request->request->get('idHotel'),
				"pais" 			=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 		=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name'),
				"bannerImg" => 'http://webapps.tycgroup.com/assets/img/bannerReMail.png',
				"imgHotel"  =>  $imgHotel,
				"operador"	=> array(
												'name'			=> 'Carlos Aguirre',
												'sortName' 	=> 'MA',
												'mail' 			=> 'caguirre@tcevents.com',
												'phone'			=> '+52 55 5148 75 00 ext: 69'
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
		$pages = array(
				'' 		=> 'aneic.politicas.twig.html',
				'es' 	=> 'aneic.politicas.twig.html',
				'en' 	=> 'aneic.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/ANEIC/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function _checkOut_(Request $request, Application $app,$lang){
		$response = array();
		$pay 			= new ppplus;
		$urls 		= array(
									'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(ANEIC.".payReturn"),
									'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(ANEIC.".payCancel")
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
		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'evento' 				=> 'XXXV OLIMPIANEIC TORREON 2019',
			'logo' 					=> array(
											),
			'css_logo'    	=> '',
			'fechas'  			=> array(
													'es' => 'DEL 30 DE ABRIL AL 05 DE MAYO DE 2019',
													'en' => '' 
													),
			'sede'        	=> array(
													'es' => 'MAZATLÁN, SINALOA',
													'en' => '' 
													),
			'claveEvento' 	=> 'ANEIC',
			'lang' 					=> $lang,
			'operador'  		=> array(
													'name'			=> 'Carlos Aguirre',
													'sortName' 	=> 'CA',
													'mail' 			=> 'caguirre@tycgroup.com',
													'phone'			=> '+52 55 5148 75 00 ext: 69'
											),
			'request' 			=> $request->request,
      'urlIndex'      => $app['url_generator']->generate(ANEIC.".index")
		));
	}	
	

}
?>
