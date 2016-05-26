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

        $t = $this->getTranslator();

        $fastCreateRequest = false;
        if(strpos($this->getRequest()->getUri(), 'create?code')){
            $fastCreateRequest = true;
        }

        $formMapper
            ->with($t->trans(('subject.subject')))
                ->add('name', 'text', array('label' => $t->trans('subject.name')))
                ->add('teacher', 'sonata_type_model', array(
                    'label' => $t->trans('subject.teacher'),
                    'class' => 'DBBundle\Entity\Teacher',
                    'property' => 'name',
                    'required' => true
                ));
        if(!$fastCreateRequest)
        $formMapper->add('groups', 'sonata_type_model', array(
                'label' => $t->trans('subject.groups'),
                'class' => 'DBBundle:Group',
                'required' => false,
                'multiple' => true
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $t = $this->getTranslator();
        $datagridMapper
            ->add('name', null, array('label' => $t->trans('subject.name')));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $t = $this->getTranslator();
        $listMapper
            ->addIdentifier('name', 'table', array('label' => $t->trans('subject.name'), 'route' => array('name' => 'edit')))
            ->addIdentifier('teacher', null, array('label' => $t->trans('subject.teacher')));
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