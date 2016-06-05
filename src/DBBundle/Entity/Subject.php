<?php

namespace DBBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Subject
 *
 * @ORM\Table(name="subjects")
 * @ORM\Entity(repositoryClass="DBBundle\Repository\SubjectRepository")
 */
class Subject
{
    
    public function __construct()
    {
        $this->groups = new ArrayCollection();
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
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;

    /**
     * @var Teacher
     *
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="subjects")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
     */
    private $teacher;

    /**
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="subjects")
     */
    private $groups;

    /**
     * @ORM\OneToMany(targetEntity="Mark", mappedBy="subjects")
     */
    private $marks;







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
     * @return Subject
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
    
    public function getNameWithTeacherName(){
        return $this->name . ' (' . $this->teacher . ')';
    }

    /**
     * Set teacher
     *
     * @param mixed $teacher
     * @return Subject
     */
    public function setTeacher(Teacher $teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return mixed
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param mixed $groups
     * @return $this
     */
    public function setGroups($groups){
        $this->groups = $groups;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroups(){
        return $this->groups;
    }

    public function getMarks(){
        return $this->marks;
    }

    public function __toString(){
        return $this->getName();
        //return empty($title) ? 'hell' : $title;
    }
}
