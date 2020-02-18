<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;
//use Lib\Functions\ppplusLive as ppplus;

define("SMORLCCC20","SMORL20n");

class Smorl20nController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get("/{idHotel}/{currency}/{lang}",sprintf('Controller\eventos17\%sController::index',SMORLCCC20))
		->bind(SMORLCCC20.".index")
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);		
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',SMORLCCC20))->bind(SMORLCCC20.".setReservacion");
		$index->get('/confirmacion/{lang}',sprintf('Controller\eventos17\%sController::confirmacion',SMORLCCC20))->bind(SMORLCCC20.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}',sprintf('Controller\eventos17\%sController::politicas',SMORLCCC20))->bind(SMORLCCC20.".politicas")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',SMORLCCC20))->bind(SMORLCCC20.".setReservacion");
		$index->post('/applyPay/{lang}',sprintf('Controller\eventos17\%sController::applyPay',SMORLCCC20))->bind(SMORLCCC20.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/checkOut/{lang}',sprintf('Controller\eventos17\%sController::checkOut',SMORLCCC20))->bind(SMORLCCC20.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payReturn/{lang}',sprintf('Controller\eventos17\%sController::payReturn',SMORLCCC20))->bind(SMORLCCC20.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payCancel/{lang}',sprintf('Controller\eventos17\%sController::payCancel',SMORLCCC20))->bind(SMORLCCC20.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/execute/{lang}',sprintf('Controller\eventos17\%sController::execute',SMORLCCC20))->bind(SMORLCCC20.'.execute')->assert('lang', '\w+')->value('lang', 'es');
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
				'nombre' 				=> 'HOTEL FIESTA AMERICANA MERIDA',
				'img' 					=> 'fiestaMerida.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACIÓN ESTÁNDAR SENCILLA',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'2,430.00',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'2,430.00',
								'usd'	=>	'0'
						),
						'propinas'	=>	array(
							'mxn'	=>	'45',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'HABITACIÓN ESTÁNDAR DOBLE',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,430.00',
							'usd'	=>	'0'
							),
						'costor' 	=>  array(
							'mxn'	=>	'2,430.00',
							'usd'	=>	'0'
							),
						'propinas'	=>	array(
							'mxn'	=>	'90',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
            )            
				),
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
                    '<li>Renta de Habitación por noche en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos incluidos), Impuestos y Propinas Camaristas.</li>'.
                    '<li>Se hará un solo cargo de $45.00 por habitación por persona por concepto de Propinas a Bell Boys.</li>'.
                    '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 12:00 hrs.</li>'.
                    '',
						'en' => ''
					)
			);

		$hoteles[2] =
			array(
				'index' 				=> '2',
				'nombre' 				=> 'HYATT REGENCY MERIDA',
				'img' 					=> 'hyattReMerida.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACIÓN DE LUJO SENCILLA',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'2,747.39',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'2,747.39',
								'usd'	=>	'0'
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
							'es' => 'HABITACIÓN DE LUJO DOBLE',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,777.39',
							'usd'	=>	'0'
							),
						'costor' 	=>  array(
							'mxn'	=>	'2,777.39',
							'usd'	=>	'0'
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
								'es' => 'HABITACIÓN HIGH FLOR SENCILLA',
								'en' => ''
							),
							'costo' 	=>  array(
								'mxn'	=>	'3,818.39',
								'usd'	=>	'0'
								),
							'costor' 	=>  array(
								'mxn'	=>	'3,818.39',
								'usd'	=>	'0'
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
								'es' => 'HABITACIÓN HIGH FLOR DOBLE',
								'en' => ''
							),
							'costo' 	=>  array(
								'mxn'	=>	'3,848.39',
								'usd'	=>	'0'
								),
							'costor' 	=>  array(
								'mxn'	=>	'3,848.39',
								'usd'	=>	'0'
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
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
                    '<li>Renta de Habitación por noche en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos incluidos), Impuestos, Propinas a Camaristas y Bell Boys.</li>'.
                    '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 12:00 hrs.</li>'.
                    '',
						'en' => ''
					)
			);			

		$hoteles[3] =
			array(
				'index' 				=> '3',
				'nombre' 				=> 'HOLIDAY INN MERIDA',
				'img' 					=> 'holidayMerida.jpg',
				'agotado' 			=> false,
				'hidden' => false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACIÓN DE LUJO SENCILLA',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'2,549.00',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'2,549.00',
								'usd'	=>	'0'
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
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
                    '<li>Renta de Habitación por noche en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos incluidos), Impuestos, Propinas a Camaristas y Bell Boys.</li>'.
                    '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 12:00 hrs.</li>'.
                    '',
						'en' => ''
					)
			);	

			$hoteles[4] =
			array(
				'index' 				=> '4',
				'nombre' 				=> 'PRESIDENTE INTERCONTINENTAL VILLAMERCEDES MERIDA',
				'img' 					=> 'presidenteVilla.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACIÓN DE LUJO SENCILLA',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'2,549.00',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'2,549.00',
								'usd'	=>	'0'
						),
						'propinas'	=>	array(
							'mxn'	=>	'55',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'HABITACIÓN ESTÁNDAR DOBLE',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,549.00',
							'usd'	=>	'0'
							),
						'costor' 	=>  array(
							'mxn'	=>	'2,549.00',
							'usd'	=>	'0'
							),
						'propinas'	=>	array(
							'mxn'	=>	'110',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => false
            )            
				),
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
                    '<li>Renta de Habitación por noche en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos incluidos), Impuestos y Propinas a Camaristas.</li>'.
                    '<li>Se hará un solo cargo de $55.00 por habitación por persona por concepto de Propinas a Bell Boys.</li>'.
                    '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 12:00 hrs.</li>'.
                    '',
						'en' => ''
					)
			);

			$hoteles[5] =
			array(
				'index' 				=> '5',
				'nombre' 				=> 'HOTEL NH COLLECTION MERIDA',
				'img' 					=> 'nhCollection.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACIÓN ESTANDAR SENCILLA',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'2,058.00',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'2,058.00',
								'usd'	=>	'0'
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
							'es' => 'HABITACIÓN ESTANDAR DOBLE',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,058.00',
							'usd'	=>	'0'
							),
						'costor' 	=>  array(
							'mxn'	=>	'2,058.00',
							'usd'	=>	'0'
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
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
                    '<li>Renta de Habitación por noche en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos incluidos), Impuestos y Propinas a Camaristas.</li>'.
                    '<li>Se hará un solo cargo de $40.00 por habitación por persona por concepto de Propinas a Bell Boys.</li>'.
                    '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 12:00 hrs.</li>'.
                    '',
						'en' => ''
					)
			);			

		$hoteles[6] =
			array(
				'index' 				=> '6',
				'nombre' 				=> 'HOTEL WYNDHAM MERIDA',
				'img' 					=> 'wyndham.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACIÓN ESTANDAR SENCILLA',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'1,867.60',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'1,867.60',
								'usd'	=>	'0'
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
							'es' => 'HABITACIÓN ESTANDAR DOBLE',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'1,867.60',
							'usd'	=>	'0'
							),
						'costor' 	=>  array(
							'mxn'	=>	'1,867.60',
							'usd'	=>	'0'
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
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
                    '<li>Renta de Habitación por noche en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos incluidos), Impuestos y Propinas a Camaristas.</li>'.
                    '<li>Se hará un solo cargo de $40.00 por habitación por persona por concepto de Propinas a Bell Boys.</li>'.
                    '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 12:00 hrs.</li>'.
                    '',
						'en' => ''
					)
			);

			$hoteles[7] =
			array(
				'index' 				=> '7',
				'nombre' 				=> 'HOTEL CITY EXPRESS PLUS MERIDA',
				'img' 					=> 'cityPlus.jpg',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'HABITACION ESTANDAR SENCILLA',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'2,090.01',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'2,090.01',
								'usd'	=>	'0'
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
							'es' => 'HABITACIÓN ESTANDAR DOBLE',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,270.00',
							'usd'	=>	'0'
							),
						'costor' 	=>  array(
							'mxn'	=>	'2,270.00',
							'usd'	=>	'0'
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
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
                    '<li>Renta de Habitación por noche en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos incluidos), Impuestos y Propinas a Camaristas.</li>'.
                    '<li>No aplica cargo por concepto de Bell Boys.</li>'.
                    '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 13:00 hrs.</li>'.
                    '',
						'en' => ''
					)
			);







  		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 				=> '',
			'evento' 				=> '70 CONGRESO DE LA SOCIEDAD MEXICANA DE OTORRINOLARINGOLOGIA Y CIRUGIA DE CABEZA Y CUELLO, A.C.',
			'hoteles' 			=> $hoteles,
			'hotelesJson' 	=> json_encode($hoteles),
			'currency' 			=> $currency,
			'idHotel' 			=> $idHotel,
			'lang' 					=> $lang,
			'paises' 				=> $paises,
			'logo' 					=> array(
			                                   'desktop_logo' => 'smorl20_120.png',
			                                   'mobile_logo'  => 'smorl20_100.png'
											),
			'css_logo'    	=> 'logoSmorl',
			'fechas'  			=> array(
													'es' => 'DEL 30 DE ABRIL AL 05 DE MAYO DE 2020',
													'en' => '' 
													),
			'sede'        	=> array(
													'es' => 'MERIDA, YUCATAN',
													'en' => '' 
													),
			'claveEvento' 	=> 'SMORLCCC20',
			'fechaLleMin'		=> '2020-04-30',
			'fechaLleMax'		=> '2020-05-04',
			'fechaSalMin'		=> '2020-05-01',
			'fechaSalMax'		=> '2020-05-05',
			'noches' 				=> 2,
			'urlIndex'			=> $app['url_generator']->generate(SMORLCCC20.".index"),
			'urlReserva'		=> $app['url_generator']->generate(SMORLCCC20.".setReservacion"),
			'urlConfirma'		=> $app['url_generator']->generate(SMORLCCC20.".confirmacion"),
			'urlApplyPay' 	=> $app['url_generator']->generate(SMORLCCC20.".applyPay"),
			'urlChekout'    => $app['url_generator']->generate(SMORLCCC20.".checkOut"),
			'urlExecute'    => $app['url_generator']->generate(SMORLCCC20.".execute"),
			'urlPayReturn'  => $app['url_generator']->generate(SMORLCCC20.".payReturn"),
			'rutaImg' 			=> 'smorl',
			'links'					=> array(
														'es' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(SMORLCCC20.".politicas"),
																								'name' 	=> 'Políticas de reservación'
																							),
																'formato'   => array()
																),
														'en' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(SMORLCCC20.".politicas"),
																								'name' 	=> 'Reservation Policies'
																							),
																'formato'   => array()
																) 			
													),
			'linksJson' 		=> json_encode(
														array(
														)
													),
			'operador'  		=> array(
													'name'			=> 'Carlos Aguirre',
													'sortName' 	=> 'CA',
													'mail' 			=> 'caguirre@tycgroup.com',
													'phone'			=> '+52 55 5148 75 00 ext: 69'
											),
            'extOperador'   => array(
                            array(
                              'name'      => 'Mariela Arellano',
                              'sortName'  => 'MA',
                              'mail'      => 'marellano@tycgroup.com',
                              'phone'     => '+52 55 5148 75 00 ext: 11'
                            )
                          ),											
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
			'mode' 					=> 'sandbox',
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
		$SMORLCCC20Rsv 		= time();
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
		$request->request->set('claveReservacion',$SMORLCCC20Rsv);
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
							//"marellano@tycgroup.com" => "Mariela Arellano",
							"caguirre@tycgroup.com" => "Carlos Aguirre"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('70 CONGRESO DE LA SOCIEDAD MEXICANA DE OTORRINOLARINGOLOGIA Y CIRUGIA DE CABEZA Y CUELLO, A.C.');
			}
			else{
				$mail
					->setTo("erubi@tycgroup.com","Edgar Rubi")
					->setBcc(array(
							//"lcazares@tcevents.com" => "Luis Cazares",
							//"marellano@tycgroup.com" => "Mariela Arellano",
							"caguirre@tycgroup.com" => "Carlos Aguirre"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion 70 CONGRESO DE LA SOCIEDAD MEXICANA DE OTORRINOLARINGOLOGIA Y CIRUGIA DE CABEZA Y CUELLO, A.C.');
			}
			$imgHotel = explode("/",$request->request->get('imgHotel'));
			$imgHotel = end($imgHotel);
			$imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/smorl/". $imgHotel;
			$body = $app['twig']->render('pages/eventos17/universal/'.$pages[$request->request->get('lang') ], array(
				"data"			=> $rsv,
				"idHotel" 	=> $request->request->get('idHotel'),
				"pais" 			=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 		=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name'),
				"bannerImg" => 'http://webapps.tycgroup.com/assets/img/bannerReMail.png',
				"imgHotel"  =>  $imgHotel,
				"operador"	=> array(
												'name'			=> 'Carlos Aguirre',
												'sortName' 	=> 'MA',
												'mail' 			=> 'caguirre@tcevents.com',
												'phone'			=> '+52 55 5148 75 00 ext: 69'
											)
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
				'' 		=> 'smorl.politicas.twig.html',
				'es' 	=> 'smorl.politicas.twig.html',
				'en' 	=> 'smorl.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/SMORLCCC20/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function _checkOut_(Request $request, Application $app,$lang){
		$response = array();
		$pay 			= new ppplus;
		$urls 		= array(
									'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(SMORLCCC20.".payReturn"),
									'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(SMORLCCC20.".payCancel")
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
        //"marellano@tycgroup.com" => "Mariela Arellano",
			))
			->setFrom('no--reply@sin-tcevents.mx','Pago completado')
      ->setSubject('70 CONGRESO DE LA SOCIEDAD MEXICANA DE OTORRINOLARINGOLOGIA Y CIRUGIA DE CABEZA Y CUELLO, A.C. -  Pago PayPlay completado');

      $bodyc = $app['twig']->render('pages/eventos17/universal/mail-complete.twig.html', array(
				'request' => $request->request->all()
			)
		);

		$mailc->setBody($bodyc, "text/html");
		$env = $app['mailer']->send($mailc); 

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'evento' 				=> '70 CONGRESO DE LA SOCIEDAD MEXICANA DE OTORRINOLARINGOLOGIA Y CIRUGIA DE CABEZA Y CUELLO, A.C.',
			'logo' 					=> array(
			                                   'desktop_logo' => 'smorl20_120.png',
			                                    'mobile_logo'  => 'smorl20_100.png'
											),
			'css_logo'    	=> 'logoSmorl',
			'fechas'  			=> array(
													'es' => 'DEL 30 DE ABRIL AL 05 DE MAYO DE 2020',
													'en' => '' 
													),
			'sede'        	=> array(
													'es' => 'MERIDA, YUCATAN',
													'en' => '' 
													),
			'claveEvento' 	=> 'SMORLCCC20',
			'lang' 					=> $lang,
			'operador'  		=> array(
													'name'			=> 'Carlos Aguirre',
													'sortName' 	=> 'CA',
													'mail' 			=> 'caguirre@tycgroup.com',
													'phone'			=> '+52 55 5148 75 00 ext: 69'
											),
			'request' 			=> $request->request,
      'urlIndex'      => $app['url_generator']->generate(SMORLCCC20.".index")
		));
	}	
	
}
?>

