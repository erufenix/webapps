<?php

namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;

//use Lib\Functions\ppplusLive as ppplus;

define("SICC","SICC");

class SICCController implements ControllerProviderInterface
{
    private $evento;
    private $fechas;
    private $sede;
    private $operador;
    private $extOperador;

    public function __construct()
    {
        $this->evento         = "1ER SEMINARIO INTERNACIONAL DE CONSERVACION DE CARRETERAS";
        $this->fechas         = array(
                                'es' => '29 Y 30 DE OCTUBRE DEL 2020',
                                'en' => ''
                              );
        $this->sede           = array(
                                'es' => 'Cancún',
                                'en' => 'Cancún'
                              );
        $this->operador      = array(
                                'name'      => 'Carlos Aguirre',
                                'sortName'  => 'CA',
                                'mail'      => 'caguirre@tycgroup.com',
                                'phone'     => '+52 55 5148 75 00 ext: 69',
                                'cell'      => '55 4860 6845'

                              );
        $this->extOperador  =   array(
                                array(
                                  'name'      => 'Mariela Arellano',
                                  'sortName'  => 'MA',
                                  'mail'      => 'marellano@tycgroup.com',
                                  'phone'     => '+52 55 5148 75 00 ext: 11',
                                  'cell'      => '55 4540 8447'
                                )
                              );
    }


