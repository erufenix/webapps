<?php
namespace Lib\Functions;

use OpenPayU\Configuration;
//require_once __DIR__.'/Payu/PayU.php';

//require_once realpath(dirname(__FILE__)) . '/../../../vendor/openpayu/openpayu/lib/openpayu.php';
//require_once realpath(dirname(__FILE__)) . '/../config.php';

class Payus{
	function __construct($settings=array()){
		//require_once realpath(dirname(__FILE__)) . '/../../../vendor/openpayu/openpayu/lib/openpayu.php';
		
		OpenPayU_Configuration::setEnvironment('sandbox');
		//PayU::$apiKey 		= $settings['apiKey'];
		/*PayU::$apiLogin 	= $settings['apiLogin'];
		PayU::$merchantId = $settings['merchantId'];
		PayU::$language 	= $settings['language'];
		PayU::$isTest 		= $settings['test'];*/
	}
}


?>