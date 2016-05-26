<?php
namespace DBBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Config\Definition\Exception\Exception;

class SubjectAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /*if($this->getParent() == null){
            throw new Exception("noParent");
        }
        else throw new Exception('hasParent');*/

        $fastCreateRequest = false;
        if(strpos($this->getRequest()->getUri(), 'create?code')){
            $fastCreateRequest = true;
        }

        $formMapper
            ->add('name', 'text')
            ->add('teacher', 'sonata_type_model', array(
                'class' => 'DBBundle\Entity\Teacher',
                'property' => 'name',
                'required' => true
            ));
        if(!$fastCreateRequest)
        $formMapper->add('groups', 'sonata_type_model', array(
                'class' => 'DBBundle:Group',
                'required' => false,
                'multiple' => true
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
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
            ? $object->getName().'('.$object->getTeacher().')'
            : '_some_ Subject';
    }
}