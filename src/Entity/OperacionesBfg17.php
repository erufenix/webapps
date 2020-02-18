<?php

namespace Entity;

/**
 * OperacionesBfg17
 */
class OperacionesBfg17
{
    /**
     * @var integer
     */
    private $idRegistro;

    /**
     * @var string
     */
    private $nombre = '\'\'';

    /**
     * @var string
     */
    private $apellidos = '\'\'';

    /**
     * @var string
     */
    private $correo = '\'\'';

    /**
     * @var string
     */
    private $celular = '\'0\'';

    /**
     * @var string
     */
    private $razonSocial = '\'\'';

    /**
     * @var string
     */
    private $habitacion = '\'\'';

    /**
     * @var string
     */
    private $transporte = '\'\'';

    /**
     * @var \DateTime
     */
    private $fechaLlegada = 'NULL';

    /**
     * @var \DateTime
     */
    private $fechaSalida = 'NULL';

    /**
     * @var string
     */
    private $alergia = '\'\'';

    /**
     * @var string
     */
    private $licenciaEmision = '\'\'';

    /**
     * @var string
     */
    private $licenciaDigitos = '\'0\'';

    /**
     * @var \DateTime
     */
    private $licenciaValida = 'NULL';

    /**
     * @var \DateTime
     */
    private $fechaRegistro = 'NULL';


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
     * @return OperacionesBfg17
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
     * @return OperacionesBfg17
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
     * @return OperacionesBfg17
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
     * @return OperacionesBfg17
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
     * Set razonSocial
     *
     * @param string $razonSocial
     *
     * @return OperacionesBfg17
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    /**
     * Get razonSocial
     *
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Set habitacion
     *
     * @param string $habitacion
     *
     * @return OperacionesBfg17
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
     * Set transporte
     *
     * @param string $transporte
     *
     * @return OperacionesBfg17
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
     * Set fechaLlegada
     *
     * @param \DateTime $fechaLlegada
     *
     * @return OperacionesBfg17
     */
    public function setFechaLlegada($fechaLlegada)
    {
        $this->fechaLlegada = $fechaLlegada;

        return $this;
    }

    /**
     * Get fechaLlegada
     *
     * @return \DateTime
     */
    public function getFechaLlegada()
    {
        return $this->fechaLlegada;
    }

    /**
     * Set fechaSalida
     *
     * @param \DateTime $fechaSalida
     *
     * @return OperacionesBfg17
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    /**
     * Get fechaSalida
     *
     * @return \DateTime
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Set alergia
     *
     * @param string $alergia
     *
     * @return OperacionesBfg17
     */
    public function setAlergia($alergia)
    {
        $this->alergia = $alergia;

        return $this;
    }

    /**
     * Get alergia
     *
     * @return string
     */
    public function getAlergia()
    {
        return $this->alergia;
    }

    /**
     * Set licenciaEmision
     *
     * @param string $licenciaEmision
     *
     * @return OperacionesBfg17
     */
    public function setLicenciaEmision($licenciaEmision)
    {
        $this->licenciaEmision = $licenciaEmision;

        return $this;
    }

    /**
     * Get licenciaEmision
     *
     * @return string
     */
    public function getLicenciaEmision()
    {
        return $this->licenciaEmision;
    }

    /**
     * Set licenciaDigitos
     *
     * @param string $licenciaDigitos
     *
     * @return OperacionesBfg17
     */
    public function setLicenciaDigitos($licenciaDigitos)
    {
        $this->licenciaDigitos = $licenciaDigitos;

        return $this;
    }

    /**
     * Get licenciaDigitos
     *
     * @return string
     */
    public function getLicenciaDigitos()
    {
        return $this->licenciaDigitos;
    }

    /**
     * Set licenciaValida
     *
     * @param \DateTime $licenciaValida
     *
     * @return OperacionesBfg17
     */
    public function setLicenciaValida($licenciaValida)
    {
        $this->licenciaValida = $licenciaValida;

        return $this;
    }

    /**
     * Get licenciaValida
     *
     * @return \DateTime
     */
    public function getLicenciaValida()
    {
        return $this->licenciaValida;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return OperacionesBfg17
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
}
