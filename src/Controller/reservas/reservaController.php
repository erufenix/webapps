<?php
namespace Controller\Reservas;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;


class reservaController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/','Controller\Reservas\reservaController::index')->bind('reserva.index');
		return $index;
	}

	public function index(Request $request, Application $app) {
		return true;
	}

	public function panel(Request $request, Application $app) {
		return true;
	}


	public function login(Application $app, Request $request) {
		return $app["twig"]->render("pages/reservas/panel/login.twig.html", array(
			"error" => $app["security.last_error"]($request),
			"last_username" => $app["session"]->get("_security.last_username")
		));
	}


}

?>