<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Teacher
 *
 * @ORM\Table(name="teacher")
 * @ORM\Entity(repositoryClass="DBBundle\Repository\TeacherRepository")
 */
class Teacher
{
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Subject", mappedBy="teacher", orphanRemoval=true)
     */
    private $subjects;


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
     * @return Teacher
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

    /**
     * Set subjects
     *
     * @param ArrayCollection $subjects
     * @return Teacher
     */
    public function setSubjects(ArrayCollection $subjects){
        $this->subjects = $subjects;
        return $this;
    }

    /**
     * Get subjects
     *
     * @return ArrayCollection
     */
    public function getSubjects(){
        return $this->subjects;
    }

    public function __toString(){
        return $this->name;
        //return empty($title) ? 'hell' : $title;
    }

}
