<?php
namespace Model;

use Silex\Application;

use Entity\ReservacionesReservaciones;

class ReservacionesModel {
	private $app = null;
	private $em = null;
	private $repository = null;

	public function __construct(Application $app)
	{
		$this->app = $app;
    $this->em = $this->app['orm.em'];
    $this->qb = $this->em->createQueryBuilder();
    $this->repository['reservaciones']	=	$this->em->getRepository('Entity\ReservacionesReservaciones');

	}


	// Agregar reservación
    public function crearReservacion($data,$fechas=array(),$app = null){

        $miReserva = new ReservacionesReservaciones();
        $miReserva
        ->setClaveevento($data->get('claveEvento'))
        ->setClavereservacion($data->get('claveReservacion'))
        ->setIdioma($data->get('lang'))
        ->setNombreevento($data->get('nombreEvento'))
        ->setFechaevento($data->get('fechaEvento'))
        ->setSedeevento($data->get('sedeEvento'))
        ->setNombrehotel($data->get('hotel'))
        ->setTipohabitacion($data->get('tipoHabitacion'))
        ->setPagapor($data->get('pagoPor'))
        ->setDiaspago($data->get('diasPago'))
        ->setCostonoche($data->get('costoNoche'))
        ->setCargobellboys($data->get('cargoBellBoys'))
        ->setCargototal($data->get('cargoTotal'))
        ->setDivisa($data->get('divisa'))
        ->setOperador($data->get('operador'))
        ->setFechallegada($fechas['fllegada'])
        ->setFechasalida($fechas['fsalida'])
        ->setFormapago($data->get('pago'))
        ->setSTransm($data->get('',''))
        ->setNombre($data->get('nombre'))
        ->setApp($data->get('apaterno'))
        ->setApm($data->get('amaterno'))
        ->setPais($data->get('pais'))
        ->setCp($data->get('cp'))
        ->setEstado($data->get('estado'))
        ->setColonia($data->get('colProvi'))
        ->setDireccion($data->get('direccion'))
        ->setTelefono($data->get('telefono'))
        ->setTelmovil($data->get('celular'),'')
        ->setEmail($data->get('correo'))
        ->setAcompanantes($data->get('acom',''))
        ->setComentarios($data->get('comentarios',''))
        ->setRequierefactura($data->get('factura'))
        ->setRazonsocialRs($data->get('razonSocial',''))
        ->setRfcRs($data->get('rfc',''))
        ->setPaisRs($data->get('paisFactura',''))
        ->setCpRs($data->get('cpFactura',''))
        ->setEstadoRs($data->get('estadoFactura',''))
        ->setDelegacionRs($data->get('delMunFactura',''))
        ->setColoniaRs($data->get('colProFactura',''))
        ->setDireccionRs($data->get('direccionFactura',''))
        ->setTelefonoRs($data->get('telefonoFactura',''))
        ->setFaxRs($data->get('',''))
        ->setEmailRs($data->get('correoFactura',''))
        ->setAceptapoliticas($data->get('acepto'))
        ->setFechareservacion($fechas['now'])
        ->setStatus($data->get('status',''));
        $this->em->persist($miReserva);
        $this->em->flush();
        return $miReserva;
    }

    // seleccionar reservacion
    public function getReservacion($filtros){

    	$consulta = $this->repository['reservaciones']->findOneBy($filtros);

        return $consulta;

    }

    // Actualizar reservacion paypal
    public function cambiarStatusReserva($miReserva,$status){

        $miReserva->setStatus($status);

        $this->em->persist($miReserva);
        $this->em->flush();

        return $miReserva;
    }

  public function setValue($field,$value,$id){
    $q =  $this
            ->qb
            ->update('Entity\ReservacionesReservaciones','rsv')
            ->set('rsv.'. $field, ':v')
            ->where('rsv.idreservacion = :id')
            ->setParameter('v', $value)
            ->setParameter('id', $id)
            ->getQuery();
    return $q->execute();
  }

}
