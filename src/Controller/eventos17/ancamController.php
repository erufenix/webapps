<?php
 
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
 
use Symfony\Component\HttpFoundation\Request;
 
use Lib\Functions\Functions;
 
use Lib\Functions\ppPlus;

//use Lib\Functions\ppplusLive as ppplus;
 
define("ANCAM","ANCAM");
 
class ancamController implements ControllerProviderInterface
{
    private $evento;
    private $fechas;
    private $sede;
    private $operador;
    private $extOperador;
 
    public function __construct()
    {
        $this->evento         = "XIX CONGRESO NACIONAL DE CARDIOLOGÍA";
        $this->fechas         = array(
                                'es' => '13 - 17 DE OCTUBRE, 2019',
                                'en' => ''
                              );
        $this->sede           = array(
                                'es' => 'Guadalajara',
                                'en' => 'Guadalajara'
                              );
        $this->operador      = array(
                                'name'      => 'Carlos Aguirre',
                                'sortName'  => 'CA',
                                'mail'      => 'caguirre@tycgroup.com',
                                'phone'     => '+52 55 5148 75 00 ext: 69'
                              );
        $this->extOperador  =   array(
                                array(
                                  'name'      => 'Mariela Arellano',
                                  'sortName'  => 'MA',
                                  'mail'      => 'marellano@tycgroup.com',
                                  'phone'     => '+52 55 5148 75 00 ext: 11'
                                )
                              );
    }
 
 
    public function connect(Application $app)
    {
        $index = $app['controllers_factory'];
        $index->get("/{idHotel}/{currency}/{lang}", sprintf('Controller\eventos17\%sController::index', ANCAM))
        ->bind(ANCAM.".index")
        ->assert('currency', '\w+')->value('currency', 'mxn')
        ->assert('lang', '\w+')->value('lang', 'es')
        ->assert('idHotel', '\d+')->value('idHotel', 1);
        $index->post('/setReservacion', sprintf('Controller\eventos17\%sController::setReservacion', ANCAM))->bind(ANCAM.".setReservacion");
        $index->get('/confirmacion/{lang}', sprintf('Controller\eventos17\%sController::confirmacion', ANCAM))->bind(ANCAM.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/politicas/{lang}', sprintf('Controller\eventos17\%sController::politicas', ANCAM))->bind(ANCAM.".politicas")->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/setReservacion', sprintf('Controller\eventos17\%sController::setReservacion', ANCAM))->bind(ANCAM.".setReservacion");
        $index->post('/applyPay/{lang}', sprintf('Controller\eventos17\%sController::applyPay', ANCAM))->bind(ANCAM.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/checkOut/{lang}', sprintf('Controller\eventos17\%sController::checkOut', ANCAM))->bind(ANCAM.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/payReturn/{lang}', sprintf('Controller\eventos17\%sController::payReturn', ANCAM))->bind(ANCAM.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/payCancel/{lang}', sprintf('Controller\eventos17\%sController::payCancel', ANCAM))->bind(ANCAM.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/execute/{lang}', sprintf('Controller\eventos17\%sController::execute', ANCAM))->bind(ANCAM.'.execute')->assert('lang', '\w+')->value('lang', 'es');
        return $index; 
    }
 
    public function index(Request $request, Application $app, $idHotel, $currency, $lang)
    {
      $pages = array(
                ''      => 'universal/es.index.twig.html',
                'es'    => 'universal/es.index.twig.html',
                'en'    => 'universal/en.index.twig.html'
      );
      $fn       = new Functions;
      $paises   = array_column($fn->getCountryListArray($lang)['content']['geonames'], 'countryName', 'geonameId');
      $vmode    = 'live';
      $qry      = $request->query->all();

      $hoteles[1] =
        array(
          'index'         => '1',
          'nombre'        => 'CAMINO REAL GUADALAJARA',
          'img'           => 'caminoreal.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'    => 'HABITACION DE LUJO SENCILLA',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '1,765.50',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '1,765.50',
                'usd'   =>   '0'
              ),
              'propinas'  =>   array(
                'mxn'   =>   '30.00',
                'usd'   =>   '0'
                      ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            ),
            array(
              'tipo'  => array(
                'es'    => 'HABITACION DE LUJO DOBLE',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '1,944.00',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '1,944.00',
                'usd'   =>   '0'
              ),
              'propinas'  =>   array(
                'mxn'   =>   '60.00',
                'usd'   =>   '0'
                      ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            )                                                                     
          ),
          'all' => true,
          'mensajes'          => array(
                                  'es' => 
                                    '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                    '<ul>'.
                                    '<li>Renta de habitación por noche con desayuno buffet, impuestos y propinas a camaristas. 
                                    </li>'.
                                    '</ul>'.
                                    '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                    '<ul>'.
                                    '<li>Se realizara cargo por persona por entrada y salida por concepto de propinas a bell boys (Sencilla $30.00 / Doble $60.00).
                                    </li>'.
                                    '<li>Persona extra $400.00 por habitación, por noche.
                                    </li>'.
                                    '<li>Check In 15:00 hrs / Check Out 13:00 hrs.
                                    </li>'.
                                    '<li>Tarifas cotizadas en MN.
                                    </li>'.
                                    '</ul>'.                                   
                                    '',
                                'en' => ''.
                                        '',
                  )
            );
             
