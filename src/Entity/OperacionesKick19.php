<?php

namespace Entity;

/**
 * OperacionesKick19
 */
class OperacionesKick19
{
    /**
     * @var integer
     */
    private $idRegistro;

    /**
     * @var string
     */
    private $nombre = '';

    /**
     * @var string
     */
    private $apellidos = '';

    /**
     * @var string
     */
    private $correo = '';

    /**
     * @var string
     */
    private $telefono = '';

    /**
     * @var string
     */
    private $distribuidor;

    /**
     * @var string
     */
    private $puesto = '';

    /**
     * @var string
     */
    private $facturaRs = '';

    /**
     * @var string
     */
    private $facturaRfc;

    /**
     * @var string
     */
    private $facturaCorreo;

    /**
     * @var string
     */
    private $facturaDireccion;

    /**
     * @var string
     */
    private $facturaPago;

    /**
     * @var string
     */
    private $llegadaNvuelo = '';

    /**
     * @var string
     */
    private $llegadaAerolinea = '';

    /**
     * @var \DateTime
     */
    private $llegadaFecha;

    /**
     * @var string
     */
    private $salidaNvuelo = '';

    /**
     * @var string
     */
    private $salidaAerolinea = '';

    /**
     * @var \DateTime
     */
    private $salidaFecha;

    /**
     * @var string
     */
    private $habitacion = '';

    /**
     * @var \DateTime
     */
    private $fechaRegistro;

    /**
     * @var string
     */
    private $tx = '0';


