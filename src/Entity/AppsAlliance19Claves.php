<?php

namespace Entity;

/**
 * AppsAlliance19Claves
 */
class AppsAlliance19Claves
{
    /**
     * @var integer
     */
    private $idClave;

    /**
     * @var string
     */
    private $nombre = '';

    /**
     * @var string
     */
    private $distribuidor = '';

    /**
     * @var string
     */
    private $correo = '';

    /**
     * @var string
     */
    private $clave = '';

    /**
     * @var string
     */
    private $tipo = '';

    /**
     * @var boolean
     */
    private $bloqueada = '0';

    /**
     * @var boolean
     */
    private $regDoble = '0';


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return AppsAlliance19Claves
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
     * Set distribuidor
     *
     * @param string $distribuidor
     *
     * @return AppsAlliance19Claves
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
     * Set correo
     *
     * @param string $correo
     *
     * @return AppsAlliance19Claves
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
     * Set clave
     *
     * @param string $clave
     *
     * @return AppsAlliance19Claves
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return AppsAlliance19Claves
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
     * Set bloqueada
     *
     * @param boolean $bloqueada
     *
     * @return AppsAlliance19Claves
     */
    public function setBloqueada($bloqueada)
    {
        $this->bloqueada = $bloqueada;

        return $this;
    }

    /**
     * Get bloqueada
     *
     * @return boolean
     */
    public function getBloqueada()
    {
        return $this->bloqueada;
    }

    /**
     * Set regDoble
     *
     * @param boolean $regDoble
     *
     * @return AppsAlliance19Claves
     */
    public function setRegDoble($regDoble)
    {
        $this->regDoble = $regDoble;

        return $this;
    }

    /**
     * Get regDoble
     *
     * @return boolean
     */
    public function getRegDoble()
    {
        return $this->regDoble;
    }
}
