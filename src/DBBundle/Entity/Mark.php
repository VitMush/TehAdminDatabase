<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mark
 * @ORM\Table(name"mark")
 */
class Mark
{
    /**
     * @var int
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Student")
     */
    private $student;

    /**
     * @ORM\OneToOne(targetEntity="Subject")
     */
    private $subj;

    /**
     * @var tinyint
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
    public function setSubject($subj)
    {
        $this->subj = $subj;

        return $this;
    }

    /**
     * Get subj
     *
     */
    public function getSubject()
    {
        return $this->subj;
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
