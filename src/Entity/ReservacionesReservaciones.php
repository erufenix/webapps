<?php

namespace Entity;

/**
 * ReservacionesReservaciones
 */
class ReservacionesReservaciones
{
    /**
     * @var integer
     */
    private $idreservacion;

    /**
     * @var string
     */
    private $claveevento;

    /**
     * @var string
     */
    private $clavereservacion;

    /**
     * @var string
     */
    private $idioma;

    /**
     * @var string
     */
    private $nombreevento;

    /**
     * @var string
     */
    private $fechaevento;

    /**
     * @var string
     */
    private $sedeevento;

    /**
     * @var string
     */
    private $nombrehotel;

    /**
     * @var string
     */
    private $tipohabitacion;

    /**
     * @var string
     */
    private $pagapor;

    /**
     * @var integer
     */
    private $diaspago = '0';

    /**
     * @var string
     */
    private $costonoche;

    /**
     * @var string
     */
    private $cargobellboys;

    /**
     * @var string
     */
    private $cargototal;

    /**
     * @var string
     */
    private $divisa;

    /**
     * @var string
     */
    private $operador;

    /**
     * @var \DateTime
     */
    private $fechallegada;

    /**
     * @var \DateTime
     */
    private $fechasalida;

    /**
     * @var string
     */
    private $formapago;

    /**
     * @var integer
     */
    private $sTransm;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $app;

    /**
     * @var string
     */
    private $apm;

    /**
     * @var string
     */
    private $pais;

    /**
     * @var string
     */
    private $cp;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var string
     */
    private $colonia;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $telmovil;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $acompanantes;

    /**
     * @var string
     */
    private $comentarios;

    /**
     * @var string
     */
    private $requierefactura;

    /**
     * @var string
     */
    private $razonsocialRs;

    /**
     * @var string
     */
    private $rfcRs;

    /**
     * @var string
     */
    private $paisRs;

    /**
     * @var string
     */
    private $cpRs;

    /**
     * @var string
     */
    private $estadoRs;

    /**
     * @var string
     */
    private $delegacionRs;

    /**
     * @var string
     */
    private $coloniaRs;

    /**
     * @var string
     */
    private $direccionRs;

    /**
     * @var string
     */
    private $telefonoRs;

    /**
     * @var string
     */
    private $faxRs;

    /**
     * @var string
     */
    private $emailRs;

    /**
     * @var boolean
     */
    private $aceptapoliticas;

    /**
     * @var \DateTime
     */
    private $fechareservacion;

    /**
     * @var string
     */
    private $requireSeguro = 'No';

    /**
     * @var string
     */
    private $seguroViajero;

    /**
     * @var \DateTime
     */
    private $fechaNacimiento;

    /**
     * @var string
     */
    private $tipoViaje;

    /**
     * @var string
     */
    private $beneficiario1;

    /**
     * @var string
     */
    private $parentesco1;

    /**
     * @var string
     */
    private $porcentaje1;

    /**
     * @var string
     */
    private $beneficiario2;

    /**
     * @var string
     */
    private $parentesco2;

    /**
     * @var string
     */
    private $porcentaje2;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $tx = '';


    /**
     * Get idreservacion
     *
     * @return integer
     */
    public function getIdreservacion()
    {
        return $this->idreservacion;
    }

    /**
     * Set claveevento
     *
     * @param string $claveevento
     *
     * @return ReservacionesReservaciones
     */
    public function setClaveevento($claveevento)
    {
        $this->claveevento = $claveevento;

        return $this;
    }

    /**
     * Get claveevento
     *
     * @return string
     */
    public function getClaveevento()
    {
        return $this->claveevento;
    }

    /**
     * Set clavereservacion
     *
     * @param string $clavereservacion
     *
     * @return ReservacionesReservaciones
     */
    public function setClavereservacion($clavereservacion)
    {
        $this->clavereservacion = $clavereservacion;

        return $this;
    }

    /**
     * Get clavereservacion
     *
     * @return string
     */
    public function getClavereservacion()
    {
        return $this->clavereservacion;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     *
     * @return ReservacionesReservaciones
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;

        return $this;
    }

    /**
     * Get idioma
     *
     * @return string
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set nombreevento
     *
     * @param string $nombreevento
     *
     * @return ReservacionesReservaciones
     */
    public function setNombreevento($nombreevento)
    {
        $this->nombreevento = $nombreevento;

        return $this;
    }

