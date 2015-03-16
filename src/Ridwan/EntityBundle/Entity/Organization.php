<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organization
 */
class Organization
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $branch;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $previousprojects;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     * @return Organization
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
     * Set branch
     *
     * @param string $branch
     * @return Organization
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * Get branch
     *
     * @return string 
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Organization
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set previousprojects
     *
     * @param string $previousprojects
     * @return Organization
     */
    public function setPreviousprojects($previousprojects)
    {
        $this->previousprojects = $previousprojects;

        return $this;
    }

    /**
     * Get previousprojects
     *
     * @return string 
     */
    public function getPreviousprojects()
    {
        return $this->previousprojects;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Organization
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

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
     * @var integer
     */
    private $user;


    /**
     * Set user
     *
     * @param \Ridwan\EntityBundle\Entity\Authentication $user
     * @return Organization
     */
    public function setUser(\Ridwan\EntityBundle\Entity\Authentication $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ridwan\EntityBundle\Entity\Authentication
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var string
     */
    private $registration_no;


    /**
     * Set registration_no
     *
     * @param string $registrationNo
     * @return Organization
     */
    public function setRegistrationNo($registrationNo)
    {
        $this->registration_no = $registrationNo;
    
        return $this;
    }

    /**
     * Get registration_no
     *
     * @return string 
     */
    public function getRegistrationNo()
    {
        return $this->registration_no;
    }
}
