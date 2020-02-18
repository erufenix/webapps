<?php
namespace Model;

use Silex\Application;

use Entity\AppsCitasExTemario;
use Entity\AppsCitasExCita;

class rail19Model {
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

  public function getTemas(){
    $result = array();
    $this
      ->qb
      ->select('tm')
      ->from('Entity\AppsCitasExTemario','tm')
      ->OrderBy('tm.noTema', 'ASC');
      $query = $this->qb->getQuery();
      if(!empty($query->getArrayResult())){
        $result = $query->getArrayResult();
      }
      return $result;		
  }

  public function getTemasOnly(){
    $result = array();
    $this
      ->qb
      ->select('tm.noTema','tm.tema')
      ->from('Entity\AppsCitasExTemario','tm')
      ->distinct();
      //->GroupBy('tm.noTema');
      $query = $this->qb->getQuery();
      if(!empty($query->getArrayResult())){
        $result = $query->getArrayResult();
      }
      return $result;		
  }

  public function getSubTemasOnly($tema){
    $result = array();
    $this
      ->qb
      ->select('stm.tema','stm.noSubtema','stm.subtema')
      ->from('Entity\AppsCitasExTemario','stm')
      ->where(
        $this->qb->expr()->eq('stm.noTema', ':t')
      )
      ->setParameter('t',$tema)
      ->distinct();
      //->GroupBy('stm.noSubTema');
      $query = $this->qb->getQuery();
      if(!empty($query->getArrayResult())){
        $result = $query->getArrayResult();
      }
      return $result;		
  }


  public function getTemasCitas($tema,$subtema){
    $result = array();
    $this
      ->qb
      ->select('tm')
      ->from('Entity\AppsCitasExTemario','tm')
      ->where(
        $this->qb->expr()->eq('tm.noTema', ':t')
      )
      ->andWhere(
        $this->qb->expr()->eq('tm.noSubtema', ':st')
      )
      ->setParameter('t',$tema)
      ->setParameter('st',$subtema)
      ->orderBy('tm.hora');
      $query = $this->qb->getQuery();
      if(!empty($query->getArrayResult())){
        $result = $query->getArrayResult();
      }
      return $result;		
  }

  

  public function setCita($data){
    $regcr = new AppsCitasExCita;
    $cita = $data->get('cita') ."|". $data->get('tema');
    $regcr
      ->setNombre($data->get('nombre'))
      ->setCorreo($data->get('correo'))
      ->setEmpresa($data->get('empresa'))
      ->setTelefono('')
      ->setCita($data->get('id'))
      ->setHora($data->get('hora'))
      ->setDia($data->get('dia'))
      ->setMesa($data->get('mesa'))
    ;
    $this->em->persist($regcr);
    $this->em->flush();

    $regc = $this->em->getRepository('Entity\AppsCitasExTemario')->findOneByIdTemario($data->get('id'));
    $regc
      ->setBloqueada(1)
    ;
    $this->em->persist($regc);
    $this->em->flush();

    if($regcr && $regc){

    }

    return array(
      'cita' => $regcr,
      'tema' => $regc
    );

  }
  
  public function valMail($mail){
    return $this->em->getRepository('Entity\AppsCitasExCita')->findOneByCorreo($mail);
  }

  public function getAll(){
    //return $this->em->getRepository('Entity\AppsCitasExCita')->findAll(['recordatorio'  => 0]);
    $this
      ->qb
      ->select('ct')
      ->from('Entity\AppsCitasExCita','ct')
      ->where(
        $this->qb->expr()->eq('ct.recordatorio', ':r')
      )
      ->setParameter('r',0)
      ;
    $query = $this->qb->getQuery();
    return $query->getResult();
  }

  public function blkReco($id){
    $reco = $this->em->getRepository('Entity\AppsCitasExCita')->findOneByIdCita($id);
    $reco->setRecordatorio(1);
    $this->em->persist($reco);
    $this->em->flush();    
    return $reco;
  }

  public function gettcita($id){
    $tc = $this->em->getRepository('Entity\AppsCitasExTemario')->findOneByIdTemario($id);
    return $tc;
  }


}
