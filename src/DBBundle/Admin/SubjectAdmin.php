<?php
namespace DBBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SubjectAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('teacher', 'sonata_type_model', array(
                'class' => 'DBBundle\Entity\Teacher',
                'property' => 'name',
                'required' => true
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', 'table', array('route' => array('name' => 'edit')))
            ->addIdentifier('teacher');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name');
    }

    public function toString($object) {
        //return $object->getName();
        return $object instanceof \DBBundle\Entity\Subject
            ? $object->getName().$object->getTeacher()
            : '_some_ Subject';
    }
}