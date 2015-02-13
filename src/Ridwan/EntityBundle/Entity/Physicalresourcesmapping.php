<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Physicalresourcesmapping
 */
class Physicalresourcesmapping
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ridwan\EntityBundle\Entity\Organization
     */
    private $organization;

    /**
     * @var \Ridwan\EntityBundle\Entity\Physicalresources
     */
    private $resource;

    /**
     * @var \Ridwan\EntityBundle\Entity\Volunteerpersonal
     */
    private $volunteer;


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
     * @return Physicalresourcesmapping
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
     * Set resource
     *
     * @param \Ridwan\EntityBundle\Entity\Physicalresources $resource
     * @return Physicalresourcesmapping
     */
    public function setResource(\Ridwan\EntityBundle\Entity\Physicalresources $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \Ridwan\EntityBundle\Entity\Physicalresources 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set volunteer
     *
     * @param \Ridwan\EntityBundle\Entity\Volunteerpersonal $volunteer
     * @return Physicalresourcesmapping
     */
    public function setVolunteer(\Ridwan\EntityBundle\Entity\Volunteerpersonal $volunteer = null)
    {
        $this->volunteer = $volunteer;

        return $this;
    }

    /**
     * Get volunteer
     *
     * @return \Ridwan\EntityBundle\Entity\Volunteerpersonal 
     */
    public function getVolunteer()
    {
        return $this->volunteer;
    }
}
