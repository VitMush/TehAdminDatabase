<?php

namespace DBBundle\Admin;

use DBBundle\DBBundle;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MarkAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('mark', "number")
            ->add('student', 'sonata_type_model', array('class' => 'DBBundle\Entity\Student'))
            ->add('subject', 'sonata_type_model', array('class' => 'DBBundle\Entity\Subject'));
    }

    /*protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('mark', "number")
            ->add('student', 'sonata_type_model', array('class' => 'DBBundle\Entity\Student'))
            ->add('subject', 'sonata_type_model', array('class' => 'DBBundle\Entity\Subject'));
    }*/

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->add('mark')
                ->addIdentifier('student');
    }
    
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
           ->add('mark')
           ->addIdentifier('studet')
           ->addIdentifier('subject');
    }
    
    public function toString($object) {
        return $object instanceof \DBBundle\Entity\Mark
                ? $object->getMark()
                : '_some_ Mark';
    }
}