    public function connect(Application $app)
    {
        $index = $app['controllers_factory'];
        $index->get("/{idHotel}/{currency}/{lang}", sprintf('Controller\eventos17\%sController::index', SICC))
        ->bind(SICC.".index")
        ->assert('currency', '\w+')->value('currency', 'mxn')
        ->assert('lang', '\w+')->value('lang', 'es')
        ->assert('idHotel', '\d+')->value('idHotel', 1);
        $index->post('/setReservacion', sprintf('Controller\eventos17\%sController::setReservacion', SICC))->bind(SICC.".setReservacion");
        $index->get('/confirmacion/{lang}', sprintf('Controller\eventos17\%sController::confirmacion', SICC))->bind(SICC.".confirmacion")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/politicas/{lang}', sprintf('Controller\eventos17\%sController::politicas', SICC))->bind(SICC.".politicas")->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/setReservacion', sprintf('Controller\eventos17\%sController::setReservacion', SICC))->bind(SICC.".setReservacion");
        $index->post('/applyPay/{lang}', sprintf('Controller\eventos17\%sController::applyPay', SICC))->bind(SICC.".applyPay")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/checkOut/{lang}', sprintf('Controller\eventos17\%sController::checkOut', SICC))->bind(SICC.".checkOut")->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/payReturn/{lang}', sprintf('Controller\eventos17\%sController::payReturn', SICC))->bind(SICC.'.payReturn')->assert('lang', '\w+')->value('lang', 'es');
        $index->post('/payCancel/{lang}', sprintf('Controller\eventos17\%sController::payCancel', SICC))->bind(SICC.".payCancel")->assert('lang', '\w+')->value('lang', 'es');
        $index->get('/execute/{lang}', sprintf('Controller\eventos17\%sController::execute', SICC))->bind(SICC.'.execute')->assert('lang', '\w+')->value('lang', 'es');
        return $index;
    }

    public function index(Request $request, Application $app, $idHotel, $currency, $lang)
    {
      $pages = array(
                ''      => 'SICC/es.index.twig.html',
                'es'    => 'SICC/es.index.twig.html',
                'en'    => 'SICC/en.index.twig.html'
      );
      $fn       = new Functions;
      $paises   = array_column($fn->getCountryListArray($lang)['content']['geonames'], 'countryName', 'geonameId');
      $vmode    = 'live';
      $qry      = $request->query->all();

      $hoteles[1] =
        array(
          'index'         => '1',
          'nombre'        => 'IBEROSTAR CANCUN',
          'img'           => 'ibero.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'    => 'HABITACION DE LUJO SENCILLA (Una Persona)',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '5,103.00',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '5,103.00',
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
                'es'    => 'HABITACION DE LUJO DOBLE (Dos Personas)',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '6,004.00',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '6,004.00',
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
          'all' => true,
          'mensajes'          => array(
                                  'es' =>
                                    '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                    '<ul>'.
                                    '<li>El servicio de TODO-INCLUIDO, es decir la tarifa da derecho a la habitación, los alimentos y bebidas que se ofrecen en el HOTEL.
                                    </li>'.
                                    '</ul>'.
                                    '<h3 class="c-theme-font c-font-uppercase">Notas Importantes:</h3>'.
                                    '<ul>'.
                                    '<li>Tarifa Por noche Incluye todos los impuestos, vigentes aplicables y propinas.
                                    </li>'.
                                    '<li>Derecho a dos menores de 13 años comprartiendo la habitacion con 2 adultos (de conformidad a las politicas vigentes en el hotel al momento de realizar el check in
                                    </li>'.
                                    '<li>Check In es a las 15:00 horas y Check Out a las 12:00 horas
                                    </li>'.
                                    '<li>Tarifas cotizadas en MN.
                                    </li>'.
                                    '<li>EL HOTEL manifiesta a EL CLIENTE que por Disposición Oficial existe un Derecho de Saneamiento Ambiental, por el importe de $26.06 MN al momento de realizar el check in el cual se calcula por habitación, por noche de conformidad a las disposiciones legales vigentes.
                                    </li>'.
                                    '<li>'.
                                    'Los menores tienen un costo por noche de $ 1,425.00 M.N aplicable de la siguiente forma:'.
                                    '<ul>'.
                                    '<li>'.
                                    '0-2 años menores gratis'.
                                    '</li>'.
                                    '<li>'.
                                    '3 a 12 aplica tarifa de menor siempre que comparta la misma habitación con 2 adultos.'.
                                    '</li'.
                                    '</ul>'.
                                    '</li>'.
                                    '</ul>'.
                                    '',
                                'en' => ''.
                                        '',
                  )
            );


      $hoteles[2] =
        array(
          'index'         => '2',
          'nombre'        => 'PARADISUS CANCÚN',
          'img'           => 'Paradisus-Cancun.jpg',
          'agotado'       => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'    => 'HABITACION DE LUJO SENCILLA',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '4,807.88',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '4,807.88',
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
                'es'    => 'HABITACION DE LUJO DOBLE',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '5,627.88',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '5,627.88',
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
          'all' => true,
          'mensajes'          => array(
                                  'es' =>
                                    '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                    '<ul>'.
                                    '<li>Habitación de Lujo con Terreza
                                    </li>'.
                                    '<li>Propinas a bell boys y camaristas
                                    </li>'.
                                    '<li>Desyauno,comida y cena tipo buffet
                                    </li>'.
                                    '<li>Cena en restaurantes de especialidades (previa resevración)
                                    </li>'.
                                    '<li>Servicio de barra libre premium, en centros de consumo
                                    </li>'.
                                    '<li>Servicio a cuarto (menú preestablecido) existe un cargo por servicio por orden
                                    </li>'.
                                    '<li>Mini bar (4 refrescos, 2 botella de agua y botana)
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
          'nombre'        => 'FIESTA AMERICANA CONDESA CANCÚN',
          'img'           => 'fiesta_americana_condesa.jpg',
          'agotado'       => false,
          'hidden'        => false,
          'habitaciones'  => array(
            array(
              'tipo'  => array(
                'es'    => 'HABITACION SENCILLA',
                'en'    => '',
              ),
              'costo' => array(
                'mxn'   =>   '3,727.88',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '3,727.88',
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
                'mxn'   =>   '5,027.88',
                'usd'   =>   ''
              ),
              'costor'    => array(
                'mxn'   =>   '5,027.88',
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
          'all' => true,
          'mensajes'          => array(
                                  'es' =>
                                    '<h3 class="c-theme-font c-font-uppercase">La tarifa incluye:</h3>'.
                                    '<ul>'.
                                    '<li>Hospedaje en Habitación de Lujo.
                                    </li>'.
                                    '<li>Desayuno, comida y cena en los restaurantes del hotel de acuerdo a los horarios de operación. No se permiten reservaciones grupales en los restaurantes del hotel.
                                    </li>'.
                                    '<li>Barra Libre de reconocidas marcas de prestigio internacional en los restaurantes y bares del hotel de acuerdo a los horarios de operación.
                                    </li>'.
                                    '<li>Variedad de refrigerios en el área de alberca de acuerdo al menú de Pool Concierge, refrigerios en la alberca (durante horarios de operación).
                                    </li>'.
                                    '<li>Mini Bar incluyendo refrescos, cerveza nacional y agua embotellada. Resurtido diariamente.
                                    </li>'.
                                    '<li>Servicio a cuartos 24 horas.
                                    </li>'.
                                    '<li>Conexión al servicio de internet del hotel en habitación y áreas abiertas. No es una conexión dedicada para el grupo.
                                    </li>'.
                                    '<li>Acceso al gimnasio.
                                    </li>'.
                                    '<li>Fiesta kids club.
                                    </li>'.
                                    '<li>Fiesta teens club.
                                    </li>'.
                                    '<li>Centro de Entretenimiento y actividades recreativas para la familia.
                                    </li>'.
                                    '<li>Llamadas telefónicas locales (no aplica a teléfonos celulares).
                                    </li>'.
                                    '<li>Cargos por servicio e Impuestos Incluidos.
                                    </li>'.
                                    '<li>Servicio de Concierge y Recepción las 24 hrs
                                    </li>'.
                                    '<li>Seguridad las 24 hrs
                                    </li>'.
                                    '<li>Todos los impuestos y propinas.
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
          'claveEvento'   => 'SICC',
          'fechaLleMin'   => '2020-10-28',
          'fechaLleMax'   => '2020-10-29',
          'fechaSalMin'   => '2020-10-29',
          'fechaSalMax'   => '2020-10-31',
          'disabledDates' => false,
          'noches'        => 2,
          'urlIndex'      => $app['url_generator']->generate(SICC.".index"),
          'urlReserva'    => $app['url_generator']->generate(SICC.".setReservacion"),
          'urlConfirma'   => $app['url_generator']->generate(SICC.".confirmacion"),
          'urlApplyPay'   => $app['url_generator']->generate(SICC.".applyPay"),
          'urlChekout'    => $app['url_generator']->generate(SICC.".checkOut"),
          'urlExecute'    => $app['url_generator']->generate(SICC.".execute"),
          'urlPayReturn'  => $app['url_generator']->generate(SICC.".payReturn"),
          'rutaImg'       => 'sicc',
          'links'         => array(
                              'es' => array(
                                        'politicas' => array(
                                                        'url'   => $app['url_generator']->generate(SICC.".politicas"),
                                                        'name'  => 'Políticas de reservación'
                                                        ),
                                        'formato'   => array()
                                      ),
                              'en' => array(
                                        'politicas' => array(
                                                        /*'url'   => $app['url_generator']->generate(SICC.".politicas"),
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
                                'es' => '<i class="fa fa-info-circle"></i> En caso de requerir reservaciones con fecha del 26 ,27 de octubre o posteriores  31 de octubre, 1 de noviembre favor de contactar a nuestros ejecutivos <strong>marellano@tycgroup.com</strong> que se encuentra al final de la reservación'
                               ),
          '_msg_'           => array(),
          'first'           => 1,
          'allGbl'          => true,
          'blkAco'          => true,
          'notaHotel'       => '<blockquote class="c-border-red c-bg-red-3 c-bg-red-3-font"><p><i class="fa fa-info-circle"></i> TODO INCLUIDO : Hospedaje , Alimentos y Bebidas</p></blockquote>',
          'customSelect'    => 'size="4"'
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
      $SICCRsv = time();
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
      $request->request->set('claveReservacion', $SICCRsv);
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
                    //"marellano@tycgroup.com" => "Mariela Arellano",
                    //"caguirre@tycgroup.com" => "Carlos Aguirre"
                  ))
                ->setFrom('no--reply@sin-tcevents.mx', 'Reservacion')
                ->setSubject($this->evento);
          } else {
              $mail
                ->setTo("erubi@tycgroup.com", "Edgar Rubi")
                ->setBcc(array(
                    //"lcazares@tcevents.com" => "Luis Cazares",
                   //"marellano@tycgroup.com" => "Mariela Arellano",
                    //"caguirre@tycgroup.com" => "Carlos Aguirre"
                  ))
                ->setFrom('no--reply@sin-tcevents.mx', 'Reservacion')
                ->setSubject("Inicio de proceso Reservacion " . $this->evento);
          }
          $imgHotel = explode("/", $request->request->get('imgHotel'));
          $imgHotel = end($imgHotel);
          $imgHotel = "https://webapps.tycgroup.com/assets/img/hotel/SICC/". $imgHotel;
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
          ''      => 'SICC.politicas.twig.html',
          'es'    => 'SICC.politicas.twig.html',
          'en'    => 'SICC.politicas-en.twig.html',
        );
        return $app['twig']->render("pages/eventos17/SICC/" . $pages[$lang], array(
            'data' => $request->query
        ));
    }

    public function _checkOut_(Request $request, Application $app, $lang){
      $response = array();
      $pay      = new ppplus;
      $urls     = array(
                    'return' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(SICC.".payReturn"),
                    'cancel' => (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $app['url_generator']->generate(SICC.".payCancel")
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
        'claveEvento' => 'SICC',
        'lang'        => $lang,
        'operador'    => $this->operador,
        'request'     => $request->request,
        'urlIndex'    => $app['url_generator']->generate(SICC.".index")
      ));
  }
}
