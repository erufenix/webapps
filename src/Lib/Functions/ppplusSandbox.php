<?php
namespace Lib\Functions;

use Silex\Application;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

use GuzzleHttp\Client;

class ppplusSandbox{
	public 	$approvalurl;
	private $clientID;
	private $secret;
	private $token;

	private function getToken(){
		$this->clientID = "Aamm4JcEPPuRAqkRYTDC44v2xyXPI3XlUlIOyCzM-jPuYoxTm4xyeX6vy0tcSZTUxPKUTkQhOI1NrGa2";
		$this->secret 	= "ELqXRheFUcx7w41XVpT1IglSXRzgbwEQ9XpBZ5toqUJnm4tjY9oku3ynWbN1EkAK3gdWCxq-Ac7Vss-g";
		$response = array();
		$client = new Client([
		    'headers' => [ 
		    	'Accept' 					=> 'application/json',
		    	'Accept-Language' => 'en_US'
		    ]
		]);

		$response = $client->post('https://api.sandbox.paypal.com/v1/oauth2/token',
		    [
		    	'body' => 'grant_type=client_credentials',
		    	'auth' => [$this->clientID, $this->secret]
		  	]
		);
		if($response->getStatusCode()){
			$result = array(
												'code' 		=> $response->getStatusCode(),
												'content' => $response->getBody()->getContents() 
											);
		}
		return $result;
	}

	private function getExpProfile($token,$params){
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


		$response = $client->post('https://api.sandbox.paypal.com/v1/payment-experience/web-profiles/',
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

	private function getApproval($token,$payData,$lang,$urls,$idProfile){
		$result = array();
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
									'currency' => strtoupper($payData->get('divisa')),
									'total' => $payData->get('cargototal'),
									'details' => 
									array (
										'shipping' => '0',
										'subtotal' => $payData->get('cargototal'),
										'shipping_discount' => '0',
										'handling_fee' => '0',
										'tax' => '0',
									),
								),
							'description' => $payData->get('nombreevento') .", " . $payData->get('nombrehotel') ." - ". $payData->get('tipohabitacion'),
							'payment_options' => 
							array (
								'allowed_payment_method' => 'IMMEDIATE_PAY',
							),
							'item_list' => 
								array (
									'shipping_address' => 
									array (
										'recipient_name' => $payData->get('nombre') ." ". $payData->get('app') ." ". $payData->get('apm'), 
										'line1' => $payData->get('direccion') .", ". $payData->get('colonia'),
										'line2' => '',
										'city' => 'CDMX',
										'country_code' => 'MX',
										'postal_code' => $payData->get('cp'),
										'state' => $payData->get('estado'),
										'phone' => $payData->get('telefono'),
									),
									'items' => 
									array (
										0 => 
										array (
											'name' => $payData->get('nombreevento'),
											'description' => $payData->get('nombreevento') .", " . $payData->get('nombrehotel') ." - ". $payData->get('tipohabitacion'),
											'quantity' => '1',
											'price' => $payData->get('cargototal'),
											'tax' => '0',
											'sku' => $payData->get('claveevento') ."-". $payData->get('clavereservacion'),
											'currency' => strtoupper($payData->get('divisa')),
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

		$response = $client->post('https://api.sandbox.paypal.com/v1/payments/payment',
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
		return $result;
	}

	public function checkOut($payData = array(),$lang,$urls,$params=array()){
		$token = null;
		$this->token = $this->getToken();
		$token = json_decode($this->token['content'],true);
		$idProfile = '';
		$idProfile 		= $this->getExpProfile($token['access_token'],$params);
		return $this->getApproval($token['access_token'],$payData,$lang,$urls,$idProfile);
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
		$response = $client->post($exeUrl,
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
		return $result;
	}
}
?>