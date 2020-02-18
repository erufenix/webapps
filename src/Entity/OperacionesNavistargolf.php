<?php

namespace Entity;

/**
 * OperacionesNavistargolf
 */
class OperacionesNavistargolf
{
    /**
     * @var integer
     */
    private $idRegistro;

    /**
     * @var integer
     */
    private $idClave = '0';

    /**
     * @var string
     */
    private $tpoNombre = '\'\'';

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
     * @var string
     */
    private $celular = '\'0\'';

    /**
     * @var string
     */
    private $empresa = '\'\'';

    /**
     * @var string
     */
    private $distribuidor = '\'\'';

    /**
     * @var string
     */
    private $acoNombre = '\'\'';

    /**
     * @var string
     */
    private $habitacion = '\'\'';

    /**
     * @var integer
     */
    private $ncamas = '0';

    /**
     * @var string
     */
    private $transporte;

    /**
     * @var string
     */
    private $aerolineas;

    /**
     * @var string
     */
    private $nvuelos = '\'\'';

    /**
     * @var \DateTime
     */
    private $fechaHoraVuelos = 'NULL';

    /**
     * @var string
     */
    private $aerolineal;

    /**
     * @var string
     */
    private $nveulol = '\'\'';

    /**
     * @var \DateTime
     */
    private $fechaHoraVuelol = 'NULL';

    /**
     * @var \DateTime
     */
    private $fechaRegistro = 'NULL';

    /**
     * @var string
     */
    private $tipo = '\'\'';

    /**
     * @var integer
     */
    private $handicap = '0';

    /**
     * @var string
     */
    private $equipo = '\'\'';

    /**
     * @var string
     */
    private $guante = '\'\'';

    /**
     * @var string
     */
    private $alergias = 'NULL';

    /**
     * @var string
     */
    private $comentarios = 'NULL';

    /**
     * @var integer
     */
    private $noches = '0';

    /**
     * @var integer
     */
    private $nochesa = '0';

    /**
     * @var string
     */
    private $rsocial = '\'\'';

    /**
     * @var string
     */
    private $rfc = '\'\'';

    /**
     * @var string
     */
    private $fcorreo = '\'\'';

    /**
     * @var string
     */
    private $ftelefono = '\'\'';

    /**
     * @var string
     */
    private $fdireccion = 'NULL';

    /**
     * @var string
     */
    private $jcamisa = '\'\'';

    /**
     * @var string
     */
    private $njcamisa = '\'\'';

    /**
     * @var string
     */
    private $respaciales = 'NULL';


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
     * Set idClave
     *
     * @param integer $idClave
     *
     * @return OperacionesNavistargolf
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
     * Set tpoNombre
     *
     * @param string $tpoNombre
     *
     * @return OperacionesNavistargolf
     */
    public function setTpoNombre($tpoNombre)
    {
        $this->tpoNombre = $tpoNombre;

        return $this;
    }

