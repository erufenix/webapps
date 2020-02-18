<?php
namespace Lib\Functions;

use Silex\Application;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Invoice;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ItemList;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Address;
use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;


class payTwo{
  private $currency;
  private $apiContext;

  /*public $payer;
  public $payment;
  public $item;
  public $temList;
  public $details;
  public $amount;
  public $transaction;
  public $redirectUrls;
  public $approvalUrl;*/
      
  const LOG_LEVEL = 'INFO';
  const LOG_FILE_NAME = 'paypal.log';

	function __construct($settings=array()){
	  $this->currency = (array_key_exists('currency', $settings) ? $settings['currency'] : 'MXN');
	  $mode = (array_key_exists('mode', $settings) ? $settings['mode'] : 'sandbox');
	  $clientID = (array_key_exists('clientID', $settings) ? $settings['clientID'] : null);
	  $secret = (array_key_exists('secret', $settings) ? $settings['secret'] : null);
	  $connectionTimeOut = (array_key_exists('connectionTimeOut', $settings) ? $settings['connectionTimeOut'] : 30);
	  $logEnabled = (array_key_exists('logEnabled', $settings) ? $settings['logEnabled'] : true);
	  $logDir = (array_key_exists('logDir', $settings) ? $settings['logDir'] : __DIR__ . '/../../../logs/');

    $this->apiContext = new ApiContext(new OAuthTokenCredential(
    		$clientID,
        $secret
    ));

	  $this->apiContext->setConfig(array(
	      'mode' => $mode,
	      'http.ConnectionTimeOut' => $connectionTimeOut,
	      'log.LogEnabled' => $logEnabled,
	      'log.FileName' => $logDir . self::LOG_FILE_NAME,
	      'log.LogLevel' => self::LOG_LEVEL,
          'cache.enabled' => true
	  ));
	}

  public function getApiContext(){
    return $this->apiContext;
  }

  /*public function checkOut($request,$app){
    $this->payer = new Payer();
    $this->itemList = new ItemList();
    $this->item = new Item();
    $this->details = new Details();
    $this->amount = new Amount();
    $this->transaction = new Transaction();
    $this->redirectUrls = new RedirectUrls();
    $this->payment = new Payment();

    $this->payer->setPaymentMethod("paypal");
    
    $this->item->setName($request->request->get('pay_item'))
        ->setCurrency($this->currency)
        ->setQuantity(1)
        ->setSku($request->request->get('pay_sku'))
        ->setPrice($request->request->get('pay_costo'));
      

    $this->itemList->setItems([$this->item]);
    
    $this->details->setShipping(0)
        ->setTax(0)
        ->setSubtotal($request->request->get('pay_costo'));
      
    
    $this->amount->setCurrency($this->currency)
        ->setTotal($request->request->get('pay_costo'))
        ->setDetails($this->details);
      
    
    $this->transaction->setAmount($this->amount)
        ->setItemList($this->itemList)
        ->setDescription($request->request->get('pay_item_des'))
        ->setInvoiceNumber($request->request->get('pay_sku'));
      
    
    $urlSuccess = (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST').$app['url_generator']->generate('mansionx.paySuccess');
    $urlFail = (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST').$app['url_generator']->generate('mansionx.payFail'); 
    var_dump($urlSuccess,$urlFail);
    $this->redirectUrls
          ->setReturnUrl($urlSuccess)
          ->setCancelUrl($urlFail);
      
    
    $this->payment->setIntent("sale")
        ->setPayer($this->payer)
        ->setRedirectUrls($this->redirectUrls)
        ->setTransactions(array($this->transaction));
      
      
    $rqst = clone $this->payment;
    try {
        $this->payment->create($this->apiContext);
    }catch (Exception $ex) {
      // print "<pre>";
      //print_r($ex);
      //print "</pre>";
      exit(1);
    }
    return $this->payment;
  }*/

  /*public function checkOut($request,$app){
    $this->payer = new Payer();
    $this->itemList = new ItemList();
    $this->item = new Item();
    $this->details = new Details();
    $this->amount = new Amount();
    $this->transaction = new Transaction();
    $this->redirectUrls = new RedirectUrls();
    $this->payment = new Payment();

    $this->payer->setPaymentMethod("paypal");
    
    $this->item->setName($request->request->get('pay_item'))
        ->setCurrency($this->currency)
        ->setQuantity(1)
        ->setSku($request->request->get('pay_sku'))
        ->setPrice($request->request->get('pay_costo'));
      

    $this->itemList->setItems([$this->item]);
    
    $this->details->setShipping(0)
        ->setTax(0)
        ->setSubtotal($request->request->get('pay_costo'));
      
    
    $this->amount->setCurrency($this->currency)
        ->setTotal($request->request->get('pay_costo'))
        ->setDetails($this->details);
      
    
    $this->transaction->setAmount($this->amount)
        ->setItemList($this->itemList)
        ->setDescription($request->request->get('pay_item_des'))
        ->setInvoiceNumber($request->request->get('pay_sku'));
      
    
    $urlSuccess = (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST').$app['url_generator']->generate('mansionx.paySuccess');
    $urlFail = (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST').$app['url_generator']->generate('mansionx.payFail'); 
    var_dump($urlSuccess,$urlFail);
    $this->redirectUrls
          ->setReturnUrl($urlSuccess)
          ->setCancelUrl($urlFail);
      
    
    $this->payment->setIntent("sale")
        ->setPayer($this->payer)
        ->setRedirectUrls($this->redirectUrls)
        ->setTransactions(array($this->transaction));
      
      
    $rqst = clone $this->payment;
    try {
        $this->payment->create($this->apiContext);
    }catch (Exception $ex) {
      // print "<pre>";
      //print_r($ex);
      //print "</pre>";
      exit(1);
    }
    return $this->payment;
  }*/

