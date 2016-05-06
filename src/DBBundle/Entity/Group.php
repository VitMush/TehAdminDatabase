<?php

namespace DBBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 *
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="DBBundle\Repository\GroupRepository")
 */
class Group
{

    public function __construct(){
        $this->students = new ArrayCollection();
        $this->subjects = new ArrayCollection();
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="speciality", type="string", length=20)
     */
    private $speciality;

    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="group", cascade={"persist"}, orphanRemoval=false)
     */
    private $students;

    /**
     * @ORM\ManyToMany(targetEntity="Subject", inversedBy="groups")
     */
    private $subjects;





    /*public function preRemove(){
        $this->removeStudents();
    }*/




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
     * @return Group
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
     * Set speciality
     *
     * @param string $speciality
     * @return Group
     */
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Get speciality
     *
     * @return string 
     */
            public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * Set students
     *
     * @param ArrayCollection $students
     *
     * @return Group
     */
    public function setStudents(ArrayCollection $students)
    {
        if($students->count() > 0) {
            foreach ($students as $student) {
                $this->addStudent($student);
            }
        }

        return $this;
    }

    /**
     * Add Student
     *
     * @param Student $student
     * @return $this
     */
    public function addStudent(Student $student){
        $student->setGroup($this);
        if(!$this->students->contains($student))
            $this->students->add($student);

        return $this;
    }

    /**
     * Remove Student
     *
     * @param Student $student
     * @return $this
     */
    public function removeStudent(Student $student){

        $student->setGroup(null);
        $this->students->removeElement($student);

        return $this;
    }

    /**
     * Remove Students
     *
     * @return $this
     */
    public function removeStudents(){
        foreach($this->students as $student)
            $this->removeStudent($student);

        return $this;
    }

    /**
     * Get students
     *
     * @return ArrayCollection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param mixed $subjects
     * @return $this
     */
    public function setSubjects($subjects){
        $this->subjects = $subjects;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubjects(){
        return $this->subjects;
    }

    public function __toString(){
        return $this->name;
    }
}
