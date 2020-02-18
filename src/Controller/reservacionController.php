<?php
namespace Controller;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;


class reservacionController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\reservacionController::index')
		->bind('reservacion.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\reservacionController::setReservacion')->bind('reservacion.setReservacion');
		$index->get('/politicas','Controller\reservacionController::politicas')->bind('reservacion.politicas');
		$index->get('/politicas_pt','Controller\reservacionController::politicas_pt')->bind('reservacion.politicas_pt');
		$index->get('/confirmacion/{lang}','Controller\reservacionController::confirmacion')->bind('reservacion.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/statusReservacion','Controller\reservacionController::statusReservacion')->bind('reservacion.statusReservacion');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'index.twig.html',
				'es' 	=> 'index.twig.html',
				'en' 	=> 'index.en.twig.html',
				'pt' 	=> 'index.pt.twig.html'
		);
		$hoteles = array();
		$hoteles[1] = 			array(
				'index' 				=> '1',
				'nombre' 				=> 'Grand Fiesta Americana Coral Beach',
				'img' 					=> '1.jpg',
				'agotado' 			=> false,
				'habitaciones'	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'Junior Suite Sencilla',
							'en'	=> 'Junior Suite Single',
							'pt' 	=> 'Junior Suite Simple'
						),
						'costo' 	=> array(
								'mxn'	=>	'5,481.00',
								'usd'	=>	'305.00'
						),
						'propinas'	=>	array(
							'mxn'	=>	'144.00',
							'usd'	=>	'8.00'
							),
						'hagotada' => false
						),
					array(
						'tipo' 	=> array(
							'es' => 'Junior Suite Doble',
							'en' => 'Junior Suite Double',
							'pt' => 'Junior Suite Duplo'
						),
						'costo' 	=>  array(
							'mxn'	=>	'5,481.00',
							'usd'	=>	'305.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'288.00',
							'usd'	=>	'16.00'
							),
						'hagotada' => false
						)
					),
				'All' => false,
				'mensajes'	=> array(
							'es' => 
									'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
									'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
									'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
									'<ul>\n'.
                     						 '<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ('.($currency == "mxn" ? '$144 MXP' : '$8.00 USD').').</li>\n'.
                      						'<li>El cargo por persona extra es de $864.00 MXP / 48.00 USD mas impuestos, no se aceptan cuadruples.</li>\n'.
                      						'<li>Máximo dos niños menores de 12 año sin cargo, compartiendo la misma habitación que sus padres</li>\n'.
									'<li>Check inn 15:00 hrs. / Check out 12:00 hrs.</li>\n'.
					            			'</ul>\n',
							'en' => 
									'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
					            			'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
								   	'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
								   	'<ul>\n'.
								   	'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ($ 8.00 USD).</li>\n'.
								   	'<li>El cargo por persona extra es de 48.00 USD mas impuestos, no se aceptan cuadruples.</li>\n'.
								   	'<li>Máximo dos niños menores de 12 año sin cargo, compartiendo la misma habitación que sus padres</li>\n'.
								   	'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
								   	'</ul>\n',
					   		'pt' => 
									'<h3 class=\"c-theme-font c-font-uppercase\"> A taxa inclui: :</h3>\n'.
					            			'<ul><li>Aluguel do quarto da categoria selecionada, 16% IVA, 3% ISH (imposto sobre hospedagem) e gorjeta ao serviço de limpeza. </li></ul>\n'.
								   	'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
								   	'<ul>\n'.
								   	'<li>Um cobro único será efetuado para gorjeta dos bell boys por persona (8.00 USD). </li>\n'.
								   	'<liA taxa por pessoa adicional é de $864.00 MXP / 48.00 USD mais impostos, quádruplo não é aceite.</li>\n'.
								   	'<li>Máxima duas crianças menores e 12 anos sem taxa adicional, no mesmo quarto que os seus pais.</li>\n'.
								   	'<li>Check inn 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
								   	'</ul>\n'					    				
					) 
				);

		$hoteles[2] = array(
				'index' 			=> '2',
				'nombre' 			=> 'Krystal Grand Punta Cancún',
				'img' 				=> '2.jpg',
				'agotado' 		=> true,
				'habitaciones' 	=> 	array(
					array(
						'tipo' 		=> array(
							'es' 	=> 'Sencilla Estándar',
							'en'	=> 'Simple Standard',
							'pt' 	=> 'Simple Standard'
						),
						'costo' 	=> 	array(
							'mxn'	=>	'3,206.00',
							'usd'	=>	'189.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'90.00',
							'usd'	=>	'5.00'
							),
						'hagotada' => false
						),
					array(
						'tipo' 		=> array(
							'es' => 'Doble Estándar',
							'en' => 'Double Standar',
							'pt' => 'Double Standar'
						),
						'costo' 	=>  array(
							'mxn'	=>	'3,206.00',
							'usd'	=>	'189.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'180.00',
							'usd'	=>	'10.00'
							),
						'hagotada' => false
						)
					),
				'All' => false,
				'mensajes' 			=> array(
					'es' => 
						'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
						'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
						'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
						'<ul>\n'.
						'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ('.($currency == "mxn" ? '$90 MXP' : '$5.00 USD').').</li>\n'.
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
						'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
						'<ul><li>Aluguel do quarto da categoria selecionada, 16% IVA, 3% ISH (imposto sobre hospedagem) e gorjeta ao serviço de limpeza.</li></ul>\n'.
						'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
						'<ul>\n'.
						'<li>Um cobro único será efetuado para gorjeta dos bell boys por persona (5.00 USD). </li>\n'.
						'<li>Check inn 15:00 hrs. / Check out 12:00 hrs.</li>\n'.
						'</ul>\n'
					)				
				);

		$hoteles[3] = array(
				'index' 				=> '3',
				'nombre' 				=> 	'Krystal Cancún',
				'img' 					=> 	'3.jpg',
				'agotado' 			=> true,
				'habitaciones' 	=> 	array(
					array(
						'tipo' 		=> array(
							'es'	=> 'Sencilla',
							'en' => 'Simple',
							'pt' 	=> 'Simple'
						),
						'costo' 	=> 	array(
							'mxn'	=>	'2,599.00',
							'usd'	=>	'153.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'90.00',
							'usd'	=>	'5.00'
							),
						'hagotada' => false
						),
					array(
						'tipo' 		=> array(
							'es' 	=> 'Doble',
							'en'	=> 'Double',
							'pt'	=> 'Duplo'
						),
						'costo' 	=>  array(
							'mxn'	=>	'2,599.00',
							'usd'	=>	'153.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'180.00',
							'usd'	=>	'10.00'
							),
						'hagotada' => false
						),
					array(
						'tipo' 		=> array(
							'es'	=> 'Sencilla Krystal Club',
							'en' => 'Simple Krystal Club',
							'pt' 	=> 'Simple Krystal Club'
						),
						'costo' 	=>  array(
							'mxn'	=>	'3,206.00',
							'usd'	=>	'189.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'90.00',
							'usd'	=>	'5.00'
							),
						'hagotada' => false
						),
					array(
						'tipo' 		=> array(
							'es' => 'Doble Krystal Club',
							'en' => 'Double Krystal Club',
							'pt' => 'Duplo Krystal Club'
						),
						'costo' 	=>  array(
							'mxn'	=>	'3,206.00',
							'usd'	=>	'189.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'180.00',
							'usd'	=>	'10.00'
							),
						'hagotada' => false
						)
					),
				'All' => false,
				'mensajes' => array(
						'es' => 
							'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
							'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
							'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
							'<ul>\n'.
							'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ('.($currency == "mxn" ? '$90 MXP' : '$5.00 USD').').</li>\n'.
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
				'nombre' 				=> 'Presidente Cancún',
				'img' 					=> '4.jpg',
				'agotado' 			=> true,
				'habitaciones' 	=> 	array(
					array(
						'tipo' 		=> array(
							'es' 	=> 'Sencilla Estándar',
							'en'	=> 'Simple Standard',
							'pt' => 'Simple Standard'
						),
						'costo' 	=> 	array(
							'mxn'	=>	'3,956.00',
							'usd'	=>	'206.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'80.00',
							'usd'	=>	'5.00'
							),
						'hagotada' => true
						),
					array(
						'tipo' => array(
							'es' => 'Doble Estándar',
							'en' => 'Double Standard',
							'pt' => 'Duplo Standard'
						),						
						'costo' 	=>  array(
							'mxn'	=>	'3,956.00',
							'usd'	=>	'206.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'160.00',
							'usd'	=>	'10.00'
							),
						'hagotada' => true
						),
					array(
						'tipo' 		=> array(
							'es' 	=> 'Sencilla Deluxe Ocean Front',
							'en'	=> 'Simple Deluxe Ocean Front',
							'pt'    => 'Simple Deluxe Ocean Front'
						),
						'costo' 	=> 	array(
							'mxn'	=>	'3,982.00',
							'usd'	=>	'228.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'80.00',
							'usd'	=>	'5.00'
							),
						'hagotada' => true
						),
					array(
						'tipo' 		=> array(
							'es' 	=> 'Doble Deluxe Ocean Front',
							'en'	=> 'Double Deluxe Ocean Front',
							'pt'    => 'Duplo Deluxe Ocean Front'
						),
						'costo' 	=> 	array(
							'mxn'	=>	'3,982.00',
							'usd'	=>	'228.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'160.00',
							'usd'	=>	'10.00'
							),
						'hagotada' => true
						)						
					),
				'All' => false,					
				'mensajes' => array(
					'es' => 
						'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
						'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
						'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
						'<ul>\n'.
						'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ('.($currency == "mxn" ? '$80 MXP' : '$5.00 USD').'). </li>\n'.
						'<li>Check inn 15:00 hrs. / Check out 13:00 hrs.</li>\n'.
						'</ul>\n',
					'en' => 
						'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
						'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
						'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
						'<ul>\n'.
						'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ($ 5.00 USD).</li>\n'.
						'<li>Check inn 15:00 hrs. / Check out 13:00 hrs.</li>\n'.
						'</ul>\n',
					'pt' 	=> 
						'<h3 class=\"c-theme-font c-font-uppercase\">A taxa inclui:</h3>\n'.
						'<ul><li>Aluguel do quarto da categoria selecionada, 16% IVA, 3% ISH (imposto sobre hospedagem) e gorjeta ao serviço de limpeza.</li></ul>\n'.
						'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
						'<ul>\n'.
						'<li>Um cobro único será efetuado para gorjeta dos bell boys por persona (5.00 USD).</li>\n'.
						'<li>Check in 15:00 hrs. / Check out 13:00 hrs. </li>\n'.
						'</ul>\n'
					)			
				);

			$hoteles[6] = array(
					'index' 				=> '6',
					'nombre' 				=> 'HOTEL KIN HA BEACHSCAPE',
					'img' 					=> '6.jpg',
					'agotado' 			=> true,
					'habitaciones' 	=> 	
						array(
							array(
								'tipo' 		=> array(
									'es' 	=> 'Sencilla Estándar',
									'en'	=> 'Simple Standard',
									'pt' => 'Simple Standard'
								),
								'costo' 	=> 	array(
									'mxn'	=>	'1957.00',
									'usd'	=>	'109.00'
									),
								'propinas'	=>	array(
									'mxn'	=>	'45.00',
									'usd'	=>	'3.5.00'
									),
								'hagotada' => false
								),
							array(
								'tipo' 		=> array(
									'es' 	=> 'Estándar Doble',
									'en'	=> 'Double Standard',
									'pt' => 'Double Standard'
								),
								'costo' 	=> 	array(
									'mxn'	=>	'1957.00',
									'usd'	=>	'109.00'
									),
								'propinas'	=>	array(
									'mxn'	=>	'60.00',
									'usd'	=>	'3.5.00'
									),
								'hagotada' => false
								)															
						),
					'All' => true,	
					'mensajes' => array(
						'es' => 
							'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
							'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
							'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
							'<ul>\n'.
							'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ('.($currency == "mxn" ? '$60.00 MXP' : '$3.5.00 USD').'). </li>\n'.
							'<li>Check inn 15:00 hrs. / Check out 12:00 hrs.</li>\n'.
							'</ul>\n',
						'en' => 
							'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
							'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
							'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
							'<ul>\n'.
							'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ('.($currency == "mxn" ? '$60.00 MXP' : '$3.5.00 USD').').</li>\n'.
							'<li>Check inn 15:00 hrs. / Check out 12:00 hrs.</li>\n'.
							'</ul>\n',
						'pt' 	=> 
							'<h3 class=\"c-theme-font c-font-uppercase\">A taxa inclui:</h3>\n'.
							'<ul><li>Aluguel do quarto da categoria selecionada, 16% IVA, 3% ISH (imposto sobre hospedagem) e gorjeta ao serviço de limpeza.</li></ul>\n'.
							'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
							'<ul>\n'.
							'<li>Um cobro único será efetuado para gorjeta dos bell boys por persona ('.($currency == "mxn" ? '$60.00 MXP' : '$3.5.00 USD').').</li>\n'.
							'<li>Check in 15:00 hrs. / Check out 12:00 hrs. </li>\n'.
							'</ul>\n'
						)						
				); 		 		

	
			/*$aloft = array(
				'index' 				=> '5',
				'nombre' 				=> 'Aloft Cancún',
				'img' 					=> '5.jpg',
				'agotado' 			=> true,
				'habitaciones' 	=> array(
					array(
						'tipo' 		=> array(
							'es'	=> 'Sencilla Estándar',
							'en'	=> 'Simple Standard',
							'pt'	=> 'Simple Standard'
						),
						'costo' 		=> array(
							'mxn'	=>	'0.00',
							'usd'	=>	'112.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'0.00',
							'usd'	=>	'0.00'
							),
						'hagotada' => false
						),
					array(
						'tipo' 		=> array(
							'es'	=> 'Doble Estándar',
							'es' => 'Double Standard',
							'pt'	=> 'Duplo Standard'
						),
						'costo' 		=>  array(
							'mxn'	=>	'0.00',
							'usd'	=>	'112.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'0.00',
							'usd'	=>	'0.00'
							),
						'hagotada' => false
						)
					),
				'mensajes' => array(
					'es' => '',
					'en' => 
						'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
						'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
						'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
						'<ul>\n'.
						'<li>Check inn 15:00 hrs. / Check out 13:00 hrs.</li>\n'.
						'</ul>\n',
					'pt' 	=> 
						'<h3 class=\"c-theme-font c-font-uppercase\">A taxa inclui:</h3>\n'.
						'<ul><li>Aluguel do quarto da categoria selecionada, 16% IVA, 3% ISH (imposto sobre hospedagem) e gorjeta ao serviço de limpeza.</li></ul>\n'.
						'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
						'<ul>\n'.
						'<li>Check inn 15:00 hrs. / Check out 13:00 hrs.</li>\n'.
						'</ul>\n'
					)				

		);*/
		
		if((($lang == 'en' || $lang == 'pt') && ($currency=='usd'))){
			//array_push($hoteles, $aloft);
			$hoteles[5] = array(
				'index' 				=> '5',
				'nombre' 				=> 'Aloft Cancún',
				'img' 					=> '5.jpg',
				'agotado' 			=> true,
				'habitaciones' 	=> array(
					array(
						'tipo' 		=> array(
							'es'	=> 'Sencilla Estándar',
							'en'	=> 'Simple Standard',
							'pt'	=> 'Simple Standard'
						),
						'costo' 		=> array(
							'mxn'	=>	'0.00',
							'usd'	=>	'112.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'0.00',
							'usd'	=>	'0.00'
							),
						'hagotada' => false
						),
					array(
						'tipo' 		=> array(
							'es'	=> 'Doble Estándar',
							'es' => 'Double Standard',
							'pt'	=> 'Duplo Standard'
						),
						'costo' 		=>  array(
							'mxn'	=>	'0.00',
							'usd'	=>	'112.00'
							),
						'propinas'	=>	array(
							'mxn'	=>	'0.00',
							'usd'	=>	'0.00'
							),
						'hagotada' => false
						)
					),
				'All' => false,
				'mensajes' => array(
					'es' => '',
					'en' => 
						'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
						'<ul><li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li></ul>\n'.
						'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
						'<ul>\n'.
						'<li>Check inn 15:00 hrs. / Check out 13:00 hrs.</li>\n'.
						'</ul>\n',
					'pt' 	=> 
						'<h3 class=\"c-theme-font c-font-uppercase\">A taxa inclui:</h3>\n'.
						'<ul><li>Aluguel do quarto da categoria selecionada, 16% IVA, 3% ISH (imposto sobre hospedagem) e gorjeta ao serviço de limpeza.</li></ul>\n'.
						'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>\n'.
						'<ul>\n'.
						'<li>Check inn 15:00 hrs. / Check out 13:00 hrs.</li>\n'.
						'</ul>\n'
					)				
			); 
		}

		$hoteles[7] = array(
			'index' 				=> '7',
			'nombre' 				=> 'REAL INN CANCUN',
			'img' 					=> '7.jpg',
			'agotado' 			=> false,
			'habitaciones' 	=> array(
				array(
					'tipo' 		=> array(
						'es'	=> 'Deluxe Sencilla o Doble',
						'en'	=> 'Deluxe Single or Double',
						'pt'	=> 'Deluxe Único ou Duplo'
					),
					'costo' 		=> array(
						'mxn'	=>	'1939.00',
						'usd'	=>	'98.00'
						),
					'propinas'	=>	array(
						'mxn'	=>	'45.00',
						'usd'	=>	'2.50'
						),
					'hagotada' => false
					)
				),
			'All' => false,
			'mensajes' => array(
				'es' 	=> 
					'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>'.
					'<ul>'.
					'<li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li>'.
					'</ul>'.
					'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>'.
					'<ul>'.
					'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ('.($currency == "mxn" ? '$45.00 MXP' : '$2.50 USD').').</li>'.
					'<li> Check inn 15:00 hrs. / Check out 12:00 hrs.</li>'.
					'</ul>',
				'en'	=> 
					'',
				'pt' 	=> 
					'<h3 class=\"c-theme-font c-font-uppercase\">A taxa inclui:</h3>'.
					'<ul>'.
					'<li>Aluguel do quarto da categoria selecionada, 16% IVA, 3% ISH (imposto sobre hospedagem) e gorjeta ao serviço de limpeza.</li>'.
					'</ul>'.
					'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>'.
					'<ul>'.
					'<li>Um cobro único será efetuado para gorjeta dos bell boys por persona ('.($currency == "mxn" ? '$45.00 MXP' : '$2.50 USD').').</li>'.
					'<li>Check in 15:00 hrs. / Check out 12:00 hrs.</li>'.
					'</ul>'
				)				
		);		

		$hoteles[8] = array(
			'index' 				=> '8',
			'nombre' 				=> 'KRYSTAL URBAN CANCUN',
			'img' 					=> '8.jpg',
			'agotado' 			=> false,
			'habitaciones' 	=> array(
				array(
					'tipo' 		=> array(
						'es'	=> 'Deluxe Sencilla o Doble',
						'en'	=> 'Deluxe Single or Double',
						'pt'	=> 'Deluxe Único ou Duplo'
					),
					'costo' 		=> array(
						'mxn'	=>	'1519.00',
						'usd'	=>	'87.00'
						),
					'propinas'	=>	array(
						'mxn'	=>	'30.00',
						'usd'	=>	'2.00'
						),
					'hagotada' => false
					)
				),
			'All' => false,
			'mensajes' => array(
				'es' 	=> 
					'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>'.
					'<ul>'.
					'<li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li>'.
					'</ul>'.
					'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>'.
					'<ul>'.
					'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ('.($currency == "mxn" ? '$30.00 MXP' : '$2.00 USD').').</li>'.
					'<li> Check inn 15:00 hrs. / Check out 12:00 hrs.</li>'.
					'</ul>',
				'en'	=> 
					'',
				'pt' 	=> 
					'<h3 class=\"c-theme-font c-font-uppercase\">A taxa inclui:</h3>'.
					'<ul>'.
					'<li>Aluguel do quarto da categoria selecionada, 16% IVA, 3% ISH (imposto sobre hospedagem) e gorjeta ao serviço de limpeza.</li>'.
					'</ul>'.
					'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>'.
					'<ul>'.
					'<li>Um cobro único será efetuado para gorjeta dos bell boys por persona ('.($currency == "mxn" ? '$30.00 MXP' : '$2.00 USD').').</li>'.
					'<li>Check in 15:00 hrs. / Check out 12:00 hrs.</li>'.
					'</ul>'
				)				
		); 

		$hoteles[9] = array(
			'index' 				=> '9',
			'nombre' 				=> 'HOLIDAY INN CANCUN ARENAS',
			'img' 					=> '9.jpg',
			'agotado' 			=> false,
			'habitaciones' 	=> array(
				array(
					'tipo' 		=> array(
						'es'	=> 'Estándar Sencilla o Doble',
						'en'	=> 'Standard Single or Double',
						'pt'	=> 'Estándar Único ou Duplo'
					),
					'costo' 		=> array(
						'mxn'	=>	'2536.00',
						'usd'	=>	'134.00'
						),
					'propinas'	=>	array(
						'mxn'	=>	'100.00',
						'usd'	=>	'5.00'
						),
					'hagotada' => false
					)
				),
			'All' => false,
			'mensajes' => array(
				'es' 	=> 
					'<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>'.
					'<ul>'.
					'<li>Renta de habitación en la categoria seleccionada, 16% IVA, 3% ISH y propinas a camaristas.</li>'.
					'</ul>'.
					'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>'.
					'<ul>'.
					'<li>Se realizara un cargo único por concepto de propinas a bell boys por persona ('.($currency == "mxn" ? '$100.00 MXP' : '$5.00 USD').').</li>'.
					'<li> Check inn 15:00 hrs. / Check out 12:00 hrs.</li>'.
					'</ul>',
				'en'	=> 
					'',
				'pt' 	=> 
					'<h3 class=\"c-theme-font c-font-uppercase\">A taxa inclui:</h3>'.
					'<ul>'.
					'<li>Aluguel do quarto da categoria selecionada, 16% IVA, 3% ISH (imposto sobre hospedagem) e gorjeta ao serviço de limpeza.</li>'.
					'</ul>'.
					'<h3 class=\"c-theme-font c-font-uppercase\">Notas importantes:</h3>'.
					'<ul>'.
					'<li>Um cobro único será efetuado para gorjeta dos bell boys por persona ('.($currency == "mxn" ? '$100.00 MXP' : '$5.00 USD').').</li>'.
					'<li>Check in 15:00 hrs. / Check out 12:00 hrs.</li>'.
					'</ul>'
				)				
		); 


		return $app['twig']->render('pages/reservacion/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 			=> 'XXXVI REUNIÓN ANUAL DE DERMATOLOGOS LATINOAMERICANOS 2018',
			'hoteles' 		=> $hoteles,
			'hotelesJson' => json_encode($hoteles),
			'currency' 		=> $currency,
			'idHotel' 		=> $idHotel,
			'lang' 				=> $lang,
			'operador'		=> array(),
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
				'' 		=> 'mail-reserva-deposito-es.twig.html',
				'es' 	=> 'mail-reserva-deposito-es.twig.html',
				'en' 	=> 'mail-reserva-deposito-en.twig.html',
				'pt' 	=> 'mail-reserva-deposito-pt.twig.html'
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
		$request->request->set('status',$cargo);
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
			if($fpago == 'pDB'){
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"marellano@tcevents.com" => "Mariela Arellano"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion RADLA 2018');
			}
			else{
				$mail
					->setTo("marellano@tcevents.com","Mariela Arellano")
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
							"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion RADLA 2018');				
			}
			$body = $app['twig']->render('pages/reservacion/'.$pages[$request->request->get('lang') ], array(
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
				'' 		=> 'confirmacion.twig.html',
				'es' 	=> 'confirmacion.twig.html',
				'en' 	=> 'confirmacion-en.twig.html',
				'pt' 	=> 'confirmacion-pt.twig.html'
		);		
		return $app['twig']->render("pages/reservacion/" . $pages[$lang], array(
			'data' => $request->query
		));
	}
}

?>