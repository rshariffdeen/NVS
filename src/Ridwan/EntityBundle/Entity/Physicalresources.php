<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Physicalresources
 */
class Physicalresources
{
    /**
     * @var integer
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $causes;

    /**
     * @var string
     */
    private $organizations;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set type
     *
     * @param integer $type
     * @return Physicalresources
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Physicalresources
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
     * Set causes
     *
     * @param string $causes
     * @return Physicalresources
     */
    public function setCauses($causes)
    {
        $this->causes = $causes;

        return $this;
    }

    /**
     * Get causes
     *
     * @return string 
     */
    public function getCauses()
    {
        return $this->causes;
    }

    /**
     * Set organizations
     *
     * @param string $organizations
     * @return Physicalresources
     */
    public function setOrganizations($organizations)
    {
        $this->organizations = $organizations;

        return $this;
    }

    /**
     * Get organizations
     *
     * @return string 
     */
    public function getOrganizations()
    {
        return $this->organizations;
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
