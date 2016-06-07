<?php

namespace DBBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\Exception\Exception;

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
        $this->marksTable = array('marks' => array());
        $this->scheduleTable = array('subject_choice' => array(), 'rooms' => array());
        $this->subjectsChanged = true;
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
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $students;

    /**
     * @ORM\ManyToMany(targetEntity="Subject", inversedBy="groups")
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $subjects;

    /**
     * @ORM\Column(type="array")
     */
    private $marksTable;

    /**
     * @Orm\Column(type="array", nullable = true)
     */
    private $scheduleTable;

    /**
     *
     * @ORM\Column(type="boolean")
     */
    private $subjectsChanged;






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
    public function setSubjects($subjects)
    {
        if($this->subjects != $subjects){
            $this->subjectsChanged = true;
        }

        $this->subjects = $subjects;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubjects(){
        return $this->subjects;
    }

    public function setMarksTable(array $value)
    {
        //throw new Exception();
        if($value == null || $value['marks'] == null){
            return;
        }

        foreach($value['marks'] as $studentId => $subjects){
            foreach($subjects as $subjectId => $mark){
                $this->marksTable['marks'][$studentId][$subjectId] = $mark;
            }
        }

        return $this;
    }

    public function getMarksTable()
    {
        return $this->formMarksTable();
    }

    public function formMarksTable(){
        
        if($this->subjects->isEmpty() || $this->students->isEmpty()) {
            return;
        }

        /*$sortedSubjects = asort($this->subjects->getValues(), SORT_STRING);
        $sortedStudents = asort($this->students->getValues(), SORT_STRING);*/

        $subjectsObj = $this->subjects->getValues();
        $subjects = array();
        foreach($subjectsObj as $subject){
            $subjects[$subject->getId()] = $subject->getName();
        }

        $studentsObj = $this->students->getValues();
        $students = array(); $bk = array(); $notation = array();
        foreach($studentsObj as $student){
            $studentId = $student->getId();
            $students[$studentId] = $student->getNameWithInitials();
            $bk[$studentId] = $student->getBK();
            $notation[$studentId] = $student->getNotation();
        }

        $table = array(
            'students' => $students,
            'subjects' => $subjects,
            'marks' => array(),
            'bk' => $bk,
            'notation' => $notation
        );

        if($this->marksTable['marks'] == null){
            $this->marksTable['marks'] = array();
        }

        foreach($students as $studentId => $student) {
            if (key_exists($studentId, $this->marksTable['marks'])) {
                foreach ($subjects as $subjectId => $subject) {
                    if (key_exists($subjectId, $this->marksTable['marks'][$studentId])) {
                        $mark = $this->marksTable['marks'][$studentId][$subjectId];
                        $table['marks'][$studentId][$subjectId] = $mark;
                    }
                }
            }
        }

        return $table;
    }

    public function setScheduleTable($table)
    {
        if(empty($table)){
            return;
        }
        $this->scheduleTable['subject_choice'] = $table['subject_choice'];
        $this->scheduleTable['rooms'] = $table['rooms'];
    }

    public function getScheduleTable()
    {
        $table = $this->scheduleTable;
        $table['subjects'] = array();
        $table['teachers'] = array();
        foreach($this->getSubjects() as $subject){
            $name = $subject->getName();
            $id = $subject->getId();
            $table['subjects'][$id] = $name;
            $table['subject_id'][$name] = $id;
            
            $table['teachers'][$subject->getId()] = $subject->getTeacher()->getName();
        }
        if($this->subjectsChanged) {
            foreach($table['subject_choice'] as $i => $row){
                foreach($row as $m => $name){
                    if(!in_array($name, $table['subjects'])){
                        $table['subject_choice'][$i][$m] = '';
                    }
                }
            }
            $this->subjectsChanged = false;
        }

        return $table;
    }

    public function __toString()
    {
        return $this->name;
    }
}
