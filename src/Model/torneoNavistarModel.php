<?php
namespace Model;

use Silex\Application;

use Entity\OperacionesNavistargolf;
use Entity\OperacionesUserNavi;

class torneoNavistarModel {
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
		$usuario = $this->em->getRepository('Entity\OperacionesUserNavi')->findOneBy(array('userCorreo' => $this->user->getUsername()));
		return $usuario;
	}

  public function setRegistro($data) {
    $reg = new OperacionesNavistargolf;
    $reg
      ->setNombre($data->get('nombre'))
      ->setApellidos('')
      ->setCorreo($data->get('correo'))
      ->setCelular($data->get('telefono'),'')
      ->setEmpresa($data->get('empresa'),'')
      ->setDistribuidor($data->get('distribuidor'),'')
      ->setHabitacion($data->get('habitacion'),'')
      ->setNcamas($data->get('ncamas'),'')
      ->setTransporte($data->get('transporte'),'')
      ->setAerolineas($data->get('aerolineas'),'')
      ->setNvuelos($data->get('nvuelos'),'')
      ->setFechaHoraVuelos($data->get('fecha_hora_vuelos'),'')
      ->setAerolineal($data->get('aerolineal'),'')
      ->setNveulol($data->get('nvuelol'),'')
      ->setFechaHoraVuelol($data->get('fecha_hora_vuelol'),'')
      ->setFechaRegistro($data->get('fecha_registro'),'')
      ->setTipo($data->get('tipo'),0)
      ->setHandicap($data->get('handicap'),'')
      ->setEquipo($data->get('equipo'),'')
      ->setGuante($data->get('guante'),'')
      ->setGtalla($data->get('gtalla'),'')
      ->setJcamisa($data->get('jcamisa'),'')
      ->setnjcamisa($data->get('njcamisa'),'')
      ->setAlergias($data->get('alergia'),'')
      ->setComentarios($data->get('comentarios'),'')
      ->setNoches($data->get('noches'),'')
      ->setNochesa($data->get('nochesa'),'')
      ->setComentarios($data->get('comentarios'),'')
      ->setRespeciales($data->get('respeciales'),'')
      ->setRsocial($data->get('rsocial'),'')
      ->setRfc($data->get('rfc'),'')
      ->setFcorreo($data->get('fcorreo'),'')
      ->setFtelefono($data->get('ftelefono'),'')
      ->setFDireccion($data->get('fdireccion'),'')
      ;
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;
  }


  public function getAll(){
    return $this->em->getRepository('Entity\OperacionesNavistargolf')->findAll();
  }


}
