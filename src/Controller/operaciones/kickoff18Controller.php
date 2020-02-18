<?php
namespace Controller\operaciones;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class kickoff18Controller implements ControllerProviderInterface {
	private $model 	=	null;

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		//$this->model =	$app["kickoff18Model"];
		$index->get('/','Controller\operaciones\kickoff18Controller::index')->bind('kickoff18.index');
		$index->get('/registro/{tpo}','Controller\operaciones\kickoff18Controller::registro')
			->bind('kickoff18.registro')
			->assert('tpo', '\w+')->value('tpo', 'kickoff18');
		$index->post('/valida','Controller\operaciones\kickoff18Controller::valida')->bind('kickoff18.valida');
		$index->post('/setregistro','Controller\operaciones\kickoff18Controller::setRegistro')->bind('kickoff18.setRegistro');
		$index->get('/sede','Controller\operaciones\kickoff18Controller::sede')->bind('kickoff18.sede');
		$index->get('/contacto','Controller\operaciones\kickoff18Controller::contacto')->bind('kickoff18.contacto');
		$index->post('/sendContacto','Controller\operaciones\kickoff18Controller::sendContacto')->bind('kickoff18.sendContacto');
		$index->get('/agenda','Controller\operaciones\kickoff18Controller::agenda')->bind('kickoff18.agenda');
		$index->get('/politicas','Controller\operaciones\kickoff18Controller::politicas')->bind('kickoff18.politicas');
		$index->get('/tarifa','Controller\operaciones\kickoff18Controller::tarifa')->bind('kickoff18.tarifa');
		/*$index->get('/contacto','Controller\mPS4Controller::contacto')->bind('bfg17.contacto');

		$index->post('/lvalida','Controller\mPS4Controller::lvalida')->bind('bfg17.valida');
		$index->get('/lvalidaf','Controller\mPS4Controller::lvalidaFull')->bind('bfg17.validaf');
		$index->post('/vmail','Controller\mPS4Controller::vmail')->bind('bfg17.vmail');
		$index->get('/reporte','Controller\mPS4Controller::reporte')->bind('reporte');
		$index->get('/reporte2','Controller\mPS4Controller::reporte2')->bind('reporte2');*/
		return $index;
	}

	public function index(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff18/index.twig.html', array(
			'title' =>''
		));
	}

	public function registro(Request $request, Application $app,$tpo) {
		return $app['twig']->render('pages/kickoff18/registro.twig.html', array(
			'title' => '',
			'tpo' 	=> $tpo
		));
	}

	public function setRegistro(Request $request, Application $app) {
		$model 								=	$app["kickoff18Model"];
		$data 								= array();
		$fn 									= new Functions;
		$now   								= new \DateTime('now');
		$fechaHoraIda_ 				= $request->request->get('fechaIda') ." ". $request->request->get('horaIda').":00";
		$fechaHoraRegreso_ 		= $request->request->get('fechaRegreso') ." ". $request->request->get('horaRegreso').":00";
		$acofechaHoraIda_ 		= $request->request->get('acoFechaIda') ." ". $request->request->get('acoHoraIda').":00";
		$acofechaHoraRegreso_	= $request->request->get('acoFechaIda') ." ". $request->request->get('acoHoraIda').":00";
		$request->request->set('fechaHoraIda',$fn->d2b($fechaHoraIda_,true));
		$request->request->set('fechaHoraRegreso',$fn->d2b($fechaHoraRegreso_,true));
		$request->request->set('acoFechaHoraIda',$fn->d2b($acofechaHoraIda_,true));
		$request->request->set('acoFechaHoraRegreso',$fn->d2b($acofechaHoraRegreso_,true));
		$request->request->set('fecha_registro',$now);
		$acoCamisa = empty($request->request->get('acoCamisa')) ? '' : $request->request->get('acoCamisa');
		$request->request->set('acoCamisa',$acoCamisa);
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		$reg 	= $model->setregistro($request->request);
		$data = $app["serializer"]->toArray($reg);
		if(!empty($data)){
			$mail 	= \Swift_Message::newInstance();
			$mail
				->setTo($request->request->get('correo'),$request->request->get('nombre'))
				->setBcc(array(
						"erubi@tcevents.com" => "Edgar Rubi",
						//"gterreros@tcevents.com" => "Gerardo Terreros"
				))
				->setFrom('no--reply@sin-tcevents.mx','Registro')
				->setSubject('Registro INTERNATIONAL KICKOFF 2019');
				$body = $app['twig']->render('pages/kickoff18/remail.twig.html', array(
					"data"		=> $data,
					"tot" 		=> $request->request->get('tot')
				)
			);
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);
			$json   	= array(
				'status' => true,
				'msg' 	=> '',
				'data' 	=> $data
			);
		}
		return $app->json($json);
	}

	public function valida(Request $request, Application $app){
		$model 	=	$app["kickoff18Model"];
		$clave  = $model->getClave($request->request);
		return $app->json($clave);
	}

	public function sede(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff18/sede.twig.html', array(
			'title' => ''
		));
	}

	public function contacto(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff18/contacto.twig.html', array(
			'title' => ''
		));
	}

	public function sendContacto(Request $request, Application $app) {
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		$mail = \Swift_Message::newInstance();
		$mail
			->setTo('erubi@tycgroup.com','Mónica Flores')
			->setBcc(array(
			 //"marellano@tycgroup.com" => "Mariela Arellano",
			 "erubi@tcevents.com" => "Edgar Rubi"
			))
			->setFrom($request->request->get('correo'),$request->request->get('nombre'))
			->setSubject('Contacto Convención Distribuidores 2018');
		$body = $app['twig']->render('pages/kickoff18/mailContact.twig.html', array(
							"data"	=> $request->request
						)
		);

		$mail->setBody($body, "text/html");
		$env = $app['mailer']->send($mail);
		$json   	= array(
				'status'	=> true,
				'msg' 		=> ''
		);
		return $app->json($json);
	}

	public function agenda(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff18/agenda.twig.html', array(
			'title' => ''
		));
	}

	public function politicas(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff18/politicas.twig.html', array(
			'title' => ''
		));
	}

	public function tarifa(Request $request, Application $app) {
		return $app['twig']->render('pages/kickoff18/tarifa.twig.html', array(
			'title' => ''
		));
	}

}

?>