    /**
     * Get nombreevento
     *
     * @return string
     */
    public function getNombreevento()
    {
        return $this->nombreevento;
    }

    /**
     * Set fechaevento
     *
     * @param string $fechaevento
     *
     * @return ReservacionesReservaciones
     */
    public function setFechaevento($fechaevento)
    {
        $this->fechaevento = $fechaevento;

        return $this;
    }

    /**
     * Get fechaevento
     *
     * @return string
     */
    public function getFechaevento()
    {
        return $this->fechaevento;
    }

    /**
     * Set sedeevento
     *
     * @param string $sedeevento
     *
     * @return ReservacionesReservaciones
     */
    public function setSedeevento($sedeevento)
    {
        $this->sedeevento = $sedeevento;

        return $this;
    }

    /**
     * Get sedeevento
     *
     * @return string
     */
    public function getSedeevento()
    {
        return $this->sedeevento;
    }

    /**
     * Set nombrehotel
     *
     * @param string $nombrehotel
     *
     * @return ReservacionesReservaciones
     */
    public function setNombrehotel($nombrehotel)
    {
        $this->nombrehotel = $nombrehotel;

        return $this;
    }

    /**
     * Get nombrehotel
     *
     * @return string
     */
    public function getNombrehotel()
    {
        return $this->nombrehotel;
    }

    /**
     * Set tipohabitacion
     *
     * @param string $tipohabitacion
     *
     * @return ReservacionesReservaciones
     */
    public function setTipohabitacion($tipohabitacion)
    {
        $this->tipohabitacion = $tipohabitacion;

        return $this;
    }

    /**
     * Get tipohabitacion
     *
     * @return string
     */
    public function getTipohabitacion()
    {
        return $this->tipohabitacion;
    }

    /**
     * Set pagapor
     *
     * @param string $pagapor
     *
     * @return ReservacionesReservaciones
     */
    public function setPagapor($pagapor)
    {
        $this->pagapor = $pagapor;

        return $this;
    }

    /**
     * Get pagapor
     *
     * @return string
     */
    public function getPagapor()
    {
        return $this->pagapor;
    }

    /**
     * Set diaspago
     *
     * @param integer $diaspago
     *
     * @return ReservacionesReservaciones
     */
    public function setDiaspago($diaspago)
    {
        $this->diaspago = $diaspago;

        return $this;
    }

    /**
     * Get diaspago
     *
     * @return integer
     */
    public function getDiaspago()
    {
        return $this->diaspago;
    }

    /**
     * Set costonoche
     *
     * @param string $costonoche
     *
     * @return ReservacionesReservaciones
     */
    public function setCostonoche($costonoche)
    {
        $this->costonoche = $costonoche;

        return $this;
    }

    /**
     * Get costonoche
     *
     * @return string
     */
    public function getCostonoche()
    {
        return $this->costonoche;
    }

    /**
     * Set cargobellboys
     *
     * @param string $cargobellboys
     *
     * @return ReservacionesReservaciones
     */
    public function setCargobellboys($cargobellboys)
    {
        $this->cargobellboys = $cargobellboys;

        return $this;
    }

    /**
     * Get cargobellboys
     *
     * @return string
     */
    public function getCargobellboys()
    {
        return $this->cargobellboys;
    }

    /**
     * Set cargototal
     *
     * @param string $cargototal
     *
     * @return ReservacionesReservaciones
     */
    public function setCargototal($cargototal)
    {
        $this->cargototal = $cargototal;

        return $this;
    }

    /**
     * Get cargototal
     *
     * @return string
     */
    public function getCargototal()
    {
        return $this->cargototal;
    }

    /**
     * Set divisa
     *
     * @param string $divisa
     *
     * @return ReservacionesReservaciones
     */
    public function setDivisa($divisa)
    {
        $this->divisa = $divisa;

        return $this;
    }

    /**
     * Get divisa
     *
     * @return string
     */
    public function getDivisa()
    {
        return $this->divisa;
    }

    /**
     * Set operador
     *
     * @param string $operador
     *
     * @return ReservacionesReservaciones
     */
    public function setOperador($operador)
    {
        $this->operador = $operador;

        return $this;
    }

