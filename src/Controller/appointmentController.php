<?php
namespace Controller;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Entity\Bfg17;

use Lib\Functions\Functions;

class appointmentController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/','Controller\appointmentController::index')->bind('appointment.index');
		return $index;
	}

	public function index(Request $request, Application $app) {
		return $app['twig']->render('pages/appointment/index.twig.html', array(
			'title' =>''
		));
	}

}

?>