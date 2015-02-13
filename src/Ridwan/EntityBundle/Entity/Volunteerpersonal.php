<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Volunteerpersonal
 */
class Volunteerpersonal
{
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $nicorpassport;

    /**
     * @var boolean
     */
    private $gender;

    /**
     * @var \DateTime
     */
    private $dateofbirth;

    /**
     * @var string
     */
    private $nationality;

    /**
     * @var string
     */
    private $category;

    /**
     * @var boolean
     */
    private $civilstatus;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Volunteerpersonal
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Volunteerpersonal
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set nicorpassport
     *
     * @param string $nicorpassport
     * @return Volunteerpersonal
     */
    public function setNicorpassport($nicorpassport)
    {
        $this->nicorpassport = $nicorpassport;

        return $this;
    }

    /**
     * Get nicorpassport
     *
     * @return string 
     */
    public function getNicorpassport()
    {
        return $this->nicorpassport;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     * @return Volunteerpersonal
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set dateofbirth
     *
     * @param \DateTime $dateofbirth
     * @return Volunteerpersonal
     */
    public function setDateofbirth($dateofbirth)
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    /**
     * Get dateofbirth
     *
     * @return \DateTime 
     */
    public function getDateofbirth()
    {
        return $this->dateofbirth;
    }

    /**
     * Set nationality
     *
     * @param $nationality
     * @return Volunteerpersonal
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string 
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Volunteerpersonal
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set civilstatus
     *
     * @param boolean $civilstatus
     * @return Volunteerpersonal
     */
    public function setCivilstatus($civilstatus)
    {
        $this->civilstatus = $civilstatus;

        return $this;
    }

    /**
     * Get civilstatus
     *
     * @return boolean 
     */
    public function getCivilstatus()
    {
        return $this->civilstatus;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Volunteerpersonal
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
     * @return Volunteercontactdetails
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
}
