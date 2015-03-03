<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RefereeAndUser
 */
class RefereeAndUser
{
    /**
     * @var String
     */
    private $referee;
    
    /**
     * @var String
     */
    private $referees;

    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var integer
     */
    private $status;
    
    /**
     * @var integer
     */
    private $token;



    /**
     * @var \Ridwan\EntityBundle\Entity\Authentication
     */
    private $user;


    public function __construct()
    {
        $this->referees = new ArrayCollection();
    }
    
     /**
     * Get referees [Only for the FORM]
     *
     * @return string
     */
    public function getReferees()
    {
        return $this->referees;
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
     * Set referee
     *
     * @param \Ridwan\EntityBundle\Entity\Referee $referee
     * @return RefereeAndUser
     */
    public function setReferee(\Ridwan\EntityBundle\Entity\Referees $referee = null)
    {
        $this->referee = $referee;

        return $this;
    }

    /**
     * Get referee
     *
     * @return string
     */
    public function getReferee()
    {
        return $this->referee;
    }
    
    
     /**
     * Set token
     *
     * @param string $token
     * @return RefereeAndUser
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }



 /**
     * Set status
     *
     * @param int $status
     * @return RefereeAndUser
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }






    /**
     * Set user
     *
     * @param \Ridwan\EntityBundle\Entity\Authentication $user
     * @return RefereeAndUser
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
