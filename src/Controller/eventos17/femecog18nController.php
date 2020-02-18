<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;


use Lib\Functions\ppplusLive as ppplus;

define("FEMECOG18","femecog18n");

class femecog18nController implements ControllerProviderInterface {
	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get("/{idHotel}/{currency}/{lang}",sprintf('Controller\eventos17\%sController::index',FEMECOG18))
		->bind(FEMECOG18.".index")
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);		
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',FEMECOG18))->bind(FEMECOG18.".setReservacion");
		$index->get('/confirmacion/{lang}',sprintf('Controller\eventos17\%sController::confirmacion',FEMECOG18))->bind(FEMECOG18.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}',sprintf('Controller\eventos17\%sController::politicas',FEMECOG18))->bind(FEMECOG18.".politicas")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',FEMECOG18))->bind(FEMECOG18.".setReservacion");
		$index->post('/applyPay/{lang}',sprintf('Controller\eventos17\%sController::applyPay',FEMECOG18))->bind(FEMECOG18.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/checkOut/{lang}',sprintf('Controller\eventos17\%sController::checkOut',FEMECOG18))->bind(FEMECOG18.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payReturn/{lang}',sprintf('Controller\eventos17\%sController::payRetrun',FEMECOG18))->bind(FEMECOG18.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/payCancel/{lang}',sprintf('Controller\eventos17\%sController::payCancel',FEMECOG18))->bind(FEMECOG18.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/execute/{lang}',sprintf('Controller\eventos17\%sController::execute',FEMECOG18))->bind(FEMECOG18.'.execute')->assert('lang', '\w+')->value('lang', 'es');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'universal/es.index.twig.html',
				'es' 	=> 'universal/es.index.twig.html',
				'en' 	=> 'universal/en.index.twig.html'
		);
		$fn 				= new Functions;
    $paises   = $fn->getCountryList($lang);
    
		$hoteles[20] =
			array(
				'index' 				=> '20',
				'nombre' 				=> 'HOTEL EL CID MARINA',
				'img' 					=> 'cidMarina.jpg',
				'agotado' 			=> true,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'Habitacion Sencilla',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'2,873.00',
								'usd'	=>	'0'
						),
						'costor' 	=> array(
								'mxn'	=>	'2,873.00',
								'usd'	=>	'0'
						),
						'propinas'	=>	array(
							'mxn'	=>	'25',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => true
						),
					array(
						'tipo' 	=> array(
							'es' => 'Habitacion Doble',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'3,103.01',
							'usd'	=>	'0'
							),
						'costor' 	=>  array(
							'mxn'	=>	'3,103.01',
							'usd'	=>	'0'
							),
						'propinas'	=>	array(
							'mxn'	=>	'50',
							'usd'	=>	'0'
							),
						'pack' => 0,
						'pp' 		=> 0,
						'hagotada' => true
            ),
          array(
            'tipo' 	=> array(
              'es' => 'Habitacion Triple',
              'en' => ''
            ),
            'costo' 	=>  array(
              'mxn'	=>	'3,571.01',
              'usd'	=>	'0'
              ),
            'costor' 	=>  array(
              'mxn'	=>	'3,571.01',
              'usd'	=>	'0'
              ),
            'propinas'	=>	array(
              'mxn'	=>	'50',
              'usd'	=>	'0'
              ),
            'pack' => 0,
            'pp' 		=> 0,
            'hagotada' => true
            ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Cuádruple',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'4,039.02',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'3,571.01',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'50',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => true
              )                       
				),
				'all' => false,
				'mensajes'			=> array(
						'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
										'<ul>'.
                    '<li>Se realizará un cargo único de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                    '<li>Tarifas cotizadas en MN</li>'.
                    '</ul>'.
                    '',
						'en' => ''
					)
      );
      
      $hoteles[1] =
        array(
          'index' 				=> '1',
          'nombre' 				=> 'HOTEL EL CID EL MORO',
          'img' 					=> 'CIDMoro.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'2,813.50',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'2,813.50',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'25',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'3,043.51',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'3,043.51',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'50',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Triple',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'3,511.51',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'3,511.51',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'50',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
              array(
                'tipo' 	=> array(
                  'es' => 'Habitacion Cuádruple',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'3,979.52',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'3,979.52',
                  'usd'	=>	'0'
                  ),
                'propinas'	=>	array(
                  'mxn'	=>	'50',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );
      
      $hoteles[2] =
        array(
          'index' 				=> '2',
          'nombre' 				=> 'HOTEL EL CID CASTILLA',
          'img' 					=> 'cidCastilla.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'2,159.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'2,159.00',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'25',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,389.01',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,389.01',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'50',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Triple',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,857.01',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,857.01',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'50',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
              array(
                'tipo' 	=> array(
                  'es' => 'Habitacion Cuádruple',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'3,325.02',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'3,325.02',
                  'usd'	=>	'0'
                  ),
                'propinas'	=>	array(
                  'mxn'	=>	'50',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );    

      $hoteles[3] =
        array(
          'index' 				=> '3',
          'nombre' 				=> 'HOTEL EL CID GRANADA',
          'img' 					=> 'cidGranada.jpeg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'2,087.60',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'2,087.60',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'25',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,317.61',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,317.61',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'50',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Triple',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,785.61',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,785.61',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'50',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
              array(
                'tipo' 	=> array(
                  'es' => 'Habitacion Cuádruple',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'3,253.62',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'3,253.62',
                  'usd'	=>	'0'
                  ),
                'propinas'	=>	array(
                  'mxn'	=>	'50',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );       

      $hoteles[4] =
        array(
          'index' 				=> '4',
          'nombre' 				=> 'HOTEL EMPORIO MAZATLÁN',
          'img' 					=> 'emporio.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla (Dos Camas)',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'2,337.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'2,337.00',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'30',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,507.01',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,507.01',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'60',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $30.00 MN en habitación sencilla y $60.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );         

      $hoteles[5] =
        array(
          'index' 				=> '5',
          'nombre' 				=> 'HOTEL HOLIDAY INN RESORT',
          'img' 					=> 'holiday-resort-mazatlan.jpg',
          'agotado' 			=> true,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'2,492.60',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'2,492.60',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'50',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => true
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,741.80',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,741.80',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'100',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => true
              )                      
          ),
          'all' => false,
          'mensajes'			=> array(
              'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                      '<ul>'.
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $50.00 MN en habitación sencilla y $100.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );

      $hoteles[6] =
        array(
          'index' 				=> '6',
          'nombre' 				=> 'HOTEL PARK ROYAL MAZATLÁN',
          'img' 					=> 'parkRoyal.jpg',
          'agotado' 			=> true,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Junior Suite Sencilla (Cama King)',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'2,330.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'2,330.00',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'40',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => true
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Junior Suite Doble (Dos camas)',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,540.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,540.00',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'80',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
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
          'all' => false,
          'mensajes'			=> array(
              'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                      '<ul>'.
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $50.00 MN en habitación sencilla y $100.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );

      $hoteles[7] =
        array(
          'index' 				=> '7',
          'nombre' 				=> 'HOTEL MISIÓN MAZATLÁN',
          'img' 					=> 'MMision.jpg',
          'agotado' 			=> true,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'1,270.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'1,270.00',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'30',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => true
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'1,270.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'1,270.00',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'60',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => true
              )                                
          ),
          'all' => false,
          'mensajes'			=> array(
              'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                      '<ul>'.
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $30.00 MN en habitación sencilla y $60.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );
      
      $hoteles[9] =
        array(
          'index' 				=> '9',
          'nombre' 				=> 'ROYAL VILLAS RESORT',
          'img' 					=> 'VillasResort.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla Mitla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'2,345.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'2,345.00',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'25',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble Mitla',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,475.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,475.00',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'50',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 11:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );

      $hoteles[10] =
        array(
          'index' 				=> '10',
          'nombre' 				=> 'RAMADA RESORT & SPA MAZATLÁN',
          'img' 					=> 'Mazatlan_Ramada.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'1,875.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'1,875.00',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'25',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,225.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,225.00 ',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'50',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $25.00 MN en habitación sencilla y $50.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 14:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );
      
      $hoteles[11] =
        array(
          'index' 				=> '11',
          'nombre' 				=> 'HOTEL SUITES LAS FLORES BEACH RESORT',
          'img' 					=> 'flores_beach.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'1,440.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'1,440.00',
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
                'es' => 'Habitacion Jr. Suite Doble (Dos camas matrimoniales 1 sofa)',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,000.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,000.00',
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
                  'es' => 'Habitacion Jr. Suite Doble (Dos camas matrimoniales 2 sofas)',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'2,000.00',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'2,000.00',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 11:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );
      
      $hoteles[12] =
        array(
          'index' 				=> '12',
          'nombre' 				=> 'HOTEL QUALITY INN MAZATLÁN',
          'img' 					=> 'quality-In-mazatlan.jpg',
          'agotado' 			=> false,
          'hidden'        => true,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'1,533.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'1,533.00',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'10',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'1,533.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'1,533.00',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'20',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $10.00 MN en habitación sencilla y $20.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );
      
      $hoteles[13] =
        array(
          'index' 				=> '13',
          'nombre' 				=> 'THE INN BEACH HOTEL MAZATLÁN',
          'img' 					=> 'In_beach.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Estudio Sencilla y/o Doble',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'2,507.58',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'2,507.58',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'20',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Junior Suite Sencilla y/o Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,884.81',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,884.81',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'20',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $20.00 MN en habitación sencilla y $40.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 11:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );
      
      $hoteles[14] =
        array(
          'index' 				=> '14',
          'nombre' 				=> 'HOTEL QUIJOTE INN',
          'img' 					=> 'quijote.jpeg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Doble',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'1,495.01',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'1,495.01',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'40',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo único de $40.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 16:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );      

      $hoteles[16] =
        array(
          'index' 				=> '16',
          'nombre' 				=> 'HOTEL PLAYA MAZATLÁN',
          'img' 					=> 'playa_mazatlan.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla Vista al Jardin',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'2,142.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'2,142.00',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'20',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble Vista al Jardin',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,342.01',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,342.01',
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
                  'es' => 'Habitacion Sencilla Vista al Mar',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'2,821.00',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'2,821.00',
                  'usd'	=>	'0'
                  ),
                'propinas'	=>	array(
                  'mxn'	=>	'20',
                  'usd'	=>	'0'
                  ),
                'pack' => 0,
                'pp' 		=> 0,
                'hagotada' => false
                ),
                array(
                  'tipo' 	=> array(
                    'es' => 'Habitacion Doble Vista al Mar',
                    'en' => ''
                  ),
                  'costo' 	=>  array(
                    'mxn'	=>	'3,021.00',
                    'usd'	=>	'0'
                    ),
                  'costor' 	=>  array(
                    'mxn'	=>	'3,021.00',
                    'usd'	=>	'0'
                    ),
                  'propinas'	=>	array(
                    'mxn'	=>	'40',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $20.00 MN en habitación sencilla y $40.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );

      $hoteles[17] =
        array(
          'index' 				=> '17',
          'nombre' 				=> 'HOTEL PLAYA BONITA',
          'img' 					=> 'playaBonita.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'1,030.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'1,030.00',
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
                'es' => 'Habitacion Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'1,255.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'1,255.00',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 14:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );      

      $hoteles[18] =
        array(
          'index' 				=> '18',
          'nombre' 				=> 'HOTEL COSTA DE ORO',
          'img' 					=> 'Costa-de-Oro.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Sencilla Vista al Jardin',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'1,685.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'1,685.00',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'10',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Doble Vista al Jardin',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'1,865.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'1,865.00',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'20',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
              array(
                'tipo' 	=> array(
                  'es' => 'Habitacion Sencilla Vista al Mar',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'2,050.00',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'2,050.00',
                  'usd'	=>	'0'
                  ),
                'propinas'	=>	array(
                  'mxn'	=>	'10',
                  'usd'	=>	'0'
                  ),
                'pack' => 0,
                'pp' 		=> 0,
                'hagotada' => false
              ),
              array(
                'tipo' 	=> array(
                  'es' => 'Habitacion Doble Vista al Mar',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'2,230.00',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'2,230.00',
                  'usd'	=>	'0'
                  ),
                'propinas'	=>	array(
                  'mxn'	=>	'20',
                  'usd'	=>	'0'
                  ),
                'pack' => 0,
                'pp' 		=> 0,
                'hagotada' => false
              ),
              array(
                'tipo' 	=> array(
                  'es' => 'Habitacion Suite Sencilla Vista al Mar',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'2,470.00',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'2,470.00',
                  'usd'	=>	'0'
                  ),
                'propinas'	=>	array(
                  'mxn'	=>	'10',
                  'usd'	=>	'0'
                  ),
                'pack' => 0,
                'pp' 		=> 0,
                'hagotada' => false
              ),
              array(
                'tipo' 	=> array(
                  'es' => 'Habitacion Suite Doble Vista al Mar',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'2,650.00',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'2,650.00',
                  'usd'	=>	'0'
                  ),
                'propinas'	=>	array(
                  'mxn'	=>	'20',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $10.00 MN en habitación sencilla y $20.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );

      $hoteles[19] =
        array(
          'index' 				=> '19',
          'nombre' 				=> 'OCEAN VIEW BEACH HOTEL',
          'img' 					=> 'ocean.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Estandar Sencilla o Doble Visita al Mar (Dos camas matrimoniales)',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'1,570.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'1,570.00',
                  'usd'	=>	'0'
              ),
              'propinas'	=>	array(
                'mxn'	=>	'30',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
            array(
              'tipo' 	=> array(
                'es' => 'Habitacion Estandar Sencilla o Doble Visita al Mar (Una Cama Queen)',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'1,570.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'1,570.00',
                'usd'	=>	'0'
                ),
              'propinas'	=>	array(
                'mxn'	=>	'30',
                'usd'	=>	'0'
                ),
              'pack' => 0,
              'pp' 		=> 0,
              'hagotada' => false
              ),
              array(
                'tipo' 	=> array(
                  'es' => 'Jr. Suite Sencilla o Doble Vista a Ciudad (Dos camas Queen)',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'1,700.00',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'1,700.00',
                  'usd'	=>	'0'
                  ),
                'propinas'	=>	array(
                  'mxn'	=>	'30',
                  'usd'	=>	'0'
                  ),
                'pack' => 0,
                'pp' 		=> 0,
                'hagotada' => false
              ),
              array(
                'tipo' 	=> array(
                  'es' => 'Jr. Suite Sencilla o Doble Vista a Ciudad (Dos camas Queen)',
                  'en' => ''
                ),
                'costo' 	=>  array(
                  'mxn'	=>	'2,240.00',
                  'usd'	=>	'0'
                  ),
                'costor' 	=>  array(
                  'mxn'	=>	'2,240.00',
                  'usd'	=>	'0'
                  ),
                'propinas'	=>	array(
                  'mxn'	=>	'30',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $30.00 MN en habitación sencilla y $60.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );

      $hoteles[21] =
        array(
          'index' 				=> '21',
          'nombre' 				=> 'HOTEL PUEBLO BONITO EMERALD BAY RESORT & SPA',
          'img' 					=> 'PBonito.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Jr. Suite Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'3,280.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'3,280.00',
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
                'es' => 'Habitacion Jr. Suite Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'3,535.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'3,535.00',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $55.00 MN en habitación sencilla y $110.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 14:00 hrs. / Check out 11:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );      

      $hoteles[22] =
        array(
          'index' 				=> '22',
          'nombre' 				=> 'HOTEL PUEBLO BONITO MAZATLÁN',
          'img' 					=> 'PueBonito.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion Jr. Suite Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'2,710.00',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'2,710.00',
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
                'es' => 'Habitacion Jr. Suite Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,965.00',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,965.00',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>Se realizará un cargo unico de $55.00 MN en habitación sencilla y $110.00 MN en habitación doble (entrada y salida) por concepto de propinas a botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 14:00 hrs. / Check out 11:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );

      $hoteles[23] =
        array(
          'index' 				=> '23',
          'nombre' 				=> 'PARK INN BY RADISSON',
          'img' 					=> 'parkInn.jpg',
          'agotado' 			=> false,
          'habitaciones' 	=> array(
            array(
              'tipo' 	=> array(
                'es'	=> 'Habitacion STD Sencilla',
                'en'	=> '',
              ),
              'costo' 	=> array(
                  'mxn'	=>	'1,773.19',
                  'usd'	=>	'0'
              ),
              'costor' 	=> array(
                  'mxn'	=>	'1,773.19',
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
                'es' => 'Habitacion STD Doble',
                'en' => ''
              ),
              'costo' 	=>  array(
                'mxn'	=>	'2,061.39',
                'usd'	=>	'0'
                ),
              'costor' 	=>  array(
                'mxn'	=>	'2,061.39',
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
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>No aplica cargo por concepto de botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 11:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );

      $hoteles[24] =
        array(
          'index'         => '24',
          'nombre'        => 'HOTEL IBIS MAZATLÁN',
          'img'           => 'ibis.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'  => 'SDT SENCILLA',
                'en'  => '',
              ),
              'costo'   => array(
                  'mxn' =>  '1,137.09',
                  'usd' =>  '0'
              ),
              'costor'  => array(
                  'mxn' =>  '1,137.09',
                  'usd' =>  '0'
              ),
              'propinas'  =>  array(
                'mxn' =>  '0',
                'usd' =>  '0'
                ),
              'pack' => 0,
              'pp'    => 0,
              'hagotada' => false
              ),
            array(
              'tipo'  => array(
                'es' => 'STD DOBLE',
                'en' => ''
              ),
              'costo'   =>  array(
                'mxn' =>  '1,460.18',
                'usd' =>  '0'
                ),
              'costor'  =>  array(
                'mxn' =>  '1,460.18',
                'usd' =>  '0'
                ),
              'propinas'  =>  array(
                'mxn' =>  '0',
                'usd' =>  '0'
                ),
              'pack' => 0,
              'pp'    => 0,
              'hagotada' => false
              )                                
          ),
          'all' => false,
          'mensajes'      => array(
              'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                      '<ul>'.
                      '<li>Renta de habitación por noche con desayuno buffet,16% de IVA, 3% de ISH y propinas a camaristas.</li>'.
                      '<li>No aplica cargo por concepto de botones.</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );        

  		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 				=> '',
			'evento' 				=> '68 CONGRESO MEXICANO DE OBSTETRICIA Y GINECOLOGÍA',
			'hoteles' 			=> $hoteles,
			'hotelesJson' 	=> json_encode($hoteles),
			'currency' 			=> $currency,
			'idHotel' 			=> $idHotel,
			'lang' 					=> $lang,
			'paises' 				=> $paises,
			'logo' 					=> array(
											),
			'css_logo'    	=> false,
			'fechas'  			=> array(
													'es' => '11 AL 15 DE NOVIEMBRE, 2018',
													'en' => '' 
													),
			'sede'        	=> array(
													'es' => 'MAZATLÁN, SINALOA',
													'en' => '' 
													),
			'claveEvento' 	=> 'FEMECOG18',
			'fechaLleMin'		=> '2018-11-10',
			'fechaLleMax'		=> '2018-11-14',
			'fechaSalMin'		=> '2018-11-12',
			'fechaSalMax'		=> '2018-11-15',
			'noches' 				=> 2,
			'urlIndex'			=> $app['url_generator']->generate(FEMECOG18.".index"),
			'urlReserva'		=> $app['url_generator']->generate(FEMECOG18.".setReservacion"),
			'urlConfirma'		=> $app['url_generator']->generate(FEMECOG18.".confirmacion"),
			'urlApplyPay' 	=> $app['url_generator']->generate(FEMECOG18.".applyPay"),
			'urlChekout'    => $app['url_generator']->generate(FEMECOG18.".checkOut"),
			'urlExecute'    => $app['url_generator']->generate(FEMECOG18.".execute"),
			'rutaImg' 			=> 'femecog',
			'links'					=> array(
														'es' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(FEMECOG18.".politicas"),
																								'name' 	=> 'Políticas de reservación'
																							),
																'formato'   => array()
																),
														'en' => array(
																'politicas' => array(
																								'url' 	=> $app['url_generator']->generate(FEMECOG18.".politicas"),
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
													'mail' 			=> 'caguirre@tcevents.com',
													'phone'			=> '+52 55 5148 75 00 ext: 69'
											),
			'operadorJson' 	=> json_encode(
														array(
															'name'			=> 'Carlos Aguirre',
															'sortName' 	=> 'CA',
															'mail' 			=> 'caguirre@tcevents.com',
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
			'_msg_'					=> array(
                        'es' => '<p class="c-font-red-3" style="font-size:14px;">'.
                                'Para llegadas anticipadas y/o salidas posteriores a las fechas oficiales del Congreso, favor de enviar su solicitud a:'.
                                '</p>'.
                                '<ul class="list-unstyled c-font-red-3">'.
                                '<li>'.
                                '<span class="fa fa-fw fa-user"></span> Mariela Arellano'.
                                '</li>'.
                                '<li>'.
                                '<span class="fa fa-fw fa-envelope"></span> <a href="mailto:marellano@tycgroup.com" class="c-font-red-3">marellano@tycgroup.com</a>'.
                                '</li>'.
                                '<li>'.
                                '<span class="fa fa-fw fa-phone"></span> (55) 51 48 75 11'.
                                '</li>'.                                                              
                                '</u>'.
                                '',
                      ),
      'blkAco'       => true
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
		$FEMECOG18Rsv 		= time();
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
		$request->request->set('claveReservacion',$FEMECOG18Rsv);
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
							"caguirre@tycgroup.com" => "Carlos Aguirre"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion 68 CONGRESO MEXICANO DE OBSTETRICIA Y GINECOLOGÍA');
			}
			else{
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setBcc(array(
							"lcazares@tcevents.com" => "Luis Cazares",
							"caguirre@tycgroup.com" => "Carlos Aguirre",
							"erubi@tycgroup.com" => "Edgar Rubi"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion 68 CONGRESO MEXICANO DE OBSTETRICIA Y GINECOLOGÍA');
			}
			$imgHotel = explode("/",$request->request->get('imgHotel'));
			$imgHotel = end($imgHotel);
			$imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/femecog/" . $imgHotel;
			$body = $app['twig']->render('pages/eventos17/universal/'.$pages[$request->request->get('lang') ], array(
				"data"			=> $rsv,
				"idHotel" 	=> $request->request->get('idHotel'),
				"pais" 			=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 		=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name'),
				"bannerImg" => 'http://webapps.tycgroup.com/assets/img/bannerReMail.png',
				"imgHotel"  =>  $imgHotel,
				"operador"	=> array(
												'name'			=> 'Carlos Aguirre',
												'sortName' 	=> 'CA',
												'mail' 			=> 'caguirre@tycgroup.com',
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
      '' 		=> 'FEMECOG18.politicas.twig.html',
      'es' 	=> 'FEMECOG18.politicas.twig.html',
      'en' 	=> 'FEMECOG18.politicas-en.twig.html',
    );		
    return $app['twig']->render("pages/eventos17/FEMECOG18/" . $pages[$lang], array(
      'data' => $request->query
    ));	
	}

	public function checkOut(Request $request, Application $app,$lang){
		$response = array();
		$pay 			= new ppplus;
		$urls 		= array(
									'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(FEMECOG18.".payReturn"),
									'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(FEMECOG18.".payCancel")
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

	public function execute(Request $request, Application $app,$lang){
		$pay 			= new ppplus;
		$exeUrl 	= $request->query->get('exeUrl');
		$payerId 	= $request->query->get('payer_id');
		$token 		= $request->query->get('token');
		return $app->json($pay->execute($exeUrl,$token,$payerId));
	}	

}
?>
