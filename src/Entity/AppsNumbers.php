<?php

namespace Entity;

/**
 * AppsNumbers
 */
class AppsNumbers
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $correo = '0';

    /**
     * @var integer
     */
    private $numero = '0';

    /**
     * @var string
     */
    private $premio = '';


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set correo
     *
     * @param integer $correo
     *
     * @return AppsNumbers
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return integer
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return AppsNumbers
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set premio
     *
     * @param string $premio
     *
     * @return AppsNumbers
     */
    public function setPremio($premio)
    {
        $this->premio = $premio;

        return $this;
    }

    /**
     * Get premio
     *
     * @return string
     */
    public function getPremio()
    {
        return $this->premio;
    }
}
