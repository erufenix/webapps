<?php
namespace Controller\Reservas;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Entity\ReservasEvento;
use Entity\ReservasUsuario;
use Entity\ReservasHotel;
use Entity\ReservasOperadores;
use Entity\ReservasEventoIdioma;

class reservaPanelController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$panel = $app['controllers_factory'];
		$panel->get('/','Controller\Reservas\reservaPanelController::index')->bind('reserva.panel.index');
		$panel->get('/login', 'Controller\Reservas\reservaPanelController::login')->bind("reserva.panel.login");
		$panel->match('/addEvento','Controller\Reservas\reservaPanelController::addEvent')->bind('reserva.panel.addEvent');
		$panel->post('/frmEvento/{idEvento}','Controller\Reservas\reservaPanelController::setEvent')->bind('panel.setEvent')->assert('idEvento', '\d+')->value('idEvento', 0);
		$panel->get('/evento/{cveEvento}','Controller\Reservas\reservaPanelController::amdEvento')->bind('reserva.panel.evento')->value('cveEvento', '');
		$panel->match('/addHotel/{cveEvento}/{idHotel}','Controller\Reservas\reservaPanelController::addHotel')->bind('panel.addHotel')->value('cveEvento', '')->value('idHotel',0);
		$panel->post('/frmHotel/{idHotel}','Controller\Reservas\reservaPanelController::setHotel')->bind('panel.setHotel')->assert('idHotel', '\d+')->value('idHotel', 0);
		$panel->post('/upFile','Controller\Reservas\reservaPanelController::upFile')->bind('panel.upFile');
		$panel->get('/hoteles/{idEvento}','Controller\Reservas\reservaPanelController::getHoteles')->bind('panel.hoteles')->assert('idEvento', '\d+')->value('idEvento', 0);
		return $panel;
	}

	public function index(Request $request, Application $app) {
		$em 			= $app['orm.ems']['reservas'];
		$model 		= $app["rsvPanelModel"];
		$user     = $model->getUser();
		$idUser 	= $user->getIdUsuario();
		$eventos  = array(); 
		if ($app['security.authorization_checker']->isGranted('ROLE_ADMIN')) {
			//$eventos 	= $em->getRepository('Entity\ReservasEvento')->findByIdUsuario($idUser);
			$eventos =  $model->getEventos($idUser);
		}
		elseif($app['security.authorization_checker']->isGranted('ROLE_SUPER_ADMIN')) {
			//$eventos 	= $em->getRepository('Entity\ReservasEvento')->findAll();
		}
		return $app['twig']->render('pages/reservas/panel/index.twig.html', array(
			'user' 			=> $user,
			'pageTitle' => 'Eventos',
			'eventos' 	=> $eventos
		));
	}

	public function login(Application $app, Request $request) {
		return $app["twig"]->render("pages/reservas/panel/login.twig.html", array(
			"error" => $app["security.last_error"]($request),
			"last_username" => $app["session"]->get("_security.last_username")
		));
	}

	public function addEvent(Request $request, Application $app) {
		$em 				= $app['orm.ems']['reservas'];
		$model 		= $app["rsvPanelModel"];
		$user     = $model->getUser();
		$operadores = $em->getRepository('Entity\ReservasOperadores')->findBy(array(),array('nombreOperador' => 'ASC'));
		return $app['twig']->render('pages/reservas/panel/addEvent.twig.html', array(
			'user' 				=> $user,
			'operadores' 	=> $operadores
		));
	}	

	public function setEvent(Request $request, Application $app,$idEvento) {
		$em 					= $app['orm.ems']['reservas'];
		$evento 			= null;
		$claveEvento 	= '';
		$formaPago   	= array();
		$responseJson = array(
			'status' 	=> false,
			'message'	=> '',
			'data' 		=> array()
		);
		if($idEvento ==0){
			$evento = new ReservasEvento;
		}
		else{
			$evento = $em->getRepository('Entity\ReservasEvento')->findOneByIdEvento($idEvento);
		}
		if($evento){
			$claveEvento 	= trim($request->request->get('claveEvento'));
			$formaPago  	= implode(',',$request->request->get('formaPago'));
			$fn 					= new Functions;
			$entyUser 		= $em->getRepository('Entity\ReservasUsuarios')->findOneByIdUsuario($request->request->get('idUsuario'));
			$entyOpe 			= $em->getRepository('Entity\ReservasOperadores')->findOneByIdOperador($request->request->get('idOperador'));
			$evento
				->setClaveEvento($claveEvento)
				->setFechaEventoInicio($fn->d2b($request->request->get('fechaEventoInicio')))
				->setFechaEventoFin($fn->d2b($request->request->get('fechaEventoFin')))
				->setFormaPago($formaPago)
				->setIdOperador($entyOpe)
				->setIdUsuario($entyUser);
			try {
				$em->persist($evento);
				$em->flush();
				$idEvento = $evento->getIdEvento();
				$data['evento'] 	= $app["serializer"]->toArray($evento);
				$entyEvento = $em->getRepository('Entity\ReservasEvento')->findOneByIdEvento($idEvento);
				$evelang = new ReservasEventoIdioma;
				try{
					$evelang
						->setIdioma($request->request->get('idioma'))
					  ->setNombreEvento($request->request->get('nombreEvento'))
				    ->setSedeEvento($request->request->get('sedeEvento'))
				    ->setIdEvento($entyEvento);
					$em->persist($evelang);
					$em->flush();
					$data['eventoIdioma'] 	= $app["serializer"]->toArray($evelang);			    
				}
			 	catch (\Exception $e) {
			 		echo $e;
				}				
				$responseJson = array(
					'status'  	=> true,
					'data'    	=> $data,
					'message' 	=> "Se agrego el evento corectamente",
					'url'     	=> $app['url_generator']->generate('reserva.panel.index')
				);
			}
			 catch (\Exception $e) {
			 	echo $e;
			}	
		}
		return $app->json($responseJson);
	}

	public function amdEvento(Request $request, Application $app,$cveEvento){
		$em 			= $app['orm.ems']['reservas'];
		$model 		= $app["rsvPanelModel"];
		$user     = $model->getUser();
		$evento 	= $model->getEvento($cveEvento);
		$idEvento = $evento[0]['eve_idEvento'];
		$langs    = $em->getRepository('Entity\ReservasEventoIdioma')->findByIdEvento($idEvento);
		return $app['twig']->render('pages/reservas/panel/evento.twig.html', array(
			'user' 			=> $user,
			'pageTitle' => $evento[0]['l_nombreEvento'],
			'sede' 			=> $evento[0]['l_sedeEvento'],
			'fechai' 		=> $evento[0]['eve_fechaEventoInicio'],
			'fechaf' 		=> $evento[0]['eve_fechaEventoFin'],
			'langs' 		=> $langs,
			'evento' 		=> $evento
		));
	}

	public function addHotel(Request $request, Application $app, $cveEvento,$idHotel) {
		$em 			= $app['orm.ems']['reservas'];
		$model 		= $app["rsvPanelModel"];
		$evento 	= $model->getEvento($cveEvento);		
		return $app['twig']->render('pages/reservas/panel/addHotel.twig.html', array(
			'evento' 	=> $evento,
			'idHotel' => $idHotel 
		));
	}

	public function setHotel(Request $request, Application $app,$idHotel) {
		$em 					= $app['orm.ems']['reservas'];
		$responseJson = array(
			'status' 	=> false,
			'message'	=> '',
			'data' 		=> array()
		);
		if($idHotel == 0){
			$ht = new ReservasHotel;
		}
		else{
			$ht = $em->getRepository('Entity\ReservasHotel')->findOneByIdEvento($idHotel);
		}
		if($ht){
			$entyEvento = $em->getRepository('Entity\ReservasEvento')->findOneByIdEvento($request->request->get('idEvento'));
			try{
				$ht
					->setNombreHotel($request->request->get('nombreHotel'))
				  ->setFotoHotel($request->request->get('nFile'))
			    ->setIdEvento($entyEvento);
				$em->persist($ht);
				$em->flush();
				$responseJson = array(
					'status' 	=> true,
					'message'	=> '',
					'data' 		=> $app["serializer"]->toArray($ht),
					'url'     => $app['url_generator']->generate('reserva.panel.evento')."/".$entyEvento->getClaveEvento()
				);				
			}
		 	catch (\Exception $e) {
		 		echo $e;
			}				
		}
		return $app->json($responseJson);
	}	

	public function upFile(Request $request, Application $app) {
		$cve  = $request->request->get('cve');
 		$file = $request->files->get('qqfile');
   	$responseJson = array("success"=>false,"fileUploaded" => false);
		if(!is_null($file)){
      // generate a random name for the file but keep the extension
      $filename = uniqid().".".$file->getClientOriginalExtension();
      $path = getcwd() .  "/assets/files/reservas/hoteles/". $cve ."/";
      if(!file_exists($path)){
      	mkdir($path, 0700);
    	}
      $file->move($path,$filename); // move the file to a path
      $responseJson = array("success" => true,"fileUploaded" => $filename,"path" => $path);
   	}
		return $app->json($responseJson);
	}

	public function getHoteles(Request $request, Application $app,$idEvento){
		$em 		= $app['orm.ems']['reservas'];
		$model 	= $app["rsvPanelModel"];
		$ht 		= $model->getHoteles($idEvento);
		return $app->json($ht);		
	}	

}

?>