<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 */
class Notification
{
    /**
     * @var string
     */
    private $heading;

    /**
     * @var string
     */
    private $details;

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @var integer
     */
    private $userid;

    /**
     * @var integer
     */
    private $project;

    /**
     * @var integer
     */
    private $event;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set heading
     *
     * @param string $heading
     * @return Notification
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Get heading
     *
     * @return string 
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set details
     *
     * @param string $details
     * @return Notification
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string 
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Notification
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return Notification
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set project
     *
     * @param integer $project
     * @return Notification
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return integer 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set event
     *
     * @param integer $event
     * @return Notification
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return integer 
     */
    public function getEvent()
    {
        return $this->event;
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
     * @var boolean
     */
    private $read;

    /**
     * @var integer
     */
    private $type;


    /**
     * Set read
     *
     * @param boolean $read
     * @return Notification
     */
    public function setRead($read)
    {
        $this->read = $read;

        return $this;
    }

    /**
     * Get read
     *
     * @return boolean 
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Notification
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
     * @var integer
     */
    private $opportunity;

    /**
     * @var boolean
     */
    private $seen;


    /**
     * Set opportunity
     *
     * @param integer $opportunity
     * @return Notification
     */
    public function setopportunity($opportunity)
    {
        $this->opportunity = $opportunity;

        return $this;
    }

    /**
     * Get opportunity
     *
     * @return integer 
     */
    public function getopportunity()
    {
        return $this->opportunity;
    }

    /**
     * Set seen
     *
     * @param boolean $seen
     * @return Notification
     */
    public function setSeen($seen)
    {
        $this->seen = $seen;

        return $this;
    }

    /**
     * Get seen
     *
     * @return boolean 
     */
    public function getSeen()
    {
        return $this->seen;
    }
}
