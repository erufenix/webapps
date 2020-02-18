<?php
namespace Controller\commimsa;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;


class commimsaController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/','Controller\commimsa\commimsaController::index')->bind('commimsa.index');
		$index->post('/setRegistro','Controller\commimsa\commimsaController::setRegistro')->bind('commimsa.setRegistro');
		return $index;
	}

	public function index(Request $request, Application $app) {
		return $app['twig']->render('pages/commimsa/index.twig', array(
		));
	}

	public function setRegistro(Request $request, Application $app){
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		$mail 	= \Swift_Message::newInstance();
		$nombre = $request->request->get('nombre') . " " . $request->request->get('apaterno') ." " . $request->request->get('amaterno');
		$mail
			->setTo($request->request->get('correo'),$nombre)
			->setBcc(array(
					"erubi@tcevents.com" => "Edgar Rubi"
			))
			->setFrom('no--reply@sin-tcevents.mx','Confirmación de registro')
			->setSubject('TALLER PARA LA IDENTIFICACIÓN DE PRIORIDADES NACIONALES EN INVESTIGACIÓN, DESARROLLO DE TECNOLOGÍA Y FORMACIÓN DE RECURSOS HUMANOS');
			$body = $app['twig']->render('pages/commimsa/cmmm.mail.twig', array(
				"data"		=> $request->request		
				)
			);			
		$mail->setBody($body, "text/html");
		if($app['mailer']->send($mail,$error)){
			$json   	= array(
				'status' => true,
				'msg' 	=> '',
				'data' 	=> $request->request->all()
			);			
		}
		return $app->json($json);		
	}

}

?>