    /**
     * Get tpoNombre
     *
     * @return string
     */
    public function getTpoNombre()
    {
        return $this->tpoNombre;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return OperacionesNavistargolf
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
     * @return OperacionesNavistargolf
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
     * @return OperacionesNavistargolf
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
     * Set celular
     *
     * @param string $celular
     *
     * @return OperacionesNavistargolf
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     *
     * @return OperacionesNavistargolf
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
     * Set distribuidor
     *
     * @param string $distribuidor
     *
     * @return OperacionesNavistargolf
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
     * Set acoNombre
     *
     * @param string $acoNombre
     *
     * @return OperacionesNavistargolf
     */
    public function setAcoNombre($acoNombre)
    {
        $this->acoNombre = $acoNombre;

        return $this;
    }

    /**
     * Get acoNombre
     *
     * @return string
     */
    public function getAcoNombre()
    {
        return $this->acoNombre;
    }

    /**
     * Set habitacion
     *
     * @param string $habitacion
     *
     * @return OperacionesNavistargolf
     */
    public function setHabitacion($habitacion)
    {
        $this->habitacion = $habitacion;

        return $this;
    }

    /**
     * Get habitacion
     *
     * @return string
     */
    public function getHabitacion()
    {
        return $this->habitacion;
    }

    /**
     * Set ncamas
     *
     * @param integer $ncamas
     *
     * @return OperacionesNavistargolf
     */
    public function setNcamas($ncamas)
    {
        $this->ncamas = $ncamas;

        return $this;
    }

    /**
     * Get ncamas
     *
     * @return integer
     */
    public function getNcamas()
    {
        return $this->ncamas;
    }

    /**
     * Set transporte
     *
     * @param string $transporte
     *
     * @return OperacionesNavistargolf
     */
    public function setTransporte($transporte)
    {
        $this->transporte = $transporte;

        return $this;
    }

    /**
     * Get transporte
     *
     * @return string
     */
    public function getTransporte()
    {
        return $this->transporte;
    }

    /**
     * Set aerolineas
     *
     * @param string $aerolineas
     *
     * @return OperacionesNavistargolf
     */
    public function setAerolineas($aerolineas)
    {
        $this->aerolineas = $aerolineas;

        return $this;
    }

    /**
     * Get aerolineas
     *
     * @return string
     */
    public function getAerolineas()
    {
        return $this->aerolineas;
    }

    /**
     * Set nvuelos
     *
     * @param string $nvuelos
     *
     * @return OperacionesNavistargolf
     */
    public function setNvuelos($nvuelos)
    {
        $this->nvuelos = $nvuelos;

        return $this;
    }

    /**
     * Get nvuelos
     *
     * @return string
     */
    public function getNvuelos()
    {
        return $this->nvuelos;
    }

    /**
     * Set fechaHoraVuelos
     *
     * @param \DateTime $fechaHoraVuelos
     *
     * @return OperacionesNavistargolf
     */
    public function setFechaHoraVuelos($fechaHoraVuelos)
    {
        $this->fechaHoraVuelos = $fechaHoraVuelos;

        return $this;
    }

    /**
     * Get fechaHoraVuelos
     *
     * @return \DateTime
     */
    public function getFechaHoraVuelos()
    {
        return $this->fechaHoraVuelos;
    }

    /**
     * Set aerolineal
     *
     * @param string $aerolineal
     *
     * @return OperacionesNavistargolf
     */
    public function setAerolineal($aerolineal)
    {
        $this->aerolineal = $aerolineal;

        return $this;
    }

    /**
     * Get aerolineal
     *
     * @return string
     */
    public function getAerolineal()
    {
        return $this->aerolineal;
    }

    /**
     * Set nveulol
     *
     * @param string $nveulol
     *
     * @return OperacionesNavistargolf
     */
    public function setNveulol($nveulol)
    {
        $this->nveulol = $nveulol;

        return $this;
    }

    /**
     * Get nveulol
     *
     * @return string
     */
    public function getNveulol()
    {
        return $this->nveulol;
    }

    /**
     * Set fechaHoraVuelol
     *
     * @param \DateTime $fechaHoraVuelol
     *
     * @return OperacionesNavistargolf
     */
    public function setFechaHoraVuelol($fechaHoraVuelol)
    {
        $this->fechaHoraVuelol = $fechaHoraVuelol;

        return $this;
    }

    /**
     * Get fechaHoraVuelol
     *
     * @return \DateTime
     */
    public function getFechaHoraVuelol()
    {
        return $this->fechaHoraVuelol;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return OperacionesNavistargolf
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return OperacionesNavistargolf
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
     * Set handicap
     *
     * @param integer $handicap
     *
     * @return OperacionesNavistargolf
     */
    public function setHandicap($handicap)
    {
        $this->handicap = $handicap;

        return $this;
    }

    /**
     * Get handicap
     *
     * @return integer
     */
    public function getHandicap()
    {
        return $this->handicap;
    }

    /**
     * Set equipo
     *
     * @param string $equipo
     *
     * @return OperacionesNavistargolf
     */
    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;

        return $this;
    }

    /**
     * Get equipo
     *
     * @return string
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * Set guante
     *
     * @param string $guante
     *
     * @return OperacionesNavistargolf
     */
    public function setGuante($guante)
    {
        $this->guante = $guante;

        return $this;
    }

    /**
     * Get guante
     *
     * @return string
     */
    public function getGuante()
    {
        return $this->guante;
    }

    /**
     * Set alergias
     *
     * @param string $alergias
     *
     * @return OperacionesNavistargolf
     */
    public function setAlergias($alergias)
    {
        $this->alergias = $alergias;

        return $this;
    }

    /**
     * Get alergias
     *
     * @return string
     */
    public function getAlergias()
    {
        return $this->alergias;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     *
     * @return OperacionesNavistargolf
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
     * Set noches
     *
     * @param integer $noches
     *
     * @return OperacionesNavistargolf
     */
    public function setNoches($noches)
    {
        $this->noches = $noches;

        return $this;
    }

    /**
     * Get noches
     *
     * @return integer
     */
    public function getNoches()
    {
        return $this->noches;
    }

    /**
     * Set nochesa
     *
     * @param integer $nochesa
     *
     * @return OperacionesNavistargolf
     */
    public function setNochesa($nochesa)
    {
        $this->nochesa = $nochesa;

        return $this;
    }

    /**
     * Get nochesa
     *
     * @return integer
     */
    public function getNochesa()
    {
        return $this->nochesa;
    }

    /**
     * Set rsocial
     *
     * @param string $rsocial
     *
     * @return OperacionesNavistargolf
     */
    public function setRsocial($rsocial)
    {
        $this->rsocial = $rsocial;

        return $this;
    }

    /**
     * Get rsocial
     *
     * @return string
     */
    public function getRsocial()
    {
        return $this->rsocial;
    }

    /**
     * Set rfc
     *
     * @param string $rfc
     *
     * @return OperacionesNavistargolf
     */
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;

        return $this;
    }

    /**
     * Get rfc
     *
     * @return string
     */
    public function getRfc()
    {
        return $this->rfc;
    }

    /**
     * Set fcorreo
     *
     * @param string $fcorreo
     *
     * @return OperacionesNavistargolf
     */
    public function setFcorreo($fcorreo)
    {
        $this->fcorreo = $fcorreo;

        return $this;
    }

    /**
     * Get fcorreo
     *
     * @return string
     */
    public function getFcorreo()
    {
        return $this->fcorreo;
    }

    /**
     * Set ftelefono
     *
     * @param string $ftelefono
     *
     * @return OperacionesNavistargolf
     */
    public function setFtelefono($ftelefono)
    {
        $this->ftelefono = $ftelefono;

        return $this;
    }

    /**
     * Get ftelefono
     *
     * @return string
     */
    public function getFtelefono()
    {
        return $this->ftelefono;
    }

    /**
     * Set fdireccion
     *
     * @param string $fdireccion
     *
     * @return OperacionesNavistargolf
     */
    public function setFdireccion($fdireccion)
    {
        $this->fdireccion = $fdireccion;

        return $this;
    }

    /**
     * Get fdireccion
     *
     * @return string
     */
    public function getFdireccion()
    {
        return $this->fdireccion;
    }

    /**
     * Set jcamisa
     *
     * @param string $jcamisa
     *
     * @return OperacionesNavistargolf
     */
    public function setJcamisa($jcamisa)
    {
        $this->jcamisa = $jcamisa;

        return $this;
    }

    /**
     * Get jcamisa
     *
     * @return string
     */
    public function getJcamisa()
    {
        return $this->jcamisa;
    }

    /**
     * Set njcamisa
     *
     * @param string $njcamisa
     *
     * @return OperacionesNavistargolf
     */
    public function setNjcamisa($njcamisa)
    {
        $this->njcamisa = $njcamisa;

        return $this;
    }

    /**
     * Get njcamisa
     *
     * @return string
     */
    public function getNjcamisa()
    {
        return $this->njcamisa;
    }

    /**
     * Set respaciales
     *
     * @param string $respaciales
     *
     * @return OperacionesNavistargolf
     */
    public function setRespaciales($respaciales)
    {
        $this->respaciales = $respaciales;

        return $this;
    }

    /**
     * Get respaciales
     *
     * @return string
     */
    public function getRespaciales()
    {
        return $this->respaciales;
    }
    /**
     * @var string
     */
    private $gtalla = '\'\'';


    /**
     * Set gtalla
     *
     * @param string $gtalla
     *
     * @return OperacionesNavistargolf
     */
    public function setGtalla($gtalla)
    {
        $this->gtalla = $gtalla;

        return $this;
    }

    /**
     * Get gtalla
     *
     * @return string
     */
    public function getGtalla()
    {
        return $this->gtalla;
    }
    /**
     * @var string
     */
    private $respeciales = 'NULL';


    /**
     * Set respeciales
     *
     * @param string $respeciales
     *
     * @return OperacionesNavistargolf
     */
    public function setRespeciales($respeciales)
    {
        $this->respeciales = $respeciales;

        return $this;
    }

    /**
     * Get respeciales
     *
     * @return string
     */
    public function getRespeciales()
    {
        return $this->respeciales;
    }
}
