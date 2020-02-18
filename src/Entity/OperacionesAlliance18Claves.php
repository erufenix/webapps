<?php

namespace Entity;

/**
 * OperacionesAlliance18Claves
 */
class OperacionesAlliance18Claves
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
    private $clave = '\'\'';

    /**
     * @var integer
     */
    private $grupo = '0';

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
     * @return OperacionesAlliance18Claves
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
     * Set clave
     *
     * @param string $clave
     *
     * @return OperacionesAlliance18Claves
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
     * Set grupo
     *
     * @param integer $grupo
     *
     * @return OperacionesAlliance18Claves
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return integer
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set bloqueada
     *
     * @param boolean $bloqueada
     *
     * @return OperacionesAlliance18Claves
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
     * @return OperacionesAlliance18Claves
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
