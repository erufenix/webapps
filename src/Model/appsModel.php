<?php
namespace Model;

use Silex\Application;

use Entity\AppsNumbers;

class appsModel {
	private $app = null;
	private $em = null;
	private $repository = null;

	public function __construct(Application $app) {
		$this->app = $app;
		$this->em = $this->app['orm.ems']['devapps'];
    $this->qb = $this->em->createQueryBuilder();

		/*$token = $this->app['security.token_storage']->getToken();
		if (null != $token) {
			$this->user = $token->getUser();
		}
		$this->repository = $this->em->getRepository('Entity\ReservasUsuarios');*/
	}

	public function chkMail($mail){
		return $this->em->getRepository('Entity\AppsNumbers')->findOneBy(array('correo' => $mail));
	}


	public function getNumbers(){
		$q = $this
					->qb
					->select('tk.numero')
					->from('Entity\AppsNumbers','tk')
					->addOrderBy('tk.numero', 'ASC')
					->getQuery();
		return $q->execute();
	}

	public function reg($rq,$rnd){
		$reg = new AppsNumbers;
		$reg
			->setCorreo($rq->get('correo'))
			->setNumero($rnd);
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;
	}

  public function getAll(){
    return $this->em->getRepository('Entity\AppsNumbers')->findAll();
  }
}
