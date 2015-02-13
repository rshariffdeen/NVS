<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Volunteercontactdetails
 */
class Volunteercontactdetails
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $fax;

    /**
     * @var integer
     */
    private $mobile;

    /**
     * @var integer
     */
    private $phone;

    /**
     * @var string
     */
    private $streetnumber;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $divisionalsecretary;

    /**
     * @var string
     */
    private $district;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $province;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ridwan\EntityBundle\Entity\Volunteerpersonal
     */
    private $user;


    /**
     * Set email
     *
     * @param string $email
     * @return Volunteercontactdetails
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
     * Set fax
     *
     * @param integer $fax
     * @return Volunteercontactdetails
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return integer 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set fax
     *
     * @param integer $mobile
     * @return Volunteercontactdetails
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return integer
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return Volunteercontactdetails
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get fax
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set streetnumber
     *
     * @param string $streetnumber
     * @return Volunteercontactdetails
     */
    public function setStreetnumber($streetnumber)
    {
        $this->streetnumber = $streetnumber;

        return $this;
    }

    /**
     * Get streetnumber
     *
     * @return string 
     */
    public function getStreetnumber()
    {
        return $this->streetnumber;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Volunteercontactdetails
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Volunteercontactdetails
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
     * Set divisionalsecretary
     *
     * @param string $divisionalsecretary
     * @return Volunteercontactdetails
     */
    public function setDivisionalsecretary($divisionalsecretary)
    {
        $this->divisionalsecretary = $divisionalsecretary;

        return $this;
    }

    /**
     * Get divisionalsecretary
     *
     * @return string
     */
    public function getDivisionalsecretary()
    {
        return $this->divisionalsecretary;
    }

    /**
     * Set district
     *
     * @param string $district
     * @return Volunteercontactdetails
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Volunteercontactdetails
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set province
     *
     * @param string $province
     * @return Volunteercontactdetails
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
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
