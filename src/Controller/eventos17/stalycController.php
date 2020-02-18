<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;
//use Lib\Functions\ppplusLive as ppplus;

define("STALYC","stalyc");

class stalycController implements ControllerProviderInterface {
  public function connect(Application $app) {
    $index = $app['controllers_factory'];
    $index->get("/{idHotel}/{currency}/{lang}",sprintf('Controller\eventos17\%sController::index',STALYC))
    ->bind(STALYC.".index")
    ->assert('currency', '\w+')->value('currency', 'mxn')
    ->assert('lang', '\w+')->value('lang', 'es')
    ->assert('idHotel', '\d+')->value('idHotel', 1);
    $index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',STALYC))->bind(STALYC.".setReservacion");
    $index->get('/confirmacion/{lang}',sprintf('Controller\eventos17\%sController::confirmacion',STALYC))->bind(STALYC.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
    $index->get('/politicas/{lang}',sprintf('Controller\eventos17\%sController::politicas',STALYC))->bind(STALYC.".politicas")->assert('lang', '\w+')->value('lang', 'es');
    $index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',STALYC))->bind(STALYC.".setReservacion");
    $index->post('/applyPay/{lang}',sprintf('Controller\eventos17\%sController::applyPay',STALYC))->bind(STALYC.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
    $index->get('/checkOut/{lang}',sprintf('Controller\eventos17\%sController::checkOut',STALYC))->bind(STALYC.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
    $index->post('/payReturn/{lang}',sprintf('Controller\eventos17\%sController::payReturn',STALYC))->bind(STALYC.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
    $index->post('/payCancel/{lang}',sprintf('Controller\eventos17\%sController::payCancel',STALYC))->bind(STALYC.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
    $index->get('/execute/{lang}',sprintf('Controller\eventos17\%sController::execute',STALYC))->bind(STALYC.'.execute')->assert('lang', '\w+')->value('lang', 'es');
    return $index;
  }

  public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
    $pages = array(
        ''    => 'universal/es.index.twig.html',
        'es'  => 'universal/es.index.twig.html',
        'en'  => 'universal/en.index.twig.html'
    );
    $fn         = new Functions;
    //$paises   = $fn->getCountryList($lang);
    $paises   = array_column($fn->getCountryListArray($lang)['content']['geonames'], 'countryName', 'geonameId');

      $hoteles[1] =
        array(
          'index'         => '1',
          'nombre'        => 'HOTEL HYATT REGENCY MÉRIDA',
          'img'           => 'hyattm.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'  => 'Habitación Sencilla en Plan Europeo',
                'en'  => 'Single Room in European Plan',
              ),
              'costo'   => array(
                  'mxn' =>  '2,376.00',
                  'usd' =>  '113.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,376.00',
                  'usd' =>  '113.00'
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
                'es'  => 'Habitación Doble en Plan Europeo',
                'en'  => 'Double Room or Double in European Plan',
              ),
              'costo'   => array(
                  'mxn' =>  '2,376.00',
                  'usd' =>  '113.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,376.00',
                  'usd' =>  '113.00'
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
                'es'  => 'Habitación Sencilla con Desayuno Incluido (1 persona)',
                'en'  => 'Sigle Room with Breakfast included (1 person)',
              ),
              'costo'   => array(
                  'mxn' =>  '2,639.00',
                  'usd' =>  '126.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,639.00',
                  'usd' =>  '126.00'
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
                'es'  => 'Habitación Doble con Desayuno Incluido (2 personas)',
                'en'  => 'Double Room with Breakfast included (2 persons)',
              ),
              'costo'   => array(
                  'mxn' =>  '2,882.00',
                  'usd' =>  '137.24'
              ),
              'costor'  => array(
                  'mxn' =>  '2,882.00',
                  'usd' =>  '137.24'
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
          'all' => true,
          'mensajes'      => array(
              'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                      '<ul>'.
                      '<li>Renta de habitación en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos), impuestos y propinas (Camaristas y bell boys).</li>'.
                      '<li>Renta de habitación en la categoría elegida sencilla o doble con desayuno buffet, impuestos y propinas (Camaristas y bell boys).</li>'.
                      '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => '<h3 class="c-theme-font c-font-uppercase">The rate includes:</h3>'.
                      '<ul>'.
                      '<li>Room Rent in the chosen single or double category in European Plan (Without food included), Taxes, and tips included</li>'.
                      '<li>Room Rent in the chosen single or double category in Plan with Breakfast, Taxes, and tips included</li>'.
                      '<li>The check-in at the Hotel is from 15:00 hrs, and the check-out is at 12:00 hrs.</li>'.
                      '</ul>'.
                      ''
          )
      );


      $hoteles[2] =
        array(
          'index'         => '2',
          'nombre'        => 'HOTEL FIESTA AMERICANA MÉRIDA',
          'img'           => 'fiestaam.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'  => 'Habitación Sencilla en Plan Europeo',
                'en'  => 'Single Room in European Plan',
              ),
              'costo'   => array(
                  'mxn' =>  '2,376.00',
                  'usd' =>  '113.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,376.00',
                  'usd' =>  '113.00'
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
                'es'  => 'Habitación Doble en Plan Europeo',
                'en'  => 'Double Room in European Plan',
              ),
              'costo'   => array(
                  'mxn' =>  '2,376.00',
                  'usd' =>  '113.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,376.00',
                  'usd' =>  '113.00'
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
                'es'  => 'Habitación Sencilla con Desayuno Incluido (1 persona)',
                'en'  => 'Sigle Room with Breakfast included (1 person)',
              ),
              'costo'   => array(
                  'mxn' =>  '2,792.00',
                  'usd' =>  '133.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,792.00',
                  'usd' =>  '133.00'
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
                'es'  => 'Habitación Doble con Desayuno Incluido (2 personas)',
                'en'  => 'Double Room with Breakfast included (2 persons)',
              ),
              'costo'   => array(
                  'mxn' =>  '3,278.00',
                  'usd' =>  '156.00'
              ),
              'costor'  => array(
                  'mxn' =>  '3,278.00',
                  'usd' =>  '156.00'
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
          'all' => true,
          'mensajes'      => array(
              'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                      '<ul>'.
                      '<li>Renta de habitación en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos), impuestos y propinas (Camaristas y bell boys).</li>'.
                      '<li>Renta de habitación en la categoría elegida sencilla o doble con desayuno buffet, impuestos y propinas (Camaristas y bell boys).</li>'.
                      '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => '<h3 class="c-theme-font c-font-uppercase">The rate includes:</h3>'.
                      '<ul>'.
                      '<li>Room Rent in the chosen single or double category in European Plan (Without food included), Taxes, and tips included</li>'.
                      '<li>Room Rent in the chosen single or double category in Plan with Breakfast, Taxes, and tips included</li>'.
                      '<li>The check-in at the Hotel is from 15:00 hrs, and the check-out is at 12:00 hrs.</li>'.
                      '</ul>'.
                      ''
          )
      );

      $hoteles[3] =
        array(
          'index'         => '3',
          'nombre'        => 'HOTEL PRESIDENTE INTERCONTINENTAL VILLA MERCEDES MÉRIDA',
          'img'           => 'intervm.jpg',
          'agotado'       => true,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'  => 'SENCILLA DE LUJO / DOBLE DE LUJO EN PLAN EUROPEO',
                'en'  => 'SINGLE / DOUBLE LUXURY EUROPEAN PLAN INCLUDED TIPS',
              ),
              'costo'   => array(
                  'mxn' =>  '2,574.00',
                  'usd' =>  '123.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,574.00',
                  'usd' =>  '123.00'
              ),
              'propinas'  =>  array(
                'mxn' =>  '0',
                'usd' =>  '0'
                ),
              'pack' => 0,
              'pp'    => 0,
              'hagotada' => true
              ),
            array(
              'tipo'  => array(
                'es'  => 'SENCILLA DE LUJO CON DESAYUNO BUFFET',
                'en'  => 'SINGLE LUXURY PLAN WITH BREAKFAST INCLUDED',
              ),
              'costo'   => array(
                  'mxn' =>  '3,010.00',
                  'usd' =>  '143.00'
              ),
              'costor'  => array(
                  'mxn' =>  '3,010.00',
                  'usd' =>  '143.00'
              ),
              'propinas'  =>  array(
                'mxn' =>  '0',
                'usd' =>  '0'
                ),
              'pack' => 0,
              'pp'    => 0,
              'hagotada' => true
              ),
            array(
              'tipo'  => array(
                'es'  => 'DOBLE DE LUJO CON DESAYUNO BUFFET',
                'en'  => 'DOUBLE LUXURY PLAN WITH BREAKFAST INCLUDED',
              ),
              'costo'   => array(
                  'mxn' =>  '3,422.00',
                  'usd' =>  '163.00'
              ),
              'costor'  => array(
                  'mxn' =>  '3,422.00',
                  'usd' =>  '163.00'
              ),
              'propinas'  =>  array(
                'mxn' =>  '0',
                'usd' =>  '0'
                ),
              'pack' => 0,
              'pp'    => 0,
              'hagotada' => true
              )
          ),
          'all' => true,
          'mensajes'      => array(
              'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                      '<ul>'.
                      '<li>Renta de habitación en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos), impuestos y propinas (Camaristas y bell boys).</li>'.
                      '<li>Renta de habitación en la categoría elegida sencilla o doble con desayuno buffet, impuestos y propinas (Camaristas y bell boys).</li>'.
                      '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => '<h3 class="c-theme-font c-font-uppercase">The rate includes:</h3>'.
                      '<ul>'.
                      '<li>Room Rent in the chosen single or double category in European Plan (Without food included), Taxes, and tips included</li>'.
                      '<li>Room Rent in the chosen single or double category in Plan with Breakfast, Taxes, and tips included</li>'.
                      '<li>The check-in at the Hotel is from 15:00 hrs, and the check-out is at 12:00 hrs.</li>'.
                      '</ul>'.
                      ''
          )
      );

      $hoteles[4] =
        array(
          'index'         => '4',
          'nombre'        => 'HOTEL NH COLLECTION MERIDA PASEO MONTEJO',
          'img'           => 'nhcolm.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'  => 'Habitación Sencilla en Plan Europeo',
                'en'  => 'Single Room in European Plan',
              ),
              'costo'   => array(
                  'mxn' =>  '2,112.00',
                  'usd' =>  '101.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,112.00',
                  'usd' =>  '101.00'
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
                'es'  => 'Habitación Doble en Plan Europeo',
                'en'  => 'Double Room in European Plan',
              ),
              'costo'   => array(
                  'mxn' =>  '2,112.00',
                  'usd' =>  '101.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,112.00',
                  'usd' =>  '101.00'
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
                'es'  => 'Habitación Sencilla con Desayuno Incluido (1 persona)',
                'en'  => 'Sigle Room with Breakfast included (1 person)',
              ),
              'costo'   => array(
                  'mxn' =>  '2,404.00',
                  'usd' =>  '114.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,404.00',
                  'usd' =>  '114.00'
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
                'es'  => 'Habitación Doble con Desayuno Incluido (2 personas)',
                'en'  => 'Double Room with Breakfast included (2 persons)',
              ),
              'costo'   => array(
                  'mxn' =>  '2,694.00',
                  'usd' =>  '128.00'
              ),
              'costor'  => array(
                  'mxn' =>  '2,694.00',
                  'usd' =>  '128.00'
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
          'all' => true,
          'mensajes'      => array(
              'es' => '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                      '<ul>'.
                      '<li>Renta de habitación en la categoría elegida sencilla o doble en Plan Europeo (Sin alimentos), impuestos y propinas incluidas (Camaristas y bell boys).</li>'.
                      '<li>Renta de habitación en la categoría elegida sencilla o doble con desayuno buffet, impuestos y propinas (Camaristas y bell boys).</li>'.
                      '<li>El check inn en el Hotel es a partir de las 15:00 hrs, y el check out es a las 12:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => '<h3 class="c-theme-font c-font-uppercase">The rate includes:</h3>'.
                      '<ul>'.
                      '<li>Room Rent in the chosen single or double category in European Plan (Without food included), Taxes, and tips included</li>'.
                      '<li>Room Rent in the chosen single or double category in Plan with Breakfast, Taxes, and tips included</li>'.
                      '<li>The check-in at the Hotel is from 15:00 hrs, and the check-out is at 12:00 hrs.</li>'.
                      '</ul>'.
                      ''
          )
      );

      return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
      'title'         => '',
      'evento'        => 'XXV CONGRESO LATINOAMERICANO Y DEL CARIBE DE TRASPLANTE',
      'hoteles'       => $hoteles,
      'hotelesJson'   => json_encode($hoteles),
      'currency'      => $currency,
      'idHotel'       => $idHotel,
      'lang'          => $lang,
      'paises'        => $paises,
      'logo'          => array(
                      ),
      'css_logo'      => '',
      'banner'        => true,
      'logo_banner'   => 'stalyc_ban_3a.png',
      'css_banner'    => 'bannerStalyc',
      'stiky'         => false,
      'fechas'        => array(
                          'es' => 'DEL 23 AL 26 DE OCTUBRE DE 2019',
                          'en' => 'FROM 23 TO 26 OCTOBER 2019'
                          ),
      'sede'          => array(
                          'es' => 'MÉRIDA, YUCATÁN',
                          'en' => 'MÉRIDA, YUCATÁN'
                          ),
      'claveEvento'   => 'STALYC',
      'fechaLleMin'   => '2019-10-20',
      'fechaLleMax'   => '2019-10-28',
      'fechaSalMin'   => '2019-10-21',
      'fechaSalMax'   => '2019-10-29',
      'noches'        => 2,
      'urlIndex'      => $app['url_generator']->generate(STALYC.".index"),
      'urlReserva'    => $app['url_generator']->generate(STALYC.".setReservacion"),
      'urlConfirma'   => $app['url_generator']->generate(STALYC.".confirmacion"),
      'urlApplyPay'   => $app['url_generator']->generate(STALYC.".applyPay"),
      'urlChekout'    => $app['url_generator']->generate(STALYC.".checkOut"),
      'urlExecute'    => $app['url_generator']->generate(STALYC.".execute"),
      'urlPayReturn'  => $app['url_generator']->generate(STALYC.".payReturn"),
      'rutaImg'       => 'stalyc',
      'links'         => array(
                            'es' => array(
                                'politicas' => array(
                                                'url'   => $app['url_generator']->generate(STALYC.".politicas"),
                                                'name'  => 'Políticas de reservación'
                                              ),
                                'formato'   => array()
                                ),
                            'en' => array(
                                'politicas' => array(
                                                'url'   => $app['url_generator']->generate(STALYC.".politicas"),
                                                'name'  => 'Reservation Policies'
                                              ),
                                'formato'   => array()
                                )
                          ),
      'flags'         => array(
                            'es' => array(
                                    'fen' => array(
                                              'url'   => $app['url_generator']->generate(STALYC.".index")."/1/$currency/en",
                                              'name'  => 'EN'
                                    )
                            ),
                            'en' => array(
                                    'fes' => array(
                                              'url'   => $app['url_generator']->generate(STALYC.".index")."/1/$currency/es",
                                              'name'  => 'ES'
                                    )
                            ),                                  

                      ),
      'linksJson'     => json_encode(
                            array(
                            )
                          ),
      'operador'      => array(
                          'name'      => 'Mariela Arellano',
                          'sortName'  => 'MA',
                          'mail'      => 'marellano@tycgroup.com',
                          'phone'     => '+52 55 5148 75 00 ext: 11'
                      ),
      'extOperador'   => array(
                            array(
                              'name'      => 'Carlos Aguirre',
                              'sortName'  => 'CA',
                              'mail'      => 'caguirre@tycgroup.com',
                              'phone'     => '+52 55 5148 75 00 ext: 69'
                            )
                          ),
      'operadorJson'  => json_encode(
                            array(
                              'name'      => 'Carlos Aguirre',
                              'sortName'  => 'CA',
                              'mail'      => 'caguirre@tcevents.com',
                              'phone'     => '+52 55 5148 75 00 ext: 69'
                            )
                          ),
      'host'          => $request->server->get('HTTP_HOST'),
      'protocol'      => sprintf("%s://",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http'),
      'hostFullUri'   => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME')),
      'hostFull'      => sprintf("%s://%s%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME') ,$request->server->get('REQUEST_URI')),
      'mode'          => 'live',
      'dateMsg'       => array(
                        ),
      '_msg_'         => array(
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
      'blkAco'       => false
      ));
  }

  public function setReservacion(Request $request, Application $app){
    $model = $app["rsvModel"];
    $fn         = new Functions;
    $dh         = explode('|', $request->request->get('habitacionc'));
    $now        = new \DateTime('now');
    $fllegada   = $fn->d2b($request->request->get('fechaLlegada'));
    $fsalida    = $fn->d2b($request->request->get('fechaSalida'));
    $habitacion = $dh[0];
    $costoNoche = str_replace(',','',$dh[1]);
    $bellBoy    = str_replace(',','',$dh[2]);
    $pack       = (empty(str_replace(',','',$dh[3]))) ? 0*1 : str_replace(',','',$dh[3])*1;
    $pp         = $dh[4];
    $costoNochr = str_replace(',','',$dh[5]);
    $STALYCRsv     = time();
    $diasPago   = 0;
    $fpago      = $request->request->get('pago');
    $data = array();
    $pages = array(
        ''    => 'mail-deposito-es.twig.html',
        'es'  => 'mail-deposito-es.twig.html',
        'en'  => 'mail-deposito-en.twig.html'
    );
    if($pack != 0){
      $costoNochr = $costoNochr / $pack;
      $diasPago   = $pack;
    }
    elseif($request->request->get('pagoPor') == 'N'){
      $diasPago = $request->request->get('noches');
    }
    else{
      $dl       = $fllegada;
      $ds       = $fsalida;
      $di       = $fllegada->diff($fsalida);
      $diasPago = $di->format('%a');
    }
    $cargo      = ($costoNochr * $diasPago) + $bellBoy;
    $request->request->set('claveReservacion',$STALYCRsv);
    $request->request->set('tipoHabitacion',$habitacion);
    $request->request->set('costoNoche',$costoNochr);
    $request->request->set('cargoBellBoys',$bellBoy);
    $request->request->set('diasPago',$diasPago);
    $request->request->set('cargoTotal',$cargo);
    $request->request->set('status','iniciada');
    $fechas['fsalida']  = $fsalida;
    $fechas['fllegada'] = $fllegada;
    $fechas['now']    = $now;
    $json     = array(
      'status' => false,
      'msg'   => '',
      'data'  => null
    );
    $rsv = $model->crearReservacion($request->request,$fechas,$app);
    if($rsv){
      $data = $app["serializer"]->toArray($rsv);
      $data['mode'] = $request->request->get('pmode');
      $data['lang'] = $request->request->get('lang');
      $mail   = \Swift_Message::newInstance();
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
          ->setSubject('Reservacion XXV CONGRESO LATINOAMERICANO Y DEL CARIBE DE TRASPLANTE');
      }
      else{
        $mail
          ->setTo($request->request->get('correo'),$nombre)
          ->setBcc(array(
              "lcazares@tcevents.com" => "Luis Cazares",
              "marellano@tycgroup.com" => "Mariela Arellano",
              "caguirre@tycgroup.com" => "Carlos Aguirre",
              "erubi@tycgroup.com" => "Edgar Rubi"
          ))
          ->setFrom('no--reply@sin-tcevents.mx','Reservacion')
          ->setSubject('Inicio de proceso de Reservación XXV CONGRESO LATINOAMERICANO Y DEL CARIBE DE TRASPLANTE');
      }
      $imgHotel = explode("/",$request->request->get('imgHotel'));
      $imgHotel = end($imgHotel);
      $imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/stalyc/" . $imgHotel;
      $body = $app['twig']->render('pages/eventos17/STALYC/'.$pages[$request->request->get('lang') ], array(
        "data"      => $rsv,
        "idHotel"   => $request->request->get('idHotel'),
        "pais"      => $fn->getGeo($request->request->get('pais'),'name'),
        "paisRs"    => empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name'),
        "bannerImg" => 'http://webapps.tycgroup.com/assets/img/bannerReMail.png',
        "imgHotel"  =>  $imgHotel,
        "operador"  => array(
                        'name'      => 'Carlos Aguirre',
                        'sortName'  => 'CA',
                        'mail'      => 'caguirre@tycgroup.com',
                        'phone'     => '+52 55 5148 75 00 ext: 69'
                      )
        )
      );
      $mail->setBody($body, "text/html");
      $env = $app['mailer']->send($mail);
      $json     = array(
          'status'  => true,
          'msg'     => '',
          'data'    => $data,
          'aData'   => $app["serializer"]->toArray($data),
          'request' => $request->request->all()
      );
    }
    return $app->json($json);
  }

  public function confirmacion(Request $request, Application $app,$lang){
    $pages = array(
        ''    => 'es.confirmacion.twig.html',
        'es'  => 'es.confirmacion.twig.html',
        'en'  => 'en.confirmacion.twig.html',
    );
    return $app['twig']->render("pages/eventos17/universal/" . $pages[$lang], array(
      'data'      => $request->query
    ));
  }

  public function politicas(Request $request, Application $app,$lang){
    $pages = array(
      ''    => 'STALYC.politicas.twig.html',
      'es'  => 'STALYC.politicas.twig.html',
      'en'  => 'STALYC.politicas-en.twig.html',
    );
    return $app['twig']->render("pages/eventos17/STALYC/" . $pages[$lang], array(
      'data' => $request->query
    ));
  }

  public function _checkOut_(Request $request, Application $app,$lang){
    $response = array();
    $pay      = new ppplus;
    $urls     = array(
                  'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(STALYC.".payReturn"),
                  'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(STALYC.".payCancel")
                );
    $params   = array(
                  'nameProfile' => 'ReservasTyC_' . uniqid(),
                  'logoImage'   => 'https://webapps.tycgroup.com/assets/img/logoTyC50.png',
                  'shipping'    => 1,
                  'address'     => 1,
                  'landingPage' => 'billing',
                  'bank'        => 'https://www.paypal.com'
                );
    return $app->json($pay->checkOut($request->query,$lang,$urls,$params));
  }


  public function checkOut(Request $request, Application $app,$lang){
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
                          'live'    => 'AXIjt9ZwFU34lIzBOlOb2ozh5ZyQ3Tif7hehrFgyhcBFFTValGA4835roqraOvM_voonyy2ceGSfJ0r-'
                        ),
        'secret'    => array(
                          'sandbox' => 'ELqXRheFUcx7w41XVpT1IglSXRzgbwEQ9XpBZ5toqUJnm4tjY9oku3ynWbN1EkAK3gdWCxq-Ac7Vss-g',
                          'live'    => 'EL-XIzcVqUMWNaZBThBH7yTVf2kkaKBSvN7wEV2pbYWZ34BTS4vtxzAZYA2EKzQQzxun4KvB-1Teyx9A'
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

    $urls       = array(
                    'return' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate(CVE.'.payReturn')),
                    'cancel' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate(CVE.'.payCancel'))
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
    $ppPlus     = new ppPlus($settings);
    return $app->json($ppPlus->getApproval($payData,$urls,$lang));
  }


