<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skills
 */
class Locations
{
    /**
     * @var string
     */
    private $division;

    /**
     * @var string
     */
    private $district;

    /**
     * @var string
     */
    private $province;



    /**
     * @var integer
     */
    private $id;


    /**
     * Set province
     *
     * @param string $province
     * @return Locations
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
     * Get district
     *
     * @return string
     */
    public function getPlace()
    {
        return ( $this->division." | ".$this->district. " | ". $this->province. ' Province');
    }

    /**
     * Set district
     *
     * @param string $district
     * @return Locations
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
     * Set division
     *
     * @param string $division
     * @return Locations
     */
    public function setDivision($division)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return string
     */
    public function getDivision()
    {
        return $this->division;
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


}
