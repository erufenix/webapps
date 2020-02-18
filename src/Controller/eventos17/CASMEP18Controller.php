<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class CASMEP18Controller implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\CASMEP18Controller::index')
		->bind('casmep18.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\CASMEP18Controller::setReservacion')->bind('casmep18.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\CASMEP18Controller::confirmacion')->bind('casmep18.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\CASMEP18Controller::politicas')->bind('casmep18.politicas')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'CASMEP18/casmep18.index.twig.html',
				'es' 	=> 'CASMEP18/casmep18.index.twig.html',
				'en' 	=> 'CASMEP18/casmep18.index.en.twig.html'
		);
		$hoteles[1] =
			array(
				'index' 				=> '1',
				'nombre' 				=> 'HOTEL CROWNE PLAZA MTY',
				'img' 					=> '1.jpg',
				'agotado' 			=> true,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACION SENCILLA',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'3,120.55',
								'usd'	=>	''
						),
						'costor' 	=> array(
								'mxn'	=>	'3,120.55',
								'usd'	=>	''
						),						
						'propinas'	=>	array(
							'mxn'	=>	'40',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'HABITACION DOBLE',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'4,608.10',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'4,608.10',
							'usd'	=>	''
							),						
						'propinas'	=>	array(
							'mxn'	=>	'80',
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
										'<li>Renta de habitación por noche,  impuestos  (16%IVA / 3% ISH), Desayuno, Comida y Cena Tipo Buffet, refill de refrescos en comidas y cenas ( para 1 persona), servicio de Coffee Break en los salones de sesiones.</li>\n'.
										'</ul>\n'.
										'<h3 class=\"c-theme-font c-font-uppercase\">Notas Importantes:</h3>\n'.
										'<ul>\n'.
										'<li>Se realizara un cargo único por concepto de propinas a bell boys (Sencilla $40.00 / Doble $80.00)</li>\n'.
										'<li>Los alimentos inician con Comida y terminan con Desayuno.</li>\n'.
										'<li>Ckeck in 15:00 hrs. / Check out 13:00 hrs.</li>\n'.
										'<li>Tarifa <strong>Day Pass</strong> para personas no hospedadas en el Hotel $ 1,494.00, incluye desayuno, comida ,cena y coffee break por persona más IVA</li>\n'.
										'</ul>\n'
										,
						'en' => ''
					)		
			);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 			=> 'XIX CONGRESO ANUAL DE LA SOCIEDAD MEXICANA DE ENDOCRINOLOGIA PEDIATRICA',
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
				'' 		=> 'mail-casmep18-deposito-es.twig.html',
				'es' 	=> 'mail-casmep18-deposito-es.twig.html',
				'en' 	=> 'mail-casmep18-deposito-en.twig.html'
		);		
		if($pack != 0){
			$costoNochr = $costoNochr / $pack;
			$diasPago   = $pack;			
		}
		elseif($request->request->get('pagoPor') == 'N'){
			$diasPago = 2;
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
					->setSubject('Reservacion XIX CONGRESO ANUAL DE LA SOCIEDAD MEXICANA DE ENDOCRINOLOGIA PEDIATRICA');
			}
			else{
				$mail
					->setTo("marellano@tcevents.com","Mariela Arellano")
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion XIX CONGRESO ANUAL DE LA SOCIEDAD MEXICANA DE ENDOCRINOLOGIA PEDIATRICA');				
			}
			$body = $app['twig']->render('pages/eventos17/CASMEP18/'.$pages[$request->request->get('lang') ], array(
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
				'' 		=> 'casmep18.confirmacion.twig.html',
				'es' 	=> 'casmep18.confirmacion.twig.html',
				'en' 	=> 'casmep18.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/CASMEP18/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'casmep18.politicas.twig.html',
				'es' 	=> 'casmep18.politicas.twig.html',
				'en' 	=> 'casmep18.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/CASMEP18/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	

}
?>