<?php
namespace Model;

use Silex\Application;

use Entity\OperacionesAlliance18;
use Entity\OperacionesAlliance18Claves;

class AllianceModel {
	private $app = null;
	private $em = null;
	private $repository = null;

	public function __construct(Application $app) {
		$this->app = $app;
		$this->em = $this->app['orm.ems']['operations'];
    $this->qb = $this->em->createQueryBuilder();

		/*$token = $this->app['security.token_storage']->getToken();
		if (null != $token) {
			$this->user = $token->getUser();
		}
		$this->repository = $this->em->getRepository('Entity\ReservasUsuarios');*/
	}

	public function getClave($data) {
		$result = array();
		$this
			->qb
			->select('cv')
			->from('Entity\OperacionesAlliance18Claves','cv')
			->where(
				$this->qb->expr()->eq('cv.clave', ':cve')
			)
			/*->andWhere(
				$this->qb->expr()->eq('cv.bloqueada', ':blk')
			)*/
			->setParameter('cve',$data->get('clave'));
			/*->setParameter('blk',0);*/
			$query = $this->qb->getQuery();
			if(!empty($query->getArrayResult())){
				$result = $query->getArrayResult()[0];
			}
			return $result;
	}

	public function getRegCve($cve){
		$result = array();
		$this
			->qb
			->select('cv')
			->from('Entity\OperacionesAlliance18','cv')
			->where(
				$this->qb->expr()->eq('cv.idClave', ':cve')
			)
			->setParameter('cve',$cve);
			$query = $this->qb->getQuery();
			if(!empty($query->getArrayResult())){
				$result = $query->getArrayResult();
			}
			return $result;		
	}



	public function setRegistro($data) {
		$reg = new OperacionesAlliance18;
		$reg
			->setIdClave($data->get('idClave'))
			->setTpoNombre($data->get('tpoNombre'))
			->setNombre($data->get('nombre'))
			->setApellidos('')
			->setCorreo($data->get('correo'))
			->setCelular($data->get('celular'))
			->setContacto($data->get('contacto'))
			->setDistribuidor($data->get('distribuidor'))
			->setAcoNombre($data->get('aco_nombre'),'')
			->setHabitacion($data->get('habitacion'))
			->setNcamas($data->get('ncamas'),'')
			->setTransporte($data->get('transporte'))
			->setAerolineas($data->get('aerolineas'),'')
			->setNvuelos($data->get('nvuelos'),'')
			->setFechaHoraVuelos($data->get('fecha_hora_vuelos'),'')
			->setAerolineal($data->get('aerolineal'),'')
			->setNveulol($data->get('nvuelol'),'')
			->setFechaHoraVuelol($data->get('fecha_hora_vuelol'),'')
			->setActividad($data->get('actividad'),'')
			->setOpActividad('')
			->setDiaActividad('')
			->setFechaRegistro($data->get('fecha_registro'))
			->setFechaL($data->get('fecha_l'))
			->setFechaS($data->get('fecha_s'))
			->setToken('')
			->setGrupo($data->get('grupo'))
			->setCmVuelo($data->get('cmVuelo'),' ')	
			;
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;			
	}

	public function blkCve($idClave) {
		$cve = $this->em->getRepository('Entity\OperacionesAlliance18Claves')->findOneByIdClave($idClave);
		$cve
			->setBloqueada(true)
		;
		//var_dump($cve,$idClave);
    $this->em->persist($cve);
    $this->em->flush();
    return $cve;			
	}

	public function getAll(){
	  $this
	      ->qb
	      ->select('reg','cve')
	      ->from('Entity\OperacionesAlliance18','reg')
	      ->leftJoin('Entity\OperacionesAlliance18Claves','cve','WITH','reg.idClave=cve.idClave');
	  $query = $this->qb->getQuery();
	  return  $query->getScalarResult();	      
	}

}
?>