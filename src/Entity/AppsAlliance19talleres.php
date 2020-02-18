<?php

namespace Entity;

/**
 * AppsAlliance19talleres
 */
class AppsAlliance19talleres
{
    /**
     * @var integer
     */
    private $idTaller;

    /**
     * @var integer
     */
    private $noTaller = '0';

    /**
     * @var string
     */
    private $taller = '';

    /**
     * @var string
     */
    private $hora = '00:00 - 00:00';

    /**
     * @var integer
     */
    private $nHora = '0';

    /**
     * @var string
     */
    private $turno = '';

    /**
     * @var integer
     */
    private $cupo = '0';

    /**
     * @var integer
     */
    private $cupostaff = '0';


    /**
     * Get idTaller
     *
     * @return integer
     */
    public function getIdTaller()
    {
        return $this->idTaller;
    }

    /**
     * Set noTaller
     *
     * @param integer $noTaller
     *
     * @return AppsAlliance19talleres
     */
    public function setNoTaller($noTaller)
    {
        $this->noTaller = $noTaller;

        return $this;
    }

    /**
     * Get noTaller
     *
     * @return integer
     */
    public function getNoTaller()
    {
        return $this->noTaller;
    }

    /**
     * Set taller
     *
     * @param string $taller
     *
     * @return AppsAlliance19talleres
     */
    public function setTaller($taller)
    {
        $this->taller = $taller;

        return $this;
    }

    /**
     * Get taller
     *
     * @return string
     */
    public function getTaller()
    {
        return $this->taller;
    }

    /**
     * Set hora
     *
     * @param string $hora
     *
     * @return AppsAlliance19talleres
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return string
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set nHora
     *
     * @param integer $nHora
     *
     * @return AppsAlliance19talleres
     */
    public function setNHora($nHora)
    {
        $this->nHora = $nHora;

        return $this;
    }

    /**
     * Get nHora
     *
     * @return integer
     */
    public function getNHora()
    {
        return $this->nHora;
    }

    /**
     * Set turno
     *
     * @param string $turno
     *
     * @return AppsAlliance19talleres
     */
    public function setTurno($turno)
    {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get turno
     *
     * @return string
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * Set cupo
     *
     * @param integer $cupo
     *
     * @return AppsAlliance19talleres
     */
    public function setCupo($cupo)
    {
        $this->cupo = $cupo;

        return $this;
    }

    /**
     * Get cupo
     *
     * @return integer
     */
    public function getCupo()
    {
        return $this->cupo;
    }

    /**
     * Set cupostaff
     *
     * @param integer $cupostaff
     *
     * @return AppsAlliance19talleres
     */
    public function setCupostaff($cupostaff)
    {
        $this->cupostaff = $cupostaff;

        return $this;
    }

    /**
     * Get cupostaff
     *
     * @return integer
     */
    public function getCupostaff()
    {
        return $this->cupostaff;
    }
}
