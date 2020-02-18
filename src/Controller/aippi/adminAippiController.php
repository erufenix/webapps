<?php
namespace Controller\aippi;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;
use Lib\Functions\ppPlus;

class adminAippiController implements ControllerProviderInterface {
	private $hoteles;
	private $transfer;

	public function __construct(){
		$this->hoteles['Fiesta Americana Coral Beach'] = array(
			'index' 				=> '1',
			'nombre' 				=> "Fiesta Americana Coral Beach",
			'img' 					=> 'fiestaAmericana.jpg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);

		$this->hoteles['Presidente Intercontinental'] = array(
			'index' 				=> '2',
			'nombre' 				=> "Presidente Intercontinental",
			'img' 					=> 'intercontinental-cancun.jpeg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);

		$this->hoteles['Hyatt Ziva'] = array(
			'index' 				=> '3',
			'nombre' 				=> "Hyatt Ziva",
			'img' 					=> 'ziva.jpg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);

		$this->hoteles['Krystal Grand'] = array(
			'index' 				=> '4',
			'nombre' 				=> "Krystal Grand",
			'img' 					=> 'KrystalGrand.jpg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);

		$this->hoteles['Krystal'] = array(
			'index' 				=> '5',
			'nombre' 				=> "Krystal",
			'img' 					=> 'kristal.jpg',
			'agotado' 			=> false,
			'currency'   		=> array('usd'),
			'habitaciones' 	=> 	array(),
		);

		$this->transfer = array(
			'shared' 	=> array(
										'index' => 1,
										'value' => 50,
										'text' 	=> 'Shared (1 Passenger) – Round Trip ($50.00 USD)'
										),
			'private' => array(
											'index' => 2,
											'value' => 82,
											'text' 	=> 'Private (from 1 to 7 Passengers) – Round Trip ($82.00 USD)'
										),
			'private_shuttle' => array(
			                'index' => 3,
			                'value' => 41,
			                'text'  => 'Private shuttle'
			    					)
		);
	}

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index
			->get('/','Controller\aippi\adminAippiController::index')->bind('adminAippi.index');
		$index
			->get('/login','Controller\aippi\adminAippiController::login')->bind('adminAippi.login');
		$index
			->get('/transportation','Controller\aippi\adminAippiController::transportation')->bind('adminAippi.transportation');
		$index
			->get('/tedit/{id}','Controller\aippi\adminAippiController::tedit')
			->bind('adminAippi.tedit')
			->assert('id', '\w+')->value('id', 0);
		$index
			->get('/usuarios','Controller\aippi\adminAippiController::usuarios')->bind('adminAippi.usuarios');
		$index
			->post('/setValue/{id}','Controller\aippi\adminAippiController::setValue')
			->bind('adminAippi.setValue')
			->assert('id', '\w+')->value('id', 0);
		$index
		->get('/setValue_/{id}','Controller\aippi\adminAippiController::setValue_')
		->bind('adminAippi.setValue_')
		->assert('id', '\w+')->value('id', 0);
		$index
			->post('/srefund/{id}','Controller\aippi\adminAippiController::srefund')
			->bind('adminAippi.srefund')
			->assert('id', '\w+')->value('id', 0);
		$index
			->post('/arefund','Controller\aippi\adminAippiController::arefund')->bind('adminAippi.arefund');
		$index
			->post('/sreturn/{id}','Controller\aippi\adminAippiController::sreturn')
			->bind('adminAippi.sreturn')
			->assert('id', '\w+')->value('id', 0);
		$index
			->post('/iReturn','Controller\aippi\adminAippiController::ireturn')->bind('adminAippi.ireturn');
		return $index;
	}

	public function index(Request $request, Application $app) {
		$user = $app["aippiUser"];// $app["serializer"]->toArray($app["aippiUser"]);

		return $app['twig']->render('pages/aippi/admin/index.twig', array(
			'user' 	=> $user
		));
	}

	public function login(Request $request, Application $app) {
		return $app['twig']->render('pages/aippi/admin/login.twig', array(
			"error" => $app["security.last_error"]($request),
			"last_username" => $app["session"]->get("_security.last_username")
		));
	}

	public function transportation(Request $request, Application $app) {
		$user = $app["aippiUser"];
		return $app['twig']->render('pages/aippi/admin/trans.twig', array(
			'trp' 			=> $this->getTprAllTable($app),
			'user' 			=> $user,
			'urlRefund'  => $app['url_generator']->generate('adminAippi.srefund'),
			'urlReturn'  => $app['url_generator']->generate('adminAippi.sreturn')
		));
	}

	public function usuarios(Request $request, Application $app) {
		return $app['twig']->render('pages/aippi/admin/users.twig', array(
		));
	}


	public function getTprAllTable($app){
		$model 		=	$app["aippiModel"];
		$all 			= $app["serializer"]->toArray($model->getTransportAllCompleted());
		return $all;
	}

	public function tedit(Request $request, Application $app,$id){
		$model 		=	$app["aippiModel"];
		$data 		= $model->getTransportId($id);
		$user 		= $app["aippiUser"];
		return $app['twig']->render('pages/aippi/admin/tdata.twig', array(
			'data'   				=> $app["serializer"]->toArray($data),
			'hoteles' 			=> $this->hoteles,
			'hotelesJson' 	=> json_encode($this->hoteles),
			'transfer' 			=> $this->transfer,
			'transferJson' 	=> json_encode($this->transfer),
			'id' 						=> $id,
			'urlSet' 				=> $app['url_generator']->generate('adminAippi.setValue'),
			'urlSet_' 			=> $app['url_generator']->generate('adminAippi.setValue_'),
			'user' 					=> $user
		));
	}

	public function setValue(Request $request, Application $app,$id){
		$model 		=	$app["aippiModel"];
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
		$model 		=	$app["aippiModel"];
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
		$model 		=	$app["aippiModel"];
		$data 		= $model->getTransportId($request->request->get('id'));
		return $app['twig']->render('pages/aippi/admin/refund.twig', array(
			'data' => $data
		));
	}

	public function sreturn(Request $request, Application $app,$id){
		$model 		=	$app["aippiModel"];
		$data 		= $model->getTransportId($request->request->get('id'));
		return $app['twig']->render('pages/aippi/admin/return.twig', array(
			'data' => $data
		));
	}


	public function arefund(Request $request, Application $app,$id){
		$lang 				= 'en_US';
		$urls 				= array();
		$response 		= array();
		$st 					= null;
		$model 		=	$app["aippiModel"];
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
		$model 		=	$app["aippiModel"];
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
						"lcazares@tycgroup.com" => "Luis Cazares"
				))
				->setFrom('no--reply@sin-tcevents.mx','AIPPI Transport')
				->setSubject('AIPPI Transport to Airport');
			$body = $app['twig']->render('pages/aippi/admin/amail.twig', array(
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
