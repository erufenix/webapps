<?php

namespace Entity;

/**
 * AppsAlliance19
 */
class AppsAlliance19
{
    /**
     * @var integer
     */
    private $idRegistro;

    /**
     * @var integer
     */
    private $idClave = '0';

    /**
     * @var string
     */
    private $tpoNombre = '';

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
    private $celular = '';

    /**
     * @var string
     */
    private $contacto = '';

    /**
     * @var string
     */
    private $distribuidor = '';

    /**
     * @var string
     */
    private $acoNombre = '';

    /**
     * @var string
     */
    private $habitacion = '';

    /**
     * @var integer
     */
    private $ncamas = '0';

    /**
     * @var string
     */
    private $transporte;

    /**
     * @var string
     */
    private $aerolineas;

    /**
     * @var string
     */
    private $nvuelos = '';

    /**
     * @var \DateTime
     */
    private $fechaHoraVuelos;

    /**
     * @var string
     */
    private $aerolineal;

    /**
     * @var string
     */
    private $nveulol = '';

    /**
     * @var \DateTime
     */
    private $fechaHoraVuelol;

    /**
     * @var string
     */
    private $cmVuelo;

    /**
     * @var string
     */
    private $actividad;

    /**
     * @var string
     */
    private $opActividad = '';

    /**
     * @var string
     */
    private $diaActividad;

    /**
     * @var \DateTime
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     */
    private $fechaL;

    /**
     * @var \DateTime
     */
    private $fechaS;

    /**
     * @var string
     */
    private $token = '';

    /**
     * @var string
     */
    private $tipo = '';

    /**
     * @var string
     */
    private $talleres;

    /**
     * @var string
     */
    private $talleresAco;

    /**
     * @var string
     */
    private $comentarios;


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
     * Set idClave
     *
     * @param integer $idClave
     *
     * @return AppsAlliance19
     */
    public function setIdClave($idClave)
    {
        $this->idClave = $idClave;

        return $this;
    }

    /**
     * Get idClave
     *
     * @return integer
     */
    public function getIdClave()
    {
        return $this->idClave;
    }

    /**
     * Set tpoNombre
     *
     * @param string $tpoNombre
     *
     * @return AppsAlliance19
     */
    public function setTpoNombre($tpoNombre)
    {
        $this->tpoNombre = $tpoNombre;

        return $this;
    }

