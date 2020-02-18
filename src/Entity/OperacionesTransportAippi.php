<?php

namespace Entity;

/**
 * OperacionesTransportAippi
 */
class OperacionesTransportAippi
{
    /**
     * @var integer
     */
    private $tranportId;

    /**
     * @var string
     */
    private $hotel;

    /**
     * @var string
     */
    private $transfer = '';

    /**
     * @var string
     */
    private $arrivePersons = '0';

    /**
     * @var string
     */
    private $arriveAirline = '';

    /**
     * @var string
     */
    private $arriveFly = '';

    /**
     * @var \DateTime
     */
    private $arriveDate;

    /**
     * @var \DateTime
     */
    private $arriveTime;

    /**
     * @var string
     */
    private $arriveRate = '';

    /**
     * @var string
     */
    private $departurePersons = '0';

    /**
     * @var string
     */
    private $departureAirline = '';

    /**
     * @var string
     */
    private $departureFly = '';

    /**
     * @var \DateTime
     */
    private $departureDate;

    /**
     * @var \DateTime
     */
    private $departureTime;

    /**
     * @var string
     */
    private $departureRate = '';

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $phone = '';

    /**
     * @var string
     */
    private $email = '';

    /**
     * @var string
     */
    private $total = '';

    /**
     * @var string
     */
    private $comments;

    /**
     * @var \DateTime
     */
    private $registerDate;

    /**
     * @var string
     */
    private $pay = '0';

    /**
     * @var string
     */
    private $code = '0';

    /**
     * @var string
     */
    private $st = '';

    /**
     * @var string
     */
    private $tx = '';

    /**
     * @var string
     */
    private $refund = '0';

    /**
     * @var string
     */
    private $txRefund = '';

    /**
     * @var string
     */
    private $rfc = '';

    /**
     * @var string
     */
    private $company = '';

    /**
     * @var integer
     */
    private $country = '0';

    /**
     * @var string
     */
    private $bemail = '';

    /**
     * @var string
     */
    private $city = '';

    /**
     * @var string
     */
    private $state = '';

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $bphone = '';

    /**
     * @var string
     */
    private $cp = '';

    /**
     * @var boolean
     */
    private $ireturn = '0';

    /**
     * @var boolean
     */
    private $aviso = '0';


    /**
     * Get tranportId
     *
     * @return integer
     */
    public function getTranportId()
    {
        return $this->tranportId;
    }

    /**
     * Set hotel
     *
     * @param string $hotel
     *
     * @return OperacionesTransportAippi
     */
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return string
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Set transfer
     *
     * @param string $transfer
     *
     * @return OperacionesTransportAippi
     */
    public function setTransfer($transfer)
    {
        $this->transfer = $transfer;

        return $this;
    }

    /**
     * Get transfer
     *
     * @return string
     */
    public function getTransfer()
    {
        return $this->transfer;
    }

    /**
     * Set arrivePersons
     *
     * @param string $arrivePersons
     *
     * @return OperacionesTransportAippi
     */
    public function setArrivePersons($arrivePersons)
    {
        $this->arrivePersons = $arrivePersons;

        return $this;
    }

    /**
     * Get arrivePersons
     *
     * @return string
     */
    public function getArrivePersons()
    {
        return $this->arrivePersons;
    }

    /**
     * Set arriveAirline
     *
     * @param string $arriveAirline
     *
     * @return OperacionesTransportAippi
     */
    public function setArriveAirline($arriveAirline)
    {
        $this->arriveAirline = $arriveAirline;

        return $this;
    }

    /**
     * Get arriveAirline
     *
     * @return string
     */
    public function getArriveAirline()
    {
        return $this->arriveAirline;
    }

    /**
     * Set arriveFly
     *
     * @param string $arriveFly
     *
     * @return OperacionesTransportAippi
     */
    public function setArriveFly($arriveFly)
    {
        $this->arriveFly = $arriveFly;

        return $this;
    }

    /**
     * Get arriveFly
     *
     * @return string
     */
    public function getArriveFly()
    {
        return $this->arriveFly;
    }

    /**
     * Set arriveDate
     *
     * @param \DateTime $arriveDate
     *
     * @return OperacionesTransportAippi
     */
    public function setArriveDate($arriveDate)
    {
        $this->arriveDate = $arriveDate;

        return $this;
    }

    /**
     * Get arriveDate
     *
     * @return \DateTime
     */
    public function getArriveDate()
    {
        return $this->arriveDate;
    }

    /**
     * Set arriveTime
     *
     * @param \DateTime $arriveTime
     *
     * @return OperacionesTransportAippi
     */
    public function setArriveTime($arriveTime)
    {
        $this->arriveTime = $arriveTime;

        return $this;
    }

    /**
     * Get arriveTime
     *
     * @return \DateTime
     */
    public function getArriveTime()
    {
        return $this->arriveTime;
    }

    /**
     * Set arriveRate
     *
     * @param string $arriveRate
     *
     * @return OperacionesTransportAippi
     */
    public function setArriveRate($arriveRate)
    {
        $this->arriveRate = $arriveRate;

        return $this;
    }

    /**
     * Get arriveRate
     *
     * @return string
     */
    public function getArriveRate()
    {
        return $this->arriveRate;
    }

    /**
     * Set departurePersons
     *
     * @param string $departurePersons
     *
     * @return OperacionesTransportAippi
     */
    public function setDeparturePersons($departurePersons)
    {
        $this->departurePersons = $departurePersons;

        return $this;
    }

