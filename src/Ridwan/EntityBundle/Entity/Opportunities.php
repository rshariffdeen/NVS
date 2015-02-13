<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Opportunities
 */
class Opportunities
{

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $cause;

    /**
     * @var string
     */
    private $role;

    /**
     * @var string
     */
    private $time;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $shortdescription;

    /**
     * @var \DateTime
     */
    private $startdate;

    /**
     * @var \DateTime
     */
    private $enddate;

    /**
     * @var integer
     */
    private $numberofvolunteers;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var string
     */
    private $agegroup;

    /**
     * @var string
     */
    private $training;

    /**
     * @var string
     */
    private $expenses;

    /**
     * @var string
     */
    private $difficulty;

    /**
     * @var string
     */
    private $systemmatch;

    /**
     * @var string
     */
    private $completed;

    /**
     * @var string
     */
    private $interested;

    /**
     * @var string
     */
    private $enrolled;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */

    private $organization;


    /**
     * Set organization
     *
     * @param integer $organization
     * @return Opportunities
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
        return $this;
    }

    /**
     * Get organization
     *
     * @return integer
     */

    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set status
     *
     * @param integer $status
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
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Set title
     *
     * @param string $title
     * @return Opportunities
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Opportunities
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set time
     *
     * @param string $time
     * @return Opportunities
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Opportunities
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
     * Set description
     *
     * @param string $description
     * @return Opportunities
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
     * Set shortdescription
     *
     * @param string $shortdescription
     * @return Opportunities
     */
    public function setShortdescription($shortdescription)
    {
        $this->shortdescription = $shortdescription;

        return $this;
    }

    /**
     * Get shortdescription
     *
     * @return string 
     */
    public function getShortdescription()
    {
        return $this->shortdescription;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     * @return Opportunities
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
     * Set enddate
     *
     * @param \DateTime $enddate
     * @return Opportunities
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime 
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * Set numberofvolunteers
     *
     * @param integer $numberofvolunteers
     * @return Opportunities
     */
    public function setNumberofvolunteers($numberofvolunteers)
    {
        $this->numberofvolunteers = $numberofvolunteers;

        return $this;
    }

    /**
     * Get numberofvolunteers
     *
     * @return integer 
     */
    public function getNumberofvolunteers()
    {
        return $this->numberofvolunteers;
    }

    /**
     * Set agegroup
     *
     * @param string $agegroup
     * @return Opportunities
     */
    public function setAgegroup($agegroup)
    {
        $this->agegroup = $agegroup;

        return $this;
    }

    /**
     * Get agegroup
     *
     * @return string 
     */
    public function getAgegroup()
    {
        return $this->agegroup;
    }

    /**
     * Set training
     *
     * @param string $training
     * @return Opportunities
     */
    public function setTraining($training)
    {
        $this->training = $training;

        return $this;
    }

    /**
     * Get training
     *
     * @return string 
     */
    public function getTraining()
    {
        return $this->training;
    }

    /**
     * Set expenses
     *
     * @param string $expenses
     * @return Opportunities
     */
    public function setExpenses($expenses)
    {
        $this->expenses = $expenses;

        return $this;
    }

    /**
     * Get expenses
     *
     * @return string 
     */
    public function getExpenses()
    {
        return $this->expenses;
    }

    /**
     * Set difficulty
     *
     * @param string $difficulty
     * @return Opportunities
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty
     *
     * @return string 
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set systemmatch
     *
     * @param string $systemmatch
     * @return Opportunities
     */
    public function setSystemmatch($systemmatch)
    {
        $this->systemmatch = $systemmatch;

        return $this;
    }

    /**
     * Get systemmatch
     *
     * @return string 
     */
    public function getSystemmatch()
    {
        return $this->systemmatch;
    }

    /**
     * Set completed
     *
     * @param string $completed
     * @return Opportunities
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return string
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set interested
     *
     * @param string $interested
     * @return Opportunities
     */
    public function setInterested($interested)
    {
        $this->interested = $interested;

        return $this;
    }

    /**
     * Get interested
     *
     * @return string 
     */
    public function getInterested()
    {
        return $this->interested;
    }

    /**
     * Set enrolled
     *
     * @param string $enrolled
     * @return Opportunities
     */
    public function setEnrolled($enrolled)
    {
        $this->enrolled = $enrolled;

        return $this;
    }

    /**
     * Get enrolled
     *
     * @return string 
     */
    public function getEnrolled()
    {
        return $this->enrolled;
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
