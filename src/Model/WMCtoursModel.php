<?php
namespace Model;

use Silex\Application;

use Entity\OperacionesWmctours;
use Lib\Functions\Functions;

class WMCtoursModel {
	private $app = null;
	private $em = null;
	private $repository = null;

	public function __construct(Application $app) {
		$this->app = $app;
		$this->em = $this->app['orm.ems']['operations'];
    $this->qb = $this->em->createQueryBuilder();
		$token = $this->app['security.token_storage']->getToken();
		if (null != $token) {
			$this->user = $token->getUser();
		}    
	}
	
	public function setTour($data){
		$reg = new OperacionesWmctours;
		$fn  = new Functions;
		$reg 
					->setTourCve($data['data']['tourdata']['tour_name'])
					->setName($data['data']['tourdata']['name'])
					->setSurname($data['data']['tourdata']['surname'])
					->setEmail($data['data']['tourdata']['email'])
					->setTourDate($fn->d2b($data['data']['tourdata']['tour_date']))
					->setcfullname(empty($data['data']['tourdata']['cfullname']) ? '' : implode(",",$data['data']['tourdata']['cfullname']),'')
					->setcemail(empty($data['data']['tourdata']['cemail']) ? '' : implode(",",$data['data']['tourdata']['cemail']),'')
					->setTotal($data['data']['approval']['content']['transactions']['0']['amount']['total'])
					->setSku($data['sku'])
					->setTx($data['tx'])
					->setCreatedDate(new \DateTime('now'),'')
		;
		$this->em->persist($reg);
    $this->em->flush();
		return $reg;
	}
}
?>