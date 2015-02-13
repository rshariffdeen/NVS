<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Education
 */
class Education
{
    /**
     * @var string
     */
    private $institution;

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $degree;

    /**
     * @var string
     */
    private $duration;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ridwan\EntityBundle\Entity\Authentication
     */
    private $user;


    /**
     * Set institution
     *
     * @param string $institution
     * @return Education
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get institution
     *
     * @return string 
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * Set field
     *
     * @param string $field
     * @return Education
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return string 
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set degree
     *
     * @param string $degree
     * @return Education
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * Get degree
     *
     * @return string 
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return Education
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
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
     * @return Education
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
