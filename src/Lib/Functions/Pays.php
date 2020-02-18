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

class Pays {
  public $currency;
  private $apiContext;

  public $payer;
  public $payment;
  public $item;
  public $temList;
  public $details;
  public $amount;
  public $transaction;
  public $redirectUrls;
  public $approvalUrl;
      
  const LOG_LEVEL = 'DEBUG';
  const LOG_FILE_NAME = '/paypal.log';

	/*function __construct($settings=array()){
	  /*$this->currency = (array_key_exists('currency', $settings) ? $settings['currency'] : 'MXN');
	  $mode = (array_key_exists('mode', $settings) ? $settings['mode'] : 'sandbox');
	  $clientID = (array_key_exists('clientID', $settings) ? $settings['clientID'] : null);
	  $secret = (array_key_exists('secret', $settings) ? $settings['secret'] : null);
	  $connectionTimeOut = (array_key_exists('connectionTimeOut', $settings) ? $settings['connectionTimeOut'] : 30);
	  $logEnabled = (array_key_exists('logEnabled', $settings) ? $settings['logEnabled'] : true);
	  $logDir = (array_key_exists('logDir', $settings) ? $settings['logDir'] : __DIR__ . '/../../../../logs');

    $this->apiContext = new ApiContext(new OAuthTokenCredential(
    		$clientID,
        $secret
    ));

	  $this->apiContext->setConfig(array(
	      'mode' => $mode,
	      'http.ConnectionTimeOut' => $connectionTimeOut,
	      'log.LogEnabled' => $logEnabled,
	      'log.FileName' => $logDir . self::LOG_FILE_NAME,
	      'log.LogLevel' => self::LOG_LEVEL
	  ));
	}*/

  public function apiContext($clientID,$secret){

    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            $clientID,
            $secret
        )
    );

    $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
            )
        );
    return $apiContext;
  } 
    /**
     * @return ExpressCheckout
     */
  public function createExpressCheckout($request,$app){
    $this->payer        = new Payer();
    $this->payment      = new Payment();
    $this->item         = new Item();
    $this->itemList     = new ItemList();
    $this->details      = new Details();
    $this->amount       = new Amount();
    $this->transaction  = new Transaction();
    $this->redirectUrls = new RedirectUrls();
    $this->payer->setPaymentMethod("");

    $urlSuccess = (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST').$app['url_generator']->generate('mansionx.paySuccess');
    $urlFail = (empty($request->server->get('REQUEST_SCHEME')) ? "http" : $request->server->get('REQUEST_SCHEME')) ."://". $request->server->get('HTTP_HOST').$app['url_generator']->generate('mansionx.payFail');        

    $this->item
           ->setName($request->request->get('pay_item'))
           ->setCurrency($this->currency)
           ->setQuantity(1)
           ->setSku($request->request->get('pay_sku')) // Similar to `item_number` in Classic API
           ->setPrice($request->request->get('pay_costo'));
    
    $this->itemList->setItems(array($this->item));
    
    $this->details->setShipping(0.0) ->setTax(0.0) ->setSubtotal(0.0);

    $this->amount
        ->setCurrency($this->currency)
        ->setTotal($request->request->get('pay_costo'))
        ->setDetails($this->details);

    $this->transaction
        ->setAmount($this->amount)
        ->setItemList($this->itemList)
        ->setDescription($request->request->get('pay_item_des'))
        ->setInvoiceNumber($request->request->get('pay_sku'));

    $this->redirectUrls
          ->setReturnUrl($urlSuccess)
          ->setCancelUrl($urlFail);

    $this->payer->setPaymentMethod("paypal");
    $this->payment
      ->setIntent("sale")
      ->setPayer($this->payer)
      ->setRedirectUrls($this->redirectUrls)
      ->setTransactions(array($this->transaction));

    //var_dump("C",$this->apiContext('AWFDvDFuJ2clc1VFZBevgdsLI7x0vxDhsIUQy2jyo45c1hf-GTkHLeEW-1A5_Zds0G2P__dhk5FuNq33','EPrSgFfb3rmyy-HxnOzAEscy6LCuXq7-m-eYo1EVkyIIkbqUDmZvqydOUI2tIlPcmneiXsUZYEJAqeD1'));

    try {
      $this->payment->create($this->apiContext('AWFDvDFuJ2clc1VFZBevgdsLI7x0vxDhsIUQy2jyo45c1hf-GTkHLeEW-1A5_Zds0G2P__dhk5FuNq33','EPrSgFfb3rmyy-HxnOzAEscy6LCuXq7-m-eYo1EVkyIIkbqUDmZvqydOUI2tIlPcmneiXsUZYEJAqeD1'));
    } catch (PayPal\Exception\PPConnectionException $pce) {
      echo '<pre>';print_r(json_decode($pce->getData()));
      exit;
    }

    
    //$request = clone $this->payment;
    /*try {
      //$this->payment->create($this->apiContext);
    } catch (Exception $ex) {
      ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
      exit(1);
    }        
    
    $this->approvalUrl = $this->payment->getApprovalLink();
    //ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);*/

    return true;
  }

    /**
     * @return CreditCardPayment
     */
    public function createCreditCardPayment()
    {
        return new CreditCardPayment($this->currency);
    }

    /**
     * @return ApiContext
     */
    public function getPayPalApiContext()
    {
        return $this->apiContext;
    }

    /**
     * @param string $payerId
     * @param string $paymentID
     * @return bool
     */
    public function executePayment($payerId, $paymentID)
    {
        $payment = Payment::get($paymentID, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
        try {
            $payment->execute($execution, $this->apiContext);
            return true;
        } catch (\Exception $exp) {
            return false;
        }
    }

    /**
     * @return string
     */
    public function generateInvoiceNumber()
    {
        $invoice = Invoice::generateNumber($this->apiContext);
        return $invoice->number;
    }

}
?>