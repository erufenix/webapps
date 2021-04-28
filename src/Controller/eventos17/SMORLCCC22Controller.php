<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;

//use Lib\Functions\ppplusLive as ppplus;

define("SMORLCCC22","SMORLCCC22");

class SMORLCCC22Controller implements ControllerProviderInterface
{
    private $evento;
    private $fechas;
    private $sede;
    private $operador;
    private $extOperador;

    public function __construct()
    {
        $this->evento         = "71 CONGRESO DE LA SOCIEDAD MEXICANA DE OTORRINOLARINGOLOGÍA Y CIRUGÍA DE CABEZA Y CUELLO AC.";
        $this->fechas         = array(
                                'es' => 'DEL 30 DE ABRIL AL 05 DE MAYO DE 2022',
                                'en' => ''
                              );
        $this->sede           = array(
                                'es' => 'CENTRO DE CONVENCIONES SAN LUIS POTOSI',
                                'en' => 'CENTRO DE CONVENCIONES SAN LUIS POTOSI'
                              );
        $this->operador      = array(
                                'name'      => 'Mariela Arellano',
                                'sortName'  => 'MA',
                                'mail'      => 'marellano@tycgroup.com',
                                'phone'     => '+52 55 5148 75 00 ext: 11'
                              );
        $this->extOperador  =   array(

                              );
    }


