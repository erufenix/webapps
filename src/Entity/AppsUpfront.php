<?php

namespace Entity;

/**
 * AppsUpfront
 */
class AppsUpfront
{
    /**
     * @var integer
     */
    private $idUpfront;

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
     * @var \DateTime
     */
    private $fechaRegistro = 'NULL';

    /**
     * @var string
     */
    private $folio = '\'\'';


    /**
     * Get idUpfront
     *
     * @return integer
     */
    public function getIdUpfront()
    {
        return $this->idUpfront;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return AppsUpfront
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
     * @return AppsUpfront
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
     * @return AppsUpfront
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return AppsUpfront
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
     * Set folio
     *
     * @param string $folio
     *
     * @return AppsUpfront
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;

        return $this;
    }

    /**
     * Get folio
     *
     * @return string
     */
    public function getFolio()
    {
        return $this->folio;
    }
    /**
     * @var integer
     */
    private $idClave = '0';


    /**
     * Set idClave
     *
     * @param integer $idClave
     *
     * @return AppsUpfront
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
     * @var integer
     */
    private $mesa = '0';

    /**
     * @var integer
     */
    private $silla = '0';

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var \DateTime
     */
    private $entrada = 'NULL';


    /**
     * Set mesa
     *
     * @param integer $mesa
     *
     * @return AppsUpfront
     */
    public function setMesa($mesa)
    {
        $this->mesa = $mesa;

        return $this;
    }

    /**
     * Get mesa
     *
     * @return integer
     */
    public function getMesa()
    {
        return $this->mesa;
    }

    /**
     * Set silla
     *
     * @param integer $silla
     *
     * @return AppsUpfront
     */
    public function setSilla($silla)
    {
        $this->silla = $silla;

        return $this;
    }

    /**
     * Get silla
     *
     * @return integer
     */
    public function getSilla()
    {
        return $this->silla;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return AppsUpfront
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set entrada
     *
     * @param \DateTime $entrada
     *
     * @return AppsUpfront
     */
    public function setEntrada($entrada)
    {
        $this->entrada = $entrada;

        return $this;
    }

    /**
     * Get entrada
     *
     * @return \DateTime
     */
    public function getEntrada()
    {
        return $this->entrada;
    }
}