    /**
     * Get tpoNombre
     *
     * @return string
     */
    public function getTpoNombre()
    {
        return $this->tpoNombre;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return AppsAlliance19
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
     * @return AppsAlliance19
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
     * @return AppsAlliance19
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
     * Set celular
     *
     * @param string $celular
     *
     * @return AppsAlliance19
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set contacto
     *
     * @param string $contacto
     *
     * @return AppsAlliance19
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set distribuidor
     *
     * @param string $distribuidor
     *
     * @return AppsAlliance19
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
     * Set acoNombre
     *
     * @param string $acoNombre
     *
     * @return AppsAlliance19
     */
    public function setAcoNombre($acoNombre)
    {
        $this->acoNombre = $acoNombre;

        return $this;
    }

    /**
     * Get acoNombre
     *
     * @return string
     */
    public function getAcoNombre()
    {
        return $this->acoNombre;
    }

    /**
     * Set habitacion
     *
     * @param string $habitacion
     *
     * @return AppsAlliance19
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
     * Set ncamas
     *
     * @param integer $ncamas
     *
     * @return AppsAlliance19
     */
    public function setNcamas($ncamas)
    {
        $this->ncamas = $ncamas;

        return $this;
    }

    /**
     * Get ncamas
     *
     * @return integer
     */
    public function getNcamas()
    {
        return $this->ncamas;
    }

    /**
     * Set transporte
     *
     * @param string $transporte
     *
     * @return AppsAlliance19
     */
    public function setTransporte($transporte)
    {
        $this->transporte = $transporte;

        return $this;
    }

    /**
     * Get transporte
     *
     * @return string
     */
    public function getTransporte()
    {
        return $this->transporte;
    }

    /**
     * Set aerolineas
     *
     * @param string $aerolineas
     *
     * @return AppsAlliance19
     */
    public function setAerolineas($aerolineas)
    {
        $this->aerolineas = $aerolineas;

        return $this;
    }

    /**
     * Get aerolineas
     *
     * @return string
     */
    public function getAerolineas()
    {
        return $this->aerolineas;
    }

    /**
     * Set nvuelos
     *
     * @param string $nvuelos
     *
     * @return AppsAlliance19
     */
    public function setNvuelos($nvuelos)
    {
        $this->nvuelos = $nvuelos;

        return $this;
    }

    /**
     * Get nvuelos
     *
     * @return string
     */
    public function getNvuelos()
    {
        return $this->nvuelos;
    }

    /**
     * Set fechaHoraVuelos
     *
     * @param \DateTime $fechaHoraVuelos
     *
     * @return AppsAlliance19
     */
    public function setFechaHoraVuelos($fechaHoraVuelos)
    {
        $this->fechaHoraVuelos = $fechaHoraVuelos;

        return $this;
    }

    /**
     * Get fechaHoraVuelos
     *
     * @return \DateTime
     */
    public function getFechaHoraVuelos()
    {
        return $this->fechaHoraVuelos;
    }

    /**
     * Set aerolineal
     *
     * @param string $aerolineal
     *
     * @return AppsAlliance19
     */
    public function setAerolineal($aerolineal)
    {
        $this->aerolineal = $aerolineal;

        return $this;
    }

    /**
     * Get aerolineal
     *
     * @return string
     */
    public function getAerolineal()
    {
        return $this->aerolineal;
    }

    /**
     * Set nveulol
     *
     * @param string $nveulol
     *
     * @return AppsAlliance19
     */
    public function setNveulol($nveulol)
    {
        $this->nveulol = $nveulol;

        return $this;
    }

    /**
     * Get nveulol
     *
     * @return string
     */
    public function getNveulol()
    {
        return $this->nveulol;
    }

    /**
     * Set fechaHoraVuelol
     *
     * @param \DateTime $fechaHoraVuelol
     *
     * @return AppsAlliance19
     */
    public function setFechaHoraVuelol($fechaHoraVuelol)
    {
        $this->fechaHoraVuelol = $fechaHoraVuelol;

        return $this;
    }

    /**
     * Get fechaHoraVuelol
     *
     * @return \DateTime
     */
    public function getFechaHoraVuelol()
    {
        return $this->fechaHoraVuelol;
    }

    /**
     * Set cmVuelo
     *
     * @param string $cmVuelo
     *
     * @return AppsAlliance19
     */
    public function setCmVuelo($cmVuelo)
    {
        $this->cmVuelo = $cmVuelo;

        return $this;
    }

    /**
     * Get cmVuelo
     *
     * @return string
     */
    public function getCmVuelo()
    {
        return $this->cmVuelo;
    }

    /**
     * Set actividad
     *
     * @param string $actividad
     *
     * @return AppsAlliance19
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return string
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set opActividad
     *
     * @param string $opActividad
     *
     * @return AppsAlliance19
     */
    public function setOpActividad($opActividad)
    {
        $this->opActividad = $opActividad;

        return $this;
    }

    /**
     * Get opActividad
     *
     * @return string
     */
    public function getOpActividad()
    {
        return $this->opActividad;
    }

    /**
     * Set diaActividad
     *
     * @param string $diaActividad
     *
     * @return AppsAlliance19
     */
    public function setDiaActividad($diaActividad)
    {
        $this->diaActividad = $diaActividad;

        return $this;
    }

    /**
     * Get diaActividad
     *
     * @return string
     */
    public function getDiaActividad()
    {
        return $this->diaActividad;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return AppsAlliance19
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
     * Set fechaL
     *
     * @param \DateTime $fechaL
     *
     * @return AppsAlliance19
     */
    public function setFechaL($fechaL)
    {
        $this->fechaL = $fechaL;

        return $this;
    }

    /**
     * Get fechaL
     *
     * @return \DateTime
     */
    public function getFechaL()
    {
        return $this->fechaL;
    }

    /**
     * Set fechaS
     *
     * @param \DateTime $fechaS
     *
     * @return AppsAlliance19
     */
    public function setFechaS($fechaS)
    {
        $this->fechaS = $fechaS;

        return $this;
    }

    /**
     * Get fechaS
     *
     * @return \DateTime
     */
    public function getFechaS()
    {
        return $this->fechaS;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return AppsAlliance19
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return AppsAlliance19
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set talleres
     *
     * @param string $talleres
     *
     * @return AppsAlliance19
     */
    public function setTalleres($talleres)
    {
        $this->talleres = $talleres;

        return $this;
    }

    /**
     * Get talleres
     *
     * @return string
     */
    public function getTalleres()
    {
        return $this->talleres;
    }

    /**
     * Set talleresAco
     *
     * @param string $talleresAco
     *
     * @return AppsAlliance19
     */
    public function setTalleresAco($talleresAco)
    {
        $this->talleresAco = $talleresAco;

        return $this;
    }

    /**
     * Get talleresAco
     *
     * @return string
     */
    public function getTalleresAco()
    {
        return $this->talleresAco;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     *
     * @return AppsAlliance19
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return string
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }
}
