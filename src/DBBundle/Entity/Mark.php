<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grade
 * 
 * @ORM\Table(name="mark")
 * @ORM\Entity(repositoryClass="DBBundle\Repository\MarkRepository")
 */
class Mark
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
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="marks")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="marks")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $subject;

    /**
     * @ORM\Column(length=15)
     */
    private $mark;

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
     * Set student
     *
     * @return Mark
     */
    public function setStudent($student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     * 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set subj
     *
     * @return Mark
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subjz`
     *
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set mark
     *
     * @param \tinyint $mark
     * @return Mark
     */
    public function setMark(\tinyint $mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return \tinyint 
     */
    public function getMark()
    {
        return $this->mark;
    }
}
