<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organizationcontactdetails
 */
class Organizationcontactdetails
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
     * @var string
     */
    private $website;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ridwan\EntityBundle\Entity\Organization
     */
    private $organization;


    /**
     * Set email
     *
     * @param string $email
     * @return Organizationcontactdetails
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
     * @return Organizationcontactdetails
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
     * Set streetnumber
     *
     * @param string $streetnumber
     * @return Organizationcontactdetails
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
     * @return Organizationcontactdetails
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
     * @return Organizationcontactdetails
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
     * @return Organizationcontactdetails
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
     * @return Organizationcontactdetails
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
     * @return Organizationcontactdetails
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
     * @return Organizationcontactdetails
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
     * Set website
     *
     * @param string $website
     * @return Organizationcontactdetails
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
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
     * Set organization
     *
     * @param \Ridwan\EntityBundle\Entity\Organization $organization
     * @return Organizationcontactdetails
     */
    public function setOrganization(\Ridwan\EntityBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return \Ridwan\EntityBundle\Entity\Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @var integer
     */
    private $user;


    /**
     * Set user
     *
     * @param \Ridwan\EntityBundle\Entity\Authentication $user
     * @return Organizationcontactdetails
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
     * @var integer
     */
    private $phone;

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

}