  public function checkOut($request,$app){
    $payer = new Payer();
    $itemList = new ItemList();
    $item = new Item();
    $details = new Details();
    $amount = new Amount();
    $transaction = new Transaction();
    $redirectUrls = new RedirectUrls();
    $payment = new Payment();

    $payer->setPaymentMethod("paypal");
    
    $item->setName($request->request->get('pay_item'))
        ->setCurrency($this->currency)
        ->setQuantity(1)
        ->setSku($request->request->get('pay_sku'))
        ->setPrice($request->request->get('pay_costo'));
      

    $itemList->setItems([$item]);
    
    $details->setShipping(0)
        ->setTax(0)
        ->setSubtotal($request->request->get('pay_costo'));
      
    
    $amount->setCurrency($this->currency)
        ->setTotal($request->request->get('pay_costo'))
        ->setDetails($details);
      
    
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription($request->request->get('pay_item_des'))
        ->setInvoiceNumber($request->request->get('pay_sku'));
      
    
    $urlSuccess = (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST').$app['url_generator']->generate('mansionx.paySuccess');
    $urlFail = (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST').$app['url_generator']->generate('mansionx.payFail'); 
    $redirectUrls
          ->setReturnUrl($urlSuccess)
          ->setCancelUrl($urlFail);
      
    
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));

    try {
        $payment->create($this->apiContext);
    }catch (Exception $ex) {
      // print "<pre>";
      //print_r($ex);
      //print "</pre>";
      exit(1);
    }
    return $payment;
  }   

  public function credidCard($request,$app){
    $card         = new CreditCard();
    $fi           = new FundingInstrument();
    $payer        = new Payer();
    $item         = new Item();
    $itemList     = new ItemList();
    $details      = new Details();
    $amount       = new Amount();
    $transaction  = new Transaction();
    $payment      = new Payment();
    $costo        = $request->request->get('pay_costo');
    $tax          = 0;
    $shipping     = 0;
    switch ($this->currency) {
        case 'USD':
            $costo    = floatval($costo);
            $tax      = floatval($tax);
            $shipping = floatval($shipping);
        break;
        case 'EUR':
            $costo    = floatval($costo);
            $tax      = floatval($tax);
            $shipping = floatval($shipping);
        break;
        case 'MXN':
            $costo    = floatval($costo);
            //$costo    = number_format($costo, 2);
            $tax      = floatval($tax);
            $shipping = floatval($shipping);
        break;               
        default:
            # code...
            $costo = $costo;
    }
    $expired  = explode("/",$request->request->get('pay_expired'));
    $card->setType($request->request->get('pay_type'))
        ->setNumber(str_replace(' ','',$request->request->get('pay_card')))
        ->setExpireMonth(ltrim($expired[0],0))
        ->setExpireYear(ltrim($expired[1],0))
        ->setCvv2($request->request->get('pay_cvv'))
        ->setFirstName($request->request->get('pay_nombre'))
        ->setLastName($request->request->get('pay_apellidos'));
 
    $fi->setCreditCard($card);
 
   
    $payer->setPaymentMethod("credit_card")
        ->setFundingInstruments(array($fi));
 
    $item->setName($request->request->get('pay_item'))
        ->setCurrency($this->currency)
        ->setQuantity(1)
        ->setSku($request->request->get('pay_sku'))
        ->setPrice($costo);
    
 
    $itemList->setItems(array($item));
    
    $details->setShipping($shipping)->setTax($tax)->setSubtotal($costo);
 
    
    $amount->setCurrency($this->currency)
        ->setTotal($costo)
        ->setDetails($details);
 
    
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription($request->request->get('pay_item_des'))
        ->setInvoiceNumber($request->request->get('pay_sku'));
 
    
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setTransactions(array($transaction));
 
    try {
        $payment->create($this->apiContext);
        return $payment;
    } catch (PayPalConnectionException $ex) {
        exit;
    } 

  }

}
?>