    public function connect(Application $app)
    {
        $index = $app['controllers_factory'];
        $index->get("/{idHotel}/{currency}/{lang}", sprintf('Controller\eventos17\%sController::index', SMORLCCC22))
        ->bind(SMORLCCC22.".index")
        ->assert('currency', '\w+')->value('currency', 'mxn')
        ->assert('lang', '\w+')->value('lang', 'es')
        ->assert('idHotel', '\d+')->value('idHotel', 1);
        $index->post('/setReservacion', sprintf('Controller\eventos17\%sController::setReservacion', SMORLCCC22))->bind(SMORLCCC22.".setReservacion");
        $index->get('/confirmacion/{lang}', sprintf('Controller\eventos17\%sController::confirmacion', SMORLCCC22))->bind(SMORLCCC22.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/politicas/{lang}', sprintf('Controller\eventos17\%sController::politicas', SMORLCCC22))->bind(SMORLCCC22.".politicas")->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/setReservacion', sprintf('Controller\eventos17\%sController::setReservacion', SMORLCCC22))->bind(SMORLCCC22.".setReservacion");
        $index->post('/applyPay/{lang}', sprintf('Controller\eventos17\%sController::applyPay', SMORLCCC22))->bind(SMORLCCC22.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/checkOut/{lang}', sprintf('Controller\eventos17\%sController::checkOut', SMORLCCC22))->bind(SMORLCCC22.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/payReturn/{lang}', sprintf('Controller\eventos17\%sController::payReturn', SMORLCCC22))->bind(SMORLCCC22.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/payCancel/{lang}', sprintf('Controller\eventos17\%sController::payCancel', SMORLCCC22))->bind(SMORLCCC22.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/execute/{lang}', sprintf('Controller\eventos17\%sController::execute', SMORLCCC22))->bind(SMORLCCC22.'.execute')->assert('lang', '\w+')->value('lang', 'es');
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
          'nombre'        => 'HOTEL HILTON TOWERS',
          'img'           => 'hiltontowers.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'    => 'HABITACION SENCILLA ',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '3,768.75',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '3,768.75',
                'usd'   =>   '0'
              ),
              'propinas'  =>   array(
                'mxn'   =>   '50.00',
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
                'mxn'   =>   '3,768.75',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '3,768.75',
                'usd'   =>   '0'
              ),
              'propinas'  =>   array(
                'mxn'   =>   '100.00',
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
                                    '<li>Renta de habitación por noche en Plan Europeo (sin alimentos), impuestos (16% IVA / 3% ISH) y propinas a camaristas.
                                    </li>'.
                                    '</ul>'.
                                    '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                    '<ul>'.
                                    '<li>Se realizará un cargo único por concepto de propinas a bell boys (Sencilla $50.00 / Doble $100.00)
                                    </li>'.
                                    '<li>El check in es a las 12:00 h, y el check out a las 15:00 h.
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
              'nombre'        => 'HOTEL HILTON',
              'img'           => 'hilton.jpg',
              'agotado'       => false,
              'habitaciones'  => array(
                array(
                  'tipo'  => array(
                    'es'    => 'HABITACION SENCILLA ',
                    'en'    => '',
                  ),
                  'costo' => array(
                    'mxn'   =>   '3,173.75',
                    'usd'   =>   ''
                  ),
                  'costor'    => array(
                    'mxn'   =>   '3,173.75',
                    'usd'   =>   '0'
                  ),
                  'propinas'  =>   array(
                    'mxn'   =>   '50.00',
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
                    'mxn'   =>   '3,173.75',
                    'usd'   =>   ''
                  ),
                  'costor'    => array(
                    'mxn'   =>   '3,173.75',
                    'usd'   =>   '0'
                  ),
                  'propinas'  =>   array(
                    'mxn'   =>   '100.00',
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
                                        '<li>Renta de habitación por noche en Plan Europeo (sin alimentos), impuestos (16% IVA / 3% ISH) y propinas a camaristas.
                                        </li>'.
                                        '</ul>'.
                                        '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                        '<ul>'.
                                        '<li>Se realizará un cargo único por concepto de propinas a bell boys (Sencilla $50.00 / Doble $100.00)
                                        </li>'.
                                        '<li>El check in es a las 12:00 h, y el check out a las 15:00 h.
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
          'logo' 					=> array(
            'desktop_logo' => 'smorl22_150.png',
            'mobile_logo'  => 'smorl22_120.png'
          ),
          'css_logo'    	=> 'logoSmorl22',
          'fechas'        => $this->fechas,
          'sede'          => $this->sede,
          'claveEvento'   => 'SMORLCCC22',
          'fechaLleMin'   => '2020-10-13',
          'fechaLleMax'   => '2020-10-16',
          'fechaSalMin'   => '2020-10-14',
          'fechaSalMax'   => '2020-10-17',
          'disabledDates' => false,
          'noches'        => 2,
          'urlIndex'      => $app['url_generator']->generate(SMORLCCC22.".index"),
          'urlReserva'    => $app['url_generator']->generate(SMORLCCC22.".setReservacion"),
          'urlConfirma'   => $app['url_generator']->generate(SMORLCCC22.".confirmacion"),
          'urlApplyPay'   => $app['url_generator']->generate(SMORLCCC22.".applyPay"),
          'urlChekout'    => $app['url_generator']->generate(SMORLCCC22.".checkOut"),
          'urlExecute'    => $app['url_generator']->generate(SMORLCCC22.".execute"),
          'urlPayReturn'  => $app['url_generator']->generate(SMORLCCC22.".payReturn"),
          'rutaImg'       => 'SMORLCCC22',
          'links'         => array(
                              'es' => array(
                                        'politicas' => array(
                                                        'url'   => $app['url_generator']->generate(SMORLCCC22.".politicas"),
                                                        'name'  => 'Políticas de reservación'
                                                        ),
                                        'formato'   => array()
                                      ),
                              'en' => array(
                                        'politicas' => array(
                                                        /*'url'   => $app['url_generator']->generate(SMORLCCC22.".politicas"),
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
                                'name'      => 'Mariela Arellano',
                                'sortName'  => 'MA',
                                'mail'      => 'marellano@tycgroup.com',
                                'phone'     => '+52 55 5148 75 00 ext: 11'
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
      $SMORLCCC22Rsv = time();
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
      $request->request->set('claveReservacion', $SMORLCCC22Rsv);
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
                    "marellano@tycgroup.com" => "Mariela Arellano"
                  ))
                ->setFrom('no--reply@sin-tcevents.mx', 'Reservacion')
                ->setSubject($this->evento);
          } else {
              $mail
                ->setTo("erubi@tycgroup.com", "Edgar Rubi")
                ->setBcc(array(
                    "erubi@tycgroup.com" => "Luis Cazares",
                    "marellano@tycgroup.com" => "Mariela Arellano"
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
          ''      => 'SMORLCCC22.politicas.twig.html',
          'es'    => 'SMORLCCC22.politicas.twig.html',
          'en'    => 'SMORLCCC22.politicas-en.twig.html',
        );
        return $app['twig']->render("pages/eventos17/SMORLCCC22/" . $pages[$lang], array(
            'data' => $request->query
        ));
    }

    public function _checkOut_(Request $request, Application $app, $lang){
      $response = array();
      $pay      = new ppplus;
      $urls     = array(
                    'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(SMORLCCC22.".payReturn"),
                    'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(SMORLCCC22.".payCancel")
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
        'claveEvento' => 'SMORLCCC22',
        'lang'        => $lang,
        'operador'    => $this->operador,
        'request'     => $request->request,
        'urlIndex'    => $app['url_generator']->generate(SMORLCCC22.".index")
      ));
  }
}
