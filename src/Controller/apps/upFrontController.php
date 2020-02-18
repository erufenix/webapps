<?php
namespace Controller\apps;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class upFrontController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/','Controller\apps\upFrontController::index')->bind('upFront.index');
		$index->post('/confirmar/','Controller\apps\upFrontController::completed')->bind('upFront.completed');
		$index->post('/setRegistro','Controller\apps\upFrontController::setRegistro')->bind('upFront.setRegistro');
		$index->post('/mvalida','Controller\apps\upFrontController::mvalida')->bind('upFront.mvalida');
		$index->get('/hotel','Controller\apps\upFrontController::hotel')->bind('upFront.hotel');
		$index->get('/panel/','Controller\apps\upFrontController::panel')->bind('upFront.panel');
		$index->get('/panel/all','Controller\apps\upFrontController::panelParticipantes')->bind('upFront.panelParticipantes');
		$index->get('/panel/participante/{id}','Controller\apps\upFrontController::panelParticipante')
			->bind('upFront.panelParticipante')
			->assert('id', '\w+')->value('id', 0);
		$index->get('/panel/mesa/{id}','Controller\apps\upFrontController::panelMesa')
			->bind('upFront.panelMesa')
			->assert('id', '\w+')->value('id', 0);
		$index->get('/panel/mail/{id}','Controller\apps\upFrontController::panelMail')
			->bind('upFront.panelMail')
			->assert('id', '\w+')->value('id', 0);
		$index->get('/panel/entrada','Controller\apps\upFrontController::panelEntrada')->bind('upFront.panelEntrada');
		$index->post('/panel/mesas/{id}/{m}/{s}','Controller\apps\upFrontController::panelMesas')
			->bind('upFront.panelMesas')
			->assert('m', '\w+')->value('id', 0)
			->assert('m', '\w+')->value('m', '')
			->assert('s', '\w+')->value('s', '');
		$index->post('/panel/vamesas/{m}/{s}','Controller\apps\upFrontController::panelVamesas')
			->bind('upFront.panelVamesas')
			->assert('m', '\w+')->value('m', '')
			->assert('s', '\w+')->value('s', '');
		$index->post('/panel/checkin','Controller\apps\upFrontController::panelCheckin')->bind('upFront.panelCheckin');
		$index->get('/panel/add','Controller\apps\upFrontController::panelAdd')->bind('upFront.panelAdd');
		$index->post('/panel/new','Controller\apps\upFrontController::panelNew')->bind('upFront.panelNew');
		$index->get('/panel/login','Controller\apps\upFrontController::panelLogin')->bind('upFront.panelLogin');
		return $index;
	}

	public function index(Request $request, Application $app) {
		return $app['twig']->render('pages/upFront20/index.twig', array(
			'title' =>''
			
		));
	}

	public function completed(Request $request, Application $app) {
		return $app['twig']->render('pages/upFront20/completed.twig', array(
			'title' => '',
			'rq' 	=> $request->request->All()
			
		));
	}	
	
	public function setRegistro(Request $request, Application $app){
		$model  =	$app["upfrontModel"];
		$reg 		= null;
		$fn 		= new Functions; 
    $response = array(
			'statusText' 	=> 'error',
      'status' 			=> false,
      'data' 				=> array()
		);
		$folio = $fn->token(6,'upfront_');
		$request->request->set('folio',$folio);
		$mail   = \Swift_Message::newInstance();
		try {
			$reg = $model->setRegistro($request->request->All());
			$areg = $app["serializer"]->toArray($reg);
			$model->blkclave($request->request->get('id_clave'));
			$renderer = new ImageRenderer(
				new RendererStyle(400),
				new ImagickImageBackEnd()
		  );
		  $writer = new Writer($renderer);
			$qr_image = $writer->writeString($folio);
			$image = \Swift_Image::newInstance($qr_image, 'qr.png', 'image/png');
      $cid = $mail->embed($image);				
			$mail
				->setTo($request->request->get('correo'),$request->request->get('nombre') . ' ' . $request->request->get('apellidos'))
				->setBcc(array(
								"erubi@tycgroup.com" => "Edgar Rubi",
								"jsanchez@tecnoregistro.com.mx" => "José Sanchez"
				))
				->setFrom('no--reply@sin-tcevents.mx','Registro UpFront 2020')
				->setSubject('Confirmación Registro UpFront 2020');
				$body = $app['twig']->render('pages/upFront20/mail.twig', array(
						"reg"  => $reg,
						"cid"  => $cid
					)
				);		
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);		
			$response = array(
				'statusText' 	=> 'OK',
				'status' 			=> true,
				'data' 				=> $request->request->All(),
				'reg' 				=> $areg
			);			
		} catch (\Throwable $th) {
			throw $th;
		}
		return $app->json($response);
	}
	
	public function mvalida(Request $request, Application $app) {
    $response = array(
			'statusText' 	=> 'error',
      'status' 			=> false,
      'data' 				=> array()
		);		
		$mail = $request->request->get('mailv');
		$vm 	= $this->getvmail($mail,$app);
		if(!empty($vm)){
			foreach ($vm as $k => $v) {
				if($v['bloqueada'] == true){
					$response = array(
						'statusText' 	=> 'error',
						'status' 			=> false,
						'data' 				=> array()
					);
					break;					
				}
				if($v['bloqueada'] == false){
					$response = array(
						'statusText' 	=> 'OK',
						'status' 			=> true,
						'data' 				=> $v
					);
					break;					
				}				
			}			
		}
		return $app->json($response);
	}

	public function getvmail($mail,$app){
		$model  =	$app["upfrontModel"];
		$vm = $model->getvmail($mail);
		return $vm;
	}
	
	public function hotel(Request $request, Application $app) {
		return $app['twig']->render('pages/upFront20/hotel.twig', array(
			'title' =>''
		));
	}

	public function panel(Request $request, Application $app){
		return $app['twig']->render('pages/upFront20/admin/panel.twig', array(
			'title' =>'Partipantes'
		));
	}

	public function panelParticipantes(Request $request, Application $app){
		$model  =	$app["upfrontModel"];
		$all 		= $app["serializer"]->toArray($model->getAll()); 
		return $app->json($all);
	}

	public function panelParticipante(Request $request, Application $app,$id){
		$model  =	$app["upfrontModel"];
		$reg 		= $app["serializer"]->toArray($model->getReg($id)); 
		return $app->json($reg);
	}

	public function panelMesa(Request $request, Application $app,$id){
    $response = array(
			'statusText' 	=> 'error',
      'status' 			=> false,
			'data' 				=> array(),
			'html' 				=> ''
		);		
		$model  =	$app["upfrontModel"];
		$reg 		= $app["serializer"]->toArray($model->getReg($id));
		if($reg){
			$html   = $app['twig']->render('pages/upFront20/admin/mesa.twig', array(
				'rq' 	=> $request->request->All(),
				'reg' => $reg			
			));
			$response = array(
				'statusText' 	=> 'ok',
				'status' 			=> true,
				'data' 				=> $reg,
				'html' 				=> $html
			);			
		}
		return $app->json($response);
	}
	
	public function panelMail(Request $request, Application $app,$id){
    $response = array(
			'statusText' 	=> 'error',
      'status' 			=> false,
			'data' 				=> array(),
			'html' 				=> ''
		);
		$mail   = \Swift_Message::newInstance();
		$model  =	$app["upfrontModel"];
		$reg 		= $model->getReg($id);
		if($reg){
			$areg 	= $app["serializer"]->toArray($model->getReg($id));
			$m = $reg->getMesa();
			$s = $reg->getSilla();
			$renderer = new ImageRenderer(
				new RendererStyle(400),
				new ImagickImageBackEnd()
		  );
		  $writer = new Writer($renderer);
			$qr_image = $writer->writeString($reg->getFolio());
			$image = \Swift_Image::newInstance($qr_image, 'qr.png', 'image/png');
      $cid = $mail->embed($image);
			$mail
				->setTo("jsanchez@tecnoregistro.com.mx","José Sanchez")
				->setBcc(array(
								"erubi@tycgroup.com" => "Edgar Rubi",
								//"jsanchez@tecnoregistro.com.mx" => "José Sanchez"
				))
				->setFrom('no--reply@sin-tcevents.mx','Registro UpFront 2020')
				->setSubject('Asignación de mesa UpFront 2020');
				$body = $app['twig']->render('pages/upFront20/admin/mailml.twig', array(
						"reg"  => $reg,
						"cid"  => $cid
					)
				);		
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);				
			$response = array(
				'statusText' 	=> 'ok',
				'status' 			=> true,
				'data' 				=> $reg,
				'html' 				=> ''
			);			
		}
		return $app->json($response);
	}		

	public function panelEntrada(Request $request, Application $app){
		$now            = new \DateTime('now');
    $response = array(
			'statusText' 	=> 'error',
      'status' 			=> false,
			'data' 				=> array(),
			'html' 				=> ''
		);
		$html   = $app['twig']->render('pages/upFront20/admin/entrada.twig', array(
			'hour' => $now->format('H:i:s')
		));		
		$model  =	$app["upfrontModel"];
    $response = array(
			'statusText' 	=> 'ok',
      'status' 			=> true,
			'data' 				=> array(),
			'html' 				=> ''
		);		
		return $app->json($response);
	}

	public function panelCheckin(Request $request, Application $app){
		$model  =	$app["upfrontModel"];
    $response = array(
			'statusText' 	=> 'error',
      'status' 			=> false,
			'time' 				=> '',
			'html' 				=> '',
			'update'			=> false,
			'data' 				=> []
		);
		$folio 		= $request->request->get('folio');
		$folior 	= $request->request->get('folior');
		$folio  = str_replace('?','_', $folio);
		if($folio){
			$setf = $model->setHora($folio);
			if(!empty($setf['folio'])){
				$time = $setf['folio']->getEntrada();
				$response = array(
					'statusText' 	=> 'ok',
					'status' 			=> true,
					'time' 				=> $time->format('H:i:s'),
					'html' 				=> '',
					'update' 			=> $setf['update'],
					'data'  			=> $app["serializer"]->toArray($setf['folio'])
				);				
			}
		}
		return $app->json($response);
	}

	public function panelMesas(Request $request, Application $app,$id,$m,$s){
		$model  =	$app["upfrontModel"];
		$mail   = \Swift_Message::newInstance();
    $response = array(
			'statusText' 	=> 'error',
      'status' 			=> false,
			'html' 				=> '',
			'data' 				=> []
		);
		$mesa 	= $m;
		$silla 	= $s;
		$id 		= $id;
		$me 		= $model->setMesaSilla($mesa,$silla,$id);
		if($me){
			$renderer = new ImageRenderer(
				new RendererStyle(400),
				new ImagickImageBackEnd()
		  );
		  $writer = new Writer($renderer);
			$qr_image = $writer->writeString($me->getFolio());
			$image = \Swift_Image::newInstance($qr_image, 'qr.png', 'image/png');
      $cid = $mail->embed($image);	
			$response = array(
				'statusText' 	=> 'ok',
				'status' 			=> true,
				'html' 				=> '',
				'data' 				=> $app["serializer"]->toArray($me)
			);
			$mail
				->setTo($me->getCorreo(),$me->getNombre() . ' ' . $me->getApellidos())
				->setBcc(array(
								"erubi@tycgroup.com" => "Edgar Rubi",
								"jsanchez@tecnoregistro.com.mx" => "José Sanchez"
				))
				->setFrom('no--reply@sin-tcevents.mx','Registro UpFront 2020')
				->setSubject('Asignación de mesa UpFront 2020');
				$body = $app['twig']->render('pages/upFront20/admin/mailm.twig', array(
						"reg"  => $me,
						"cid"  => $cid
					)
				);		
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);							
		}
		return $app->json($response);		
	}

	public function panelAdd(Request $request, Application $app){		
		$html   = $app['twig']->render('pages/upFront20/admin/registro.twig', array(
		));
		$response = array(
			'statusText' 	=> 'ok',
			'status' 			=> true,
			'data' 				=> [],
			'html' 				=> $html
		);			
		return $app->json($response);
	}

	public function panelNew(Request $request, Application $app){
		$model  =	$app["upfrontModel"];
		$reg 		= null;
		$fn 		= new Functions; 
    $response = array(
			'statusText' 	=> 'error',
      'status' 			=> false,
      'data' 				=> array()
		);
		$folio = $fn->token(6,'upfront_');
		$request->request->set('folio',$folio);
		$mail   = \Swift_Message::newInstance();
		try {
			$reg = $model->setNRegistro($request->request->All());
			$areg = $app["serializer"]->toArray($reg);
			$renderer = new ImageRenderer(
				new RendererStyle(400),
				new ImagickImageBackEnd()
		  );
		  $writer = new Writer($renderer);
			$qr_image = $writer->writeString($folio);
			$image = \Swift_Image::newInstance($qr_image, 'qr.png', 'image/png');
      $cid = $mail->embed($image);				
			$mail
				->setTo($request->request->get('correo'),$request->request->get('nombre') . ' ' . $request->request->get('apellidos'))
				->setBcc(array(
								"erubi@tycgroup.com" => "Edgar Rubi",
								"jsanchez@tecnoregistro.com.mx" => "José Sanchez"
				))
				->setFrom('no--reply@sin-tcevents.mx','Registro UpFront 2020')
				->setSubject('Confirmación Registro UpFront 2020');
				$body = $app['twig']->render('pages/upFront20/mail.twig', array(
						"reg"  => $reg,
						"cid"  => $cid
					)
				);		
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);		
			$response = array(
				'statusText' 	=> 'OK',
				'status' 			=> true,
				'data' 				=> $request->request->All(),
				'reg' 				=> $areg
			);			
		} catch (\Throwable $th) {
			throw $th;
		}
		return $app->json($response);
	}

	public function panelLogin(Request $request, Application $app) {
		return $app['twig']->render('pages/upFront20/admin/login.twig', array(
			"error" => $app["security.last_error"]($request),
			"last_username" => $app["session"]->get("_security.last_username")
		));
  }
	
}

