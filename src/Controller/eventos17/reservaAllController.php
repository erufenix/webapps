<?php
namespace Controller\eventos17;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;
use Lib\Functions\Pays;
use Lib\Functions\payTwo;
use Lib\Functions\Payus;

use OpenPayU\Configuration;

class mansionxController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/{idHotel}/{currency}/{lang}','Controller\eventos17\mansionxController::index')
		->bind('mansionx.index')
		->assert('currency', '\w+')->value('currency', 'mxn')
		->assert('lang', '\w+')->value('lang', 'es')
		->assert('idHotel', '\d+')->value('idHotel', 1);
		$index->post('/setReservacion','Controller\eventos17\mansionxController::setReservacion')->bind('mansionx.setReservacion');
		$index->get('/confirmacion/{lang}','Controller\eventos17\mansionxController::confirmacion')->bind('mansionx.confirmacion')->assert('lang', '\w+')->value('lang', 'es');
		$index->get('/politicas/{lang}','Controller\eventos17\mansionxController::politicas')->bind('mansionx.politicas')->assert('lang', '\w+')->value('lang', 'es');
		$index->post('/sendDep','Controller\eventos17\mansionxController::sendDep')->bind('mansionx.sendDep');
		$index->post('/sendPay','Controller\eventos17\mansionxController::sendPay')->bind('mansionx.sendPay');
		$index->post('/applyPay','Controller\eventos17\mansionxController::applyPay')->bind('mansionx.applyPay');
		$index->post('/paySuccess','Controller\eventos17\mansionxController::paySuccess')->bind('mansionx.paySuccess');
		$index->post('/payFail','Controller\eventos17\mansionxController::payFail')->bind('mansionx.payFail');
		$index->post('/payuCard','Controller\eventos17\mansionxController::payuCard')->bind('mansionx.payuCard');
		return $index;
	}

	public function index(Request $request, Application $app,$idHotel,$currency,$lang) {
		$pages = array(
				'' 		=> 'mansionx/mansionx.index.twig.html',
				'es' 	=> 'mansionx/mansionx.index.twig.html',
				'en' 	=> 'mansionx/mansionx.index.en.twig.html'
		);
		$hoteles = array(
			array(
				'index' 				=> '1',
				'nombre' 				=> 'Masion X',
				'img' 					=> 'X-Mansion.png',
				'agotado' 			=> false,
				'habitaciones' 	=> array(
					array(
						'tipo' 	=> array(
							'es'	=> 'Habitación residentes',
							'en'	=> '',
						),
						'costo' 	=> array(
								'mxn'	=>	'1.05',
								'usd'	=>	''
						),
						'costor' 	=> array(
								'mxn'	=>	'1.05',
								'usd'	=>	''
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
							'es' => 'Habitación maestros',
							'en' => ''
						),
						'costo' 	=>  array(
							'mxn'	=>	'1.10',
							'usd'	=>	''
							),
						'costor' 	=>  array(
							'mxn'	=>	'1.10',
							'usd'	=>	''
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
				'mensajes'			=> array(
						'es' => '<h3 class=\"c-theme-font c-font-uppercase\">La tarifa incluye:</h3>\n'.
										'<ul>\n'.
										'<li>Internet inalámbrico incluido</li>\n'.
										'<li>Acceso en cortesía al Gimnasio,</li>\n'.
										'<li>Check inn 15:00 hrs. Check out 12:00 hrs.</li>'.
										'</ul>\n',
						'en' => ''
					)		
			)
		);

		return $app['twig']->render('pages/eventos17/'.$pages[$lang], array(
			'title' 			=> '',
			'evento' 			=> 'X Men: Dark Phoenix',
			'hoteles' 		=> $hoteles,
			'hotelesJson' => json_encode($hoteles),
			'currency' 		=> $currency,
			'idHotel' 		=> $idHotel,
			'lang' 				=> $lang,
			'logo' 				=> array(
												'' => ''
											),
			'fechas'  		=> '02 al 04 de Noviembre 2018',
			'sede'        => 'Graymalkin Lane, Salem Center',
			'claveEvento' => 'EXPOmansionx',
			'operador'  	=> array(
										'name'	=> 'Edgar R. U.',
										'mail' 	=> 'erubi@tcevents.com',
										'phone'	=> '+52 55 5148 75 00 ext: 39' 
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
		$pack  			= (empty(str_replace(',','',$dh[3]))) ? 0*1 : str_replace(',','',$dh[3])*1;
		$pp 				= $dh[4];
		$costoNochr = str_replace(',','',$dh[5]);
		$cveRsv 		= time();
		$diasPago   = 0;
		$fpago 			= $request->request->get('pago');
		$data = array();
		$pages = array(
				'' 		=> 'mail-mansionx-deposito-es.twig.html',
				'es' 	=> 'mail-mansionx-deposito-es.twig.html',
				'en' 	=> 'mail-mansionx-deposito-en.twig.html'
		);		
		if($pack != 0){
			$costoNochr = $costoNochr / $pack;
			$diasPago   = $pack;			
		}
		elseif($request->request->get('pagoPor') == 'N'){
			$diasPago = 2;
		}
		else{
			$dl 			= $fllegada;
			$ds 			= $fsalida;
			$di 			= $fllegada->diff($fsalida);
			$diasPago = $di->format('%a');
		}
		$cargo 			= ($costoNochr * $diasPago) + $bellBoy;
		$request->request->set('claveReservacion',$cveRsv);
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
			$mail 	= \Swift_Message::newInstance();
			$nombre = $request->request->get('nombre') . " " . $request->request->get('apaterno') ." " . $request->request->get('amaterno');
			if($fpago == 'DB'){
				$mail
					->setTo($request->request->get('correo'),$nombre)
					->setBcc(array(
							"erubi@tcevents.com" => "Edgar Rubi",
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Reservacion X Men: Dark Phoenix');
			}
			else{
				$mail
					->setTo("erubi@tcevents.com","Edgar Rubi")
					->setBcc(array(
							//"lcazares@tcevents.com" => "Luis Cazares"
					))
					->setFrom('no--reply@sin-tcevents.mx','Reservacion')
					->setSubject('Inicio de proceso Reservacion X Men: Dark Phoenix');				
			}
			$body = $app['twig']->render('pages/eventos17/mansionx/'.$pages[$request->request->get('lang') ], array(
				"data"		=> $rsv,
				"idHotel" => $request->request->get('idHotel'),
				"pais" 		=> $fn->getGeo($request->request->get('pais'),'name'),
				"paisRs" 	=> empty($request->request->get('paisFactura')) ? '' : $fn->getGeo($request->request->get('paisFactura'),'name')				
				)
			);
			$mail->setBody($body, "text/html");
			//$env = $app['mailer']->send($mail);
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
				'' 		=> 'mansionx.confirmacion.twig.html',
				'es' 	=> 'mansionx.confirmacion.twig.html',
				'en' 	=> 'mansionx.confirmacion-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/mansionx/" . $pages[$lang], array(
			'data' => $request->query
		));
	}

	public function politicas(Request $request, Application $app,$lang){
		$pages = array(
				'' 		=> 'mansionx.politicas.twig.html',
				'es' 	=> 'mansionx.politicas.twig.html',
				'en' 	=> 'mansionx.politicas-en.twig.html',
		);		
		return $app['twig']->render("pages/eventos17/mansionx/" . $pages[$lang], array(
			'data' => $request->query
		));
	}	

	/*public function sendPay(Request $request, Application $app,$lang){
		//$expressCheckout = $app->createExpressCheckout();
		$expressCheckout = $app['paypal']->createExpressCheckout();
		$app['paypal']->setCurrency = strtoupper($request->request->get('pay_currency'));
		$urlSuccess = (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST').$app['url_generator']->generate('mansionx.paySuccess');
		$urlFail = (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST').$app['url_generator']->generate('mansionx.payFail');		
		$expressCheckout
		        ->addItem($request->request->get('pay_item'), 1, '', $request->request->get('pay_costo'),strtoupper($request->request->get('pay_currency')))
		        ->setTax(0.00)
		        ->setShipping(0.00)
		        ->setDescription($request->request->get('pay_item_des'))
		        ->setInvoiceNumber($app['paypal']->generateInvoiceNumber())
		        ->setSuccessUrl($urlSuccess)
		        ->setFailureUrl($urlFail);

		$type 	= str_replace("_","",$request->request->get('pay_type'));
		$type 	= strtolower($type);
		$exDate = explode("/", $request->request->get('pay_expired')); 

		//$creditCardPayment = $app->createCreditCreditCardPayment();
		$creditCardPayment = $app['paypal']->createCreditCardPayment();
		    $creditCardPayment
		        ->setType($type)
		        ->setNumber($request->request->get('pay_card'))
		        ->setExpireMonth($exDate[0])
		        ->setExpireYear($exDate[1])
		        ->setCvv2($request->request->get('pay_cvv'))
		        ->setFirstName($request->request->get('pay_nombre'))
		        ->setLastName($request->request->get('pay_apellidos'))
		        ->setBillingAddress(
		            $request->request->get('pay_dir1'),
		            '',
		            $request->request->get('pay_ciudad'),
		            $request->request->get('pay_estado'),
		            $request->request->get('pay_cp'),
		            'MX')
		        ->addItem($request->request->get('pay_item'), 1, '', $request->request->get('pay_costo'),strtoupper($request->request->get('pay_currency')))
		        ->setTax(0.00)
		        ->setShipping(0.00)
		        ->setDescription($request->request->get('pay_item_des'))
		        ->setInvoiceNumber($app['paypal']->generateInvoiceNumber());     
		$approvalUrl = $expressCheckout->getApprovalUrl($app['paypal']->getPayPalApiContext());
		//$approvalUrl = $creditCardPayment->getApprovalUrl($app['paypal']->getPayPalApiContext());        
		return true;
	}*/

	public function sendPay(Request $request, Application $app,$lang){
		/*$pay 	= new Pays(
							array(
								'currency' => 'MXN',
        				'mode'=> 'sandbox',
        				'clientID'=>'AWFDvDFuJ2clc1VFZBevgdsLI7x0vxDhsIUQy2jyo45c1hf-GTkHLeEW-1A5_Zds0G2P__dhk5FuNq33',
        				'secret'=>'EPrSgFfb3rmyy-HxnOzAEscy6LCuXq7-m-eYo1EVkyIIkbqUDmZvqydOUI2tIlPcmneiXsUZYEJAqeD1',
        				'connectionTimeOut'=>30,
        				'logEnabled'=>false
							));*/
		//$pay 	= new Pays;
		//$expressCheckout = $pay->createExpressCheckout($request,$app);
		return true;
	}

	public function applyPay(Request $request, Application $app,$lang){
		$checkOut = null;
		$result 	= array();
		$pay =  new payTwo
								(
									array(
										'currency' => 'USD',
        						'mode'=> 'sandbox',
        						'clientID'=>'AU8jcV85QoMTfAe4dCFwZKZy1U9fjnMlI4kQVuwO9bq27EeY8UULHD4alfdYEtUul_LIhXfDNFXlMBTw',
        						'secret'=>'ECsaDwgYQsLXjjqaVXC9ExbQaa68XkWNWvOdYSUfS9uxQDpsqO4AlbsbTXHbPS9plApU5svb1eg3gsoS',
        						'connectionTimeOut'=>40,
        						'logEnabled'=>false
							)
						);
		//$checkOut = $pay->checkOut($request,$app);
		//var_dump($checkOut->getApprovalLink());
		$credidCard = $pay->credidCard($request,$app);
		if($credidCard){
			$result = $app["serializer"]->toArray($credidCard);
		}
		return $result;
	}



	public function paySuccess(Request $request, Application $app){
		return true;
	}

	public function payFail(Request $request, Application $app){
		return true;
	}

	public function payuCard(Request $request, Application $app){
		require_once realpath(dirname(__FILE__)) . '/../../../vendor/openpayu/openpayu/lib/openpayu.php';
		OpenPayU_Configuration::setEnvironment('sandbox');
		//echo realpath(dirname(__FILE__));
		/*$payu = new Payus(
							array(
								'currency' 		=> 'MXN',
								'test' 				=> 'true',
								'apiKey' 			=> 'uqsheJZyI23rbxzBImUV78T4Mh',
								'apiLogin' 		=> 'WXHR1082JOgT2OZ',
								'merchantId'	=> '688783',
								'language' 		=> 'ES'
							)
		);*/
		return true;
	}

}
?>