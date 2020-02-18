<?php
namespace Controller\operaciones;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;
use Lib\Functions\ppPlus;

class kickoff19AdminController implements ControllerProviderInterface {
	private $model 	=	null;

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		//$this->model =	$app["kickoff19Model"];
		$index->get('/','Controller\operaciones\kickoff19AdminController::index')->bind('kickoff19Admin.index');
    $index->get('/login','Controller\operaciones\kickoff19AdminController::login')->bind('kickoff19Admin.login');
    $index->get('/registros','Controller\operaciones\kickoff19AdminController::registros')->bind('kickoff19Admin.registros');
		return $index;
	}

	public function index(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff19/admin/index.twig', array(
			'title' =>'inicio'
		));
	}

  public function login(Request $request, Application $app) {
    return $app['twig']->render('pages/kickoff19/admin/login.twig', array(
      'title' =>'login',
      "error" => $app["security.last_error"]($request),
      "last_username" => $app["session"]->get("_security.last_username")
    ));
  }

  public function registros(Request $request, Application $app) {
    return $app['twig']->render('pages/kickoff19/admin/regs.twig', array(
      'title' =>'inicio'
    ));
  }

}

?>