      $hoteles[2] =
        array(
          'index'         => '2',
          'nombre'        => 'CITY EXPRESS PLUS EXPO GUADALAJARA',
          'img'           => 'cityexpress.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'    => 'HABITACION SENCILLA',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '1,606.66',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '1,606.66',
                'usd'   =>   '0'
              ),
              'propinas'  =>   array(
                'mxn'   =>   '20.00',
                'usd'   =>   '0'
                      ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            ),
            array(
              'tipo'  => array(
                'es'    => 'HABITACION DOBLE',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '1,738.88',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '1,738.88',
                'usd'   =>   '0'
              ),
              'propinas'  =>   array(
                'mxn'   =>   '40.00',
                'usd'   =>   '0'
                      ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            )                                                                     
          ),
          'all' => false,
          'mensajes'          => array(
                                  'es' => 
                                    '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                    '<ul>'.
                                    '<li>Renta de habitación por noche con desayuno continental, impuestos y propinas a camaristas.
                                    </li>'.
                                    '</ul>'.
                                    '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                    '<ul>'.
                                    '<li>Se realizara cargo por persona por entrada y salida por concepto de propinas a bell boys (Sencilla $20.00 / Doble $40.00).
                                    </li>'.
                                    '<li>Check In 15:00 hrs / Check Out 13:00 hrs.
                                    </li>'.
                                    '<li>Tarifas cotizadas en MN.
                                    </li>'.
                                    '</ul>'.                                    
                                    '',
                                'en' => ''.
                                        '',
                  )
            );

      $hoteles[3] =
        array(
          'index'         => '3',
          'nombre'        => 'FIESTA AMERICANA GUADALAJARA',
          'img'           => 'fiestaamericana.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'    => 'HABITACION SENCILLA',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '2,213.35',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '2,213.35',
                'usd'   =>   '0'
              ),
              'propinas'  =>   array(
                'mxn'   =>   '0.00',
                'usd'   =>   '0'
                      ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            ),
            array(
              'tipo'  => array(
                'es'    => 'HABITACION DOBLE',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '3,388.40',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '3,388.40',
                'usd'   =>   '0'
              ),
              'propinas'  =>   array(
                'mxn'   =>   '0.00',
                'usd'   =>   '0'
                      ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            )                                                                     
          ),
          'all' => false,
          'mensajes'          => array(
                                  'es' => 
                                    '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                    '<ul>'.
                                    '<li>Renta de habitación por noche con desayuno buffet, impuestos,propinas a camaristas y bell boys.
                                    </li>'.
                                    '</ul>'.
                                    '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                    '<ul>'.
                                    '<li>Check In 15:00 hrs / Check Out 12:00 hrs.
                                    </li>'.
                                    '<li>Tarifas cotizadas en MN.
                                    </li>'.
                                    '</ul>'.                                    
                                    '',
                                'en' => ''.
                                        '',
                  )
            );

      $hoteles[4] =
            array(
              'index'         => '4',
              'nombre'        => 'FIESTA INN GUADALAJARA EXPO',
              'img'           => 'fiestainnguadalajara.jpg',
              'agotado'       => false,
              'habitaciones'  => array(
                array(
                  'tipo'  => array(
                    'es'    => 'HABITACION SENCILLA',
                    'en'    => '',
                  ),
                  'costo' => array(
                    'mxn'   =>   '1,956.80',
                    'usd'   =>   ''
                  ),
                  'costor'    => array(
                    'mxn'   =>   '1,956.80',
                    'usd'   =>   '0'
                  ),
                  'propinas'  =>   array(
                    'mxn'   =>   '0.00',
                    'usd'   =>   '0'
                          ),
                  'pack' => 0,
                  'pp'        => 0,
                  'hagotada' => false
                ),
                array(
                  'tipo'  => array(
                    'es'    => 'HABITACION DOBLE',
                    'en'    => '',
                  ),
                  'costo' => array(
                    'mxn'   =>   '2,222.60',
                    'usd'   =>   ''
                  ),
                  'costor'    => array(
                    'mxn'   =>   '2,222.60',
                    'usd'   =>   '0'
                  ),
                  'propinas'  =>   array(
                    'mxn'   =>   '0.00',
                    'usd'   =>   '0'
                          ),
                  'pack' => 0,
                  'pp'        => 0,
                  'hagotada' => false
                )                                                                     
              ),
              'all' => false,
              'mensajes'          => array(
                                      'es' => 
                                        '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                        '<ul>'.
                                        '<li>Renta de habitación por noche con desayuno buffet, impuestos y propinas a camaristas.
                                        </li>'.
                                        '</ul>'.
                                        '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                        '<ul>'.
                                        '<li>Check In 15:00 hrs / Check Out 12:00 hrs.
                                        </li>'.
                                        '<li>Tarifas cotizadas en MN.
                                        </li>'.
                                        '</ul>'.                               
                                        '',
                                    'en' => ''.
                                            '',
                      )
                );

      $hoteles[4] =
            array(
              'index'         => '4',
              'nombre'        => 'FIESTA INN GUADALAJARA EXPO',
              'img'           => 'fiestainnguadalajara.jpg',
              'agotado'       => false,
              'habitaciones'  => array(
                array(
                  'tipo'  => array(
                    'es'    => 'HABITACION SENCILLA',
                    'en'    => '',
                  ),
                  'costo' => array(
                    'mxn'   =>   '1,956.80',
                    'usd'   =>   ''
                  ),
                  'costor'    => array(
                    'mxn'   =>   '1,956.80',
                    'usd'   =>   '0'
                  ),
                  'propinas'  =>   array(
                    'mxn'   =>   '0.00',
                    'usd'   =>   '0'
                          ),
                  'pack' => 0,
                  'pp'        => 0,
                  'hagotada' => false
                ),
                array(
                  'tipo'  => array(
                    'es'    => 'HABITACION DOBLE',
                    'en'    => '',
                  ),
                  'costo' => array(
                    'mxn'   =>   '2,222.60',
                    'usd'   =>   ''
                  ),
                  'costor'    => array(
                    'mxn'   =>   '2,222.60',
                    'usd'   =>   '0'
                  ),
                  'propinas'  =>   array(
                    'mxn'   =>   '0.00',
                    'usd'   =>   '0'
                          ),
                  'pack' => 0,
                  'pp'        => 0,
                  'hagotada' => false
                )                                                                     
              ),
              'all' => false,
              'mensajes'          => array(
                                      'es' => 
                                        '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                        '<ul>'.
                                        '<li>Renta de habitación por noche con desayuno buffet, impuestos y propinas a camaristas.
                                        </li>'.
                                        '</ul>'.
                                        '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                        '<ul>'.
                                        '<li>Check In 15:00 hrs / Check Out 12:00 hrs.
                                        </li>'.
                                        '<li>Tarifas cotizadas en MN.
                                        </li>'.
                                        '</ul>'.                               
                                        '',
                                    'en' => ''.
                                            '',
                      )
                );
                
      $hoteles[5] =
                array(
                  'index'         => '5',
                  'nombre'        => 'GUADALAJARA PLAZA EXPO',
                  'img'           => 'plazaexpo.jpg',
                  'agotado'       => false,
                  'habitaciones'  => array(
                    array(
                      'tipo'  => array(
                        'es'    => 'HABITACION SENCILLA',
                        'en'    => '',
                      ),
                      'costo' => array(
                        'mxn'   =>   '1,489.65',
                        'usd'   =>   ''
                      ),
                      'costor'    => array(
                        'mxn'   =>   '1,489.65',
                        'usd'   =>   '0'
                      ),
                      'propinas'  =>   array(
                        'mxn'   =>   '20.00',
                        'usd'   =>   '0'
                              ),
                      'pack' => 0,
                      'pp'        => 0,
                      'hagotada' => false
                    ),
                    array(
                      'tipo'  => array(
                        'es'    => 'HABITACION DOBLE',
                        'en'    => '',
                      ),
                      'costo' => array(
                        'mxn'   =>   '1,638.40',
                        'usd'   =>   ''
                      ),
                      'costor'    => array(
                        'mxn'   =>   '1,638.40',
                        'usd'   =>   '0'
                      ),
                      'propinas'  =>   array(
                        'mxn'   =>   '40.00',
                        'usd'   =>   '0'
                              ),
                      'pack' => 0,
                      'pp'        => 0,
                      'hagotada' => false
                    )                                                                     
                  ),
                  'all' => false,
                  'mensajes'          => array(
                                          'es' => 
                                            '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                            '<ul>'.
                                            '<li>Renta de habitación por noche con desayuno buffet, impuestos y propinas a camaristas.
                                            </li>'.
                                            '</ul>'.
                                            '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                            '<ul>'.
                                            '<li>Se realizara cargo por persona por entrada y salida por concepto de propinas a bell boys (Sencilla $20.00 / Doble $40.00).
                                            </li>'.
                                            '<li>Persona extra $440.00 por habitación, por noche.</li>'.
                                            '<li>Check In 15:00 hrs / Check Out 13:00 hrs.
                                            </li>'.
                                            '<li>Tarifas cotizadas en MN.
                                            </li>'.
                                            '</ul>'.                               
                                            '',
                                        'en' => ''.
                                                '',
                          )
                    );                

      $hoteles[6] =
                array(
                  'index'         => '6',
                  'nombre'        => 'HOTEL 1970 POSADA GUADALAJARA',
                  'img'           => 'hotel1970.png',
                  'agotado'       => false,
                  'habitaciones'  => array(
                    array(
                      'tipo'  => array(
                        'es'    => 'HABITACION SENCILLA',
                        'en'    => '',
                      ),
                      'costo' => array(
                        'mxn'   =>   '2,717.50',
                        'usd'   =>   ''
                      ),
                      'costor'    => array(
                        'mxn'   =>   '2,717.50',
                        'usd'   =>   '0'
                      ),
                      'propinas'  =>   array(
                        'mxn'   =>   '30.00',
                        'usd'   =>   '0'
                              ),
                      'pack' => 0,
                      'pp'        => 0,
                      'hagotada' => false
                    ),
                    array(
                      'tipo'  => array(
                        'es'    => 'HABITACION DOBLE',
                        'en'    => '',
                      ),
                      'costo' => array(
                        'mxn'   =>   '3,193.50',
                        'usd'   =>   ''
                      ),
                      'costor'    => array(
                        'mxn'   =>   '3,193.50',
                        'usd'   =>   '0'
                      ),
                      'propinas'  =>   array(
                        'mxn'   =>   '60.00',
                        'usd'   =>   '0'
                              ),
                      'pack' => 0,
                      'pp'        => 0,
                      'hagotada' => false
                    )                                                                     
                  ),
                  'all' => false,
                  'mensajes'          => array(
                                          'es' => 
                                            '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                            '<ul>'.
                                            '<li>Renta de habitación por noche con desayuno buffet, impuestos y propinas a camaristas.
                                            </li>'.
                                            '</ul>'.
                                            '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                            '<ul>'.
                                            '<li>Se realizara cargo por persona por entrada y salida por concepto de propinas a bell boys (Sencilla $30.00 / Doble $60.00).
                                            </li>'.
                                            '<li>Check In 15:00 hrs / Check Out 12:00 hrs.
                                            </li>'.
                                            '<li>Tarifas cotizadas en MN.
                                            </li>'.
                                            '</ul>'.                                    
                                            '',
                                        'en' => ''.
                                                '',
                          )
                    );                
                    
      $hoteles[7] =
                    array(
                      'index'         => '7',
                      'nombre'        => 'PRESIDENTE INTERCONTINENTAL GUADALAJARA',
                      'img'           => 'presidenteintercontinental.jpg',
                      'agotado'       => false,
                      'habitaciones'  => array(
                        array(
                          'tipo'  => array(
                            'es'    => 'HABITACION SENCILLA',
                            'en'    => '',
                          ),
                          'costo' => array(
                            'mxn'   =>   '1,746.88',
                            'usd'   =>   ''
                          ),
                          'costor'    => array(
                            'mxn'   =>   '1,746.88',
                            'usd'   =>   '0'
                          ),
                          'propinas'  =>   array(
                            'mxn'   =>   '40.00',
                            'usd'   =>   '0'
                                  ),
                          'pack' => 0,
                          'pp'        => 0,
                          'hagotada' => false
                        ),
                        array(
                          'tipo'  => array(
                            'es'    => 'HABITACION DOBLE',
                            'en'    => '',
                          ),
                          'costo' => array(
                            'mxn'   =>   '1,923.36',
                            'usd'   =>   ''
                          ),
                          'costor'    => array(
                            'mxn'   =>   '1,923.36',
                            'usd'   =>   '0'
                          ),
                          'propinas'  =>   array(
                            'mxn'   =>   '80.00',
                            'usd'   =>   '0'
                                  ),
                          'pack' => 0,
                          'pp'        => 0,
                          'hagotada' => false
                        )                                                                     
                      ),
                      'all' => false,
                      'mensajes'          => array(
                                              'es' => 
                                                '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                                '<ul>'.
                                                '<li>Renta de habitación por noche con desayuno buffet, impuestos y propinas a camaristas.
                                                </li>'.
                                                '</ul>'.
                                                '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                                '<ul>'.
                                                '<li>Se realizara cargo por persona por entrada y salida por concepto de propinas a bell boys (Sencilla $40.00 / Doble $80.00).
                                                </li>'.
                                                '<li>Check In 15:00 hrs / Check Out 12:00 hrs.
                                                </li>'.
                                                '<li>Tarifas cotizadas en MN.
                                                </li>'.
                                                '</ul>'.                                    
                                                '',
                                            'en' => ''.
                                                    '',
                              )
                        );                    
                    
      $hoteles[8] =
                  array(
                    'index'         => '8',
                    'nombre'        => 'QUINTA REAL GUADALAJARA',
                    'img'           => 'quintareal.jpg',
                    'agotado'       => false,
                    'habitaciones'  => array(
                      array(
                        'tipo'  => array(
                          'es'    => 'MASTER SUITE SENCILLA',
                          'en'    => '',
                        ),
                        'costo' => array(
                          'mxn'   =>   '3,174.00',
                          'usd'   =>   ''
                        ),
                        'costor'    => array(
                          'mxn'   =>   '3,174.00',
                          'usd'   =>   '0'
                        ),
                        'propinas'  =>   array(
                          'mxn'   =>   '60.00',
                          'usd'   =>   '0'
                                ),
                        'pack' => 0,
                        'pp'        => 0,
                        'hagotada' => false
                      ),
                      array(
                        'tipo'  => array(
                          'es'    => 'MASTER SUITE DOBLE',
                          'en'    => '',
                        ),
                        'costo' => array(
                          'mxn'   =>   '3,412.00',
                          'usd'   =>   ''
                        ),
                        'costor'    => array(
                          'mxn'   =>   '3,412.00',
                          'usd'   =>   '0'
                        ),
                        'propinas'  =>   array(
                          'mxn'   =>   '120.00',
                          'usd'   =>   '0'
                                ),
                        'pack' => 0,
                        'pp'        => 0,
                        'hagotada' => false
                      )                                                                     
                    ),
                    'all' => false,
                    'mensajes'          => array(
                                            'es' => 
                                              '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                              '<ul>'.
                                              '<li>Renta de habitación por noche con desayuno americano, impuestos y propinas a camaristas.
                                              </li>'.
                                              '</ul>'.
                                              '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                              '<ul>'.
                                              '<li>Se realizara cargo por persona por entrada y salida por concepto de propinas a bell boys (Sencilla $60.00 / Doble $120.00).
                                              </li>'.
                                              '<li>Check In 15:00 hrs / Check Out 13:00 hrs.
                                              </li>'.
                                              '<li>Tarifas cotizadas en MN.
                                              </li>'.
                                              '</ul>'.                                    
                                              '',
                                          'en' => ''.
                                                  '',
                            )
                      );

      $hoteles[9] =
                  array(
                    'index'         => '9',
                    'nombre'        => 'REAL INN GUADALAJARA',
                    'img'           => 'realinnguadalajara.jpg',
                    'agotado'       => false,
                    'habitaciones'  => array(
                      array(
                        'tipo'  => array(
                          'es'    => 'HABITACION DE LUJO SENCILLA',
                          'en'    => '',
                        ),
                        'costo' => array(
                          'mxn'   =>   '1,551.30',
                          'usd'   =>   ''
                        ),
                        'costor'    => array(
                          'mxn'   =>   '1,551.30',
                          'usd'   =>   '0'
                        ),
                        'propinas'  =>   array(
                          'mxn'   =>   '30.00',
                          'usd'   =>   '0'
                                ),
                        'pack' => 0,
                        'pp'        => 0,
                        'hagotada' => false
                      ),
                      array(
                        'tipo'  => array(
                          'es'    => 'HABITACION DE LUJO DOBLE',
                          'en'    => '',
                        ),
                        'costo' => array(
                          'mxn'   =>   '1,634.60',
                          'usd'   =>   ''
                        ),
                        'costor'    => array(
                          'mxn'   =>   '1,634.60',
                          'usd'   =>   '0'
                        ),
                        'propinas'  =>   array(
                          'mxn'   =>   '60.00',
                          'usd'   =>   '0'
                                ),
                        'pack' => 0,
                        'pp'        => 0,
                        'hagotada' => false
                      )                                                                     
                    ),
                    'all' => false,
                    'mensajes'          => array(
                                            'es' => 
                                              '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                              '<ul>'.
                                              '<li>Renta de habitación por noche con desayuno americano, impuestos y propinas a camaristas.
                                              </li>'.
                                              '</ul>'.
                                              '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                              '<ul>'.
                                              '<li>Se realizara cargo por persona por entrada y salida por concepto de propinas a bell boys (Sencilla $30.00 / Doble $60.00).
                                              </li>'.
                                              '<li>Check In 15:00 hrs / Check Out 13:00 hrs.
                                              </li>'.
                                              '<li>Tarifas cotizadas en MN.
                                              </li>'.
                                              '</ul>'.                             
                                              '',
                                          'en' => ''.
                                                  '',
                            )
                      );

      $hoteles[10] =
                    array(
                      'index'         => '10',
                      'nombre'        => 'THE WESTIN',
                      'img'           => 'thewestin.jpg',
                      'agotado'       => false,
                      'habitaciones'  => array(
                        array(
                          'tipo'  => array(
                            'es'    => 'HABITACION DE LUJO SENCILLA',
                            'en'    => '',
                          ),
                          'costo' => array(
                            'mxn'   =>   '3,352.00',
                            'usd'   =>   ''
                          ),
                          'costor'    => array(
                            'mxn'   =>   '3,352.00',
                            'usd'   =>   '0'
                          ),
                          'propinas'  =>   array(
                            'mxn'   =>   '20.00',
                            'usd'   =>   '0'
                                  ),
                          'pack' => 0,
                          'pp'        => 0,
                          'hagotada' => false
                        ),
                        array(
                          'tipo'  => array(
                            'es'    => 'HABITACION DE LUJO DOBLE',
                            'en'    => '',
                          ),
                          'costo' => array(
                            'mxn'   =>   '3,352.00',
                            'usd'   =>   ''
                          ),
                          'costor'    => array(
                            'mxn'   =>   '3,352.00',
                            'usd'   =>   '0'
                          ),
                          'propinas'  =>   array(
                            'mxn'   =>   '40.00',
                            'usd'   =>   '0'
                                  ),
                          'pack' => 0,
                          'pp'        => 0,
                          'hagotada' => false
                        ),
                         array(
                          'tipo'  => array(
                            'es'    => 'HABITACION PREMIUM SENCILLA',
                            'en'    => '',
                          ),
                          'costo' => array(
                            'mxn'   =>   '3,828.00',
                            'usd'   =>   ''
                          ),
                          'costor'    => array(
                            'mxn'   =>   '3,828.00',
                            'usd'   =>   '0'
                          ),
                          'propinas'  =>   array(
                            'mxn'   =>   '20.00',
                            'usd'   =>   '0'
                                  ),
                          'pack' => 0,
                          'pp'        => 0,
                          'hagotada' => false
                        ),
                        array(
                          'tipo'  => array(
                            'es'    => 'HABITACION PREMIUM DOBLE',
                            'en'    => '',
                          ),
                          'costo' => array(
                            'mxn'   =>   '3,828.00',
                            'usd'   =>   ''
                          ),
                          'costor'    => array(
                            'mxn'   =>   '3,828.00',
                            'usd'   =>   '0'
                          ),
                          'propinas'  =>   array(
                            'mxn'   =>   '20.00',
                            'usd'   =>   '0'
                                  ),
                          'pack' => 0,
                          'pp'        => 0,
                          'hagotada' => false
                        ) ,
                        array(
                          'tipo'  => array(
                            'es'    => 'MASTER SUIITE',
                            'en'    => '',
                          ),
                          'costo' => array(
                            'mxn'   =>   '5,851.00',
                            'usd'   =>   ''
                          ),
                          'costor'    => array(
                            'mxn'   =>   '5,851.00',
                            'usd'   =>   '0'
                          ),
                          'propinas'  =>   array(
                            'mxn'   =>   '40.00',
                            'usd'   =>   '0'
                                  ),
                          'pack' => 0,
                          'pp'        => 0,
                          'hagotada' => false
                        )                        
                      ),
                      'all' => false,
                      'mensajes'          => array(
                                              'es' => 
                                                '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                                '<ul>'.
                                                '<li>Renta de habitación por noche, impuestos y propinas a camaristas.
                                                </li>'.
                                                '</ul>'.
                                                '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                                '<ul>'.
                                                '<li>Se realizara cargo por persona por entrada y salida por concepto de propinas a bell boys (Sencilla $20.00 / Doble $40.00).
                                                </li>'.
                                                '<li>Check In 15:00 hrs / Check Out 13:00 hrs.
                                                </li>'.
                                                '<li>Tarifas cotizadas en MN.
                                                </li>'.
                                                '</ul>'.                             
                                                '',
                                            'en' => ''.
                                                    '',
                              )
                        );                      
                      

        if(empty($qry)){
          $vmode = 'live';
        }
        elseif(!empty($qry) && !empty($qry['pmode'])){
          $vmode = $qry['pmode'];
        }
        else{
          $vmode = 'live';
        }                                                                                   
        return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
          'title'         => '',
          'evento'        => $this->evento,
          'hoteles'       => $hoteles,
          'hotelesJson'   => json_encode($hoteles),
          'currency'      => $currency,
          'idHotel'       => $idHotel,
          'lang'          => $lang,
          'paises'        => $paises,
          'logo'          => array(
                              ),
          'css_logo'      => false,
          'fechas'        => $this->fechas,
          'sede'          => $this->sede,
          'claveEvento'   => 'ancam',
          'fechaLleMin'   => '2020-10-13',
          'fechaLleMax'   => '2020-10-16',
          'fechaSalMin'   => '2020-10-14',
          'fechaSalMax'   => '2020-10-17',
          'disabledDates' => false,
          'noches'        => 2,
          'urlIndex'      => $app['url_generator']->generate(ANCAM.".index"),
          'urlReserva'    => $app['url_generator']->generate(ANCAM.".setReservacion"),
          'urlConfirma'   => $app['url_generator']->generate(ANCAM.".confirmacion"),
          'urlApplyPay'   => $app['url_generator']->generate(ANCAM.".applyPay"),
          'urlChekout'    => $app['url_generator']->generate(ANCAM.".checkOut"),
          'urlExecute'    => $app['url_generator']->generate(ANCAM.".execute"),
          'urlPayReturn'  => $app['url_generator']->generate(ANCAM.".payReturn"),
          'rutaImg'       => 'ancam',
          'links'         => array(
                              'es' => array(
                                        'politicas' => array(
                                                        'url'   => $app['url_generator']->generate(ANCAM.".politicas"),
                                                        'name'  => 'Políticas de reservación'
                                                        ),
                                        'formato'   => array()
                                      ),
                              'en' => array(
                                        'politicas' => array(
                                                        /*'url'   => $app['url_generator']->generate(ANCAM.".politicas"),
                                                        'name'  => 'Reservation Policies'*/
                                                        ),
                                        'formato'   => array()
                                      )
                              ),
          'flags'         => array(

                              ),
          'linksJson'     => json_encode(
                              array(
                              )
                                                  ),
          'operador'      => $this->operador,
          'extOperador'   => $this->extOperador,
          'operadorJson'  => json_encode(
                              array(
                                'name'      => 'Carlos Aguirre',
                                'sortName'  => 'CA',
                                'mail'      => 'caguirre@tycgroup.com',
                                'phone'     => '+52 55 5148 75 00 ext: 69'
                              )
                            ),
          'host'            => $request->server->get('HTTP_HOST'),
          'protocol'        => sprintf("%s://", (!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http'),
          'hostFullUri'     => sprintf("%s://%s", (!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME')),
          'hostFull'        => sprintf("%s://%s%s", (!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME'), $request->server->get('REQUEST_URI')),
          'mode'            => $vmode,
          'dateMsg'         => array(
                               ),
          '_msg_'           => array(),
          'first'           => 1
          ));
    }
 
    public function setReservacion(Request $request, Application $app){
      $model      = $app["rsvModel"];
      $fn         = new Functions;
      $dh         = explode('|', $request->request->get('habitacionc'));
      $now        = new \DateTime('now');
      $fllegada   = $fn->d2b($request->request->get('fechaLlegada'));
      $fsalida    = $fn->d2b($request->request->get('fechaSalida'));
      $habitacion = $dh[0];
      $costoNoche = str_replace(',', '', $dh[1]);
      $bellBoy    = str_replace(',', '', $dh[2]);
      $pack       = (empty(str_replace(',', '', $dh[3]))) ? 0*1 : str_replace(',', '', $dh[3])*1;
      $pp         = $dh[4];
      $costoNochr = str_replace(',', '', $dh[5]);
      $ANCAMRsv = time();
      $diasPago   = 0;
      $fpago      = $request->request->get('pago');
      $data       = array();
      $pages      = array(
                      ''    => 'mail-deposito-es.twig.html',
                      'es'  => 'mail-deposito-es.twig.html',
                      'en'  => 'mail-deposito-en.twig.html'
      );
      if ($pack != 0) {
        $costoNochr = $costoNochr / $pack;
        $diasPago   = $pack;
      } elseif ($request->request->get('pagoPor') == 'N') {
        $diasPago = $request->request->get('noches');
      } else {
          $dl             = $fllegada;
          $ds             = $fsalida;
          $di             = $fllegada->diff($fsalida);
          $diasPago = $di->format('%a');
      }
      $cargo      = ($costoNochr * $diasPago) + $bellBoy;
      $request->request->set('claveReservacion', $ANCAMRsv);
      $request->request->set('tipoHabitacion', $habitacion);
      $request->request->set('costoNoche', $costoNochr);
      $request->request->set('cargoBellBoys', $bellBoy);
      $request->request->set('diasPago', $diasPago);
      $request->request->set('cargoTotal', $cargo);
      $request->request->set('status', 'iniciada');
      $fechas['fsalida']  = $fsalida;
      $fechas['fllegada'] = $fllegada;
      $fechas['now']      = $now;
      $json               = array(
                              'status' => false,
                              'msg'   => '',
                              'data'  => null
      );
      $rsv = $model->crearReservacion($request->request, $fechas, $app);
      if ($rsv) {
          $data = $app["serializer"]->toArray($rsv);
          $data['mode'] = $request->request->get('pmode');
          $data['lang'] = $request->request->get('lang');
          $mail   = \Swift_Message::newInstance();
          $nombre = $request->request->get('nombre') . " " . $request->request->get('apaterno') ." " . $request->request->get('amaterno');
          if ($fpago == 'DB') {
              $mail
                ->setTo($request->request->get('correo'), $nombre)
                ->setBcc(array(
                    "erubi@tycgroup.com" => "Edgar Rubi",
                    "marellano@tycgroup.com" => "Mariela Arellano",
                    "caguirre@tycgroup.com" => "Carlos Aguirre"
                  ))
                ->setFrom('no--reply@sin-tcevents.mx', 'Reservacion')
                ->setSubject($this->evento);
          } else {
              $mail
                ->setTo("erubi@tycgroup.com", "Edgar Rubi")
                ->setBcc(array(
                    "lcazares@tcevents.com" => "Luis Cazares",
                    "marellano@tycgroup.com" => "Mariela Arellano",
                    "caguirre@tycgroup.com" => "Carlos Aguirre"
                  ))
                ->setFrom('no--reply@sin-tcevents.mx', 'Reservacion')
                ->setSubject("Inicio de proceso Reservacion " . $this->evento);
          }
          $imgHotel = explode("/", $request->request->get('imgHotel'));
          $imgHotel = end($imgHotel);
          $imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/ancam/". $imgHotel;
          $body = $app['twig']->render(
                    'pages/eventos17/universal/'.$pages[$request->request->get('lang') ],
                      array(
                        "data"      => $rsv,
                        "idHotel"   => $request->request->get('idHotel'),
                        "pais"      => $fn->getGeo($request->request->get('pais'), 'name'),
                        "paisRs"    => empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'), 'name'),
                        "bannerImg" => 'http://webapps.tycgroup.com/assets/img/bannerReMail.png',
                        "imgHotel"  =>  $imgHotel,
                        "operador"  => $this->operador
                      )
          );
          $mail->setBody($body, "text/html");
          $env  = $app['mailer']->send($mail);
          $json = array(
                    'status'    => true,
                    'msg'       => '',
                    'data'      => $data,
                    'aData'     => $app["serializer"]->toArray($data),
                    'request' => $request->request->all()
          );
      }
      return $app->json($json);
    }
 
    public function confirmacion(Request $request, Application $app, $lang){
      $pages = array(
                ''      => 'es.confirmacion.twig.html',
                'es'    => 'es.confirmacion.twig.html',
                'en'    => 'en.confirmacion.twig.html',
      );
      return $app['twig']->render("pages/eventos17/universal/" . $pages[$lang], array(
                            'data' => $request->query
      ));
    }
 
    public function politicas(Request $request, Application $app, $lang){
        $pages = array(
          ''      => 'ANCAM.politicas.twig.html',
          'es'    => 'ANCAM.politicas.twig.html',
          'en'    => 'ANCAM.politicas-en.twig.html',
        );
        return $app['twig']->render("pages/eventos17/ANCAM/" . $pages[$lang], array(
            'data' => $request->query
        ));
    }
 
    public function _checkOut_(Request $request, Application $app, $lang){
      $response = array();
      $pay      = new ppplus;
      $urls     = array(
                    'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(ANCAM.".payReturn"),
                    'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(ANCAM.".payCancel")
                  );
      $params   = array(
                    'nameProfile' => 'ReservasTyC_' . uniqid(),
                    'logoImage'   => 'https://webapps.tycgroup.com/assets/img/logoTyC50.png',
                    'shipping'    => 1,
                    'address'     => 1,
                    'landingPage' => 'billing',
                    'bank'        => 'https://www.paypal.com'
                  );
      return $app->json($pay->checkOut($request->query, $lang, $urls, $params));
    }
 
    public function checkOut(Request $request, Application $app, $lang){
      $model  = $app["rsvModel"];
      $id     = $request->query->get('id');
      $mode   = $request->query->get('mode');
      $rsv    = $model->getReservacion(array('idreservacion' =>$id));
      $langs  = array(
                  'es' => 'es_MX',
                  'en' => 'en_US',
                  'pt' => 'pt_BR'
                );
      $lang   = $langs[$lang];
      $settings = array(
              'mode'      => $mode,
              'clientID'  => array(
                              'sandbox' => 'Aamm4JcEPPuRAqkRYTDC44v2xyXPI3XlUlIOyCzM-jPuYoxTm4xyeX6vy0tcSZTUxPKUTkQhOI1NrGa2',
                              'live'      => 'AXIjt9ZwFU34lIzBOlOb2ozh5ZyQ3Tif7hehrFgyhcBFFTValGA4835roqraOvM_voonyy2ceGSfJ0r-'
                          ),
              'secret'    => array(
                              'sandbox' => 'ELqXRheFUcx7w41XVpT1IglSXRzgbwEQ9XpBZ5toqUJnm4tjY9oku3ynWbN1EkAK3gdWCxq-Ac7Vss-g',
                              'live'      => 'EL-XIzcVqUMWNaZBThBH7yTVf2kkaKBSvN7wEV2pbYWZ34BTS4vtxzAZYA2EKzQQzxun4KvB-1Teyx9A'
                          ),
              'params'    => array(
                              'nameProfile' => 'ReservasTyC_' . uniqid(),
                              'logoImage'   => 'https://webapps.tycgroup.com/assets/img/logoTyC50.png',
                              'shipping'    => 1,
                              'address'     => 1,
                              'landingPage' => 'billing',
                              'bank'        => 'https://www.paypal.com'
                             )
      );

      $urls           = array(
                          'return' => sprintf("%s://%s", (!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $app['url_generator']->generate(CVE.'.payReturn')),
                          'cancel' => sprintf("%s://%s", (!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $app['url_generator']->generate(CVE.'.payCancel'))
                        );

      $payData = array(
                  'currency'          => strtoupper($rsv->getDivisa()),
                  'total'             => $rsv->getCargototal(),
                  'subTotal'          => $rsv->getCargototal(),
                  'description'       => $rsv->getNombreevento() .", " . $rsv->getNombrehotel() ." - ". $rsv->getTipohabitacion(),
                  'name'              => $rsv->getNombre() ." ". $rsv->getApp() ." ". $rsv->getApm(),
                  'address1'          => $rsv->getDireccion() .", ". $rsv->getColonia(),
                  'address2'          => '',
                  'city'              => '_',
                  'country_code'      => 'MX',
                  'cp'                => $rsv->getCp(),
                  'state'             => $rsv->getEstado(),
                  'phone'             => $rsv->getTelefono(),
                  'item_name'         => $rsv->getNombreevento(),
                  'item_description'  => $rsv->getNombreevento() .", " . $rsv->getNombrehotel() ." - ". $rsv->getTipohabitacion(),
                  'item_price'        => $rsv->getCargototal(),
                  'item_sku'          => $rsv->getClaveevento() ."-". $rsv->getClavereservacion(),
                  'item_currency'     => strtoupper($rsv->getDivisa()),
                  'email'             => $rsv->getEmail()
                              );
      $ppPlus   = new ppPlus($settings);
      return $app->json($ppPlus->getApproval($payData, $urls, $lang));
    }
 
    public function _execute_(Request $request, Application $app, $lang){
      $pay        = new ppplus;
      $exeUrl     = $request->query->get('exeUrl');
      $payerId    = $request->query->get('payer_id');
      $token      = $request->query->get('token');
      return $app->json($pay->execute($exeUrl, $token, $payerId));
    }
     
     
    public function execute(Request $request, Application $app, $lang){
      $ppPlus     = new ppPlus(array());
      $exeUrl     = $request->query->get('exeUrl');
      $payerId    = $request->query->get('payer_id');
      $token      = $request->query->get('token');
      return $app->json($ppPlus->execute($exeUrl, $token, $payerId));
    }
 
    public function payReturn(Request $request, Application $app, $lang){
      $model  = $app["rsvModel"];
      $tx     = $request->request->get('tx');
      $id     = $request->request->get('data')['idreservacion'];
      $pages  = array(
                  ''      => 'universal/es.return.twig.html',
                  'es'    => 'universal/es.return.twig.html',
                  'en'    => 'universal/en.return.en.twig.html'
      );
      $model->setValue('tx', $tx, $id);
        
      $mailc  = \Swift_Message::newInstance();
      $mailc
        ->setTo('erubi@tycgroup.com', 'Edgar Rubi')
        ->setBcc(array(
                  "caguirre@tycgroup.com" => "Carlos Aguirre",
                  "marellano@tycgroup.com" => "Mariela Arellano",
                 )
                )
        ->setFrom('no--reply@sin-tcevents.mx', 'Pago completado')
        ->setSubject($this->evento . "-  Pago PayPlay completado");

      $bodyc = $app['twig']->render(
                  'pages/eventos17/universal/mail-complete.twig.html',
                  array(
                    'request' => $request->request->all()
                  )
      );

      $mailc->setBody($bodyc, "text/html");
      $env = $app['mailer']->send($mailc);

      return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
        'evento'      => $this->evento,
        'logo'        => array(
                         ),
        'css_logo'    => false,
        'fechas'      => $this->fechas,
        'sede'        => $this->sede,
        'claveEvento' => 'ANCAM',
        'lang'        => $lang,
        'operador'    => $this->operador,
        'request'     => $request->request,
        'urlIndex'    => $app['url_generator']->generate(ANCAM.".index")
      ));
  }
}
