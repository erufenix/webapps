<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class paratuberController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\paratuberController::index')
		->bind('pratuber.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\paratuberController::setReservacion')->bind('paratuber.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\paratuberController::confirmacion')->bind('paratuber.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\paratuberController::politicas')->bind('paratuber.politicas')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'paratuber.index.twig.html',
				'es' 	=> 'paratuber.index.twig.html',
				'en' 	=> 'paratuber.index.en.twig.html'
		);
		$hoteles = array(
			array(
				'index' 				=> '1',
				'nombre' 				=> 'HOTEL HARD ROCK RIVIERA MAYA',
				'img' 					=> '1.jpg',
				'agotado' 			=> false,
				'habitaciones'	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'Deluxe Gold Sencilla Hacienda',
							'en'	=> 'Deluxe Gold Single Hacienda',
						),
						'costo' 	=> array(
								'mxn'	=>	'6,361.52',
								'usd'	=>	'354.00'
						),
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'Deluxe Gold Doble Hacienda',
							'en' => 'Deluxe Gold Double Hacienda'
						),
						'costo' 	=>  array(
							'mxn'	=>	'7,367.37',
							'usd'	=>	'410.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'Deluxe Gold Sencilla Heaven',
							'en' => 'Deluxe Gold Single Heaven'
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,950.00',
							'usd'	=>	'373.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'Deluxe Gold Doble Heaven',
							'en' => 'Deluxe Gold Double Heaven'
						),
						'costo' 	=>  array(
							'mxn'	=>	'7,727.27',
							'usd'	=>	'430.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'hagotada' => false
						)											
					),
				'mensajes'	=> array(
							'es' => 
									'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
									'<ul><li>Habitación con cama tamaño King o dos camas por habitacion por noche.</li></ul>\n'.
									'<ul><li>Todos los alimentos y bebidas en el hotel, incluyendo bebidas alcohólicas.</li></ul>\n'.
									'<ul><li>Todos los impuestos y propinas.</li></ul>\n'.
									'<ul><li>24 horas de servicio a la habitacion.</li></ul>\n'.
									'<ul><li>Internet Inalámbrico.</li></ul>\n'.
									'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
									'<ul>\n'.
									'<li>Check In 16:00 hrs / Check Out 11:00 hrs.</li>\n'.
									'<li>Menores de 3 años compartiendo la habitación con sus padres son gratis (Máximo 2). Menores entre 4 y 17 años compartiendo la habitación con sus padres tiene un costo de $57.00 USD por menor, por noche.</li>\n'.
									'<li>La ocupacion máxima por habitación es cuatro (4) sin importar la edad. Ocupaciónes triples y cuádruples están limitadas al número de habitaciones disponibles en el Hotel. </li>\n'.
									'</ul>\n',
							'en' => 
									'<h3 class=\"c-theme-font c-font-uppercase\">Rate includes:</h3>\n'.
									'<ul>\n'.
									'<li>Room with a king-size bed or two beds per room per night.</li>\n'.
									'<li>All food and drinks in the hotel, including drinks.</li>\n'.
									'<li>All taxes and tips.</li>\n'.
									'<li>24 hours room service.</li>\n'.
									'<li>WIFi</li>\n'.
									'</ul>\n'.
									'<h3 class=\"c-theme-font c-font-uppercase\">Important notes:</h3>\n'.
									'<ul>\n'.
									'<li>Check In 16:00 hrs / Check Out 11:00 hrs.</li>\n'.
									'<li>Children under 3 years sharing room with parents are free (Maximum 2). Children between 4 and 17 years old sharing a room with their parents costs $ 57.00 USD per child, per night</li>\n'.
									'<li>The maximum occupancy per room is four (4) regardless of age. Triple and quadruple occupancy are limited to the number of rooms available at the Hotel.</li>\n'.
									'</ul>\n'				    				
					) 
				)
		);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 		=> '14 th International Colloquium on Paratuberculosis',
			'hoteles' 		=> $hoteles,
			'hotelesJson' 	=> json_encode($hoteles),
			'currency' 		=> $currency,
			'idHotel' 		=> $idHotel,
			'lang' 			=> $lang, 
			'operador'        => array(
									'name'	=> 'Carlos Aguirre',
									'mail' 	=> 'caguirre@tcevents.com',
									'phone'	=> '+52 55 5148 75 00 ext: 69' 
								),
			'url' 			=> (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST') . $request->server->get('REDIRECT_URL')
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
				'' 		=> 'mail-paratuber-deposito-es.twig.html',
				'es' 	=> 'mail-paratuber-deposito-es.twig.html',
				'en' 	=> 'mail-paratuber-deposito-en.twig.html'
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
							"caguirre@tcevents.com" => "Carlos Aguirre",
							"marellano@tcevents.com" => "Mariela Arellano"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion 14 th International Colloquium on Paratuberculosis');
			}
			else{
				$mail
					->setTo("marellano@tcevents.com","Mariela Arellano")
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"caguirre@tcevents.com" => "Carlos Aguirre",
							"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion 14 th International Colloquium on Paratuberculosis');				
			}
			$body = $app['twig']->render('pages/eventos17/'.$pages[$request->request->get('lang') ], array(
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
				'' 		=> 'paratuber.confirmacion.twig.html',
				'es' 	=> 'paratuber.confirmacion.twig.html',
				'en' 	=> 'paratuber.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'paratuber.politicas.twig.html',
				'es' 	=> 'paratuber.politicas.twig.html',
				'en' 	=> 'paratuber.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	

}
?>