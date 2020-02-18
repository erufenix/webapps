<?php

namespace Entity;

/**
 * AppsCitasExCita
 */
class AppsCitasExCita
{
    /**
     * @var integer
     */
    private $idCita;

    /**
     * @var string
     */
    private $nombre = '\'\'';

    /**
     * @var string
     */
    private $correo = '\'\'';

    /**
     * @var string
     */
    private $empresa = '\'\'';

    /**
     * @var string
     */
    private $telefono = '\'\'';

    /**
     * @var string
     */
    private $cita = '\'\'';

    /**
     * @var string
     */
    private $hora = '\'\'';


    /**
     * Get idCita
     *
     * @return integer
     */
    public function getIdCita()
    {
        return $this->idCita;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return AppsCitasExCita
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
     * @return AppsCitasExCita
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
     * Set empresa
     *
     * @param string $empresa
     *
     * @return AppsCitasExCita
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return AppsCitasExCita
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set cita
     *
     * @param string $cita
     *
     * @return AppsCitasExCita
     */
    public function setCita($cita)
    {
        $this->cita = $cita;

        return $this;
    }

    /**
     * Get cita
     *
     * @return string
     */
    public function getCita()
    {
        return $this->cita;
    }

    /**
     * Set hora
     *
     * @param string $hora
     *
     * @return AppsCitasExCita
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
     * @var string
     */
    private $dia = '\'\'';


    /**
     * Set dia
     *
     * @param string $dia
     *
     * @return AppsCitasExCita
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
     * @var integer
     */
    private $mesa = '0';


    /**
     * Set mesa
     *
     * @param integer $mesa
     *
     * @return AppsCitasExCita
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
     * @var boolean
     */
    private $recordatorio = '0';


    /**
     * Set recordatorio
     *
     * @param boolean $recordatorio
     *
     * @return AppsCitasExCita
     */
    public function setRecordatorio($recordatorio)
    {
        $this->recordatorio = $recordatorio;

        return $this;
    }

    /**
     * Get recordatorio
     *
     * @return boolean
     */
    public function getRecordatorio()
    {
        return $this->recordatorio;
    }
}
