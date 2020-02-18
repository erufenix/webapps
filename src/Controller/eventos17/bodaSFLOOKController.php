<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;
//use Lib\Functions\ppplusLive as ppplus;

define("bodaSFLOOK","bodaSFLOOK");

class bodaSFLOOKController implements ControllerProviderInterface {

	private $evento;
	private $fechas;
	private $sede;
	private $operador;
	private $extOperador;

	public function __construct(){
		$this->evento 			= "STEFFANY FLOOK Y JOSE PALACIO WEDDING ROOM BOOKING";
		$this->fechas 			= array(
													'es' => '1 AL 3 DE MAYO DE 2020',
													'en' => 'From 1st to 3rd, May, 2020' 
												);
		$this->sede 				= array(
													'es' => 'PLAYA DEL CARMEN- QUINTANA ROO',
													'en' => 'PLAYA DEL CARMEN- QUINTANA ROO' 
												);
		$this->operador 		= array(
													'name'			=> 'Carlos Aguirre',
													'sortName' 	=> 'CA',
													'mail' 			=> 'caguirre@tycgroup.com',
													'phone'			=> '+52 55 5148 75 00 ext: 69'
												);
    $this->extOperador 	=	array(
														array(
															'name'      => 'Mariela Arellano',
															'sortName'  => 'MA',
															'mail'      => 'marellano@tycgroup.com',
															'phone'     => '+52 55 5148 75 00 ext: 11'
														)
													);							
	}


	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get("/{idHotel}/{currency}/{lang}",sprintf('Controller\eventos17\%sController::index',bodaSFLOOK))
		->bind(bodaSFLOOK.".index")
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);		
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',bodaSFLOOK))->bind(bodaSFLOOK.".setReservacion");
		$index->get('/confirmacion/{lang}',sprintf('Controller\eventos17\%sController::confirmacion',bodaSFLOOK))->bind(bodaSFLOOK.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}',sprintf('Controller\eventos17\%sController::politicas',bodaSFLOOK))->bind(bodaSFLOOK.".politicas")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',bodaSFLOOK))->bind(bodaSFLOOK.".setReservacion");
		$index->post('/applyPay/{lang}',sprintf('Controller\eventos17\%sController::applyPay',bodaSFLOOK))->bind(bodaSFLOOK.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/checkOut/{lang}',sprintf('Controller\eventos17\%sController::checkOut',bodaSFLOOK))->bind(bodaSFLOOK.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payReturn/{lang}',sprintf('Controller\eventos17\%sController::payReturn',bodaSFLOOK))->bind(bodaSFLOOK.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payCancel/{lang}',sprintf('Controller\eventos17\%sController::payCancel',bodaSFLOOK))->bind(bodaSFLOOK.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/execute/{lang}',sprintf('Controller\eventos17\%sController::execute',bodaSFLOOK))->bind(bodaSFLOOK.'.execute')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'universal/es.index.twig.html',
				'es' 	=> 'universal/es.index.twig.html',
				'en' 	=> 'universal/en.index.twig.html'
		);
		$fn 				= new Functions;
		$paises   = array_column($fn->getCountryListArray($lang)['content']['geonames'], 'countryName', 'geonameId');


		$hoteles[1] =
			array(
				'index' 				=> '1',
				'nombre' 				=> 'HOTEL XCARET MÉXICO',
				'img' 					=> 'hotelXcaret2.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'SUITE RIVER EN CASA VIENTO Y/O ESPIRAL DOBLE (PRECIO POR NOCHE)',
							'en'	=> 'RIVER SUITE WIND HOUSE AND/OR ESPIRAL (PRICE PER NIGHT)',
						),
						'costo' 	=> array(
								'mxn'	=>	'9,550.00',
								'usd'	=>	'501.38'
						),
						'costor' 	=> array(
								'mxn'	=>	'9,550.00',
								'usd'	=>	'501.38'
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
							'es' => 'SUITE RIVER EN CASA VIENTO Y/O ESPIRAL TRIPLE (PRECIO POR NOCHE)',
							'en' => 'RIVER SUITE WIND HOUSE AND/OR ESPIRAL (PRICE PER NIGHT)'
						),
						'costo' 	=>  array(
							'mxn'	=>	'9,550.00',
							'usd'	=>	'689.44'
							),
						'costor' 	=>  array(
							'mxn'	=>	'9,550.00',
							'usd'	=>	'689.44'
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
				'all' => true,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
										'<li>Habitación, Desayuno, comida y cena en barra de especialidades o a la carta en los centros de consumo y horarios de operación regular del Hotel</li>'.
										'<li>Bar abierto del Hotel con bebidas nacionales e importadas dentro de los bares y restaurantes en horarios de operación regular del Hotel</li>'.
										'<li>Mini-bar en cada habitación (refrescos, cervezas y botellas de agua), surtido diariamente.</li>'.
										'<li>Hotel Xcaret México ofrece su Plan “ALL-FUN INCLUSIVE®” que redefine el todo incluido tradicional y lo convierte en una experiencia mucho más completa, donde le ofrecemos a nuestros Huéspedes, el Acceso ILIMITADO a todos los Parques y Tours de Experiencias Xcaret (Xcaret, Xel-Há, Xenses, Xplor, Xplor Fuego, Xoximilco y los Tours de Xichen, Xel -Há-Tulum y Xenotes), incluye alimentos de acuerdo al plan de cada parque y tour. Transportación gratuita compartida, NO personalizada. (todos los Parques, Tours y transportación deberán reservarse con un mínimo de 30 (treinta) días, los cuales estarán sujetos a la capacidad y disponibilidad de los mismos).</li>'.
										'<li>Shuttle. Aeropuerto – Hotel – Aeropuerto. Requiere reservación con un mínimo de 40 (cuarenta) días antes de la llegada para coordinar los traslados. Dicho servicio se brindará previa confirmación de disponibilidad de Shuttle y de acuerdo con las capacidades de operación del Hotel</li>'.
										'<li>Programa de actividades recreativas y de entretenimiento en EL HOTEL para adultos y niños.</li>'.
										'<li>Servicio de Wi-Fi en habitaciones y áreas públicas dentro del hotel.</li>'.
										'</ul>'.
										'<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
										'<ul>'.
                    '<li>Check in 15:00 hrs. / Check out 12:00 hrs.</li>'.
										'<li><strong>Persona adicional:</strong> se contempla a partir de los 6 años en adelante costo de <strong>188.06 USD</strong>. La capacidad máxima por habitación triple es de:'.
										'<ul>'.
										'<li>3 adultos</li>'.
										'<li>2 adultos y 1 niño</li>'.
										'<li>1 adulto y 2 niños</li>'.
										'</ul>'.
										'</li>'.									
										'<li>En caso de <strong>no presentarse</strong> a los tours <strong>(Xichen, Xel -Há-Tulum, Xenotes, Xochimilco y Xavage)</strong> con reservación confirmada, se aplicará una <strong>penalidad</strong> de $20 USD por persona.</li>'.
										'<li>El hotel solicitará al momento del Check in, una tarjeta de crédito para garantizar los posibles extras generados durante la estancia.</li>'.
										'</ul>'.
                    '',
						'en' => '<h3 class="c-theme-font c-font-uppercase">All Fun Inclusive Plan Rate includes:</h3>'.
										'<ul>'.
										'<li>Room, breakfast, meal, dinner at speacialty bar or menú at the consumption centers on the Hotel scheluded hours</li>'.
										'<li>Open bar with national and international drinks at the hotel bar and restaurants on the scheluded hours</li>'.
										'<li>Room mini-bar (sodas, beers and bottle of waters). Daily refilled.</li>'.
										'<li>Xcaret Hotel offers his ALL FUN INCLUSIVE Plan, which redefines the traditional all inclusive and turns it into an experience much more complete, where we offer our guests LIMITED access to all parks and tours of Xcarte Experiences (Xcaret, Xel-Há, Xenses, Xplor, Xplor Fuego, Xoximilco and Tours de Xichen, Xel -Há-Tulum y Xenotes Tours), includes meals according to each park and tour. Free share transportation, NON personalized (all parks, tours and transportation must be reserved minimum 30 days earlier, which will be subject to capacity and availability)</li>'.
										'<li>Shuttle Airport-Hotel.Airport. Requires preview reservation with minimum 40 days earlier to the arrival. Transportation will be provided with earlier confirmation and availability.</li>'.
										'<li>Recreational and entretaiment activities at THE HOTEL for adults and childs.</li>'.
										'<li>Inroom WIFI and public areas inside the hotel.</li>'.
										'</ul>'.
										'<h3 class="c-theme-font c-font-uppercase">Important notes:</h3>'.
										'<ul>'.
                    '<li>Check in 15:00 hrs. / Check out 12:00 hrs.</li>'.
										'<li><strong>Additional person:</strong> 6 years and older, <strong>$188.06 USD.</strong> Maximum capacity for triple rooms is:'.
										'<ul>'.
										'<li>3 adults</li>'.
										'<li>2 adults and 1 child</li>'.
										'<li>1 adult and 2 childs</li>'.
										'</ul>'.
										'</li>'.									
										'<li>In case of <strong>No-show</strong> at the the tours <strong>(Xichen, Xel -Há-Tulum, Xenotes, Xochimilco y Xavage)</strong> with confirmed reservation, a <strong>$20 USD penalty</strong> per person will be applied.</li>'.
										'<li>By checking in the Hotel will ask for a credit card in order to guarantee any extra charges during your stay</li>'.
										'</ul>'.
                    '',
					)
			);
			
														
										

  		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 				=> '',
			'evento' 				=> $this->evento,
			'hoteles' 			=> $hoteles,
			'hotelesJson' 	=> json_encode($hoteles),
			'currency' 			=> $currency,
			'idHotel' 			=> $idHotel,
			'lang' 					=> $lang,
			'paises' 				=> $paises,
			'logo' 					=> array(
											),
			'css_logo'    	=> false,
			'fechas'  			=> $this->fechas,
			'sede'        	=> $this->sede,
			'claveEvento' 	=> 'bodaSFLOOK',
			'fechaLleMin'		=> '2020-05-01',
			'fechaLleMax'		=> '2020-05-01',
			'fechaSalMin'		=> '2020-05-03',
			'fechaSalMax'		=> '2020-05-03',
			'disabledDates'     => false,
			'noches' 				=> 2,
			'urlIndex'			=> $app['url_generator']->generate(bodaSFLOOK.".index"),
			'urlReserva'		=> $app['url_generator']->generate(bodaSFLOOK.".setReservacion"),
			'urlConfirma'		=> $app['url_generator']->generate(bodaSFLOOK.".confirmacion"),
			'urlApplyPay' 	=> $app['url_generator']->generate(bodaSFLOOK.".applyPay"),
			'urlChekout'    => $app['url_generator']->generate(bodaSFLOOK.".checkOut"),
			'urlExecute'    => $app['url_generator']->generate(bodaSFLOOK.".execute"),
			'urlPayReturn'  => $app['url_generator']->generate(bodaSFLOOK.".payReturn"),
			'rutaImg' 			=> 'bodaSFLOOK',
			'links'					=> array(
														'es' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(bodaSFLOOK.".politicas"),
																								'name' 	=> 'Políticas de reservación'
																							),
																'formato'   => array()
																),
														'en' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(bodaSFLOOK.".politicas"),
																								'name' 	=> 'Reservation Policies'
																							),
																'formato'   => array()
																) 			
													),
			'flags'         => array(
				'es' => array(
								'fen' => array(
													'url'   => $app['url_generator']->generate(bodaSFLOOK.".index")."/1/$currency/en",
													'name'  => 'EN'
								)
				),
				'en' => array(
								'fes' => array(
													'url'   => $app['url_generator']->generate(bodaSFLOOK.".index")."/1/$currency/es",
													'name'  => 'ES'
								)
				),                                  

			),													
			'linksJson' 		=> json_encode(
														array(
														)
													),
			'operador'  		=> $this->operador,
      'extOperador'   => $this->extOperador,											
			'operadorJson' 	=> json_encode(
														array(
															'name'			=> 'Carlos Aguirre',
															'sortName' 	=> 'CA',
															'mail' 			=> 'caguirre@tycgroup.com',
															'phone'			=> '+52 55 5148 75 00 ext: 69'
														)														
													),
			'host' 					=> $request->server->get('HTTP_HOST'),
			'protocol' 			=> sprintf("%s://",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http'),
			'hostFullUri' 	=> sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME')),
			'hostFull' 			=> sprintf("%s://%s%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME') ,$request->server->get('REQUEST_URI')),
			'mode' 					=> 'live',
			'dateMsg' 			=> array(
												),
			'_msg_'					=> array(),
			'first' 				=> 1
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
		$bodaSFLOOKRsv 		= time();
		$diasPago   = 0;
		$fpago 			= $request->request->get('pago');
		$data = array();
		$pages = array(
				'' 		=> 'mail-deposito-es.twig.html',
				'es' 	=> 'mail-deposito-es.twig.html',
				'en' 	=> 'mail-deposito-en.twig.html'
		);
		if($pack != 0){
			$costoNochr = $costoNochr / $pack;
			$diasPago   = $pack;
		}
		elseif($request->request->get('pagoPor') == 'N'){
			$diasPago = $request->request->get('noches');
		}
		else{
			$dl 			= $fllegada;
			$ds 			= $fsalida;
			$di 			= $fllegada->diff($fsalida);
			$diasPago = $di->format('%a');
		}
		$cargo 			= ($costoNochr * $diasPago) + $bellBoy;
		$request->request->set('claveReservacion',$bodaSFLOOKRsv);
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
			$data['mode'] = $request->request->get('pmode');
			$data['lang'] = $request->request->get('lang');
			$mail 	= \Swift_Message::newInstance();
			$nombre = $request->request->get('nombre') . " " . $request->request->get('apaterno') ." " . $request->request->get('amaterno');
			if($fpago == 'DB'){
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setBcc(array(
							"erubi@tycgroup.com" => "Edgar Rubi",
							"marellano@tycgroup.com" => "Mariela Arellano",
							"caguirre@tycgroup.com" => "Carlos Aguirre"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject($this->evento);
			}
			else{
				$mail
					->setTo("erubi@tycgroup.com","Edgar Rubi")
					->setBcc(array(
							"lcazares@tcevents.com" => "Luis Cazares",
							"marellano@tycgroup.com" => "Mariela Arellano",
							"caguirre@tycgroup.com" => "Carlos Aguirre"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject("Inicio de proceso Reservacion " . $this->evento);
			}
			$imgHotel = explode("/",$request->request->get('imgHotel'));
			$imgHotel = end($imgHotel);
			$imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/bodaSFLOOK/". $imgHotel;
			$body = $app['twig']->render('pages/eventos17/universal/'.$pages[$request->request->get('lang') ], array(
				"data"			=> $rsv,
				"idHotel" 	=> $request->request->get('idHotel'),
				"pais" 			=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 		=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name'),
				"bannerImg" => 'http://webapps.tycgroup.com/assets/img/bannerReMail.png',
				"imgHotel"  =>  $imgHotel,
				"operador"	=> $this->operador
				)
			);
			$mail->setBody($body, "text/html");
			$env = $app['mailer']->send($mail);
			$json   	= array(
					'status'	=> true,
					'msg' 		=> '',
					'data' 		=> $data,
					'aData' 	=> $app["serializer"]->toArray($data),
					'request' => $request->request->all()
			);
		}
		return $app->json($json);
	}

	public function confirmacion(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'es.confirmacion.twig.html',
				'es' 	=> 'es.confirmacion.twig.html',
				'en' 	=> 'en.confirmacion.twig.html',
		);
		return $app['twig']->render("pages/eventos17/universal/" . $pages[$lang], array(
			'data' 			=> $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'bodaSFLOOK.politicas.twig.html',
				'es' 	=> 'bodaSFLOOK.politicas.twig.html',
				'en' 	=> 'bodaSFLOOK.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/bodaSFLOOK/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function _checkOut_(Request $request, Application $app,$lang){
		$response = array();
		$pay 			= new ppplus;
		$urls 		= array(
									'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(bodaSFLOOK.".payReturn"),
									'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(bodaSFLOOK.".payCancel")
								);
		$params 	= array(
									'nameProfile' => 'ReservasTyC_' . uniqid(),
									'logoImage' 	=> 'https://webapps.tycgroup.com/assets/img/logoTyC50.png',
									'shipping' 		=> 1,
									'address' 		=> 1,
									'landingPage' => 'billing',
									'bank' 				=> 'https://www.paypal.com'
								);
		return $app->json($pay->checkOut($request->query,$lang,$urls,$params));
	}

	public function checkOut(Request $request, Application $app,$lang){
		$model 	= $app["rsvModel"];
		$id 		= $request->query->get('id');
		$mode 	= $request->query->get('mode');
		$rsv 		= $model->getReservacion(array('idreservacion' =>$id));
		$langs 	= array(
								'es' => 'es_MX',
								'en' => 'en_US',
								'pt' => 'pt_BR'
							);
		$lang 	= $langs[$lang];
		$settings = array(
				'mode' 			=> $mode,
				'clientID' 	=> array(
													'sandbox' => 'Aamm4JcEPPuRAqkRYTDC44v2xyXPI3XlUlIOyCzM-jPuYoxTm4xyeX6vy0tcSZTUxPKUTkQhOI1NrGa2',
													'live' 		=> 'AXIjt9ZwFU34lIzBOlOb2ozh5ZyQ3Tif7hehrFgyhcBFFTValGA4835roqraOvM_voonyy2ceGSfJ0r-'
												),
				'secret' 		=> array(
													'sandbox' => 'ELqXRheFUcx7w41XVpT1IglSXRzgbwEQ9XpBZ5toqUJnm4tjY9oku3ynWbN1EkAK3gdWCxq-Ac7Vss-g',
													'live' 		=> 'EL-XIzcVqUMWNaZBThBH7yTVf2kkaKBSvN7wEV2pbYWZ34BTS4vtxzAZYA2EKzQQzxun4KvB-1Teyx9A'
												),
				'params' 		=> array(
													'nameProfile' => 'ReservasTyC_' . uniqid(),
													'logoImage' 	=> 'https://webapps.tycgroup.com/assets/img/logoTyC50.png',
													'shipping' 		=> 1,
													'address' 		=> 1,
													'landingPage' => 'billing',
													'bank' 				=> 'https://www.paypal.com'
												)
		);

		$urls 			= array(
										'return' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate(CVE.'.payReturn')),
										'cancel' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate(CVE.'.payCancel'))
									);

		$payData = array(
									'currency'					=> strtoupper($rsv->getDivisa()),
									'total' 						=> $rsv->getCargototal(),
									'subTotal' 					=> $rsv->getCargototal(),
									'description' 			=> $rsv->getNombreevento() .", " . $rsv->getNombrehotel() ." - ". $rsv->getTipohabitacion(),
									'name' 							=> $rsv->getNombre() ." ". $rsv->getApp() ." ". $rsv->getApm(),
									'address1' 					=> $rsv->getDireccion() .", ". $rsv->getColonia(),
									'address2' 					=> '',
									'city' 							=> '_',
									'country_code' 			=> 'MX',
									'cp' 								=> $rsv->getCp(),
									'state' 						=> $rsv->getEstado(),
									'phone' 						=> $rsv->getTelefono(),
									'item_name' 				=> $rsv->getNombreevento(),
									'item_description' 	=> $rsv->getNombreevento() .", " . $rsv->getNombrehotel() ." - ". $rsv->getTipohabitacion(),
									'item_price' 				=> $rsv->getCargototal(),
									'item_sku' 					=> $rsv->getClaveevento() ."-". $rsv->getClavereservacion(),
									'item_currency' 		=> strtoupper($rsv->getDivisa()),
									'email' 						=> $rsv->getEmail()
								);
		$ppPlus 		= new ppPlus($settings);
		return $app->json($ppPlus->getApproval($payData,$urls,$lang));
	}

	public function _execute_(Request $request, Application $app,$lang){
		$pay 			= new ppplus;
		$exeUrl 	= $request->query->get('exeUrl');
		$payerId 	= $request->query->get('payer_id');
		$token 		= $request->query->get('token');
		return $app->json($pay->execute($exeUrl,$token,$payerId));
	}
	
	
	public function execute(Request $request, Application $app,$lang){
		$ppPlus 	= new ppPlus(array());
		$exeUrl 	= $request->query->get('exeUrl');
		$payerId 	= $request->query->get('payer_id');
		$token 		= $request->query->get('token');
		return $app->json($ppPlus->execute($exeUrl,$token,$payerId));
	}

	public function payReturn(Request $request, Application $app,$lang){
    $model  = $app["rsvModel"];
    $tx     = $request->request->get('tx');
    $id     = $request->request->get('data')['idreservacion'];
		$pages = array(
				'' 		=> 'universal/es.return.twig.html',
				'es' 	=> 'universal/es.return.twig.html',
				'en' 	=> 'universal/en.return.en.twig.html'
		);
		$model->setValue('tx',$tx,$id);
		
		$mailc 	= \Swift_Message::newInstance();
		$mailc
			->setTo('erubi@tycgroup.com','Edgar Rubi')
			->setBcc(array(
				"caguirre@tycgroup.com" => "Carlos Aguirre",
        "marellano@tycgroup.com" => "Mariela Arellano",
			))
			->setFrom('no--reply@sin-tcevents.mx','Pago completado')
      ->setSubject($this->evento . "-  Pago PayPlay completado");

      $bodyc = $app['twig']->render('pages/eventos17/universal/mail-complete.twig.html', array(
				'request' => $request->request->all()
			)
		);

		$mailc->setBody($bodyc, "text/html");
		$env = $app['mailer']->send($mailc); 

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'evento' 				=> $this->evento,
			'logo' 					=> array(
											),
			'css_logo'    	=> false,
			'fechas'  			=> $this->fechas,
			'sede'        	=> $this->sede,
			'claveEvento' 	=> 'bodaSFLOOK',
			'lang' 					=> $lang,
			'operador'  		=> $this->operador,
			'request' 			=> $request->request,
      'urlIndex'      => $app['url_generator']->generate(bodaSFLOOK.".index")
		));
	}	
	
}
?>