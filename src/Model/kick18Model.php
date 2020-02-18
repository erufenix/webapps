<?php
namespace Model;

use Silex\Application;

use Entity\OperacionesKick18;

class kick18Model {
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
		$reg = new OperacionesKick18;
		$reg
			->setNombre($data->get('nombre'))
			->setApellidos($data->get('apellidos'))
			->setCorreo($data->get('correo'))
			->setPuesto($data->get('puesto'))
			->setTelefono($data->get('telefono'))
			->setDistribuidor($data->get('distribuidor'))
			->setCamisa($data->get('camisa'))
			->setHabitacion($data->get('habitacion'))
			->setFacturaRs($data->get('facturaRS'))
			->setFacturaRfc($data->get('facturaRFC'))
			->setFacturaDireccion($data->get('facturaDireccion'))
			->setFacturaCorreo($data->get('facturaCorreo'))
			->setFacturaPago($data->get('facturaPago'))
			->setAerolineaIda($data->get('aerolineaIda'))
			->setNvueloIda($data->get('nvueloIda'))
			->setFechaHoraIda($data->get('fechaHoraIda'))
			->setAerolineaRegreso($data->get('aerolineaRegreso'))
			->setNvueloRegreso($data->get('nvueloRegreso'))
			->setFechaHoraRegreso($data->get('fechaHoraRegreso'))
			->setFechaRegistro($data->get('fechaRegistro'))
			->setAcoNombre($data->get('acoNombre'),'')
			->setAcoCorreo($data->get('acoCorreo'),'')
			->setAcoPuesto($data->get('acoPuesto'),'')
			->setAcoCamisa($data->get('acoCamisa'),'')
			->setAcoNvueloIda($data->get('acoNvueloIda'),'')
			->setAcoAerolineaIda($data->get('acoAerolineaIda'),'')
			->setAcoFechaHoraIda($data->get('acoFechaHoraIda'))
			->setAcoNvueloRegreso($data->get('acoNvueloIda'),'')
			->setAcoAerolineaRegreso($data->get('acoAerolineaRegreso'),'')
			->setAcoFechaHoraRegreso($data->get('acoFechaHoraRegreso'))
			;
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;			
	}

	public function blkCve($idClave) {
		$cve = $this->em->getRepository('Entity\OperacionesAlliance18Claves')->findOneByIdClave($idClave);
		$cve
			->setBloqueada('1')
		;
    $this->em->persist($cve);
    $this->em->flush();
    return $cve;			
	}

}
?>