<?php
namespace Controller\transportCMI;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;


class transportCMIController implements ControllerProviderInterface {
	private $hoteles;
	private $transfer;

	public function __construct(){

		$this->hoteles[1] = array(
			'index' 				=> '1',
			'nombre' 				=> "Hotel Camino Real Polanco",
			'img' 					=> 'CR_Polanco.jpg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);
		
		$this->transfer = array(
			'shared_one_way' 	=> array(
													'index' => 1,
													'value' => 19.50,
													'text' 	=> '$19.50 USD. SHARED TRANSPORTATION "SHUTTLE" AIRPORT-HOTEL (1 PASSENGER) SINGLE RATE, ONE WAY',
													'type'  => 'shared',
													'round' => false
			),
			'shared_round' => array(
													'index' => 2,
													'value' => 40.00,
													'text' 	=> '$40.00 USD. SHARED TRANSPORTATION "SHUTTLE" AIRPORT-HOTEL-AIRPORT (1 PASSENGER) SINGLE RATE, ROUND SERVICE',
													'type'  => 'shared',
													'round' => true
			),
			'private_one_way' => array(
			                		'index' => 3,
			                		'value' => 66.00,
													'text'  => '$66.00 USD. PRIVATE TRANSPORTATION AIRPORT-HOTEL (UP TO 6 PASSENGERS) RATE PER UNIT, ONE WAY',
													'type'  => 'private',
													'round' => false												
			),
			'private_round' => array(
													'index' => 4,
													'value' => 135.00,
													'text'  => '$135.00 USD. PRIVATE TRANSPORTATION AIRPORT-HOTEL-AIRPORT (UP TO 6 PASSENGERS) RATE PER UNIT, ROUND SERVICE',
													'type'  => 'private',
													'round' => true												
			)			
		);	
		
	}

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index
			->match('/{lang}','Controller\transportCMI\transportCMIController::index')
			->bind('transportCMI.index')
			->assert('lang', '\w+')->value('lang', 'en');
		$index->post('/setregistro/','Controller\transportCMI\transportCMIController::setRegistro')->bind('transportCMI.setRegistro');
		$index
			->get('/checkout/{lang}','Controller\transportCMI\transportCMIController::checkout')
			->bind('transportCMI.checkout')
			->assert('lang', '\w+')->value('lang', 'en');
		$index->get('/payReturn/{code}','Controller\transportCMI\transportCMIController::payReturn')->bind('transportCMI.payReturn')->assert('code', '\w+')->value('code', 0);
		$index->post('/payComplete/{lang}','Controller\transportCMI\transportCMIController::payComplete')
			->bind('transportCMI.payComplete')
			->assert('lang', '\w+')->value('lang', 'en');
		$index->get('/payCancel/{lang}','Controller\transportCMI\transportCMIController::payCancel')
			->bind('transportCMI.payCancel')
			->assert('lang', '\w+')->value('lang', 'en');
		$index
			->get('/execute/{lang}','Controller\transportCMI\transportCMIController::execute')
			->bind('transportCMI.execute')
			->assert('lang', '\w+')->value('lang', 'en');
		return $index;
	}

