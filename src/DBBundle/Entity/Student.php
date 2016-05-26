<?php

namespace DBBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="DBBundle\Repository\StudentRepository")
 */
class Student
{

    public function  __construct(){
        //$this->group = new ArrayCollection();
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=20)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="bk", type="string", length=5)
     */
    private $bk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth", type="date")
     */
    private $birth;

    /**
     * @var string
     *
     * @ORM\Column(name="person_certificate", type="string", length=20)
     */
    private $personCertificate;

    /**
     * @var string
     *
     * @ORM\Column(name="inn", type="string", length=20)
     */
    private $inn;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=2)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=150)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="parents", type="string", length=150)
     */
    private $parents;

    /**
     * @var string
     *
     * @ORM\Column(name="notation", type="string", length=100)
     */
    private $notation;

    /**
     * @var string
     *
     * @ORM\Column(name="recordbook", type="string", length=30)
     */
    private $recordbook;

    /**
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="students")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $group;

    /**
     * @ORM\OneToMany(targetEntity="Mark", mappedBy="students", orphanRemoval=true)
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
     * @return Student
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
     * Set number
     *
     * @param string $number
     * @return Student
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set bk
     *
     * @param string $bk
     * @return Student
     */
    public function setBK($bk)
    {
        $this->bk = $bk;

        return $this;
    }

    /**
     * Get bk
     *
     * @return string 
     */
    public function getBK()
    {
        return $this->bk;
    }

    /**
     * Set birth
     *
     * @param \DateTime $birth
     * @return Student
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;

        return $this;
    }

    /**
     * Get birth
     *
     * @return \DateTime 
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * Set personCertificate
     *
     * @param string $personCertificate
     * @return Student
     */
    public function setPersonCertificate($personCertificate)
    {
        $this->personCertificate = $personCertificate;

        return $this;
    }

    /**
     * Get personCertificate
     *
     * @return string 
     */
    public function getPersonCertificate()
    {
        return $this->personCertificate;
    }

    /**
     * Set inn
     *
     * @param string $inn
     * @return Student
     */
    public function setInn($inn)
    {
        $this->inn = $inn;

        return $this;
    }

    /**
     * Get inn
     *
     * @return string 
     */
    public function getInn()
    {
        return $this->inn;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Student
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Student
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Student
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set parents
     *
     * @param string $parents
     * @return Student
     */
    public function setParents($parents)
    {
        $this->parents = $parents;

        return $this;
    }

    /**
     * Get parents
     *
     * @return string 
     */
    public function getParents()
    {
        return $this->parents;
    }

    /**
     * Set notation
     *
     * @param string $notation
     * @return Student
     */
    public function setNotation($notation)
    {
        $this->notation = $notation;

        return $this;
    }

    /**
     * Get notation
     *
     * @return string 
     */
    public function getNotation()
    {
        return $this->notation;
    }

    /**
     * Set recordbook
     *
     * @param string $recordbook
     * @return Student
     */
    public function setRecordbook($recordbook)
    {
        $this->recordbook = $recordbook;

        return $this;
    }

    /**
     * Get recordbook
     *
     * @return string 
     */
    public function getRecordbook()
    {
        return $this->recordbook;
    }

    /**
     * Set group
     *
     * @param mixed $group
     *
     * @return Student
     */
    public function setGroup($group){
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return mixed
     */
    public function  getGroup()
    {
        return $this->group;
    }

    /**
     * Detach Group
     *
     * @return Student
     */
    public function detachGroup(){
        $this->removeGroup();

        return $this;
    }

    /**
     * Remove Group
     *
     * @return $this
     */
    public function removeGroup(){
        $this->group = null;

        return $this;
    }

    /**
     * @param mixed $marks
     * @return $this
     */
    public function setMarks($marks){
        //$this->marks = $marks;
        foreach($marks as $mark){
            $this->addMark($mark);
        }

        return $this;
    }

    /**
     * @param Mark $mark
     * @return $this
     */
    public function addMark(Mark $mark){
        foreach($this->marks as $i){
            if($i->getId() == $mark->getId()){
                $i->setMark($mark->getMark());
                return $this;
            }
        }
        $mark->setStudent($this);
        $this->marks->add($mark);

        return $this;
    }

    /**
     * @param Mark $mark
     */
    public function removeMark(Mark $mark){
        $this->marks->removeElement($mark);
    }

    /**
     * @return mixed
     */
    public function getMarks(){
        return $this->marks;
    }

    public function __toString(){
        return $this->name;
    }
}
