<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skills
 */
class Skills
{
    /**
     * @var string
     */
    private $primary;

    /**
     * @var string
     */
    private $causes;

    /**
     * @var string
     */
    private $secondary;

    /**
     * @var string
     */
    private $languages;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ridwan\EntityBundle\Entity\Authentication
     */
    private $user;


    /**
     * Set primary
     *
     * @param string $primary
     * @return Skills
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;

        return $this;
    }

    /**
     * Get primary
     *
     * @return string 
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * Set causes
     *
     * @param string $causes
     * @return Skills
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
     * Set secondary
     *
     * @param string $secondary
     * @return Skills
     */
    public function setSecondary($secondary)
    {
        $this->secondary = $secondary;

        return $this;
    }

    /**
     * Get secondary
     *
     * @return string 
     */
    public function getSecondary()
    {
        return $this->secondary;
    }

    /**
     * Set languages
     *
     * @param string $languages
     * @return Skills
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return string 
     */
    public function getLanguages()
    {
        return $this->languages;
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
     * @return Skills
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