    /**
     * Get operador
     *
     * @return string
     */
    public function getOperador()
    {
        return $this->operador;
    }

    /**
     * Set fechallegada
     *
     * @param \DateTime $fechallegada
     *
     * @return ReservacionesReservaciones
     */
    public function setFechallegada($fechallegada)
    {
        $this->fechallegada = $fechallegada;

        return $this;
    }

    /**
     * Get fechallegada
     *
     * @return \DateTime
     */
    public function getFechallegada()
    {
        return $this->fechallegada;
    }

    /**
     * Set fechasalida
     *
     * @param \DateTime $fechasalida
     *
     * @return ReservacionesReservaciones
     */
    public function setFechasalida($fechasalida)
    {
        $this->fechasalida = $fechasalida;

        return $this;
    }

    /**
     * Get fechasalida
     *
     * @return \DateTime
     */
    public function getFechasalida()
    {
        return $this->fechasalida;
    }

    /**
     * Set formapago
     *
     * @param string $formapago
     *
     * @return ReservacionesReservaciones
     */
    public function setFormapago($formapago)
    {
        $this->formapago = $formapago;

        return $this;
    }

    /**
     * Get formapago
     *
     * @return string
     */
    public function getFormapago()
    {
        return $this->formapago;
    }

    /**
     * Set sTransm
     *
     * @param integer $sTransm
     *
     * @return ReservacionesReservaciones
     */
    public function setSTransm($sTransm)
    {
        $this->sTransm = $sTransm;

        return $this;
    }

