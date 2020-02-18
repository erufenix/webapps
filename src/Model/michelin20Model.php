<?php
namespace Model;

use Silex\Application;

use Entity\OperacionesAlliance20;
use Entity\OperacionesAlliance20Claves;
use Entity\OperacionesAlliance20talleres;
use Entity\OperacionesAlliance20TalleresU;

class michelin20Model {
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
    $reg = new OperacionesAlliance20;
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
      ->from('Entity\OperacionesAlliance20Claves','cv')
      ->leftJoin('Entity\OperacionesAlliance20','reg','WITH','cv.idClave=reg.idClave')
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
      ->from('Entity\OperacionesAlliance20','cv')
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
    $cve = $this->em->getRepository('Entity\OperacionesAlliance20Claves')->findOneByIdClave($idClave);
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
      ->from('Entity\OperacionesAlliance20talleres','ta')
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
    $ta = $this->em->getRepository('Entity\OperacionesAlliance20talleres')->findOneByIdTaller($id);
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

  public function uTaller($tb,$tab=array(),$id=0){
    foreach ($tb as $tbk => $tbv) {
      $regt = new OperacionesAlliance20TalleresU;
      $regt
          ->setIdRegistro($id)
          ->setIdTaller($tbv['idTaller'])
          ->setNoTaller($tbv['noTaller'])
          ->setHrTaller($tbv['hrTaller'])
          ->setTTaller($tbv['tTaller'])
          ->setTaller($tbv['taller'])
          ->setUTaller('u');
      var_dump($regt);
      $this->em->persist($regt);
      $this->em->flush();     
    }
    if(!empty($tab)){
      foreach ($tab as $tabk => $tabv) {
        $regta = new OperacionesAlliance20TalleresU;
        $regta
            ->setIdRegistro($id)
            ->setIdTaller($tabv['idTaller'])
            ->setNoTaller($tabv['noTaller'])
            ->setHrTaller($tabv['hrTaller'])
            ->setTTaller($tabv['tTaller'])
            ->setTaller($tabv['taller'])
            ->setUTaller('a');
        $this->em->persist($regta);
        $this->em->flush();     
      }      
    }
    /*$reg 
        ->setIdRegistro($id)
        ->setIdTaller($td[''])*/
  }

  public function getAll($tpo){
    $this
        ->qb
        ->select('reg','cve')
        ->from('Entity\OperacionesAlliance20','reg')
        ->innerJoin('Entity\OperacionesAlliance20Claves','cve','WITH','reg.idClave=cve.idClave')
        ->where(
          $this->qb->expr()->eq('reg.tipo', ':tpo')
        )
        ->setParameter('tpo',$tpo);
    $query = $this->qb->getQuery();
    return  $query->getScalarResult();        
  }

  public function getReg($idCve){
    $ta = $this->em->getRepository('Entity\OperacionesAlliance20')->findOneByIdClave($idClave);

  }


}
