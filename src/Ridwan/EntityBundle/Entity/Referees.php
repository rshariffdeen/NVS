<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Referees
 */
class Referees
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var integer
     */
    private $contactnumber;

    /**
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $mobilenumber;

    /**
     * @var integer
     */
    private $id;

 


    /**
     * Set name
     *
     * @param string $name
     * @return Referees
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
     * Set address
     *
     * @param string $address
     * @return Referees
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
     * Set contactnumber
     *
     * @param integer $contactnumber
     * @return Referees
     */
    public function setContactnumber($contactnumber)
    {
        $this->contactnumber = $contactnumber;

        return $this;
    }

    /**
     * Get contactnumber
     *
     * @return integer 
     */
    public function getContactnumber()
    {
        return $this->contactnumber;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Referees
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
     * Set mobilenumber
     *
     * @param integer $mobilenumber
     * @return Referees
     */
    public function setMobilenumber($mobilenumber)
    {
        $this->mobilenumber = $mobilenumber;

        return $this;
    }

    /**
     * Get mobilenumber
     *
     * @return integer 
     */
    public function getMobilenumber()
    {
        return $this->mobilenumber;
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
     * @param integer $user
     * @return Volunteercontactdetails
     */
    public function setUser( $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }
}
