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

class Functions {
	public function d2b($date, $time = false){
		$format = "Y-m-d";
		$ndate = null;
		if($time == true){
			$format = "Y-m-d H:i:s";
		}
		$ndate = date($format,strtotime(str_replace('/','-',$date)));
		return new \DateTime($ndate);
	}

	public function t2b($time){
		$format = "H:i:s";
		$ntime = null;
		$ntime = date($format,strtotime(str_replace('/','-',$time)));
		return new \DateTime($ntime);
	}

	public function d2w($date, $time = false){
		$format = "m-d-Y";
		$ndate = null;
		if($time == true){
			$format = "m-d-Y H:i:s";
		}
		$ndate = date($format,strtotime(str_replace('/','-',$date)));
		return new \DateTime($ndate);
	}

	public function d2h($date,$time=false){
		$d = date_parse($date);
		$format = '';
		$format = str_pad($d['day'],2,"0",STR_PAD_LEFT) . "-" . str_pad($d['month'],2,"0",STR_PAD_LEFT) . "-" .str_pad($d['year'],2,"0",STR_PAD_LEFT); //." ". str_pad($d['hour'],2,"0",STR_PAD_LEFT) . ":" . str_pad($d['minute'],2,"0",STR_PAD_LEFT);
		if($time){
			$format .= " " . str_pad($d['hour'],2,"0",STR_PAD_LEFT) . ":" . str_pad($d['minute'],2,"0",STR_PAD_LEFT);
		}
		return $format;
	}


	public function token($length, $c=""){
		$pattern 	= "123456789";
		$string 		= $c;
 		for ($i = 0 ; $i < $length ; $i++ ) {
			$string .= $pattern[rand(0,8)];
		}
		return $string;
	}

	public function genExcel($creator, $title, $worksheet){
		$phpExcel = new \PHPExcel();
		$ltrnum   = 65;
		$ltrchr   = "";
		$lastchr  = "";
		$lastcell = 0;
		// Set document properties
		$phpExcel->getProperties()->setCreator($creator)
		            ->setLastModifiedBy($creator)
		            ->setTitle($title)
		            ->setSubject($title)
		            ->setDescription("Document for Office 2007 XLSX, generated using PHPexcel")
		            ->setKeywords("office 2007 openxml php")
		            ->setCategory("xlsx");
		// Rename worksheet
		$phpExcel->getActiveSheet()->setTitle($worksheet);
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$phpExcel->setActiveSheetIndex(0);
		return $phpExcel;
	}

  public function getGeo($geoid,$index=null,$lang = 'es'){
  	$r 	= null;
    $ch = curl_init("http://api.geonames.org/getJSON?formatted=true&geonameId=$geoid&username=erufenix&style=full&lang=$lang");
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($data, true);
		if($index){
			$r = $data[$index];
		}
		else{
			$r = data;
		}
		return $r;
  }

  public function getCountryList($lang='es'){
  	$r = '';
  	$ch = curl_init("http://api.geonames.org/countryInfoJSON?username=erufenix&lang=$lang");
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		$data = json_encode($data);
		if(!empty($data)){
			$r = $data;
		}
		return $r;
  }

  public function getCountryListArray($lang='es'){
  	$result = '';
		$client = new Client([
		    'headers' => [
		    	"Content-Type" 	=> "application/json"
		    ]
		]);

		try {
			$response = $client->post("http://api.geonames.org/countryInfoJSON?username=erubi&lang=$lang",
			    [
			    	'body' => '{}'
			  	]
			);
			if($response->getStatusCode()){
				$result = array(
					'code' 		=> $response->getStatusCode(),
					'content' => json_decode($response->getBody()->getContents(),true)
				);
			}
		} catch (RequestException $e) {
	    if ($e->hasResponse()) {
	    	$result = json_decode($e->getResponse()->getBody()->getContents(),true);
	    }
		}
		return $result;
  }

  public function getCountry($geoid,$index=null,$lang = 'es'){
  	$result 	= '';
  	$content 	= array();
		$client 	= new Client([
		    'headers' => [
		    	"Content-Type" 	=> "application/json"
		    ]
		]);

		try {
			$response = $client->post("http://api.geonames.org/getJSON?formatted=true&geonameId=$geoid&username=erufenix&style=full&lang=$lang",
			    [
			    	'body' => '{}'
			  	]
			);
			if($response->getStatusCode()){
				$content = json_decode($response->getBody()->getContents(),true);
				if($index){
					$content = $content[$index];
				}
				$result = array(
					'code' 		=> $response->getStatusCode(),
					'content' => $content
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
