<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organizationfeedback
 */
class Organizationfeedback
{
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $rating;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var boolean
     */
    private $recommend;

    /**
     * @var boolean
     */
    private $joinagain;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ridwan\EntityBundle\Entity\Organization
     */
    private $organization;

    /**
     * @var \Ridwan\EntityBundle\Entity\Volunteerpersonal
     */
    private $volunteer;


    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Organizationfeedback
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set rating
     *
     * @param string $rating
     * @return Organizationfeedback
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Organizationfeedback
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set recommend
     *
     * @param boolean $recommend
     * @return Organizationfeedback
     */
    public function setRecommend($recommend)
    {
        $this->recommend = $recommend;

        return $this;
    }

    /**
     * Get recommend
     *
     * @return boolean 
     */
    public function getRecommend()
    {
        return $this->recommend;
    }

    /**
     * Set joinagain
     *
     * @param boolean $joinagain
     * @return Organizationfeedback
     */
    public function setJoinagain($joinagain)
    {
        $this->joinagain = $joinagain;

        return $this;
    }

    /**
     * Get joinagain
     *
     * @return boolean 
     */
    public function getJoinagain()
    {
        return $this->joinagain;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Organizationfeedback
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
     * @return Organizationfeedback
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
     * Set volunteer
     *
     * @param \Ridwan\EntityBundle\Entity\Volunteerpersonal $volunteer
     * @return Organizationfeedback
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
