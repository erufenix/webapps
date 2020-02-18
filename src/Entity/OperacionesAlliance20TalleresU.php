<?php

namespace Entity;

/**
 * OperacionesAlliance20TalleresU
 */
class OperacionesAlliance20TalleresU
{
    /**
     * @var integer
     */
    private $idTallerU;

    /**
     * @var integer
     */
    private $idRegistro;

    /**
     * @var integer
     */
    private $idTaller = '0';

    /**
     * @var integer
     */
    private $noTaller = '0';

    /**
     * @var string
     */
    private $hrTaller = '\'\'';

    /**
     * @var string
     */
    private $tTaller = '\'\'';

    /**
     * @var string
     */
    private $taller = '\'\'';

    /**
     * @var string
     */
    private $uTaller = '\'\'';


    /**
     * Get idTallerU
     *
     * @return integer
     */
    public function getIdTallerU()
    {
        return $this->idTallerU;
    }

    /**
     * Set idRegistro
     *
     * @param integer $idRegistro
     *
     * @return OperacionesAlliance20TalleresU
     */
    public function setIdRegistro($idRegistro)
    {
        $this->idRegistro = $idRegistro;

        return $this;
    }

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
     * Set idTaller
     *
     * @param integer $idTaller
     *
     * @return OperacionesAlliance20TalleresU
     */
    public function setIdTaller($idTaller)
    {
        $this->idTaller = $idTaller;

        return $this;
    }

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
     * @return OperacionesAlliance20TalleresU
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
     * Set hrTaller
     *
     * @param string $hrTaller
     *
     * @return OperacionesAlliance20TalleresU
     */
    public function setHrTaller($hrTaller)
    {
        $this->hrTaller = $hrTaller;

        return $this;
    }

    /**
     * Get hrTaller
     *
     * @return string
     */
    public function getHrTaller()
    {
        return $this->hrTaller;
    }

    /**
     * Set tTaller
     *
     * @param string $tTaller
     *
     * @return OperacionesAlliance20TalleresU
     */
    public function setTTaller($tTaller)
    {
        $this->tTaller = $tTaller;

        return $this;
    }

    /**
     * Get tTaller
     *
     * @return string
     */
    public function getTTaller()
    {
        return $this->tTaller;
    }

    /**
     * Set taller
     *
     * @param string $taller
     *
     * @return OperacionesAlliance20TalleresU
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
     * Set uTaller
     *
     * @param string $uTaller
     *
     * @return OperacionesAlliance20TalleresU
     */
    public function setUTaller($uTaller)
    {
        $this->uTaller = $uTaller;

        return $this;
    }

    /**
     * Get uTaller
     *
     * @return string
     */
    public function getUTaller()
    {
        return $this->uTaller;
    }
}
