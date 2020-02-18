<?php
namespace Controller\transportCMI;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;
use Lib\Functions\ppPlus;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class adminCMIController implements ControllerProviderInterface {

	private $hoteles;
	private $transfer;
	private $tokenCMI;

	public function __construct(){

		$this->hoteles['Hotel Camino Real Polanco'] = array(
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
			->get('/','Controller\transportCMI\adminCMIController::index')->bind('adminCMI.index');
		$index
			->get('/login','Controller\transportCMI\adminCMIController::login')->bind('adminCMI.login');
		$index
			->get('/transportation','Controller\transportCMI\adminCMIController::transportation')->bind('adminCMI.transportation');
		$index
			->get('/participantes','Controller\transportCMI\adminCMIController::participantes')->bind('adminCMI.participantes');
		$index
			->get('/getParticipantes','Controller\transportCMI\adminCMIController::getParticipantesCMI')->bind('adminCMI.getParticipantesCMI');						
		$index
			->get('/tedit/{id}','Controller\transportCMI\adminCMIController::tedit')
			->bind('adminCMI.tedit')
			->assert('id', '\w+')->value('id', 0);
		$index
			->get('/usuarios','Controller\transportCMI\adminCMIController::usuarios')->bind('adminCMI.usuarios');
		$index
			->post('/setValue/{id}','Controller\transportCMI\adminCMIController::setValue')
			->bind('adminCMI.setValue')
			->assert('id', '\w+')->value('id', 0);
		$index
		->get('/setValue_/{id}','Controller\transportCMI\adminCMIController::setValue_')
		->bind('adminCMI.setValue_')
		->assert('id', '\w+')->value('id', 0);
		$index
			->post('/srefund/{id}','Controller\transportCMI\adminCMIController::srefund')
			->bind('adminCMI.srefund')
			->assert('id', '\w+')->value('id', 0);
		$index
			->post('/arefund','Controller\transportCMI\adminCMIController::arefund')->bind('adminCMI.arefund');
		$index
			->post('/sreturn/{id}','Controller\transportCMI\adminCMIController::sreturn')
			->bind('adminCMI.sreturn')
			->assert('id', '\w+')->value('id', 0);
		$index
			->post('/iReturn','Controller\transportCMI\adminCMIController::ireturn')->bind('adminCMI.ireturn');
		return $index;
  }
  
	public function index(Request $request, Application $app) {
		$user = $app["cmiUser"];

		return $app['twig']->render('pages/transportCMI/admin/index.twig', array(
      'user' 	=> $user     
		));
	}

	public function login(Request $request, Application $app) {
		return $app['twig']->render('pages/transportCMI/admin/login.twig', array(
			"error" => $app["security.last_error"]($request),
			"last_username" => $app["session"]->get("_security.last_username")
		));
  }
	
	private function getTokenCMI(){
		$this->tokenCMI 	= '';
		$client = new Client([
			'headers' => [ 
				'Content-Type'	=> 'application/x-www-form-urlencoded'
			]			
		]);

		$body = array(
						'usr' 	=> 'tyc',
						'pas' 	=> '4y53:KzKET' 
					);
	
		$response = $client->get("http://www.cmi2019mexico.org/auth/auth.php?key=true",[
				'body' => json_encode($body)
			]
		);
		
		if($response->getStatusCode()){
			$this->tokenCMI = json_decode($response->getBody()->getContents(),true)[id_token];
		};
		return $this->tokenCMI;		
	}

	public function getParticipantesCMI(Request $request, Application $app){
		$token = $this->getTokenCMI();
		$participantes = array();
		$client = new Client([
			'headers' => [
				"Authorization" => "bearer " . $token,
				"Content-Type"	=> "application/json"
			]			
		]);

		try{
			$response = $client->get("http://www.cmi2019mexico.org/tyc/?t=gu",
				[
					'body' => '{}'
				]
			);

			if($response->getStatusCode()){
				$participantes = json_decode($response->getBody()->getContents(),true);
			}
		}
		catch (RequestException $e) {
			if ($e->hasResponse()) {
				$participantes = json_decode($e->getResponse()->getBody()->getContents(),true);
	    }	
		}
		return $app->json($participantes);			
	}

	public function participantes(Request $request, Application $app){
		$user = $app["cmiUser"];
		return $app['twig']->render('pages/transportCMI/admin/participantes.twig', array(
			'user' 			=> $user
		));		
	}

	public function transportation(Request $request, Application $app) {
		$user = $app["cmiUser"];
		return $app['twig']->render('pages/transportCMI/admin/trans.twig', array(
			'trp' 			=> $this->getTprAllTable($app),
			'user' 			=> $user,
			'urlRefund'  => $app['url_generator']->generate('adminCMI.srefund'),
			'urlReturn'  => $app['url_generator']->generate('adminCMI.sreturn')
		));
	}

	public function usuarios(Request $request, Application $app) {
		return $app['twig']->render('pages/transportCMI/admin/users.twig', array(
		));
	}


	public function getTprAllTable($app){
		$model 		=	$app["transportCMIModel"];
		$all 			= $app["serializer"]->toArray($model->getTransportAllCompleted());
		return $all;
	}  

	public function tedit(Request $request, Application $app,$id){
		$model 		=	$app["transportCMIModel"];
		$data 		= $model->getTransportId($id);
		$user 		= $app["cmiUser"];
		return $app['twig']->render('pages/transportCMI/admin/tdata.twig', array(
			'data'   				=> $app["serializer"]->toArray($data),
			'hoteles' 			=> $this->hoteles,
			'hotelesJson' 	=> json_encode($this->hoteles),
			'transfer' 			=> $this->transfer,
			'transferJson' 	=> json_encode($this->transfer),
			'id' 						=> $id,
			'urlSet' 				=> $app['url_generator']->generate('adminCMI.setValue'),
			'urlSet_' 			=> $app['url_generator']->generate('adminCMI.setValue_'),
			'user' 					=> $user
		));
  }
  
	public function setValue(Request $request, Application $app,$id){
		$model 		=	$app["transportCMIModel"];
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		if($model->setValue($request->request->get('name'),$request->request->get('value'),$id)){
			$json   	= array(
				'status' => true,
				'msg' 	=> '',
				'data' 	=> $request->request->all()
			);
		}
		return $app->json($json);
	}

	public function setValue_(Request $request, Application $app,$id){
		$model 		=	$app["transportCMIModel"];
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		if($model->setValue($request->query->get('name'),$request->query->get('value'),$id)){
			$json   	= array(
				'status' => true,
				'msg' 	=> '',
				'data' 	=> $request->query->all()
			);
		}
		return $app->json($json);
	}

	public function srefund(Request $request, Application $app,$id){
		$model 		=	$app["transportCMIModel"];
		$data 		= $model->getTransportId($request->request->get('id'));
		return $app['twig']->render('pages/transportCMI/admin/refund.twig', array(
			'data' => $data
		));
	}

	public function sreturn(Request $request, Application $app,$id){
		$model 		=	$app["transportCMIModel"];
		$data 		= $model->getTransportId($request->request->get('id'));
		return $app['twig']->render('pages/transportCMI/admin/return.twig', array(
			'data' => $data
		));
	}

	public function arefund(Request $request, Application $app,$id){
		$lang 				= 'en_US';
		$urls 				= array();
		$response 		= array();
		$st 					= null;
		$model 		=	$app["transportCMIModel"];
		$status 	= false;
		$data 		= array();
		$errMsg   = '';
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
		$refundData = array(
											'refund'		=> $request->request->get('rfund'),
											'tx' 				=> $request->request->get('tx'),
											'code' 			=> $request->request->get('code'),
											'currency'	=> 'USD',
											'note' 			=> "Refund of " . $request->request->get('rfund') . " for " . $request->request->get('code')
									);
		$response = $ppPlus->applyRefund($refundData,$lang);
		if(!empty($response['content']['state']) && $response['content']['state'] == 'completed'){
			$model->setRefund($response['content']['amount']['total'],$response['content']['id'],$request->request->get('code'));
			$data 	= $response['content'];
			$status = true;
		}
		else{
			$data = $response;
			$status = true;
			$errMsg = 'Bad Request';
		}
		$json  		= array(
											'status' 	=> $status,
											'data' 		=> $data,
											'errMsg'  => $errMsg
								);
		return $app->json($json);
  }
  
	public function ireturn(Request $request, Application $app,$id){
		$model 		=	$app["transportCMIModel"];
		$id       = $request->request->get('id');
		$hour    	= $request->request->get('rRt');
		$amail 		= \Swift_Message::newInstance();
		$status 	= false;
		$data 		= array();
		$Msg   		= '';
		if($id == 0){
		}
		else{
			$bid = $model->getTransportId($id);
			//$abid = $app["serializer"]->toArray($bid);
			$correo = $bid->getEmail();
			$nombre = $bid->getName();
			$amail
				->setTo($correo,$nombre)
				->setBcc(array(
						"erubi@tycgroup.com" => "Edgar Rubi",
						//"lcazares@tycgroup.com" => "Luis Cazares"
				))
				->setFrom('no--reply@sin-tcevents.mx','CMI 2019 Transportation')
				->setSubject('CMI and Mexican MLA Colloquium 2019 Transportation to Airport');
			$body = $app['twig']->render('pages/transportCMI/admin/amail.twig', array(
					"data"	=> $bid,
					"hour" 	=> $hour
				)
			);
			$amail->setBody($body, "text/html");
			try {
				$env = $app['mailer']->send($amail);
				$status 	= true;
				$data 		= $bid;
        $model->setValue('aviso',1,$id);
				$Msg   		= 'Anuncio enviado';
			} catch (Exception $e) {
				$status 	= false;
				$data 		= array();
				$Msg   		= 'Anuncio no enviado';
			}
		}
		$json  		= array(
											'status' 	=> $status,
											'data' 		=> $data,
											'errMsg'  => $Msg
								);
		return $app->json($json);
	}  

}
?>
