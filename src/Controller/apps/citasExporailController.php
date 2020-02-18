<?php
namespace Controller\apps;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class citasExporailController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/','Controller\apps\citasExporailController::index')->bind('citaExporail.index');
		$index->match('/cita','Controller\apps\citasExporailController::cita')->bind('citaExporail.cita');
		$index->post('/setCita','Controller\apps\citasExporailController::setCita')->bind('citaExporail.setCita');
		$index->get('/subTemas','Controller\apps\citasExporailController::getSubTemas')->bind('citaExporail.subTemas');
		$index->get('/temasCitas','Controller\apps\citasExporailController::getTemasCitas')->bind('citaExporail.temasCitas');
		$index->get('/valMail','Controller\apps\citasExporailController::valMail')->bind('citaExporail.valMail');
		$index->get('/recordatorio','Controller\apps\citasExporailController::recordatorio')->bind('citaExporail.recordatorio');
		return $index;
	}

	public function index(Request $request, Application $app) {
		return $app['twig']->render('pages/citas_exporail/pages/index.twig', array(
			'title' =>''
			
		));
	}

	public function cita(Request $request, Application $app) {
		if(empty($request->request->get('paso1'))){
			return $app->redirect($app['url_generator']->generate('citaExporail.index'));
		}
		return $app['twig']->render('pages/citas_exporail/pages/cita.twig', array(
			'request' 	=> $request->request,
			'title' 		=> '',
			'onlyTemas' => $this->getTemasOnly($app),
			'temas'   	=> $this->getTemas($app),
			'index'   	=> $app['url_generator']->generate('citaExporail.index')
 		));
	}	

	public function setCita(Request $request, Application $app){
		$model    = $app["rail19Model"];
		$rq       = $request->request;
		$hcita    = '';
		$idcita   = 0;
		$_xcita   = explode('|',$rq->get('cita'));
		$hcita    = $_xcita[1];
		$idcita   = $_xcita[0];
		$_reg 		= array(); 
		$request->request->set('hora',$hcita);
		$request->request->set('id',$idcita);
		$reg = $model->setCita($rq);
		if($reg){
			$_reg = array(
								'cita' => $app["serializer"]->toArray($reg['cita']),
								'tema' => $app["serializer"]->toArray($reg['tema'])
							);
			$mail   = \Swift_Message::newInstance();
			$mail
				->setTo($request->request->get('correo'),$request->request->get('nombre'))
				->setBcc(array(
								"erubi@tycgroup.com" => "Edgar Rubi",
								"jsanchez@tecnoregistro.com.mx" => "José Sanchez"
				))
				->setFrom('no--reply@sin-tcevents.mx','Registro')
				->setSubject('Registro citas EXPORAIL');
				$body = $app['twig']->render('pages/citas_exporail/pages/mail.twig', array(
						"data"  => $app["serializer"]->toArray($reg['cita']),
						"tema"  => $app["serializer"]->toArray($reg['tema']),
					)
				);
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);										
		}
		return $app->json($_reg);
	}

	private function getTemas($app){
		$model    = $app["rail19Model"];
    $_tm    = array();
    $tm     = $model->getTemas();
    $nk     = 0;
    foreach ($tm as $tk => $tv) {
      $_tm[$tv['tema']][$tv['subtema']][] = $tv;
    }
    return $_tm;
	}

	private function getTemasOnly($app){
		$model	= $app["rail19Model"];
    $otm    = array();		
		$otm 		= $model->getTemasOnly();
		return $otm;
	}

	public function getSubTemas(Request $request, Application $app){
		$model	= $app["rail19Model"];
		$otm    = array();
		$tema   = $request->query->get('tema');
		$otm 		= $model->getSubTemasOnly($tema);
		return $app->json($otm);
	}	

	public function getTemasCitas(Request $request, Application $app){
		$model    = $app["rail19Model"];
		$_tmc     = array(
									'dia' 	=> 0,
									'citas' =>  array()
								);
		$tema     = $request->query->get('tema');
		$subtema  = $request->query->get('subtema');
		$tm       = $model->getTemasCitas($tema,$subtema);
		$dia      = 0;
		if(!empty($tm)){
			$_tmc = array(
							'dia' 	=> $tm[0]['dia'],
							'mesa'  => $tm[0]['mesa'],
							'citas' => $tm
						);
		}
		return $app->json($_tmc);
	}

	public function valMail(Request $request, Application $app){
		$model = $app["rail19Model"];
		$arr = array(
			'mail' => ''
		);
		$mail  = $model->valMail($request->query->get('mail'));
		if($mail){
			$arr = array(
				'mail' => $mail->getCorreo()
			);			
		}
		return $app->json($arr);
	}

	public function recordatorio(Request $request, Application $app){
		$model = $app["rail19Model"];
		$json  = [
			'status' 	=> false,
			'msg' 		=> ''
		];
		try {
			$all 			= $model->getAll();
			$_all 		= $app["serializer"]->toArray($all);
			$now 			= new \DateTime('now');
			$nowd 		= $now->format('Y-m-d');
			$dia 			= $now->format('d');
			$format 	= 'Y-m-d H:i:s';
			$mail   = \Swift_Message::newInstance();
			foreach ($_all as $kc => $vc) {
				$horac 	= $vc['hora'];
				$diac 	= $vc['dia'];
				$id 		= $vc['id_cita'];
				$cita 	= $vc['cita'];
				if($diac == $dia){
					$dc 		= new \DateTime($nowd." ".$horac);
					$t15	 	= $now->diff($dc);
					$ft15 	= $t15->format('%R%I');
					if($ft15 == '+15'){
						$mail
						->setTo($vc['correo'],$vc['nombre'])
						->setBcc(array(
										"erubi@tycgroup.com" => "Edgar Rubi",
										"jsanchez@tecnoregistro.com.mx" => "José Sanchez"
						))
						->setFrom('no--reply@sin-tcevents.mx','Recordatorio')
						->setSubject('Recordatorio citas EXPORAIL');						
						$tc  = $model->gettcita($cita);
						$body = $app['twig']->render('pages/citas_exporail/pages/mailr.twig', array(
							"data"  => $vc,
							"tema"  => $tc->getTema() ." - ". $tc->getSubtema() 
						 )
					  );
						$mail->setBody($body, "text/html");						
						$env = $app['mailer']->send($mail);
						if(env){
							$json  = [
								'status' 	=> true,
								'msg' 		=> "Recordatorio enviado a " . $vc['correo']." - ".$vc['nombre'] 
							];							
						}
						$model->blkReco($id);
					}
				}
			}		

		}catch (\Exception $error){
			throw $error;
		}
		return $app->json($json);
	}	


}