    /**
     * Get idRegistro
     *
     * @return integer
     */
    public function getIdRegistro()
    {
        return $this->idRegistro;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return OperacionesKick19
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return OperacionesKick19
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return OperacionesKick19
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return OperacionesKick19
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set distribuidor
     *
     * @param string $distribuidor
     *
     * @return OperacionesKick19
     */
    public function setDistribuidor($distribuidor)
    {
        $this->distribuidor = $distribuidor;

        return $this;
    }

    /**
     * Get distribuidor
     *
     * @return string
     */
    public function getDistribuidor()
    {
        return $this->distribuidor;
    }

    /**
     * Set puesto
     *
     * @param string $puesto
     *
     * @return OperacionesKick19
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;

        return $this;
    }

    /**
     * Get puesto
     *
     * @return string
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set facturaRs
     *
     * @param string $facturaRs
     *
     * @return OperacionesKick19
     */
    public function setFacturaRs($facturaRs)
    {
        $this->facturaRs = $facturaRs;

        return $this;
    }

    /**
     * Get facturaRs
     *
     * @return string
     */
    public function getFacturaRs()
    {
        return $this->facturaRs;
    }

    /**
     * Set facturaRfc
     *
     * @param string $facturaRfc
     *
     * @return OperacionesKick19
     */
    public function setFacturaRfc($facturaRfc)
    {
        $this->facturaRfc = $facturaRfc;

        return $this;
    }

    /**
     * Get facturaRfc
     *
     * @return string
     */
    public function getFacturaRfc()
    {
        return $this->facturaRfc;
    }

    /**
     * Set facturaCorreo
     *
     * @param string $facturaCorreo
     *
     * @return OperacionesKick19
     */
    public function setFacturaCorreo($facturaCorreo)
    {
        $this->facturaCorreo = $facturaCorreo;

        return $this;
    }

    /**
     * Get facturaCorreo
     *
     * @return string
     */
    public function getFacturaCorreo()
    {
        return $this->facturaCorreo;
    }

    /**
     * Set facturaDireccion
     *
     * @param string $facturaDireccion
     *
     * @return OperacionesKick19
     */
    public function setFacturaDireccion($facturaDireccion)
    {
        $this->facturaDireccion = $facturaDireccion;

        return $this;
    }

    /**
     * Get facturaDireccion
     *
     * @return string
     */
    public function getFacturaDireccion()
    {
        return $this->facturaDireccion;
    }

    /**
     * Set facturaPago
     *
     * @param string $facturaPago
     *
     * @return OperacionesKick19
     */
    public function setFacturaPago($facturaPago)
    {
        $this->facturaPago = $facturaPago;

        return $this;
    }

    /**
     * Get facturaPago
     *
     * @return string
     */
    public function getFacturaPago()
    {
        return $this->facturaPago;
    }

    /**
     * Set llegadaNvuelo
     *
     * @param string $llegadaNvuelo
     *
     * @return OperacionesKick19
     */
    public function setLlegadaNvuelo($llegadaNvuelo)
    {
        $this->llegadaNvuelo = $llegadaNvuelo;

        return $this;
    }

    /**
     * Get llegadaNvuelo
     *
     * @return string
     */
    public function getLlegadaNvuelo()
    {
        return $this->llegadaNvuelo;
    }

    /**
     * Set llegadaAerolinea
     *
     * @param string $llegadaAerolinea
     *
     * @return OperacionesKick19
     */
    public function setLlegadaAerolinea($llegadaAerolinea)
    {
        $this->llegadaAerolinea = $llegadaAerolinea;

        return $this;
    }

    /**
     * Get llegadaAerolinea
     *
     * @return string
     */
    public function getLlegadaAerolinea()
    {
        return $this->llegadaAerolinea;
    }

    /**
     * Set llegadaFecha
     *
     * @param \DateTime $llegadaFecha
     *
     * @return OperacionesKick19
     */
    public function setLlegadaFecha($llegadaFecha)
    {
        $this->llegadaFecha = $llegadaFecha;

        return $this;
    }

    /**
     * Get llegadaFecha
     *
     * @return \DateTime
     */
    public function getLlegadaFecha()
    {
        return $this->llegadaFecha;
    }

    /**
     * Set salidaNvuelo
     *
     * @param string $salidaNvuelo
     *
     * @return OperacionesKick19
     */
    public function setSalidaNvuelo($salidaNvuelo)
    {
        $this->salidaNvuelo = $salidaNvuelo;

        return $this;
    }

    /**
     * Get salidaNvuelo
     *
     * @return string
     */
    public function getSalidaNvuelo()
    {
        return $this->salidaNvuelo;
    }

    /**
     * Set salidaAerolinea
     *
     * @param string $salidaAerolinea
     *
     * @return OperacionesKick19
     */
    public function setSalidaAerolinea($salidaAerolinea)
    {
        $this->salidaAerolinea = $salidaAerolinea;

        return $this;
    }

    /**
     * Get salidaAerolinea
     *
     * @return string
     */
    public function getSalidaAerolinea()
    {
        return $this->salidaAerolinea;
    }

    /**
     * Set salidaFecha
     *
     * @param \DateTime $salidaFecha
     *
     * @return OperacionesKick19
     */
    public function setSalidaFecha($salidaFecha)
    {
        $this->salidaFecha = $salidaFecha;

        return $this;
    }

    /**
     * Get salidaFecha
     *
     * @return \DateTime
     */
    public function getSalidaFecha()
    {
        return $this->salidaFecha;
    }

    /**
     * Set habitacion
     *
     * @param string $habitacion
     *
     * @return OperacionesKick19
     */
    public function setHabitacion($habitacion)
    {
        $this->habitacion = $habitacion;

        return $this;
    }

    /**
     * Get habitacion
     *
     * @return string
     */
    public function getHabitacion()
    {
        return $this->habitacion;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return OperacionesKick19
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set tx
     *
     * @param string $tx
     *
     * @return OperacionesKick19
     */
    public function setTx($tx)
    {
        $this->tx = $tx;

        return $this;
    }

    /**
     * Get tx
     *
     * @return string
     */
    public function getTx()
    {
        return $this->tx;
    }
    /**
     * @var string
     */
    private $nombreAco = '';

    /**
     * @var string
     */
    private $apellidosAco = '';

    /**
     * @var string
     */
    private $correoAco = '';

    /**
     * @var string
     */
    private $puestoAco;

    /**
     * @var string
     */
    private $tot = '';


    /**
     * Set nombreAco
     *
     * @param string $nombreAco
     *
     * @return OperacionesKick19
     */
    public function setNombreAco($nombreAco)
    {
        $this->nombreAco = $nombreAco;

        return $this;
    }

    /**
     * Get nombreAco
     *
     * @return string
     */
    public function getNombreAco()
    {
        return $this->nombreAco;
    }

    /**
     * Set apellidosAco
     *
     * @param string $apellidosAco
     *
     * @return OperacionesKick19
     */
    public function setApellidosAco($apellidosAco)
    {
        $this->apellidosAco = $apellidosAco;

        return $this;
    }

    /**
     * Get apellidosAco
     *
     * @return string
     */
    public function getApellidosAco()
    {
        return $this->apellidosAco;
    }

    /**
     * Set correoAco
     *
     * @param string $correoAco
     *
     * @return OperacionesKick19
     */
    public function setCorreoAco($correoAco)
    {
        $this->correoAco = $correoAco;

        return $this;
    }

    /**
     * Get correoAco
     *
     * @return string
     */
    public function getCorreoAco()
    {
        return $this->correoAco;
    }

    /**
     * Set puestoAco
     *
     * @param string $puestoAco
     *
     * @return OperacionesKick19
     */
    public function setPuestoAco($puestoAco)
    {
        $this->puestoAco = $puestoAco;

        return $this;
    }

    /**
     * Get puestoAco
     *
     * @return string
     */
    public function getPuestoAco()
    {
        return $this->puestoAco;
    }

    /**
     * Set tot
     *
     * @param string $tot
     *
     * @return OperacionesKick19
     */
    public function setTot($tot)
    {
        $this->tot = $tot;

        return $this;
    }

    /**
     * Get tot
     *
     * @return string
     */
    public function getTot()
    {
        return $this->tot;
    }
    /**
     * @var string
     */
    private $facturaCp = '';

    /**
     * @var string
     */
    private $facturaEdo = '';


    /**
     * Set facturaCp
     *
     * @param string $facturaCp
     *
     * @return OperacionesKick19
     */
    public function setFacturaCp($facturaCp)
    {
        $this->facturaCp = $facturaCp;

        return $this;
    }

    /**
     * Get facturaCp
     *
     * @return string
     */
    public function getFacturaCp()
    {
        return $this->facturaCp;
    }

    /**
     * Set facturaEdo
     *
     * @param string $facturaEdo
     *
     * @return OperacionesKick19
     */
    public function setFacturaEdo($facturaEdo)
    {
        $this->facturaEdo = $facturaEdo;

        return $this;
    }

    /**
     * Get facturaEdo
     *
     * @return string
     */
    public function getFacturaEdo()
    {
        return $this->facturaEdo;
    }
    /**
     * @var string
     */
    private $facturaCiudad = '';


    /**
     * Set facturaCiudad
     *
     * @param string $facturaCiudad
     *
     * @return OperacionesKick19
     */
    public function setFacturaCiudad($facturaCiudad)
    {
        $this->facturaCiudad = $facturaCiudad;

        return $this;
    }

    /**
     * Get facturaCiudad
     *
     * @return string
     */
    public function getFacturaCiudad()
    {
        return $this->facturaCiudad;
    }
    /**
     * @var string
     */
    private $llegadaNvueloAco = '';

    /**
     * @var string
     */
    private $llegadaAerolineaAco = '';

    /**
     * @var \DateTime
     */
    private $llegadaFechaAco;

    /**
     * @var string
     */
    private $salidaNvueloAco = '';

    /**
     * @var string
     */
    private $salidaAerolineaAco = '';

    /**
     * @var \DateTime
     */
    private $salidaFechaAco;


    /**
     * Set llegadaNvueloAco
     *
     * @param string $llegadaNvueloAco
     *
     * @return OperacionesKick19
     */
    public function setLlegadaNvueloAco($llegadaNvueloAco)
    {
        $this->llegadaNvueloAco = $llegadaNvueloAco;

        return $this;
    }

    /**
     * Get llegadaNvueloAco
     *
     * @return string
     */
    public function getLlegadaNvueloAco()
    {
        return $this->llegadaNvueloAco;
    }

    /**
     * Set llegadaAerolineaAco
     *
     * @param string $llegadaAerolineaAco
     *
     * @return OperacionesKick19
     */
    public function setLlegadaAerolineaAco($llegadaAerolineaAco)
    {
        $this->llegadaAerolineaAco = $llegadaAerolineaAco;

        return $this;
    }

    /**
     * Get llegadaAerolineaAco
     *
     * @return string
     */
    public function getLlegadaAerolineaAco()
    {
        return $this->llegadaAerolineaAco;
    }

    /**
     * Set llegadaFechaAco
     *
     * @param \DateTime $llegadaFechaAco
     *
     * @return OperacionesKick19
     */
    public function setLlegadaFechaAco($llegadaFechaAco)
    {
        $this->llegadaFechaAco = $llegadaFechaAco;

        return $this;
    }

    /**
     * Get llegadaFechaAco
     *
     * @return \DateTime
     */
    public function getLlegadaFechaAco()
    {
        return $this->llegadaFechaAco;
    }

    /**
     * Set salidaNvueloAco
     *
     * @param string $salidaNvueloAco
     *
     * @return OperacionesKick19
     */
    public function setSalidaNvueloAco($salidaNvueloAco)
    {
        $this->salidaNvueloAco = $salidaNvueloAco;

        return $this;
    }

    /**
     * Get salidaNvueloAco
     *
     * @return string
     */
    public function getSalidaNvueloAco()
    {
        return $this->salidaNvueloAco;
    }

    /**
     * Set salidaAerolineaAco
     *
     * @param string $salidaAerolineaAco
     *
     * @return OperacionesKick19
     */
    public function setSalidaAerolineaAco($salidaAerolineaAco)
    {
        $this->salidaAerolineaAco = $salidaAerolineaAco;

        return $this;
    }

    /**
     * Get salidaAerolineaAco
     *
     * @return string
     */
    public function getSalidaAerolineaAco()
    {
        return $this->salidaAerolineaAco;
    }

    /**
     * Set salidaFechaAco
     *
     * @param \DateTime $salidaFechaAco
     *
     * @return OperacionesKick19
     */
    public function setSalidaFechaAco($salidaFechaAco)
    {
        $this->salidaFechaAco = $salidaFechaAco;

        return $this;
    }

    /**
     * Get salidaFechaAco
     *
     * @return \DateTime
     */
    public function getSalidaFechaAco()
    {
        return $this->salidaFechaAco;
    }
}
