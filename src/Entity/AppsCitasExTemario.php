<?php

namespace Entity;

/**
 * AppsCitasExTemario
 */
class AppsCitasExTemario
{
    /**
     * @var integer
     */
    private $idTemario;

    /**
     * @var integer
     */
    private $noTema = '0';

    /**
     * @var string
     */
    private $tema = '\'\'';

    /**
     * @var integer
     */
    private $noSubtema = '0';

    /**
     * @var string
     */
    private $subtema = '\'\'';

    /**
     * @var integer
     */
    private $mesa = '0';

    /**
     * @var string
     */
    private $dia = '\'\'';

    /**
     * @var \DateTime
     */
    private $hora = 'NULL';

    /**
     * @var integer
     */
    private $bloqueada = '0';


    /**
     * Get idTemario
     *
     * @return integer
     */
    public function getIdTemario()
    {
        return $this->idTemario;
    }

    /**
     * Set noTema
     *
     * @param integer $noTema
     *
     * @return AppsCitasExTemario
     */
    public function setNoTema($noTema)
    {
        $this->noTema = $noTema;

        return $this;
    }

    /**
     * Get noTema
     *
     * @return integer
     */
    public function getNoTema()
    {
        return $this->noTema;
    }

    /**
     * Set tema
     *
     * @param string $tema
     *
     * @return AppsCitasExTemario
     */
    public function setTema($tema)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return string
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set noSubtema
     *
     * @param integer $noSubtema
     *
     * @return AppsCitasExTemario
     */
    public function setNoSubtema($noSubtema)
    {
        $this->noSubtema = $noSubtema;

        return $this;
    }

    /**
     * Get noSubtema
     *
     * @return integer
     */
    public function getNoSubtema()
    {
        return $this->noSubtema;
    }

    /**
     * Set subtema
     *
     * @param string $subtema
     *
     * @return AppsCitasExTemario
     */
    public function setSubtema($subtema)
    {
        $this->subtema = $subtema;

        return $this;
    }

    /**
     * Get subtema
     *
     * @return string
     */
    public function getSubtema()
    {
        return $this->subtema;
    }

    /**
     * Set mesa
     *
     * @param integer $mesa
     *
     * @return AppsCitasExTemario
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
     * Set dia
     *
     * @param string $dia
     *
     * @return AppsCitasExTemario
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return string
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set hora
     *
     * @param \DateTime $hora
     *
     * @return AppsCitasExTemario
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set bloqueada
     *
     * @param integer $bloqueada
     *
     * @return AppsCitasExTemario
     */
    public function setBloqueada($bloqueada)
    {
        $this->bloqueada = $bloqueada;

        return $this;
    }

    /**
     * Get bloqueada
     *
     * @return integer
     */
    public function getBloqueada()
    {
        return $this->bloqueada;
    }
}
