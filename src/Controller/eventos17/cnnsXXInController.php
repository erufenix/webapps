<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;


use Lib\Functions\ppplusSandbox as ppplus;

define("CNNSXXI","cnnsXXIn");

class cnnsXXInController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get("/{idHotel}/{currency}/{lang}",sprintf('Controller\eventos17\%sController::index',CNNSXXI))
		->bind(CNNSXXI.".index")
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);		
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',CNNSXXI))->bind(CNNSXXI.".setReservacion");
		$index->get('/confirmacion/{lang}',sprintf('Controller\eventos17\%sController::confirmacion',CNNSXXI))->bind(CNNSXXI.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}',sprintf('Controller\eventos17\%sController::politicas',CNNSXXI))->bind(CNNSXXI.".politicas")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',CNNSXXI))->bind(CNNSXXI.".setReservacion");
		$index->post('/applyPay/{lang}',sprintf('Controller\eventos17\%sController::applyPay',CNNSXXI))->bind(CNNSXXI.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/checkOut/{lang}',sprintf('Controller\eventos17\%sController::checkOut',CNNSXXI))->bind(CNNSXXI.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payReturn/{lang}',sprintf('Controller\eventos17\%sController::payRetrun',CNNSXXI))->bind(CNNSXXI.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payCancel/{lang}',sprintf('Controller\eventos17\%sController::payCancel',CNNSXXI))->bind(CNNSXXI.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/execute/{lang}',sprintf('Controller\eventos17\%sController::execute',CNNSXXI))->bind(CNNSXXI.'.execute')->assert('lang', '\w+')->value('lang', 'es');
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
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'1,476.00',
								'usd'	=>	'0'
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
							'usd'	=>	'0'
							),
						'costor' 	=>  array(
							'mxn'	=>	'2,218.00',
							'usd'	=>	'0'
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
              'usd'	=>	'0'
              ),
            'costor' 	=>  array(
              'mxn'	=>	'2,218.00',
              'usd'	=>	'0'
              ),
            'propinas'	=>	array(
              'mxn'	=>	'40',
              'usd'	=>	'0'
              ),
            'pack' => 0,
            'pp' 		=> 0,
            'hagotada' => false
            ),            
				),
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
                    '<li>Renta de habitación en ocupación sencilla y/o doble por noche, 16% IVA, 2% ISH y propinas a camaristas</li>'.
                    '<li>Se realizará un cargo único de $40.00 MN en habitación sencilla y $80.00 en habitación doble (entrada y salida) por concepto de propina a botones.</li>'.
                    '<li>Tarifas cotizadas en MN</li>'.
                    '</ul>'.
                    '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                    '<ul>'.
                    '<li>Ckeck inn: 03:00 pm. / Ckeck out: 12:00 hrs</li>'.
                    '</ul>'.
                    '',
						'en' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
										'<li>Room for single and / or double occupancy per night, 16% IVA, 2% ISH and tips for maids</li>'.
										'<li>Check Inn 15:00 hrs. / Check Out 12:00 hrs.</li>'.
										'</ul>'
					)
			);

  		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 				=> '',
			'evento' 				=> 'CONGRESO NACIONAL DE NEUROCIRUGIA SIGLO XXI',
			'hoteles' 			=> $hoteles,
			'hotelesJson' 	=> json_encode($hoteles),
			'currency' 			=> $currency,
			'idHotel' 			=> $idHotel,
			'lang' 					=> $lang,
			'paises' 				=> $paises,
			'logo' 					=> array(
											),
			'css_logo'    	=> false,
			'fechas'  			=> array(
													'es' => 'DEL 24 AL 27 DE OCTUBRE 2018',
													'en' => '' 
													),
			'sede'        	=> array(
													'es' => 'SAN MIGUEL DE ALLENDE',
													'en' => '' 
													),
			'claveEvento' 	=> 'CNNSXXI',
			'fechaLleMin'		=> '2018-10-24',
			'fechaLleMax'		=> '2018-10-26',
			'fechaSalMin'		=> '2018-10-25',
			'fechaSalMax'		=> '2018-10-27',
			'noches' 				=> 2,
			'urlIndex'			=> $app['url_generator']->generate(CNNSXXI.".index"),
			'urlReserva'		=> $app['url_generator']->generate(CNNSXXI.".setReservacion"),
			'urlConfirma'		=> $app['url_generator']->generate(CNNSXXI.".confirmacion"),
			'urlApplyPay' 	=> $app['url_generator']->generate(CNNSXXI.".applyPay"),
			'urlChekout'    => $app['url_generator']->generate(CNNSXXI.".checkOut"),
			'urlExecute'    => $app['url_generator']->generate(CNNSXXI.".execute"),
			'rutaImg' 			=> 'cnnsXXI',
			'links'					=> array(
														'es' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(CNNSXXI.".politicas"),
																								'name' 	=> 'Políticas de reservación'
																							),
																'formato'   => array()
																),
														'en' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(CNNSXXI.".politicas"),
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
			'mode' 					=> 'sandbox',
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
		$CNNSXXIRsv 		= time();
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
		$request->request->set('claveReservacion',$CNNSXXIRsv);
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
			$imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/".CNNSXXI."/" . $imgHotel;
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
		$pages = array(
      '' 		=> 'cnnsXXI.politicas.twig.html',
      'es' 	=> 'cnnsXXI.politicas.twig.html',
      'en' 	=> 'cnnsXXI.politicas-en.twig.html',
    );		
    return $app['twig']->render("pages/eventos17/cnnsXXI/" . $pages[$lang], array(
      'data' => $request->query
    ));	
	}

	public function checkOut(Request $request, Application $app,$lang){
		$response = array();
		$pay 			= new ppplus;
		$urls 		= array(
									'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(CNNSXXI.".payReturn"),
									'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(CNNSXXI.".payCancel")
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
