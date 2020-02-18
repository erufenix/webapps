<?php
namespace Model;

use Silex\Application;

use Entity\AppsUpfront;
use Entity\AppsUpfrontClaves;

class upfrontModel {
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

  public function setRegistro($data){
    $reg = new AppsUpfront;
    $reg
      ->setNombre($data['nombre'],'')
      ->setApellidos($data['apellidos'],'')
      ->setCorreo($data['correo'],'')
      ->setFechaRegistro(new \DateTime('now'),'')
      ->setFolio($data['folio'],'')
      ->setIdClave($data['id_clave'],'')
    ;
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;
  }

  public function setNRegistro($data){
    $cv  = new AppsUpfrontClaves;
    $cv 
      ->setCorreo($data['correo'],'')
      ->setNombre($data['nombre']." ". $data['apellidos'],'')
      ->setBloqueada('1')
      ;
    $this->em->persist($cv);
    $this->em->flush();    
    $reg = new AppsUpfront;
    $reg
      ->setNombre($data['nombre'],'')
      ->setApellidos($data['apellidos'],'')
      ->setCorreo($data['correo'],'')
      ->setFechaRegistro(new \DateTime('now'),'')
      ->setFolio($data['folio'],'')
      //->setIdClave($data['id_clave'],'')
      ->setEntrada(me(NULL))
      ->setMesa($data['mesa'],'')
      ->setSilla($data['silla'],'')
    ;
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;
  }  

  public function valMail($mail){
    return $this->em->getRepository('Entity\AppsUpfront')->findOneByCorreo($mail);
  }

  public function getvmail($mail){
    /*$em = $this->em->getRepository('Entity\AppsUpfrontClaves')->findAll(
                                                                          [
                                                                            'correo' => $mail,
                                                                            //'bloqueada' => 0
                                                                          ]
                                                                          );
    return $em;*/
    $result = array();
    $this
      ->qb
      ->select('cv')
      ->from('Entity\AppsUpfrontClaves','cv')
      ->where(
        $this->qb->expr()->eq('cv.correo', ':correo')
      )
      ->setParameter('correo',$mail)
      ->OrderBy('cv.bloqueada', 'DESC');
      $query = $this->qb->getQuery();
      if(!empty($query->getArrayResult())){
        $result = $query->getArrayResult();
      }
      return $result;       
  }

  public function blkclave($idClave){
    $cve = $this->em->getRepository('Entity\AppsUpfrontClaves')->findOneByIdClave($idClave);
    $cve
      ->setBloqueada(true);
    $this->em->persist($cve);
    $this->em->flush();
    return $cve;
  }

  public function getAll(){
    $reg = $this->em->getRepository('Entity\AppsUpfront')->findAll();
    return $reg;
  }

  public function getReg($id){
    $reg = $this->em->getRepository('Entity\AppsUpfront')->findOneByIdUpfront($id);
    return $reg;
  }
  
  public function getRegFolio($folio){
    $fol = $this->em->getRepository('Entity\AppsUpfront')->findOneByFolio($folio);
    return $fol;
  }    

  public function setHora($folio){
    $fol = $this->em->getRepository('Entity\AppsUpfront')->findOneByFolio($folio);
    $res = [
      'update'  => false,
      'folio'   => []
    ];
    if($fol != NULL){
      if(empty($fol->getEntrada())){ 
        $fol->setEntrada(new \DateTime('now'),'');
        $this->em->persist($fol);
        $this->em->flush();
        $res = [
          'update'  => true,
          'folio'   => $fol
        ];        
      }
      else{
        $res = [
          'update'  => false,
          'folio'   => $fol
        ];  
      }
    }  
    return $res;
  }

  public function setMesaSilla($mesa,$silla,$id){
    $reg = $this->getReg($id);
    $reg->setMesa($mesa,'');
    $reg->setSilla($silla,'');
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;  
  }
}