    /**
     * Get departurePersons
     *
     * @return string
     */
    public function getDeparturePersons()
    {
        return $this->departurePersons;
    }

    /**
     * Set departureAirline
     *
     * @param string $departureAirline
     *
     * @return OperacionesTransportAippi
     */
    public function setDepartureAirline($departureAirline)
    {
        $this->departureAirline = $departureAirline;

        return $this;
    }

    /**
     * Get departureAirline
     *
     * @return string
     */
    public function getDepartureAirline()
    {
        return $this->departureAirline;
    }

    /**
     * Set departureFly
     *
     * @param string $departureFly
     *
     * @return OperacionesTransportAippi
     */
    public function setDepartureFly($departureFly)
    {
        $this->departureFly = $departureFly;

        return $this;
    }

    /**
     * Get departureFly
     *
     * @return string
     */
    public function getDepartureFly()
    {
        return $this->departureFly;
    }

    /**
     * Set departureDate
     *
     * @param \DateTime $departureDate
     *
     * @return OperacionesTransportAippi
     */
    public function setDepartureDate($departureDate)
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    /**
     * Get departureDate
     *
     * @return \DateTime
     */
    public function getDepartureDate()
    {
        return $this->departureDate;
    }

    /**
     * Set departureTime
     *
     * @param \DateTime $departureTime
     *
     * @return OperacionesTransportAippi
     */
    public function setDepartureTime($departureTime)
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    /**
     * Get departureTime
     *
     * @return \DateTime
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * Set departureRate
     *
     * @param string $departureRate
     *
     * @return OperacionesTransportAippi
     */
    public function setDepartureRate($departureRate)
    {
        $this->departureRate = $departureRate;

        return $this;
    }

    /**
     * Get departureRate
     *
     * @return string
     */
    public function getDepartureRate()
    {
        return $this->departureRate;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return OperacionesTransportAippi
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return OperacionesTransportAippi
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return OperacionesTransportAippi
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
     * Set total
     *
     * @param string $total
     *
     * @return OperacionesTransportAippi
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return OperacionesTransportAippi
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set registerDate
     *
     * @param \DateTime $registerDate
     *
     * @return OperacionesTransportAippi
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return \DateTime
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set pay
     *
     * @param string $pay
     *
     * @return OperacionesTransportAippi
     */
    public function setPay($pay)
    {
        $this->pay = $pay;

        return $this;
    }

    /**
     * Get pay
     *
     * @return string
     */
    public function getPay()
    {
        return $this->pay;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return OperacionesTransportAippi
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set st
     *
     * @param string $st
     *
     * @return OperacionesTransportAippi
     */
    public function setSt($st)
    {
        $this->st = $st;

        return $this;
    }

    /**
     * Get st
     *
     * @return string
     */
    public function getSt()
    {
        return $this->st;
    }

    /**
     * Set tx
     *
     * @param string $tx
     *
     * @return OperacionesTransportAippi
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

    /**
     * Set refund
     *
     * @param string $refund
     *
     * @return OperacionesTransportAippi
     */
    public function setRefund($refund)
    {
        $this->refund = $refund;

        return $this;
    }

    /**
     * Get refund
     *
     * @return string
     */
    public function getRefund()
    {
        return $this->refund;
    }

    /**
     * Set txRefund
     *
     * @param string $txRefund
     *
     * @return OperacionesTransportAippi
     */
    public function setTxRefund($txRefund)
    {
        $this->txRefund = $txRefund;

        return $this;
    }

    /**
     * Get txRefund
     *
     * @return string
     */
    public function getTxRefund()
    {
        return $this->txRefund;
    }

    /**
     * Set rfc
     *
     * @param string $rfc
     *
     * @return OperacionesTransportAippi
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
     * Set company
     *
     * @param string $company
     *
     * @return OperacionesTransportAippi
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set country
     *
     * @param integer $country
     *
     * @return OperacionesTransportAippi
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return integer
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set bemail
     *
     * @param string $bemail
     *
     * @return OperacionesTransportAippi
     */
    public function setBemail($bemail)
    {
        $this->bemail = $bemail;

        return $this;
    }

    /**
     * Get bemail
     *
     * @return string
     */
    public function getBemail()
    {
        return $this->bemail;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return OperacionesTransportAippi
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return OperacionesTransportAippi
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return OperacionesTransportAippi
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set bphone
     *
     * @param string $bphone
     *
     * @return OperacionesTransportAippi
     */
    public function setBphone($bphone)
    {
        $this->bphone = $bphone;

        return $this;
    }

    /**
     * Get bphone
     *
     * @return string
     */
    public function getBphone()
    {
        return $this->bphone;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return OperacionesTransportAippi
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
     * Set ireturn
     *
     * @param boolean $ireturn
     *
     * @return OperacionesTransportAippi
     */
    public function setIreturn($ireturn)
    {
        $this->ireturn = $ireturn;

        return $this;
    }

    /**
     * Get ireturn
     *
     * @return boolean
     */
    public function getIreturn()
    {
        return $this->ireturn;
    }

    /**
     * Set aviso
     *
     * @param boolean $aviso
     *
     * @return OperacionesTransportAippi
     */
    public function setAviso($aviso)
    {
        $this->aviso = $aviso;

        return $this;
    }

    /**
     * Get aviso
     *
     * @return boolean
     */
    public function getAviso()
    {
        return $this->aviso;
    }
}
