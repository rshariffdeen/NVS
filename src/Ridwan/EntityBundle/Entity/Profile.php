<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 */
class Profile
{
    /**
     * @var string
     */
    private $intro;

    /**
     * @var string
     */
    private $opportunities;
    /**
     * @var string
     */
    private $reason;

    /**
     * @var string
     */
    private $experience;

    /**
     * @var string
     */
    private $health;

    /**
     * @var string
     */
    private $drivinglicense;

    /**
     * @var string
     */
    private $arrested;

    /**
     * @var integer
     */
    private $aggregatedrating;

    /**
     * @var integer
     */
    private $totalweight;

    /**
     * @var integer
     */
    private $hours;

    /**
     * @var integer
     */
    private $current;

    /**
     * @var integer
     */
    private $value;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ridwan\EntityBundle\Entity\Volunteerpersonal
     */
    private $user;


    /**
     * Set intro
     *
     * @param string $intro
     * @return Profile
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string 
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set opportunities
     *
     * @param string $opportunities
     * @return Profile
     */
    public function setOpportunities($opportunities)
    {
        $this->opportunities = $opportunities;

        return $this;
    }

    /**
     * Get opportunities
     *
     * @return string
     */
    public function getOpportunities()
    {
        return $this->opportunities;
    }

    /**
     * Set reason
     *
     * @param string $reason
     * @return Profile
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string 
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set experience
     *
     * @param string $experience
     * @return Profile
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return string 
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set health
     *
     * @param string $health
     * @return Profile
     */
    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get health
     *
     * @return string 
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Set drivinglicense
     *
     * @param string $drivinglicense
     * @return Profile
     */
    public function setDrivinglicense($drivinglicense)
    {
        $this->drivinglicense = $drivinglicense;

        return $this;
    }

    /**
     * Get drivinglicense
     *
     * @return string 
     */
    public function getDrivinglicense()
    {
        return $this->drivinglicense;
    }

    /**
     * Set arrested
     *
     * @param string $arrested
     * @return Profile
     */
    public function setArrested($arrested)
    {
        $this->arrested = $arrested;

        return $this;
    }

    /**
     * Get arrested
     *
     * @return string 
     */
    public function getArrested()
    {
        return $this->arrested;
    }

    /**
     * Set aggregatedrating
     *
     * @param integer $aggregatedrating
     * @return Profile
     */
    public function setAggregatedrating($aggregatedrating)
    {
        $this->aggregatedrating = $aggregatedrating;

        return $this;
    }

    /**
     * Get aggregatedrating
     *
     * @return integer 
     */
    public function getAggregatedrating()
    {
        return $this->aggregatedrating;
    }

    /**
     * Set totalweight
     *
     * @param integer $totalweight
     * @return Profile
     */
    public function setTotalweight($totalweight)
    {
        $this->totalweight = $totalweight;

        return $this;
    }

    /**
     * Get totalweight
     *
     * @return integer 
     */
    public function getTotalweight()
    {
        return $this->totalweight;
    }

    /**
     * Set hours
     *
     * @param integer $hours
     * @return Profile
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return integer
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set current
     *
     * @param integer $current
     * @return Profile
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get current
     *
     * @return integer
     */
    public function getCurrent()
    {
        return $this->current;
    }


    /**
     * Set value
     *
     * @param integer $value
     * @return Profile
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
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
     * @return Profile
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
