<?php
namespace Model;

use Silex\Application;

use Entity\OperacionesAlliance19;
use Entity\OperacionesAlliance19Claves;
use Entity\OperacionesAlliance19talleres;

class michelin19Model {
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

  public function setRegistro($data) {
    $reg = new OperacionesAlliance19;
    $reg
      ->setIdClave($data->get('idClave'))
      ->setTpoNombre($data->get('tpoNombre'),'')
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
      ->setTipo($data->get('tipo'),0)
      ->setCmVuelo($data->get('cmVuelo'),'')
      ->setComentarios($data->get('comentarios'),'')
      ->setTalleres($data->get('talleres'),'')
      ->setTalleresAco($data->get('talleres_aco'),'-')
      ;
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;
  }

  public function getClave($data) {
    $result = array();
    $this
      ->qb
      ->select('cv','reg')
      ->from('Entity\OperacionesAlliance19Claves','cv')
      ->leftJoin('Entity\OperacionesAlliance19','reg','WITH','cv.idClave=reg.idClave')
      ->where(
        $this->qb->expr()->eq('cv.clave', ':cve')
      )
      ->andWhere(
        $this->qb->expr()->eq('cv.tipo', ':tpo')
      )
      ->setParameter('cve',$data->get('clave'))
      ->setParameter('tpo',$data->get('tipov'));
      $query = $this->qb->getQuery();
      if(!empty($query->getArrayResult())){
        $result = $query->getScalarResult()[0];
      }
      return $result;
  }

  public function getRegCve($cve){
    $result = array();
    $this
      ->qb
      ->select('cv')
      ->from('Entity\OperacionesAlliance19','cv')
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

  public function blkCve($idClave) {
    $cve = $this->em->getRepository('Entity\OperacionesAlliance19Claves')->findOneByIdClave($idClave);
    $cve
      ->setBloqueada(true);
    $this->em->persist($cve);
    $this->em->flush();
    return $cve;
  }

  public function getTalleres($turno,$hora=''){
    $result = array();
    $this
      ->qb
      ->select('ta')
      ->from('Entity\OperacionesAlliance19talleres','ta')
      ->where(
        $this->qb->expr()->eq('ta.turno', ':turno')
      )
      ->setParameter('turno',$turno)
      ->OrderBy('ta.noTaller', 'ASC');
      $query = $this->qb->getQuery();
      if(!empty($query->getArrayResult())){
        $result = $query->getArrayResult();
      }
      return $result;
  }

  public function upTaller($id,$staff=false){
    $ta = $this->em->getRepository('Entity\OperacionesAlliance19talleres')->findOneByIdTaller($id);
    if($staff){
      $nt = $ta->getCupoStaff();
      $nt = (int) $nt;
      $nt = $nt + 1;
      $ta->setCupoStaff($nt);
    }
    else{
      $nt = $ta->getCupo();
      $nt = (int) $nt;
      $nt = $nt + 1;
      $ta->setCupo($nt);
    }
    $this->em->persist($ta);
    $this->em->flush();
    return $ta;
   }

  public function getAll($tpo){
    $this
        ->qb
        ->select('reg','cve')
        ->from('Entity\OperacionesAlliance19','reg')
        ->innerJoin('Entity\OperacionesAlliance19Claves','cve','WITH','reg.idClave=cve.idClave')
        ->where(
          $this->qb->expr()->eq('reg.tipo', ':tpo')
        )
        ->setParameter('tpo',$tpo);
    $query = $this->qb->getQuery();
    return  $query->getScalarResult();        
  }

  public function getReg($idCve){
    $ta = $this->em->getRepository('Entity\OperacionesAlliance19')->findOneByIdClave($idClave);

  }


}
