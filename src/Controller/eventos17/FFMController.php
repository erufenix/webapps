<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class FFMController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\ffmController::index')
		->bind('ffm.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\ffmController::setReservacion')->bind('ffm.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\ffmController::confirmacion')->bind('ffm.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\ffmController::politicas')->bind('ffm.politicas')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'FFM/ffm.index.twig.html',
				'es' 	=> 'FFM/ffm.index.twig.html',
				'en' 	=> 'FFM/ffm.index.en.twig.html'
		);
		$fn 				= new Functions;
		$paises   = $fn->getCountryList();
		$hoteles = array();
		
		$hoteles[1] = array(
										'index' 				=> '1',
										'nombre' 				=> 	"GRAN HOTEL CONCORDIA",
										'img' 					=> 	'concordia.jpg',
										'agotado' 			=> true,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitación sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,165.10',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'0.00',
													'usd'	=>	''
													),
												'hagotada' => true
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitación Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'1,165.10',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'0.00',
													'usd'	=>	''
													),
												'hagotada' => true
												)																																	
											),
										'All' => false,
										'mensajes' => array(
												'es' => 
													'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
													'<ul>'.
													'<li>Renta de habitación en la ocupación seleccionada con Desayuno Americano (Jugo, café, fruta, huevos al gusto, pan dulce y salado)  16% de IVA, 3% de ISH.</li>\n'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check In 15:00 hrs / Check Out 12:00 hrs.</li>\n',
													'<li>Propinas de Bell Boys a discresión del cliente.</li>\n',
													'</ul>\n',
												'en' => 
													'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
													'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ($5.00 USD).</li>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
													'</ul>\n',
												'pt' 	=> 
													'<h3 class=\"c-theme-font c-font-uppercase\">A taxa inclui:</h3>\n'.
													'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Um cobro único será efetuado para gorjeta dos bell boys por persona (5.00 USD).</li>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs.</li>\n'.
													'</ul>\n'
			)
		);		

		$hoteles[2] = array(
										'index' 				=> '2',
										'nombre' 				=> 	"HOTEL PANORAMA",
										'img' 					=> 	'panorama.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitación sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,165.10',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'0.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitación Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'1,165.10',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'0.00',
													'usd'	=>	''
													),
												'hagotada' => false
												)																																	
											),
										'All' => false,
										'mensajes' => array(
												'es' => 
													'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
													'<ul>'.
													'<li>Renta de habitación en la ocupación seleccionada con Desayuno Buffet 16% de IVA, 3% de ISH.</li>\n'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check In 15:00 hrs / Check Out 12:00 hrs.</li>\n',
													'<li>Propinas de Bell Boys a discresión del cliente.</li>\n',
													'</ul>\n',
												'en' => 
													'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
													'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ($5.00 USD).</li>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
													'</ul>\n',
												'pt' 	=> 
													'<h3 class=\"c-theme-font c-font-uppercase\">A taxa inclui:</h3>\n'.
													'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Um cobro único será efetuado para gorjeta dos bell boys por persona (5.00 USD).</li>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs.</li>\n'.
													'</ul>\n'
			)
		);	


		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 			=> 'TERCER FORO FRANCO- MEXICANO DE CIENCIA, TECNOLOGÍA E INNOVACIÓN',
			'hoteles' 		=> $hoteles,
			'hotelesJson' => json_encode($hoteles),
			'currency' 		=> $currency,
			'idHotel' 		=> $idHotel,
			'lang' 				=> $lang,
			'paises' 			=> $paises,
			'operador'  	=> array(
										'name'	=> 'Carlos Aguirre',
										'mail' 	=> 'caguirre@tcevents.com',
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
		$cveRsv 		= time();
		$diasPago   = 0;
		$fpago 			= $request->request->get('pago');
		$data = array();
		$pages = array(
				'' 		=> 'mail-ffm-deposito-es.twig.html',
				'es' 	=> 'mail-ffm-deposito-es.twig.html',
				'en' 	=> 'mail-ffm-deposito-en.twig.html'
		);		
		if($request->request->get('pagoPor') == 'N'){
			$diasPago = 2;
		}
		else{
			$dl 			= $fllegada;
			$ds 			= $fsalida;
			$di 			= $fllegada->diff($fsalida);
			$diasPago = $di->format('%a');
		}
		$cargo 			= ($costoNoche * $diasPago) + $bellBoy;
		$request->request->set('claveReservacion',$cveRsv);
		$request->request->set('tipoHabitacion',$habitacion);
		$request->request->set('costoNoche',$costoNoche);
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
							"caguirre@tcevents.com" => "Carlos Aguirre"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion ');
			}
			else{
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setCc("caguirre@tcevents.com","Carlos Aguirre")
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion TERCER FORO FRANCO- MEXICANO DE CIENCIA, TECNOLOGÍA E INNOVACIÓN');				
			}
			$imgHotel 	= explode("/",$request->request->get('imgHotel'));
			$imgHotel_  = array_pop($imgHotel);
			$body = $app['twig']->render('pages/eventos17/FFM/'.$pages[$request->request->get('lang') ], array(
				"data"			=> $rsv,
				"idHotel" 	=> $request->request->get('idHotel'),
				"imgHotel" 	=> $imgHotel_,
				"pais" 			=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 		=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name')				
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
				'' 		=> 'ffm.confirmacion.twig.html',
				'es' 	=> 'ffm.confirmacion.twig.html',
				'en' 	=> 'ffm.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/FFM/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'ffm.politicas.twig.html',
				'es' 	=> 'ffm.politicas.twig.html',
				'en' 	=> 'ffm.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/FFM/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	
}
?>