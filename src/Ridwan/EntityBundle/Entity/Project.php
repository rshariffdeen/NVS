<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 */
class Project
{
    /**
     * @var string
     */
    private $cause;

    /**
     * @var string
     */
    private $name;


    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $startdate;

    /**
     * @var \DateTime
     */
    private $proposedenddate;

    /**
     * @var string
     */
    private $location;

    /**
     * @var \DateTime
     */
    private $actualenddate;

    /**
     * @var string
     */
    private $status;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ridwan\EntityBundle\Entity\Organization
     */
    private $organization;


    /**
     * Set cause
     *
     * @param string $cause
     * @return Project
     */
    public function setCause($cause)
    {
        $this->cause = $cause;

        return $this;
    }

    /**
     * Get cause
     *
     * @return string 
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Project
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
     * Set description
     *
     * @param string $description
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     * @return Project
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime 
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set proposedenddate
     *
     * @param \DateTime $proposedenddate
     * @return Project
     */
    public function setProposedenddate($proposedenddate)
    {
        $this->proposedenddate = $proposedenddate;

        return $this;
    }

    /**
     * Get proposedenddate
     *
     * @return \DateTime 
     */
    public function getProposedenddate()
    {
        return $this->proposedenddate;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Project
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set actualenddate
     *
     * @param \DateTime $actualenddate
     * @return Project
     */
    public function setActualenddate($actualenddate)
    {
        $this->actualenddate = $actualenddate;

        return $this;
    }

    /**
     * Get actualenddate
     *
     * @return \DateTime 
     */
    public function getActualenddate()
    {
        return $this->actualenddate;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Project
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
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
     * Set organization
     *
     * @param \Ridwan\EntityBundle\Entity\Organization $organization
     * @return Project
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
}
