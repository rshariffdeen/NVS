<?php

namespace Ridwan\EntityBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Authentication
 */
class Authentication extends BaseUser
{

    private $path;

    /**
     * @var integer
     */



    /**
     * Set path
     *
     * @param string $path
     * @return Authentication
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    private $type;


    /**
     * Set type
     *
     * @param string $type
     * @return Authentication
     */

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }





    /**
     * @var integer
     */
    protected $id;


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
