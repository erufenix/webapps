<?php
namespace Model;

use Silex\Application;

use Entity\Reservaciones;

class rsvPanelModel {
	private $app = null;
	private $em = null;
	private $repository = null;

	public function __construct(Application $app) {
		$this->app = $app;
		$this->em = $this->app['orm.ems']['reservas'];
    $this->qb = $this->em->createQueryBuilder();

		$token = $this->app['security.token_storage']->getToken();
		if (null != $token) {
			$this->user = $token->getUser();
		}
		$this->repository = $this->em->getRepository('Entity\ReservasUsuarios');
	}

	public function getUser() {
		//$usuario = $this->repository->findOneBy(array('usuarioCorreo' => $this->user->getUsername()));
		$usuario = $this->repository->findOneByUsuarioCorreo($this->user->getUsername());
		return $usuario;
	}

	public function getEventos($idusuario){
	  $this
	      ->qb
	      ->select('eve','l')
	      ->from('Entity\ReservasEvento','eve')
	      ->where(
	              $this->qb->expr()->eq('eve.idUsuario', ':id')
	          )
	      ->innerJoin('Entity\ReservasEventoIdioma','l','WITH','eve.idEvento=l.idEvento')
	      ->setParameter('id' ,$idusuario)
	      ->orderBy('eve.idEvento ,l.idioma')
	      ->groupBy('eve.claveEvento');
	  $query = $this->qb->getQuery();
	  return  $query->getScalarResult();
	}

	public function getEvento($cveEvento){
	  $this
	      ->qb
	      ->select('eve','l')
	      ->from('Entity\ReservasEvento','eve')
	      ->where(
	              $this->qb->expr()->eq('eve.claveEvento', ':cve')
	          )
	      ->innerJoin('Entity\ReservasEventoIdioma','l','WITH','eve.idEvento=l.idEvento')
	      ->setParameter('cve' ,$cveEvento)
	      ->orderBy('eve.idEvento ,l.idioma')
	      ->setMaxResults(1);
	  $query = $this->qb->getQuery();
	  return  $query->getScalarResult();
	}

	public function getHoteles($idEvento){
		$this
			->qb
			->select('ht')
			->from('Entity\ReservasHotel','ht')
			->where(
				$this->qb->expr()->eq('ht.idEvento', ':id')
			)
			->setParameter('id',$idEvento);
			$query = $this->qb->getQuery();
			return $query->getArrayResult();  
	} 

}
?>