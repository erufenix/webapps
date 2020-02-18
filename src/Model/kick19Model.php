<?php
namespace Model;

use Silex\Application;

use Entity\OperacionesKick19;

class kick19Model {
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
		$reg = new OperacionesKick19;
		$reg
			->setNombre($data->get('nombre'))
			->setApellidos($data->get('apellidos'))
			->setCorreo($data->get('correo'))
			->setTelefono($data->get('telefono'))
			->setDistribuidor($data->get('distribuidor'))
      ->setPuesto($data->get('puesto'))
			->setFacturaRs($data->get('factura_rs'),'')
			->setFacturaRfc($data->get('factura_rfc'),'')
      ->setFacturaCorreo($data->get('factura_correo'),'')
      ->setFacturaCp($data->get('factura_cp'),'')
       ->setFacturaEdo($data->get('factura_edo'),'')
			->setFacturaDireccion($data->get('factura_direccion'),'')
			->setFacturaPago($data->get('factura_pago'),'')
      ->setLlegadaNvuelo($data->get('llegada_nvuelo'))
      ->setLlegadaAerolinea($data->get('llegada_aerolinea'))
      ->setLlegadaFecha($data->get('llegada_fecha'))
      ->setSalidaNvuelo($data->get('salida_nvuelo'))
      ->setSalidaAerolinea($data->get('salida_aerolinea'))
      ->setSalidaFecha($data->get('salida_fecha'))
      ->setHabitacion($data->get('habitacion'),'')
      ->setNombreAco($data->get('nombre_aco'),'')
      ->setApellidosAco($data->get('apellidos_aco'),'')
      ->setCorreoAco($data->get('correo_aco'),'')
      ->setPuestoAco($data->get('puesto_aco'),'')
      ->setFechaRegistro($data->get('fecha_registro'))
      ->setTx('')
			;
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;
	}

	public function getAll(){
		return $this->em->getRepository('Entity\OperacionesKick19')->findAll();
	}

  public function getById($id){
    $tpr = $this->em->getRepository('Entity\OperacionesKick19')->findOneByIdRegistro($id);
    return $tpr;
  }

  public function setTX($id,$tx,$tot){
    $reg = $this->em->getRepository('Entity\OperacionesKick19')->findOneByIdRegistro($id);
    $reg
       ->setTx($tx)
       ->setTot($tot);
    $this->em->persist($reg);
    $this->em->flush();
    return $reg;
  }

}
?>
