<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;


use Lib\Functions\ppplusSandbox as ppplus;

class mansionxController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\mansionxController::index')
		->bind('mansionx.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\mansionxController::setReservacion')->bind('mansionx.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\mansionxController::confirmacion')->bind('mansionx.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\mansionxController::politicas')->bind('mansionx.politicas')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/setReservacion','Controller\eventos17\mansionxController::setReservacion')->bind('mansionx.setReservacion');
		$index->post('/applyPay/{lang}','Controller\eventos17\mansionxController::applyPay')->bind('mansionx.applyPay')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/checkOut/{lang}','Controller\eventos17\mansionxController::checkOut')->bind('mansionx.checkOut')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payReturn/{lang}','Controller\eventos17\mansionxController::payRetrun')->bind('mansionx.payReturn')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payCancel/{lang}','Controller\eventos17\mansionxController::payCancel')->bind('mansionx.payCancel')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/execute/{lang}','Controller\eventos17\mansionxController::execute')->bind('mansionx.execute')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'universal/es.index.twig.html',
				'es' 	=> 'universal/es.index.twig.html',
				'en' 	=> 'universal/en.index.en.twig.html'
		);
		$fn 				= new Functions;
		$paises   = $fn->getCountryList();
		$hoteles[1] =
			array(
				'index' 				=> '1',
				'nombre' 				=> 'Masion X',
				'img' 					=> 'X-Mansion.png',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'Habitación residentes',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'0.05',
								'usd'	=>	''
						),
						'costor' 	=> array(
								'mxn'	=>	'0.05',
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
							'es' => 'Habitación maestros',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'1.00',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'1.00',
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
										'<li>Internet inalámbrico incluido</li>\n'.
										'<li>Acceso en cortesía al Gimnasio,</li>\n'.
										'<li>Check inn 15:00 hrs. Check out 12:00 hrs.</li>'.
										'</ul>\n',
						'en' => ''
					)		
			);

		$hoteles[2] =
			array(
				'index' 				=> '2',
				'nombre' 				=> 'Avalon',
				'img' 					=> 'avalon.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'Sector 001',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'0.05',
								'usd'	=>	''
						),
						'costor' 	=> array(
								'mxn'	=>	'0.05',
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
							'es' => 'Sector 003',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'1.00',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'1.00',
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
						'es' => '<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
										'<ul>\n'.
										'<li>Internet inalámbrico incluido</li>\n'.
										'<li>Acceso en cortesía al Gimnasio,</li>\n'.
										'</ul>\n',
						'en' => ''
					)		
			);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 				=> '',
			'evento' 				=> 'X Men: Dark Phoenix',
			'hoteles' 			=> $hoteles,
			'hotelesJson' 	=> json_encode($hoteles),
			'currency' 			=> $currency,
			'idHotel' 			=> $idHotel,
			'lang' 					=> $lang,
			'paises' 				=> $paises,
			'logo' 					=> array(
													'desktop_logo'	=> 'xologo_100.png',
													'mobile_logo' 	=> 'xologo_80.png'
											),
			'css_logo'    	=> 'logo01',
			'fechas'  			=> '02 al 04 de Noviembre 2018',
			'sede'        	=> 'Graymalkin Lane, Salem Center',
			'claveEvento' 	=> 'EXPOmansionx',
			'fechaLleMin'		=> '2018-11-01',
			'fechaLleMax'		=> '2018-11-03',
			'fechaSalMin'		=> '2018-11-02',
			'fechaSalMax'		=> '2018-11-04',
			'noches' 				=> 2,
			'urlReserva'		=> $app['url_generator']->generate('mansionx.setReservacion'),
			'urlConfirma'		=> $app['url_generator']->generate('mansionx.confirmacion'),
			'urlApplyPay' 	=> $app['url_generator']->generate('mansionx.applyPay'),
			'urlChekout'    => $app['url_generator']->generate('mansionx.checkOut'),
			'urlExecute'    => $app['url_generator']->generate('mansionx.execute'),
			'rutaImg' 			=> 'mansionX',
			'links'					=> array(
														'politicas' => array(
																						'url' 	=> $app['url_generator']->generate('mansionx.politicas'),
																						'name' 	=> 'Politicas de reservación' 
																					),
														'formato'   => array()
													),	
			'operador'  		=> array(
													'name'			=> 'Edgar R. U.',
													'sortName' 	=> 'ER',
													'mail' 			=> 'erubi@tcevents.com',
													'phone'			=> '+52 55 5148 75 00 ext: 39' 
											),
			'url' 					=> (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST') . $request->server->get('REDIRECT_URL')
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
			$mail 	= \Swift_Message::newInstance();
			$nombre = $request->request->get('nombre') . " " . $request->request->get('apaterno') ." " . $request->request->get('amaterno');
			if($fpago == 'DB'){
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion X Men: Dark Phoenix');
			}
			else{
				$mail
					->setTo("erubi@tcevents.com","Edgar Rubi")
					->setBcc(array(
							//"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion X Men: Dark Phoenix');				
			}
			$imgHotel = explode("/",$request->request->get('imgHotel'));
			$imgHotel = end($imgHotel);
			$imgHotel = 'http://webapps.tcevents.com/assets/img/hotel/mansionx/' . $imgHotel;
			$body = $app['twig']->render('pages/eventos17/universal/'.$pages[$request->request->get('lang') ], array(
				"data"			=> $rsv,
				"idHotel" 	=> $request->request->get('idHotel'),
				"pais" 			=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 		=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name'),
				"bannerImg" => 'http://webapps.tcevents.com/assets/img/bannerReMail.png',
				"imgHotel"  =>  $imgHotel,
				"operador"	=> array(
												'name'			=> 'Edgar R. U.',
												'sortName' 	=> 'ER',
												'mail' 			=> 'erubi@tcevents.com',
												'phone'			=> '+52 55 5148 75 00 ext: 39' 
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
				'' 		=> 'es.politicas.twig.html',
				'es' 	=> 'es.politicas.twig.html',
				'en' 	=> 'en.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/universal/" . $pages[$lang], array(
			'data' => $request->query,
			'operador'	=> array(
												'name'	=> 'Edgar R. U.',
												'sortName' 	=> 'ER',
												'mail' 	=> 'erubi@tcevents.com',
												'phone'	=> '+52 55 5148 75 00 ext: 39' 
										),			
		));
	}


	public function _applyPay_(Request $request, Application $app,$lang){
		$checkOut 	= null;
		$credidCard = null;
		$result 		= array();
		$mode 			= 'CC';
		/*$pay =  new payTwo
								(
									array(
										'currency' => 'USD',
        						'mode'=> 'sandbox',
        						'clientID'=>'AU8jcV85QoMTfAe4dCFwZKZy1U9fjnMlI4kQVuwO9bq27EeY8UULHD4alfdYEtUul_LIhXfDNFXlMBTw',
        						'secret'=>'ECsaDwgYQsLXjjqaVXC9ExbQaa68XkWNWvOdYSUfS9uxQDpsqO4AlbsbTXHbPS9plApU5svb1eg3gsoS',
        						'connectionTimeOut'=>40,
        						'logEnabled'=>true
							)
						);*/
		$pay =  new payTwo
								(
									array(
										'currency' => 'USD',
        						'mode'=> 'live',
        						'clientID'=>'AXiq4z044x-B0t-Vx27UMoaaN2M13sC6d3VimgFWRGySZoEfnDGoGzg4-_aFOh1_0ZXKPCknXhFuA7nj',
        						'secret'=>'EOhGQpjnA1rOpRWyPphGa418YJ1qn9OQ8K6U82T0rciq11c32hv7xNQiMB4dnX6OGyEL43sqNPP91Rcf',
        						'connectionTimeOut'=>40,
        						'logEnabled'=>true,
							)
						);			
		if($mode == 'CC'){						
			$credidCard = $pay->credidCard($request,$app);
			if($credidCard){
				$result = $app["serializer"]->toArray($credidCard);
			}
		}
		return $app->json(
			array(
				'result' 	=> $result,
				'request' => $app["serializer"]->toArray($request->request)
			)
		);
	}


	public function checkOut(Request $request, Application $app,$lang){
		$response = array();
		$pay 			= new ppplus;
		$urls 		= array(
									'return' => $app['url_generator']->generate('mansionx.payReturn'),
									'cancel' => $app['url_generator']->generate('mansionx.payCancel')
								);
		$params 	= array(
									'nameProfile' => 'ReservasTyC_' . uniqid(),
									'logoImage' 	=> 'https://webapps.tcevents.com/assets/img/logoTyC50.png',
									'shipping' 		=> 0,
									'address' 		=> 0,
									'landingPage' => 'billing',
									'bank' 				=> 'https://www.paypal.com'
								); 
		return $app->json($pay->checkOut($request->query,$lang,$urls,$params));
	}

	public function payReturn(Request $request, Application $app,$lang){
		return true;
	}

	public function execute(Request $request, Application $app,$lang){
		$pay = new ppplusLive;
		return $app->json($execute = $pay->execute($request->query->get('exeUrl'),$request->query->get('token'),$request->query->get('payer_id')));
	}

}
?>