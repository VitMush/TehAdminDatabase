<?php
namespace DBBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TeacherAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $t = $this->getTranslator();
        $formMapper
            ->with($t->trans('teacher.teacher'))
                ->add('name', 'text', array('label' => $t->trans('teacher.name')))
            /*->add('subjects', 'sonata_type_model', array(
                'class' => 'DBBundle\Entity\Subject',
                'property' => 'name',
                'required' => false
            ));*/
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $t = $this->getTranslator();
        $datagridMapper
            ->add('name', null, array('label' => $t->trans('teacher.name')));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $t = $this->getTranslator();
        $listMapper
            ->addIdentifier('name', null, array('label' => $t->trans('teacher.name')))
            ->addIdentifier('subjects', null, array('label' => $t->trans('teacher.subjects'), 'route' => array('name' => 'edit')));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $t = $this->getTranslator();
        $showMapper
            ->add('id')
            ->add('name', null, array('label' => $t->trans('teacher.name')));
    }

    public function toString($object) {
        //return $object->getName();
        return $object instanceof \DBBundle\Entity\Teacher
            ? $object->getName()
            : '_some_ Teacher;';
    }
}