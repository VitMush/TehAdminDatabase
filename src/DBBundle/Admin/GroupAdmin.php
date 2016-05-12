<?php

namespace DBBundle\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use DBBundle\Form\Type\TableType;
use DBBundle\Entity\Group;
use DBBundle\Entity\Student;
use DBBundle\Entity\Mark;
use DBBundle\Entity\Subject;
use Symfony\Component\Form\Form;

class GroupAdmin extends Admin
{

    private $start = 'new';
    private $end = 'new';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();
        $creation = $subject && $subject->getId() ? false : true;
        $this->log($this->getClass());

        if(!$creation){
            $this->log(implode($subject->getStudents()->getValues()));
            /*$groupId = $this->id($this->getSubject());
            $doc = $this->getConfigurationPool()->getContainer()->get('Doctrine');
            $group = $doc->getRepository('DBBundle:Group')->find($groupId);

            $this->getConfigurationPool()->getContainer()->get('Logger')->debug($group.getName());*/
        }

        /*if(!$creation){
            $formMapper
                ->tab('Table')
                    ->add('students', "sonata_type_model_autocomplete", array(
                        'template' => "DBBundle:mark_table.html.twi",
                        'table' => $this->formTable(),
                        'students' => array('someStudent' => 'hello', 's2' => 'bye'),    
                        ))
                ->end()->end();
        }*/
        $formMapper
                ->tab('Edit')
                    ->with('General', array('class' => 'col-md-4'))
                        ->add('name', 'text')
                        ->add("speciality", 'text')
                    ->end()
                    ->with("Subjects List", array('class' => 'col-md-7'))
                        ->add('subjects', 'sonata_type_model', array(
                            'class' => 'DBBundle\Entity\Subject',
                            'by_reference' => false,
                            'required' => false,
                            'multiple' => true
                        ))
                    ->end()
                    ->with("Student List", array('class' => 'col-md-7'))
                        ->add('students', 'sonata_type_model', array(
                            'class' => 'DBBundle\Entity\Student',
                            'property' => 'name',
                            'by_reference' => false,
                            'required' => false,
                            'multiple' => true
                        ))
                    ->end()
                ->end();

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('name')
                ->add('speciality');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('name')
                ->add('speciality');
    }
    
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
           ->add('id')
           ->add('name');
    }

    public function prePersist($group){
        $this->preUpdate($group);
    }

    public function preUpdate($group){
        //$students = $group->getStudents();
        //$group->setStudents($students instanceof ArrayCollection ? $students : new ArrayCollection($students->getValues()));
    }
    
    public function toString($object) {
        return $object instanceof \DBBundle\Entity\Group
                ? $object->getName()
                : '_some_ Category';
    }

    private function formTable(){
        //$doc = $this->getConfigurationPool()->getContainer()->get('Doctrine');
        //$group = $doc->getRepository('DBBundle:Group')->find($groupId);
        $group = $this->getSubject();
        $students = $group->getStudents();
        $subjects = $group->getSubjects();
        
        $studentsNames = array(); $subjectsNames = array(); $marks = array(); $sbujectsIds = array();
        
        foreach($subjects as $subject){
            array_push($subjectsNames, $subject->getName());
            array_push($subjectsIds, $subject->getId());
        }
        
        foreach($students as $student){
            array_push($studentsNames, $student->getName());
            $row = array();
            foreach($subjectsIds as $subjectId){
                foreach($student->getMarks() as $mark){
                    if($subjectId == $mark->getSubject()->getId()){
                        array_push($row, $mark->getMark());
                        break;
                    }
                }
            }
            array_push($marks, $row);
        }
        
        
        return array(
            'students' => $studentsNames,
            'subjects' => $subjectsNames,
            'marksTable' => $marks
        );
    }

    private function log($message){
        $this->getConfigurationPool()->getContainer()->get('Logger')->debug($message);
    }
}