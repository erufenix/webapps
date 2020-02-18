<?php
namespace Controller;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Entity\Evento;
use Entity\Habitaciones;
use Entity\Hotel;
use Entity\Mapa;
use Entity\Mensajes;
use Entity\Usuarios;

use Lib\Functions\Functions;

class PanelController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$panel = $app['controllers_factory'];
		$panel->get('/','Controller\PanelController::panel')->bind('panel');
		$panel->get("/login", "Controller\PanelController::login")->bind("panel.login");
		$panel->match('/addEvento','Controller\PanelController::addEvent')->bind('panel.addEvent');
		$panel->post('/frmEvento/{idEvento}','Controller\PanelController::setEvent')->bind('panel.setEvent')->assert('idEvento', '\d+')->value('idEvento', 0);
		return $panel;
	}

	public function login(Application $app, Request $request) {
		return $app["twig"]->render("panel/login.twig", array(
			"error" => $app["security.last_error"]($request),
			"last_username" => $app["session"]->get("_security.last_username")
		));
	}

	public function panel(Request $request, Application $app) {
		$em 			= $app['orm.em'];
		$user 		= $app["admin"];
		$eventos 	= $em->getRepository('Entity\Evento')->findAll();
		return $app['twig']->render('panel/index.twig', array(
			'user' 			=> $user,
			'pageTitle' => 'Eventos',
			'eventos' 	=> $eventos
		));
	}

	public function addEvent(Request $request, Application $app) {
		return $app['twig']->render('panel/pages/addEvent.twig', array());
	}	

	public function setEvent(Request $request, Application $app,$idEvento) {
		$em 					= $app['orm.em'];
		$evento 			= null;
		$claveEvento 	= '';
		$formaPago   	= '';
		$responseJson = array(
			'status' 	=> false,
			'message'	=> '',
			'data' 		=> array()
		);
		if($idEvento ==0){
			$evento = new Evento;
		}
		else{
			$evento = $em->getRepository('Entity\Evento')->findOneByIdEvento($idEvento);
		}
		if($evento){
			$claveEvento = trim($request->request->get('claveEvento'));
			$formaPago   = implode(',',$request->request->get('formaPago'));
			$fn = new Functions;
			$evento
				->setClaveEvento($claveEvento)
				->setNombreEvento($request->request->get('nombreEvento'))
				->setSedeEvento($request->request->get('sedeEvento'))
				->setFechaEventoInicio($fn->d2b($request->request->get('fechaEventoInicio')))
				->setFechaEventoFin($fn->d2b($request->request->get('fechaEventoFin')))
				->setMinFechaLlegada($fn->d2b($request->request->get('minFechaLlegada')))
				->setMaxFechaLlegada($fn->d2b($request->request->get('maxFechaLlegada')))
				->setFormaPago($formaPago);	
			try {
				$em = $app['orm.em'];
				$em->persist($evento);
				$em->flush();
				$data = $app["serializer"]->toArray($evento);
				$appResponseJSON = array(
					'status'  => true,
					'data'    => null,
					'message' => "Se agrego el evento corectamente");
			}
			 catch (\Exception $e) {
			}	
		}
		return $app->json($responseJson);
	}	
}

?>