  public function _execute_(Request $request, Application $app,$lang){
    $pay      = new ppplus;
    $exeUrl   = $request->query->get('exeUrl');
    $payerId  = $request->query->get('payer_id');
    $token    = $request->query->get('token');
    return $app->json($pay->execute($exeUrl,$token,$payerId));
  }

  public function execute(Request $request, Application $app,$lang){
    $ppPlus   = new ppPlus(array());
    $exeUrl   = $request->query->get('exeUrl');
    $payerId  = $request->query->get('payer_id');
    $token    = $request->query->get('token');
    return $app->json($ppPlus->execute($exeUrl,$token,$payerId));
  }

  public function payReturn(Request $request, Application $app,$lang){
    $model  = $app["rsvModel"];
    $tx     = $request->request->get('tx');
    $id     = $request->request->get('data')['idreservacion'];
    $pages = array(
        ''    => 'universal/es.return.twig.html',
        'es'  => 'universal/es.return.twig.html',
        'en'  => 'universal/en.return.twig.html'
    );
    $model->setValue('tx',$tx,$id);

		$mailc 	= \Swift_Message::newInstance();
		$mailc
			->setTo('erubi@tycgroup.com','Edgar Rubi')
			->setBcc(array(
        "marellano@tycgroup.com" => "Mariela Arellano",
        "caguirre@tycgroup.com" => "Carlos Aguirre"

			))
			->setFrom('no--reply@sin-tcevents.mx','Pago completado')
      ->setSubject('XXV CONGRESO LATINOAMERICANO Y DEL CARIBE DE TRASPLANTE -  Pago PayPlay completado');

      $bodyc = $app['twig']->render('pages/eventos17/universal/mail-complete.twig.html', array(
				'request' => $request->request->all()
			)
		);

		$mailc->setBody($bodyc, "text/html");
		$env = $app['mailer']->send($mailc);

    return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
      'evento'        => 'XXV CONGRESO LATINOAMERICANO Y DEL CARIBE DE TRASPLANTE',
      'logo'          => array(
                      ),
      'css_logo'      => false,
      'fechas'        => array(
                          'es' => 'DEL 23 AL 26 DE OCTUBRE DE 2019',
                          'en' => 'FROM 23 TO 26 OCTOBER 2019'
                          ),
      'sede'          => array(
                          'es' => 'MÉRIDA, YUCATÁN',
                          'en' => 'MÉRIDA, YUCATÁN'
                          ),
      'claveEvento'   => STALYC,
      'lang'          => $lang,
      'operador'      => array(
        'name'      => 'Carlos Aguirre',
        'sortName'  => 'CA',
        'mail'      => 'caguirre@tcevents.com',
        'phone'     => '+52 55 5148 75 00 ext: 69'
      ),      
      'request'       => $request->request,
      'urlIndex'      => $app['url_generator']->generate(STALYC.".index")."/1/mxn/es",
      'banner'        => true,
      'logo_banner'   => 'stalyc_ban_3a.png',
      'css_banner'    => 'bannerStalyc',
      'stiky'         => false,      
    ));
  }

}
?>
