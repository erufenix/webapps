<?php
namespace Model;

use Silex\Application;

use Entity\OperacionesUserCMI;
use Entity\OperacionesTransportCMI;

class transportCMIModel {
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

	public function getUser() {
		$usuario = $this->em->getRepository('Entity\OperacionesUserCMI')->findOneBy(array('userCorreo' => $this->user->getUsername()));
		return $usuario;
	}

	public function setRegistro($data) {
		$reg = new OperacionesTransportCMI;
		$reg
				->setHotel($data->get('hotelName'))
				->setTransfer($data->get('transfer'))
				->setArrivePersons($data->get('arrive_persons'))
				->setArriveAirline($data->get('arrive_airline'))
				->setArriveFly($data->get('arrive_fly'))
				->setArriveDate($data->get('arrive_date'))
				->setArriveTime($data->get('arrive_time'))
				->setArriveRate($data->get('arrive_rate'))
				->setDeparturePersons($data->get('departure_persons'),'')
				->setDepartureAirline($data->get('departure_airline'),'')
				->setDepartureFly($data->get('departure_fly'),'')
				->setDepartureDate($data->get('departure_date'),'')
				->setDepartureTime($data->get('departure_time'),'')
				->setDepartureRate($data->get('departure_rate'),'')
				->setName($data->get('name'))
				->setPhone($data->get('phone'))
				->setEmail($data->get('email'))
				->setTotal($data->get('total'))
				->setComments($data->get('comments'),'')
				->setRegisterDate($data->get('register_date'),'')
				->setPay(0)
				->setCode($data->get('code'),'')
				->setRfc($data->get('rfc'),'')
				->setCompany($data->get('company'),'')
				->setCountry($data->get('country'),'')
				->setBemail($data->get('bemail'),'')
				->setCity($data->get('city'),'')
				->setState($data->get('state'),'')
				->setAddress($data->get('address'),'')
				->setBphone($data->get('bphone'),'')
				->setCp($data->get('cp'),'')		
			;
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;			
	}


	public function getTransport($code,$st,$tx){
		$tpr = $this->em->getRepository('Entity\OperacionesTransportCMI')->findOneByCode($code);
		$tpr
			->setPay(1)
			->setSt($st)
			->setTx($tx)
		;
		//var_dump($cve,$idClave);
    $this->em->persist($tpr);
    $this->em->flush();
    return $tpr;			
	}

	public function getTransportAll(){
		//$tpr = $this->em->getRepository('Entity\OperacionesTransportCMI')->findAll();
		$q = $this
					->qb
					->select('trp')
					->from('Entity\OperacionesTransportCMI','trp')
					//->orderBy('trp.tranportId', 'DESC')
					->addOrderBy('trp.st', 'DESC')
					->addOrderBy('trp.tranportId', 'DESC')
					->getQuery();
		return $q->execute();
	}

	public function getTransportAllCompleted(){
		$q = $this
					->qb
					->select('trp')
					->from('Entity\OperacionesTransportCMI','trp')
					->where(
						$this->qb->expr()->eq('trp.st', ':ct')
					)
					->setParameter('ct','Completed')
					->addOrderBy('trp.st', 'DESC')
					->addOrderBy('trp.tranportId', 'DESC')
					->getQuery();
		return $q->execute();
	}	

	public function getTransportId($id){
		$tpr = $this->em->getRepository('Entity\OperacionesTransportCMI')->findOneByTranportId($id);
    return $tpr;			
	}	

	public function setValue($field,$value,$id){
	  $q =	$this
			      ->qb
			      ->update('Entity\OperacionesTransportCMI','trp')
			      ->set('trp.'. $field, ':v')
			      ->where('trp.tranportId = :id')
			      ->setParameter('v', $value)
			      ->setParameter('id', $id)
			      ->getQuery();
		return $q->execute();
	}

	public function setRefund($refund,$tx,$code){
		$q = $this
					->qb
					->update('Entity\OperacionesTransportCMI','rf')
					->set('rf.refund', ':r')
					->set('rf.txRefund', ':t')
					->where('rf.code = :c')
					->setParameter('r', $refund)
					->setParameter('t', $tx)
					->setParameter('c', $code)
					->getQuery();
		return $q->execute();
	} 


}