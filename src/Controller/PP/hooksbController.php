<?php
namespace Controller\PP;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class hooksbController implements ControllerProviderInterface {

	public function connect(Application $app) {
	$index = $app['controllers_factory'];
	$index
		->match('/','Controller\PP\hooksbController::index')
		->bind('hooksb.index');		
	return $index;
	}

	public function index(Request $request, Application $app,$lang) {
		return true;
	}

}
?>