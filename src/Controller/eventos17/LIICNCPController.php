<?php
 
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
 
use Symfony\Component\HttpFoundation\Request;
 
use Lib\Functions\Functions;
 
use Lib\Functions\ppPlus;

//use Lib\Functions\ppplusLive as ppplus;
 
define("LIICNCP", "LIICNCP");
 
class LIICNCPController implements ControllerProviderInterface
{
    private $evento;
    private $fechas;
    private $sede;
    private $operador;
    private $extOperador;
 
    public function __construct()
    {
        $this->evento         = "LIII CONGRESO NACIONAL DE CIRUGIA PEDIÁTRICA";
        $this->fechas         = array(
                                'es' => '11 AL 16 DE SEPTIEMBRE DE 2020',
                                'en' => 'From 11 to 16, September, 2020'
                              );
        $this->sede           = array(
                                'es' => 'LEÓN, GUANAJUATO',
                                'en' => 'LEÓN, GUANAJUATO'
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
        $index->get("/{idHotel}/{currency}/{lang}", sprintf('Controller\eventos17\%sController::index', LIICNCP))
        ->bind(LIICNCP.".index")
        ->assert('currency', '\w+')->value('currency', 'mxn')
        ->assert('lang', '\w+')->value('lang', 'es')
        ->assert('idHotel', '\d+')->value('idHotel', 1);
        $index->post('/setReservacion', sprintf('Controller\eventos17\%sController::setReservacion', LIICNCP))->bind(LIICNCP.".setReservacion");
        $index->get('/confirmacion/{lang}', sprintf('Controller\eventos17\%sController::confirmacion', LIICNCP))->bind(LIICNCP.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/politicas/{lang}', sprintf('Controller\eventos17\%sController::politicas', LIICNCP))->bind(LIICNCP.".politicas")->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/setReservacion', sprintf('Controller\eventos17\%sController::setReservacion', LIICNCP))->bind(LIICNCP.".setReservacion");
        $index->post('/applyPay/{lang}', sprintf('Controller\eventos17\%sController::applyPay', LIICNCP))->bind(LIICNCP.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/checkOut/{lang}', sprintf('Controller\eventos17\%sController::checkOut', LIICNCP))->bind(LIICNCP.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/payReturn/{lang}', sprintf('Controller\eventos17\%sController::payReturn', LIICNCP))->bind(LIICNCP.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/payCancel/{lang}', sprintf('Controller\eventos17\%sController::payCancel', LIICNCP))->bind(LIICNCP.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/execute/{lang}', sprintf('Controller\eventos17\%sController::execute', LIICNCP))->bind(LIICNCP.'.execute')->assert('lang', '\w+')->value('lang', 'es');
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
          'nombre'        => 'HS HOTSSON HOTEL LEÓN',
          'img'           => 'hotsonLeon.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'    => 'HABITACION ESTANDAR SENCILLA (1 CAMA)',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '2,685.36',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '2,685.36',
                'usd'   =>   '0'
              ),
              'propinas'  =>   array(
                'mxn'   =>   '0',
                'usd'   =>   '0'
                      ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            ),
            array(
              'tipo'  => array(
                'es' => 'HABITACION ESTANDAR DOBLE (2 CAMAS)',
                'en' => ''
              ),
              'costo'     =>  array(
                'mxn'   =>   '2,983.43',
                'usd'   =>   ''
              ),
              'costor'    =>  array(
                'mxn'   =>   '2,983.43',
                'usd'   =>   ''
              ),
              'propinas'  =>   array(
                'mxn'   =>   '0',
                'usd'   =>   '0'
              ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            ),
            array(
              'tipo'  => array(
                'es' => 'HABITACION TERRAZA SENCILLA (1 CAMA)',
                'en' => ''
              ),
              'costo'     =>  array(
                'mxn'   =>   '2,663.30',
                'usd'   =>   ''
              ),
              'costor'    =>  array(
                'mxn'   =>   '2,663.30',
                'usd'   =>   ''
              ),
              'propinas'  =>   array(
                'mxn'   =>   '0',
                'usd'   =>   '0'
              ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            ),
            array(
              'tipo'  => array(
                'es' => 'HABITACION TERRAZA DOBLE (2 CAMAS)',
                'en' => ''
              ),
              'costo'     =>  array(
                'mxn'   =>   '2,703.30',
                'usd'   =>   ''
              ),
              'costor'    =>  array(
                'mxn'   =>   '2,703.30',
                'usd'   =>   ''
              ),
              'propinas'  =>   array(
                'mxn'   =>   '0',
                'usd'   =>   '0'
              ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            ), 
            array(
              'tipo'  => array(
                'es' => 'HABITACION DE LUJO SENCILLA (1 CAMA)',
                'en' => ''
              ),
              'costo'     =>  array(
                'mxn'   =>   '2,958.00',
                'usd'   =>   ''
              ),
              'costor'    =>  array(
                'mxn'   =>   '2,958.00',
                'usd'   =>   ''
              ),
              'propinas'  =>   array(
                'mxn'   =>   '0',
                'usd'   =>   '0'
              ),
              'pack' => 0,
              'pp'        => 0,
              'hagotada' => false
            ),
            array(
              'tipo'  => array(
                'es' => 'HABITACION DE LUJO DOBLE (2 CAMAS)',
                'en' => ''
              ),
              'costo'     =>  array(
                'mxn'   =>   '2,998.30',
                'usd'   =>   ''
              ),
              'costor'    =>  array(
                'mxn'   =>   '2,998.30',
                'usd'   =>   ''
              ),
              'propinas'  =>   array(
                'mxn'   =>   '0',
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
                                    '<li>Renta de habitación por noche con desayuno, impuestos (16% IVA y 2 % I.H.), propinas a camaristas y bell boys.</li>'.
                                    '</ul>'.
                                    '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                    '<ol>'.
                                    '<li>Habitaciones con 2 camas, sujeto a disponibilidad.</li>'.
                                    '<li>Habitaciones Estándar y Terraza con <strong>Desayuno Buffet en Restaurante Los Vitrales.</strong></li>'.
                                    '<li>Habitaciones en Piso Ejecutivo Hotsson Club de Lujo y Junior Suite:'.
                                    '<ul>'.
                                    '<li>Espacio exclusivo para el registro.</li>'.
                                    '<li>Horario de 06:00 a 23:00 hrs. (Hotsson Club).</li>'.
                                    '<li>Desayuno amercano en horario de 06:00 a 11:00 hrs.</li>'.
                                    '<li>CoffeBreak será de 12:00 a 23:00 hrs.</li>'.
                                    '</ul>'.
                                    '</li>'.
                                    '<li>A partir de las 18:00 hrs. se servirá botana seca, canapés, carnes frías, refrescos, cervezas, vino tinto y blanco.</li>'.
                                    '<li>Tarifas cotizadas en MN.</li>'.
                                    '<li>Check In 15:00 hrs / Check Out 13:00 hrs.</li>'.
                                    '</ol>'.
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
          'claveEvento'   => 'LIICNCP',
          'fechaLleMin'   => '2020-09-11',
          'fechaLleMax'   => '2020-09-15',
          'fechaSalMin'   => '2020-09-12',
          'fechaSalMax'   => '2020-09-16',
          'disabledDates' => false,
          'noches'        => 2,
          'urlIndex'      => $app['url_generator']->generate(LIICNCP.".index"),
          'urlReserva'    => $app['url_generator']->generate(LIICNCP.".setReservacion"),
          'urlConfirma'   => $app['url_generator']->generate(LIICNCP.".confirmacion"),
          'urlApplyPay'   => $app['url_generator']->generate(LIICNCP.".applyPay"),
          'urlChekout'    => $app['url_generator']->generate(LIICNCP.".checkOut"),
          'urlExecute'    => $app['url_generator']->generate(LIICNCP.".execute"),
          'urlPayReturn'  => $app['url_generator']->generate(LIICNCP.".payReturn"),
          'rutaImg'       => 'LIICNCP',
          'links'         => array(
                              'es' => array(
                                        'politicas' => array(
                                                        'url'   => $app['url_generator']->generate(LIICNCP.".politicas"),
                                                        'name'  => 'Políticas de reservación'
                                                        ),
                                        'formato'   => array()
                                      ),
                              'en' => array(
                                        'politicas' => array(
                                                        'url'   => $app['url_generator']->generate(LIICNCP.".politicas"),
                                                        'name'  => 'Reservation Policies'
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
      $LIICNCPRsv = time();
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
      $request->request->set('claveReservacion', $LIICNCPRsv);
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
          $imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/LIICNCP/". $imgHotel;
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
          ''      => 'LIICNCP.politicas.twig.html',
          'es'    => 'LIICNCP.politicas.twig.html',
          'en'    => 'LIICNCP.politicas-en.twig.html',
        );
        return $app['twig']->render("pages/eventos17/LIICNCP/" . $pages[$lang], array(
            'data' => $request->query
        ));
    }
 
    public function _checkOut_(Request $request, Application $app, $lang){
      $response = array();
      $pay      = new ppplus;
      $urls     = array(
                    'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(LIICNCP.".payReturn"),
                    'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(LIICNCP.".payCancel")
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
        'claveEvento' => 'LIICNCP',
        'lang'        => $lang,
        'operador'    => $this->operador,
        'request'     => $request->request,
        'urlIndex'    => $app['url_generator']->generate(LIICNCP.".index")
      ));
  }
}
