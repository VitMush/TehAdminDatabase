<?php

namespace DBBundle\Admin;

use DBBundle\DBBundle;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class GroupAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Table')
            ->end()
            ->tab('Edit')
                ->with('General', array('class' => 'col-md-4'))
                ->add('name', 'text')
                ->add("speciality", 'text')
                ->end()
                ->with("Student List", array('class' => 'col-md-5'))
                    ->add('students', 'sonata_type_model', array('class' => 'DBBundle\Entity\Student', 'required' => false, 'multiple' => true))
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
    
    public function toString($object) {
        return $object instanceof \DBBundle\Entity\Group
                ? $object->getName()
                : '_some_ Category';
    }
}