    /**
     * Get sTransm
     *
     * @return integer
     */
    public function getSTransm()
    {
        return $this->sTransm;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ReservacionesReservaciones
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
     * Set app
     *
     * @param string $app
     *
     * @return ReservacionesReservaciones
     */
    public function setApp($app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Get app
     *
     * @return string
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Set apm
     *
     * @param string $apm
     *
     * @return ReservacionesReservaciones
     */
    public function setApm($apm)
    {
        $this->apm = $apm;

        return $this;
    }

    /**
     * Get apm
     *
     * @return string
     */
    public function getApm()
    {
        return $this->apm;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return ReservacionesReservaciones
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return ReservacionesReservaciones
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return ReservacionesReservaciones
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set colonia
     *
     * @param string $colonia
     *
     * @return ReservacionesReservaciones
     */
    public function setColonia($colonia)
    {
        $this->colonia = $colonia;

        return $this;
    }

    /**
     * Get colonia
     *
     * @return string
     */
    public function getColonia()
    {
        return $this->colonia;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return ReservacionesReservaciones
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return ReservacionesReservaciones
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
     * Set telmovil
     *
     * @param string $telmovil
     *
     * @return ReservacionesReservaciones
     */
    public function setTelmovil($telmovil)
    {
        $this->telmovil = $telmovil;

        return $this;
    }

    /**
     * Get telmovil
     *
     * @return string
     */
    public function getTelmovil()
    {
        return $this->telmovil;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ReservacionesReservaciones
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set acompanantes
     *
     * @param string $acompanantes
     *
     * @return ReservacionesReservaciones
     */
    public function setAcompanantes($acompanantes)
    {
        $this->acompanantes = $acompanantes;

        return $this;
    }

    /**
     * Get acompanantes
     *
     * @return string
     */
    public function getAcompanantes()
    {
        return $this->acompanantes;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     *
     * @return ReservacionesReservaciones
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return string
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set requierefactura
     *
     * @param string $requierefactura
     *
     * @return ReservacionesReservaciones
     */
    public function setRequierefactura($requierefactura)
    {
        $this->requierefactura = $requierefactura;

        return $this;
    }

    /**
     * Get requierefactura
     *
     * @return string
     */
    public function getRequierefactura()
    {
        return $this->requierefactura;
    }

    /**
     * Set razonsocialRs
     *
     * @param string $razonsocialRs
     *
     * @return ReservacionesReservaciones
     */
    public function setRazonsocialRs($razonsocialRs)
    {
        $this->razonsocialRs = $razonsocialRs;

        return $this;
    }

    /**
     * Get razonsocialRs
     *
     * @return string
     */
    public function getRazonsocialRs()
    {
        return $this->razonsocialRs;
    }

    /**
     * Set rfcRs
     *
     * @param string $rfcRs
     *
     * @return ReservacionesReservaciones
     */
    public function setRfcRs($rfcRs)
    {
        $this->rfcRs = $rfcRs;

        return $this;
    }

    /**
     * Get rfcRs
     *
     * @return string
     */
    public function getRfcRs()
    {
        return $this->rfcRs;
    }

    /**
     * Set paisRs
     *
     * @param string $paisRs
     *
     * @return ReservacionesReservaciones
     */
    public function setPaisRs($paisRs)
    {
        $this->paisRs = $paisRs;

        return $this;
    }

    /**
     * Get paisRs
     *
     * @return string
     */
    public function getPaisRs()
    {
        return $this->paisRs;
    }

    /**
     * Set cpRs
     *
     * @param string $cpRs
     *
     * @return ReservacionesReservaciones
     */
    public function setCpRs($cpRs)
    {
        $this->cpRs = $cpRs;

        return $this;
    }

    /**
     * Get cpRs
     *
     * @return string
     */
    public function getCpRs()
    {
        return $this->cpRs;
    }

    /**
     * Set estadoRs
     *
     * @param string $estadoRs
     *
     * @return ReservacionesReservaciones
     */
    public function setEstadoRs($estadoRs)
    {
        $this->estadoRs = $estadoRs;

        return $this;
    }

    /**
     * Get estadoRs
     *
     * @return string
     */
    public function getEstadoRs()
    {
        return $this->estadoRs;
    }

    /**
     * Set delegacionRs
     *
     * @param string $delegacionRs
     *
     * @return ReservacionesReservaciones
     */
    public function setDelegacionRs($delegacionRs)
    {
        $this->delegacionRs = $delegacionRs;

        return $this;
    }

    /**
     * Get delegacionRs
     *
     * @return string
     */
    public function getDelegacionRs()
    {
        return $this->delegacionRs;
    }

    /**
     * Set coloniaRs
     *
     * @param string $coloniaRs
     *
     * @return ReservacionesReservaciones
     */
    public function setColoniaRs($coloniaRs)
    {
        $this->coloniaRs = $coloniaRs;

        return $this;
    }

    /**
     * Get coloniaRs
     *
     * @return string
     */
    public function getColoniaRs()
    {
        return $this->coloniaRs;
    }

    /**
     * Set direccionRs
     *
     * @param string $direccionRs
     *
     * @return ReservacionesReservaciones
     */
    public function setDireccionRs($direccionRs)
    {
        $this->direccionRs = $direccionRs;

        return $this;
    }

    /**
     * Get direccionRs
     *
     * @return string
     */
    public function getDireccionRs()
    {
        return $this->direccionRs;
    }

    /**
     * Set telefonoRs
     *
     * @param string $telefonoRs
     *
     * @return ReservacionesReservaciones
     */
    public function setTelefonoRs($telefonoRs)
    {
        $this->telefonoRs = $telefonoRs;

        return $this;
    }

    /**
     * Get telefonoRs
     *
     * @return string
     */
    public function getTelefonoRs()
    {
        return $this->telefonoRs;
    }

    /**
     * Set faxRs
     *
     * @param string $faxRs
     *
     * @return ReservacionesReservaciones
     */
    public function setFaxRs($faxRs)
    {
        $this->faxRs = $faxRs;

        return $this;
    }

    /**
     * Get faxRs
     *
     * @return string
     */
    public function getFaxRs()
    {
        return $this->faxRs;
    }

    /**
     * Set emailRs
     *
     * @param string $emailRs
     *
     * @return ReservacionesReservaciones
     */
    public function setEmailRs($emailRs)
    {
        $this->emailRs = $emailRs;

        return $this;
    }

    /**
     * Get emailRs
     *
     * @return string
     */
    public function getEmailRs()
    {
        return $this->emailRs;
    }

    /**
     * Set aceptapoliticas
     *
     * @param boolean $aceptapoliticas
     *
     * @return ReservacionesReservaciones
     */
    public function setAceptapoliticas($aceptapoliticas)
    {
        $this->aceptapoliticas = $aceptapoliticas;

        return $this;
    }

    /**
     * Get aceptapoliticas
     *
     * @return boolean
     */
    public function getAceptapoliticas()
    {
        return $this->aceptapoliticas;
    }

    /**
     * Set fechareservacion
     *
     * @param \DateTime $fechareservacion
     *
     * @return ReservacionesReservaciones
     */
    public function setFechareservacion($fechareservacion)
    {
        $this->fechareservacion = $fechareservacion;

        return $this;
    }

    /**
     * Get fechareservacion
     *
     * @return \DateTime
     */
    public function getFechareservacion()
    {
        return $this->fechareservacion;
    }

    /**
     * Set requireSeguro
     *
     * @param string $requireSeguro
     *
     * @return ReservacionesReservaciones
     */
    public function setRequireSeguro($requireSeguro)
    {
        $this->requireSeguro = $requireSeguro;

        return $this;
    }

    /**
     * Get requireSeguro
     *
     * @return string
     */
    public function getRequireSeguro()
    {
        return $this->requireSeguro;
    }

    /**
     * Set seguroViajero
     *
     * @param string $seguroViajero
     *
     * @return ReservacionesReservaciones
     */
    public function setSeguroViajero($seguroViajero)
    {
        $this->seguroViajero = $seguroViajero;

        return $this;
    }

    /**
     * Get seguroViajero
     *
     * @return string
     */
    public function getSeguroViajero()
    {
        return $this->seguroViajero;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return ReservacionesReservaciones
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set tipoViaje
     *
     * @param string $tipoViaje
     *
     * @return ReservacionesReservaciones
     */
    public function setTipoViaje($tipoViaje)
    {
        $this->tipoViaje = $tipoViaje;

        return $this;
    }

    /**
     * Get tipoViaje
     *
     * @return string
     */
    public function getTipoViaje()
    {
        return $this->tipoViaje;
    }

    /**
     * Set beneficiario1
     *
     * @param string $beneficiario1
     *
     * @return ReservacionesReservaciones
     */
    public function setBeneficiario1($beneficiario1)
    {
        $this->beneficiario1 = $beneficiario1;

        return $this;
    }

    /**
     * Get beneficiario1
     *
     * @return string
     */
    public function getBeneficiario1()
    {
        return $this->beneficiario1;
    }

    /**
     * Set parentesco1
     *
     * @param string $parentesco1
     *
     * @return ReservacionesReservaciones
     */
    public function setParentesco1($parentesco1)
    {
        $this->parentesco1 = $parentesco1;

        return $this;
    }

    /**
     * Get parentesco1
     *
     * @return string
     */
    public function getParentesco1()
    {
        return $this->parentesco1;
    }

    /**
     * Set porcentaje1
     *
     * @param string $porcentaje1
     *
     * @return ReservacionesReservaciones
     */
    public function setPorcentaje1($porcentaje1)
    {
        $this->porcentaje1 = $porcentaje1;

        return $this;
    }

    /**
     * Get porcentaje1
     *
     * @return string
     */
    public function getPorcentaje1()
    {
        return $this->porcentaje1;
    }

    /**
     * Set beneficiario2
     *
     * @param string $beneficiario2
     *
     * @return ReservacionesReservaciones
     */
    public function setBeneficiario2($beneficiario2)
    {
        $this->beneficiario2 = $beneficiario2;

        return $this;
    }

    /**
     * Get beneficiario2
     *
     * @return string
     */
    public function getBeneficiario2()
    {
        return $this->beneficiario2;
    }

    /**
     * Set parentesco2
     *
     * @param string $parentesco2
     *
     * @return ReservacionesReservaciones
     */
    public function setParentesco2($parentesco2)
    {
        $this->parentesco2 = $parentesco2;

        return $this;
    }

    /**
     * Get parentesco2
     *
     * @return string
     */
    public function getParentesco2()
    {
        return $this->parentesco2;
    }

    /**
     * Set porcentaje2
     *
     * @param string $porcentaje2
     *
     * @return ReservacionesReservaciones
     */
    public function setPorcentaje2($porcentaje2)
    {
        $this->porcentaje2 = $porcentaje2;

        return $this;
    }

    /**
     * Get porcentaje2
     *
     * @return string
     */
    public function getPorcentaje2()
    {
        return $this->porcentaje2;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return ReservacionesReservaciones
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tx
     *
     * @param string $tx
     *
     * @return ReservacionesReservaciones
     */
    public function setTx($tx)
    {
        $this->tx = $tx;

        return $this;
    }

    /**
     * Get tx
     *
     * @return string
     */
    public function getTx()
    {
        return $this->tx;
    }
}
