<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class AMSOFACController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\AMSOFACController::index')
		->bind('amsofac.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\AMSOFACController::setReservacion')->bind('amsofac.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\AMSOFACController::confirmacion')->bind('amsofac.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\AMSOFACController::politicas')->bind('amsofac.politicas')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$fn 				= new Functions;
		$pages = array(
				'' 		=> 'AMSOFAC/amsofac.index.twig.html',
				'es' 	=> 'AMSOFAC/amsofac.index.twig.html',
				'en' 	=> 'AMSOFAC/amsofac.index.en.twig.html'
		);
		$paises   = $fn->getCountryList();
		$hoteles[1] =
			array(
				'index' 				=> '1',
				'nombre' 				=> 'HOTEL PRINCESS MUNDO IMPERIAL',
				'img' 					=> '1.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACION SENCILLA',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'4,589.00',
								'usd'	=>	''
						),
						'costor' 	=> array(
								'mxn'	=>	'4,589.00',
								'usd'	=>	''
						),						
						'propinas'	=>	array(
							'mxn'	=>	'0',
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
							'mxn'	=>	'6,780.00',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'6,780.00',
							'usd'	=>	''
							),						
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						)
				),
				'All' => false,
				'mensajes'			=> array(
						'es' => '<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
										'<ul>\n'.
										'<li>\n'.
										'Renta de habitación por noche,  impuestos  (16%IVA / 3% ISH) Desayuno Buffet en restaurantes, Comida  y Cena, Bebidas Nacionales a partir de las 11:00 am hasta las 23:00 en los bares previamente seleccionados (las bebidas aplican solamente por copeo)'.
										'</li>\n'.
										'<li>\n'.
										'Botones/ Camaristas y cargos por servicio\n'.
										'</li>\n'.
										'<li>\n'.
										'Resort Service que le da acceso a internet Inalambrico (No acceso dedicado) y llamadas locales, nacionales y lasa 800´s sin cargo.\n'.
										'</li>\n'.
										'</ul>\n'.
										'<h3 class=\"c-theme-font c-font-uppercase\">Notas Importantes:</h3>\n'.
										'<ul>\n'.
										'<li>Niños de 0 a 5 años acompañados de un adulto no tiene costo durante la estancia</li>\n'.
										'<li>Niños de 6 a 12 años el cargo sera de $615.70 pesos por noche</li>\n'.
										'<li>Niños de 13 a 17 años el cargo sera de $1,231.40 pesos por noche</li>\n'.
										'<li>Los alimentos inician con Cena el dia 22 de febrero y terminan con Comida el 25 de febrero.</li>\n'.
										'<li>Ckeck in 16:00 hrs. / Check out 12:00 hrs.</li>\n'.
										'<li>Tarifa <strong>\"Day Pass\"</strong> para personas no hospedadas en el Hotel  se hara un cargo unico de $ 6,571.30 , incluye la Cena del dia 22, desayuno, comida y cena en restaurantes, bebidas nacionales por persona los dias 23 y 24 de febrero y solamente el desayuno el dia 25, impuestos y propinas incluidas.</li>\n'.
										'<li>El servicio de estacionamiento es de $125.00 pesos por noche, impuestos y servicio de valet parking (No incluye propina)</li>'.
										'</ul>\n'
										,
						'en' => ''
					)		
			);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 			=> 'REUNION DE DIRECTORES GENERALES AMSOFAC',
			'hoteles' 		=> $hoteles,
			'hotelesJson' => json_encode($hoteles),
			'currency' 		=> $currency,
			'idHotel' 		=> $idHotel,
			'lang' 				=> $lang,
			'paises' 			=> $paises,
			'noches'  		=> 2, 
			'operador'  	=> array(
										'name'	=> 'Carlos Aguirre',
										'mail' 	=> 'caguirre@tycgroup.com',
										'phone'	=> '+52 55 5148 75 00 ext: 69'
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
				'' 		=> 'mail-amsofac-deposito-es.twig.html',
				'es' 	=> 'mail-amsofac-deposito-es.twig.html',
				'en' 	=> 'mail-amsofac-deposito-en.twig.html'
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
							"caguirre@tycgroup.com" => "Carlos Aguirre"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion REUNION DE DIRECTORES GENERALES AMSOFAC');
			}
			else{
				$mail
					->setTo("caguirre@tycgroup.com","Carlos Aguirre")
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion REUNION DE DIRECTORES GENERALES AMSOFAC');				
			}
			$body = $app['twig']->render('pages/eventos17/AMSOFAC/'.$pages[$request->request->get('lang') ], array(
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
				'' 		=> 'amsofac.confirmacion.twig.html',
				'es' 	=> 'amsofac.confirmacion.twig.html',
				'en' 	=> 'amsofac.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/AMSOFAC/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'amsofac.politicas.twig.html',
				'es' 	=> 'amsofac.politicas.twig.html',
				'en' 	=> 'amsofac.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/AMSOFAC/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	

}
?>