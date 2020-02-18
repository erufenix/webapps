<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class CLEIC17Controller implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\CLEIC17Controller::index')
		->bind('CLEIC17.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\CLEIC17Controller::setReservacion')->bind('CLEIC17.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\CLEIC17Controller::confirmacion')->bind('CLEIC17.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\CLEIC17Controller::politicas')->bind('CLEIC17.politicas')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'cleic/CLEIC17.index.twig.html',
				'es' 	=> 'cleic/CLEIC17.index.twig.html',
				'en' 	=> 'cleic/CLEIC17.index.en.twig.html'
		);
		$hoteles = array(
			array(
				'index' 				=> '1',
				'nombre' 				=> 'Hotel Misión Carlton Guadalajara',
				'img' 					=> '1.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'Paquete Habitación Sencilla',
							'en'	=> 'Single Room Package',
						),
						'costo' 	=> array(
								'mxn'	=>	'4,800.00',
								'usd'	=>	'354.00'
						),
						'costor' 	=> array(
								'mxn'	=>	'4,800.00',
								'usd'	=>	'354.00'
						),						
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'pack' => 3,
						'pp' 		=> 0,
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'Paquete Habitación Doble',
							'en' => 'Double Room Package'
						),
						'costo' 	=>  array(
							'mxn'	=>	'6,900.00',
							'usd'	=>	'410.00'
							),
						'costor' 	=>  array(
							'mxn'	=>	'6,900.00',
							'usd'	=>	'410.00'
							),						
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'pack' => 3,
						'pp' 		=> 0,
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'Paquete Habitación Cuadruple (costo por persona)',
							'en' => 'Deluxe Gold Single Heaven'
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,950.00',
							'usd'	=>	'373.00'
							),
						'costor' 	=>  array(
							'mxn'	=>	'11,800.00',
							'usd'	=>	'373.00'
							),						
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'pack' => 3,
						'pp' 		=> 4,
						'hagotada' => false
						),
						array(
							'sep' => true
						),
					array(
						'tipo' 	=> array(
							'es' => 'DAY PASS (por persona)',
							'en' => 'DAY PASS (per person)'
						),
						'costo' 	=>  array(
							'mxn'	=>	'800.00',
							'usd'	=>	'373.00'
							),
						'costor' 	=>  array(
							'mxn'	=>	'800.00',
							'usd'	=>	'373.00'
							),						
						'propinas'	=>	array(
							'mxn'	=>	'0',
							'usd'	=>	'0'
							),
						'pack' => 3,
						'pp' 		=> 0,
						'hagotada' => false
						)
				),
				'mensajes'			=> array(
						'es' => '<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
										'<ul>\n'.
										'<li>3 desayunos tipo buffet, 2 comidas tipo buffet y 2 cenas tipo buffet en las instaciones del Hotel.</li>\n'.
										'<li>Cena de gala programada el 04 de noviembre de 2017, fuera del Hotel.</li>\n'.
										'<li>Todos los impuestos y propinas.</li>'.
										'<li>Todos los huéspedes entran con la cena del día 02 de noviembre y salen con el desayuno del 05 de noviembre.</li>'.
										'<li>El check in es a las 15:00 hrs. y la salida a las 12:00 hrs.</li>\n'.
										'</ul>\n'.
										'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa DAY PASS incluye:</h3>\n'.
										'<ul>\n'.
										'<li>Coffe breck durante el Congreso en el Hotel (3 días).</li>\n'.
										'<li>Una bebida durante el coktel de bienvenida del Congreso.</li>\n'.
										'<li>Cena de gala programada el 04 de noviembre de 2017, fuera del Hotel.</li>\n'.
										'<li>Todos los impuestos y propinas.</li>\n'.
										'</ul>\n',
						'en' => ''
					)		
			)
		);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 			=> 'XXVI CONGRESO LATINOAMERICANO DE ESTUDIANTES DE INGENIERIA CIVIL',
			'hoteles' 		=> $hoteles,
			'hotelesJson' => json_encode($hoteles),
			'currency' 		=> $currency,
			'idHotel' 		=> $idHotel,
			'lang' 				=> $lang, 
			'operador'  	=> array(
										'name'	=> 'Mariela Arrellano',
										'mail' 	=> 'marrelano@tcevents.com',
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
				'' 		=> 'mail-CLEIC17-deposito-es.twig.html',
				'es' 	=> 'mail-CLEIC17-deposito-es.twig.html',
				'en' 	=> 'mail-CLEIC17-deposito-en.twig.html'
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
					->setSubject('Reservacion XXVI CONGRESO LATINOAMERICANO DE ESTUDIANTES DE INGENIERIA CIVIL');
			}
			else{
				$mail
					->setTo("marellano@tcevents.com","Mariela Arellano")
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion XXVI CONGRESO LATINOAMERICANO DE ESTUDIANTES DE INGENIERIA CIVIL');				
			}
			$body = $app['twig']->render('pages/eventos17/cleic/'.$pages[$request->request->get('lang') ], array(
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
				'' 		=> 'CLEIC17.confirmacion.twig.html',
				'es' 	=> 'CLEIC17.confirmacion.twig.html',
				'en' 	=> 'CLEIC17.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/cleic/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'CLEIC17.politicas.twig.html',
				'es' 	=> 'CLEIC17.politicas.twig.html',
				'en' 	=> 'CLEIC17.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/cleic/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	

}
?>