	public function index(Request $request, Application $app,$lang) {
		$fn 				= new Functions;
		$host 			= $request->server->get('HTTP_HOST');
		$hostFull 	= sprintf("%s://%s%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME') ,$request->server->get('REQUEST_URI'));
			
		$msg = array(
								'es' => '', 
								'en' => "<h4 class='text-danger'>IMPORTANT NOTES:</h4>\n".
												"<p class='text-justify bold_semi_bold'>\n".
												"Service limited only for Camino Real Hotel".
												"</p>".
												"<h4 class='text-danger m-t-10'>CHANGES AND CANCELLATIONS</h4>\n".
												"<p class='text-justify bold_semi_bold'>\n".
												"All changes or cancellations must be sent in writing until September 20th, 2019 no charges. After September 20th no refunds will be possible<br>".
												"Any schedule changes must be sent in writing before September 20th to caguirre@tycgroup.com<br>".
												"No-shows will not be refunded<br>".
												"<p>\n".
												"<h4 class='text-danger'>IMPORTANT NOTES:</h4>\n".
												"<p class='text-justify bold_semi_bold'>\n".
												"All payments are per person<br>".
												"At your arrival you must wait for all the passengers schedules to board the unit, this could take no longer than an hour<br>".
												"The pick up at the hotel will wait maximum 15 minutes after the schedule time<br>".
												"<p>\n"																	
								);



		return $app['twig']->render('pages/transportCMI/index.twig', array(
			'evento' 				=> 'CMI and Mexican MLA Colloquium 2019',
			'hoteles' 			=> $this->hoteles,
			'hotelesJson' 	=> json_encode($this->hoteles),
			'lang' 					=> $lang,
			'transfer' 			=> $this->transfer,
			'transferJson'	=> json_encode($this->transfer),
			'msg' 					=> $msg[$lang],
			'urlReturn'			=> $app['url_generator']->generate("transportCMI.payReturn"),
			'urlCancel'			=> $app['url_generator']->generate("transportCMI.index"),
			'hosts' 				=> $host,
			'hostFull' 			=> $hostFull,
			'paises'   			=> $fn->getCountryListArray($lang),
			'rqst' 					=> $request->request->All(),
			'qry' 					=> $request->query->All()
		));		
	}

	public function setRegistro(Request $request, Application $app) {
		$model 		=	$app["transportCMIModel"];
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
		$request->request->set('code',$fn->token(6,'transportCMI_'));
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
						"dveytia@tycgroup.com" => "Daniela Veytia",
						"caguirre@tcevents.com" => "Carlos Aguirre"
				))
				->setFrom('no--reply@sin-tcevents.mx','CMI 2019 Transportation')
				->setSubject('CMI and Mexican MLA Colloquium 2019 Transportation');
				$body = $app['twig']->render('pages/transportCMI/mail.twig', array(
					"data"			=> $data,
					"hotelImg" 	=> $request->request->get('hotelImg')			
				)
			);
			$mail->setBody($body, "text/html");

