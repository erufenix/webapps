<?php
namespace Controller\aippi;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;


class AippiController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index
			->get('/{lang}','Controller\aippi\AippiController::index')
			->bind('aippi.index')
			->assert('lang', '\w+')->value('lang', 'en');
		$index->post('/setregistro','Controller\aippi\AippiController::setRegistro')->bind('aippi.setRegistro');
		$index
			->get('/checkout/{lang}','Controller\aippi\AippiController::checkout')
			->bind('aippi.checkout')
			->assert('lang', '\w+')->value('lang', 'en');
		$index->get('/payReturn/{code}','Controller\aippi\AippiController::payReturn')->bind('aippi.payReturn')->assert('code', '\w+')->value('code', 0);
		$index->post('/payComplete/{lang}','Controller\aippi\AippiController::payComplete')
			->bind('aippi.payComplete')
			->assert('lang', '\w+')->value('lang', 'en');
		$index->get('/payCancel/{lang}','Controller\aippi\AippiController::payCancel')
			->bind('aippi.payCancel')
			->assert('lang', '\w+')->value('lang', 'en');
		$index
			->get('/execute/{lang}','Controller\aippi\AippiController::execute')
			->bind('aippi.execute')
			->assert('lang', '\w+')->value('lang', 'en');
		return $index;
	}

	public function index(Request $request, Application $app,$lang) {
		$fn 				= new Functions;
		$host 			= $request->server->get('HTTP_HOST');
		$hostFull 	= sprintf("%s://%s%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME') ,$request->server->get('REQUEST_URI'));
		$hoteles[1] = array(
			'index' 				=> '1',
			'nombre' 				=> "Fiesta Americana Coral Beach",
			'img' 					=> 'fiestaAmericana.jpg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);				
		
		$hoteles[2] = array(
			'index' 				=> '2',
			'nombre' 				=> "Presidente Intercontinental",
			'img' 					=> 'intercontinental-cancun.jpeg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);
		
		$hoteles[3] = array(
			'index' 				=> '3',
			'nombre' 				=> "Hyatt Ziva",
			'img' 					=> 'ziva.jpg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);
		
		$hoteles[4] = array(
			'index' 				=> '4',
			'nombre' 				=> "Krystal Grand",
			'img' 					=> 'KrystalGrand.jpg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);

		$hoteles[5] = array(
			'index' 				=> '5',
			'nombre' 				=> "Krystal",
			'img' 					=> 'kristal.jpg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);		

		$transfer = array(
			'shared' 	=> array(
										'index' => 1,
										'value' => ($host == 'localhost') ? 50 : 50,
										'text' 	=> ($host == 'localhost') ? 'Shared (1 Passenger) – Round Trip ($50.00 USD)' : 'Shared (1 Passenger) – Round Trip ($50.00 USD)' 
										),
			'private' => array(
											'index' => 2,
											'value' => ($host == 'localhost') ? 82 : 82,
											'text' 	=> ($host == 'localhost') ? 'Private (from 1 to 7 Passengers) – Round Trip ($82.00 USD)' : 'Private (from 1 to 7 Passengers) – Round Trip ($82.00 USD)'  
										)
		);


		$msg = array(
								'es' => '', 
								'en' => "<h5 class='text-info'>ARRIVALS:</h5>\n".
												"<h5 class='text-info m-t-5'>SHARE BASIS:</h5>\n".
												"<p class='text-justify'>\n".
												"Traveling with other passengers and most probably making a few stops in other hotels, this service operates until 9 P.M. after this time only <strong>PRIVATE BASIS TRANSFER</strong> is available. <strong>PRIVATE BASIS:</strong> (Price per Vehicle) With capacity up to 6 passengers and operates 24/7.\n".
												"</p>".
												"<h5 class='text-info m-t-10'>DEPARTURES:</h5>\n".
												"<p class='text-justify'>\n".
												"SHARE BASIS service is NOT AVAILABLE for departures, only PRIVATE TRANSFER\n".
												"<p>\n".
												"<p class='text-justify'><strong>\n".
												"For Domestic flights you will be picked up 2 1/2 hours before the flight departure time and for International flights 3 1/2 hours before the flight departure time.\n".
												"</strong><p>\n"																								
								);

		$msgPay = array(
										'es' => '',
										'en' => "<p class='text-justify m-t-10'>\n".
														"Please look for our staff with the AIPPI logo, there will be waiting for you at the Airport and/or Hotel Motor Lobby with a sign with your name. Once you finish the payment procedure, you will receive a confirmation within the next four days.\n".
														"<p>\n".
														"<h5 class='text-info'>OBSERVATIONS</h5>\n".
														"<p class='justify'>\n".
														"The reception of passengers upon arrival will be through the agency area, once finished the flight the van is removed.<br>\n".
														"To pick up at the hotel we will have a maximum tolerance of 15 minutes, once the unit has been used up, the unit is removed.\n".
														"</p>\n".
														"<h5 class='text-info'>CANCELATION CLAUSES</h5>\n".
														"<p class='justify'>\n".
														"For cancellations without charge 48 hrs before.\n".
														"For changes without charge 24 hrs before.\n".
														"For shared transfers in arrivals, we will wait for all the passengers to be complete, with different times and flights to leave to the hotel.\n".
														"</p>\n"
									);



		return $app['twig']->render('pages/aippi/index.twig', array(
			'evento' 				=> '2018 AIPPI World Congress – Cancun',
			'hoteles' 			=> $hoteles,
			'hotelesJson' 	=> json_encode($hoteles),
			'lang' 					=> $lang,
			'transfer' 			=> $transfer,
			'transferJson'	=> json_encode($transfer),
			'msg' 					=> $msg[$lang],
			'msgPay' 				=> $msgPay[$lang],
			'urlReturn'			=> $app['url_generator']->generate("aippi.payReturn"),
			'urlCancel'			=> $app['url_generator']->generate("aippi.index"),
			'hosts' 				=> $host,
			'hostFull' 			=> $hostFull,
			'paises'   			=> $fn->getCountryListArray($lang)
		));		
	}

	public function setRegistro(Request $request, Application $app) {
		$model 		=	$app["aippiModel"];
		$data 		= array();
		$fn 			= new Functions;
		$now   		= new \DateTime('now');
		$code   	= null;
		$reg 			= null;
		$pais 		= (empty($request->request->get('country'))) ? '' : $fn->getCountry($request->request->get('country'),'countryName',$lang = 'es')['content']; 
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		if($request->request->get('departure_persons') == 0){
			$request->request->set('departure_airline','');
			$request->request->set('departure_fly','');
			$request->request->set('departure_rate',0.00);
			$request->request->set('departure_date',NULL);
			$request->request->set('departure_time',NULL);
		}		
		$request->request->set('arrive_date',$fn->d2b($request->request->get('arrive_date')));
		$request->request->set('arrive_time',$fn->t2b($request->request->get('arrive_time')));
		$request->request->set('departure_date',$fn->d2b($request->request->get('departure_date')));
		$request->request->set('departure_time',$fn->t2b($request->request->get('departure_time')));
		$request->request->set('code',$fn->token(6,'AIPPI_'));
		$request->request->set('register_date',$now);
		$request->request->set('country',$pais);

		$reg 			= $model->setregistro($request->request);
		$data = $app["serializer"]->toArray($reg);
		if(!empty($data)){
			$mail 		= \Swift_Message::newInstance();
			$mail_cli	= \Swift_Message::newInstance();

			$mail
				->setTo("erubi@tycgroup.com",'Edgar Rubi')
				->setBcc(array(
						//"mflores@tycgroup.com" => "Mónica Flores",
						//"angelica@tcevents.com" => "Angelica García"
				))
				->setFrom('no--reply@sin-tcevents.mx','Transporte')
				->setSubject('Transportation AIPPI 2018');
				$body = $app['twig']->render('pages/aippi/mail.twig', array(
					"data"			=> $data,
					"hotelImg" 	=> $request->request->get('hotelImg')			
				)
			);
			$mail->setBody($body, "text/html");

			$mail_cli
				->setTo($request->request->get('email'),$request->request->get('name'))
				->setBcc(array(
						"erubi@tycgroup.com" => "Edgar Rubi"
						//"mflores@tycgroup.com" => "Mónica Flores",
						//"angelica@tcevents.com" => "Angelica García"
				))
				->setFrom('no--reply@sin-tcevents.mx','Transporte')
				->setSubject('Transportation AIPPI 2018');
				$body = $app['twig']->render('pages/aippi/mail_cli.twig', array(
					"data"			=> $data,
					"hotelImg" 	=> $request->request->get('hotelImg')		
				)
			);
			$mail_cli->setBody($body, "text/html");


			$env = $app['mailer']->send($mail);
			$env_cli = $app['mailer']->send($mail_cli);


			$json   	= array(
				'status' 			=> true,
				'msg' 				=> '',
				'data' 				=> $data,
				'urlChekout' 	=> $request->request->get('urlCheckOut'),
				'urlExecute' 	=> $request->request->get('urlExecute'),
				'urlComplete' => $request->request->get('urlComplete')
			);			
		}
		return $app->json($json);
	}

		

	public function payReturn(Request $request, Application $app,$code){
		$query 			= $request->query;
		$host 			= $request->server->get('HTTP_HOST');
		$model 			=	$app["aippiModel"];

		$mail_cli_f	= \Swift_Message::newInstance();

		$transfer = array(
			'shared' 	=> array(
										'index' => 1,
										'value' => ($host == 'localhost') ? 50 : 50,
										'text' 	=> ($host == 'localhost') ? 'Shared (1 Passenger) – Round Trip ($50.00 USD)' : 'Shared (1 Passenger) – Round Trip ($50.00 USD)' 
										),
			'private' => array(
											'index' => 2,
											'value' => ($host == 'localhost') ? 82 : 82,
											'text' 	=> ($host == 'localhost') ? 'Private (from 1 to 7 Passengers) – Round Trip ($82.00 USD)' : 'Private (from 1 to 7 Passengers) – Round Trip ($82.00 USD)'  
										)
		);
		$qry 	= $app["serializer"]->toArray($query);
		if(!empty($qry['parameters']) && $qry['parameters']['st'] == 'Completed'){
			$data = $app["serializer"]->toArray($model->getTransport($code,$qry['parameters']['st'],$qry['parameters']['tx']));
			$mail_cli_f
				->setTo($data['email'],$data['name'])
				->setBcc(array(
						"erubi@tycgroup.com" => "Edgar Rubi"
						//"mflores@tycgroup.com" => "Mónica Flores",
						//"angelica@tcevents.com" => "Angelica García"
				))
				->setFrom('no--reply@sin-tcevents.mx','Transporte')
				->setSubject('Transportation AIPPI 2018 Completed');
				$body = $app['twig']->render('pages/aippi/mail_cli_final.twig', array(
					"data"			=> $data,
					"hotelImg" 	=> $request->request->get('hotelImg')	
				)
			);
			$mail_cli_f->setBody($body, "text/html");			
			$env_cli_f = $app['mailer']->send($mail_cli_f);
		}
		return $app['twig']->render('pages/aippi/complete.twig', array(
				'atransfer' 	=> $transfer,
				'data' 				=> $data,
				'hosts'				=> $host
		));		
	}

	public function checkout(Request $request, Application $app,$lang){
		$approvalUrl	= array();
		$transport 		= array();
		$model 				=	$app["aippiModel"];
		$id 					= $request->query->get('id');
		$payData 			= array();
		$lang 				= 'en_US';
		$urls 				= array();
		$settings = array(
				'mode' 			=> 'sandbox',
				'clientID' 	=> array(
													'sandbox' => 'ATRlwj29eLlkCfnbXcVnuBxmKyISuUzZCTIhCFc-tyo_8ucLxAtdABEyMseGGelDD1mrXNJca938JePw',
													'live' 		=> 'AX4F5-EOloUwKXnhgNGcMigiFrwVUUbF3kaVHJgk5dDY-5JRf7glVyq2f8psi0QXCLSSYp-aKxM7PS2A'
												),
				'secret' 		=> array(
													'sandbox' => 'EAhILjAqrzGkp63Woew2l9H73mphTLpPyChr_opX_ADnWX6uaJbYj-QfRazOmozNQrk0_ubKr8LaTo7U',
													'live' 		=> 'EE8KjGC0PCt-Nz7hpGE_sYKVDIogwqILyvzaOJLMCYyALKvMSDBmwJUqv_SOnYPjwwrilxfxhgOftLq6'
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
		$ppPlus 		= new ppPlus($settings);
		$transport 	= $app["serializer"]->toArray($model->getTransportId($id));
		$urls 			= array(
										'return' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate('aippi.payComplete')),
										'cancel' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate('aippi.payCancel'))
									);
		$payData = array(
									'currency'					=> 'USD',
									'total' 						=> $transport['total'],
									'subTotal' 					=> $transport['total'],
									'description' 			=> 'AIPPI-'. $transport['transfer'] ."-". $transport['arrive_persons'],
									'name' 							=> $transport['name'],
									'address1' 					=> empty($transport['address']) ? 'Ángel Urraza 625, Del Valle' : $transport['address'],
									'address2' 					=> '',
									'city' 							=> empty($transport['city']) ? 'CDMX' : $transport['city'],
									'country_code' 			=> 'MX',
									'cp' 								=> empty($transport['cp']) ? '0' : $transport['cp'],
									'state' 						=> empty($transport['state']) ? 'CDMX' : $transport['state'],
									'phone' 						=> empty($transport['bphone']) ? $transport['phone'] : $transport['bphone'],
									'item_name' 				=> 'AIPPI Transportation',
									'item_description' 	=> 'AIPPI-'. $transport['transfer'] ."-". $transport['arrive_persons'],
									'item_price' 				=> $transport['total'],
									'item_sku' 					=> $transport['code'],
									'item_currency' 		=> 'USD'
								);
		return $app->json($ppPlus->getApproval($payData,$urls,$lang));
	}

	public function payComplete(Request $request, Application $app,$lang){
		$rqts 			= $app["serializer"]->toArray($request->request)['parameters'];
		$host 			= $request->server->get('HTTP_HOST');
		$model 			=	$app["aippiModel"];
		$mail_cli_f	= \Swift_Message::newInstance();
		$transfer = array(
			'shared' 	=> array(
										'index' => 1,
										'value' => ($host == 'localhost') ? 50 : 50,
										'text' 	=> ($host == 'localhost') ? 'Shared (1 Passenger) – Round Trip ($50.00 USD)' : 'Shared (1 Passenger) – Round Trip ($50.00 USD)' 
										),
			'private' => array(
											'index' => 2,
											'value' => ($host == 'localhost') ? 82 : 82,
											'text' 	=> ($host == 'localhost') ? 'Private (from 1 to 7 Passengers) – Round Trip ($82.00 USD)' : 'Private (from 1 to 7 Passengers) – Round Trip ($82.00 USD)'  
										)
		);
		$data = $app["serializer"]->toArray($model->getTransport($rqts['code'],$rqts['st'],$rqts['tx']));
		$mail_cli_f
			->setTo($data['email'],$data['name'])
			->setBcc(array(
					"erubi@tycgroup.com" => "Edgar Rubi"
					//"mflores@tycgroup.com" => "Mónica Flores",
					//"angelica@tcevents.com" => "Angelica García"
			))
			->setFrom('no--reply@sin-tcevents.mx','Transporte')
			->setSubject('Transportation AIPPI 2018 Completed');
			$body = $app['twig']->render('pages/aippi/mail_cli_final.twig', array(
				"data"			=> $data,
				"hotelImg" 	=> $request->request->get('hotelImg')	
			)
		);
		$mail_cli_f->setBody($body, "text/html");			
		$env_cli_f = $app['mailer']->send($mail_cli_f);
		return $app['twig']->render('pages/aippi/complete.twig', array(
				'atransfer' 	=> $transfer,
				'data' 				=> $data,
				'hosts'				=> $host,
				'home' 				=> $app['url_generator']->generate("aippi.index")
		));										
	}

	public function payCancel(Request $request, Application $app,$lang){
		return true;
	}

	public function execute(Request $request, Application $app,$lang){
		$ppPlus 	= new ppPlus(array());
		$exeUrl 	= $request->query->get('exeUrl');
		$payerId 	= $request->query->get('payer_id');
		$token 		= $request->query->get('token');
		return $app->json($ppPlus->execute($exeUrl,$token,$payerId));
	}
}

?>