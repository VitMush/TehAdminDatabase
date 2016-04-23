<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
    * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="category", orphanRemoval=true)
    */
    private $blogPosts;

    public function __construct()
    {
        $this->blogPosts = new ArrayCollection();
    }
    
    public function getBlogPosts()
    {
        return $this->blogPosts;
    }
	
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="number", type="string", length=20)
     */
    private $number;
    
    /**
     * Get number
     * 
     * @return integer
     */
    public function getNumber()
    {
        return intval($this->number);
    }
    
    /**
     * Set number
     * 
     * @param int $val
     * @return Category
     */
    public function setNumber($val)
    {
        $this->number = strval($val);
        return $this;
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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function  __toString()
    {
        return $this->getName();
    }

}
