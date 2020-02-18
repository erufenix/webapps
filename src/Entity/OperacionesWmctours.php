<?php

namespace Entity;

/**
 * OperacionesWmctours
 */
class OperacionesWmctours
{
    /**
     * @var integer
     */
    private $tourId;

    /**
     * @var string
     */
    private $tourCve = '\'\'';

    /**
     * @var string
     */
    private $name = '\'\'';

    /**
     * @var string
     */
    private $surname = '\'\'';

    /**
     * @var string
     */
    private $email = '\'\'';

    /**
     * @var \DateTime
     */
    private $tourDate;

    /**
     * @var string
     */
    private $cfullname = 'NULL';

    /**
     * @var string
     */
    private $cemail = 'NULL';

    /**
     * @var string
     */
    private $total = '\'\'';

    /**
     * @var string
     */
    private $sku = '\'\'';

    /**
     * @var string
     */
    private $tx = '\'\'';

    /**
     * @var \DateTime
     */
    private $createdDate = 'NULL';


    /**
     * Get tourId
     *
     * @return integer
     */
    public function getTourId()
    {
        return $this->tourId;
    }

    /**
     * Set tourCve
     *
     * @param string $tourCve
     *
     * @return OperacionesWmctours
     */
    public function setTourCve($tourCve)
    {
        $this->tourCve = $tourCve;

        return $this;
    }

    /**
     * Get tourCve
     *
     * @return string
     */
    public function getTourCve()
    {
        return $this->tourCve;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return OperacionesWmctours
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
     * Set surname
     *
     * @param string $surname
     *
     * @return OperacionesWmctours
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return OperacionesWmctours
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
     * Set tourDate
     *
     * @param \DateTime $tourDate
     *
     * @return OperacionesWmctours
     */
    public function setTourDate($tourDate)
    {
        $this->tourDate = $tourDate;

        return $this;
    }

    /**
     * Get tourDate
     *
     * @return \DateTime
     */
    public function getTourDate()
    {
        return $this->tourDate;
    }

    /**
     * Set cfullname
     *
     * @param string $cfullname
     *
     * @return OperacionesWmctours
     */
    public function setCfullname($cfullname)
    {
        $this->cfullname = $cfullname;

        return $this;
    }

    /**
     * Get cfullname
     *
     * @return string
     */
    public function getCfullname()
    {
        return $this->cfullname;
    }

    /**
     * Set cemail
     *
     * @param string $cemail
     *
     * @return OperacionesWmctours
     */
    public function setCemail($cemail)
    {
        $this->cemail = $cemail;

        return $this;
    }

    /**
     * Get cemail
     *
     * @return string
     */
    public function getCemail()
    {
        return $this->cemail;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return OperacionesWmctours
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
     * Set sku
     *
     * @param string $sku
     *
     * @return OperacionesWmctours
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set tx
     *
     * @param string $tx
     *
     * @return OperacionesWmctours
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
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return OperacionesWmctours
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }
    /**
     * @var string
     */
    private $companionsName;

    /**
     * @var string
     */
    private $companionsMail;

    /**
     * @var \DateTime
     */
    private $dateCreated = 'CURRENT_TIMESTAMP';


    /**
     * Set companionsName
     *
     * @param string $companionsName
     *
     * @return OperacionesWmctours
     */
    public function setCompanionsName($companionsName)
    {
        $this->companionsName = $companionsName;

        return $this;
    }

    /**
     * Get companionsName
     *
     * @return string
     */
    public function getCompanionsName()
    {
        return $this->companionsName;
    }

    /**
     * Set companionsMail
     *
     * @param string $companionsMail
     *
     * @return OperacionesWmctours
     */
    public function setCompanionsMail($companionsMail)
    {
        $this->companionsMail = $companionsMail;

        return $this;
    }

    /**
     * Get companionsMail
     *
     * @return string
     */
    public function getCompanionsMail()
    {
        return $this->companionsMail;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return OperacionesWmctours
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
}