			$mail_cli
				->setTo($request->request->get('email'),$request->request->get('name'))
				->setBcc(array(
						"erubi@tycgroup.com" => "Edgar Rubi",
						"dveytia@tycgroup.com" => "Daniela Veytia",
						"caguirre@tcevents.com" => "Carlos Aguirre"
				))
				->setFrom('no--reply@sin-tcevents.mx','CMI 2019 Transportation')
				->setSubject('CMI and Mexican MLA Colloquium 2019 Transportation');
				$body = $app['twig']->render('pages/transportCMI/mail_cli.twig', array(
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
		$model 			=	$app["transportCMIModel"];

		$mail_cli_f	= \Swift_Message::newInstance();

		/*$transfer = array(
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
		);*/
		$this->transfer;
		$qry 	= $app["serializer"]->toArray($query);
		if(!empty($qry['parameters']) && $qry['parameters']['st'] == 'Completed'){
			$data = $app["serializer"]->toArray($model->getTransport($code,$qry['parameters']['st'],$qry['parameters']['tx']));
			$mail_cli_f
				->setTo($data['email'],$data['name'])
				->setBcc(array(
						"erubi@tycgroup.com" => "Edgar Rubi",
						"dveytia@tycgroup.com" => "Daniela Veytia",
						"caguirre@tcevents.com" => "Carlos Aguirre"
				))
				->setFrom('no--reply@sin-tcevents.mx','CMI 2019 Transportation')
				->setSubject('CMI and Mexican MLA Colloquium 2019 Transportation Completed');
				$body = $app['twig']->render('pages/transportCMI/mail_cli_final.twig', array(
					"data"			=> $data,
					"hotelImg" 	=> $request->request->get('hotelImg')	
				)
			);
			$mail_cli_f->setBody($body, "text/html");			
			$env_cli_f = $app['mailer']->send($mail_cli_f);
		}
		return $app['twig']->render('pages/transportCMI/complete.twig', array(
				'atransfer' 	=> $this->transfer,
				'data' 				=> $data,
				'hosts'				=> $host
		));		
	}

	public function checkout(Request $request, Application $app,$lang){
		$approvalUrl	= array();
		$transportCMI 		= array();
		$model 				=	$app["transportCMIModel"];
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
													'nameProfile' => 'TransportTyC_' . uniqid(),
													'logoImage' 	=> 'https://webapps.tycgroup.com/assets/img/logoTyC50.png',
													'shipping' 		=> 1,
													'address' 		=> 1,
													'landingPage' => 'billing',
													'bank' 				=> 'https://www.paypal.com'
												)
		);
		$ppPlus 		= new ppPlus($settings);
		$transportCMI 	= $app["serializer"]->toArray($model->getTransportId($id));
		$urls 			= array(
										'return' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate('transportCMI.payComplete')),
										'cancel' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate('transportCMI.payCancel'))
									);
		$payData = array(
									'currency'					=> 'USD',
									'total' 						=> $transportCMI['total'],
									'subTotal' 					=> $transportCMI['total'],
									'description' 			=> 'transportCMI-'. $transportCMI['transfer'] ."-". $transportCMI['arrive_persons'],
									'name' 							=> $transportCMI['name'],
									'address1' 					=> empty($transportCMI['address']) ? 'Ángel Urraza 625, Del Valle' : $transportCMI['address'],
									'address2' 					=> '',
									'city' 							=> empty($transportCMI['city']) ? 'CDMX' : $transportCMI['city'],
									'country_code' 			=> 'MX',
									'cp' 								=> empty($transportCMI['cp']) ? '0' : $transportCMI['cp'],
									'state' 						=> empty($transportCMI['state']) ? 'CDMX' : $transportCMI['state'],
									'phone' 						=> empty($transportCMI['bphone']) ? $transportCMI['phone'] : $transportCMI['bphone'],
									'item_name' 				=> 'CMI 2019 transportation',
									'item_description' 	=> 'CMI Transposrt-'. $transportCMI['transfer'] ."-". $transportCMI['arrive_persons'],
									'item_price' 				=> $transportCMI['total'],
									'item_sku' 					=> $transportCMI['code'],
									'item_currency' 		=> 'USD'
								);
		return $app->json($ppPlus->getApproval($payData,$urls,$lang));
	}

	public function payComplete(Request $request, Application $app,$lang){
		$rqts 			= $app["serializer"]->toArray($request->request)['parameters'];
		$host 			= $request->server->get('HTTP_HOST');
		$model 			=	$app["transportCMIModel"];
		$mail_cli_f	= \Swift_Message::newInstance();
		/*$transfer = array(
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
		);*/
		$transfer = $this->transfer;
		$data = $app["serializer"]->toArray($model->getTransport($rqts['code'],$rqts['st'],$rqts['tx']));
		$mail_cli_f
			->setTo($data['email'],$data['name'])
			->setBcc(array(
					"erubi@tycgroup.com" => "Edgar Rubi",
				    "dveytia@tycgroup.com" => "Daniela Veytia",
					"caguirre@tcevents.com" => "Carlos Aguirre"
			))
			->setFrom('no--reply@sin-tcevents.mx','CMI 2019 Transportation')
			->setSubject('CMI and Mexican MLA Colloquium 2019 Transportation Completed');
			$body = $app['twig']->render('pages/transportCMI/mail_cli_final.twig', array(
				"data"			=> $data,
				"hotelImg" 	=> $request->request->get('hotelImg')	
			)
		);
		$mail_cli_f->setBody($body, "text/html");			
		$env_cli_f = $app['mailer']->send($mail_cli_f);
		return $app['twig']->render('pages/transportCMI/complete.twig', array(
				'atransfer' 	=> $transfer,
				'data' 				=> $data,
				'hosts'				=> $host,
				'home' 				=> $app['url_generator']->generate("transportCMI.index")
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