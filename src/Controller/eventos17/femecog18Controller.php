<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class femecog18Controller implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\femecog18Controller::index')
		->bind('femecog.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\femecog18Controller::setReservacion')->bind('femecog.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\femecog18Controller::confirmacion')->bind('femecog.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\femecog18Controller::politicas')->bind('femecog.politicas')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'FEMECOG18/femecog.index.twig.html',
				'es' 	=> 'FEMECOG18/femecog.index.twig.html',
				'en' 	=> 'FEMECOG18/femecog.index.en.twig.html'
		);
		$fn 				= new Functions;
		$paises   = $fn->getCountryList();
		$hoteles = array();
		
		$hoteles[20] = array(
										'index' 				=> '20',
										'nombre' 				=> 	'HOTEL EL CID MARINA',
										'img' 					=> 	'cidMarina.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'2,873.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'25.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'3,103.01',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Triple',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'3,571.01',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Cuádruple',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'4,039.02',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
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
													'<li>Se realizará un cargo único de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
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

		$hoteles[1] = array(
								'index' 				=> '1',
								'nombre' 				=> 	'HOTEL EL CID EL MORO',
								'img' 					=> 	'CIDMoro.jpg',
								'agotado' 			=> false,
								'currency'   		=> array('mxn'),
								'habitaciones' 	=> 	array(
									array(
										'tipo' 		=> array(
											'es'	=> 'Habitacion Sencilla',
											'en' => '',
											'pt' 	=> ''
										),
										'costo' 	=> 	array(
											'mxn'	=>	'2,813.50',
											'usd'	=>	''
											),
										'propinas'	=>	array(
											'mxn'	=>	'25.00',
											'usd'	=>	''
											),
										'hagotada' => false
										),
									array(
										'tipo' 		=> array(
											'es' 	=> 'Habitacion Doble',
											'en'	=> '',
											'pt'	=> ''
										),
										'costo' 	=>  array(
											'mxn'	=>	'3,043.51',
											'usd'	=>	''
											),
										'propinas'	=>	array(
											'mxn'	=>	'50.00',
											'usd'	=>	''
											),
										'hagotada' => false
										),
									array(
										'tipo' 		=> array(
											'es' 	=> 'Habitacion Triple',
											'en'	=> '',
											'pt'	=> ''
										),
										'costo' 	=>  array(
											'mxn'	=>	'3,511.51',
											'usd'	=>	''
											),
										'propinas'	=>	array(
											'mxn'	=>	'50.00',
											'usd'	=>	''
											),
										'hagotada' => false
										),
									array(
										'tipo' 		=> array(
											'es' 	=> 'Habitacion Cuádruple',
											'en'	=> '',
											'pt'	=> ''
										),
										'costo' 	=>  array(
											'mxn'	=>	'3,979.52',
											'usd'	=>	''
											),
										'propinas'	=>	array(
											'mxn'	=>	'50.00',
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
											'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
											'<li>Se realizará un cargo unico de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
											'<li>Tarifas cotizadas en MN.</li>\n'.
											'</ul>\n'.
											'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
											'<ul>\n'.
											'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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
										'nombre' 				=> 	'HOTEL EL CID CASTILLA',
										'img' 					=> 	'cidCastilla.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'2,159.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'25.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,389.01',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Triple',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,857.01',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Cuádruple',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'3,325.02',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		$hoteles[3] = array(
										'index' 				=> '3',
										'nombre' 				=> 	'HOTEL EL CID GRANADA',
										'img' 					=> 	'cidGranada.jpeg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'2,087.60',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'25.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,317.61',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Triple',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,785.61',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Cuádruple',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'3,253.62',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		$hoteles[4] = array(
										'index' 				=> '4',
										'nombre' 				=> 	'HOTEL EMPORIO MAZATLÁN',
										'img' 					=> 	'emporio.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla (Dos Camas)',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'2,337.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'30.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,507.01',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'60.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $30.00 MN en habitación sencilla y $60.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		$hoteles[5] = array(
										'index' 				=> '5',
										'nombre' 				=> 	'HOTEL HOLIDAY INN RESORT',
										'img' 					=> 	'holiday-resort-mazatlan.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'2,492.60',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,741.80',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'100.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $50.00 MN en habitación sencilla y $100.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 14:00 hrs. / Check out 12:00 hrs. </li>\n'.
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
													'<li>Check inn 14:00 hrs. / Check out 12:00 hrs.</li>\n'.
													'</ul>\n'
											)					
		);

		$hoteles[6] = array(
										'index' 				=> '6',
										'nombre' 				=> 	'HOTEL PARK ROYAL MAZATLÁN',
										'img' 					=> 	'parkRoyal.jpg',
										'agotado' 			=> true,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Junior Suite Sencilla (Cama King)',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'2,330.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'40.00',
													'usd'	=>	''
													),
												'hagotada' => true
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Junior Suite Doble (Dos camas)',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,540.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'80.00',
													'usd'	=>	''
													),
												'hagotada' => true
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Junior Suite Doble (Cama King)',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,540.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'80.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $40.00 MN en habitación sencilla y $80.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		$hoteles[7] = array(
										'index' 				=> '7',
										'nombre' 				=> 	'HOTEL MISIÓN MAZATLÁN',
										'img' 					=> 	'MMision.jpg',
										'agotado' 			=> true,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,270.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'30.00',
													'usd'	=>	''
													),
												'hagotada' => true
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'1,270.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'60.00',
													'usd'	=>	''
													),
												'hagotada' => true
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Triple',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'1,565.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'60.00',
													'usd'	=>	''
													),
												'hagotada' => true
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Cuádruple',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,060.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'60.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $30.00 MN en habitación sencilla y $60.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		/*$hoteles[8] = array(
										'index' 				=> '8',
										'nombre' 				=> 	'CITY EXPRESS MAZATLÁN',
										'img' 					=> 	'CityMazatlan.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla (Camas queen)',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,057.52',
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
													'es' 	=> 'Habitacion Doble (Dos camas matrimoniales)',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'1,188.72',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 14:00 hrs. / Check out 12:00 hrs. </li>\n'.
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
		);*/

		$hoteles[9] = array(
										'index' 				=> '9',
										'nombre' 				=> 	'ROYAL VILLAS RESORT',
										'img' 					=> 	'VillasResort.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla Mitla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'2,345.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'25.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble Mitla',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,475.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 11:00 hrs. </li>\n'.
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

		$hoteles[10] = array(
										'index' 				=> '10',
										'nombre' 				=> 	'RAMADA RESORT & SPA MAZATLÁN',
										'img' 					=> 	'Mazatlan_Ramada.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,875.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'25.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,225.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 14:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		$hoteles[11] = array(
										'index' 				=> '11',
										'nombre' 				=> 	'HOTEL SUITES LAS FLORES BEACH RESORT',
										'img' 					=> 	'flores_beach.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,440.00',
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
													'es' 	=> 'Habitacion Jr. Suite Doble (Dos camas matrimoniales 1 sofa)',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,000.00',
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
													'es' 	=> 'Habitacion Jr. Suite Doble (Dos camas matrimoniales 2 sofas)',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,000.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Persona extra por noche $300.00</li>\n'.
													'<li>Check inn 15:00 hrs. / Check out 11:00 hrs.</li>\n'.
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

		$hoteles[12] = array(
										'index' 				=> '12',
										'nombre' 				=> 	'HOTEL QUALITY INN MAZATLÁN',
										'img' 					=> 	'quality-inn-mazatlan.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,533.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'10.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'1,533.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'20.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $10.00 MN en habitación sencilla y $20.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		$hoteles[13] = array(
										'index' 				=> '13',
										'nombre' 				=> 	'THE INN BEACH HOTEL MAZATLÁN',
										'img' 					=> 	'inn_beach.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Estudio Sencilla y/o Doble',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	' 2,507.58',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'20.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Junior Suite Sencilla y/o Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,884.81',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'20.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $20.00 MN en habitación sencilla y $40.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 11:00 hrs. </li>\n'.
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

		$hoteles[14] = array(
										'index' 				=> '14',
										'nombre' 				=> 	'HOTEL QUIJOTE INN',
										'img' 					=> 	'quijote.jpeg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Doble',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,495.01',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'40.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $40.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 16:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		/*$hoteles[15] = array(
										'index' 				=> '15',
										'nombre' 				=> 	'HOTEL DON PELAYO PACIFIC BEACH MAZATLÁN',
										'img' 					=> 	'hotel_pelayo.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Estandar Doble Vista Laguna',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'2,017.77',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Estandar Doble Vista al Mar',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,157.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Jr. Suites Doble Regular',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,297.42',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Jr. Suite Sencilla/Doble c/ Cocineta',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,439.03',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo unico de  $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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
		);*/

		$hoteles[16] = array(
										'index' 				=> '16',
										'nombre' 				=> 	'HOTEL PLAYA MAZATLÁN',
										'img' 					=> 	'playa_mazatlan.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla Vista al Jardin',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'2,142.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'20.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble Vista al Jardin',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,342.01',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'40.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Sencilla Vista al Mar',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,821.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'20.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble Vista al Mar',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'3,021.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'50.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $20.00 MN en habitación sencilla y $40.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		$hoteles[17] = array(
										'index' 				=> '17',
										'nombre' 				=> 	'HOTEL PLAYA BONITA',
										'img' 					=> 	'playaBonita.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,030.00',
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
													'es' 	=> 'Habitacion Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'1,255.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 14:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		$hoteles[18] = array(
										'index' 				=> '18',
										'nombre' 				=> 	'HOTEL COSTA DE ORO',
										'img' 					=> 	'Costa-de-Oro.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Sencilla Vista al Jardin',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,685.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'10.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble Vista al Jardin',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'1,865.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'20.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Sencilla Vista al Mar',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,050.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'10.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Doble Vista al Mar',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,230.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'20.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Suite Sencilla Vista al Mar',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,470.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'10.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Suite Dobel Vista al Mar',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,650.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'20.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $10.00 MN en habitación sencilla y $20.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		$hoteles[19] = array(
										'index' 				=> '19',
										'nombre' 				=> 	'OCEAN VIEW BEACH HOTEL',
										'img' 					=> 	'ocean.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Estandar Sencilla o Doble Visita al Mar (Dos camas matrimoniales)',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,570.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'30.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Estandar Sencilla o Doble Visita al Mar (Una Cama Queen)',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'1,570.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'30.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Jr. Suite Sencilla o Doble Vista a Ciudad (Dos camas Queen)',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'1,700.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'30.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Jr. Suite Sencilla o Doble vista al Mar (Dos camas Queen)',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,240.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'30.00',
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
													'<li>Renta de habitación en la ocupación seleccionada con desayuno buffet incluido para 1 o 2 personas,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo único de $30.00 MN en habitación sencilla y $60.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
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

		$hoteles[21] = array(
										'index' 				=> '21',
										'nombre' 				=> 	'HOTEL PUEBLO BONITO EMERALD BAY RESORT & SPA',
										'img' 					=> 	'PBonito.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Jr. Suite Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'3,280.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'55.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Jr. Suite Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'3,535.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'110.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo unico de $55.00 MN en habitación sencilla y 110.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check In 14:00 hrs / Check Out 11:00 hrs.</li>\n'.
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

		$hoteles[22] = array(
										'index' 				=> '22',
										'nombre' 				=> 	'HOTEL PUEBLO BONITO MAZATLÁN',
										'img' 					=> 	'PueBonito.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion Jr. Suite Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'2,710.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'55.00',
													'usd'	=>	''
													),
												'hagotada' => false
												),
											array(
												'tipo' 		=> array(
													'es' 	=> 'Habitacion Jr. Suite Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,965.00',
													'usd'	=>	''
													),
												'propinas'	=>	array(
													'mxn'	=>	'110.00',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>Se realizará un cargo unico de $55.00 MN en habitación sencilla y $110.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check In 14:00 hrs / Check Out 11:00 hrs.</li>\n'.
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

		$hoteles[23] = array(
										'index' 				=> '23',
										'nombre' 				=> 	'PARK INN BY RADISSON',
										'img' 					=> 	'parkInn.jpg',
										'agotado' 			=> false,
										'currency'   		=> array('mxn'),
										'habitaciones' 	=> 	array(
											array(
												'tipo' 		=> array(
													'es'	=> 'Habitacion STD Sencilla',
													'en' => '',
													'pt' 	=> ''
												),
												'costo' 	=> 	array(
													'mxn'	=>	'1,773.19',
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
													'es' 	=> 'Habitacion STD Doble',
													'en'	=> '',
													'pt'	=> ''
												),
												'costo' 	=>  array(
													'mxn'	=>	'2,061.39',
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
													'<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
													'<li>No aplica cargo por concepto de botones.</li>\n'.
													'<li>Tarifas cotizadas en MN.</li>'.
													'</ul>\n'.
													'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
													'<ul>\n'.
													'<li>Check In 14:00 hrs / Check Out 12:00 hrs.</li>\n'.
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
			'evento' 			=> '68 CONGRESO MEXICANO DE OBSTETRICIA Y GINECOLOGÍA',
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
				'' 		=> 'mail-femecog-deposito-es.twig.html',
				'es' 	=> 'mail-femecog-deposito-es.twig.html',
				'en' 	=> 'mail-femecog-deposito-en.twig.html'
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
					->setSubject('Inicio de proceso Reservacion 68 CONGRESO MEXICANO DE OBSTETRICIA Y GINECOLOGÍA');				
			}
			$imgHotel 	= explode("/",$request->request->get('imgHotel'));
			$imgHotel_  = array_pop($imgHotel);
			$body = $app['twig']->render('pages/eventos17/FEMECOG18/'.$pages[$request->request->get('lang') ], array(
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
				'' 		=> 'femecog.confirmacion.twig.html',
				'es' 	=> 'femecog.confirmacion.twig.html',
				'en' 	=> 'femecog.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/FEMECOG18/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'femecog.politicas.twig.html',
				'es' 	=> 'femecog.politicas.twig.html',
				'en' 	=> 'femecog.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/FEMECOG18/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	
}
?>