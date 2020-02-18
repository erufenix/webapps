<?php

namespace Entity;

/**
 * AppsUpfrontClaves
 */
class AppsUpfrontClaves
{
    /**
     * @var integer
     */
    private $idClave;

    /**
     * @var string
     */
    private $nombre = '\'\'';

    /**
     * @var string
     */
    private $correo = '\'\'';

    /**
     * @var boolean
     */
    private $bloqueada = '0';


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
     * @return AppsUpfrontClaves
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
     * Set correo
     *
     * @param string $correo
     *
     * @return AppsUpfrontClaves
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
     * Set bloqueada
     *
     * @param boolean $bloqueada
     *
     * @return AppsUpfrontClaves
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
}
