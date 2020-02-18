<?php

namespace Entity;

/**
 * OperacionesUserCmi
 */
class OperacionesUserCmi
{
    /**
     * @var integer
     */
    private $idUser;

    /**
     * @var string
     */
    private $user = '\'\'';

    /**
     * @var string
     */
    private $userName = '\'\'';

    /**
     * @var string
     */
    private $userCorreo = '\'\'';

    /**
     * @var string
     */
    private $userPassword = '\'\'';

    /**
     * @var string
     */
    private $userRole = '\'ROLE_AIPPI_VIEW\'';

    /**
     * @var \DateTime
     */
    private $userCreate = 'NULL';

    /**
     * @var string
     */
    private $userRoleName = '\'Consulta\'';


    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return OperacionesUserCmi
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return OperacionesUserCmi
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set userCorreo
     *
     * @param string $userCorreo
     *
     * @return OperacionesUserCmi
     */
    public function setUserCorreo($userCorreo)
    {
        $this->userCorreo = $userCorreo;

        return $this;
    }

    /**
     * Get userCorreo
     *
     * @return string
     */
    public function getUserCorreo()
    {
        return $this->userCorreo;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     *
     * @return OperacionesUserCmi
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set userRole
     *
     * @param string $userRole
     *
     * @return OperacionesUserCmi
     */
    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;

        return $this;
    }

    /**
     * Get userRole
     *
     * @return string
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * Set userCreate
     *
     * @param \DateTime $userCreate
     *
     * @return OperacionesUserCmi
     */
    public function setUserCreate($userCreate)
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    /**
     * Get userCreate
     *
     * @return \DateTime
     */
    public function getUserCreate()
    {
        return $this->userCreate;
    }

    /**
     * Set userRoleName
     *
     * @param string $userRoleName
     *
     * @return OperacionesUserCmi
     */
    public function setUserRoleName($userRoleName)
    {
        $this->userRoleName = $userRoleName;

        return $this;
    }

    /**
     * Get userRoleName
     *
     * @return string
     */
    public function getUserRoleName()
    {
        return $this->userRoleName;
    }
}
