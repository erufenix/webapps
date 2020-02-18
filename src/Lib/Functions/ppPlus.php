<?php
namespace Lib\Functions;

use Silex\Application;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class ppPlus {

	public 	$approvalurl;
	private $clientID;
	private $secret;
	private $token;
	private $idProfile;
  private $mode;
  private $apiUrl;	

  /**
   * [
   * 	Contructor que obtiene el approvalUrl para generar el formulario de PayPal Plus
   * ]
   * @param array $settings [description]
   */
	public function __construct($settings=array()){
		if(!empty($settings)){
			$this->clientID 	= ($settings['mode'] == 'live') ? $settings['clientID']['live'] : $settings['clientID']['sandbox'];
			$this->secret 		=	($settings['mode'] == 'live') ? $settings['secret']['live'] : $settings['secret']['sandbox'];
			$this->apiUrl 		=	($settings['mode'] == 'live') ? 'api.paypal.com' : 'api.sandbox.paypal.com';
			$this->token 			= $this->getToken($this->apiUrl,$this->clientID,$this->secret)['content']['access_token'];
			$this->idProfile	= $this->getExpProfile($this->token,$settings['params'],$this->apiUrl);
			$this->mode  			= $settings['mode'];
		}
		else{
			return false;
		}	
	}
	

	private function getToken($apiUrl,$clientID,$secret){
		$client = new Client([
		    'headers' => [ 
		    	'Accept' 					=> 'application/json',
		    	'Accept-Language' => 'en_US'
		    ]
		]);
		$response = $client->post("https://$apiUrl/v1/oauth2/token",
		    [
		    	'body' => 'grant_type=client_credentials',
		    	'auth' => [$this->clientID, $this->secret]
		  	]
		);
		if($response->getStatusCode()){
			$result = array(
												'code' 		=> $response->getStatusCode(),
												'content' => json_decode($response->getBody()->getContents(),true) 
											);
		}
		return $result;
	}

	private function getExpProfile($token,$params,$apiUrl){
		$response = array();
		$idProfile = '';
		$client = new Client([
		    'headers' => [ 
		    	"Content-Type" 	=> "application/json",
		    	"Authorization" => "Bearer " . $token
		    ]
		]);

		$body =
			array (
				'name' => $params['nameProfile'],
			  'presentation' => 
			  	array (
			    	'logo_image' => $params['logoImage'],
			  	),
			  'input_fields' => 
			  	array (
			    	'no_shipping' => $params['shipping'],
			    	'address_override' => $params['address'],
			  	),
			  'flow_config' => 
			  	array (
			    	'landing_page_type' => $params['landingPage'],
			    	'bank_txn_pending_url' => $params['bank'],
			  	),
			);


		$response = $client->post("https://$apiUrl/v1/payment-experience/web-profiles/",
		    [
		    	'body' => json_encode($body)
		  	]
		);			

		if($response->getStatusCode()){
			$idProfile = json_decode($response->getBody()->getContents(),true);
			$idProfile = $idProfile['id'];
		}
		return $idProfile;
	}

	public function getApproval($payData,$urls,$lang){
		$token 			= $this->token;
		$idProfile  = $this->idProfile;
		$apiUrl 		= $this->apiUrl;
		$mode 			= $this->mode;
		$result 		= array();

		$body = array (
			'intent' => 'sale',
			'experience_profile_id' => $idProfile,
			'payer' => 
				array (
					'payment_method' => 'paypal',
				),
			'transactions' => 
				array (
					0 => 
						array (
							'amount' => 
								array (
									'currency' 	=> $payData['currency'],
									'total' 		=> $payData['total'],
									'details' 	=> 
										array (
											'shipping' 					=> '0',
											'subtotal' 					=> $payData['total'],
											'shipping_discount' => '0',
											'handling_fee' 			=> '0',
											'tax' 							=> '0',
										),
								),
							'description' 		=> $payData['description'],
							'payment_options' => 
								array (
									'allowed_payment_method' => 'IMMEDIATE_PAY',
								),
							'item_list' => 
								array (
									'shipping_address' => 
										array (
											'recipient_name' 	=> $payData['name'], 
											'line1' 					=> $payData['address1'],
											'line2' 					=> $payData['address2'],
											'city' 						=> $payData['city'],
											'country_code' 		=> $payData['country_code'],
											'postal_code' 		=> $payData['cp'],
											'state' 					=> $payData['state'],
											'phone' 					=> $payData['phone'],
										),
									'items' => 
									array (
										0 => 
										array (
											'name' 				=> $payData['item_name'],
											'description' => $payData['item_description'],
											'quantity' 		=> '1',
											'price' 			=> $payData['item_price'],
											'tax' 				=> '0',
											'sku' 				=> $payData['item_sku'],
											'currency' 		=> $payData['item_currency'],
										),
									),
								),
						),
				),
			'redirect_urls' => 
				array (
					'return_url' => $urls['return'],
					'cancel_url' => $urls['cancel'],
				),
		);

		$client = new Client([
		    'headers' => [ 
		    	"Content-Type" 	=> "application/json",
		    	"Authorization" => "Bearer " . $token
		    ]
		]);

		try{
			$response = $client->post("https://$apiUrl/v1/payments/payment",
					[
						'body' => json_encode($body)
					]
			);

			if($response->getStatusCode()){
				$result = array(
					'code' 		=> $response->getStatusCode(),
					'content' => json_decode($response->getBody()->getContents(),true),
					'token' 	=> $token,
					'mode' 		=> $mode
				);
			}
		}
		catch (RequestException $e) {
			if ($e->hasResponse()) {
				$result = json_decode($e->getResponse()->getBody()->getContents(),true);
				var_dump($result);				
	    }	
		}		
		return $result;				
	}

	public function execute($exeUrl='',$token='',$payerId=''){
		$result = array();
		$body = array('payer_id' => $payerId );
		$client = new Client([
		    'headers' => [ 
		    	"Content-Type" 	=> "application/json",
		    	"Authorization" => "Bearer " . $token
		    ]
		]);
		
		try{
			$response = $client->post("$exeUrl",
					[
						'body' => json_encode($body)
					]
			);

			if($response->getStatusCode()){
				$result = array(
					'code' 		=> $response->getStatusCode(),
					'content' => json_decode($response->getBody()->getContents(),true),
					'token' 	=> $token
				);
			}
		}
		catch (RequestException $e) {
			if ($e->hasResponse()) {
				$result = json_decode($e->getResponse()->getBody()->getContents(),true);
				var_dump($result);				
	    }	
		}
		return $result;
	}	

	public function applyRefund($refundData,$lang){
		$token 		=	$this->token;
		$apiUrl 	= $this->apiUrl;
		$tx 			=	$refundData['tx'];
		$rf    		= $refundData['refund'];
		$code 		= $refundData['code'];
		$currency = $refundData['currency'];
		$note    	= $refundData['note'];
		$result 	= array();
		$body 	= array(
										'amount' 				=> array(
																				'total' 				=> $rf,
																				'currency' => $currency
																				),
										'invoice_number' 		=> 'refund-' . $code
									);
		$client = new Client([
		    'headers' => [ 
		    	"Content-Type" 	=> "application/json",
		    	"Authorization" => "Bearer " . $token
		    ]
		]);

		try {
			$response = $client->post("https://$apiUrl/v1/payments/sale/$tx/refund",
			    [
			    	'body' => json_encode($body)
			  	]
			);			
			if($response->getStatusCode()){
				$result = array(
					'code' 		=> $response->getStatusCode(),
					'content' => json_decode($response->getBody()->getContents(),true),
					'refund' 	=> $rf
				);
			}
		} catch (RequestException $e) {
	    if ($e->hasResponse()) {
	    	$result = json_decode($e->getResponse()->getBody()->getContents(),true);
	    }	
		}
		return $result;
	}
}
?>