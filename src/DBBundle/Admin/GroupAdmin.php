<?php

namespace DBBundle\Admin;

use DBBundle\Form\Type\MarksTableType;
use DBBundle\Form\Type\ScheduleType;
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
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Form;

class GroupAdmin extends Admin
{

    private $start = 'new';
    private $end = 'new';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();
        $creation = $subject && $subject->getId() ? false : true;
        //$this->log($this->getClass());

        $some = array(2 => '2', 0 => '0', 4 => '4');
        //throw new \Exception(implode(' ', array_keys($some)));

        if(!$creation){
            $this->log(implode($subject->getStudents()->getValues()));
            /*$groupId = $this->id($this->getSubject());
            $doc = $this->getConfigurationPool()->getContainer()->get('Doctrine');
            $group = $doc->getRepository('DBBundle:Group')->find($groupId);

            $this->getConfigurationPool()->getContainer()->get('Logger')->debug($group.getName());*/
        }

        $t = $this->getTranslator();

        if(!$creation){
            $formMapper
                ->tab($t->trans('group.marksT'))
                    ->with($t->trans('group.marksT'))
                        ->add('marksTable', MarksTableType::class, array('label' => $t->trans('group.marks.marksTable'), 'required' => false))
                ->end()->end();
        }
        $formMapper
                ->tab($t->trans('group.editT'))
                    ->with($t->trans('group.edit.general'), array('class' => 'col-md-4'))
                        ->add('name', 'text', array('label' => $t->trans('group.name')))
                        ->add("speciality", 'text', array('label' => $t->trans('group.speciality')))
                    ->end()
                    ->with($t->trans('group.edit.subjectsList'), array('class' => 'col-md-7'))
                        ->add('subjects', 'sonata_type_model', array(
                            'label' => $t->trans('group.subjects'),
                            'class' => 'DBBundle\Entity\Subject',
                            'property' => 'nameWithTeacherName',
                            'by_reference' => false,
                            'required' => false,
                            'multiple' => true
                        ))
                    ->end()
                    ->with($t->trans('group.edit.studentsList'), array('class' => 'col-md-7'))
                        ->add('students', 'sonata_type_model', array(
                            'label' => $t->trans('group.students'),
                            'class' => 'DBBundle\Entity\Student',
                            'property' => 'nameWithInitials',
                            'by_reference' => false,
                            'required' => false,
                            'multiple' => true
                        ))
                    ->end()->end();
        if(!$creation){
            $formMapper
                ->tab($t->trans('group.scheduleT'))
                    ->with($t->trans('group.schedule.scheduleTable'))
                        ->add('scheduleTable', ScheduleType::class, array('label' => $t->trans('group.schedule.scheduleTable')))
                ->end()->end();
        }

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $t = $this->getTranslator();
        $datagridMapper
                ->add('name', null, array('label' => $t->trans('group.name')))
                ->add('speciality', null, array('label' => $t->trans('group.speciality')));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $t = $this->getTranslator();
        $listMapper
                ->addIdentifier('name', null, array('label' => $t->trans('group.name')))
                ->add('speciality', null, array('label' => $t->trans('group.speciality')));
    }
    
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id', null, array())
            ->add('name', null, array());
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