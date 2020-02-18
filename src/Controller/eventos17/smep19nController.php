<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;
//use Lib\Functions\ppplusLive as ppplus;

define("SMEP19","smep19n");

class smep19nController implements ControllerProviderInterface {
  public function connect(Application $app) {
    $index = $app['controllers_factory'];
    $index->get("/{idHotel}/{currency}/{lang}",sprintf('Controller\eventos17\%sController::index',SMEP19))
    ->bind(SMEP19.".index")
    ->assert('currency', '\w+')->value('currency', 'mxn')
    ->assert('lang', '\w+')->value('lang', 'es')
    ->assert('idHotel', '\d+')->value('idHotel', 1);    
    $index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',SMEP19))->bind(SMEP19.".setReservacion");
    $index->get('/confirmacion/{lang}',sprintf('Controller\eventos17\%sController::confirmacion',SMEP19))->bind(SMEP19.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
    $index->get('/politicas/{lang}',sprintf('Controller\eventos17\%sController::politicas',SMEP19))->bind(SMEP19.".politicas")->assert('lang', '\w+')->value('lang', 'es');
    $index->post('/setReservacion',sprintf('Controller\eventos17\%sController::setReservacion',SMEP19))->bind(SMEP19.".setReservacion");
    $index->post('/applyPay/{lang}',sprintf('Controller\eventos17\%sController::applyPay',SMEP19))->bind(SMEP19.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
    $index->get('/checkOut/{lang}',sprintf('Controller\eventos17\%sController::checkOut',SMEP19))->bind(SMEP19.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
    $index->post('/payReturn/{lang}',sprintf('Controller\eventos17\%sController::payReturn',SMEP19))->bind(SMEP19.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
    $index->post('/payCancel/{lang}',sprintf('Controller\eventos17\%sController::payCancel',SMEP19))->bind(SMEP19.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
    $index->get('/execute/{lang}',sprintf('Controller\eventos17\%sController::execute',SMEP19))->bind(SMEP19.'.execute')->assert('lang', '\w+')->value('lang', 'es');
    return $index;
  }

  public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
    $pages = array(
        ''    => 'universal/es.index.twig.html',
        'es'  => 'universal/es.index.twig.html',
        'en'  => 'universal/en.index.twig.html'
    );
    $fn         = new Functions;
    //$paisesArray = $fn->getCountryListArray($lang);
    $paises   = array_column($fn->getCountryListArray($lang)['content']['geonames'], 'countryName', 'geonameId');

      $hoteles[1] =
        array(
          'index'         => '1',
          'nombre'        => 'PRESIDENTE INTERCONTIENTAL',
          'img'           => 'presidentei.jpg',
          'agotado'       => false,
          'hidden'        => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'  => 'HABITACION SGL',
                'en'  => '',
              ),
              'costo'   => array(
                  'mxn' =>  '3,261.67',
                  'usd' =>  '0'
              ),
              'costor'  => array(
                  'mxn' =>  '3,261.67',
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
                'es'  => 'HABITACION DBL',
                'en'  => '',
              ),
              'costo'   => array(
                  'mxn' =>  '5,032.00',
                  'usd' =>  '0'
              ),
              'costor'  => array(
                  'mxn' =>  '5,032.00',
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
                      '<li>Renta de habitación por noche en la categoría elegida</li>'.
                      '<li>Desayuno Buffet en el Restaurante</li>'.
                      '<li>Comida Buffet con agua de sabor</li>'.
                      '<li>01 Cena menú de 3 tiempos con agua de sabor incluida</li>'.
                      '<li>02 Cenas menú de 3 tiempos con agua de sabor incluida ( Cenas del 22 y 23 de mayo)</li>'.
                      '<li>Propinas a Bell boys y Camaristas</li>'.
                      '<li>Impuestos y servicios</li>'.
                      '<li>El Check In 15:00 hrs. / Check Out 13:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );

      $hoteles[2] =
        array(
          'index'         => '2',
          'nombre'        => 'PRESIDENTE INTERCONTIENTAL (DAY PASS)',
          'img'           => 'presidenteia.jpg',
          'agotado'       => false,
          'hidden'        => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'  => 'DAY PASS POR PERSONA',
                'en'  => '',
              ),
              'costo'   => array(
                  'mxn' =>  '1,411.50',
                  'usd' =>  '0'
              ),
              'costor'  => array(
                  'mxn' =>  '1,411.50',
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
              'es' => '<h3 class="c-theme-font c-font-uppercase">Costo por persona por día, el “Day Pass”  Incluye:</h3>'.
                      '<ul>'.
                      '<li>Comida Buffet con agua de sabor</li>'.
                      '<li>01 Cena menú de 3 tiempos con agua de sabor incluida ( 21 de agosto)</li>'.
                      '<li>02 Cenas menú de 3 tiempos con agua de sabor incluida ( Cenas del 22 y 23 de agosto)</li>'.
                      '<li>Impuestos y servicios</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );        
  
      $hoteles[3] =
        array(
          'index'         => '3',
          'nombre'        => 'HOLIDAY INN EXPRESS PUEBLA',
          'img'           => 'holidayInnP.jpg',
          'agotado'       => false,
          'hidden'        => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'  => 'HABITACION SGL',
                'en'  => '',
              ),
              'costo'   => array(
                  'mxn' =>  '2,531.67',
                  'usd' =>  '0'
              ),
              'costor'  => array(
                  'mxn' =>  '2,531.67',
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
                'es'  => 'HABITACION DBL',
                'en'  => '',
              ),
              'costo'   => array(
                  'mxn' =>  '3,825.33',
                  'usd' =>  '0'
              ),
              'costor'  => array(
                  'mxn' =>  '3,825.33',
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
                      '<li>Renta de habitación por noche en la categoría elegida</li>'.
                      '<li>Se realizará un solo cargo por persona por concepto de propinas a bell boys (Sencilla $20.00 / Doble $40.00).</li>'.
                      '<li>Tarifas cotizadas en MN</li>'.
                      '</ul>'.
                      '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                      '<ul>'.
                      '<li>Check In 15:00 hrs. / Check out 13:00 hrs.</li>'.
                      '</ul>'.
                      '',
              'en' => ''
          )
      );  

      return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
      'title'         => '',
      'evento'        => 'XX CONGRESO ANUAL SMEP 2019',
      'hoteles'       => $hoteles,
      'hotelesJson'   => json_encode($hoteles),
      'currency'      => $currency,
      'idHotel'       => (int)$idHotel,
      'lang'          => $lang,
      'paises'        => $paises,
      'logo'          => array(
                      ),
      'css_logo'      => false,
      'fechas'        => array(
                          'es' => '21 AL 24 DE MAYO 2019',
                          'en' => '' 
                          ),
      'sede'          => array(
                          'es' => 'PUEBLA PUEBLA',
                          'en' => '' 
                          ),
      'claveEvento'   => 'SMEP19',
      'fechaLleMin'   => '2019-05-21',
      'fechaLleMax'   => '2019-05-23',
      'fechaSalMin'   => '2019-10-22',
      'fechaSalMax'   => '2019-10-24',
      'noches'        => 2,
      'urlIndex'      => $app['url_generator']->generate(SMEP19.".index"),
      'urlReserva'    => $app['url_generator']->generate(SMEP19.".setReservacion"),
      'urlConfirma'   => $app['url_generator']->generate(SMEP19.".confirmacion"),
      'urlApplyPay'   => $app['url_generator']->generate(SMEP19.".applyPay"),
      'urlChekout'    => $app['url_generator']->generate(SMEP19.".checkOut"),
      'urlExecute'    => $app['url_generator']->generate(SMEP19.".execute"),
      'urlPayReturn'  => $app['url_generator']->generate(SMEP19.".payReturn"),
      'rutaImg'       => 'smep',
      'links'         => array(
                            'es' => array(
                                'politicas' => array(
                                                'url'   => $app['url_generator']->generate(SMEP19.".politicas"),
                                                'name'  => 'Políticas de reservación'
                                              ),
                                'formato'   => array()
                                ),
                            'en' => array(
                                'politicas' => array(
                                                'url'   => $app['url_generator']->generate(SMEP19.".politicas"),
                                                'name'  => 'Reservation Policies'
                                              ),
                                'formato'   => array()
                                )       
                          ),
      'linksJson'     => json_encode(
                            array(
                            )
                          ),
      'operador'      => array(
                          'name'      => 'Carlos Aguirre',
                          'sortName'  => 'CA',
                          'mail'      => 'caguirre@tycgroup.com',
                          'phone'     => '+52 55 5148 75 00 ext: 69'
                      ),
      'extOperador'   => array(
                            
                          ),                      
      'operadorJson'  => json_encode(
                            array(
                              'name'      => 'Carlos Aguirre',
                              'sortName'  => 'CA',
                              'mail'      => 'caguirre@tycgroup.com',
                              'phone'     => '+52 55 5148 75 00 ext: 69'
                            )                           
                          ),
      'host'          => $request->server->get('HTTP_HOST'),
      'protocol'      => sprintf("%s://",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http'),
      'hostFullUri'   => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME')),
      'hostFull'      => sprintf("%s://%s%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http', $request->server->get('SERVER_NAME') ,$request->server->get('REQUEST_URI')),
      'mode'          => 'sandbox',
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
      'blkAco'       => true,
      'blkAll'       => false,
      'first' 		   => 1,
      'noOne'        => false
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
    $SMEP19Rsv     = time();
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
    $request->request->set('claveReservacion',$SMEP19Rsv);
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
              //"marellano@tycgroup.com" => "Mariela Arellano"
          ))
          ->setFrom('no--reply@sin-tcevents.mx','Reservacion')
          ->setSubject('XX CONGRESO ANUAL SMEP 2019');
      }
      else{
        $mail
          ->setTo($request->request->get('correo'),$nombre)
          ->setBcc(array(
              //"lcazares@tcevents.com" => "Luis Cazares",
              //"marellano@tycgroup.com" => "Mariela Arellano",
              "erubi@tycgroup.com" => "Edgar Rubi"
          ))
          ->setFrom('no--reply@sin-tcevents.mx','Reservacion')
          ->setSubject('Inicio de proceso Reservacion XX CONGRESO ANUAL SMEP 2019');
      }
      $imgHotel = explode("/",$request->request->get('imgHotel'));
      $imgHotel = end($imgHotel);
      $imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/smep/" . $imgHotel;
      $body = $app['twig']->render('pages/eventos17/universal/'.$pages[$request->request->get('lang') ], array(
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
      ''    => 'smep19.politicas.twig.html',
      'es'  => 'smep19.politicas.twig.html',
      'en'  => 'smep19.politicas-en.twig.html',
    );    
    return $app['twig']->render("pages/eventos17/SMEP19/" . $pages[$lang], array(
      'data' => $request->query
    )); 
  }

  public function _checkOut_(Request $request, Application $app,$lang){
    $response = array();
    $pay      = new ppplus;
    $urls     = array(
                  'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(SMEP19.".payReturn"),
                  'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(SMEP19.".payCancel")
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
        'en'  => 'universal/en.return.en.twig.html'
    );
    $model->setValue('tx',$tx,$id);

		$mailc 	= \Swift_Message::newInstance();
		$mailc
			->setTo('erubi@tycgroup.com','Edgar Rubi')
			->setBcc(array(
        "caguirre@tycgroup.com" => "Mariela Arellano",
			))
			->setFrom('no--reply@sin-tcevents.mx','Pago completado')
      ->setSubject('XX CONGRESO ANUAL SMEP 2019 -  Pago PayPlay completado');

      $bodyc = $app['twig']->render('pages/eventos17/universal/mail-complete.twig.html', array(
				'request' => $request->request->all()
			)
		);

		$mailc->setBody($bodyc, "text/html");
		$env = $app['mailer']->send($mailc);      

    return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
      'evento'        => 'XX CONGRESO ANUAL SMEP 2019',
      'logo'          => array(
                      ),
      'css_logo'      => false,
      'fechas'        => array(
                          'es' => '21 AL 24 DE MAYO 2019',
                          'en' => '' 
                          ),
      'sede'          => array(
                          'es' => 'PUEBLA PUEBLA',
                          'en' => '' 
                          ),
      'claveEvento'   => SMEP19,
      'lang'          => $lang,
      'operador'      => array(
                            'name'      => 'Carlos Aguirre',
                            'sortName'  => 'CA',
                            'mail'      => 'caguirre@tycgroup.com',
                            'phone'     => '+52 55 5148 75 00 ext: 69'
                      ),
      'request'       => $request->request,
      'urlIndex'      => $app['url_generator']->generate(SMEP19.".index")
    ));
  } 

}
?>