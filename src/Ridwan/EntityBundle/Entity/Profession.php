<?php

namespace Ridwan\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skills
 */
class Profession
{
    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $profession;



    /**
     * @var integer
     */
    private $id;


    /**
     * Set category
     *
     * @param string $category
     * @return Profession
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get selection
     *
     * @return string
     */
    public function getSelection()
    {
        return ( $this->category." | ".$this->profession);
    }

    /**
     * Set profession
     *
     * @param string $profession
     * @return Profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string 
     */
    public function getProfession()
    {
        return $this->profession;
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
