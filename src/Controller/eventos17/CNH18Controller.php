<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class CNH18Controller implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\CNH18Controller::index')
		->bind('CNH18.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\CNH18Controller::setReservacion')->bind('cnh18.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\CNH18Controller::confirmacion')->bind('cnh18.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\CNH18Controller::politicas')->bind('cnh18.politicas')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'CNH18/cnh18.index.twig.html',
				'es' 	=> 'CNH18/cnh18.index.twig.html',
				'en' 	=> 'CNH18/cnh18.index.en.twig.html'
		);
		$hoteles[1] =
			array(
				'index' 				=> '1',
				'nombre' 				=> 'GRAND FIESTA AMERICANA CORAL BEACH CANCÚN',
				'img' 					=> '1.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'Junior Suite ROH - Sencilla',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'4,030.69',
								'usd'	=>	''
						),
						'costor' 	=> array(
								'mxn'	=>	'4,030.69',
								'usd'	=>	''
						),						
						'propinas'	=>	array(
							'mxn'	=>	'90',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'Junior Suite ROH - Doble',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'4,030.69',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'4,030.69',
							'usd'	=>	''
							),						
						'propinas'	=>	array(
							'mxn'	=>	'180',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						)
				),
				'mensajes'			=> array(
						'es' => '<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
										'<ul>\n'.
										'<li>Renta de habitación en la ocupación seleccionada en Plan Europeo (sin alimentos),16% de IVA, 3% de ISH y propinas a camaristas.</li>\n'.
										'</ul>\n'.
										'<h3 class=\"c-theme-font c-font-uppercase\">Notas Importantes:</h3>\n'.
										'<ul>\n'.
										'<li>Se realizará un cargo de $90.00 MN en habitación sencilla y $180.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
										'<li>ROH:  Habitaciones que el hotel tiene disponibles y que son asignadas a la llegada del huésped. </li>\n'.
										'<li>Check in 15:00 hrs. / Check out 12:00 hrs.</li>\n'.
										'</ul>\n'
										,
						'en' => ''
					)		
			);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 			=> 'XIII CONGRESO NACIONAL DE HEPATOLOGIA',
			'hoteles' 		=> $hoteles,
			'hotelesJson' => json_encode($hoteles),
			'currency' 		=> $currency,
			'idHotel' 		=> $idHotel,
			'lang' 				=> $lang, 
			'operador'  	=> array(
										'name'	=> 'Mariela Arellano',
										'mail' 	=> 'marellano@tcevents.com',
										'phone'	=> '+52 55 5148 75 00 ext: 11' 
										),
			'url' 				=> (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST') . $request->server->get('REDIRECT_URL')
 			));		
	}

	public function setReservacion(Request $request, Application $app){
		$model = $app["rsvModel"];
		$fn 				= new Functions;
		$dh    			= explode('|', $request->request->get('habitacionc'));
		$now   			= new \DateTime('now');
		$fllegada 	= $fn->d2b($request->request->get('fechaLlegada'));
		$fsalida 		= $fn->d2b($request->request->get('fechaSalida'));
		$habitacion = $dh[0];
		$costoNoche = str_replace(',','',$dh[1]);
		$bellBoy 		= str_replace(',','',$dh[2]);
		$pack  			= (empty(str_replace(',','',$dh[3]))) ? 0*1 : str_replace(',','',$dh[3])*1;
		$pp 				= $dh[4];
		$costoNochr = str_replace(',','',$dh[5]);
		$cveRsv 		= time();
		$diasPago   = 0;
		$fpago 			= $request->request->get('pago');
		$data = array();
		$pages = array(
				'' 		=> 'mail-cnh18-deposito-es.twig.html',
				'es' 	=> 'mail-cnh18-deposito-es.twig.html',
				'en' 	=> 'mail-cnh18-deposito-en.twig.html'
		);		
		if($pack != 0){
			$costoNochr = $costoNochr / $pack;
			$diasPago   = $pack;			
		}
		elseif($request->request->get('pagoPor') == 'N'){
			$diasPago = 1;
		}
		else{
			$dl 			= $fllegada;
			$ds 			= $fsalida;
			$di 			= $fllegada->diff($fsalida);
			$diasPago = $di->format('%a');
		}
		$cargo 			= ($costoNochr * $diasPago) + $bellBoy;
		$request->request->set('claveReservacion',$cveRsv);
		$request->request->set('tipoHabitacion',$habitacion);
		$request->request->set('costoNoche',$costoNochr);
		$request->request->set('cargoBellBoys',$bellBoy);
		$request->request->set('diasPago',$diasPago);
		$request->request->set('cargoTotal',$cargo);
		$request->request->set('status','iniciada');
		$fechas['fsalida'] 	= $fsalida;
		$fechas['fllegada'] = $fllegada;
		$fechas['now'] 		= $now;
		$json   	= array(
			'status' => false,
			'msg' 	=> '',
			'data' 	=> null
		);
		$rsv = $model->crearReservacion($request->request,$fechas,$app);
		if($rsv){
			$data = $app["serializer"]->toArray($rsv);
			$mail 	= \Swift_Message::newInstance();
			$nombre = $request->request->get('nombre') . " " . $request->request->get('apaterno') ." " . $request->request->get('amaterno');
			if($fpago == 'DB'){
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"marellano@tcevents.com" => "Mariela Arellano"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion XIII CONGRESO NACIONAL DE HEPATOLOGIA ');
			}
			else{
				$mail
					->setTo("marellano@tcevents.com","Mariela Arellano")
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion XIII CONGRESO NACIONAL DE HEPATOLOGIA');				
			}
			$body = $app['twig']->render('pages/eventos17/CNH18/'.$pages[$request->request->get('lang') ], array(
				"data"		=> $rsv,
				"idHotel" => $request->request->get('idHotel'),
				"pais" 		=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 	=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name')				
				)
			);
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);
			$json   	= array(
					'status'	=> true,
					'msg' 		=> '',
					'data' 		=> $data
			);										
		}
		return $app->json($json);
	}

	public function confirmacion(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'cnh18.confirmacion.twig.html',
				'es' 	=> 'cnh18.confirmacion.twig.html',
				'en' 	=> 'cnh18.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/CNH18/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'cnh18.politicas.twig.html',
				'es' 	=> 'cnh18.politicas.twig.html',
				'en' 	=> 'cnh18.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/CNH18/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	

}
?>